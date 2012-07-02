<?php

abstract class EControllerEditAbstract extends EController
{
    protected $_model;
    
    public abstract function actionEdit($id);
    
    public abstract function actionCreate();
    
    public abstract function actionDelete($id);
    
    public abstract function actionList();
    
    protected abstract function form();
    
}
