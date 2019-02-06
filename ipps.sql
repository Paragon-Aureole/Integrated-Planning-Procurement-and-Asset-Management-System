/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : ipps

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 24/01/2019 14:01:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for measurement_units
-- ----------------------------
DROP TABLE IF EXISTS `measurement_units`;
CREATE TABLE `measurement_units`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `unit_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_01_23_114611_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_01_23_151713_create_offices_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_01_23_190508_create_procurement_modes_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_01_23_192427_create_measurement_units_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_01_23_194928_create_signatories_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 1);

-- ----------------------------
-- Table structure for offices
-- ----------------------------
DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `office_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of offices
-- ----------------------------
INSERT INTO `offices` VALUES (1, 'ICT', 'Information Technology Section', 2, '2019-01-24 04:49:23', '2019-01-24 04:49:23');
INSERT INTO `offices` VALUES (2, 'ADM', 'Office of the City Administrator', 1, '2019-01-24 04:49:23', '2019-01-24 04:49:23');
INSERT INTO `offices` VALUES (3, 'BFP', 'Bureau of Fire Protection', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (4, 'DILG', 'City Department of Interior and Local Government', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (5, 'EEM', 'City Market Office', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (6, 'COC', 'Clerk of Court', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (7, 'COMELEC', 'Commission on Elections', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (8, 'COA', 'Commision on Audit', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (9, 'MTCCB1', 'Court Branch 1', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (10, 'MTCCB2', 'Court Branch 2', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (11, 'DEPED', 'Department of Education', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (12, 'ELEC', 'Electrical Office', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (13, 'EAS', 'Engineering and Architectural Services', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (14, 'HRM', 'Human Resource Management Office', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (15, 'IDS', 'Information Dissemination Section', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (16, 'LUSCM', 'La Union Science Centrum and Museum', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (17, 'LNMB', 'Liga ng mga Barangay', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (18, 'LEBDO', 'Local Economic, Business and Dev\'t Office', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (19, 'OSM', 'Office for Strategy Management', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (20, 'ACA', 'Office of the City Accountant', 1, '2019-01-24 04:49:24', '2019-01-24 04:49:24');
INSERT INTO `offices` VALUES (21, 'AGR', 'Office of the City Agriculturist', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (22, 'OCA', 'Office of the City Assesor', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (23, 'CBO', 'Office of the City Budget Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (24, 'ENR', 'Office of the City Environment and Natural Resources Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (25, 'GSO', 'Office of the City General Sercices Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (26, 'CHO', 'Office of the City Health Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (27, 'CLO', 'Office of the City Legal Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (28, 'LIB', 'Office of the City Library', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (29, 'OCM', 'Office of the City Mayor', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (30, 'PDO', 'Office of the City Planning and Development Coordinator', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (31, 'REG', 'Office of the City Registrar', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (32, 'SWD', 'Office of the Social Welfare and Development Officer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (33, 'CTO', 'Office of the City Treasurer', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (34, 'CVO', 'Office of the City Veterenarian', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (35, 'OCVM', 'Office of the City Vice-Mayor', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (36, 'OPS', 'Office of the Public Safety', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (37, 'OSP', 'Office of the Sangguniang Panlungsod', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (38, 'OSSP', 'Office of the Secretary to the Sangguniang Panlungsod', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (39, 'OSCA', 'Office of the Senior Citizen', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (40, 'PNP', 'Philippine National Police', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (41, 'PACU', 'Public Assistance and Complaints Unit', 1, '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `offices` VALUES (42, 'TWG', 'Technical Working Group', 3, '2019-01-24 05:27:19', '2019-01-24 05:27:19');
INSERT INTO `offices` VALUES (43, 'BAC', 'Bids and Awards Committee', 3, '2019-01-24 05:27:40', '2019-01-24 05:27:40');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'full control', 'web', '2019-01-24 04:49:21', '2019-01-24 04:49:21');
INSERT INTO `permissions` VALUES (2, 'modify', 'web', '2019-01-24 04:49:21', '2019-01-24 04:49:21');
INSERT INTO `permissions` VALUES (3, 'read', 'web', '2019-01-24 04:49:21', '2019-01-24 04:49:21');
INSERT INTO `permissions` VALUES (4, 'write', 'web', '2019-01-24 04:49:22', '2019-01-24 04:49:22');
INSERT INTO `permissions` VALUES (5, 'close', 'web', '2019-01-24 04:49:22', '2019-01-24 04:49:22');

-- ----------------------------
-- Table structure for procurement_modes
-- ----------------------------
DROP TABLE IF EXISTS `procurement_modes`;
CREATE TABLE `procurement_modes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of procurement_modes
-- ----------------------------
INSERT INTO `procurement_modes` VALUES (1, 'limited source bidding', 'Section 49', '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `procurement_modes` VALUES (2, 'direct contracting', 'Section 50', '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `procurement_modes` VALUES (3, 'repeat order', 'Section 51', '2019-01-24 04:49:25', '2019-01-24 04:49:25');
INSERT INTO `procurement_modes` VALUES (4, 'shopping', 'Section 51', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (5, 'two failed biddings', 'Section 53.1', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (6, 'take - over of contracts', 'Section 53.3', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (7, 'adjacent or contiguous', 'Section 53.4', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (8, 'agency - to - agency', 'Section 53.5', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (9, 'Science/Arts/Exclusive Tech./Media', 'Section 53.6', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (10, 'highly technical consultants', 'Section 53.7', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (11, 'defense cooperation agreement', 'Section 53.8', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (12, 'small value procurement', 'Section 53.8', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (13, 'lease of real property and venue', 'Section 53.10', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (14, 'NGO Participation', 'Section 53.11', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (15, 'Community Participation', 'Section 53.12', '2019-01-24 04:49:26', '2019-01-24 04:49:26');
INSERT INTO `procurement_modes` VALUES (16, 'UN Agencies/Other International Organizations', 'Section 53.13', '2019-01-24 04:49:26', '2019-01-24 04:49:26');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 3);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (2, 3);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (3, 2);
INSERT INTO `role_has_permissions` VALUES (3, 3);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (4, 2);
INSERT INTO `role_has_permissions` VALUES (4, 3);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (5, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Department', 'web', '2019-01-24 04:49:22', '2019-01-24 04:49:22');
INSERT INTO `roles` VALUES (2, 'Secretariat', 'web', '2019-01-24 04:49:22', '2019-01-24 04:49:22');
INSERT INTO `roles` VALUES (3, 'Admin', 'web', '2019-01-24 04:49:22', '2019-01-24 04:49:22');

-- ----------------------------
-- Table structure for signatories
-- ----------------------------
DROP TABLE IF EXISTS `signatories`;
CREATE TABLE `signatories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `office_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `signatory_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `signatory_position` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `signatories_office_id_index`(`office_id`) USING BTREE,
  CONSTRAINT `signatories_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of signatories
-- ----------------------------
INSERT INTO `signatories` VALUES (1, '2019-01-24 04:50:31', '2019-01-24 04:50:31', 1, 'Germie O. Deang', 'Information Technology Officer II', 1, 0, NULL);
INSERT INTO `signatories` VALUES (2, '2019-01-24 04:51:00', '2019-01-24 04:51:00', 2, 'Ernesto V. Datuin', 'City Administrator', 1, 0, NULL);
INSERT INTO `signatories` VALUES (3, '2019-01-24 04:51:28', '2019-01-24 04:51:28', 29, 'Hon. Hermenegildo A. Gualberto', 'City Mayor', 1, 0, NULL);
INSERT INTO `signatories` VALUES (4, '2019-01-24 04:52:12', '2019-01-24 04:52:12', 35, 'Hon. Alfredo Pablo R. Ortega', 'City Vice Mayor', 1, 0, NULL);
INSERT INTO `signatories` VALUES (5, '2019-01-24 05:12:24', '2019-01-24 05:12:24', 23, 'Cleopatra A. Noces', 'City Budget Officer', 2, 0, NULL);
INSERT INTO `signatories` VALUES (6, '2019-01-24 05:12:47', '2019-01-24 05:12:47', 33, 'Edmar C. Luna', 'City Treasurer', 3, 0, NULL);
INSERT INTO `signatories` VALUES (7, '2019-01-24 05:13:17', '2019-01-24 05:13:17', 29, 'Hon. Hermenegildo A. Gualberto', 'City Mayor', 4, 0, NULL);
INSERT INTO `signatories` VALUES (8, '2019-01-24 05:13:34', '2019-01-24 05:13:34', 35, 'Hon. Alfredo Pablo R. Ortega', 'City Vice Mayor', 4, 0, NULL);
INSERT INTO `signatories` VALUES (9, '2019-01-24 05:18:47', '2019-01-24 05:29:22', 1, 'Germie O. Deang', 'TWG Member - ICT', 5, 0, '2019-01-24 05:29:22');
INSERT INTO `signatories` VALUES (10, '2019-01-24 05:31:07', '2019-01-24 05:31:07', 42, 'Germie O. Deang', 'IT & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (11, '2019-01-24 05:32:14', '2019-01-24 05:32:14', 42, 'Ma. Teresa Navarro', 'Goods & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (12, '2019-01-24 05:33:18', '2019-01-24 05:33:18', 42, 'Jem Tamani', 'Construction & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (13, '2019-01-24 05:33:46', '2019-01-24 05:33:46', 42, 'Elvy N. Casilla', 'Goods & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (14, '2019-01-24 05:34:17', '2019-01-24 05:34:17', 42, 'Madeline Tadifa', 'Construction & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (15, '2019-01-24 05:36:30', '2019-01-24 05:36:30', 42, 'Jovito Casuga', 'Auto Repair & Supplies', 5, 0, NULL);
INSERT INTO `signatories` VALUES (16, '2019-01-24 05:37:08', '2019-01-24 05:37:08', 42, 'Mercy G. Go', 'TWG Chairman', 5, 0, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wholename` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `contact_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  INDEX `users_office_id_index`(`office_id`) USING BTREE,
  CONSTRAINT `users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'systemadmin', '$2y$10$zp8w4hMBKVBcvG8E9nMSquG13QU937z6W2vOke69vd/OvPzEzk9qG', 'System Administrator', 1, '139', 'fuMIM3jgvOIYhCx5gvvQtEgSuUDjyFEqrOmsijyUEEIx2KzvHJwGwJKva5ca', '2019-01-24 04:49:23', '2019-01-24 04:49:23', NULL);

SET FOREIGN_KEY_CHECKS = 1;
