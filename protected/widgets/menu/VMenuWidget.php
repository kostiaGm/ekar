<?php

class VMenuWidget extends CMenu
{
    private $_model;
    public function init()
    {
        $this->_model = Urls::model();
        
        $this->items = $this->_model->initVMenu();    

        parent::init();
    }
    
   
}

?>
