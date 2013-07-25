<?php
/**
 * Class Manager
 */
class Controller_Manager extends Controller_General{
    public $template = "frontend/manager/layout";
    /**
     * @var Model_Users
     */
    private $_user = NULL;

    public function before()
    {
        parent::before();
        if(!$this->auth->logged_in())
        {
            $this->redirect('auth/login');
        }
        $this->_user = $this->auth->get_user();
        if(!$this->_user->is_manager)
        {
            $this->redirect('auth/login');
        }

        $data_header['user'] = $this->_user;
        $data_header['controller'] = $this->request->controller();
        $data_header['action'] = $this->request->action();
        $message_model = ORM::factory('Message');
        $data_header['unread_messages_count'] = $message_model->get_unread_messages_count($this->auth->get_user()->id);
        $this->template->header = view::factory('frontend/manager/header', $data_header);
        $this->template->left_bar = '';
        $this->template->additional = '';
    }

    public function action_index()
    {
        $manager = ORM::factory('Manager', $this->_user->id);
        $clients = $manager->clients->find_all();
        foreach($clients as $client)
        {
            $client_ids[] = $client->user->id;
        }
        $expired_accounts = ORM::factory('Accounts')->get_expired_accounts($client_ids);
        $this->template->content = View::factory('frontend/manager/clients')
            ->bind('clients', $clients)
            ->bind('expired_accounts', $expired_accounts)
        ;
    }

    public function action_inbox()
    {
        $controller = strtolower($this->request->controller());
        $url = $controller.'/inbox_view/';
        $data['clients'] = ORM::factory('Manager')->get_clients_as_array($this->_user->id);
        $data['message'] = array('sender_id' => $this->_user->id);
        $data['action'] = $controller.'/inbox_create';
        $additional = View::factory('frontend/inbox/to_client_form', $data);
        $this->template->additional = $additional;
        $this->template->content = View::factory('frontend/manager/messages')
            ->bind('action_url', $url)
            ->bind('clients', $data['clients'])
        ;
    }

    public function action_inbox_view()
    {
        $id = $this->request->param('id');
        $model = ORM::factory('Message', $id);
        if(!$model->loaded())
        {
            throw new HTTP_Exception_404("Page not found");
        }
        if($model->status == Model_Message::STATUS_UNREAD)
        {
            $model->status = Model_Message::STATUS_READ;
            $model->save();
        }
        $statuses = $model->get_statuses();
        $action = strtolower($this->request->controller()).'/inbox_create';
        $this->template->content = View::factory('frontend/inbox/view')
            ->bind('message', $model)
            ->bind('statuses', $statuses)
            ->bind('action', $action)
        ;
    }

    public function action_inbox_create()
    {
        if($this->request->post())
        {
            $message = $this->request->post('message');
            if($this->request->post('account_id'))
            {
                $message['account_id'] = $this->request->post('account_id');
            }
            $message['created'] = time();
            $message['status'] = Model_Message::STATUS_UNREAD;
            ORM::factory('Message')->values($message)->save();
        }
        $this->redirect(strtolower($this->request->controller()).'/inbox');
    }

    public function action_outbox()
    {
        $controller = strtolower($this->request->controller());
        $url = $controller.'/outbox_view/';
        $messages = ORM::factory('Message')->get_sent_messages($this->_user->id);
        $this->template->content = View::factory('frontend/outbox/index')
            ->bind('messages', $messages)
            ->bind('action_url', $url)
        ;
    }

    public function action_outbox_view()
    {
        $id = $this->request->param('id');
        $model = ORM::factory('Message', $id);
        if(!$model->loaded())
        {
            throw new HTTP_Exception_404("Page not found");
        }
        $this->template->content = View::factory('frontend/outbox/view')
            ->bind('message', $model)
        ;
    }

    public function action_settings()
    {
        if($this->request->post())
        {
            try
            {
                $this->_user->username = $this->request->post('username');
                $this->_user->lastname = $this->request->post('lastname');
                $this->_user->email = $this->request->post('email');
                $password = $this->request->post('password');
                $this->_user->mobile_phone = $this->request->post('mobile_phone');
                $this->_user->provider_id = $this->request->post('mobile_provider');
                $this->_user->email_format = $this->request->post('email_format');
                if($password)
                {
                    $this->_user->password = $this->auth->hash($password);
                }
                if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['size'] > 0)
                {
                    $filename = ORM::factory('Users')->save_avatar($_FILES['profile_photo']);
                    if(!$filename)
                    {
                        throw new Exception('There was a problem while uploading the image.
                                Make sure it is uploaded and must be JPG/PNG/GIF file.'
                        );
                    }
                    $this->_user->image = $filename;
                }
                $this->_user->save();
            }
            catch(ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $data['user'] = $this->_user;
        $action = 'manager/settings/';
        $this->template->content = view::factory('frontend/users/settings', $data)
            ->set('form', $_POST)
            ->bind('errors', $errors)
            ->bind('action', $action)
        ;
    }
}
