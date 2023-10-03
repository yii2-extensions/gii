<?php

declare (strict_types = 1);

use yii\gii\CodeFile;
use yii\gii\components\ActiveForm;
use yii\gii\Generator;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var array|null $answers
 * @var bool $hasError
 * @var CodeFile[]|null $files
 * @var Generator $generator
 * @var string $id panel ID
 * @var string|null $results
 * @var View $this
 */

$this->title = $generator->getName();
$templates = [];

foreach ($generator->templates as $name => $path) {
    $templates[$name] = "$name ($path)";
}
?>
<div class="default-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $generator->getDescription() ?></p>

    <?php $form = ActiveForm::begin([
        'id' => "$id-generator",
        'successCssClass' => 'is-valid',
        'errorCssClass' => 'is-invalid',
        'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_INPUT,
        'fieldConfig' => [
            'hintOptions' => ['tag' => 'small', 'class' => 'form-text text-muted'],
            'errorOptions' => ['class' => 'invalid-feedback']
        ],
    ]); ?>
        <div class="row">
            <div class="col-lg-8 col-md-10" id="form-fields">
                <?= $this->renderFile($generator->formView(), [
                    'generator' => $generator,
                    'form' => $form,
                ]) ?>
                <?= $form->field($generator, 'template')
                    ->sticky()
                    ->hint('Please select which set of the templates should be used to generated the code.')
                    ->label('Code Template')
                    ->dropDownList($templates) ?>
                <div class="form-group">
                    <?= Html::submitButton('Preview', ['name' => 'preview', 'class' => 'btn btn-primary']) ?>

                    <?php if (isset($files)): ?>
                        <?= Html::submitButton('Generate', ['name' => 'generate', 'class' => 'btn btn-success']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php
        if (isset($results)) {
            echo $this->render('view/results', [
                'generator' => $generator,
                'results' => $results,
                'hasError' => $hasError,
            ]);
        } elseif (isset($files)) {
            echo $this->render('view/files', [
                'id' => $id,
                'generator' => $generator,
                'files' => $files,
                'answers' => $answers,
            ]);
        }
        ?>
    <?php ActiveForm::end(); ?>
</div>
