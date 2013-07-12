<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_Manager
 *
 * @property int $manager_id
 * @property int $client_id
 */
class Model_Manager extends ORM{
    /**
     * @TODO need primary key and table refactoring
     */
    protected $_primary_key = 'manager_id';
    protected $_table_name = 'managers_clients';

    protected $_belongs_to = array(
        'user' => array('model' => 'Users', 'foreign_key' => 'manager_id')
    );

    protected $_has_many = array(
        'clients' => array('model' => 'Client', 'foreign_key' => 'manager_id')
    );
}
