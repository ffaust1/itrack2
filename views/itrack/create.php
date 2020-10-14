<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Создать';
$this->params['breadcrumbs'][] = $this->title;
$sess = Yii::$app->session;

if ($sess->hasFlash('mess')) {
    echo '<div class="alert alert-warning" role="alert">';
    echo $sess->getFlash('mess');
    echo '</div>';
}

$form = ActiveForm::begin([
    'id' => 'comment',
    'method' => 'POST',
]);

echo $form->field($contact, 'email')->input('email');
echo $form->field($comment, 'text')->textarea(['rows' => 10]);

echo '<div class="form-group">';
echo Html::submitButton('Отправить', ['class' => 'btn btn-success']);
echo '</div>';

ActiveForm::end();

