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
<div class="col-lg-12 mt30">
    <div class="table-responsive">
    <table class="table table-bordered" id="user_available_exams" data-href="<?php echo base_url(); ?>user/dashboard/list_of_available_exams">
            <thead>
                <th>
                    ID
                </th>
                <th>
                    Exam Name
                </th>
                <th>
                    Class Name
                </th>
                <th>
                    Actions
                </th>
            </thead>
        </table>
    </div>
</div>