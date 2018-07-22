<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Repair $repair
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Repair'), ['action' => 'edit', $repair->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Repair'), ['action' => 'delete', $repair->id], ['confirm' => __('Are you sure you want to delete # {0}?', $repair->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Repairs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Repair'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="repairs view large-9 medium-8 columns content">
    <h3><?= h($repair->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reason') ?></th>
            <td><?= h($repair->reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($repair->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $repair->has('phone') ? $this->Html->link($repair->phone->label, ['controller' => 'Phones', 'action' => 'view', $repair->phone->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Imiei') ?></th>
            <td><?= $repair->has('phone') ? $this->Html->link($repair->phone->imiei, ['controller' => 'Phones', 'action' => 'view', $repair->phone->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($repair->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($repair->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($repair->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($repair->comments)); ?>
    </div>
</div>
