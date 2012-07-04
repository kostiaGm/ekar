<?php

class EUrlRuleSections extends EUrlRule
{

    public function createUrl($manager, $route, $params, $ampersand)
    {
        return $route;
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        return $pathInfo;
    }

}

