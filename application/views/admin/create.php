<?php
/**
 * Create view
 *
 * PHP version 7.0.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    Create.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @link        http://localhost/online-exam/admin
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create.php
 *
 * @category Create.php
 * @package  Views
 * @author   Mahesh Sajja <maheshhasan07@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     http://localhost/online-exam/admin
 */
?>
<div class="col-lg-12">
    <h1><?php echo $page_type; ?> User</h1><br>
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php
        $submit_url = "admin/users/create";
        if ($page_type == "Edit")
            $submit_url = "admin/users/create/".$user_info['id'];
        echo form_open(base_url($submit_url), array('name' => 'setup_user', 'id' => 'setup_user' ));
        echo form_hidden("page_type", $page_type);
        echo form_hidden("user_id", (isset($user_info['id'])?$user_info['id']:0));
        ?>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Name</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('name');
                } else {
                    $value = set_value('name');
                    if (empty($value)) {
                        $namevalue = $user_info['name'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $name = array("name" => "name",
                    "id" => "name",
                    "class" => "required form-control",
                    "placeholder" => "Name",
                    "maxlength" => 50,
                    "value" => $namevalue
                    );
                echo form_input($name);
                echo form_error('name');
                ?>
            </div>
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Email</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('email');
                } else {
                    $value = set_value('email');
                    if (empty($value)) {
                        $namevalue = $user_info['email'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $email = array("name" => "email",
                    "id" => "email",
                    "type" => "email",
                    "class" => "required form-control",
                    "placeholder" => "Email",
                    "value" => $namevalue
                    );
                echo form_input($email);
                echo form_error('email');
                ?>
            </div>
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Phone Number</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('phone_number');
                } else {
                    $value = set_value('phone_number');
                    if (empty($value)) {
                        $namevalue = $user_info['phone_number'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $phone_number = array("name" => "phone_number",
                    "id" => "phone_number",
                    "class" => "required form-control",
                    "placeholder" => "Phone number",
                    "maxlength" => 15,
                    "value" => $namevalue
                    );
                echo form_input($phone_number);
                echo form_error('phone_number');
                ?>
            </div>
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Gender</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('gender');
                } else {
                    $value = set_value('gender');
                    if (empty($value)) {
                        $namevalue = $user_info['gender'];
                    } else {
                        $namevalue = $value;
                    }
                }
                ?>
                <label> <input type="radio" class="required" name="gender" value="M" <?php echo ($namevalue == "M")?"checked='checked'":""; ?>><i></i> Male </label>
                <label> <input type="radio" class="required" name="gender" value="F" <?php echo ($namevalue == "F")?"checked='checked'":""; ?>><i></i> Female </label>
            </div>
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Address</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('address');
                } else {
                    $value = set_value('address');
                    if (empty($value)) {
                        $namevalue = $user_info['address'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $address = array("name" => "address",
                    "id" => "address",
                    "class" => "required form-control",
                    "placeholder" => "Address",
                    "rows" => 4,
                    "value" => $namevalue
                    );
                echo form_textarea($address);
                echo form_error('address');
                ?>
            </div>
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Class</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('class_id');
                } else {
                    $value = set_value('class_id');
                    if (empty($value)) {
                        $namevalue = $user_info['class_id'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $options = array("" => "Select class");
                foreach ($class_info as $key => $value) {
                    $options[$value['id']] = $value['class_name'];
                }
                $js = 'id="class_id" class="form-control required"';
                echo form_dropdown('class_id', $options, $namevalue,$js);
                ?>
            </div>
        </div>
        <?php if($page_type == "Add") { ?>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Password</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('password');
                } else {
                    $value = set_value('password');
                    if (empty($value)) {
                        $namevalue = $user_info['password'];
                    } else {
                        $namevalue = $value;
                    }
                }
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
        </div>
        <div class="col-lg-12 form-group">
            <label class="col-lg-4 control-label">Confirm Password</label>
            <div class="col-lg-8">
                <?php
                if (!isset($user_info)) {
                    $namevalue = set_value('passconf');
                } else {
                    $value = set_value('passconf');
                    if (empty($value)) {
                        $namevalue = $user_info['passconf'];
                    } else {
                        $namevalue = $value;
                    }
                }
                $passconf = array("name" => "passconf",
                    "id" => "passconf",
                    "type" => "password",
                    "maxlength" => 20,
                    "minlength" => 5,
                    "class" => "required form-control",
                    "placeholder" => "Confirm password"
                    );
                echo form_input($passconf);
                echo form_error('passconf');
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-12 text-center">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 pull-right no-padding">
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary block full-width m-b"><?php echo ($page_type == "Add")?$page_type:"Save"; ?></button>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo base_url() ?>admin/users" class="btn btn-default block full-width m-b">Cancel</a>
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