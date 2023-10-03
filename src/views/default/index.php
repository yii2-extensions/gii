<?php

declare (strict_types = 1);

use yii\helpers\Html;
use yii\gii\controllers\DefaultController;

/**
 * @var string $content
 * @var \yii\gii\Generator[] $generators
 * @var \yii\web\View $this
 */
$this->title = 'Welcome to Gii';

/** @phpstan-var DefaultController $controller */
$controller = Yii::$app->controller;
$generators = $controller->module->generators;
?>
<div class="default-index">
    <h1 class="border-bottom pb-3 mb-3">Welcome to Gii <small class="text-muted">a magical tool that can write code for you</small></h1>

    <p class="lead mb-5">Start the fun with the following code generators:</p>

    <div class="row">
        <?php foreach ($generators as $id => $generator): ?>
        <div class="generator col-lg-4">
            <h3><?= Html::encode($generator->getName()) ?></h3>
            <p><?= $generator->getDescription() ?></p>
            <p><?= Html::a('Start &raquo;', ['default/view', 'id' => $id], ['class' => ['btn', 'btn-outline-secondary']]) ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <p><a class="btn btn-success" href="https://www.yiiframework.com/extensions/?tag=gii">Get More Generators</a></p>

</div>
