<?php

use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Configuration;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Helpers\ResultsListFactory;
use WHMCS\Domain\TopLevel\ImportItem;
use WHMCS\Results\ResultsList;
use WHMCS\Domain\Registrar\Domain;
use \WHMCS\Carbon;

//Loader
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . "Loader.php";
new \ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Loader(__DIR__);

/**
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_getConfigArray()
{
    $configarray = [
        "FriendlyName" => [
            "Type"  => "System",
            "Value" => "RadWebPro"
        ],
        "Description"  => [
            "Type"  => "System",
            "Value" => "Rad Web Hosting's official maintained white-label Registrar Module. Offer domain registration, transfer, and renewal services for over 500 TLDs including the ngTLDs as well as ccTLDs from around the globe."
        ],
        "Username"     => [
            "FriendlyName" => "API Username",
            "Type"         => "text",
            "Size"         => "40",
            "Description"  => "Enter your email used in the main WHMCS"
        ],
        "ApiKey"       => [
            "FriendlyName" => "API Key",
            "Type"         => "text",
            "Size"         => "40",
            "Description"  => "Enter your API key received from provider"
        ],
        "ApiEndpoint"  => [
            "FriendlyName" => "API Endpoint",
            "Type"         => "text",
            "Size"         => "40",
            "Description"  => "Enter API endpoint",
            "Default"      => "https://radwebhosting.com/client_area/modules/addons/DomainsReseller/api/index.php"
        ],
    ];

    return $configarray;
}

/**
 * Register Domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_RegisterDomain($params)
{
    $postfields =
        [
            "domain"       => $params["domainname"],
            "regperiod"    => (int)$params["regperiod"],
            "domainfields" => base64_encode(serialize($params["additionalfields"])),
            "addons"       =>
                [
                    "dnsmanagement"   => $params['dnsmanagement'] ? 1 : 0,
                    "emailforwarding" => $params['emailforwarding'] ? 1 : 0,
                    "idprotection"    => $params['idprotection'] ? 1 : 0,
                ],
            "nameservers"  =>
                [
                    'ns1' => $params["ns1"],
                    'ns2' => $params["ns2"],
                    'ns3' => $params["ns3"],
                    'ns4' => $params["ns4"],
                    'ns5' => $params["ns5"],
                ],
            "contacts"     =>
                [
                    "registrant" =>
                        [
                            'firstname'   => $params["firstname"],
                            'lastname'    => $params["lastname"],
                            'companyname' => $params["companyname"],
                            'email'       => $params["email"],
                            'address1'    => $params["address1"],
                            'address2'    => $params["address2"],
                            'city'        => $params["city"],
                            'state'       => $params["state"],
                            'postcode'    => $params["postcode"],
                            'country'     => $params["country"],
                            'phonenumber' => $params["phonenumber"],
                            'tax_id'      => $params['tax_id']
                        ],
                ]
        ];
    try
    {
        $call = new Calls\RegisterDomain(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Transfer Domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_TransferDomain($params)
{
    $postfields =
        [
            "domain"       => $params["domainname"],
            "regperiod"    => (int)$params["regperiod"],
            "eppcode"      => $params["eppcode"],
            'domainfields' => base64_encode(serialize($params["additionalfields"])),
            "addons"       =>
                [
                    "dnsmanagement"   => $params['dnsmanagement'] ? 1 : 0,
                    "emailforwarding" => $params['emailforwarding'] ? 1 : 0,
                    "idprotection"    => $params['idprotection'] ? 1 : 0,
                ],
            "nameservers"  =>
                [
                    $params["ns1"],
                    $params["ns2"],
                    $params["ns3"],
                    $params["ns4"],
                    $params["ns5"],
                ],
            "contacts"     =>
                [
                    "registrant" =>
                        [
                            'firstname'   => $params["firstname"],
                            'lastname'    => $params["lastname"],
                            'companyname' => $params["companyname"],
                            'email'       => $params["email"],
                            'address1'    => $params["address1"],
                            'address2'    => $params["address2"],
                            'city'        => $params["city"],
                            'state'       => $params["state"],
                            'postcode'    => $params["postcode"],
                            'country'     => $params["country"],
                            'phonenumber' => $params["phonenumber"],
                            'tax_id'      => $params['tax_id']
                        ],
                ]
        ];

    try
    {
        $call = new Calls\TransferDomain(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Renew Domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_RenewDomain($params)
{
    $postfields =
        [
            "domain"    => $params["domainname"],
            "regperiod" => (int)$params["regperiod"],
            "addons"    =>
                [
                    "dnsmanagement"   => $params['dnsmanagement'] ? 1 : 0,
                    "emailforwarding" => $params['emailforwarding'] ? 1 : 0,
                    "idprotection"    => $params['idprotection'] ? 1 : 0,
                ],
        ];

    try
    {
        $call = new Calls\RenewDomain(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get name servers
 *
 * @param array $params
 * @return array $return
 */
//function RadWebPro_GetNameservers($params)
//{
//    $postfields =
//        [
//            "domain" => $params["domainname"]
//        ];
//
//    try
//    {
//        $call = new Calls\GetNameServers(Configuration::create($params), $postfields);
//
//        $result = $call->process();
//        unset($result['success']);
//        unset($result['message']);
//        unset($result['status']);
//
//        return $result;
//    }
//    catch (\Exception $e)
//    {
//        return ['error' => $e->getMessage()];
//    }
//}

/**
 * Save nameservers
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_SaveNameservers($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],

            "ns1" => $params["ns1"],
            "ns2" => $params["ns2"],
            "ns3" => $params["ns3"],
            "ns4" => $params["ns4"],
            "ns5" => $params["ns5"],
        ];

    try
    {
        $call = new Calls\SaveNameServers(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Release Domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_ReleaseDomain($params)
{
    $postfields =
        [
            "domain"      => $params["domainname"],
            "transfertag" => $params["transfertag"]
        ];

    try
    {
        $call = new Calls\ReleaseDomain(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get EPP Code
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_GetEPPCode($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],
        ];

    try
    {
        $call = new Calls\GetEppCode(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get Contact Details
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_GetContactDetails($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],
        ];
    try
    {
        $call   = new Calls\GetContactDetails(Configuration::create($params), $postfields);
        $result = $call->process();
        $new    = [];
        foreach ($result as $key => $value)
        {
            $new[$key] = [];
            foreach ($value as $detail => $info)
            {
                $new[$key][str_replace('_', ' ', $detail)] = $info;
            }
        }
        return $new;
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Save Contact Details
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_SaveContactDetails($params)
{
    $postfields =
        [
            "domain"         => $params["domainname"],
            "contactdetails" => $params["contactdetails"]
        ];

    try
    {
        $call = new Calls\SaveContactDetails(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get Lock Status
 *
 * @param array $params
 * @return array $return
 */
//function RadWebPro_GetRegistrarLock($params)
//{
//    $postfields =
//        [
//            "domain" => $params["domainname"],
//        ];
//
//    try
//    {
//        $call = new Calls\GetRegistrarLock(Configuration::create($params), $postfields);
//        return $call->process();
//    }
//    catch (\Exception $e)
//    {
//        return ['error' => $e->getMessage()];
//    }
//}

/**
 * Update Lock Status
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_SaveRegistrarLock($params)
{
    $postfields =
        [
            "domain"     => $params["domainname"],
            "lockstatus" => $params["lockenabled"]
        ];

    try
    {
        $call = new Calls\SaveRegistrarLock(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get DNS Records
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_GetDNS($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],
        ];

    try
    {
        $call = new Calls\GetDns(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Save DNS Records
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_SaveDNS($params)
{
    $postfields =
        [
            "domain"     => $params["domainname"],
            "dnsrecords" => $params["dnsrecords"]
        ];

    try
    {
        $call = new Calls\SaveDns(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Register Name Server
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_RegisterNameserver($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],

            "nameserver" => $params["nameserver"],
            "ipaddress"  => $params["ipaddress"],
        ];

    try
    {
        $call = new Calls\RegisterNameServer(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Update Name Server
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_ModifyNameserver($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],

            "nameserver"       => $params["nameserver"],
            "currentipaddress" => $params["currentipaddress"],
            "newipaddress"     => $params["newipaddress"],
        ];

    try
    {
        $call = new Calls\ModifyNameServer(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Delete Name Server
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_DeleteNameserver($params)
{
    $postfields =
        [
            "domain"     => $params["domainname"],
            "nameserver" => $params["nameserver"],
        ];

    try
    {
        $call = new Calls\DeleteNameServer(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Delete Domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_RequestDelete($params)
{
    $postfields =
        [
            "domain" => $params["domainname"]
        ];

    try
    {
        $call = new Calls\RequestDelete(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Synchronize transfer domain
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_TransferSync($params)
{
    $postfields =
        [
            "domain" => "{$params["sld"]}.{$params["tld"]}"
        ];

    try
    {
        $call = new Calls\TransferSync(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Synchronize Registered Domains
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_Sync($params)
{
    $postfields =
        [
            "domain" => "{$params["sld"]}.{$params["tld"]}"
        ];

    try
    {
        $call = new Calls\Sync(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Get list of emails aliases
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_GetEmailForwarding($params)
{
    $postfields =
        [
            "domain" => $params["domainname"]
        ];

    try
    {
        $call = new Calls\GetEmailForwarding(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * Save list of emails aliases
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_SaveEmailForwarding($params)
{
    $postfields =
        [
            "domain"    => $params["domainname"],
            "prefix"    => $params["prefix"],
            "forwardto" => $params["forwardto"]
        ];

    try
    {
        $call = new Calls\SaveEmailForwarding(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * This function is called when the ID Protection setting is toggled on or off
 *
 * @param array $params
 * @return array $return
 */
function RadWebPro_IDProtectionToggle($params)
{
    $postfields =
        [
            "domain" => $params["domainname"],
            "status" => $params["protectenable"]
        ];

    try
    {
        $call = new Calls\ToggleIdProtect(Configuration::create($params), $postfields);
        return $call->process();
    }
    catch (\Exception $e)
    {
        return ['error' => $e->getMessage()];
    }
}

/**
 * This function is called when the ID Protection setting is toggled on or off
 *
 * @param $params
 * @return array
 */
function RadWebPro_IDProtectToggle($params)
{
    return RadWebPro_IDProtectionToggle($params);
}


/**
 * Send domain lookup request
 *
 * @param $params
 * @return array|bool|mixed|stdClass|string
 */
function RadWebPro_CheckAvailability($params)
{
    $postfields =
        [
            "searchTerm"         => $params["searchTerm"],
            "punyCodeSearchTerm" => $params["punyCodeSearchTerm"],
            "tldsToInclude"      => $params["tldsToInclude"],
            "isIdnDomain"        => $params['isIdnDomain'],
            "premiumEnabled"     => $params['premiumEnabled'],
            "isWhmcs"            => 1
        ];

    try
    {
        $call = new Calls\CheckAvailability(Configuration::create($params), $postfields);
        $result = $call->process();
        return  ResultsListFactory::createResultsList($result);
    }
    catch (\Exception $e)
    {
        \logModuleCall(
            'RadWebPro',
            'DomainLookup',
            $postfields,
            ['error' => $e->getMessage()]
        );
        return  ResultsListFactory::createResultsList([]);    }
}

function RadWebPro_GetDomainSuggestions($params)
{
    $postfields = [
        'searchTerm' => $params['searchTerm'],
        'punyCodeSearchTerm' => $params['punyCodeSearchTerm'],
        'tldsToInclude' => $params['tldsToInclude'] ?? [],
        'isIdnDomain' => (bool) $params['isIdnDomain'],
        'premiumEnabled' => (bool) $params['premiumEnabled'],
        'suggestionSettings' => $params['suggestionSettings'] ?? []
    ];

    try
    {
        $call = new Calls\GetDomainSuggestions(Configuration::create($params), $postfields);
        $result = $call->process();
        return ResultsListFactory::createResultsList($result);
    }
    catch (\Exception $e)
    {
        \logModuleCall(
            'RadWebPro',
            'DomainLookup',
            $postfields,
            ['error' => $e->getMessage()]
        );
    }
}

function RadWebPro_GetTldPricing($params)
{
    try
    {
        $call = new Calls\GetTldPricing(Configuration::create($params));
        $result = $call->process();

        $results = new ResultsList();

        foreach ($result as $extension)
        {
            $item = (new ImportItem)
                ->setExtension((string) $extension['tld'])
                ->setRegisterPrice((float) $extension['registrationPrice'])
                ->setRenewPrice((float) $extension['renewalPrice'])
                ->setTransferPrice((float) $extension['transferPrice'])
                ->setGraceFeeDays((int) $extension['graceDays'])
                ->setGraceFeePrice((float) $extension['graceFee'])
                ->setRedemptionFeeDays((int) $extension['redemptionDays'])
                ->setRedemptionFeePrice((float) $extension['redemptionFee'])
                ->setCurrency((string) $extension['currencyCode'])
                ->setYears($extension['years']);

            $results[] = $item;
        }

        return $results;
    }
    catch (\Exception $e)
    {
        \logModuleCall(
            'RadWebPro',
            'GetTldPricing',
            [],
            ['error' => $e->getMessage()]
        );
    }
}

function RadWebPro_GetDomainInformation($params)
{
    $call = new Calls\GetDomainInformation(Configuration::create($params), ['domain' => $params['domainname']]);
    $response = $call->process();

    if (array_key_exists('error', $response))
    {
        throw new Exception($response['error']);
    }

    $domain = new Domain();

    $domain->setDomain($response['domain'])
        ->setNameservers($response['nameservers'])
        ->setTransferLock($response['transferLock']);

    if ($response['expiryDate'])
    {
        $domain->setRegistrationStatus($response['status'])
            ->setTransferLockExpiryDate(Carbon::createFromFormat('Y-m-d', Carbon::parse($response['transferLockExpiryDate'])->format('Y-m-d')))
            ->setExpiryDate(Carbon::createFromFormat('Y-m-d', Carbon::parse($response['expiryDate'])->format('Y-m-d')))
            ->setRestorable($response['restorable'])
            ->setIdProtectionStatus($response['idProtectionStatus'])
            ->setDnsManagementStatus($response['dnsManagementStatus'])
            ->setEmailForwardingStatus($response['emailForwardingStatus'])
            ->setIsIrtpEnabled($response['isIrtpEnabled'])
            ->setIrtpOptOutStatus($response['irtpOptOutStatus'])
            ->setIrtpTransferLock($response['irtpTransferLock'])
            ->setIrtpTransferLockExpiryDate(Carbon::createFromFormat('Y-m-d', Carbon::parse($response['irtpTransferLockExpiryDate'])->format('Y-m-d')))
            ->setDomainContactChangePending($response['domainContactChangePending'])
            ->setPendingSuspension($response['willDomainSuspend'])
            ->setDomainContactChangeExpiryDate(Carbon::createFromFormat('Y-m-d', Carbon::parse($response['domainContactChangeExpiryDate'])->format('Y-m-d')))
            ->setRegistrantEmailAddress($response['registrantEmailAddress'])
            ->setRenewBeforeExpiration($response['renewBeforeExpiration'])
            ->setIrtpVerificationTriggerFields($response['irtpVerificationTriggerFields']);
    }

    return $domain;
}
