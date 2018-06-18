/*
Navicat MySQL Data Transfer

Source Server         : Yubei
Source Server Version : 50559
Source Host           : 112.74.181.131:3306
Source Database       : yubei

Target Server Type    : MYSQL
Target Server Version : 50559
File Encoding         : 65001

Date: 2018-05-05 16:13:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for 商户表
-- ----------------------------
DROP TABLE IF EXISTS `yb_mch`;
CREATE TABLE `yb_mch` (
  `mchid` int(10)  NOT NULL AUTO_INCREMENT COMMENT '商户ID',
  `appid` varchar(40) NOT NULL COMMENT '应用ID',
  `username` varchar(80) NOT NULL COMMENT '登录邮箱',
  `password` varchar(80) NOT NULL COMMENT '商户登录密码',
  `secretkey` varchar(32) DEFAULT NULL COMMENT '支付签名密钥',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 =free 2=pro 3= Partner',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL COMMENT '用户创建时间',
  `updatetime` int(10) NOT NULL COMMENT '用户数据更新时间',
  PRIMARY KEY (`mchid`)
) ENGINE=InnoDB AUTO_INCREMENT=100000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for 商户信息表
-- ----------------------------
DROP TABLE IF EXISTS `yb_mch_info`;
CREATE TABLE `yb_mch_info` (
  `id` int(20)  NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mchid` varchar(40) NOT NULL COMMENT '关联商户ID',
  `mchname` varchar(30) DEFAULT NULL COMMENT '商户姓名',
  `realname` varchar(255) NOT NULL COMMENT '真实姓名',
  `plan` tinyint(1) NOT NULL COMMENT '结算方式',
  `account` varchar(255) NOT NULL COMMENT '提现账户',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 =free 2=pro 3= Partner',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL COMMENT '用户创建时间',
  `updatetime` int(10) NOT NULL COMMENT '用户数据更新时间',
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Table structure for 商户资金表
-- ----------------------------
DROP TABLE IF EXISTS `yb_mch_asset`;
CREATE TABLE `yb_mch_asset` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `mchid` varchar(40) NOT NULL COMMENT '用户ID',
  `asset` decimal(20,2) DEFAULT '0.00' COMMENT '总金额',
  `available` decimal(20,2) DEFAULT '0.00' COMMENT '可用金额',
  `disable` decimal(20,2) DEFAULT '0.00' COMMENT '禁用金额',
  `createtime` int(10) NOT NULL COMMENT '用户创建时间',
  `updatetime` int(10) NOT NULL COMMENT '用户数据更新时间',
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产表';

-- ----------------------------
-- Table structure for 商户资产变动记录表
-- ----------------------------
DROP TABLE IF EXISTS `yb_mch_asset_change`;
CREATE TABLE `yb_mch_asset_change` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `mchid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '资金变动记录单号',
  `amount` decimal(20,0) NOT NULL COMMENT '变动资金',
  `remarks` varchar(255) NOT NULL COMMENT '资金变动说明',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL COMMENT '变动时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产变动记录表';

-- ----------------------------
-- Table structure for 支付渠道表
-- ----------------------------
DROP TABLE IF EXISTS `yb_pay_channel`;
CREATE TABLE `yb_pay_channel` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '渠道主键ID',
  `channel` varchar(30) NOT NULL COMMENT '渠道名称,如:alipay,wechat',
  `configure` varchar(4096) NOT NULL COMMENT '配置参数,json字符串',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  `state` tinyint(6) NOT NULL DEFAULT '1' COMMENT '渠道状态,0-停止使用,1-使用中',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COMMENT='支付渠道表';

-- ----------------------------
-- Table structure for 支付订单表
-- ----------------------------
DROP TABLE IF EXISTS `yb_pay_order`;
CREATE TABLE `yb_pay_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mchid` varchar(40) NOT NULL COMMENT '某商户',
  `subject` varchar(255) NOT NULL COMMENT '支付项目',
  `body` varchar(255) NOT NULL COMMENT '支付具体',
  `order_no` varchar(80) NOT NULL COMMENT '支付订单号',
  `out_trade_no` varchar(80) DEFAULT NULL COMMENT '商户订单号',
  `currency` varchar(3) NOT NULL DEFAULT 'CNY' COMMENT '三位货币代码,人民币:CNY',
  `amount` decimal(8,2) NOT NULL COMMENT '支付金额表（单位：RMB）',
  `channel` varchar(30) NOT NULL COMMENT '支付通道',
  `client_ip` varchar(40) NOT NULL COMMENT '订单构建IP',
  `return_url` varchar(255) NOT NULL COMMENT '同步返回URL',
  `notify_url` varchar(255) NOT NULL COMMENT '异步通知URL',
  `extparam` varchar(1024) NOT NULL COMMENT '拓展参数',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=订单关闭，1=订单待支付，2=订单支付完成',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `IDX_MchId_OrderNo` (`mchid`,`out_trade_no`,`order_no`,`channel`,`state`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000000 DEFAULT CHARSET=utf8mb4 COMMENT='支付订单信息表';

-- ----------------------------
-- Table structure for 支付流水表
-- ----------------------------
DROP TABLE IF EXISTS `yb_transaction`;
CREATE TABLE `yb_transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(80) NOT NULL COMMENT '支付订单号',
  `amount` decimal(8,2) NOT NULL COMMENT '流水金额（单位：CNY）',
  `channel` varchar(30) NOT NULL COMMENT '支付通道',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8mb4 COMMENT='交易流水表';

-- ----------------------------
-- Table structure for 支付宝流水表
-- ----------------------------
DROP TABLE IF EXISTS `yb_transaction_alipay`;
CREATE TABLE `yb_transaction_alipay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(80) NOT NULL COMMENT '支付订单号',
  `amount` decimal(8,2) NOT NULL COMMENT '流水金额（单位：CNY）',
  `channel` varchar(30) NOT NULL COMMENT '支付通道',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8mb4 COMMENT='支付宝流水表';

-- ----------------------------
-- Table structure for 微信流水表
-- ----------------------------
DROP TABLE IF EXISTS `yb_transaction_wxpay`;
CREATE TABLE `yb_transaction_wxpay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(80) NOT NULL COMMENT '支付订单号',
  `prepay_id` varchar(80) NOT NULL COMMENT '预支付ID',
  `amount` decimal(8,2) NOT NULL COMMENT '流水金额（单位：CNY）',
  `channel` varchar(30) NOT NULL COMMENT '支付通道',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `updatetime` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8mb4 COMMENT='微信流水表';

-- //管理中心


-- ----------------------------
-- Table structure for 菜单表
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_menu`;
CREATE TABLE `yb_admin_menu` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(9) unsigned DEFAULT '0',
  `name` varchar(40) DEFAULT NULL,
  `ico` varchar(20) DEFAULT NULL,
  `level` tinyint(1) unsigned DEFAULT '0',
  `controller` varchar(20) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Records of yb_admin_menu
-- ----------------------------
INSERT INTO `yb_admin_menu` VALUES ('1', '0', '控制台', 'linecons-cog', '0', 'Index', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('2', '0', '系统设置', 'linecons-desktop', '0', '', null, '0', null);
INSERT INTO `yb_admin_menu` VALUES ('3', '2', '员工管理', null, '1', 'User', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('4', '0', '仓库作业', 'linecons-tag', '0', null, null, '0', null);
INSERT INTO `yb_admin_menu` VALUES ('5', '4', '入库管理', null, '1', 'Instorage', 'index', '0', '5');
INSERT INTO `yb_admin_menu` VALUES ('6', '4', '出库管理', null, '1', 'Outstorage', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('7', '4', '查询管理', null, '1', 'Product', 'lists', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('8', '0', '基本设置', 'linecons-cog', '0', null, null, '0', null);
INSERT INTO `yb_admin_menu` VALUES ('9', '8', '仓库管理', null, '1', 'Storage', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('10', '8', '库位管理', null, '1', 'Location', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('11', '8', '供应商管理', null, '1', 'Supplier', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('12', '8', '客户管理', null, '1', 'Customer', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('13', '8', '计量单位', null, '1', 'Unit', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('14', '8', '产品类别', null, '1', 'Category', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('15', '8', '产品管理', null, '1', 'Product', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('16', '2', '角色管理', null, '1', 'Role', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('17', '8', '企业管理', null, '1', 'Company', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('18', '8', '货架管理', null, '1', 'Shelve', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('19', '8', '货位管理', null, '1', 'Position', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('20', '0', '订单管理', 'linecons-note', '0', '', null, '0', null);
INSERT INTO `yb_admin_menu` VALUES ('21', '20', '订单查询', null, '1', 'Order', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('22', '20', '订单导入', null, '1', 'Order', 'import', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('23', '4', '货物上架', null, '1', 'Goodtop', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('24', '4', '调度管理', null, '1', 'Allot', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('25', '26', '理货管理', null, '1', 'Pack', 'index', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('26', '0', '发货管理', 'linecons-doc', '0', null, null, '0', null);
INSERT INTO `yb_admin_menu` VALUES ('27', '26', '理货任务', null, '1', 'Pack', 'send', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('28', '20', '拣货管理', null, '1', 'Pack', 'pack', '0', null);
INSERT INTO `yb_admin_menu` VALUES ('29', '20', '理货包装', null, '1', 'Pack', 'arrange', '0', null);
