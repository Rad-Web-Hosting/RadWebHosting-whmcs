<?php

namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;

use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

/**
 * Description of GetDomainSuggestions
 *
 * @author inbs
 */
class GetDomainSuggestions extends Call
{
    public $action = "domains/lookup/suggestions";

    public $type = parent::TYPE_POST;
}