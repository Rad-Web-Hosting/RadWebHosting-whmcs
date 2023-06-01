<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetNameServers
 *
 * @author inbs
 */
class TransferSync extends Call
{
    public $action = "domains/:domain/transfersync";
    
    public $type = parent::TYPE_POST;
}