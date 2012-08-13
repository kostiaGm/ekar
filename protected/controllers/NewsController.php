<?php

class NewsController extends Controller
{

    public function actionDetail($lang = '', $recordId = '')
    {        
        $data = News::model()->findByPk($recordId);
        $this->pageTitle = $data->title;
        //  print Yii::app()->pageMenuData->getSubUrl($data->id);
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');
        $this->render('detail', array('model' => $data));
    }

    public function actionIndex($lang = '', $recordId = '', $page = '')
    {
        $data = Page::model()->find('name=:name', array(':name'=>'НОВОСТИ'));
        // print Yii::app()->pageMenuData->getSubUrl($data->id);

        $this->pageTitle = $data->title;
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');

        $dataProvider = new CActiveDataProvider('News', array(
                    'criteria' => array('order' => 'date'),
                    'pagination' => array('pageSize' => 2, 'currentpage' => $page - 1)
                        //  'pagination' => $ePagination
                ));




        $this->render('list', array(
            'header' => $data->header,
            'dataProvider' => $dataProvider
        ));
       
    }

    public function actionList($lang = '', $recordId = '', $page = '')
    {
       /*   $pages = News::model()->findAll();
          $lastInsertId = 0;
          foreach ($pages as $page) {

          $urls = new Urls();
          $urls->parentId = 0;
          $urls->recordId = $page->id;
          $urls->url = $page->href;
          $urls->module = 'site';
          $urls->controller = 'news';
          $urls->action = 'detail';
          $urls->tableName = 'news';
          $urls->save();

          $lastInsertId = intval($urls->id);
          }*/ 


        if (empty($recordId)) {
            $recordId = 0;
        }
        $this->breadcrumbs = Yii::app()->menuManager->getBreadcrumbs($recordId, 'news');

        $data = News::model()->findByPk($recordId);
        // print Yii::app()->pageMenuData->getSubUrl($data->id);

        $this->pageTitle = $data->title;
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');

        $dataProvider = new CActiveDataProvider('News', array(
                    'criteria' => array('order' => 'date'),
                    'pagination' => array('pageSize' => 2, 'currentpage' => $page - 1)
                        //  'pagination' => $ePagination
                ));




        $this->render('list', array(
            'header' => $data->header,
            'dataProvider' => $dataProvider
        ));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}