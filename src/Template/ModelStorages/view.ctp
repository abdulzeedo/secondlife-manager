<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelStorage $modelStorage
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Model Storage'), ['action' => 'edit', $modelStorage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Model Storage'), ['action' => 'delete', $modelStorage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelStorage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Model Storages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Storage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="modelStorages view large-10 medium-10 columns content">
    <h3><?= h($modelStorage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Storage') ?></th>
            <td><?= $modelStorage->has('storage') ? $this->Html->link($modelStorage->storage->storage, ['controller' => 'Storages', 'action' => 'view', $modelStorage->storage->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= $modelStorage->has('model') ? $this->Html->link($modelStorage->model->mobile_model, ['controller' => 'Models', 'action' => 'view', $modelStorage->model->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($modelStorage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($this->Time->i18nFormat($modelStorage->created)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($modelStorage->modified)) ?></td>
        </tr>
    </table>
</div>
