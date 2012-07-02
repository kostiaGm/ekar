<?php

class EActiveForm extends CActiveForm
{

    public function show($model)
    {    
        $this->render('_form', array('model' => $model));
    }
     

}

