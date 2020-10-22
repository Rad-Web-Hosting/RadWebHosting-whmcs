<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetDns
 *
 * @author inbs
 */
class GetDns extends Call
{
    public $action = "domains/:domain/dns";
    
    public $type = parent::TYPE_GET;
}