<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturn $itemReturn
 */
?>
<script>
    var itemReturnsTypeStatus = <?= json_encode($itemReturnsTypeStatus)?>;
    var itemReturnsStatus = <?= json_encode($itemReturnsStatus) ?>;
</script>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemReturn->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturn->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturns form large-9 medium-8 columns content">
    <?= $this->Form->create($itemReturn) ?>
    <fieldset>
        <legend><?= __('Edit Item Return') ?></legend>
        <?php
            echo $this->Form->control('reason');
            echo $this->Form->control('item_returns_type_id', ['options' => $itemReturnsTypes]);
            echo $this->Form->control('item_returns_status_or_type_id',
                                            ['type' => 'select']);
        ?>
        <div class="form-group">
            <a id="customer-return-tracking-button"
               class="btn btn-default <?= ($itemReturn->customer_return_tracking === '' || null ? '' : 'hidden') ?>">
                <i class="fas fa-plus"></i> Add tracking of return from customer
            </a>
            <a id="customer-resent-tracking-button"
               class="btn btn-default <?= ($itemReturn->customer_resent_tracking === '' || null ? '' : 'hidden') ?>">
                <i class="fas fa-plus"></i> Add tracking of parcel sent to customer
            </a>
        </div>
        <?php
            echo '<div class="'.($itemReturn->customer_return_tracking === "" || null ? "hidden" : "show").'">';
                echo $this->Form->control('customer_return_tracking');
            echo '</div>';
            echo '<div class="'.($itemReturn->customer_resent_tracking === "" || null ? "hidden" : "show").'">';
                echo $this->Form->control('customer_resent_tracking');
            echo '</div>';
            echo '<div style="display: none;">';
            echo $this->Form->control('exchanged_with_item');
            echo '</div>';
            echo '<div style="display: none;">';
            echo $this->Form->control('refund_amount');
            echo '</div>';
            echo '<div style="position: relative">';
                echo $this->Form->control('return_date', ['id' => 'returnDateTimePicker']);
            echo '</div>';
            echo $this->Form->control('status');
            echo $this->Form->control('refund');
            echo $this->Form->control('comments');
            echo $this->Form->control('item_id', ['options' => $phones]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
    $( document ).ready(function() {
        changeSelect();
        $('#item-returns-type-id').on('change', changeSelect);
        function changeSelect() {
            $('#item-returns-status-or-type-id').empty();

            // Get DOM object of item returns type
            var itemReturnsStatusOrTypeField = $('#item-returns-status-or-type-id').get(0);
            var returnTypeValue = $('#item-returns-type-id').val();
            console.log(returnTypeValue)
            // Set visible any related fields if necessary
            if (returnTypeValue == '1') {
                $('#refund-amount').parent().hide();
                $('#exchanged-with-item').parents(':hidden').show()
            } // Exchange
            else if (returnTypeValue == '2') {
                $('#exchanged-with-item').parent().hide();
                $('#refund-amount').parents(':hidden').show()
            } // refund
            else {
                $('#refund-amount').parent().hide();
                $('#exchanged-with-item').parent().hide()
            }

            itemReturnsStatus = Object.values(itemReturnsStatus);
            var currentTypeStatus =
                itemReturnsTypeStatus
                    .filter(status => status.item_returns_type_id === returnTypeValue);
            let j = 0;
            for (let i = 0; i < itemReturnsStatus.length + currentTypeStatus.length - 1; i++) {

                if (i >= itemReturnsStatus.length - 1) {
                    itemReturnsStatusOrTypeField.add(
                        new Option(currentTypeStatus[j].name, currentTypeStatus[j].id)
                    );
                    j++;
                }
                else {
                    itemReturnsStatusOrTypeField.add(new Option(itemReturnsStatus[i]))
                }
            }
            itemReturnsStatusOrTypeField.add(new Option(itemReturnsStatus[itemReturnsStatus.length - 1]));
        }

        /**
         * Show the tracking field requested
         *
         * @param field return from customer or to customer 0|1
         * @param e event
         */
        $('#customer-return-tracking-button').on('click', showTrackingField);
        $('#customer-resent-tracking-button').on('click', showTrackingField);
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
</script>