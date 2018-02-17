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
        $this->load->model(array('exams_model'));
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
}
