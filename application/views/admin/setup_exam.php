<?php
/**
 * Setup_Exam view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Setup_Exam.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setup_Exam.php
 *
 * @category Setup_Exam.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12">
	<h1><?php echo $page_type; ?> Exam</h1><br>
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<?php
		$submit_url = "admin/exams/setup";
		if ($page_type == "Edit")
			$submit_url = "admin/exams/setup/".$exam_info['id'];
			echo form_open(base_url($submit_url), array('name' => 'setup_exam', 'id' => 'setup_exam' ));
			echo form_hidden("page_type", $page_type);
			echo form_hidden("exam_id", (isset($exam_info['id'])?$exam_info['id']:0));
		?>
		<div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">Exam name</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($exam_info)) {
                        $namevalue = set_value('exam_name');
                    } else {
                        $value = set_value('exam_name');
                        if (empty($value)) {
                            $namevalue = $exam_info['exam_name'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $exam_name = array("name" => "exam_name",
		                "id" => "exam_name",
		                "class" => "required form-control",
		                "placeholder" => "Exam name",
		                "value" => $namevalue
		            );
		            echo form_input($exam_name);
		            echo form_error('exam_name');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">Exam Time Limit (mins)</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($exam_info)) {
                        $namevalue = set_value('exam_time_limit');
                    } else {
                        $value = set_value('exam_time_limit');
                        if (empty($value)) {
                            $namevalue = $exam_info['exam_time_limit'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $exam_time_limit = array("name" => "exam_time_limit",
		                "id" => "exam_time_limit",
		                "class" => "required form-control",
		                "placeholder" => "10",
		                "value" => $namevalue
		            );
		            echo form_input($exam_time_limit);
		            echo form_error('exam_time_limit');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">No of Questions</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($exam_info)) {
                        $namevalue = set_value('no_of_questions');
                    } else {
                        $value = set_value('no_of_questions');
                        if (empty($value)) {
                            $namevalue = $exam_info['no_of_questions'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $no_of_questions = array("name" => "no_of_questions",
		                "id" => "no_of_questions",
		                "class" => "required form-control",
		                "placeholder" => "10",
		                "value" => $namevalue
		            );
		            echo form_input($no_of_questions);
		            echo form_error('no_of_questions');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">Class</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($exam_info)) {
                        $namevalue = set_value('class_id');
                    } else {
                        $value = set_value('class_id');
                        if (empty($value)) {
                            $namevalue = $exam_info['class_id'];
                        } else {
                            $namevalue = $value;
                        }
                    }
                    $options = array("" => "Select class");
                    foreach ($class_info as $key => $value) {
                    	$options[$value['id']] = $value['class_name'];
                    }
                    $js = 'class="form-control required" id="class_id"';
		            echo form_dropdown('class_id', $options, $namevalue, $js);
		            echo form_error('class_id');
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
			    	<a href="<?php echo base_url() ?>admin/exams" class="btn btn-default block full-width m-b">Cancel</a>
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