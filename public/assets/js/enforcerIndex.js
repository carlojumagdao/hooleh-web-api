$('#dtblEnforcer').dataTable();
$('document').ready(function(){
    $('.loading').addClass('hide');
    $('#dtblEnforcer tbody').on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
    } );

});

$(".addEnforcer").click(function(){
    var passwordGenerated = randomString(7);
    if($('#form').data('bs.validator').validate().hasErrors()) {
        $('#form').data('bs.validator').reset();
    }
    $("#formErrorMessage").hide();
    $("#inputPassword").val(passwordGenerated);
    $("#inputReEnterPassword").val(passwordGenerated);
    $("#inputFirstname").val("");
    $("#inputLastname").val("");
    $("#inputEnforcerID").val("");
    $(".passwordCredential").hide();
    $("#setPasswordBlock").show();
});


function randomString(length){
    var stringGenerated = '';
    var chars = '0123456789!@#$_&abcdefghijklmnopwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for(var i = length; i > 0; --i){
        stringGenerated += chars[Math.floor(Math.random() * chars.length)];
    }
    return stringGenerated;
}

$(".passwordCredential").hide();
$("#setPassword").click(function(){
    $(".passwordCredential").show();
    $("#setPasswordBlock").hide();
    $("#inputPassword").val("");
    $("#inputReEnterPassword").val("");
});
$("#autoGeneratePassword").click(function(){
    $(".passwordCredential").hide();
    $("#setPasswordBlock").show();
    var passwordGenerated = randomString(7);
    $("#inputPassword").val(passwordGenerated);
    $("#inputReEnterPassword").val(passwordGenerated);
});


$('#form').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        $('#loadingEnforcer').addClass('overlay');
        $('#loadingEnforcerDesign').addClass('fa fa-refresh fa-spin')
        /* 
            for create enforcer loading state
        */
        var $btnCreateEnforcer = $('#btnCreateEnforcer');
        $btnCreateEnforcer.button('loading');
        /*
            Submit data to the controller using ajax
        */
        var strFirstname = $("#inputFirstname").val();
        var strLastname = $("#inputLastname").val();
        var strEnforcerID = $("#inputEnforcerID").val();
        var strPassword = $("#inputPassword").val();
        var strReEnterPassword = $("#inputReEnterPassword").val();
        $.ajax({
            url: "enforcer/create",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { strFirstname : strFirstname, strLastname : strLastname, strEnforcerID : strEnforcerID, strPassword : strPassword },
            success:function(data){
                if(data == 'error'){
                    $("#formErrorMessage").show();
                    $btnCreateEnforcer.button('reset');  
                } else{
                    $('#enforcerTable').empty();
                    $('#enforcerTable').append(data);
                    $('#modalAddEnforcer').modal('hide');
                    $('#successUsername').text(strEnforcerID);
                    $('#successPassword').text(strPassword);
                    $('#successFirstname').text(strFirstname);
                    $('#successLastname').text(strLastname);
                    $('#modalSuccessfulCreation').modal('show');
                    $btnCreateEnforcer.button('reset');
                    $(".selFilter").val(0);  
                }
                
            },error:function(data){ 
                alert("Error!");
            }
        });
    }
    return false;
})

$("#btnCreateAnotherEnforcer").click(function(){
    $('#modalSuccessfulCreation').modal('hide');
    var passwordGenerated = randomString(7);
    if($('#form').data('bs.validator').validate().hasErrors()) {
        $('#form').data('bs.validator').reset();
    }
    $("#formErrorMessage").hide();
    $("#inputPassword").val(passwordGenerated);
    $("#inputReEnterPassword").val(passwordGenerated);
    $("#inputFirstname").val("");
    $("#inputLastname").val("");
    $("#inputEnforcerID").val("");
    $(".passwordCredential").hide();
    $("#setPasswordBlock").show();
    $('#modalAddEnforcer').modal('show');
});

$('#dtblEnforcer tbody').on('click', '.btnRenameEnforcer', function () {
    if($('#formRename').data('bs.validator').validate().hasErrors()) {
        $('#formRename').data('bs.validator').reset();
    }
    var enforcerPrimaryKey = $(this).parent().parent().parent().find('.classEnforcerPrimaryKey').text(); 
    var enforcerFirstname = $(this).parent().parent().parent().find('.classFirstname').text(); 
    var enforcerLastname = $(this).parent().parent().parent().find('.classLastname').text(); 
    
    $("#inputFirstnameRename").val(enforcerFirstname);
    $("#inputLastnameRename").val(enforcerLastname);
    $("#inputEnforcerPrimaryKey").val(enforcerPrimaryKey);
    $("#formErrorMessageRename").hide();
    $('#modalRenameEnforcer').modal('show');

} );


$('#formRename').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        /* 
            for create enforcer loading state
        */
        var $btnRenameEnforcerSubmit = $('#btnRenameEnforcerSubmit');
        $btnRenameEnforcerSubmit.button('loading');
        /*
            Submit data to the controller using ajax
        */
        var strFirstname = $("#inputFirstnameRename").val();
        var strLastname = $("#inputLastnameRename").val();
        var strPrimaryKey = $("#inputEnforcerPrimaryKey").val();
        $.ajax({
            url: "enforcer/update",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: {strPrimaryKey : strPrimaryKey, strFirstname : strFirstname, strLastname : strLastname},
            success:function(data){
                if(data == 'error'){
                    $("#formErrorMessageRename").show();
                    $btnRenameEnforcerSubmit.button('reset');  
                } else{
                    $('#enforcerTable').empty();
                    $('#enforcerTable').append(data);
                    $('#modalRenameEnforcer').modal('hide');  
                    $('#updatedName').text(strFirstname +' '+ strLastname);
                    $('#modalSuccessfulRename').modal('show');
                    $btnRenameEnforcerSubmit.button('reset');
                    $(".selFilter").val(0); 
                }
                
            },error:function(data){ 
                alert("Error!");
            }
        });
    }
    return false;
})

$("#autoGeneratePasswordReset").click(function(){
    var passwordGenerated = randomString(7);
    $("#inputPasswordReset").val(passwordGenerated);
    $("#inputReEnterPasswordReset").val(passwordGenerated);
});

$('#dtblEnforcer tbody').on('click', '.btnResetPassword', function () {
    if($('#formResetPassword').data('bs.validator').validate().hasErrors()) {
        $('#formResetPassword').data('bs.validator').reset();
    }
    var userID = $(this).parent().parent().parent().find('.classUserID').text();
    $("#inputUserID").val(userID); 
    $('#modalResetPassword').modal('show');
    $("#inputPasswordReset").val("");
    $("#inputReEnterPasswordReset").val("");
} );

$('#formResetPassword').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        /* 
            for create enforcer loading state
        */
        var $btnResetPasswordSubmit = $('#btnResetPasswordSubmit');
        $btnResetPasswordSubmit.button('loading');
        /*
            Submit data to the controller using ajax
        */
        var intUserID = $("#inputUserID").val();
        var strPassword = $("#inputPasswordReset").val();
        $.ajax({
            url: "enforcer/resetpassword",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: {intUserID : intUserID, strPassword : strPassword},
            success:function(data){
                if(data == 'error'){
                    $btnResetPasswordSubmit.button('reset');  
                } else{
                    $('#modalResetPassword').modal('hide');  
                    $('#updatedPassword').text(strPassword);
                    $('#modalResetPasswordSuccess').modal('show');
                    $btnResetPasswordSubmit.button('reset');
                }
                
            },error:function(data){ 
                alert("Error!");
            }
        });
    }
    return false;
})


$( ".selFilter" ).change(function() {
    var selFilterValue = $( ".selFilter" ).val();
    $('#loadingEnforcer').addClass('overlay');
    $('#loadingEnforcerDesign').addClass('fa fa-refresh fa-spin')
    $.ajax({
        url: "enforcer/filter",
        type:"POST",
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        data: {selFilterValue : selFilterValue},
        success:function(data){
            $('#enforcerTable').empty();    
            $('#enforcerTable').append(data);
        },error:function(data){ 
            alert("Error!");
        }
    });
});

$('#dtblEnforcer tbody').on('click', '.btnSuspendEnforcer', function () {
    var strFirstname = $(this).parent().parent().parent().parent().parent().find('.classFirstname').text();
    var strLastname = $(this).parent().parent().parent().parent().parent().find('.classLastname').text();
    var strPrimaryKey = $(this).parent().parent().parent().parent().parent().find('.classEnforcerPrimaryKey').text(); 
    bootbox.confirm({ 
        size: "small",
        title: "<b>Suspend " + strFirstname + " " + strLastname + "</b>",
        message:  "This enforcer will not be able to:<ul><li>Login to Hooleh app.</li><li>Access any data to Hooleh system.</li></ul>",
        callback: function(result){ 
            if(result){
                $('#loadingEnforcer').addClass('overlay');
                $('#loadingEnforcerDesign').addClass('fa fa-refresh fa-spin')
                $.ajax({
                    url: "enforcer/suspend",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: {strPrimaryKey : strPrimaryKey},
                    success:function(data){
                        $('#enforcerTable').empty();
                        $('#enforcerTable').append(data);  
                        $('#suspendedEnforcer').text(strFirstname + " " + strLastname);
                        $('#modalSuspendEnforcerSuccess').modal('show');
                    },error:function(data){ 
                        alert("Error!");
                    }
                });
            }
        }
    })
} );


$('#dtblEnforcer tbody').on('click', '.btnRestoreEnforcer', function () {
    var strFirstname = $(this).parent().parent().parent().find('.classFirstname').text();
    var strLastname = $(this).parent().parent().parent().find('.classLastname').text();
    var strPrimaryKey = $(this).parent().parent().parent().find('.classEnforcerPrimaryKey').text(); 
    bootbox.confirm({ 
        size: "small",
        title: "<b>Restore " + strFirstname + " " + strLastname + "</b>",
        message:  "This enforcer will be able to access Hooleh application",
        callback: function(result){ 
            if(result){
                $('#loadingEnforcer').addClass('overlay');
                $('#loadingEnforcerDesign').addClass('fa fa-refresh fa-spin')
                $.ajax({
                    url: "enforcer/restore",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: {strPrimaryKey : strPrimaryKey},
                    success:function(data){
                        $('#enforcerTable').empty();
                        $('#enforcerTable').append(data);
                        $('#restoredEnforcer').text(strFirstname + " " + strLastname);
                        $('#modalRestoredEnforcerSuccess').modal('show');
                        $(".selFilter").val(0); 
                    },error:function(data){ 
                        alert("Error!");
                    }
                });
            }
        }
    })
} );












