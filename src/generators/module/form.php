<?php

declare(strict_types=1);

/**
 * @var yii\gii\components\ActiveForm $form
 * @var yii\gii\generators\module\Generator $generator
 * @var yii\web\View $this
 */
?>
<div class="module-form">
<?php
    echo $form->field($generator, 'moduleClass');
    echo $form->field($generator, 'moduleID');
?>
</div>
