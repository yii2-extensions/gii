<?php

declare(strict_types=1);

namespace yiiunit\gii;

use ReflectionException;
use Yii;
use yii\gii\Module;

class ModuleTest extends TestCase
{
    public function testDefaultVersion(): void
    {
        $this->mockApplication();

        Yii::$app->extensions['yiisoft/yii2-gii'] = [
            'name' => 'yiisoft/yii2-gii',
            'version' => '2.0.6',
        ];

        $module = new Module('gii');

        $this->assertEquals('2.2', $module->getVersion());
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::checkAccess
     *
     * @throws ReflectionException
     */
    public function testCheckAccess(array $allowedIPs, string $userIp, bool $expectedResult): void
    {
        $module = new Module('gii');
        $module->allowedIPs = $allowedIPs;

        $this->mockWebApplication();

        $_SERVER['REMOTE_ADDR'] = $userIp;

        $this->assertEquals($expectedResult, $this->invoke($module, 'checkAccess'));
    }
}
