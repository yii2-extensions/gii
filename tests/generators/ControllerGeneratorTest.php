<?php

declare(strict_types=1);

namespace yiiunit\gii\generators;

use Yii;
use yii\base\Exception;
use yii\gii\generators\controller\Generator as ControllerGenerator;
use yii\helpers\FileHelper;
use yiiunit\gii\GiiTestCase;

/**
 * ControllerGeneratorTest checks that Gii controller generator produces valid results
 *
 * @group gii
 */
class ControllerGeneratorTest extends GiiTestCase
{
    /**
     * @dataProvider \yiiunit\gii\providers\Data::controllerData
     *
     * @throws Exception
     */
    public function testSimpleWithNamespace($controllerClass, $expectedNames): void
    {
        FileHelper::createDirectory(Yii::getAlias('@app/runtime/controllers'));

        $generator = new ControllerGenerator();
        $generator->template = 'default';
        $generator->controllerClass = $controllerClass;
        $valid = $generator->validate();

        $this->assertTrue($valid, print_r($generator->getErrors(), true));

        $files = $generator->generate();
        $fileNames = array_map(
            static fn($f) => basename($f->path),
            $files,
        );

        sort($fileNames);

        $this->assertEquals($expectedNames, $fileNames);
    }
}
