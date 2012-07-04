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
    public abstract function createUrl($manager, $route, $params, $ampersand);
    
    public abstract function parseUrl($manager, $request, $pathInfo, $rawPathInfo);
}


