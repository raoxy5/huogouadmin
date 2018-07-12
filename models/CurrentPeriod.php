<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "current_periods".
 *
 * @property string $id
 * @property integer $product_id
 * @property integer $table_id
 * @property string $period_number
 * @property integer $price
 * @property integer $limit_num
 * @property integer $sales_num
 * @property integer $progress
 * @property integer $left_num
 * @property string $start_time
 */
class CurrentPeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'current_periods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'table_id', 'period_number', 'price', 'limit_num', 'sales_num', 'progress', 'left_num'], 'integer'],
            [['table_id', 'start_time'], 'required'],
            [['start_time'], 'string', 'max' => 16],
            [['product_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }
}
