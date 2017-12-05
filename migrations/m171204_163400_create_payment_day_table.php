<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment_day`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m171204_163400_create_payment_day_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('payment_day', [
            'id' => $this->primaryKey(),
            'administrator_id' => $this->integer(),
            'begin_saldo' => $this->double(),
            'end_saldo' => $this->double(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `administrator_id`
        $this->createIndex(
            'idx-payment_day-administrator_id',
            'payment_day',
            'administrator_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-payment_day-administrator_id',
            'payment_day',
            'administrator_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-payment_day-administrator_id',
            'payment_day'
        );

        // drops index for column `administrator_id`
        $this->dropIndex(
            'idx-payment_day-administrator_id',
            'payment_day'
        );

        $this->dropTable('payment_day');
    }
}
