<?php

namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;

use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

class GetDomainInformation extends Call
{
    public $action = 'domains/:domain/information';

    public $type = parent::TYPE_GET;
}