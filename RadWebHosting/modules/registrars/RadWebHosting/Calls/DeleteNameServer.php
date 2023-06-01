<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of DeleteNameServer
 *
 * @author inbs
 */
class DeleteNameServer extends Call
{
    public $action = "domains/:domain/nameservers/delete";
    
    public $type = parent::TYPE_POST;
}