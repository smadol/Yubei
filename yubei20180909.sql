/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yubei

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-09 13:02:14
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
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员信息';

-- ----------------------------
-- Table structure for yb_admin_menu
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
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Records of yb_admin_menu
-- ----------------------------
INSERT INTO `yb_admin_menu` VALUES ('1', '0', '控制台', '&#xe604;', '0', 'Index', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('2', '0', '系统设置', '&#xe60b;', '0', null, null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('3', '2', '菜单管理', null, '1', 'Menu', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('4', '2', '安全管理', '', '1', 'Safe', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('5', '0', '支付管理', '&#xe600;', '0', '', null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('6', '5', '渠道管理', null, '1', 'Channel', 'index', '1', '5');
INSERT INTO `yb_admin_menu` VALUES ('7', '5', '风控管理', null, '1', 'Channel', 'risk ', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('8', '0', '内容管理', '&#xe602;', '0', '', null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('9', '8', '文章管理', null, '1', 'Article', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('10', '8', '公告管理', null, '1', 'Article', 'notice', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('11', '0', '商户管理', '&#xe606;', '0', '', '', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('12', '11', '商户列表', null, '1', 'User', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('13', '11', '商户提现', null, '1', 'User', 'cash', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('14', '11', '付款记录', null, '1', 'User', 'paid', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('15', '0', '订单管理', '&#xe608;', '0', '', null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('16', '15', '订单列表', null, '1', 'Orders', 'index', '1', null);
INSERT INTO `yb_admin_menu` VALUES ('17', '15', '退款列表', null, '1', null, null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('18', '15', '待结列表', null, '1', null, null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('19', '15', '商户统计', null, '1', null, null, '1', null);
INSERT INTO `yb_admin_menu` VALUES ('20', '15', '渠道统计', null, '1', null, null, '1', null);

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
-- Records of yb_api
-- ----------------------------
INSERT INTO `yb_api` VALUES ('10001', '100001', '575e16d64580c38e8a071009c21e30d0', '余呗', 'https://api.yubei.cn', '5000', 'MIIEpAIBAAKCAQEApsxaPoX0IdATmPF4YZDj/8TZbLpu7kO714I1ROf+yXLBpNQrAay6N02FG00nvrFaEF8ARTIyYVu4sr/n8U0iPF1AbZb75MY3MUX5KAt5Djvxrd2tVGASn6dbragczFsAMgJ8kDCKna8RskqfUKtaY+yBnVEsJkyS1PwPPu7DqAaPB4dYC9ugyBBs9X1x4X5+pFF1FAAWoxu31CDgpSSjQrTD427EgwPa+jJLGZWEVvvDvRlkh+xbkpumM2SCEMDDGXM7mWgdD9npSVUsin18JOEla8FO/VCf75NV7IcSbOMsensMrCVJOb8GKdwX1AvR+9IGhsMk8AKCuKLH9hbt+QIDAQABAoIBAGF0VmnfdCNpYnni49YFhOFEj1CSoQu/MXoaDqui7N+gl/mJKVOCKw7y0QmBi+5Dyv5zs0G6sWrm30Q5EfiPe6hPR7yAEc657TdxzcCS63jglzVhpsr8kwULEGqnJaRUqwmNIGBSrDqzNiC4rtrAM0Dcx2I2MhhydvvQBcxcTp7VvI/lXD/7yzoOu/8Q7Ob655ZshlX2BwFX9GGTyGMV10v2j4In+fdy8kVAQi6++43aCtZYo5Zg8Yy4FLGZhz1qK9a1JmVAwxHHGlqQXmi0DvAT6rxx1ISR8ACgR+GLj/EqsayMLd5/se/o65QphBoSZ9nGX8P4wfzaxfh42Sh3s20CgYEA1fr1VSoojcFrEuhU6qMM5icmvYSpe25/l/jh5pSHmDZUO+eW0CjGCD1r1ZTazfwE7xt6PMwMbeoBc5pEtgBfIFxSJlPsRL8tnXO9ICOU1WigskN7FTFKUGH19+rd1qSW+J8RYx7RQDItAl3XfXHi0XWWFLtzNx2zcsjf4UZ3/LsCgYEAx41/MLB6wMe4i79Dr4Metb48y+88GREkjbRmvJCFjBiQ4qLk/1PWVM/dqzDX7TSZFHMsYGNOcv/VGG0NC4LZqU/D+mYs7qKH6X2h/XxfjtHk55C6HyUzj+Kneqz6TOZD4Uf0hTYHsGFtJ1Lrlx3uBZWMqdInoofHZELOD9qmjtsCgYEAzRv1tmDm5pqUbFdPrmoEn0jAFcHoQ2yz2ZSz1TZik0DglVt0cKvkx1k42E4LPo9om1oXXdepwmIgahNh8aOBi59zD1I6k9s9ekPK8depfrb/8mBExxesSEjeYXo8ktbJ8B9ppz2PDp4KDs6tFI3qASVZax4TXq2VqV1rXKETuqkCgYA3ydUvNYd78dokJ5qyrMOfJ8ozcXSpxWMkwrSeLwFHA28uDUBcKYIYP+zG+WbEiBnr368eW2UJPYDDzWkCONjFPumZTYtuQ74fhuIMzgKhGQkXvBxsrKfXqBQOdeGcMhv0FXvE6jAIHZS4k7QNkW6D3SVwLLKr+63A1/Rn9kbuVQKBgQCSSrVKVjgS+W2dXRKYcIcuAvp7YHHcYMxzIF+10l1NrrCzyzASEwaLVNHY2/QRMV9YJVIi/TOIO4QBUody3F6rUrQV7owx2c8/8BYd3RFtA8SftIQWmLhgf+WDvl1efC1YrdzbSXc8N4HLF8LLbBmqjpVANNPhoMsEpSDBDlfwhQ==', '1', '1', '1535984045', '1536468938');
INSERT INTO `yb_api` VALUES ('10003', null, null, '', '', '0', '', '0', '0', '1536386076', '1536386076');
INSERT INTO `yb_api` VALUES ('10004', null, null, '', '', '0', '', '0', '0', '1536386132', '1536386132');
INSERT INTO `yb_api` VALUES ('10005', '100013', null, '', '', '0', '', '0', '0', '1536386355', '1536386355');
INSERT INTO `yb_api` VALUES ('10006', '100001', null, '', '', '0', '', '0', '-1', '1536391012', '1536394364');
INSERT INTO `yb_api` VALUES ('10008', '100014', '94f813acad20575603054ff5cfb95cc0', '百度', 'www.baidu.com', '0', '21340a74abb4e5353e665c241f1b70f59a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e39a119fbf90696da26f394f471f91c7e3', '0', '1', '1536393619', '1536394336');

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
-- Records of yb_article
-- ----------------------------
INSERT INTO `yb_article` VALUES ('1', 'admin', '序言', '什么是聚合支付', '&lt;h3 class=&quot;line&quot;&gt;\r\n	ThinkPHP -&amp;gt; OneBase -&amp;gt; 产品\r\n&lt;/h3&gt;\r\n&lt;p&gt;\r\n	OneBase是一个免费开源的，快速、简单的面向对象的应用研发架构，是为了快速研发应用而诞生的。在保持出色的性能和新颖设计思想同时，也注重易用性。遵循Apache2开源许可协议发布，意味着你可以免费使用OneBase，允许把您基于OneBase研发的应用开源或商业产品发布/销售。\r\n&lt;/p&gt;\r\n&lt;hr /&gt;\r\n&lt;h3 class=&quot;line&quot;&gt;\r\n	主要特性\r\n&lt;/h3&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;规范&lt;/strong&gt;： OneBase 提供一套编码规范，可使团队研发协作事半功倍。&lt;br /&gt;\r\n&lt;strong&gt;严谨&lt;/strong&gt;： 异常严谨的错误检测和安全机制，详细的日志信息，为您的研发保驾护航。&lt;br /&gt;\r\n&lt;strong&gt;灵活&lt;/strong&gt;： 分层，服务，插件等合理的解耦合设计使您升级框架或需求变更得心应手。&lt;br /&gt;\r\n&lt;strong&gt;接口&lt;/strong&gt;： 完善的接口研发架构，使您只需关注业务逻辑研发，省心省力。&lt;br /&gt;\r\n&lt;strong&gt;高效&lt;/strong&gt;： 自动缓存设计，抛弃了处处判断的尴尬，使您不知不觉中已经使用了缓存。&lt;br /&gt;\r\n&lt;strong&gt;特色&lt;/strong&gt;： 无限级权限控制，垃圾资源回收，系统通用回收站，SEO变量支持，性能与操作监控，等各种脑洞大开的设计思想。\r\n&lt;/p&gt;\r\n&lt;hr /&gt;\r\n&lt;h3 class=&quot;line&quot;&gt;\r\n	捐赠我们\r\n&lt;/h3&gt;\r\n&lt;p&gt;\r\n	OneBase致力于简化企业和个人应用研发，您的帮助是对我们最大的支持和动力！\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	OneBase团队一直在坚持不懈地努力，并坚持开源和免费提供使用，帮助开发人员更加方便的进行应用快速研发，如果您对我们的成果表示认同并且觉得对您有所帮助我们愿意接受来自各方面的捐赠^_^。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	************ &lt;strong&gt;微信捐赠&lt;/strong&gt; ************************* &lt;strong&gt;支付宝捐赠&lt;/strong&gt; ************\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;https://box.kancloud.cn/6640ec28b9701a85b8a970e53b870da3_265x265.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;https://box.kancloud.cn/b63395ec098a6e3c823825167bd6ffd7_265x265.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n************************* &lt;strong&gt;QQ交流群：477824874&lt;/strong&gt; *********************\r\n&lt;/p&gt;', '0', '0', '', '1', '1536386132', '1536386132');

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
-- Records of yb_balance
-- ----------------------------
INSERT INTO `yb_balance` VALUES ('10000001', '100001', '0.00', '200.00', '10100.00', '1535984045', '1535984045');
INSERT INTO `yb_balance` VALUES ('10000002', '100013', '0.00', '0.00', '0.00', '1535984045', '1535984045');
INSERT INTO `yb_balance` VALUES ('10000003', '100001', '0.00', '0.00', '0.00', '0', '0');
INSERT INTO `yb_balance` VALUES ('10000004', '100001', '0.00', '0.00', '0.00', '0', '0');
INSERT INTO `yb_balance` VALUES ('10000005', '100014', '0.00', '0.00', '0.00', '0', '0');

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
-- Records of yb_balance_cash
-- ----------------------------

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
-- Records of yb_balance_change
-- ----------------------------

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
-- Records of yb_balance_settle
-- ----------------------------

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
-- Records of yb_bank
-- ----------------------------
INSERT INTO `yb_bank` VALUES ('10001', '支付宝', '支付宝即时到账', '1', '1', '1535983287', '1535983287');
INSERT INTO `yb_bank` VALUES ('10002', '工商银行', '工商银行两小时到账', '0', '1', '1535983287', '1535983287');
INSERT INTO `yb_bank` VALUES ('10003', '农业银行', '农业银行两小时到账', '0', '1', '1535983287', '1535983287');

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
) ENGINE=InnoDB AUTO_INCREMENT=100006 DEFAULT CHARSET=utf8mb4 COMMENT='交易渠道表';

-- ----------------------------
-- Records of yb_channel
-- ----------------------------
INSERT INTO `yb_channel` VALUES ('100001', 'wx_scan', '0.060', '20000.00', '{\"mchid\":\"1493758822\",\"appid\":\"wx1c32cda245563ee1\",\"key\":\"06c56a89949d617def52f371c357b6db\"}', '微信支付', '1', '1535983487', '1536468893');
INSERT INTO `yb_channel` VALUES ('100002', 'ali_web', '0.060', '20000.00', '{\"appid\":\"2018030402313504\",\"private_key\":\"MIIEowIBAAKCAQEAp7f6gGT8GXS2glJ48hOdj6FgRKTTFzqho9IMxIlfcIpieQ4NO3jyl36tRxSQUtt8pUp85Z9v6/fqI1bt7dq4NPdero14dXgzL3XZt18QPAVntosqEjyI0QgiZZg3oXnh4fEgDwln+NFs8T/Ni/BDHMwzpuRpnNdglr6167kRj1frxjLWGUAgo3gmKQgZiVOmeFGNWEJ3vlB6nhfIrQOi2p+nPbPLOQKyUiJeGKh1aR3qGtFrUUpIYasizx3Kg/xdxMISzMSVOqDIxeVCB9FWSJXr9Ws6uErmpBI7lXmaAs3144Ie5rqRbKslMriJ3ovdaLlmTlXDxjbTR/AGsKu3XQIDAQABAoIBABX2a6FAmBqlQ/kQ37Gji/BxC3AxvUq/bMdNDEr4Sj0sgfSkOGtfTTU1a29xa+zNvSbP+EcBd+CImGqESafqClE1S3rEH9ASK3G9lwMCOdgCRTCMTLgSoT/uNsLjCfXlRgUWVEJj0u+sTP3SgxIeJkuxGdpy8rmNIqLa2mvB0mDYxiytOVyMO+J8amaTbz/MllRxa+iAxIbd/M12rrV3vvEYUgitvK4uXER62MZMyIvOW6Cf+CLfOq3Tsp+M1Jve4ox/xJOrg1815e9//+7hHcujjCo5XiG+u1rVyH+Tr/Qs6Rdk+CVgBiZ/YqWMSdFUBkUIYCKazzeVkzCkx0eJYIECgYEA3bIM0H7kCwfAHiWm5EGXEW8qoSTqc8bZMG5S6D2BuMTTVixRcfDTJlt2daKfxLRsU1ijrG6EVKaLblrBOFVJb1WYrgxgKkoUHIUqNwGMnTTe3dj8w2uA5/IUYcqmzwO5Rb49mc/1ATzzMqn2kUck5Vts9i8DpJUe0PLYJ7VkT5ECgYEAwavDC5NkPrE/QOYmvy1Aqj5vhKIr5W6IEGSGDMIfZ2e7o08URfRkc5jprZozcOl3MuseCE1I6ysIyDlvHtbV0eAl128xUWI5HXIC8zGrYJQ95Fsl2Xd6yymEC6CUKgnae2WyyOls3QM56XAmZbh1W+QN8Hsb5X0yLTii8LDsXQ0CgYB6AzVERqHxZCmbLfPFKkgfY0Rd/fg/EhCUtBNTGA7eBw2dHrUQdY9wS+RNZ9xwoTABSwaBry2LfUG90ZsICwBokv59w/flLnIVJEEQlvyxxNhn1rV+RBtlDHmlPKhDxPPh64rxrV9VeBsNJje6yyIGTSQR9dwWZ6/XJeBLMmzr0QKBgQC0uXeVAcF1zyjbgul9VNkXBJREDKExw+cshOGiXjO35tDuIAknDlv+kx7cZRzDrNkSptyrmpMFAG99iDrtaES3SJeHZbd73lC17YJbNmpaAXuP8I5tVFU96EvUHdClOfSrWcdwPILd6vjLoV/zZCH/0dxAIGFz0VRVZpiGSlMGsQKBgET9vKqOSvI88W8/Ve3YGOoXQ5qjrm5JqbL/J8f4GiOoDrBfaYij2Yg2WZlaPWi5t1KXh8IsN/Yn6NenY8CiI5hQZi/0CQM5ICEZmCnX3U1QdpffGzAbd/tb4ldmA3ez3cYNPzIP3q1bUQ3ybwO2eD8N978mHXBokoO0AHh01thZ\",\"public_key\":\"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAix0lmphMY4htd8sw6kLMBGyju6p2y4pQtmiUpk7KxIV2NaUj0Zve2WJvPDptbKB0Lmn3EksPVG8VCrlh97shKjerm0gW314YN1DY/7RFPqxeeYNIFaMiGgf1ecMZUAOwO/v8NKn2nKH5hA0eMFxXNTtAXfSY/UBBnMFWOd765uQsXNn6r0PjhIpC2T9Hk+KfVm2eQ3QqY82/s0SaeebN/xjbkTsAc6yKGPCJxbe2vyE5coQ8iCj4pVvlFX6+SO+lEFvB56r8H+dQlDixPGgEGz+PZkUny7SZjFBZm5amH6XEl40ac9iWuuaW2C28FMoHX6XjJgu95aZMeVa5ZCrqmQIDAQAB\"}', '支付宝web支付', '1', '1535983487', '1536413944');
INSERT INTO `yb_channel` VALUES ('100003', 'wx_scan', '0.060', '20000.00', '{\"mchid\":\"1493758822\",\"appid\":\"wx1c32cda245563ee1\",\"key\":\"06c56a89949d617def52f371c357b6db\"}', '微信支付', '1', '1535983487', '1536413843');
INSERT INTO `yb_channel` VALUES ('100004', 'ali_wap', '0.060', '20000.00', '{\"appid\":\"2018030402313504\",\"private_key\":\"MIIEowIBAAKCAQEAp7f6gGT8GXS2glJ48hOdj6FgRKTTFzqho9IMxIlfcIpieQ4NO3jyl36tRxSQUtt8pUp85Z9v6/fqI1bt7dq4NPdero14dXgzL3XZt18QPAVntosqEjyI0QgiZZg3oXnh4fEgDwln+NFs8T/Ni/BDHMwzpuRpnNdglr6167kRj1frxjLWGUAgo3gmKQgZiVOmeFGNWEJ3vlB6nhfIrQOi2p+nPbPLOQKyUiJeGKh1aR3qGtFrUUpIYasizx3Kg/xdxMISzMSVOqDIxeVCB9FWSJXr9Ws6uErmpBI7lXmaAs3144Ie5rqRbKslMriJ3ovdaLlmTlXDxjbTR/AGsKu3XQIDAQABAoIBABX2a6FAmBqlQ/kQ37Gji/BxC3AxvUq/bMdNDEr4Sj0sgfSkOGtfTTU1a29xa+zNvSbP+EcBd+CImGqESafqClE1S3rEH9ASK3G9lwMCOdgCRTCMTLgSoT/uNsLjCfXlRgUWVEJj0u+sTP3SgxIeJkuxGdpy8rmNIqLa2mvB0mDYxiytOVyMO+J8amaTbz/MllRxa+iAxIbd/M12rrV3vvEYUgitvK4uXER62MZMyIvOW6Cf+CLfOq3Tsp+M1Jve4ox/xJOrg1815e9//+7hHcujjCo5XiG+u1rVyH+Tr/Qs6Rdk+CVgBiZ/YqWMSdFUBkUIYCKazzeVkzCkx0eJYIECgYEA3bIM0H7kCwfAHiWm5EGXEW8qoSTqc8bZMG5S6D2BuMTTVixRcfDTJlt2daKfxLRsU1ijrG6EVKaLblrBOFVJb1WYrgxgKkoUHIUqNwGMnTTe3dj8w2uA5/IUYcqmzwO5Rb49mc/1ATzzMqn2kUck5Vts9i8DpJUe0PLYJ7VkT5ECgYEAwavDC5NkPrE/QOYmvy1Aqj5vhKIr5W6IEGSGDMIfZ2e7o08URfRkc5jprZozcOl3MuseCE1I6ysIyDlvHtbV0eAl128xUWI5HXIC8zGrYJQ95Fsl2Xd6yymEC6CUKgnae2WyyOls3QM56XAmZbh1W+QN8Hsb5X0yLTii8LDsXQ0CgYB6AzVERqHxZCmbLfPFKkgfY0Rd/fg/EhCUtBNTGA7eBw2dHrUQdY9wS+RNZ9xwoTABSwaBry2LfUG90ZsICwBokv59w/flLnIVJEEQlvyxxNhn1rV+RBtlDHmlPKhDxPPh64rxrV9VeBsNJje6yyIGTSQR9dwWZ6/XJeBLMmzr0QKBgQC0uXeVAcF1zyjbgul9VNkXBJREDKExw+cshOGiXjO35tDuIAknDlv+kx7cZRzDrNkSptyrmpMFAG99iDrtaES3SJeHZbd73lC17YJbNmpaAXuP8I5tVFU96EvUHdClOfSrWcdwPILd6vjLoV/zZCH/0dxAIGFz0VRVZpiGSlMGsQKBgET9vKqOSvI88W8/Ve3YGOoXQ5qjrm5JqbL/J8f4GiOoDrBfaYij2Yg2WZlaPWi5t1KXh8IsN/Yn6NenY8CiI5hQZi/0CQM5ICEZmCnX3U1QdpffGzAbd/tb4ldmA3ez3cYNPzIP3q1bUQ3ybwO2eD8N978mHXBokoO0AHh01thZ\",\"public_key\":\"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAix0lmphMY4htd8sw6kLMBGyju6p2y4pQtmiUpk7KxIV2NaUj0Zve2WJvPDptbKB0Lmn3EksPVG8VCrlh97shKjerm0gW314YN1DY/7RFPqxeeYNIFaMiGgf1ecMZUAOwO/v8NKn2nKH5hA0eMFxXNTtAXfSY/UBBnMFWOd765uQsXNn6r0PjhIpC2T9Hk+KfVm2eQ3QqY82/s0SaeebN/xjbkTsAc6yKGPCJxbe2vyE5coQ8iCj4pVvlFX6+SO+lEFvB56r8H+dQlDixPGgEGz+PZkUny7SZjFBZm5amH6XEl40ac9iWuuaW2C28FMoHX6XjJgu95aZMeVa5ZCrqmQIDAQAB\"}', '支付宝手机支付', '1', '1535983487', '1536413845');
INSERT INTO `yb_channel` VALUES ('100005', 'wx_scan', '0.080', '20000.00', '{\"mchid\":\"145900000\",\"appid\":\"145900000\",\"key\":\"145900000\"}', '微信支付', '1', '1536416246', '1536423170');

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
-- Records of yb_notice
-- ----------------------------

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
-- Records of yb_orders
-- ----------------------------
INSERT INTO `yb_orders` VALUES ('1000000022', '100001', 'A2018090400132790455', '201809040010489414', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535991207', '1535991207');
INSERT INTO `yb_orders` VALUES ('1000000023', '100001', 'A20180904001531904233', '201809040015273100', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '10.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535991331', '1535991331');
INSERT INTO `yb_orders` VALUES ('1000000024', '100001', 'A2018090400170290471', '201809040017003318', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535991422', '1535991422');
INSERT INTO `yb_orders` VALUES ('1000000025', '100001', 'A2018090400432590435', '201809040043225732', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535993005', '1535993005');
INSERT INTO `yb_orders` VALUES ('1000000026', '100001', 'A20180904004349904160', '201809040043489236', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535993029', '1535993029');
INSERT INTO `yb_orders` VALUES ('1000000027', '100001', 'A20180904004404904793', '201809040044039345', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535993044', '1535993044');
INSERT INTO `yb_orders` VALUES ('1000000028', '100001', 'A20180904004549904689', '201809040045475986', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1535993149', '1535993149');
INSERT INTO `yb_orders` VALUES ('1000000029', '100001', 'A20180904123417904553', '201809041234113826', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536035657', '1536035657');
INSERT INTO `yb_orders` VALUES ('1000000030', '100001', 'A20180908114636908550', '201809081146336255', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536378396', '1536378396');
INSERT INTO `yb_orders` VALUES ('1000000031', '100001', 'A2018090811560690892', '201809081156048690', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536378966', '1536378966');
INSERT INTO `yb_orders` VALUES ('1000000032', '100001', 'A20180909001905909205', '201809090018069087', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423545', '1536423545');
INSERT INTO `yb_orders` VALUES ('1000000033', '100001', 'A2018090900192190998', '201809090019209519', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423561', '1536423561');
INSERT INTO `yb_orders` VALUES ('1000000034', '100001', 'A20180909001940909210', '201809090019391857', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423580', '1536423580');
INSERT INTO `yb_orders` VALUES ('1000000035', '100001', 'A20180909001948909360', '201809090019476333', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423588', '1536423588');
INSERT INTO `yb_orders` VALUES ('1000000036', '100001', 'A20180909001952909671', '201809090019507352', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423592', '1536423592');
INSERT INTO `yb_orders` VALUES ('1000000037', '100001', 'A20180909001957909321', '201809090019565522', '支付测试', '支付测试', 'wx_qrcode', '{\"openid\":\"ow_adnfkewnlalaNLNfBJfghyrkBL\"}', '100.00', 'CNY', '::1', 'https://sirhe.cn/return.php', 'https://sirhe.cn/notify.php', '1', '1536423597', '1536423597');

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
-- Records of yb_transaction
-- ----------------------------

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
-- Records of yb_user
-- ----------------------------
INSERT INTO `yb_user` VALUES ('100001', '1078509454@qq.com', 'f54ea2d15eb0655be344cc909f23c1c9', 'yubei', '润轩商务', '18078687485', '1078509454', '1', '1', '1', '1', '1535984045', '1536468913');
INSERT INTO `yb_user` VALUES ('100002', '', '12aa4d415fac28fc6c3668aea3f168b5', '', '', '', '', '0', '0', '0', '-1', '1536384395', '1536410868');
INSERT INTO `yb_user` VALUES ('100003', '702154416@qq.com', '12aa4d415fac28fc6c3668aea3f168b5', 'man', '测试', '', '', '0', '0', '0', '1', '1536384593', '1536468801');
INSERT INTO `yb_user` VALUES ('100004', '702154416@qq.com', '12aa4d415fac28fc6c3668aea3f168b5', 'man', '测试', '', '', '0', '0', '0', '-1', '1536384670', '1536410874');
INSERT INTO `yb_user` VALUES ('100005', 'brianwaring98@gmail.com', '12aa4d415fac28fc6c3668aea3f168b5', 'BrianWaring', '威廉', '', '', '0', '0', '0', '-1', '1536384768', '1536410879');
INSERT INTO `yb_user` VALUES ('100006', 'brianwaring98@gmail.com', '12aa4d415fac28fc6c3668aea3f168b5', 'BrianWaring', '威廉', '', '', '0', '0', '0', '1', '1536385087', '1536385087');
INSERT INTO `yb_user` VALUES ('100009', '10785094540@qq.com', '12aa4d415fac28fc6c3668aea3f168b5', 'asd', '测试', '', '', '0', '0', '0', '1', '1536386076', '1536468805');
INSERT INTO `yb_user` VALUES ('100010', '10735646734@qq.com', '12aa4d415fac28fc6c3668aea3f168b5', 'asd34', '测试', '', '', '0', '0', '0', '-1', '1536386132', '1536406757');
INSERT INTO `yb_user` VALUES ('100013', '1073255646734@qq.com', '12aa4d415fac28fc6c3668aea3f168b5', 'asd343456', '测试', '', '', '0', '0', '0', '-1', '1536386355', '1536393261');
INSERT INTO `yb_user` VALUES ('100014', 'test@sss.com', '12aa4d415fac28fc6c3668aea3f168b5', 'testee', '测试123', '', '', '0', '0', '0', '1', '1536393619', '1536468905');

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
-- Records of yb_user_account
-- ----------------------------
INSERT INTO `yb_user_account` VALUES ('1', '100001', '10001', 'imoapp@sina.com', '广西百色市右江区', '', '0', '1535984045', '1536467648');
INSERT INTO `yb_user_account` VALUES ('2', '100013', '0', '', '', '', '0', '1536386355', '1536386355');
INSERT INTO `yb_user_account` VALUES ('4', '100014', '0', '', '', '', '0', '1536393619', '1536393619');

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

-- ----------------------------
-- Records of yb_user_register
-- ----------------------------
