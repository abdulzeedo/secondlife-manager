<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturn $itemReturn
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Return'), ['action' => 'edit', $itemReturn->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Return'), ['action' => 'delete', $itemReturn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturn->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Return'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemReturns view large-9 medium-8 columns content">
    <h3><?= h($itemReturn->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reason') ?></th>
            <td><?= h($itemReturn->reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($itemReturn->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Return type') ?></th>
            <td><?= $itemReturn->item_returns_type->name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Refund') ?></th>
            <td><?= h($itemReturn->refund) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $itemReturn->has('phone') ? $this->Html->link($itemReturn->phone->label, ['controller' => 'Phones', 'action' => 'view', $itemReturn->phone->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemReturn->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($this->Time->i18nFormat($itemReturn->created)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($itemReturn->modified)) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($itemReturn->comments)); ?>
    </div>
</div>
