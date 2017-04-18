$("#dtblViolation").DataTable();
    
$('document').ready(function(){
    $('.loading').addClass('hide');
    $('#dtblViolation tbody').on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
    } );

});

$(".addViolation").click(function(){
    if($('#form').data('bs.validator').validate().hasErrors()) {
        $('#form').data('bs.validator').reset();
    }
    $("#formErrorMessage").hide();
    $("#inputCode").val("");
    $("#inputDescription").val("");
    $("#inputFine").val("");
    
});

$('#form').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        $('#loadingViolation').addClass('overlay');
        $('#loadingViolationDesign').addClass('fa fa-refresh fa-spin')
        /* 
            for create violation loading state
        */
        var $btnCreateViolation = $('#btnCreateViolation');
        $btnCreateViolation.button('loading');
        /*
            Submit data to the controller using ajax
        */
        var strCode = $("#inputCode").val();
        var strDescription = $("#inputDescription").val();
        var dblFine = $("#inputFine").val();
        $.ajax({
            url: "violation/create",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: { strCode : strCode, strDescription : strDescription, dblFine : dblFine },
            success:function(data){
                if(data == 'error'){
                    $("#formErrorMessage").show();
                    $btnCreateViolation.button('reset');  
                } else{
                    $('#violationTable').empty();
                    $('#violationTable').append(data);
                    $('#modalAddViolation').modal('hide');
                    $('#successCode').text(strCode);
                    $('#successDescription').text(strDescription);
                    $('#successFine').text(dblFine);
                    $('#modalSuccessfulCreation').modal('show');
                    $btnCreateViolation.button('reset');  
                }
                
            },error:function(data){ 
                alert("Error!");
            }
        });
    }
    return false;
})


$('#dtblViolation tbody').on('click', '.btnUpdateViolation', function () {
    if($('#formUpdate').data('bs.validator').validate().hasErrors()) {
        $('#formUpdate').data('bs.validator').reset();
    }
    var violationPrimaryKey = $(this).parent().parent().parent().find('.classViolationPrimaryKey').text(); 
    var violationCode = $(this).parent().parent().parent().find('.classCode').text().trim(); 
    var violationDescription = $(this).parent().parent().parent().find('.classDescription').text().trim();
    var violationFine = $(this).parent().parent().parent().find('.classFine').text().trim().substring(2); 
    
    $("#inputCodeUpdate").val(violationCode);
    $("#inputDescriptionUpdate").val(violationDescription);
    $("#inputFineUpdate").val(violationFine);
    $("#inputViolationPrimaryKey").val(violationPrimaryKey);
    $("#formErrorMessageUpdate").hide();
    $('#modalUpdateViolation').modal('show');

} );


$('#formUpdate').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        /* 
            for create enforcer loading state
        */
        var $btnUpdateViolationSubmit = $('#btnUpdateViolationSubmit');
        $btnUpdateViolationSubmit.button('loading');
        /*
            Submit data to the controller using ajax
        */
        var strCode = $("#inputCodeUpdate").val();
        var strDescription = $("#inputDescriptionUpdate").val();
        var dblFine = $("#inputFineUpdate").val();
        var strPrimaryKey = $("#inputViolationPrimaryKey").val();
        $.ajax({
            url: "violation/update",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: {strPrimaryKey : strPrimaryKey, strCode : strCode, strDescription : strDescription, dblFine : dblFine},
            success:function(data){
                if(data == 'error'){
                    $("#formErrorMessageUpdate").show();
                    $btnUpdateViolationSubmit.button('reset');  
                } else{
                    $('#violationTable').empty();
                    $('#violationTable').append(data);
                    $('#modalUpdateViolation').modal('hide');  
                    $('#updatedCode').text(strCode);
                    $('#updatedDescription').text(strDescription);
                    $('#updatedFine').text(dblFine);
                    $('#modalSuccessfulUpdate').modal('show');
                    $btnUpdateViolationSubmit.button('reset');
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
    $('#loadingViolation').addClass('overlay');
    $('#loadingViolationDesign').addClass('fa fa-refresh fa-spin')
    $.ajax({
        url: "violation/filter",
        type:"POST",
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        data: {selFilterValue : selFilterValue},
        success:function(data){
            $('#violationTable').empty();    
            $('#violationTable').append(data);
        },error:function(data){ 
            alert("Error!");
        }
    });
});

$('#dtblViolation tbody').on('click', '.btnDeleteViolation', function () {
    var strCode = $(this).parent().parent().parent().parent().parent().find('.classCode').text();
    var strDescription = $(this).parent().parent().parent().parent().parent().find('.classDescription').text();
    var dblFine = $(this).parent().parent().parent().parent().parent().find('.classFine').text().substring(2);
    var strPrimaryKey = $(this).parent().parent().parent().parent().parent().find('.classViolationPrimaryKey').text(); 
    bootbox.confirm({ 
        size: "small",
        title: "<b>Delete Violation Code " + strCode + " : " + strDescription + "</b>",
        message:  "This violation will " + strCode + " not be available!",
        callback: function(result){ 
            if(result){
                $('#loadingViolation').addClass('overlay');
                $('#loadingViolationDesign').addClass('fa fa-refresh fa-spin')
                $.ajax({
                    url: "violation/delete",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: {strPrimaryKey : strPrimaryKey},
                    success:function(data){
                        $('#violationTable').empty();
                        $('#violationTable').append(data);  
                        $('#deletedViolationCode').text(strCode);
                        $('#deletedViolationDescription').text(strDescription);
                        $('#deletedViolationFine').text(dblFine);
                        $('#modalDeleteViolationSuccess').modal('show');
                    },error:function(data){ 
                        alert("Error!");
                    }
                });
            }
        }
    })
} );

$('#dtblViolation tbody').on('click', '.btnRestoreViolation', function () {
    var strCode = $(this).parent().parent().parent().parent().parent().find('.classCode').text();
    var strDescription = $(this).parent().parent().parent().parent().parent().find('.classDescription').text();
    var dblFine = $(this).parent().parent().parent().parent().parent().find('.classFine').text().substring(2);
    var strPrimaryKey = $(this).parent().parent().parent().parent().parent().find('.classViolationPrimaryKey').text(); 
    bootbox.confirm({ 
        size: "small",
        title: "<b>Restore Violation Code " + strCode + " : " + strDescription + "</b>",
        message:  "This violation will " + strCode + " be available!",
        callback: function(result){ 
            if(result){
                $('#loadingViolation').addClass('overlay');
                $('#loadingViolationDesign').addClass('fa fa-refresh fa-spin')
                $.ajax({
                    url: "violation/restore",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: {strPrimaryKey : strPrimaryKey},
                    success:function(data){
                        $('#violationTable').empty();
                        $('#violationTable').append(data);  
                        $('#restoredViolationCode').text(strCode);
                        $('#restoredViolationDescription').text(strDescription);
                        $('#restoreddViolationFine').text(dblFine);
                        $('#modalRestoreViolationSuccess').modal('show');
                    },error:function(data){ 
                        alert("Error!");
                    }
                });
            }
        }
    })
} );
