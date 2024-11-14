-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table wms.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wms.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table wms.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wms.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table wms.m_comodity
CREATE TABLE IF NOT EXISTS `m_comodity` (
  `comodity_id` int(11) NOT NULL,
  `comodity name` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`comodity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_comodity: 0 rows
/*!40000 ALTER TABLE `m_comodity` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_comodity` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_classification
CREATE TABLE IF NOT EXISTS `m_item_classification` (
  `item_classification_id` int(11) NOT NULL,
  `classification_name` varchar(50) DEFAULT NULL,
  `process_id` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`item_classification_id`,`process_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='item classification on warehouse';

-- Dumping data for table wms.m_item_classification: 13 rows
/*!40000 ALTER TABLE `m_item_classification` DISABLE KEYS */;
INSERT INTO `m_item_classification` (`item_classification_id`, `classification_name`, `process_id`, `created_by`, `created_on`, `is_active`, `is_deleted`) VALUES
	(1, 'Selling Item', 12, NULL, NULL, NULL, NULL),
	(2, 'Raw Material', 12, NULL, NULL, NULL, NULL),
	(3, 'Spare Parts', 12, NULL, NULL, NULL, NULL),
	(4, 'Damaged', 12, NULL, NULL, NULL, NULL),
	(4, 'Damaged', 14, NULL, NULL, NULL, NULL),
	(1, 'Selling Item', 19, NULL, NULL, NULL, NULL),
	(2, 'Raw Material', 19, NULL, NULL, NULL, NULL),
	(3, 'Spare Parts', 19, NULL, NULL, NULL, NULL),
	(4, 'Damaged', 19, NULL, NULL, NULL, NULL),
	(1, 'Selling Item', 23, NULL, NULL, NULL, NULL),
	(2, 'Raw Material', 23, NULL, NULL, NULL, NULL),
	(3, 'Spare Parts', 23, NULL, NULL, NULL, NULL),
	(4, 'Damaged', 23, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_item_classification` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_classification_copy
CREATE TABLE IF NOT EXISTS `m_item_classification_copy` (
  `item_classification_id` int(11) NOT NULL,
  `classification_name` varchar(50) DEFAULT NULL,
  `process_id` char(11) NOT NULL DEFAULT '',
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`item_classification_id`,`process_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='item classification on warehouse';

-- Dumping data for table wms.m_item_classification_copy: 5 rows
/*!40000 ALTER TABLE `m_item_classification_copy` DISABLE KEYS */;
INSERT INTO `m_item_classification_copy` (`item_classification_id`, `classification_name`, `process_id`, `created_by`, `created_on`, `is_active`, `is_deleted`) VALUES
	(1, 'Selling Item', 'IN', NULL, NULL, NULL, NULL),
	(2, 'Raw Material', 'IN', NULL, NULL, NULL, NULL),
	(3, 'Spare Parts', 'IN', NULL, NULL, NULL, NULL),
	(4, 'Damaged', 'IN', NULL, NULL, NULL, NULL),
	(4, 'Damaged', 'OUT', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_item_classification_copy` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_uom
CREATE TABLE IF NOT EXISTS `m_item_uom` (
  `uom_name` varchar(50) NOT NULL DEFAULT '',
  `uom_type_id` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`uom_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='master item uom warehouse';

-- Dumping data for table wms.m_item_uom: 13 rows
/*!40000 ALTER TABLE `m_item_uom` DISABLE KEYS */;
INSERT INTO `m_item_uom` (`uom_name`, `uom_type_id`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	('DRUM', 3, NULL, NULL, NULL, NULL, 'Y', NULL),
	('BARREL', 3, NULL, NULL, NULL, NULL, 'Y', NULL),
	('PACK', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('PALLET', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('ROLL', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('SET', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('UNIT', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('METER', 1, NULL, NULL, NULL, NULL, 'Y', NULL),
	('KG', 4, NULL, NULL, NULL, NULL, 'Y', NULL),
	('PIECES', 2, NULL, NULL, NULL, NULL, 'Y', NULL),
	('PAIR', 3, 'atmi', '2023-03-08 10:50:24', 'atmi', '2023-03-08 11:24:32', 'Y', 'N'),
	('BOX', 2, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('BAG', 2, 'superadmin', '2024-08-28 11:28:41', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_item_uom` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_uom_2
CREATE TABLE IF NOT EXISTS `m_item_uom_2` (
  `item_uom_id` int(11) NOT NULL DEFAULT 0,
  `uom_name` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`item_uom_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master item uom warehouse';

-- Dumping data for table wms.m_item_uom_2: 11 rows
/*!40000 ALTER TABLE `m_item_uom_2` DISABLE KEYS */;
INSERT INTO `m_item_uom_2` (`item_uom_id`, `uom_name`, `created_by`, `created_on`, `is_active`, `is_deleted`) VALUES
	(1, 'DRUM', NULL, NULL, 'Y', NULL),
	(2, 'BARREL', NULL, NULL, 'Y', NULL),
	(3, 'PACK', NULL, NULL, 'Y', NULL),
	(4, 'PALLET', NULL, NULL, 'Y', NULL),
	(5, 'ROLL', NULL, NULL, 'Y', NULL),
	(6, 'SET', NULL, NULL, 'Y', NULL),
	(7, 'UNIT', NULL, NULL, 'Y', NULL),
	(8, 'METER', NULL, NULL, 'Y', NULL),
	(9, 'KG', NULL, NULL, 'Y', NULL),
	(10, 'PIECES', NULL, NULL, 'Y', NULL),
	(11, 'BAG', NULL, NULL, 'Y', NULL);
/*!40000 ALTER TABLE `m_item_uom_2` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_uom_type
CREATE TABLE IF NOT EXISTS `m_item_uom_type` (
  `uom_type_id` int(11) NOT NULL,
  `uom_type_name` varchar(50) NOT NULL DEFAULT '',
  `user_created` varchar(50) NOT NULL DEFAULT '',
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`uom_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_item_uom_type: 5 rows
/*!40000 ALTER TABLE `m_item_uom_type` DISABLE KEYS */;
INSERT INTO `m_item_uom_type` (`uom_type_id`, `uom_type_name`, `user_created`, `datetime_created`) VALUES
	(1, 'Length', 'atmi', '2023-03-08 09:47:51'),
	(2, 'Quantity', 'atmi', '2023-03-08 09:49:08'),
	(3, 'Volume', 'atmi', '2023-03-08 09:49:22'),
	(4, 'Weight', 'atmi', '2023-03-08 09:49:37'),
	(5, 'Others', 'atmi', '2023-03-08 09:51:05');
/*!40000 ALTER TABLE `m_item_uom_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_menu
CREATE TABLE IF NOT EXISTS `m_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `platform_id` varchar(50) NOT NULL COMMENT '1. android  2.web',
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(3) unsigned DEFAULT 0,
  `no_urut` tinyint(3) unsigned DEFAULT NULL,
  `id_dom` varchar(200) DEFAULT NULL,
  `menu_link` varchar(100) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_icon_white` varchar(100) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`platform_id`) USING BTREE,
  UNIQUE KEY `menu_id` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_menu: 46 rows
/*!40000 ALTER TABLE `m_menu` DISABLE KEYS */;
INSERT INTO `m_menu` (`menu_id`, `menu_name`, `description`, `platform_id`, `parent_id`, `status`, `no_urut`, `id_dom`, `menu_link`, `menu_icon`, `menu_icon_white`, `is_active`, `user_created`, `datetime_created`) VALUES
	(31, 'User Management', 'User Management', '2', 10, 1, 1, 'user_management', 'user_management', NULL, NULL, 'Y', 'backdoor', '2023-03-16 09:42:13'),
	(30, 'Item', 'Item', '2', 9, 1, 10, 'master_item', 'master_item', NULL, NULL, 'Y', 'backdoor', '2023-03-14 10:01:07'),
	(29, 'Supplier', 'Supplier', '2', 9, 1, 9, 'master_supplier', 'master_supplier', NULL, NULL, 'Y', 'backdoor', '2023-03-14 10:00:31'),
	(25, 'Location Index', 'Location Index', '2', 9, 1, 5, 'master_location_index', 'master_location_index', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:57:58'),
	(24, 'Location', 'Location', '2', 9, 1, 4, 'master_location', 'master_location', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:55:45'),
	(22, 'Project', 'Project', '2', 9, 1, 2, 'master_project', 'master_project', NULL, NULL, 'Y', 'backdoor', '2023-03-07 11:24:59'),
	(19, 'Packing', 'Packing', '2', 6, 1, 4, 'packing', 'packing', NULL, NULL, 'Y', 'rdarmawan', '2023-01-06 13:56:53'),
	(20, 'Movement Location', 'Movement Location', '2', 5, 1, 2, 'movement_location', 'movement_location', NULL, NULL, 'Y', 'backdoor', '2023-01-06 13:56:53'),
	(21, 'Stock Count', 'Stock Count', '2', 5, 1, 5, 'stock_count', 'stock_count', NULL, NULL, 'Y', 'backdoor', '2023-01-13 12:56:46'),
	(23, 'Warehouse', 'Warehouse', '2', 9, 1, 3, 'master_warehouse', 'master_warehouse', NULL, NULL, 'Y', 'backdoor', '2023-03-08 08:07:55'),
	(18, 'Inventory Adjustment', 'Inventory Adjustment', '2', 5, 1, 4, 'inventory_adjustment', 'inventory_adjustment', NULL, NULL, 'Y', 'backdoor', '2023-01-04 10:38:04'),
	(17, 'Checking', 'Checking', '2', 6, 1, 3, 'checking', 'checking', NULL, NULL, 'Y', 'backdoor', '2023-01-04 10:02:43'),
	(16, 'Stock Transfer', 'Stock Transfer', '2', 5, 1, 3, 'stock_transfer', 'stock_transfer', NULL, NULL, 'Y', 'backdoor', '2022-12-27 09:44:12'),
	(15, 'Inventory List', 'Inventory List', '2', 5, 1, 1, 'inventory_list', 'inventory_list', NULL, NULL, 'Y', NULL, NULL),
	(14, 'Picking', 'Picking', '2', 6, 1, 2, 'picking', 'picking', NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(28, 'Unit', 'Unit', '2', 9, 1, 8, 'master_unit', 'master_unit', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:59:59'),
	(27, 'Transporter', 'Transporter', '2', 9, 1, 7, 'master_transporter', 'master_transporter', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:59:33'),
	(26, 'Commodity', 'Commodity', '2', 9, 1, 6, 'master_commodity', 'master_commodity', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:58:57'),
	(13, 'Outbound Planning', 'Outbound Planning', '2', 6, 1, 1, 'outbound_planning', 'outbound_planning', NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(12, 'Goods Receiving', 'Goods Receiving', '2', 1, 1, 2, 'goods_receiving', 'goods_receiving', NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(11, 'Inbound Planning', 'Inbound Planning', '2', 1, 1, 1, 'inbound_planning', 'inbound_planning', NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(10, 'Setting', 'Setting', '2', 0, 1, 9, 'setting', NULL, 'public/img/Setting.png', 'public/img/setting_white.png', 'Y', 'atmi', '2022-09-27 15:05:11'),
	(9, 'Master', 'Master Data', '2', 0, 1, 8, 'master', NULL, 'public/img/master_data.png', 'public/img/master_data_white.png', 'Y', 'atmi', '2022-09-27 15:05:11'),
	(8, 'Finance', 'Finance', '2', 0, 1, 6, 'finance', NULL, NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(7, 'Order Management', 'Order Management', '2', 0, 1, 5, 'order_management', NULL, NULL, NULL, 'Y', 'atmi', '2022-09-27 15:05:11'),
	(6, 'Outbound', 'Outbound', '2', 0, 1, 4, 'outbound', NULL, 'public/img/Outbound_Menu.png', 'public/img/Outbound_white.png', 'Y', 'atmi', '2022-09-27 15:05:11'),
	(5, 'Inventory', 'Inventory', '2', 0, 1, 3, 'inventory', NULL, 'public/img/Inventory_menu.png', 'public/img/Inventory_white.png', 'Y', 'atmi', '2022-09-27 15:05:11'),
	(4, 'Dashboard', 'Dashboard WMS', '2', 0, 1, 1, 'dashboard', 'dashboard', 'public/img/DASHBOARD.png', 'public/img/Dashboard_White.png', 'Y', 'atmi', '2022-09-27 15:05:11'),
	(3, 'Cek & Receive', 'Inbound Check and Receive', '1', 0, 0, 1, 'cek_n_receive', NULL, NULL, NULL, 'Y', 'rdarmawan', '2022-09-23 11:06:20'),
	(2, 'Putaway', 'Putaway', '1', 0, 0, 2, 'putaway', '/putaway', NULL, NULL, 'Y', 'rdarmawan', '2022-09-23 11:07:04'),
	(1, 'Inbound', 'Inbound', '2', 0, 1, 2, 'inbound', NULL, 'public/img/Inbound_Menu.png', 'public/img/Inboound_white.png', 'Y', 'rdarmawan', '2022-09-23 11:06:20'),
	(32, 'Report', 'Report', '2', 0, 1, 7, 'report', NULL, 'public/img/Report.png', 'public/img/report_white.png', 'Y', 'backdoor', '2023-03-27 13:42:17'),
	(33, 'Summary Inbound', 'Summary Inbound', '2', 32, 1, 1, 'report_summary_inbound', 'report_summary_inbound', NULL, NULL, 'Y', 'backdoor', '2023-03-27 13:42:53'),
	(34, 'Summary Outbound', 'Summary Outbound', '2', 32, 1, 2, 'report_summary_outbound', 'report_summary_outbound', NULL, NULL, 'Y', 'backdoor', '2023-03-29 07:40:58'),
	(35, 'Movement Report', 'Movement Report', '2', 32, 1, 3, 'movement_report', 'movement_report', NULL, NULL, 'Y', 'backdoor', '2023-03-30 08:06:26'),
	(36, 'Client', 'Client', '2', 9, 1, 1, 'master_client', 'master_client', NULL, NULL, 'Y', 'backdoor', '2023-05-02 13:46:43'),
	(37, 'Contact', 'Contact', '2', 9, 1, 12, 'master_contact', 'master_contact', NULL, NULL, 'Y', 'backdoor', '2023-03-14 09:59:59'),
	(38, 'Buffer', 'Buffer', '2', 9, 1, 11, 'master_buffer', 'master_buffer', NULL, NULL, 'Y', 'backdoor', '2023-05-19 10:32:22'),
	(39, 'Return', 'Return', '2', 1, 1, 3, 'return', 'return', NULL, NULL, 'Y', 'backdoor', '2023-05-22 15:34:54'),
	(40, 'GR Return', 'GR Return', '2', 1, 1, 4, 'gr_return', 'gr_return', NULL, NULL, 'Y', 'backdoor', '2023-06-12 09:27:10'),
	(43, 'Transport', 'Transport', '2', 41, 1, 1, 'transport', 'transport', NULL, NULL, 'Y', 'backdoor', '2023-10-04 13:21:35'),
	(42, 'Shipping Load', 'Shipping Load', '2', 41, 1, 2, 'shipping_load', 'shipping_load', NULL, NULL, 'Y', 'backdoor', '2023-07-27 14:16:46'),
	(41, 'Transportation', 'Transportation', '2', 0, 1, 5, 'transportation', NULL, 'public/img/transport.png', 'public/img/transport_white.png', 'Y', 'backdoor', '2023-07-27 14:16:51'),
	(44, 'User Group Management', 'User Group Management', '2', 10, 1, 2, 'user_group_management', 'user_group_management', NULL, NULL, 'Y', 'backdoor', '2024-08-30 09:17:49'),
	(45, 'COGS Computation', 'COGS Computation', '2', 32, 1, 4, 'cogs_computation', 'cogs_computation', NULL, NULL, 'Y', 'backdoor', '2024-08-30 09:17:49'),
	(46, 'Change Password', 'Change Password', '2', 10, 1, 3, 'user_change_password', 'user_change_password', NULL, NULL, 'Y', 'backdoor', '2024-08-30 09:17:49');
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;

-- Dumping structure for table wms.m_process
CREATE TABLE IF NOT EXISTS `m_process` (
  `process_id` int(11) NOT NULL DEFAULT 0,
  `process_code` char(11) NOT NULL DEFAULT '',
  `process_name` varchar(50) DEFAULT NULL,
  `is_movement` enum('Y','N') DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `process_alias` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`process_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_process: 24 rows
/*!40000 ALTER TABLE `m_process` DISABLE KEYS */;
INSERT INTO `m_process` (`process_id`, `process_code`, `process_name`, `is_movement`, `is_active`, `process_alias`, `user_created`, `datetime_created`) VALUES
	(1, '01', 'Putaway Inbound Regular', 'Y', 'Y', 'IN', 'atmi', '2022-09-26 16:49:42'),
	(2, '02', 'Putaway Inbound KIREX', 'Y', 'Y', 'IN', 'atmi', '2022-09-26 16:49:42'),
	(3, '03', 'Putaway Inbound Transfer Warehouse', 'Y', 'Y', 'IN', 'atmi', '2022-09-26 16:49:42'),
	(4, '04', 'Putaway Return', 'Y', 'N', 'RTN', 'atmi', '2022-10-03 14:44:00'),
	(5, '05', 'Pick Outbound Regular', 'Y', 'N', 'OUT', 'atmi', '2022-10-03 14:44:00'),
	(6, '06', 'Pick Outbound KIREX', 'Y', 'N', 'OUT', 'atmi', '2022-10-03 14:44:00'),
	(7, '07', 'Pick Outbound Transfer Warehouse', 'Y', 'N', 'OUT', 'atmi', '2022-10-03 14:44:00'),
	(8, '08', 'Movement Location', 'Y', 'Y', NULL, 'atmi', '2022-10-03 14:44:00'),
	(9, '09', 'Adjust In', 'Y', 'Y', 'ADIN', 'atmi', '2022-10-03 14:44:00'),
	(10, '10', 'Adjust Out', 'Y', 'Y', 'ADOUT', 'atmi', '2022-10-03 14:44:00'),
	(11, '11', 'Stock Transfer', 'Y', 'Y', 'STR', 'atmi', '2022-10-03 14:44:00'),
	(12, 'IN', 'Inbound', 'N', 'Y', NULL, 'atmi', '2022-10-03 14:44:00'),
	(13, 'GR', 'Goods Receive', 'N', 'Y', NULL, 'atmi', '2022-10-04 09:34:00'),
	(14, 'OPN', 'Opname', 'N', 'Y', NULL, 'atmi', '2022-10-04 09:34:00'),
	(15, 'DCC', 'Daily Stock Count', 'N', 'Y', NULL, 'atmi', '2022-10-04 09:34:00'),
	(16, 'STR', 'Stock Transfer', 'N', 'Y', NULL, NULL, NULL),
	(17, 'ADIN', 'Adjust IN', 'N', 'Y', NULL, NULL, NULL),
	(18, 'ADOUT', 'Adjust Out', 'N', 'Y', NULL, NULL, NULL),
	(19, 'OUT', 'Outbound', 'N', 'Y', NULL, NULL, NULL),
	(20, 'PICK', 'Picking', 'N', 'Y', NULL, NULL, NULL),
	(21, 'CHECK', 'Checking', 'N', 'Y', NULL, NULL, NULL),
	(22, 'PACK', 'Packing', 'N', 'Y', NULL, NULL, NULL),
	(23, 'RTN', 'Return', 'N', 'Y', NULL, NULL, NULL),
	(24, 'GRR', 'Goods Receive Return', 'N', 'Y', NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_process` ENABLE KEYS */;

-- Dumping structure for table wms.m_process_2
CREATE TABLE IF NOT EXISTS `m_process_2` (
  `process_id` char(11) NOT NULL DEFAULT '',
  `process_code` char(11) NOT NULL DEFAULT '',
  `process_name` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_process_2: 15 rows
/*!40000 ALTER TABLE `m_process_2` DISABLE KEYS */;
INSERT INTO `m_process_2` (`process_id`, `process_code`, `process_name`, `is_active`, `user_created`, `datetime_created`) VALUES
	('1', '01', 'Putaway Inbound Regular', 'Y', 'atmi', '2022-09-26 16:49:42'),
	('2', '02', 'Putaway Inbound KIREX', 'Y', 'atmi', '2022-09-26 16:49:42'),
	('3', '03', 'Putaway Inbound Transfer Warehouse', 'Y', 'atmi', '2022-09-26 16:49:42'),
	('4', '04', 'Putaway Return', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('5', '05', 'Pick Outbound Regular', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('6', '06', 'Pick Outbound KIREX', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('7', '07', 'Pick Outbound Transfer Warehouse', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('8', '08', 'Movement Location', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('9', '09', 'Adjust In', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('10', '10', 'Adjust Out', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('11', '11', 'Stock Transfer', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('IN', 'IN', 'Inbound', 'Y', 'atmi', '2022-10-03 14:44:00'),
	('GR', 'GR', 'Goods Receive', 'Y', 'atmi', '2022-10-04 09:34:00'),
	('OUT', 'OUT', 'Outbound', 'Y', 'atmi', '2022-10-04 09:34:00'),
	('STC', 'STC', 'Stock Count', 'Y', 'atmi', '2022-10-04 09:34:00');
/*!40000 ALTER TABLE `m_process_2` ENABLE KEYS */;

-- Dumping structure for table wms.m_status
CREATE TABLE IF NOT EXISTS `m_status` (
  `status_id` varchar(3) NOT NULL DEFAULT '',
  `status_name` varchar(50) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`) USING BTREE,
  KEY `process_id` (`process_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_status: 53 rows
/*!40000 ALTER TABLE `m_status` DISABLE KEYS */;
INSERT INTO `m_status` (`status_id`, `status_name`, `process_id`, `is_active`, `user_created`, `datetime_created`) VALUES
	('UIN', 'Unreceived', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('RIN', 'Received', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('PIN', 'Partial Received', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('FIN', 'Fully Received', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('CLI', 'Close', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('CIN', 'Cancel', 12, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('OGR', 'Open', 13, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('CGR', 'Putaway Confirmed', 13, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('PGR', 'Fully Putaway', 13, 'Y', 'atmi', '2022-09-23 14:20:46'),
	('UNO', 'Unallocated', 19, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('ALO', 'Allocated', 19, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('RPO', 'Ready to Pick', 20, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('PIO', 'Picked', 20, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('PAO', 'Packed', 19, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('PPO', 'Pick and Pack', 19, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('GIO', 'Good Isuue', 22, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('DOO', 'Done', 19, 'Y', 'atmi', '2022-09-25 10:47:05'),
	('OPI', 'Open', 12, 'Y', NULL, NULL),
	('RGR', 'Received', 13, 'Y', 'atmi', '2022-10-04 10:32:06'),
	('CPI', 'Cancel Picking', 20, 'Y', NULL, NULL),
	('OPM', 'Open', 8, 'Y', 'atmi', '2022-11-04 09:08:04'),
	('COM', 'Confirm', 8, 'Y', 'atmi', '2022-11-04 09:08:04'),
	('CAM', 'Cancel', 8, 'Y', 'atmi', '2022-11-04 09:08:04'),
	('OST', 'Open', 16, 'Y', NULL, NULL),
	('CST', 'Confirmed', 16, 'Y', NULL, NULL),
	('ASM', 'Assigned', 8, 'Y', NULL, NULL),
	('MOM', 'Moved', 8, 'Y', NULL, NULL),
	('OIN', 'Open', 17, 'Y', NULL, NULL),
	('OOT', 'Open', 18, 'Y', NULL, NULL),
	('CAI', 'Confirmed', 17, 'Y', NULL, NULL),
	('CAO', 'Confirmed', 18, 'Y', NULL, NULL),
	('ODC', 'Open', 15, 'Y', NULL, NULL),
	('CFC', 'Confirmed', 15, 'Y', NULL, NULL),
	('ADC', 'Assigned', 15, 'Y', NULL, NULL),
	('OOP', 'Open', 14, 'Y', NULL, NULL),
	('AOP', 'Assigned', 14, 'Y', NULL, NULL),
	('CTD', 'Counted', 15, 'Y', NULL, NULL),
	('CTO', 'Counted', 14, 'Y', NULL, NULL),
	('CFO', 'Confirmed', 14, 'Y', NULL, NULL),
	('COU', 'Cancel Outbound', 19, 'Y', NULL, NULL),
	('UNC', 'Unchecked', 21, 'Y', NULL, NULL),
	('CHE', 'Checked', 21, 'Y', NULL, NULL),
	('CAC', 'Cancel Checking', 21, 'Y', NULL, NULL),
	('UNP', 'Unpacked', 22, 'Y', NULL, NULL),
	('PAC', 'Packed', 22, 'Y', NULL, NULL),
	('CGI', 'Cancel Good Issue', 22, 'Y', NULL, NULL),
	('OPR', 'Open', 23, 'Y', NULL, NULL),
	('RER', 'Return Received', 23, 'Y', NULL, NULL),
	('RFR', 'Return Fully Received', 23, 'Y', NULL, NULL),
	('ORR', 'Open', 24, 'Y', NULL, NULL),
	('RRR', 'Received', 24, 'Y', NULL, NULL),
	('CRR', 'Confirmed', 24, 'Y', NULL, NULL),
	('FRR', 'Fully Putaway', 24, 'Y', NULL, NULL);
/*!40000 ALTER TABLE `m_status` ENABLE KEYS */;

-- Dumping structure for table wms.m_status_2
CREATE TABLE IF NOT EXISTS `m_status_2` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) DEFAULT NULL,
  `process_id` char(11) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  KEY `process_id` (`process_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_status_2: 22 rows
/*!40000 ALTER TABLE `m_status_2` DISABLE KEYS */;
INSERT INTO `m_status_2` (`status_id`, `status_name`, `process_id`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 'Unreceived', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(2, 'Received', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(3, 'Partial Received', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(4, 'Fully Received', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(5, 'Close', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(6, 'Cancel', 'IN', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(7, 'Open', 'GR', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(8, 'Putaway Confirmed', 'GR', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(9, 'Fully Putaway', 'GR', 'Y', 'atmi', '2022-09-23 14:20:46'),
	(10, 'Unallocated', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(11, 'Allocated', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(12, 'Ready to Pick', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(13, 'Picked', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(14, 'Packed', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(15, 'Pick and Pack', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(16, 'Good Isuue', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(17, 'Done', 'OUT', 'Y', 'atmi', '2022-09-25 10:47:05'),
	(18, 'Open', 'IN', 'Y', NULL, NULL),
	(19, 'Received', 'GR', 'Y', 'atmi', '2022-10-04 10:32:06'),
	(20, 'Open', '8', 'Y', NULL, NULL),
	(21, 'Confirm', '8', 'Y', NULL, NULL),
	(22, 'Cancel', '8', 'Y', NULL, NULL);
/*!40000 ALTER TABLE `m_status_2` ENABLE KEYS */;

-- Dumping structure for table wms.m_status_relation
CREATE TABLE IF NOT EXISTS `m_status_relation` (
  `status_relation_id` int(11) NOT NULL DEFAULT 0,
  `status_id` varchar(3) NOT NULL DEFAULT '',
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`status_relation_id`,`status_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_status_relation: 12 rows
/*!40000 ALTER TABLE `m_status_relation` DISABLE KEYS */;
INSERT INTO `m_status_relation` (`status_relation_id`, `status_id`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 'UIN', 'Y', NULL, NULL),
	(1, 'RGR', 'Y', NULL, NULL),
	(1, 'ASM', 'Y', NULL, NULL),
	(1, 'AOP', 'Y', NULL, NULL),
	(1, 'ADC', 'Y', NULL, NULL),
	(1, 'RPO', 'Y', NULL, NULL),
	(2, 'RIN', 'Y', NULL, NULL),
	(2, 'RGR', 'Y', NULL, NULL),
	(2, 'MOM', 'Y', NULL, NULL),
	(2, 'CTO', 'Y', NULL, NULL),
	(2, 'CTD', 'Y', NULL, NULL),
	(2, 'RPO', 'Y', NULL, NULL);
/*!40000 ALTER TABLE `m_status_relation` ENABLE KEYS */;

-- Dumping structure for table wms.m_user_group
CREATE TABLE IF NOT EXISTS `m_user_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activ` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_user_group: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_user_group` DISABLE KEYS */;
INSERT INTO `m_user_group` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_activ`) VALUES
	(1, 'SA', 'Superadmin', '', '2024-08-30 08:48:51', NULL, '2024-09-18 08:12:53', 'Y'),
	(2, 'SPV', 'Spv', '', '2024-08-30 10:21:49', NULL, '2024-09-04 13:03:06', 'Y'),
	(3, 'ADM', 'Admin', '', '2024-08-30 10:22:03', NULL, '2024-09-04 13:00:36', 'Y'),
	(4, 'Staff', 'Staff', 'superadmin', '2024-09-03 10:30:09', NULL, '2024-09-04 13:00:24', 'Y');
/*!40000 ALTER TABLE `m_user_group` ENABLE KEYS */;

-- Dumping structure for table wms.m_user_group_menu_access
CREATE TABLE IF NOT EXISTS `m_user_group_menu_access` (
  `usergroup_id` bigint(20) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`usergroup_id`,`menu_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_user_group_menu_access: 149 rows
/*!40000 ALTER TABLE `m_user_group_menu_access` DISABLE KEYS */;
INSERT INTO `m_user_group_menu_access` (`usergroup_id`, `menu_id`) 
VALUES 
  (1, 10), 
  (1, 31), 
  (1, 44), 
  (1, 46), 
  (2, 1), 
  (2, 10), 
  (2, 11), 
  (2, 12), 
  (2, 31), 
  (2, 44), 
  (2, 46),  
  (3, 1), 
  (3, 11), 
  (3, 12), 
  (4, 1), 
  (4, 11),  
  (4, 12);
/*!40000 ALTER TABLE `m_user_group_menu_access` ENABLE KEYS */;

-- Dumping structure for table wms.m_user_menu_access
CREATE TABLE IF NOT EXISTS `m_user_menu_access` (
  `username` varchar(50) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_user_menu_access: 53 rows
/*!40000 ALTER TABLE `m_user_menu_access` DISABLE KEYS */;
INSERT INTO `m_user_menu_access` (`username`, `menu_id`) VALUES
	('ares', 1),
	('ares', 4),
	('ares', 11),
	('superadmin', 1),
	('superadmin', 4),
	('superadmin', 5),
	('superadmin', 6),
	('superadmin', 7),
	('superadmin', 8),
	('superadmin', 9),
	('superadmin', 10),
	('superadmin', 11),
	('superadmin', 12),
	('superadmin', 13),
	('superadmin', 14),
	('superadmin', 15),
	('superadmin', 16),
	('superadmin', 17),
	('superadmin', 18),
	('superadmin', 19),
	('superadmin', 20),
	('superadmin', 21),
	('superadmin', 22),
	('superadmin', 23),
	('superadmin', 24),
	('superadmin', 25),
	('superadmin', 26),
	('superadmin', 27),
	('superadmin', 28),
	('superadmin', 29),
	('superadmin', 30),
	('superadmin', 31),
	('superadmin', 32),
	('superadmin', 33),
	('superadmin', 34),
	('superadmin', 35),
	('superadmin', 36),
	('superadmin', 37),
	('superadmin', 38),
	('superadmin', 39),
	('superadmin', 40),
	('superadmin', 41),
	('superadmin', 42),
	('superadmin', 43),
	('superadmin', 44),
	('superadmin', 45),
	('whsman01', 6),
	('whsman01', 12),
	('whsman01', 14),
	('whsman01', 17),
	('whsman01', 19),
	('whsman01', 39),
	('whsman01', 40);
/*!40000 ALTER TABLE `m_user_menu_access` ENABLE KEYS */;

-- Dumping structure for table wms.m_warehouse
CREATE TABLE IF NOT EXISTS `m_warehouse` (
  `wh_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wh_code` varchar(50) DEFAULT NULL,
  `wh_prefix` varchar(50) DEFAULT NULL,
  `wh_name` varchar(100) DEFAULT NULL,
  `address1` varchar(30) DEFAULT NULL,
  `address2` varchar(30) DEFAULT NULL,
  `address3` varchar(30) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `client_project_id` int(11) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`wh_id`) USING BTREE,
  KEY `id` (`wh_id`),
  KEY `wh_id` (`wh_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master warehouse';

-- Dumping data for table wms.m_warehouse: 2 rows
/*!40000 ALTER TABLE `m_warehouse` DISABLE KEYS */;
INSERT INTO `m_warehouse` (`wh_id`, `wh_code`, `wh_prefix`, `wh_name`, `address1`, `address2`, `address3`, `city`, `country`, `postal_code`, `phone`, `client_project_id`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 'NOJ-GD-01', 'NG1', 'GUDANG 1', 'Jl. AKBP Agil Kusumadya No.2a,', 'Kec. Jati, Kab. Kudus', NULL, 'Jawa Tengah', 'Indonesia', 59347, '(022) 8980981', 1, 'superadmin', '2024-09-03 13:22:41', 'superadmin', '2024-09-03 14:25:37', 'Y', 'N'),
	(2, 'NOJ-GD-02', 'NG2', 'GUDANG 2', 'Jl. AKBP Agil Kusumadya No.2a,', 'Kec. Jati, Kab. Kudus', NULL, 'Jawa Tengah', 'Indonesia', 59347, NULL, 1, 'superadmin', '2024-09-03 13:22:41', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_warehouse` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_adjustment_type
CREATE TABLE IF NOT EXISTS `m_wh_adjustment_type` (
  `adjustment_code` varchar(5) NOT NULL DEFAULT '',
  `adjustment_type` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`adjustment_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_adjustment_type: 2 rows
/*!40000 ALTER TABLE `m_wh_adjustment_type` DISABLE KEYS */;
INSERT INTO `m_wh_adjustment_type` (`adjustment_code`, `adjustment_type`, `user_created`, `datetime_created`) VALUES
	('ADIN', 'Adjustment IN', 'atmi', '2022-11-22 16:57:05'),
	('ADOUT', 'Adjustment OUT', 'atmi', '2022-11-22 16:57:07');
/*!40000 ALTER TABLE `m_wh_adjustment_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_buffer
CREATE TABLE IF NOT EXISTS `m_wh_buffer` (
  `buffer_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(20) DEFAULT NULL,
  `qty_buffer` int(11) DEFAULT NULL,
  `rules_id` int(11) DEFAULT NULL,
  `messages` varchar(250) DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`buffer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_buffer: 6 rows
/*!40000 ALTER TABLE `m_wh_buffer` DISABLE KEYS */;
INSERT INTO `m_wh_buffer` (`buffer_id`, `contact_id`, `sku`, `qty_buffer`, `rules_id`, `messages`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 1, '75016438', 50, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-03 16:35:29', NULL, NULL),
	(2, 1, '32L5995', 50, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-03 16:35:57', NULL, NULL),
	(3, 1, '47RW1EJ', 50, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-03 16:37:04', NULL, NULL),
	(4, 1, '112233445', 100, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-03 16:37:53', NULL, NULL),
	(5, 1, 'KK3259001', 20, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-03 17:32:12', NULL, NULL),
	(6, 1, 'ABC123', 50, 2, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'atmi', '2023-05-08 11:01:45', NULL, NULL);
/*!40000 ALTER TABLE `m_wh_buffer` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_client
CREATE TABLE IF NOT EXISTS `m_wh_client` (
  `client_id` varchar(20) NOT NULL,
  `client_name` varchar(40) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `methods_id` int(11) DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master client warehouse';

-- Dumping data for table wms.m_wh_client: 2 rows
/*!40000 ALTER TABLE `m_wh_client` DISABLE KEYS */;
INSERT INTO `m_wh_client` (`client_id`, `client_name`, `address1`, `address2`, `address3`, `phone`, `city`, `country`, `postal_code`, `account_number`, `methods_id`, `user_created`, `datetime_created`, `updated_by`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	('NOJ', 'Nojorono', 'Jl. AKBP Agil Kusumadya No.2a, Jatikulon Krajan', 'Jati Kulon, Kec. Jati, Kab, Kudus', NULL, NULL, 'Jawa Tengah', 'Indonesia', '59347', 123, 1, NULL, NULL, 'superadmin', '2024-09-02 10:56:47', 'Y', 'N'),
	('CT', 'client test', 'jalan ciputat raya no 99', NULL, NULL, '123', 'Jakarta', 'Indonesia', '12310', NULL, 1, 'superadmin', '2023-05-04 09:06:46', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_wh_client` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_client_project
CREATE TABLE IF NOT EXISTS `m_wh_client_project` (
  `client_project_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(20) NOT NULL,
  `project_type_id` int(11) NOT NULL DEFAULT 0,
  `client_project_name` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`client_project_id`,`client_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='project client warehouse';

-- Dumping data for table wms.m_wh_client_project: 6 rows
/*!40000 ALTER TABLE `m_wh_client_project` DISABLE KEYS */;
INSERT INTO `m_wh_client_project` (`client_project_id`, `client_id`, `project_type_id`, `client_project_name`, `address1`, `address2`, `address3`, `city`, `postal_code`, `country`, `phone`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 'NOJ', 1, 'Nojorono', 'Jl. AKBP Agil Kusumadya No.2a, Jatikulon Krajan', 'Jati Kulon, Kec. Jati, Kab, Kudus', NULL, 'Jawa Tengah', '59347', 'Indonesia', '', NULL, NULL, 'mariofrans', '2023-03-07 16:09:43', 'Y', 'N'),
	(2, 'CT', 1, 'client project test', 'jalan ciputat raya no 99', NULL, NULL, 'Jakarta', '12310', 'Indonesia', '', NULL, NULL, 'mariofrans', '2023-03-07 16:09:43', 'Y', 'N'),
	(3, 'NOJ', 1, 'test', 'es', 'tet', NULL, 'test', '12345', 'test', 'test', 'superadmin', '2024-09-04 08:59:48', NULL, NULL, 'Y', 'N'),
	(4, 'NOJ', 1, 'poi', 'poi', 'poi', 'poi', 'poi', '1234', 'ppoi', '123', 'superadmin', '2024-09-04 09:39:28', NULL, NULL, 'Y', 'N'),
	(5, 'NOJ', 1, 'weqwe', 'qweqw', 'qwe', 'qwe', 'qwe', '123124`', 'qwe', '12312', 'superadmin', '2024-09-04 09:40:33', NULL, NULL, 'Y', 'N'),
	(6, 'NOJ', 1, 'weqwe', 'qweqw', 'qwe', 'qwe', 'qwe', '123124`', 'qwe', '12312', 'superadmin', '2024-09-04 09:41:08', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_wh_client_project` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_client_project_whs
CREATE TABLE IF NOT EXISTS `m_wh_client_project_whs` (
  `client_project_id` int(11) NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `wh_id` bigint(20) unsigned NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`client_project_id`,`client_id`,`wh_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='project client warehouse';

-- Dumping data for table wms.m_wh_client_project_whs: 9 rows
/*!40000 ALTER TABLE `m_wh_client_project_whs` DISABLE KEYS */;
INSERT INTO `m_wh_client_project_whs` (`client_project_id`, `client_id`, `wh_id`, `created_by`, `created_on`, `user_updated`, `datetime_updated`) VALUES
	(1, 'NOJ', 1, NULL, NULL, 'mariofrans', '2023-03-07 16:09:43'),
	(2, 'CT', 1, NULL, NULL, 'mariofrans', '2023-03-07 16:09:43'),
	(1, 'NOJ', 2, NULL, NULL, NULL, NULL),
	(4, 'NOJ', 1, 'superadmin', '2024-09-04 09:39:28', NULL, NULL),
	(4, 'NOJ', 2, 'superadmin', '2024-09-04 09:39:28', NULL, NULL),
	(5, 'NOJ', 1, 'superadmin', '2024-09-04 09:40:33', NULL, NULL),
	(5, 'NOJ', 2, 'superadmin', '2024-09-04 09:40:33', NULL, NULL),
	(6, 'NOJ', 1, 'superadmin', '2024-09-04 09:41:08', NULL, NULL),
	(6, 'NOJ', 2, 'superadmin', '2024-09-04 09:41:08', NULL, NULL);
/*!40000 ALTER TABLE `m_wh_client_project_whs` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_commodity
CREATE TABLE IF NOT EXISTS `m_wh_commodity` (
  `commodity_id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity_name` varchar(50) DEFAULT '',
  `commodity_desc` varchar(250) DEFAULT '',
  `user_created` varchar(250) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`commodity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_commodity: 5 rows
/*!40000 ALTER TABLE `m_wh_commodity` DISABLE KEYS */;
INSERT INTO `m_wh_commodity` (`commodity_id`, `commodity_name`, `commodity_desc`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 'Chemicals', 'Chemicals, Liquid, etc', 'atmi', '2023-03-06 11:39:11', '', NULL),
	(2, 'Electronics', 'Electronics', 'atmi', '2023-03-06 11:39:50', '', NULL),
	(3, 'Foods', 'Foods, Beverages, etc', 'atmi', '2023-03-06 11:40:15', '', NULL),
	(4, 'Tools', 'Sparepart, Mechanical Tools, etc', 'atmi', '2023-03-06 11:41:00', '', NULL),
	(5, 'Others', 'Lainnya', 'atmi', '2023-03-07 16:28:21', 'atmi', '2023-03-07 17:18:30');
/*!40000 ALTER TABLE `m_wh_commodity` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_contact_buffer
CREATE TABLE IF NOT EXISTS `m_wh_contact_buffer` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`contact_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_contact_buffer: 1 rows
/*!40000 ALTER TABLE `m_wh_contact_buffer` DISABLE KEYS */;
INSERT INTO `m_wh_contact_buffer` (`contact_id`, `client_project_id`, `supplier_id`, `is_active`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 1, 5, 'Y', 'atmi', '2023-05-04 16:19:56', 'superadmin', '2024-09-04 14:22:06');
/*!40000 ALTER TABLE `m_wh_contact_buffer` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_contact_buffer_detail
CREATE TABLE IF NOT EXISTS `m_wh_contact_buffer_detail` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type_id` int(11) NOT NULL,
  `notification_address` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`contact_id`,`notification_type_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_wh_contact_buffer_detail: 2 rows
/*!40000 ALTER TABLE `m_wh_contact_buffer_detail` DISABLE KEYS */;
INSERT INTO `m_wh_contact_buffer_detail` (`contact_id`, `notification_type_id`, `notification_address`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 1, 'banyu.senjana@limamail.net', 'superadmin', '2024-09-04 14:22:06', NULL, NULL),
	(1, 3, NULL, 'superadmin', '2024-09-04 14:22:06', NULL, NULL);
/*!40000 ALTER TABLE `m_wh_contact_buffer_detail` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_inbox
CREATE TABLE IF NOT EXISTS `m_wh_inbox` (
  `inbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `buffer_id` int(11) NOT NULL,
  `available_qty_total` int(11) NOT NULL,
  `messages` text DEFAULT NULL,
  `is_read` enum('Y','N') DEFAULT 'N',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`inbox_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_inbox: 2 rows
/*!40000 ALTER TABLE `m_wh_inbox` DISABLE KEYS */;
INSERT INTO `m_wh_inbox` (`inbox_id`, `buffer_id`, `available_qty_total`, `messages`, `is_read`, `user_created`, `datetime_created`) VALUES
	(1, 1, 0, 'Stok SKU 75016438 kurang dari buffer stock. Harap melakukan inbound kembali', 'Y', 'atmi', '2023-05-10 10:13:12'),
	(2, 6, 33, 'Please inbound for details of this item Client Project Name : Toshiba Supplier Name : test SKU : ABC123 Available Qty : 33 ', 'N', 'atmi', '2023-05-10 14:47:46');
/*!40000 ALTER TABLE `m_wh_inbox` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_item
CREATE TABLE IF NOT EXISTS `m_wh_item` (
  `sku` varchar(20) NOT NULL DEFAULT '',
  `part_name` varchar(200) DEFAULT NULL,
  `base_qty` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `item_classification_id` int(11) DEFAULT NULL,
  `base_uom` varchar(20) DEFAULT NULL,
  `length` double DEFAULT NULL,
  `width` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `directions` varchar(50) DEFAULT '',
  `group_id` char(50) DEFAULT NULL,
  `wh_id` varchar(10) DEFAULT NULL,
  `client_id` varchar(10) NOT NULL DEFAULT '',
  `photo` text DEFAULT NULL,
  `is_serial_no` enum('Y','N') DEFAULT 'N',
  `is_batch_no` enum('Y','N') DEFAULT 'N',
  `is_imei` enum('Y','N') DEFAULT 'N',
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`sku`,`client_id`) USING BTREE,
  KEY `wh_id` (`wh_id`),
  KEY `is_serial_no` (`is_serial_no`),
  KEY `is_batch_no` (`is_batch_no`),
  KEY `is_imei` (`is_imei`),
  KEY `item_classification_id` (`item_classification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master item warehouse';

-- Dumping data for table wms.m_wh_item: 3 rows
/*!40000 ALTER TABLE `m_wh_item` DISABLE KEYS */;
INSERT INTO `m_wh_item` (
  `sku`, `part_name`, `base_qty`, `imei`, 
  `part_no`, `color`, `size`, `item_classification_id`, 
  `base_uom`, `length`, `width`, `height`, 
  `volume`, `directions`, `group_id`, 
  `wh_id`, `client_id`, `photo`, `is_serial_no`, 
  `is_batch_no`, `is_imei`, `created_by`, 
  `created_on`, `user_updated`, `datetime_updated`, 
  `is_active`
) 
VALUES 
  (
    'SKU001', 'Cigatow', NULL, NULL, NULL, 
    NULL, NULL, NULL, 'PALLET', 50, 50, 
    50, 1000, NULL, NULL, '1', 'NOJ', NULL, 
    'N', 'N', 'N', 'superadmin', '2024-09-04 13:23:31', 
    NULL, NULL, 'Y'
  ), 
  (
    'SKU002', 'Foil', NULL, NULL, NULL, 
    NULL, NULL, NULL, 'PALLET', 60, 100, 5, 40, 
    NULL, NULL, '1', 'NOJ', NULL, 'N', 'N', 
    'N', 'superadmin', '2024-08-26 09:06:49', 
    NULL, NULL, 'Y'
  ), 
  (
    'SKU003', 'Porous Plug Wrap Paper', 
    NULL, NULL, NULL, NULL, NULL, NULL, 
    'PALLET', 50, 50, 50, 125000, NULL, 
    NULL, '1', 'NOJ', NULL, 'N', 'N', 'N', 
    'superadmin', '2024-09-02 11:16:37', 
    NULL, NULL, 'Y'
  ),
    (
    'SKU004', 'Cigarete Paper', 
    NULL, NULL, NULL, NULL, NULL, NULL, 
    'PALLET', 50, 50, 50, 125000, NULL, 
    NULL, '1', 'NOJ', NULL, 'N', 'N', 'N', 
    'superadmin', '2024-09-02 11:16:37', 
    NULL, NULL, 'Y'
  ),
  (
    'SKU005', 'CTP', 
    NULL, NULL, NULL, NULL, NULL, NULL, 
    'PALLET', 50, 50, 50, 125000, NULL, 
    NULL, '1', 'NOJ', NULL, 'N', 'N', 'N', 
    'superadmin', '2024-09-02 11:16:37', 
    NULL, NULL, 'Y'
  ),
  (
    'SKU006', 'Inner frame', 
    NULL, NULL, NULL, NULL, NULL, NULL, 
    'PALLET', 50, 50, 50, 125000, NULL, 
    NULL, '1', 'NOJ', NULL, 'N', 'N', 'N', 
    'superadmin', '2024-09-02 11:16:37', 
    NULL, NULL, 'Y'
  );
/*!40000 ALTER TABLE `m_wh_item` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location
CREATE TABLE IF NOT EXISTS `m_wh_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_code` varchar(50) NOT NULL,
  `wh_id` bigint(20) unsigned DEFAULT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  `index_code` varchar(10) DEFAULT NULL,
  `location_type` varchar(50) DEFAULT NULL,
  `commodity_id` int(11) DEFAULT 0,
  `client_project_id` int(11) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`location_id`) USING BTREE,
  KEY `stock_id` (`stock_id`),
  KEY `type` (`index_code`) USING BTREE,
  KEY `location_code` (`location_code`),
  KEY `wh_id` (`wh_id`),
  KEY `type_code` (`location_type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master lokasi warehouse';

-- Dumping data for table wms.m_wh_location: 13 rows
/*!40000 ALTER TABLE `m_wh_location` DISABLE KEYS */;
INSERT INTO `m_wh_location` (
  `location_id`, `location_code`, `wh_id`, 
  `location_name`, `index_code`, `location_type`, 
  `commodity_id`, `client_project_id`, 
  `stock_id`, `created_by`, `created_on`, 
  `user_updated`, `datetime_updated`, 
  `is_active`, `is_deleted`
) 
VALUES 
  (
    1, 'GD01-F01-001', 1, 'GD01-F01-001', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  ),
  (
    2, 'GD01-F01-002', 1, 'GD01-F01-002', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  ),
  (
    3, 'GD01-F01-003', 1, 'GD01-F01-003', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  ),
  (
    4, 'GD02-F01-001', 2, 'GD02-F01-001', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  ),
  (
    5, 'GD02-F01-002', 2, 'GD02-F01-002', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  ),
  (
    6, 'GD02-F01-003', 2, 'GD02-F01-003', 
    'F01', 'Floor', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 
    'atmi', '2023-03-07 09:14:55', 'Y', 
    NULL
  );
/*!40000 ALTER TABLE `m_wh_location` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location_index
CREATE TABLE IF NOT EXISTS `m_wh_location_index` (
  `index_code` varchar(10) NOT NULL DEFAULT '',
  `index_name` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `width` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`index_code`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tipe Lokasi Warehouse';

-- Dumping data for table wms.m_wh_location_index: 5 rows
/*!40000 ALTER TABLE `m_wh_location_index` DISABLE KEYS */;
INSERT INTO `m_wh_location_index` (
  `index_code`, `index_name`, `length`, 
  `width`, `height`, `capacity`, `is_active`, 
  `is_deleted`, `user_created`, `datetime_created`, 
  `user_updated`, `datetime_updated`
) 
VALUES 
  (
    'F01', 'Floor', '30', '30', '100', 
    '1000', 'Y', NULL, 'atmi', '2022-09-21 17:34:29', 
    NULL, NULL
  ), 
  (
    'R01', 'Rack', '50', '30', '50', 
    '1000', 'Y', NULL, 'atmi', '2023-03-07 10:29:42', 
    'superadmin', '2024-09-04 11:31:32'
  ),
  (
    'B01', 'Bulk', '50', '30', '50', 
    '1000', 'Y', NULL, 'atmi', '2023-03-07 10:29:42', 
    'superadmin', '2024-09-04 11:31:32'
  );
/*!40000 ALTER TABLE `m_wh_location_index` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location_type
CREATE TABLE IF NOT EXISTS `m_wh_location_type` (
  `type_name` varchar(50) NOT NULL DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`type_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_location_type: 4 rows
/*!40000 ALTER TABLE `m_wh_location_type` DISABLE KEYS */;
INSERT INTO `m_wh_location_type` (`type_name`, `user_created`, `datetime_created`, `is_active`) VALUES
	('Racking', 'atmi', '2022-10-06 16:42:37', 'Y'),
	('Bulk', 'atmi', '2022-10-06 16:42:37', 'Y'),
	('Quarantine', 'atmi', '2022-10-06 16:42:37', 'Y'),
	('Return', 'atmi', '2022-10-06 16:42:37', 'Y');
/*!40000 ALTER TABLE `m_wh_location_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_mail
CREATE TABLE IF NOT EXISTS `m_wh_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `buffer_id` int(11) NOT NULL DEFAULT 0,
  `available_qty_total` int(11) NOT NULL DEFAULT 0,
  `subject` text NOT NULL,
  `messages` text DEFAULT NULL,
  `send_from` text DEFAULT NULL,
  `send_to` text DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`mail_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_wh_mail: 2 rows
/*!40000 ALTER TABLE `m_wh_mail` DISABLE KEYS */;
INSERT INTO `m_wh_mail` (`mail_id`, `buffer_id`, `available_qty_total`, `subject`, `messages`, `send_from`, `send_to`, `user_created`, `datetime_created`) VALUES
	(1, 1, 33, 'Buffer Stock Notification', NULL, NULL, NULL, NULL, NULL),
	(2, 6, 33, 'Buffer Stock Notification', 'Dear test Please inbound for details of this item Client Project Name : Toshiba Supplier Name : test SKU : ABC123 Available Qty : 33 Regards, Warehouse Admin', 'no-reply.wms@rpxholding.com', 'npertiwi@rpxholding.com', 'atmi', '2023-05-10 14:21:15');
/*!40000 ALTER TABLE `m_wh_mail` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_methods
CREATE TABLE IF NOT EXISTS `m_wh_methods` (
  `methods_id` int(11) NOT NULL,
  `methods_name` varchar(50) DEFAULT '',
  `methods_desc` varchar(250) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`methods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_methods: 3 rows
/*!40000 ALTER TABLE `m_wh_methods` DISABLE KEYS */;
INSERT INTO `m_wh_methods` (`methods_id`, `methods_name`, `methods_desc`, `user_created`, `datetime_created`) VALUES
	(1, 'FIFO', 'First In First Out', 'atmi', '2023-03-01 15:51:12'),
	(2, 'FEFO', 'First Expired First Out', 'atmi', '2023-03-01 15:51:20'),
	(3, 'LIFO', 'Last In First Out', 'atmi', '2023-03-01 15:51:31');
/*!40000 ALTER TABLE `m_wh_methods` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_notification_type
CREATE TABLE IF NOT EXISTS `m_wh_notification_type` (
  `notification_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`notification_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_notification_type: 3 rows
/*!40000 ALTER TABLE `m_wh_notification_type` DISABLE KEYS */;
INSERT INTO `m_wh_notification_type` (`notification_type_id`, `notification_type_name`) VALUES
	(1, 'email'),
	(2, 'whatsapp'),
	(3, 'apps inbox');
/*!40000 ALTER TABLE `m_wh_notification_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_order_type
CREATE TABLE IF NOT EXISTS `m_wh_order_type` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_type` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='tipe order customer warehouse';

-- Dumping data for table wms.m_wh_order_type: 3 rows
/*!40000 ALTER TABLE `m_wh_order_type` DISABLE KEYS */;
INSERT INTO `m_wh_order_type` (`order_id`, `order_type`, `created_by`, `created_on`, `is_active`, `is_deleted`) VALUES
	(1, 'Regular', NULL, NULL, 'Y', NULL),
	(2, 'Kiriman Express', NULL, NULL, 'N', 'Y'),
	(3, 'Transfer Warehouse', NULL, NULL, 'Y', NULL);
/*!40000 ALTER TABLE `m_wh_order_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_parameter
CREATE TABLE IF NOT EXISTS `m_wh_parameter` (
  `param_var` varchar(20) NOT NULL,
  `rules_id` varchar(50) NOT NULL,
  `param_text` text DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) NOT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`param_var`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_parameter: 3 rows
/*!40000 ALTER TABLE `m_wh_parameter` DISABLE KEYS */;
INSERT INTO `m_wh_parameter` (`param_var`, `rules_id`, `param_text`, `remarks`, `is_active`, `user_created`, `datetime_created`) VALUES
	('lebih_dari', '1', NULL, 'SKU lebih dari buffer stock', 'Y', 'atmi', '2023-05-08 11:41:04'),
	('kurang_dari', '2', NULL, 'SKU kurang dari buffer stock. Harap melakukan inbound kembali', 'Y', 'atmi', '2023-05-08 11:47:26'),
	('sama_dengan', '3', NULL, 'SKU sama dengan buffer stock.', 'Y', 'atmi', '2023-05-08 11:50:22');
/*!40000 ALTER TABLE `m_wh_parameter` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_project_type
CREATE TABLE IF NOT EXISTS `m_wh_project_type` (
  `project_type_id` int(11) NOT NULL,
  `project_type_name` varchar(50) DEFAULT '',
  `project_type_desc` varchar(50) DEFAULT '',
  PRIMARY KEY (`project_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_project_type: 2 rows
/*!40000 ALTER TABLE `m_wh_project_type` DISABLE KEYS */;
INSERT INTO `m_wh_project_type` (`project_type_id`, `project_type_name`, `project_type_desc`) VALUES
	(1, 'B2B', 'Business to Business'),
	(2, 'Fulfillment', 'Warehouse Fulfillment');
/*!40000 ALTER TABLE `m_wh_project_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_rules
CREATE TABLE IF NOT EXISTS `m_wh_rules` (
  `rules_id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rules_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_rules: 3 rows
/*!40000 ALTER TABLE `m_wh_rules` DISABLE KEYS */;
INSERT INTO `m_wh_rules` (`rules_id`, `desc`) VALUES
	(1, 'lebih besar dari'),
	(2, 'kurang dari'),
	(3, 'sama dengan');
/*!40000 ALTER TABLE `m_wh_rules` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_service_type
CREATE TABLE IF NOT EXISTS `m_wh_service_type` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(25) DEFAULT NULL,
  `service_description` varchar(200) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_service_type: 4 rows
/*!40000 ALTER TABLE `m_wh_service_type` DISABLE KEYS */;
INSERT INTO `m_wh_service_type` (`service_id`, `service_name`, `service_description`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 'Kilat', 'Secepat Kilat', 'Y', 'rdarmawan', '2023-01-03 13:53:35'),
	(2, 'Sameday', 'Pengiriman di hari yang sama', 'Y', 'rdarmawan', '2023-01-03 13:53:58'),
	(3, 'Regular', 'Pengiriman Regular', 'Y', 'atmi', '2023-03-17 14:26:53'),
	(4, 'Next Day', 'Pengiriman esok hari', 'Y', 'rdarmawan', '2023-03-17 14:28:09');
/*!40000 ALTER TABLE `m_wh_service_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_setting_buffer
CREATE TABLE IF NOT EXISTS `m_wh_setting_buffer` (
  `client_project_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `is_email` enum('Y','N') DEFAULT NULL,
  `is_whatsapp` enum('Y','N') DEFAULT NULL,
  `is_apps` enum('Y','N') DEFAULT NULL,
  `notification_time` varchar(50) DEFAULT NULL,
  `notification_periods` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_setting_buffer: 0 rows
/*!40000 ALTER TABLE `m_wh_setting_buffer` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_wh_setting_buffer` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_stock_count_type
CREATE TABLE IF NOT EXISTS `m_wh_stock_count_type` (
  `type_code` varchar(3) NOT NULL DEFAULT '',
  `type_name` varchar(50) DEFAULT '',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`type_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_stock_count_type: 2 rows
/*!40000 ALTER TABLE `m_wh_stock_count_type` DISABLE KEYS */;
INSERT INTO `m_wh_stock_count_type` (`type_code`, `type_name`, `is_active`, `user_created`, `datetime_created`) VALUES
	('DCC', 'Daily Cycle Count', 'Y', '', NULL),
	('OPN', 'Opname', 'Y', '', NULL);
/*!40000 ALTER TABLE `m_wh_stock_count_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_stock_type
CREATE TABLE IF NOT EXISTS `m_wh_stock_type` (
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `stock_type` varchar(50) DEFAULT '',
  `process_id` char(11) DEFAULT NULL,
  `selling_type` char(1) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`stock_id`) USING BTREE,
  KEY `process_id` (`process_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Stock Type';

-- Dumping data for table wms.m_wh_stock_type: 7 rows
/*!40000 ALTER TABLE `m_wh_stock_type` DISABLE KEYS */;
INSERT INTO `m_wh_stock_type` (`stock_id`, `stock_type`, `process_id`, `selling_type`, `created_by`, `created_on`, `is_active`, `is_deleted`) VALUES
	('AV', 'AVAILABLE STOCK', 'IN', '1', NULL, NULL, NULL, NULL),
	('DMG', 'DAMAGE STOCK', 'IN', '2', NULL, NULL, NULL, NULL),
	('QR', 'QUARANTINE STOCK', 'IN', '2', NULL, NULL, NULL, NULL),
	('RT', 'RETURN STOCK', 'RTN', NULL, NULL, NULL, NULL, NULL),
	('WIP', 'WORK IN PROCESS STOCK', 'IN', NULL, NULL, NULL, NULL, NULL),
	('AVR', 'AVAILABLE STOCK RETURN', 'RTN', '1', NULL, NULL, NULL, NULL),
	('DMGR', 'DAMAGE STOCK RETURN', 'RTN', '2', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_wh_stock_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_stock_type_copy
CREATE TABLE IF NOT EXISTS `m_wh_stock_type_copy` (
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `stock_type` varchar(50) DEFAULT '',
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`stock_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='Stock Type';

-- Dumping data for table wms.m_wh_stock_type_copy: 5 rows
/*!40000 ALTER TABLE `m_wh_stock_type_copy` DISABLE KEYS */;
INSERT INTO `m_wh_stock_type_copy` (`stock_id`, `stock_type`, `created_by`, `created_on`, `is_active`) VALUES
	('AV', 'AVAILABLE STOCK', NULL, NULL, NULL),
	('DMG', 'DAMAGE STOCK', NULL, NULL, NULL),
	('QR', 'QUARANTINE STOCK', NULL, NULL, NULL),
	('RT', 'RETURN STOCK', NULL, NULL, NULL),
	('WIP', 'WORK IN PROCESS STOCK', NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_wh_stock_type_copy` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_supplier
CREATE TABLE IF NOT EXISTS `m_wh_supplier` (
  `supplier_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `client_id` varchar(30) DEFAULT NULL,
  `contact_person` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`supplier_id`) USING BTREE,
  KEY `cust_id` (`client_id`) USING BTREE,
  KEY `id` (`supplier_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master supplier warehouse';

-- Dumping data for table wms.m_wh_supplier: 5 rows
/*!40000 ALTER TABLE `m_wh_supplier` DISABLE KEYS */;
INSERT INTO `m_wh_supplier` (
  `supplier_id`, `supplier_name`, `address1`, 
  `address2`, `address3`, `city`, `client_id`, 
  `contact_person`, `phone`, `created_by`, 
  `created_on`, `user_updated`, `datetime_updated`, 
  `is_active`, `is_deleted`
) 
VALUES 
  (
    1, 'Supplier Cigatow', 'Address1 Supplier Cigatow', 'Address2 Supplier Cigatow', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  ),
   (
    2, 'Supplier Foil', 'Address1 Supplier Foil', 'Address2 Supplier Foil', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  ),
  (
    3, 'Supplier Porous Plug Wrap Paper', 'Address1 Porous Plug Wrap Paper', 'Address2 Porous Plug Wrap Paper', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  ),
   (
    4, 'Supplier Cigarete paper', 'Address1 Cigarete paper', 'Address2 Cigarete paper', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  ),
    (
    5, 'Supplier CTP', 'Address1 CTP', 'Address2 CTP', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  ),
   (
    6, 'Supplier Inner frame', 'Address1 Inner frame', 'Address2 Inner frame', 
    NULL, 'Kudus', 'NOJ', 'aji', '0811111', 
    'superadmin', '2024-09-04 14:21:36', 
    NULL, NULL, 'Y', 'N'
  );
/*!40000 ALTER TABLE `m_wh_supplier` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_transaction_type
CREATE TABLE IF NOT EXISTS `m_wh_transaction_type` (
  `transaction_type` varchar(3) NOT NULL DEFAULT '',
  `transaction_name` varchar(50) DEFAULT '',
  `created_by` varchar(50) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_transaction_type: 2 rows
/*!40000 ALTER TABLE `m_wh_transaction_type` DISABLE KEYS */;
INSERT INTO `m_wh_transaction_type` (`transaction_type`, `transaction_name`, `created_by`, `created_on`) VALUES
	('CST', 'Change Stock Type', '', NULL),
	('PTP', 'Product to Product', '', NULL);
/*!40000 ALTER TABLE `m_wh_transaction_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_transporter
CREATE TABLE IF NOT EXISTS `m_wh_transporter` (
  `transporter_id` int(11) NOT NULL AUTO_INCREMENT,
  `transporter_name` varchar(100) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`transporter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_transporter: 4 rows
/*!40000 ALTER TABLE `m_wh_transporter` DISABLE KEYS */;
INSERT INTO `m_wh_transporter` (`transporter_id`, `transporter_name`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 'JNE', 'Y', 'rdarmawan', '2023-01-03 13:54:26'),
	(2, 'SICEPAT', 'Y', 'rdarmawan', '2023-01-03 13:54:37'),
	(3, 'RPX', 'Y', 'rdarmawan', '2023-01-03 13:54:46'),
	(4, 'TIKI', 'Y', 'atmi', '2023-03-09 16:49:54');
/*!40000 ALTER TABLE `m_wh_transporter` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_user_client_project
CREATE TABLE IF NOT EXISTS `m_wh_user_client_project` (
  `username` varchar(100) NOT NULL,
  `client_project_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`client_project_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_user_client_project: 10 rows
/*!40000 ALTER TABLE `m_wh_user_client_project` DISABLE KEYS */;
INSERT INTO `m_wh_user_client_project` (`username`, `client_project_id`) 
VALUES 
  ('admin', 1), 
  ('superadmin', 1), 
  ('superadmin', 2), 
  ('superadmin', 3), 
  ('superadmin', 4), 
  ('superadmin', 5), 
  ('superadmin', 6), 
  ('whsman01', 1), 
  ('whsman01', 2), 
  ('whs_spv', 1);
/*!40000 ALTER TABLE `m_wh_user_client_project` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_user_level
CREATE TABLE IF NOT EXISTS `m_wh_user_level` (
  `user_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_project` enum('N','Y') NOT NULL DEFAULT 'N',
  `user_level` char(10) DEFAULT NULL,
  `level_desc` char(20) DEFAULT NULL,
  `user_view` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `user_edit` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `user_delete` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `user_create` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_level_id`,`access_project`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='list user level';

-- Dumping data for table wms.m_wh_user_level: 5 rows
/*!40000 ALTER TABLE `m_wh_user_level` DISABLE KEYS */;
INSERT INTO `m_wh_user_level` (`user_level_id`, `access_project`, `user_level`, `level_desc`, `user_view`, `user_edit`, `user_delete`, `user_create`) VALUES
	(1, 'N', 'SPV', 'Supervisor', 1, 1, 0, 1),
	(2, 'N', 'Admin', 'Admin', 1, 1, 0, 1),
	(3, 'N', 'Staff', 'Staff', 1, 0, 0, 1),
	(4, 'N', 'Customer', 'Customer', 0, 0, 0, 0),
	(5, 'Y', 'SuperAdmin', 'Super Admin', 1, 1, 1, 1);
/*!40000 ALTER TABLE `m_wh_user_level` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_user_project
CREATE TABLE IF NOT EXISTS `m_wh_user_project` (
  `user_project_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`user_project_id`),
  KEY `username` (`username`),
  KEY `project_id` (`client_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_user_project: 0 rows
/*!40000 ALTER TABLE `m_wh_user_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_wh_user_project` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_vehicle
CREATE TABLE IF NOT EXISTS `m_wh_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_description` varchar(100) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`) USING BTREE,
  KEY `id` (`vehicle_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='vehicle that usually used to carry goods in/out from warehouse';

-- Dumping data for table wms.m_wh_vehicle: 7 rows
/*!40000 ALTER TABLE `m_wh_vehicle` DISABLE KEYS */;
INSERT INTO `m_wh_vehicle` (`vehicle_id`, `vehicle_type`, `vehicle_description`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 'CDD', 'hanya muat 50 kg', 'Y', 'rdarmawan', '2023-01-03 13:55:48'),
	(2, 'FUSO', 'mobil FUSO', 'Y', 'rdarmawan', '2023-01-03 13:55:51'),
	(3, 'WINGBOX', NULL, 'Y', 'rdarmawan', '2023-01-03 13:55:54'),
	(4, 'BIG MAMA 36', 'Mama Besar 36', 'Y', 'rdarmawan', '2023-01-03 13:55:57'),
	(5, 'BIG MAMA 48', NULL, 'Y', 'rdarmawan', '2023-01-03 13:55:59'),
	(6, 'BIG MAMA 52', NULL, 'Y', 'rdarmawan', '2023-01-03 13:56:02'),
	(7, 'CONTAINER 20 FT', NULL, 'Y', 'rdarmawan', '2023-01-03 13:56:04');
/*!40000 ALTER TABLE `m_wh_vehicle` ENABLE KEYS */;

-- Dumping structure for table wms.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wms.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table wms.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wms.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table wms.t_running_number
CREATE TABLE IF NOT EXISTS `t_running_number` (
  `process_code` char(11) NOT NULL DEFAULT '',
  `date` char(50) NOT NULL DEFAULT '',
  `wh_id` bigint(20) NOT NULL,
  `running_number` int(11) NOT NULL,
  PRIMARY KEY (`process_code`,`date`,`wh_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_running_number: 85 rows
/*!40000 ALTER TABLE `t_running_number` DISABLE KEYS */;
INSERT INTO `t_running_number` (`process_code`, `date`, `wh_id`, `running_number`) VALUES
	('IN', '2022-10', 1, 43),
	('IN', '2022-11', 1, 17),
	('IN', '2022-12', 1, 18),
	('OUT', '2022-10', 1, 12),
	('OUT', '2022-11', 1, 12),
	('OUT', '2022-12', 1, 26),
	('01', '2022-11', 1, 19),
	('01', '2022-12', 1, 15),
	('02', '2022-11', 1, 12),
	('02', '2022-12', 1, 12),
	('08', '2022-11', 1, 12),
	('08', '2022-12', 1, 12),
	('DCC', '2022-11', 1, 12),
	('DCC', '2022-12', 1, 12),
	('ADIN', '2022-11', 1, 12),
	('ADIN', '2022-12', 1, 12),
	('ADOUT', '2022-11', 1, 12),
	('ADOUT', '2022-12', 1, 12),
	('OPN', '2022-11', 1, 12),
	('OPN', '2022-12', 1, 12),
	('OUT', '2022-12', 2, 12),
	('STR', '2022-12', 1, 1),
	('STR', '2023-01', 1, 16),
	('IN', '2023-01', 1, 12),
	('ADIN', '2023-01', 1, 6),
	('ADOUT', '2023-01', 1, 5),
	('OUT', '2023-01', 1, 8),
	('09', '2023-01', 1, 5),
	('10', '2023-01', 1, 8),
	('01', '2023-01', 1, 7),
	('08', '2023-01', 1, 15),
	('DCC', '2023-01', 1, 7),
	('OPN', '2023-01', 1, 10),
	('OPN', '2023-02', 1, 5),
	('IN', '2023-02', 1, 15),
	('01', '2023-02', 1, 5),
	('08', '2023-02', 1, 8),
	('STR', '2023-02', 1, 2),
	('ADIN', '2023-02', 1, 2),
	('OUT', '2023-02', 1, 10),
	('DCC', '2023-02', 1, 4),
	('09', '2023-02', 1, 1),
	('IN', '2023-03', 1, 7),
	('OUT', '2023-03', 1, 5),
	('01', '2023-03', 1, 4),
	('08', '2023-03', 1, 4),
	('STR', '2023-03', 1, 3),
	('ADOUT', '2023-03', 1, 1),
	('10', '2023-03', 1, 1),
	('DCC', '2023-03', 1, 5),
	('02', '2023-03', 1, 1),
	('ADIN', '2023-03', 1, 1),
	('09', '2023-03', 1, 1),
	('``', '2023-03', 1, 0),
	('OPN', '2023-04', 1, 1),
	('IN', '2023-04', 1, 4),
	('03', '2023-04', 1, 1),
	('08', '2023-04', 1, 4),
	('DCC', '2023-04', 1, 1),
	('OUT', '2023-04', 1, 8),
	('01', '2023-04', 1, 4),
	('DCC', '2023-05', 1, 1),
	('08', '2023-05', 1, 6),
	('OUT', '2023-05', 1, 7),
	('IN', '2023-05', 1, 4),
	('01', '2023-05', 1, 2),
	('04', '2023-06', 1, 0),
	('IN', '2023-06', 1, 3),
	('RTN', '2023-06', 1, 9),
	('08', '2023-06', 1, 1),
	('DCC', '2023-06', 1, 2),
	('OUT', '2023-06', 1, 6),
	('OPN', '2023-06', 1, 1),
	('OPN', '2023-07', 1, 1),
	('IN', '2024-07', 1, 1),
	('IN', '2024-08', 1, 2),
	('01', '2024-08', 1, 4),
	('08', '2024-08', 1, 2),
	('IN', '2024-09', 1, 2),
	('01', '2024-09', 1, 2),
	('OUT', '2024-09', 1, 2),
	('RTN', '2024-09', 1, 2),
	('04', '2024-09', 1, 1),
	('08', '2024-09', 1, 1),
	('DCC', '2024-09', 1, 1);
/*!40000 ALTER TABLE `t_running_number` ENABLE KEYS */;

-- Dumping structure for table wms.t_running_number_copy
CREATE TABLE IF NOT EXISTS `t_running_number_copy` (
  `process_id` char(11) NOT NULL DEFAULT '',
  `wh_id` bigint(20) NOT NULL,
  `running_number` int(11) NOT NULL,
  `last_updated` date NOT NULL,
  PRIMARY KEY (`process_id`,`wh_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=FIXED;

-- Dumping data for table wms.t_running_number_copy: 2 rows
/*!40000 ALTER TABLE `t_running_number_copy` DISABLE KEYS */;
INSERT INTO `t_running_number_copy` (`process_id`, `wh_id`, `running_number`, `last_updated`) VALUES
	('IN', 1, 1, '2022-11-01'),
	('OUT', 1, 12, '2022-10-29');
/*!40000 ALTER TABLE `t_running_number_copy` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_activity
CREATE TABLE IF NOT EXISTS `t_wh_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `inbound_planning_no` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `movement_id` varchar(30) DEFAULT NULL,
  `stock_count_id` varchar(30) DEFAULT NULL,
  `count_no` varchar(50) DEFAULT NULL,
  `gr_id` varchar(30) DEFAULT NULL,
  `gr_return_id` varchar(30) DEFAULT NULL,
  `outbound_planning_no` varchar(50) DEFAULT NULL,
  `checker` varchar(30) DEFAULT NULL,
  `main_checker` varchar(30) DEFAULT NULL,
  `supervisor_id` varchar(50) DEFAULT '',
  `datetime_est_start` datetime DEFAULT NULL,
  `datetime_est_finish` datetime DEFAULT NULL,
  `datetime_start_counting` datetime DEFAULT NULL,
  `datetime_finish_counting` datetime DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `location_from` varchar(50) DEFAULT NULL,
  `location_to` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_delete` enum('Y','N') DEFAULT 'N',
  `user_created` varchar(30) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_id`) USING BTREE,
  KEY `checker` (`checker`) USING BTREE,
  KEY `gr_id` (`gr_id`) USING BTREE,
  KEY `inbound_planning_no` (`inbound_planning_no`) USING BTREE,
  KEY `process_id` (`process_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_activity: 8 rows
/*!40000 ALTER TABLE `t_wh_activity` DISABLE KEYS */;
INSERT INTO `t_wh_activity` (`activity_id`, `process_id`, `inbound_planning_no`, `reference_no`, `movement_id`, `stock_count_id`, `count_no`, `gr_id`, `gr_return_id`, `outbound_planning_no`, `checker`, `supervisor_id`, `datetime_est_start`, `datetime_est_finish`, `datetime_start_counting`, `datetime_finish_counting`, `sku`, `serial_no`, `location_from`, `location_to`, `is_active`, `is_delete`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 12, 'NG1-IN-0924-0001', 'po123123e', NULL, NULL, NULL, NULL, NULL, NULL, 'whsman01', '', '2024-09-04 14:50:00', '2024-09-04 16:50:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 14:50:17', '', NULL),
	(2, 12, 'NG1-IN-0924-0001', 'po123123e', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-09-04 14:50:00', '2024-09-04 14:50:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 14:50:48', '', NULL),
	(3, 12, 'NG1-IN-0924-0001', 'po123123e', NULL, NULL, NULL, NULL, NULL, NULL, 'ares', '', '2024-09-04 14:51:00', '2024-09-04 14:51:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 14:51:38', '', NULL),
	(4, 13, NULL, 'po123123e', NULL, NULL, NULL, 'NG1-GR-0924-0001', NULL, NULL, 'ares', '', '2024-09-04 14:59:00', '2024-09-04 14:59:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 14:59:40', '', NULL),
	(5, 13, NULL, '123', NULL, NULL, NULL, NULL, 'NG1-GRR-0924-0002', NULL, 'ares', '', '2024-09-04 15:26:00', '2024-09-04 15:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 15:26:40', '', NULL),
	(6, 8, NULL, NULL, 'NG1-08-0924-0001', NULL, NULL, NULL, NULL, NULL, 'ares', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'ares', '2024-09-04 15:48:38', '', NULL),
	(7, 12, 'NG1-IN-0924-0002', 'er13', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-09-25 09:16:00', '2024-09-25 10:16:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-09-25 09:16:29', '', NULL),
	(8, 13, NULL, 'er13', NULL, NULL, NULL, 'NG1-GR-0924-0002', NULL, NULL, 'whsman01', '', '2024-09-25 09:57:00', '2024-09-25 09:57:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-09-25 09:57:48', '', NULL);
/*!40000 ALTER TABLE `t_wh_activity` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_activity_2
CREATE TABLE IF NOT EXISTS `t_wh_activity_2` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` char(11) DEFAULT NULL,
  `client_project_id` int(11) DEFAULT NULL,
  `inbound_planning_no` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `gr_id` varchar(30) DEFAULT NULL,
  `outbound_planning_no` varchar(50) DEFAULT NULL,
  `checker` varchar(30) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `datetime_est_start` datetime DEFAULT NULL,
  `datetime_est_finish` datetime DEFAULT NULL,
  `location_from` varchar(50) DEFAULT NULL,
  `location_to` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_delete` enum('Y','N') DEFAULT NULL,
  `user_created` varchar(30) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `process_id` (`process_id`),
  KEY `client_project_id` (`client_project_id`),
  KEY `checker` (`checker`),
  KEY `gr_id` (`gr_id`),
  KEY `inbound_planning_no` (`inbound_planning_no`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_activity_2: 10 rows
/*!40000 ALTER TABLE `t_wh_activity_2` DISABLE KEYS */;
INSERT INTO `t_wh_activity_2` (`activity_id`, `process_id`, `client_project_id`, `inbound_planning_no`, `reference_no`, `gr_id`, `outbound_planning_no`, `checker`, `qty`, `datetime_est_start`, `datetime_est_finish`, `location_from`, `location_to`, `is_active`, `is_delete`, `user_created`, `datetime_created`) VALUES
	(1, 'IN', 1, 'CBT0107220002', 'PO/092022/Jak-02', NULL, NULL, 'hari', 10, '2022-10-05 09:02:00', '2022-10-05 10:02:00', NULL, NULL, 'Y', NULL, 'atmi', '2022-10-05 09:11:28'),
	(2, 'IN', 1, 'CBT-IN-1022-0036', 'test_10okt2022_2', NULL, NULL, 'test_admin', 10, '2022-10-10 14:33:00', '2022-10-11 14:33:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-10 14:33:43'),
	(3, 'IN', 1, 'CBT-IN-1022-0036', 'test_10okt2022_2', NULL, NULL, 'test_staff', 15, '2022-10-11 14:33:00', '2022-10-12 14:33:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-10 14:34:03'),
	(4, 'IN', 1, 'CBT-IN-1022-0037', 'test_atmi_1110', NULL, NULL, 'test_admin', 5, '2022-10-11 11:55:00', '2022-10-11 12:55:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-11 13:55:37'),
	(5, 'IN', 1, 'CBT-IN-1022-0038', 'test_11okt2022_1', NULL, NULL, 'test_admin', 60, '2022-10-11 16:54:00', '2022-10-12 16:54:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-11 16:59:44'),
	(6, 'IN', 1, 'CBT-IN-1022-0041', NULL, NULL, NULL, 'test_admin', NULL, '2022-10-01 09:12:00', '2022-10-27 09:12:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-26 09:13:44'),
	(7, 'IN', 1, 'CBT-IN-1022-0041', NULL, NULL, NULL, 'test_staff', NULL, '2022-10-26 09:13:00', '2022-10-27 09:13:00', NULL, NULL, 'N', NULL, 'mariofrans', '2022-10-26 09:13:44'),
	(8, 'IN', 1, 'CBT-IN-1022-0042', 'test_26okt22_2', NULL, NULL, 'test_staff', NULL, '2022-10-27 10:12:00', '2022-10-28 10:12:00', NULL, NULL, 'Y', NULL, 'test_staff', '2022-10-26 10:12:50'),
	(9, 'IN', 1, 'CBT-IN-1022-0043', 'test_281022', NULL, NULL, 'test_admin', NULL, '2022-10-28 15:15:00', '2022-10-28 16:16:00', NULL, NULL, 'Y', NULL, 'mariofrans', '2022-10-28 15:10:54'),
	(11, 'IN', 1, 'CBT-IN-1122-0013', 'test_01nov2022_1', NULL, NULL, 'test_staff', NULL, '2022-11-02 10:57:00', '2022-11-05 22:57:00', NULL, NULL, 'Y', NULL, 'mariofrans', '2022-11-01 10:57:47');
/*!40000 ALTER TABLE `t_wh_activity_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_adjustment
CREATE TABLE IF NOT EXISTS `t_wh_adjustment` (
  `adjustment_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) DEFAULT 0,
  `wh_id` int(11) DEFAULT 0,
  `adjustment_code` varchar(5) DEFAULT '',
  `reason` varchar(250) DEFAULT '',
  `status_id` varchar(3) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`adjustment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_adjustment: 14 rows
/*!40000 ALTER TABLE `t_wh_adjustment` DISABLE KEYS */;
INSERT INTO `t_wh_adjustment` (`adjustment_id`, `client_project_id`, `wh_id`, `adjustment_code`, `reason`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-ADIN-1122-0001', 1, 1, 'ADIN', 'Permintaan SPV', 'OIN', 'atmi', '2022-11-22 16:58:38', '', NULL),
	('CBT-ADOUT-1122-0001', 1, 1, 'ADOUT', 'Salah Hitung', 'OOT', 'atmi', '2022-11-22 16:58:46', '', NULL),
	('CBT-ADOUT-1122-0002', 1, 1, 'ADOUT', 'Request Supervisor', 'CAI', 'atmi', '2022-11-24 09:36:31', 'atmi', '2022-11-24 15:33:42'),
	('CBT-ADOUT-0123-0002', 1, 1, 'ADOUT', 'test06jan23_1', 'CAO', 'mariofrans', '2023-01-06 11:07:12', 'mariofrans', '2023-01-06 14:08:17'),
	('CBT-ADIN-0123-0002', 1, 1, 'ADIN', 'test06jan23_2', 'CAI', 'mariofrans', '2023-01-06 13:14:08', 'mariofrans', '2023-01-06 14:08:21'),
	('CBT-ADIN-0123-0003', 1, 1, 'ADIN', 'barang kelebihan kirim', 'CAI', 'mariofrans', '2023-01-06 15:09:49', 'mariofrans', '2023-01-06 15:23:22'),
	('CBT-ADOUT-0123-0003', 1, 1, 'ADOUT', 'barang kelebihan input', 'CAO', 'mariofrans', '2023-01-06 15:12:08', 'mariofrans', '2023-01-06 15:22:40'),
	('CBT-ADOUT-0123-0004', 1, 1, 'ADOUT', 'test06jan23_4', 'OOT', 'mariofrans', '2023-01-06 15:19:50', '', NULL),
	('CBT-ADIN-0123-0006', 1, 1, 'ADIN', 'test06jan23_3', 'OIN', 'mariofrans', '2023-01-06 15:19:30', '', NULL),
	('CBT-ADOUT-0123-0005', 1, 1, 'ADOUT', 'test adjustment_1501', 'CAO', 'atmi', '2023-01-15 17:39:19', 'atmi', '2023-01-15 17:39:40'),
	('CBT-ADIN-0223-0001', 1, 1, 'ADIN', 'abis dipake nonton bola', 'OIN', 'atmi', '2023-02-03 11:26:09', '', NULL),
	('CBT-ADIN-0223-0002', 1, 1, 'ADIN', 'Misscounting', 'CAI', 'atmi', '2023-02-09 14:28:22', 'atmi', '2023-02-09 14:28:36'),
	('CBT-ADOUT-0323-0001', 1, 1, 'ADOUT', 'MISS GR (EXCESS)', 'CAO', 'atmi', '2023-03-20 17:00:05', 'atmi', '2023-03-20 17:01:44'),
	('CBT-ADIN-0323-0001', 1, 1, 'ADIN', 'test_adin_2803', 'CAI', 'superadmin', '2023-03-28 09:12:39', 'superadmin', '2023-03-28 09:12:51');
/*!40000 ALTER TABLE `t_wh_adjustment` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_adjustment_detail
CREATE TABLE IF NOT EXISTS `t_wh_adjustment_detail` (
  `adjustment_id` varchar(30) NOT NULL DEFAULT '',
  `location_code` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(200) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `adjustment_qty` int(11) DEFAULT 0,
  `final_qty` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT '',
  `gr_id` varchar(50) NOT NULL DEFAULT '',
  `movement_id` varchar(50) NOT NULL DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`adjustment_id`,`sku`,`location_code`,`stock_id`,`gr_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_adjustment_detail: 18 rows
/*!40000 ALTER TABLE `t_wh_adjustment_detail` DISABLE KEYS */;
INSERT INTO `t_wh_adjustment_detail` (`adjustment_id`, `location_code`, `sku`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `stock_id`, `adjustment_qty`, `final_qty`, `uom_name`, `gr_id`, `movement_id`, `user_created`, `datetime_created`) VALUES
	('CBT-ADOUT-1122-0002', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 2, 48, 'PIECES', '', '', 'atmi', '2022-11-24 11:10:08'),
	('CBT-ADOUT-1122-0002', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 2, 18, 'PIECES', '', '', 'atmi', '2022-11-24 11:12:15'),
	('CBT-ADOUT-1122-0002', '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 2, 23, 'PIECES', '', '', 'atmi', '2022-11-24 11:13:16'),
	('CBT-ADOUT-0123-0002', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 5, 25, 'PIECES', 'CBT-GR-1222-0016', '', 'mariofrans', '2023-01-06 11:07:12'),
	('CBT-ADOUT-0123-0002', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 5, 30, 'PIECES', 'CBT-GR-1222-0014', '', 'mariofrans', '2023-01-06 11:07:12'),
	('CBT-ADIN-0123-0002', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 5, 30, 'PIECES', 'CBT-GR-1222-0016', '', 'mariofrans', '2023-01-06 13:14:08'),
	('CBT-ADIN-0123-0002', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 5, 35, 'PIECES', 'CBT-GR-1222-0014', '', 'mariofrans', '2023-01-06 13:14:08'),
	('CBT-ADIN-0123-0003', 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 5, 12, 'PIECES', 'CBT-GR-1222-0016', '', 'mariofrans', '2023-01-06 15:09:49'),
	('CBT-ADIN-0123-0003', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 2, 17, 'PIECES', 'CBT-GR-1222-0015', '', 'mariofrans', '2023-01-06 15:09:49'),
	('CBT-ADOUT-0123-0003', 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 3, 7, 'PIECES', 'CBT-GR-1222-0016', '', 'mariofrans', '2023-01-06 15:12:08'),
	('CBT-ADIN-0123-0006', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 5, 0, 'PIECES', 'CBT-GR-1122-0017', '', 'mariofrans', '2023-01-06 15:19:30'),
	('CBT-ADOUT-0123-0004', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 4, 0, 'PIECES', '', '', 'mariofrans', '2023-01-06 15:19:50'),
	('CBT-ADOUT-0123-0005', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 10, 10, 'PIECES', 'CBT-GR-0123-0007', '', 'atmi', '2023-01-15 17:39:19'),
	('CBT-ADIN-0223-0001', 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'AV', -5, 0, 'PIECES', 'CBT-GR-0223-0002', '', 'atmi', '2023-02-03 11:26:09'),
	('CBT-ADIN-0223-0001', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 5, 0, '', 'CBT-GR-1222-0015', '', 'atmi', '2023-02-03 11:26:09'),
	('CBT-ADIN-0223-0002', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 10, 40, 'PIECES', 'CBT-GR-1222-0016', 'CBT-09-0223-0001', 'atmi', '2023-02-09 14:28:22'),
	('CBT-ADOUT-0323-0001', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 5, 30, 'PIECES', 'CBT-GR-1222-0014', 'CBT-10-0323-0001', 'atmi', '2023-03-20 17:00:05'),
	('CBT-ADIN-0323-0001', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 2, 15, 'PIECES', 'CBT-GR-0323-0004', 'CBT-09-0323-0001', 'superadmin', '2023-03-28 09:12:39');
/*!40000 ALTER TABLE `t_wh_adjustment_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking
CREATE TABLE IF NOT EXISTS `t_wh_checking` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `bucket_id` varchar(50) NOT NULL DEFAULT '',
  `carton_id` varchar(50) NOT NULL DEFAULT '',
  `status_id` varchar(3) NOT NULL DEFAULT '',
  `checker` varchar(50) DEFAULT NULL,
  `cancel_reason` varchar(250) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_checking: 0 rows
/*!40000 ALTER TABLE `t_wh_checking` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_checking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_attachment
CREATE TABLE IF NOT EXISTS `t_wh_checking_attachment` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`order_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_checking_attachment: 0 rows
/*!40000 ALTER TABLE `t_wh_checking_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_checking_attachment` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_detail
CREATE TABLE IF NOT EXISTS `t_wh_checking_detail` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `gr_id` varchar(30) NOT NULL,
  `location_id` varchar(50) NOT NULL DEFAULT '',
  `stock_id` varchar(10) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`sku`,`location_id`,`gr_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_checking_detail: 0 rows
/*!40000 ALTER TABLE `t_wh_checking_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_checking_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_transport_loading
CREATE TABLE IF NOT EXISTS `t_wh_checking_transport_loading` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `supervisor_id` varchar(50) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `transporter_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `start_loading` datetime DEFAULT NULL,
  `finish_loading` datetime DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `vehicle_no` varchar(15) DEFAULT NULL,
  `container_no` varchar(25) DEFAULT NULL,
  `seal_no` varchar(25) DEFAULT NULL,
  `consignee_name` varchar(50) DEFAULT NULL,
  `consignee_address` varchar(250) DEFAULT NULL,
  `consignee_city` varchar(50) DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `awb` varchar(50) DEFAULT NULL,
  `image_awb` text DEFAULT NULL,
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_checking_transport_loading: 2 rows
/*!40000 ALTER TABLE `t_wh_checking_transport_loading` DISABLE KEYS */;
INSERT INTO `t_wh_checking_transport_loading` (`outbound_planning_no`, `supervisor_id`, `vehicle_id`, `transporter_id`, `service_id`, `start_loading`, `finish_loading`, `driver`, `vehicle_no`, `container_no`, `seal_no`, `consignee_name`, `consignee_address`, `consignee_city`, `remark`, `phone_no`, `awb`, `image_awb`, `user_created`, `datetime_created`) VALUES
	('NG1-OUT-0924-0002', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'te', 'te', 'te', NULL, '123213', NULL, NULL, 'superadmin', '2024-09-24 08:15:23'),
	('NG1-OUT-0924-0001', 'sugeng', 1, 1, 2, '2024-09-04 15:12:00', '2024-09-04 17:12:00', 'asd', 'b123asd', '1', '1', 'asd', 'asd', 'asd', 'tedt', '123123', NULL, NULL, 'ares', '2024-09-04 15:12:28');
/*!40000 ALTER TABLE `t_wh_checking_transport_loading` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_count_qty
CREATE TABLE IF NOT EXISTS `t_wh_count_qty` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT 0,
  `location_id` varchar(50) DEFAULT '',
  `sku` varchar(20) DEFAULT '',
  `item_name` varchar(200) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `qty_count` float DEFAULT NULL,
  `discrepancy` int(11) DEFAULT 0,
  `percentage` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT '',
  `stock_id` varchar(10) DEFAULT '',
  `gr_id` varchar(50) DEFAULT '',
  `count_status` varchar(20) DEFAULT '',
  `counter` varchar(50) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`count_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_count_qty: 0 rows
/*!40000 ALTER TABLE `t_wh_count_qty` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_count_qty` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_detail
CREATE TABLE IF NOT EXISTS `t_wh_inbound_detail` (
  `inbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `SKU` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(250) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discrepancy` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `spv_id` varchar(50) DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`inbound_planning_no`,`SKU`,`stock_id`) USING BTREE,
  KEY `SKU` (`SKU`) USING BTREE,
  KEY `expired_date` (`expired_date`) USING BTREE,
  KEY `clasification_id` (`clasification_id`) USING BTREE,
  KEY `serial_no` (`serial_no`) USING BTREE,
  KEY `inbound_planning_id` (`inbound_planning_no`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_inbound_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_inbound_detail` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_detail` (`inbound_planning_no`, `SKU`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty`, `discrepancy`, `uom_name`, `clasification_id`, `stock_id`, `spv_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-IN-0924-0001', 'CG001', 'Cengkeh', '', '123', '', '', '', '', '2027-01-01 00:00:00', 1, 0, 'BARREL', 1, 'AV', 'ares', NULL, NULL, 'ares', '2024-09-04 14:54:51'),
	('NG1-IN-0924-0002', 'sku001', 'Cigatow - Supplier1', '', '', '', '', '', '', '2025-12-31 00:00:00', 2, 0, 'PALLET', 2, 'AV', 'superadmin', NULL, NULL, 'superadmin', '2024-09-25 09:54:35');
/*!40000 ALTER TABLE `t_wh_inbound_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_detail_copy
CREATE TABLE IF NOT EXISTS `t_wh_inbound_detail_copy` (
  `inbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `pallet_id` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(250) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `discrepancy` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT '',
  `clasification_id` int(11) DEFAULT 0,
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `spv_id` varchar(50) DEFAULT '',
  `user_created` varchar(20) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`inbound_planning_no`,`sku`,`stock_id`) USING BTREE,
  KEY `clasification_id` (`clasification_id`) USING BTREE,
  KEY `SKU` (`sku`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_inbound_detail_copy: 8 rows
/*!40000 ALTER TABLE `t_wh_inbound_detail_copy` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_detail_copy` (`inbound_planning_no`, `pallet_id`, `sku`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty`, `discrepancy`, `uom_name`, `clasification_id`, `stock_id`, `spv_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT0107220002', '', '47RW1EJ', 'TV Toshiba 47RW1EJ', '123123', '20220101', '1568887-1215', '01', 'BLACK', '47"', '0000-00-00 00:00:00', 10, 0, 'PIECES', 1, '', NULL, 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-14 15:17:54'),
	('CBT0107220002', '', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '125536', '20', 'BLACK', '32"', NULL, 12, 0, 'PIECES', NULL, '', NULL, NULL, NULL, NULL, NULL),
	('CBT-IN-1022-0044', '', '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', '', '', '', '', NULL, 20, 0, 'PIECES', 1, '', 'sugeng', 'atmi', '2022-11-06 16:07:24', 'atmi', '2022-11-06 16:51:37'),
	('CBT-IN-1122-0015', '', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 17:26:09'),
	('CBT-IN-1122-0015', '', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 17:26:09'),
	('CBT-IN-1122-0014', 'RPX010203', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 5, 5, 'PIECES', 1, 'AV', 'test_admin', 'test_admin', '2022-11-10 11:42:53', '', NULL),
	('CBT-IN-1122-0014', 'RPX010204', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 3, 7, 'PIECES', 1, 'AV', 'test_admin', 'test_admin', '2022-11-10 11:43:44', '', NULL),
	('CBT-IN-1122-0014', 'RPX010205', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 2, 0, 'PIECES', 1, 'DMG', 'test_admin', 'test_admin', '2022-11-10 11:44:00', '', NULL);
/*!40000 ALTER TABLE `t_wh_inbound_detail_copy` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning
CREATE TABLE IF NOT EXISTS `t_wh_inbound_planning` (
  `inbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `wh_id` bigint(20) unsigned DEFAULT NULL,
  `client_project_id` int(10) unsigned NOT NULL DEFAULT 0,
  `supplier_id` int(10) unsigned DEFAULT NULL,
  `status_id` varchar(3) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT '',
  `plan_delivery` datetime DEFAULT NULL,
  `order_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_german2_ci DEFAULT NULL,
  `task_type` enum('Single Receive','Partial Receive') DEFAULT 'Single Receive',
  `remarks` varchar(500) DEFAULT '',
  `data_upload1` varchar(500) DEFAULT '',
  `data_upload2` varchar(500) DEFAULT '',
  `data_upload3` varchar(500) DEFAULT '',
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`inbound_planning_no`),
  KEY `status` (`status_id`) USING BTREE,
  KEY `reference_no` (`reference_no`) USING BTREE,
  KEY `supplier_id` (`supplier_id`) USING BTREE,
  KEY `plan_delivery` (`plan_delivery`) USING BTREE,
  KEY `wh_id` (`wh_id`) USING BTREE,
  KEY `user_project_id` (`client_project_id`) USING BTREE,
  KEY `inbound_planning_no` (`inbound_planning_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_inbound_planning: 5 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning` (`inbound_planning_no`, `wh_id`, `client_project_id`, `supplier_id`, `status_id`, `reference_no`, `receipt_no`, `plan_delivery`, `order_id`, `task_type`, `remarks`, `data_upload1`, `data_upload2`, `data_upload3`, `is_active`, `is_deleted`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-IN-0924-0001', 1, 1, 5, 'FIN', 'po123123e', 'qwe123', '2024-09-04 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'ares', '2024-09-04 14:46:17', 'ares', '2024-09-04 14:56:57'),
	('NG1-IN-0924-0002', 1, 1, 5, 'FIN', 'er13', '12312', '2024-09-25 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-09-25 09:13:04', 'superadmin', '2024-09-25 09:57:10'),
	('CBT-IN-0724-0001', 1, 1, 3, 'FIN', 'PO123456', '123456', '2024-07-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-07-15 17:00:23', 'superadmin', '2024-07-15 17:02:43'),
	('CBT-IN-0824-0001', 1, 1, 1, 'FIN', 'PO123', 'RN123', '2024-08-26 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-08-26 09:08:06', 'superadmin', '2024-08-26 13:44:37'),
	('CBT-IN-0824-0002', 1, 1, 4, 'FIN', 'PO240808001', 'RN240808001', '2024-08-28 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-08-28 11:30:27', 'superadmin', '2024-08-28 11:41:56');
/*!40000 ALTER TABLE `t_wh_inbound_planning` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_2
CREATE TABLE IF NOT EXISTS `t_wh_inbound_planning_2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inbound_planning_no` varchar(50) DEFAULT NULL,
  `wh_id` bigint(20) unsigned DEFAULT NULL,
  `client_project_id` int(10) unsigned NOT NULL DEFAULT 0,
  `supplier_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `plan_delivery` datetime DEFAULT NULL,
  `order_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_german2_ci DEFAULT NULL,
  `task_type` enum('Single Receive','Multi Receive') DEFAULT 'Single Receive',
  `remarks` varchar(500) DEFAULT NULL,
  `data_upload1` varchar(500) DEFAULT NULL,
  `data_upload2` varchar(500) DEFAULT NULL,
  `data_upload3` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `status` (`status_id`),
  KEY `reference_no` (`reference_no`),
  KEY `supplier_id` (`supplier_id`),
  KEY `plan_delivery` (`plan_delivery`),
  KEY `wh_id` (`wh_id`),
  KEY `user_project_id` (`client_project_id`) USING BTREE,
  KEY `inbound_planning_no` (`inbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_inbound_planning_2: 0 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_inbound_planning_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_detail
CREATE TABLE IF NOT EXISTS `t_wh_inbound_planning_detail` (
  `inbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `SKU` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(250) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`inbound_planning_no`,`SKU`) USING BTREE,
  KEY `SKU` (`SKU`) USING BTREE,
  KEY `expired_date` (`expired_date`) USING BTREE,
  KEY `clasification_id` (`clasification_id`) USING BTREE,
  KEY `serial_no` (`serial_no`) USING BTREE,
  KEY `inbound_planning_id` (`inbound_planning_no`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_inbound_planning_detail: 5 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning_detail` (`inbound_planning_no`, `SKU`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty`, `uom_name`, `stock_id`, `clasification_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-IN-0924-0001', 'CG001', 'Cengkeh', '', '123', '', '', '', '', '2027-01-01 00:00:00', 1, 'BARREL', NULL, 1, 'ares', '2024-09-04 14:46:17', NULL, NULL),
	('NG1-IN-0924-0002', 'sku001', 'Cigatow - Supplier1', '', '', '', '', '', '', '2025-12-31 00:00:00', 2, 'PALLET', NULL, 2, 'superadmin', '2024-09-25 09:13:04', NULL, NULL),
	('CBT-IN-0724-0001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 'UNIT', NULL, 1, 'superadmin', '2024-07-15 17:00:23', NULL, NULL),
	('CBT-IN-0824-0001', 'CG001', 'Cengkeh', '', '', '', '', '', '', NULL, 400, 'KG', NULL, 1, 'superadmin', '2024-08-26 09:08:06', NULL, NULL),
	('CBT-IN-0824-0002', 'CG001', 'Cengkeh', '', '', '', '', '', '', '2026-12-28 00:00:00', 40, 'Bag', NULL, 2, 'superadmin', '2024-08-28 11:30:27', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_detail_2
CREATE TABLE IF NOT EXISTS `t_wh_inbound_planning_detail_2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inbound_id` bigint(20) DEFAULT NULL,
  `SKU` varchar(50) DEFAULT NULL,
  `item_name` varchar(250) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `qty_plan` int(11) DEFAULT NULL,
  `qty_receive` int(11) DEFAULT NULL,
  `discrepancy` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `pallet_id` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SKU` (`SKU`),
  KEY `expired_date` (`expired_date`),
  KEY `clasification_id` (`clasification_id`),
  KEY `inbound_planning_id` (`inbound_id`) USING BTREE,
  KEY `pallet_id` (`pallet_id`),
  KEY `serial_no` (`serial_no`),
  KEY `uom_id` (`uom_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_inbound_planning_detail_2: 0 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_location_inventory
CREATE TABLE IF NOT EXISTS `t_wh_location_inventory` (
  `location_id` varchar(50) NOT NULL DEFAULT '0',
  `location_type` varchar(50) NOT NULL DEFAULT '',
  `client_project_id` int(11) NOT NULL DEFAULT 0,
  `pallet_id` varchar(50) DEFAULT NULL,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `part_name` varchar(250) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `on_hand_qty` int(11) DEFAULT 0,
  `allocated_qty` int(11) DEFAULT 0,
  `picked_qty` int(11) DEFAULT 0,
  `available_qty` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `gr_id` varchar(30) NOT NULL DEFAULT '',
  `gr_datetime` datetime DEFAULT NULL,
  `last_movement_id` varchar(30) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(30) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`location_id`,`stock_id`,`sku`,`gr_id`) USING BTREE,
  KEY `last_movement_id` (`last_movement_id`),
  KEY `client_project_id` (`client_project_id`),
  KEY `item_classification_id` (`clasification_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_location_inventory: 5 rows
/*!40000 ALTER TABLE `t_wh_location_inventory` DISABLE KEYS */;
INSERT INTO `t_wh_location_inventory` (`location_id`, `location_type`, `client_project_id`, `pallet_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `clasification_id`, `on_hand_qty`, `allocated_qty`, `picked_qty`, `available_qty`, `uom_name`, `stock_id`, `gr_id`, `gr_datetime`, `last_movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('test_location_1', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 1, 5, 17, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0824-0001', 'atmi', '2023-02-03 10:29:14', 'superadmin', '2024-08-28 15:50:44', 'Y'),
	('R1F3', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', NULL, '', '', '', '', NULL, 1, -18, 12, 0, 10, 'PIECES', 'DMG', '', NULL, 'CBT-08-0824-0002', NULL, NULL, 'superadmin', '2024-08-28 15:52:26', 'Y'),
	('1A1-001-001', 'Bulk', 1, '', 'sku001', 'Cigatow - Supplier1', '', '', '', '', '', '', '2025-12-31', 2, 2, 0, 0, 2, 'PALLET', 'AV', 'NG1-GR-0924-0002', '2024-09-25 10:06:07', 'NG1-01-0924-0002', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, '', 'sku001', 'Cigatow - Supplier1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-30', 4, 1, 0, 0, 1, 'PACK', 'DMGR', 'NG1-GRR-0924-0002', '2024-09-04 15:28:55', 'NG1-04-0924-0001', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, '', 'CG001', 'Cengkeh', '', '123', '', '', '', '', '2027-01-01', 1, 1, 0, 0, 1, 'BARREL', 'AV', 'NG1-GR-0924-0001', '2024-09-04 15:02:40', 'NG1-08-0924-0001', NULL, NULL, 'ares', '2024-09-04 15:48:57', 'Y');
/*!40000 ALTER TABLE `t_wh_location_inventory` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_log_api
CREATE TABLE IF NOT EXISTS `t_wh_log_api` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `method` varchar(50) DEFAULT '-',
  `last_access` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(50) DEFAULT NULL,
  `data` varchar(4000) DEFAULT NULL,
  `respon` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='API Inbound';

-- Dumping data for table wms.t_wh_log_api: 0 rows
/*!40000 ALTER TABLE `t_wh_log_api` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_log_api` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_moved_movement
CREATE TABLE IF NOT EXISTS `t_wh_moved_movement` (
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `process_id` int(11) DEFAULT NULL,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `part_name` varchar(200) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) NOT NULL DEFAULT '',
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(50) DEFAULT NULL,
  `location_from` varchar(50) NOT NULL DEFAULT 'STAGING AREA',
  `location_type_from` varchar(50) DEFAULT NULL,
  `location_to` varchar(50) NOT NULL DEFAULT '',
  `location_type_to` varchar(50) DEFAULT 'STAGING AREA',
  `warehouseman` varchar(50) DEFAULT '',
  `is_submit` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`movement_id`,`location_to`,`sku`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_moved_movement: 0 rows
/*!40000 ALTER TABLE `t_wh_moved_movement` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_moved_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_movement
CREATE TABLE IF NOT EXISTS `t_wh_movement` (
  `movement_id` varchar(50) NOT NULL DEFAULT '',
  `wh_id` int(11) NOT NULL DEFAULT 0,
  `client_project_id` int(11) NOT NULL DEFAULT 0,
  `movement_date` date DEFAULT NULL,
  `status_id` varchar(3) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`movement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_movement: 1 rows
/*!40000 ALTER TABLE `t_wh_movement` DISABLE KEYS */;
INSERT INTO `t_wh_movement` (`movement_id`, `wh_id`, `client_project_id`, `movement_date`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-08-0924-0001', 1, 1, '2024-09-04', 'COM', 'ares', '2024-09-04 15:42:43', 'ares', '2024-09-04 15:48:57');
/*!40000 ALTER TABLE `t_wh_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_movement_detail
CREATE TABLE IF NOT EXISTS `t_wh_movement_detail` (
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `process_id` char(11) DEFAULT NULL,
  `sku` varchar(20) NOT NULL DEFAULT '',
  `part_name` varchar(200) DEFAULT NULL,
  `pallet_id` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) NOT NULL DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `location_type_from` varchar(50) DEFAULT NULL,
  `location_from` varchar(50) NOT NULL DEFAULT 'STAGING AREA',
  `pallet_id_to` varchar(50) DEFAULT '',
  `location_type_to` varchar(50) DEFAULT '',
  `location_to` varchar(50) NOT NULL DEFAULT '',
  `qty` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `status_id` varchar(3) DEFAULT '',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`movement_id`,`sku`,`location_to`) USING BTREE,
  KEY `pallet_id` (`pallet_id`) USING BTREE,
  KEY `stock_id` (`stock_id`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE,
  KEY `sku` (`sku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_movement_detail: 3 rows
/*!40000 ALTER TABLE `t_wh_movement_detail` DISABLE KEYS */;
INSERT INTO `t_wh_movement_detail` (`movement_id`, `process_id`, `sku`, `part_name`, `pallet_id`, `serial_no`, `batch_no`, `expired_date`, `location_type_from`, `location_from`, `pallet_id_to`, `location_type_to`, `location_to`, `qty`, `uom_name`, `stock_id`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('NG1-01-0924-0001', '1', 'CG001', 'Cengkeh', NULL, '', '', '2027-01-01', 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 1, 'BARREL', 'AV', '', 'ares', '2024-09-04 15:02:40', NULL, NULL, 'Y'),
	('NG1-04-0924-0001', '4', 'sku001', 'Cigatow - Supplier1', NULL, '', '', '2024-09-30', 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 1, 'PACK', 'DMGR', '', 'ares', '2024-09-04 15:28:55', NULL, NULL, 'Y'),
	('NG1-01-0924-0002', '1', 'sku001', 'Cigatow - Supplier1', NULL, '', '', '2025-12-31', 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 2, 'PALLET', 'AV', '', 'superadmin', '2024-09-25 10:06:07', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_movement_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_attachment
CREATE TABLE IF NOT EXISTS `t_wh_outbound_attachment` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_attachment: 0 rows
/*!40000 ALTER TABLE `t_wh_outbound_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_outbound_attachment` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_detail_sku
CREATE TABLE IF NOT EXISTS `t_wh_outbound_detail_sku` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `batch_no` varchar(50) NOT NULL,
  `gr_id` varchar(50) DEFAULT NULL,
  `available_qty` int(11) DEFAULT NULL,
  `allocated_qty` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`sku`,`batch_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_detail_sku: 1 rows
/*!40000 ALTER TABLE `t_wh_outbound_detail_sku` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_detail_sku` (`outbound_planning_no`, `sku`, `batch_no`, `gr_id`, `available_qty`, `allocated_qty`, `expired_date`, `user_created`, `datetime_created`) VALUES
	('NG1-OUT-0924-0001', 'CG001', '', 'NG1-GR-0924-0001', 1, 1, '2027-01-01', 'ares', '2024-09-04 15:12:28');
/*!40000 ALTER TABLE `t_wh_outbound_detail_sku` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_package
CREATE TABLE IF NOT EXISTS `t_wh_outbound_package` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `desc_of_goods` varchar(250) DEFAULT '',
  `tot_package` int(11) DEFAULT 0,
  `actual_weight` int(11) DEFAULT 0,
  `widhtx` int(11) DEFAULT 0,
  `lengthx` int(11) DEFAULT 0,
  `heightx` int(11) DEFAULT 0,
  `tot_dimensi` int(11) DEFAULT 0,
  `tot_weight` int(11) DEFAULT 0,
  `tot_declare_value` int(11) DEFAULT 0,
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_package: 0 rows
/*!40000 ALTER TABLE `t_wh_outbound_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_outbound_package` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning
CREATE TABLE IF NOT EXISTS `t_wh_outbound_planning` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `wh_id` bigint(20) DEFAULT NULL,
  `client_project_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `status_id` varchar(3) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `plan_delivery` date DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `cancel_reason` varchar(100) DEFAULT NULL,
  `user_created` varchar(30) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(30) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_planning: 2 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_planning` (`outbound_planning_no`, `wh_id`, `client_project_id`, `supplier_id`, `order_id`, `status_id`, `reference_no`, `receipt_no`, `plan_delivery`, `notes`, `cancel_reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-OUT-0924-0001', 1, 1, 5, '1', 'ALO', 'asdasd', '12d', '2024-09-04', NULL, NULL, 'ares', '2024-09-04 15:12:28', 'ares', '2024-09-04 15:12:40'),
	('NG1-OUT-0924-0002', 1, 1, 5, '1', 'ALO', '11232', '123', '2024-09-24', NULL, NULL, 'superadmin', '2024-09-24 08:15:23', 'superadmin', '2024-09-24 08:15:30');
/*!40000 ALTER TABLE `t_wh_outbound_planning` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning_detail
CREATE TABLE IF NOT EXISTS `t_wh_outbound_planning_detail` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `clasification_id` int(11) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`sku`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_planning_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning_detail` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_planning_detail` (`outbound_planning_no`, `sku`, `qty`, `uom_name`, `clasification_id`, `serial_no`, `user_created`, `datetime_created`) VALUES
	('NG1-OUT-0924-0001', 'CG001', 1, 'PACK', 4, '', 'ares', '2024-09-04 15:12:28'),
	('NG1-OUT-0924-0002', 'CG001', 1, 'PACK', 2, '', 'superadmin', '2024-09-24 08:15:23');
/*!40000 ALTER TABLE `t_wh_outbound_planning_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning_history
CREATE TABLE IF NOT EXISTS `t_wh_outbound_planning_history` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `previous_state` varchar(3) DEFAULT NULL,
  `last_status` varchar(3) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_planning_history: 0 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_outbound_planning_history` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_packing
CREATE TABLE IF NOT EXISTS `t_wh_packing` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `bucket_id` varchar(50) NOT NULL DEFAULT '',
  `carton_id` varchar(50) NOT NULL DEFAULT '',
  `status_id` varchar(3) NOT NULL DEFAULT '',
  `checker` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_packing: 0 rows
/*!40000 ALTER TABLE `t_wh_packing` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_packing` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_picking
CREATE TABLE IF NOT EXISTS `t_wh_picking` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `movement_id` varchar(50) NOT NULL DEFAULT '',
  `bucket_id` varchar(50) NOT NULL DEFAULT '',
  `status_id` varchar(3) NOT NULL DEFAULT '',
  `picker` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_picking: 5 rows
/*!40000 ALTER TABLE `t_wh_picking` DISABLE KEYS */;
INSERT INTO `t_wh_picking` (`outbound_planning_no`, `movement_id`, `bucket_id`, `status_id`, `picker`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-OUT-0924-0001', '', '', 'RPO', NULL, 'ares', '2024-09-04 15:12:40', '', NULL),
	('NG1-OUT-0924-0002', '', '', 'RPO', NULL, 'superadmin', '2024-09-24 08:15:30', '', NULL),
	('CBT-OUT-0623-0006', '', '', 'RPO', NULL, 'superadmin', '2024-03-19 11:56:11', '', NULL),
	('CBT-OUT-0523-0007', '', '', 'RPO', NULL, 'superadmin', '2024-08-26 14:45:19', '', NULL),
	('CBT-OUT-0423-0046', '', '', 'RPO', NULL, 'superadmin', '2024-08-26 14:48:00', '', NULL);
/*!40000 ALTER TABLE `t_wh_picking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_picking_detail
CREATE TABLE IF NOT EXISTS `t_wh_picking_detail` (
  `outbound_planning_no` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `pick_qty` int(11) DEFAULT 0,
  `location_id` varchar(50) NOT NULL DEFAULT '',
  `stock_id` varchar(10) DEFAULT '',
  `gr_id` varchar(30) NOT NULL,
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`sku`,`location_id`,`gr_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_picking_detail: 0 rows
/*!40000 ALTER TABLE `t_wh_picking_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_picking_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive
CREATE TABLE IF NOT EXISTS `t_wh_receive` (
  `gr_id` varchar(30) NOT NULL,
  `inbound_planning_no` varchar(50) DEFAULT NULL,
  `status_id` varchar(3) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`gr_id`),
  KEY `status_id` (`status_id`) USING BTREE,
  KEY `gr_id` (`gr_id`) USING BTREE,
  KEY `inbound_id` (`inbound_planning_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='checking and receiving';

-- Dumping data for table wms.t_wh_receive: 2 rows
/*!40000 ALTER TABLE `t_wh_receive` DISABLE KEYS */;
INSERT INTO `t_wh_receive` (`gr_id`, `inbound_planning_no`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('NG1-GR-0924-0001', 'NG1-IN-0924-0001', 'CGR', 'ares', '2024-09-04 14:54:51', 'ares', '2024-09-04 15:02:40', 'Y'),
	('NG1-GR-0924-0002', 'NG1-IN-0924-0002', 'CGR', 'superadmin', '2024-09-25 09:54:35', 'superadmin', '2024-09-25 10:06:07', 'Y');
/*!40000 ALTER TABLE `t_wh_receive` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_2
CREATE TABLE IF NOT EXISTS `t_wh_receive_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inbound_id` bigint(20) DEFAULT NULL,
  `gr_id` varchar(30) NOT NULL,
  `client_project_id` int(11) DEFAULT NULL,
  `GR_date` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `client_id` (`client_project_id`) USING BTREE,
  KEY `status_id` (`status_id`),
  KEY `gr_id` (`gr_id`),
  KEY `inbound_id` (`inbound_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='checking and receiving';

-- Dumping data for table wms.t_wh_receive_2: 0 rows
/*!40000 ALTER TABLE `t_wh_receive_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_receive_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_detail
CREATE TABLE IF NOT EXISTS `t_wh_receive_detail` (
  `gr_id` varchar(50) NOT NULL DEFAULT '',
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`gr_id`) USING BTREE,
  KEY `movement_id` (`movement_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_receive_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_receive_detail` DISABLE KEYS */;
INSERT INTO `t_wh_receive_detail` (`gr_id`, `movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('NG1-GR-0924-0001', 'NG1-01-0924-0001', 'ares', '2024-09-04 15:02:09', NULL, NULL, 'Y'),
	('NG1-GR-0924-0002', 'NG1-01-0924-0002', 'superadmin', '2024-09-25 09:58:24', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_receive_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_detail_2
CREATE TABLE IF NOT EXISTS `t_wh_receive_detail_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receive_id` int(11) NOT NULL,
  `movement_id` varchar(30) DEFAULT NULL,
  `movement_date` datetime DEFAULT NULL,
  `pallet_id` varchar(50) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `part_name` varchar(200) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `location_from` varchar(50) DEFAULT 'STAGING AREA',
  `location_to` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `movement_id` (`movement_id`),
  KEY `pallet_id` (`pallet_id`),
  KEY `uom_id` (`uom_id`),
  KEY `stock_id` (`stock_id`),
  KEY `receive_id` (`receive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_receive_detail_2: 0 rows
/*!40000 ALTER TABLE `t_wh_receive_detail_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_receive_detail_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_return
CREATE TABLE IF NOT EXISTS `t_wh_receive_return` (
  `gr_return_id` varchar(30) NOT NULL,
  `return_no` varchar(50) DEFAULT NULL,
  `status_id` varchar(3) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`gr_return_id`) USING BTREE,
  KEY `status_id` (`status_id`) USING BTREE,
  KEY `inbound_id` (`return_no`) USING BTREE,
  KEY `gr_id` (`gr_return_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='checking and receiving';

-- Dumping data for table wms.t_wh_receive_return: 4 rows
/*!40000 ALTER TABLE `t_wh_receive_return` DISABLE KEYS */;
INSERT INTO `t_wh_receive_return` (`gr_return_id`, `return_no`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-GRR-0523-0001', 'CBT-RTN-0523-0001', 'CRR', 'atmi', '2023-05-17 17:51:33', 'atmi', '2023-06-08 16:31:23', 'Y'),
	('CBT-GRR-0623-0009', 'CBT-RTN-0623-0009', 'CRR', 'mariofrans', '2023-06-13 09:26:00', 'superadmin', '2024-08-28 11:48:41', 'Y'),
	('NG1-GRR-0924-0001', 'NG1-RTN-0924-0001', 'ORR', 'ares', '2024-09-04 15:20:41', NULL, NULL, 'Y'),
	('NG1-GRR-0924-0002', 'NG1-RTN-0924-0002', 'CRR', 'ares', '2024-09-04 15:23:06', 'ares', '2024-09-04 15:28:55', 'Y');
/*!40000 ALTER TABLE `t_wh_receive_return` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_return_detail
CREATE TABLE IF NOT EXISTS `t_wh_receive_return_detail` (
  `gr_return_id` varchar(50) NOT NULL DEFAULT '',
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`gr_return_id`) USING BTREE,
  KEY `movement_id` (`movement_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_receive_return_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_receive_return_detail` DISABLE KEYS */;
INSERT INTO `t_wh_receive_return_detail` (`gr_return_id`, `movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-GRR-0523-0001', 'CBT-04-0623-0001', 'atmi', '2023-06-07 09:03:54', NULL, NULL),
	('NG1-GRR-0924-0002', 'NG1-04-0924-0001', 'ares', '2024-09-04 15:28:44', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_receive_return_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_return
CREATE TABLE IF NOT EXISTS `t_wh_return` (
  `return_no` varchar(20) NOT NULL,
  `client_project_id` int(11) DEFAULT NULL,
  `wh_id` int(11) DEFAULT NULL,
  `outbound_reference_no` varchar(20) DEFAULT NULL,
  `awb` varchar(50) DEFAULT NULL,
  `reference_no` varchar(20) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_from` varchar(50) DEFAULT NULL,
  `status_id` varchar(10) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `user_created` varchar(20) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`return_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_return: 4 rows
/*!40000 ALTER TABLE `t_wh_return` DISABLE KEYS */;
INSERT INTO `t_wh_return` (`return_no`, `client_project_id`, `wh_id`, `outbound_reference_no`, `awb`, `reference_no`, `return_date`, `return_from`, `status_id`, `reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-RTN-0523-0001', 1, NULL, 'test_outbound_1105_2', '7779254850212', 'RET_001', '2023-05-15', 'ali', 'RER', '', 'atmi', '2023-05-15 09:36:06', NULL, NULL),
	('CBT-RTN-0623-0009', 1, NULL, 'test_outbound_2501_2', '999712531548', 'test_outbound_2501_2', '2023-06-13', 'Toko Cahaya Abadi', 'RFR', NULL, 'mariofrans', '2023-06-13 09:23:04', 'superadmin', '2024-08-28 11:46:29'),
	('NG1-RTN-0924-0001', 1, 1, 'as', '123123', 'asd', '2024-09-04', 'suplier', 'RER', NULL, 'ares', '2024-09-04 15:16:33', 'ares', '2024-09-04 15:20:41'),
	('NG1-RTN-0924-0002', 1, 1, '123', '123', '123', '2024-09-04', '123', 'RFR', NULL, 'ares', '2024-09-04 15:19:20', 'ares', '2024-09-04 15:24:58');
/*!40000 ALTER TABLE `t_wh_return` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_return_detail
CREATE TABLE IF NOT EXISTS `t_wh_return_detail` (
  `return_no` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `item_name` varchar(250) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(50) DEFAULT NULL,
  `classification_id` varchar(50) DEFAULT NULL,
  `item_reason` text DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`return_no`,`sku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_return_detail: 5 rows
/*!40000 ALTER TABLE `t_wh_return_detail` DISABLE KEYS */;
INSERT INTO `t_wh_return_detail` (`return_no`, `sku`, `item_name`, `batch_no`, `serial_no`, `expired_date`, `part_no`, `imei`, `color`, `size`, `qty`, `uom_name`, `stock_id`, `classification_id`, `item_reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-RTN-0523-0001', '112233446', 'Teh Kotak Lemon', '23022023', NULL, '2024-02-23', NULL, NULL, NULL, NULL, 25, 'PIECES', 'AVR', '1', 'kemasan penyok', 'atmi', '2023-05-15 11:54:50', NULL, NULL),
	('CBT-RTN-0623-0009', '32L5995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'PIECES', 'DMGR', '1', 'Rusak', 'mariofrans', '2023-06-13 09:23:04', NULL, NULL),
	('CBT-RTN-0623-0009', 'IC0123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'SET', 'DMGR', '2', 'Rusak', 'mariofrans', '2023-06-13 09:23:04', NULL, NULL),
	('NG1-RTN-0924-0001', 'sku001', 'Cigatow - Supplier1', NULL, NULL, '2024-09-30', NULL, NULL, NULL, NULL, 2, 'PACK', 'DMGR', '4', 'rusak', 'ares', '2024-09-04 15:16:33', NULL, NULL),
	('NG1-RTN-0924-0002', 'sku001', 'Cigatow - Supplier1', NULL, NULL, '2024-09-30', NULL, NULL, NULL, NULL, 1, 'PACK', 'DMGR', '4', 'rusak', 'ares', '2024-09-04 15:19:20', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_return_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_checking
CREATE TABLE IF NOT EXISTS `t_wh_scan_checking` (
  `scan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outbound_id` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `location_id` varchar(50) NOT NULL DEFAULT '',
  `gr_id` varchar(30) NOT NULL DEFAULT '',
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `batch_no` varchar(50) NOT NULL DEFAULT '',
  `scan_qty` int(11) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`scan_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_scan_checking: 0 rows
/*!40000 ALTER TABLE `t_wh_scan_checking` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_scan_checking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_picking
CREATE TABLE IF NOT EXISTS `t_wh_scan_picking` (
  `scan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outbound_id` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `location_id` varchar(50) NOT NULL DEFAULT '',
  `gr_id` varchar(30) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `scan_qty` int(11) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`scan_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_scan_picking: 0 rows
/*!40000 ALTER TABLE `t_wh_scan_picking` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_scan_picking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_qty
CREATE TABLE IF NOT EXISTS `t_wh_scan_qty` (
  `scan_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT 0,
  `transport_id` int(11) NOT NULL DEFAULT 0,
  `pallet_id` varchar(50) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `part_name` varchar(200) DEFAULT NULL,
  `qty_scan` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT '',
  `batch_no` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `is_submit` enum('Y','N') DEFAULT 'Y',
  `is_active` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(30) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`scan_id`) USING BTREE,
  KEY `pallet_id` (`pallet_id`) USING BTREE,
  KEY `user_created` (`user_created`) USING BTREE,
  KEY `classification_id` (`stock_id`) USING BTREE,
  KEY `activity_id` (`activity_id`) USING BTREE,
  KEY `transport_id` (`transport_id`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_scan_qty: 3 rows
/*!40000 ALTER TABLE `t_wh_scan_qty` DISABLE KEYS */;
INSERT INTO `t_wh_scan_qty` (`scan_id`, `activity_id`, `transport_id`, `pallet_id`, `sku`, `part_name`, `qty_scan`, `uom_name`, `serial_no`, `batch_no`, `stock_id`, `remarks`, `is_submit`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 3, 1, '1', 'CG001', 'Cengkeh', 1, 'BARREL', NULL, '', 'AV', NULL, 'Y', 'Y', 'ares', '2024-09-04 14:54:13'),
	(3, 7, 2, '1', 'sku001', 'Cigatow - Supplier1', 1, 'PALLET', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-09-25 09:46:57'),
	(5, 7, 2, '2', 'sku001', 'Cigatow - Supplier1', 1, 'PALLET', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-09-25 09:47:45');
/*!40000 ALTER TABLE `t_wh_scan_qty` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_qty_2
CREATE TABLE IF NOT EXISTS `t_wh_scan_qty_2` (
  `scan_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT 0,
  `transport_id` int(11) NOT NULL DEFAULT 0,
  `spv_id` int(11) DEFAULT NULL,
  `pallet_id` varchar(50) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `part_name` varchar(200) DEFAULT NULL,
  `qty_scan` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `stock_id` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(30) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`scan_id`) USING BTREE,
  KEY `spv_id` (`spv_id`),
  KEY `pallet_id` (`pallet_id`),
  KEY `uom_id` (`uom_id`),
  KEY `user_created` (`user_created`),
  KEY `classification_id` (`stock_id`) USING BTREE,
  KEY `activity_id` (`activity_id`),
  KEY `transport_id` (`transport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_scan_qty_2: 0 rows
/*!40000 ALTER TABLE `t_wh_scan_qty_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_scan_qty_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_shipping_load
CREATE TABLE IF NOT EXISTS `t_wh_shipping_load` (
  `booking_no` varchar(50) NOT NULL DEFAULT '',
  `pickup_name` varchar(100) DEFAULT NULL,
  `pickup_company` varchar(100) DEFAULT NULL,
  `pickup_address` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `job_no` varchar(50) DEFAULT NULL,
  `pickup_datetime` datetime DEFAULT NULL,
  `status_id` varchar(3) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `client_project_id` int(11) NOT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`booking_no`,`client_project_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_shipping_load: 0 rows
/*!40000 ALTER TABLE `t_wh_shipping_load` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_shipping_load` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_shipping_load_detail
CREATE TABLE IF NOT EXISTS `t_wh_shipping_load_detail` (
  `booking_no` varchar(50) NOT NULL,
  `outbound_planning_no` varchar(50) NOT NULL,
  `awb` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booking_no`,`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_shipping_load_detail: 0 rows
/*!40000 ALTER TABLE `t_wh_shipping_load_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_shipping_load_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_count
CREATE TABLE IF NOT EXISTS `t_wh_stock_count` (
  `stock_count_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) DEFAULT 0,
  `wh_id` int(11) DEFAULT 0,
  `count_date` date DEFAULT NULL,
  `count_no` varchar(50) DEFAULT '',
  `stock_count_type` varchar(200) DEFAULT '',
  `status_id` varchar(3) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_count_id`),
  KEY `remark` (`stock_count_type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_stock_count: 1 rows
/*!40000 ALTER TABLE `t_wh_stock_count` DISABLE KEYS */;
INSERT INTO `t_wh_stock_count` (`stock_count_id`, `client_project_id`, `wh_id`, `count_date`, `count_no`, `stock_count_type`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-DCC-0924-0001', 1, 1, '2024-09-04', 'Count 1', 'DCC', 'ODC', 'superadmin', '2024-09-04 16:50:44', '', NULL);
/*!40000 ALTER TABLE `t_wh_stock_count` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_count_detail
CREATE TABLE IF NOT EXISTS `t_wh_stock_count_detail` (
  `stock_count_id` varchar(30) NOT NULL DEFAULT '',
  `count_no` varchar(30) NOT NULL DEFAULT '',
  `location_id` varchar(50) NOT NULL DEFAULT '',
  `sku` varchar(50) NOT NULL DEFAULT '',
  `item_name` varchar(200) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) DEFAULT '',
  `imei` varchar(50) DEFAULT '',
  `part_no` varchar(50) DEFAULT '',
  `color` varchar(50) DEFAULT '',
  `size` varchar(50) DEFAULT '',
  `expired_date` date DEFAULT NULL,
  `stock_id` varchar(10) NOT NULL DEFAULT '',
  `gr_id` varchar(50) NOT NULL DEFAULT '',
  `count_qty` int(11) DEFAULT 0,
  `on_hand_qty` int(11) DEFAULT 0,
  `discrepancy` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT '',
  `percentage` char(50) DEFAULT NULL,
  `counter` varchar(50) DEFAULT '',
  `count_status` varchar(20) DEFAULT '',
  `is_submit` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_count_id`,`location_id`,`sku`,`stock_id`,`gr_id`,`count_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_stock_count_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_stock_count_detail` DISABLE KEYS */;
INSERT INTO `t_wh_stock_count_detail` (`stock_count_id`, `count_no`, `location_id`, `sku`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `stock_id`, `gr_id`, `count_qty`, `on_hand_qty`, `discrepancy`, `uom_name`, `percentage`, `counter`, `count_status`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('NG1-DCC-0924-0001', 'Count 1', '1A1-001-001', 'CG001', 'Cengkeh', '', '123', '', '', '', '', '2027-01-01', 'AV', 'NG1-GR-0924-0001', 0, 1, 0, 'BARREL', NULL, '', '', 'Y', 'superadmin', '2024-09-04 16:50:44', '', NULL),
	('NG1-DCC-0924-0001', 'Count 1', '1A1-001-001', 'sku001', 'Cigatow - Supplier1', '', '', '', '', '', '', '2024-09-30', 'DMGR', 'NG1-GRR-0924-0002', 0, 1, 0, 'PACK', NULL, '', '', 'Y', 'superadmin', '2024-09-04 16:50:44', '', NULL);
/*!40000 ALTER TABLE `t_wh_stock_count_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_transfer
CREATE TABLE IF NOT EXISTS `t_wh_stock_transfer` (
  `stock_transfer_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) NOT NULL DEFAULT 0,
  `wh_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_type` varchar(3) DEFAULT '',
  `remark` varchar(250) DEFAULT '',
  `status_id` varchar(3) DEFAULT '',
  `data_upload1` varchar(500) DEFAULT '',
  `data_upload2` varchar(500) DEFAULT '',
  `data_upload3` varchar(500) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_transfer_id`),
  KEY `wh_id` (`wh_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_stock_transfer: 0 rows
/*!40000 ALTER TABLE `t_wh_stock_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_stock_transfer` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_transfer_detail
CREATE TABLE IF NOT EXISTS `t_wh_stock_transfer_detail` (
  `stock_transfer_id` varchar(30) NOT NULL DEFAULT '',
  `source_sku` varchar(50) NOT NULL DEFAULT '',
  `source_item_name` varchar(250) DEFAULT '',
  `source_batch_no` varchar(50) DEFAULT '',
  `source_serial_no` varchar(50) DEFAULT '',
  `source_imei` varchar(50) DEFAULT '',
  `source_part_no` varchar(50) DEFAULT '',
  `source_color` varchar(50) DEFAULT '',
  `source_size` varchar(50) DEFAULT '',
  `source_exp_date` date DEFAULT NULL,
  `source_pallet_id` varchar(50) DEFAULT '',
  `source_qty` int(11) DEFAULT 0,
  `source_uom` varchar(50) DEFAULT '',
  `source_stock_id` varchar(10) NOT NULL DEFAULT '',
  `source_location` varchar(50) NOT NULL DEFAULT '',
  `source_gr` varchar(30) DEFAULT '',
  `dest_sku` varchar(50) NOT NULL DEFAULT '',
  `dest_item_name` varchar(50) DEFAULT '',
  `dest_batch_no` varchar(50) DEFAULT '',
  `dest_serial_no` varchar(50) DEFAULT '',
  `dest_imei` varchar(50) DEFAULT '',
  `dest_part_no` varchar(50) DEFAULT '',
  `dest_color` varchar(50) DEFAULT '',
  `dest_size` varchar(50) DEFAULT '',
  `dest_exp_date` date DEFAULT NULL,
  `dest_pallet_id` varchar(50) DEFAULT '',
  `dest_qty` int(11) DEFAULT 0,
  `dest_uom` varchar(50) NOT NULL DEFAULT '',
  `dest_stock_id` varchar(10) NOT NULL DEFAULT '',
  `dest_location` varchar(50) DEFAULT '',
  `movement_id` varchar(50) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`dest_stock_id`,`dest_sku`,`dest_uom`,`stock_transfer_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_stock_transfer_detail: 0 rows
/*!40000 ALTER TABLE `t_wh_stock_transfer_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_stock_transfer_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_supervisor
CREATE TABLE IF NOT EXISTS `t_wh_supervisor` (
  `supervisor_id` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `client_project_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`supervisor_id`) USING BTREE,
  KEY `wh_id` (`client_project_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master supervisor per warehouse';

-- Dumping data for table wms.t_wh_supervisor: 4 rows
/*!40000 ALTER TABLE `t_wh_supervisor` DISABLE KEYS */;
INSERT INTO `t_wh_supervisor` (`supervisor_id`, `name`, `client_project_id`, `created_by`, `created_on`, `updated_by`, `updated_on`, `is_active`) VALUES
	('sugeng', 'Sugeng A', 1, 'atmi', '2022-09-20 11:16:50', NULL, NULL, 'Y'),
	('doni', 'Doni B', 2, 'atmi', '2022-09-20 11:16:50', NULL, NULL, 'Y'),
	('rian', 'Rian C', 3, 'atmi', '2022-09-20 11:16:50', NULL, NULL, 'Y'),
	('robby', 'Robby', 1, 'rdarmawan', '2023-01-03 13:58:53', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_supervisor` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_temporary_movement
CREATE TABLE IF NOT EXISTS `t_wh_temporary_movement` (
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `process_id` int(11) DEFAULT NULL,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `part_name` varchar(200) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `serial_no` varchar(50) NOT NULL DEFAULT '',
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `stock_id` varchar(50) DEFAULT NULL,
  `location_from` varchar(50) NOT NULL DEFAULT 'STAGING AREA',
  `location_type_from` varchar(50) DEFAULT NULL,
  `location_to` varchar(50) NOT NULL DEFAULT '',
  `location_type_to` varchar(50) DEFAULT 'STAGING AREA',
  `warehouseman` varchar(50) DEFAULT '',
  `is_submit` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_scanned` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`movement_id`,`location_to`,`sku`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_temporary_movement: 3 rows
/*!40000 ALTER TABLE `t_wh_temporary_movement` DISABLE KEYS */;
INSERT INTO `t_wh_temporary_movement` (`movement_id`, `process_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `expired_date`, `qty`, `uom_name`, `stock_id`, `location_from`, `location_type_from`, `location_to`, `location_type_to`, `warehouseman`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('NG1-01-0924-0002', 1, 'sku001', 'Cigatow - Supplier1', '', '', '2025-12-31 00:00:00', 2, 'PALLET', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-09-25 10:05:46', NULL, NULL, 'Y'),
	('NG1-04-0924-0001', 4, 'sku001', 'Cigatow - Supplier1', '', '', '2024-09-30 00:00:00', 1, 'PACK', 'DMGR', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'ares', 'Y', 'ares', '2024-09-04 15:28:44', NULL, NULL, 'Y'),
	('NG1-01-0924-0001', 1, 'CG001', 'Cengkeh', '', '', '2027-01-01 00:00:00', 1, 'BARREL', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'ares', 'Y', 'ares', '2024-09-04 15:02:09', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_temporary_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_temporary_movement_copy
CREATE TABLE IF NOT EXISTS `t_wh_temporary_movement_copy` (
  `movement_id` varchar(30) NOT NULL DEFAULT '',
  `process_id` int(11) DEFAULT 0,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `part_name` varchar(200) DEFAULT '',
  `batch_no` varchar(50) DEFAULT '',
  `serial_no` varchar(50) NOT NULL DEFAULT '',
  `expired_date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `uom_name` varchar(50) DEFAULT '',
  `stock_id` varchar(10) DEFAULT '',
  `location_from` varchar(50) NOT NULL DEFAULT 'STAGING AREA',
  `location_type_from` varchar(50) DEFAULT '',
  `location_to` varchar(50) NOT NULL DEFAULT '',
  `location_type_to` varchar(50) DEFAULT 'STAGING AREA',
  `gr_id` varchar(50) DEFAULT '',
  `is_submit` enum('Y','N') DEFAULT 'Y',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT '',
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`movement_id`,`location_to`,`sku`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_temporary_movement_copy: 1 rows
/*!40000 ALTER TABLE `t_wh_temporary_movement_copy` DISABLE KEYS */;
INSERT INTO `t_wh_temporary_movement_copy` (`movement_id`, `process_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `expired_date`, `qty`, `uom_name`, `stock_id`, `location_from`, `location_type_from`, `location_to`, `location_type_to`, `gr_id`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('NG1-08-0924-0001', 8, 'CG001', 'Cengkeh', '', '123', '2027-01-01 00:00:00', 1, 'BARREL', 'AV', '1A1-001-001', 'Bulk', '1A1-001-001', 'Bulk', 'NG1-GR-0924-0001', 'Y', 'ares', '2024-09-04 15:42:43', 'ares', '2024-09-04 15:48:53', 'Y');
/*!40000 ALTER TABLE `t_wh_temporary_movement_copy` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_transportation
CREATE TABLE IF NOT EXISTS `t_wh_transportation` (
  `transport_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `arrival_date` datetime DEFAULT NULL,
  `start_unloading` datetime DEFAULT NULL,
  `finish_unloading` datetime DEFAULT NULL,
  `departure_date` datetime DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `container_no` varchar(50) DEFAULT NULL,
  `seal_no` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`transport_id`) USING BTREE,
  KEY `vehicle_no` (`vehicle_no`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='sub menu transportation and unloading on inbound planning';

-- Dumping data for table wms.t_wh_transportation: 2 rows
/*!40000 ALTER TABLE `t_wh_transportation` DISABLE KEYS */;
INSERT INTO `t_wh_transportation` (`transport_id`, `activity_id`, `vehicle_no`, `driver_name`, `arrival_date`, `start_unloading`, `finish_unloading`, `departure_date`, `vehicle_id`, `container_no`, `seal_no`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 3, 'b123as', 'pandi', '2024-09-04 14:53:00', '2024-09-04 14:53:00', '2024-09-04 14:54:00', '2024-09-04 14:54:00', 1, '1', '1', 'ares', '2024-09-04 14:53:56', 'ares', '2024-09-04 14:54:30', 'Y', NULL),
	(2, 7, 'B123XXX', 'arara', '2024-09-25 09:23:00', '2024-09-25 09:23:00', '2024-09-25 10:52:00', '2024-09-25 10:53:00', 3, '1', '1', 'superadmin', '2024-09-25 09:23:37', 'superadmin', '2024-09-25 09:52:43', 'Y', NULL);
/*!40000 ALTER TABLE `t_wh_transportation` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_transportation_2
CREATE TABLE IF NOT EXISTS `t_wh_transportation_2` (
  `transport_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `checker` varchar(30) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `arrival_date` datetime DEFAULT NULL,
  `start_unloading` datetime DEFAULT NULL,
  `finish_unloading` datetime DEFAULT NULL,
  `departure_date` datetime DEFAULT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `container_no` varchar(50) DEFAULT NULL,
  `seal_no` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`transport_id`) USING BTREE,
  KEY `spv_id` (`supervisor_id`) USING BTREE,
  KEY `checker` (`checker`),
  KEY `vehicle_no` (`vehicle_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='sub menu transportation and unloading on inbound planning';

-- Dumping data for table wms.t_wh_transportation_2: 0 rows
/*!40000 ALTER TABLE `t_wh_transportation_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_wh_transportation_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_user
CREATE TABLE IF NOT EXISTS `t_wh_user` (
  `username` varchar(30) NOT NULL,
  `user_level_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `wh_id` int(11) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `send_email` enum('Y','N') DEFAULT 'N',
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `use_hht` enum('Y','N') DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT NULL,
  `is_android` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_web` enum('Y','N') NOT NULL DEFAULT 'Y',
  `remember_token` varchar(100) DEFAULT NULL,
  `user_group_id` bigint(20) DEFAULT NULL,
  `update_by` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`username`,`user_level_id`,`wh_id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master user warehouse';

-- Dumping data for table wms.t_wh_user: 4 rows
/*!40000 ALTER TABLE `t_wh_user` DISABLE KEYS */;
INSERT INTO `t_wh_user` (
  `username`, `user_level_id`, `fullname`, 
  `password`, `wh_id`, `email`, `phone`, 
  `send_email`, `created_by`, `created_on`, 
  `last_login`, `use_hht`, `is_active`, 
  `is_deleted`, `is_android`, `is_web`, 
  `remember_token`, `user_group_id`, 
  `update_by`, `updated_at`
) 
VALUES 
  (
    'superadmin', 5, 'Super Admin', '$2y$10$ML9NnCSNxqa5RHJjqH7QyeX1qx9fV9J2aLqrReQpSnM.l9VG/I3ni', 
    1, 'sa@test.com', '081111111', 'Y', 
    'mariofrans', '2023-03-20 10:51:54', 
    NULL, NULL, 'Y', NULL, 'Y', 'Y', NULL, 
    1, 'superadmin', '2024-09-18 08:57:01'
  ), 
  (
    'whsman01', 3, 'whsman01', '$2a$10$ILnXIj7eQK8lSFjUgXDsGuYOjCzCUACRW.tRbguR2cpy.AMmBcvka', 
    1, 'whsman01@test.com', '081111111', 
    'N', 'superadmin', '2024-08-26 10:30:36', 
    NULL, NULL, 'Y', NULL, 'Y', 'Y', NULL, 
    4, 'superadmin', '2024-09-03 11:02:06'
  ), 
  (
    'admin', 2, 'Admin', '$2a$10$ILnXIj7eQK8lSFjUgXDsGuYOjCzCUACRW.tRbguR2cpy.AMmBcvka', 
    1, 'test@test.com', '12312389090', 
    'N', 'superadmin', '2024-08-30 16:09:34', 
    NULL, NULL, 'Y', NULL, 'N', 'Y', NULL, 
    3, 'superadmin', '2024-09-04 13:00:50'
  ), 
  (
    'whs_spv', 1, 'whs_spv', '$2a$10$ILnXIj7eQK8lSFjUgXDsGuYOjCzCUACRW.tRbguR2cpy.AMmBcvka', 
    1, 'whs_spv@test.com', '08111111', 
    'Y', 'superadmin', '2024-09-04 13:02:05', 
    NULL, NULL, 'Y', NULL, 'N', 'Y', NULL, 
    2, NULL, NULL
  );
/*!40000 ALTER TABLE `t_wh_user` ENABLE KEYS */;

-- Dumping structure for table wms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wms.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
