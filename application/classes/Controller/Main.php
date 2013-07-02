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
        $errors = array();
        $message = '';
        $data = array('name' => '', 'email' => '', 'subject' => '', 'message' => '', 'project' => '');
        $send = $this->request->post('send');
        if($send)
        {
            $data = $this->request->post('message');
            $validation = Validation::factory($data)
                ->rule('name', 'not_empty')
                ->rule('name', 'not_empty')
                ->rule('email', 'not_empty')
                ->rule('email', 'email')
                ->rule('subject', 'not_empty')
                ->rule('type', 'not_empty')
            ;
            if($validation->check())
            {
                $config = Kohana::$config->load('config');
                $to = $config->get('admin_email');
                $template = View::factory('mails/frontend/contact', $data);
                $email_config = Kohana::$config->load('email');
                Email::connect($email_config);
                if(Email::send($to, $data['email'], $data['subject'], $template, TRUE))
                {
                    $message = 'Email was sent successfully';
                }
                else
                {
                    $errors[] = 'Email wasn\'t sent';
                }
            }
            else
            {
                $errors = $validation->errors('frontend/static/contact');
            }
        }
        $this->template->content = View::factory('frontend/static/contact')
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('message', $message)
        ;
    }

    public function action_freelance()
    {
        $this->template->content = View::factory('frontend/static/freelance');
    }
}
