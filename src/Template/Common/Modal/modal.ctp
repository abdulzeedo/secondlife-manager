<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><?= h($this->fetch('title')) ?></h5>
    </div>
    <div class="modal-body">
        <?= $this->fetch('content') ?>
        <div class="modal-footer">

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->button('Close', ['data-dismiss' => 'modal']) ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>