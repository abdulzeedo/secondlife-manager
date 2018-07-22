<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelColour $modelColour
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Model Colours'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelColours form large-10 medium-10 columns content">
    <?= $this->Form->create($modelColour) ?>
    <fieldset>
        <legend><?= __('Add Model Colour') ?></legend>
        <?php
            echo $this->Form->control('colour_id', ['options' => $colours]);
            echo $this->Form->control('model_id', ['options' => $models]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
