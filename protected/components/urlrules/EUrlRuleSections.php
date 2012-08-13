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
    

    protected function _testUrl(array $url, CModel $urlModel = null)
    {
        if ($urlModel === null) {
            $urlModel = Urls::model();
        }
        $sql = "SELECT `id`, `parentId` FROM `urls` WHERE `url` IN('" . implode("','", $url) . "') ORDER BY `id` DESC";
        $row = $urlModel->findAllBySql($sql);
        $retValue = false;
        $rowLength = count($row);

        if ($rowLength < count($url)) {
            return false;
        }

        if (!empty($row)) {

            for ($i = 0; $i < count($row); $i++) {

                if (isset($row[$i + 1])) {
                    // if ($row[$i] == $row[$i+1]->parentId)

                    echo $row[$i]->id . ' == ';
                    echo $row[$i]->parentId . '<br>';
                    //  echo $row[$i]->id +'=='+ $row[$i+1]->parentId +'<br>';
                }
            }
        }
        die;
    }

    public function createUrl($manager, $route, $params, $ampersand)
    {   
        if (!$this->_isTest($route)) {
            return $route;
        }
       
        if (($key = $this->_filter->createUrlIsSetParams($params)) !== false) {
  
            $route = preg_replace('/^\/+/', '', Yii::app()->request->url);

            if (preg_match('/page\/\d+/', $route)) {
                return preg_replace('/page\/\d+/', 'page/' . $params[$key], $route);
            }
            
            return $route . '/page/' . $params[$key];
        } 
      
        return $route;
    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        if (!$this->_isTest($pathInfo)) {
            return $pathInfo;
        }
        
        $urlInfo = $this->_filter->getUrlInfo();
        $_GET = $urlInfo['params'];
     
        // var_dump($_GET); 
        if (isset($urlInfo['url'][0]) && !empty($urlInfo['url'][0])) {
            //$this->_testUrl($urlInfo['url'], $this->getUrlModel());

            $data = $this->_getUrl(end($urlInfo['url']));
           
            if (!empty($data)) {
                $rule = '';

                if (Yii::app()->defaultController != $data->module) {
                    $rule .= $data->module;
                }

                if (empty($data->controller)) {
                    $data->controller = 'site';
                }

                if (empty($data->action)) {
                    $data->action = 'index';
                }

                $rule .= (!empty($rule) ? '/' : '') . $data->controller . '/' . $data->action;

                if (isset($urlInfo['params']['page'])) {
                    $rule .= '/page/' . $urlInfo['params']['page'];
                }

                $_GET['recordId'] = $data->recordId;

                return $rule;
            } else {  
                    
                return $urlInfo['url'][0];
            }
        }
     
        return $pathInfo;
    }

}

