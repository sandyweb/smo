<?php
/**
 * Class Manager
 */
class Controller_Manager extends Controller_General{
    public $template = "frontend/manager/layout";
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
    }

    public function action_index()
    {
        $manager = ORM::factory('Manager', $this->_user->id);
        $clients = $manager->clients->find_all();
        $this->template->content = View::factory('frontend/manager/clients')->bind('clients', $clients);
    }

    public function action_inbox()
    {
        $this->template->content = '';
    }

    public function action_settings()
    {
        $this->template->content = '';
    }
}
