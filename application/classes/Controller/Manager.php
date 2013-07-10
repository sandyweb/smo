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
        $this->template->header = '';
        $this->template->left_bar = '';
    }

    public function action_index()
    {
        $this->template->content = '';
    }
}
