<?php

class PageUrlRule extends CBaseUrlRule
{
    public $parseType = 'single';
   
    public function createUrl($manager, $route, $params, $ampersand)
    {       
        return $route;
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        return $request;
    }

}