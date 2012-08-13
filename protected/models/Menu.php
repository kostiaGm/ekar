<?php

/**
 * This is the model class for table "urls3".
 *
 * The followings are the available columns in table 'urls3':
 * @property string $id
 * @property integer $parentId
 * @property integer $recordId
 * @property string $url
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $model
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuManager the static model class
	 */
	public static function model($className=__CLASS__)
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, controller, action, model', 'required'),
			array('parentId, recordId', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>255),
			array('module, controller, action, model', 'length', 'max'=>65),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parentId, recordId, url, module, controller, action, model', 'safe', 'on'=>'search'),
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
                     'page' => array(self::HAS_ONE, 'Page', array('id'=>'recordId'), 'select'=>' header, name, menu, href'),
                     'news' => array(self::HAS_ONE, 'News', array('id'=>'recordId'), 'select'=>'id, header, name')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parentId' => 'Parent',
			'recordId' => 'Record',
			'url' => 'Url',
			'module' => 'Module',
			'controller' => 'Controller',
			'action' => 'Action',
			'model' => 'Model',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parentId',$this->parentId);
		$criteria->compare('recordId',$this->recordId);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}