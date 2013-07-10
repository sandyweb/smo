<?php
/**
 * Class Notification
 */
class Notification extends Model{

    /**
     * Function send notification email message from sender to receiver
     *
     * @access public
     * @static
     * @param $sender_id
     * @param $receiver_id
     * @return int
     */
    public static function send_notification_message($sender_id, $receiver_id)
    {
        $sender = ORM::factory('Users', $sender_id);
        $receiver = ORM::factory('Users', $receiver_id);
        $data['from'] = $sender->email;
        $data['url'] = URL::site('inbox/index');
        $template = View::factory('mails/frontend/inbox_notification', $data);
        $email_config = Kohana::$config->load('email');
        Email::connect($email_config);
        return Email::send($receiver->email, $sender->email, 'Inbox Notification', $template, TRUE);
    }

    /**
     * Method send registration validation message
     *
     * @access public
     * @static
     * @param $email
     * @param $data
     * @return int
     */
    public static function send_validation_message($email, $data)
    {
        $config = Kohana::$config->load('config');
        $from = $config->get('admin_email');
        $template = View::factory('mails/frontend/validation', $data);
        $email_config = Kohana::$config->load('email');
        Email::connect($email_config);
        return Email::send($email, $from, 'Registration Process', $template, TRUE);
    }

    /**
     * Method send registration finish message
     *
     * @access public
     * @static
     * @param $email
     * @return int
     */
    public static function send_registration_message($email)
    {
        $config = Kohana::$config->load('config');
        $from = $config->get('admin_email');
        $template = View::factory('mails/frontend/register');
        $email_config = Kohana::$config->load('email');
        Email::connect($email_config);
        return Email::send($email, $from, 'Registration Process', $template, TRUE);
    }

    public static function send_order_message($email, $data)
    {
        $config = Kohana::$config->load('config');
        $from = $config->get('admin_email');
        $data['paid'] = Inflector::cents2dollars($data['paid']);
        $data['created'] = Date::to_datetime($data['created']);
        $statuses = Model_Order::get_statuses();
        $data['status'] = $statuses[$data['status']];
        $template = View::factory('mails/frontend/order', $data);
        $email_config = Kohana::$config->load('email');
        Email::connect($email_config);
        return Email::send($email, $from, 'Payment Notification', $template, TRUE);
    }
}
