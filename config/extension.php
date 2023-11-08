<?php

declare(strict_types=1);

/**
 * @var array $params
 */
$gii = [];

if (isset($params['yii2.gii']) && $params['yii2.gii'] === true) {
    $gii = [
        // configuration adjustments for 'dev' environment
        'bootstrap' => ['gii'],
        'modules' => [
            'gii' => [
                'class' => $params['yii2.gii.classMap'] ?? \yii\gii\Module::class,
                'allowedIPs' => $params['yii2.gii.allowedIPs'] ?? ['127.0.0.1', '::1'],
            ],
        ],
    ];
}

return $gii;
