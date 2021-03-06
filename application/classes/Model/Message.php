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
        'receiver' => array('model' => 'Users', 'foreign_key' => 'receiver_id'),
        'account' => array('model' => 'Accounts', 'foreign_key' => 'account_id')
    );

    public function filters() {
        parent::filters();

        return array(
            'subject' => array(array('trim'), array('strip_tags')),
            'message' => array(array('trim'), array('strip_tags')),
        );
    }

    public function save(Validation $validation = NULL)
    {
        Notification::send_notification_message($this->sender_id, $this->receiver_id);
        parent::save($validation);
    }

    public function get_messages($receiver_id, $offset = 0, $limit = 5)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->order_by('created', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->find_all();
    }

    public function get_messages_count($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->count_all();
    }

    public function get_archived_messages($receiver_id, $offset = 0, $limit = 5)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_ARCHIVED)
            ->order_by('created', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->find_all();
    }

    public function get_archived_messages_count($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_ARCHIVED)
            ->count_all();
    }

    public function get_read_messages($receiver_id, $offset = 0, $limit = 5)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_READ)
            ->order_by('created', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->find_all();
    }

    public function get_read_messages_count($receiver_id)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_READ)
            ->count_all();
    }

    public function get_unread_messages($receiver_id, $offset = 0, $limit = 5)
    {
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_UNREAD)
            ->order_by('created', 'desc')
            ->offset($offset)
            ->limit($limit)
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
        return $this->where('receiver_id', '=', $receiver_id)
            ->and_where('status', '=', self::STATUS_UNREAD)
            ->count_all();
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

    /**
     * Method get sent messages
     *
     * @access public
     * @param $sender_id
     * @return Database_Result
     */
    public function get_sent_messages($sender_id)
    {
        return $this->where('sender_id', '=', $sender_id)
            ->find_all();
    }

    /**
     * Method get message history
     *
     * @param $sender_id
     * @param $receiver_id
     * @param int $offset
     * @param int $limit
     * @return Database_Result
     */
    public function get_history($sender_id, $receiver_id, $offset = 0, $limit = 5)
    {
        return $this->
            where_open()
                ->where('sender_id', '=', $sender_id)
                ->and_where('receiver_id', '=', $receiver_id)
            ->where_close()
            ->or_where_open()
                ->where('receiver_id', '=', $sender_id)
                ->and_where('sender_id', '=', $receiver_id)
            ->or_where_close()
            ->order_by('created', 'asc')
            ->offset($offset)
            ->limit($limit)
            ->find_all()
        ;
    }

    /**
     * Method get message history count
     *
     * @access public
     * @param $sender_id
     * @param $receiver_id
     * @return int
     */
    public function get_history_count($sender_id, $receiver_id)
    {
        return $this->where_open()
            ->where('sender_id', '=', $sender_id)
            ->and_where('receiver_id', '=', $receiver_id)
            ->where_close()
            ->or_where_open()
            ->where('receiver_id', '=', $sender_id)
            ->and_where('sender_id', '=', $receiver_id)
            ->or_where_close()
            ->count_all()
        ;
    }
}