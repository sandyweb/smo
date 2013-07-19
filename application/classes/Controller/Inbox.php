<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Inbox extends Controller_General{

    public $template = "frontend/layout_users";
    private $_user;

    public function before(){
        parent::before();
        if (!$this->auth->logged_in()) {
            $this->redirect('auth/login');
        }

        // Init arrays
        $data_left_bar = array();
        $data_header = array();

        $this->_user = $this->auth->get_user();
        $data_header['user'] = $this->_user;
        $data_header['controller'] = $this->request->controller();
        $data_header['action'] = $this->request->action();

        $message_model = ORM::factory('Message');
        $data_header['unread_messages_count'] = $message_model->get_unread_messages_count($this->auth->get_user()->id);

        $model_types = new Model_AccountsTypes();
        $data_left_bar['social_networks'] = $model_types->find_all();

        $data_left_bar['social_id'] = $this->request->param('id');
        if (empty($data_left_bar['social_id'])) {
            $data_left_bar['social_id'] = NULL;
        }

        $this->template->header = view::factory('frontend/header', $data_header);
        $this->template->left_bar = view::factory('frontend/left_bar', $data_left_bar);
    }

    public function action_index()
    {
        /**
         * @TODO add ability to send message for manager
         */
        $url = strtolower($this->request->controller()).'/view/';
        $this->template->content = View::factory('frontend/inbox/index')
            ->bind('action_url', $url)
        ;
    }

    public function action_view()
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
        $action = strtolower($this->request->controller()).'/create';
        $this->template->content = View::factory('frontend/inbox/view')
            ->bind('message', $model)
            ->bind('statuses', $statuses)
            ->bind('action', $action)
        ;
    }

    public function action_create()
    {
        if($this->request->post())
        {
            $message = $this->request->post('message');
            $message['created'] = time();
            $message['status'] = Model_Message::STATUS_UNREAD;
            ORM::factory('Message')->values($message)->save();
        }
        $this->redirect(strtolower($this->request->controller()).'/index');
    }
}