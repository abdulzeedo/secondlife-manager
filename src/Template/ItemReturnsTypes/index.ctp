<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsType[]|\Cake\Collection\CollectionInterface $itemReturnsTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsTypes index large-9 medium-8 columns content">
    <h3><?= __('Item Returns Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemReturnsTypes as $itemReturnsType): ?>
            <tr>
                <td><?= $this->Number->format($itemReturnsType->id) ?></td>
                <td><?= h($itemReturnsType->name) ?></td>
                <td><?= h($itemReturnsType->description) ?></td>
                <td><?= h($itemReturnsType->created) ?></td>
                <td><?= h($itemReturnsType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemReturnsType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemReturnsType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemReturnsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsType->id)]) ?>
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
