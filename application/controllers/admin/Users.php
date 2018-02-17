<?php

/**
 * Users Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Users.php
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
 * Users.php
 *
 * @category Users.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */

class Users extends CI_Controller {
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
        $this->load->model(array('users_model'));
        $this->load->library(array('session', 'form_validation', 'Authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
     * Function to load users
     * 
     * @return void
     */
    public function index() {
    	$this->data['title'] = "Users";
        $viewContent = $this->load->view('admin/users', $this->data, true);
        renderWithLayout(array('content' => $viewContent), 'admin');
    }

    /**
    * Function to get list of users
    *
    * @return void
    */
    public function get_list_of_users() {
        $request = $_GET;
        $result = $this->users_model->get_list_of_users_data($request, array());
        $result = getUtfData($result);
        echo json_encode($result);
        exit;
    }

    /**
    * Function to delete a class
    *
    * @param int $class_id
    *
    * @return json $json_string
    */
    public function delete_user() {
        $post_data = $_POST;
        $where_cond = array(
            "id" => $post_data['id'],
        );
        $update_data = array(
            "row_status" => 0
        );
        $status = $this->users_model->update_user($where_cond, $update_data);
        if ($status) {
            echo json_encode(array(
                "status" => "success",
                "message" => "User deleted successfully."
            ));
            exit;
        }
        echo json_encode(array(
                "status" => "success",
                "message" => "User deletion failed."
            ));
            exit;
    }
}