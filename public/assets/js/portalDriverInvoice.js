$('.btnPortalSubmitPayment').click(function() {
    var strUsername = $("#inputUsername").val();
    var strPassword = $("#inputPassword").val();
    if(strUsername == "teamintern" && strPassword == "secret"){
        $('#portalPayment').submit();
    } else {
        alert("Invalid Credential");
    }
});

$('#btnPrintInvoice').click(function(){
    window.print();
});
