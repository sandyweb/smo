<?php defined('SYSPATH') or die('No direct script access.');

class Model_AccountsTypes extends ORM {
    protected $_table_name = 'accounts_types';

    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'accounts_types_id'),
        'posting_range' => array('model' => 'PostingRange', 'foreign_key' => 'account_type_id'),
        'comments_range' => array('model' => 'CommentsRange', 'foreign_key' => 'account_type_id'),
        'like_range' => array('model' => 'LikeRange', 'foreign_key' => 'account_type_id'),
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