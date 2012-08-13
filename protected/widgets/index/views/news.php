<p><b>Новости на главной</b></p>
<?php  foreach($model as $val):?>
<p>
    <a href="/news/<?php echo Yii::app()->menuManager->getPath($val->id, 'news');?>"><?php echo $val->header;?></a>

</p>
<?php  echo (!empty($val->preview) ? $val->preview .'<hr />' : '');?> 
<?php endforeach; ?>
