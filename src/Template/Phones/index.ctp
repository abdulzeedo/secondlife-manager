<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone[]|\Cake\Collection\CollectionInterface $phones
 */
?>
<style>
    td.details-control{
        width: 100px;
        width: 100px;
    }
    td.details-control:before {
        content:"\e252";
        font-family: "Glyphicons Halflings";
        line-height: 1;
        margin: 10px;
        color: #848484;
        display: inline-block;
    }
    td.details-control {

        cursor: pointer;
    }
    tr.shown td.details-control:before {
        content:"\e253";
        color: #ff0e1d;
    }
    .sub-table {
        background: #f9f9f9;
        padding: 1rem 0 1rem 1rem;
    }
    .sub-table table {
        width: auto;
    }
    .zero-padding {
        padding: 0 !important;
    }
</style>
<div class="row island-style">
<div class="col-md-12">
    <h3><?= __('Phones') ?></h3>


    <?php
    echo $this->Form->create(null, ['valueSources' => 'query', 'id' => 'home-filter-form']);
    echo $this->Panel->startGroup(['open' => true]);
    echo $this->Panel->create('Advanced Filters');
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo $this->Form->control('storage_id', ['options' => $storages, 'empty' => true]);
    echo $this->Form->control('colour_id', ['type' => 'select', 'multiple' => 'checkbox', 'options' => $colours, 'empty' => true]);
    echo $this->Form->control('model_id', ['options' => $models, 'empty' => true]);
        echo '</div><div class="col-md-6">';
    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
    echo $this->Form->control('grade');
    echo $this->Form->control('icloud_status', ['type' => 'checkbox', 'label' => 'iCloud Locked',
        'templates' => ['nestingLabel' => '<input type="hidden" name="{{name}} value"><label {{attrs}}>{{input}}{{text}}</label>']]);
    echo $this->Form->control('touch_id_status', ['type' => 'checkbox', 'label' => 'Touch ID',
        'templates' => ['nestingLabel' => '<input type="hidden" name="{{name}} value"><label {{attrs}}>{{input}}{{text}}</label>']]);
    echo $this->Form->control('is_phone_available', ['type' => 'checkbox', 'label' => 'Available Phones only',
        'templates' => ['nestingLabel' => '<input type="hidden" name="{{name}} value"><label {{attrs}}>{{input}}{{text}}</label>']]);
        echo '</div></div><div class="row"><div class="col-md-6" id="filter-supplier-id">';
    echo $this->Form->control('supplier_id', ['type' => 'select', 'multiple' => 'checkbox', 'options' => $suppliers, 'empty' => true]);
        echo '</div><div class="col-md-6" id="filter-supplier-orders"></div>'
             .'<div class="col-md-6">';
    echo $this->Form->control('customer_id', ['type' => 'select', 'multiple' => 'checkbox', 'options' => $customers, 'empty' => true]);
    echo '</div></div><div class="row"><div class="col-md-6">';
    echo $this->Form->control('Repairs.status', ['type' => 'select', 'multiple' => 'checkbox', 'options' => $repairs, 'empty' => true, 'label' => 'Repairs status']);
        echo '</div><div class="col-md-6">';
    echo $this->Form->control('Repairs.reason', ['type' => 'select', 'multiple' => 'checkbox', 'options' => $repairsReason, 'empty' => true, 'label' => 'Repair reason']);
    echo '</div></div>'; // Closing tag for row
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
<br>
    <div class="row island-style">
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
<br>
<div class="row island-style">
    <div class="col-md-12">
    <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" class="table" id="main-table">
        <thead>
            <tr>
                <th scope="col"><?= __('ID') ?></th>
                <th scope="col"><?= __('IMIEI') ?></th>
                <!--<th scope="col"><?= __('serial_number') ?></th>-->
                <th scope="col"><?= __('GRADE') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Storage') ?></th>
                <th scope="col"><?= __('created') ?></th>
                <!--<th scope="col"><?= __('modified') ?></th>-->
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Colour') ?></th>
                <th scope="col"><?= __('Battery Health (Cycles)') ?></th>
                <th scope="col"><?= __('Miscellaneous') ?></th>
                <!--<th scope="col"><?= __('Os Version') ?></th>-->
                <!--<th scope="col"><?= __('region_code') ?></th>-->
                <!--<th scope="col"><?= __('Model Number') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($phones as $phone): ?>
            <tr>
                <td class="details-control"><?= $this->Number->format($phone->id) ?></td>
                <td><?= h($phone->imiei) ?></td>
                <!--<td><?= h($phone->serial_number) ?></td>-->
                <td><?= h($phone->grade) ?></td>
                <td><?= h($phone->status) ?></td>
                <td><?= $phone->has('storage') ? $this->Html->link($phone->storage->storage, ['controller' => 'Storages', 'action' => 'view', $phone->storage->id]) : '' ?></td>
                <td><?= h($this->Time->i18nFormat($phone->created)) ?></td>
                <!--<td><?= h($this->Time->i18nFormat($phone->modified)) ?></td>-->
                <td><?= $phone->has('model') ? $this->Html->link($phone->model->name, ['controller' => 'Models', 'action' => 'view', $phone->model->id]) : '' ?></td>
                <td><?= $phone->has('colour') ? $this->Html->link($phone->colour->colour_name, ['controller' => 'Colours', 'action' => 'view', $phone->colour->id]) : '' ?></td>
                <td><?= $this->Number->format($phone->battery_health) ?>
                     (<?= $this->Number->format($phone->battery_cycles) ?>)    </td>
                <td>
                    <span class="fas fa-cloud
                                <?= ($phone->icloud_status === '0' ? 'green-status-icon' : 'red-status-icon') ?>"
                          data-toggle="tooltip"
                          data-placement="bottom" title="iCloud <?= $phone->icloud_status_label ?>"></span>
                    <span class="fas fas fa-signal
                                 <?= ($phone->sim_lock_status === 'unlocked' ? 'green-status-icon'
                                 : ($phone->sim_lock_status === 'locked' ? 'red-status-icon'
                                 : 'unknown-status-icon')) ?>"
                          data-toggle="tooltip"
                          data-placement="bottom" title="Sim <?= $phone->sim_lock_status ?>"></span>
                    <span class="fas fa-fingerprint
                                <?= ($phone->touch_id_status === '0' ? 'green-status-icon' : 'red-status-icon')?>"
                          data-toggle="tooltip"
                          data-placement="bottom" title="Touch ID <?= $phone->touch_id_status_label ?>"></span>
                    <?php
                        $returnsCount = $phone->getReturnsCount();
                        $repairsCount = $phone->getRepairsCount();
                        $isPhoneAvailable = $phone->is_phone_available;
                    ?>
                    <span class="fas fa-dollar-sign
                                <?= ($isPhoneAvailable ? 'unknown-status-icon' : 'green-status-icon')?>"
                          data-toggle="tooltip"
                          data-placement="bottom" title="<?= ($isPhoneAvailable ? 'Available' : 'Not available') ?>"></span>

                    <span class="fas fa-undo-alt
                            <?= ($returnsCount > 0 ? 'yellow-status-icon' : 'unknown-status-icon')?>"
                            data-toggle="tooltip"
                            data-placement="bottom" title="<?= ($returnsCount < 0 ? 'No' : $returnsCount) ?> Returns">
                        <?= ($returnsCount > 0 ? '<span class="status-icon-badge">'.$returnsCount.'</span>' : '') ?></span>
                    <span class="fas fa-screwdriver
                            <?= ($repairsCount > 0 ? 'yellow-status-icon' : 'unknown-status-icon')?>"
                            data-toggle="tooltip"
                            data-placement="bottom" title="<?= ($repairsCount < 0 ? 'No' : $repairsCount) ?> Repairs">
                        <?= ($repairsCount > 0 ? '<span class="status-icon-badge">'.$repairsCount.'</span>' : '') ?></span>
                    </span>

                </td>
                <!--<td><?= h($phone->os_version) ?></td>-->
                <!--<td><?= h($phone->region_code) ?></td>-->
                <!--<td><?= h($phone->model_number) ?></td>-->
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
</div>
</div>

<?= $this->element('Common/modal'); ?>

<script>
    // Initialize the tooltip here.
    $('[data-toggle="tooltip"]').tooltip();
    var table = $('#main-table').DataTable({
        select: true,
        stateSave: true
    });

    function getPhoneDetails(input) {
        return $.ajax({
            type: "post",
            url: '/phones/getPhoneDetails/' + input,
            dataType: 'json',
        });
    }

    $('#main-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            var div = format(row.data());
            row.child( div ).show();
            div.parent().addClass("zero-padding");
            tr.addClass('shown');
        }
    } );

    function format( rowData ) {

        var div = $('<div/>')
            .addClass( 'loading' )
            .text( 'Loading...' );

        getPhoneDetails(rowData[0])
            .then((response) => {
                phone = response.phone;

               div.html(
                   "<table class='table table-bordered table-hover'>" +
                   "<tbody>" +
                   "<tr>" +
                   "<th>Comments:</th>" +
                   (phone.comments != null ? `<td>${phone.comments}</td>` : '<td></td>') +
                   "</tr>" +
                   "<tr>" +
                   "<th>Model:</th>" +
                   (phone.model != null ? `<td>${phone.model}</td>` : '<td></td>') +
                   "</tr>" +
                   "<tr>" +
                   "<th>OS Version:</th>" +
                   (phone.os_version != null ? `<td>${phone.os_version}</td>` : '<td></td>') +
                   "</tr>" +
                   "<tr>" +
                   "<th>Supplier:</th>"
                        + (phone.supplier_order != null ?
                            `<td>${phone.supplier_order.supplier.name}</td>`
                            : '<td></td>') +
                   "</tr>" +
                   "</tbody>" +
                   "</table>" +
                   "<p><b>Repairs:</b></p>" +
                   (phone.repairs.length !== 0 ?
                               "<table class='table table-bordered table-hover'>" +
                               "<thead>" +
                               "<tr>" +
                               "<th>ID</th>" +
                               "<th>Reason</th>" +
                               "<th>Status</th>" +
                               "<th>Comments</th>" +
                               "<th>Created</th>" +
                               "<th>Modified</th>" +
                               "</tr>" +
                               "</thead>" +
                               "<tbody>" +
                               $.map(phone.repairs, (repair, i) => {
                                   return "<tr>" +
                                       `<td>${repair.id} </td>` +
                                       `<td>${repair.reason} </td>` +
                                       `<td>${repair.status} </td>` +
                                       `<td>${repair.comments} </td>` +
                                       `<td>${repair.created} </td>` +
                                       `<td>${repair.modified} </td>` +
                                       "</tr>"
                               }).join("") +
                               "</tbody>" +
                               "</table>"

                   : '<p>No repairs found.</p>')
                   + "<p><b>Returns: </b></p>" +
                   (phone.item_returns.length !== 0 ?
                           (
                               "<table class='table table-bordered table-hover'>" +
                               "<thead>" +
                               "<tr>" +
                               "<th>ID</th>" +
                               "<th>Reason</th>" +
                               "<th>Status</th>" +
                               "<th>Refund Amount</th>" +
                               "<th>Comments</th>" +
                               "<th>Created</th>" +
                               "<th>Modified</th>" +
                               "</tr>" +
                               "</thead>" +
                               "<tbody>" +
                               $.map(phone.item_returns, (itemReturn, i) => {
                                   return "<tr>" +
                                       `<td>${itemReturn.id} </td>` +
                                       `<td>${itemReturn.reason} </td>` +
                                       `<td>${itemReturn.status} </td>` +
                                       `<td>${itemReturn.refund} </td>` +
                                       `<td>${itemReturn.comments} </td>` +
                                       `<td>${itemReturn.created} </td>` +
                                       `<td>${itemReturn.modified} </td>` +
                                       "</tr>"
                               }).join("") +
                               "</tbody>" +
                               "</table>"
                           )
                   : "<p> No returns present!<p>"

                   )

               )
            })
            .fail(()=> {
                div.html("Sorry error occurred during loading. <br>" +
                    "Check your internet connection");
            })
            .always(()=>{
                div.removeClass( 'loading' );
            });
        // Do some style formatting to the div
        div.addClass('sub-table');
        return div;
    }
</script>
