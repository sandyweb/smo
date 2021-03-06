<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_General {

    public $template = "frontend/layout_users";
    public $message = '';

    public function before() {
        parent::before();
        if (!$this->auth->logged_in()) {
            $this->redirect('auth/login');
        }
        if($this->auth->get_user()->is_manager)
        {
            $this->redirect('auth/login');
        }

        // Init arrays
        $data_left_bar = array();
        $data_header = array();
        
        $data_header['user'] = $this->auth->get_user();
        $data_header['controller'] = $this->request->controller();
        $data_header['action'] = $this->request->action();
        $message_model = ORM::factory('Message');
        $data_header['unread_messages_count'] = $message_model->get_unread_messages_count($this->auth->get_user()->id);
        
        $model_types = new Model_AccountsTypes();
        $data_left_bar['social_networks'] = $model_types->order_by('id')->find_all();
        
        $data_left_bar['social_id'] = $this->request->param('id');
        if (empty($data_left_bar['social_id'])) {
            $data_left_bar['social_id'] = NULL;
        }

        $session = Session::instance();
        $this->message = $session->get_once('message');
        
        $this->template->header = view::factory('frontend/header', $data_header);
        $this->template->left_bar = view::factory('frontend/left_bar', $data_left_bar);
        $this->template->additional = '';
    }

    public function action_edit() {
        if ($this->request->post()) {
            $email = $this->request->post('email');
            $username = $this->request->post('username');
            $lastname = $this->request->post('lastname');
            $password = $this->request->post('password');
            $confirm_password = $this->request->post('confirm_password');
            $old_password = $this->request->post('old_password');
            
        }
        
        $data['user'] = $this->auth->get_user()->id;
        $this->template->content = view::factory('frontend/users/edit')->set('form', $_POST)->bind('errors', $errors);
    }
    
    public function action_index()
    {
        $expired_accounts = ORM::factory('Accounts')->get_expired_accounts($this->auth->get_user()->id);
        $social_id = $this->request->param('id');

        $data['user'] = $this->auth->get_user();
        
        // Get accounts
        $model_accounts = new Model_Accounts();
        $model_accounts->where('users_id', '=', $this->auth->get_user()->id);
        if($social_id)
        {
            $model_accounts->and_where('accounts_types_id', '=', $social_id);
        }
        $data['accounts'] = $model_accounts->find_all();
        $data['account_type_id'] = $social_id;
        
        $this->template->content = view::factory('frontend/users/index', $data)->bind('expired_accounts', $expired_accounts);
    }
    
    public function action_settings() {

        $user_id = $this->auth->get_user()->id;
        $model = new Model_Users($user_id);
        $action = 'users/settings';
        $message = '';
        if($this->request->post())
        {
            try
            {
                $model->username = $this->request->post('username');
                $model->lastname = $this->request->post('lastname');
                $model->email = $this->request->post('email');
                $password = $this->request->post('password');
                $model->mobile_phone = $this->request->post('mobile_phone');
                $model->provider_id = $this->request->post('mobile_provider');
                $model->email_format = $this->request->post('email_format');
                if($password)
                {
                    $model->password = $this->auth->hash($password);
                }
                if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['size'] > 0)
                {
                    $filename = $model->save_avatar($_FILES['profile_photo']);
                    if(!$filename)
                    {
                        throw new Exception('There was a problem while uploading the image.
                                Make sure it is uploaded and must be JPG/PNG/GIF file.'
                        );
                    }
                    $model->image = $filename;
                }
                $model->save();
                $message = 'User details was saved successfully';
            }
            catch(Exception $e)
            {
                $errors['validation'] = $e->getMessage();
            }
        }
        $data['user'] = $model;
        $this->template->content = view::factory('frontend/users/settings', $data)
            ->set('form', $_POST)
            ->bind('errors', $errors)
            ->bind('action', $action)
            ->bind('message', $message)
        ;
    }

    public function action_orders()
    {
        $auth_user_id = $this->auth->get_user()->id;
        $order = new Model_Order();
        $paid_orders = $order->get_paid_orders($auth_user_id);
        $unpaid_orders = $order->get_unpaid_orders($auth_user_id);
        $this->template->content = view::factory('frontend/users/orders')
            ->bind('paid_orders', $paid_orders)
            ->bind('unpaid_orders', $unpaid_orders)
        ;
    }

    public function action_account_edit()
    {
        $id = $this->request->param('id');
        $model = new Model_Accounts($id);
        if(!$model->loaded())
        {
            throw new HTTP_Exception_404("Page not found");
        }
        $data['account'] = $model;
        $account_type = new Model_AccountsTypes();
        $data['networks_types'] = $account_type->find_all();
        $view['edit_view'] = view::factory('frontend/accounts/edit', $data);
        $messages = $model->messages->find_all();
        $message = ORM::factory('Message');
        $statuses = $message->get_statuses();
        $action_url = 'inbox/view/';
        $this->template->additional = View::factory('frontend/inbox/project_messages')
            ->bind('messages', $messages)
            ->bind('statuses', $statuses)
            ->bind('action_url', $action_url)
        ;
        $this->template->content = view::factory('frontend/accounts/view', $view);
    }
}
