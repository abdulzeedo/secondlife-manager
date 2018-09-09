<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manufacturer $manufacturer
 */
?>
<nav class="large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Manufacturer'), ['action' => 'edit', $manufacturer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Manufacturer'), ['action' => 'delete', $manufacturer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manufacturer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Manufacturers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manufacturer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Models'), ['controller' => 'Models', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model'), ['controller' => 'Models', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="manufacturers view large-10 medium-10 columns content">
    <h3><?= h($manufacturer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($manufacturer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($manufacturer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($this->Time->i18nFormat($manufacturer->created)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($manufacturer->modified)) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Models') ?></h4>
        <?php if (!empty($manufacturer->models)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Mobile Model') ?></th>
                <th scope="col"><?= __('Manufacturer Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($manufacturer->models as $models): ?>
            <tr>
                <td><?= h($models->id) ?></td>
                <td><?= h($models->mobile_model) ?></td>
                <td><?= h($models->manufacturer_id) ?></td>
                <td><?= h($this->Time->i18nFormat($models->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($models->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Models', 'action' => 'view', $models->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Models', 'action' => 'edit', $models->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Models', 'action' => 'delete', $models->id], ['confirm' => __('Are you sure you want to delete # {0}?', $models->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
