<?php

declare (strict_types = 1);

/**
 * This is the template for generating an action view file.
 */

/**
 * @var string $action the action ID
 * @var yii\gii\generators\controller\Generator $generator
 * @var yii\web\View $this
 */

echo "<?php\n";
?>
/** @var yii\web\View $this */
<?= "?>" ?>

<h1><?= $generator->getControllerSubPath() . $generator->getControllerID() . '/' . $action ?></h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= '<?=' ?> __FILE__; ?></code>.
</p>
