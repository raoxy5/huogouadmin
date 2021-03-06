CREATE TABLE `exchange_orders` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_no` CHAR(25) NOT NULL COMMENT '原订单号',
  `admin_id` INT(10) NOT NULL COMMENT '操作人',
  `created_time` INT(10) UNSIGNED NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='换货订单';