<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_General {
    public $template = 'frontend/static/template';

    public function action_home()
    {
        $this->template->content = View::factory('frontend/static/index');
    }

    public function action_about()
    {
        $this->template->content = View::factory('frontend/static/about');
    }

    public function action_testimonials()
    {
        $this->template->content = View::factory('frontend/static/testimonials');
    }

    public function action_dashboard()
    {
        $this->template->content = View::factory('frontend/static/dashboard');
    }

    public function action_contact()
    {
        $this->template->content = View::factory('frontend/static/contact');
    }

    public function action_freelance()
    {
        $this->template->content = View::factory('frontend/static/freelance');
    }
}
