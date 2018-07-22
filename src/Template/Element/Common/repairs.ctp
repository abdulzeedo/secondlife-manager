<?= $this->Panel->create([
        'id' => 'repairs-table',
        'class' => 'relative',
        'data-table-id' => 'repairs-table',
        'data-table-url' => $this->Url->build([
            "controller" => "Phones",
            "action" => "repairsTable",
            $phone->id]),
    ]); ?>
<?= $this->Panel->header(['style' => 'display: flex; justify-content: space-between;',
                          'data-toggle'=>"collapse"]); ?>
<h4 data-toggle="collapse"><?= __('Related Repairs') ?></h4>
<?= $this->Html->link(__('Add Repair'), ['controller' => 'Phones', 'action' => 'addRepairModal', $phone->id],
['class' => 'btn btn-default modal-ajax-button']) ?>
</div> <!-- close header-->
<?php if (!empty($phone->repairs)): ?>
<div class="table-responsive">

<table cellpadding="0" cellspacing="0" class="table ">
    <tr>
        <th scope="col"><?= __('Reason') ?></th>
        <th scope="col"><?= __('Comments') ?></th>
        <th scope="col"><?= __('Status') ?></th>
        <th scope="col"><?= __('Created') ?></th>
        <th scope="col"><?= __('Modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>

    </tr>
    <?php foreach ($phone->repairs as $repair): ?>
    <tr>
        <td><?= h($repair->reason) ?></td>
        <td><?= h($repair->comments) ?></td>
        <td><?= h($repair->status) ?></td>
        <td><?= h($repair->created) ?></td>
        <td><?= h($repair->modified) ?></td>


        <td class="actions">
            <?= $this->Html->link(__('View'), ['controller' => 'Repairs', 'action' => 'view', $repair->id],
            ['class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit'), ['controller' => 'Phones', 'action' => 'editRepairModal', $repair->id],
            ['class' => 'modal-ajax-button btn btn-default']) ?>
            <?= $this->Html->link(__('Delete'), ['controller' => 'Repairs', 'action' => 'delete', $repair->id], ['class' => 'btn btn-danger delete-ajax-button']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

<?php endif; ?>
<?= $this->Panel->end(); ?>