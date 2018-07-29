<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colour[]|\Cake\Collection\CollectionInterface $colours
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Colour'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Model Colours'), ['controller' => 'ModelColours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model Colour'), ['controller' => 'ModelColours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="colours index large-9 medium-8 columns content">
    <h3><?= __('Colours') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colour_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($colours as $colour): ?>
            <tr>
                <td><?= $this->Number->format($colour->id) ?></td>
                <td><?= h($colour->colour_name) ?></td>
                <td><?= h($this->Time->i18nFormat($colour->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($colour->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $colour->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $colour->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $colour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colour->id)]) ?>
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
