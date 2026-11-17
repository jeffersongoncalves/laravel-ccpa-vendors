<?php

return [

    'table' => 'ccpa_vendors',

    /*
     * Terms the written contract must contain. Keys are stored on each vendor's dpa_checklist;
     * a vendor with an unchecked item of its role is flagged.
     */
    'checklist' => [
        // Service providers and contractors (Cal. Civ. Code §1798.100(d); CCPA Regulations §7051(a)).
        'service_provider' => [
            'no_sale_or_sharing' => 'Prohibits selling or sharing the personal information',
            'specified_purpose' => 'Identifies the specific business purpose of the processing',
            'purpose_limitation' => 'Prohibits retaining, using or disclosing it for any other purpose or outside the direct relationship',
            'no_combining' => 'Prohibits combining it with personal information from other sources, except as allowed',
            'same_protection' => 'Requires CCPA compliance and the same level of privacy protection',
            'reasonable_steps' => 'Lets you take reasonable steps to ensure its use is consistent with your obligations',
            'notify_if_unable' => 'Requires notice if it can no longer meet its obligations',
            'stop_and_remediate' => 'Lets you stop and remediate unauthorized use',
            'subcontractors' => 'Requires notice of subcontractors bound by the same terms',
            'consumer_requests' => 'Requires cooperation with consumer requests',
        ],
        // Contractors also certify they understand and will comply with the restrictions (§1798.140(j)(1)(B)).
        'contractor' => [
            'certification' => 'Contractor certifies it understands and will comply with the restrictions',
        ],
        // Third parties you sell or share personal information with (Regulations §7053).
        'third_party' => [
            'limited_purposes' => 'Limits the use to the specified purposes of the sale or sharing',
            'same_protection' => 'Requires CCPA compliance and the same level of privacy protection',
            'reasonable_steps' => 'Lets you take reasonable steps to ensure its use is consistent with your obligations',
            'notify_if_unable' => 'Requires notice if it can no longer meet its obligations',
            'stop_and_remediate' => 'Lets you stop and remediate unauthorized use',
        ],
    ],

    /*
     * How often each risk tier must be reviewed, counted from the last review
     * (or from registration). CarbonInterval strings.
     */
    'review_every' => [
        'low' => '3 years',
        'medium' => '2 years',
        'high' => '1 year',
    ],

];
