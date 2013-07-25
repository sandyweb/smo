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
        'accountsTypes' => array('model' => 'AccountsTypes', 'foreign_key' => 'accounts_types_id'),
        'information_source' => array('model' => 'InformationSource', 'foreign_key' => 'information_source_id'),
        'posting_range' => array('model' => 'PostingRange', 'foreign_key' => 'posting_range_id'),
        'comments_range' => array('model' => 'CommentsRange', 'foreign_key' => 'comments_range_id'),
        'like_range' => array('model' => 'LikeRange', 'foreign_key' => 'like_range_id')
    );

    protected $_has_many = array(
        'orders' => array('model' => 'Orders', 'foreign_key' => 'account_id'),
        'messages' => array('model' => 'Message', 'foreign_key' => 'account_id')
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
     * Get expired user accounts
     *
     * @access public
     * @param $user_id
     * @return Database_Result
     */
    public function get_expired_accounts($user_id)
    {
        return self::factory('Accounts')->where('users_id', '=', $user_id)->and_where('expiration', '<=', time())->find_all();
    }
}