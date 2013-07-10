<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_Manager
 */
class Model_Manager extends ORM{
    protected $_table_name = 'managers_clients';

    protected $_belongs_to = array(
        'user' => array('model' => 'Users', 'foreign_key' => 'manager_id')
    );

    protected $_has_many = array(
        'clients' => array('model' => 'Users', 'foreign_key' => 'client_id')
    );
}
