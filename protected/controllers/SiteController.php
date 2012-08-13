<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($lang = '')
    {


        $pages = Page::model()->findAll();
        $lastInsertId = 0;
        /*  foreach ($pages as $page) {

          $urls = new Urls();
          $urls->id = $page->id;
          $urls->parentId = $page->level;
          $urls->recordId = $page->id;
          $urls->url = $page->href;
          $urls->module = 'site';
          $urls->controller = 'site';
          $urls->tableName = 'page';
          $urls->action = ($page->type != 'section' ? 'detail': 'list');
          $urls->save();

          $lastInsertId = intval($urls->id);
          } */

        $data = Page::model()->find('href=:url', array(':url' => 'mainpage'));

        $this->pageTitle = $data->title;
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');
        $this->render('index', array('data' => $data));
    }

    public function actionList($lang = '', $recordId = '', $page = '')
    {
        /* $route = '';
          if (!empty($page)) {
          $route = Yii::app()->request->url;
          } */
        if (empty($recordId)) {
            $recordId = 0;
        }


        $this->breadcrumbs = Yii::app()->menuManager->getBreadcrumbs($recordId);
        //  $this->breadcrumbs = Yii::app()->pageMenuData->getBreadcrumbs($recordId);
        $data = Page::model()->findByPk($recordId);
        // print Yii::app()->pageMenuData->getSubUrl($data->id);
          $this->pageTitle =  $data->title;
            Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
            Yii::app()->clientScript->registerMetaTag($data->description, 'description');
        
          $dataProvider = new CActiveDataProvider('Page', array(
          'criteria' => array('condition' => "level=$recordId"),
          'pagination' => array( 'pageSize' => 12, 'currentpage' => $page - 1),

          //  'pagination' => $ePagination
          ));

         

        //  $this->render('list');

        $this->render('list', array(
            'header' => $data->header,
            'dataProvider' => $dataProvider,
            'page' => (!empty($page) ? "/page/$page" : '')
        ));
    }

    public function actionDetail($lang = '', $recordId = '')
    {

        $this->breadcrumbs = Yii::app()->menuManager->getBreadcrumbs($recordId);


        $data = Page::model()->findByPk($recordId);

        $this->pageTitle = $data->title;
        //  print Yii::app()->pageMenuData->getSubUrl($data->id);
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');
        $this->render('detail', array('model' => $data));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact($lang = '', $recordId = '')
    {
        $this->breadcrumbs = Yii::app()->pageMenuData->getBreadcrumbs($recordId);
        $data = Page::model()->findByPk($recordId);
        $this->pageTitle = $data->title;
        //  print Yii::app()->pageMenuData->getSubUrl($data->id);
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');


        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }

        $this->render('contact', array('model' => $model, 'header' => $data->header, 'body' => $data->body));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid


            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}