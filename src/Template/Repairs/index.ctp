<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Repair[]|\Cake\Collection\CollectionInterface $repairs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Repair'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="repairs index large-9 medium-8 columns content">
    <h3><?= __('Repairs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($repairs as $repair): ?>
            <tr>
                <td><?= $this->Number->format($repair->id) ?></td>
                <td><?= h($repair->reason) ?></td>
                <td><?= h($repair->status) ?></td>
                <td><?= $repair->has('phone') ? $this->Html->link($repair->phone->label.' - '.$repair->phone->imiei, ['controller' => 'Phones', 'action' => 'view', $repair->phone->id]) : '' ?></td>
                <td><?= h($repair->created) ?></td>
                <td><?= h($repair->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $repair->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $repair->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $repair->id], ['confirm' => __('Are you sure you want to delete # {0}?', $repair->id)]) ?>
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
