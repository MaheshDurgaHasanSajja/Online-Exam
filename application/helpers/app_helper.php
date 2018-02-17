<?php

/**
 * App helper
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    app_helper.php
 * @package     Helpers
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */

/**
 * Function to load the view with template
 * @param type $contentArray
 * @param type $layout
 */
function renderWithLayout($contentArray, $layout = 'app') {
    if (!$layout) {
        die('$layout argument missing!');
    }
    $instance = & get_instance();
    $instance->load->view('layouts/' . $layout, $contentArray);
}

/**
 * Function to get current date based on timezone
 * @param string offset of user timezone
 * @return date current time based on user timezone
 */
function getUtfData($result) {
    array_walk_recursive($result, function (&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });

    return $result;
}

/**
 * Returns Password hash of a string
 *
 * @param string $string 
 *
 * @return unique string $hash hashed value of string 
 */
function getPasswordHash($string) {
    $hash = password_hash($string, PASSWORD_DEFAULT);
    return $hash;
}

/**
 * Method to verify password 
 *
 * @param string $password_string
 * @param string $hash_value 
 *
 * @return boolean $value holds true or false based on password verification 
 */
function verifyPassword($password_string, $hash_value) {
    $value = false;


    if (password_verify($password_string, $hash_value)) {
        $value = true;
    } else {
        $value = false;
    }

    return $value;
}

/**
 * getBrowser
 * @global type $user_agent
 * @return string
 */
function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

/**
 * getOS
 * @global type $user_agent
 * @return string
 */
function getOS() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];


    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/ubuntu/i' => 'Ubuntu',
        '/linux/i' => 'Linux',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
            break;
        }
    }

    return $os_platform;
}