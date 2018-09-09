<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturn[]|\Cake\Collection\CollectionInterface $itemReturns
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturns index large-9 medium-8 columns content">
    <h3><?= __('Item Returns') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('refund') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemReturns as $itemReturn): ?>
            <tr>
                <td><?= $this->Number->format($itemReturn->id) ?></td>
                <td><?= h($itemReturn->reason) ?></td>
                <td><?= h($itemReturn->status) ?></td>
                <td><?= h($itemReturn->refund) ?></td>
                <td><?= $itemReturn->has('phone') ? $this->Html->link($itemReturn->phone->label, ['controller' => 'Phones', 'action' => 'view', $itemReturn->phone->id]) : '' ?></td>
                <td><?= h($this->Time->i18nFormat($itemReturn->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($itemReturn->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemReturn->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemReturn->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemReturn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturn->id)]) ?>
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
