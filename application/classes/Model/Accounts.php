<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Accounts
 * @property int $id
 * @property int $accounts_types_id
 * @property int $users_id
 * @property string $title
 * @property string $description
 */
class Model_Accounts extends ORM {
    protected $_table_name = 'accounts';
    
    protected $_belongs_to = array(
        'users' => array('model' => 'Users', 'foreign_key' => 'users_id'),
        'accountsTypes' => array('model' => 'AccountsTypes', 'foreign_key' => 'accounts_types_id')
    );

    protected $_has_many = array(
        'orders' => array('model' => 'Orders', 'foreign_key' => 'account_id')
    );

    public function rules() {
        return array(
            'title' => array(array('not_empty'), array('max_length', array(':value', 250))),
        );
    }
    
    public function filters() {
        parent::filters();
        
        return array(
            'title' => array(array('trim'), array('strip_tags')),
        );
    }
}