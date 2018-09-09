<?=
    $this->Form->control($name,
                         ['type' => 'select', 'multiple' => 'checkbox', 'options' => $values, 'empty' => true,
                          'label' => $label])
?>