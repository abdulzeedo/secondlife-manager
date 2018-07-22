<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$bakeEntities = [ $modelClass ];
foreach ($associations as $type => $data) {
  foreach ($data as $alias => $details){
    if (!empty($details['navLink']) && !in_array($details['controller'], $bakeEntities))
      $bakeEntities[] = $details['controller'];
  }
}
?>

<CakePHPBakeOpenTagphp
/**
 * @var \<?= $namespace ?>\View\AppView $this
 * @var \<?= $namespace ?>\Model\Entity\<?= $this->_entityName($modelClass) ?> $<?= $singularVar ?>

 */

$this->set('bakeEntities', <?= var_export($bakeEntities) ?>);
CakePHPBakeCloseTag>
<?php
use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
?>
<div class="container"  id="<?= Inflector::underscore($singularVar.Inflector::humanize($action)) ?>">
    <div class="float-right">
        <CakePHPBakeOpenTag= $this->Html->button(
        '<i class="fa fa-pencil fa-lg pr-3"></i> ' . __('Edit'),
        ['action' => 'edit', <?= $pk ?>],
        ['class' => ['mr-3'], 'escape' => false, 'size' => 'sm']); CakePHPBakeCloseTag>

        <CakePHPBakeOpenTag= $this->Form->postLink('<i class="fa fa-trash fa-lg pr-3"></i>'. __('Delete'), ['action' => 'delete', <?= $pk ?>], [
        'escape' => false,
        'class' => 'btn btn-primary btn-sm',
        'confirm' => __('Are you sure you want to delete # {0}?', <?= $pk ?>)]) CakePHPBakeCloseTag>
    </div>

    <h3 class="mb-3"><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $displayField ?>) CakePHPBakeCloseTag></h3>
    <dl class="row">
<?php if ($groupedFields['string']) : ?>
<?php foreach ($groupedFields['string'] as $field) : ?>
<?php if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
?>
        <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($details['property']) ?>') CakePHPBakeCloseTag></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></dd>
<?php else : ?>
        <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></dd>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($associations['HasOne']) : ?>
<?php foreach ($associations['HasOne'] as $alias => $details) : ?>
        <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) ?>') CakePHPBakeCloseTag></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></dd>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['number']) : ?>
<?php foreach ($groupedFields['number'] as $field) : ?>
        <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></dd>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['date']) : ?>
<?php foreach ($groupedFields['date'] as $field) : ?>
        <dt class="col-sm-3"><?= "<?= __('" . Inflector::humanize($field) . "') ?>" ?></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></dd>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['boolean']) : ?>
<?php foreach ($groupedFields['boolean'] as $field) : ?>
        <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></dt>
        <dd class="col-sm-9"><CakePHPBakeOpenTag= $<?= $singularVar ?>-><?= $field ?> ? __('Yes') : __('No'); CakePHPBakeCloseTag></dd>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['text']) : ?>
<?php foreach ($groupedFields['text'] as $field) : ?>

    <dt class="col-sm-3"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></dt>
    <dd class="col-sm-9"><CakePHPBakeOpenTag= $this->Text->autoParagraph(h($<?= $singularVar ?>-><?= $field ?>)); CakePHPBakeCloseTag></dd>
<?php endforeach; ?>
<?php endif; ?>
    </dl>
<?php
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize(Inflector::underscore($details['controller']));
        ?>
    <h4><CakePHPBakeOpenTag= __('Related <?= $otherPluralHumanName ?>') CakePHPBakeCloseTag></h4>
    <CakePHPBakeOpenTagphp if (!empty($<?= $singularVar ?>-><?= $details['property'] ?>)): CakePHPBakeCloseTag>
    <div class=" table-responsive">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
    <?php foreach ($details['fields'] as $field): ?>
                    <th scope="col"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></th>
    <?php endforeach; ?>
                    <th scope="col" class="actions"><CakePHPBakeOpenTag= __('Actions') CakePHPBakeCloseTag></th>
                </tr>
            </thead>
            <CakePHPBakeOpenTagphp foreach ($<?= $singularVar ?>-><?= $details['property'] ?> as $<?= $otherSingularVar ?>): CakePHPBakeCloseTag>
            <tr>
<?php foreach ($details['fields'] as $field): ?>
                <td><CakePHPBakeOpenTag= h($<?= $otherSingularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php endforeach; ?>
<?php $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; ?>
                <td class="text-right">
                    <CakePHPBakeOpenTag= $this->Html->link(null, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', <?= $otherPk ?>], ['class' => 'btn btn-primary fa fa-eye p-1 mx-1']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Html->link(null, ['controller' => '<?= $details['controller'] ?>', 'action' => 'edit', <?= $otherPk ?>], ['class' => 'btn btn-primary fa fa-pencil p-1 mx-1']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Form->postLink(null, ['controller' => '<?= $details['controller'] ?>', 'action' => 'delete', <?= $otherPk ?>], [
                    'confirm' => __('Are you sure you want to delete # {0}?', <?= $otherPk ?>),
                    'class' => 'btn btn-primary fa fa-trash p-1 mx-1'
                    ]) CakePHPBakeCloseTag>
                </td>
            </tr>
            <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
        </table>
        <CakePHPBakeOpenTagphp endif; CakePHPBakeCloseTag>
    </div>
<?php endforeach; ?>

</div>