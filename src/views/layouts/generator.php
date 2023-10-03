<?php

declare (strict_types = 1);

use Yii;
use yii\gii\controllers\DefaultController;
use yii\gii\Generator;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var string $content
 * @var View $this
 */

/** @phpstan-var DefaultController $controller */
$controller = Yii::$app->controller;
$generators = $controller->module->generators;
$activeGenerator = $controller->generator;
?>
<?php $this->beginContent('@yii/gii/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="list-group">
            <?php
            $classes = ['list-group-item', 'd-flex', 'justify-content-between', 'align-items-center'];
            foreach ($generators as $id => $generator) {
                $label = Html::tag('span', Html::encode($generator->getName())) . '<span class="icon"></span>';
                echo Html::a($label, ['default/view', 'id' => $id], [
                    'class' => $generator === $activeGenerator ? [...$classes, 'active'] : $classes,
                ]);
            }
            ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
