<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_virtual_hand".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $type
 * @property string $account
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 * @property integer $checked_at
 * @property integer $checked_admin
 */
class UserVirtualHand extends \yii\db\ActiveRecord
{
    const VIRTUAL_HAND_LIMIT = 'VIRTUAL_HAND_LIMIT_';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_virtual_hand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'status', 'created_at', 'checked_at', 'checked_admin'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['account', 'name'], 'string', 'max' => 64],
            [['order_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'type' => 'Type',
            'account' => 'Account',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'checked_at' => 'Checked At',
            'checked_admin' => 'Checked Admin',
        ];
    }
}
