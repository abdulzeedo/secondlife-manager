$(function () {
    /**
     * Implement barcode scan detector event and initialize it
     *
     */
    new BarcodeScanner();
    $(document).on('barcode',function(e,code){
        if($('.modal').is(':hidden') && window.location.pathname === "/phones") {
            /**
             * Set the value of input field so that all other
             * filters can still be applied
             */
            $('#q').val(code);
            $("#home-filter-form").submit();
        }
    });

});