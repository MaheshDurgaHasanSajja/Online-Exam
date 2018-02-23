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
 * @link        http://localhost/online-exam/user/login
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
 * @link     http://localhost/online-exam/user/login
 */
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Online | Exam</title>

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/ss/animate.css" rel="stylesheet"><!-- Toastr style -->
  <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
  <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <ul class="nav navbar-top-links navbar-right">
      <li>
        <a href="<?php echo base_url(); ?>admin/auth">
          Admin
        </a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>home/freetest">
          Free Test
        </a>
      </li>
    </ul>

  </nav>
  <div class="loginColumns animated fadeInDown">
    <div class="row">

      <div class="col-md-6">
        <h2 class="font-bold">Online Exam</h2>

        <p>
          For registration, You need to pay 200/-. If you already have an account please try login.
        </p>

        <p>
          After logged in, you can see the list of available exams.
        </p>

        <p>
          Each and every exam has time limit defined by an admin. So you have to compelte that in time. If you are running out and you can not able to submit the exam, In the last second the exam will be automatically submitted.
        </p>

      </div>
      <div class="col-md-6">
        <div class="ibox-content">
          <?php
          echo form_open(base_url("user/login"), array("id" => "login_form", "name" => "login_form"));
          ?>
          <div class="form-group">
            <?php
            $name = array("name" => "name",
              "id" => "name",
              "class" => "form-control",
              "placeholder" => "User ID",
              "value" => set_value('name', '')
              );
            echo form_input($name);
            echo form_error('name');
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

                        <!-- <a href="#">
                            <small>Forgot password?</small>
                          </a> -->

                          <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                          </p>
                          <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url(); ?>user/login/register">Create an account</a>
                        </form>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                  <hr/>
                </div>

                <!-- Mainly scripts -->
                <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
                <!-- Toastr -->
                <script src="<?php echo base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
                <?php if ($this->session->flashdata('errormessage')) { ?>
                <script type="text/javascript">
            // Toastr options
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "progressBar": true,
              "positionClass": "toast-top-center",
              "onclick": null,
              "showDuration": "400",
              "hideDuration": "1000",
              "timeOut": "7000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.error("<?php echo $this->session->flashdata('errormessage'); ?>");
          </script>
          <?php } ?>
          <?php if ($this->session->flashdata('successmessage')) { ?>
          <script type="text/javascript">
                // Toastr options
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "progressBar": true,
                  "positionClass": "toast-top-center",
                  "onclick": null,
                  "showDuration": "400",
                  "hideDuration": "1000",
                  "timeOut": "7000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr.success("<?php echo $this->session->flashdata('successmessage'); ?>");
              </script>
              <?php } ?>
            </body>

            </html>