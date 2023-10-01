<?php

declare(strict_types=1);

namespace yiiunit\gii;

use Yii;
use yii\gii\Module;

class ModuleTest extends TestCase
{
    public function testDefaultVersion()
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
     * @param string $userIp
     * @param bool $expectedResult
     *
     * @throws \ReflectionException
     */
    public function testCheckAccess(array $allowedIPs, $userIp, $expectedResult)
    {
        $module = new Module('gii');
        $module->allowedIPs = $allowedIPs;
        $this->mockWebApplication();
        $_SERVER['REMOTE_ADDR'] = $userIp;
        $this->assertEquals($expectedResult, $this->invoke($module, 'checkAccess'));
    }
}
