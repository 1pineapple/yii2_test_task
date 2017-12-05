<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_day".
 *
 * @property integer $id
 * @property string $payment_day
 * @property integer $administrator_id
 * @property double $begin_saldo
 * @property double $end_saldo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $administrator
 * @property PaymentSum[] $paymentSums
 */
class PaymentDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['administrator_id'], 'integer'],
            [['begin_saldo', 'end_saldo'], 'number'],
            [['administrator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['administrator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'administrator_id' => 'Администратор',
            'begin_saldo' => 'Сумма на начало',
            'turnover'=>'Оборот',
            'end_saldo' => 'Сумма на конец',
            'created_at' => 'Дата',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrator()
    {
        return User::findOne(['id'=>$this->administrator_id])->getUsername();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSums()
    {
        return $this->hasMany(PaymentSum::className(), ['payment_day_id' => 'id']);
    }
    public function getData(){
       return PaymentDay::find();
    }
}
