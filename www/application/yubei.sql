/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yubei

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-11 21:13:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for be_admin
-- ----------------------------
DROP TABLE IF EXISTS `be_admin`;
CREATE TABLE `be_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `nickname` varchar(80) DEFAULT NULL,
  `password` varchar(44) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for be_pay_channel
-- ----------------------------
DROP TABLE IF EXISTS `be_pay_channel`;
CREATE TABLE `be_pay_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '渠道ID',
  `channel` varchar(30) NOT NULL COMMENT '渠道名称,如:alipay,wechat',
  `param` varchar(4096) NOT NULL COMMENT '配置参数,json字符串',
  `rate` decimal(20,0) NOT NULL COMMENT '渠道费率',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道状态,0-停止使用,1-使用中',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8mb4 COMMENT='支付渠道表';

-- ----------------------------
-- Table structure for be_pay_order
-- ----------------------------
DROP TABLE IF EXISTS `be_pay_order`;
CREATE TABLE `be_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `mchid` int(11) NOT NULL COMMENT '商户id',
  `trade_no` varchar(20) NOT NULL COMMENT '支付订单号',
  `out_trade_no` int(11) NOT NULL COMMENT '商户订单号',
  `subject` varchar(64) NOT NULL COMMENT '商品标题',
  `body` varchar(256) NOT NULL COMMENT '商品描述信息',
  `channel` varchar(30) NOT NULL COMMENT '支付渠道',
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
  UNIQUE KEY `order_no_index` (`out_trade_no`,`trade_no`,`mchid`,`channel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000000000 DEFAULT CHARSET=utf8mb4 COMMENT='交易订单表';

-- ----------------------------
-- Table structure for be_transaction
-- ----------------------------
DROP TABLE IF EXISTS `be_transaction`;
CREATE TABLE `be_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mchid` int(11) DEFAULT NULL COMMENT '商户id',
  `order_no` varchar(80) DEFAULT NULL COMMENT '支付订单号',
  `amount` decimal(20,2) DEFAULT NULL COMMENT '支付订单号',
  `platform` tinyint(1) DEFAULT NULL COMMENT '支付平台:1-支付宝,2-微信',
  `platform_number` varchar(200) DEFAULT NULL COMMENT '支付宝支付流水号',
  `status` tinyint(1) DEFAULT NULL COMMENT '支付状态',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8mb4 COMMENT='交易流水表';

-- ----------------------------
-- Table structure for be_user
-- ----------------------------
DROP TABLE IF EXISTS `be_user`;
CREATE TABLE `be_user` (
  `mchid` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户mchid',
  `username` varchar(50) NOT NULL COMMENT '商户登录名称',
  `password` varchar(50) NOT NULL COMMENT '商户登录密码',
  `realname` varchar(50) NOT NULL COMMENT '商户登录密码',
  `secretkey` varchar(2048) NOT NULL COMMENT '商户请求私钥',
  `email` varchar(50) DEFAULT NULL COMMENT '商户登录/注册邮件',
  `phone` varchar(20) DEFAULT NULL COMMENT '商户联系电话',
  `role` int(4) NOT NULL COMMENT '角色0-管理员,1-普通商户,角色2-特约商户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户状态,0-未激活,1-使用中,2-禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`mchid`),
  UNIQUE KEY `user_name_unique` (`username`,`mchid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10000000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for be_user_asset
-- ----------------------------
DROP TABLE IF EXISTS `be_user_asset`;
CREATE TABLE `be_user_asset` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `mchid` varchar(40) NOT NULL COMMENT '商户ID',
  `asset` decimal(20,2) DEFAULT '0.00' COMMENT '总金额',
  `available` decimal(20,2) DEFAULT '0.00' COMMENT '可用金额',
  `disable` decimal(20,2) DEFAULT '0.00' COMMENT '禁用金额',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产表';

-- ----------------------------
-- Table structure for be_user_asset_change
-- ----------------------------
DROP TABLE IF EXISTS `be_user_asset_change`;
CREATE TABLE `be_user_asset_change` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `mchid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '资金变动记录单号',
  `increase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '增加金额',
  `reduce` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '减少金额',
  `disable` decimal(20,2) NOT NULL COMMENT '冻结金额',
  `remarks` varchar(255) NOT NULL COMMENT '资金变动说明',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产变动记录表';
