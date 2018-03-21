/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : small

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-21 11:56:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) DEFAULT '1',
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'adminn', '2169046620@qq.com', 'beb2ca9bca2c1d1610b55657e7383ae8', 'SayY2ZwtjjRJZi3v6hm7NGqO67Vv54EI9XCpIXARl4fw4KnuW6zNKHUX2Kwt', '1521600653', '1521600653', 'http://wx.com/uploads/images/20180321/6a2ddf6b98b05bf76d9028d0d43824f6.jpg', '1', '1');
INSERT INTO `admin` VALUES ('42', 'foxriver', '216484814548@qq.com', '14e1b600b1fd579f47433b88e8d85291', '', '1521600675', '1521604467', 'http://wx.com/uploads/images/20180321/4d7817116b8948f785e8548b426a3b39.jpg', '0', '15');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'web_site_title', '微品匠心后台管理系统');
INSERT INTO `config` VALUES ('2', 'web_site_description', '微品匠心后台管理系统');
INSERT INTO `config` VALUES ('3', 'web_site_keyword', '微信开发，公众号开发，移动端开发，h5');
INSERT INTO `config` VALUES ('4', 'web_site_icp', '川ICP备15095485号-1');
INSERT INTO `config` VALUES ('5', 'web_site_cnzz', '');
INSERT INTO `config` VALUES ('6', 'web_site_copy', 'Copyright © 2018 微品匠心后台管理系统 All rights reserved.');
INSERT INTO `config` VALUES ('7', 'web_site_close', '1');
INSERT INTO `config` VALUES ('8', 'list_rows', '5');
INSERT INTO `config` VALUES ('9', 'admin_allow_ip', '');
INSERT INTO `config` VALUES ('10', 'alisms_appkey', '');
INSERT INTO `config` VALUES ('11', 'alisms_appsecret', '');
INSERT INTO `config` VALUES ('12', 'alisms_signname', '');
INSERT INTO `config` VALUES ('13', 'qiniu_appkey', '');
INSERT INTO `config` VALUES ('14', 'qiniu_secret', '');
INSERT INTO `config` VALUES ('15', 'qiniu_bucket', '');
INSERT INTO `config` VALUES ('16', 'qiniu_domain', '');

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(20) NOT NULL COMMENT '样式',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '#', '系统管理', '1', '1', 'fa fa-gear', '', '0', '3', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('2', 'admin/admin/index', '用户管理', '1', '1', '', '', '1', '10', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('3', 'admin/role/index', '角色管理', '1', '1', '', '', '1', '20', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('4', 'admin/menu/index', '菜单管理', '1', '1', '', '', '1', '30', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('5', '#', '数据库管理', '1', '1', 'fa fa-database', '', '0', '10', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('6', 'admin/data/index', '数据库备份', '1', '1', '', '', '5', '50', '1446535750', '1477312169');
INSERT INTO `node` VALUES ('7', 'admin/data/optimize', '优化表', '1', '1', '', '', '6', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('8', 'admin/data/repair', '修复表', '1', '1', '', '', '6', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('9', 'admin/admin/create', '添加用户', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('10', 'admin/admin/edit', '编辑用户', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('11', 'admin/admin/delete', '删除用户', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('12', 'admin/admin/status', '用户状态', '1', '1', '', '', '2', '50', '1477312169', '1477312169');
INSERT INTO `node` VALUES ('27', 'admin/data/import', '数据库还原', '1', '1', '', '', '5', '50', '1477639870', '1477639870');
INSERT INTO `node` VALUES ('28', 'admin/data/revert', '还原', '1', '1', '', '', '27', '50', '1477639972', '1477639972');
INSERT INTO `node` VALUES ('29', 'admin/data/del', '删除', '1', '1', '', '', '27', '50', '1477640011', '1477640011');
INSERT INTO `node` VALUES ('30', 'admin/role/create', '添加角色', '1', '1', '', '', '3', '50', '1477640011', '1521602116');
INSERT INTO `node` VALUES ('31', 'admin/role/edit', '编辑角色', '1', '1', '', '', '3', '50', '1477640011', '1521602131');
INSERT INTO `node` VALUES ('32', 'admin/role/delete', '删除角色', '1', '1', '', '', '3', '50', '1477640011', '1521602160');
INSERT INTO `node` VALUES ('34', 'admin/role/getAccessData', '权限分配', '1', '1', '', '', '3', '50', '1477640011', '1521602087');
INSERT INTO `node` VALUES ('35', 'admin/menu/menuStore', '添加菜单接口', '1', '1', '', '', '4', '50', '1477640011', '1521603859');
INSERT INTO `node` VALUES ('36', 'admin/menu/edit', '编辑菜单', '1', '1', '', '', '4', '50', '1477640011', '1521603823');
INSERT INTO `node` VALUES ('37', 'admin/menu/delete', '删除菜单', '1', '1', '', '', '4', '50', '1477640011', '1521603759');
INSERT INTO `node` VALUES ('38', 'admin/menu/status', '菜单状态', '1', '1', '', '', '4', '50', '1477640011', '1521603697');
INSERT INTO `node` VALUES ('39', 'admin/menu/order', '菜单排序', '1', '1', '', '', '4', '50', '1477640011', '1521602641');
INSERT INTO `node` VALUES ('61', 'admin/config/index', '配置管理', '1', '1', '', '', '1', '3', '1479908607', '1479908607');
INSERT INTO `node` VALUES ('63', 'admin/config/save', '保存配置', '1', '1', '', '', '61', '50', '1479908607', '1487943831');
INSERT INTO `node` VALUES ('83', '#', '示例', '1', '1', 'fa fa-paper-plane', '', '0', '50', '1505281878', '1505281878');
INSERT INTO `node` VALUES ('84', 'admin/demo/sms', '发送短信', '1', '1', '', '', '83', '50', '1505281944', '1505281944');
INSERT INTO `node` VALUES ('89', 'admin/admin/deleteMany', '批量删除', '1', '1', '', '', '2', '50', '1521601628', '1521601628');
INSERT INTO `node` VALUES ('90', 'admin/admin/status', '状态修改', '1', '1', '', '', '2', '50', '1521601665', '1521601665');
INSERT INTO `node` VALUES ('94', 'admin/admin/store', '添加用户接口', '1', '1', '', '', '2', '50', '1521603419', '1521603419');
INSERT INTO `node` VALUES ('95', 'admin/admin/update', '编辑用户接口', '1', '1', '', '', '2', '50', '1521603446', '1521603446');
INSERT INTO `node` VALUES ('96', 'admin/admin/getData', '获取用户数据接口', '1', '1', '', '', '2', '50', '1521603527', '1521603527');
INSERT INTO `node` VALUES ('97', 'admin/role/getRoleData', '获取角色接口', '1', '1', '', '', '3', '50', '1521603575', '1521603575');
INSERT INTO `node` VALUES ('99', 'admin/admin/update', '更新角色接口', '1', '1', '', '', '3', '50', '1521603643', '1521603643');
INSERT INTO `node` VALUES ('100', 'admin/menu/update', '编辑菜单接口', '1', '1', '', '', '4', '50', '1521603899', '1521603899');

-- ----------------------------
-- Table structure for node_role
-- ----------------------------
DROP TABLE IF EXISTS `node_role`;
CREATE TABLE `node_role` (
  `node_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of node_role
-- ----------------------------
INSERT INTO `node_role` VALUES ('9', '1');
INSERT INTO `node_role` VALUES ('12', '1');
INSERT INTO `node_role` VALUES ('4', '1');
INSERT INTO `node_role` VALUES ('3', '1');
INSERT INTO `node_role` VALUES ('2', '1');
INSERT INTO `node_role` VALUES ('1', '1');
INSERT INTO `node_role` VALUES ('37', '1');
INSERT INTO `node_role` VALUES ('34', '1');
INSERT INTO `node_role` VALUES ('10', '1');
INSERT INTO `node_role` VALUES ('11', '1');
INSERT INTO `node_role` VALUES ('31', '1');
INSERT INTO `node_role` VALUES ('32', '1');
INSERT INTO `node_role` VALUES ('84', '15');
INSERT INTO `node_role` VALUES ('83', '15');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1521600687', '1521600687');
INSERT INTO `role` VALUES ('15', '编辑', '1521600687', '1521600687');

-- ----------------------------
-- Event structure for ceshi
-- ----------------------------
DROP EVENT IF EXISTS `ceshi`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `ceshi` ON SCHEDULE EVERY 1 MINUTE STARTS '2017-07-19 09:51:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE think_user set status='2' where id='1'
;;
DELIMITER ;
