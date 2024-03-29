<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Popup</h4>
            </div>
            <div class="modal-body">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <div>
                    <select class="selectpicker" data-size="8" data-live-search="true">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tertiary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function printForm(data) {
        $('.modal-content').replaceWith(data);
        $('#myModal').modal('show');
        if ( $('.selectpicker').length)
            $('.selectpicker').selectpicker('refresh');
        $('.modal').trigger("ajax.modal.loaded");
    }

    function showAlert(message) {
        $('#alert-box').html(
            '<div class="alert alert-success alert-dismissible" id="success" '
            + 'role="alert" style="display:none;" >'
            + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
            + message + '</div>');
        $('#success').show();

        $(".alert-dismissible").fadeTo(4000, 500).slideUp(500, function(){
            $(".alert-dismissible").alert('close');
        });
    }
    function getTable(url, table_id) {
        return $.ajax({
            type: "POST",
            url: url,
            dataType: 'html',
            success: function(res)
            {

                $('#'+table_id).replaceWith(res);




            },
            error:function(request, status, error) {
                console.log('Errore ' + request.responseText);

            }
        });
    }

    function getListAJAX(input) {
        return $.ajax({
            type: "GET",
            url: '/phones/imiei-list/' + input,
            dataType: 'json',
            });
    }

    function getSupplierOrdersListAJAX(input) {
        return $.ajax({
            type: "POST",
            url: '/supplier-orders/getSupplierOrders',
            data: {
                "ids": input
            },
            dataType: 'html',
        });
    }

    function getListImiei() {
        if (this.value && this.value.length > 2)
            getListAJAX(this.value)
                .then(function (elements) {
                    // Don't remove the first option (which is empty option)
                    $('#phone-id option:gt(0)').remove()
                    // Loop through
                    $.each(elements.phonesList, function(i, element) {
                        $('#phone-id').append($('<option>', {
                            value: element.value,
                            text: element.text,
                            'data-subtext': element['data-subtext']
                        }));
                    });
                },
                    function(){console.log('error list not loaded')})
                .then(function(){console.log('Imiei list loaded')})
                .then(function() {
                    $('#phone-id').selectpicker('refresh');
                });
    }
    var phoneRowIndex = 0;
    function createPhoneRow() {

        var addMessage = function(message, type) {
            // First remove from any messages
            cleanFromMessages();
            if (type == 'success') {
                $('#phone-selection > .form-group').addClass('has-success');
                $('#phone-selection button').addClass('button-has-success');
                $('#phone-selection > .form-group').append($('<span>', {
                    class: "help-block",
                    text: message
                }));
            }
            else {
                $('#phone-selection > .form-group').addClass('has-error');
                $('#phone-selection button').addClass('button-has-error');
                $('#phone-selection > .form-group').append($('<span>', {
                    class: "help-block",
                    text: message
                }));
            }
        }

        // If it's the empty field
        if (!$('#phone-selection option:selected').val()) {
            addMessage('Please select an IMIE from list.', 'error');
            return; // TODO: add warning
        }

        var table = $('#phones-table');

        // Check whether the current ID is already in the table
        let id = $('#phone-selection option:selected').val();

        // If the element is already present, the this is true
        // false otherwise
        var elementPresent = false;
        table.find('tbody tr').each((i, element) => {
           if (parseInt($(element).data('id')) == parseInt(id)) {
                elementPresent = true;
                return false;
           }
        });
        if (elementPresent) {
           addMessage('The IMIEI has already been added!', 'error');
            return;  // TODO: add warning
        }

        let imiei = $('#phone-selection option:selected').text();
        let description = $('#phone-selection option:selected').attr('data-subtext');

        // Create table row and add it to the table

        // Toggle table from hidden to visible
        if (table.hasClass('hidden')) {
            table.removeClass('hidden');
        }

        addMessage('Imiei added succesfully', 'success');

        table.find('tbody').append(
          $('<tr>'
              + `<input type="hidden" name=phones[${phoneRowIndex}][id] class="form-control" value="${id}">`
              + `<input type="hidden" name=phones[${phoneRowIndex}][_joinData][] class="form-control" value>`
          + '<td>' + id + '</td>'
          + '<td>' + imiei + '</td>'
          + '<td>' + description + '</td>'
          + '<td><a href="#" class="phone-remove btn btn-danger" data-id="'+ id +'">Remove</a></td>'
          + '</tr>').data('id', id)
        );
        phoneRowIndex++;

    }
    function removePhoneRow() {
        var id = $(this).attr('data-id');
        var trParent = $(this).parents('tr');
        // If there is a row related to this row remove that one as well
        // that row can be of type error for instance
        if (trParent.next().data('id') === parseInt(id))
            trParent.next().remove();
        trParent.remove();

        var table = $('#phones-table');
        // Make table invisible if there are no elements to show
        if (table.find('tbody').has('td').length == 0)
            table.addClass('hidden');
    }
    function cleanFromMessages() {
        // Remove any success/error classes added
        $('#phone-selection > .form-group').removeClass('has-error');
        $('#phone-selection > .form-group').removeClass('has-success');

        $('#phone-selection button').removeClass('button-has-error');
        $('#phone-selection button').removeClass('button-has-success');
        $('#phone-selection > .form-group span.help-block').remove();
    }
    function getSupplierOrders(event) {
        //Trigger event only if the target is the one expected: TODO: do it for all other cases
        if ($(event.target).is('#supplier-id')) {
            // Check whether the current ID is already in the table
            let id = $('#supplier-selection option:selected').val();
            console.log(id);
            console.log(event);
            if (id !== null || id !== '')
                getSupplierOrdersListAJAX(id)
                    .then(function (elements) {
                            elements = JSON.parse(elements);
                            // Don't remove the first option (which is empty option)
                            $('#supplier-order-id option:gt(0)').remove()
                            // Loop through
                            $.each(elements, function(i, element) {
                                $('#supplier-order-id').append($('<option>', {
                                    value: element.value,
                                    text: element.text,
                                    'data-subtext': element['data-subtext']
                                }));
                            });
                        },
                        function(){console.log('error')})
                    .then(function(){console.log('loaded')})
                    .then(function() {
                        $('#supplier-order-id').selectpicker('refresh');
                    });
        }
    }
    $(document).ready(function () {

        $('body').on('changed.bs.select', cleanFromMessages);
        $('body').on('changed.bs.select', getSupplierOrders);

        $('body').on('click', '.phone-remove', removePhoneRow);
        $('body').on('click', '#phone-add', createPhoneRow);
        $('body').on('input', '#phone-selection .form-control', getListImiei);


        // Get modal form (html form)
        $('body').on('click', '.modal-ajax-button', function(event){

            event.preventDefault();
            var url = $(this).attr("href");

            // Start the loading icon on the modal
            $(event.currentTarget).LoadingOverlay("show");

            $.ajax({
                url: url,
                dataType: 'html',
                success: function(res) {
                    // Show modal with Form


                    printForm(res);
                },
                error:function(request, status, error) {
                    showAlert("Something went wrong");
                    console.log("ajax call went wrong:" + request.responseText);
                }
            }).always(()=>{
                // Hide the loading icon now
                $(event.currentTarget).LoadingOverlay("hide");
            });

        });
        /* get some values from elements on the page: */




        $(".modal").on('submit', '.form-ajax', function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var $form = $(this),
                url = $form.attr('action');
            var table_url = $(this).data("tableUrl");
            var table_id = $(this).data("tableId");
            console.log($(".form-ajax").serialize());

            $("#transactions").trigger("ajax.before.submit", [$form]);

            var formIsValid = $form.data('is-valid');


            if (formIsValid === undefined || formIsValid) {
                $(event.currentTarget).LoadingOverlay("show");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $(".form-ajax").serialize(), // serializes the form's elements.
                    success: function(res)
                    {
                        // Only if defined otherwise don't print table
                        if (table_url && table_id) {
                            $('#' + table_id).LoadingOverlay("show");
                            getTable(table_url, table_id).always(()=>{
                                console.log('complete')
                                $('#' + table_id).LoadingOverlay("hide");
                            });
                        }
                        printForm(res);
                        console.log('printed form')

                        $('#myModal').modal('hide');
                        showAlert('Data updated successfully');
                    },
                    error:function(request, status, error) {
                        console.log('Errore');
                        $().showAlert('Error occurred after submission.<br>If no error is shown refresh the page and try again.', 'error');

                        if (request.responseJSON) {
                            $(event.currentTarget).trigger("error.json.response", [request.responseJSON])
                        }
                        else {
                            printForm(request.responseText);
                        }

                    }
                }).always(()=>{
                    // Hide the loading icon now
                    $(event.currentTarget).LoadingOverlay("hide");
                });
            }


        });

        // Delete record from table
        $("body").on('click', '.delete-ajax-button', function(event) {

            event.preventDefault();


            var url = $(this).attr("href");

            var table_url = $(this).parents('.relative').data("tableUrl");
            var table_id = $(this).parents('.relative').data("tableId");
            if(!confirm('Are you sure you want to delete this record?'))
                return;
            if (table_id)
                $('#' + table_id).LoadingOverlay("show");
            $.ajax({
                url: url,
                type: "DELETE",
                success: function(res) {
                    getTable(table_url, table_id).always(()=>{
                        $('#' + table_id).LoadingOverlay("hide");
                    });
                    showAlert('Data deleted successfully');
                },
                error:function(request, status, error) {
                    console.log("ajax call went wrong:" + request.responseText);
                }
            });
        });
    });

</script>