<?php
/**
 * UserFreetest layout view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    UserFreetest.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/UserFreetest
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserFreetest.php
 *
 * @category UserFreetest.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/UserFreetest
 */
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>INSPINIA | Register</title>

	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

	<div class="middle-box text-center loginscreen   animated fadeInDown">
		<div>
			<div>

				<h1 class="logo-name">IN+</h1>

			</div>
			<h3>Register for Free Test</h3>
			<?php
			echo form_open(base_url("home/freetest"), array("id" => "free_register_form", "name" => "free_register_form"));
			?>
			<div class="form-group">
				<?php
				$name = array("name" => "name",
					"id" => "name",
					"class" => "required form-control",
					"placeholder" => "Your Name",
					"maxlength" => 20,
					"value" => set_value('name', '')
					);
				echo form_input($name);
				echo form_error('name');
				?>
			</div>
			<div class="form-group">
				<?php
				$email = array("name" => "email",
					"id" => "email",
					"type" => "email",
					"class" => "form-control",
					"maxlength" => 50,
					"placeholder" => "Your Email Address",
					"value" => set_value('email', '')
					);
				echo form_input($email);
				echo form_error('email');
				?>
			</div>
			<div class="form-group">
                <label> <input type="radio" class="required" name="gender" value="M" <?php echo (set_value("gender") == "M")?"checked='checked'":""; ?>><i></i> Male </label>
                <label> <input type="radio" class="required" name="gender" value="F" <?php echo (set_value("gender") == "F")?"checked='checked'":""; ?>><i></i> Female </label>
            </div>
			<div class="form-group">
				<?php
				$phone_number = array("name" => "phone_number",
					"id" => "phone_number",
					"type" => "text",
					"class" => "required form-control",
					"maxlength" => 15,
					"placeholder" => "Your phone number",
					"value" => set_value('phone_number', '')
					);
				echo form_input($phone_number);
				echo form_error('phone_number');
				?>
			</div>
			<div class="form-group">
				<?php
				$options = array("" => "Select class");
				foreach ($class_info as $key => $value) {
					$options[$value['id']] = $value['class_name'];
				}
				$js = 'id="class_id" class="form-control required"';
				echo form_dropdown('class_id', $options, set_value('class_id'),$js);
				?>
			</div>
			<button type="submit" class="btn btn-primary block full-width m-b">Register</button>
		</form>
	</div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
</body>

</html>