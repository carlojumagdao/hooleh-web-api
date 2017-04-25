$('.submitPortalPayment').click(function() {
    bootbox.confirm({ 
        size: "medium",
        title: "UnionBank Payment Confirmation",
        message:  "Are you sure you want to perform this transaction using your unionbank account?",
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