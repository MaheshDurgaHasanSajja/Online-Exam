<?php

/**
 * Home Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Home.php
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
 * Home.php
 *
 * @category Home.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Home extends CI_Controller {
	public $data = "";

    /**
     * Construct
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *    or MissingViewException in debug mode.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('exams_model', 'classes_model', 'auth_model', 'users_model'));
        $this->load->library(array('session', 'form_validation', 'authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
    * FUnction to load home page
    *
    * @return void
    */
    public function index() {
    	$this->data['title'] = "Home";
    	$this->load->view("home.php", $this->data);
    }

    /**
    * Function to start a free test
    * 
    * @return void
    */
    public function freetest() {
        $this->data['title'] = "Free Test";
        $where_cond = array(
            "row_status" => 1
            );
        $this->data['class_info'] = $this->classes_model->all_class_info($where_cond);
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if ($this->form_validation->run("free_register_form") == false) {
                $this->load->view("freetest", $this->data);    
            } else {
                $insert_data = array(
                        "name" => $post_data['name'],
                        "email" => (isset($post_data['email']) && $post_data['email'] != "")?$post_data['email']:"",
                        "phone_number" => $post_data['phone_number'],
                        "class_id" => $post_data['class_id'],
                        "user_type" => "F",
                        "gender" => $post_data['gender'],
                        "created_time" => date("Y-m-d H:i:s")
                    );
                $result = $this->auth_model->create_user($insert_data);
                $user_id = $this->db->insert_id();
                $this->session->set_userdata("user_session", array("id" => $user_id));
                if ($result)
                    redirect("home/start/".my_simple_crypt($user_id, "e")."/".my_simple_crypt($post_data['class_id'], "e"));
                else
                    redirect("home");
            }
        } else {
            $this->load->view("freetest", $this->data);
        }
    }

    /**
    * Function to start an exam
    * 
    * @return json json_string
    */
    public function start() {
        $where_array = array(
                "class_id" => my_simple_crypt($this->uri->segment(4), "d"),
                "row_status" => 1
            );
        $exam_info = $this->exams_model->get_exam_info($where_array);
        $insert_data = array(
            "user_id" => my_simple_crypt($this->uri->segment(3), "d"),
            "exam_id" => $exam_info['id'],
            "exam_started_time" => date("Y-m-d H:i:s"),
            "created_time" => date("Y-m-d H:i:s")
            );
        $result = $this->exams_model->save_exam_time($insert_data);
        if($result) 
            redirect("home/freeexam/".$exam_info['id']);
        else
            redirect("home");
    }

    public function freeexam() {
        $exam_id = $this->uri->segment(3);
        $this->data['exam_id'] = $exam_id;
        $this->load->view("free_exam_progress.php", $this->data);
    }

    public function complete() {
        $exam_id = $this->uri->segment(3);
        $this->data['exam_id'] = $exam_id;
        $this->load->view("exam_completed", $this->data);
    }

    /**
    * Function to get user info
    * 
    * @return json
    */
    function get_user_exam_info() {
        $post_data = $_GET;
        $user_exam_data = $this->users_model->get_user_exam_data($post_data['exam_id']);
        $to_time = strtotime(date('Y-m-d H:i:s'));
        $from_time = strtotime($user_exam_data['exam_started_time']);
        $user_exam_data['exam_time_limit'] = $user_exam_data['exam_time_limit'] - round(abs($to_time - $from_time) / 60);
        echo json_encode($user_exam_data);
        exit;
    }

    /**
    * Function to load the question
    *
    * @return string $html_string
    */
    public function load_question() {
        $post_data = $_POST;
        $exam_id = $post_data['exam_id'];
        $result = $this->exams_model->get_question_by_exam_id($exam_id);
        if($result) {
            $result['options'] = json_decode($result['options']);
            $return_array = array(
                "status" => 200,
                "data" => $result
                );
            echo json_encode($return_array);
            exit;
        }
        $return_array = array(
            "status" => 500,
            "data" => ""
            );
        echo json_encode($return_array);
        exit;
    }

    /**
    * Function to load previous question
    *
    * @return json
    */
    public function load_prev_question() {
        $post_data = $_GET;
        $exam_id = $post_data['exam_id'];
        $question_no = $post_data['question_no'];
        $result = $this->exams_model->load_prev_question_info($exam_id, $question_no);
        if($result) {
            $result['options'] = json_decode($result['options']);
            $return_array = array(
                "status" => 200,
                "data" => $result
                );
            echo json_encode($return_array);
            exit;
        }
        $return_array = array(
            "status" => 500,
            "data" => ""
            );
        echo json_encode($return_array);
        exit;
    }

    /**
    * Function to load next question
    *
    * @return json
    */
    public function load_next_question() {
        $post_data = $_GET;
        $exam_id = $post_data['exam_id'];
        $question_no = $post_data['question_no'];
        $result = $this->exams_model->load_next_question_info($exam_id, $question_no);
        if($result) {
            if (isset($result['options']) && $result['options'] != "")
                $result['options'] = json_decode($result['options']);
            $return_array = array(
                "status" => 200,
                "data" => $result
                );
            echo json_encode($return_array);
            exit;
        }
        $return_array = array(
            "status" => 500,
            "data" => ""
            );
        echo json_encode($return_array);
        exit;
    }

    /**
    * Function to save user answer
    * 
    *
    * @return json 
    */
    public function save_user_answer() {
        $post_data = $_POST;
        $insert_data = array(
            "user_id" => $this->session->userdata['user_session']['id'],
            "exam_id" => $post_data['exam_id'],
            "question_id" => $post_data['question_id'],
            "question_no" => $post_data['question_no'],
            "user_answer" => $post_data['answer'],
            "created_time" => date("Y-m-d H:i:s")
            );
        $result = $this->exams_model->insert_user_questions_data($insert_data);
        if ($result) {
            if ($post_data['flag'] == 1) {
                $this->exams_model->save_exam_end_time($insert_data['exam_id']);
            }
            echo json_encode(
                array("status" => 200, "msg" => "success")
                );
            exit;
        }
        echo json_encode(
            array("status" => 500, "msg" => "failed")
            );
        exit;
    }
}