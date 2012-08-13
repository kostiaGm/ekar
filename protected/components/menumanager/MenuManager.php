<?php

/**
 * Description of MenuManager
 *
 * @author Anisimov Kostya <kostiaGt@mail.ru>
 */
class MenuManager
{

    protected $_data = array();
    protected $_menu = array();
    protected $_pathArray = array();
    protected $_breadcrumbs = array();
    protected $_menuWidgetArray = array();
    protected $_relationsArray = array();
    protected $_cacheMenuId = 'EMenuManagerDbArray';

    public function init()
    {


        $dataCache = Yii::app()->cache->mget(array($this->_cacheMenuId));
       // $this->flush();

        if (isset($dataCache[$this->_cacheMenuId]) || !$dataCache[$this->_cacheMenuId]) {
            $model = Menu::model();
            $this->_relationsArray = array_keys($model->relations());
            //  print 12; die;
            // Делаем жадную загрузку.
            foreach ($this->_relationsArray as $relation) {
                $model->with($relation);
            }


            $data = $model->findAll();
            foreach ($data as $menu) {

                $this->_data[$menu->parentId][] = $menu;
            }

            $this->_initTree(0, 0);

            $cacheArray = array(
                'data' => $this->_data,
                'menu' => $this->_menu,
                'path' => $this->_pathArray,
                'menuWidget' => $this->_menuWidgetArray,
                'breadcrumbs' => $this->_breadcrumbs,
                'relationsArray' => $this->_relationsArray
            );

            Yii::app()->cache->add($this->_cacheMenuId, $cacheArray);
        } else {

            $this->_data = $dataCache[$this->_cacheMenuId]['data'];
            $this->_menu = $dataCache[$this->_cacheMenuId]['menu'];
            $this->_pathArray = $dataCache[$this->_cacheMenuId]['path'];
            $this->_menuWidgetArray = $dataCache[$this->_cacheMenuId]['menuWidget'];
            $this->_relationsArray = $dataCache[$this->_cacheMenuId]['relationsArray'];
            $this->_breadcrumbs = $dataCache[$this->_cacheMenuId]['breadcrumbs'];
        }
       // die;
    }

    public function flush()
    {
        Yii::app()->cache->flush();
    }

    public function getPath($id = null, $tableName = 'page')
    {
        if ($id == null) {
            return $this->_pathArray;
        }
        // var_dump($this->_pathArray); die;

        if (isset($this->_pathArray[$id][$tableName])) {
            return $this->_pathArray[$id][$tableName];
        }

        return null;
    }

    public function getMenu($label = null)
    {
        if ($label == null) {
            return $this->_menuWidgetArray;
        }

        if (isset($this->_menuWidgetArray[$label])) {
            return $this->_menuWidgetArray[$label];
        }

        return null;
    }

    public function getBreadcrumbs($id, $tableName = 'page')
    {

        if (isset($this->_breadcrumbs[$id][$tableName])) {
            $lastElement = end(array_keys($this->_breadcrumbs[$id][$tableName]));
            if (isset($this->_breadcrumbs[$id][$tableName][$lastElement])) {
                unset($this->_breadcrumbs[$id][$tableName][$lastElement]);
                array_push($this->_breadcrumbs[$id][$tableName], $lastElement);
            }
          //  var_dump($lastElement); die;
            return $this->_breadcrumbs[$id][$tableName];
        }

        return null;
    }

    protected function _initTree($parentId, $level)
    {
        if (isset($this->_data[$parentId])) {
            foreach ($this->_data[$parentId] as $value) {

                $this->_insertInArray($value);
                $this->_initPathArray($value);
                $this->_initMenuWidgetArray($value);
                $level++;
                //  print "pId: $parentId: id: $value->id \n";
                $this->_initTree($value->id, $level);
                $level--;
            }
        }
    }

    protected function _initMenuWidgetArray($data)
    {
        foreach ($this->_relationsArray as $relation) {
            if (isset($data->{$relation}->menu) && $data->{$relation}->menu == 'horisontal') {
                $url = '/' . $this->getPath($data->recordId);
                $url = preg_replace('/(\/){2,}/', '/', $url);
                $this->_menuWidgetArray[$data->tableName][] = array('label' => $data->{$relation}->name, 'url' => $url);
            }
        }
    }

    protected function _initPathArray($data)
    {
        $url = '';
        $isSetParentUrl = false;
        if (isset($this->_menu[$data->parentId])) {
            $url .= $this->_menu[$data->parentId] . '/';
            $isSetParentUrl = true;
        }


        $relation = $data->tableName;

        if (isset($this->_breadcrumbs[$data->parentId][$relation])) {

            $this->_breadcrumbs[$data->recordId][$relation] = array(
                $data->{$relation}->name => '/'. $url . $data->url
            );
            $this->_breadcrumbs[$data->recordId][$relation] = array_merge($this->_breadcrumbs[$data->parentId][$relation],  $this->_breadcrumbs[$data->recordId][$relation]);
        } else {
            $this->_breadcrumbs[$data->recordId][$relation][$data->{$relation}->name] = '/'. $url . $data->url;
        }




        $this->_pathArray[$data->recordId][$data->tableName] = $url . $data->url;
    }

    // Системный массив.

    protected function _insertInArray($data)
    {

        foreach ($this->_relationsArray as $relation) {
            if (isset($data->{$relation}->header)) {
                $this->_menu[$data->id] = $data->{$relation}->href;
            }
        }
    }

}

