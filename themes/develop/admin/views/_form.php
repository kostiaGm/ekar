<?php
$form = $this->beginWidget('EActiveForm', array(
    
   
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<?php echo $form->show($model);?>

  
<?php $this->endWidget(); ?>