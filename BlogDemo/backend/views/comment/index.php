<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Commentstatus;
// use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute'=>'id',
            'contentOptions'=>['width'=>'30px'],
            ],
            // 'content:ntext',
            ['attribute'=>'content',

            //方式1 get属性
            'value' => 'beginning',

            //方式2 匿名函数
            // 'value'=> function($model) 
            //     {   
            //         //strip_tags 去掉字符串里的HTML、XML、PHP标签
            //         $tmpStr = strip_tags($model->content);
            //         //获取字符串长度
            //         $tmpStrLen = mb_strlen($tmpStr);

            //         return mb_substr($tmpStr, 0,20,'utf-8').($tmpStrLen>20?'...':'');
            //     }
            ],

            // 'userid',
            ['attribute'=>'userName',
            'label'=>'作者',
            'value'=>'user.username',
            ],

            // 'status',
            ['attribute'=>'status',
            'value' => 'status0.name',
            'filter' => Commentstatus::find()
                        ->select(['name','id'])
                        ->orderBy('position')
                        ->indexBy('id')
                        ->column(),
            'contentOptions'=> function($model)
                {
                    return ($model->status ==1) ? ['class' => 'bg-danger']:[];
                }
            ],
            // 'create_time:datetime',
            ['attribute' => 'create_time',
            'format' => ['date','php: Y-m-d H:i:s'],
            ],
            
            // 'email:email',
            // 'url:url',
            'post.title',

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}{approve}',
            'buttons' => [
                    'approve'=>function($url,$model,$key)
                    {
                        $options=[
                            'title' => Yii::t('yii', '审核'),
                            'aria-label' => Yii::t('yii', '审核'),
                            'data-confirm' => Yii::t('yii', '你确定通过这条评论么？'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class = "glyphicon glyphicon-check"></span>',$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
