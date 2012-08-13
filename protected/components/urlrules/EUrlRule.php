<?php

/*
 * class EUrlRule
 * 
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 * Абстрактный класс EUrlRule определяет интерфейс обработчиков ссылок

 */

abstract class EUrlRule
{

    protected $_filter;
    private $_urlModel;
    
    // --------------- public --------------------------
    
    public $noTest = array('gii.*',  'site\/login');

    public function __construct($filter)
    {
        $this->_filter = $filter;
        $this->_urlModel = Urls::model();
    }

    public abstract function createUrl($manager, $route, $params, $ampersand);

    public abstract function parseUrl($manager, $request, $pathInfo, $rawPathInfo);

    protected function _getUrl($url)
    {
        return $this->_urlModel->find("url=:url", array(":url" => $url));
    }

    public function getUrlModel()
    {
        return $this->_urlModel;
    }

    protected function _isTest($url)
    {       
        if (empty($this->noTest) || empty($url)) {
            return true;
        }

        foreach ($this->noTest as $val) {
            if (preg_match("/$val/", $url)) {               
                return false;
            }
        }
        return true;
    }

}

