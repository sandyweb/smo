<?php
/**
 * Class CommentsRange
 *
 * @property int $id
 * @property string $name
 * @property int $account_type_id
 * @property int $price
 * @property int $custom
 */
class Model_CommentsRange extends ORM{
    const FB_DEFAULT_RANGE = 1;
    const GOOGLE_DEFAULT_RANGE = 4;

    protected $_table_name = 'comments_range';

    protected $_belongs_to = array(
        'account_type' => array('model' => 'AccountsTypes', 'foreign_key' => 'account_type_id')
    );

    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'comments_range_id')
    );

    public function get_fb_default_range()
    {
        return self::FB_DEFAULT_RANGE;
    }

    public function get_google_default_range()
    {
        return self::GOOGLE_DEFAULT_RANGE;
    }

    /**
     * Method get comments range
     *
     * @access public
     * @param $account_type_id
     * @return Database_Result
     */
    public function get_range($account_type_id)
    {
        return $this->where('account_type_id', '=', $account_type_id)->find_all();
    }
}
