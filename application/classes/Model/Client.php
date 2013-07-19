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

    /**
     * Method get clients accounts list
     *
     * @access public
     * @return array
     * @throws Exception
     */
    public function get_account_list()
    {
        if(!$this->loaded())
        {
            throw new Exception('Client is not loaded');
        }
        $list = array();
        $accounts = $this->user->accounts->find_all();
        foreach($accounts as $account)
        {
            $list[$account->id] = $account->title;
        }
        return $list;
    }
}
