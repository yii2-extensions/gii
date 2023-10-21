<?php

declare(strict_types=1);

/**
 * @var array $params
 */
$gii = [];

if (isset($params['yii.gii']) && $params['yii.gii'] === true) {
    $gii = [
        // configuration adjustments for 'dev' environment
        'modules' => [
            'gii' => [
                'class' => \yii\gii\Module::class,
                'allowedIPs' => $params['yii.gii.allowedIPs'] ?? ['127.0.0.1', '::1'],
            ],
        ],
    ];
}

return $gii;
