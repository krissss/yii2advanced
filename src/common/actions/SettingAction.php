<?php

namespace common\actions;

use common\models\settings\BaseModel;
use yii\base\Model;
use yii2mod\settings\actions\SettingsAction;

/**
 * controller:
 * $actions['example'] = [
 *     'class' => SettingUserAction::class,
 *     // for Setting
 *     'modelClass' => SettingApp::class,
 *     // for UserSetting
 *     'modelClass' => function () {
 *         return ExampleUserSetting::getInstance();
 *     },
 *     'view' => 'example',
 *     'successMessage' => '修改成功',
 * ];
 *
 * view:
 * echo $form->field($model, 'key1');
 * echo $form->field($model, 'key_name2');
 */
class SettingAction extends SettingsAction
{
    /**
     * @inheritDoc
     */
    protected function getSection(Model $model): string
    {
        if ($model instanceof BaseModel) {
            return $model->getSectionName();
        }
        return parent::getSection($model);
    }

    /**
     * @inheritDoc
     */
    protected function prepareModel(Model $model)
    {
        if ($model instanceof BaseModel) {
            if (is_callable($this->prepareModel)) {
                call_user_func($this->prepareModel, $model);
            } else {
                foreach ($model->attributes() as $attribute) {
                    $model->{$attribute} = $model->getValue($attribute);
                }
            }
        }
        parent::prepareModel($model);
    }
}
