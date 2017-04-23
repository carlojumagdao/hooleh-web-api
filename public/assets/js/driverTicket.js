$('.controlNumber').click(function() {
    var strControlNumber = $(this)..text(); 
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
    });
});