<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone $phone
 */
?>
<div class="row">
    <div class="col-md-6">
        <?= $this->Panel->create();?>
        <?= $this->Panel->header();?>
        <h3><?= h($phone->label) ?></h3>
        <?= $this->Html->link(__('Edit'), ['controller' => 'phones', 'action' => 'edit', $phone->id], ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link(__('Label'), ['controller' => 'phones', 'action' => 'pdfLabel', $phone->id], ['class' => 'btn btn-default', 'target' => '_blank']) ?>
        <?= $this->Panel->body(); ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th scope="row"><?= __('Model') ?></th>
                        <td><?= $phone->has('model') ? $this->Html->link($phone->model->name, ['controller' => 'Models', 'action' => 'view', $phone->model->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Storage') ?></th>
                        <td><?= $phone->has('storage') ? $this->Html->link($phone->storage->storage, ['controller' => 'Storages', 'action' => 'view', $phone->storage->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Colour') ?></th>
                        <td><?= $phone->has('colour') ? $this->Html->link($phone->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $phone->colour->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Imiei') ?></th>
                        <td><?= h($phone->imiei) ?></td>
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
                        <th scope="row"><?= __('Sim Lock Status') ?></th>
                        <td><?= h($phone->sim_lock_status) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('iCloud status') ?></th>
                        <td><?= h($phone->icloud_status_label) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Touch ID status') ?></th>
                        <td><?= h($phone->touch_id_status_label) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Supplier') ?></th>
                        <td>
                            <?php if (!empty($phone->supplier_order)): ?>
                            <?= h($phone->supplier_order->supplier->name) ?>
                            <?= h('('.$phone->supplier_order->supplier->description.')') ?>
                            <p><b>Invoice</b>: <?= $phone->supplier_order->invoice_number ?>
                                <?= $phone->supplier_order->invoice_date ?></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Sold to') ?></th>
                        <td>
                            <?php foreach($phone->customers as $customer): ?>
                            <?= $this->Html->link($customer->name, ['controller' => 'transactions', 'action' => 'view', $customer->_joinData->id], ['target' => '_blank'])  ?>
                            - <?= h($customer->_joinData->date) ?> <br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th scope="row"><?= __('Battery Health') ?></th>
                        <?= $phone->battery_health < 65 ? '<td class="danger">' :
                        ($phone->battery_health < 75 ? '<td class="warning">' :
                        '<td class="success">' )?>
                        <?= $this->Number->format($phone->battery_health) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Battery Cycles') ?></th>
                        <?= $phone->battery_cycles > 1200 ? '<td class="danger">' :
                        ($phone->battery_cycles > 800 ? '<td class="warning">' :
                        '<td class="success">' )?>
                        <?= $this->Number->format($phone->battery_cycles) ?></td>
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
                        <th scope="row"><?= __('Serial Number') ?></th>
                        <td><?= h($phone->serial_number) ?></td>
                    </tr>
                    <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($phone->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($this->Time->i18nFormat(
                            $phone->created
                            )) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($this->Time->i18nFormat(
                            $phone->modified
                            )) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?= $this->Panel->end(); ?>
    <?= $this->Panel->create(); ?>
    <?= $this->Panel->body(); ?>
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($phone->comments)); ?>
        <?= $this->Panel->end(); ?>
    </div>

    <div class="col-md-6">
        <?= $this->element('Common/repairs') ?>

        <?= $this->element('Common/returns') ?>
        <?= $this->Panel->create(); ?>
        <?= $this->Panel->header();?>
        <h4>History of actions</h4>
        <?= $this->Panel->body(['class' => 'logs-history']); ?>
        <?php foreach($phone->audit_trail as $logs): ?>
            <div class="alert log-message alert-<?php echo ($logs['type'] === 'created' ? 'info'
                                        : ($logs['type'] === 'updated' ? 'warning' : 'danger')) ?>" role="alert">
                <?php if ($logs["type"] === 'created'): ?>
                    <strong><?= $logs["user"] ?></strong> has created a new
                    <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
                <?php elseif ($logs["type"] === 'updated'): ?>
                    <strong><?= $logs["user"] ?></strong> has updated
                    <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
                <?php else: ?>
                    <strong><?= $logs["user"] ?></strong> has deleted
                    <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
                <?php endif; ?>
                <br>
                <?php foreach($logs["updates"] as $update): ?>
                    <hr>
                    <strong><?= ucfirst($update["property"]) ?></strong> has changed from '<?= $update["original"] ?>'
                    to '<?= $update["changed"] ?>'
                <?php endforeach; ?>

            </div>
            <div class="time">
                <?= h($this->Time->i18nFormat($logs["date"])) ?>
            </div>
        <?php endforeach; ?>
        <?= $this->Panel->end(); ?>

    </div>
</div>

        <br><br>

        <?= $this->element('Common/modal') ?>


    </div>







