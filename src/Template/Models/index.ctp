<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Model[]|\Cake\Collection\CollectionInterface $models
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Model'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manufacturers'), ['controller' => 'Manufacturers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manufacturer'), ['controller' => 'Manufacturers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Colours'), ['controller' => 'ModelColours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Colour'), ['controller' => 'ModelColours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Storages'), ['controller' => 'ModelStorages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Storage'), ['controller' => 'ModelStorages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="models index large-9 medium-8 columns content">
    <h3><?= __('Models') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manufacturer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model_code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?= $this->Number->format($model->id) ?></td>
                <td><?= h($model->name) ?></td>
                <td><?= $model->has('manufacturer') ? $this->Html->link($model->manufacturer->name, ['controller' => 'Manufacturers', 'action' => 'view', $model->manufacturer->id]) : '' ?></td>
                <td><?= h($model->created) ?></td>
                <td><?= h($model->modified) ?></td>
                <td><?= h($model->model_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $model->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $model->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $model->id], ['confirm' => __('Are you sure you want to delete # {0}?', $model->id)]) ?>
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
