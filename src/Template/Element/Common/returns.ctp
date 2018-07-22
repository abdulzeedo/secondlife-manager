<?= $this->Panel->create([
        'id' => 'returns-table',
        'class' => 'relative',
        'data-table-id' => 'returns-table',
        'data-table-url' => $this->Url->build([
            "controller" => "Phones",
            "action" => "returnsTable",
            $phone->id]),
    ]); ?>
<?= $this->Panel->header(['style' => 'display: flex; justify-content: space-between;']); ?>
<h4 ><?= __('Related Returns') ?></h4>
<?= $this->Html->link(__('Add Return'), ['controller' => 'Phones', 'action' => 'addReturnModal', $phone->id],
['class' => 'btn btn-default modal-ajax-button']) ?>
</div> <!-- close header-->
<?php if (!empty($phone->item_returns)): ?>
<div class="table-responsive">
<table cellpadding="0" cellspacing="0" class="table table-responsive" >
    <tr>
        <th scope="col"><?= __('Reason') ?></th>
        <th scope="col"><?= __('Status') ?></th>
        <th scope="col"><?= __('Refund') ?></th>
        <th scope="col"><?= __('Comments') ?></th>
        <th scope="col"><?= __('Created') ?></th>
        <th scope="col"><?= __('Modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>

    </tr>
    <?php foreach ($phone->item_returns as $return): ?>
    <tr>
        <td><?= h($return->reason) ?></td>
        <td><?= h($return->status) ?></td>
        <td><?= h($return->refund) ?></td>
        <td><?= h($return->comments) ?></td>
        <td><?= h($return->created) ?></td>
        <td><?= h($return->modified) ?></td>


        <td class="actions">
            <?= $this->Html->link(__('View'), ['controller' => 'ItemReturns', 'action' => 'view', $return->id],
            ['class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit'), ['controller' => 'Phones', 'action' => 'editReturnModal', $return->id],
            ['class' => 'modal-ajax-button btn btn-default']) ?>
            <?= $this->Html->link(__('Delete'), ['controller' => 'ItemReturns', 'action' => 'delete', $return->id], ['class' => 'btn btn-danger delete-ajax-button']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php endif; ?>
<?= $this->Panel->end(); ?>