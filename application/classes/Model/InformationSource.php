<?php
/**
 * Class Model_InformationSource
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $custom
 */
class Model_InformationSource extends ORM{
    const FB_DEFAULT_SOURCE = 1;
    const TWITTER_DEFAULT_SOURCE = 1;
    const LINKEDIN_DEFAULT_SOURCE = 1;
    const GOOGLE_DEFAULT_SOURCE = 1;
    protected $_table_name = 'information_source';

    public function get_fb_default_source()
    {
        return self::FB_DEFAULT_SOURCE;
    }

    public function get_twitter_default_source()
    {
        return self::TWITTER_DEFAULT_SOURCE;
    }

    public function get_linkedin_default_source()
    {
        return self::LINKEDIN_DEFAULT_SOURCE;
    }

    public function get_google_default_source()
    {
        return self::GOOGLE_DEFAULT_SOURCE;
    }
}
