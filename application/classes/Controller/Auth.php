<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_General {

    public function login($email, $password) {
        if ($this->auth->login($email, $password)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function action_restorePassword() {
        if ($this->request->post()) {
            try {
                $email = $this->request->post('email');
                $model = new Model_Users();
                $email_validation = $model->isset_email($email);
                $model->check($email_validation);
                
                // Send email
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $this->template->title .= "Restore password";
        $this->template->content = view::factory('frontend/auth/restore')->set('form', $_POST)->bind('errors', $errors);
    }
    
    public function action_login() {
        if ($this->request->post()) {
            try {
                $email = $this->request->post('email');
                $password = $this->request->post('password');
                
                if($this->login($email, $password))
                {
                    (!$this->auth->get_user()->is_manager) ? $this->redirect('users/index') : $this->redirect('manager/index');
                }
                else
                {
                    $errors['auth'] = "Not valid email/password, please try again";
                }
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $this->template->title .= "Login";
        $this->template->content = view::factory('frontend/auth/login')->set('form', $_POST)->bind('errors', $errors);
    }

    public function action_register()
    {
        $form = array('email' => '', 'password' => '', 'password_confirm' => '', 'username' => '', 'lastname' => '');
        $errors = array();
        if($this->request->post()){
            try {
                $email = $this->request->post('email');
                $password = $this->request->post('password');
                $password_confirm = $this->request->post('password_confirm');
                $username = $this->request->post('username');
                $lastname = $this->request->post('lastname');
                
                $image = NULL;
                
                // Check password
                if ($password === $password_confirm) {
                    $check = $this->register($email, $password, $username, $lastname, $image);
                    
                    if ($check != FALSE) {
                        Notification::send_registration_message($email);
                        $this->auth->login($email, $password);
                        // Redirect to account
                        $this->redirect('users/index');
                    }
                    
                } else {
                    $errors['password_confirm'] = "Confirm password not valid";
                }

            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        else
        {
            $request_token = $this->request->query('token');
            $session = Session::instance();
            $session_token = $session->get('register_token');
            if(!is_null($session_token) && $request_token == $session_token)
            {
                $form['email'] = $this->request->query('email');
                $form['username'] = $this->request->query('name');
                $session->delete('register_token');
            }
            else
            {
                $errors[] = 'Invalid request token';
            }
        }
        
        $this->template->title .= "Register";
        $this->template->content = view::factory('frontend/auth/register')->set('form', $form)->bind('errors', $errors);
    }
    
    public function register($email, $password, $username, $lastname, $image = NULL) {
        $model = new Model_Users();
        
        $model->email = $email;
        $model->username = $username;
        $model->lastname = $lastname;
        $model->password = $this->auth->hash_password($password);
        $model->date_register = date("Y-m-d h:i:s", time());
        $model->image = NULL;
        
        // Add avatar
        // Rewrite to controller Images (add action add, delete, resize)
        if ($image != NULL) {
            $new_filename = Helper_Convertor::StringToFilename($image['name']);
            $directory = Kohana::load('paths');
            Upload::save($image, $new_filename, $directory->avatars, 0777);
            $model->image = $new_filename;
        }
        
        if ($model->save()) {
            
            $model->add('roles', ORM::factory('Role')->where('name', '=', 'login')->find());
            
            return $model;
        } else {
            return FALSE;
        }
    }
    
    public function action_logout() {
        if ($this->auth->logged_in()) {
            $this->auth->logout();
        }
        
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
