<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelStorage[]|\Cake\Collection\CollectionInterface $modelStorages
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Model Storage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelStorages index large-10 medium-10 columns content">
    <h3><?= __('Model Storages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelStorages as $modelStorage): ?>
            <tr>
                <td><?= $this->Number->format($modelStorage->id) ?></td>
                <td><?= $modelStorage->has('storage') ? $this->Html->link($modelStorage->storage->storage, ['controller' => 'Storages', 'action' => 'view', $modelStorage->storage->id]) : '' ?></td>
                <td><?= $modelStorage->has('model') ? $this->Html->link($modelStorage->model->mobile_model, ['controller' => 'Models', 'action' => 'view', $modelStorage->model->id]) : '' ?></td>
                <td><?= h($this->Time->i18nFormat($modelStorage->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($modelStorage->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $modelStorage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $modelStorage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $modelStorage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelStorage->id)]) ?>
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
