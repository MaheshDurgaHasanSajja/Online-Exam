/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(function () {
    init();
});
 function init() {
    initValidators();
    initClassesDataTable();
    initExamsDataTable();
    initYesNoAlert();
    initSetupClassValidation();
    initSetupExamValidation();
    initIndividualDelete();
    initQuestionsDataTable();
    initAddMoreOptions();
    initQuestionsFormValidation();
    initUsersTable();
    initClassOnchange();
    initUserAvailableExamsDataTable();
}

function initValidators() {
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s-_+=.,/!@#$&*]+$/.test(value);
    }); 
}

/**
* Function to set up a class validation
*
* return void
*/
function initSetupExamValidation() {
    $('#setup_exam').validate({
        errorElement: 'label',
        errorClass: 'error',
        focusInvalid: false,
        rules: {
            exam_name: {
                required: true,
                alphanumeric: true
            },
            exam_time_limit: {
                required: true,
                digits: true
            },
        },
        messages: {
            "exam_name": {
                "alphanumeric": "Enter valid name."
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#setup_exam')).show();
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        unhighlight: function (element) { // <-- fires when element is valid
            $(element).closest('.form-group').removeClass('has-error').addClass('has-info');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            $(e).remove();
        }
    });
}


/**
* Function to intialize class data table
*
* return void
*/
function initUserAvailableExamsDataTable() {
    var ajaxUrl = $("#user_available_exams").data("href");
    $("#user_available_exams").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null,null, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
        }
    });
}

/**
* Function to intialize class data table
*
* return void
*/
function initExamsDataTable() {
    var ajaxUrl = SITEURL + "admin/exams/list_of_all_exams";
    $("#list_of_exams").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null,null, null, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
        }
    });
}

/**
* Function to intialize class data table
*
* return void
*/
function initClassesDataTable() {
    var ajaxUrl = SITEURL + "admin/classes/list_of_all_classes";
    $("#list_of_classes").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
        }
    });
}

/**
* Function to initalize yes no alert
*
* return void
*/
function initYesNoAlert() {
    $(".yes-no-alert").on('click', function() {
        var ajaxUrl = $(this).data('href');
        var confirmText = $(this).data('confirm-text');
        swal({
            text: confirmText,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            titleClass: "mine",
            confirmButtonText: "Yes, I'm sure.",
            cancelButtonClass: "btn btn-default",
            closeOnConfirm: false,
            allowOutsideClick: false
        }, function () {
            location.href = ajaxUrl;
        });
    });
}

/**
* Function to set up a class validation
*
* return void
*/
function initSetupClassValidation() {
    $('#setup_class').validate({
        errorElement: 'label',
        errorClass: 'error',
        focusInvalid: false,
        rules: {
            class_name: {
                required: true,
                alphanumeric: true
            }
        },
        messages: {
            "class_name": {
                "alphanumeric": "Enter valid name."
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#setup_class')).show();
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        unhighlight: function (element) { // <-- fires when element is valid
            $(element).closest('.form-group').removeClass('has-error').addClass('has-info');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            $(e).remove();
        }
    });
}

/**
* Function to delete individual row
* 
* return void
*/
function initIndividualDelete() {
    $(".delete-individual").each(function () {
        $(this).click(function () {
            var deleteUrl = $(this).attr('data-href');
            var deleteMessage = $(this).attr("data-message");
            var deleteDesc = $(this).attr("data-desc");
            var tableId = $(this).data("table-id");
            var id = $(this).data("record-id");
            var pageLoad = $(this).data("page-load");
            var userCount = $(this).data("user-count");
            
            swal({
                title: deleteMessage,
                text: deleteDesc,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No, cancel",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-default",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax(
                    {
                        url: deleteUrl,
                        type: 'POST',
                        data: {"id": id},
                        cache: false,
                        success: function (data) {
                        }
                    }
                    )
                    .done(function (data) {
                        var isJSON = true;
                        try {
                            var jsonData = $.parseJSON(data);
                        } catch (err) {
                            isJSON = false;
                        }
                        if (isJSON) {
                            if (typeof (jsonData.status) != 'undefined' && jsonData.status == 'success') {
                                var message = jsonData.message;
                                if (typeof (jsonData.message) != 'undefined') {
                                    swal({
                                        title: "Deleted",
                                        text: message,
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonText: "Ok",
                                        confirmButtonClass: "yesok-btn",
                                    },
                                    function (e) {
                                        if (pageLoad != "" && pageLoad == 1)
                                            location.reload();
                                        $("#" + tableId).DataTable().draw();
                                    });
                                }
                            }
                            if (typeof (jsonData.status) != 'undefined' && jsonData.status == 'failure') {
                                var message = jsonData.message;
                                if (typeof (jsonData.message) != 'undefined') {
                                    swal({
                                        title: "Failed",
                                        text: message,
                                        type: "error",
                                        confirmButtonText: "Ok",
                                        confirmButtonClass: "yescancel-btn",
                                    });
                                }
                            }
                        } else {
                            swal({
                                title: "Failed!",
                                text: "Something went wrong. Please try again!",
                                type: "error",
                                confirmButtonText: "Ok",
                                confirmButtonClass: "yescancel-btn",
                            });
                        }
                    })
                    .error(function (data) {
                        swal({
                            title: "Failed!",
                            text: "Something went wrong. Please try again!",
                            type: "error",
                            confirmButtonText: "Ok",
                            confirmButtonClass: "yescancel-btn",
                        });
                    });
                } else {
                    swal({
                        title: "Cancelled",
                        text: "The action has been cancelled.",
                        type: "error",
                        confirmButtonText: "Ok",
                        confirmButtonClass: "yescancel-btn",
                    })
                }
            });
});
});
}

/**
* Function to intialize class data table
*
* return void
*/
function initQuestionsDataTable() {
    var ajaxUrl = $("#list_of_questions").data("href");
    var exam_id = $("#exam_id").val();
    $("#list_of_questions").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null, null,null, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl,
            "data": function(d) {
                d.exam_id = exam_id;
            }
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
        }
    });
}

/** Function to intialize rel copy functionality
*
* return void
*/
function initAddMoreOptions() {
    var removeLink = ' <a class="remove pull-right" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">remove</a>';
    $('a.more-options').relCopy({append: removeLink});
}

/**
* Function to intialize question form validation
*
* return coid
*/
function initQuestionsFormValidation() {
    $('#setup_question').validate({
        errorElement: 'label',
        errorClass: 'error',
        focusInvalid: false,
        rules: {
            title: {
                required: true
            },
            'options[]': {
                required: true
            },
            answer: {
                required: true,
                digits: true
            },
            marks: {
                required: true,
                digits: true
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#setup_question')).show();
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        unhighlight: function (element) { // <-- fires when element is valid
            $(element).closest('.form-group').removeClass('has-error').addClass('has-info');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            $(e).remove();
        }
    });
}

/**
* Function to intialize class data table
*
* return void
*/
function initUsersTable() {
    var ajaxUrl = SITEURL + "admin/users/get_list_of_users";
    $("#list_of_users").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null, null, null, null, null, null, {bSortable:false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
        }
    });
}

/**
* Function to intialize on cahgne for class
*
*/
function initClassOnchange() {
    $("#exam_id").on("change", function() {
        initQuestionsDataTable();
    });
}