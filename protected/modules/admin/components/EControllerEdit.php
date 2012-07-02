<?php


class EControllerEdit extends EControllerEditAbstract
{
    public function init() {
        parent::init();
        $this->_model = new Page();
    }
    
    public function actionEdit($id) 
    {
        
    }
    
    public function actionCreate()
    {
        $this->form();
    }
    
    public function actionDelete($id)
    {
        
    }
    
    public function actionList()
    {
        
    }
    
    protected function form()
    {
        if ($this->_model === null) {
            throw new Exception($this->_getErrorMessage(0));
        }
        $this->render('webroot.themes.develop.admin.views._form', array('model'=>$this->_model));
       // $this->render('webroot.themes.develop.admin.views._form', array('schema'=>$this->_model->tableSchema->columns));
       
    }
}

