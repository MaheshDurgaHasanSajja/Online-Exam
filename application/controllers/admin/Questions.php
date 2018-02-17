<?php

/**
 * Questions Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Questions.php
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
 * Questions.php
 *
 * @category Questions.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */

class Questions extends CI_Controller {
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
        $this->load->model(array('questions_model', 'classes_model', 'exams_model'));
        $this->load->library(array('session', 'form_validation', 'Authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
    * Function to load questions table
    *
    * @return void
    */
    public function index() {
        $this->data['title'] = "Questions";
        $where_cond = array(
            "row_status" => 1
            );
        $this->data['exam_info'] = $this->exams_model->all_exam_info($where_cond);
        $viewContent = $this->load->view('admin/questions', $this->data, true);
        renderWithlayout(array("content" => $viewContent), 'admin');
    }

    /**
    * Function to get list of all questions
    * 
    * @return json json_string
    */
    public function list_of_all_questions() {
        $request = $_GET;
        $result = $this->questions_model->get_list_of_questions($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }

    /**
    * Function to set up a question
    *
    * @return void
    */
    public function setup() {
        $question_id = $this->uri->segment(4);
        if (!($this->authorization->check_admin_session()))
            redirect("admin/auth");
        $this->data['title'] = "Setup Question";
        $this->data['page_type'] = "Add";
        if ($question_id != "")
            $this->data['page_type'] = "Edit";
        if ($question_id != "") {
            $where_cond = array(
                "row_status" => 1,
                "id" => $question_id
                );
            $question_data = $this->questions_model->get_question_info($where_cond);
            $this->data['question_info'] = $question_data;
        }
        $where_cond = array(
            "row_status" => 1
            );
        $this->data['exam_info'] = $this->exams_model->all_exam_info($where_cond);
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if ($this->form_validation->run("setup_question") == false) {
                $this->data['question_info']['options'] = json_encode($_POST['options']);
                $viewContent = $this->load->view('admin/setup_question', $this->data, true);
                renderWithLayout(array('content' => $viewContent), 'admin');
            } else {
                $insert_data = array(
                    "exam_id" => $post_data['exam_id'],
                    "title" => $post_data['title'],
                    "options" => json_encode($post_data['options']),
                    "answer" => $post_data['answer'],
                    "marks" => $post_data['marks'],
                    "created_time" => date("Y-m-d H:i:s"),
                    );
                $this->questions_model->insert_question_data($insert_data, $question_id);
                $successmessage = "Question added successfully.";
                if ($question_id != "" && $question_id != 0) 
                    $successmessage = "Question updated successfully.";
                $this->session->set_flashdata("successmessage", $successmessage);
                redirect('admin/questions');
            }
        } else {
            $viewContent = $this->load->view('admin/setup_question', $this->data, true);
            renderWithLayout(array('content' => $viewContent), 'admin');
        }
    }

    /**
    * Function to delete a class
    *
    * @param int $class_id
    *
    * @return json $json_string
    */
    public function delete_question() {
        $post_data = $_POST;
        $where_cond = array(
            "id" => $post_data['id'],
            );
        $update_data = array(
            "row_status" => 0
            );
        $status = $this->questions_model->update_question_data($where_cond, $update_data);
        if ($status) {
            echo json_encode(array(
                "status" => "success",
                "message" => "Question deleted successfully."
                ));
            exit;
        }
        echo json_encode(array(
            "status" => "success",
            "message" => "Question deletion failed."
            ));
        exit;
    }

    /**
    * Function to check wehter class name is exists or not
    *
    * @param string $str
    *
    * @return boolean true or false
    */
    public function check_title_exists_or_not($str) {
        $this->form_validation->set_message('check_title_exists_or_not', 'Question already exists.');
        $post_data = $_POST;
        $where_cond = array(
            "row_status" => 1,
            "title" => $post_data['title'],
            "exam_id" => $post_data['exam_id']
            );
        if ($post_data['page_type'] == "Edit")
            $where_cond['id != '] = $post_data['question_id'];
        $question_data = $this->questions_model->get_question_info($where_cond);
        if (count($question_data) > 0)
            return false;
        return true;
    }

    /**
    * Function to check wehter answer is valid or not
    *
    * @param string $str
    *
    * @return boolean true or false
    */
    public function check_valid_answer($str) {
        $this->form_validation->set_message('check_valid_answer', 'Answer is beyond the limit of options.');
        $post_data = $_POST;
        $count_of_options = count($post_data['options']);
        if ($post_data['answer'] > $count_of_options)
            return false;
        return true;
    }
}