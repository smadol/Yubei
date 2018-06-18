/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yubei

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-18 23:36:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yb_admin
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin`;
CREATE TABLE `yb_admin` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `sn` varchar(255) NOT NULL COMMENT '管理编号',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `truename` varchar(80) DEFAULT NULL,
  `password` varchar(32) NOT NULL COMMENT '密码',
  `phone` varchar(12) DEFAULT NULL COMMENT '手机号',
  `eamil` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0:正常 1:禁用',
  `role` mediumint(10) unsigned DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of yb_admin
-- ----------------------------
INSERT INTO `yb_admin` VALUES ('1', '18060611291287917', 'admin', '超级管理员', '21232f297a57a5a743894a0e4a801fc3', '18078687485', '1078509454@qq.com', '1', '1', '1515908045', '1515908045');

-- ----------------------------
-- Table structure for yb_admin_menu
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='菜单';

-- ----------------------------
-- Records of yb_admin_menu
-- ----------------------------
INSERT INTO `yb_admin_menu` VALUES ('1', '0', '控制台', 'linecons-cog', '0', 'Index', 'index', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('2', '0', '系统设置', 'linecons-desktop', '0', '', null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('3', '2', '管理员管理', null, '1', 'User', 'index', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('4', '0', '交易管理', 'linecons-tag', '0', null, null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('6', '4', '交易订单', null, '1', 'Order', 'index', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('7', '4', '退款订单', null, '1', 'Order', 'refund', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('8', '0', '支付设置', 'linecons-beaker', '0', '', '', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('9', '8', '渠道管理', null, '1', 'Channel', 'index', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('10', '8', '服务商', null, '1', 'Channel', 'b', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('11', '0', '商户管理', 'linecons-globe', '0', '', null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('12', '11', '商户列表', null, '1', 'Customer', 'index', '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('13', '11', '商户账户', null, '1', null, null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('14', '0', '结算管理', 'linecons-fire', '0', null, null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('15', '14', '结算列表', null, '1', null, null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('16', '14', '待结算列表', null, '1', null, null, '0', '1528095052', '1528095052');
INSERT INTO `yb_admin_menu` VALUES ('17', '2', '角色管理', null, '1', 'User', 'role', '0', '1528095052', '1528095052');

-- ----------------------------
-- Table structure for yb_admin_role
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='权限表';

-- ----------------------------
-- Records of yb_admin_role
-- ----------------------------
INSERT INTO `yb_admin_role` VALUES ('1', '系统管理员', '1,2,3,4,5,6,7,8,9', '1', '至高无上 管理员', '1528095052', '1528095052');
INSERT INTO `yb_admin_role` VALUES ('2', '订单审计', null, '1', '', '1528095052', '1528095052');

-- ----------------------------
-- Table structure for yb_api
-- ----------------------------
DROP TABLE IF EXISTS `yb_api`;
CREATE TABLE `yb_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '商户id',
  `domain` varchar(100) NOT NULL COMMENT '商户验证域名',
  `key` varchar(32) NOT NULL COMMENT '商户数据安全密钥MD5',
  `secretkey` varchar(2048) DEFAULT NULL,
  `role` int(4) NOT NULL COMMENT '角色1-普通商户,角色2-特约商户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户API状态,0-禁用,1-锁,2-正常',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_domain_unique` (`domain`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Records of yb_api
-- ----------------------------
INSERT INTO `yb_api` VALUES ('10001', '100001', 'sirhe.cn', '984423e02a22f79457111e84a3dcd369', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApsxaPoX0IdATmPF4YZDj/8TZbLpu7kO714I1ROf+yXLBpNQrAay6N02FG00nvrFaEF8ARTIyYVu4sr/n8U0iPF1AbZb75MY3MUX5KAt5Djvxrd2tVGASn6dbragczFsAMgJ8kDCKna8RskqfUKtaY+yBnVEsJkyS1PwPPu7DqAaPB4dYC9ugyBBs9X1x4X5+pFF1FAAWoxu31CDgpSSjQrTD427EgwPa+jJLGZWEVvvDvRlkh+xbkpumM2SCEMDDGXM7mWgdD9npSVUsin18JOEla8FO/VCf75NV7IcSbOMsensMrCVJOb8GKdwX1AvR+9IGhsMk8AKCuKLH9hbt+QIDAQAB', '1', '1', '0', '1528863449');

-- ----------------------------
-- Table structure for yb_asset
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
) ENGINE=InnoDB AUTO_INCREMENT=10000002 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产表';

-- ----------------------------
-- Records of yb_asset
-- ----------------------------
INSERT INTO `yb_asset` VALUES ('10000001', '100001', '6.00', '100.00', '13333.00', '1528176462', '1528176462');

-- ----------------------------
-- Table structure for yb_asset_cash
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset_cash`;
CREATE TABLE `yb_asset_cash` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '取现记录单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '取现金额',
  `account` varchar(255) NOT NULL COMMENT '取现账户',
  `remarks` varchar(255) NOT NULL COMMENT '取现说明',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '取现状态',
  `create_time` int(10) NOT NULL COMMENT '申请时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000005 DEFAULT CHARSET=utf8mb4 COMMENT='取现记录';

-- ----------------------------
-- Records of yb_asset_cash
-- ----------------------------
INSERT INTO `yb_asset_cash` VALUES ('10000001', '100001', '201806051327426945', '100.00', '100001', '201806051354取现', '1', '0', '0');
INSERT INTO `yb_asset_cash` VALUES ('10000002', '100001', '201806051357479057', '100.00', '10001', '提现', '1', '1528178267', '1528178267');
INSERT INTO `yb_asset_cash` VALUES ('10000003', '100001', '201806051400458230', '1000.00', '10001', '提现', '1', '1528178445', '1528178445');
INSERT INTO `yb_asset_cash` VALUES ('10000004', '100001', '201806051519308369', '986550.00', '10001', '提现', '1', '1528183170', '1528183170');

-- ----------------------------
-- Table structure for yb_asset_change
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
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000012 DEFAULT CHARSET=utf8mb4 COMMENT='商户资产变动记录表';

-- ----------------------------
-- Records of yb_asset_change
-- ----------------------------
INSERT INTO `yb_asset_change` VALUES ('1000001', '100001', 'A20180603151730000365', '1120.00', '0.00', '100.00', '1020.00', '提现', '1528010712', '1528010712');
INSERT INTO `yb_asset_change` VALUES ('1000002', '100001', 'A20180603151730000366', '1020.00', '0.00', '100.00', '920.00', '提现', '1528010712', '1528010712');
INSERT INTO `yb_asset_change` VALUES ('1000003', '100001', 'A20180603151730000367', '920.00', '0.00', '100.00', '820.00', '提现', '1528010712', '1528010712');
INSERT INTO `yb_asset_change` VALUES ('1000004', '100001', '201806051241073105', '1080.00', '0.00', '100.00', '980.00', '提现', '1528010712', '1528010712');
INSERT INTO `yb_asset_change` VALUES ('1000005', '100001', '201806051242031030', '999980.00', '0.00', '10000.00', '989980.00', '提现', '1528010712', '1528010712');
INSERT INTO `yb_asset_change` VALUES ('1000006', '100001', '201806051327211331', '989880.00', '0.00', '100.00', '989780.00', '提现', '1528176441', '1528176441');
INSERT INTO `yb_asset_change` VALUES ('1000007', '100001', '201806051327426945', '989780.00', '0.00', '2222.00', '987558.00', '提现', '1528176462', '1528176462');
INSERT INTO `yb_asset_change` VALUES ('1000008', '100001', '201806051357476193', '987558.00', '0.00', '100.00', '987458.00', '提现', '1528178267', '1528178267');
INSERT INTO `yb_asset_change` VALUES ('1000009', '100001', '201806051400459118', '987458.00', '0.00', '1000.00', '986458.00', '提现', '1528178445', '1528178445');
INSERT INTO `yb_asset_change` VALUES ('1000010', '100001', '201806051400459896', '986458.00', '98.00', '0.00', '986556.00', '平台日结', '1528178445', '1528178445');
INSERT INTO `yb_asset_change` VALUES ('1000011', '100001', '201806051519307016', '986556.00', '0.00', '986550.00', '6.00', '提现', '1528183170', '1528183170');

-- ----------------------------
-- Table structure for yb_asset_settle
-- ----------------------------
DROP TABLE IF EXISTS `yb_asset_settle`;
CREATE TABLE `yb_asset_settle` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `assets_no` varchar(80) NOT NULL COMMENT '结算记录单号',
  `order_no` varchar(80) NOT NULL COMMENT '结算订单单号',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `fee` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '费率金额',
  `actual` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '入账金额',
  `remarks` varchar(255) NOT NULL COMMENT '结算说明',
  `create_time` int(10) NOT NULL COMMENT '结算时间',
  `update_time` int(10) NOT NULL COMMENT '处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000002 DEFAULT CHARSET=utf8mb4 COMMENT='结算记录';

-- ----------------------------
-- Records of yb_asset_settle
-- ----------------------------
INSERT INTO `yb_asset_settle` VALUES ('1000001', '100001', '201806051327426945', 'A20180604145052604733', '100.00', '2.00', '98.00', '结算', '1528095052', '1528095052');

-- ----------------------------
-- Table structure for yb_channel
-- ----------------------------
DROP TABLE IF EXISTS `yb_channel`;
CREATE TABLE `yb_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '渠道ID',
  `sn` varchar(20) NOT NULL DEFAULT '800' COMMENT '支付渠道编号',
  `channel` varchar(30) NOT NULL COMMENT '渠道名称,如:alipay,wechat',
  `param` varchar(4096) NOT NULL COMMENT '配置参数,json字符串',
  `rate` decimal(20,3) NOT NULL DEFAULT '0.010' COMMENT '渠道费率',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '渠道状态,0-停止使用,1-开放使用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='交易渠道表';

-- ----------------------------
-- Records of yb_channel
-- ----------------------------
INSERT INTO `yb_channel` VALUES ('1', '800', '官方微信支付', '', '0.010', 'XXX微信支付商', '1', '1528095052', '1528095052');
INSERT INTO `yb_channel` VALUES ('2', '801', '微信扫码支付一', '{\"appid\":\"wx1c32cda245563ee1\",\"key\":\"06c56a89949d617def52f371c357b6db\"}', '0.012', 'wx1c32cda245563ee1', '1', '1528095052', '1528095052');
INSERT INTO `yb_channel` VALUES ('3', '802', 'QQ扫码支付一', '{\"appid\":\"1499660101\",\"key\":\"a50e731409bada470b8f2d50b254e62a\"}', '0.012', 'QQ扫码支付1499660101', '1', '1528095052', '1528095052');
INSERT INTO `yb_channel` VALUES ('4', '903', '支付宝网关', '{\"appid\":\"1499660101\",\"key\":\"1499660101\"}', '0.012', '支付宝网关', '1', '1528536792', '1528536792');
INSERT INTO `yb_channel` VALUES ('5', '904', '支付宝一', '{\"appid\":\"2018030402313504\",\"private_key\":\"MIIEowIBAAKCAQEAp7f6gGT8GXS2glJ48hOdj6FgRKTTFzqho9IMxIlfcIpieQ4NO3jyl36tRxSQUtt8pUp85Z9v6\\/fqI1bt7dq4NPdero14dXgzL3XZt18QPAVntosqEjyI0QgiZZg3oXnh4fEgDwln+NFs8T\\/Ni\\/BDHMwzpuRpnNdglr6167kRj1frxjLWGUAgo3gmKQgZiVOmeFGNWEJ3vlB6nhfIrQOi2p+nPbPLOQKyUiJeGKh1aR3qGtFrUUpIYasizx3Kg\\/xdxMISzMSVOqDIxeVCB9FWSJXr9Ws6uErmpBI7lXmaAs3144Ie5rqRbKslMriJ3ovdaLlmTlXDxjbTR\\/AGsKu3XQIDAQABAoIBABX2a6FAmBqlQ\\/kQ37Gji\\/BxC3AxvUq\\/bMdNDEr4Sj0sgfSkOGtfTTU1a29xa+zNvSbP+EcBd+CImGqESafqClE1S3rEH9ASK3G9lwMCOdgCRTCMTLgSoT\\/uNsLjCfXlRgUWVEJj0u+sTP3SgxIeJkuxGdpy8rmNIqLa2mvB0mDYxiytOVyMO+J8amaTbz\\/MllRxa+iAxIbd\\/M12rrV3vvEYUgitvK4uXER62MZMyIvOW6Cf+CLfOq3Tsp+M1Jve4ox\\/xJOrg1815e9\\/\\/+7hHcujjCo5XiG+u1rVyH+Tr\\/Qs6Rdk+CVgBiZ\\/YqWMSdFUBkUIYCKazzeVkzCkx0eJYIECgYEA3bIM0H7kCwfAHiWm5EGXEW8qoSTqc8bZMG5S6D2BuMTTVixRcfDTJlt2daKfxLRsU1ijrG6EVKaLblrBOFVJb1WYrgxgKkoUHIUqNwGMnTTe3dj8w2uA5\\/IUYcqmzwO5Rb49mc\\/1ATzzMqn2kUck5Vts9i8DpJUe0PLYJ7VkT5ECgYEAwavDC5NkPrE\\/QOYmvy1Aqj5vhKIr5W6IEGSGDMIfZ2e7o08URfRkc5jprZozcOl3MuseCE1I6ysIyDlvHtbV0eAl128xUWI5HXIC8zGrYJQ95Fsl2Xd6yymEC6CUKgnae2WyyOls3QM56XAmZbh1W+QN8Hsb5X0yLTii8LDsXQ0CgYB6AzVERqHxZCmbLfPFKkgfY0Rd\\/fg\\/EhCUtBNTGA7eBw2dHrUQdY9wS+RNZ9xwoTABSwaBry2LfUG90ZsICwBokv59w\\/flLnIVJEEQlvyxxNhn1rV+RBtlDHmlPKhDxPPh64rxrV9VeBsNJje6yyIGTSQR9dwWZ6\\/XJeBLMmzr0QKBgQC0uXeVAcF1zyjbgul9VNkXBJREDKExw+cshOGiXjO35tDuIAknDlv+kx7cZRzDrNkSptyrmpMFAG99iDrtaES3SJeHZbd73lC17YJbNmpaAXuP8I5tVFU96EvUHdClOfSrWcdwPILd6vjLoV\\/zZCH\\/0dxAIGFz0VRVZpiGSlMGsQKBgET9vKqOSvI88W8\\/Ve3YGOoXQ5qjrm5JqbL\\/J8f4GiOoDrBfaYij2Yg2WZlaPWi5t1KXh8IsN\\/Yn6NenY8CiI5hQZi\\/0CQM5ICEZmCnX3U1QdpffGzAbd\\/tb4ldmA3ez3cYNPzIP3q1bUQ3ybwO2eD8N978mHXBokoO0AHh01thZ\",\"public_key\":\"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAix0lmphMY4htd8sw6kLMBGyju6p2y4pQtmiUpk7KxIV2NaUj0Zve2WJvPDptbKB0Lmn3EksPVG8VCrlh97shKjerm0gW314YN1DY\\/7RFPqxeeYNIFaMiGgf1ecMZUAOwO\\/v8NKn2nKH5hA0eMFxXNTtAXfSY\\/UBBnMFWOd765uQsXNn6r0PjhIpC2T9Hk+KfVm2eQ3QqY82\\/s0SaeebN\\/xjbkTsAc6yKGPCJxbe2vyE5coQ8iCj4pVvlFX6+SO+lEFvB56r8H+dQlDixPGgEGz+PZkUny7SZjFBZm5amH6XEl40ac9iWuuaW2C28FMoHX6XjJgu95aZMeVa5ZCrqmQIDAQAB\"}', '0.120', '支付宝一', '1', '1528537258', '1528537258');

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
) ENGINE=InnoDB AUTO_INCREMENT=10004 DEFAULT CHARSET=utf8mb4 COMMENT='公告表';

-- ----------------------------
-- Records of yb_notice
-- ----------------------------
INSERT INTO `yb_notice` VALUES ('10001', '我是公告内容一', '1', '0', '0');
INSERT INTO `yb_notice` VALUES ('10002', '我是公告内容二', '1', '0', '0');
INSERT INTO `yb_notice` VALUES ('10003', '客服：QQ702154416', '1', '0', '0');

-- ----------------------------
-- Table structure for yb_pay_order
-- ----------------------------
DROP TABLE IF EXISTS `yb_pay_order`;
CREATE TABLE `yb_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '商户id',
  `trade_no` varchar(80) NOT NULL COMMENT '交易订单号',
  `out_trade_no` varchar(80) NOT NULL COMMENT '商户订单号',
  `subject` varchar(64) NOT NULL COMMENT '商品标题',
  `body` varchar(256) NOT NULL COMMENT '商品描述信息',
  `channel` varchar(30) NOT NULL COMMENT '交易渠道',
  `extra` varchar(512) DEFAULT NULL COMMENT '特定渠道发起时额外参数',
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
) ENGINE=InnoDB AUTO_INCREMENT=100000042 DEFAULT CHARSET=utf8mb4 COMMENT='交易订单表';

-- ----------------------------
-- Records of yb_pay_order
-- ----------------------------
INSERT INTO `yb_pay_order` VALUES ('100000005', '100001', 'A2018060315022260396', '2147483647', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009342', '1528009342');
INSERT INTO `yb_pay_order` VALUES ('100000009', '100001', 'A2018060315070760357', '2147483647', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009627', '1528009627');
INSERT INTO `yb_pay_order` VALUES ('100000010', '100001', 'A20180603150753603787', '2147483647', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009673', '1528009673');
INSERT INTO `yb_pay_order` VALUES ('100000011', '100001', 'A20180603150906603499', '2147483647', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009746', '1528009746');
INSERT INTO `yb_pay_order` VALUES ('100000012', '100001', 'A20180603150956603178', '201806030709542896', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009796', '1528009796');
INSERT INTO `yb_pay_order` VALUES ('100000013', '100001', 'A2018060315111060370', '201806030711077254', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009870', '1528009870');
INSERT INTO `yb_pay_order` VALUES ('100000014', '100001', 'A20180603151211603106', '201806030712091163', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009931', '1528009931');
INSERT INTO `yb_pay_order` VALUES ('100000015', '100001', 'A20180603151314603411', '201806030713124738', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528009994', '1528009994');
INSERT INTO `yb_pay_order` VALUES ('100000016', '100001', 'A20180603151355603557', '201806030713523373', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528010035', '1528010035');
INSERT INTO `yb_pay_order` VALUES ('100000017', '100001', 'A20180603151610603786', '201806030716084159', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528010170', '1528010170');
INSERT INTO `yb_pay_order` VALUES ('100000018', '100001', 'A2018060315173060342', '201806030717274242', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '1000.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528010250', '1528010250');
INSERT INTO `yb_pay_order` VALUES ('100000019', '100001', 'A20180603152050603639', '201806030720458425', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '2000.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528010450', '1528010450');
INSERT INTO `yb_pay_order` VALUES ('100000020', '100001', 'A20180603152512603715', '201806030725091136', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528010712', '1528010712');
INSERT INTO `yb_pay_order` VALUES ('100000021', '100001', 'A20180603153807603204', '201806030738047659', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528011487', '1528011487');
INSERT INTO `yb_pay_order` VALUES ('100000022', '100001', 'A20180603153855603517', '201806030738541086', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528011535', '1528011535');
INSERT INTO `yb_pay_order` VALUES ('100000023', '100001', 'A20180603155148603654', '201806030751472618', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528012308', '1528012308');
INSERT INTO `yb_pay_order` VALUES ('100000024', '100001', 'A20180603155227603406', '201806030752268691', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528012347', '1528012347');
INSERT INTO `yb_pay_order` VALUES ('100000025', '100001', 'A20180603155535603769', '201806030755338545', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528012535', '1528012535');
INSERT INTO `yb_pay_order` VALUES ('100000026', '100001', 'A20180603155549603845', '201806030755485707', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528012549', '1528012549');
INSERT INTO `yb_pay_order` VALUES ('100000027', '100001', 'A20180603155605603703', '201806030756048360', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '2', '1528012565', '1528012565');
INSERT INTO `yb_pay_order` VALUES ('100000028', '100001', 'A20180603162716603618', '201806030827111783', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '1000.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528014436', '1528014436');
INSERT INTO `yb_pay_order` VALUES ('100000029', '100001', 'A20180603180326603679', '201806031003241024', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528020206', '1528020206');
INSERT INTO `yb_pay_order` VALUES ('100000030', '100001', 'A20180603181014603188', '201806031003505565', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528020614', '1528020614');
INSERT INTO `yb_pay_order` VALUES ('100000031', '100001', 'A20180604145052604733', '201806040650482594', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528095052', '1528095052');
INSERT INTO `yb_pay_order` VALUES ('100000032', '100001', 'A20180605193353605759', '201806051133484651', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528198433', '1528198433');
INSERT INTO `yb_pay_order` VALUES ('100000033', '100001', 'A20180605210654605162', '201806051306501558', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528204014', '1528204014');
INSERT INTO `yb_pay_order` VALUES ('100000034', '100001', 'A2018060521073760596', '201806051307364460', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528204057', '1528204057');
INSERT INTO `yb_pay_order` VALUES ('100000035', '100001', 'A20180605210749605412', '201806051307481007', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528204069', '1528204069');
INSERT INTO `yb_pay_order` VALUES ('100000036', '100001', 'A20180606164503606906', '201806060844592825', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1528274703', '1528274703');
INSERT INTO `yb_pay_order` VALUES ('100000037', '100001', 'A20180618224459618739', '201806182244556490', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1529333099', '1529333099');
INSERT INTO `yb_pay_order` VALUES ('100000038', '100001', 'A20180618224622618817', '201806182246211395', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1529333182', '1529333182');
INSERT INTO `yb_pay_order` VALUES ('100000039', '100001', 'A20180618225755618188', '201806182257408663', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1529333875', '1529333875');
INSERT INTO `yb_pay_order` VALUES ('100000040', '100001', 'A20180618225825618687', '201806182258246021', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1529333905', '1529333905');
INSERT INTO `yb_pay_order` VALUES ('100000041', '100001', 'A20180618230955618108', '201806182309491301', '支付测试', '支付测试', 'WXPAY', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '10000.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1529334595', '1529334595');

-- ----------------------------
-- Table structure for yb_transaction
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='交易流水表';

-- ----------------------------
-- Records of yb_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for yb_user
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
) ENGINE=InnoDB AUTO_INCREMENT=100002 DEFAULT CHARSET=utf8mb4 COMMENT='商户信息表';

-- ----------------------------
-- Records of yb_user
-- ----------------------------
INSERT INTO `yb_user` VALUES ('100001', '1078509454@qq.com', 'MGEyYTk1YjkxNGQ1YWQ1ZDA4YjI2YThlMTc1Yjg1Mzk=', '许大大', '18078687485', '1', '1528095052', '1528095052');

-- ----------------------------
-- Table structure for yb_user_account
-- ----------------------------
DROP TABLE IF EXISTS `yb_user_account`;
CREATE TABLE `yb_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(40) NOT NULL COMMENT '商户ID',
  `bank` varchar(250) NOT NULL COMMENT '开户行',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `account` varchar(250) NOT NULL COMMENT '开户号',
  `remarks` varchar(250) NOT NULL COMMENT '备注',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10004 DEFAULT CHARSET=utf8mb4 COMMENT='结算账户表';

-- ----------------------------
-- Records of yb_user_account
-- ----------------------------
INSERT INTO `yb_user_account` VALUES ('10001', '100001', 'wxpay', '许祖兴', '18377670545', '微信支付', '1528095052', '1528095052');
INSERT INTO `yb_user_account` VALUES ('10002', '100001', 'alipay', '许祖兴', '18377670545', '支付宝支付', '1528095052', '1528095052');
INSERT INTO `yb_user_account` VALUES ('10003', '100001', 'alipay', '许祖兴', '18088986363', '支付宝', '1528183701', '1528183701');
