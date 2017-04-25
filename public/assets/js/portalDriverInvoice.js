$('.submitPortalPayment').click(function() {
    bootbox.confirm({ 
        size: "medium",
        title: "Payment Confirmation",
        message:  "Are you sure you want to perform this transaction?",
        callback: function(result){ 
            if(result){
                $('#portalPayment').submit();
            } else {
                return false;
            }
        }
    });
});

$('#btnPrintInvoice').click(function(){
    window.print();
});