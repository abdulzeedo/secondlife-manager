<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone $phone
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $phone->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $phone->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="phones form large-9 medium-8 columns content">
    <?= $this->Form->create($phone) ?>
    <fieldset>
        <legend><?= __('Edit Phone') ?></legend>
        <?php
            echo $this->Form->control('imiei');
            echo $this->Form->control('serial_number');
            echo $this->Form->control('grade');
            echo $this->Form->control('status');
            echo $this->Form->control('storage_id', ['options' => $storages, 'empty' => true]);
            echo $this->Form->control('comments');
            echo $this->Form->control('model_id', ['options' => $models, 'empty' => true]);
            echo $this->Form->control('colour_id', ['options' => $colours, 'empty' => true]);
            echo $this->Form->control('battery_health');
            echo $this->Form->control('sim_lock_status');
            echo $this->Form->control('battery_cycles');
            echo $this->Form->control('os_version');
            echo $this->Form->control('region_code');

            echo $this->Form->control('model_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
