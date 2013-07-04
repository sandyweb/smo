<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_Message
 */
class Model_Message extends ORM{
    const STATUS_READ = 1;
    const STATUS_UNREAD = 2;
    const STATUS_ARCHIVED = 3;

    protected $_table_name = 'messages';

    protected $_belongs_to = array(
        'sender' => array('model' => 'Users', 'foreign_key' => 'sender_id'),
        'receiver' => array('model' => 'Users', 'foreign_key' => 'receiver_id')
    );

    public function get_messages($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)->find_all();
    }

    public function get_archived_messages($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_ARCHIVED)
            ->find_all();
    }

    public function get_read_messages($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_READ)
            ->find_all();
    }

    public function get_unread_messages($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_UNREAD)
            ->find_all();
    }
}