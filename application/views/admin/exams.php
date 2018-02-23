<?php
/**
 * Exams view
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
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exams.php
 *
 * @category Exams.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>

<div class="col-lg-12 mt50">
    <div class="col-lg-12 pull-right mb20">
    <div class="col-lg-7"></div>
        <div class="col-lg-3">
            <?php
            $options = array(
                "P" => "Paid users",
                "F" => "Free users"
                );
            $js = 'id="user_type" class="form-control"';
            echo form_dropdown('user_type', $options, '',$js);
            ?>
        </div>
        <div class="col-lg-2 text-right">
            <a href="<?php echo base_url(); ?>admin/exams/setup" class="btn btn-primary pull-right">Add Exam</a>
        </div>
    </div>
    <div class="col-lg-12 table-responsive">
        <table class="table table-bordered" id="list_of_exams">
            <thead>
                <th>ID</th>
                <th>Class Name</th>
                <th>Exam Name</th>
                <th>Exam Time (mins)</th>
                <th>No of questions</th>
                <th>Registered Users</th>
                <th>No.of users completed</th>
                <th>Result</th>
                <th>Actions</th>
            </thead>
        </table>
    </div>
</div>