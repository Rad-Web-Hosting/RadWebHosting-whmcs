<?php

namespace ModulesGarden\DomainsReseller\Registrar\RadWebPro\Core;

use GuzzleHttp\Client;

/**
 * Description of Call
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
abstract class Call
{
    const TYPE_GET      = "GET";

    const TYPE_POST     = "POST";

    const TYPE_PUT      = "PUT";

    const TYPE_DELETE   = "DELETE";

    /**
     * Action path
     *
     * @var string
     */
    public $action;

    /**
     * Request type
     *
     * @var string
     */
    public $type;

    /**
     * Configuration
     *
     * @var Configuration
     */
    public $config;

    /**
     * params to send trough API
     *
     * @var mixed
     */
    public $params;

    /**
     * AbstractCall constructor
     *
     * @param Configuration $config
     * @param $params
     */
    public function __construct(Configuration $config, $params = [])
    {
        $this->config = $config;
        $this->params = $params;
    }

    /**
     * Make request to API
     *
     * @return array|bool|mixed|\stdClass|string
     */
    public function process()
    {
        try
        {
            $this->setVariablesInActionString();
            $url = "{$this->config->ApiEndpoint}/{$this->action}";

            $client = new Client();
            if($this->isWhmcsVersionHigherOrEqual('8.0.0'))
            {
                $params = $this->type === self::TYPE_POST ? $this->params : [];
                $request = $client->request($this->type, $url, ["headers" => $this->config->getAuthHeaders(), "form_params" => $params]);
                $output = $request->getBody()->getContents();
            } else
            {
                $request = $client->createRequest($this->type, $url, ["headers" => $this->config->getAuthHeaders(), $this->getParamKeyName() => $this->params]);
                $output = $client->send($request)->getBody()->getContents();
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            $response = $ex->getResponse();
            $output = $response->getBody()->getContents();
        }
        catch (\GuzzleHttp\Exception\ServerException $ex)
        {
            $response = $ex->getResponse();
            $output = $response->getBody()->getContents();
        }
        catch (\Exception $ex)
        {
            $output = $ex->getMessage();
        }

        $result = json_decode($output, true);
        if($result === null && is_string($output))
        {
            $result = ["error" => $output];
        }

        return $result;
    }

    /**
     * Put variables from params to action string if possible
     */
    protected function setVariablesInActionString()
    {
        //Check if params needs to be filled
        if(strpos($this->action, ":") !== false)
        {
            //Get params names
            $pos = 0;
            $names = [];
            while(($pos = strpos($this->action, ":", $pos)) !== false)
            {
                $pos++;

                $slash = strpos($this->action, "/", $pos);
                $names[] = substr($this->action, $pos, $slash - $pos);
            }

            foreach($names as $name)
            {
                $this->action = str_replace(":{$name}", $this->params[$name], $this->action);
            }
        }
    }

    /**
     * Get correct param name depending on the request type
     *
     * @return string
     */
    protected function getParamKeyName()
    {
        $result = "query";
        if($this->type == self::TYPE_POST)
        {
            $result = "body";
        }

        return $result;
    }

    private function isWhmcsVersionHigherOrEqual($toCompare)
    {
        if (isset($GLOBALS['CONFIG']['Version']))
        {
            $version = explode('-', $GLOBALS['CONFIG']['Version']);
            return (version_compare($version[0], $toCompare, '>='));
        }

        global $whmcs;

        return (version_compare($whmcs->getVersion()->getRelease(), $toCompare, '>='));
    }
}