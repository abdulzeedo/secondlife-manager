<html>
<title><?= $phone->label ?></title>
<body>
<div class="grade">
    <?= $phone->grade ?>
</div>
<div style="text-align: right">
    <barcode code="<?= $phone->imiei ?>" type="C128A" height="0.66" text="1" size="0.8"/>
</div>
<div style="text-align: center">
    IMIEI: <?= $phone->imiei ?>
</div>
<div class="label">
    <?= $phone->model->manufacturer->name ?> <?= $phone->label ?>
    <?php if ($phone->sim_lock_status === 'locked'): ?>
        - GSM Locked
    <?php endif; ?>

    <?php if ($phone->icloud_status === '1'): ?>
         - iCloud LOCK
    <?php endif; ?>
    <?php if ($phone->touch_id_status === '1'): ?>
         - TOUCH ID
    <?php endif; ?>
</div>

</body>
</html>