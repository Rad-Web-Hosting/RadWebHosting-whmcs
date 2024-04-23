<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

/**
 * Description of RequestDelete
 *
 * @author inbs
 */
class RequestDelete extends Call
{
    public $action = "domains/:domain/delete";
    
    public $type = parent::TYPE_POST;
}