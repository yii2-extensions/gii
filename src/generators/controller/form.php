<?php

declare (strict_types = 1);

/**
 * @var yii\gii\generators\controller\Generator $generator
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 */

echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'actions');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'baseClass');
