<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $href
 * @property string $type
 * @property string $menu
 * @property integer $position
 * @property string $preview
 * @property string $body
 * @property string $level
 * @property string $visibility
 * @property string $top
 * @property string $header
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $language
 * @property string $pic
 * @property string $hpic
 * @property string $tube
 * @property string $date
 */
class Page extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public $url;

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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('pic, hpic, tube, date', 'required'),
            array('position', 'numerical', 'integerOnly' => true),
            array('position', 'numerical', 'integerOnly' => true),
            array('href,  header, title, keywords, description, pic, hpic', 'length', 'max' => 255),
            array('type', 'length', 'max' => 7),
            array('menu', 'length', 'max' => 10),
            array('level, date', 'length', 'max' => 20),
            array('visibility, top', 'length', 'max' => 1),
            array('language', 'length', 'max' => 2),
            array('preview, body', 'safe'),
            //array('preview, body', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, href, type, menu, position, preview, body, level, visibility, top, header, title, keywords, description, language, pic, hpic, tube, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'urls' => array(self::HAS_ONE, 'Urls', array('recordId'=>'id'))
     
        );
    }
    
    

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'url' => 'Url',
            'href' => 'Href',
            'type' => 'Type',
            'menu' => 'Menu',
            'position' => 'Position',
            'preview' => 'Preview',
            'body' => 'Body',
            'level' => 'Level',
            'visibility' => 'Visibility',
            'top' => 'Top',
            'header' => 'Header',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'language' => 'Language',
            'pic' => 'Pic',
            'hpic' => 'Hpic',
            'tube' => 'Tube',
            'date' => 'Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('href', $this->href, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('menu', $this->menu, true);
        $criteria->compare('position', $this->position);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('visibility', $this->visibility, true);
        $criteria->compare('top', $this->top, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('pic', $this->pic, true);
        $criteria->compare('hpic', $this->hpic, true);
        $criteria->compare('tube', $this->tube, true);
        $criteria->compare('date', $this->date, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    public function search2($page='') {
        $criteria = new CDbCriteria;
        $criteria->with = array('news');

        $criteria->compare('id', $this->id, true);
        $criteria->compare('href', $this->href, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('menu', $this->menu, true);
        $criteria->compare('position', $this->position);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('visibility', $this->visibility, true);
        $criteria->compare('top', $this->top, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('pic', $this->pic, true);
        $criteria->compare('hpic', $this->hpic, true);
        $criteria->compare('tube', $this->tube, true);
        $criteria->compare('date', $this->date, true);
        if (empty($page)) {
            $page = 1;
        }
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
             'pagination' => array('pageSize' => 2, 'currentpage' => $page - 1)
                ));
    }

    protected function afterSave()
    {
        parent::afterSave();
        /*  parent::afterSave();

          $urls =Urls::model()->find('recordId=:recordId', array(':recordId'=>$this->id));

          $urls->url = $this->urls->url;
          $urls->save(); */
    }

   

}