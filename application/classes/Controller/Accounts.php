<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Accounts extends Controller_General {

    public function add($user_id, $type_id, $title, $description) {
        $model = new Model_Accounts();
        $model->title = $title;
        $model->description = $description;
        $model->accounts_types_id = $type_id;
        $model->users_id = $user_id;
        if($model->save())
        {
            return $model;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function action_delete() {
        $id = $this->request->param('id');
        $model = new Model_Accounts($id);
        if (!$model->loaded()) {
            throw new HTTP_Exception_404("Page not found");
        }
        
        $model->delete();
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function action_edit() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
            $account_id = $this->request->param('id');
            
            $model = new Model_Accounts($account_id);
            if (!$model->loaded()) {
                throw new HTTP_Exception_404("Not found page");
                exit;
            }
            
            try {
                if ($this->request->post()) {
                    $model->title = $this->request->post('title');
                    $model->description = $this->request->post('description');
                    $model->accounts_types_id = $this->request->post('type');

                    if ($model->save()) {
                        echo NULL;
                        exit;
                    }
                }
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
            
            $data['account'] = $model;
            $model = new Model_AccountsTypes();
            $data['networks_types'] = $model->find_all();
            echo view::factory('frontend/accounts/edit', $data)->set('form', $_POST)->bind('errors', $errors);
        }
    }
    
    public function action_add()
    {
        $session = Session::instance();
        $this->auto_render = FALSE;
        if($this->request->post())
        {
            $data['title'] = $this->request->post('title');
            $data['description'] = $this->request->post('description');
            $data['accounts_types_id'] = $this->request->post('account_type');
            $data['posting_range_id'] = $this->request->post('posting_range');
            $data['posting_range_custom'] = ($this->request->post('posting_range_custom')) ? $this->request->post('posting_range_custom') : 0;
            $data['comments_range_id'] = $this->request->post('comments_range');
            $data['comments_range_custom'] = ($this->request->post('comments_range_custom')) ? $this->request->post('comments_range_custom') : 0;
            $data['like_range_id'] = $this->request->post('like_range');
            $data['like_range_custom'] = ($this->request->post('like_range_custom')) ? $this->request->post('like_range_custom') : 0;
            $data['information_source_id'] = $this->request->post('information_source');
            $data['total_likes'] = $this->request->post('total_page_likes');
            $data['total_followers'] = ($this->request->post('followers')) ? $this->request->post('followers') : 0;
            $data['total_friends'] = ($this->request->post('friends')) ? $this->request->post('friends') : 0;
            $price = $this->request->post('price');
            $data['cost'] = $price;
            $data['users_id'] = $this->auth->get_user()->id;
            $account = new Model_Accounts;
            $account->values($data);
            try
            {
                if($account->save())
                {
                    $session->set('message', array('type' => 'success', 'message' => 'Account was saved successfully'));
                    if($this->request->post('add_to_order') || $this->request->post('purchase'))
                    {

                        $order_id = $this->add_to_order($account->id, $price);
                        if($order_id)
                        {
                            $message = array('type' => 'success', 'message' => 'Order was added successfully');
                            $session->set('message', $message);
                            if($this->request->post('purchase'))
                            {
                                $this->purchase_order($order_id, $account->id, $price, $data['title']);
                            }
                        }
                        else
                        {
                            $message = array('type' => 'alert', 'message' => 'Order was not saved');
                            $session->set('message', $message);
                        }
                    }
                }
            }
            catch(ORM_Validation_Exception $e)
            {
                $message = array('type' => 'alert', 'message' => $e->errors('validation'));
                $session->set('message', $message);
            }
        }
        $this->redirect('users/index');
    }

    public function add_to_order($account_id, $price)
    {
        $order_id = 0;
        $order = new Model_Order;
        $order->account_id = $account_id;
        $order->user_id = $this->auth->get_user()->id;
        $order->created = time();
        $order->status = Model_Order::STATUS_UNPAID;
        $order->paid = $price;
        if($order->save())
        {
            $data = $order->as_array();
            Notification::send_order_message($this->auth->get_user()->email, $data);
            $order_id = $order->id;
        }
        return $order_id;
    }

    public function purchase_order($order_id, $account_id, $price, $title)
    {
        require_once(APPPATH.'vendor/Twocheckout.php');
        $config = Kohana::$config->load('config');
        Twocheckout::setCredentials($config['api_username'], $config['api_password']);
        $product = array();
        $product['currency_code'] = 'USD';
        $product['mode'] = '2CO';
        $product['li_0_price'] = round($price / 100, 2);
        $product['merchant_order_id'] = $order_id;
        $product['li_0_name'] = $title;
        $product['li_0_quantity'] = 1;
        $product['sid'] = $config['vendor_id'];
        $product['li_0_type'] = 'product';
        $product['li_0_tangible'] = 'N';
        $product['li_0_product_id'] = $account_id;
        $product['demo'] = 'Y';
        Twocheckout_Charge::redirect($product);
        exit();
    }

    public function action_get(){
        if($this->request->is_ajax())
        {
            $this->auto_render = FALSE;
            $model = new Model_AccountsTypes();
            $data['networks_types'] = $model->find_all();
            echo view::factory('frontend/accounts/add', $data)->set('form', $_POST)->bind('errors', $errors);
        }
    }
}
