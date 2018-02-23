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
        if (isset($user_session) && count($user_session) > 0 && isset($user_session['name']) && $user_session['name'] != "") {
            return true;
        }
        return false;
    }

    /**
     * Generate CSV from a query result object
     *
     * @access  public
     * @param   object  The query result object
     * @param   string  The delimiter - comma by default
     * @param   string  The newline character - \n by default
     * @param   string  The enclosure - double quote by default
     * @return  string
     */
    public function query_to_csv($query, $delim = ",", $newline = "\n", $enclosure = '"') {
        if (!is_object($query) OR ! method_exists($query, 'list_fields')) {
            show_error('You must submit a valid result object');
        }

        $out = '';
        $column_names = $query->list_fields();
        $CI = &get_instance();

        
        // First generate the headings from the table column names
        foreach ($column_names as $name) {
            $name = ucwords(str_replace("_", " ", $name));
            $out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $name) . $enclosure . $delim;
        }

        $out = rtrim($out);
        $out .= $newline;

        // Next blast through the result array and build out the rows
        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $item) {
                $out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $item) . $enclosure . $delim;
            }
            $out = rtrim($out);
            $out .= $newline;
        }
        return $out;
    }

    /**
     * Force Download
     *
     * Generates headers that force a download to happen
     *
     * @access  private
     * @param   string  filename
     * @param   mixed   the data to be downloaded
     * @return  void
     */
    public function force_download($filename = '', $data = '') {
        if ($filename == '' OR $data == '') {
            return FALSE;
        }

        // Try to determine if the filename includes a file extension.
        // We need it in order to set the MIME type
        if (FALSE === strpos($filename, '.')) {
            return FALSE;
        }

        // Grab the file extension
        $x = explode('.', $filename);
        $extension = end($x);

        // Load the mime types
        if (defined('ENVIRONMENT') AND is_file(APPPATH . 'config/' . ENVIRONMENT . '/mimes.php')) {
            include(APPPATH . 'config/' . ENVIRONMENT . '/mimes.php');
        } elseif (is_file(APPPATH . 'config/mimes.php')) {
            include(APPPATH . 'config/mimes.php');
        }

        // Set a default mime if we can't find it
        if (!isset($mimes[$extension])) {
            $mime = 'application/octet-stream';
        } else {
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }

        // Generate the server headers
        if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE) {
            header('Content-Type: "' . $mime . '"');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Content-Transfer-Encoding: binary");
            header('Pragma: public');
            header("Content-Length: " . strlen($data));
        } else {
            header('Content-Type: "' . $mime . '"');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            header("Content-Length: " . strlen($data));
        }

        exit($data);
    }
}

?>