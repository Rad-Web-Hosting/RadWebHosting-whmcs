<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

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