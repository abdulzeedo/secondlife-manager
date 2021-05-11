<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsStatus[]|\Cake\Collection\CollectionInterface $itemReturnsStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Returns Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsStatus index large-9 medium-8 columns content">
    <h3><?= __('Item Returns Status') ?></h3>
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
            <?php foreach ($itemReturnsStatus as $itemReturnsStatus): ?>
            <tr>
                <td><?= $this->Number->format($itemReturnsStatus->id) ?></td>
                <td><?= h($itemReturnsStatus->name) ?></td>
                <td><?= h($itemReturnsStatus->description) ?></td>
                <td><?= h($itemReturnsStatus->created) ?></td>
                <td><?= h($itemReturnsStatus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemReturnsStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemReturnsStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemReturnsStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsStatus->id)]) ?>
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
