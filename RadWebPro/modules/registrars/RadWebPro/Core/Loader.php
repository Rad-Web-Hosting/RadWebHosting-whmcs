<?php

namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core;

/**
 * Description of Loader
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class Loader
{
    private $rootdir;
    
    public function __construct($dir)
    {
        $this->rootdir = $dir;
        $this->register();
    }

    protected function register()
    {
        spl_autoload_register(function($className)
        {
            $namespace = str_replace("\\Core","", __NAMESPACE__);
            if (strpos($className, $namespace) === 0)
            {
                $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
                $file      = str_replace("ModulesGarden".DIRECTORY_SEPARATOR."DomainsReseller".DIRECTORY_SEPARATOR."Registrar".DIRECTORY_SEPARATOR."RadWebPro", $this->rootdir, $className) . '.php';
                
                if (file_exists($file))
                {
                    require_once $file;
                }
            }
        });
    }
}
