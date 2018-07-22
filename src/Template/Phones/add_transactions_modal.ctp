<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Label as sold</h5>
    </div>
    <div class="modal-body">
        <?= $this->Form->create(null, [
        'class' => 'form-ajax',
        'id' => 'transactions',
        'novalidate',
        ]);?>
        <div class="row">
            <div class="col-md-8">


                <div id="phone-selection">
                    <?php
                        echo $this->Form->control('phone_id', [
                        'options' => [],
                        'empty' => true,
                        'class' => 'selectpicker',
                        'data-live-search' => "true",
                        'data-show-subtext'=>"true"
                        ]);
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <fieldset>
                    <?php
                echo $this->Form->control('customer_id', [
                    'options' => $customersList,
                    'class' => 'selectpicker',
                    'data-live-search' => "true",
                    'data-show-subtext'=>"true"
                    ]);
                    ?>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a id="phone-add" class="btn btn-primary">Add Phone</a>
            </div>
        </div>




        <table class="table table-hover hidden" id="phones-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>IMIEI</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <input type="hidden" name="phones[_ids]" class="form-control" value="">
            <tbody>

            </tbody>
        </table>


        <div class="modal-footer">

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->button('Close', ['data-dismiss' => 'modal']) ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>