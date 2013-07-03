<?php defined('SYSPATH') or die('No direct script access.');

class Model_Accounts extends ORM {
    protected $_table_name = 'accounts';
    
    protected $_belongs_to = array(
        'users' => array('model' => 'Users', 'foreign_key' => 'users_id'),
        'accountsTypes' => array('model' => 'AccountsTypes', 'foreign_key' => 'accounts_types_id')
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

    /**
     * Method send registration message
     *
     * @access public
     * @static
     * @param $email
     * @param $data
     * @return int
     */
    public static function send_register_message($email, $data)
    {
        $config = Kohana::$config->load('config');
        $to = $config->get('admin_email');
        $template = View::factory('mails/frontend/register', $data);
        $email_config = Kohana::$config->load('email');
        Email::connect($email_config);
        return Email::send($email, $to, 'Registration', $template, TRUE);
    }
}