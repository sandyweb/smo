<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends Model_User {
    
    protected $_table_name = 'users';
    
    public function labels()
    {
        return array(
            'username' => 'Username',
            'email'    => 'Email address',
            'password' => 'Password',
            'lastname' => 'Lastname'
        );
    }
        
    protected $_has_many = array(
            'user_tokens' => array('model' => 'User_Token'),
            'roles'       => array('model' => 'Role', 'through' => 'roles_users', 'foreign_key' => 'user_id'),
            'accounts'    => array('model' => 'Accounts', 'foreign_key' => 'users_id')
    );
    
    public function rules() {
        return array(
            'username' => array(array('not_empty'), array('max_length', array(':value', 32))),
            'lastname' => array(array('not_empty'), array('max_length', array(':value', 32))),
            'password' => array(array('not_empty')),
            'email' => array(array('not_empty'), array('email'), array(array($this, 'unique'), array('email', ':value'))),
        );
    }
    
    public function filters() {
        parent::filters();
        
        return array(
            'username' => array(array('trim'), array('strip_tags')),
            'lastname' => array(array('trim'), array('strip_tags')),
            'email' => array(array('trim'), array('strip_tags'))
        );
    }
    
    public static function get_password_validation($values) {
        return Validation::factory($values)
            ->rule('password', 'not_empty')
            ->rule('password', 'min_length', array(':value', 4))
            ->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));
    }
}