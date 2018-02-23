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
            array('db' => 'no_of_questions', 'dt' => 4,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'registered_users', 'dt' => 5,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'no_of_users_completed', 'dt' => 6,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_id', 'dt' => 7,
                'formatter' => function($d, $row) use ($request) {
                    if ($request['user_type'] == "F") {
                        return "--";
                    } else {
                        if($row['results_status'] == 0 && $row['no_of_users_completed'] > 0)
                            return !empty($d) ? "<div class='post-result-div'><div class='loading-div'></div><button data-href='".base_url()."admin/exams/post_results' name='post_result' data-exam-id='".$row['exam_id']."' id='post_result' class='btn btn-primary post-result-button' data-completed-users='".$row['no_of_users_completed']."' data-registered-users='".$row['registered_users']."'>Post Result</button></div>" : "--";
                        else if ($row['results_status'] == 0 && empty($row['no_of_users_completed']))
                            return "Exam has not been taken by users";
                        else
                            return "Results posted";
                    }
                }),
            array('db' => 'exam_id', 'dt' => 8,
                'formatter' => function($d, $row) use ($request) {
                    if ($request['user_type'] == "F") {
                        $return_string = "<div class='text-center'>";
                        $return_string .= '<a  href="' . base_url() . 'admin/exams/setup/'.$row['exam_id'].'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp';
                        $return_string .= '<a  data-page-load="0" href="javascript:void(0);" data-href="' . base_url() . 'admin/exams/delete_exam" class="delete-individual" data-message="Are you sure?" data-desc="This will permanently delete the exam and associated questions in this class." data-table-id="list_of_exams" data-record-id=' . $row["exam_id"] . '><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                        $return_string .= "</div>";
                        return $return_string;
                    }
                    $return_string = "<div class='text-center'>";
                    $return_string .= '<a class="send-notification" href="javascript:void(0);" data-href="' . base_url() . 'admin/exams/send_notification" data-exam-id="'.$row['exam_id'].'"><i class="fa fa-bell" aria-hidden="true"></i></a>&nbsp;';
                    $return_string .= '<a  href="' . base_url() . 'admin/exams/setup/'.$row['exam_id'].'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp';
                    $return_string .= '<a  data-page-load="0" href="javascript:void(0);" data-href="' . base_url() . 'admin/exams/delete_exam" class="delete-individual" data-message="Are you sure?" data-desc="This will permanently delete the exam and associated questions in this class." data-table-id="list_of_exams" data-record-id=' . $row["exam_id"] . '><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    $return_string .= "</div>";
                    return $return_string;
                })
            );

$join = "";
$join .= " JOIN classes c ON c.id = e.class_id and c.row_status = 1";
$query_columns_array = array("e.id as exam_id", "exam_name", "class_name", "exam_time_limit", "no_of_questions", "results_status", "(select count(*) from users where row_status = 1 and class_id = c.id and user_type = '".$request['user_type']."') as registered_users", "(select count(*) from user_exams ue JOIN users u on u.id = ue.user_id and u.row_status = 1 and u.user_type = '".$request['user_type']."' where ue.row_status = 1 and ue.exam_id = e.id) as no_of_users_completed");

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
                    $return_string .= "<a class='btn btn-primary' href='".base_url()."user/dashboard/terms/".$row['exam_id']."'>Take Test</button>";
                    $return_string .= "</div>";
                    return $return_string;
                }),
            );

        $join = "";
        $join .= " JOIN classes c ON c.id = u.class_id and c.row_status = 1";
        $join .= " JOIN exams e ON e.class_id = c.id and e.row_status = 1 and e.id not in (select exam_id from user_exams where user_id = ".$this->session->userdata['user_session']['id'].") and e.no_of_questions <= (select count(id) from questions q1 where q1.exam_id = e.id and q1.row_status = 1) ";
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

    /**
    * Function to save exam time
    *
    * @param array $insert_data
    *
    * @return boolean true or false
    */
    public function save_exam_time($insert_data, $exam_id) {
        try {
            if ($exam_id != "" && $exam_id != 0) {
                $where_array = array(
                    "user_id" => $this->session->userdata['user_session']['user_id'],
                    "exam_id" => $exam_id
                    );
                unset($insert_data['created_time']);
                return $this->db->where($where_array)->update($insert_data);
            }
            return $this->db->insert("user_exams", $insert_data);
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to load a question based on exam id
    *
    * @param int $exam_id
    *
    * @return array $result_array
    */
    public function get_question_by_exam_id($exam_id) {
        try {
            return $this->db->query("SELECT q.exam_id, q.id as question_id, q.title, q.options, e.no_of_questions, (select count(id) from user_questions where user_id = ".$this->session->userdata['user_session']['id']." and exam_id = ".$exam_id." and row_status = 1) as no_of_questions_completed, 0 as flag_status FROM questions q JOIN exams e ON e.id = q.exam_id and e.row_status = 1 where q.row_status = 1 and exam_id = ".$exam_id." and q.id not in (select question_id from user_questions where row_status = 1 and user_id = ".$this->session->userdata['user_session']['id']." and exam_id = ".$exam_id.")  ORDER BY RAND() LIMIT 1")->row_array();
            
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to save a question answer
    *
    * @param int $insert_data
    *
    * @return boolean true or false
    */
    public function insert_user_questions_data($insert_data) {
        try {
            $where_array = array(
                "user_id" => $insert_data['user_id'],
                "exam_id" => $insert_data['exam_id'],
                "question_id" => $insert_data['question_id'],
                "row_status" => 1
                );
            $count = $this->db->where($where_array)
            ->select("*")
            ->from("user_questions")
            ->get()
            ->num_rows();
            if ($count > 0) {
                $update_data = array(
                    "user_answer" => $insert_data['user_answer']
                    );
                return $this->db->where($where_array)->update("user_questions", $update_data);
            }
            else            
                return $this->db->insert("user_questions", $insert_data);
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to load previous question
    *
    * @param int $exam_id
    * @param int $question_no
    *
    * @return array
    */
    public function load_prev_question_info($exam_id, $question_no) {
        try {
            $where_array = array(
                "uq.user_id" => $this->session->userdata['user_session']['id'],
                "uq.exam_id" => $exam_id,
                "uq.question_no" => $question_no-1,
                "uq.row_status" => 1
                );
            return $this->db->where($where_array)
            ->select("uq.user_answer, q.exam_id, q.id as question_id, q.title, q.options, e.no_of_questions, (select count(id) from user_questions where user_id = ".$this->session->userdata['user_session']['id']." and exam_id = ".$exam_id." and row_status = 1) as no_of_questions_completed, uq.question_no, 0 as flag_status")
            ->from("user_questions uq")
            ->join("questions q", "q.id = uq.question_id and q.row_status = 1")
            ->join("exams e", "e.id = uq.exam_id and e.row_status = 1")
            ->get()
            ->row_array();
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to load next question
    *
    * @param int $exam_id
    * @param int $question_no
    *
    * @return array
    */
    public function load_next_question_info($exam_id, $question_no) {
        try {
            $where_array = array(
                "uq.user_id" => $this->session->userdata['user_session']['id'],
                "uq.exam_id" => $exam_id,
                "uq.question_no" => $question_no+1,
                "uq.row_status" => 1
                );
            $count = $this->db->where($where_array)
            ->select("*")
            ->from("user_questions uq")
            ->get()
            ->num_rows();
            if ($count == 0) {
                unset($where_array['uq.question_no']);
                return $this->db->where($where_array)
                ->select("count(id) as no_of_questions_completed, max(uq.question_no) as question_no, 1 as flag_status")
                ->from("user_questions uq")
                ->get()
                ->row_array();
            }
            return $this->db->where($where_array)
            ->select("uq.user_answer, q.exam_id, q.id as question_id, q.title, q.options, e.no_of_questions, (select count(id) from user_questions where user_id = ".$this->session->userdata['user_session']['id']." and exam_id = ".$exam_id." and row_status = 1) as no_of_questions_completed, uq.question_no, 0 as flag_status")
            ->from("user_questions uq")
            ->join("questions q", "q.id = uq.question_id and q.row_status = 1")
            ->join("exams e", "e.id = uq.exam_id and e.row_status = 1")
            ->get()
            ->row_array();
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to save exam end time
    *
    * @param int $exam_id
    *
    * @return int 0 or 1
    */
    public function save_exam_end_time($exam_id) {
        try {
            $where_array = array(
                "exam_id" => $exam_id,
                "user_id" => $this->session->userdata['user_session']['id'],
                "row_status" => 1
                );
            $update_data = array(
                "exam_ended_time" => date("Y-m-d H:i:s")
                );
            return $this->db->where($where_array)->update("user_exams", $update_data);
        } catch(Exception $e) {
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
    public function load_list_of_completed_exams($request, $user_data = array()) {
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
                }),
            array('db' => 'exam_id', 'dt' => 0,
                'formatter' => function($d, $row) {
                    return $d;
                }),
            array('db' => 'exam_name', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_started_time', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? date("Y-m-d", strtotime($d)) : "--";
                }),
            array('db' => 'marks', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "Not yet declared";
                }),
            array('db' => 'total_marks', 'dt' => 4,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "Not yet declared";
                }),
            array('db' => 'user_rank', 'dt' => 5,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "Not yet declared";
                })
            );

        $join = "";
        $join .= " JOIN exams e ON e.id = ue.exam_id and ue.row_status = 1";
        $join .= " LEFT JOIN user_exam_results uer ON uer.exam_id = ue.exam_id and uer.user_id =  ".$this->session->userdata['user_session']['id'];
        $query_columns_array = array("e.id as exam_id", "exam_name", "exam_started_time", "marks", "total_marks",
            "(select FIND_IN_SET(marks, (SELECT GROUP_CONCAT(marks ORDER BY marks DESC) FROM user_exam_results u1 join users u on u.id = u1.user_id and u.row_status = 1 and u.user_type ='P' where u1.row_status=1)) AS rank from user_exam_results u2 join users u3 on u3.id = u2.user_id and u3.row_status = 1 and u3.user_type ='P' where u2.row_status = 1 and u2.user_id = uer.user_id) as user_rank");

        $custom_where = array(
            "ue.row_status = 1",
            "ue.user_id = ".$this->session->userdata['user_session']['id']
            );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from user_exams as ue ' . $join . $where;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

    /**
    * Function to get the exam result information by exam id
    *
    * @param int $exam_id
    *
    * @return array
    */
    public function get_exam_result_by_id($exam_id) {
        try {
            $where_array = array(
                "uq.exam_id" => $exam_id,
                "uq.row_status" => 1,
                "uq.user_id not in (select user_id from user_exam_results uer where uer.exam_id = ".$exam_id.")" => NULL
                );
            return $this->db->where($where_array)
            ->select("uq.user_id, SUM(q.marks) as user_gained_marks, (select SUM(marks) from questions where row_status = 1 and exam_id = ".$exam_id.") as total_marks")
            ->from("user_questions uq")
            ->join("questions q", "q.id = uq.question_id and q.row_status = 1 and q.answer = uq.user_answer")
            ->group_by("uq.user_id")
            ->get()
            ->result_array();
        } catch(Exception $e) {
            return false;
        }
    }

    /**
    * Function to save user exam result
    *
    * @param array $insert_data
    * @param int $exam_id
    *
    * @return array
    */
    public function insert_user_exam_results($insert_data , $exam_id, $flag) {
        try {
            $this->db->trans_begin();

            $this->db->insert_batch("user_exam_results", $insert_data);

            if ($flag == 1) {
                $this->db->where(array("id" => $exam_id, "row_status" => 1));
                $this->db->update("exams", array("results_status" => 1));
            }

            if ($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                return false;
            }
            $this->db->trans_commit();
            return true;
        } catch(Exception $e) {
            $this->db->trans_rollback();
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
    public function load_list_of_exam_reports_data($request, $user_data = array()) {
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
            array('db' => 'user_name', 'dt' => 1,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'exam_name', 'dt' => 2,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'marks', 'dt' => 3,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'total_marks', 'dt' => 4,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                }),
            array('db' => 'user_rank', 'dt' => 5,
                'formatter' => function($d, $row) {
                    return !empty($d) ? $d : "--";
                })
            );

        $join = "";
        $join .= " JOIN exams e ON e.id = uer.exam_id and e.row_status = 1";
        $join .= " JOIN users u ON u.id = uer.user_id and u.row_status = 1 and u.user_type = '".$request['user_type']."'";
        $query_columns_array = array("uer.id", "uer.marks", "uer.total_marks", "exam_name", "u.name as user_name",
            "(select FIND_IN_SET(marks, (SELECT GROUP_CONCAT(marks ORDER BY marks DESC) FROM user_exam_results u1 join users u on u.id = u1.user_id and u.row_status = 1 and u.user_type ='".$request['user_type']."' where u1.row_status=1 and u1.exam_id = ".$request['exam_id'].")) AS rank from user_exam_results u2 join users u3 on u3.id = u2.user_id and u3.row_status = 1 and u3.user_type ='".$request['user_type']."' where u2.row_status = 1 and u2.user_id = uer.user_id) as user_rank"
            );

        $custom_where = array(
            "uer.row_status = 1",
            "uer.exam_id = ".$request['exam_id'],
            );

        $where = " WHERE ";
        $where .= (count($custom_where) > 0) ? implode(" AND ", array_unique($custom_where)) : '';
        $query_columns = implode(",", array_unique($query_columns_array));
        $sql_query = 'SELECT $query_columns from user_exam_results as uer ' . $join . $where;
        $result = datatable::simple($request, $sql_details, $sql_query, $query_columns, $columns);
        return $result;
    }

    /**
    * Function to export the exam report of users data
    * 
    * @param array $request
    */
    public function export_exam_report($exam_id, $user_type = "P") {
        try {
            return $this->db->query("SELECT uer.id, u.name as user_name, exam_name, uer.marks, uer.total_marks, (select FIND_IN_SET(marks, (SELECT GROUP_CONCAT(marks ORDER BY marks DESC) FROM user_exam_results u1 join users u on u.id = u1.user_id and u.row_status = 1 and u.user_type ='".$user_type."' where u1.row_status=1 and u1.exam_id = ".$exam_id.")) AS rank from user_exam_results u2 join users u3 on u3.id = u2.user_id and u3.row_status = 1 and u3.user_type ='".$user_type."' where u2.row_status = 1 and u2.user_id = uer.user_id) as rank from user_exam_results as uer JOIN exams e ON e.id = uer.exam_id and e.row_status = 1 JOIN users u ON u.id = uer.user_id and u.row_status = 1 and u.user_type = '".$user_type."' WHERE uer.row_status = 1 AND uer.exam_id = ".$exam_id." ORDER BY marks DESC");
        } catch(Exception $e) {
            return false;
        }
    }
}
