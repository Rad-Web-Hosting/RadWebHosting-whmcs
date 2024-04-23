<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

/**
 * Description of GetNameServers
 *
 * @author inbs
 */
class ToggleIdProtect extends Call
{
    public $action = "domains/:domain/protectid";
    
    public $type = parent::TYPE_POST;
}