<?php

declare (strict_types = 1);

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\gii\generators\crud\Generator $generator
 * @var yii\web\View $this
 */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();

if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\gii\components\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var <?= ltrim($generator->modelClass, '\\') ?> $model
 * @var yii\gii\components\ActiveForm $form
 */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
