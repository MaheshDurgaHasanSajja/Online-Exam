<?php
/**
 * User layout view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    User.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/User
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User.php
 *
 * @category User.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/User
 */
?>
<!DOCTYPE html>
<html>

    <head>

        <script type="text/javascript">
          var SITEURL = "<?php echo base_url(); ?>";
          var CONTROLLER = '<?php echo $this->router->fetch_class(); ?>';
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>INSPINIA | Dashboard</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/basic.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dataTables/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dataTables/dataTables.tableTools.css" />

    </head>
    <body>
        <div id="wrapper">
            <?php
            echo $this->load->view("layouts/user_leftbar.php");
            ?>
            <div id="page-wrapper" class="gray-bg dashboard-1">
                <div class="row border-bottom">
                    <?php
                    echo $this->load->view("layouts/user_header.php");
                    ?>
                </div>
                <div class="row  border-bottom white-bg">
                    <?php
                    echo $this->load->view("layouts/user_breadcrumbs.php");
                    ?>
                    <div class="border-bottom"></div>
                    <?php
                    echo $content;
                    ?>
                </div>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
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