<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ModelColour[]|\Cake\Collection\CollectionInterface $modelColours
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Model Colour'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelColours index large-10 medium-10 columns content">
    <h3><?= __('Model Colours') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colour_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelColours as $modelColour): ?>
            <tr>
                <td><?= $this->Number->format($modelColour->id) ?></td>
                <td><?= $modelColour->has('colour') ? $this->Html->link($modelColour->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $modelColour->colour->id]) : '' ?></td>
                <td><?= $modelColour->has('model') ? $this->Html->link($modelColour->model->mobile_model, ['controller' => 'Models', 'action' => 'view', $modelColour->model->id]) : '' ?></td>
                <td><?= h($this->Time->i18nFormat($modelColour->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($modelColour->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $modelColour->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $modelColour->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $modelColour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelColour->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
