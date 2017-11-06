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

class Contacts
{

    public $base_endpoint = '/contacts';

    public $contentType = 'application/json';

    public $method;

    public $request_type;

    public $query = array();

    public $body = '';

    /**
     * Function get()
     * Gets last 25 contacts
     *
     * @param string $list_id            
     * @param string $user_type            
     * @param string $sort            
     */
    public function get($list_id = null, $user_type = null, $sort = null)
    {
        $this->method = '';
        $this->request_type = 'GET';
        $this->body = '';
        $this->query = array();
        
        if (isset($list_id)) {
            $this->query['list_id'] = (int) $list_id;
        }
        if (isset($user_type)) {
            $this->query['user_type'] = $user_type;
        }
        if (isset($sort)) {
            $this->query['sort'] = $sort;
        }
        return $this;
    }

    /**
     * Function post()
     * Creates one or more Contacts
     *
     * @param string|array $email_or_array            
     * @param integer $list_id            
     * @param boolean $overwrite            
     * @param array $fields            
     */
    public function post($email_or_array = null, $list_id = null, $overwrite = false, $fields = null)
    {
        $this->method = '';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        if (is_array($email_or_array)) {
            $parameters = array();
            foreach ($email_or_array as $i => $contact) {
                $contact_parameter['list_id'] = (int) $list_id;
                $contact_parameter['overwrite'] = $overwrite;
                foreach ($contact as $field => $value) {
                    if ($field == 'email') {
                        $contact_parameter['email'] = $value;
                    } else {
                        $contact_parameter['fields'][$field] = $value;
                    }
                }
                $parameters[] = $contact_parameter;
                unset($contact_parameter);
            }
        } else {
            $parameters = array(
                'email' => $email_or_array,
                'overwrite' => $overwrite,
                'list_id' => $list_id,
                'fields' => $fields
            );
        }
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function put()
     * Updates one or more Contacts
     *
     * @param string_or_array $email_or_array            
     * @param integer $list_id            
     * @param boolean $overwrite            
     * @param array $fields            
     */
    public function put($email_or_array = null, $list_id = null, $fields = null)
    {
        $this->method = '';
        $this->request_type = 'PUT';
        $this->body = '';
        $this->query = array();
        if (is_array($email_or_array)) {
            $parameters = array();
            foreach ($email_or_array as $i => $contact) {
                $contact_parameter['list_id'] = (int) $list_id;
                foreach ($contact as $field => $value) {
                    if ($field == 'email') {
                        $contact_parameter['email'] = $value;
                    } else {
                        $contact_parameter['fields'][$field] = $value;
                    }
                }
                $parameters[] = $contact_parameter;
                unset($contact_parameter);
            }
        } else {
            $parameters = array(
                'email' => $email_or_array,
                'overwrite' => $overwrite,
                'list_id' => $list_id,
                'fields' => $fields
            );
        }
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function delete()
     * Deletes contact(s) based on id(s)
     *
     * @param integer|array $contact_ids            
     */
    public function delete($contact_ids)
    {
        $this->method = '/delete';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        if (is_array($contact_ids)) {
            $parameters = array(
                'contact_ids' => $contact_ids
            );
        } else {
            $parameters = array(
                'contact_id' => $contact_ids
            );
        }
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function remove()
     * Change contact status based on email and list
     *
     * @param string $list_id            
     * @param string $change_to
     *            Possible values - 'resubscribe', 'unsubscribe', 'remove', 'bounce', 'complaint', 'soft_bounce'
     * @param string|array $emails            
     * @param string $mailing_id            
     */
    public function remove($list_id = null, $change_to = 'unsubscribe', $emails = array(), $mailing_id = null)
    {
        $this->method = '/remove';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'list_id' => $list_id,
            'change_to' => $change_to,
            'emails' => $emails,
            'mailing_id' => $mailing_id
        );
        $this->body = json_encode($parameters);
        return $this;
    }

    /**
     * Function lookup()
     * Contact search function
     *
     * @param string $user_type
     *            Valid values for $user_type as follows:
     *            'all' - All users
     *            'active' - Active users
     *            'nonactive' - Inactive users
     *            'unsubscribed' - Unsubscribed users
     *            'bounced' - Bounced users
     *            'complaint' - Complained users
     * @param string $offset            
     * @param string $limit            
     * @param string $list_id            
     * @param array $sort            
     * @param array $criteria
     *            Array of arrays containing field criteria and operators.
     *            
     *            Valid "operator" values for the $criteria array are as follows:
     *            '=' - Equal to / on date
     *            '<' - Less than / before date
     *            '>' - More than / after date
     *            '<=' - Less than or equal to / Before or on date
     *            '>=' - More than or equal to / On or after date
     *            '!=' - Not equal to / Not on
     *            '><' - in range
     *            'empty' - is empty
     *            'notempty' - is not empty
     *            'LIKE' - Contains value
     *            'NOT LIKE' - Does not contain value
     *            'LIKE_' - Begins with value
     *            '_LIKE' - Ends with value
     * @link http://apidocs.ongage.net/class-Controller_API_Contacts.html
     */
    public function lookup($user_type = null, $offset = null, $limit = null, $list_id = null, $sort = array(), $criteria = array())
    {
        $this->method = '/lookup';
        $this->request_type = 'POST';
        $this->body = '';
        $this->query = array();
        
        $parameters = array(
            'user_type' => $user_type,
            'offset' => (int) $offset,
            'limit' => (int) $limit,
            'list_id' => (int) $list_id,
            'sort' => $sort,
            'criteria' => $criteria
        );
        
        $this->body = json_encode($parameters);
        return $this;
    }
}
?>