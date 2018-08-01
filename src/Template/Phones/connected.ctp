<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Phone $phone
 */
?>

<div style='position: fixed; margin-right: 2rem; right: 0;z-index: 1000;'>
    <div id="alert-box"></div>
</div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="">
                <?= $this->Form->create($phone, ['horizontal' => false, 'id' => 'edit-phone-form']) ?>
                <br>
                <fieldset>

                    <legend><?= __('Edit Connected Phone') ?>
                        <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $phone->id],
                        [
                        'class' => 'btn btn-danger btn-md',
                        'confirm' => __('Are you sure you want to delete # {0}?', $phone->id)
                        ]);?></legend>
                    <br>
                    <?php

                    echo $this->Form->input('grade', [
                            'options' => $values['grade'],
                            'empty' => true,
                            'type' => 'select',
                            'class' => 'selectpicker',
                            'data-live-search' => "true",
                            'data-show-subtext'=>"true",
                            'data-live-search-style' => 'startsWith'
                        ]);
                    echo $this->Form->control('status');

                    echo $this->Form->input(
                            'sim_lock_status',
                    [
                        'options' => $values['sim_lock_status'],
                        'type'=> 'radio',
                        'inline' => 'true'
                    ]);
                    echo $this->Form->control('comments');
                    echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-lg']);
                    echo "<hr>";
                    echo $this->Form->control('imiei', ['required' => true]);
                    echo $this->Form->control('serial_number');
                    echo $this->Form->control('storage_id', ['options' => $storages, 'empty' => true]);
                    echo $this->Form->control('model_id', ['options' => $models, 'empty' => true]);
                    echo $this->Form->control('colour_id', ['options' => $colours, 'empty' => true]);
                    echo $this->Form->control('battery_health');
                    echo $this->Form->control('battery_cycles');
                    echo $this->Form->control('os_version');
                    echo $this->Form->control('region_code');
                    echo $this->Form->control('model_number');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-8">
            <div class="alert alert-success" id="edit-phone-form-alert" role="alert">Nothing to submit</div>
            <?php
                echo $this->Panel->create($phone->label);

            ?>
            <div class="table-responsive">
            <table class="table ">
                <tr>
                    <th scope="row"><?= __('Imiei') ?></th>
                    <td><?= h($phone->imiei) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Serial Number') ?></th>
                    <td><?= h($phone->serial_number) ?></td>
                </tr>
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
                    <td><?= $phone->has('colour') ? $this->Html->link(ucfirst($phone->colour->colour_name), ['controller' => 'Colours', 'action' => 'view', $phone->colour->id]) : '' ?></td>
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
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($this->Time->i18nFormat($phone->created)) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($this->Time->i18nFormat($phone->modified)) ?></td>
                </tr>
            </table>
            </div>
            <?php
                echo $this->Panel->end();
            ?>

                <div>

                    <?= $this->element('Common/returns') ?>

                    <div><div>
                    <?= $this->element('Common/repairs') ?>


            <?= $this->element('Common/modal') ?>
        </div>
    </div>
</div>
<script>
    unsavedForm = function(event) {
        form.data("changed", true);
        console.log(event);
        let field = $(event.target);
        field.parent().addClass("has-warning");
        $('#edit-phone-form-alert').html('You might have un-saved data.')
            .removeClass("alert-success")
            .addClass("alert-warning");
        $(window).on("beforeunload", function() {
            return "Are you sure? The form has unsubmitted changes!";
        });
    }
    removeBeforeUnload = function(event) {
        $(window).off("beforeunload");
        return true;
    }

    form = $("#edit-phone-form");

    form.on('input', undefined, unsavedForm);
    form.on('changed.bs.select', unsavedForm);
    form.on('submit', removeBeforeUnload);






</script>