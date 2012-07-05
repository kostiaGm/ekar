<?php

/* class Urls
 * @author Anisimov Kostya kostiaGm@gmail.com
 * @version 1.1
 * @since   1.1
 * 
 * Модель для работы с url в базе данных.
 */

class Urls extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'urls';
    }

    public function findUrl($url)
    {
        return $this->find('url=:url', array(':url' => $url));
    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menu' => array(self::HAS_ONE, 'Page', array('id'=>'recordId'))
        );
    }

    public function initVMenu($parenId = 0, $url = '/')
    {
        $row = $this->findAll('parentId=:parenId', array(':parenId' => $parenId));
       // $row = $this->with('menu')->findBySql("SELECT `urls`.`id`, `urls`.`url`, `page`.`header` FROM `page`, `urls` WHERE `urls`.`parentId`='$parenId'");
        $retArray = array();
      
        if (!empty($row)) {
            foreach ($row as $res) {
               
                if (isset($res->menu)) {
                    $parentUrl = $res->menu->href.'/';
                    $header =  $res->menu->header;
                   
                    $items = $this->initVMenu($res->id, $parentUrl);
                    $retArray[] = array(
                        'label' => $header,
                        'url' => array($url. $res->url),
                        'items' => $items
                    );
                }
            }
        }

        return $retArray;
    }

}

