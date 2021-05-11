<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsType $itemReturnsType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Returns Type'), ['action' => 'edit', $itemReturnsType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Returns Type'), ['action' => 'delete', $itemReturnsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Returns Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemReturnsTypes view large-9 medium-8 columns content">
    <h3><?= h($itemReturnsType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemReturnsType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($itemReturnsType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemReturnsType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($itemReturnsType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($itemReturnsType->modified) ?></td>
        </tr>
    </table>
</div>
