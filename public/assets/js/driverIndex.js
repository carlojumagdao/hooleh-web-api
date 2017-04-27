$('#dtblDriver').dataTable();
$('document').ready(function(){
    $('.loading').addClass('hide');
    $('#dtblDriver tbody').on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
	});
});

var time = new Date().getTime();
$(document.body).bind("mousemove keypress", function(e) {
 time = new Date().getTime();
});

function refresh() {
 if(new Date().getTime() - time >= 6000) 
     window.location.reload(true);
 else 
     setTimeout(refresh, 1000);
}

setTimeout(refresh, 1000);
