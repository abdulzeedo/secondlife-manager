<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add/Edit Return</h5>
    </div>
    <div class="modal-body">
        <?= $this->Form->create($return, [
        'class' => 'form-ajax',
        'data-table-url' => $this->Url->build([
            "controller" => "Phones",
            "action" => "returnsTable",
            $return->item_id]),
        'data-table-id' => 'returns-table',
        'novalidate',
        ]);?>
        <fieldset>
            <?php
            echo $this->Form->control('reason', [
                'options' => $values['reason'],
                'class' => 'selectpicker',
                'data-live-search' => "true",
                'data-show-subtext'=>"true"
            ]);
            echo $this->Form->control('status', [
                'options' => $values['status'],
                'class' => 'selectpicker',
                'data-live-search' => "true",
                'data-show-subtext'=>"true"
            ]);
                echo $this->Form->control('refund');
                echo $this->Form->control('comments');

            ?>
        </fieldset>
        <?= $this->Form->control('item_id', [
            'options' => $phonesList,
            'class' => 'selectpicker',
            'data-live-search' => "true",
            'data-show-subtext'=>"true"
        ]) ?>

        <div class="modal-footer">

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->button('Close', ['data-dismiss' => 'modal']) ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>