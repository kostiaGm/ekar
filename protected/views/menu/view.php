<?php
$this->breadcrumbs=array(
	'Urls3s'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Urls3', 'url'=>array('index')),
	array('label'=>'Create Urls3', 'url'=>array('create')),
	array('label'=>'Update Urls3', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Urls3', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Urls3', 'url'=>array('admin')),
);
?>

<h1>View Urls3 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parentId',
		'recordId',
		'url',
		'module',
		'controller',
		'action',
	),
)); ?>
