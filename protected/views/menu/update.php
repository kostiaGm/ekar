<?php
$this->breadcrumbs=array(
	'Urls3s'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Urls3', 'url'=>array('index')),
	array('label'=>'Create Urls3', 'url'=>array('create')),
	array('label'=>'View Urls3', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Urls3', 'url'=>array('admin')),
);
?>

<h1>Update Urls3 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>