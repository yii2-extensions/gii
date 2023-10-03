<?php

declare(strict_types=1);

/**
 * @var yii\gii\components\ActiveForm $form
 * @var yii\gii\generators\crud\Generator $generator
 * @var yii\web\View $this
 */

echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'searchModelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'indexWidgetType')->dropDownList(
    [
        'grid' => 'GridView',
        'list' => 'ListView',
    ]
);
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'enablePjax')->checkbox();
echo $form->field($generator, 'messageCategory');
