<?php


class NewsWidget extends CWidget
{
    public $limit = 5;   
    public function init()
    {
        $model = News::model()->findAll(array(
            'condition'=>'top=:top',
            'params'=>array(':top'=>'1'),
            'limit'=>$this->limit
        ));
       
        $this->render('news', array('model'=>$model));
    }
    
   
}
