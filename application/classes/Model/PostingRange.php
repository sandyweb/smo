<?php
/**
 * Class Model_PostingRange
 *
 * @property int $id
 * @property string $name
 * @property int $account_type_id
 * @property int $price
 * @property int $custom
 */
class Model_PostingRange extends ORM{
    const FB_DEFAULT_RANGE = 2;
    const TWITTER_DEFAULT_RANGE = 4;
    const GOOGLE_DEFAULT_RANGE = 8;
    const LINKEDIN_DEFAULT_RANGE = 10;
    const BLOG_DEFAULT_RANGE = 12;

    protected $_table_name = 'posting_range';

    protected $_belongs_to = array(
        'account_type' => array('model' => 'AccountsTypes', 'foreign_key' => 'account_type_id')
    );

    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'posting_range_id')
    );

    /**
     * Method get account type post range
     *
     * @access public
     * @param $account_type_id
     * @return Database_Result
     */
    public function get_range($account_type_id)
    {
        $range = $this->where('account_type_id', '=', $account_type_id)->find_all();
        return $range;
    }

    public function get_fb_default_range()
    {
        return self::FB_DEFAULT_RANGE;
    }

    public function get_twitter_default_range()
    {
        return self::TWITTER_DEFAULT_RANGE;
    }

    public function get_google_default_range()
    {
        return self::GOOGLE_DEFAULT_RANGE;
    }

    public function get_linkedin_default_range()
    {
        return self::LINKEDIN_DEFAULT_RANGE;
    }

    public function get_blog_default_range()
    {
        return self::BLOG_DEFAULT_RANGE;
    }
}
