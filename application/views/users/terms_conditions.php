<?php
/**
 * Terms_conditions view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Terms_conditions.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Terms_conditions.php
 *
 * @category Terms_conditions.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12">
	<div class="col-lg-12 text-center">
		<h1>Terms & Conditions</h1>
	</div>
	<div class="col-lg-12 mt20">
		<ul>
			<li>
				The content of the pages of this website is for your general information and use only. It is subject to change without notice. 
			</li>
			<li>
				Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.
			</li>
			<li>
				Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.
			</li>
			<li>
				This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.
			</li>
			<li>
				All trade marks reproduced in this website which are not the property of, or licensed to, the operator are acknowledged on the website.
			</li>
			<li>
				Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.
			</li>
		</ul>
	</div>
	<div class="col-lg-12 mt30 mb30 text-center">
		<button class="btn btn-primary start-exam" data-href="<?php echo base_url(); ?>user/dashboard/start" data-exam-id="<?php echo $exam_id; ?>">
			Start
		</button>
	</div>
</div>