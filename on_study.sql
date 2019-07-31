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

 Date: 31/07/2019 10:40:30
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
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin
-- ----------------------------
INSERT INTO `on_admin` VALUES (1, 'admin', 'on490bc47ffe57e67f88e681c577f430e1', 1, 'admin@qq.com', 0, 1, 1557898848, 1564536477, 0, 1564536477, '127.0.0.1');
INSERT INTO `on_admin` VALUES (2, 'justin', 'on490bc47ffe57e67f88e681c577f430e1', 0, 'justin@qq.com', 1, 1, 1557898848, 1564536464, 0, 1564467074, '127.0.0.1');
INSERT INTO `on_admin` VALUES (32, 'mooke', 'on47288b0def8776d233329db248e37188', 0, 'mooke@qq.com', 1, 1, 1564539804, 1564539804, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (10, 'niki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '5@qq.com', 1, 0, 1564470214, 1564537668, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (9, 'yuki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, '3@qq.com', 1, 1, 1564469023, 1564537666, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (8, 'jack', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '2@qq.com', 1, 1, 1564468966, 1564537664, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (13, 'jeannie', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'qq@qq.com', 1, 0, 1564470563, 1564537680, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (11, 'banks', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '6@qq.com', 1, 0, 1564470433, 1564537031, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (12, 'willy', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '7@qq.com', 1, 1, 1564470455, 1564537683, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (14, 'lily', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'we@qq.com', 1, 0, 1564470601, 1564537679, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (15, 'anna', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'ef@qq.com', 1, 0, 1564470641, 1564537676, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (16, 'ella', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ella@qq.com', 1, 1, 1564470669, 1564470669, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (17, 'ava', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ava@qq.com', 1, 1, 1564470688, 1564470688, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (18, 'emma', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'emma@qq.com', 1, 1, 1564470723, 1564470723, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (19, 'john', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'john@qq.com', 1, 1, 1564470765, 1564470765, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (20, 'jordan', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'jordan@qq.com', 1, 1, 1564470791, 1564470791, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (21, 'aiden', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'aiden@qq.com', 1, 1, 1564470810, 1564470810, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (34, 'youhn', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'youhn@qq.com', 1, 1, 1564539899, 1564539899, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (33, 'mookee', 'on47288b0def8776d233329db248e37188', 0, 'mookee@qq.com', 1, 1, 1564539834, 1564539834, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (28, 'juck', 'on47288b0def8776d233329db248e37188', 1, 'juck@qq.com', 1, 1, 1564539465, 1564539465, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (29, 'molera', 'on47288b0def8776d233329db248e37188', 1, 'molera@qq.com', 1, 1, 1564539496, 1564539496, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (30, 'jacka', 'on47288b0def8776d233329db248e37188', 1, 'jacka@qq.com', 1, 1, 1564539565, 1564539565, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (31, 'julye', 'on47288b0def8776d233329db248e37188', 0, 'julye@163.com', 1, 1, 1564539718, 1564539718, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (44, '1233', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '1223@qq.com', 1, 1, 1564540426, 1564540426, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (43, '123', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '123@qq.com', 1, 1, 1564540402, 1564540402, NULL, NULL, NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_permission
-- ----------------------------
INSERT INTO `on_permission` VALUES (2, '角色管理', 'role/index', 'admin', 'role', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (1, '后台首页', 'index/index', 'admin', '', '', 'side-menu__icon fa fa-desktop', 0, 0, 1, 0, 1, 1563170072, 1563170072);
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
INSERT INTO `on_permission` VALUES (16, '管理员状态管理', 'admin/store', 'admin', 'admin', 'store', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (17, '编辑管理员', 'admin/edit', 'admin', 'admin', 'edit', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (18, '批量删除', 'admin/deletes', 'admin', 'admin', 'deletes', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (19, '删除管理员', 'admin/delete', 'admin', 'admin', 'delete', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (20, '员工管理', 'admin/admin', 'admin', '', '', '', 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (21, '测试', 'test/index', 'admin', 'test', 'index', '', 0, 0, 1, 0, -1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (22, '首页', 'index/index', 'admin', 'index', 'index', '', 1, 0, 1, 1, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (23, 'test', 'tess/index', 'admin', 'tess', 'index', '', 0, 0, 1, 0, 0, 1501686013, 1501686013);

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
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_role_permission
-- ----------------------------
INSERT INTO `on_role_permission` VALUES (4, 1, '1，22', 0);
INSERT INTO `on_role_permission` VALUES (3, 2, '1，14，15，16，17，18，19，20，22', 0);

SET FOREIGN_KEY_CHECKS = 1;
