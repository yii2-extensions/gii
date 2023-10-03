<?php

declare(strict_types=1);

namespace yiiunit\gii\generators;

use yii\gii\generators\model\Generator;

/**
 * Just a mock for testing porpoises.
 *
 * @author Sidney Lins slinstj@gmail.com
 */
class ModelGeneratorMock extends Generator
{
    public function publicGenerateClassName($tableName, $useSchemaName = null): string
    {
        return $this->generateClassName($tableName, $useSchemaName);
    }
}
