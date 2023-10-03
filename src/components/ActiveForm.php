<?php

declare(strict_types=1);

namespace yii\gii\components;

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
