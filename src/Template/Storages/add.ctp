<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Storage $storage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Storages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Model Storages'), ['controller' => 'ModelStorages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Storage'), ['controller' => 'ModelStorages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storages form large-9 medium-8 columns content">
    <?= $this->Form->create($storage) ?>
    <fieldset>
        <legend><?= __('Add Storage') ?></legend>
        <?php
            echo $this->Form->control('storage');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
