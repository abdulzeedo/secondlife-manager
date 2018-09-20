<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsType $itemReturnsType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Returns Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Returns Type Status'), ['controller' => 'ItemReturnsTypeStatus', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($itemReturnsType) ?>
    <fieldset>
        <legend><?= __('Add Item Returns Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
