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

 Date: 22/08/2019 15:48:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for on_action
-- ----------------------------
DROP TABLE IF EXISTS `on_action`;
CREATE TABLE `on_action`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actionName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '行为标记',
  `actionTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '行为名称',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '行为说明',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '种类',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `actionName`(`actionName`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '行为列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_action
-- ----------------------------
INSERT INTO `on_action` VALUES (1, 'admin_login', '管理员登录', '管理员登录', 1, 1, 1563170072);
INSERT INTO `on_action` VALUES (2, 'update', '更新内容', '更新内容', 1, 1, 1565856140);
INSERT INTO `on_action` VALUES (3, 'user_login1', '用户登录', '用户登录', 1, 1, 1565860656);
INSERT INTO `on_action` VALUES (4, 'updateMenu', '更新菜单', '更新菜单', 0, 1, 1566292170);
INSERT INTO `on_action` VALUES (5, 'getExcel', '导出表格', '导出表格', 1, 1, 1566292803);
INSERT INTO `on_action` VALUES (6, 'delete', '删除数据', '删除数据', 1, 1, 1566293108);
INSERT INTO `on_action` VALUES (7, 'deletes', '批量删除', '批量删除', 1, 1, 1566348300);
INSERT INTO `on_action` VALUES (8, 'add', '添加操作', '添加操作', 1, 1, 1566348326);
INSERT INTO `on_action` VALUES (9, 'clear', '清空操作', '清空操作', 1, 1, 1566348394);

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
  `is_login` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未登录，1登录',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1启用0禁用',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  `last_login_time` int(11) NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_login_ip` varchar(34) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上次登录ip',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 47 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin
-- ----------------------------
INSERT INTO `on_admin` VALUES (1, 'admin', 'on490bc47ffe57e67f88e681c577f430e1', 1, 'admin@qq.com', 0, 0, 1, 1557898848, 1566458131, NULL, 1566458131, '127.0.0.1');
INSERT INTO `on_admin` VALUES (2, 'justin', 'on6559c2b7caad120d5d85b85bd1b88561', 1, 'justin1@qq.com', 1, 1, 1, 1557898848, 1566371217, NULL, 1565145065, '127.0.0.1');
INSERT INTO `on_admin` VALUES (32, 'mooke', 'on47288b0def8776d233329db248e37188', 0, 'mooke@qq.com', 1, 0, 1, 1564539804, 1564539804, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (10, 'niki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '5@qq.com', 1, 0, 1, 1564470214, 1564558418, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (9, 'yuki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, '3@qq.com', 1, 0, 1, 1564469023, 1566368015, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (8, 'jack', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '2@qq.com', 1, 0, 2, 1564468966, 1564558670, 1564558670, NULL, NULL);
INSERT INTO `on_admin` VALUES (13, 'jeannie', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'qq@qq.com', 1, 0, 0, 1564470563, 1564713995, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (11, 'banks', 'onc1053fbf10e6253b3f41e18307543bd6', 1, '6@qq.com', 1, 0, 0, 1564470433, 1564713982, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (12, 'willy', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '7@qq.com', 1, 0, 0, 1564470455, 1564559786, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (14, 'lily', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'we@qq.com', 1, 0, 1, 1564470601, 1564558418, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (15, 'anna', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'ef@qq.com', 1, 0, 1, 1564470641, 1564558418, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (16, 'ella', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ella@qq.com', 1, 0, 1, 1564470669, 1564470669, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (17, 'ava', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ava@qq.com', 1, 0, 1, 1564470688, 1564470688, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (18, 'emma', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'emma@qq.com', 1, 0, 1, 1564470723, 1564470723, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (19, 'john', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'john@qq.com', 1, 0, 1, 1564470765, 1564470765, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (20, 'jordan', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'jordan@qq.com', 1, 0, 1, 1564470791, 1564470791, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (21, 'aiden', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'aiden@qq.com', 1, 0, 1, 1564470810, 1564470810, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (34, 'youhn', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'youhn@qq.com', 1, 0, 2, 1564539899, 1565147494, 1564549971, NULL, NULL);
INSERT INTO `on_admin` VALUES (33, 'mookee', 'on47288b0def8776d233329db248e37188', 0, 'mookee@qq.com', 1, 0, 2, 1564539834, 1565147494, 1564550003, NULL, NULL);
INSERT INTO `on_admin` VALUES (28, 'juck', 'on47288b0def8776d233329db248e37188', 1, 'juck@qq.com', 1, 0, 1, 1564539465, 1564539465, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (29, 'molera', 'on47288b0def8776d233329db248e37188', 1, 'molera@qq.com', 1, 0, 1, 1564539496, 1564539496, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (30, 'jacka', 'on47288b0def8776d233329db248e37188', 1, 'jacka@qq.com', 1, 0, 1, 1564539565, 1564539565, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (31, 'julye', 'on47288b0def8776d233329db248e37188', 0, 'julye@163.com', 1, 0, 1, 1564539718, 1564539718, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (45, 'admin1123', 'on19b7c9c11f2afd6ad8d6249797787fca', 1, 'admin123@qq.com', 1, 0, 2, 1566352584, 1566352633, 1564550003, NULL, NULL);
INSERT INTO `on_admin` VALUES (46, 'admin11232', 'on19b7c9c11f2afd6ad8d6249797787fca', 1, 'admin1232@qq.com', 1, 0, 2, 1566352622, 1566352633, 1564550003, NULL, NULL);

-- ----------------------------
-- Table structure for on_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `on_admin_role`;
CREATE TABLE `on_admin_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) UNSIGNED NOT NULL COMMENT '对应user表ID',
  `role_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '对应role表id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户与角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin_role
-- ----------------------------
INSERT INTO `on_admin_role` VALUES (1, 2, '1', 1563170072);
INSERT INTO `on_admin_role` VALUES (3, 9, '2，3', 1565144570);
INSERT INTO `on_admin_role` VALUES (4, 32, '2', 1566441156);
INSERT INTO `on_admin_role` VALUES (5, 31, '2', 1566441165);
INSERT INTO `on_admin_role` VALUES (6, 30, '2', 1566441169);
INSERT INTO `on_admin_role` VALUES (7, 29, '2', 1566441174);
INSERT INTO `on_admin_role` VALUES (8, 28, '2', 1566441180);
INSERT INTO `on_admin_role` VALUES (9, 20, '3', 1566441186);

-- ----------------------------
-- Table structure for on_icon
-- ----------------------------
DROP TABLE IF EXISTS `on_icon`;
CREATE TABLE `on_icon`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图标id',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图标名字',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否被删除',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 617 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '图标' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_icon
-- ----------------------------
INSERT INTO `on_icon` VALUES (1, 'fa-adjust', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (2, 'fa-anchor', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (3, ' fa-archive', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (4, 'fa-area-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (5, ' fa-arrows', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (6, 'fa-arrows-h', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (7, 'fa-arrows-v', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (8, 'fa-asterisk', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (9, ' fa-at', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (10, ' fa-automobile', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (11, ' fa-ban', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (12, 'fa-bank ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (13, ' fa-bar-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (14, 'fa-bar-chart-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (15, 'fa-barcode', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (16, 'fa-bars', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (17, ' fa-beer', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (18, 'fa-bell', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (19, 'fa-bell-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (20, 'fa-bell-slash', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (21, 'fa-bell-slash-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (22, 'fa-bicycle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (23, ' fa-binoculars', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (24, ' fa-birthday-cake', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (25, 'fa-bolt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (26, 'fa-bomb', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (27, 'fa-book', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (28, ' fa-bookmark', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (29, ' fa-bookmark-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (30, ' fa-briefcase', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (31, ' fa-bug', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (32, 'fa-building', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (33, 'fa-building-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (34, 'fa-bullhorn', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (35, 'fa-bullseye', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (36, ' fa-bus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (37, 'fa-cab ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (38, ' fa-calculator', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (39, 'fa-calendar', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (40, 'fa-calendar-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (41, ' fa-camera', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (42, 'fa-camera-retro', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (43, ' fa-car', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (44, 'fa-caret-square-o-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (45, 'fa-caret-square-o-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (46, ' fa-caret-square-o-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (47, ' fa-caret-square-o-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (48, ' fa-cc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (49, 'fa-certificate', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (50, ' fa-check', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (51, 'fa-check-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (52, 'fa-check-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (53, 'fa-check-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (54, 'fa-check-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (55, 'fa-child', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (56, 'fa-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (57, 'fa-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (58, 'fa-circle-o-notch', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (59, 'fa-circle-thin', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (60, 'fa-clock-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (61, 'fa-close', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (62, 'fa-cloud', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (63, 'fa-cloud-download', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (64, ' fa-cloud-upload', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (65, ' fa-code', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (66, ' fa-code-fork', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (67, ' fa-coffee', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (68, 'fa-cog', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (69, 'fa-cogs', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (70, 'fa-comment', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (71, 'fa-comment-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (72, 'fa-comments', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (73, ' fa-comments-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (74, 'fa-compass', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (75, 'fa-copyright', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (76, 'fa-credit-card', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (77, 'fa-crop', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (78, ' fa-crosshairs', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (79, 'fa-cube', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (80, 'fa-cubes', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (81, 'fa-cutlery', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (82, 'fa-dashboard ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (83, 'fa-database', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (84, 'fa-desktop', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (85, ' fa-dot-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (86, 'fa-download', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (87, 'fa-edit', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (88, 'fa-ellipsis-h', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (89, 'fa-ellipsis-v', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (90, 'fa-envelope', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (91, 'fa-envelope-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (92, 'fa-envelope-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (93, 'fa-eraser', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (94, 'fa-exchange', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (95, 'fa-exclamation', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (96, 'fa-exclamation-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (97, 'fa-exclamation-triangle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (98, 'fa-external-link', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (99, 'fa-external-link-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (100, 'fa-eye', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (101, 'fa-fa-eye-slash', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (102, ' fa-eyedropper', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (103, 'fa-fax', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (104, ' fa-female', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (105, 'fa-fighter-jet', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (106, 'fa-file-archive-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (107, 'fa-file-audio-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (108, 'fa-file-code-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (109, 'fa-file-excel-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (110, 'fa-file-image-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (111, 'fa-file-movie-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (112, 'fa-file-pdf-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (113, ' fa-file-photo-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (114, 'fa-file-picture-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (115, ' fa-file-powerpoint-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (116, 'fa-file-sound-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (117, 'fa-file-video-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (118, 'fa-file-word-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (119, 'fa-file-zip-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (120, 'fa-film', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (121, 'fa-filter', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (122, 'fa-fire', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (123, 'fa-fire-extinguisher', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (124, 'fa-flag', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (125, 'fa-flag-checkered', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (126, 'fa-flag-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (127, 'fa-flash ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (128, 'fa-flask', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (129, 'fa-folder', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (130, ' fa-folder-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (131, 'fa-folder-open', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (132, 'fa-folder-open-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (133, 'fa-frown-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (134, ' fa-futbol-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (135, 'fa-gamepad', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (136, 'fa-gavel', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (137, 'fa-gear ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (138, ' fa-gears ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (139, 'fa-gift', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (140, 'fa-glass', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (141, 'fa-globe', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (142, 'fa-graduation-cap', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (143, ' fa-group ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (144, ' fa-hdd-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (145, ' fa-headphones', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (146, 'fa-heart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (147, 'fa-heart-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (148, ' fa-history', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (149, ' fa-home', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (150, ' fa-image ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (151, 'fa-inbox', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (152, 'fa-info', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (153, ' fa-info-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (154, 'fa-institution', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (155, 'fa-key', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (156, ' fa-keyboard-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (157, 'fa-language', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (158, 'fa-laptop', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (159, ' fa-leaf', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (160, 'fa-legal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (161, ' fa-lemon-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (162, 'fa-level-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (163, 'fa-level-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (164, 'fa-life-bouy', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (165, 'fa-life-buoy ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (166, 'fa-life-ring', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (167, ' fa-life-saver', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (168, ' fa-lightbulb-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (169, 'fa-line-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (170, ' fa-location-arrow', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (171, 'fa-lock', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (172, ' fa-magic', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (173, ' fa-magnet', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (174, 'fa-mail-forward ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (175, 'fa-mail-reply', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (176, 'fa-mail-reply-all ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (177, 'fa-male', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (178, 'fa-map-marker', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (179, ' fa-meh-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (180, 'fa-microphone', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (181, 'fa-microphone-slash', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (182, 'fa-minus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (183, 'fa-minus-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (184, ' fa-minus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (185, 'fa-minus-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (186, 'fa-mobile', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (187, 'fa-mobile-phone', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (188, 'fa-money', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (189, 'fa-moon-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (190, 'fa-mortar-board ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (191, 'fa-music', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (192, ' fa-navicon ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (193, 'fa-newspaper-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (194, 'fa-paint-brush', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (195, 'fa-paper-plane', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (196, 'fa-paper-plane-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (197, ' fa-paw', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (198, ' fa-pencil', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (199, 'fa-pencil-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (200, 'fa-pencil-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (201, 'fa-phone', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (202, ' fa-phone-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (203, 'fa-photo ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (204, 'fa-picture-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (205, ' fa-pie-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (206, ' fa-plane', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (207, 'fa-plug', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (208, ' fa-plus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (209, 'fa-plus-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (210, ' fa-plus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (211, 'fa-plus-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (212, 'fa-power-off', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (213, 'fa-print', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (214, ' fa-puzzle-piece', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (215, 'fa-qrcode', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (216, ' fa-question', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (217, ' fa-question-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (218, 'fa-quote-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (219, 'fa-quote-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (220, ' fa-random', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (221, 'fa-recycle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (222, 'fa-refresh', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (223, 'fa-remove ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (224, ' fa-reorder', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (225, ' fa-reply', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (226, 'fa-reply-all', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (227, 'fa-retweet', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (228, 'fa-road', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (229, 'fa-rocket', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (230, 'fa-rss', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (231, ' fa-rss-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (232, 'fa-search', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (233, 'fa-search-minus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (234, 'fa-search-plus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (235, 'fa-send ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (236, 'fa-send-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (237, 'fa-share', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (238, 'fa-share-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (239, 'fa-share-alt-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (240, 'fa-share-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (241, 'fa-share-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (242, 'fa-shield', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (243, 'fa-shopping-cart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (244, 'fa-sign-in', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (245, ' fa-sign-out', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (246, ' fa-signal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (247, 'fa-sitemap', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (248, 'fa-sliders', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (249, 'fa-smile-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (250, 'fa-soccer-ball-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (251, 'fa-sort', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (252, 'fa-sort-alpha-asc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (253, 'fa-sort-alpha-desc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (254, 'fa-sort-amount-asc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (255, 'fa-sort-amount-desc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (256, 'fa-sort-asc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (257, 'fa-sort-desc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (258, 'fa-sort-down ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (259, 'fa-sort-numeric-asc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (260, 'fa-sort-numeric-desc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (261, ' fa-sort-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (262, 'fa-space-shuttle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (263, ' fa-spinner', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (264, 'fa-spoon', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (265, 'fa-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (266, 'fa-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (267, 'fa-star', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (268, ' fa-star-half', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (269, 'fa-star-half-empty ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (270, 'fa-star-half-full ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (271, 'fa-star-half-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (272, 'fa-star-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (273, 'fa-suitcase', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (274, 'fa-sun-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (275, ' fa-support ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (276, 'fa-tablet', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (277, 'fa-tachometer', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (278, 'fa-tag', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (279, 'fa-tags', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (280, 'fa-tasks', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (281, ' fa-taxi', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (282, ' fa-terminal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (283, 'fa-thumb-tack', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (284, 'fa-thumbs-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (285, 'fa-thumbs-o-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (286, 'fa-thumbs-o-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (287, 'fa-thumbs-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (288, ' fa-ticket', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (289, 'fa-times', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (290, ' fa-times-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (291, ' fa-times-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (292, 'fa-tint', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (293, 'fa-toggle-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (294, 'fa-toggle-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (295, 'fa-toggle-off', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (296, ' fa-toggle-on', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (297, 'fa-toggle-right ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (298, ' fa-toggle-up ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (299, 'fa-trash', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (300, 'fa-trash-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (301, 'fa-tree', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (302, 'fa-trophy', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (303, 'fa-truck', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (304, 'fa-tty', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (305, 'fa-umbrella', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (306, 'fa-university', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (307, 'fa-unlock', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (308, 'fa-unlock-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (309, 'fa-unsorted', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (310, ' fa-upload', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (311, 'fa-user', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (312, 'fa-users', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (313, 'fa-video-camera', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (314, ' fa-volume-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (315, 'fa-volume-off', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (316, 'fa-volume-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (317, 'fa-warning', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (318, 'fa-wheelchair', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (319, 'fa-wifi', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (320, 'fa-wrench', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (321, 'fa-angle-double-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (322, 'fa-angle-double-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (323, 'fa-angle-double-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (324, 'fa-angle-double-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (325, 'fa-angle-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (326, 'fa-angle-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (327, 'fa-angle-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (328, 'fa-angle-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (329, 'fa-arrow-circle-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (330, 'fa-arrow-circle-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (331, 'fa-arrow-circle-o-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (332, 'fa-arrow-circle-o-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (333, 'fa-arrow-circle-o-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (334, 'fa-arrow-circle-o-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (335, 'fa-arrow-circle-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (336, 'fa-arrow-circle-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (337, 'fa-arrow-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (338, 'fa-arrow-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (339, 'fa-arrow-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (340, 'fa-arrow-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (341, 'fa-arrows', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (342, 'fa-arrows-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (343, 'fa-arrows-h', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (344, 'fa-arrows-v', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (345, 'fa-caret-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (346, 'fa-caret-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (347, 'fa-caret-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (348, 'fa-caret-square-o-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (349, 'fa-caret-square-o-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (350, 'fa-caret-square-o-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (351, 'fa-caret-square-o-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (352, 'fa-caret-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (353, 'fa-chevron-circle-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (354, 'fa-chevron-circle-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (355, 'fa-chevron-circle-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (356, 'fa-chevron-circle-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (357, ' fa-chevron-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (358, 'fa-chevron-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (359, 'fa-chevron-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (360, 'fa-chevron-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (361, ' fa-hand-o-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (362, 'fa-hand-o-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (363, 'fa-hand-o-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (364, 'fa-hand-o-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (365, 'fa-long-arrow-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (366, ' fa-long-arrow-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (367, 'fa-long-arrow-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (368, 'fa-long-arrow-up', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (369, 'fa-toggle-down', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (370, 'fa-toggle-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (371, 'fa-toggle-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (372, 'fa-arrows-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (373, 'fa-backward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (374, 'fa-compress', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (375, 'fa-eject', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (376, 'fa-expand', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (377, 'fa-fast-backward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (378, 'fa-fast-forward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (379, 'fa-forward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (380, ' fa-pause', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (381, 'fa-play', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (382, 'fa-play-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (383, 'fa-play-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (384, 'fa-step-backward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (385, 'fa-step-forward', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (386, 'fa-stop', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (387, 'fa-youtube-play', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (388, 'fa-adn', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (389, 'fa-android', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (390, 'fa-angellist', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (391, 'fa-apple', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (392, 'fa-behance', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (393, 'fa-behance-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (394, 'fa-bitbucket', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (395, 'fa-bitbucket-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (396, 'fa-bitcoin', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (397, 'fa-btc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (398, 'fa-cc-amex', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (399, 'fa-cc-discover', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (400, 'fa-cc-paypal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (401, 'fa-th', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (402, 'fa-cc-stripe', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (403, 'fa-cc-visa', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (404, 'fa-codepen&gt;&lt;/i&gt; &lt;/li&gt; &lt;li class=', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (405, 'fa-delicious', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (406, 'fa-deviantart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (407, 'fa-digg', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (408, 'fa-dribbble', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (409, 'fa-dropbox', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (410, 'fa-drupal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (411, ' fa-empire', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (412, 'fa-facebook', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (413, 'fa-facebook-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (414, 'fa-flickr', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (415, ' fa-foursquare', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (416, 'fa-ge', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (417, 'fa-git', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (418, 'fa-git-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (419, 'fa-github', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (420, 'fa-github-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (421, 'fa-github-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (422, 'fa-gittip', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (423, 'fa-google', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (424, 'fa-google-plus', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (425, 'fa-google-plus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (426, 'fa-hacker-news', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (427, 'fa-hacker-news', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (428, 'fa-html5', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (429, 'fa-instagram', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (430, 'fa-ioxhost', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (431, 'fa-joomla', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (432, 'fa-jsfiddle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (433, 'fa-lastfm', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (434, 'fa-lastfm-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (435, 'fa-linkedin', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (436, 'fa-linkedin-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (437, 'fa-linux', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (438, 'fa-maxcdn', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (439, 'fa-meanpath', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (440, 'fa-openid', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (441, ' fa-pagelines', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (442, 'fa-paypal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (443, 'fa-pied-piper', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (444, 'fa-pied-piper-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (445, 'fa-pinterest', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (446, ' fa-pinterest-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (447, 'fa-qq', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (448, 'fa-ra', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (449, 'fa-rebel', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (450, 'fa-reddit', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (451, 'fa-reddit-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (452, 'fa-renren', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (453, 'fa-share-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (454, 'fa-share-alt-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (455, 'fa-skype', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (456, 'fa-slack', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (457, 'fa-slideshare', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (458, 'fa-soundcloud', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (459, 'fa-spotify', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (460, 'fa-stack-exchange', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (461, ' fa-stack-overflow', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (462, 'fa-steam', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (463, 'fa-steam-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (464, 'fa-stumbleupon', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (465, 'fa-stumbleupon-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (466, 'fa-tencent-weibo', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (467, ' fa-trello', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (468, 'fa-tumblr', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (469, 'fa-tumblr-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (470, 'fa-twitch', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (471, 'fa-twitter', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (472, 'fa-twitter-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (473, 'fa-vimeo-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (474, 'fa-vine', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (475, 'fa-vk', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (476, 'fa-wechat', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (477, 'fa-weibo', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (478, 'fa-weixin', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (479, 'fa-windows', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (480, ' fa-wordpress', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (481, 'fa-xing', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (482, 'fa-xing-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (483, 'fa-yahoo', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (484, 'fa-yelp', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (485, 'fa-youtube', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (486, 'fa-youtube-play', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (487, 'fa-youtube-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (488, 'fa-ambulance', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (489, 'fa-h-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (490, 'fa-hospital-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (491, 'fa-medkit', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (492, 'fa-plus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (493, 'fa-stethoscope', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (494, 'fa-user-md', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (495, ' fa-wheelchair', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (496, 'fa-file', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (497, 'fa-file-archive-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (498, 'fa-file-audio-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (499, 'fa-file-code-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (500, 'fa-file-excel-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (501, 'fa-file-image-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (502, 'fa-file-movie-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (503, 'fa-file-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (504, 'fa-file-pdf-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (505, 'fa-file-photo-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (506, 'fa-file-picture-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (507, 'fa-file-powerpoint-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (508, 'fa-file-sound-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (509, 'fa-file-text', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (510, 'fa-file-text-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (511, 'fa-file-video-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (512, ' fa-file-word-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (513, 'fa-file-zip-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (514, 'fa-align-center', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (515, 'fa-align-justify', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (516, ' fa-align-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (517, 'fa-align-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (518, 'fa-bold', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (519, ' fa-chain', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (520, 'fa-chain-broken', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (521, ' fa-clipboard', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (522, 'fa-columns', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (523, 'fa-copy', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (524, 'fa-cut', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (525, 'fa-dedent', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (526, ' fa-eraser', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (527, 'fa-file', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (528, 'fa-file-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (529, ' fa-file-text', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (530, 'fa-file-text-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (531, 'fa-files-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (532, 'fa-floppy-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (533, 'fa-font', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (534, 'fa-header', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (535, ' fa-indent', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (536, ' fa-italic', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (537, ' fa-link', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (538, 'fa-list', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (539, 'fa-list-alt', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (540, 'fa-list-ol', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (541, 'fa-list-ul', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (542, 'fa-outdent', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (543, 'fa-paperclip', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (544, 'fa-paragraph', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (545, 'fa-paste', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (546, 'fa-repeat', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (547, 'fa-rotate-left', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (548, 'fa-rotate-right', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (549, ' fa-save', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (550, ' fa-scissors', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (551, ' fa-strikethrough', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (552, 'fa-subscript', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (553, ' fa-superscript', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (554, 'fa-table', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (555, 'fa-text-height', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (556, 'fa-text-width', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (557, 'fa-th', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (558, 'fa-th-large', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (559, 'fa-th-list', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (560, ' fa-underline', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (561, 'fa-undo', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (562, ' fa-unlink', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (563, 'fa-check-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (564, 'fa-check-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (565, 'fa-circle', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (566, 'fa-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (567, 'fa-dot-circle-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (568, 'fa-minus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (569, 'fa-minus-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (570, 'fa-plus-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (571, 'fa-plus-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (572, 'fa-square', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (573, ' fa-square-o', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (574, 'fa-circle-o-notch', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (575, 'fa-cog', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (576, 'fa-gear ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (577, ' fa-refresh', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (578, 'fa-spinner', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (579, 'fa-cc-amex', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (580, 'fa-cc-discover', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (581, 'fa-cc-mastercard', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (582, 'fa-cc-paypal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (583, ' fa-cc-stripe', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (584, 'fa-cc-visa', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (585, 'fa-credit-card', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (586, 'fa-google-wallet', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (587, 'fa-paypal', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (588, 'fa-area-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (589, 'fa-bar-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (590, 'fa-bar-chart-o ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (591, 'fa-line-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (592, 'fa-pie-chart', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (593, 'fa-bitcoin', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (594, ' fa-btc', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (595, 'fa-cny', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (596, 'fa-dollar', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (597, 'fa-eur', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (598, 'fa-euro', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (599, 'fa-gbp', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (600, ' fa-ils', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (601, 'fa-inr', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (602, 'fa-jpy', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (603, ' fa-krw', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (604, 'fa-money', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (605, 'fa-rmb ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (606, 'fa-rouble', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (607, 'fa-rub', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (608, 'fa-ruble', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (609, 'fa-rupee ', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (610, 'fa-shekel', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (611, ' fa-sheqel', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (612, 'fa-try', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (613, 'fa-turkish-lira', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (614, 'fa-usd', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (615, 'fa-won', 1565231486, 1, NULL);
INSERT INTO `on_icon` VALUES (616, 'fa fa-yen', 1565231486, 1, NULL);

-- ----------------------------
-- Table structure for on_log
-- ----------------------------
DROP TABLE IF EXISTS `on_log`;
CREATE TABLE `on_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL COMMENT '行为id',
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `IP` varchar(34) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'IP地址',
  `browser` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录浏览器',
  `os` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录系统',
  `model` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '说明',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 187 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '日志' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_log
-- ----------------------------
INSERT INTO `on_log` VALUES (1, 1, 1, '127.0.0.1', 'chrome-74', 'Windows 7', 'admin', '登录成功', 1, 1563170072);
INSERT INTO `on_log` VALUES (2, 1, 2, '127.0.0.1', 'chrome-63', 'Windows 7', 'index', '登录成功', 1, 1563170072);
INSERT INTO `on_log` VALUES (3, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1563170072);
INSERT INTO `on_log` VALUES (4, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1563170072);
INSERT INTO `on_log` VALUES (5, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566179360);
INSERT INTO `on_log` VALUES (6, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录失败账号或者密码错误', 1, 1566179801);
INSERT INTO `on_log` VALUES (7, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566179830);
INSERT INTO `on_log` VALUES (8, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566261102);
INSERT INTO `on_log` VALUES (9, 4, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '添加了123菜单', 1, 1566292584);
INSERT INTO `on_log` VALUES (10, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566293020);
INSERT INTO `on_log` VALUES (11, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566293259);
INSERT INTO `on_log` VALUES (12, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '日志删除', 1, 1566293315);
INSERT INTO `on_log` VALUES (13, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '日志删除', 1, 1566293390);
INSERT INTO `on_log` VALUES (14, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566348195);
INSERT INTO `on_log` VALUES (15, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为1日志被删除', 1, 1566348627);
INSERT INTO `on_log` VALUES (16, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为15的日志被删除', 1, 1566348874);
INSERT INTO `on_log` VALUES (17, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为7,6的日志被删除', 1, 1566348882);
INSERT INTO `on_log` VALUES (18, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为8的角色被删除', 1, 1566349483);
INSERT INTO `on_log` VALUES (19, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '给账号id为9成功授予了角色', 1, 1566350283);
INSERT INTO `on_log` VALUES (20, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '添加了test21角色', 1, 1566350986);
INSERT INTO `on_log` VALUES (21, 2, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '编辑了id为的角色信息', 1, 1566351061);
INSERT INTO `on_log` VALUES (22, 2, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '编辑了id为11的角色信息', 1, 1566351100);
INSERT INTO `on_log` VALUES (23, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为10的角色被删除', 1, 1566351137);
INSERT INTO `on_log` VALUES (24, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为6,7,9,11的角色被删除', 1, 1566351326);
INSERT INTO `on_log` VALUES (25, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为6,7,8的角色被删除', 1, 1566351381);
INSERT INTO `on_log` VALUES (26, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为5的角色被删除', 1, 1566352296);
INSERT INTO `on_log` VALUES (27, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '给id为2的角色添加了权限', 1, 1566352389);
INSERT INTO `on_log` VALUES (28, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为51的菜单被删除', 1, 1566352410);
INSERT INTO `on_log` VALUES (29, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为52的日志被删除', 1, 1566352430);
INSERT INTO `on_log` VALUES (30, 2, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '编辑了ID为39的菜单', 1, 1566352459);
INSERT INTO `on_log` VALUES (31, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '添加了--123--菜单', 1, 1566352530);
INSERT INTO `on_log` VALUES (32, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '给账号id为2成功授予了角色', 1, 1566352561);
INSERT INTO `on_log` VALUES (33, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '添加了id为46的账号信息', 1, 1566352622);
INSERT INTO `on_log` VALUES (34, 7, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '批量删除了id为45,46的账号信息', 1, 1566352633);
INSERT INTO `on_log` VALUES (35, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', 'id为39的菜单被删除', 1, 1566352952);
INSERT INTO `on_log` VALUES (36, 6, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '删除了id为4的行为信息', 1, 1566353098);
INSERT INTO `on_log` VALUES (37, 2, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '修改了id为3的行为信息', 1, 1566354386);
INSERT INTO `on_log` VALUES (38, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566356217);
INSERT INTO `on_log` VALUES (39, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566356963);
INSERT INTO `on_log` VALUES (40, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566357125);
INSERT INTO `on_log` VALUES (41, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566357173);
INSERT INTO `on_log` VALUES (42, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566357195);
INSERT INTO `on_log` VALUES (43, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566357261);
INSERT INTO `on_log` VALUES (44, 1, 2, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录失败账号或者密码错误', 1, 1566367085);
INSERT INTO `on_log` VALUES (45, 2, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '修改了id为账号的密码', 1, 1566367167);
INSERT INTO `on_log` VALUES (46, 1, 2, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566367195);
INSERT INTO `on_log` VALUES (47, 1, 2, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566367489);
INSERT INTO `on_log` VALUES (48, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566367546);
INSERT INTO `on_log` VALUES (49, 1, 2, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566367560);
INSERT INTO `on_log` VALUES (50, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566367580);
INSERT INTO `on_log` VALUES (51, 8, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '给账号id为2成功授予了角色', 1, 1566367605);
INSERT INTO `on_log` VALUES (52, 1, 2, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566368196);
INSERT INTO `on_log` VALUES (53, 1, 2, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566371217);
INSERT INTO `on_log` VALUES (54, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录失败账号或者密码错误', 1, 1566434712);
INSERT INTO `on_log` VALUES (55, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566435309);
INSERT INTO `on_log` VALUES (56, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566435960);
INSERT INTO `on_log` VALUES (57, 1, 1, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566436068);
INSERT INTO `on_log` VALUES (58, 1, 1, '127.0.0.1', '未知浏览器 ', '未知操作系统', 'admin', '登录成功', 1, 1566439470);
INSERT INTO `on_log` VALUES (59, 1, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 7', 'admin', '登录成功', 1, 1566440934);
INSERT INTO `on_log` VALUES (60, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Linux', 'admin', '导出日志表格', 1, 1566440981);
INSERT INTO `on_log` VALUES (61, 5, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '导出日志表格', 1, 1566441001);
INSERT INTO `on_log` VALUES (62, 5, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '导出日志表格', 1, 1566441029);
INSERT INTO `on_log` VALUES (63, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441076);
INSERT INTO `on_log` VALUES (64, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为32成功授予了角色', 1, 1566441156);
INSERT INTO `on_log` VALUES (65, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为31成功授予了角色', 1, 1566441165);
INSERT INTO `on_log` VALUES (66, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为30成功授予了角色', 1, 1566441169);
INSERT INTO `on_log` VALUES (67, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为29成功授予了角色', 1, 1566441174);
INSERT INTO `on_log` VALUES (68, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为28成功授予了角色', 1, 1566441180);
INSERT INTO `on_log` VALUES (69, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为20成功授予了角色', 1, 1566441186);
INSERT INTO `on_log` VALUES (70, 8, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '给账号id为9成功授予了角色', 1, 1566441198);
INSERT INTO `on_log` VALUES (71, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441222);
INSERT INTO `on_log` VALUES (72, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441224);
INSERT INTO `on_log` VALUES (73, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441227);
INSERT INTO `on_log` VALUES (74, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441229);
INSERT INTO `on_log` VALUES (75, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441231);
INSERT INTO `on_log` VALUES (76, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441239);
INSERT INTO `on_log` VALUES (77, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441249);
INSERT INTO `on_log` VALUES (78, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441250);
INSERT INTO `on_log` VALUES (79, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441252);
INSERT INTO `on_log` VALUES (80, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441253);
INSERT INTO `on_log` VALUES (81, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441253);
INSERT INTO `on_log` VALUES (82, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441254);
INSERT INTO `on_log` VALUES (83, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441254);
INSERT INTO `on_log` VALUES (84, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441255);
INSERT INTO `on_log` VALUES (85, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441255);
INSERT INTO `on_log` VALUES (86, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441255);
INSERT INTO `on_log` VALUES (87, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441255);
INSERT INTO `on_log` VALUES (88, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441256);
INSERT INTO `on_log` VALUES (89, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441256);
INSERT INTO `on_log` VALUES (90, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441256);
INSERT INTO `on_log` VALUES (91, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441256);
INSERT INTO `on_log` VALUES (92, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441257);
INSERT INTO `on_log` VALUES (93, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441257);
INSERT INTO `on_log` VALUES (94, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441257);
INSERT INTO `on_log` VALUES (95, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441258);
INSERT INTO `on_log` VALUES (96, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441258);
INSERT INTO `on_log` VALUES (97, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441258);
INSERT INTO `on_log` VALUES (98, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441258);
INSERT INTO `on_log` VALUES (99, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441259);
INSERT INTO `on_log` VALUES (100, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441259);
INSERT INTO `on_log` VALUES (101, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441259);
INSERT INTO `on_log` VALUES (102, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441260);
INSERT INTO `on_log` VALUES (103, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441260);
INSERT INTO `on_log` VALUES (104, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441260);
INSERT INTO `on_log` VALUES (105, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441261);
INSERT INTO `on_log` VALUES (106, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441261);
INSERT INTO `on_log` VALUES (107, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441261);
INSERT INTO `on_log` VALUES (108, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441261);
INSERT INTO `on_log` VALUES (109, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441262);
INSERT INTO `on_log` VALUES (110, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441262);
INSERT INTO `on_log` VALUES (111, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441262);
INSERT INTO `on_log` VALUES (112, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441263);
INSERT INTO `on_log` VALUES (113, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441263);
INSERT INTO `on_log` VALUES (114, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441263);
INSERT INTO `on_log` VALUES (115, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441264);
INSERT INTO `on_log` VALUES (116, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441264);
INSERT INTO `on_log` VALUES (117, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441264);
INSERT INTO `on_log` VALUES (118, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441264);
INSERT INTO `on_log` VALUES (119, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441265);
INSERT INTO `on_log` VALUES (120, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441265);
INSERT INTO `on_log` VALUES (121, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441265);
INSERT INTO `on_log` VALUES (122, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441266);
INSERT INTO `on_log` VALUES (123, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441863);
INSERT INTO `on_log` VALUES (124, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441864);
INSERT INTO `on_log` VALUES (125, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441864);
INSERT INTO `on_log` VALUES (126, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441865);
INSERT INTO `on_log` VALUES (127, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441865);
INSERT INTO `on_log` VALUES (128, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441866);
INSERT INTO `on_log` VALUES (129, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566441866);
INSERT INTO `on_log` VALUES (130, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441881);
INSERT INTO `on_log` VALUES (131, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441881);
INSERT INTO `on_log` VALUES (132, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441881);
INSERT INTO `on_log` VALUES (133, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441882);
INSERT INTO `on_log` VALUES (134, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441882);
INSERT INTO `on_log` VALUES (135, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441882);
INSERT INTO `on_log` VALUES (136, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441883);
INSERT INTO `on_log` VALUES (137, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441883);
INSERT INTO `on_log` VALUES (138, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441883);
INSERT INTO `on_log` VALUES (139, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441905);
INSERT INTO `on_log` VALUES (140, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441905);
INSERT INTO `on_log` VALUES (141, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441905);
INSERT INTO `on_log` VALUES (142, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441906);
INSERT INTO `on_log` VALUES (143, 5, 1, '127.0.0.1', 'Edge 18.17763', 'Windows 10', 'admin', '导出日志表格', 1, 1566441906);
INSERT INTO `on_log` VALUES (144, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441933);
INSERT INTO `on_log` VALUES (145, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441934);
INSERT INTO `on_log` VALUES (146, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441934);
INSERT INTO `on_log` VALUES (147, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441934);
INSERT INTO `on_log` VALUES (148, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441935);
INSERT INTO `on_log` VALUES (149, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441935);
INSERT INTO `on_log` VALUES (150, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441935);
INSERT INTO `on_log` VALUES (151, 5, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '导出日志表格', 1, 1566441936);
INSERT INTO `on_log` VALUES (152, 5, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '导出日志表格', 1, 1566442009);
INSERT INTO `on_log` VALUES (153, 5, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '导出日志表格', 1, 1566442023);
INSERT INTO `on_log` VALUES (154, 5, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '导出日志表格', 1, 1566442043);
INSERT INTO `on_log` VALUES (155, 1, 1, '127.0.0.1', 'Firefox 60.8', 'Windows 10', 'admin', '登录成功', 1, 1566444500);
INSERT INTO `on_log` VALUES (156, 1, 2, '127.0.0.1', 'IE 11.0', 'Windows 7', 'admin', '登录成功', 1, 1566444606);
INSERT INTO `on_log` VALUES (157, 1, 2, '127.0.0.1', 'IE 11.0', 'Windows 7', 'admin', '登录失败账号或者密码错误', 1, 1566444620);
INSERT INTO `on_log` VALUES (158, 1, 1, '127.0.0.1', 'IE 11.0', 'Windows 7', 'admin', '登录成功', 1, 1566451612);
INSERT INTO `on_log` VALUES (159, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566451677);
INSERT INTO `on_log` VALUES (160, 1, 2, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566452021);
INSERT INTO `on_log` VALUES (161, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566452376);
INSERT INTO `on_log` VALUES (162, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566452658);
INSERT INTO `on_log` VALUES (163, 1, 1, '127.0.0.1', 'safari 605.1.15', 'SunOS', 'admin', '登录成功', 1, 1566452685);
INSERT INTO `on_log` VALUES (164, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566454246);
INSERT INTO `on_log` VALUES (165, 1, 1, '127.0.0.1', 'Firefox 68.0', 'Linux', 'admin', '登录成功', 1, 1566454377);
INSERT INTO `on_log` VALUES (166, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566454525);
INSERT INTO `on_log` VALUES (167, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566454571);
INSERT INTO `on_log` VALUES (168, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566455006);
INSERT INTO `on_log` VALUES (169, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566455200);
INSERT INTO `on_log` VALUES (170, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566455443);
INSERT INTO `on_log` VALUES (171, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566455828);
INSERT INTO `on_log` VALUES (172, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566456429);
INSERT INTO `on_log` VALUES (173, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566456568);
INSERT INTO `on_log` VALUES (174, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566456749);
INSERT INTO `on_log` VALUES (175, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566456781);
INSERT INTO `on_log` VALUES (176, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录失败账号或者密码错误', 1, 1566456943);
INSERT INTO `on_log` VALUES (177, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566456959);
INSERT INTO `on_log` VALUES (178, 1, 1, '127.0.0.1', 'Firefox 68.0', 'Windows 10', 'admin', '登录成功', 1, 1566457113);
INSERT INTO `on_log` VALUES (179, 1, 1, '127.0.0.1', 'IE 11.0', 'Windows 7', 'admin', '登录成功', 1, 1566457173);
INSERT INTO `on_log` VALUES (180, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566457883);
INSERT INTO `on_log` VALUES (181, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566458138);
INSERT INTO `on_log` VALUES (182, 5, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '导出日志表格', 1, 1566458203);
INSERT INTO `on_log` VALUES (183, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566459159);
INSERT INTO `on_log` VALUES (184, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566459296);
INSERT INTO `on_log` VALUES (185, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566459433);
INSERT INTO `on_log` VALUES (186, 1, 1, '127.0.0.1', 'Chrome 75.0.3770.142', 'Windows 7', 'admin', '登录成功', 1, 1566459853);

-- ----------------------------
-- Table structure for on_module
-- ----------------------------
DROP TABLE IF EXISTS `on_module`;
CREATE TABLE `on_module`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模块id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '模块名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_module
-- ----------------------------
INSERT INTO `on_module` VALUES (1, 'admin');
INSERT INTO `on_module` VALUES (2, 'index');

-- ----------------------------
-- Table structure for on_permission
-- ----------------------------
DROP TABLE IF EXISTS `on_permission`;
CREATE TABLE `on_permission`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '路由',
  `module_id` int(50) NOT NULL COMMENT '模块名id',
  `controller` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器名',
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法名',
  `icon_id` int(11) NULL DEFAULT NULL COMMENT '权限图标id',
  `level` int(11) NULL DEFAULT 0 COMMENT '级别',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `display_menu` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否在右侧导航展示',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父级id',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1有效0无效',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `model`(`module_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 54 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_permission
-- ----------------------------
INSERT INTO `on_permission` VALUES (2, '角色管理', 'role/index', 1, 'role', 'index', NULL, 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (1, '后台首页', 'index/index', 1, '', '', 84, 0, 0, 1, 0, 1, 1563170072, 1565856711);
INSERT INTO `on_permission` VALUES (3, '添加角色', 'role/add', 1, 'role', 'add', NULL, 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (4, '权限分配', 'role/store', 1, 'role', 'store', NULL, 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (5, '编辑角色', 'role/edit', 1, 'role', 'edit', NULL, 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (6, '批量删除', 'role/deletes', 1, 'role', 'deletes', NULL, 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (7, '删除角色', 'role/delete', 1, 'role', 'delete', NULL, 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (8, '权限管理', 'permission/index', 1, 'permission', 'index', NULL, 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (9, '添加权限', 'permission/add', 1, 'permission', 'add', NULL, 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (10, '创建权限', 'permission/store', 1, 'permission', 'store', NULL, 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (11, '编辑权限', 'permission/edit', 1, 'permission', 'edit', NULL, 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (12, '批量删除', 'permission/deletes', 1, 'permission', 'deletes', NULL, 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (13, '删除权限', 'permission/delete', 1, 'permission', 'delete', NULL, 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (14, '管理员管理', 'admin/index', 1, 'admin', 'index', NULL, 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (15, '添加管理员', 'admin/add', 1, 'admin', 'add', NULL, 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (16, '状态管理', 'admin/store', 1, 'admin', 'store', NULL, 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (17, '编辑管理员', 'admin/editPass', 1, 'admin', 'editPass', NULL, 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (18, '批量删除', 'admin/deletes', 1, 'admin', 'deletes', NULL, 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (19, '删除管理员', 'admin/delete', 1, 'admin', 'delete', NULL, 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (20, '员工管理', 'admin/admin', 1, '', '', 311, 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (27, '管理员列表', 'admin/index', 1, 'admin', 'index', NULL, 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (26, '权限列表', 'permission/index', 1, 'permission', 'index', NULL, 2, 0, 0, 8, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (21, '测试', 'test/index', 1, 'test', 'index', NULL, 0, 0, 1, 0, 0, 1501686013, 1565148753);
INSERT INTO `on_permission` VALUES (22, '首页', 'index/index', 1, 'index', 'index', NULL, 1, 0, 1, 1, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (23, 'test', 'tess/index', 1, 'tess', 'index', NULL, 0, 0, 1, 0, 0, 1501686013, 1565147275);
INSERT INTO `on_permission` VALUES (24, '个人中心', 'admin/edit', 1, 'admin', 'edit', NULL, 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (25, '分配角色', 'admin/addRole', 1, 'admin', 'addRole', NULL, 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (28, '角色列表', 'role/index', 1, 'role', 'index', NULL, 2, 0, 0, 2, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (33, '系统管理', 'system/index', 1, 'system', 'index', 69, 0, 0, 1, 0, 1, 1565318074, 1565318074);
INSERT INTO `on_permission` VALUES (34, '日志管理', 'log/index', 1, 'log', 'index', NULL, 0, 0, 1, 33, 1, 1565318670, 1565318670);
INSERT INTO `on_permission` VALUES (35, '日志列表', 'log/index', 1, 'log', 'index', NULL, 0, 0, 1, 34, 1, 1565318748, 1565318748);
INSERT INTO `on_permission` VALUES (36, '日志清空', 'log/clear', 1, 'log', 'clear', NULL, 0, 0, 1, 34, 1, 1565318797, 1565318895);
INSERT INTO `on_permission` VALUES (37, '日志删除', 'log/delete', 1, 'log', 'delete', NULL, 0, 0, 0, 34, 1, 1565318825, 1565318825);
INSERT INTO `on_permission` VALUES (38, '批量删除', 'log/deletes', 1, 'log', 'deletes', NULL, 0, 0, 0, 34, 1, 1565318854, 1565318854);
INSERT INTO `on_permission` VALUES (39, '日志查看1', 'log/read', 1, 'log', 'read', NULL, 0, 0, 1, 34, 0, 1565318880, 1566352952);
INSERT INTO `on_permission` VALUES (40, '行为日志', 'action/index', 1, 'action', 'index', NULL, 0, 0, 1, 33, 1, 1565850048, 1565850048);
INSERT INTO `on_permission` VALUES (41, '行为列表', 'action/index', 1, 'action', 'index', NULL, 0, 0, 0, 40, 1, 1565850103, 1565850103);
INSERT INTO `on_permission` VALUES (42, '行为删除', 'action/delete', 1, 'action', 'delete', NULL, 0, 0, 0, 40, 1, 1565850140, 1565850140);
INSERT INTO `on_permission` VALUES (43, '批量删除', 'action/deletes', 1, 'action', 'deletes', NULL, 0, 0, 0, 40, 1, 1565850159, 1565850159);
INSERT INTO `on_permission` VALUES (44, '行为添加', 'action/add', 1, 'action', 'add', NULL, 0, 0, 0, 40, 1, 1565850190, 1565850190);
INSERT INTO `on_permission` VALUES (45, '行为编辑', 'action/edit', 1, 'action', 'edit', NULL, 0, 0, 0, 40, 1, 1565850220, 1565850220);
INSERT INTO `on_permission` VALUES (46, '日志导出', 'log/derive', 1, 'log', 'derive', NULL, 0, 0, 0, 34, 1, 1565850780, 1565922484);

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
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_role
-- ----------------------------
INSERT INTO `on_role` VALUES (1, 'admin', '管理员', 1, 1563170072, 1563170072);
INSERT INTO `on_role` VALUES (2, 'test111', '测试10', 1, 1563170072, 1565145017);
INSERT INTO `on_role` VALUES (3, 'test1', '测试1', 1, 1563170072, 1565145012);
INSERT INTO `on_role` VALUES (4, 'test2', '测试2', 1, 1563170072, 1564722389);
INSERT INTO `on_role` VALUES (5, 'test3', '测试3', 0, 1563170072, 1566352295);
INSERT INTO `on_role` VALUES (6, 'test4', '测试4', 0, 1563170072, 1566351381);
INSERT INTO `on_role` VALUES (7, 'test5', '测试5', 0, 1563170072, 1566351381);
INSERT INTO `on_role` VALUES (8, 'test7', '测试7', 0, 1564730259, 1566351381);
INSERT INTO `on_role` VALUES (9, 'test81', '测试81', 0, 1564730271, 1566351326);
INSERT INTO `on_role` VALUES (10, 'test10', '测试10', 0, 1564732635, 1566351137);
INSERT INTO `on_role` VALUES (11, 'test21', '测试21', 0, 1566350986, 1566351326);

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
INSERT INTO `on_role_permission` VALUES (4, 1, '1,22,20,2,28,8,26,14,15,16,27,24,25,33,34,35,39,46,40,41,44,45', 0);
INSERT INTO `on_role_permission` VALUES (3, 2, '1,22,20,2,28,8,26,14,15,16,27,24,25,33,34,35', 0);

SET FOREIGN_KEY_CHECKS = 1;
