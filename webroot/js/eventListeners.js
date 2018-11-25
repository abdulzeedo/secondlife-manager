$(function() {
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
        /**
         * Add Add/Edit item return form initialization
         */
        if ($('.modal .itemReturns')) {
            $('#returnDateTimePicker').datetimepicker({
                format: DATE_FORMAT,
            });
            if ($('.modal .itemReturns').is(':visible'))
                changeSelect();


        }


    });
    /**
     * Event triggered when a form is being submitted via ajax.
     * Do some validation here
     * @return bool | False there are validation errors
     */
    $('body').on('ajax.before.submit', "#transactions", (event, $form) => {
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
            let newRow = $("<tr class='warning'>" +
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

    $('body').on('change', '#filter-supplier-id', (event) => {

        // Get all suplier checkboxes starting with supplier-id-* and ending with any number
        var selectedSuppliersID = $("input[id^='supplier-id-']:checkbox:checked").map((i, el) => {
            return el.value;
        }).get();
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
    /**
     * Event listener for updated imiei list
     *
     * type: on input
     */
    $('body').on('input', '#exchanged-with-item-id .form-control', getListImiei);


    /**
     * Change the content of the child of interdependent select drop down UX elements,  whenever the parent's
     * selected value changes.
     *
     */
    window.changeSelect = function () {
        $('#item-returns-status-or-type-id').empty();

        // Get DOM object of item returns type
        var itemReturnsStatusOrTypeField = $('#item-returns-status-or-type-id').get(0);
        var returnTypeValue = $('#item-returns-type-id').val();
        // Set visible any related fields if necessary
        var refundField = $('#refund-amount');
        var exchangeWithItemField = $('#exchanged-with-item-id');
        if (returnTypeValue == '1') {
            refundField.parent().hide();
            refundField.val('');
            exchangeWithItemField.show()
        } // Exchange
        else if (returnTypeValue == '2') {
            exchangeWithItemField.hide();
            exchangeWithItemField.val('');
            refundField.parents(':hidden').show()
        } // refund
        else {
            refundField.parent().hide();
            refundField.val('');
            exchangeWithItemField.hide();
            exchangeWithItemField.val('');
        }
        itemReturnsStatus = Object.values(itemReturnsStatus);
        // Get only the type status related to the selected type
        var currentTypeStatus =
            itemReturnsTypeStatus
                .filter(status => status.item_returns_type_id == returnTypeValue);
        let j = 0;
        for (let i = 0; i < itemReturnsStatus.length + currentTypeStatus.length - 1; i++) {

            // Add type specific status
            if (i >= itemReturnsStatus.length - 1) {
                itemReturnsStatusOrTypeField.add(
                    new Option(currentTypeStatus[j].name, currentTypeStatus[j].id + '-type-status')
                );
                j++;
            }
            else {
                itemReturnsStatusOrTypeField.add(new Option(itemReturnsStatus[i], i+1))
            }
        }
        // Add remaining global status (close)
        itemReturnsStatusOrTypeField.add(new Option(itemReturnsStatus[itemReturnsStatus.length - 1], itemReturnsStatus.length));

        // For modals: update selectpicker
        $('.selectpicker').selectpicker('refresh');
    };

    /**
     * Event listener for return type drop down list
     *
     * type: onChange
     */
    $('body').on('change', '.itemReturns #item-returns-type-id', window.changeSelect);


    /**
     * Event listener for item return tracking field
     *
     * routes: itemReturn modal/add/edit
     */
    $('body').on('click', '#customer-return-tracking-button', showTrackingField);
    $('body').on('click', '#customer-resent-tracking-button', showTrackingField);
    /**
     * Show the requested tracking field
     *
     * @param field return from customer or to customer 0|1
     * @param e event
     */
    function showTrackingField(e) {
        var field = $(event.target);
        field.addClass('hidden');
        if (field.is('#customer-return-tracking-button')) {

            $('#customer-return-tracking').parents('.hidden').removeClass('hidden')
        }
        else if (field.is('#customer-resent-tracking-button')) {
            $('#customer-resent-tracking').parents('.hidden').removeClass('hidden')
        }
    }
});