<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_General {

    public function action_index()
    {
        $this->redirect('auth/login');
    }

}
