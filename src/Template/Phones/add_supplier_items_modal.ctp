<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add supplier orders</h5>
    </div>
    <div class="modal-body">
        <?= $this->Form->create(null, [
        'class' => 'form-ajax',
        'id' => 'supplierOrders',
        'novalidate',
        ]);?>
        <div class="row">
            <div class="col-md-8" id="supplier-selection">
                <?php
                echo $this->Form->control('supplier_id', [
                'options' => $suppliersList,
                'class' => 'selectpicker',
                'data-live-search' => "true",
                'data-show-subtext'=>"true",
                'empty' => true
                ]);
                ?>
            </div>
            <div class="col-md-4" id="supplier-order-selection">
                <fieldset>
                    <?php
                echo $this->Form->control('supplier_order_id', [
                    'options' => [],
                    'class' => 'selectpicker',
                    'data-live-search' => "true",
                    'data-show-subtext'=>"true",
                    'empty' => true
                    ]);
                    ?>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->control('phones_list', ['type' => 'textarea'])?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a id="phones-add" class="btn btn-primary">Add Phones</a>
            </div>
        </div>
        <div class="modal-footer">

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->button('Close', ['data-dismiss' => 'modal']) ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>