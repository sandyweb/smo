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
        $message = ORM::factory('Message');
        $messages = $message->get_messages($user_id);
        $statuses = $message->get_statuses();
        echo View::factory('frontend/inbox/all_messages')->bind('messages', $messages)->bind('statuses', $statuses);
    }

    public function action_unread_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_unread_messages($user_id);
        echo View::factory('frontend/inbox/unread_messages')->bind('messages', $messages);
    }

    public function action_read_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_read_messages($user_id);
        echo View::factory('frontend/inbox/read_messages')->bind('messages', $messages);
    }

    public function action_archived_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_archived_messages($user_id);
        echo View::factory('frontend/inbox/archived_messages')->bind('messages', $messages);
    }

    public function action_get_counters()
    {
        $session = Session::instance();
        $like_ratio = 1127.13;
        $message_ratio = 64799.71;
        $twits_ratio = 2931.14;
        $dollar_ratio = 1615623.73;
        $time = time();
        $likes = round($time / $like_ratio, 0);
        $messages = round($time / $message_ratio, 0);
        $twits = round($time / $twits_ratio, 0);
        $dollars = round($time / $dollar_ratio, 0);
        $session_likes = (double)$session->get('likes');
        $session_messages = (double)$session->get('messages');
        $session_twits = (double)$session->get('twits');
        $session_dollars = (double)$session->get('dollars');
        if($session_likes > $likes){
            $likes = $session_likes + rand(1, 2);
        }
        else
        {
            $likes += rand(1, 2);
        }
        if($session_messages > $messages){
            $messages = $session_messages + rand(1, 2);
        }
        else
        {
            $messages += rand(1, 2);
        }
        if($session_twits > $twits){
            $twits = $session_twits + rand(1, 2);
        }
        else
        {
            $twits += rand(1, 2);
        }
        if($session_dollars > $dollars){
            $dollars = $session_dollars + rand(1, 2);
        }
        else
        {
            $dollars += rand(1, 2);
        }
        $session->set('likes', $likes);
        $session->set('messages', $messages);
        $session->set('twits', $twits);
        $session->set('dollars', $dollars);
        $likes = number_format($likes);
        $messages = number_format($messages);
        $twits = number_format($twits);
        $dollars = number_format($dollars);
        $result = array('status' => 200, 'data' => array(
            'likes' => $likes, 'messages' => $messages, 'twits' => $twits, 'dollars' => $dollars
        ));
        echo json_encode($result);
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