/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : on_study

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 19/07/2019 17:28:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for on_admin
-- ----------------------------
DROP TABLE IF EXISTS `on_admin`;
CREATE TABLE `on_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` char(34) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `sex` tinyint(1) NOT NULL DEFAULT 2 COMMENT '性别，0女1男2保密',
  `email` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0原始管理员1管理员',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1启用0禁用',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  `last_login_time` int(11) NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_login_ip` varchar(34) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上次登录ip',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin
-- ----------------------------
INSERT INTO `on_admin` VALUES (1, 'admin', 'on490bc47ffe57e67f88e681c577f430e1', 1, 'admin@qq.com', 0, 1, 1557898848, 1563521504, 0, 1563521504, '127.0.0.1');
INSERT INTO `on_admin` VALUES (2, 'justin', 'on490bc47ffe57e67f88e681c577f430e1', 0, 'justin@qq.com', 1, 1, 1557898848, 1557898848, 0, 0, NULL);

-- ----------------------------
-- Table structure for on_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `on_admin_role`;
CREATE TABLE `on_admin_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) UNSIGNED NOT NULL COMMENT '对应user表ID',
  `role_id` int(11) UNSIGNED NOT NULL COMMENT '对应role表id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户与角色表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of on_admin_role
-- ----------------------------
INSERT INTO `on_admin_role` VALUES (1, 2, 1, 1563170072);
INSERT INTO `on_admin_role` VALUES (2, 2, 2, 1563170072);

-- ----------------------------
-- Table structure for on_menu
-- ----------------------------
DROP TABLE IF EXISTS `on_menu`;
CREATE TABLE `on_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单名',
  `parentId` int(11) NOT NULL COMMENT '父级菜单id',
  `model` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块名',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路径',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0表示删除1表示未删除',
  `createTime` int(11) NOT NULL COMMENT '创建时间',
  `updateTime` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `delTime` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_menu
-- ----------------------------
INSERT INTO `on_menu` VALUES (1, '管理员管理', 0, 'admin', NULL, 1, 1559632581, NULL, NULL, 'side-menu__icon fa fa-desktop');
INSERT INTO `on_menu` VALUES (2, '角色管理', 1, 'admin', NULL, 1, 1559632581, NULL, NULL, NULL);
INSERT INTO `on_menu` VALUES (3, '权限管理', 1, 'admin', NULL, 1, 1559632581, NULL, NULL, NULL);
INSERT INTO `on_menu` VALUES (4, '管理员管理', 1, 'admin', NULL, 1, 1559632581, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for on_permission
-- ----------------------------
DROP TABLE IF EXISTS `on_permission`;
CREATE TABLE `on_permission`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `model` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块名',
  `controller` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器名',
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法名',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限图标',
  `level` int(11) NOT NULL DEFAULT 0 COMMENT '级别',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `display_menu` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否在右侧导航展示',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父级id',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1有效0无效',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_permission
-- ----------------------------
INSERT INTO `on_permission` VALUES (2, '角色管理', 'role/index', 'admin', 'role', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (1, '后台首页', 'index/index', 'admin', 'index', 'index', 'side-menu__icon fa fa-desktop', 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (3, '添加角色', 'role/add', 'admin', 'role', 'add', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (4, '创建角色', 'role/store', 'admin', 'role', 'store', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (5, '编辑角色', 'role/edit', 'admin', 'role', 'edit', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (6, '修改角色', 'role/update', 'admin', 'role', 'update', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (7, '删除角色', 'role/delete', 'admin', 'role', 'delete', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (8, '权限管理', 'permission/index', 'admin', 'permission', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (9, '添加权限', 'permission/add', 'admin', 'permission', 'add', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (10, '创建权限', 'permission/store', 'admin', 'permission', 'store', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (11, '编辑权限', 'permission/edit', 'admin', 'permission', 'edit', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (12, '修改权限', 'permission/update', 'admin', 'permission', 'update', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (13, '删除权限', 'permission/delete', 'admin', 'permission', 'delete', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (14, '管理员管理', 'admin/index', 'admin', 'admin', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (15, '添加管理员', 'admin/add', 'admin', 'admin', 'add', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (16, '创建管理员', 'admin/store', 'admin', 'admin', 'store', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (17, '编辑管理员', 'admin/edit', 'admin', 'admin', 'edit', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (18, '修改管理员', 'admin/update', 'admin', 'admin', 'update', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (19, '删除管理员', 'admin/delete', 'admin', 'admin', 'delete', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (20, '员工管理', 'admin/admin', 'admin', '', '', '', 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (21, '测试', 'test/index', 'admin', 'test', 'index', '', 0, 0, 1, 0, 1, 1501686013, 1501686013);

-- ----------------------------
-- Table structure for on_role
-- ----------------------------
DROP TABLE IF EXISTS `on_role`;
CREATE TABLE `on_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1有效0无效',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_role
-- ----------------------------
INSERT INTO `on_role` VALUES (1, 'admin', '管理员', 1, 1563170072, 1563170072);
INSERT INTO `on_role` VALUES (2, 'test', '测试', 1, 1563170072, 1563170072);

-- ----------------------------
-- Table structure for on_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `on_role_permission`;
CREATE TABLE `on_role_permission`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '对应role表id',
  `access_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '对应access表的id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限角色表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
