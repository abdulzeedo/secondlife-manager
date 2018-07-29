<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manufacturer[]|\Cake\Collection\CollectionInterface $manufacturers
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Manufacturer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="manufacturers index large-10 medium-10 columns content">
    <h3><?= __('Manufacturers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($manufacturers as $manufacturer): ?>
            <tr>
                <td><?= $this->Number->format($manufacturer->id) ?></td>
                <td><?= h($manufacturer->name) ?></td>
                <td><?= h($this->Time->i18nFormat($manufacturer->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($manufacturer->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $manufacturer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $manufacturer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $manufacturer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manufacturer->id)]) ?>
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
