<?php
/**
 * Exam_completed view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Exam_completed.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exam_completed.php
 *
 * @category Exam_completed.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12 mt30">
	<h1>Completed</h1>
	<div class="col-lg-12 text-center">
		<img src="<?php echo base_url() ?>assets/images/award.png" height="100">
	</div>
	<div class="col-lg-12 mt20 mb20">
		<div class="col-lg-2"></div>
		<div class="col-lg-8 text-center">
			<h3>
				You have successfully completed your exam. Results will be announced soon and you can check your results in your dashboard once they are released.
			</h3>
		</div>
		<div class="col-lg-2"></div>
	</div>
	<div class="col-lg-12 mb20 text-center">
		<a class="btn btn-primary" href="<?php echo base_url(); ?>user/dashboard">Go to dashboard</a>
	</div>
</div>