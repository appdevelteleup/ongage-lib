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

class AccountAddresses
{

    public $base_endpoint = '/account_addresses';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets a list of sender details for ESP Connection Accounts
     *
     * @param integer $esp_connection_id
     *            Get a list of available sender details for an ESP connection
     * @param integer $list_id
     *            Get a list of available sender details for a list
     */
    public function get($esp_connection_id = null, $list_id = null)
    {
        $this->method = '';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        if (isset($esp_connection_id)) {
            $this->query['esp_connection_id'] = $esp_connection_id;
        }
        if (isset($list_id)) {
            $this->query['list_id'] = $list_id;
        }
        return $this;
    }

    /**
     * Function getById()
     * Gets a single sender detail
     *
     * @param string $address_id
     *            Sender detail id
     * @param integer $list_id
     *            List Id that the sender detail belongs to (defaults to Default list)
     */
    public function getById($address_id, $list_id = null)
    {
        $this->method = '/' . (int) $address_id;
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        if (isset($list_id)) {
            $this->query['list_id'] = $list_id;
        }
        return $this;
    }

    /**
     * Function post()
     * Creates a new set of sender details
     *
     * @param integer $esp_connection_id
     *            ESP Connection Id
     * @param integer $list_id
     *            Applicable List Id
     * @param string $type
     *            Type of sender detail - "name", "from" or "reply"
     * @param string $value
     *            Value for the sender detail
     * @param boolean $default
     *            Whether the value set will be default for the set type.
     */
    public function post($esp_connection_id, $list_id = null, $type, $value, $default = false)
    {
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array();
        $parameters['esp_connection_id'] = $esp_connection_id;
        
        if (isset($list_id)) {
            $this->parameters['list_id'] = $list_id;
        }
        
        $parameters['type'] = $type;
        $parameters['value'] = $value;
        $parameters['default'] = $default;
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function put()
     * Updates sender details
     *
     * @param integer $list_id
     *            Applicable List Id
     * @param string $type
     *            Type of sender detail - "name", "from" or "reply"
     * @param string $value
     *            Value for the sender detail
     * @param boolean $default
     *            Whether the value set will be default for the set type.
     */
    public function put($address_id, $type, $value, $default = false)
    {
        $this->method = '';
        $this->request_type = 'PUT';
        $this->body = '';
        $this->query = array();
        
        $parameters = array();
        if (isset($type)) {
            $parameters['type'] = $type;
        }
        if (isset($value)) {
            $parameters['value'] = $value;
        }
        if (isset($default)) {
            $parameters['default'] = $default;
        }
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function delete()
     * Deletes Sender details for supplied id
     *
     * @param array $address_ids
     *            Array of sender details to delete
     */
    public function delete($address_ids)
    {
        $this->method = '/delete';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        if (isset($address_ids)) {
            $parameters['address_ids'] = $address_ids;
        }
        return $this;
    }
}
?>