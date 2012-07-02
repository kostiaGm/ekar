<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ParseUrl
{
    public $multiLang = true;
    public $url = null;
    public $rootId = 0; //id корневой страницы, сейчас 0, но должно быть 1
    public $maxNestingLevel = 20;
    public function returnPageArray(){ 
        $this->url = Yii::app()->getRequest()->getUrl();
        $this->url = explode('/', $this->url);
        if (end($this->url) == null) {
            array_pop($this->url);
        }
        $connection=Yii::app()->db;
        $command=$connection->createCommand("SELECT `url`, `parentId`, `recordId`, `controller` FROM `urls` WHERE `url`='".end($this->url)."'");
        $data=$command->queryRow();
        if ($data['parentId'] == $this->rootId){
            return $data;
        } else {
            $realUrl = $this->checkAttachments($data['parentId'], $data['controller']);
            if ( '/'.Yii::app()->language.'/'.$realUrl.end($this->url) == implode('/', $this->url)){
                return $data;
            } else { 
                return false;
            }
            echo '/'.Yii::app()->language.'/'.$realUrl.end($this->url); die;
        }

    }
    private function checkAttachments($pId, $controller){
        $currentNestingLevel = 0;
        $connection=Yii::app()->db;
        while ($pId != $this->rootId) {
            $currentNestingLevel++;
            if ($currentNestingLevel >= $this->maxNestingLevel) {
                return false;
            }
            $command=$connection->createCommand("SELECT `url`, `parentId`, `recordId`, `id` 
                    FROM `urls` 
                    WHERE (`id`='$pId' AND `controller`='$controller')");
            
            $data=$command->queryRow();
            
            $pId = $data['parentId'];
            $correctUrl = $data['url'].'/'.$correctUrl;
        }
        //echo $currentNestingLevel;
        return $correctUrl;
    }
}