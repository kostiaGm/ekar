<?php

/*
 * class PageUrlRule
 * 
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 * Класс PageUrlRule обрабатывает url маршруты.
 * Каждая фнкция заканчивающаяся на Rule обрабатывает разные виды ссылок.
 * @activeRule string - активное правило.
 * @showDefaultController - удалять имя контроллера по умолчанию.
 * 
 */

class PageUrlRule extends CBaseUrlRule
{

    // @activeRule string - активное правило.
    public $parseType = 'single';
    // @showDefaultController - удалять имя контроллера по умолчанию.
    public $showDefaultController = false;
    // @isLanguages Использовать несколько языков
    public $isLanguages= true;
    
    public $adminLinks = array(
        'administrator',
        'manager',
        'user'
    );
     // @_activeLanguage Уакзывает активный язык
    protected $_activeLanguage = 'ru';
    private $_pathInfo;
    
    /* createUrl
     * реализация абстрактного класса указанного в CBaseUrlRule.
     * Отвечает за создание url например, в меню. 
     */

    public function createUrl($manager, $route, $params, $ampersand)
    {
        if (strpos($route, 'gii') !== false) {  
            return $route;
        }
        
        if (!$this->showDefaultController) {
            $route = str_replace(Yii::app()->defaultController . '/', '', $route);
        }
        
        if ($this->isLanguages && !strpos($this->_activeLanguage, $route)) {
            $route = $this->_activeLanguage.'/'.$route;
        }
        
        return $route;
    }

    /* parseUrl
     * реализация абстрактного класса указанного в CBaseUrlRule.
     * Отвечает за парсинг (вызывает действие определенного в этой функции 
     * контроллера). 
     */

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        $this->_pathInfo = $pathInfo;
        $this->adminRules();
       // var_dump($this->_pathInfo); die;
        
        try {
            return $this->runRule();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $this->_pathInfo;
    }

    /* runRule
     * Вызывается в parseUrl. Определяет активное правило, проверяет наличие
     * функции для этого правила и вызывает это правило.
     */

    protected function runRule()
    {
        if (!method_exists($this, $this->parseType . "Rule")) {
            throw new Exception(__CLASS__ . ' rule not found');
        }

        return $this->{$this->parseType . "Rule"}();
    }

    // Список функци-правил

    /* singleRule
     * Функция обробатывает ссылки, в которых нет разделов и подразделов (my-host.com/some-url)
     * 
     */

    protected function singleRule()
    {
        $modelUrls = new Urls();
        $url = '';
        $urlArray = explode('/', $this->_pathInfo);

        if (isset($urlArray[0])) {
            $url = $urlArray[0];
        }
        
        if ($this->isLanguages && $url == $this->_activeLanguage) {
            array_shift($urlArray);            
        }
        
        if (isset($urlArray[0])) {
            $url = $urlArray[0];
        }
        
        if (($data = $modelUrls->findUrl($url)) !== null) {
            $rule = '';
            if (Yii::app()->defaultController != $data->model) {
                $rule .= $data->model;
            }
            
            if (empty($data->controller)) {
                $data->controller = 'site';
            }
            
            if (empty($data->action)) {
                $data->action = 'index';
            }

            $rule .= (!empty($rule) ? '/' : ''). $data->controller.'/'.$data->action;
            
            if ($this->isLanguages) {
                $_GET['lang'] = $this->_activeLanguage;
            }
            
            $_GET['recordId'] = $data->recordId;
            
            return $rule;
        }
        return $this->_pathInfo;
    }
    
    /* adminRules 
     * Правило для админки сайта. Отдельное правило для админки дает возможность
     * устанавливать в урл любое название как для админитсратора, так и для любых
     * типов пользователей. 
     * Вызывается в parseUrl.
     */
    protected function adminRules(){
        
        $url = '';
        $urlArray = explode('/', $this->_pathInfo);
        
        if (isset($urlArray[0])) {
            $url = $urlArray[0];
        }
       
        if ($this->isLanguages && $url == $this->_activeLanguage) {
            array_shift($urlArray);            
        }
        
        if (isset($urlArray[0])) {
            $url = $urlArray[0];
        }
        
        if (!empty($this->adminLinks)) {
            foreach ($this->adminLinks as $link) {
                if ($link == $url) {
                    $urlArray[0] = 'admin';
                    break;
                }
            }
        }
        $this->_pathInfo = implode('/', $urlArray);
    }

}