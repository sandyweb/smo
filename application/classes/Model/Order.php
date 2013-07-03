<?php defined('SYSPATH') or die('No direct script access.');
class Model_Order extends ORM{
    protected $_table_name = 'orders';

    protected $_belongs_to = array(
        'user' => array('model' => 'Users', 'foreign_key' => 'user_id'),
        'account' => array('model' => 'Accounts', 'foreign_key' => 'account_id')
    );
}
