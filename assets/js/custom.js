/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 var ajaxFlag = true;
 $(function () {
    init();
});
 function init() {
    initSubmitExam();
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
    initAdminUserCreationvalidation();
    initStartExam();
    var pageUrl = window.location.href;
    if (pageUrl.indexOf("progress") != -1 || pageUrl.indexOf("home/freeexam") != -1) {
        initQuestionByExam();
    }
    initLeftBarBlur();
    initUserCompletedExamsTable();
    initPostExamResult();
    initLoadExamReports();
    initExamIdchange();
    initSendNotifications();
    initDownloadExamReport();
}

/**
* Function to download the exam report
*
* return void
*/
function initDownloadExamReport() {
    $("#export_button").on("click", function() {
        var ajaxUrl = $(this).data("href");
        var examId = $("#report_exam_id").val();
        var userType = $("#user_type").val();
        window.open(ajaxUrl+"/"+examId+"/"+userType);
    });
}


/**
* Function to send notification
*
* return void
*/
function initSendNotifications() {
    $(".send-notification").each(function() {
        $(this).on('click', function() {
            var ajaxUrl = $(this).data("href");
            var examId = $(this).data("exam-id");
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {"exam_id":examId},
                async: true,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if(response['status'] == 500) {
                        swal(response['msg']);
                    } else {
                        swal(response['msg']);
                    }
                }
            });
        });
    });
}

/**
* Function to exam id change
*
* return void
*/
function initExamIdchange() {
    $("#report_exam_id").on("change", function() {
        initLoadExamReports();
    });
    $("#user_type").on("change", function() {
        initLoadExamReports();
        var pageUrl = window.location.href;
        if (pageUrl.indexOf("users") != -1 || pageUrl.indexOf("exams") != -1) {
            initUsersTable();
            initExamsDataTable();
        }
    });
}

/**
* Function to load exam results
*
* return void
*/
function initLoadExamReports() {
    var ajaxUrl = $("#list_of_exam_reports").data("href");
    var exam_id = $("#report_exam_id").val();
    var userType = $("#user_type").val();
    $("#list_of_exam_reports").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null,null,null,null, null],
        "bOrderable": false,
        "aaSorting": [[3, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl,
            "data": function(d) {
                d.exam_id = exam_id;
                d.user_type = userType;
            }
        },
        "fnDrawCallback": function () {
        }
    });
}

/**
* Function to initialize calculate and post exam result
* 
* return void
*/
function initPostExamResult() {
    $(".post-result-button").each(function() {
        $(this).on("click", function() {
            var ajaxUrl = $(this).data("href");
            var examId = $(this).data("exam-id");
            var completedUsers = $(this).data("completed-users");
            var registeredUsers = $(this).data("registered-users");
            var obj = $(this);
            obj.hide();
            obj.parent().find(".loading-div").html("<img src='"+SITEURL+"assets/images/loading.gif' width='20' height='25'>");
            if (completedUsers < registeredUsers) {
                swal({
                    text: "There are few more users left to complete this. So, Do you still wants to post the result?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn btn-primary",
                    titleClass: "mine",
                    confirmButtonText: "Yes, I'm sure.",
                    cancelButtonClass: "btn btn-default",
                    closeOnConfirm: true,
                    allowOutsideClick: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: ajaxUrl,
                            type: 'POST',
                            data: {"exam_id":examId, "save_result": 0},
                            async: false,
                            cache: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response['status'] == 200) {
                                    initExamsDataTable();
                                } else {
                                    obj.show();
                                    obj.parent().find(".loading-div").html("");
                                    swal(response['msg']);
                                }
                            }
                        });
                    } else {
                        obj.show();
                        obj.parent().find(".loading-div").html("");
                    }
                });
            } else {
                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {"exam_id":examId, "save_result": 1},
                    async: false,
                    cache: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response['status'] == 200) {
                            initExamsDataTable();
                        } else {
                            obj.show();
                            obj.parent().find(".loading-div").html("");
                            swal(response['msg']);
                        }
                    }
                });
            }
        });
    });
}


/**
* Function to initialize user completed exams data table
* 
* return void
*/
function initUserCompletedExamsTable() {
    var ajaxUrl = $("#user_completed_exams").data("href");
    $("#user_completed_exams").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null,null,null,null, null],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
        }
    });
}

/**
* Function to unbind the click for left bar menu whil user taking the exam
* 
* return void
*/
function initLeftBarBlur() {
    var pageUrl = window.location.href;
    if (pageUrl.indexOf("progress") != -1) {
        $(".metismenu").find("li.list-item-left").on("click", function(e) {
            e.preventDefault();
        });
    }
}

/**
* Function to initialize the check box and radio button
*
* return void
*/
function initSubmitExam() {
    $("#submit_question").on("click", function() {
        swal({
            text: "Are you sure to submit the exam?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-primary",
            titleClass: "mine",
            confirmButtonText: "Yes, I'm sure.",
            cancelButtonClass: "btn btn-default",
            closeOnConfirm: false,
            allowOutsideClick: false
        }, function () {
            var overlay = jQuery('<div id="overlay"> </div>');
            overlay.appendTo(document.body);
            var ajaxResponse = saveAnswer(1);
            ajaxResponse.success(function(response) {
                if (response['status'] == 200) {
                    if (CONTROLLER == "dashboard")
                        location.href = SITEURL+"user/dashboard/complete";
                    else if (CONTROLLER == 'home')
                        location.href = SITEURL+"home/complete";
                }
                else {
                    swal("We are facing some technical issues. Can you please submit your answer again");    
                }
            });
        });
    });
}

/**
* Function to save a answer for question
*
* return void
*/
function saveAnswer(flag) {
    var ajaxUrl = "";
    var pageUrl = window.location.href;
    var pageUrlArray = pageUrl.split("/").reverse();
    var questionId = $("#question_id").val();
    var questionNo = $("#question_no").val();
    var answer = $("input[name=answer]:checked").val();
    if (CONTROLLER == "dashboard") {
        ajaxUrl = SITEURL+"user/dashboard/save_user_answer"
        examId = pageUrlArray[0];
    } else if (CONTROLLER == "home") {
        ajaxUrl = SITEURL+"home/save_user_answer"
        examId = $("#free_exam_id").val();
    }
    return $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {'answer':answer,"exam_id":examId, "question_id":questionId, "question_no": questionNo, "flag":flag},
        async: false,
        cache: false,
        dataType: 'json'
    });
}

function timedCount(c)
{

    var hours = parseInt( c / 3600 ) % 24;
    var minutes = parseInt( c / 60 ) % 60;
    var seconds = c % 60;

    var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);

    if (c > 0) {
        c = c - 1;
        t = setTimeout(function()
        {
           timedCount(c)
       },
       1000);
        $('#timer').html(result);
    }
    if(parseInt(c) == 0 )
    {
        var overlay = jQuery('<div id="overlay"> </div>');
        overlay.appendTo(document.body);
        var ajaxResponse = saveAnswer(1);
        ajaxResponse.success(function(response) {
            if (response['status'] == 200) {
                if (CONTROLLER == "dashboard")
                    location.href = SITEURL+"user/dashboard/complete";
                else if (CONTROLLER == 'home')
                    location.href = SITEURL+"home/complete";
            }
            else {
                swal("We are facing some technical issues. Can you please submit your answer again");    
            }
        });
    }
}

/**
* Function to initialize question by question
* 
* return void
*/
function initQuestionByExam() {
    var pageUrl = window.location.href;
    var pageUrlArray = pageUrl.split("/").reverse();
    var ajaxUrl =  "";
    if (CONTROLLER == "home") {
        ajaxUrl = SITEURL+"home/get_user_exam_info";
        questionUrl = SITEURL+"home/load_question";
        examId = $("#free_exam_id").val();
    } else if (CONTROLLER == "dashboard") {
        ajaxUrl = SITEURL+"user/dashboard/get_user_exam_info";
        questionUrl = SITEURL+"user/dashboard/load_question";
        examId = pageUrlArray[0];
    }
    if(ajaxFlag) {
        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            data: {"exam_id":examId},
            async: false,
            cache: false,
            dataType: 'json',
            success: function (response) {
                ajaxFlag = false;
                timedCount(response['exam_time_limit']*60);
            }
        });
    }
    $.ajax({
        url: questionUrl,
        type: 'POST',
        data: {"exam_id":examId},
        async: false,
        cache: false,
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 200) {
                var htmlString = prepareQuestionHtml((parseInt(response['data']['no_of_questions_completed']) + 1), response['data']['title'], response['data']['question_id'], response['data']['options'], "", response['data']['no_of_questions'], 1);
                $("#question_div").html(htmlString);
                if (parseInt(response['data']['no_of_questions_completed']) > 0)
                    initPrevButtonQuestion();
                if (parseInt(response['data']['no_of_questions_completed']) < response['data']['no_of_questions'])
                    initNextButtonQuestion();
                initSubmitExam();
            }
        }
    });
}

/**
* Function to initialize a functionality for load a next question
*
* return void
*/
function initNextButtonQuestion() {
    $("#next_question").on("click", function() {
        var ajaxResponse = saveAnswer(0);
        ajaxResponse.success(function(response) {
            if (response['status'] == 200)
                initQuestionByExam();
            else
                swal("We are facing some technical issues. Can you please submit your answer again");    
        });
    });
}

/**
* Function to initialize a functionality for load a prev question
*
* return void
*/
function initPrevButtonQuestion() {
    $("#prev_question").on("click", function() {
        var ajaxUrl = "";
        var pageUrl = window.location.href;
        var pageUrlArray = pageUrl.split("/").reverse();
        var questionNo = $("#question_no").val();
        var examId = "";
        if (CONTROLLER == "dashboard") {
            ajaxUrl = SITEURL+"user/dashboard/load_prev_question";
            examId = pageUrlArray[0];
        } else if (CONTROLLER == "home") {
            ajaxUrl = SITEURL+"home/load_prev_question";
            examId = $("#free_exam_id").val();
        }
        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            data: {"exam_id":examId, "question_no":questionNo},
            async: false,
            cache: false,
            dataType: 'json',
            success: function (response) {
                if (response['status'] == 200) {
                    response['data']['question_no'] = parseInt(response['data']['question_no']);
                    var htmlString = prepareQuestionHtml(parseInt(response['data']['question_no']), response['data']['title'], response['data']['question_id'], response['data']['options'], parseInt(response['data']['user_answer']), response['data']['no_of_questions'], 0);

                    $("#question_div").html(htmlString);
                    if (response['data']['question_no'] != 1)
                        initPrevButtonQuestion();
                    if (response['data']['question_no'] < response['data']['no_of_questions'])
                        initPrevNextButton();
                    initSubmitExam();
                }
                else
                    swal("We are facing some technical issues. Can you please try again");
            }
        });
    });
}

/**
* Function to load the next question after cliking prev button
*
* return void
*/
function initPrevNextButton() {
    $("#prev_next_question").on("click", function() {
        saveAnswer(0);
        var ajaxUrl = "";
        var pageUrl = window.location.href;
        var pageUrlArray = pageUrl.split("/").reverse();
        var questionNo = $("#question_no").val();
        if (CONTROLLER == "dashboard") {
            ajaxUrl = SITEURL+"user/dashboard/load_next_question";
            examId = pageUrlArray[0];
        } else if (CONTROLLER == "home") {
            ajaxUrl = SITEURL+"home/load_next_question";
            examId = $("#free_exam_id").val();
        }
        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            data: {"exam_id":examId, "question_no": questionNo},
            async: false,
            cache: false,
            dataType: 'json',
            success: function (response) {
                if (response['status'] == 200) {
                    if (parseInt(response['data']['no_of_questions_completed']) == parseInt(response['data']['question_no']) && response['data']['flag_status'] == 1) {
                        initQuestionByExam();
                    }
                    else if (parseInt(response['data']['no_of_questions_completed']) == parseInt(response['data']['question_no'])) {
                        var htmlString = prepareQuestionHtml(parseInt(response['data']['question_no']), response['data']['title'], response['data']['question_id'], response['data']['options'], parseInt(response['data']['user_answer']), response['data']['no_of_questions'], 1);
                        $("#question_div").html(htmlString);
                        if (parseInt(response['data']['no_of_questions_completed']) > 0)
                            initPrevButtonQuestion();
                        if ((parseInt(response['data']['no_of_questions_completed'])) < response['data']['no_of_questions'])
                            initNextButtonQuestion();
                        initSubmitExam();
                    } else {
                        response['data']['question_no'] = parseInt(response['data']['question_no']);
                        var htmlString = prepareQuestionHtml(parseInt(response['data']['question_no']), response['data']['title'], response['data']['question_id'], response['data']['options'], parseInt(response['data']['user_answer']), response['data']['no_of_questions'], 0);

                        $("#question_div").html(htmlString);
                        if (response['data']['question_no'] != 1)
                            initPrevButtonQuestion();
                        if (response['data']['question_no'] < response['data']['no_of_questions'])
                            initPrevNextButton();
                        initSubmitExam();
                    }
                }
                else
                    swal("We are facing some technical issues. Can you please try again");
            }
        });
    });
}


/**
* Function to prepare question HTML
* 
* return string
*/
function prepareQuestionHtml(questionNo, questionTitle, questionId, questionOptions, userAnswer, noOfQuestions, flag) {
    var htmlString = "";
    htmlString += '<div class="col-lg-12"><h1>';
    htmlString += questionNo+") "+questionTitle;
    htmlString += '</h1></div>';
    htmlString += '<div class="col-lg-12"><input type="hidden" name="question_id" id="question_id" value="'+questionId+'"</div>';
    htmlString += '<div class="col-lg-12"><input type="hidden" name="question_no" id="question_no" value="'+questionNo+'"</div>';
    htmlString += '<div class="col-lg-12 mt10">';
    for (var i = 0; i < questionOptions.length ; i++) {
        var checked = "";
        if (userAnswer-1 == i)
            checked = "checked='checked'";
        htmlString += '<div class="col-lg-6 mt10"><div class="answer-radio"><label> <input type="radio" class="pl10 radio-answer" value="'+(i+1)+'" name="answer" '+checked+'> <i></i> '+questionOptions[i]+' </label></div></div>';
    }
    htmlString += '</div>';
    htmlString += '<div class="col-lg-12 mt20 mb20">';
    htmlString += '<div class="col-lg-10 text-right">';
    if (questionNo != 1)
        htmlString += '<button class="btn btn-primary" id="prev_question">Prev</button>';
    if (questionNo < noOfQuestions) {
        if (flag == 1)
            htmlString += '<button class="btn btn-primary ml5" id="next_question">Next</button>';
        else
            htmlString += '<button class="btn btn-primary ml5" id="prev_next_question">Next</button>';
    }
    if (questionNo == noOfQuestions)
        htmlString += '<button class="btn btn-primary ml5" id="submit_question">Submit</button></div>';
    htmlString += '<div class="col-lg-2 text-left"></div></div>';
    return htmlString;
}


/**
* Function to initialize exam
*
* return void
*/
function initStartExam() {
    $(".start-exam").each(function() {
        $(this).unbind('click').bind('click').on("click", function() {
            var ajaxUrl = $(this).data("href");
            var examId = $(this).data("exam-id");
            var overlay = jQuery('<div id="overlay"> </div>');
            overlay.appendTo(document.body);
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {"exam_id":examId},
                async: false,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if (response['status'] == 200)
                        location.href=response['url'];
                    else
                        location.href=SITEURL+"user/dashbaord";
                }
            });
        });
    });
}

function initValidators() {
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s-_+=.,/!@#$&*]+$/.test(value);
    }); 
}

function initAdminUserCreationvalidation() {
    $('#setup_user').validate({
        errorElement: 'label',
        errorClass: 'error',
        focusInvalid: false,
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            },
            passconf: {
                equalTo: "#password",
            },
            class_id: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Email is required",
                email: "Enter valid email address"
            },
            password: {
                required: "Password is required"
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#login_form')).show();
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
        },
        errorPlacement: function (error, element) {
            if (element.is(':radio')) {
                error.insertAfter(element.parent().next());
            }else if (element.is(":checkbox")) {
                error.insertAfter(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        }
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
            no_of_questions: {
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
        "aoColumns": [null, null,null,null, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
            initStartExam();
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
    var userType = $("#user_type").val();
    $("#list_of_exams").DataTable({
        "oTableTools": {
            "sSwfPath": SITEURL + "assets/admin/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": []
        },
        "processing": true,
        "serverSide": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "bFilter": true,
        "aoColumns": [null, null,null, null, null, null, null, {"bSortable": false, "className": "text-center",}, {"bSortable": false}],
        "bOrderable": false,
        "aaSorting": [[0, "desc"]],
        "destroy": true,
        "ajax": {
            "url": ajaxUrl,
            "data": function(d) {
                d.user_type = userType;
            }
        },
        "fnDrawCallback": function () {
            initIndividualDelete();
            initPostExamResult();
            initSendNotifications();
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
    $('a.more-options').on("click", function() {
        $(this).prev().find("div").children('input').valid();
    }).relCopy({append: removeLink});
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
    var userType = $("#user_type").val();
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
            "url": ajaxUrl,
            "data": function(d) {
                d.user_type = userType;
            }
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