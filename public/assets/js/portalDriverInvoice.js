$('.btnPortalSubmitPayment').click(function() {
    var strUsername = $("#inputUsername").val();
    var strPassword = $("#inputPassword").val();
    if(strUsername == "teamintern" && strPassword == "secret"){
        $('#modalSubmitPayment').modal('hide');
    	bootbox.prompt({
    		size: "small",
		    title: "Please choose an account you want to use.",
		    inputType: 'select',
		    inputOptions: [
		        {
		            text: '<b>XXXX - XXXX - XXXX - 7191</b>',
		            value: '',
		        },
		        {
		            text: '<b>XXXX - XXXX - XXXX - 1018</b>',
		            value: '2',
		        },
		        {
		            text: '<b>XXXX - XXXX - XXXX - 8112</b>',
		            value: '3',
		        }
		    ],
		    callback: function (result) {
		        console.log(result);
		        $('#portalPayment').submit();
		    }
		});
    } else {
        alert("Invalid Credential");
    }
});

$('#btnPrintInvoice').click(function(){
    window.print();
});
