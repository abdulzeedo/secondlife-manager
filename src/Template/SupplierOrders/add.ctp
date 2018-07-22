<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierOrder $supplierOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Supplier Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supplierOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($supplierOrder) ?>
    <fieldset>
        <legend><?= __('Add Supplier Order') ?></legend>
        <?php
            echo $this->Form->control('invoice_number');
            echo $this->Form->control('invoice_date', ['empty' => true]);
            echo $this->Form->control('comments');
            echo $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
