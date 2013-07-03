<?php defined('SYSPATH') or die('No direct script access.');

class Inflector extends Kohana_Inflector{

    /**
     * Method convert string to cents
     *
     * @access public
     * @static
     * @param string $value
     * @return int
     */
    public static function string2cents($value)
    {
        return trim(str_replace(array('$', ' '), '', $value))*100;
    }

    /**
     * Method convert cents to dollars
     * and return dollars in 0.00 format
     *
     * @access public
     * @static
     * @param int $value
     * @return float
     */
    public static function cents2dollars($value)
    {
        $dol = $value / 100;
        $tmp = explode('.', $dol);
        if(empty($tmp[1]))
        {
            $dol .= '.00';
        }
        else if(strlen($tmp[1]) < 2)
        {
            $dol .= '0';
        }
        else if(strlen($tmp[1]) > 2)
        {
            $dol = $tmp[1].'.'.substr ($tmp[1], 0, 2);
        }
        return (string)$dol;
    }

}
