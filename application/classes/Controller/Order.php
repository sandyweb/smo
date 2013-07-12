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

    /**
     * @TODO Finish payment process
     * @TODO update order
     */
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
        var_dump($params);
        exit();

        $session = Session::instance();
        if($passback['response_code'] == 'Success')
        {
            $session->set('message', 'Payment was proceed successfully');
        }
        else
        {
            $session->set('message', $passback['response_message']);
        }
//        $this->redirect('users/orders');
    }
}
