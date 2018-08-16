<?= $this->Panel->create([
        'id' => 'repairs-table',
        'class' => 'relative',
        'data-table-id' => 'repairs-table',
        'data-table-url' => $this->Url->build([
            "controller" => "Phones",
            "action" => "repairsTable",
            $phone->id]),
    ]); ?>
<div class="panel-heading" style='display: flex; justify-content: space-between;' data-toggle="collapse">
    <h4 data-toggle="collapse"><?= __('Related Repairs') ?></h4>
    <?= $this->Html->link("<span class='fas fa-plus'></span>", ['controller' => 'Phones', 'action' => 'addRepairModal', $phone->id],
    ['class' => 'btn btn-default modal-ajax-button', 'escapeTitle' => false]) ?>
</div>
<?php if (!empty($phone->repairs)): ?>
<div class="table-responsive">

<table cellpadding="0" cellspacing="0" class="table ">
    <tr>
        <th scope="col"><?= __('Reason') ?></th>
        <th scope="col"><?= __('Status') ?></th>
        <th scope="col"><?= __('Created') ?></th>
        <th scope="col"><?= __('Modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>

    </tr>
    <?php foreach ($phone->repairs as $repair): ?>
    <tr>
        <td><?= h($repair->reason) ?></td>
        <td><?= h($repair->status) ?></td>
        <td><?= h($this->Time->i18nFormat($repair->created)) ?></td>
        <td><?= h($this->Time->i18nFormat($repair->modified)) ?></td>


        <td class="actions">
            <?= $this->Html->link("<span class='far fa-eye'></span>", ['controller' => 'Repairs', 'action' => 'view', $repair->id],
            ['class' => 'btn btn-default', 'escapeTitle' => false]) ?>
            <?= $this->Html->link("<span class='far fa-edit'></span>", ['controller' => 'Phones', 'action' => 'editRepairModal', $repair->id],
            ['class' => 'modal-ajax-button btn btn-warning', 'escapeTitle' => false]) ?>
            <?= $this->Html->link("<span class='far fa-trash-alt'></span>", ['controller' => 'Repairs', 'action' => 'delete', $repair->id],
            ['class' => 'btn btn-danger delete-ajax-button', 'escapeTitle' => false]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="ajax-comments-table-cell"><b><?= __('Comments') ?></b>: <?= h($repair->comments) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

<?php endif; ?>
<?= $this->Panel->end(); ?>