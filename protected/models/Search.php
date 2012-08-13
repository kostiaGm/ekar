<?php

class Search extends CActiveRecord
{

    protected $_tables = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'page';
    }
   
    

  
    public function search($page = '', $word='')
    {
        
        if (empty($page)) {
            $page = 1;
        }
        
        $sql = "SELECT * FROM `page`  `p`, `news` `n` WHERE 
            (`p`.`title` LIKE '%$word%'  OR `n`.`title` LIKE '%$word%') OR
            (`p`.`preview` LIKE '%$word%'  OR `n`.`preview` LIKE '%$word%') OR
            (`p`.`body` LIKE '%$word%'  OR `n`.`body` LIKE '%$word%') 
        
        " ;
        
        return new CSqlDataProvider($sql, array(
                  //  'criteria' => $criteria,
             'pagination' => array('pageSize' => 2, 'currentpage' => $page - 1)
                ));
    }

}

