<h1><?php echo $header;?></h1>
<table >
 <?php 
 // -4 зароса
 
 $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
     'itemView'=>'_list',
    
      
        )); 
?>
</table>