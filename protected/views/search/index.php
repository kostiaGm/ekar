<h1>Поиск</h1>
<table >
 <?php 
 
// var_dump($pageDataProvider->getData());
 
 $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$pageDataProvider,
     'itemView'=>'_list',
    
      
        )); 
?>
</table>
