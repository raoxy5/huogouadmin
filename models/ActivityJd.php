<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_jd".
 *
 * @property integer $id
 * @property integer $money
 * @property integer $user_id
 * @property integer $up_time
 * @property integer $lastlottery_id
 */
class ActivityJd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_jd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'user_id', 'up_time', 'lastlottery_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'money' => 'Money',
            'user_id' => 'User ID',
            'up_time' => 'Up Time',
            'lastlottery_id' => 'Lastlottery ID',
        ];
    }
}
