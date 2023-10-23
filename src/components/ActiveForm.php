<?php

declare(strict_types=1);

/**
 * @link https://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yii\gii\components;

/**
 * @author Wilmer Arambula <terabytesoftw@gmail.com>
 *
 * @since 2.2
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * @inheritDoc
     */
    public $fieldClass = ActiveField::class;

    /**
     * @inheritDoc
     *
     * @return ActiveField
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }
}
