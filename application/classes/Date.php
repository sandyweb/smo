<?php defined('SYSPATH') or die('No direct script access.');
class Date extends Kohana_Date{

    /**
     * Method convert timestamp to date time
     *
     * @param $timestamp
     * @return string
     */
    public static function to_datetime($timestamp)
    {
        return date('m/d/Y h:i A', $timestamp);
    }
}