<?php

class EUrlRuleFilter
{

    protected $_pathInfo;
    protected $_pathInfoArray = array(
        'formGet' => array(),
        'formUrl' => array(),
        'params' => array(),
        'url' => array()
    );
    protected $_filterFields = array(
        'page' => array('value' => '\d+', 'isGet' => false),
        'sss' => array('isGet' => false)
    );
    protected $_maxFiltersKeys = 30;

    public function __construct($pathInfo)
    {
        $this->_pathInfo = $pathInfo;
        $this->_pathInfo2Array();
        $this->_initParams();
    }

    protected function _pathInfo2Array()
    {
        $pathInfoArray = explode('/', $this->_pathInfo);
        $pathInfoTmpArray = array();
        $isFindFilterKey = false;

        for ($i = 0; $i < $this->_maxFiltersKeys; $i++) {

            if (isset($pathInfoArray[$i])) {
                $key = $pathInfoArray[$i];
                $value = (isset($pathInfoArray[$i + 1]) ? $pathInfoArray[$i + 1] : '');
                if (isset($this->_filterFields[$key]) &&
                        (!isset($this->_filterFields[$key]['isGet']) || !$this->_filterFields[$key]['isGet'])
                        &&
                        (!isset($this->_filterFields[$key]['value']) ||
                        (isset($this->_filterFields[$key]['value']) && preg_match("/^" . $this->_filterFields[$key]['value'] . "$/", $value))
                        )
                ) {
                    $this->_pathInfoArray['formUrl'][$key] = $value;
                    $isFindFilterKey = true;
                }
            }

            if (!$isFindFilterKey && isset($pathInfoArray[$i])) {
                $this->_pathInfoArray['url'][] = $pathInfoArray[$i];
            }
        }
    }

    protected function _initParams($array = array())
    {
        $getTmpArray = array();
        $pathInfo = '';

        if (empty($array)) {
            $array = $_GET;
        }

        if (!empty($array)) {
            $counter = 0;
            foreach ($array as $key => $value) {
                if (isset($this->_filterFields[$key]) &&
                        (isset($this->_filterFields[$key]['isGet']) && $this->_filterFields[$key]['isGet'])
                        &&
                        (!isset($this->_filterFields[$key]['value']) ||
                        (isset($this->_filterFields[$key]['value']) && preg_match("/^" . $this->_filterFields[$key]['value'] . "$/", $value))
                        )
                ) {
                    $this->_pathInfoArray['formGet'][$key] = $value;
                    $getTmpArray[$key] = $value;
                    $pathInfo .= (empty($pathInfo) ? '?' : '&') . "$key=$value";
                }
                if ($counter >= $this->_maxFiltersKeys) {
                    break;
                }
                $counter++;
            }
        }
        $this->_pathInfoArray['params'] = array_merge($this->_pathInfoArray['formUrl'], $this->_pathInfoArray['formGet']);
    }

    public function createUrlIsSetParams($params)
    {        
        $ret = '';
        if (!empty($params)) {
            $counter = 0;
            foreach ($params as $key => $value) {
                $key1 = substr($key, strpos($key,'_') + 1, strlen($key));     
                
                if (isset($this->_filterFields[$key1]) &&
                       /* (!isset($this->_filterFields[$key]['isGet']) || !$this->_filterFields[$key]['isGet'])
                        &&*/
                        (!isset($this->_filterFields[$key1]['value']) ||
                        (isset($this->_filterFields[$key1]['value']) && preg_match("/^" . $this->_filterFields[$key1]['value'] . "$/", $value))
                        )
                ) {
                        
                    return $key;
                }
                if ($counter >= $this->_maxFiltersKeys) {
                    break;
                }
                $counter++;
            }
        }
        
        return false;
    }

    public function getUrlInfo()
    {
        return $this->_pathInfoArray;
    }

}

