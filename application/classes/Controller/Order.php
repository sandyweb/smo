<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Controller_Order
 */
class Controller_Order extends Controller{

    public function before()
    {
        parent::before();
        require_once(APPPATH.'vendor/Twocheckout.php');
    }

    public function action_passback()
    {
        $params = array();
        foreach($_REQUEST as $k => $v)
        {
            $params[$k] = $v;
        }
        if($params['demo'] == 'Y')
        {
            $params['order_number'] = 1;
        }
        //Check the MD5 Hash to determine the validity of the sale.
        $config = Kohana::$config->load('config');
        $passback = Twocheckout_Return::check($params, $config['secret_word'], 'array');
        $session = Session::instance();
        if($passback['response_code'] == 'Success')
        {
            $total = Inflector::string2cents($params['total']);
            $order = ORM::factory('Order', $params['merchant_order_id']);
            $data = array(
                'paid' => $total,
                'status' => Model_Order::STATUS_PAID
            );
            $order->values($data)->save();
            $account = ORM::factory('Accounts', $params['li_0_product_id']);
            $data = array(
                'cost' => $total,
                'expiration' => strtotime('30 days')
            );
            $account->values($data)->save();
            $session->set('message', 'Payment was proceed successfully');
        }
        else
        {
            $session->set('message', $passback['response_message']);
        }
        $this->redirect('users/orders');
    }
}
