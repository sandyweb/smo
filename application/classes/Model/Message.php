<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Class Model_Message
 *
 * @property int $id
 * @property int $created
 * @property string $subject
 * @property string $message
 * @property int $sender_id
 * @property int $receiver_id
 * @property int $status
 * @property Model_Users sender
 * @property Model_Users receiver
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

    public function filters() {
        parent::filters();

        return array(
            'subject' => array(array('trim'), array('strip_tags')),
            'message' => array(array('trim'), array('strip_tags')),
        );
    }

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

    /**
     * Method get unread messages count
     *
     * @access public
     * @param $receiver_id
     * @return int
     */
    public function get_unread_messages_count($receiver_id)
    {
        return sizeof($this->get_unread_messages($receiver_id));
    }

    /**
     * Method get message statuses
     *
     * @access public
     * @return array
     */
    public function get_statuses()
    {
        return array(
            self::STATUS_READ => 'Read',
            self::STATUS_UNREAD => 'Unread',
            self::STATUS_ARCHIVED => 'Archived'
        );
    }
}