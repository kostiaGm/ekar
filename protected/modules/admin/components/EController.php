<?php

/*
 * class EController
 * 
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 * Класс PageUrlRule 
 * 
 */


class EController extends Controller
{
    public $layout = 'webroot.themes.develop.admin.views.layouts.main';
    public $viewPath = 'webroot.themes.develop.admin.views';
    protected $_errorsMessage = array(
        'ru'=>array(
            'Модель для этого контроллера не найдена. Передайте свойству _model объект класса Model'
        )
    );
    
    protected function _getErrorMessage($index)
    {
        $language = Yii::app()->language;
      
        if (isset($this->_errorsMessage[$language][$index])) {
            return $this->_errorsMessage[$language][$index];
        }
        return '';
    }
    
    
    //put your code here
}
