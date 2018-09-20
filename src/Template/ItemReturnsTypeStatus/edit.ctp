<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsTypeStatus $itemReturnsTypeStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemReturnsTypeStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsTypeStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Returns Type Status'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns Types'), ['controller' => 'ItemReturnsTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type'), ['controller' => 'ItemReturnsTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsTypeStatus form large-9 medium-8 columns content">
    <?= $this->Form->create($itemReturnsTypeStatus) ?>
    <fieldset>
        <legend><?= __('Edit Item Returns Type Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('item_returns_type_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
