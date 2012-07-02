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
        return $this->find('url=:url', array(':url'=>$url));
    }
}

