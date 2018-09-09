/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yubei

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-09 18:37:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yb_admin
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin`;
CREATE TABLE `yb_admin` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT '0',
  `nickname` varchar(40) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员信息';

-- ----------------------------
-- Table structure for yb_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_menu`;
CREATE TABLE `yb_admin_menu` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL,
  `ico` varchar(20) DEFAULT NULL,
  `level` tinyint(1) unsigned DEFAULT '0',
  `controller` varchar(20) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Table structure for yb_api
-- ----------------------------
DROP TABLE IF EXISTS `yb_api`;
CREATE TABLE `yb_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '商户id',
  `key` varchar(32) DEFAULT NULL COMMENT 'API验证KEY',
  `sitename` varchar(30) NOT NULL,
  `domain` varchar(100) NOT NULL COMMENT '商户验证域名',
  `daily` int(10) NOT NULL COMMENT '日限访问（超过就锁）',
  `secretkey` text NOT NULL COMMENT '商户请求RSA私钥',
  `role` int(4) NOT NULL COMMENT '角色1-普通商户,角色2-特约商户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户API状态,0-禁用,1-锁,2-正常',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_domain_unique` (`domain`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10009 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for yb_article
-- ----------------------------
DROP TABLE IF EXISTS `yb_article`;
CREATE TABLE `yb_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `author` char(20) NOT NULL DEFAULT 'admin' COMMENT '作者',
  `title` char(40) NOT NULL DEFAULT '' COMMENT '文章名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` text NOT NULL COMMENT '文章内容',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面图片id',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件id',
  `img_ids` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文章表';

-- ----------------------------
-- Table structure for yb_balance
-- ----------------------------
DROP TABLE IF EXISTS `yb_balance`;
CREATE TABLE `yb_balance` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `balance` decimal(20,2) DEFAULT '0.00' COMMENT '总金额=可用+冻结',
  `available` decimal(20,2) DEFAULT '0.00' COMMENT '可用余额(已结算金额)',
  `disable` decimal(20,2) DEFAULT '0.00' COMMENT '冻结金额(待结算金额)',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000006 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产表';

-- ----------------------------
-- Table structure for yb_balance_cash
-- ----------------------------
DROP TABLE IF EXISTS `yb_balance_cash`;
CREATE TABLE `yb_balance_cash` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `cash_no` varchar(80) NOT NULL COMMENT '取现记录单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '取现金额',
  `account` int(2) NOT NULL COMMENT '取现账户（关联商户结算账户表）',
  `remarks` varchar(255) NOT NULL COMMENT '取现说明',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '取现状态',
  `create_time` int(10) NOT NULL COMMENT '申请时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商户账户取现记录';

-- ----------------------------
-- Table structure for yb_balance_change
-- ----------------------------
DROP TABLE IF EXISTS `yb_balance_change`;
CREATE TABLE `yb_balance_change` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商户资产变动记录表';

-- ----------------------------
-- Table structure for yb_balance_settle
-- ----------------------------
DROP TABLE IF EXISTS `yb_balance_settle`;
CREATE TABLE `yb_balance_settle` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `settle_no` varchar(80) NOT NULL COMMENT '结算记录单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `fee` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '费率金额',
  `actual` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '实际金额',
  `remarks` varchar(255) NOT NULL COMMENT '申请结算说明',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '结算状态',
  `create_time` int(10) NOT NULL COMMENT '申请时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商户账户结算记录';

-- ----------------------------
-- Table structure for yb_bank
-- ----------------------------
DROP TABLE IF EXISTS `yb_bank`;
CREATE TABLE `yb_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '银行ID',
  `name` varchar(250) NOT NULL COMMENT '银行名称',
  `remarks` varchar(250) NOT NULL COMMENT '备注',
  `default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认账户,0-不默认,1-默认',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10004 DEFAULT CHARSET=utf8mb4 COMMENT='系统支持银行列表';

-- ----------------------------
-- Table structure for yb_channel
-- ----------------------------
DROP TABLE IF EXISTS `yb_channel`;
CREATE TABLE `yb_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '渠道ID',
  `name` varchar(30) NOT NULL COMMENT '渠道名称,如:wx_qrcode,qq_qrcode',
  `rate` decimal(20,3) NOT NULL COMMENT '渠道费率',
  `daily` decimal(20,2) NOT NULL COMMENT '日限额',
  `param` text NOT NULL COMMENT '账户配置参数,json字符串',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道状态,0-停止使用,1-开放使用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel_index` (`name`,`status`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100007 DEFAULT CHARSET=utf8mb4 COMMENT='交易渠道表';

-- ----------------------------
-- Table structure for yb_notice
-- ----------------------------
DROP TABLE IF EXISTS `yb_notice`;
CREATE TABLE `yb_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(250) NOT NULL COMMENT '公告内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '公告状态,0-不展示,1-展示',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='公告表';

-- ----------------------------
-- Table structure for yb_orders
-- ----------------------------
DROP TABLE IF EXISTS `yb_orders`;
CREATE TABLE `yb_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '商户id',
  `trade_no` varchar(30) NOT NULL COMMENT '交易订单号',
  `out_trade_no` varchar(30) NOT NULL COMMENT '商户订单号',
  `subject` varchar(64) NOT NULL COMMENT '商品标题',
  `body` varchar(256) NOT NULL COMMENT '商品描述信息',
  `channel` varchar(30) NOT NULL COMMENT '交易渠道(wx_qrcode)',
  `extra` text COMMENT '特定渠道发起时额外参数',
  `amount` decimal(20,2) NOT NULL COMMENT '实际付款金额,单位是元,保留两位小数',
  `currency` varchar(3) NOT NULL DEFAULT 'CNY' COMMENT '三位货币代码,人民币:CNY',
  `client_ip` varchar(32) NOT NULL COMMENT '客户端IP',
  `return_url` varchar(128) NOT NULL COMMENT '同步通知地址',
  `notify_url` varchar(128) NOT NULL COMMENT '异步通知地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态:0-已取消-1-待付款，2-已付款',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no_index` (`out_trade_no`,`trade_no`,`uid`,`channel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000000038 DEFAULT CHARSET=utf8mb4 COMMENT='交易订单表';

-- ----------------------------
-- Table structure for yb_transaction
-- ----------------------------
DROP TABLE IF EXISTS `yb_transaction`;
CREATE TABLE `yb_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '商户id',
  `order_no` varchar(80) DEFAULT NULL COMMENT '交易订单号',
  `amount` decimal(20,2) DEFAULT NULL COMMENT '交易金额',
  `platform` tinyint(1) DEFAULT NULL COMMENT '交易平台:1-支付宝,2-微信',
  `platform_number` varchar(200) DEFAULT NULL COMMENT '交易平台交易流水号',
  `status` tinyint(1) DEFAULT NULL COMMENT '交易状态',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_index` (`order_no`,`platform`,`uid`,`amount`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='交易流水表';

-- ----------------------------
-- Table structure for yb_user
-- ----------------------------
DROP TABLE IF EXISTS `yb_user`;
CREATE TABLE `yb_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户uid',
  `account` varchar(50) NOT NULL COMMENT '商户邮件',
  `password` varchar(50) NOT NULL COMMENT '商户登录密码',
  `username` varchar(30) NOT NULL COMMENT '商户姓名',
  `nickname` varchar(30) NOT NULL COMMENT '商户简称',
  `phone` varchar(250) NOT NULL COMMENT '手机号',
  `qq` varchar(250) NOT NULL COMMENT 'QQ',
  `is_agent` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '代理商',
  `is_verify` tinyint(1) NOT NULL COMMENT '验证账号',
  `is_verify_phone` tinyint(1) NOT NULL COMMENT '验证手机',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户状态,0-未激活,1-使用中,2-禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `user_name_unique` (`account`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100015 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for yb_user_account
-- ----------------------------
DROP TABLE IF EXISTS `yb_user_account`;
CREATE TABLE `yb_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `bank` int(11) NOT NULL COMMENT '开户行(关联银行表)',
  `account` varchar(250) NOT NULL COMMENT '开户号',
  `address` varchar(250) NOT NULL COMMENT '开户所在地',
  `remarks` varchar(250) NOT NULL COMMENT '备注',
  `default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认账户,0-不默认,1-默认',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='商户结算账户表';

-- ----------------------------
-- Table structure for yb_user_register
-- ----------------------------
DROP TABLE IF EXISTS `yb_user_register`;
CREATE TABLE `yb_user_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL COMMENT '申请邮箱',
  `token` varchar(32) NOT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='申请注册记录';
