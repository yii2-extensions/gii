<?php

declare(strict_types=1);

namespace yiiunit\gii;

use Yii;
use yii\db\Exception;
use yii\helpers\FileHelper;

/**
 * GiiTestCase is the base class for all gii related test cases
 *
 * @group gii
 */
class GiiTestCase extends TestCase
{
    protected string $driverName = 'sqlite';

    /**
     * @throws Exception|yii\base\Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        FileHelper::createDirectory(__DIR__ . '/runtime');

        $allConfigs = require(__DIR__ . '/data/config.php');
        $config = $allConfigs['databases'][$this->driverName];
        $pdo_database = 'pdo_' . $this->driverName;

        if (!extension_loaded('pdo') || !extension_loaded($pdo_database)) {
            $this->markTestSkipped('pdo and ' . $pdo_database . ' extension are required.');
        }

        $this->mockApplication([
            'components' => [
                'db' => [
                    'class' => $config['class'] ?? 'yii\db\Connection',
                    'dsn' => $config['dsn'],
                    'username' => $config['username'] ?? null,
                    'password' => $config['password'] ?? null,
                ],
            ],
        ]);

        if (isset($config['fixture'])) {
            Yii::$app->db->open();
            $lines = explode(';', file_get_contents($config['fixture']));

            foreach ($lines as $line) {
                if (trim($line) !== '') {
                    Yii::$app->db->pdo->exec($line);
                }
            }
        }
    }
}
