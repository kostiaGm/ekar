<p><b>Стати на главной</b></p>
<?php  foreach($model as $val):?>
<p>
    <a href="/<?php echo Yii::app()->menuManager->getPath($val->id);?>"><?php echo $val->header;?></a>
</p>

<?php //var_dump(Yii::app()->menuManager->getPath($val->id));?>
<?php  echo (!empty($val->preview) ? $val->preview .'<hr />' : '');?> 
<?php endforeach; ?>
