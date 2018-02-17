<?php
/**
 * Login view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    login.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * login.php
 *
 * @category login.php
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

    <title>INSPINIA | Login</title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <ul class="nav navbar-top-links navbar-right">
            <li>
            <a href="<?php echo base_url(); ?>user/login">
                    User
                </a>
            </li>
        </ul>

    </nav>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name" style="line-height: inherit;">IN+</h1>
            </div>
            <?php
            echo form_open(base_url("admin/auth"), array("id" => "login_form", "name" => "login_form"));
            ?>
            <div class="form-group">
                <?php
                $email = array("name" => "email",
                    "id" => "email",
                    "class" => "required form-control",
                    "placeholder" => "Your Email Address",
                    "value" => set_value('email', '')
                    );
                echo form_input($email);
                echo form_error('email');
                ?>
            </div>
            <div class="form-group">
                <?php
                $password = array("name" => "password",
                    "type" => "password",
                    "id" => "password",
                    "class" => "required form-control",
                    "placeholder" => "Password"
                    );
                echo form_input($password);
                echo form_error('password');
                ?>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <?php /*<a href="<?php echo base_url(); ?>admin/auth/forgot"><small>Forgot password?</small></a> */?>
            <?php echo form_close(); ?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/login.js"></script>

</body>

</html>