<?php
/**
 * Created by PhpStorm.
 * User: Joan
 * Date: 2016/7/13
 * Time: 12:44
 */

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "send_messages".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property integer $create_time
 * @property integer $admin_id
 * @property integer $type
 * @property integer $view
 */
class SendMessage extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'send_messages';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'content', 'create_time', 'admin_id', 'type'], 'required'],
			[['user_id', 'type', 'view', 'admin_id', 'create_time'], 'integer']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => '编号',
			'user_id' => '用户ID',
			'content' => '发货消息内容',
			'type' => '消息类型',
			'view' => '是否查看',
			'admin_id' => '发货人',
			'create_time' => '发货时间',
		];
	}
	
	/**
	 * 获得被推送发货消息的用户id
	 * @phone 收货人手机号
	 * @uid 当前用户id
	 */
	public static function getDeliverUid($phone, $uid)
	{
		$info = User::findOne($uid);
		if ($info['phone'] != $phone) {
			$rs = User::findOne(['phone' => $phone, 'from' => $info['from']]);
			return $rs ? $rs['id'] : 0;
		}
		
		return $uid;
		
	}
}