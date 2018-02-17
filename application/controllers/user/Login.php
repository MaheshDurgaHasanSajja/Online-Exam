<?php

/**
 * Login Controller
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Login.php
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
 * Login.php
 *
 * @category Login.php
 * @package  Controllers
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
class Login extends CI_Controller {

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
        $this->load->model(array('auth_model', 'classes_model'));
        $this->load->library(array('session', 'form_validation', 'authorization'));
        $this->load->helper(array('datatable'));
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }

    /**
    * Function to load the login page
    *
    * @return void
    */
    public function index() {
        if (isset($this->session->userdata['user_session']) && count($this->session->userdata['user_session']) > 0) {
            redirect('user/dashboard');
        }
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if($this->form_validation->run('login_form') == false){
                $this->load->view("users/login.php");
            } else {
                $post_data['email'] = strtolower($post_data['email']);
                $where_cond = array(
                    "email" => $post_data['email'],
                    "row_status" => 1,
                    "user_type" => "P"
                    );
                $user_data = $this->auth_model->get_user_info($where_cond);
                if (count($user_data) > 0) {
                    $this->session->set_userdata("user_session", $user_data);
                    redirect('user/dashboard');
                } else {
                    $this->session->set_flashdata("errormessage", "Invalid login details.");
                    redirect("user/login");
                }
            }
        } else {
            $this->load->view("users/login", $this->data);
        }
    }

    /**
    * Function to register a user
    * 
    * @return void
    */
    public function register() {
        $this->data['title'] = "Register";
        $where_cond = array(
            "row_status" => 1
            );
        $this->data['class_info'] = $this->classes_model->all_class_info($where_cond);
        $post_data = $_POST;
        if (count($post_data) > 0) {
            if ($this->form_validation->run('register_form') == false) {
                $this->load->view('users/register', $this->data);
            } else {
                $insert_data = array(
                    "name" => $post_data['name'],
                    "email" => $post_data['email'],
                    "phone_number" => $post_data['phone_number'],
                    "password" => getPasswordHash($post_data['password']),
                    "gender" => $post_data['gender'],
                    "class_id" => $post_data['class_id'],
                    "address" => $post_data['address'],
                    "user_type" => "P",
                    "created_time" => date('Y-m-d H:i:s')
                    );
                $status = $this->auth_model->create_user($insert_data);
                if ($status) {
                    $this->session->set_flashdata("successmessage", "Registered successfully. You can login now.");
                } else {
                    $this->session->set_flashdata("errormessage", "Registered Failed. Try again.");
                }
                redirect("user/login");
            }
        } else {
            $this->load->view('users/register', $this->data);
        }
    }



    /**
    * Function to clear the session and logout the user
    * 
    * @return boolean
    */
    public function logout() {
        $this->session->unset_userdata('user_session');
        redirect("user/login");
    }

    /**
    * Function to check email exists or not
    * 
    * @return boolean true or false
    */
    public function check_email_exists_or_not($str) {
        $this->form_validation->set_message('check_email_exists_or_not', 'Invalid login details.');

        $where_array = array('email' => $_POST['email'], 'user_type' => 'P', "row_status" => 1);
        $user_data = $this->auth_model->get_user_info($where_array);
        if (count($user_data) == 0)
            return false;
        $hashed_password = $user_data['password'];
        $password_verify = verifyPassword($_POST['password'], $hashed_password);
        if ($password_verify) {
            return true;
        }
        return false;
    }

    /**
    * Function to check email exists or not
    * 
    * @return boolean true or false
    */
    public function check_register_email_exists_or_not($str) {
        $this->form_validation->set_message('check_register_email_exists_or_not', 'Email already exists.');

        $where_array = array('email' => $_POST['email'], 'user_type' => 'P', "row_status" => 1);
        $user_data = $this->auth_model->get_user_info($where_array);
        if (count($user_data) > 0)
            return false;
        return true;
    }
}
