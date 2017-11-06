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

class Segments
{

    public $base_endpoint = '/segments';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets a list of segments
     *
     * @param string $segment_id
     *            Segment Id
     * @param string $list_id
     *            List Id for segments, leave empty for default list
     */
    public function get($segment_id = null, $list_id = null, $limit = null, $offset = null)
    {
        if (isset($segment_id)) {
            $this->method = '/' . (int) $segment_id;
        } else {
            $this->method = '';
        }
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        if (isset($list_id)) {
            $this->query['list_id'] = (int) $list_id;
        }
        if (isset($limit)) {
            $this->query['limit'] = (int) $limit;
        }
        if (isset($offset)) {
            $this->query['offset'] = (int) $offset;
        }
        return $this;
    }

    /**
     * Function post()
     * Creates a segment
     *
     * Valid "operator" values for the $criteria array are as follows:
     *
     * '=' - Equal to / on date
     * '<' - Less than / before date
     * '>' - More than / after date
     * '<=' - Less than or equal to / Before or on date
     * '>=' - More than or equal to / On or after date
     * '!=' - Not equal to / Not on
     * '><' - in range
     * 'empty' - is empty
     * 'notempty' - is not empty
     * 'LIKE' - Contains value
     * 'NOT LIKE' - Does not contain value
     * 'LIKE_' - Begins with value
     * '_LIKE' - Ends with value
     *
     * @param integer $list_id
     *            List id for segment, leave empty for default list
     * @param string $name
     *            Segment name (Required)
     * @param string $type
     *            Segment Type ( "Active", "Test", "Deleted" )
     * @param string $description
     *            Segment description
     * @param boolean $favorite
     *            Mark segment as favourite
     * @param array $criteria
     *            array of arrays containing field criteria and operators
     * @link http://apidocs.ongage.net/class-Controller_API_Contacts.html
     */
    public function post($list_id = null, $name, $type = 'Active', $description = '', $favorite = false, $criteria = array())
    {
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'list_id' => (int) $list_id,
            'name' => $name,
            'type' => $type,
            'description' => $description,
            'favorite' => $favorite,
            'criteria' => $criteria
        );
        
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function export()
     * Creates an export from a segment
     *
     * @param integer $list_id
     *            List Id for segments, leave empty for default list
     * @param string $name
     *            List Id for segments, leave empty for default list
     * @param integer $segment_id
     *            Segment Id
     * @param integer[] $mailing_id
     *            Array of mailing ID's, required if segment_id not supplied.
     * @param string[] $fields_selected
     *            Array of field names to export
     * @param string $date_format
     *            Date fields format, options:
     *            - 'mm/dd/yyyy'
     *            - 'mm/dd/yy'
     *            - 'mm-dd-yyyy'
     *            - 'mm-dd-yy'
     *            - 'dd/mm/yyyy'
     *            - 'dd/mm/yy'
     *            - 'dd-mm-yyyy'
     *            - 'dd-mm-yy'
     * @param string $file_format
     *            File format for export, options: 'csv', 'xls'
     * @param string[] $status
     *            Status for users on the segment, options:
     *            - 'active'
     *            - 'unjoin-member'
     *            - 'clicked'
     *            - 'opened'
     *            - 'inactive'
     *            - 'bounced' - Available on segment export only
     *            - 'complaint' - Available on segment export only
     */
    public function export($list_id = null, $name, $segment_id, $mailing_id = array(), $fields_selected = array(), $date_format = 'dd/mm/yyyy', $file_format = 'csv', $status = array('active'))
    {
        $this->method = '/export';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'list_id' => (int) $list_id,
            'name' => $name,
            'segment_id' => $segment_id,
            'mailing_id' => $mailing_id,
            'fields_selected' => $fields_selected,
            'date_format' => $date_format,
            'file_format' => $file_format,
            'status' => $status
        );
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function export_retrieve()
     * Retrieves a segment export
     *
     * @param integer $export_id
     *            Export Id returned from export() call
     */
    public function export_retrieve($export_id)
    {
        $this->method = '/' . (int) $export_id . '/export_retrieve';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        return $this;
    }

    /**
     * Function delete()
     * Deletes segment for supplied id
     *
     * @param integer $segment_id
     *            Segment ID to delete
     */
    public function delete($segment_id)
    {
        $this->method = '/' . $segment_id;
        $this->request_type = 'DELETE';
        $this->body = '';
        $this->query = array();
        return $this;
    }
}
?>