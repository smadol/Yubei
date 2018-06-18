
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for 商户表
-- ----------------------------
DROP TABLE IF EXISTS `yb_user`;
CREATE TABLE `yb_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户uid',
  `username` varchar(50) NOT NULL COMMENT '商户登录/注册邮件',
  `password` varchar(50) NOT NULL COMMENT '商户登录密码',
  `realname` varchar(50) NOT NULL COMMENT '商户名称',
  `phone` varchar(20) DEFAULT NULL COMMENT '商户联系电话',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户状态,0-未激活,1-使用中,2-禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `user_name_unique` (`username`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100001 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';


-- ----------------------------
-- Table structure for 结算账户表
-- ----------------------------
DROP TABLE IF EXISTS `yb_user_account`;
CREATE TABLE `yb_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `bank` varchar(250) NOT NULL COMMENT '开户行',
  `account` varchar(250) NOT NULL COMMENT '开户号',
  `remarks` varchar(250) NOT NULL COMMENT '备注',
  `default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认账户,0-不默认,1-默认',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8mb4 COMMENT='结算账户表';

-- ----------------------------
-- Table structure for 商户资产表
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset`;
CREATE TABLE `yb_asset` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `asset` decimal(20,2) DEFAULT '0.00' COMMENT '总金额=可用+冻结',
  `available` decimal(20,2) DEFAULT '0.00' COMMENT '可用金额',
  `disable` decimal(20,2) DEFAULT '0.00' COMMENT '冻结金额',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产表';


-- ----------------------------
-- Table structure for 结算记录
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset_settle`;
CREATE TABLE `yb_asset_settle` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '结算记录单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `fee` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '费率金额',
  `actual` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '实际金额',
  `remarks` varchar(255) NOT NULL COMMENT '申请结算说明',
  `status` tinyint(1) NOT NULL DEFAULT '0'COMMENT '结算状态',
  `create_time` int(10) NOT NULL COMMENT '申请时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4 COMMENT='结算记录';

-- ----------------------------
-- Table structure for 取现记录
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset_cash`;
CREATE TABLE `yb_asset_cash` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '取现记录单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '取现金额',
  `account` varchar(255) NOT NULL COMMENT '取现账户',
  `remarks` varchar(255) NOT NULL COMMENT '取现说明',
  `status` tinyint(1) NOT NULL DEFAULT '0'COMMENT '取现状态',
  `create_time` int(10) NOT NULL COMMENT '申请时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4 COMMENT='取现记录';

-- ----------------------------
-- Table structure for 商户资产变动记录表
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset_change`;
CREATE TABLE `yb_asset_change` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '资金变动记录单号',
  `preinc` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '变动前金额',
  `increase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '增加金额',
  `reduce` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '减少金额',
  `suffixred` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '变动后金额',
  `remarks` varchar(255) NOT NULL COMMENT '资金变动说明',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产变动记录表';

-- ----------------------------
-- Table structure for 交易渠道表
-- ----------------------------
DROP TABLE IF EXISTS `yb_pay_channel`;
CREATE TABLE `yb_pay_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '渠道ID',
  `channel` varchar(30) NOT NULL COMMENT '渠道名称,如:alipay,wechat',
  `param` varchar(4096) NOT NULL COMMENT '配置参数,json字符串',
  `rate` decimal(20,0) NOT NULL COMMENT '渠道费率',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道状态,0-停止使用,1-开放使用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100001 DEFAULT CHARSET=utf8mb4 COMMENT='交易渠道表';

-- ----------------------------
-- Table structure for 交易订单表
-- ----------------------------
DROP TABLE IF EXISTS `yb_pay_order`;
CREATE TABLE `yb_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '商户id',
  `trade_no` varchar(20) NOT NULL COMMENT '交易订单号',
  `out_trade_no` int(11) NOT NULL COMMENT '商户订单号',
  `subject` varchar(64) NOT NULL COMMENT '商品标题',
  `body` varchar(256) NOT NULL COMMENT '商品描述信息',
  `channel` varchar(30) NOT NULL COMMENT '交易渠道',
  `extra` varchar(512) DEFAULT NULL COMMENT '特定渠道发起时额外参数',
  `amount` decimal(20,2) NOT NULL COMMENT '实际付款金额,单位是元,保留两位小数',
  `currency` varchar(3) NOT NULL DEFAULT 'CNY' COMMENT '三位货币代码,人民币:CNY',
  `client_ip` varchar(32) NOT NULL COMMENT '客户端IP',
  `return_url` varchar(128) NOT NULL COMMENT '同步通知地址',
  `notify_url` varchar(128) NOT NULL COMMENT '异步通知地址',
  `status` tinyint(1) NOT NULL COMMENT '订单状态:0-已取消-1-待付款，2-已付款',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no_index` (`out_trade_no`,`trade_no`,`uid`,`channel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100000001 DEFAULT CHARSET=utf8mb4 COMMENT='交易订单表';

-- ----------------------------
-- Table structure for 交易流水表
-- ----------------------------
DROP TABLE IF EXISTS `yb_transaction`;
CREATE TABLE `yb_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '商户id',
  `order_no` varchar(80) DEFAULT NULL COMMENT '交易订单号',
  `amount` decimal(20,2) DEFAULT NULL COMMENT '交易金额',
  `platform` tinyint(1) DEFAULT NULL COMMENT '交易平台:1-交易宝,2-微信',
  `platform_number` varchar(200) DEFAULT NULL COMMENT '交易平台交易流水号',
  `status` tinyint(1) DEFAULT NULL COMMENT '交易状态',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100001 DEFAULT CHARSET=utf8mb4 COMMENT='交易流水表';

-- ----------------------------
-- Table structure for API 管理表
-- ----------------------------
DROP TABLE IF EXISTS `yb_api`;
CREATE TABLE `yb_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '商户id',
  `domain` varchar(100) NOT NULL COMMENT '商户验证域名',
  `secretkey` varchar(2048) NOT NULL COMMENT '商户请求RSA私钥',
  `role` int(4) NOT NULL COMMENT '角色1-普通商户,角色2-特约商户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户API状态,0-禁用,1-锁,2-正常',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_domain_unique` (`domain`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for 公告表
-- ----------------------------
DROP TABLE IF EXISTS `yb_notice`;
CREATE TABLE `yb_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(250) NOT NULL COMMENT '公告内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '公告状态,0-不展示,1-展示',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8mb4 COMMENT='公告表';

-- ---------------------------后台-------------------------------------------
-- ----------------------------
-- Table structure for 菜单
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_menu`;
CREATE TABLE `yb_admin_menu` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(9) unsigned DEFAULT '0',
  `name` varchar(40) DEFAULT NULL,
  `ico` varchar(20) DEFAULT NULL,
  `level` tinyint(1) unsigned DEFAULT '0',
  `controller` varchar(20) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='菜单';

-- ----------------------------
-- Table structure for
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin`;
CREATE TABLE `yb_admin` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `phone` varchar(12) DEFAULT NULL COMMENT '手机号',
  `eamil` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0:正常 1:禁用',
  `role` mediumint(10) unsigned DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

INSERT INTO `yb_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '18078687485','1078509454@qq.com', '0', '1', '1515908045', '1515908045');

-- ----------------------------
-- Table structure for 权限表
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_role`;
CREATE TABLE `yb_admin_role` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `ids` mediumtext,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(80) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='权限表';