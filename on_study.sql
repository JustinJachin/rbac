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

 Date: 07/08/2019 17:27:04
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin
-- ----------------------------
INSERT INTO `on_admin` VALUES (1, 'admin', 'on490bc47ffe57e67f88e681c577f430e1', 1, 'admin@qq.com', 0, 1, 1557898848, 1565143629, 1564558418, 1565143629, '127.0.0.1');
INSERT INTO `on_admin` VALUES (2, 'justin', 'on6559c2b7caad120d5d85b85bd1b88561', 1, 'justin1@qq.com', 1, 1, 1557898848, 1565145065, 1564558418, 1565145065, '127.0.0.1');
INSERT INTO `on_admin` VALUES (32, 'mooke', 'on47288b0def8776d233329db248e37188', 0, 'mooke@qq.com', 1, 1, 1564539804, 1564539804, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (10, 'niki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '5@qq.com', 1, 1, 1564470214, 1564558418, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (9, 'yuki', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, '3@qq.com', 1, 0, 1564469023, 1565144564, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (8, 'jack', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '2@qq.com', 1, 2, 1564468966, 1564558670, 1564558670, NULL, NULL);
INSERT INTO `on_admin` VALUES (13, 'jeannie', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'qq@qq.com', 1, 0, 1564470563, 1564713995, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (11, 'banks', 'onc1053fbf10e6253b3f41e18307543bd6', 1, '6@qq.com', 1, 0, 1564470433, 1564713982, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (12, 'willy', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '7@qq.com', 1, 0, 1564470455, 1564559786, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (14, 'lily', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'we@qq.com', 1, 1, 1564470601, 1564558418, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (15, 'anna', 'on5e2680c87b294fe0dd00c076b7afe1b4', 0, 'ef@qq.com', 1, 1, 1564470641, 1564558418, 1564558418, NULL, NULL);
INSERT INTO `on_admin` VALUES (16, 'ella', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ella@qq.com', 1, 1, 1564470669, 1564470669, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (17, 'ava', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'ava@qq.com', 1, 1, 1564470688, 1564470688, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (18, 'emma', 'on5e2680c87b294fe0dd00c076b7afe1b4', 2, 'emma@qq.com', 1, 1, 1564470723, 1564470723, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (19, 'john', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'john@qq.com', 1, 1, 1564470765, 1564470765, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (20, 'jordan', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'jordan@qq.com', 1, 1, 1564470791, 1564470791, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (21, 'aiden', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'aiden@qq.com', 1, 1, 1564470810, 1564470810, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (34, 'youhn', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, 'youhn@qq.com', 1, 2, 1564539899, 1565147494, 1564549971, NULL, NULL);
INSERT INTO `on_admin` VALUES (33, 'mookee', 'on47288b0def8776d233329db248e37188', 0, 'mookee@qq.com', 1, 2, 1564539834, 1565147494, 1564550003, NULL, NULL);
INSERT INTO `on_admin` VALUES (28, 'juck', 'on47288b0def8776d233329db248e37188', 1, 'juck@qq.com', 1, 1, 1564539465, 1564539465, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (29, 'molera', 'on47288b0def8776d233329db248e37188', 1, 'molera@qq.com', 1, 1, 1564539496, 1564539496, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (30, 'jacka', 'on47288b0def8776d233329db248e37188', 1, 'jacka@qq.com', 1, 1, 1564539565, 1564539565, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (31, 'julye', 'on47288b0def8776d233329db248e37188', 0, 'julye@163.com', 1, 1, 1564539718, 1564539718, NULL, NULL, NULL);
INSERT INTO `on_admin` VALUES (44, '1233', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '1223@qq.com', 1, 2, 1564540426, 1565147494, 1564549866, NULL, NULL);
INSERT INTO `on_admin` VALUES (43, '123', 'on5e2680c87b294fe0dd00c076b7afe1b4', 1, '123@qq.com', 1, 2, 1564540402, 1564549927, 1564549927, NULL, NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户与角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_admin_role
-- ----------------------------
INSERT INTO `on_admin_role` VALUES (1, 2, '1', 1563170072);
INSERT INTO `on_admin_role` VALUES (3, 9, '2，6，7', 1565144570);

-- ----------------------------
-- Table structure for on_icon
-- ----------------------------
DROP TABLE IF EXISTS `on_icon`;
CREATE TABLE `on_icon`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图标id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标名',
  `create_time` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '是否被删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 214 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_icon
-- ----------------------------
INSERT INTO `on_icon` VALUES (25, 'icon-user', '1565163133', 1);
INSERT INTO `on_icon` VALUES (26, 'icon-people', '1565163133', 1);
INSERT INTO `on_icon` VALUES (27, 'icon-user-female', '1565163133', 1);
INSERT INTO `on_icon` VALUES (28, 'icon-user-follow', '1565163133', 1);
INSERT INTO `on_icon` VALUES (29, 'icon-user-following', '1565163133', 1);
INSERT INTO `on_icon` VALUES (30, 'icon-user-unfollow', '1565163133', 1);
INSERT INTO `on_icon` VALUES (31, 'icon-login', '1565163133', 1);
INSERT INTO `on_icon` VALUES (32, 'icon-logout', '1565163133', 1);
INSERT INTO `on_icon` VALUES (33, 'icon-emotsmile', '1565163133', 1);
INSERT INTO `on_icon` VALUES (34, 'icon-phone', '1565163133', 1);
INSERT INTO `on_icon` VALUES (35, 'icon-call-end', '1565163133', 1);
INSERT INTO `on_icon` VALUES (36, 'icon-call-in', '1565163133', 1);
INSERT INTO `on_icon` VALUES (37, 'icon-call-out', '1565163133', 1);
INSERT INTO `on_icon` VALUES (38, 'icon-map', '1565163133', 1);
INSERT INTO `on_icon` VALUES (39, 'icon-location-pin', '1565163133', 1);
INSERT INTO `on_icon` VALUES (40, 'icon-direction', '1565163133', 1);
INSERT INTO `on_icon` VALUES (41, 'icon-directions', '1565163133', 1);
INSERT INTO `on_icon` VALUES (42, 'icon-compass', '1565163133', 1);
INSERT INTO `on_icon` VALUES (43, 'icon-layers', '1565163133', 1);
INSERT INTO `on_icon` VALUES (44, 'icon-menu', '1565163133', 1);
INSERT INTO `on_icon` VALUES (45, 'icon-list', '1565163133', 1);
INSERT INTO `on_icon` VALUES (46, 'icon-options-vertical', '1565163133', 1);
INSERT INTO `on_icon` VALUES (47, 'icon-options', '1565163133', 1);
INSERT INTO `on_icon` VALUES (48, 'icon-arrow-down', '1565163133', 1);
INSERT INTO `on_icon` VALUES (49, 'icon-arrow-left', '1565163133', 1);
INSERT INTO `on_icon` VALUES (50, 'icon-arrow-right', '1565163133', 1);
INSERT INTO `on_icon` VALUES (51, 'icon-arrow-up', '1565163133', 1);
INSERT INTO `on_icon` VALUES (52, 'icon-arrow-up-circle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (53, 'icon-arrow-left-circle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (54, 'icon-arrow-right-circle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (55, 'icon-arrow-down-circle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (56, 'icon-check', '1565163133', 1);
INSERT INTO `on_icon` VALUES (57, 'icon-clock', '1565163133', 1);
INSERT INTO `on_icon` VALUES (58, 'icon-plus', '1565163133', 1);
INSERT INTO `on_icon` VALUES (59, 'icon-minus', '1565163133', 1);
INSERT INTO `on_icon` VALUES (60, 'icon-close', '1565163133', 1);
INSERT INTO `on_icon` VALUES (61, 'icon-event', '1565163133', 1);
INSERT INTO `on_icon` VALUES (62, 'icon-exclamation', '1565163133', 1);
INSERT INTO `on_icon` VALUES (63, 'icon-organization', '1565163133', 1);
INSERT INTO `on_icon` VALUES (64, 'icon-trophy', '1565163133', 1);
INSERT INTO `on_icon` VALUES (65, 'icon-screen-smartphone', '1565163133', 1);
INSERT INTO `on_icon` VALUES (66, 'icon-screen-desktop', '1565163133', 1);
INSERT INTO `on_icon` VALUES (67, 'icon-plane', '1565163133', 1);
INSERT INTO `on_icon` VALUES (68, 'icon-notebook', '1565163133', 1);
INSERT INTO `on_icon` VALUES (69, 'icon-mustache', '1565163133', 1);
INSERT INTO `on_icon` VALUES (70, 'icon-mouse', '1565163133', 1);
INSERT INTO `on_icon` VALUES (71, 'icon-magnet', '1565163133', 1);
INSERT INTO `on_icon` VALUES (72, 'icon-energy', '1565163133', 1);
INSERT INTO `on_icon` VALUES (73, 'icon-disc', '1565163133', 1);
INSERT INTO `on_icon` VALUES (74, 'icon-cursor', '1565163133', 1);
INSERT INTO `on_icon` VALUES (75, 'icon-cursor-move', '1565163133', 1);
INSERT INTO `on_icon` VALUES (76, 'icon-crop', '1565163133', 1);
INSERT INTO `on_icon` VALUES (77, 'icon-chemistry', '1565163133', 1);
INSERT INTO `on_icon` VALUES (78, 'icon-speedometer', '1565163133', 1);
INSERT INTO `on_icon` VALUES (79, 'icon-shield', '1565163133', 1);
INSERT INTO `on_icon` VALUES (80, 'icon-screen-tablet', '1565163133', 1);
INSERT INTO `on_icon` VALUES (81, 'icon-magic-wand', '1565163133', 1);
INSERT INTO `on_icon` VALUES (82, 'icon-hourglass', '1565163133', 1);
INSERT INTO `on_icon` VALUES (83, 'icon-graduation', '1565163133', 1);
INSERT INTO `on_icon` VALUES (84, 'icon-ghost', '1565163133', 1);
INSERT INTO `on_icon` VALUES (85, 'icon-game-controller', '1565163133', 1);
INSERT INTO `on_icon` VALUES (86, 'icon-fire', '1565163133', 1);
INSERT INTO `on_icon` VALUES (87, 'icon-eyeglass', '1565163133', 1);
INSERT INTO `on_icon` VALUES (88, 'icon-envelope-open', '1565163133', 1);
INSERT INTO `on_icon` VALUES (89, 'icon-envelope-letter', '1565163133', 1);
INSERT INTO `on_icon` VALUES (90, 'icon-bell', '1565163133', 1);
INSERT INTO `on_icon` VALUES (91, 'icon-badge', '1565163133', 1);
INSERT INTO `on_icon` VALUES (92, 'icon-anchor', '1565163133', 1);
INSERT INTO `on_icon` VALUES (93, 'icon-wallet', '1565163133', 1);
INSERT INTO `on_icon` VALUES (94, 'icon-vector', '1565163133', 1);
INSERT INTO `on_icon` VALUES (95, 'icon-speech', '1565163133', 1);
INSERT INTO `on_icon` VALUES (96, 'icon-puzzle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (97, 'icon-printer', '1565163133', 1);
INSERT INTO `on_icon` VALUES (98, 'icon-present', '1565163133', 1);
INSERT INTO `on_icon` VALUES (99, 'icon-playlist', '1565163133', 1);
INSERT INTO `on_icon` VALUES (100, 'icon-pin', '1565163133', 1);
INSERT INTO `on_icon` VALUES (101, 'icon-picture', '1565163133', 1);
INSERT INTO `on_icon` VALUES (102, 'icon-handbag', '1565163133', 1);
INSERT INTO `on_icon` VALUES (103, 'icon-globe-alt', '1565163133', 1);
INSERT INTO `on_icon` VALUES (104, 'icon-globe', '1565163133', 1);
INSERT INTO `on_icon` VALUES (105, 'icon-folder-alt', '1565163133', 1);
INSERT INTO `on_icon` VALUES (106, 'icon-folder', '1565163133', 1);
INSERT INTO `on_icon` VALUES (107, 'icon-film', '1565163133', 1);
INSERT INTO `on_icon` VALUES (108, 'icon-feed', '1565163133', 1);
INSERT INTO `on_icon` VALUES (109, 'icon-drop', '1565163133', 1);
INSERT INTO `on_icon` VALUES (110, 'icon-drawer', '1565163133', 1);
INSERT INTO `on_icon` VALUES (111, 'icon-docs', '1565163133', 1);
INSERT INTO `on_icon` VALUES (112, 'icon-doc', '1565163133', 1);
INSERT INTO `on_icon` VALUES (113, 'icon-diamond', '1565163133', 1);
INSERT INTO `on_icon` VALUES (114, 'icon-cup', '1565163133', 1);
INSERT INTO `on_icon` VALUES (115, 'icon-calculator', '1565163133', 1);
INSERT INTO `on_icon` VALUES (116, 'icon-bubbles', '1565163133', 1);
INSERT INTO `on_icon` VALUES (117, 'icon-briefcase', '1565163133', 1);
INSERT INTO `on_icon` VALUES (118, 'icon-book-open', '1565163133', 1);
INSERT INTO `on_icon` VALUES (119, 'icon-basket-loaded', '1565163133', 1);
INSERT INTO `on_icon` VALUES (120, 'icon-basket', '1565163133', 1);
INSERT INTO `on_icon` VALUES (121, 'icon-bag', '1565163133', 1);
INSERT INTO `on_icon` VALUES (122, 'icon-action-undo', '1565163133', 1);
INSERT INTO `on_icon` VALUES (123, 'icon-action-redo', '1565163133', 1);
INSERT INTO `on_icon` VALUES (124, 'icon-wrench', '1565163133', 1);
INSERT INTO `on_icon` VALUES (125, 'icon-umbrella', '1565163133', 1);
INSERT INTO `on_icon` VALUES (126, 'icon-trash', '1565163133', 1);
INSERT INTO `on_icon` VALUES (127, 'icon-tag', '1565163133', 1);
INSERT INTO `on_icon` VALUES (128, 'icon-support', '1565163133', 1);
INSERT INTO `on_icon` VALUES (129, 'icon-frame', '1565163133', 1);
INSERT INTO `on_icon` VALUES (130, 'icon-size-fullscreen', '1565163133', 1);
INSERT INTO `on_icon` VALUES (131, 'icon-size-actual', '1565163133', 1);
INSERT INTO `on_icon` VALUES (132, 'icon-shuffle', '1565163133', 1);
INSERT INTO `on_icon` VALUES (133, 'icon-share-alt', '1565163133', 1);
INSERT INTO `on_icon` VALUES (134, 'icon-share', '1565163133', 1);
INSERT INTO `on_icon` VALUES (135, 'icon-rocket', '1565163133', 1);
INSERT INTO `on_icon` VALUES (136, 'icon-question', '1565163133', 1);
INSERT INTO `on_icon` VALUES (137, 'icon-pie-chart', '1565163133', 1);
INSERT INTO `on_icon` VALUES (138, 'icon-pencil', '1565163133', 1);
INSERT INTO `on_icon` VALUES (139, 'icon-note', '1565163133', 1);
INSERT INTO `on_icon` VALUES (140, 'icon-loop', '1565163133', 1);
INSERT INTO `on_icon` VALUES (141, 'icon-home', '1565163133', 1);
INSERT INTO `on_icon` VALUES (142, 'icon-grid', '1565163133', 1);
INSERT INTO `on_icon` VALUES (143, 'icon-graph', '1565163133', 1);
INSERT INTO `on_icon` VALUES (144, 'icon-microphone', '1565163133', 1);
INSERT INTO `on_icon` VALUES (145, 'icon-music-tone-alt', '1565163133', 1);
INSERT INTO `on_icon` VALUES (146, 'icon-music-tone', '1565163133', 1);
INSERT INTO `on_icon` VALUES (147, 'icon-earphones-alt', '1565163133', 1);
INSERT INTO `on_icon` VALUES (148, 'icon-earphones', '1565163133', 1);
INSERT INTO `on_icon` VALUES (149, 'icon-equalizer', '1565163133', 1);
INSERT INTO `on_icon` VALUES (150, 'icon-like', '1565163133', 1);
INSERT INTO `on_icon` VALUES (151, 'icon-dislike', '1565163133', 1);
INSERT INTO `on_icon` VALUES (152, 'icon-control-start', '1565163133', 1);
INSERT INTO `on_icon` VALUES (153, 'icon-control-rewind', '1565163133', 1);
INSERT INTO `on_icon` VALUES (154, 'icon-control-play', '1565163133', 1);
INSERT INTO `on_icon` VALUES (155, 'icon-control-pause', '1565163133', 1);
INSERT INTO `on_icon` VALUES (156, 'icon-control-forward', '1565163133', 1);
INSERT INTO `on_icon` VALUES (157, 'icon-control-end', '1565163133', 1);
INSERT INTO `on_icon` VALUES (158, 'icon-volume-1', '1565163133', 1);
INSERT INTO `on_icon` VALUES (159, 'icon-volume-2', '1565163133', 1);
INSERT INTO `on_icon` VALUES (160, 'icon-volume-off', '1565163133', 1);
INSERT INTO `on_icon` VALUES (161, 'icon-calendar', '1565163133', 1);
INSERT INTO `on_icon` VALUES (162, 'icon-bulb', '1565163133', 1);
INSERT INTO `on_icon` VALUES (163, 'icon-chart', '1565163133', 1);
INSERT INTO `on_icon` VALUES (164, 'icon-ban', '1565163133', 1);
INSERT INTO `on_icon` VALUES (165, 'icon-bubble', '1565163133', 1);
INSERT INTO `on_icon` VALUES (166, 'icon-camrecorder', '1565163133', 1);
INSERT INTO `on_icon` VALUES (167, 'icon-camera', '1565163133', 1);
INSERT INTO `on_icon` VALUES (168, 'icon-cloud-download', '1565163133', 1);
INSERT INTO `on_icon` VALUES (169, 'icon-cloud-upload', '1565163133', 1);
INSERT INTO `on_icon` VALUES (170, 'icon-envelope', '1565163133', 1);
INSERT INTO `on_icon` VALUES (171, 'icon-eye', '1565163133', 1);
INSERT INTO `on_icon` VALUES (172, 'icon-flag', '1565163133', 1);
INSERT INTO `on_icon` VALUES (173, 'icon-heart', '1565163133', 1);
INSERT INTO `on_icon` VALUES (174, 'icon-info', '1565163133', 1);
INSERT INTO `on_icon` VALUES (175, 'icon-key', '1565163133', 1);
INSERT INTO `on_icon` VALUES (176, 'icon-link', '1565163133', 1);
INSERT INTO `on_icon` VALUES (177, 'icon-lock', '1565163133', 1);
INSERT INTO `on_icon` VALUES (178, 'icon-lock-open', '1565163133', 1);
INSERT INTO `on_icon` VALUES (179, 'icon-magnifier', '1565163133', 1);
INSERT INTO `on_icon` VALUES (180, 'icon-magnifier-add', '1565163133', 1);
INSERT INTO `on_icon` VALUES (181, 'icon-magnifier-remove', '1565163133', 1);
INSERT INTO `on_icon` VALUES (182, 'icon-paper-clip', '1565163133', 1);
INSERT INTO `on_icon` VALUES (183, 'icon-paper-plane', '1565163133', 1);
INSERT INTO `on_icon` VALUES (184, 'icon-power', '1565163133', 1);
INSERT INTO `on_icon` VALUES (185, 'icon-refresh', '1565163133', 1);
INSERT INTO `on_icon` VALUES (186, 'icon-reload', '1565163133', 1);
INSERT INTO `on_icon` VALUES (187, 'icon-settings', '1565163133', 1);
INSERT INTO `on_icon` VALUES (188, 'icon-star', '1565163133', 1);
INSERT INTO `on_icon` VALUES (189, 'icon-symbol-female', '1565163133', 1);
INSERT INTO `on_icon` VALUES (190, 'icon-symbol-male', '1565163133', 1);
INSERT INTO `on_icon` VALUES (191, 'icon-target', '1565163133', 1);
INSERT INTO `on_icon` VALUES (192, 'icon-credit-card', '1565163133', 1);
INSERT INTO `on_icon` VALUES (193, 'icon-paypal', '1565163133', 1);
INSERT INTO `on_icon` VALUES (194, 'icon-social-tumblr', '1565163133', 1);
INSERT INTO `on_icon` VALUES (195, 'icon-social-twitter', '1565163133', 1);
INSERT INTO `on_icon` VALUES (196, 'icon-social-facebook', '1565163133', 1);
INSERT INTO `on_icon` VALUES (197, 'icon-social-instagram', '1565163133', 1);
INSERT INTO `on_icon` VALUES (198, 'icon-social-linkedin', '1565163133', 1);
INSERT INTO `on_icon` VALUES (199, 'icon-social-pinterest', '1565163133', 1);
INSERT INTO `on_icon` VALUES (200, 'icon-social-github', '1565163133', 1);
INSERT INTO `on_icon` VALUES (201, 'icon-social-google', '1565163133', 1);
INSERT INTO `on_icon` VALUES (202, 'icon-social-reddit', '1565163133', 1);
INSERT INTO `on_icon` VALUES (203, 'icon-social-skype', '1565163133', 1);
INSERT INTO `on_icon` VALUES (204, 'icon-social-dribbble', '1565163133', 1);
INSERT INTO `on_icon` VALUES (205, 'icon-social-behance', '1565163133', 1);
INSERT INTO `on_icon` VALUES (206, 'icon-social-foursqare', '1565163133', 1);
INSERT INTO `on_icon` VALUES (207, 'icon-social-soundcloud', '1565163133', 1);
INSERT INTO `on_icon` VALUES (208, 'icon-social-spotify', '1565163133', 1);
INSERT INTO `on_icon` VALUES (209, 'icon-social-stumbleupon', '1565163133', 1);
INSERT INTO `on_icon` VALUES (210, 'icon-social-youtube', '1565163133', 1);
INSERT INTO `on_icon` VALUES (211, 'icon-social-dropbox', '1565163133', 1);
INSERT INTO `on_icon` VALUES (212, 'icon-social-vkontakte', '1565163133', 1);
INSERT INTO `on_icon` VALUES (213, 'icon-social-steam', '1565163133', 1);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `model`(`model`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_permission
-- ----------------------------
INSERT INTO `on_permission` VALUES (2, '角色管理', 'role/index', '1', 'role', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (1, '后台首页', 'index/index', '1', '', '', 'side-menu__icon fa fa-desktop', 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (3, '添加角色', 'role/add', '1', 'role', 'add', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (4, '权限分配', 'role/store', '1', 'role', 'store', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (5, '编辑角色', 'role/edit', '1', 'role', 'edit', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (6, '批量删除', 'role/deletes', '1', 'role', 'deletes', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (7, '删除角色', 'role/delete', '1', 'role', 'delete', '', 2, 0, 0, 2, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (8, '权限管理', 'permission/index', '1', 'permission', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (9, '添加权限', 'permission/add', '1', 'permission', 'add', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (10, '创建权限', 'permission/store', '1', 'permission', 'store', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (11, '编辑权限', 'permission/edit', '1', 'permission', 'edit', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (12, '批量删除', 'permission/deletes', '1', 'permission', 'deletes', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (13, '删除权限', 'permission/delete', '1', 'permission', 'delete', '', 2, 0, 0, 8, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (14, '管理员管理', 'admin/index', '1', 'admin', 'index', '', 1, 0, 1, 20, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (15, '添加管理员', 'admin/add', '1', 'admin', 'add', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (16, '状态管理', 'admin/store', '1', 'admin', 'store', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (17, '编辑管理员', 'admin/editPass', '1', 'admin', 'editPass', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (18, '批量删除', 'admin/deletes', '1', 'admin', 'deletes', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (19, '删除管理员', 'admin/delete', '1', 'admin', 'delete', '', 2, 0, 0, 14, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (20, '员工管理', 'admin/admin', '1', '', '', '', 0, 0, 1, 0, 1, 1563170072, 1563170072);
INSERT INTO `on_permission` VALUES (27, '管理员列表', 'admin/index', '1', 'admin', 'index', '', 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (26, '权限列表', 'permission/index', '1', 'permission', 'index', '', 2, 0, 0, 8, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (21, '测试', 'test/index', '1', 'test', 'index', '', 0, 0, 1, 0, 0, 1501686013, 1565148753);
INSERT INTO `on_permission` VALUES (22, '首页', 'index/index', '1', 'index', 'index', '', 1, 0, 1, 1, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (23, 'test', 'tess/index', '1', 'tess', 'index', '', 0, 0, 1, 0, 0, 1501686013, 1565147275);
INSERT INTO `on_permission` VALUES (24, '个人中心', 'admin/edit', '1', 'admin', 'edit', '', 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (25, '分配角色', 'admin/addRole', '1', 'admin', 'addRole', '', 2, 0, 0, 14, 1, 1501686013, 1501686013);
INSERT INTO `on_permission` VALUES (28, '角色列表', 'role/index', '1', 'role', 'index', '', 2, 0, 0, 2, 1, 1501686013, 1501686013);

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
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_role
-- ----------------------------
INSERT INTO `on_role` VALUES (1, 'admin', '管理员', 1, 1563170072, 1563170072);
INSERT INTO `on_role` VALUES (2, 'test111', '测试10', 0, 1563170072, 1565145017);
INSERT INTO `on_role` VALUES (3, 'test1', '测试1', 1, 1563170072, 1565145012);
INSERT INTO `on_role` VALUES (4, 'test2', '测试2', 1, 1563170072, 1564722389);
INSERT INTO `on_role` VALUES (5, 'test3', '测试3', 1, 1563170072, 1564722372);
INSERT INTO `on_role` VALUES (6, 'test4', '测试4', 0, 1563170072, 1564724352);
INSERT INTO `on_role` VALUES (7, 'test5', '测试5', 0, 1563170072, 1564724352);
INSERT INTO `on_role` VALUES (8, 'test7', '测试7', 1, 1564730259, 1564730259);
INSERT INTO `on_role` VALUES (9, 'test81', '测试81', 0, 1564730271, 1565145019);
INSERT INTO `on_role` VALUES (10, 'test10', '测试10', 1, 1564732635, 1564732635);

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
INSERT INTO `on_role_permission` VALUES (4, 1, '1,22,20,2,28,8,26,14,15,16,27,24,25', 0);
INSERT INTO `on_role_permission` VALUES (3, 2, '1,22,20,2,28,8,26,14,15,16,27,24,25', 0);

SET FOREIGN_KEY_CHECKS = 1;
