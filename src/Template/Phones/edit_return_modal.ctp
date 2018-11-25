<?php $this->extend($viewToExtend); ?>
<?php $this->assign('title', 'Add/Edit Returns'); ?>
<?= $this->Form->create($itemReturn, [
'class' => 'form-ajax',
'data-table-url' => $this->Url->build([
    "controller" => "Phones",
    "action" => "returnsTable",
    $itemReturn->item_id]),
'data-table-id' => 'returns-table',
'novalidate',
]);?>
<?= $this->element('Common/forms/return') ?>