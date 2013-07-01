<?php defined('SYSPATH') or die('No direct script access.');

class Model_AccountsTypes extends ORM {
    protected $_table_name = 'accounts_types';
    
    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'accounts_types_id')
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