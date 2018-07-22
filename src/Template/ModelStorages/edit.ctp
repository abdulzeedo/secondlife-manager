<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelStorage $modelStorage
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $modelStorage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $modelStorage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Model Storages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelStorages form large-10 medium-10 columns content">
    <?= $this->Form->create($modelStorage) ?>
    <fieldset>
        <legend><?= __('Edit Model Storage') ?></legend>
        <?php
            echo $this->Form->control('storage_id', ['options' => $storages]);
            echo $this->Form->control('model_id', ['options' => $models]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
