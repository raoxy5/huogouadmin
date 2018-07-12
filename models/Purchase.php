<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
/**
 * 采购
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id','product_id','product_name','nums','per_money','total','create_time','last_update_time','schedule'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'admin' => '申请人',
            'product_id' => '商品ID',
            'product_name' => '商品名称',
            'nums' => '购买数量',
            'per_money' => '单价',
            'total' => '总价',
            'create_time' => '创建时间',
            'last_update_time' => '最后跟新时间',
            'schedule' => '进度',
            'extra' => '备注'
        ];
    }

    public static function getList($where,$page,$perpage,$orderBy = ' create_time desc '){
        $query = Purchase::find()->select('p.*,admin.username,vpo.status as order_status')->from(static::tableName().' p')->leftJoin('admin',' p.admin_id = admin.id')->leftJoin('virtual_purchase_order as vpo','vpo.purchaseid=p.id');
        if ($where) {
            $query->where($where);
        }
        $totalCount = $query->count();
        $pagination = new Pagination([
                'totalCount' => $totalCount, 
                'page'=>$page -1,
                'defaultPageSize'=>$perpage]
            );
        $list = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy($orderBy)->asArray()->all();
        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['pagination'] = $pagination;
        return $return;
    }

    public static function getInfoById($id){
        return Purchase::find()->select('p.*,admin.username')->from(static::tableName().' p')->leftJoin('admin',' p.admin_id = admin.id')->where(['p.id'=>$id])->asArray()->one();
    }

    //进度
    public static function getStatus($status)
    {
        switch($status){
            case 0 :
                return '待审核';
                break;
            case 1 :
                return '待付款';
                break;
            case 2 :
                return '待收货';
                break;
            case 3 :
                return '完成';
                break;
            case '-1' :
                return '驳回';
                break;
            default :
                return '待审核';
                break;
        }
    }
}
