<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierOrder[]|\Cake\Collection\CollectionInterface $supplierOrders
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Supplier Order'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supplierOrders index large-9 medium-8 columns content">
    <h3><?= __('Supplier Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplierOrders as $supplierOrder): ?>
            <tr>
                <td><?= $this->Number->format($supplierOrder->id) ?></td>
                <td><?= h($supplierOrder->invoice_number) ?></td>
                <td><?= h($supplierOrder->invoice_date) ?></td>
                <td><?= $supplierOrder->has('supplier') ? $this->Html->link($supplierOrder->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $supplierOrder->supplier->id]) : '' ?></td>
                <td><?= h($supplierOrder->created) ?></td>
                <td><?= h($supplierOrder->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $supplierOrder->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplierOrder->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplierOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierOrder->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
