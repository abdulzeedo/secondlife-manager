<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelColour $modelColour
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Model Colour'), ['action' => 'edit', $modelColour->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Model Colour'), ['action' => 'delete', $modelColour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelColour->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Model Colours'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Colour'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="modelColours view large-10 medium-10 columns content">
    <h3><?= h($modelColour->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Colour') ?></th>
            <td><?= $modelColour->has('colour') ? $this->Html->link($modelColour->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $modelColour->colour->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= $modelColour->has('model') ? $this->Html->link($modelColour->model->mobile_model, ['controller' => 'Models', 'action' => 'view', $modelColour->model->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($modelColour->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($modelColour->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($modelColour->modified) ?></td>
        </tr>
    </table>
</div>
