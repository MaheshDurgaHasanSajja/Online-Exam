<?php

/**
 * Classes Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Classes.php
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
 * Classes.php
 *
 * @category Classes.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */

class Classes extends CI_Controller {
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
        $this->load->model(array('classes_model'));
        $this->load->library(array('session', 'form_validation', 'Authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
     * Function to load Classes
     * 
     * @return void
     */
    public function index() {
    	$this->data['title'] = "Classes";
        $viewContent = $this->load->view('admin/classes', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'admin');
    }

    /**
     * Function to load list of all classes
     * 
     * @return json $json_data
     */
    public function list_of_all_classes() {
        $request = $_GET;
        $result = $this->classes_model->load_list_of_classes($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }

    /**
    * Function to set up a class
    *
    * @return void
    */
    public function setup() {
        $class_id = $this->uri->segment(4);
        if (!($this->authorization->check_admin_session()))
            redirect("admin/auth");
        $this->data['title'] = "Setup Class";
        $this->data['page_type'] = "Add";
        if ($class_id != "")
            $this->data['page_type'] = "Edit";
        if ($class_id != "") {
            $where_cond = array(
                "row_status" => 1,
                "id" => $class_id
            );
            $class_data = $this->classes_model->get_class_info($where_cond);
            $this->data['class_info'] = $class_data;
        }
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if ($this->form_validation->run("setup_class") == false) {
                $viewContent = $this->load->view('admin/setup_class', $this->data, true);
                renderWithLayout(array('content' => $viewContent), 'admin');
            } else {
                $insert_data = array(
                    "class_name" => $post_data['class_name'],
                    "created_time" => date("Y-m-d H:i:s"),
                );
                $this->classes_model->insert_class_info($insert_data, $class_id);
                
                $successmessage = "Class added successfully.";
                if ($class_id != "" && $class_id != 0) 
                    $successmessage = "Class updated successfully.";
                $this->session->set_flashdata("successmessage", $successmessage);
                redirect('admin/classes');
            }
        } else {
            $viewContent = $this->load->view('admin/setup_class', $this->data, true);
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
    public function delete_class() {
        $post_data = $_POST;
        $where_cond = array(
            "id" => $post_data['id'],
        );
        $update_data = array(
            "row_status" => 0
        );
        $status = $this->classes_model->update_class_data($where_cond, $update_data);
        if ($status) {
            echo json_encode(array(
                "status" => "success",
                "message" => "Class deleted successfully."
            ));
            exit;
        }
        echo json_encode(array(
                "status" => "success",
                "message" => "Class deletion failed."
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
    public function check_name_exists_or_not($str) {
        $this->form_validation->set_message('check_name_exists_or_not', 'Name already exists.');
        $post_data = $_POST;
        $where_cond = array(
            "row_status" => 1,
            "class_name" => $post_data['class_name']
        );
        if ($post_data['page_type'] == "Edit")
            $where_cond['id != '] = $post_data['class_id'];
        $class_data = $this->classes_model->get_class_info($where_cond);
        if (count($class_data) > 0)
            return false;
        return true;
    }
}