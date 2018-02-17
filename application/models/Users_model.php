<?php

/**
 * Users Model
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Users_model.php
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
 * Users_model.php
 *
 * @category Users_model.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Users_model extends CI_Model {

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
    * @param array $cond
    * @param array $insert_data
    *
    * @return boolean true or false
    */
    public function update_user($cond, $update_data) {
        try {
            return $this->db->where($cond)->update("users", $update_data);
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__error_message());
        }
           
    }

    /**
     * Load all classes
     * 
     * @param array $request
     * @param array $user_data
     * 
     * @return array result
     */
    public function get_list_of_users_data($request, $user_data = array()) {
        $sql_details = array('user' => $this->db->username, 'pass' => $this->db->password, 'db' => $this->db->database, 'host' => $this->db->hostname);
        $request['searchcolumns'] = array();

        $columns = array(
            array(
                'db' => 'id',
                'dt' => 'DT_RowId',
                'formatter' => function( $d, $row ) {
                    // Technically a DOM id cannot start with an integer, so we prefix
                    // a string. This can also be useful if you have multiple tables
                    // to ensure that the id is unique with a different prefix
                    return 'row_' . $d;
                }
            ),
            array('db' => 'id', 'dt' => 0,
                'formatter' => function($d, $row) {
                    return $d;
                }),
            array('db' => 'name', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'email', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'phone_number', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'gender', 'dt' => 4,
                'formatter' => function($d, $row) {
                    return !empty($d) ? ($d == "M")?"Male":"Female" : "--";
                }),
            array('db' => 'address', 'dt' => 5,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'class_name', 'dt' => 6,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'id', 'dt' => 7,
                'formatter' => function($d, $row) {
                    $return_string = "<div class='text-center'>";
                    $return_string .= '<a  data-page-load="0" href="javascript:void(0);" data-href="' . base_url() . 'admin/users/delete_user" class="delete-individual" data-message="Are you sure?" data-desc="This will permanently delete the user" data-table-id="list_of_users" data-record-id=' . $row["id"] . '><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    $return_string .= "</div>";
                    return $return_string;
                }),
        );

        $join = "";
        $join .= "JOIN classes a ON a.id = c.class_id AND a.row_status = 1";
        $query_columns_array = array("c.id", "c.name", "email", "gender", "address", "phone_number", "class_id","a.class_name as class_name");

        $custom_where = array(
            "c.row_status = 1"
        );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from users as c ' . $join . $where . $having;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

}
