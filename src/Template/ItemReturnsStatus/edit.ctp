<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturnsStatus $itemReturnsStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemReturnsStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemReturnsStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Returns Status'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['controller' => 'ItemReturns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Return'), ['controller' => 'ItemReturns', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturnsStatus form large-9 medium-8 columns content">
    <?= $this->Form->create($itemReturnsStatus) ?>
    <fieldset>
        <legend><?= __('Edit Item Returns Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
