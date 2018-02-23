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

function my_simple_crypt($string, $action = 'e') {
    // you may change these values to your own
    $secret_key = 'e6653209341d14df5423914bdb834fcd';
    $secret_iv = '11979ce01cb1dac2667bfe1c7a540f36';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
    }
