<?php

class DefaultController extends EController
{    

    public function actionIndex()
    {       
        $this->render('index');
    }

}