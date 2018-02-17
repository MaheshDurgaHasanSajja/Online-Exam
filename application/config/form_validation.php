<?php

/**
 * FormValidation.php
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    FormValidation.php
 * @package     Config
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @link        http://localhost/medicare/index.php/users
 * @dateCreated 02/14/2018  MM/DD/YYYY
 * @dateUpdated 02/14/2018  MM/DD/YYYY 
 * @functions   0
 */
$config = array(

	'login_form' => array(
			array(
	            'field' => 'email',
	            'label' => 'Email',
	            'rules' => 'trim|required|valid_email|callback_check_email_exists_or_not'
	        ),
	        array(
	            'field' => 'password',
	            'label' => 'Password',
	            'rules' => 'trim|required'
	        ),
	),
	'setup_class' => array(
			array(
	            'field' => 'class_name',
	            'label' => 'Class Name',
	            'rules' => 'trim|required|callback_check_name_exists_or_not'
	        ),
	),
	'setup_exam' => array(
			array(
	            'field' => 'exam_name',
	            'label' => 'Exam Name',
	            'rules' => 'trim|required|callback_check_name_exists_or_not'
	        ),
	        array(
	            'field' => 'exam_time_limit',
	            'label' => 'Exam time limit',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'class_id',
	            'label' => 'Class',
	            'rules' => 'trim|required'
	        )
	),
	'setup_question' => array(
			array(
	            'field' => 'title',
	            'label' => 'Title',
	            'rules' => 'trim|required|callback_check_title_exists_or_not'
	        ),
	        array(
	            'field' => 'options[]',
	            'label' => 'Options',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'answer',
	            'label' => 'Answer',
	            'rules' => 'trim|required|integer|callback_check_valid_answer'
	        ),
	        array(
	            'field' => 'marks',
	            'label' => 'Marks',
	            'rules' => 'trim|required|integer'
	        ),
	        array(
	            'field' => 'exam_id',
	            'label' => 'Exam',
	            'rules' => 'trim|required'
	        ),
	),
	'register_form' => array(
			array(
	            'field' => 'email',
	            'label' => 'Email',
	            'rules' => 'trim|required|valid_email|callback_check_register_email_exists_or_not'
	        ),
	        array(
	            'field' => 'password',
	            'label' => 'Password',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'passconf',
	            'label' => 'Confirm password',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'class_id',
	            'label' => 'Class',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'gender',
	            'label' => 'Gender',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'address',
	            'label' => 'Address',
	            'rules' => 'trim|required'
	        ),
	        array(
	            'field' => 'name',
	            'label' => 'Name',
	            'rules' => 'trim|required'
	        ),
	),
);