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

class Esps
{

    public $base_endpoint = '/esps';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets list fields
     *
     * @param string $list_id
     *            List to look up fields in, defaults to default list
     * @param string $name
     *            Field Name
     * @param string $type
     *            Field Type - 'sending' or 'suppression'
     * @param string $sort
     *            Field column name
     * @param string $order
     *            Order of results - 'ASC' or 'DESC'
     * @param integer $offset
     *            Pagination offset
     * @param integer $limit
     *            Pagination limit
     */
    public function get($list_id = null, $name = null, $type = null, $sort = null, $order = null, $offset = null, $limit = null)
    {
        $this->method = '';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        if (isset($list_id)) {
            $this->query['list_id'] = $list_id;
        }
        if (isset($name)) {
            $this->query['name'] = $name;
        }
        if (isset($type)) {
            $this->query['type'] = $type;
        }
        if (isset($sort)) {
            $this->query['sort'] = $sort;
        }
        if (isset($order)) {
            $this->query['order'] = $order;
        }
        if (isset($offset)) {
            $this->query['offset'] = (int) $offset;
        }
        if (isset($limit)) {
            $this->query['limit'] = (int) $limit;
        }
        return $this;
    }

    /**
     * Function getById()
     * Gets a single field
     *
     * @param string $field_id
     *            Id for list
     */
    public function getById($field_id)
    {
        $this->method = '/' . (int) $field_id;
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        return $this;
    }
}
?>