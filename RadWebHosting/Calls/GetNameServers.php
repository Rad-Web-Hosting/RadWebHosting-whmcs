<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetNameServers
 *
 * @author inbs
 */
class GetNameServers extends Call
{
    public $action = "domains/:domain/nameservers";
    
    public $type = parent::TYPE_GET;
}