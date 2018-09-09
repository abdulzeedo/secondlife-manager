<?php $this->extend($viewToExtend); ?>
<?php $this->assign('title', 'Add/Edit Returns'); ?>
<?= $this->Form->create($return, [
'class' => 'form-ajax',
'data-table-url' => $this->Url->build([
    "controller" => "Phones",
    "action" => "returnsTable",
    $return->item_id]),
'data-table-id' => 'returns-table',
'novalidate',
]);?>
<?= $this->element('Common/forms/return') ?>