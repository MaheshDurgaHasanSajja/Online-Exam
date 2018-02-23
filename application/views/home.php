<?php
/**
 * Home layout view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Home.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/Home
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home.php
 *
 * @category Home.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/Home
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Online Exam</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Animation CSS -->
	<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
</head>
<body id="page-top" class="landing-page">
	<div class="navbar-wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Online Exam</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a class="page-scroll" href="<?php echo base_url() ?>user/login">Login</a></li>
						<li><a class="page-scroll" href="<?php echo base_url() ?>user/login/register">Signup</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="home-screen white-text" id="inSlider">
		<div class="row no-padding">
			<div class="col-lg-12 text-center mt75 white-text">
				<h1>
					<b>Your ultimate destination for online assessment</b>
				</h1>
				<div class="col-lg-12 text-center f16">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						Prepare candidates to perform extraordinarily with an easy to use highly interactive platform and 
						simplify the assessment cycle.
					</div>
					<div class="col-lg-3"></div>
				</div>
			</div>
			<div class="col-lg-12 text-center mt30">
				<a class="btn btn-danger" href="<?php echo base_url() ?>home/freetest">TAKE A FREE TEST</a>
			</div>
			<div class="col-lg-12 text-center mt50">
				<img src="<?php echo base_url(); ?>assets/images/homepage.png" height="300">
			</div>
		</div>
	</div>


	

	<!-- Mainly scripts -->
	<script src="<?php echo base_url() ?>assets/js/jquery-2.1.1.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/wow/wow.min.js"></script>


	<script>

		$(document).ready(function () {

			$('body').scrollspy({
				target: '.navbar-fixed-top',
				offset: 80
			});

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
        	var link = $(this);
        	$('html, body').stop().animate({
        		scrollTop: $(link.attr('href')).offset().top - 50
        	}, 500);
        	event.preventDefault();
        });
    });

		var cbpAnimatedHeader = (function() {
			var docElem = document.documentElement,
			header = document.querySelector( '.navbar-default' ),
			didScroll = false,
			changeHeaderOn = 200;
			function init() {
				window.addEventListener( 'scroll', function( event ) {
					if( !didScroll ) {
						didScroll = true;
						setTimeout( scrollPage, 250 );
					}
				}, false );
			}
			function scrollPage() {
				var sy = scrollY();
				if ( sy >= changeHeaderOn ) {
					$(header).addClass('navbar-scroll')
				}
				else {
					$(header).removeClass('navbar-scroll')
				}
				didScroll = false;
			}
			function scrollY() {
				return window.pageYOffset || docElem.scrollTop;
			}
			init();

		})();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>

</body>
</html>
