<?php

declare(strict_types=1);

/**
 * @var yii\gii\components\ActiveForm $form
 * @var yii\gii\generators\form\Generator $generator
 * @var yii\web\View $this
 */

echo $form->field($generator, 'viewName');
echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'scenarioName');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
