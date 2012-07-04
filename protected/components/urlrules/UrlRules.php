<?php

/*
 * class UrlRules
 * 
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 * Класс UrlRules обрабатывает url маршруты.
 * Обработкой правил занимаются отдельные классы начинающиеся с EUrlRule
 * ---------------- Свойства класса --------------------------------------------
 * @_activeRuleClass string - активное правило.
 * @_filterRuleClass string - активное правило для фильтра.
 * @_filter EUrlRuleFilter - объект фильтра. Инициализируется методом _initRuleFilter()
 *                           вызывается в методах createUrl() и parseUrl()
 * 
 * --------------- Методы класса -----------------------------------------------
 * @_initRuleFilter void - инициализирует объект класса EUrlRuleFilter и 
 *                         сохраняет его в свойстве класса _filter. 
 *                         Вызывается в createUrl() и parseUrl(). 
 * 
 * @_getRuleObject EUrlRule - возвращает объект класса обработчика правил. 
 *                            Вызывается в createUrl() и parseUrl(). 
 * 
 *                                  
 */

Yii::import('application.components.urlrules.EUrlRule'); 

class UrlRules extends CBaseUrlRule
{

    protected $_activeRuleClass = 'EUrlRuleSections';
    protected $_filterRuleClass = 'EUrlRuleFilter';
    protected $_filter;
    
    protected function _initRuleFilter()
    {
        Yii::import('application.components.urlrules.'.$this->_filterRuleClass);
        $this->_filter = new $this->_filterRuleClass;
    }
    
    protected function _getRuleObject()
    {               
        Yii::import('application.components.urlrules.'.$this->_activeRuleClass);
        return new $this->_activeRuleClass;
    }
    
    public function createUrl($manager, $route, $params, $ampersand)
    {
        $this->_initRuleFilter();
        return $this->_getRuleObject()->createUrl($manager, $route, $params, $ampersand);
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {     
        $this->_initRuleFilter();       
        return $this->_getRuleObject()->parseUrl($manager, $request, $pathInfo, $rawPathInfo);
    }

}


