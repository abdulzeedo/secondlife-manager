<?= $this->Panel->create(); ?>
<?= $this->Panel->header();?>
<h4>History of actions</h4>
<?= $this->Panel->body(['class' => 'logs-history']); ?>
<?php foreach($phone->audit_trail as $i => $logs): ?>
<div class="alert log-message alert-<?php echo ($logs['type'] === 'created' ? 'info'
                                        : ($logs['type'] === 'updated' ? 'warning' : 'danger')) ?>" role="alert">
    <?php if ($logs["type"] === 'created'): ?>
        <i class="far fa-plus-square fa-lg"></i>
        <strong><?= $logs["user"] ?></strong> has created a new
        <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
    <?php elseif ($logs["type"] === 'updated'): ?>
        <i class="fas fa-edit"></i>
        <strong><?= $logs["user"] ?></strong> has updated
        <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
    <?php else: ?>
        <i class="fas fa-trash-alt"></i>
        <strong><?= $logs["user"] ?></strong> has deleted
        <strong><?= $logs["source"] ?> #<?= $logs["id"] ?></strong>.
    <?php endif; ?>
    <?php if(count($logs["updates"]) > 3): ?>
        <button class="btn icon btn-xs collapsed"  data-toggle="collapse" data-target="#property-<?= $i ?>">
            more
        </button>
    <?php else: ?>
        <br>
    <?php endif; ?>




        <?php if($logs["type"] === 'created'): ?>
        <?php foreach($logs["updates"] as $key => $update): ?>
        <hr>
        <?php if ($key === 3): ?>
            <div class="collapse" id="property-<?= $i ?>">
        <?php endif; ?>
        <div class="property-message">
            <strong><?= ucfirst($update["property"]) ?></strong> has been added: '<?= $update["original"] ?>'.
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if($logs["type"] === 'updated'): ?>
        <?php foreach($logs["updates"] as $key => $update): ?>
        <hr>
        <?php if ($key === 3): ?>
            <div class="collapse" id="property-<?= $i ?>">
        <?php endif; ?>
        <div class="property-message">
            <strong><?= ucfirst($update["property"]) ?></strong> has changed from '<?= $update["original"] ?>'
            to '<?= $update["changed"] ?>'
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if(count($logs["updates"]) > 3): ?>
            </div>
        <?php endif; ?>
</div>
<div class="time">
    <span><?= h($this->Time->i18nFormat($logs["date"])) ?></span>
</div>
<?php endforeach; ?>
<?= $this->Panel->end(); ?>