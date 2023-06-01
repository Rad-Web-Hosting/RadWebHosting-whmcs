<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetEmailForwarding
 *
 * @author inbs
 */
class GetEmailForwarding extends Call
{
    public $action = "domains/:domain/email";
    
    public $type = parent::TYPE_GET;
}