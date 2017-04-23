$('document').ready(function(){
    $('.loading').addClass('hide');
    $('#driverTicketsTable tbody').on('click', '.clickable-row', function () {
        window.location = $(this).data("href");
    } );

});