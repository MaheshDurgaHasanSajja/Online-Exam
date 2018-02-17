<?php
/**
 * Admin_create view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Admin_create.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin_create.php
 *
 * @category Admin_create.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12">
	<h1><?php echo $page_type; ?> Class</h1><br>
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<?php
		$submit_url = "admin/classes/setup";
		if ($page_type == "Edit")
			$submit_url = "admin/classes/setup/".$class_info['id'];
			echo form_open(base_url($submit_url), array('name' => 'admin_create', 'id' => 'admin_create' ));
			echo form_hidden("page_type", $page_type);
			echo form_hidden("class_id", (isset($class_info['id'])?$class_info['id']:0));
		?>
		<div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">Class name</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($class_info)) {
                        $namevalue = set_value('name');
                    } else {
                        $value = set_value('name');
                        if (empty($value)) {
                            $namevalue = $class_info['name'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $class_name = array("name" => "name",
		                "id" => "name",
		                "class" => "required form-control",
		                "placeholder" => "Class name",
		                "value" => $namevalue
		            );
		            echo form_input($class_name);
		            echo form_error('name');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
	    	<label class="col-lg-4 control-label">Time of exam (min)</label>
	    	<div class="col-lg-8">
		        <?php
			        if (!isset($class_info)) {
                        $namevalue = set_value('time_of_exam');
                    } else {
                        $value = set_value('time_of_exam');
                        if (empty($value)) {
                            $namevalue = $class_info['time_of_exam'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $time_of_exam = array("name" => "time_of_exam",
		                "id" => "time_of_exam",
		                "class" => "required form-control",
		                "placeholder" => "10...",
		                "value" => $namevalue
		            );
		            echo form_input($time_of_exam);
		            echo form_error('time_of_exam');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 text-center">
		    <div class="col-lg-2"></div>
		    <div class="col-lg-8 pull-right no-padding">
			    <div class="col-lg-4">
			    	<button type="submit" class="btn btn-primary block full-width m-b"><?php echo ($page_type == "Add")?$page_type:"Save"; ?></button>
			    </div>
			    <div class="col-lg-4">
			    	<a href="<?php echo base_url() ?>admin/classes" class="btn btn-default block full-width m-b">Cancel</a>
			    </div>
		    </div>
		    <div class="col-lg-2"></div>
	    </div>
		<?php
			echo form_close();
		?>
	</div>
	<div class="col-lg-3"></div>
</div>