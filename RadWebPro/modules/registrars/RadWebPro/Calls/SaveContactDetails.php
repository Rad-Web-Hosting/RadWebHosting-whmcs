<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

/**
 * Description of TransferDomain
 *
 * @author inbs
 */
class SaveContactDetails extends Call
{
    public $action = "domains/:domain/contact";
    
    public $type = parent::TYPE_POST;
}
