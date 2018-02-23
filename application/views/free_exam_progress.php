<?php
/**
 * Free_exam_progress view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Free_exam_progress.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Free_exam_progress.php
 *
 * @category Free_exam_progress.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Toastr style -->
	<link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/css/basic.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dataTables/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dataTables/dataTables.tableTools.css" />
	<script type="text/javascript">
		var SITEURL = '<?php echo base_url(); ?>';
		var CONTROLLER = '<?php echo $this->router->fetch_class(); ?>';
	</script>
</head>
<body>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- add header -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="javascript:void(0);">Online Exam</a>
			</div>
			<!-- menu items -->
			<div class="collapse navbar-collapse" id="navbar1">
				<ul class="nav navbar-nav navbar-right">
					<li class="">
						<a href="javascript:void(0)" id="timer" class="pull-right f16"></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container pt110">
		<div class="row">
			<input type="hidden" id="free_exam_id" value="<?php echo $exam_id; ?>">
			<div class="col-lg-12 mt20" id="question_div">
			</div>
		</div>
	</div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Peity -->
<script src="<?php echo base_url(); ?>assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/sweetalert.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/relCopy.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>
</html>