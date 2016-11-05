$(document).ready(function () {
    var date_input = $('input[name="birth_date"]'); //our date input has the name "date"
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    var options = {
        format: 'dd/mm/yyyy',
        endDate: '-1d',
        setDate: new Date(2006, 11, 24),
        container: container,
        //todayHighlight: true,
        autoclose: true,
        startView: 2 // start view of years
    };
    date_input.datepicker(options);
})
