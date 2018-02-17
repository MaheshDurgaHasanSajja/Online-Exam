<?php
/**
 * Register view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Register.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Register.php
 *
 * @category Register.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
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
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>
            <?php
            echo form_open(base_url("user/login/register"), array("id" => "register_form", "name" => "register_form"));
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
                    "class" => "required form-control",
                    "maxlength" => 50,
                    "placeholder" => "Your Email Address",
                    "value" => set_value('email', '')
                    );
                echo form_input($email);
                echo form_error('email');
                ?>
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
                <label> <input type="radio" class="required" name="gender" value="M" <?php echo (set_value("gender") == "M")?"checked='checked'":""; ?>><i></i> Male </label>
                <label> <input type="radio" class="required" name="gender" value="F" <?php echo (set_value("gender") == "F")?"checked='checked'":""; ?>><i></i> Female </label>
            </div>
            <div class="form-group">
                <?php
                $address = array("name" => "address",
                    "id" => "address",
                    "class" => "required form-control",
                    "placeholder" => "Your address",
                    "value" => set_value('address', ''),
                    "rows" => 5
                    );
                echo form_textarea($address);
                echo form_error('address');
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
            <div class="form-group">
                <?php
                $password = array("name" => "password",
                    "id" => "password",
                    "type" => "password",
                    "maxlength" => 20,
                    "minlength" => 5,
                    "class" => "required form-control",
                    "placeholder" => "Your password"
                    );
                echo form_input($password);
                echo form_error('password');
                ?>
            </div>
            <div class="form-group">
                <?php
                $passconf = array("name" => "passconf",
                    "id" => "passconf",
                    "type" => "password",
                    "maxlength" => 20,
                    "minlength" => 5,
                    "class" => "required form-control",
                    "placeholder" => "Confirm your password"
                    );
                echo form_input($passconf);
                echo form_error('passconf');
                ?>
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox" name="agree" class="required" value="1"><i></i> Agree the terms and policy </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url(); ?>user/login" style='margin-bottom:20px;'>Login</a>
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
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>