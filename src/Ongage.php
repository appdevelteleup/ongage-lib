<?php
/**
 * RfgOngage Library
 * 
 * An Ongage API library for PHP.
 * 
 * @copyright 2014 Retail Food Group Ltd (http://www.rfg.com.au/)
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @author Abilio Henrique <abilio.henrique@rfg.com.au>
 * @link http://www.rfg.com.au/
 * @see LICENSE.TXT
 */
namespace RfgOngage;

use GuzzleHttp;

/**
 * Main class for making calls to the Ongage API
 */
class Ongage
{

    /**
     *
     * @var username Ongage Username
     */
    protected static $username;

    /**
     *
     * @var password Ongage Password
     */
    protected static $password;

    /**
     *
     * @var account_code Ongage Account Code
     */
    protected static $account_code;

    /**
     *
     * @var \GuzzleHttp\Client The Guzzle HTTP client
     */
    protected static $httpClient;

    /**
     * @const string Ongage API URL
     */
    const BASE_ONGAGE_URL = 'https://api.ongage.net/api';

    /**
     * Function __construct
     *
     * @param string $username            
     * @param string $password            
     * @param string $account_code            
     */
    public function __construct($username = null, $password = null, $account_code = null)
    {
        // Instatiate GuzzleHttp Client
        self::$httpClient = new GuzzleHttp\Client([
            'base_uri' => self::BASE_ONGAGE_URL
        ]);

        // Set Authentication Variables
        self::$username = $username;
        self::$password = $password;
        self::$account_code = $account_code;
    }

    /**
     * Function send()
     * Sends the request to the Ongage API Server
     *
     * @param object $OngageObject
     *            A valid Ongage object
     * @return mixed A JSON decoded object/array
     */
    public function send($OngageObject)
    {
        $headers = [
            'X_USERNAME' => self::$username,
            'X_PASSWORD' => self::$password,
            'X_ACCOUNT_CODE' => self::$account_code
        ];
        $request = new GuzzleHttp\Psr7\Request($OngageObject->request_type, self::BASE_ONGAGE_URL . $OngageObject->base_endpoint . $OngageObject->method, $headers, $OngageObject->body);
        try {
            $response = self::$httpClient->send($request, [
                'query' => $OngageObject->query
            ]);
            return json_decode($response->getBody());
        } catch (GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody());
            } else {
                return $e->getMessage();
            }
        }
    }
}
