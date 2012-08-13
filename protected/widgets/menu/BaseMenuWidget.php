<?php

class BaseMenuWidget extends CMenu
{    
    public $isTestVisibility = true;
    
    public function init()
    {
       // $this->_model = Urls::model();
        $this->items = Yii::app()->pageMenuData->getData();
       // $this->items = $this->_model->initVMenu();    
        parent::init();
    }
}


