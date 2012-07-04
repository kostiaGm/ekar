<?php

class EUrlRuleFilter extends EUrlRule
{

    public function __construct() 
    {
        
    }
    public function createUrl($manager, $route, $params, $ampersand)
    {
        return $route;
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        return $pathInfo;
    }

}

