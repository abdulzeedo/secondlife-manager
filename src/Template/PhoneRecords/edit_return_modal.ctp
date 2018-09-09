<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add/Edit Returns</h5>
    </div>
    <div class="modal-body">
        <p v-show="returnModalLoading.status">{{returnModalLoading.message}}</p>
        <div v-show="returnModalError.status" class="alert alert-danger">
            {{returnModalError.message}} {{returnModalError.error}}</div>
        <?= $this->Form->create($return, [
        'id' => 'returns-form',
        '@submit.prevent' => "\$emit('process-return-form')",
        'novalidate',
        'escape' => false,
        ]);?>
        <?= $this->element('Common/forms/return') ?>
        <div class="modal-footer">
            <?= $this->Form->button('Go back', ['@click.prevent' => "\$emit('go-back')"]) ?>
            <?= $this->Form->button(__('Submit'), ['@click.prevent' => "\$emit('process-return-form')"]) ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>