<?php

namespace kriss\adminlte\widgets;

use Yii;
use yii\base\Widget;
use yii\bootstrap4\Alert;

class FlashMessageAlert extends Widget
{
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $key => $message) {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-' . $key,
                ],
                'body' => $message,
            ]);
        }
    }
}
