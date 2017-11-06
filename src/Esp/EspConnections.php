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
namespace RfgOngage\Esp;

class EspConnections
{

    public $base_endpoint = '/esp_connections';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets a list of setup Email Service Providers
     *
     * @param boolean $deleted
     *            Show deleted ESP Connections
     */
    public function get($deleted = false)
    {
        $this->base_endpoint = '/accounts/0/esps';
        $this->method = '';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        $this->query['deleted'] = $deleted;
        return $this;
    }

    /**
     * Function getById()
     * Gets a single ESP Connection
     *
     * @param string $esp_connection_id
     *            Id for list
     */
    public function getById($esp_connection_id)
    {
        $this->base_endpoint = '/esp_connections';
        $this->method = '/' . (int) $esp_connection_id;
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        return $this;
    }

    /**
     * Function post()
     * Creates an ESP Connection
     *
     * @todo This needs to be done at some point
     */
    public function post()
    {
        $this->base_endpoint = '/esp_connections';
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        return false;
    }

    /**
     * Function put()
     * Updates an ESP Connection
     *
     * @todo This needs to be done at some point
     */
    public function put()
    {
        $this->base_endpoint = '/esp_connections';
        $this->method = '';
        $this->request_type = 'PUT';
        $this->body = '';
        $this->query = array();
        return false;
    }

    /**
     * Function delete()
     * Deletes ESP Connection for supplied id
     *
     * @param integer $esp_connection_id
     *            ESP Connection ID to delete
     */
    public function delete($esp_connection_id)
    {
        $this->base_endpoint = '/esp_connections';
        $this->method = '/' . $esp_connection_id;
        $this->request_type = 'DELETE';
        $this->body = '';
        $this->query = array();
        return $this;
    }
}
?>