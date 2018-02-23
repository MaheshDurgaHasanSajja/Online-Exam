<?php
/**
 * Admin leftbar view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    admin_leftbar.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * admin_leftbar.php
 *
 * @category admin_leftbar.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo (isset($this->session->userdata['admin_session']['name']) && $this->session->userdata['admin_session']['name'] != "")?$this->session->userdata['admin_session']['name']:"--" ;?></strong> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="yes-no-alert" data-confirm-text='Are you sure? You are about to logout!' data-href="<?php echo base_url(); ?>admin/auth/logout">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?php echo ($title != "" && $title == "Users") ? "active" : ""; ?>">
                <a href="<?php echo base_url(); ?>admin/users"> <span class="nav-label">Users</span></a>
            </li>
            <li class="<?php echo ($title != "" && $title == "Classes" || ($this->uri->segment(2) == "classes" && $this->uri->segment(3) == "setup")|| $this->uri->segment(2) == "classes") ? "active" : ""; ?>">
                <a href="<?php echo base_url(); ?>admin/classes"> <span class="nav-label">Classes</span></a>
            </li>
            <li class="<?php echo ($title != "" && $title == "Exams" || ($this->uri->segment(2) == "exams" && $this->uri->segment(3) == "setup")|| ($this->uri->segment(2) == "exams" && $this->uri->segment(3) != "reports")) ? "active" : ""; ?>">
                <a href="<?php echo base_url(); ?>admin/exams"><span class="nav-label">Exams</span></a>
            </li>
            <li class="<?php echo ($title != "" && $title == "Questions" || ($this->uri->segment(2) == "questions" && $this->uri->segment(3) == "setup")|| $this->uri->segment(2) == "questions") ? "active" : ""; ?>">
                <a href="<?php echo base_url(); ?>admin/questions"><span class="nav-label">Questions</span></a>
            </li>
            <li class="<?php echo ($title != "" && $title == "Reports" || ($this->uri->segment(2) == "exams" && $this->uri->segment(3) == "reports")|| $this->uri->segment(2) == "questions") ? "active" : ""; ?>">
            <a href="<?php echo base_url(); ?>admin/exams/reports"><span class="nav-label">Exam Reports</span></a>
            </li>
        </ul>

    </div>
</nav>