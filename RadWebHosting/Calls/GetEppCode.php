<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetEppCode
 *
 * @author inbs
 */
class GetEppCode extends Call
{
    public $action = "domains/:domain/eppcode";
    
    public $type = parent::TYPE_GET;
}