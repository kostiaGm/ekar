<?php

class BaseMenuWidget extends CMenu
{
    private $_model;
    public $cssFile;
    
    public function init()
    {
        $this->_model = Urls::model();
        
        $this->items = $this->_model->initVMenu();    

        parent::init();
    }
}

?>
