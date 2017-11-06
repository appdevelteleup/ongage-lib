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
namespace RfgOngage\Lists;

class ListFields
{

    public $base_endpoint = '/list_fields';

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

    /**
     * Function post()
     * Creates a list field
     *
     * @param integer $list_id
     *            List ID to add field to
     * @param string $name
     *            Field name (Required)
     * @param string $title
     *            Field title (Required)
     * @param string $type
     *            List Type ( "email", "string", "date", "numeric" )
     * @param string $format
     *            Date format for the date field.
     *            Possible Values:
     *            - mm/dd/yyyy
     *            - dd/mm/yyyy
     *            - yyyy/mm/dd
     *            - dd-mm-yyyy
     *            - mm-dd-yyyy
     *            - yyyy-mm-dd
     *            - dd/mm/yyyy hh24:mi
     *            - mm/dd/yyyy hh24:mi
     *            - yyyy/mm/dd hh24:mi
     *            - dd-mm-yyyy hh24:mi
     *            - mm-dd-yyyy hh24:mi
     *            - yyyy-mm-dd hh24:mi
     *            - dd/mm/yyyy hh24:mi:ss
     *            - mm/dd/yyyy hh24:mi:ss
     *            - yyyy/mm/dd hh24:mi:ss
     *            - dd-mm-yyyy hh24:mi:ss
     *            - mm-dd-yyyy hh24:mi:ss
     *            - yyyy-mm-dd hh24:mi:ss
     * @param string $default
     *            Default value for field
     * @param integer $position
     *            Position in field list
     * @param boolean $mandatory
     *            Whether field is mandatory or not
     */
    public function post($list_id = null, $name, $title, $type = 'string', $format = '', $default = '', $position, $mandatory = false)
    {
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'list_id' => $list_id,
            'name' => $name,
            'title' => $title,
            'type' => $type,
            'format' => $format,
            'default' => $default,
            'position' => $position,
            'mandatory' => $mandatory
        );
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function put()
     * Updates a list field
     *
     * @param integer $list_id
     *            List ID to add field to
     * @param string $name
     *            Field name (Required)
     * @param string $title
     *            Field title (Required)
     * @param string $type
     *            List Type ( "email", "string", "date", "numeric" )
     * @param string $format
     *            Date format for the date field.
     *            Possible Values:
     *            - mm/dd/yyyy
     *            - dd/mm/yyyy
     *            - yyyy/mm/dd
     *            - dd-mm-yyyy
     *            - mm-dd-yyyy
     *            - yyyy-mm-dd
     *            - dd/mm/yyyy hh24:mi
     *            - mm/dd/yyyy hh24:mi
     *            - yyyy/mm/dd hh24:mi
     *            - dd-mm-yyyy hh24:mi
     *            - mm-dd-yyyy hh24:mi
     *            - yyyy-mm-dd hh24:mi
     *            - dd/mm/yyyy hh24:mi:ss
     *            - mm/dd/yyyy hh24:mi:ss
     *            - yyyy/mm/dd hh24:mi:ss
     *            - dd-mm-yyyy hh24:mi:ss
     *            - mm-dd-yyyy hh24:mi:ss
     *            - yyyy-mm-dd hh24:mi:ss
     * @param string $default
     *            Default value for field
     * @param integer $position
     *            Position in field list
     * @param boolean $mandatory
     *            Whether field is mandatory or not
     */
    public function put($list_id = null, $name, $title, $type = 'string', $format = '', $default = '', $position, $mandatory = null)
    {
        $this->method = '/' . (int) $list_id;
        $this->request_type = 'PUT';
        $this->body = '';
        $this->query = array();
        
        $parameters = array();
        
        if (isset($name)) {
            $parameters['name'] = $name;
        }
        if (isset($title)) {
            $parameters['title'] = $title;
        }
        if (isset($format)) {
            $parameters['format'] = $format;
        }
        if (isset($default)) {
            $parameters['default'] = $default;
        }
        if (isset($position)) {
            $parameters['position'] = $position;
        }
        if (isset($mandatory)) {
            $parameters['mandatory'] = $mandatory;
        }
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function delete()
     * Deletes field for supplied id
     *
     * @param integer $field_id
     *            field ID to delete
     */
    public function delete($field_id)
    {
        $this->method = '/' . $field_id;
        $this->request_type = 'DELETE';
        $this->body = '';
        $this->query = array();
        return $this;
    }
}
?>