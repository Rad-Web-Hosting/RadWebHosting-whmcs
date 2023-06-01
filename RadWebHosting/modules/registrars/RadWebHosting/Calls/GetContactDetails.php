<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebHosting\Core\Call;

/**
 * Description of GetContactDetails
 *
 * @author inbs
 */
class GetContactDetails extends Call
{
    public $action = "domains/:domain/contact";
    
    public $type = parent::TYPE_GET;
}