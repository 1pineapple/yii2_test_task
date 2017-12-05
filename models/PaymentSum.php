<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_sum".
 *
 * @property integer $id
 * @property integer $payment_day_id
 * @property integer $client_id
 * @property double $payment_sum
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Client $client
 * @property PaymentDay $paymentDay
 */
class PaymentSum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_sum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_day_id', 'client_id'], 'integer'],
            [['payment_sum'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['payment_day_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentDay::className(), 'targetAttribute' => ['payment_day_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_day_id' => 'Payment Day ID',
            'client_id' => 'Client ID',
            'payment_sum' => 'Payment Sum',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentDay()
    {
        return $this->hasOne(PaymentDay::className(), ['id' => 'payment_day_id']);
    }
}
