<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'EKar',   
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.inits.*',
        'application.components.system.*',
        'zii.widgets.CMenu',
        'application.widgets.menu.*',
        'application.widgets.system.*',
        'application.components.menumanager.*',
        
        /// test
        'application.menumanager.*',
        
    ),
    'language'=>'ru',
    'theme' => 'develop',
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'admin',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
   
        'menuManager' => array('class'=> 'MenuManager') ,
        
        'cache'=>array(
            'class'=>'system.caching.CApcCache'
            ),
        
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array( 
               'menu/create/<type>'=>'menu/create',
               'menu/<_a>/<id:\d+>'=>'menu/<_a>',
               'menu/<_a>'=>'menu/<_a>',
               
                array(
                    'class' => 'application.components.urlrules.UrlRules'                    
                ),
                
                /*
                '<lang>/admin/<_c>/<_a>/<id:\d+>'=>'admin/<_c>/<_a>',
                '<lang>/admin/<_c>/<_a>'=>'admin/<_c>/<_a>',
               */
                
                '' => 'site/index'
               
            ),
        ),
        
       
        
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
          // uncomment the following to use a MySQL database
         */
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ekar',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling'=>true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
       
              array(
              'class'=>'CWebLogRoute',
              ),
            
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);