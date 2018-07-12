CREATE TABLE `jdcard_buyback_list` (
   `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '回购表',
   `order_id` int(10) NOT NULL COMMENT '订单id',
   `user_id` int(10) NOT NULL COMMENT '用户id',
   `mobile` varchar(15) NOT NULL COMMENT '回购手机号',
   `pay_type` varchar(20) NOT NULL DEFAULT '' COMMENT '支付类型',
   `pay_accounts` varchar(30) NOT NULL DEFAULT '' COMMENT '帐号',
   `pay_name` varchar(10) NOT NULL DEFAULT '' COMMENT '姓名',
   `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
   `pay_no` varchar(60) NOT NULL DEFAULT '' COMMENT '订单号',
   `pay_desc` text COMMENT '备注',
   `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0 未付款 1 付款',
   `bank_name` varchar(50) NOT NULL DEFAULT '' COMMENT '开户行',
   `product_id` int(10) NOT NULL DEFAULT '0' COMMENT '商品id',
   `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
   `pay_time` int(10) NOT NULL DEFAULT '0' COMMENT '付款时间',
   `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '操作人',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4