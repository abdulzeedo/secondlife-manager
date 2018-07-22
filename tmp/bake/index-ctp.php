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
<CakePHPBakeOpenTag= $this->Html->bootstrapCss(); CakePHPBakeCloseTag>
<CakePHPBakeOpenTag= $this->Html->bootstrapScript(); CakePHPBakeCloseTag>
<CakePHPBakeOpenTagphp
/**
 * @var \<?= $namespace ?>\View\AppView $this
 * @var \Cake\ORM\ResultSet $<?= $pluralVar ?>

 */

$this->set('bakeEntities', <?= var_export($bakeEntities) ?>);
CakePHPBakeCloseTag>
<?php
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return !in_array($schema->columnType($field), ['binary', 'text']);
});

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
$fields = $fields->reject(function ($field) {
return $field === 'lft' || $field === 'rght';
});
}

if (!empty($indexColumns)) {
$fields = $fields->take($indexColumns);
}

?>
<div class="container" id="<?= Inflector::underscore($pluralVar.Inflector::humanize($action)) ?>">
    <CakePHPBakeOpenTag= $this->Html->button(
        '<i class="fa fa-plus-circle fa-lg"></i> ' . __('New <?= $singularHumanName ?>'),
        ['action' => 'add'],
        ['class' => ['float-right'], 'escape' => false, 'size' => 'small']); CakePHPBakeCloseTag>
    <h3 class="mb-4"><CakePHPBakeOpenTag= __('<?= $pluralHumanName ?>') CakePHPBakeCloseTag></h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
<?php foreach ($fields as $field): ?>
                <th><CakePHPBakeOpenTag= $this->Paginator->sort('<?= $field ?>') CakePHPBakeCloseTag></th>
<?php endforeach; ?>
                <th><CakePHPBakeOpenTag= __('Actions') CakePHPBakeCloseTag></th>
            </tr>
            </thead>
            <tbody>
            <CakePHPBakeOpenTagphp foreach ($<?= $pluralVar ?> as $<?= $singularVar ?>): CakePHPBakeCloseTag>
            <tr>
<?php foreach ($fields as $field) {
$isKey = false;
if (!empty($associations['BelongsTo'])) {
foreach ($associations['BelongsTo'] as $alias => $details) {
if ($field === $details['foreignKey']) {
$isKey = true;
?>
                <td><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></td>
<?php
break;
}
}
}
if ($isKey !== true) {
if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
?>
                <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php
} else {
?>
                <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php
}
}
}
$pk = '$' . $singularVar . '->' . $primaryKey[0];
?>
                <td class="text-right">
                    <CakePHPBakeOpenTag= $this->Html->link(null, ['action' => 'view', <?= $pk ?>], ['class' => 'btn btn-primary fa fa-eye p-1 mx-1']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Html->link(null, ['action' => 'edit', <?= $pk ?>], ['class' => 'btn btn-primary fa fa-pencil p-1 mx-1']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Form->postLink(null, ['action' => 'delete', <?= $pk ?>], [
                    'confirm' => __('Are you sure you want to delete # {0}?', <?= $pk ?>),
                    'class' => 'btn btn-primary fa fa-trash p-1 mx-1'
                    ]) CakePHPBakeCloseTag>
                </td>
            </tr>
            <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            <CakePHPBakeOpenTag= $this->Paginator->prev('< ' . __('previous')) CakePHPBakeCloseTag>
            <CakePHPBakeOpenTag= $this->Paginator->numbers() CakePHPBakeCloseTag>
            <CakePHPBakeOpenTag= $this->Paginator->next(__('next') . ' >') CakePHPBakeCloseTag>
        </ul>
        <small class="text-muted"><CakePHPBakeOpenTag= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) CakePHPBakeCloseTag></small>
    </nav>
</div>
