<?php
/**
 * Class Model_PostingRange
 *
 * @property int $id
 * @property string $name
 * @property int $account_type_id
 * @property int $price
 */
class Model_PostingRange extends ORM{
    protected $_table_name = 'posting_range';

    protected $_belongs_to = array(
        'account_type' => array('model' => 'AccountsTypes', 'foreign_key' => 'account_type_id')
    );

    protected $_has_many = array(
        'accounts' => array('model' => 'Accounts', 'foreign_key' => 'posting_range_id')
    );
}
