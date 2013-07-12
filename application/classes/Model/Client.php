<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_Client
 */
class Model_Client extends ORM{
    protected $_primary_key = 'client_id';
    protected $_table_name = 'managers_clients';

    protected $_belongs_to = array(
        'user' => array('model' => 'Users', 'foreign_key' => 'client_id')
    );

    protected $_has_one = array(
        'manager' => array('model' => 'Manager', 'foreign_key' => 'manager_id')
    );
}
