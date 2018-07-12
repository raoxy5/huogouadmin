<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/28
 * Time: 下午12:14
 */

namespace app\services;

use app\helpers\Message;
use app\models\Area;
use app\models\Group;
use app\models\Invite;
use app\models\PaymentOrderDistribution;
use app\models\RechargeOrderDistribution;
use app\models\ShareTopic;
use \app\models\User as UserModel;
use app\models\UserLimit;
use app\validators\MobileValidator;
use yii\captcha\CaptchaValidator;
use yii\data\Pagination;
use yii\helpers\StringHelper;
use yii\validators\EmailValidator;
use Yii;
use app\models\Friend;

/** 所有用户相关
 * Class User
 * @package app\services
 */
class User
{
	
	/**
	 *  一个或多个用户的基本信息
	 * @param $id   一个或多个用户ID
	 * @return array|null
	 */
	public static function baseInfo($id)
	{
		if (is_array($id)) {
			$user = UserModel::find()->where(['id' => $id])->indexBy('id')->asArray()->all();
			$users = [];
			foreach ($user as $key => $one) {
				$users[$key] = $one;
				if ($one['nickname']) {
					$users[$key]['username'] = $one['nickname'];
				} elseif ($one['phone']) {
					$users[$key]['username'] = static::privatePhone($one['phone']);
				} elseif ($one['email']) {
					$users[$key]['username'] = static::privateEmail($one['email']);
				}
				$groupAdmin = Group::find()->where(['or', 'adminuser="' . $one['email'] . '"', 'adminuser="' . $one['phone'] . '"'])->one();
				if ($groupAdmin['id']) $groupLevel = 1; else $groupLevel = 0;
				$users[$key]['level'] = static::level($one['experience'], $groupLevel);
			}
			return $users;
		} else {
			$user = UserModel::find()->where(['id' => $id])->asArray()->one();
			if ($user) {
				if ($user['nickname']) {
					$user['username'] = $user['nickname'];
				} elseif ($user['phone']) {
					$user['username'] = static::privatePhone($user['phone']);
				} elseif ($user['email']) {
					$user['username'] = static::privateEmail($user['email']);
				}
				$groupAdmin = Group::find()->where(['or', 'adminuser="' . $user['email'] . '"', 'adminuser="' . $user['phone'] . '"'])->one();
				if ($groupAdmin['id']) $groupLevel = 1; else $groupLevel = 0;
				$user['level'] = static::level($user['experience'], $groupLevel);
			}
			return $user;
		}
	}
	
	private static function level($experience, $groupLevel = 0)
	{
		$arr = [];
		if ($groupLevel == 1) {
			$arr['num'] = 1;
			$arr['pic'] = 'g_circles03.png';
			$arr['name'] = '伙购官方';
		} else {
			if ($experience <= 10000) {
				$arr['pic'] = 'xl_v1.png';
				$arr['name'] = '伙购新兵';
				$arr['num'] = 1;
				$arr['next_level'] = "伙购少将";
				$arr['remain_expr'] = 10000 - $experience + 1;
			} elseif ($experience < 50000) {
				$arr['pic'] = 'xl_v2.png';
				$arr['name'] = '伙购少将';
				$arr['num'] = 2;
				$arr['next_level'] = "伙购中将";
				$arr['remain_expr'] = 50000 - $experience;
			} elseif ($experience < 200000) {
				$arr['pic'] = 'xl_v3.png';
				$arr['name'] = '伙购中将';
				$arr['num'] = 3;
				$arr['next_level'] = "伙购上将";
				$arr['remain_expr'] = 200000 - $experience;
			} elseif ($experience < 500000) {
				$arr['pic'] = 'xl_v4.png';
				$arr['name'] = '伙购上将';
				$arr['num'] = 4;
				$arr['next_level'] = "伙购大将";
				$arr['remain_expr'] = 500000 - $experience;
			} elseif ($experience < 1000000) {
				$arr['pic'] = 'xl_v5.png';
				$arr['name'] = '伙购大将';
				$arr['num'] = 5;
				$arr['next_level'] = "伙购元帅";
				$arr['remain_expr'] = 1000000 - $experience;
			} elseif ($experience >= 1000000) {
				$arr['pic'] = 'xl_v6.png';
				$arr['name'] = '伙购元帅';
				$arr['num'] = 6;
				$arr['next_level'] = "";
				$arr['remain_expr'] = 0;
			} else {
				$arr['num'] = 1;
				$arr['pic'] = 'xl_v1.png';
				$arr['name'] = '伙购新兵';
			}
		}
		
		return $arr;
	}
	
	public static function privateAccount($account)
	{
		$mobileValidator = new MobileValidator();
		$valid = $mobileValidator->validate($account);
		if ($valid) {
			return static::privatePhone($account);
		}
		$emailValidator = new EmailValidator();
		$valid = $emailValidator->validate($account);
		if ($valid) {
			return static::privateEmail($account);
		}
	}
	
	public static function privatePhone($phone)
	{
		if (empty($phone)) {
			return '';
		}
		$len = StringHelper::byteLength($phone);
		$subPos = floor($len / 3);
		$before = StringHelper::byteSubstr($phone, 0, $subPos);
		$after = StringHelper::byteSubstr($phone, -1 * $subPos);
		$phone = $before . str_repeat('*', $len - 2 * $subPos) . $after;
		return $phone;
	}
	
	public static function privateEmail($email)
	{
		if (empty($email)) {
			return '';
		}
		$arr = explode('@', $email);
		
		$len = StringHelper::byteLength($arr[0]);
		$subPos = floor($len / 3);
		$before = StringHelper::byteSubstr($arr[0], 0, $subPos);
		$after = StringHelper::byteSubstr($arr[0], -1 * $subPos);
		$email = $before . str_repeat('*', $len - 2 * $subPos) . $after . '@' . $arr[1];
		return $email;
	}
	
	/** 一个或多个用户的所有信息
	 * @param $id
	 * @return mixed
	 */
	public static function allInfo($id)
	{
		if (is_array($id)) {
			$allInfo = UserModel::find()->select('*,users.id id')
				->leftJoin('user_profile as p', 'users.id = p.id')
				->where(['users.id' => $id])
				->indexBy('id')
				->asArray()
				->all();
			foreach ($allInfo as $key => $one) {
				if ($one['nickname']) {
					$allInfo[$key]['username'] = $one['nickname'];
				} elseif ($one['phone']) {
					$allInfo[$key]['username'] = static::privatePhone($one['phone']);
				} elseif ($one['email']) {
					$allInfo[$key]['username'] = static::privateEmail($one['email']);
				}
				$groupAdmin = Group::find()->where(['or', 'adminuser="' . $one['email'] . '"', 'adminuser="' . $one['phone'] . '"'])->one();
				if ($groupAdmin['id']) $groupLevel = 1; else $groupLevel = 0;
				$allInfo[$key]['level'] = static::level($one['experience'], $groupLevel);
				$allInfo[$key]['hometown'] = static::hometown($one['hometown'], $one['id']);
			}
		} else {
			$allInfo = UserModel::find()->select('*,users.id id')
				->leftJoin('user_profile as p', 'users.id = p.id')
				->where(['users.id' => $id])
				->asArray()
				->one();
			if ($allInfo) {
				if ($allInfo['nickname']) {
					$allInfo['username'] = $allInfo['nickname'];
				} elseif ($allInfo['phone']) {
					$allInfo['username'] = static::privatePhone($allInfo['phone']);
				} elseif ($allInfo['email']) {
					$allInfo['username'] = static::privateEmail($allInfo['email']);
				}
				$groupAdmin = Group::find()->where(['or', 'adminuser="' . $allInfo['email'] . '"', 'adminuser="' . $allInfo['phone'] . '"'])->one();
				if ($groupAdmin['id']) $groupLevel = 1; else $groupLevel = 0;
				$allInfo['level'] = static::level($allInfo['experience'], $groupLevel);
				$allInfo['hometown'] = static::hometown($allInfo['hometown'], $id);
			}
		}
		return $allInfo;
	}
	
	public static function hometown($hometown, $id)
	{
		$home = '';
		$limit = UserLimit::findOne(['user_id' => $id]);
		if (($limit && $limit['position'] == 1) || !$limit) {
			if ($hometown) {
				$split = explode(',', $hometown);
				$one = Area::findOne([$split[0]]);
				$two = Area::findOne([$split[1]]);
				$home = $one['name'] . $two['name'];
			}
		}
		
		return $home;
	}
	
	/** 用户主页的动态
	 * @param $userId
	 */
	public static function movement($userId)
	{
		
	}
	
	/**
	 * 用户主页购买纪录
	 * @param $uid
	 * @param $homeId
	 * @param $page
	 * @param int $perpage
	 * @return mixed
	 */
	public static function buyList($uid, $homeId, $page, $perpage = 20)
	{
		$member = new Member(['homeId' => $homeId]);
		
		$total = 'all';
		$userId = UserModel::findOne(['home_id' => $homeId]);
		$limit = UserLimit::findOne(['user_id' => $userId['id']]);
		$isFriend = Friend::findOne(['user_id' => $uid, 'friend_userid' => $limit['user_id']]);
		if ($limit['user_id'] == $uid) {
			$total = 'all';
		} elseif ($limit) {
			if ($limit['ucenter_buylist'] == 1 && $limit['buylist_number'] != 0) {
				$total = $limit['buylist_number'];
			} elseif ($limit['ucenter_buylist'] == 2) {
				if ($isFriend) $total = 'all';
				else $total = 'zero';
			} elseif ($limit['ucenter_buylist'] == 0) {
				$total = 'zero';
			}
		}
		
		return $member->getBuyList('', '', $page, $perpage, '-1', $total);
	}
	
	/**
	 * 用户主页获得的商品列表
	 * @param $uid
	 * @param $homeId
	 * @param $page
	 * @param int $perpage
	 * @return mixed
	 */
	public static function productList($uid, $homeId, $page, $perpage = 20)
	{
		$member = new Member(['homeId' => $homeId]);
		
		$total = 'all';
		$userId = UserModel::findOne(['home_id' => $homeId]);
		$limit = UserLimit::findOne(['user_id' => $userId['id']]);
		$isFriend = Friend::findOne(['user_id' => $uid, 'friend_userid' => $limit['user_id']]);
		if ($limit['user_id'] == $uid) {
			$total = 'all';
		} elseif ($limit) {
			if ($limit['ucenter_orderlist'] == 1 && $limit['orderlist_number'] != 0) {
				$total = $limit['orderlist_number'];
			} elseif ($limit['ucenter_orderlist'] == 2) {
				if ($isFriend) $total = 'all';
				else $total = 'zero';
			} elseif ($limit['ucenter_orderlist'] == 0) {
				$total = 'zero';
			}
		}
		
		return $member->getProductList('', '', $page, $perpage, -1, $total);
	}
	
	/**
	 * 用户主页晒单列表
	 * @param $uid
	 * @param $homeId
	 * @param $page
	 * @param int $perpage
	 * @return array
	 */
	public static function shareList($uid, $homeId, $page, $perpage = 20)
	{
		$total = 'all';
		$userId = UserModel::findOne(['home_id' => $homeId]);
		$limit = UserLimit::findOne(['user_id' => $userId['id']]);
		$isFriend = Friend::findOne(['user_id' => $uid, 'friend_userid' => $limit['user_id']]);
		if ($limit['user_id'] == $uid) {
			$total = 'all';
		} elseif ($limit) {
			if ($limit['ucenter_sharelist'] == 1 && $limit['sharelist_number'] != 0) {
				$total = $limit['sharelist_number'];
			} elseif ($limit['ucenter_sharelist'] == 2) {
				if ($isFriend) $total = 'all';
				else $total = 'zero';
			} elseif ($limit['ucenter_sharelist'] == 0) {
				$total = 'zero';
			}
		}
		
		$shareList = ShareTopic::getListByType(10, 0, 0, 10, 1, substr($homeId, 3, strlen($homeId) - 1), $total);
		
		foreach ($shareList['list'] as &$share) {
			$periodInfo = Period::info($share['period_id']);
			if ($periodInfo) {
				$share['period_number'] = $periodInfo['period_number'];
				$share['product_name'] = $periodInfo['goods_name'];
			}
			$share['is_up'] = ShareTopic::is_up($share['id']);
		}
		
		return $shareList;
	}
	
	/** 用户主页加入的圈子
	 * @param $homeId
	 */
	public static function joinGroups($userId)
	{
		
	}
	
	/** 用户主页发表的话题列表
	 * @param $userId
	 * @param $page
	 * @param int $perpage
	 */
	public static function topicList($userId, $page, $perpage = 20)
	{
		
	}
	
	/** 用户主页发表的话题回复列表
	 * @param $userId
	 * @param $page
	 * @param int $perpage
	 */
	public static function topicCommentList($userId, $page, $perpage = 20)
	{
		
	}
	
	/** 用户主页的好友列表
	 * @param $userId
	 * @param $page
	 * @param int $perpage
	 */
	public static function firends($userId, $page, $perpage = 20)
	{
		$member = new Member(['id' => $userId]);
		return $member->getFirends($page, $perpage);
	}
	
	
	/** 发送验证码
	 * @param $to
	 * @param int $type
	 * @return bool
	 */
	public static function sendCode($to, $type, $verify = false, $verifyCode = '', $data = [])
	{
		if (empty($type)) {
			return ['errcode' => 102];
		}
		if (empty($to)) {
			return ['errcode' => 103];
		}
		$numDuration = 3600 * 24;
		$cache = \Yii::$app->cache;
		$totalKey = __CLASS__ . '__verifyCodeNum__' . $to;
		$totalKey = md5($totalKey);
		$totalNum = $cache->get($totalKey) ?: 0;
		if ($totalNum > 100) {
			return ['errcode' => 102];
		}
		$key = __CLASS__ . '__verifyCode__' . $to . '_' . $type;
		$key = md5($key);
		$code = mt_rand(100000, 999999);
		$codeInfo = $cache->get($key);
		$duration = 1800;
		if ($codeInfo && isset($codeInfo['num'])) {
			$codeInfo['num'] += 1;
			$codeInfo['code'] = $code;
		} else {
			$codeInfo = [];
			$codeInfo['num'] = 1;
			$codeInfo['code'] = $code;
		}
		$data['code'] = $code;
		if (!$verify) {
			$cache->set($totalKey, $totalNum + 1, $duration);
			$cache->set($key, $codeInfo, $numDuration);
			Message::send($type, $to, $data);
			return ['errcode' => 100];
		}
		if ($verify && $codeInfo['num'] > 3) {
			$captchaValidator = new CaptchaValidator();
			$captchaValidator->captchaAction = '/api/user/captcha';
			$valid = $captchaValidator->validate($verifyCode);
			if ($valid) {
				$cache->set($totalKey, $totalNum + 1, $numDuration);
				$cache->set($key, $codeInfo, $duration);
				Message::send($type, $to, $data);
				return ['errcode' => 100];
			}
			return ['errcode' => 101];
		} else {
			$cache->set($totalKey, $totalNum + 1, $duration);
			$cache->set($key, $codeInfo, $duration);
			Message::send($type, $to, $data);
			return ['errcode' => 100];
		}
	}
	
	/** 获取验证码
	 * @param $to
	 * @return bool|mixed
	 */
	public static function getCode($to, $type)
	{
		if (empty($to) || empty($type)) {
			return false;
		}
		$key = __CLASS__ . '__verifyCode__' . $to . '_' . $type;
		$key = md5($key);
		$cache = \Yii::$app->cache;
		$codeInfo = $cache->get($key);
		if (empty($codeInfo)) {
			return false;
		}
		$num = $codeInfo['num'];
		$code = $codeInfo['code'];
		return $code;
	}
	
	/*** 销毁验证码
	 * @param $to
	 * @param $type
	 * @return bool|string
	 */
	public static function destroyCode($to, $type)
	{
		$key = __CLASS__ . '__verifyCode__' . $to . '_' . $type;
		$key = md5($key);
		$cache = \Yii::$app->cache;
		$v = $cache->delete($key);
		$key = __CLASS__ . '__checkedCode__' . $to . '_' . $type;
		$key = md5($key);
		$c = $cache->delete($key);
		return $v && $c ? true : false;
	}
	
	public static function checkCode($code, $account, $type)
	{
		$getCode = User::getCode($account, $type);
		if (!$getCode || $code != $getCode) {
			return false;
		}
		$key = __CLASS__ . '__checkedCode__' . $account . '_' . $type;
		$key = md5($key);
		$cache = \Yii::$app->cache;
		return $cache->set($key, 1, 1800) ? true : false;
	}
	
	
	public static function isCheckedCode($account, $type)
	{
		if (empty($account) || empty($type)) {
			return false;
		}
		$key = __CLASS__ . '__checkedCode__' . $account . '_' . $type;
		$key = md5($key);
		$cache = \Yii::$app->cache;
		return $cache->get($key) ? true : false;
	}
	
	/**
	 * 用户列表
	 * @param int $limit
	 * @param int $status -1 全部  0 冻结  1 正常
	 * @param int $order
	 * @param int $type 1 注册时间  2 登录时间
	 * @param string $start_time
	 * @param string $end_time
	 * @param string $account 会员名/手机号/邮箱
	 * @return array
	 */
	public static function UserList($limit = 10, $status = -1, $order = 1, $type = 1, $start_time = '', $end_time = '', $account = '')
	{
		$query = \app\models\User::find();
		
		if ($status != -1) {
			$query->where(['users.status' => $status]);
		}
		
		if ($type == 1) {
			if ($start_time != '') {
				$query->andWhere(['>', 'users.created_at', $start_time]);
			}
			if ($end_time != '') {
				$query->andWhere(['<', 'users.created_at', $end_time]);
			}
		} elseif ($type == 2) {
			if ($start_time != '') {
				$query->andWhere(['>', 'users.updated_at', $start_time]);
			}
			if ($end_time != '') {
				$query->andWhere(['<', 'users.updated_at', $end_time]);
			}
		}
		
		if ($account != '') {
			$query->andWhere(['or', 'users.phone="' . $account . '"', 'users.email="' . $account . '"', 'users.nickname="' . $account . '"']);
		}
		$query->leftJoin('(SELECT COUNT(*) invite_num, invite.user_id FROM invite GROUP BY invite.user_id) invite_count', 'users.id=invite_count.user_id');
		$sql = '';
		for ($i = 100; $i <= 109; $i++) {
			$sql .= '(SELECT user_id, SUM(money) payment_num FROM payment_orders_' . $i . ' GROUP BY user_id) union';
		}
		$sql = rtrim($sql, 'union');
		$query->leftJoin('(' . $sql . ') payment_orders', 'users.id=payment_orders.user_id');
		$query->leftJoin('(SELECT COUNT(*) orders_num, orders.user_id FROM orders GROUP BY orders.user_id) orders_count', 'users.id=orders_count.user_id');
		$query->select('*');
		switch ($order) {
			case 1:
				$query->orderBy('users.created_at DESC');
				break;
			case 2:
				$query->orderBy('users.created_at ASC');
				break;
			case 3:
				$query->orderBy('users.updated_at DESC');
				break;
			case 4:
				$query->orderBy('users.updated_at ASC');
				break;
			case 5:
				$query->orderBy('users.money desc');
				break;
			case 6: //邀请人数降序
				$query->orderBy('invite_count.invite_num DESC');
				break;
			case 7: //消费金额降序
				$query->orderBy('payment_orders.payment_num DESC');
				break;
			case 8: //中奖次数降序
				$query->orderBy('orders_count.orders_num DESC');
				break;
		}
		
		$countQuery = clone $query;
		$pagination = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => $limit]);
		$list = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->asArray()
			->all();
		
		// 获取等级  上级
		foreach ($list as &$l) {
			$expr = self::level($l['experience']);
			$l['level_name'] = $expr['name'];
			
			if ($l['nickname']) {
				$l['username'] = $l['nickname'];
			} elseif ($l['phone']) {
				$l['username'] = static::privatePhone($l['phone']);
			} elseif ($l['email']) {
				$l['username'] = static::privateEmail($l['email']);
			}
			
			$invite = User::getInviteUser($l['id']);
			$l['invite_name'] = $invite['user_name'];
			
		}
		
		return ['list' => $list, 'pagination' => $pagination];
	}
	
	public static function getInviteUser($userId)
	{
		$invite = Invite::findOne(['invite_uid' => $userId]);
		
		if (empty($invite)) {
			$data['user_id'] = 0;
			$data['user_name'] = 'system';
		} else {
			$inviteUserInfo = self::baseInfo($invite['user_id']);
			$data['user_id'] = $invite['user_id'];
			$data['user_name'] = $inviteUserInfo['username'];
		}
		
		return $data;
	}
	
	public static function getTotalPayment($userId)
	{
		$baseInfo = self::baseInfo($userId);
		$tableId = PaymentOrderDistribution::getTableIdByUserHomeId($baseInfo['home_id']);
		$query = PaymentOrderDistribution::findByTableId($tableId)->where(['user_id' => $userId]);
		$query->andWhere(['=', 'status', PaymentOrderDistribution::STATUS_PAID]);
		
		// 消费总额
		$totalMoney = $query->select('SUM(money) as totalMoney')->asArray()->one();
		return $totalMoney['totalMoney'];
	}
	
	public static function getTotalRecharge($userId)
	{
		$baseInfo = self::baseInfo($userId);
		$homeId = $baseInfo['home_id'];
		$query = RechargeOrderDistribution::findByTableId($homeId)->where(['user_id' => $userId, 'status' => 1]);
		$order = 'pay_time desc';
		
		// 充值总额
		$totalMoney = $query->select('SUM(money) as totalMoney')->asArray()->one();
		return $totalMoney['totalMoney'];
	}
	
	public static function getFirstRecharge($userId)
	{
		$baseInfo = self::baseInfo($userId);
		$homeId = $baseInfo['home_id'];
		$money = RechargeOrderDistribution::findByTableId($homeId)->where(['user_id' => $userId, 'status' => 1])
			->orderBy("pay_time asc")->one();
		return $money["money"];
	}
}