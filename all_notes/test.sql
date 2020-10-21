/*
 Navicat Premium Data Transfer

 Source Server         : egorder
 Source Server Type    : MySQL
 Source Server Version : 80019
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 80019
 File Encoding         : 65001

 Date: 09/10/2020 06:19:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `id` bigint NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `gname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名字',
  `gprice` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '商品结构',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
BEGIN;
INSERT INTO `shop_goods` VALUES (1, '橡皮擦', 15.20);
INSERT INTO `shop_goods` VALUES (2, '铅笔', 6.00);
INSERT INTO `shop_goods` VALUES (3, '钢笔', 6.40);
INSERT INTO `shop_goods` VALUES (4, '皮球 ', 67.60);
COMMIT;

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user` (
  `id` bigint NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `sex` tinyint NOT NULL COMMENT '0为‘男’,1为''女''',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `age` tinyint NOT NULL COMMENT '年龄',
  `gid` bigint NOT NULL COMMENT '商品id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of shop_user
-- ----------------------------
BEGIN;
INSERT INTO `shop_user` VALUES (1, '张三', '123456', 0, '潮汕', 18, 1);
INSERT INTO `shop_user` VALUES (2, '李四', '457988', 1, '深圳', 16, 2);
INSERT INTO `shop_user` VALUES (3, '王五', '789', 1, '雷州', 20, 1);
INSERT INTO `shop_user` VALUES (4, '孙七', '457988', 1, '深圳', 30, 2);
INSERT INTO `shop_user` VALUES (5, '孙八', '789', 0, '潮汕', 32, 3);
INSERT INTO `shop_user` VALUES (6, '秦始皇', '1445', 0, '香港', 60, 4);
INSERT INTO `shop_user` VALUES (7, '宋慈', '8997', 1, '深圳', 48, 1);
INSERT INTO `shop_user` VALUES (8, '唐太宗', '122', 1, '深圳', 70, 2);
INSERT INTO `shop_user` VALUES (9, '武则天', '890', 0, '深圳', 80, 0);
INSERT INTO `shop_user` VALUES (10, '小猪', '1313', 1, '深圳', 50, 0);
INSERT INTO `shop_user` VALUES (11, '赵括', '121', 1, '香港', 40, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
