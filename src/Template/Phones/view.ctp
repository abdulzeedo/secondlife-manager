<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone $phone
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->Panel->create();?>
        <?= $this->Panel->header();?>
        <h3><?= h($phone->label) ?></h3>
        <?= $this->Panel->body(); ?>
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th scope="row"><?= __('Imiei') ?></th>
                <td><?= h($phone->imiei) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Serial Number') ?></th>
                <td><?= h($phone->serial_number) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Grade') ?></th>
                <td><?= h($phone->grade) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($phone->status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Storage') ?></th>
                <td><?= $phone->has('storage') ? $this->Html->link($phone->storage->storage, ['controller' => 'Storages', 'action' => 'view', $phone->storage->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Model') ?></th>
                <td><?= $phone->has('model') ? $this->Html->link($phone->model->name, ['controller' => 'Models', 'action' => 'view', $phone->model->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Colour') ?></th>
                <td><?= $phone->has('colour') ? $this->Html->link($phone->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $phone->colour->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sim Lock Status') ?></th>
                <td><?= h($phone->sim_lock_status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Os Version') ?></th>
                <td><?= h($phone->os_version) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Region Code') ?></th>
                <td><?= h($phone->region_code) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Model Number') ?></th>
                <td><?= h($phone->model_number) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($phone->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Battery Health') ?></th>
                <td><?= $this->Number->format($phone->battery_health) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Battery Cycles') ?></th>
                <td><?= $this->Number->format($phone->battery_cycles) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($phone->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($phone->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Supplier') ?></th>
                <?php if (!empty($phone->supplier_order)): ?>
                <td>
                    <?= h($phone->supplier_order->supplier->name) ?>
                    (<?= h($phone->supplier_order->supplier->description) ?>)
                </td>
                <?php endif; ?>
            </tr>
            <tr>
                <th scope="row"><?= __('Sold to') ?></th>
                <td>
                <?php foreach($phone->transactions as $transaction): ?>
                    <?= h($transaction->customer->name) ?> - <?= h($transaction->created) ?> <br>
                <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<?= $this->Panel->end(); ?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->Panel->create(); ?>
        <?= $this->Panel->body(); ?>
            <h4><?= __('Comments') ?></h4>
            <?= $this->Text->autoParagraph(h($phone->comments)); ?>
    </div>
    <?= $this->Panel->end(); ?>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->element('Common/repairs') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->element('Common/returns') ?>
    </div>
</div>


        <br><br>

        <?= $this->element('Common/modal') ?>


    </div>







