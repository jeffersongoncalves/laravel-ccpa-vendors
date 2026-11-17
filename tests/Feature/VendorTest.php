<?php

use Illuminate\Support\Facades\Artisan;
use JeffersonGoncalves\CcpaVendors\Enums\VendorIssue;
use JeffersonGoncalves\CcpaVendors\Enums\VendorRisk;
use JeffersonGoncalves\CcpaVendors\Enums\VendorRole;
use JeffersonGoncalves\CcpaVendors\Models\Vendor;

function fullChecklist(VendorRole $role): array
{
    return array_fill_keys(array_keys($role->checklist()), true);
}

it('flags a service provider without a contract, then with missing terms', function () {
    $vendor = Vendor::create(['name' => 'Stripe', 'role' => VendorRole::ServiceProvider]);

    expect($vendor->issues())->toBe([VendorIssue::AgreementMissing]);

    $vendor->update(['dpa_signed_at' => now(), 'dpa_checklist' => ['no_sale_or_sharing' => true]]);

    expect($vendor->issues())->toBe([VendorIssue::AgreementIncomplete])
        ->and($vendor->missingChecklistItems())->toContain('specified_purpose', 'consumer_requests')->not->toContain('no_sale_or_sharing');

    $vendor->update(['dpa_checklist' => fullChecklist(VendorRole::ServiceProvider)]);

    expect($vendor->issues())->toBe([]);
});

it('asks contractors for the certification on top of the service provider terms', function () {
    $vendor = Vendor::create([
        'name' => 'Agency',
        'role' => VendorRole::Contractor,
        'dpa_signed_at' => now(),
        'dpa_checklist' => fullChecklist(VendorRole::ServiceProvider),
    ]);

    expect($vendor->missingChecklistItems())->toBe(['certification']);
});

it('uses the third-party terms for sales and sharing', function () {
    $vendor = Vendor::create([
        'name' => 'AdNetwork',
        'role' => VendorRole::ThirdParty,
        'dpa_signed_at' => now(),
        'dpa_expires_at' => now()->addMonth(),
        'dpa_checklist' => fullChecklist(VendorRole::ThirdParty),
    ]);

    expect($vendor->issues())->toBe([])
        ->and(array_keys(VendorRole::ThirdParty->checklist()))->not->toContain('no_combining');

    $this->travel(2)->months();

    expect($vendor->issues())->toBe([VendorIssue::AgreementExpired]);
});

it('asks for a review by risk tier', function () {
    $high = Vendor::create(['name' => 'Payroll', 'role' => VendorRole::ServiceProvider, 'risk' => VendorRisk::High, 'dpa_signed_at' => now(), 'dpa_checklist' => fullChecklist(VendorRole::ServiceProvider)]);

    $this->travel(13)->months();

    expect($high->issues())->toBe([VendorIssue::ReviewDue])
        ->and($high->markReviewed()->issues())->toBe([]);
});

it('owes the data deletion or return after termination', function () {
    $vendor = Vendor::create(['name' => 'Old CRM', 'role' => VendorRole::ServiceProvider])->terminate();

    expect($vendor->issues())->toBe([VendorIssue::DataReturnPending])
        ->and(Vendor::query()->scopes('active')->count())->toBe(0)
        ->and($vendor->confirmDataReturned()->issues())->toBe([]);
});

it('lists vendors and their issues', function () {
    Vendor::create(['name' => 'Stripe', 'role' => VendorRole::ServiceProvider]);

    Artisan::call('ccpa:vendors');
    expect(Artisan::output())->toContain('Stripe')->toContain('No signed contract')->toContain('1 vendor(s) with issues.');

    Artisan::call('ccpa:vendors', ['--json' => true, '--issues' => true]);
    expect(json_decode(Artisan::output(), true))->toHaveCount(1)
        ->{0}->issues->toBe(['agreement_missing']);
});
