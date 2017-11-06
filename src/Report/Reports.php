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
namespace RfgOngage\Report;

/**
 * Reports class
 * Implementation of the Ongage /reports endpoint
 *
 * @link http://apidocs.ongage.net/class-Controller_API_Reports.html
 */
class Reports
{

    /**
     *
     * @var string $base_endpoint Variable corresponding to the /emails Ongage Endpoint
     */
    public $base_endpoint = '/reports';

    /**
     *
     * @var string $contentType Content-Type for the API requests
     */
    public $contentType = 'application/json';

    /**
     *
     * @var string $method Corresponding method in the Ongage API
     */
    public $method;

    /**
     *
     * @var string $request_type HTTP Request Type for the API call (e.g. GET/POST/PUT/DELETE/PATCH etc).
     */
    public $request_type;

    /**
     *
     * @var array $query Array of HTTP Query variables for the API call
     */
    public $query = array();

    /**
     *
     * @var array $body The body of the HTTP request
     */
    public $body = '';

    /**
     * Function query()
     * Queries for reports for a campaign
     *
     * @param mixed[] $select
     *            Array of select fields to display. Can contain a 2 argument array for aliased fields.
     *            e.g.
     *            [ "segment_id", "segment_name", [ "COUNT(clicks)", "total_clicks" ] ]
     * @param string $from
     *            Source of report results - "mailing" or "list"
     * @param mixed[] $group
     *            Array of field names to group results by
     *            e.g.
     *            [ "email_message_id", "segment_id" ]
     *            
     *            For grouping by dates, there are some predefined group aliases we have in the system: day, week, month, year.
     *            e.g.
     *            [ "delivery_timestamp", "day" ]
     *            
     * @param mixed[] $order
     *            array of field names to order by, or a 2 arguments array [field name, order direction] (order direction = ASC/DESC)
     *            e.g.
     *            [ "email_message_id", [ "segment_name", "DESC" ] ]
     * @param mixed[] $filter
     *            Array of arguments to filter results with.
     *            Each filter is a 3 arguments array [field_name, operator, value]
     *            e.g.
     *            [
     *            [ "email_message_id", "=", 3001 ],
     *            [ "delivery_date", ">=", "2013-01-01" ]
     *            ]
     * @param string $value
     *            The field that will be used for payload values
     *            e.g.
     *            when sending:
     *            "value": "mailing_id"
     *            
     *            The response will be serialized array of mailing IDs
     *            [ 811111, 822222, 833333 ]
     *            
     * @param integer $offset
     *            Query pagination offset
     * @param integer $limit
     *            Query pagination limit
     * @param string $format
     *            Values "null" - for JSON results, or "csv" for comma delimited results
     */
    public function query($list_id, $select, $from = null, $group = null, $order = null, $filter = null, $value = null, $offset = null, $limit = null, $format = null)
    {
        $this->method = '/query';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        $parameters = array();
        
        if (isset($list_id)) {
            $parameters['list_id'] = $list_id;
        }
        if (isset($select)) {
            $parameters['select'] = $select;
        }
        if (isset($from)) {
            $parameters['from'] = $from;
        }
        if (isset($group)) {
            $parameters['group'] = $group;
        }
        if (isset($order)) {
            $parameters['order'] = $order;
        }
        if (isset($filter)) {
            $parameters['filter'] = $filter;
        }
        if (isset($value)) {
            $parameters['value'] = $value;
        }
        if (isset($offset)) {
            $parameters['offset'] = $offset;
        }
        if (isset($limit)) {
            $parameters['limit'] = $limit;
        }
        if (isset($format)) {
            $parameters['format'] = $format;
        }
        $this->body = json_encode($parameters);
        return $this;
    }
}