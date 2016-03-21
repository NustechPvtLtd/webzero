<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * User Helpers
 *
 * @package		Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Nustech Dev Team
 */
// ------------------------------------------------------------------------

/**
 * 
 *
 * Fetches a user session variable
 *
 * @access	public
 * @param	string	the session variable name
 * @param	string	the value of variable
 * @return	string
 */
if (!function_exists('check_account_expiration')) {

    function check_account_expiration() {
        $expiry_date = userdata('expiry_date');
        if (!empty($expiry_date)) {
            $current_date = time();
            $flag = 0;
            if ($current_date == $expiry_date) {
                
            } else if ($current_date > $expiry_date) {
                $flag = 1;
            }
            return $flag;
        }
    }

}

