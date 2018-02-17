<?php

/**
 * Authorization Library
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Authorization.php
 * @package     Controllers
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 * @functions   01
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authorization.php
 *
 * @category Authorization.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Authorization {

	/**
     * Construct
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *    or MissingViewException in debug mode.
     */
    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
    * Function to check admin session
    * 
    * @return void
    */
    public function check_admin_session() {
    	$user_session = $this->CI->session->userdata['admin_session'];
    	if (isset($user_session) && count($user_session) > 0) {
    		return true;
    	}
    	return false;
    }

    /**
    * Function to check admin session
    * 
    * @return void
    */
    public function check_user_session() {
        $user_session = $this->CI->session->userdata['user_session'];
        if (isset($user_session) && count($user_session) > 0) {
            return true;
        }
        return false;
    }
}

?>