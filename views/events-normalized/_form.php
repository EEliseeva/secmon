<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventsNormalized */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-normalized-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datetime')->textInput() ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_vendor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_dev_prod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_dev_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_event_class_id')->textInput() ?>

    <?= $form->field($model, 'cef_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cef_severity')->textInput() ?>

    <?= $form->field($model, 'src_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dst_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'src_port')->textInput() ?>

    <?= $form->field($model, 'dst_port')->textInput() ?>

    <?= $form->field($model, 'protocol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'src_mac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dst_mac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_method')->textInput(['maxlength => true']) ?>

    <?= $form->field($model, 'request_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_client_application')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'destination_user_name')->textInput() ?>

    <?= $form->field($model, 'destination_user_id')->textInput() ?>

    <?= $form->field($model, 'destination_group_name')->textInput() ?>

    <?= $form->field($model, 'destination_group_id')->textInput() ?>

    <?= $form->field($model, 'device_process_id')->textInput() ?>

    <?= $form->field($model, 'source_user_privileges')->textInput() ?>

    <?= $form->field($model, 'exec_user')->textInput() ?>

    <?= $form->field($model, 'extensions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'raw')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
