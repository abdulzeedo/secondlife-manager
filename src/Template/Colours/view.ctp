<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colour $colour
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Colour'), ['action' => 'edit', $colour->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Colour'), ['action' => 'delete', $colour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $colour->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colours'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colour'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Model Colours'), ['controller' => 'ModelColours', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Model Colour'), ['controller' => 'ModelColours', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Phones'), ['controller' => 'Phones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phone'), ['controller' => 'Phones', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="colours view large-9 medium-8 columns content">
    <h3><?= h($colour->colour_name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Colour Name') ?></th>
            <td><?= h($colour->colour_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($colour->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($this->Time->i18nFormat($colour->created)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($colour->modified)) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Model Colours') ?></h4>
        <?php if (!empty($colour->model_colours)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Colour Id') ?></th>
                <th scope="col"><?= __('Model Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($colour->model_colours as $modelColours): ?>
            <tr>
                <td><?= h($modelColours->id) ?></td>
                <td><?= h($modelColours->colour_id) ?></td>
                <td><?= h($modelColours->model_id) ?></td>
                <td><?= h($this->Time->i18nFormat($modelColours->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($modelColours->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ModelColours', 'action' => 'view', $modelColours->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ModelColours', 'action' => 'edit', $modelColours->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ModelColours', 'action' => 'delete', $modelColours->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelColours->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Phones') ?></h4>
        <?php if (!empty($colour->phones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Imiei') ?></th>
                <th scope="col"><?= __('Serial Number') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Storage Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Comments') ?></th>
                <th scope="col"><?= __('Model Id') ?></th>
                <th scope="col"><?= __('Colour Id') ?></th>
                <th scope="col"><?= __('Battery Health') ?></th>
                <th scope="col"><?= __('Sim Lock Status') ?></th>
                <th scope="col"><?= __('Battery Cycles') ?></th>
                <th scope="col"><?= __('Os Version') ?></th>
                <th scope="col"><?= __('Region Code') ?></th>
                <th scope="col"><?= __('Product Type Specific') ?></th>
                <th scope="col"><?= __('Model Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($colour->phones as $phones): ?>
            <tr>
                <td><?= h($phones->id) ?></td>
                <td><?= h($phones->imiei) ?></td>
                <td><?= h($phones->serial_number) ?></td>
                <td><?= h($phones->grade) ?></td>
                <td><?= h($phones->status) ?></td>
                <td><?= h($phones->storage_id) ?></td>
                <td><?= h($this->Time->i18nFormat($phones->created)) ?></td>
                <td><?= h($this->Time->i18nFormat($phones->modified)) ?></td>
                <td><?= h($phones->comments) ?></td>
                <td><?= h($phones->model_id) ?></td>
                <td><?= h($phones->colour_id) ?></td>
                <td><?= h($phones->battery_health) ?></td>
                <td><?= h($phones->sim_lock_status) ?></td>
                <td><?= h($phones->battery_cycles) ?></td>
                <td><?= h($phones->os_version) ?></td>
                <td><?= h($phones->region_code) ?></td>
                <td><?= h($phones->product_type_specific) ?></td>
                <td><?= h($phones->model_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Phones', 'action' => 'view', $phones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Phones', 'action' => 'edit', $phones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Phones', 'action' => 'delete', $phones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $phones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
