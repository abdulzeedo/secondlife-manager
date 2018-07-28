<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone[]|\Cake\Collection\CollectionInterface $phones
 */
?>
<div class="row">
<div class="col-md-12">
    <h3><?= __('Phones') ?></h3>


    <?php
    echo $this->Form->create(null, ['valueSources' => 'query', 'id' => 'home-filter-form']);
    echo $this->Panel->startGroup(['open' => true]);
    echo $this->Panel->create('Advanced Filters');
    echo $this->Form->control('storage_id', ['options' => $storages, 'empty' => true]);
    echo $this->Form->control('colour_id', ['options' => $colours, 'empty' => true]);
    echo $this->Form->control('model_id', ['options' => $models, 'empty' => true]);
    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
    echo $this->Form->control('grade');
    echo $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => true]);
    echo $this->Form->control('Repairs.status', ['options' => $repairs, 'empty' => true]);
    echo $this->Panel->endGroup();
    // Match the search param in your table configuration
    echo $this->Form->control('q', ['label'=>'Search IMIEI or SERIAL #']);
    echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary']);
    echo ' ';
    echo $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-warning']);
    echo $this->Form->end();
    ?>
</div>
</div>
    <div class="row">
        <div class="col-md-12 text-right">
        <div class="bulk-action">
            <?= $this->Html->link(__('Set as sold'), ['controller' => 'Phones', 'action' => 'addTransactionsModal'],
            ['class' => 'btn btn-default modal-ajax-button']) ?>
            <?= $this->Html->link(__('Set suppliers'), ['controller' => 'Phones', 'action' => 'addSupplierItemsModal'],
            ['class' => 'btn btn-default modal-ajax-button']) ?>

            <?= $this->Html->link('Generate CSV', ['action' => 'export', '?' => $this->request->getQueryParams()], ['class' => 'btn btn-success']) ?>
        </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
    <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('imiei') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('serial_number') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('grade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('model_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colour_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_health') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sim_lock_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_cycles') ?></th>
                <th scope="col"><?= $this->Paginator->sort('os_version') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('region_code') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('model_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($phones as $phone): ?>
            <tr>
                <td><?= $this->Number->format($phone->id) ?></td>
                <td><?= h($phone->imiei) ?></td>
                <!--<td><?= h($phone->serial_number) ?></td>-->
                <td><?= h($phone->grade) ?></td>
                <td><?= h($phone->status) ?></td>
                <td><?= $phone->has('storage') ? $this->Html->link($phone->storage->storage, ['controller' => 'Storages', 'action' => 'view', $phone->storage->id]) : '' ?></td>
                <td><?= h($phone->created) ?></td>
                <!--<td><?= h($phone->modified) ?></td>-->
                <td><?= $phone->has('model') ? $this->Html->link($phone->model->name, ['controller' => 'Models', 'action' => 'view', $phone->model->id]) : '' ?></td>
                <td><?= $phone->has('colour') ? $this->Html->link($phone->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $phone->colour->id]) : '' ?></td>
                <td><?= $this->Number->format($phone->battery_health) ?></td>
                <td><?= h($phone->sim_lock_status) ?></td>
                <td><?= $this->Number->format($phone->battery_cycles) ?></td>
                <td><?= h($phone->os_version) ?></td>
                <!--<td><?= h($phone->region_code) ?></td>-->
                <td><?= h($phone->model_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $phone->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'connected', $phone->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $phone->id], ['confirm' => __('Are you sure you want to delete # {0}?', $phone->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="Page navigation" style="text-align: center;">

        <ul class="pagination" >
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>

        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
</div>

<?= $this->element('Common/modal'); ?>