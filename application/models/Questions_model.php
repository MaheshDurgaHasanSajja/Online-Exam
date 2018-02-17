<?php

/**
 * Questions Model
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Questions_model.php
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
 * Questions_model.php
 *
 * @category Questions_model.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Questions_model extends CI_Model {

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
    * Function to get question information
    * 
    * @param array $where_cond
    *
    * @return void
    */
    public function get_question_info($where_cond) {
        try {
            $query = $this->db->where($where_cond)
            ->select("*")
            ->from("questions")
            ->get();
            return $query->row_array();
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to get question information
    * 
    * @param array $where_cond
    *
    * @return void
    */
    public function all_question_info($where_cond) {
        try {
            $query = $this->db->where($where_cond)
            ->select("*")
            ->from("questions")
            ->get();
            return $query->result_array();
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to insert question info data
    * 
    * @param array $insert_data
    * @param int $question_id
    *
    * @return boolean status
    */
    public function insert_question_data($insert_data, $question_id) {
        try {
            if ($question_id != "" && $question_id != 0) {
                $where_array = array(
                    "id" => $question_id,
                    "row_status" => 1
                    );
                unset($insert_data['created_time']);
                return $this->db->where($where_array)->update("questions", $insert_data);
            }
            return $this->db->insert("questions", $insert_data);
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
        }
    }

    /**
    * Function to update question data
    *
    * @param array $where_cond
    * @param array $update_data
    *
    * @return boolean true or false
    */
    public function update_question_data($where_cond, $update_data) {
        try {
            return $this->db->where($where_cond)->update("questions", $update_data);
        } catch(Exception $e) {
            log_message("Error: ".$this->db->__erro_message());
            return false;
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
    public function get_list_of_questions($request, $user_data = array()) {
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
            array('db' => 'title', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'class_name', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_name', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'id', 'dt' => 4,
                'formatter' => function($d, $row) {
                    $return_string = "<div class='text-center'>";
                    $return_string .= '<a  href="' . base_url() . 'admin/questions/setup/'.$row['id'].'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp&nbsp;&nbsp;&nbsp;';
                    $return_string .= '<a  data-page-load="0" href="javascript:void(0);" data-href="' . base_url() . 'admin/questions/delete_question" class="delete-individual" data-message="Are you sure?" data-desc="This will permanently delete the question." data-table-id="list_of_questions" data-record-id=' . $row["id"] . '><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    $return_string .= "</div>";
                    return $return_string;
                }),
            );

        $join = "";
        $join .= "JOIN exams e ON e.id = q.exam_id AND e.row_status = 1 ";
        $join .= "JOIN classes a ON a.id = e.class_id AND a.row_status = 1 ";
        
        $query_columns_array = array("q.id", "q.title", "q.exam_id", "class_name", "exam_name");

        $custom_where = array(
            "q.row_status = 1",
            "q.exam_id = ".$request['exam_id']
            );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from questions as q ' . $join . $where . $having;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

}
