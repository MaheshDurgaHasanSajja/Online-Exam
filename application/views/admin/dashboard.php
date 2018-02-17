<?php
/**
 * Dashboard view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    dashboard.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * dashboard.php
 *
 * @category dashboard.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-md-3 mt20">
    <div class="btn-blue-bg rad6 h100 mb30" id="dashboard">
        <a href="<?php echo base_url(); ?>admin/users" class="custom_dashboard_btn" id="dashboard_link">
            <center>
                <div class="font-extra-bold f18 pt15" style="color:#fff">
                    Users
                </div>
                <div class="user_policy_image mt10"></div>
            </center>
        </a>
    </div>
</div>
<div class="col-md-3 mt20">
    <div class="btn-blue-bg rad6 h100 mb30" id="dashboard">
        <a href="<?php echo base_url(); ?>admin/classes" class="custom_dashboard_btn" id="dashboard_link">
            <center>
                <div class="font-extra-bold f18 pt15" style="color:#fff">
                    Classes
                </div>
                <div class="user_class_image mt10"></div>
            </center>
        </a>
    </div>
</div>