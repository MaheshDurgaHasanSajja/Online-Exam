<?php

/**
 * Auth Model
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Auth_model.php
 * @package     Models
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 * @functions   01
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth_model.php
 *
 * @category Auth_model.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Auth_model extends CI_Model {

    /**
     * Construct
     * @return void
     * @throws NotFoundException When the view file could not be found
     *    or MissingViewException in debug mode.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
    * Function to create user
    *
    * @param array $insert_data
    *
    * @return boolean true or false
    */
    public function create_user($insert_data, $user_id) {
        try {
            if ($user_id != "" && $user_id != 0) {
                $where_array = array(
                    "id" => $user_id,
                    "row_status" => 1
                    );
                unset($insert_data['created_time'], $insert_data['password']);
                return $this->db->where($where_array)->update("users", $insert_data);
            }
            return $this->db->insert("users", $insert_data);
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__error_message());
        }
           
    }

    /**
    * Function to get all the user information
    *
    * @param array $where_cond
    *
    * @return array $result_array
    */
    public function get_user_info($where_cond) {
        try {
            $query = $this->db->where($where_cond)
                            ->select("*")
                            ->from("users")
                            ->get();
                return $query->row_array();
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__error_message());
            return false;
        }
    }

    /**
    * Function to insert data in user sessions table
    * 
    * @param array $insert_data
    *
    * @return boolean true or false
    */
    public function insert_user_session_data($insert_data) {
        try {
            $this->db->trans_begin();

            $this->db->insert("user_sessions", $insert_data);
            $last_id = $this->db->insert_id();

            $where_array = array(
                "id" => $insert_data['user_id'],
                "row_status" => 1
            );
            $update_data = array(
                "user_session_id" => $last_id
            );
            $this->db->where($where_array)->update("users", $update_data);

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                return false;
            }
            $this->db->trans_commit();
            return true;
        } catch(Exception $e) {
            $this->db->trans_rollback();
            log_message("Error: ".$this->db->__error_message());
            return false;
        }
    }

}
