<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $name
 * @property string $href
 * @property string $preview
 * @property string $body
 * @property string $date
 * @property string $visibility
 * @property string $title
 * @property string $header
 * @property string $keywords
 * @property string $description
 * @property string $language
 * @property string $pic
 * @property string $top
 */
class News extends CActiveRecord
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
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pic, top', 'required'),
            array('name, href, title, header, keywords, description', 'length', 'max' => 1000),
            array('date', 'length', 'max' => 32),
            array('visibility', 'length', 'max' => 1),
            array('language', 'length', 'max' => 2),
            array('pic', 'length', 'max' => 255),
            array('preview, body', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, href, preview, body, date, visibility, title, header, keywords, description, language, pic, top', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'href' => 'Href',
            'preview' => 'Preview',
            'body' => 'Body',
            'date' => 'Date',
            'visibility' => 'Visibility',
            'title' => 'Title',
            'header' => 'Header',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'language' => 'Language',
            'pic' => 'Pic',
            'top' => 'Top',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('href', $this->href, true);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('visibility', $this->visibility, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('pic', $this->pic, true);
        $criteria->compare('top', $this->top, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}