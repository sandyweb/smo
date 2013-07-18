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
            Notification::send_validation_message($email, $data);
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
        $action_url = $this->request->post('action_url');
        echo View::factory('frontend/inbox/all_messages')
            ->bind('messages', $messages)
            ->bind('statuses', $statuses)
            ->bind('action_url', $action_url)
        ;
    }

    public function action_unread_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_unread_messages($user_id);
        $action_url = $this->request->post('action_url');
        echo View::factory('frontend/inbox/unread_messages')
            ->bind('messages', $messages)
            ->bind('action_url', $action_url)
        ;
    }

    public function action_read_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_read_messages($user_id);
        $action_url = $this->request->post('action_url');
        echo View::factory('frontend/inbox/read_messages')
            ->bind('messages', $messages)
            ->bind('action_url', $action_url)
        ;
    }

    public function action_archived_messages()
    {
        $user_id = $this->auth->get_user()->id;
        $messages = ORM::factory('Message')->get_archived_messages($user_id);
        $action_url = $this->request->post('action_url');
        echo View::factory('frontend/inbox/archived_messages')
            ->bind('messages', $messages)
            ->bind('action_url', $action_url)
        ;
    }

    public function action_get_counters()
    {
        $like_ratio = 1127.13;
        $message_ratio = 64799.71;
        $twits_ratio = 2931.14;
        $time = time();
        $likes = round($time / $like_ratio, 0);
        $messages = round($time / $message_ratio, 0);
        $twits = round($time / $twits_ratio, 0);
        $likes = number_format($likes);
        $messages = number_format($messages);
        $twits = number_format($twits);
        $result = array('status' => 200, 'data' => array(
            'likes' => $likes, 'messages' => $messages, 'twits' => $twits
        ));
        echo json_encode($result);
    }

    public function action_message_history()
    {
        $sender_id = $this->auth->get_user()->id;
        $receiver_id = $this->request->post('client_id');
        $messages = ORM::factory('Message')->get_history($sender_id, $receiver_id);
        echo View::factory('frontend/manager/message_history')
            ->bind('messages', $messages)
            ->bind('sender', $sender_id)
        ;
    }

    public function action_account_type_view()
    {
        $account_type_id = $this->request->post('account_type_id');
        $account_type = ORM::factory('AccountsTypes', $account_type_id);
        switch($account_type->title)
        {
            case 'Facebook':
                $this->fb_view($account_type_id);
                break;
            case 'Twitter':
                $this->twitter_view($account_type_id);
                break;
            case 'LinkedIn':
                $this->linkedin_view();
                break;
            case 'Google+':
                $this->google_view($account_type_id);
                break;
            case 'Blog':
                $this->blog_view();
                break;
            case 'Pinterest':
                $this->pinterest_view();
                break;
        }
    }

    public function fb_view($account_type_id)
    {
        $posting_model = ORM::factory('PostingRange');
        $posting_range = $posting_model->get_range($account_type_id);
        $default_posting_range = $posting_model->get_fb_default_range();
        $source_model = ORM::factory('InformationSource');
        $sources = $source_model->find_all();
        $default_source = $source_model->get_fb_default_source();
        $like_model = ORM::factory('LikeRange');
        $like_range = $like_model->get_range($account_type_id);
        $default_like_range = $like_model->get_fb_default_range();
        $comment_model = ORM::factory('CommentsRange');
        $comments_range = $comment_model->get_range($account_type_id);
        $default_comments_range = $comment_model->get_fb_default_range();

        echo View::factory('frontend/account_type/facebook')
            ->bind('posting_range', $posting_range)
            ->bind('default_posting_range', $default_posting_range)
            ->bind('like_range', $like_range)
            ->bind('default_like_range', $default_like_range)
            ->bind('sources', $sources)
            ->bind('default_source', $default_source)
            ->bind('comments_range', $comments_range)
            ->bind('default_comments_range', $default_comments_range)
        ;
    }

    public function twitter_view($account_type_id)
    {
        $posting_model = ORM::factory('PostingRange');
        $posting_range = $posting_model->get_range($account_type_id);
        $default_posting_range = $posting_model->get_twitter_default_range();
        $source_model = ORM::factory('InformationSource');
        $sources = $source_model->find_all();
        $default_source = $source_model->get_twitter_default_source();
        echo View::factory('frontend/account_type/twitter')
            ->bind('posting_range', $posting_range)
            ->bind('default_posting_range', $default_posting_range)
            ->bind('sources', $sources)
            ->bind('default_source', $default_source)
        ;
    }

    public function linkedin_view()
    {
        $source_model = ORM::factory('InformationSource');
        $sources = $source_model->find_all();
        $default_source = $source_model->get_linkedin_default_source();
        echo View::factory('frontend/account_type/linkedin')
            ->bind('sources', $sources)
            ->bind('default_source', $default_source)
        ;
    }

    public function google_view($account_type_id)
    {
        $posting_model = ORM::factory('PostingRange');
        $posting_range = $posting_model->get_range($account_type_id);
        $default_posting_range = $posting_model->get_google_default_range();
        $source_model = ORM::factory('InformationSource');
        $sources = $source_model->find_all();
        $default_source = $source_model->get_google_default_source();
        $like_model = ORM::factory('LikeRange');
        $like_range = $like_model->get_range($account_type_id);
        $default_like_range = $like_model->get_google_default_range();
        $comment_model = ORM::factory('CommentsRange');
        $comments_range = $comment_model->get_range($account_type_id);
        $default_comments_range = $comment_model->get_google_default_range();

        echo View::factory('frontend/account_type/google')
            ->bind('posting_range', $posting_range)
            ->bind('default_posting_range', $default_posting_range)
            ->bind('like_range', $like_range)
            ->bind('default_like_range', $default_like_range)
            ->bind('sources', $sources)
            ->bind('default_source', $default_source)
            ->bind('comments_range', $comments_range)
            ->bind('default_comments_range', $default_comments_range)
        ;
    }

    public function blog_view()
    {
        echo View::factory('frontend/account_type/blog');
    }

    public function pinterest_view()
    {
        echo View::factory('frontend/account_type/pinterest');
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