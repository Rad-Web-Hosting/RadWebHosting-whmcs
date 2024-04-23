<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Helpers;
use \WHMCS\Domains\DomainLookup\SearchResult;
use \WHMCS\Domains\DomainLookup\ResultsList;
/**
 * Description of ResultsListFactory
 * 
 */
class ResultsListFactory
{
    public static function createResultsList(array $domainResults = []): ResultsList
    {
        $resultList = new ResultsList();
        foreach ($domainResults as $domainResult) {
            if(!is_array($domainResult)) {
                \logModuleCall(
                    'RadWebPro',
                    'DomainLookup',
                    [],
                    $domainResults
                );
                continue;
            }
            $searchResult = new SearchResult($domainResult["sld"], $domainResult["tld"]);
            $searchResult->setStatus($domainResult["status"]);
            if(!empty($domainResult["premiumCostPricing"]))
            {
                $searchResult->setPremiumCostPricing($domainResult["premiumCostPricing"]);
            }
            $resultList->append($searchResult);
        }
        return $resultList;
    }
    
}
