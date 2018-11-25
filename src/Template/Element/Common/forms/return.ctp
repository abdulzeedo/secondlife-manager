<script>
    var itemReturnsTypeStatus = <?= json_encode($itemReturnsTypeStatus)?>;
    var itemReturnsStatus = <?= json_encode($itemReturnsStatus) ?>;
</script>
<div class="itemReturns form large-9 medium-8 columns content">

    <fieldset>
        <?php
            echo '<div style="position: relative">';
        echo $this->Form->control('request_date', [
        'prepend' => '<i class="far fa-calendar-alt"></i>',
        'id' => 'returnDateTimePicker',
        'type' => 'text'
        ]);
        echo '</div>';
echo $this->Form->control('reason', [
    'prepend' => '<i class="fas fa-question-circle"></i>',
    'options' => $values['reason'],
    'class' => 'selectpicker',
    'data-live-search' => "true",
    'data-show-subtext'=>"true"
]);

?>
<div class="row">
    <div class="col-sm-6">
        <?= $this->Form->control('item_returns_type_id', [
        'prepend' => '<i class="fas fa-info-circle"></i>',
        'options' => $itemReturnsTypes,
        'class' => 'selectpicker',
        'data-live-search' => "true",
        'data-show-subtext'=>"true",
        'label' => 'Return Type'])
        ?>
    </div>
    <div class="col-sm-6">
        <?= $this->Form->control('item_returns_status_or_type_id', [
        'prepend' => '<i class="fas fa-clipboard-check"></i>',
        'type' => 'select',
        'class' => 'selectpicker',
        'data-live-search' => "true",
        'data-show-subtext'=>"true",
        'label' => 'Return Status'])
        ?>
    </div>
</div>
<?php
            if ($itemReturn->exchanged_with_item)
$options = [
'value' => $itemReturn->exchanged_with_item->id, // to make it safe during update/creation
'text' => $itemReturn->exchanged_with_item->imiei,
'data-subtext' => $itemReturn->exchanged_with_item->label,
];
else
$options = [];
echo '<div id="exchanged-with-item-id" style="display: none;">';
    echo $this->Form->control('exchanged_with_item_id', [
    'help' => 'Leave empty if you do not know which item to exchange with, but you must specify in comments.',
    'options' => [$options],
    'empty' => true,
    'prepend' => '<i class="fas fa-exchange-alt"></i>',
    'label' => 'Item to exchange with',
    'class' => 'selectpicker',
    'id' => 'phone-id',
    'data-live-search' => "true",
    'data-show-subtext'=>"true"
    ]);
    echo '</div>';
echo '<div style="display: none;">';
    echo $this->Form->control('refund_amount', ['label' => 'Amount to refund']);
    echo '</div>';
?>

<div class="form-group">
    <a id="customer-return-tracking-button" style="margin-bottom: 1rem;"
       class="btn btn-default <?= ($itemReturn->customer_return_tracking === ''
                                            || $itemReturn->customer_return_tracking === null ? '' : 'hidden') ?>">
        <i class="fas fa-plus"></i> Add tracking of return from customer
    </a>
    <a id="customer-resent-tracking-button" style="margin-bottom: 1rem;"
       class="btn btn-default <?= ($itemReturn->customer_resent_tracking === '' ||
                                            $itemReturn->customer_resent_tracking === null ? '' : 'hidden') ?>">
        <i class="fas fa-plus"></i> Add tracking of parcel sent to customer
    </a>
</div>
<?php
            echo '<div class="'.($itemReturn->customer_return_tracking === "" || $itemReturn->customer_return_tracking === null ? "hidden" : "show").'">';
echo $this->Form->control('customer_return_tracking', [
'prepend' => '<i class="fas fa-truck"></i>',
'label' => 'Add tracking of return from customer',
]);
echo '</div>';
echo '<div class="'.($itemReturn->customer_resent_tracking === "" || $itemReturn->customer_return_tracking === null ? "hidden" : "show").'">';
echo $this->Form->control('customer_resent_tracking', [
'label' => 'Add tracking of parcel sent to customer',
'prepend' => '<i class="fas fa-truck"></i>',
]);
echo '</div>';
echo $this->Form->control('comments');
echo $this->Form->control('item_id', [
    'options' => $phonesList,
    'class' => 'selectpicker',
    'data-live-search' => "true",
    'data-show-subtext'=>"true",
    'disabled' => true
]);
?>
</fieldset>
</div>
<?= $this->element('Common/modal') ?>
<script>
    $( document ).ready(function() {
        // After page reload, show/hide the fields appropriately
        changeSelect();
    });
</script>
