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

class Lists
{

    public $base_endpoint = '/lists';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets available Lists
     *
     * @param string $name
     *            List Name
     * @param string $type
     *            List Type - 'sending' or 'suppression'
     * @param string $sort
     *            List column name
     * @param string $order
     *            Order of results - 'ASC' or 'DESC'
     * @param integer $offset
     *            Pagination offset
     * @param integer $limit
     *            Pagination limit
     */
    public function get($name = null, $type = null, $sort = null, $order = null, $offset = null, $limit = null)
    {
        $this->method = '';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
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
     * Gets a single list
     *
     * @param string $list_id
     *            Id for list
     */
    public function getById($list_id)
    {
        $this->method = '/' . (int) $list_id;
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        return $this;
    }

    /**
     * Function post()
     * Creates a list
     *
     * @param string $name
     *            List name (Required)
     * @param string $type
     *            List Type ( "supression", "sending" )
     * @param string $description
     *            List description
     * @param boolean $create_segment
     *            Create a "All List Members" segment
     * @param array $fields
     *            array of arrays containing field criteria and operators
     * @param string $expiration_date
     *            Expiration date (supression lists only)
     * @param string $scope
     *            Scope for suppression list - "global" or "campaign"
     */
    public function post($name, $type = 'sending', $description = '', $create_segment = true, $fields = array(), $expiration_date = null, $scope = null)
    {
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'name' => $name,
            'type' => $type,
            'description' => $description,
            'create_segment' => $create_segment,
            'fields' => $fields,
            'expiration_date' => $expiration_date,
            'scope' => $scope
        );
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function put()
     * Updates a list
     *
     * @param string $list_id
     *            List Id to update
     * @param string $description
     *            Edit list description
     * @param string $expiration_date
     *            Expiration date
     * @param string $scope
     *            update scope for suppression lists ("global", "campaign")
     * @param integer $welcome_email_id
     *            Email ID
     * @param boolean $welcome_email_active
     *            Send welcome email to new contacts on list
     */
    public function put($list_id = null, $description = '', $expiration_date = null, $scope = null, $welcome_email_id, $welcome_email_active = true)
    {
        $this->method = '/' . (int) $list_id;
        $this->request_type = 'PUT';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'name' => $name,
            'description' => $description,
            'expiration_date' => $expiration_date,
            'scope' => $scope,
            'welcome_email_id' => $welcome_email_id,
            'welcome_email_active' => $welcome_email_active
        );
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function delete()
     * Deletes list for supplied id
     *
     * @param integer $list_id
     *            List ID to delete
     */
    public function delete($list_id)
    {
        $this->method = '/' . $list_id;
        $this->request_type = 'DELETE';
        $this->body = '';
        $this->query = array();
        return $this;
    }

    /**
     * Function delete_implications()
     * Fetches a list delete implications
     *
     * @param integer $list_id
     *            List ID to look up
     */
    public function delete_implications($list_id)
    {
        $this->method = '/' . $list_id . '/delete_implications';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        return $this;
    }
}
?>