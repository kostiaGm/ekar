<?php

/*
 * class EUrlRuleSections
 * 
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 */

class EUrlRuleSections extends EUrlRule
{

    public function createUrl($manager, $route, $params, $ampersand)
    {
        return $route;
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {       
        $urlInfo = $this->_filter->getUrlInfo();
        
        return $pathInfo;
    }

}

