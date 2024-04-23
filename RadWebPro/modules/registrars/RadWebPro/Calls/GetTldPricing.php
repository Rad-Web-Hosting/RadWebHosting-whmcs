<?php

namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;

use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

class GetTldPricing extends Call
{
    public $action = "tlds/pricing";

    public $type = parent::TYPE_GET;
}