<?php


class PageWidget extends CWidget
{
    public $limit = 5;   
    public function init()
    {
        $model = Page::model()->findAll(array(
            'condition'=>'top=:top AND menu=:menu AND href!=:href',
            'params'=>array(':top'=>'1', ':menu'=>'none', ':href'=>'mainpage'),
            'limit'=>$this->limit
        ));
       
        $this->render('page', array('model'=>$model));
    }
    
   
}
