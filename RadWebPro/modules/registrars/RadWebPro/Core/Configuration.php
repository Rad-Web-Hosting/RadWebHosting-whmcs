<?php
namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core;

/**
 * Description of Configuration
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class Configuration
{
    const FIELD_USERNAME     = "Username";
    const FIELD_API_KEY      = "ApiKey";
    const FIELD_API_ENDPOINT = "ApiEndpoint";

    /**
     * @var mixed
     */
    protected $configuration;

    /**
     * Get configuration values and create params
     *
     * @param $params
     */
    public static function create($params)
    {
        //Get configuration fields from params
        $config = [self::FIELD_USERNAME, self::FIELD_API_KEY, self::FIELD_API_ENDPOINT];
        foreach($config as  $name)
        {
            $result[$name] = $params[$name];
        }

        return new Configuration($result);
    }

    /**
     * Create Configuration
     *
     * @param $params
     * @throws \Exception
     */
    public function __construct($params)
    {
        //Check if registrar is enabled in WHMCS configuration
        if($params[self::FIELD_API_ENDPOINT] === null)
        {
            throw new \Exception("Domain registrar is deactivated in WHMCS configuration");
        }

        $this->configuration = $params;
    }

    /**
     * Get values from configuration array
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->configuration[$name];
    }

    /**
     * Create authorization headers
     *
     * @return array
     */
    public function getAuthHeaders()
    {
        $timestamp = time();
        $time = gmdate("y-m-d H", $timestamp);
        $token = base64_encode(hash_hmac("sha256", $this->ApiKey, "{$this->Username}:$time"));

        return
        [
            "username"  => $this->Username,
            "token"     => $token,
            "timestamp" => $timestamp,
        ];
    }
}