<?php

/**
 * Exams Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Exams.php
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
 * Exams.php
 *
 * @category Exams.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */

class Exams extends CI_Controller {
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
        $this->load->model(array('exams_model', 'classes_model'));
        $this->load->library(array('session', 'form_validation', 'Authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
     * Function to load exams
     * 
     * @return void
     */
    public function index() {
    	$this->data['title'] = "Exams";
        $viewContent = $this->load->view('admin/exams', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'admin');
    }

    /**
     * Function to load list of all exams
     * 
     * @return json $json_data
     */
    public function list_of_all_exams() {
        $request = $_GET;
        $result = $this->exams_model->load_list_of_exams($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }

    /**
    * Function to set up a exam
    *
    * @return void
    */
    public function setup() {
        $exam_id = $this->uri->segment(4);
        if (!($this->authorization->check_admin_session()))
            redirect("admin/auth");
        $this->data['title'] = "Setup Exam";
        $this->data['page_type'] = "Add";
        if ($exam_id != "")
            $this->data['page_type'] = "Edit";
        $where_cond = array("row_status" => 1);
        $this->data['class_info'] = $this->classes_model->all_class_info($where_cond);
        if ($exam_id != "") {
            $where_cond = array(
                "row_status" => 1,
                "id" => $exam_id
            );
            $exam_data = $this->exams_model->get_exam_info($where_cond);
            $this->data['exam_info'] = $exam_data;
        }
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if ($this->form_validation->run("setup_exam") == false) {
                $viewContent = $this->load->view('admin/setup_exam', $this->data, true);
                renderWithLayout(array('content' => $viewContent), 'admin');
            } else {
                $insert_data = array(
                    "exam_name" => $post_data['exam_name'],
                    "class_id" => $post_data['class_id'],
                    "exam_time_limit" => $post_data['exam_time_limit'],
                    "created_time" => date("Y-m-d H:i:s")
                );
                $this->exams_model->insert_exam_info($insert_data, $exam_id);
                
                $successmessage = "Exam added successfully.";
                if ($exam_id != "" && $exam_id != 0) 
                    $successmessage = "Exam updated successfully.";
                $this->session->set_flashdata("successmessage", $successmessage);
                redirect('admin/exams');
            }
        } else {
            $viewContent = $this->load->view('admin/setup_exam', $this->data, true);
            renderWithLayout(array('content' => $viewContent), 'admin');
        }
    }

    /**
    * Function to delete a exam
    *
    * @param int $exam_id
    *
    * @return json $json_string
    */
    public function delete_exam() {
        $post_data = $_POST;
        $where_cond = array(
            "id" => $post_data['id'],
        );
        $update_data = array(
            "row_status" => 0
        );
        $status = $this->exams_model->update_exam_data($where_cond, $update_data);
        if ($status) {
            echo json_encode(array(
                "status" => "success",
                "message" => "Exam deleted successfully."
            ));
            exit;
        }
        echo json_encode(array(
                "status" => "success",
                "message" => "Exam deletion failed."
            ));
            exit;
    }

    /**
    * Function to check wehter exam name is exists or not
    *
    * @param string $str
    *
    * @return boolean true or false
    */
    public function check_name_exists_or_not($str) {
        $this->form_validation->set_message('check_name_exists_or_not', 'Name already exists.');
        $post_data = $_POST;
        $where_cond = array(
            "row_status" => 1,
            "exam_name" => $post_data['exam_name'],
            "class_id" => $post_data['class_id']
        );
        if ($post_data['page_type'] == "Edit")
            $where_cond['id != '] = $post_data['exam_id'];
        $exam_data = $this->exams_model->get_exam_info($where_cond);
        if (count($exam_data) > 0)
            return false;
        return true;
    }
}