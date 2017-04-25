$('.submitPortalPayment').click(function() {
    bootbox.prompt({
        size: "small",
        title: "Enter your password in your UnionBank account",
        inputType: 'password',
        callback: function (result) {
            if(result == "Hooleh12345"){
                $('#portalPayment').submit();
            } else {
                return false
            }
        }
    });
});

$('#btnPrintInvoice').click(function(){
    window.print();
});


