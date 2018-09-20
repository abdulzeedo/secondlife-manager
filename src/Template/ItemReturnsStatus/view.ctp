<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsStatus $itemReturnsStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Returns Status'), ['action' => 'edit', $itemReturnsStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Returns Status'), ['action' => 'delete', $itemReturnsStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Returns Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemReturnsStatus view large-9 medium-8 columns content">
    <h3><?= h($itemReturnsStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemReturnsStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($itemReturnsStatus->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemReturnsStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($itemReturnsStatus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($itemReturnsStatus->modified) ?></td>
        </tr>
    </table>
</div>
