$('#dtblDriver').dataTable();
$('document').ready(function(){
    $('.loading').addClass('hide');
    $('#dtblDriver tbody').on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
	});
});