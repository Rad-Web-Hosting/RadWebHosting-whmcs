<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Calls;
use ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core\Call;

/**
 * Description of RegisterDomain
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class RegisterDomain extends Call
{
    public $action = "order/domains/register";
    
    public $type = parent::TYPE_POST;
}
