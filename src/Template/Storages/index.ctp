<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Storage[]|\Cake\Collection\CollectionInterface $storages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Storage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Storages'), ['controller' => 'ModelStorages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Storage'), ['controller' => 'ModelStorages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storages index large-9 medium-8 columns content">
    <h3><?= __('Storages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($storages as $storage): ?>
            <tr>
                <td><?= $this->Number->format($storage->id) ?></td>
                <td><?= h($storage->storage) ?></td>
                <td><?= h($this->Time->i18nFormat($storage->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($storage->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $storage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $storage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $storage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storage->id)]) ?>
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
