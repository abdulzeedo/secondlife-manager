<?php $this->extend($viewToExtend); ?>
<?php $this->assign('title', 'Add/Edit Repair'); ?>
<?= $this->Form->create($repair, [
'class' => 'form-ajax',
'data-table-url' => $this->Url->build([
"controller" => "Phones",
"action" => "repairsTable",
$repair->item_id]),
'data-table-id' => 'repairs-table',
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
    echo $this->Form->control('comments');

    ?>
</fieldset>
<?= $this->Form->control('item_id', [
'options' => $phonesList,
'class' => 'selectpicker',
'data-live-search' => "true",
'data-show-subtext'=>"true",
'disabled' => true
]) ?>