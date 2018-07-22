<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colour $colour
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $colour->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $colour->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Colours'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Model Colours'), ['controller' => 'ModelColours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Colour'), ['controller' => 'ModelColours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="colours form large-9 medium-8 columns content">
    <?= $this->Form->create($colour) ?>
    <fieldset>
        <legend><?= __('Edit Colour') ?></legend>
        <?php
            echo $this->Form->control('colour_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
