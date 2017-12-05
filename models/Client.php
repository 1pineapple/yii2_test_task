<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $client_snp
 * @property string $client_phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PaymentSum[] $paymentSums
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_snp', 'client_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_snp' => 'ФИО',
            'client_phone' => 'Телефон',
            'created_at' => 'Создано',
            'updated_at' => 'Отредактировано',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSums()
    {
        return $this->hasMany(PaymentSum::className(), ['client_id' => 'id']);
    }
    public function create(){
        if ($this->validate()){
            $client =new Client();
            $client->client_snp=$this->client_snp;
            $client->client_phone=$this->client_phone;
            $client->created_at=new Expression('NOW()');
            return $client->save();
        }
    }
    public function getId()
    {
        return Client::findOne(['client_snp'=>$this->client_snp])->id;
    }
    public function updateClient()
    {
        if ($this->validate()){
            $client = Client::findOne(['id'=>$this->id]);
            $client->client_snp=$this->client_snp;
            $client->client_phone=$this->client_phone;
            $client->updated_at=new Expression('NOW()');
            return $client->save();
        }
    }
}
