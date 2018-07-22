<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manufacturer $manufacturer
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Manufacturers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manufacturers form large-10 medium-10 columns content">
    <?= $this->Form->create($manufacturer) ?>
    <fieldset>
        <legend><?= __('Add Manufacturer') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
