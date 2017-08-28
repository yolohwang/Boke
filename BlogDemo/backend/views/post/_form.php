<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use common\models\Adminuser;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    
    <?php 
        /* AR的find方法
        $psObjs = Poststatus::find()->all();
        $allStatus = ArrayHelper::map($psObjs,'id','name');
        */

        /*command 对象方法
        $psArray = Yii::$app->db->createCommand("select id,name from poststatus")->queryAll();
        $allStatus = ArrayHelper::map($psArray,'id','name');
        */

        /*查询构建器 queryBuilder
        $allStatus = (new \yii\db\Query())
        ->select(['name','id'])
        ->from('poststatus')
        ->indexBy('id')
        ->column();
        */

        /*AR 是继承的Query 也可以用下面的方式*/  
        $allStatus = Poststatus::find()
        ->select(['name','id'])
        ->orderBy('position')//数据库里用来排序
        ->indexBy('id')
        ->column();
        // print_r($allStatus);

    ?>
    <?= $form->field($model, 'status')->dropDownList($allStatus,['prompt'=>'请选择状态']); ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList(
            Adminuser::find()
            ->select(['nickname','id'])
            ->indexBy('id')
            ->column(),
            ['prompt'=>'请选择作者']
            )
     ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
