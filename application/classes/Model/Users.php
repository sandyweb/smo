<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends Model_User {
    
    protected $_table_name = 'users';

    protected $_has_many = array(
        'user_tokens' => array('model' => 'User_Token'),
        'roles'       => array('model' => 'Role', 'through' => 'roles_users', 'foreign_key' => 'user_id'),
        'accounts'    => array('model' => 'Accounts', 'foreign_key' => 'users_id'),
        'orders' => array('model' => 'Orders', 'foreign_key' => 'user_id')
    );

    protected $_has_one = array(
        'manager' => array('model' => 'Manager', 'foreign_key' => 'manager_id'),
        'client' => array('model' => 'Client', 'foreign_key' => 'client_id'),
    );
    
    public function labels()
    {
        return array(
            'username' => 'Username',
            'email'    => 'Email address',
            'password' => 'Password',
            'lastname' => 'Lastname'
        );
    }
    
    public function rules() {
        return array(
            'username' => array(array('not_empty'), array('max_length', array(':value', 32))),
            'lastname' => array(array('not_empty'), array('max_length', array(':value', 32))),
            'password' => array(array('not_empty')),
            'email' => array(array('not_empty'), array('email'), array(array($this, 'unique'), array('email', ':value'))),
        );
    }
    
    public function filters() {
        parent::filters();
        
        return array(
            'username' => array(array('trim'), array('strip_tags')),
            'lastname' => array(array('trim'), array('strip_tags')),
            'email' => array(array('trim'), array('strip_tags'))
        );
    }

    /**
     * Method check exits email or not
     *
     * @access public
     * @param $email
     * @return bool
     */
    public function is_email_exists($email)
    {
        $query = DB::select('id')
            ->from($this->_table_name)
            ->where('email', '=', $email)
            ->limit(1)
        ;
        $id = $query->execute()->get('id', 0);
        return (!empty($id)) ? TRUE : FALSE;
    }

    /**
     * Save user avatar, if success return file name
     *
     * @access public
     * @param $image
     * @return bool|string
     */
    public function save_avatar($image)
    {
        if(
            ! Upload::valid($image) OR
            ! Upload::not_empty($image) OR
            ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
        {
            return FALSE;
        }

        $directory = DOCROOT.'files/media/avatars/';

        if($file = Upload::save($image, NULL, $directory))
        {
            $filename = strtolower(Text::random('alnum', 20)).'.jpg';

            Image::factory($file)
                ->resize(200, 200, Image::AUTO)
                ->save($directory.$filename);

            // Delete the temporary file
            unlink($file);

            return $filename;
        }

        return FALSE;
    }
    
    public static function get_password_validation($values) {
        return Validation::factory($values)
            ->rule('password', 'not_empty')
            ->rule('password', 'min_length', array(':value', 4))
            ->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));
    }
}