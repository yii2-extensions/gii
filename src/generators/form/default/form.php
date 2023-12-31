<?php

declare(strict_types=1);

/**
 * This is the template for generating an action view file.
 */

/** @var yii\web\View $this */
/** @var yii\gii\generators\form\Generator $generator */

$class = str_replace('/', '-', trim((string) $generator->viewName, '_'));

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\gii\components\ActiveForm;

/** @var yii\web\View $this */
/** @var <?= ltrim((string) $generator->modelClass, '\\') ?> $model */
/** @var ActiveForm $form */
<?= "?>" ?>

<div class="<?= $class ?>">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

    <?php foreach ($generator->getModelAttributes() as $attribute): ?>
    <?= "<?= " ?>$form->field($model, '<?= $attribute ?>') ?>
    <?php endforeach; ?>

        <div class="form-group">
            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Submit') ?>, ['class' => 'btn btn-primary']) ?>
        </div>
    <?= "<?php " ?>ActiveForm::end(); ?>

</div><!-- <?= $class ?> -->
