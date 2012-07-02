<fieldset>
    <?php
    $attributes = $model->attributeLabels();

    foreach ($model->tableSchema->columns as $obj):
        $fieldType = $obj->dbType;
        $fieldSize = '';

        if (strpos($fieldType, '(') !== false) {
            list($fieldType, $fieldSize) = explode('(', $fieldType);
            $fieldSize = str_replace(')', '', $fieldSize);
            $fieldSize = str_replace(array('"', "'"), '', $fieldSize);
            if ($fieldType == 'enum' || $fieldType == 'set') {
                $fieldSize = explode(',', $fieldSize);
            }
        }
        ?>
        <?php if (isset($attributes[$obj->name])): ?>
            <?php if ($fieldType == 'enum' || $fieldType == 'set'): ?>
               <dl>
                        <dt><?php echo $this->labelEx($model, $obj->name);?></dt>
                        <dd>
                            <?php foreach($fieldSize as $val):?>
                            
                                <?php echo $this->labelEx($model, $val);?>
                                <?php echo $fieldType == 'enum' ? $this->checkBox($model, $obj->name) : $this->radioButton($model, $obj->name); ?>
                            <?php endforeach; ?>
                             
                        </dd>
                    </dl>
            <?php endif; ?> 


            <?php if ($fieldType == 'varchar'): ?>
                <dl>
                    <dt> 
                    <?php
                    echo $this->labelEx($model, $obj->name);
                    echo $obj->dbType;
                    ?>
                    </dt>
                    <dd>
                        <img class="NFTextLeft" src="img/0.png">
                        <div class="NFTextCenter">
                            <?php echo $this->textField($model, $obj->name, array('class' => 'NFText', 'size' => '50')); ?>
                        </div>
                        <img class="NFTextRight" src="img/0.png">
                        <?php echo $this->error($model, $obj->name); ?>
                    </dd>
                </dl>
            <?php endif; ?> 


        <?php endif; ?>  
    <?php endforeach; ?>

</fieldset>