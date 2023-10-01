<?php

/**
 * @var yii\gii\generators\extension\Generator $generator
 */

"<?php\n"
?>

namespace <?= substr((string) $generator->namespace, 0, -1) ?>;

/**
 * This is just an example.
 */
class AutoloadExample extends \yii\base\Widget
{
    public function run()
    {
        return "Hello!";
    }
}
