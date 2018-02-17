<?php
/**
 * Short description for file : user_breadcrumbs.php
 *
 * PHP version 7.22
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category    user_breadcrumbs.php
 * @package     Views
 * @author      Mahesh Sajja <maheshhasan07@gmail.com>
 * @link        http://localhost/online-exam/user
 * @dateCreated 02/13/2018  MM/DD/YYYY
 * @dateUpdated 02/13/2018  MM/DD/YYYY  
 */
?>

<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <?php // echo $this->breadcrumbs->show(); ?>
            </div>
            <h2 class="font-light m-b-xs">
                <?php echo ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/', " $1", $this->uri->segment(2))); ?>
            </h2>
            <small>
                <?php
                if ($this->uri->segment(3) == "classes") {
                    echo "The list of classes";
                }
                ?>
            </small>
        </div>
    </div>
</div>