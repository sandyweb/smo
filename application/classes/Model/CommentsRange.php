<?php
/**
 * Class CommentsRange
 *
 * @property int $id
 * @property string $name
 * @property int $account_type_id
 * @property int $price
 */
class CommentsRange extends ORM{

    protected $_table_name = 'comments_range';

    protected $_belongs_to = array(
        'account_type' => array('model' => 'AccountTypes', 'foreign_key' => 'account_type_id')
    );

    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'comments_range_id')
    );
}
