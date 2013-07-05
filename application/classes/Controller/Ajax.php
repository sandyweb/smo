<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Kohana_Controller{
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_APPLICATION_ERROR = 500;

    protected $auth;

    public function before()
    {
        $this->auth = Auth::instance();
        if(!$this->request->is_ajax())
        {
            $this->_permission_denied();
        }
    }

    public function action_check_email()
    {
        $email = $this->request->post('email');
        if(!$email)
        {
            $this->_invalid_request();
        }
        $users_model = new Model_Users();
        if($users_model->is_email_exists($email))
        {
            $result = array('status' => self::STATUS_BAD_REQUEST, 'reason' => 'Email already in use');
        }
        else
        {
            $token = Security::token(TRUE);
            $session = Session::instance();
            $session->set('register_token', $token);
            $data['url'] = URL::site('auth/register').URL::query(array(
                    'email' => $email, 'token' => $token, 'name' => $this->request->post('name')
            ));
            Model_Users::send_register_message($email, $data);
            $result = array('status' => self::STATUS_SUCCESS, 'data' => array('redirect' => URL::site('confirmation')));
        }
        echo $this->_response_json($result);
    }

    public function action_account_edit()
    {
        $id = $this->request->post('id');
        if(empty($id))
        {
            $this->_invalid_request();
        }
        $account = new Model_Accounts($id);
        if(!$account->loaded())
        {
            $result = array('status' => self::STATUS_BAD_REQUEST, 'reason' => 'Account was not found');
            $this->_response_json($result);
        }
        $account->title = $this->request->post('title');
        $account->accounts_types_id = $this->request->post('account_type');
        $account->description = $this->request->post('description');
        if($account->save())
        {
            $result = array('status' => self::STATUS_SUCCESS, 'message' => 'Account was saved successfully');
        }
        else
        {
            $result = array('status' => self::STATUS_BAD_REQUEST, 'reason' => 'Account was no saved');
        }
        echo $this->_response_json($result);
    }

    public function action_all_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('message')->get_messages($user_id);
        echo View::factory('frontend/inbox/all_messages')->bind('messages', $messages);
    }

    protected function _permission_denied()
    {
        $result = array('status' => self::STATUS_UNAUTHORIZED, 'reason' => 'You don\'t have permission for this method.');
        echo $this->_response_json($result);
    }

    protected function _invalid_request()
    {
        $result = array('status' => self::STATUS_BAD_REQUEST, 'reason' => 'Required parameter is missing');
        echo $this->_response_json($result);
    }

    protected function _application_error()
    {
        $result = array('status' => self::STATUS_APPLICATION_ERROR, 'reason' => 'Internal Server Error');
        echo $this->_response_json($result);
    }

    protected function _response_json($result)
    {
        header('Content-type: application/json');
        return json_encode($result);
    }
}