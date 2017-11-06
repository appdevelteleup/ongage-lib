Ongage PHP Library
======================

### About ###
This Library is a PHP implementation of the [Ongage](http://www.ongage.com) Email Platform API.

###Features###
This library features an implementation of most of the Ongage Documented Endpoints and Methods, as well as un-documented, potentially unsupported, but also very helpful methods.

Currently implemented endpoints:

**"Campaign"** Package
* /api/mailings
* /api/emails

**"Esp"** Package (Unsupported, Undocumented by Ongage)
* /api/account_addresses
* /api/esp_connections
* /api/esps

**"Lists"** Package
* /api/contacts
* /api/lists/
* /api/segments
* /api/list_fields *(Unsupported, Undocumented by Ongage)*

**"Reports"** Package
* /api/reports

### Installation ###

#### Via Composer ####
Install composer in your project:

```bash
    curl -s https://getcomposer.org/installer | php
```

Create a composer.json file in your project root:

```javascript
    {
        "require": {
            "appdevelteleup/ongage-lib": "0.1*"
        }
    }
```

Install via composer:

```bash
    php composer.phar install
```

Add this line to your application’s code:

```php
    <?php
        require 'vendor/autoload.php';
    ?>
```

### Usage ###

```php
    <?php
        $list_id = ''; // Set your List ID here
        // Instantiate Ongage Object
        $ongage = new RfgOngage\Ongage('username', 'password', 'account_code');

        // Instantiate Contacts Object
        $contacts = new RfgOngage\Lists\Contacts();

        // Get Contacts for a list
        $contacts->get($list_id);

        // Send Request
        $results = $ongage->send($contacts);

        // Echo raw results
        print_r($results);
    ?>
```