<tr>
    <td>
        <?php echo CHtml::link($data->header, array( Yii::app()->menuManager->getPath($data->id, 'news')));?>
        
    </td>    
</tr>

<tr>
    <td><?php echo $data->preview; ?></td>    
</tr>