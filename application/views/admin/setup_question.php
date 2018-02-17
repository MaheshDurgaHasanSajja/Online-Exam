<?php
/**
 * Setup_question view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Setup_question.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setup_question.php
 *
 * @category Setup_question.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12">
	<h1><?php echo $page_type; ?> Question</h1><br>
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<?php
		$submit_url = "admin/questions/setup/";
		if ($page_type == "Edit")
			$submit_url = "admin/questions/setup/".$question_info['id'];
			echo form_open(base_url($submit_url), array('name' => 'setup_question', 'id' => 'setup_question' ));
			echo form_hidden("page_type", $page_type);
			echo form_hidden("question_id", (isset($question_info['id'])?$question_info['id']:0));
		?>
		<div class="col-lg-12 form-group">
			<label class="col-lg-4 control-label">Title</label>
	        <div class="col-lg-8">
	        	<?php
	        		if (!isset($question_info)) {
                        $namevalue = set_value('title');
                    } else {
                        $value = set_value('title');
                        if (empty($value)) {
                            $namevalue = $question_info['title'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $question_name = array("name" => "title",
		                "id" => "title",
		                "class" => "required form-control",
		                "placeholder" => "title",
		                "value" => $namevalue,
		                "rows" => 4,
		            );
		            echo form_textarea($question_name);
		            echo form_error('title');
		        ?>
	        </div>
	    </div>
	    <?php
	    	if ($question_info['options'] != "") {
	    		$question_options = json_decode($question_info['options']);
	    		foreach($question_options as $que_key => $que_val):
	    		?>
	    			<div class="col-lg-12 form-group options-div">
				    	<label class="col-lg-4 control-label">Options</label>
				    	<div class="col-lg-8">
					        <?php
					            $options = array("name" => "options[]",
					                "id" => "options",
					                "class" => "required form-control",
					                "placeholder" => "options",
					                "value" => $que_val
					            );
					            echo form_input($options);
					            echo form_error('options');
					        ?>
				        </div>
				        <a class="remove pull-right" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">remove</a>
				    </div>
	    		<?php
	    		endforeach;
	    	} else {
	    		?>
	    			<div class="col-lg-12 form-group options-div">
				    	<label class="col-lg-4 control-label">Options</label>
				    	<div class="col-lg-8">
					        <?php
					            $options = array("name" => "options[]",
					                "id" => "options",
					                "class" => "required form-control",
					                "placeholder" => "options"
					            );
					            echo form_input($options);
					            echo form_error('options');
					        ?>
				        </div>
				    </div>
	    		<?php
	    	}
	    ?>
	    <a href="#" class="more-options pull-right" rel=".options-div">
        	Add more options
        </a>
	    <div class="col-lg-12 form-group">
	    	<label class="col-lg-4 control-label">Correct Answer</label>
	    	<div class="col-lg-8">
		        <?php
		            if (!isset($question_info)) {
                        $namevalue = set_value('answer');
                    } else {
                        $value = set_value('answer');
                        if (empty($value)) {
                            $namevalue = $question_info['answer'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $question_name = array("name" => "answer",
		                "id" => "answer",
		                "class" => "required form-control",
		                "placeholder" => "1",
		                "value" => $namevalue
		            );
		            echo form_input($question_name);
		            echo form_error('answer');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
	    	<label class="col-lg-4 control-label">Marks</label>
	    	<div class="col-lg-8">
		        <?php
		            if (!isset($question_info)) {
                        $namevalue = set_value('marks');
                    } else {
                        $value = set_value('marks');
                        if (empty($value)) {
                            $namevalue = $question_info['marks'];
                        } else {
                            $namevalue = $value;
                        }
                    }
		            $marks = array("name" => "marks",
		                "id" => "marks",
		                "class" => "required form-control",
		                "placeholder" => "100",
		                "value" => $namevalue
		            );
		            echo form_input($marks);
		            echo form_error('marks');
		        ?>
	        </div>
	    </div>
	    <div class="col-lg-12 form-group">
	    	<label class="col-lg-4 control-label">Exam</label>
	    	<div class="col-lg-8">
	            <?php
	            	if (!isset($question_info)) {
                        $namevalue = set_value('exam_id');
                    } else {
                        $value = set_value('exam_id');
                        if (empty($value)) {
                            $namevalue = $question_info['exam_id'];
                        } else {
                            $namevalue = $value;
                        }
                    }
	                $options = array("" => "Select exam");
	                foreach ($exam_info as $key => $value) {
	                    $options[$value['id']] = $value['exam_name'];
	                }
	                $js = 'id="exam_id" class="form-control required"';
	                echo form_dropdown('exam_id', $options, $namevalue,$js);
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
			    	<a href="<?php echo base_url() ?>admin/questions/index/<?php echo $class_id; ?>" class="btn btn-default block full-width m-b">Cancel</a>
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