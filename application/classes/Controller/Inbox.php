<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Inbox extends Controller_General{

    public $template = "frontend/layout_users";

    public function before() {
        parent::before();
        if (!$this->auth->logged_in()) {
            $this->redirect('auth/login');
        }

        // Init arrays
        $data_left_bar = array();
        $data_header = array();

        $data_header['user'] = $this->auth->get_user();
        $data_header['controller'] = $this->request->controller();
        $data_header['action'] = $this->request->action();

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
        $this->template->content = View::factory('frontend/inbox/index');
    }
}