<?php

declare (strict_types = 1);

/**
 * @var bool $hasError
 * @var string $results
 * @var yii\gii\Generator $generator
 * @var yii\web\View $this
 */
?>
<div class="default-view-results">
    <?php
    if ($hasError) {
        echo '<div class="alert alert-danger">There was something wrong when generating the code. Please check the following messages.</div>';
    } else {
        echo '<div class="alert alert-success">' . $generator->successMessage() . '</div>';
    }
    ?>
    <pre><?= nl2br($results) ?></pre>
</div>
