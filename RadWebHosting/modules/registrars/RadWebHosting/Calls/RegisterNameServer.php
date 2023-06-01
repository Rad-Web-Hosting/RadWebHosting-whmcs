<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of RegisterNameServer
 *
 * @author inbs
 */
class RegisterNameServer extends Call
{
    public $action = "domains/:domain/nameservers/register";
    
    public $type = parent::TYPE_POST;
}