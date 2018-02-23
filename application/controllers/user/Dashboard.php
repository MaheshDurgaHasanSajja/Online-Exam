<?php

/**
 * Dashboard Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Dashboard.php
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
 * Dashboard.php
 *
 * @category Dashboard.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Dashboard extends CI_Controller {

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
        if (!($this->authorization->check_user_session())) 
            redirect('user/login');
    }

    /**
    * Function to load a dashboard page
    * 
    * @return void
    */
    public function index() {
        $this->data['title'] = "Dashboard";
        $viewContent = $this->load->view('users/dashboard', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'user');
    }

    /**
    * Function to get list of all available exams
    * 
    * @return json json_array
    */
    public function list_of_available_exams() {
        $request = $_GET;
        $result = $this->exams_model->load_list_of_available_exams($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }

    /**
    * Function to start the exam
    *
    * @return json json_data
    */
    public function terms() {
        $this->data['title'] = "Terms and Conditions";
        $exam_id = $this->uri->segment(4);
        $this->data['exam_id'] = $exam_id;
        $where_cond = array(    
            "u.id" => $this->session->userdata['user_session']['id'],
            "u.row_status" => 1,
            "e.id" => $exam_id
            );
        $user_exam_data = $this->users_model->get_user_exam_info($where_cond);
        if (count($user_exam_data) == 0) {
            $this->session->set_flashdata("errormessage", "Sorry! You are not authorized to take this exam!");
            redirect("user/dashboard");
        }

        $viewContent = $this->load->view('users/terms_conditions', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'user');
    }

    /**
    * Function to start an exam
    * 
    * @return json json_string
    */
    public function start() {
        $post_data = $_POST;
        $insert_data = array(
            "user_id" => $this->session->userdata['user_session']['id'],
            "exam_id" => $post_data['exam_id'],
            "exam_started_time" => date("Y-m-d H:i:s"),
            "created_time" => date("Y-m-d H:i:s")
            );
        $result = $this->exams_model->save_exam_time($insert_data);
        if($result) {
            $json_array = array(
                "status" => 200,
                "url" => base_url()."user/dashboard/progress/".$post_data['exam_id']
                );
            echo json_encode($json_array);
            exit;
        }
        $json_array = array(
            "status" => 500,
            "url" => ""
            );
        echo json_encode($json_array);
        exit;
    }

    /**
    * Function to load the exam view page
    *
    * @return void
    */
    public function progress() {
        $exam_id = $this->uri->segment('4');
        $this->data['exam_id'] = $exam_id;
        $viewContent = $this->load->view('users/exam_progress', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'user');
    }

    /**
    * Function to load the exam view page
    *
    * @return void
    */
    public function complete() {
        $this->data['title'] = "Completed";
        $viewContent = $this->load->view('users/exam_completed', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'user');
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
    * Function to load the completed exams view
    *
    * @return void
    */
    public function completed_exams() {
        $this->data['title'] = "Completed Exams";
        $viewContent = $this->load->view('users/completed_exams', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'user');
    }

    /**
    * Function to get all list of compelted exams
    *
    * return void
    */
    public function get_list_of_compelted_exams() {
        $request = $_GET;
        $result = $this->exams_model->load_list_of_completed_exams($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }
}
