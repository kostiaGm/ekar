<?php
$this->breadcrumbs=array(
	'Urls3s'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Urls3', 'url'=>array('index')),
	array('label'=>'Manage Urls3', 'url'=>array('admin')),
);
?>

<h1>Create Urls3</h1>
<input type="file" name="files[]" multiple="true">
<?php echo $this->renderPartial($type, array('model'=>$model)); ?>