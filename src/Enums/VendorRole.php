<?php

namespace JeffersonGoncalves\CcpaVendors\Enums;

enum VendorRole: string
{
    /** Processes personal information on your behalf for a business purpose (Cal. Civ. Code §1798.140(ag)). */
    case ServiceProvider = 'service_provider';

    /** Receives personal information for a business purpose under a written contract (§1798.140(j)). */
    case Contractor = 'contractor';

    /** Anyone else you sell or share personal information with (§1798.140(ai)). */
    case ThirdParty = 'third_party';

    /**
     * Contract terms this role requires: config('ccpa-vendors.checklist.service_provider') for service
     * providers and contractors (Regulations §§7051 and 7050), config('ccpa-vendors.checklist.third_party')
     * for third parties (Regulations §7053; §1798.100(d)).
     *
     * @return array<string, string>
     */
    public function checklist(): array
    {
        $key = $this === self::ThirdParty ? 'third_party' : 'service_provider';
        $items = (array) config("ccpa-vendors.checklist.{$key}", []);

        if ($this === self::Contractor) {
            $items += (array) config('ccpa-vendors.checklist.contractor', []);
        }

        return $items;
    }
}
