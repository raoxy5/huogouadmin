CREATE TABLE `keywords` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0话题，1回帖',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '关键字内容',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='关键字表';