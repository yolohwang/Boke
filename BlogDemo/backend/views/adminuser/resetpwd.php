<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '密码重置';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="adminuser-resetpwd">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

  



    <div class="form-group">
        <?= Html::submitButton('重置' , ['class' =>  'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
