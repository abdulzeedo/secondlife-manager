<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsTypeStatus[]|\Cake\Collection\CollectionInterface $itemReturnsTypeStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns Types'), ['controller' => 'ItemReturnsTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type'), ['controller' => 'ItemReturnsTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsTypeStatus index large-9 medium-8 columns content">
    <h3><?= __('Item Returns Type Status') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_returns_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemReturnsTypeStatus as $itemReturnsTypeStatus): ?>
            <tr>
                <td><?= $this->Number->format($itemReturnsTypeStatus->id) ?></td>
                <td><?= h($itemReturnsTypeStatus->name) ?></td>
                <td><?= h($itemReturnsTypeStatus->description) ?></td>
                <td><?= $this->Number->format($itemReturnsTypeStatus->item_returns_type_id) ?></td>
                <td><?= h($itemReturnsTypeStatus->created) ?></td>
                <td><?= h($itemReturnsTypeStatus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemReturnsTypeStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemReturnsTypeStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemReturnsTypeStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsTypeStatus->id)]) ?>
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
