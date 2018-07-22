<div class="modal-content">
    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Title</h5>
            </div>
    <div class="modal-body">
        <?= $this->Form->create($phone, [
        'class' => 'form-ajax',
        'novalidate',
        ]);?>
        <fieldset>
            <?= $this->Form->input('imiei'); ?>
            // [further input fields]
        </fieldset>


        <div class="modal-footer">
            // FormEnd (save) button generated using CkTools
            <?= $this->Form->submit(); ?>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>
