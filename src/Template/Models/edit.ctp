<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Model $model
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $model->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $model->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Models'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Manufacturers'), ['controller' => 'Manufacturers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manufacturer'), ['controller' => 'Manufacturers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Colours'), ['controller' => 'ModelColours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Colour'), ['controller' => 'ModelColours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Storages'), ['controller' => 'ModelStorages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Storage'), ['controller' => 'ModelStorages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="models form large-9 medium-8 columns content">
    <?= $this->Form->create($model) ?>
    <fieldset>
        <legend><?= __('Edit Model') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('manufacturer_id', ['options' => $manufacturers]);
            echo $this->Form->control('model_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
