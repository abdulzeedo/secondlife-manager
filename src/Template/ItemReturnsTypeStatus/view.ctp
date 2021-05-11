<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsTypeStatus $itemReturnsTypeStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Returns Type Status'), ['action' => 'edit', $itemReturnsTypeStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Returns Type Status'), ['action' => 'delete', $itemReturnsTypeStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsTypeStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns Type Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Returns Type Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Returns Types'), ['controller' => 'ItemReturnsTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Returns Type'), ['controller' => 'ItemReturnsTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemReturnsTypeStatus view large-9 medium-8 columns content">
    <h3><?= h($itemReturnsTypeStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemReturnsTypeStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($itemReturnsTypeStatus->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemReturnsTypeStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Returns Type Id') ?></th>
            <td><?= $this->Number->format($itemReturnsTypeStatus->item_returns_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($itemReturnsTypeStatus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($itemReturnsTypeStatus->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Item Returns Types') ?></h4>
        <?php if (!empty($itemReturnsTypeStatus->item_returns_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemReturnsTypeStatus->item_returns_types as $itemReturnsTypes): ?>
            <tr>
                <td><?= h($itemReturnsTypes->id) ?></td>
                <td><?= h($itemReturnsTypes->name) ?></td>
                <td><?= h($itemReturnsTypes->description) ?></td>
                <td><?= h($itemReturnsTypes->created) ?></td>
                <td><?= h($itemReturnsTypes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemReturnsTypes', 'action' => 'view', $itemReturnsTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemReturnsTypes', 'action' => 'edit', $itemReturnsTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemReturnsTypes', 'action' => 'delete', $itemReturnsTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
