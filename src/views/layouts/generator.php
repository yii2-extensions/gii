<?php

declare (strict_types = 1);

use Yii;
use yii\helpers\Html;

/**
 * @var string $content
 * @var yii\gii\Generator $activeGenerator
 * @var yii\gii\Generator[] $generators
 * @var yii\web\View $this
 */

$generators = Yii::$app->controller->module->generators;
$activeGenerator = Yii::$app->controller->generator;
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
