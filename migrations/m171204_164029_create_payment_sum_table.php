<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment_sum`.
 * Has foreign keys to the tables:
 *
 * - `payment_day`
 * - `client`
 */
class m171204_164029_create_payment_sum_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('payment_sum', [
            'id' => $this->primaryKey(),
            'payment_day_id' => $this->integer(),
            'client_id' => $this->integer(),
            'payment_sum' => $this->double(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `payment_day_id`
        $this->createIndex(
            'idx-payment_sum-payment_day_id',
            'payment_sum',
            'payment_day_id'
        );

        // add foreign key for table `payment_day`
        $this->addForeignKey(
            'fk-payment_sum-payment_day_id',
            'payment_sum',
            'payment_day_id',
            'payment_day',
            'id',
            'CASCADE'
        );

        // creates index for column `client_id`
        $this->createIndex(
            'idx-payment_sum-client_id',
            'payment_sum',
            'client_id'
        );

        // add foreign key for table `client`
        $this->addForeignKey(
            'fk-payment_sum-client_id',
            'payment_sum',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `payment_day`
        $this->dropForeignKey(
            'fk-payment_sum-payment_day_id',
            'payment_sum'
        );

        // drops index for column `payment_day_id`
        $this->dropIndex(
            'idx-payment_sum-payment_day_id',
            'payment_sum'
        );

        // drops foreign key for table `client`
        $this->dropForeignKey(
            'fk-payment_sum-client_id',
            'payment_sum'
        );

        // drops index for column `client_id`
        $this->dropIndex(
            'idx-payment_sum-client_id',
            'payment_sum'
        );

        $this->dropTable('payment_sum');
    }
}
