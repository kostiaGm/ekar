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
        
        $data = Urls::model()->find('url=:url', array(':url'=>'index'));
     
        $this->pageTitle =  $data->menu->title;
        Yii::app()->clientScript->registerMetaTag($data->menu->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->menu->description, 'description');
        $this->render('index', array('data'=>$data));
    }

    public function actionList($lang = '', $recordId = '', $page = '')
    {
        $route = '';
        if (!empty($page)) {
            $route = Yii::app()->request->url;
        }
        if (empty($recordId)) {
            $recordId = 0;
        }
        
        $data = Page::model()->findByPk($recordId);
       
        $this->pageTitle =  $data->title;
        Yii::app()->clientScript->registerMetaTag($data->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($data->description, 'description');
        
        $dataProvider = new CActiveDataProvider('Page', array(
                    'criteria' => array('condition' => "level=$recordId"),
                    'pagination' => array('pageSize' => 2, 'currentpage' => $page - 1)
                ));



        $this->render('list', array(
            'dataProvider' => $dataProvider
        ));
    }

    public function actionDetail($lang = '', $recordId = '')
    {       
        $data = Page::model()->findByPk($recordId);
        $this->pageTitle = $data->title;
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
    public function actionContact($lang = '')
    {
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

        $this->render('contact', array('model' => $model));
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