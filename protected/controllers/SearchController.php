<?php

class SearchController extends Controller
{

    public function actionIndex($page='',$word = '')
    {
        if (!empty($word)) {
            $model = new Search();
           
          
            $this->render('index', array(
                'pageDataProvider'=>$model->search($page, $word),
                'pagination' => array( 'pageSize' => 2, 'currentpage' => $page - 1),
                
                    ));
        }

        return false;
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