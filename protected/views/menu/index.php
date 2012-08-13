<?php
$this->breadcrumbs=array(
	'Urls3s',
);

$this->menu=array(
	array('label'=>'Create Urls3', 'url'=>array('create')),
	array('label'=>'Manage Urls3', 'url'=>array('admin')),
);
?>

<h1>Менюха. Тест</h1>

<p>
    Добавить <!--<a href="/menu/create/base"> <b>базовую запись</b></a>-->меню для:
    <a href="/menu/create/page"> <b>статей</b></a>  |
    <a href="/menu/create/news">  <b>новостей</b> </a> |
    <a href="/menu/create/catalog"> <b>каталога</b></a>  
</p>

<?php

print_r(Yii::app()->menuManager->getMenu('page'));


?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
