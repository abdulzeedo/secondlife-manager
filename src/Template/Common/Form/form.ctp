<h5 class="modal-title"><?= h($this->fetch('title')) ?></h5>
<?= $this->fetch('content') ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end(); ?>