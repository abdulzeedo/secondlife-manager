/**
 * Global constants
 */
const DATE_FORMAT = 'DD-MM-YYYY H:m:s';
$(function () {
    /**
     * Implement barcode scan detector event and initialize it
     *
     * routes: '/phones' and '/'
     */
    new BarcodeScanner();
    $(document).on('barcode',function(e,code){
        if($('.modal').is(':hidden')
            && window.location.pathname === "/phones"
            || window.location.pathname === "/") {
            /**
             * Set the value of input field so that all other
             * filters can still be applied
             */
            $('#q').val(code);
            $("#home-filter-form").submit();
        }
    });


    /**
     * Initialize dateTimePicker for return Date
     *
     * routes: item returns add/edit/modal
     */
    $('#returnDateTimePicker').datetimepicker({
        format: DATE_FORMAT,
    });
});

