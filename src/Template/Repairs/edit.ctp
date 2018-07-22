<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Repair $repair
 */
?>

<div class="form large-9 medium-8 columns content">
    <?= $this->Form->create($repair) ?>
    <fieldset>
        <legend><?= __('Add Repair') ?></legend>
        <?php
            echo $this->Form->control('reason');
            echo $this->Form->control('status');
            echo $this->Form->control('comments');
            echo $this->Form->control('item_id', [
                'options' => $phonesList,
                'class' => 'selectpicker',
                'data-live-search' => "true",
                'data-show-subtext'=>"true"
            ]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

