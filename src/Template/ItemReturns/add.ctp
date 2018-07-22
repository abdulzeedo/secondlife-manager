<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemReturn $itemReturn
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Item Returns'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemReturns form large-9 medium-8 columns content">
    <?= $this->Form->create($itemReturn) ?>
    <fieldset>
        <legend><?= __('Add Item Return') ?></legend>
        <?php
            echo $this->Form->control('reason');
            echo $this->Form->control('status');
            echo $this->Form->control('refund');
            echo $this->Form->control('comments');
            echo $this->Form->control('item_id', ['options' => $phones]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
