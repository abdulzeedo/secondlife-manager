<?= $this->Panel->create([
        'id' => 'returns-table',
        'class' => 'relative',
        'data-table-id' => 'returns-table',
        'data-table-url' => $this->Url->build([
            "controller" => "Phones",
            "action" => "returnsTable",
            $phone->id]),
    ]); ?>
<div class="panel-heading" style='display: flex; justify-content: space-between;' data-toggle="collapse">
<h4 ><?= __('Related Returns') ?></h4>
<?= $this->Html->link("<span class='fas fa-plus'></span>", ['controller' => 'Phones', 'action' => 'addReturnModal', $phone->id],
['class' => 'btn btn-default modal-ajax-button', 'escapeTitle' => false]) ?>
</div> <!-- close header-->
<?php if (!empty($phone->item_returns)): ?>
<div class="table-responsive">
<table cellpadding="0" cellspacing="0" class="table table-responsive" >
    <tr>
        <th scope="col"><?= __('Reason') ?></th>
        <th scope="col"><?= __('Status') ?></th>
        <th scope="col"><?= __('Refund') ?></th>
        <th scope="col"><?= __('Created') ?></th>
        <th scope="col"><?= __('Modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>

    </tr>
    <?php foreach ($phone->item_returns as $return): ?>
    <tr>
        <td><?= h($return->reason) ?></td>
        <td><?= h($return->status) ?></td>
        <td><?= h($return->refund) ?></td>
        <td><?= h($this->Time->i18nFormat($return->created)) ?></td>
        <td><?= h($this->Time->i18nFormat($return->modified)) ?></td>


        <td class="actions">
            <?= $this->Html->link("<span class='far fa-eye'></span>", ['controller' => 'ItemReturns', 'action' => 'view', $return->id],
            ['class' => 'btn btn-default', 'escapeTitle' => false]) ?>
            <?= $this->Html->link("<span class='far fa-edit'></span>", ['controller' => 'Phones', 'action' => 'editReturnModal', $return->id],
            ['class' => 'modal-ajax-button btn btn-warning', 'escapeTitle' => false]) ?>
            <?= $this->Html->link("<span class='far fa-trash-alt'></span>", ['controller' => 'ItemReturns', 'action' => 'delete', $return->id],
            ['class' => 'btn btn-danger delete-ajax-button', 'escapeTitle' => false]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="ajax-comments-table-cell"><b><?= __('Comments') ?></b>: <?= h($return->comments) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php endif; ?>
<?= $this->Panel->end(); ?>