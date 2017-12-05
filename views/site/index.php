<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Yii Application';
?>
<div class="payment-day-index">

    <p>
        <?= Html::a('Добавить дневную кассу', ['/payment-day/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Клиенты', ['/client'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'created_at',


            [
                'attribute' => 'administrator_id',
                'value' => 'administrator',
            ],
            'begin_saldo',
            'turnover',
            'end_saldo',
        ],
    ]); ?>
</div>
