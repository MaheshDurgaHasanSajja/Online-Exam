<?php

/**
 * Exams Model
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Exams_model.php
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
 * Exams_model.php
 *
 * @category Exams_model.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Exams_model extends CI_Model {

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
    * Function to get class information
    * 
    * @param array $where_cond
    *
    * @return void
    */
    public function get_exam_info($where_cond) {
        try {
            $query = $this->db->where($where_cond)
            ->select("*")
            ->from("exams")
            ->get();
            return $query->row_array();
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to get class information
    * 
    * @param array $where_cond
    *
    * @return void
    */
    public function all_exam_info($where_cond) {
        try {
            $query = $this->db->where($where_cond)
            ->select("*")
            ->from("exams")
            ->get();
            return $query->result_array();
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to insert class info data
    * 
    * @param array $insert_data
    *
    * @return boolean status
    */
    public function insert_exam_info($insert_data, $class_id) {
        try {
            if ($class_id != "" && $class_id != 0) {
                $where_array = array(
                    "id" => $class_id,
                    "row_status" => 1
                    );
                unset($insert_data['created_time']);
                return $this->db->where($where_array)->update("exams", $insert_data);
            }
            return $this->db->insert("exams", $insert_data);
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to update class data
    *
    * @param array $where_cond
    * @param array $update_data
    *
    * @return boolean true or false
    */
    public function update_exam_data($where_cond, $update_data) {
        try {
            $this->db->trans_begin();

            $this->db->where(array("class_id" => $where_cond['id']))
            ->update("exams", array("row_status" => 0));

            $this->db->where($where_cond)->update("exams", $update_data);

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                return false;
            }
            $this->db->trans_commit();
            return true;
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
     * Load all exams
     * 
     * @param array $request
     * @param array $user_data
     * 
     * @return array result
     */
    public function load_list_of_exams($request, $user_data = array()) {
        $sql_details = array('user' => $this->db->username, 'pass' => $this->db->password, 'db' => $this->db->database, 'host' => $this->db->hostname);
        $request['searchcolumns'] = array();

        $columns = array(
            array(
                'db' => 'exam_id',
                'dt' => 'DT_RowId',
                'formatter' => function( $d, $row ) {
                    // Technically a DOM id cannot start with an integer, so we prefix
                    // a string. This can also be useful if you have multiple tables
                    // to ensure that the id is unique with a different prefix
                    return 'row_' . $d;
                }
                ),
            array('db' => 'exam_id', 'dt' => 0,
                'formatter' => function($d, $row) {
                    return $d;
                }),
            array('db' => 'class_name', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_name', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_time_limit', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_id', 'dt' => 4,
                'formatter' => function($d, $row) {
                    $return_string = "<div class='text-center'>";
                    $return_string .= '<a  href="' . base_url() . 'admin/exams/setup/'.$row['exam_id'].'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp&nbsp;&nbsp;&nbsp;';
                    $return_string .= '<a  data-page-load="0" href="javascript:void(0);" data-href="' . base_url() . 'admin/exams/delete_exam" class="delete-individual" data-message="Are you sure?" data-desc="This will permanently delete the exam and associated questions in this class." data-table-id="list_of_exams" data-record-id=' . $row["exam_id"] . '><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    $return_string .= "</div>";
                    return $return_string;
                }),
            );

        $join = "";
        $join .= " JOIN classes c ON c.id = e.class_id and c.row_status = 1";
        $query_columns_array = array("e.id as exam_id", "exam_name", "class_name", "exam_time_limit");

        $custom_where = array(
            "e.row_status = 1"
            );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from exams as e ' . $join . $where;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

    /**
     * Load all classes
     * 
     * @param array $request
     * @param array $user_data
     * 
     * @return array result
     */
    public function load_list_of_available_exams($request, $user_data = array()) {
        $sql_details = array('user' => $this->db->username, 'pass' => $this->db->password, 'db' => $this->db->database, 'host' => $this->db->hostname);
        $request['searchcolumns'] = array();

        $columns = array(
            array(
                'db' => 'exam_id',
                'dt' => 'DT_RowId',
                'formatter' => function( $d, $row ) {
                    // Technically a DOM id cannot start with an integer, so we prefix
                    // a string. This can also be useful if you have multiple tables
                    // to ensure that the id is unique with a different prefix
                    return 'row_' . $d;
                }
                ),
            array('db' => 'exam_id', 'dt' => 0,
                'formatter' => function($d, $row) {
                    return $d;
                }),
            array('db' => 'exam_name', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_time_limit', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'class_name', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_id', 'dt' => 4,
                'formatter' => function($d, $row) {
                    $return_string = "<div class='text-center'>";
                    $return_string .= "<a class='btn btn-primary' href='javascript:void(0);'>Take Test</a>";
                    $return_string .= "</div>";
                    return $return_string;
                }),
            );

        $join = "";
        $join .= " JOIN classes c ON c.id = u.class_id and c.row_status = 1";
        $join .= " JOIN exams e ON e.class_id = c.id and e.row_status = 1 and e.id not in (select exam_id from user_exams where user_id = ".$this->session->userdata['user_session']['id'].")";
        $query_columns_array = array("u.id as user_id", "exam_name", 'e.id as exam_id', "class_name", "exam_time_limit");

        $custom_where = array(
            "u.row_status = 1",
            "u.user_type = 'P'",
            "u.id = ".$this->session->userdata['user_session']['id']
            );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from users as u ' . $join . $where;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

}
