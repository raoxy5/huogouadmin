<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/22
 * Time: 17:05
 */

namespace app\components;


use yii\base\Component;

class Sms extends Component
{

    public $url;
    public $account;
    public $password;

    /** 发送短信
     * @param $mobile
     * @param $message
     * @return string
     */
    public function send($mobile, $message)
    {
        $url = $this->url . '?';
        $params = [
            'username' => $this->account,
            'password' => $this->password,
            'to' => $mobile,
            'text' => urlencode(mb_convert_encoding($message, 'GBK', 'UTF-8')),
            'subid' => '',
            'msgtype' => 4,
        ];

        foreach($params as $key=>$param) {
            $url .= $key . '=' . $param . '&';
        }
        $url = rtrim($url, '&');
        $result = file_get_contents($url);
        return $result;
    }

    /** 获取发送结果
     * @param $result
     * @return array
     */
    public function getSendResult($result)
    {
        $resultDetail = [
            'result' => $result,
            'message' => '',
        ];
        switch($result) {
            case 0:
                $resultDetail['message'] = '正常发送';
                break;
            case -2:
                $resultDetail['message'] = '发送参数填定不正确';
                break;
            case -3:
                $resultDetail['message'] = '用户载入延迟';
                break;
            case -6:
                $resultDetail['message'] = '密码错误';
                break;
            case -7:
                $resultDetail['message'] = '用户不存在';
                break;
            case -11:
                $resultDetail['message'] = '发送号码数理大于最大发送数量';
                break;
            case -12:
                $resultDetail['message'] = '余额不足';
                break;
            case -99:
                $resultDetail['message'] = '内部处理错误';
                break;
            default:
                $resultDetail['message'] = '未知错误';
                break;
        }
        return $resultDetail;
    }


}