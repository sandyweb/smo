<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Order
 * @property int $id
 * @property int $user_id
 * @property int $account_id
 * @property int $created
 * @property int $paid
 * @property int $status
 * @property string $description
 */
class Model_Order extends ORM{
    const STATUS_PAID = 1;
    const STATUS_UNPAID = 2;

    protected $_table_name = 'orders';

    protected $_belongs_to = array(
        'user' => array('model' => 'Users', 'foreign_key' => 'user_id'),
        'account' => array('model' => 'Accounts', 'foreign_key' => 'account_id')
    );

    /**
     * Method get paid user orders
     *
     * @access public
     * @param $user_id
     * @return Database_Result
     */
    public function get_paid_orders($user_id)
    {
        return $this->where('user_id', '=', $user_id)
        ->and_where('status', '=', self::STATUS_PAID)
        ->find_all();
    }

    /**
     * Method get unpaid user orders
     *
     * @access public
     * @param $user_id
     * @return Database_Result
     */
    public function get_unpaid_orders($user_id)
    {
        return $this->where('user_id', '=', $user_id)
            ->and_where('status', '=', self::STATUS_UNPAID)
            ->find_all();
    }

    /**
     * Method get order statuses
     *
     * @access public
     * @static
     * @return array
     */
    public static function get_statuses()
    {
        return array(self::STATUS_PAID => 'Paid', self::STATUS_UNPAID => 'Unpaid');
    }
}
