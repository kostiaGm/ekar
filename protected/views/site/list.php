<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<table >
 <?php 
 $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
     'itemView'=>'_list'
      
        )); 
?>
</table>