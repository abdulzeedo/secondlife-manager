/**
 * Event triggered when a modal is being loaded and shown.
 * Do some initializing stuff such as checking for select/datepicker scripts to initialize
 */
$('.modal').on('ajax.modal.loaded', (event) => {

    /**
     * Add Transactions modal datepicker initialization
     */
    if ($('.modal .datepicker').is("#transactionDateTimePicker")) {
        $('#transactionDateTimePicker').datetimepicker({
            format: 'DD-MM-YYYY H:m:s'
        });
    }
});
/**
 * Event triggered when a form is being submitted via ajax.
 * Do some validation here
 * @return bool | False there are validation errors
 */
$('body').on('ajax.before.submit', "#transactions",(event, $form) => {
    var isValid = true;
    var $dateField = $form.find('[name="date"]');
    if (($dateField.val()) === "") {
        $dateField.addValidationMessage('Please specify a date of sale.', 'error');
        isValid = false;
    }

    var $table = $('#phones-table');
    if (!$table.find('tbody tr').exists()) {
        $('[name="phone_id"]').addValidationMessage('Please select at least on phone', 'error');
        isValid = false;
    }

    $form.data('is-valid', isValid);
});
/**
 * Event triggered when a 400 with ajax response is given after submission.
 * Add some errors here to table's row
 */
$('body').on("error.json.response", '#transactions', (event, json) => {
    console.log(json);
    json.errors.phones.forEach((el, val) => {
        let id = el.phone.id;
        let row = $("#phones-table").find(`[data-id=${id}]`).parents('tr');
        let newRow =  $("<tr class='warning'>" +
            `<td colspan='4'>${el.phone.message}</td>` +
            "</tr>").data('id', id);
        // If error row already exists, update it
        if (row.next().data('id') === id)
            row.next().html(newRow);
        row.after(newRow);
        row.addClass('danger');
    });
});
/**
 * Event triggered when a selection is being made: in this case for suppliers only.
 * Callback the correct function from here whenever a select event for suppliers list is being triggered.
 */

$('body').on('change', '#filter-supplier-id',(event) => {

    // Get all suplier checkboxes starting with supplier-id-* and ending with any number
    var selectedSuppliersID = $("input[id^='supplier-id-']:checkbox:checked").map((i, el)=>{return el.value;}).get();
    console.log(selectedSuppliersID);
    if (selectedSuppliersID.length > 0)
        getSupplierOrdersListAJAX(selectedSuppliersID)
            .then(function (response) {
                $('#filter-supplier-orders').html(response);
            })
            .fail(function () {
                $('#filter-supplier-orders').html("<b>Supplier orders:</b><br>" +
                                                  "Something went wrong. Check your internet connection!");
            });

});