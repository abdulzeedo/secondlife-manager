<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierOrder $supplierOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Supplier Order'), ['action' => 'edit', $supplierOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Supplier Order'), ['action' => 'delete', $supplierOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Supplier Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="supplierOrders view large-9 medium-8 columns content">
    <h3><?= h($supplierOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Invoice Number') ?></th>
            <td><?= h($supplierOrder->invoice_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= $supplierOrder->has('supplier') ? $this->Html->link($supplierOrder->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $supplierOrder->supplier->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($supplierOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Date') ?></th>
            <td><?= h($supplierOrder->invoice_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($supplierOrder->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($supplierOrder->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($supplierOrder->comments)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Phones') ?></h4>
        <?php if (!empty($supplierOrder->phones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Imiei') ?></th>
                <th scope="col"><?= __('Serial Number') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Storage Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Comments') ?></th>
                <th scope="col"><?= __('Model Id') ?></th>
                <th scope="col"><?= __('Colour Id') ?></th>
                <th scope="col"><?= __('Battery Health') ?></th>
                <th scope="col"><?= __('Sim Lock Status') ?></th>
                <th scope="col"><?= __('Battery Cycles') ?></th>
                <th scope="col"><?= __('Os Version') ?></th>
                <th scope="col"><?= __('Region Code') ?></th>
                <th scope="col"><?= __('Model Number') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Supplier Order Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($supplierOrder->phones as $phones): ?>
            <tr>
                <td><?= h($phones->id) ?></td>
                <td><?= h($phones->imiei) ?></td>
                <td><?= h($phones->serial_number) ?></td>
                <td><?= h($phones->grade) ?></td>
                <td><?= h($phones->status) ?></td>
                <td><?= h($phones->storage_id) ?></td>
                <td><?= h($phones->created) ?></td>
                <td><?= h($phones->modified) ?></td>
                <td><?= h($phones->comments) ?></td>
                <td><?= h($phones->model_id) ?></td>
                <td><?= h($phones->colour_id) ?></td>
                <td><?= h($phones->battery_health) ?></td>
                <td><?= h($phones->sim_lock_status) ?></td>
                <td><?= h($phones->battery_cycles) ?></td>
                <td><?= h($phones->os_version) ?></td>
                <td><?= h($phones->region_code) ?></td>
                <td><?= h($phones->model_number) ?></td>
                <td><?= h($phones->user_id) ?></td>
                <td><?= h($phones->supplier_order_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Phones', 'action' => 'view', $phones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Phones', 'action' => 'edit', $phones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Phones', 'action' => 'delete', $phones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $phones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
