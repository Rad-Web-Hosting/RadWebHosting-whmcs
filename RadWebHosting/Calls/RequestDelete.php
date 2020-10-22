<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

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