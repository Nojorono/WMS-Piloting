-- --------------------------------------------------------
-- Host:                         10.0.29.49
-- Server version:               10.6.18-MariaDB-0ubuntu0.22.04.1 - Ubuntu 22.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table wms.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
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
DROP TABLE IF EXISTS `migrations`;
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
DROP TABLE IF EXISTS `m_comodity`;
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
DROP TABLE IF EXISTS `m_item_classification`;
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
DROP TABLE IF EXISTS `m_item_classification_copy`;
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
DROP TABLE IF EXISTS `m_item_uom`;
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
	('Bag', 2, 'superadmin', '2024-08-28 11:28:41', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_item_uom` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_uom_2
DROP TABLE IF EXISTS `m_item_uom_2`;
CREATE TABLE IF NOT EXISTS `m_item_uom_2` (
  `item_uom_id` int(11) NOT NULL DEFAULT 0,
  `uom_name` varchar(50) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `is_deleted` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`item_uom_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master item uom warehouse';

-- Dumping data for table wms.m_item_uom_2: 10 rows
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
	(10, 'PIECES', NULL, NULL, 'Y', NULL);
/*!40000 ALTER TABLE `m_item_uom_2` ENABLE KEYS */;

-- Dumping structure for table wms.m_item_uom_type
DROP TABLE IF EXISTS `m_item_uom_type`;
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
DROP TABLE IF EXISTS `m_menu`;
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_menu: 43 rows
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
	(41, 'Transportation', 'Transportation', '2', 0, 1, 5, 'transportation', NULL, 'public/img/transport.png', 'public/img/transport_white.png', 'Y', 'backdoor', '2023-07-27 14:16:51');
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;

-- Dumping structure for table wms.m_process
DROP TABLE IF EXISTS `m_process`;
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
DROP TABLE IF EXISTS `m_process_2`;
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
DROP TABLE IF EXISTS `m_status`;
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
DROP TABLE IF EXISTS `m_status_2`;
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
DROP TABLE IF EXISTS `m_status_relation`;
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
DROP TABLE IF EXISTS `m_user_group`;
CREATE TABLE IF NOT EXISTS `m_user_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activ` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_user_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_user_group` DISABLE KEYS */;
INSERT INTO `m_user_group` (`id`, `name`, `description`, `created_at`, `updated_at`, `is_activ`) VALUES
	(1, 'SA', 'Superadmin', '2024-08-30 08:48:51', NULL, 'Y');
/*!40000 ALTER TABLE `m_user_group` ENABLE KEYS */;

-- Dumping structure for table wms.m_user_group_menu_access
DROP TABLE IF EXISTS `m_user_group_menu_access`;
CREATE TABLE IF NOT EXISTS `m_user_group_menu_access` (
  `usergroup_id` bigint(20) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`usergroup_id`,`menu_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.m_user_group_menu_access: 0 rows
/*!40000 ALTER TABLE `m_user_group_menu_access` DISABLE KEYS */;
INSERT INTO `m_user_group_menu_access` (`usergroup_id`, `menu_id`) VALUES
	(1, 1),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 13),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(1, 22),
	(1, 23),
	(1, 24),
	(1, 25),
	(1, 26),
	(1, 27),
	(1, 28),
	(1, 29),
	(1, 30),
	(1, 31),
	(1, 32),
	(1, 33),
	(1, 34),
	(1, 35),
	(1, 36),
	(1, 37),
	(1, 38),
	(1, 39),
	(1, 40),
	(1, 41),
	(1, 42),
	(1, 43);
/*!40000 ALTER TABLE `m_user_group_menu_access` ENABLE KEYS */;

-- Dumping structure for table wms.m_user_menu_access
DROP TABLE IF EXISTS `m_user_menu_access`;
CREATE TABLE IF NOT EXISTS `m_user_menu_access` (
  `username` varchar(50) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_user_menu_access: 48 rows
/*!40000 ALTER TABLE `m_user_menu_access` DISABLE KEYS */;
INSERT INTO `m_user_menu_access` (`username`, `menu_id`) VALUES
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
	('whsman01', 6),
	('whsman01', 12),
	('whsman01', 14),
	('whsman01', 17),
	('whsman01', 19),
	('whsman01', 39),
	('whsman01', 40);
/*!40000 ALTER TABLE `m_user_menu_access` ENABLE KEYS */;

-- Dumping structure for table wms.m_warehouse
DROP TABLE IF EXISTS `m_warehouse`;
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
  `is_rpx_wh` enum('Y','N') DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `user_updated` varchar(20) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`wh_id`) USING BTREE,
  KEY `id` (`wh_id`),
  KEY `wh_id` (`wh_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master warehouse';

-- Dumping data for table wms.m_warehouse: 4 rows
/*!40000 ALTER TABLE `m_warehouse` DISABLE KEYS */;
INSERT INTO `m_warehouse` (`wh_id`, `wh_code`, `wh_prefix`, `wh_name`, `address1`, `address2`, `address3`, `city`, `country`, `postal_code`, `phone`, `is_rpx_wh`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 'RPX-CBT-01', 'CBT', 'RDC Cibitung', 'JL Sulawesi Blok H No.1', NULL, NULL, 'Bekasi', 'Indonesia', 17520, '(022) 8980980', 'Y', NULL, NULL, NULL, NULL, 'Y', 'N'),
	(2, 'RPX-TAN-01', 'TAN', 'Telesonic Warehouse', 'Jl. Telesonik Industri Jatake', NULL, NULL, 'Tangerang', 'Indonesia', 15135, NULL, 'N', NULL, NULL, NULL, NULL, 'Y', 'N'),
	(3, 'RPX-CIN-01', 'CIN', 'Cilegon Warehouse', 'Jl. Australia I', NULL, NULL, 'Cilegon', 'Indonesia', 42443, NULL, 'N', NULL, NULL, NULL, NULL, 'Y', 'N'),
	(4, 'RPX-TEST-01', 'TEST', 'Warehouse Test', 'asd', 'bcd', 'efg', 'Jakarta', 'Indonesia', 12310, '123', 'Y', 'atmi', '2023-03-06 09:48:48', 'atmi', '2023-03-06 10:04:36', 'Y', 'N');
/*!40000 ALTER TABLE `m_warehouse` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_adjustment_type
DROP TABLE IF EXISTS `m_wh_adjustment_type`;
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
DROP TABLE IF EXISTS `m_wh_buffer`;
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
DROP TABLE IF EXISTS `m_wh_client`;
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

-- Dumping data for table wms.m_wh_client: 8 rows
/*!40000 ALTER TABLE `m_wh_client` DISABLE KEYS */;
INSERT INTO `m_wh_client` (`client_id`, `client_name`, `address1`, `address2`, `address3`, `phone`, `city`, `country`, `postal_code`, `account_number`, `methods_id`, `user_created`, `datetime_created`, `updated_by`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	('1', 'Toshiba', 'Gedung Summitmas 2', NULL, NULL, '(021) 5201227', 'Jakarta Selatan', 'Indonesia', '12190', 123, 1, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('2', 'Yutaka', 'Soho Capital', NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('3', 'Sanwa', 'Jl. Danau Sunter Barat No.4, R', NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('4', 'Smart Logistics', 'Zhongguo', NULL, NULL, NULL, NULL, 'China', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('5', 'Archroma', 'Kalisabi', NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Y', 'N'),
	('TEST', 'Test Insert Client', 'Jalan SD 3', '', '', '123', 'Jakarta', 'Indonesia', '12310', NULL, 1, 'atmi', '2023-03-02 17:03:44', NULL, NULL, 'Y', 'N'),
	('6', 'RPX Fulfillment', 'Jalan Pegangsaan no 31', '', '', '02123456', 'Jakarta', 'Indonesia', '12350', NULL, 1, NULL, NULL, 'atmi', '2023-05-02 14:42:53', 'Y', 'N'),
	('client_test', 'client test', 'jalan ciputat raya no 99', NULL, NULL, '123', 'Jakarta', 'Indonesia', '12310', NULL, 1, 'superadmin', '2023-05-04 09:06:46', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_wh_client` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_client_project
DROP TABLE IF EXISTS `m_wh_client_project`;
CREATE TABLE IF NOT EXISTS `m_wh_client_project` (
  `client_project_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(20) NOT NULL,
  `wh_id` int(11) NOT NULL DEFAULT 0,
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
  PRIMARY KEY (`client_project_id`,`client_id`) USING BTREE,
  KEY `wh_id` (`wh_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='project client warehouse';

-- Dumping data for table wms.m_wh_client_project: 8 rows
/*!40000 ALTER TABLE `m_wh_client_project` DISABLE KEYS */;
INSERT INTO `m_wh_client_project` (`client_project_id`, `client_id`, `wh_id`, `project_type_id`, `client_project_name`, `address1`, `address2`, `address3`, `city`, `postal_code`, `country`, `phone`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, '1', 1, 1, 'Toshiba', 'Gedung Summitmas', NULL, NULL, 'Jakarta Selatan', '12190', 'Indonesia', '(021) 5201227', NULL, NULL, 'mariofrans', '2023-03-07 16:09:43', 'Y', 'N'),
	(2, '2', 1, 1, 'Yutaka', NULL, NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, 'Y', 'N'),
	(3, '3', 1, 1, 'Sanwa', NULL, NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, 'Y', 'N'),
	(4, '4', 1, 1, 'Smart Logistics', NULL, NULL, NULL, NULL, NULL, 'China', NULL, NULL, NULL, NULL, NULL, 'Y', 'N'),
	(5, '5', 2, 1, 'Archroma Tangerang', NULL, NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, 'Y', 'N'),
	(6, '5', 3, 1, 'Archroma Cilegon', NULL, NULL, NULL, NULL, NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, 'Y', 'N'),
	(8, 'TEST', 1, 2, 'Fulfillment', 'asd', '', '', 'Jakarta', '12345', 'Indonesia', '123456', 'atmi', '2023-03-03 18:11:57', NULL, NULL, 'Y', 'N'),
	(9, 'client_test', 1, 1, 'test project', 'jalan ciputat raya no 99', NULL, NULL, 'Jakarta', '12310', 'Indonesia', '123', 'superadmin', '2023-05-04 09:07:33', NULL, NULL, 'Y', 'N');
/*!40000 ALTER TABLE `m_wh_client_project` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_commodity
DROP TABLE IF EXISTS `m_wh_commodity`;
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
DROP TABLE IF EXISTS `m_wh_contact_buffer`;
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
	(1, 1, 1, 'Y', 'atmi', '2023-05-04 16:19:56', NULL, NULL);
/*!40000 ALTER TABLE `m_wh_contact_buffer` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_contact_buffer_detail
DROP TABLE IF EXISTS `m_wh_contact_buffer_detail`;
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
	(1, 3, '', NULL, NULL, 'atmi', '2023-05-19 16:11:29'),
	(1, 1, 'npertiwi@rpxholding.com', NULL, NULL, 'atmi', '2023-05-19 16:11:29');
/*!40000 ALTER TABLE `m_wh_contact_buffer_detail` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_inbox
DROP TABLE IF EXISTS `m_wh_inbox`;
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
DROP TABLE IF EXISTS `m_wh_item`;
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

-- Dumping data for table wms.m_wh_item: 13 rows
/*!40000 ALTER TABLE `m_wh_item` DISABLE KEYS */;
INSERT INTO `m_wh_item` (`sku`, `part_name`, `base_qty`, `imei`, `part_no`, `color`, `size`, `item_classification_id`, `base_uom`, `length`, `width`, `height`, `volume`, `directions`, `group_id`, `wh_id`, `client_id`, `photo`, `is_serial_no`, `is_batch_no`, `is_imei`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('75016438', 'DISPLAY PANEL V216B1-L02', 1, '', '', '', '', 1, 'PIECES', 50, 42, 50, 1000, NULL, NULL, '1', '1', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('32L5995', 'TV Toshiba 32L5995', 1, '', '', '', '', 1, 'PIECES', 48, 40, 43, NULL, NULL, NULL, '1', '1', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('47RW1EJ', 'TV Toshiba 47RW1EJ', 1, '', '', '', '', 1, 'PIECES', 41, 34, 35, NULL, NULL, NULL, '1', '1', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('KK3259001', 'Smart Bluetooth Headset', 1, '', '', '', '', 1, 'PIECES', 10, 8, 4, NULL, NULL, NULL, '1', '4', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('600428066', 'Mini Camera', 1, '', '', '', '', 1, 'PIECES', 10, 14, 9, NULL, NULL, NULL, '1', '2', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('505627201', 'Mens Shoulder Bag', 1, '', '', '', '', 1, 'PIECES', 20, 11, 9, NULL, NULL, NULL, '1', '4', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('112233445', 'Teh Kotak Original', 1, '', '11', 'Cokelat', '', 1, 'PIECES', 10, 10, 10, NULL, NULL, NULL, '1', '1', NULL, 'N', 'Y', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('112233446', 'Teh Kotak Lemon', 1, '', '44', 'Kuning', '', 1, 'PIECES', 10, 10, 10, NULL, NULL, NULL, '1', '1', NULL, 'N', 'Y', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('112233447', 'Teh Kotak Apel', 1, '', '66', 'Merah', '', 1, 'PIECES', 10, 10, 10, NULL, NULL, NULL, '1', '1', NULL, 'N', 'Y', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('IC0123', 'IC TV Toshiba 32L5995', 1, '', '123', '', '', 1, 'SET', 10, 10, 10, NULL, NULL, NULL, '1', '1', NULL, 'N', 'N', 'N', NULL, NULL, NULL, NULL, 'Y'),
	('ABC123', 'Baterai ABC', NULL, '', '', '', '', NULL, 'BOX', 23, 23, 12, 200, '', NULL, '1', '1', NULL, 'N', 'Y', 'N', 'atmi', '2023-03-09 14:33:35', NULL, NULL, 'Y'),
	('ABC456', 'Sirup ABC Jeruk', NULL, '', '', '', '', NULL, 'BOX', 12, 5, 23, 60, '', NULL, '1', '1', NULL, 'N', 'Y', 'N', 'atmi', '2023-03-09 14:35:59', 'atmi', '2023-03-09 15:34:27', 'Y'),
	('CG001', 'Cengkeh', NULL, NULL, NULL, NULL, NULL, NULL, 'KG', 60, 100, 5, 40, NULL, NULL, '1', '1', NULL, 'N', 'N', 'N', 'superadmin', '2024-08-26 09:06:49', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `m_wh_item` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location
DROP TABLE IF EXISTS `m_wh_location`;
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
INSERT INTO `m_wh_location` (`location_id`, `location_code`, `wh_id`, `location_name`, `index_code`, `location_type`, `commodity_id`, `client_project_id`, `stock_id`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, '1A1-001-001', 1, '1A1-001-001', 'F02', 'Bulk', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', 'atmi', '2023-03-07 09:14:55', 'Y', NULL),
	(2, '1A1-001-002', 1, '1A1-001-002', 'R02', 'Racking', 1, 1, NULL, 'atmi', '2022-09-27 09:55:36', NULL, NULL, 'Y', NULL),
	(3, '1A1-012', 1, '1A1-012', 'F01', 'Bulk', 2, 1, NULL, 'atmi', '2022-09-27 09:55:36', NULL, NULL, 'Y', NULL),
	(4, '1A1-001-001', 2, '1A1-001-001', 'R01', 'Racking', 4, 2, NULL, 'atmi', '2022-09-27 09:55:36', NULL, NULL, 'Y', NULL),
	(5, 'DMG01-001', 1, 'DMG01-001', 'F02', 'Quarantine', 2, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(6, '1A1-001-003', 1, '1A1-001-003', 'R01', 'Racking', 3, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(7, 'FL001', 1, 'FL001', 'F01', 'Bulk', 4, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(8, '1B1-001-001', 1, '1B1-001-001', 'R01', 'Racking', 3, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(9, 'DMG-001-001', 1, 'DMG-001-001', 'R02', 'Racking', 1, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(10, 'test_location_1', 1, 'test_location_1', 'R01', 'Racking', 2, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(11, 'test_location_2', 1, 'test_location_2', 'R02', 'Racking', 2, 1, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(12, 'test_location_3', 1, 'test_location_3', 'F01', 'Bulk', 1, 1, NULL, 'atmi', '2023-03-06 17:31:40', NULL, NULL, NULL, NULL),
	(13, 'R1F3', 1, 'R1F3', 'F01', 'Bulk', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_wh_location` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location_index
DROP TABLE IF EXISTS `m_wh_location_index`;
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
INSERT INTO `m_wh_location_index` (`index_code`, `index_name`, `length`, `width`, `height`, `capacity`, `is_active`, `is_deleted`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('R01', 'Rack 01', '20', '30', '50', '1000', 'Y', NULL, 'atmi', '2022-09-21 17:34:29', NULL, NULL),
	('R02', 'Rack 02', '30', '30', '50', '1000', 'Y', NULL, 'atmi', '2022-09-21 17:34:29', NULL, NULL),
	('F01', 'Floor 01', '30', '30', '100', '1000', 'Y', NULL, 'atmi', '2022-09-21 17:34:29', NULL, NULL),
	('F02', 'Floor 02', '50', '50', '100', '1000', 'Y', NULL, 'atmi', '2022-09-21 17:34:29', NULL, NULL),
	('R03', 'Rack 03', '50', '30', '50', '1000', NULL, NULL, 'atmi', '2023-03-07 10:29:42', 'atmi', '2023-03-07 14:30:58');
/*!40000 ALTER TABLE `m_wh_location_index` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_location_type
DROP TABLE IF EXISTS `m_wh_location_type`;
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
DROP TABLE IF EXISTS `m_wh_mail`;
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
DROP TABLE IF EXISTS `m_wh_methods`;
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
DROP TABLE IF EXISTS `m_wh_notification_type`;
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
DROP TABLE IF EXISTS `m_wh_order_type`;
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
	(2, 'Kiriman Express', NULL, NULL, 'Y', NULL),
	(3, 'Transfer Warehouse', NULL, NULL, 'Y', NULL);
/*!40000 ALTER TABLE `m_wh_order_type` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_parameter
DROP TABLE IF EXISTS `m_wh_parameter`;
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
DROP TABLE IF EXISTS `m_wh_project_type`;
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
DROP TABLE IF EXISTS `m_wh_rules`;
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
DROP TABLE IF EXISTS `m_wh_service_type`;
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
DROP TABLE IF EXISTS `m_wh_setting_buffer`;
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
DROP TABLE IF EXISTS `m_wh_stock_count_type`;
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
DROP TABLE IF EXISTS `m_wh_stock_type`;
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
DROP TABLE IF EXISTS `m_wh_stock_type_copy`;
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
DROP TABLE IF EXISTS `m_wh_supplier`;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master supplier warehouse';

-- Dumping data for table wms.m_wh_supplier: 4 rows
/*!40000 ALTER TABLE `m_wh_supplier` DISABLE KEYS */;
INSERT INTO `m_wh_supplier` (`supplier_id`, `supplier_name`, `address1`, `address2`, `address3`, `city`, `client_id`, `contact_person`, `phone`, `created_by`, `created_on`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 'test', 'Jalan Ciputat Raya No 99', NULL, NULL, 'Jakarta', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(2, 'PT XYZ', 'Jalan Bahagia', NULL, NULL, 'Bekasi', '2', NULL, NULL, 'atmi', '2022-10-03 09:45:31', NULL, NULL, 'Y', NULL),
	(3, 'PT Yunbo', 'Jalan Jalan', NULL, NULL, 'Jonggol', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', NULL),
	(4, 'PT Maju Jaya', 'asd', 'qwe', 'zxc', 'Jakarta', '1', 'Cindy', '123', 'atmi', '2023-03-08 15:20:56', 'atmi', '2023-03-08 17:25:43', 'Y', 'N');
/*!40000 ALTER TABLE `m_wh_supplier` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_transaction_type
DROP TABLE IF EXISTS `m_wh_transaction_type`;
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
DROP TABLE IF EXISTS `m_wh_transporter`;
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
DROP TABLE IF EXISTS `m_wh_user_client_project`;
CREATE TABLE IF NOT EXISTS `m_wh_user_client_project` (
  `username` varchar(100) NOT NULL,
  `client_project_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`client_project_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.m_wh_user_client_project: 34 rows
/*!40000 ALTER TABLE `m_wh_user_client_project` DISABLE KEYS */;
INSERT INTO `m_wh_user_client_project` (`username`, `client_project_id`) VALUES
	('atmi', 1),
	('bunga', 1),
	('bunga', 2),
	('bunga', 3),
	('bunga', 4),
	('bunga', 5),
	('bunga', 6),
	('bunga', 8),
	('bunga', 9),
	('hari', 1),
	('hari', 2),
	('mariofrans', 1),
	('mariofrans', 2),
	('mariofrans', 3),
	('mariofrans', 4),
	('mariofrans', 5),
	('mariofrans', 6),
	('mariofrans_spv', 1),
	('ozawa', 1),
	('rdarmawan', 1),
	('rdarmawan', 2),
	('rdivianto', 1),
	('superadmin', 1),
	('superadmin', 2),
	('superadmin', 3),
	('superadmin', 4),
	('superadmin', 5),
	('superadmin', 6),
	('superadmin', 8),
	('superadmin', 9),
	('test_admin', 1),
	('test_staff', 1),
	('whsman01', 1),
	('whsman01', 9);
/*!40000 ALTER TABLE `m_wh_user_client_project` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_user_level
DROP TABLE IF EXISTS `m_wh_user_level`;
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='list user level';

-- Dumping data for table wms.m_wh_user_level: 5 rows
/*!40000 ALTER TABLE `m_wh_user_level` DISABLE KEYS */;
INSERT INTO `m_wh_user_level` (`user_level_id`, `access_project`, `user_level`, `level_desc`, `user_view`, `user_edit`, `user_delete`, `user_create`) VALUES
	(1, 'N', 'SPV', 'Supervisor', 1, 1, 0, 1),
	(2, 'N', 'Admin', 'Admin', 1, 1, 1, 1),
	(3, 'N', 'Staff', 'Staff', 1, 1, 1, 1),
	(4, 'N', 'Customer', 'Customer', 0, 0, 0, 0),
	(5, 'Y', 'SuperAdmin', 'Super Admin', 1, 1, 1, 1);
/*!40000 ALTER TABLE `m_wh_user_level` ENABLE KEYS */;

-- Dumping structure for table wms.m_wh_user_project
DROP TABLE IF EXISTS `m_wh_user_project`;
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
DROP TABLE IF EXISTS `m_wh_vehicle`;
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
DROP TABLE IF EXISTS `password_resets`;
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
DROP TABLE IF EXISTS `personal_access_tokens`;
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
DROP TABLE IF EXISTS `t_running_number`;
CREATE TABLE IF NOT EXISTS `t_running_number` (
  `process_code` char(11) NOT NULL DEFAULT '',
  `date` char(50) NOT NULL DEFAULT '',
  `wh_id` bigint(20) NOT NULL,
  `running_number` int(11) NOT NULL,
  PRIMARY KEY (`process_code`,`date`,`wh_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_running_number: 78 rows
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
	('08', '2024-08', 1, 2);
/*!40000 ALTER TABLE `t_running_number` ENABLE KEYS */;

-- Dumping structure for table wms.t_running_number_copy
DROP TABLE IF EXISTS `t_running_number_copy`;
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
DROP TABLE IF EXISTS `t_wh_activity`;
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
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_activity: 189 rows
/*!40000 ALTER TABLE `t_wh_activity` DISABLE KEYS */;
INSERT INTO `t_wh_activity` (`activity_id`, `process_id`, `inbound_planning_no`, `reference_no`, `movement_id`, `stock_count_id`, `count_no`, `gr_id`, `gr_return_id`, `outbound_planning_no`, `checker`, `supervisor_id`, `datetime_est_start`, `datetime_est_finish`, `datetime_start_counting`, `datetime_finish_counting`, `sku`, `serial_no`, `location_from`, `location_to`, `is_active`, `is_delete`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(15, 12, 'CBT-IN-1122-0014', 'test09nov22_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2022-11-11 09:08:00', '2022-11-12 09:08:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-09 09:09:00', '', NULL),
	(16, 13, NULL, 'test09nov22_1', NULL, NULL, NULL, 'CBT-GR-1122-0014', NULL, NULL, 'test_staff', '', '2022-11-13 13:40:00', '2022-11-13 13:40:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-09 13:40:35', '', NULL),
	(13, 12, 'CBT-IN-1022-0044', 'test_0411', NULL, NULL, NULL, NULL, NULL, NULL, 'hari', 'sugeng', '2022-11-04 13:00:00', '2022-11-04 14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-11-04 14:43:54', 'sugeng', '2022-11-06 14:42:58'),
	(12, 8, NULL, NULL, 'CBT-08-1122-00001', NULL, NULL, NULL, NULL, NULL, 'abu', '0', '2022-11-03 09:41:06', '2022-11-03 09:50:06', NULL, NULL, '32L5995', '20210612', '1A1-001-001', '1A1-001-002', 'Y', 'N', 'atmi', '2022-11-03 11:26:39', '', NULL),
	(14, 13, NULL, NULL, NULL, NULL, NULL, 'CBT-GR-1022-0043', NULL, NULL, 'bayu', '', '2022-11-05 13:00:00', '2022-11-05 14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-11-06 19:50:30', '', NULL),
	(17, 12, 'CBT-IN-1122-0015', 'test_09nov22_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2022-11-12 17:23:00', '2022-11-13 17:23:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-09 17:23:22', '', NULL),
	(18, 13, NULL, 'test_09nov22_2', NULL, NULL, NULL, 'CBT-GR-1122-0015', NULL, NULL, 'test_staff', '', '2022-11-17 17:26:00', '2022-11-09 17:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-09 17:26:55', '', NULL),
	(19, 12, 'CBT-IN-1022-0045', 'test_0411_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2022-11-11 17:32:00', '2022-11-11 20:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-11 16:33:17', '', NULL),
	(20, 12, 'CBT-IN-1022-0045', 'test_0411_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2022-11-11 16:41:00', '2022-11-11 16:41:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-11 16:41:29', '', NULL),
	(21, 12, 'CBT-IN-1022-0045', 'test_0411_2', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2022-11-11 16:41:00', '2022-11-11 16:41:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-11 16:41:29', '', NULL),
	(22, 12, 'CBT-IN-1122-0016', 'RBY-1234', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2022-11-15 01:02:00', '2022-11-15 06:02:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-14 14:25:56', '', NULL),
	(23, 13, NULL, 'RBY-1234', NULL, NULL, NULL, 'CBT-GR-1122-0016', NULL, NULL, 'atmi', '', '2022-11-15 07:00:00', '2022-11-15 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-14 15:00:36', '', NULL),
	(24, 12, 'CBT-IN-1122-0017', 'test_atmi', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2022-11-16 09:38:00', '2022-11-16 11:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-11-16 08:47:21', '', NULL),
	(25, 13, NULL, 'test_atmi', NULL, NULL, NULL, 'CBT-GR-1122-0017', NULL, NULL, 'atmi', '', '2022-11-16 14:00:00', '2022-11-16 15:50:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-11-16 09:25:31', '', NULL),
	(26, 12, 'CBT-IN-1022-0045', 'test_0411_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2022-11-16 13:25:00', '2022-11-16 15:25:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-11-16 13:25:33', '', NULL),
	(27, 8, NULL, NULL, 'CBT-08-1122-0002', NULL, NULL, NULL, NULL, NULL, 'agus', '', '2022-11-18 17:00:06', '2022-11-18 17:15:06', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-11-18 17:40:29', '', NULL),
	(28, 15, NULL, NULL, NULL, 'CBT-DCC-1122-0002', 'Count 1', NULL, NULL, NULL, 'agus', '', '2022-12-07 08:56:23', '2022-12-07 09:56:23', '2022-12-09 17:51:51', '2022-12-09 20:51:51', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-12-06 18:38:50', 'atmi', '2022-12-09 17:52:43'),
	(29, 15, NULL, NULL, NULL, 'CBT-DCC-1122-0002', 'Count 1', NULL, NULL, NULL, 'juang', '', '2022-12-07 08:56:23', '2022-12-07 09:56:23', '2022-12-09 17:51:51', '2022-12-09 20:51:51', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-12-07 14:13:40', 'atmi', '2022-12-09 17:52:43'),
	(30, 12, 'CBT-IN-1222-0014', 'test_exp', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2022-12-15 09:33:00', '2022-12-15 10:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 09:34:00', '', NULL),
	(31, 13, NULL, 'test_exp', NULL, NULL, NULL, 'CBT-GR-1222-0014', NULL, NULL, 'test_staff', '', '2022-12-15 10:58:00', '2022-12-15 11:58:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 10:58:18', '', NULL),
	(32, 12, 'CBT-IN-1222-0015', 'test_exp_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2022-12-15 11:48:00', '2022-12-15 00:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 11:48:59', '', NULL),
	(33, 13, NULL, 'test_exp_2', NULL, NULL, NULL, 'CBT-GR-1222-0015', NULL, NULL, 'test_staff', '', '2022-12-15 12:06:00', '2022-12-15 01:06:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 12:06:21', '', NULL),
	(34, 12, 'CBT-IN-1222-0016', 'test_exp_3', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2022-12-15 12:24:00', '2022-12-15 01:24:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 12:24:53', '', NULL),
	(35, 13, NULL, 'test_exp_3', NULL, NULL, NULL, 'CBT-GR-1222-0016', NULL, NULL, 'test_staff', '', '2022-12-15 12:58:00', '2022-12-15 01:58:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2022-12-15 12:58:28', '', NULL),
	(36, 12, 'CBT-IN-1222-0018', 'test29des22_1', NULL, NULL, NULL, NULL, NULL, NULL, 'rdarmawan', '', '2022-12-30 14:52:00', '2022-12-30 16:55:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'rdarmawan', '2022-12-30 14:52:21', '', NULL),
	(37, 12, 'CBT-IN-0123-0001', 'test_confirm', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-01-03 17:38:00', '2023-01-03 18:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-03 17:38:21', '', NULL),
	(38, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0001', 'count 1', NULL, NULL, NULL, 'agus', '', '2023-01-07 08:56:23', '2023-01-07 09:56:23', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-07 11:58:24', 'atmi', '2023-06-07 14:43:32'),
	(39, 13, NULL, 'test_confirm', NULL, NULL, NULL, 'CBT-GR-0123-0001', NULL, NULL, 'atmi', '', '2023-01-09 09:02:00', '2023-01-09 10:02:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-09 09:02:06', '', NULL),
	(40, 12, 'CBT-IN-0123-0002', 'test9jan2023_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-09 09:44:00', '2023-01-10 09:44:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-09 09:44:15', '', NULL),
	(41, 12, 'CBT-IN-0123-0003', 'test9jan2023_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-09 10:05:00', '2023-01-09 10:05:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-09 10:05:54', '', NULL),
	(42, 12, 'CBT-IN-0123-0004', 'test_input_090123', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-09 14:07:00', '2023-01-09 15:07:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-09 14:07:23', '', NULL),
	(43, 13, NULL, 'test_input_090123', NULL, NULL, NULL, 'CBT-GR-0123-0004', NULL, NULL, 'atmi', '', '2023-01-10 09:46:00', '2023-01-10 10:46:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-10 09:46:51', '', NULL),
	(44, 8, NULL, NULL, 'CBT-08-0123-0002', NULL, NULL, NULL, NULL, NULL, 'mariofrans_spv', '', '2023-01-01 23:55:00', '2023-01-11 11:55:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-11 13:04:28', '', NULL),
	(45, 12, 'CBT-IN-0123-0005', 'test12jan2023_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-01-12 10:11:00', '2023-01-13 10:11:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-12 10:11:44', '', NULL),
	(46, 13, NULL, 'test12jan2023_1', NULL, NULL, NULL, 'CBT-GR-0123-0005', NULL, NULL, 'test_admin', '', '2023-01-12 10:25:00', '2023-01-13 10:25:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-12 10:25:30', '', NULL),
	(47, 12, 'CBT-IN-0123-0006', 'test12jan2023_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-01-13 10:34:00', '2023-01-13 10:35:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-12 10:35:02', '', NULL),
	(48, 13, NULL, 'test12jan2023_2', NULL, NULL, NULL, 'CBT-GR-0123-0006', NULL, NULL, 'test_admin', '', '2023-01-13 10:47:00', '2023-01-14 10:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-12 10:47:48', '', NULL),
	(49, 12, 'CBT-IN-0123-0007', 'test_13jan22', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-13 09:47:00', '2023-01-13 09:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-13 09:48:05', '', NULL),
	(50, 12, 'CBT-IN-0123-0007', 'test_13jan22', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-13 09:47:00', '2023-01-13 09:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-13 09:48:05', '', NULL),
	(51, 13, NULL, 'test_13jan22', NULL, NULL, NULL, 'CBT-GR-0123-0007', NULL, NULL, 'atmi', '', '2023-01-13 10:48:00', '2023-01-13 11:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-13 11:01:50', '', NULL),
	(52, 13, NULL, 'test_13jan22', NULL, NULL, NULL, 'CBT-GR-0123-0007', NULL, NULL, 'test_staff', '', '2023-01-13 11:01:00', '2023-01-13 00:01:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-13 11:01:50', '', NULL),
	(53, 8, NULL, NULL, 'CBT-08-0123-0003', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-15 16:00:00', '2023-01-15 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-15 16:00:22', '', NULL),
	(54, 12, 'CBT-IN-0123-0008', 'TEST BUNGA', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-17 10:32:00', '2023-01-17 00:35:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-17 09:32:31', '', NULL),
	(55, 12, 'CBT-IN-0123-0009', 'TEST BUNGA', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-17 10:42:00', '2023-01-17 11:42:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-17 09:42:40', '', NULL),
	(56, 14, NULL, NULL, NULL, 'CBT-OPN-0123-0006', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-01-17 09:32:00', '2023-01-17 09:32:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-17 09:50:53', '', NULL),
	(57, 13, NULL, 'TEST BUNGA', NULL, NULL, NULL, 'CBT-GR-0123-0009', NULL, NULL, 'rdarmawan', '', '2023-01-17 09:55:00', '2023-01-02 11:54:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-17 09:54:50', '', NULL),
	(58, 13, NULL, 'TEST BUNGA', NULL, NULL, NULL, 'CBT-GR-0123-0008', NULL, NULL, 'atmi', '', '2023-01-18 14:15:00', '2023-01-05 14:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-17 14:14:39', '', NULL),
	(59, 8, NULL, NULL, 'CBT-08-0123-0011', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-18 10:11:00', '2023-01-19 10:11:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-18 10:11:31', '', NULL),
	(60, 12, 'CBT-IN-0123-0010', 'test19jan23_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-19 14:42:00', '2023-01-20 14:43:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-19 14:43:05', '', NULL),
	(61, 12, 'CBT-IN-0123-0012', 'test24jan2023_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-24 09:28:00', '2023-01-25 09:28:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 09:28:37', '', NULL),
	(62, 13, NULL, 'test24jan2023_1', NULL, NULL, NULL, 'CBT-GR-0123-0012', NULL, NULL, 'test_staff', '', '2023-01-24 09:31:00', '2023-01-25 09:31:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 09:31:06', '', NULL),
	(63, 8, NULL, NULL, 'CBT-08-0123-0013', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-24 09:35:00', '2023-01-25 09:35:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 09:35:41', '', NULL),
	(64, 8, NULL, NULL, 'CBT-08-0123-0014', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-01-24 10:00:00', '2023-01-25 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 10:00:33', '', NULL),
	(65, 14, NULL, NULL, NULL, 'CBT-OPN-0123-0007', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-01-24 15:15:00', '2023-01-25 15:16:00', '2023-06-08 14:35:10', '2023-06-08 14:35:32', NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 15:16:13', 'atmi', '2023-06-08 14:35:32'),
	(66, 14, NULL, NULL, NULL, 'CBT-OPN-0123-0007', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-01-24 15:16:00', '2023-01-25 15:16:00', '2023-06-08 14:35:10', '2023-06-08 14:35:32', NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-24 15:16:13', 'atmi', '2023-06-08 14:35:32'),
	(67, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0006', 'Count 1', NULL, NULL, NULL, 'test_admin', '', '2023-01-24 16:18:00', '2023-01-24 17:18:00', '2023-01-30 12:00:00', '2023-01-30 17:00:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-24 16:22:20', 'atmi', '2023-01-30 17:27:06'),
	(68, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0006', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-01-24 16:18:00', '2023-01-24 17:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-24 16:22:20', '', NULL),
	(69, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0006', 'Count 1', NULL, NULL, NULL, 'hari', '', '2023-01-24 16:19:00', '2023-01-24 17:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-24 16:22:20', '', NULL),
	(70, 12, 'CBT-IN-0123-0011', 'test_1901', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-01-24 17:19:00', '2023-01-24 17:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-24 17:19:57', '', NULL),
	(71, 14, NULL, NULL, NULL, 'CBT-OPN-0123-0010', 'Count 1', NULL, NULL, NULL, 'test_admin', '', '2023-01-30 16:58:00', '2023-01-31 16:59:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-30 16:59:04', '', NULL),
	(72, 14, NULL, NULL, NULL, 'CBT-OPN-0123-0010', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-01-30 16:58:00', '2023-01-31 16:59:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-01-30 16:59:04', '', NULL),
	(73, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0007', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-01-31 09:08:00', '2023-01-31 00:09:00', '2023-01-31 10:00:00', '2023-01-31 12:00:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-31 09:09:39', 'atmi', '2023-01-31 09:20:06'),
	(74, 15, NULL, NULL, NULL, 'CBT-DCC-0123-0007', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-01-31 09:09:00', '2023-01-31 00:09:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-01-31 09:09:39', '', NULL),
	(84, 14, NULL, NULL, NULL, 'CBT-OPN-0223-0004', 'Count 1', NULL, NULL, NULL, 'test_staff', '', '2023-02-03 14:52:00', '2023-02-04 14:52:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 14:53:44', 'test_staff', '2023-02-03 14:56:13'),
	(83, 14, NULL, NULL, NULL, 'CBT-OPN-0223-0004', 'Count 1', NULL, NULL, NULL, 'test_admin', '', '2023-02-03 14:52:00', '2023-02-04 14:52:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 14:54:09'),
	(77, 12, 'CBT-IN-0223-0002', 'test_0203', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-03 09:58:00', '2023-02-03 10:58:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 09:58:49', '', NULL),
	(78, 12, 'CBT-IN-0223-0002', 'test_0203', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-03 09:58:00', '2023-02-03 10:58:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 09:58:49', '', NULL),
	(79, 13, NULL, 'test_0203', NULL, NULL, NULL, 'CBT-GR-0223-0002', NULL, NULL, 'test_admin', '', '2023-02-03 10:26:00', '2023-02-03 11:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 10:26:49', '', NULL),
	(80, 13, NULL, 'test_0203', NULL, NULL, NULL, 'CBT-GR-0223-0002', NULL, NULL, 'test_staff', '', '2023-02-03 10:26:00', '2023-02-03 11:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 10:26:49', '', NULL),
	(81, 8, NULL, NULL, 'CBT-08-0223-0001', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-03 10:46:00', '2023-02-03 11:46:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 10:46:59', '', NULL),
	(82, 8, NULL, NULL, 'CBT-08-0223-0002', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-03 11:01:00', '2023-02-03 00:01:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-03 11:01:47', '', NULL),
	(85, 14, NULL, NULL, NULL, 'CBT-OPN-0223-0004', 'Count 2', NULL, NULL, NULL, 'test_admin', '', '2023-02-03 15:13:00', '2023-02-04 15:13:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:13:32'),
	(86, 14, NULL, NULL, NULL, 'CBT-OPN-0223-0004', 'Count 3', NULL, NULL, NULL, 'test_admin', '', '2023-02-03 15:14:00', '2023-02-04 15:14:00', '2023-02-03 15:15:00', '2023-02-04 15:15:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:31'),
	(87, 12, 'CBT-IN-0223-0001', 'test_0202', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-03 17:32:00', '2023-02-03 18:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 17:33:24', '', NULL),
	(88, 12, 'CBT-IN-0223-0001', 'test_0202', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-03 17:33:00', '2023-02-03 18:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-02-03 17:33:24', '', NULL),
	(89, 8, NULL, NULL, 'CBT-08-0223-0003', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-07 09:27:00', '2023-02-07 10:27:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-07 09:27:16', '', NULL),
	(90, 12, 'CBT-IN-0223-0003', 'test7feb23_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-07 13:31:00', '2023-02-08 13:31:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-02-07 13:31:36', '', NULL),
	(91, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-02-07 15:56:00', '2023-02-07 16:56:00', '2023-02-07 15:57:00', '2023-02-07 16:57:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-07 15:56:58', 'atmi', '2023-02-07 15:57:27'),
	(92, 14, NULL, NULL, NULL, 'CBT-OPN-0223-0005', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-02-07 15:59:00', '2023-02-07 18:59:00', '2023-02-07 16:00:00', '2023-02-07 18:00:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-07 16:00:02', 'atmi', '2023-02-07 16:00:35'),
	(93, 12, 'CBT-IN-0223-0004', 'TEST ISA', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-08 13:00:00', '2023-02-08 14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-02-08 11:22:18', '', NULL),
	(94, 13, NULL, 'TEST ISA', NULL, NULL, NULL, 'CBT-GR-0223-0004', NULL, NULL, 'atmi', '', '2023-02-08 00:47:00', '2023-02-08 00:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-08 11:47:48', '', NULL),
	(95, 13, NULL, 'TEST ISA', NULL, NULL, NULL, 'CBT-GR-0223-0004', NULL, NULL, 'rdarmawan', '', '2023-02-08 00:51:00', '2023-02-08 01:51:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-08 11:51:37', '', NULL),
	(96, 12, 'CBT-IN-0223-0005', 'test_bugfixing', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-08 14:27:00', '2023-02-08 15:27:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-08 14:28:21', '', NULL),
	(97, 12, 'CBT-IN-0223-0005', 'test_bugfixing', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-08 14:27:00', '2023-02-08 15:28:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-08 14:28:21', '', NULL),
	(98, 12, 'CBT-IN-0223-0006', 'TEST 2 -AKMALISA', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-08 15:20:00', '2023-02-08 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-08 15:20:28', '', NULL),
	(99, 13, NULL, 'TEST 2 -AKMALISA', NULL, NULL, NULL, 'CBT-GR-0223-0006', NULL, NULL, 'atmi', '', '2023-02-09 09:53:00', '2023-02-09 10:53:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 09:53:58', '', NULL),
	(100, 8, NULL, NULL, 'CBT-08-0223-0004', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-09 10:12:00', '2023-02-09 00:12:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 10:12:30', '', NULL),
	(101, 8, NULL, NULL, 'CBT-08-0223-0005', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-09 10:16:00', '2023-02-09 10:16:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 10:16:23', '', NULL),
	(102, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0003', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-02-09 15:21:00', '2023-02-09 17:22:00', '2023-07-03 15:27:36', '2023-07-03 15:27:43', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 15:23:34', 'atmi', '2023-07-03 15:27:43'),
	(103, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0003', 'Count 1', NULL, NULL, NULL, 'rdarmawan', '', '2023-02-09 15:22:00', '2023-02-09 17:22:00', '2023-07-03 15:27:36', '2023-07-03 15:27:43', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 15:23:34', 'atmi', '2023-07-03 15:27:43'),
	(104, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0003', 'Count 1', NULL, NULL, NULL, 'test_admin', '', '2023-02-09 15:22:00', '2023-02-09 18:22:00', '2023-07-03 15:27:36', '2023-07-03 15:27:43', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 15:23:34', 'atmi', '2023-07-03 15:27:43'),
	(105, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0004', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-02-09 15:29:00', '2023-02-09 15:29:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:22'),
	(106, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0004', 'Count 2', NULL, NULL, NULL, 'atmi', '', '2023-02-09 15:31:00', '2023-02-09 15:32:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:35'),
	(107, 12, 'CBT-IN-0223-0007', 'aaaa', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-09 16:32:00', '2023-02-09 16:32:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans_spv', '2023-02-09 16:32:24', '', NULL),
	(108, 12, 'CBT-IN-0223-0008', 'test10feb23_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-10 17:52:00', '2023-02-11 17:52:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-02-10 17:53:04', '', NULL),
	(109, 12, 'CBT-IN-0223-0008', 'test10feb23_1', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-10 17:52:00', '2023-02-11 17:53:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-02-10 17:53:04', '', NULL),
	(110, 12, 'CBT-IN-0223-0009', 'test_0312', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-13 13:36:00', '2023-02-13 14:36:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-13 13:36:40', '', NULL),
	(111, 12, 'CBT-IN-0223-0009', 'test_0312', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-13 13:36:00', '2023-02-13 14:36:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-13 13:36:40', '', NULL),
	(112, 12, 'CBT-IN-0223-0011', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-17 17:35:00', '2023-02-17 17:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-16 17:32:32', '', NULL),
	(113, 13, NULL, 'test', NULL, NULL, NULL, 'CBT-GR-0223-0011', NULL, NULL, 'atmi', '', '2023-02-17 17:42:00', '2023-02-17 17:45:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-16 17:40:14', '', NULL),
	(114, 12, 'CBT-IN-0223-0010', 'test_1502', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-21 08:57:00', '2023-02-22 08:57:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-02-21 08:57:40', '', NULL),
	(115, 12, 'CBT-IN-0223-0012', 'test_2102', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-21 11:23:00', '2023-02-21 00:23:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans_spv', '2023-02-21 11:24:01', '', NULL),
	(116, 12, 'CBT-IN-0223-0012', 'test_2102', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-21 11:23:00', '2023-02-21 00:23:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans_spv', '2023-02-21 11:24:01', '', NULL),
	(117, 12, 'CBT-IN-0223-0013', 'test_2302', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-23 09:09:00', '2023-02-23 10:09:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 09:10:20', '', NULL),
	(118, 12, 'CBT-IN-0223-0013', 'test_2302', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-23 09:10:00', '2023-02-23 10:10:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 09:10:20', '', NULL),
	(119, 12, 'CBT-IN-0223-0014', 'test_2303_2', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-23 15:47:00', '2023-02-23 15:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 14:48:18', '', NULL),
	(120, 12, 'CBT-IN-0223-0014', 'test_2303_2', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-02-23 14:48:00', '2023-02-23 15:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 14:48:18', '', NULL),
	(121, 12, 'CBT-IN-0223-0015', 'test_2302_03', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-23 16:36:00', '2023-02-23 17:36:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 16:37:34', '', NULL),
	(122, 12, 'CBT-IN-0223-0015', 'test_2302_03', NULL, NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-02-23 16:36:00', '2023-02-23 17:37:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 16:37:34', '', NULL),
	(123, 13, NULL, 'test_2302_03', NULL, NULL, NULL, 'CBT-GR-0223-0015', NULL, NULL, 'atmi', '', '2023-02-23 16:53:00', '2023-02-23 18:53:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 16:53:55', '', NULL),
	(124, 13, NULL, 'test_2302_03', NULL, NULL, NULL, 'CBT-GR-0223-0015', NULL, NULL, 'test_staff', '', '2023-02-23 17:54:00', '2023-02-23 18:54:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-23 16:54:38', '', NULL),
	(125, 8, NULL, NULL, 'CBT-08-0223-0008', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-24 09:00:00', '2023-02-24 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-24 09:01:04', '', NULL),
	(126, 8, NULL, NULL, 'CBT-08-0123-0007', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-02-27 09:56:00', '2023-02-27 10:56:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-27 09:57:52', '', NULL),
	(127, 15, NULL, NULL, NULL, 'CBT-DCC-0223-0002', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-02-27 11:27:00', '2023-02-28 11:27:00', '2023-07-03 15:28:00', '2023-07-03 15:28:09', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-02-27 11:27:35', 'atmi', '2023-07-03 15:28:09'),
	(128, 12, 'CBT-IN-0323-0001', 'adasfsfafa', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-04 12:00:00', '2023-03-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-02 10:58:26', '', NULL),
	(129, 12, 'CBT-IN-0323-0001', 'adasfsfafa', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-04 12:00:00', '2023-03-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-02 10:58:27', '', NULL),
	(130, 13, NULL, 'adasfsfafa', NULL, NULL, NULL, 'CBT-GR-0323-0001', NULL, NULL, 'atmi', '', '2023-03-18 23:17:00', '2023-03-18 23:17:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-18 23:17:56', '', NULL),
	(131, 12, 'CBT-IN-0323-0003', 'TEST RFC-2', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-20 15:32:00', '2023-03-20 16:32:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2023-03-20 14:32:22', '', NULL),
	(132, 13, NULL, 'TEST RFC-2', NULL, NULL, NULL, 'CBT-GR-0323-0003', NULL, NULL, 'atmi', '', '2023-03-20 15:46:00', '2023-03-20 16:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-20 14:46:51', '', NULL),
	(133, 8, NULL, NULL, 'CBT-08-0323-0002', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-20 16:56:00', '2023-03-20 16:56:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-20 15:57:05', '', NULL),
	(134, 15, NULL, NULL, NULL, 'CBT-DCC-0323-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-03-20 17:08:00', '2023-03-20 17:09:00', '2023-06-08 14:47:41', '2023-06-08 14:47:51', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-20 17:09:30', 'atmi', '2023-06-08 14:47:51'),
	(135, 15, NULL, NULL, NULL, 'CBT-DCC-0323-0002', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-03-20 17:18:00', '2023-03-20 19:19:00', '2023-03-20 17:21:00', '2023-03-20 19:21:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-20 17:20:00', 'atmi', '2023-03-20 17:22:39'),
	(136, 15, NULL, NULL, NULL, 'CBT-DCC-0323-0002', 'Count 1', NULL, NULL, NULL, 'test_admin', '', '2023-03-20 17:19:00', '2023-03-20 19:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:28:46'),
	(137, 12, 'CBT-IN-0323-0002', 'TEST-RFC 1', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-21 09:26:00', '2023-03-21 09:27:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-21 09:27:07', '', NULL),
	(138, 13, NULL, 'TEST-RFC 1', NULL, NULL, NULL, 'CBT-GR-0323-0002', NULL, NULL, 'atmi', '', '2023-03-21 09:29:00', '2023-03-21 09:29:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-21 09:29:34', '', NULL),
	(139, 12, 'CBT-IN-0323-0004', 'test_inbound_2403', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-24 15:01:00', '2023-03-24 15:01:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2023-03-24 15:01:53', '', NULL),
	(140, 13, NULL, 'test_inbound_2403', NULL, NULL, NULL, 'CBT-GR-0323-0004', NULL, NULL, 'atmi', '', '2023-03-24 15:52:00', '2023-03-24 15:52:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-24 15:52:35', '', NULL),
	(141, 12, 'CBT-IN-0323-0005', 'test_inbound_2703', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-27 13:48:00', '2023-03-27 17:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-27 13:48:22', '', NULL),
	(142, 13, NULL, 'test_inbound_2703', NULL, NULL, NULL, 'CBT-GR-0323-0005', NULL, NULL, 'atmi', '', '2023-03-27 14:02:00', '2023-03-27 17:02:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-27 14:02:34', '', NULL),
	(143, 8, NULL, NULL, 'CBT-08-0323-0004', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-03-30 18:14:00', '2023-03-31 16:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-03-30 15:15:08', '', NULL),
	(144, 14, NULL, NULL, NULL, 'CBT-OPN-0423-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-04-04 09:02:00', '2023-04-04 10:02:00', '2023-04-04 09:02:00', '2023-04-04 10:02:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-04 09:02:34', 'atmi', '2023-04-04 09:03:03'),
	(145, 12, 'CBT-IN-0423-0055', 'test_api', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-04 17:13:00', '2023-04-05 17:13:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'bunga', '2023-04-04 14:14:00', '', NULL),
	(146, 12, 'CBT-IN-0423-0001', 'RO0123', NULL, NULL, NULL, NULL, NULL, NULL, 'rdarmawan', '', '2023-04-05 18:00:00', '2023-04-05 22:20:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2023-04-04 14:21:46', '', NULL),
	(147, 12, 'CBT-IN-0423-0001', 'RO0123', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-04-05 18:00:00', '2023-04-05 23:21:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2023-04-04 14:21:46', '', NULL),
	(148, 13, NULL, 'RO0123', NULL, NULL, NULL, 'CBT-GR-0423-0001', NULL, NULL, 'test_admin', '', '2023-04-06 18:00:00', '2023-04-06 23:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-04-04 14:44:55', '', NULL),
	(149, 13, NULL, 'RO0123', NULL, NULL, NULL, 'CBT-GR-0423-0001', NULL, NULL, 'test_staff', '', '2023-04-06 17:48:00', '2023-04-06 13:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-04-04 14:48:54', '', NULL),
	(150, 8, NULL, NULL, 'CBT-08-0423-0001', NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-04-07 14:58:00', '2023-04-07 14:03:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-04-04 14:58:53', '', NULL),
	(151, 12, 'CBT-IN-0323-0007', 'awdawd', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-05 10:19:00', '2023-04-05 11:20:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-05 10:20:06', '', NULL),
	(152, 13, NULL, 'test_1502', NULL, NULL, NULL, 'CBT-GR-0223-0010', NULL, NULL, 'atmi', '', '2023-04-05 13:10:00', '2023-04-05 14:10:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-05 13:10:37', '', NULL),
	(153, 8, NULL, NULL, 'CBT-08-0323-0003', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-05 15:30:00', '2023-04-05 16:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-05 15:31:03', '', NULL),
	(154, 12, 'CBT-IN-0423-0057', 'test_api', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-06 08:31:00', '2023-04-06 09:31:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-06 08:31:57', '', NULL),
	(155, 12, 'CBT-IN-0423-0002', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-06 08:38:00', '2023-04-06 09:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-06 08:38:49', '', NULL),
	(156, 12, 'CBT-IN-0323-0049', '123', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-06 08:44:00', '2023-04-06 08:44:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-06 08:44:37', '', NULL),
	(157, 12, 'CBT-IN-0423-0003', 'Ref1234', NULL, NULL, NULL, NULL, NULL, NULL, 'test_admin', '', '2023-04-07 21:00:00', '2023-04-07 23:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-04-06 12:14:32', '', NULL),
	(158, 12, 'CBT-IN-0423-0003', 'Ref1234', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-07 22:00:00', '2023-04-07 12:16:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'test_admin', '2023-04-06 12:14:32', '', NULL),
	(159, 13, NULL, 'Ref1234', NULL, NULL, NULL, 'CBT-GR-0423-0003', NULL, NULL, 'test_admin', '', '2023-04-08 20:44:00', '2023-04-08 12:44:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-06 12:44:57', '', NULL),
	(160, 13, NULL, '123', NULL, NULL, NULL, 'CBT-GR-0323-0049', NULL, NULL, 'atmi', '', '2023-04-11 12:01:00', '2023-04-11 14:01:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-11 12:01:34', '', NULL),
	(161, 13, NULL, 'test', NULL, NULL, NULL, 'CBT-GR-0423-0002', NULL, NULL, 'atmi', '', '2023-04-13 11:48:00', '2023-04-13 00:48:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-13 11:48:21', '', NULL),
	(162, 8, NULL, NULL, 'CBT-08-0423-0004', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-14 09:11:00', '2023-04-14 10:11:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-14 09:11:58', '', NULL),
	(163, 8, NULL, NULL, 'CBT-08-0423-0004', NULL, NULL, NULL, NULL, NULL, 'test_staff', '', '2023-04-14 09:11:00', '2023-04-14 10:11:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-14 09:11:58', '', NULL),
	(164, 12, 'CBT-IN-0423-0004', 'test_1704', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-17 14:38:00', '2023-04-17 14:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-17 14:38:31', '', NULL),
	(165, 8, NULL, NULL, 'CBT-08-0423-0003', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-19 11:07:00', '2023-04-19 11:07:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-19 11:07:38', '', NULL),
	(166, 8, NULL, NULL, 'CBT-08-0423-0002', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-04-19 11:15:00', '2023-04-19 11:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-04-19 11:15:27', '', NULL),
	(167, 15, NULL, NULL, NULL, 'CBT-DCC-0523-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-05-03 15:00:00', '2023-05-03 15:00:00', '2023-05-03 16:07:00', '2023-05-03 18:07:00', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-03 15:00:29', 'atmi', '2023-05-03 15:07:46'),
	(168, 8, NULL, NULL, 'CBT-08-0523-0003', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-04 14:19:00', '2023-05-04 15:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-04 14:19:20', '', NULL),
	(169, 8, NULL, NULL, 'CBT-08-0523-0006', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-12 15:19:00', '2023-05-12 15:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-12 15:19:58', '', NULL),
	(170, 12, 'CBT-IN-0523-0002', 'test_21_05', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-21 13:36:00', '2023-05-21 13:36:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-21 13:36:34', '', NULL),
	(171, 12, 'CBT-IN-0523-0003', 'test_partial_2205', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-22 09:33:00', '2023-05-22 09:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-22 09:33:37', '', NULL),
	(172, 8, NULL, NULL, 'CBT-08-0523-0005', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-23 09:28:00', '2023-05-23 09:28:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-23 09:28:45', '', NULL),
	(173, 12, 'CBT-IN-0523-0004', 'test_inbound_2405', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-24 11:47:00', '2023-05-24 11:47:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-24 11:47:34', '', NULL),
	(174, 12, 'CBT-IN-0523-0001', 'test_19mei23_1', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-05-24 14:38:00', '2023-05-24 14:38:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-24 14:38:40', '', NULL),
	(175, 24, NULL, 'RET_001', NULL, NULL, NULL, NULL, 'CBT-GRR-0523-0001', NULL, 'atmi', '', '2023-05-25 09:35:00', '2023-05-25 12:35:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-24 18:36:13', '', NULL),
	(176, 13, NULL, 'test_inbound_2405', NULL, NULL, NULL, 'CBT-GR-0523-0004', NULL, NULL, 'atmi', '', '2023-05-25 21:36:00', '2023-05-25 12:37:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-24 18:37:08', '', NULL),
	(177, 13, NULL, 'test_1704', NULL, NULL, NULL, 'CBT-GR-0423-0004', NULL, NULL, 'atmi', '', '2023-05-26 10:20:00', '2023-05-26 10:20:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-05-26 10:20:45', '', NULL),
	(178, 12, 'CBT-IN-0423-0057', 'test_api', NULL, NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-06-07 09:42:00', '2023-06-07 10:42:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-06-07 09:43:05', '', NULL),
	(179, 13, NULL, 'test_partial_2205', NULL, NULL, NULL, 'CBT-GR-0523-0003', NULL, NULL, 'atmi', '', '2023-06-07 10:03:00', '2023-06-07 10:03:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-06-07 10:03:34', '', NULL),
	(180, 8, NULL, NULL, 'CBT-08-0423-0005', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-06-13 10:40:00', '2023-06-13 10:40:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-06-13 10:44:05', '', NULL),
	(181, 15, NULL, NULL, NULL, 'CBT-DCC-0323-0003', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-06-13 14:59:00', '2023-06-13 14:59:00', '2023-06-13 17:42:28', '2023-06-13 17:43:40', NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:43:40'),
	(182, 15, NULL, NULL, NULL, 'CBT-DCC-0623-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-06-13 15:02:00', '2023-06-13 15:02:00', '2023-06-13 17:36:25', '2023-06-13 17:40:48', NULL, NULL, NULL, NULL, 'Y', 'N', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:40:48'),
	(183, 15, NULL, NULL, NULL, 'CBT-DCC-0623-0002', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-06-13 17:46:00', '2023-06-13 17:46:00', '2023-06-13 17:46:52', '2023-06-13 17:47:15', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-06-13 17:46:43', 'atmi', '2023-06-13 17:47:15'),
	(184, 14, NULL, NULL, NULL, 'CBT-OPN-0623-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-06-13 17:52:00', '2023-06-13 17:52:00', '2023-07-03 15:28:26', '2023-07-03 15:28:30', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-06-13 17:52:51', 'atmi', '2023-07-03 15:28:30'),
	(185, 8, NULL, NULL, 'CBT-08-0523-0004', NULL, NULL, NULL, NULL, NULL, 'atmi', '', '2023-07-03 16:33:00', '2023-07-03 21:57:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-07-03 16:33:40', '', NULL),
	(186, 15, NULL, NULL, NULL, 'CBT-DCC-0423-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-07-03 16:47:00', '2023-07-04 20:47:00', '2023-07-03 20:12:27', '2023-07-03 20:12:35', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-07-03 16:47:45', 'atmi', '2023-07-03 20:12:35'),
	(187, 14, NULL, NULL, NULL, 'CBT-OPN-0723-0001', 'Count 1', NULL, NULL, NULL, 'atmi', '', '2023-07-03 16:57:00', '2023-07-05 20:57:00', '2023-07-03 20:21:35', '2023-07-03 20:22:05', NULL, NULL, NULL, NULL, 'Y', 'N', 'atmi', '2023-07-03 16:58:05', 'atmi', '2023-07-03 20:22:05'),
	(188, 13, NULL, 'PO123456', NULL, NULL, NULL, 'CBT-GR-0724-0001', NULL, NULL, 'whsman01', '', '2024-08-26 11:30:00', '2024-08-26 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 10:31:31', '', NULL),
	(189, 12, 'CBT-IN-0824-0001', 'PO123', NULL, NULL, NULL, NULL, NULL, NULL, 'whsman01', '', '2024-08-26 10:31:00', '2024-08-26 11:31:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 10:32:17', '', NULL),
	(190, 12, 'CBT-IN-0824-0001', 'PO123', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-08-26 10:31:00', '2024-08-26 11:31:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 10:32:50', '', NULL),
	(191, 13, NULL, 'PO123456', NULL, NULL, NULL, 'CBT-GR-0724-0001', NULL, NULL, 'whsman01', '', '2024-08-26 10:55:00', '2024-08-26 23:55:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 10:58:02', '', NULL),
	(192, 13, NULL, 'PO123', NULL, NULL, NULL, 'CBT-GR-0824-0001', NULL, NULL, 'whsman01', '', '2024-08-26 13:45:00', '2024-08-26 15:44:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 13:45:34', '', NULL),
	(193, 12, 'CBT-IN-0623-0003', 'test_2', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-08-26 09:51:00', '2024-08-26 10:51:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 13:52:41', '', NULL),
	(194, 13, NULL, 'test_2', NULL, NULL, NULL, 'CBT-GR-0623-0003', NULL, NULL, 'whsman01', '', '2024-08-26 10:26:00', '2024-08-26 11:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-26 14:27:25', '', NULL),
	(195, 12, 'CBT-IN-0623-0002', 'test_inbound', NULL, NULL, NULL, NULL, NULL, NULL, 'whsman01', '', '2024-08-27 08:18:00', '2024-08-27 17:18:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-27 16:19:36', '', NULL),
	(196, 12, 'CBT-IN-0623-0002', 'test_inbound', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-08-27 16:19:00', '2024-08-27 16:19:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-27 16:20:06', '', NULL),
	(197, 13, NULL, 'test_inbound', NULL, NULL, NULL, 'CBT-GR-0623-0002', NULL, NULL, 'whsman01', '', '2024-08-27 16:26:00', '2024-08-27 16:26:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-27 16:27:05', '', NULL),
	(198, 12, 'CBT-IN-0824-0002', 'PO240808001', NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', '', '2024-08-28 08:33:00', '2024-08-28 10:33:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-28 11:34:46', '', NULL),
	(199, 13, NULL, 'PO240808001', NULL, NULL, NULL, 'CBT-GR-0824-0002', NULL, NULL, 'whsman01', '', '2024-08-28 11:41:00', '2024-08-28 13:41:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-28 11:42:44', '', NULL),
	(200, 13, NULL, 'test_outbound_2501_2', NULL, NULL, NULL, NULL, 'CBT-GRR-0623-0009', NULL, 'whsman01', '', '2024-08-28 11:46:00', '2024-08-28 11:46:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-28 11:47:36', '', NULL),
	(201, 8, NULL, NULL, 'CBT-08-0824-0001', NULL, NULL, NULL, NULL, NULL, 'whsman01', '', '2024-08-28 15:49:00', '2024-08-28 15:49:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-28 15:49:56', '', NULL),
	(202, 8, NULL, NULL, 'CBT-08-0824-0002', NULL, NULL, NULL, NULL, NULL, 'whsman01', '', '2024-08-28 15:51:00', '2024-08-28 15:51:00', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', 'superadmin', '2024-08-28 15:52:47', '', NULL);
/*!40000 ALTER TABLE `t_wh_activity` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_activity_2
DROP TABLE IF EXISTS `t_wh_activity_2`;
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
DROP TABLE IF EXISTS `t_wh_adjustment`;
CREATE TABLE IF NOT EXISTS `t_wh_adjustment` (
  `adjustment_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) DEFAULT 0,
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
INSERT INTO `t_wh_adjustment` (`adjustment_id`, `client_project_id`, `adjustment_code`, `reason`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-ADIN-1122-0001', 1, 'ADIN', 'Permintaan SPV', 'OIN', 'atmi', '2022-11-22 16:58:38', '', NULL),
	('CBT-ADOUT-1122-0001', 1, 'ADOUT', 'Salah Hitung', 'OOT', 'atmi', '2022-11-22 16:58:46', '', NULL),
	('CBT-ADOUT-1122-0002', 1, 'ADOUT', 'Request Supervisor', 'CAI', 'atmi', '2022-11-24 09:36:31', 'atmi', '2022-11-24 15:33:42'),
	('CBT-ADOUT-0123-0002', 1, 'ADOUT', 'test06jan23_1', 'CAO', 'mariofrans', '2023-01-06 11:07:12', 'mariofrans', '2023-01-06 14:08:17'),
	('CBT-ADIN-0123-0002', 1, 'ADIN', 'test06jan23_2', 'CAI', 'mariofrans', '2023-01-06 13:14:08', 'mariofrans', '2023-01-06 14:08:21'),
	('CBT-ADIN-0123-0003', 1, 'ADIN', 'barang kelebihan kirim', 'CAI', 'mariofrans', '2023-01-06 15:09:49', 'mariofrans', '2023-01-06 15:23:22'),
	('CBT-ADOUT-0123-0003', 1, 'ADOUT', 'barang kelebihan input', 'CAO', 'mariofrans', '2023-01-06 15:12:08', 'mariofrans', '2023-01-06 15:22:40'),
	('CBT-ADOUT-0123-0004', 1, 'ADOUT', 'test06jan23_4', 'OOT', 'mariofrans', '2023-01-06 15:19:50', '', NULL),
	('CBT-ADIN-0123-0006', 1, 'ADIN', 'test06jan23_3', 'OIN', 'mariofrans', '2023-01-06 15:19:30', '', NULL),
	('CBT-ADOUT-0123-0005', 1, 'ADOUT', 'test adjustment_1501', 'CAO', 'atmi', '2023-01-15 17:39:19', 'atmi', '2023-01-15 17:39:40'),
	('CBT-ADIN-0223-0001', 1, 'ADIN', 'abis dipake nonton bola', 'OIN', 'atmi', '2023-02-03 11:26:09', '', NULL),
	('CBT-ADIN-0223-0002', 1, 'ADIN', 'Misscounting', 'CAI', 'atmi', '2023-02-09 14:28:22', 'atmi', '2023-02-09 14:28:36'),
	('CBT-ADOUT-0323-0001', 1, 'ADOUT', 'MISS GR (EXCESS)', 'CAO', 'atmi', '2023-03-20 17:00:05', 'atmi', '2023-03-20 17:01:44'),
	('CBT-ADIN-0323-0001', 1, 'ADIN', 'test_adin_2803', 'CAI', 'superadmin', '2023-03-28 09:12:39', 'superadmin', '2023-03-28 09:12:51');
/*!40000 ALTER TABLE `t_wh_adjustment` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_adjustment_detail
DROP TABLE IF EXISTS `t_wh_adjustment_detail`;
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
DROP TABLE IF EXISTS `t_wh_checking`;
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

-- Dumping data for table wms.t_wh_checking: 29 rows
/*!40000 ALTER TABLE `t_wh_checking` DISABLE KEYS */;
INSERT INTO `t_wh_checking` (`outbound_planning_no`, `bucket_id`, `carton_id`, `status_id`, `checker`, `cancel_reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-OUT-1222-0019', 'RPX123', '1', 'CHC', 'rdarmawan', NULL, 'mariofrans', '2022-12-31 20:19:57', ' ', '2022-12-31 20:18:53'),
	('CBT-OUT-1122-0001', '', '', 'UNC', NULL, NULL, 'rdarmawan', '2022-12-22 10:31:15', '', NULL),
	('CBT-OUT-1222-0024', '', '', 'UNC', NULL, NULL, 'mariofrans', '2022-12-24 13:56:16', 'mariofrans', '2022-12-24 13:57:47'),
	('CBT-OUT-1222-0025', '', '', 'UNC', NULL, NULL, 'rdarmawan', '2022-12-24 14:16:06', 'rdarmawan', '2022-12-24 14:17:11'),
	('CBT-OUT-1222-0026', '', '', 'UNC', NULL, NULL, 'rdarmawan', '2023-01-05 18:43:19', 'rdarmawan', '2022-12-26 09:45:18'),
	('CBT-OUT-0123-0001', '555', '1', 'UNC', 'mariofrans_spv', NULL, 'rdarmawan', '2023-01-10 16:05:26', 'mariofrans', '2023-01-12 09:55:47'),
	('CBT-OUT-0123-0002', '333', '', 'UNC', NULL, NULL, 'rdarmawan', '2023-01-10 16:24:20', '', NULL),
	('CBT-OUT-0123-0003', 'test12jan23_4', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-01-12 14:07:34', 'mariofrans', '2023-01-12 14:39:02'),
	('CBT-OUT-0123-0006', 'bucket123', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-01-17 09:31:10', 'mariofrans_spv', '2023-01-17 09:32:56'),
	('CBT-OUT-0123-0008', 'test_outbound_2501_2', '11', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-01-25 09:50:46', 'mariofrans_spv', '2023-01-25 09:52:56'),
	('CBT-OUT-0223-0002', 'test_123', '2', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-03 11:54:16', 'atmi', '2023-02-03 15:39:25'),
	('CBT-OUT-0223-0004', 'test_0702', '2', 'UNC', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-07 18:25:10', 'mariofrans_spv', '2023-02-07 18:27:47'),
	('CBT-OUT-0223-0005', '123_by_AKMAL', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-09 16:43:11', 'mariofrans_spv', '2023-02-09 17:07:20'),
	('CBT-OUT-0223-0008', '123', '1', 'UNC', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-15 14:02:35', 'mariofrans_spv', '2023-02-15 14:11:02'),
	('CBT-OUT-0223-0009', '456', '1', 'UNC', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-21 10:45:13', 'mariofrans_spv', '2023-02-21 10:59:05'),
	('CBT-OUT-0123-0005', '1', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-28 10:23:35', 'mariofrans_spv', '2023-02-28 10:29:33'),
	('CBT-OUT-0223-0010', '12', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-02-28 14:40:31', 'mariofrans_spv', '2023-02-28 17:00:21'),
	('CBT-OUT-0323-0003', 'RFC012', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-03-20 17:59:34', 'mariofrans_spv', '2023-03-20 18:16:38'),
	('CBT-OUT-0323-0004', '111', '1', 'UNC', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-03-24 11:22:27', 'atmi', '2023-03-24 11:42:00'),
	('CBT-OUT-0423-0001', 'BO0123', '', 'UNC', NULL, NULL, 'mariofrans_spv', '2023-04-04 15:24:23', '', NULL),
	('CBT-OUT-0423-0002', '123', '1', 'UNC', 'atmi', NULL, 'mariofrans_spv', '2023-04-06 13:50:38', 'atmi', '2023-04-06 13:51:51'),
	('CBT-OUT-0423-0003', '12', 'ABC123', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-04-06 14:12:35', 'mariofrans_spv', '2023-04-06 14:35:51'),
	('CBT-OUT-0423-0007', 'ABC123', '', 'UNC', NULL, NULL, 'mariofrans_spv', '2023-04-17 11:39:47', '', NULL),
	('CBT-OUT-0523-0001', 'abc123', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-05-09 13:38:53', 'mariofrans_spv', '2023-05-09 13:54:46'),
	('CBT-OUT-0523-0002', '12', '1', 'UNC', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-05-09 14:44:02', 'mariofrans_spv', '2023-05-09 15:25:55'),
	('CBT-OUT-0623-0001', 'test123', '1', 'CHE', 'mariofrans', NULL, 'mariofrans_spv', '2023-06-13 16:39:48', 'mariofrans', '2023-06-13 16:41:36'),
	('CBT-OUT-0623-0002', 'test02', '', 'UNC', NULL, NULL, 'mariofrans_spv', '2023-06-13 17:19:06', '', NULL),
	('CBT-OUT-0623-0004', '123', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-06-30 10:22:16', 'mariofrans_spv', '2023-06-30 10:22:42'),
	('CBT-OUT-0623-0003', '123', '1', 'CHE', 'mariofrans_spv', NULL, 'mariofrans_spv', '2023-06-30 14:56:11', 'mariofrans_spv', '2023-06-30 14:58:21');
/*!40000 ALTER TABLE `t_wh_checking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_attachment
DROP TABLE IF EXISTS `t_wh_checking_attachment`;
CREATE TABLE IF NOT EXISTS `t_wh_checking_attachment` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `user_created` varchar(25) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`,`order_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_checking_attachment: 5 rows
/*!40000 ALTER TABLE `t_wh_checking_attachment` DISABLE KEYS */;
INSERT INTO `t_wh_checking_attachment` (`outbound_planning_no`, `img_url`, `description`, `order_id`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1222-0019', 'https://static.rpx.co.id/wms_web_dev/checking/wxuW0HYOsyAL92o0aV5UA5BQIPQfutSqdYRbAm4R.jpg', 'aa', 1, 'rdarmawan', '2023-01-03 15:32:40'),
	('CBT-OUT-1222-0019', 'https://static.rpx.co.id/wms_web_dev/checking/MPSghfo6IscLf6icDsxorzO5CLkZWfXDodLVDTUZ.png', 'rr', 3, 'rdarmawan', '2023-01-03 15:32:40'),
	('CBT-OUT-0123-0001', 'https://static.rpx.co.id/wms_web_dev/checking/1rkrtLU3LyAhamXx04i4GbxhRMJOSyiw1eTiw33G.jpg', 'Logo RPX', 1, 'rdarmawan', '2023-01-10 13:20:06'),
	('CBT-OUT-0123-0001', 'https://static.rpx.co.id/wms_web_dev/checking/mrpnmKFGwdVLxBQMX933B9RekeQCFrZgo0LS9bXn.jpg', 'Sukron', 2, 'rdarmawan', '2023-01-10 13:20:06'),
	('CBT-OUT-0123-0001', 'https://static.rpx.co.id/wms_web_dev/checking/akpBjcjKCYzEp8I2g2f3MbyvjW2cds4dWfN4dYz6.png', 'Icon', 3, 'rdarmawan', '2023-01-10 13:20:06');
/*!40000 ALTER TABLE `t_wh_checking_attachment` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_detail
DROP TABLE IF EXISTS `t_wh_checking_detail`;
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

-- Dumping data for table wms.t_wh_checking_detail: 2 rows
/*!40000 ALTER TABLE `t_wh_checking_detail` DISABLE KEYS */;
INSERT INTO `t_wh_checking_detail` (`outbound_planning_no`, `sku`, `batch_no`, `serial_no`, `expired_date`, `gr_id`, `location_id`, `stock_id`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1222-0019', '112233446', '20200606', '00012', '2023-06-06', '', 'RF08-01', 'AV', '', NULL),
	('CBT-OUT-1222-0019', '112233446', '20201201', '00013', '2023-12-01', '', 'RC09-01', 'AV', '', NULL);
/*!40000 ALTER TABLE `t_wh_checking_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_checking_transport_loading
DROP TABLE IF EXISTS `t_wh_checking_transport_loading`;
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

-- Dumping data for table wms.t_wh_checking_transport_loading: 37 rows
/*!40000 ALTER TABLE `t_wh_checking_transport_loading` DISABLE KEYS */;
INSERT INTO `t_wh_checking_transport_loading` (`outbound_planning_no`, `supervisor_id`, `vehicle_id`, `transporter_id`, `service_id`, `start_loading`, `finish_loading`, `driver`, `vehicle_no`, `container_no`, `seal_no`, `consignee_name`, `consignee_address`, `consignee_city`, `remark`, `phone_no`, `awb`, `image_awb`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1222-0019', 'sugeng', 1, 1, 1, '2023-01-02 15:21:50', '2023-01-02 15:59:55', 'parman', 'B1234TES', '123', 'RPX123A', 'Akmal', 'Nama jalan rumahnya', 'Jakarta Barat', 'Jangan Dibanting', '08123456789', NULL, NULL, 'rdarmawan', '2023-01-03 15:23:47'),
	('CBT-OUT-0123-0001', 'sugeng', 1, 3, 1, NULL, NULL, 'Jono', 'B 6781 YUI', '66', '77', 'Robby Darmawan', 'Jonggol Raya Jaya', 'Bogor', 'Hati2 barang bagus', '08988667711', NULL, NULL, 'mariofrans', '2023-01-12 09:55:47'),
	('CBT-OUT-0123-0003', 'sugeng', 1, 3, 1, '2023-01-12 14:38:00', '2023-01-13 14:38:00', 'test Driver', 'b123s', 'test Container No', 'test Seal No', 'test Consignee Name', 'test Consignee Address', 'test Consignee City', 'test', '12345', NULL, NULL, 'mariofrans', '2023-01-12 14:39:02'),
	('CBT-OUT-0123-0006', 'robby', 7, 2, 2, NULL, NULL, 'ucup', 'b1234tes', '123', '123', 'igan', 'jalan ke rumahnya', 'jakarta', NULL, '081234567891', NULL, NULL, 'mariofrans_spv', '2023-01-17 09:32:56'),
	('CBT-OUT-0123-0008', 'sugeng', 1, 1, 1, NULL, NULL, 'ceo', 'b1234s', '123', '123', 'ari', 'jln a no 123', 'jakarta', NULL, '123456789', NULL, NULL, 'mariofrans_spv', '2023-01-25 09:52:56'),
	('CBT-OUT-0223-0002', 'sugeng', 1, 1, 1, NULL, NULL, 'urip', 'b1234kl', '1234', '1234', 'piru', 'jln ke depan', 'Jakarta', NULL, '0123456789', NULL, NULL, 'atmi', '2023-02-03 15:39:25'),
	('CBT-OUT-0223-0004', 'sugeng', 1, 1, 1, NULL, NULL, 'deni', 'b234gd', '234', '133', 'dani', 'pondok pinang raya', 'jakarta selatan', 'jangan dibanting', '082648621597', NULL, NULL, 'mariofrans_spv', '2023-02-07 18:27:47'),
	('CBT-OUT-0223-0005', 'sugeng', 2, 2, 2, NULL, NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', NULL, NULL, 'mariofrans_spv', '2023-02-09 17:07:20'),
	('CBT-OUT-0223-0008', 'sugeng', 1, 1, 1, NULL, NULL, 'ucok', 'b2356ef', '456', '456', 'dimas', 'jalan ina jadulu', 'jakarta', 'jangan dibantinfg soalnya rapuh', '084523697521', NULL, NULL, 'mariofrans_spv', '2023-02-15 14:11:02'),
	('CBT-OUT-0223-0009', 'robby', 1, 1, 1, NULL, NULL, 'gumi', 'b1234jk', '123', '456', 'ratu', 'jalan atas', 'depok', NULL, '081245876325', NULL, NULL, 'mariofrans_spv', '2023-02-21 10:59:05'),
	('CBT-OUT-0123-0005', 'sugeng', 1, 3, 2, NULL, NULL, 's', 'b2341sd', NULL, NULL, 'd', 'jln x', 'jakarta', NULL, '081265482364', NULL, NULL, 'mariofrans_spv', '2023-02-28 10:29:33'),
	('CBT-OUT-0223-0010', 'sugeng', 1, 1, 1, NULL, NULL, 'q', 'b2342d', NULL, NULL, 's', 'w', 'f', NULL, '123', NULL, NULL, 'mariofrans_spv', '2023-02-28 17:00:21'),
	('CBT-OUT-0323-0003', 'sugeng', 6, 3, 3, NULL, NULL, 'AKMAL', 'AAA123', NULL, NULL, 'TIWI', 'RPX CENTER', 'JAKARTA', NULL, '08123413xxxx', NULL, NULL, 'mariofrans_spv', '2023-03-20 18:16:38'),
	('CBT-OUT-0323-0004', 'sugeng', 1, 1, 1, NULL, NULL, 'b', 'b123r', '1', '1', 'a', 'a', 'a', NULL, '1', NULL, NULL, 'atmi', '2023-03-24 11:42:00'),
	('CBT-OUT-0323-0005', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '12312', '123123', '12312', NULL, '1231231', NULL, NULL, 'atmi', '2023-03-30 15:31:44'),
	('CBT-OUT-0423-0001', 'sugeng', 1, 1, 3, NULL, NULL, 'v', '1', '1', '1', 'PT Cahaya Abadi', 'Jl. Kebayoran', 'Jakarta', 'Test Outbound', '089272222', NULL, NULL, 'test_admin', '2023-04-04 15:17:25'),
	('CBT-OUT-0423-0002', 'sugeng', 1, 1, 1, NULL, NULL, 'd', '1', '1', '1', 's', 'a', 'd', NULL, '1', NULL, NULL, 'atmi', '2023-04-06 14:16:00'),
	('CBT-OUT-0423-0003', 'sugeng', 1, 1, 1, NULL, NULL, 'f', '1', '1', '1', 'f', 'w', 'f', NULL, '2', NULL, NULL, 'atmi', '2023-04-06 14:24:16'),
	('CBT-OUT-0423-0004', 'sugeng', 1, 1, 1, NULL, NULL, 'a', '2', '2', '2', 'a', 'a', 'a', NULL, '1', NULL, NULL, 'atmi', '2023-04-10 10:30:01'),
	('CBT-OUT-0423-0005', 'sugeng', 3, 3, 3, NULL, NULL, 'z', '4', NULL, NULL, 'g', 'd', 'e', NULL, '4', NULL, NULL, 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0006', 'sugeng', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'ayu', 'jalan samping no 20', 'jakarta', 'makanan', '0123456789', NULL, NULL, 'atmi', '2023-04-13 09:57:06'),
	('CBT-OUT-0423-0007', 'sugeng', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'doni', 'jalan panjang', 'medan', NULL, '0123456789', NULL, NULL, 'atmi', '2023-04-17 08:54:51'),
	('CBT-OUT-0423-0008', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 'a', 'a', NULL, '2', NULL, NULL, 'atmi', '2023-04-20 10:15:04'),
	('CBT-OUT-0423-0045', NULL, 0, 0, 0, NULL, NULL, 'joni', 'b1234sd', '12', 'asd212', 'hilda', 'jalan merdeka no 12', 'Bekasi', 'Jangan dibanting', '081234567891', 'RPX123', 'asdfghjkl', 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0046', NULL, 0, 0, 0, NULL, NULL, 'joni', 'b1234sd', '12', 'asd212', 'hilda', 'jalan merdeka no 12', 'Bekasi', 'Jangan dibanting', '081234567891', 'RPX123', 'asdfghjkl', 'demo', '2023-04-25 15:31:26'),
	('CBT-OUT-0523-0002', 'sugeng', 1, 1, 1, NULL, NULL, 'abdul', 'b1234bs', NULL, NULL, 'somad', 'jalan panjang', 'bogor', NULL, '12234567890', NULL, NULL, 'mariofrans_spv', '2023-05-09 14:31:03'),
	('CBT-OUT-0523-0001', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test', 'Jakarta', NULL, '0123456789', NULL, NULL, 'atmi', '2023-05-09 11:23:02'),
	('CBT-OUT-0523-0003', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 'a', 'a', NULL, '1', NULL, NULL, 'mariofrans_spv', '2023-05-09 15:49:05'),
	('CBT-OUT-0523-0004', 'sugeng', 1, 1, 1, NULL, NULL, 'a', 'b1234a', '1', '1', 'a', 'a', 'a', 'a', '1', NULL, NULL, 'atmi', '2023-05-11 10:01:03'),
	('CBT-OUT-0523-0005', 'sugeng', 1, 2, 3, NULL, NULL, 'a', '1', '1', '1', 'd', 'd', 'd', 'd', '1', NULL, NULL, 'atmi', '2023-05-11 14:03:02'),
	('CBT-OUT-0523-0006', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'a', 'a', 'a', NULL, '1', NULL, NULL, 'atmi', '2023-05-24 19:05:56'),
	('CBT-OUT-0623-0001', 'robby', 1, 1, 1, '2023-06-13 16:16:00', '2023-06-13 16:16:00', 'a', 'b1234s', '1', '1', 'a', 'a', 'a', 'a', '1', NULL, NULL, 'mariofrans', '2023-06-13 16:17:18'),
	('CBT-OUT-0623-0002', 'robby', 1, 1, 1, '2023-06-13 17:14:00', '2023-06-13 17:14:00', 'a', '1', '1', '1', 'a', 'a', 'a', NULL, '1', NULL, NULL, 'mariofrans', '2023-06-13 17:14:37'),
	('CBT-OUT-0623-0003', NULL, 1, 1, 1, NULL, NULL, 'a', '1', '1', '1', 'a', 'a', 'a', 'a', '1', NULL, NULL, 'atmi', '2023-06-27 11:08:56'),
	('CBT-OUT-0623-0004', NULL, 1, 1, 3, NULL, NULL, 's', '1', '1', '1', 's', 'a', 's', NULL, '5', NULL, NULL, 'atmi', '2023-06-30 10:06:00'),
	('CBT-OUT-0623-0005', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 's', 'd', 'q', NULL, '2', NULL, NULL, 'atmi', '2023-06-30 10:07:29'),
	('CBT-OUT-0623-0006', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'd', 'q', 'd', NULL, '1', NULL, NULL, 'mariofrans_spv', '2023-06-30 10:16:44');
/*!40000 ALTER TABLE `t_wh_checking_transport_loading` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_count_qty
DROP TABLE IF EXISTS `t_wh_count_qty`;
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
) ENGINE=MyISAM AUTO_INCREMENT=578 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_count_qty: 561 rows
/*!40000 ALTER TABLE `t_wh_count_qty` DISABLE KEYS */;
INSERT INTO `t_wh_count_qty` (`count_id`, `activity_id`, `location_id`, `sku`, `item_name`, `batch_no`, `serial_no`, `expired_date`, `qty_count`, `discrepancy`, `percentage`, `uom_name`, `stock_id`, `gr_id`, `count_status`, `counter`, `user_created`, `datetime_created`) VALUES
	(1, 28, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 20, 0, 100, 'PIECES', '', '', 'Balance', 'agus', 'atmi', '2022-12-12 17:25:59'),
	(2, 29, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 79, 1, 99, 'PIECES', '', '', 'Loss', 'juang', 'atmi', '2022-12-12 17:28:09'),
	(4, 38, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 100, 'PIECES', 'AV', 'CBT-GR-1222-0014', 'Balance', 'agus', 'atmi', '2023-01-07 21:20:26'),
	(5, 67, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'test_admin', 'test_admin', '2023-01-25 11:11:49'),
	(6, 71, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'test_admin', 'mariofrans', '2023-01-30 16:59:04'),
	(7, 71, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'test_admin', 'mariofrans', '2023-01-30 16:59:04'),
	(8, 71, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'test_admin', 'mariofrans', '2023-01-30 16:59:04'),
	(9, 72, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'test_staff', 'mariofrans', '2023-01-30 16:59:04'),
	(10, 72, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'test_staff', 'mariofrans', '2023-01-30 16:59:04'),
	(11, 73, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 100, 'PIECES', 'AV', '', 'Balance', 'atmi', 'atmi', '2023-01-31 09:09:39'),
	(12, 73, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-01-31 09:09:39'),
	(13, 74, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'test_staff', 'atmi', '2023-01-31 09:09:39'),
	(14, 73, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '0000-00-00', 48, 0, 100, 'PIECES', 'AV', '', 'Balance', 'atmi', 'atmi', '2023-01-31 09:23:09'),
	(15, 73, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '0000-00-00', 25, 0, 100, 'UNIT', 'AV', 'CBT-GR-0123-0012', 'Balance', 'atmi', 'atmi', '2023-01-31 10:56:22'),
	(16, 74, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '0000-00-00', 25, 0, 100, 'UNIT', 'AV', 'CBT-GR-0123-0012', 'Balance', 'test_staff', 'atmi', '2023-01-31 10:57:27'),
	(17, 75, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'test_admin', 'test_admin', '2023-02-02 12:44:56'),
	(18, 75, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 51, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'test_admin', 'test_admin', '2023-02-02 12:44:56'),
	(19, 75, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 60, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'test_admin', 'test_admin', '2023-02-02 12:44:56'),
	(20, 76, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, 50, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'test_staff', 'test_staff', '2023-02-02 13:53:19'),
	(21, 76, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 5, 0, 0, 'PIECES', 'DMG', '', '', 'test_staff', 'test_staff', '2023-02-02 13:53:19'),
	(22, 83, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 34, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'test_admin', 'test_admin', '2023-02-03 14:54:09'),
	(23, 83, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 15, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 14:54:09'),
	(24, 83, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 30, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'test_admin', 'test_admin', '2023-02-03 14:54:09'),
	(25, 83, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 10, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'test_admin', 'test_admin', '2023-02-03 14:54:09'),
	(26, 83, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 6, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 14:54:09'),
	(27, 84, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 64, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'test_staff', 'test_staff', '2023-02-03 14:56:13'),
	(28, 85, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 34, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(29, 85, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 17, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(30, 85, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 30, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(31, 85, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 64, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(32, 85, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 10, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(33, 85, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 5, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 15:13:32'),
	(34, 86, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(35, 86, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 17, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(36, 86, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 30, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(37, 86, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 64, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(38, 86, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 10, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(39, 86, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 5, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'test_admin', 'test_admin', '2023-02-03 15:15:31'),
	(40, 91, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 50, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-07 15:57:27'),
	(41, 92, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 45, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-02-07 16:00:35'),
	(42, 92, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 60, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-02-07 16:00:35'),
	(43, 92, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, -1, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-02-07 16:00:35'),
	(44, 92, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 15, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-02-07 16:00:35'),
	(45, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(46, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 17, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(47, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 40, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(48, 102, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 20, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(49, 102, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 20, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(50, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(51, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 50, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(52, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(53, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(54, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(55, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(56, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 48, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(57, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 48, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(58, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 9, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(59, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 9, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(60, 102, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 64, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(61, 102, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 20, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(62, 102, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 10, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(63, 102, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 60, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(64, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(65, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(66, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(67, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(68, 102, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 25, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(69, 102, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 50, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(70, 102, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 8, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(71, 102, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(72, 102, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 24, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(73, 102, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 24, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(74, 102, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 19, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-02-09 15:27:45'),
	(75, 105, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(76, 105, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 17, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(77, 105, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 40, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(78, 105, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 63, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(79, 105, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 8, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(80, 105, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 3, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:30:22'),
	(81, 106, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 35, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(82, 106, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 17, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(83, 106, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 41, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(84, 106, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 64, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(85, 106, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 9, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(86, 106, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 5, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-02-09 15:32:35'),
	(87, 135, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(88, 135, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(89, 135, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(90, 135, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 19, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(91, 135, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 21, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(92, 135, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-03-20 17:22:39'),
	(93, 136, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'test_admin', 'test_admin', '2023-03-20 17:28:46'),
	(94, 144, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-04-04 09:03:03'),
	(95, 144, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 10, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-04-04 09:03:03'),
	(96, 144, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 15, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-04-04 09:03:03'),
	(97, 144, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 15, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-04-04 09:03:03'),
	(98, 167, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 9, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-05-03 15:07:46'),
	(99, 167, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 11, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-05-03 15:07:46'),
	(100, 167, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 15, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-05-03 15:07:46'),
	(101, 167, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 14, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-05-03 15:07:46'),
	(124, 182, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(120, 134, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 24, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-06-08 14:47:51'),
	(121, 182, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(122, 182, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 10, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(117, 65, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 0, 0, 'PIECES', 'AV', '', '', '', 'atmi', '2023-06-08 14:35:32'),
	(118, 65, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 12, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', '', 'atmi', '2023-06-08 14:35:32'),
	(119, 65, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 15, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', '', 'atmi', '2023-06-08 14:35:32'),
	(123, 182, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(125, 182, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(126, 182, '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(127, 182, '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(128, 182, 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 5, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(129, 182, 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-06-13 17:40:48'),
	(130, 181, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-06-13 17:43:40'),
	(131, 181, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:43:40'),
	(132, 181, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 20, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:43:40'),
	(133, 181, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 20, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-06-13 17:43:40'),
	(134, 181, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 20, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-06-13 17:43:40'),
	(135, 183, 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-06-13 17:47:15'),
	(136, 183, 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, 10, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-06-13 17:47:15'),
	(137, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(138, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(139, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(140, 102, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 0, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(141, 102, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(142, 102, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(143, 102, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(144, 102, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(145, 102, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(146, 102, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(147, 102, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(148, 102, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(149, 102, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(150, 102, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(151, 102, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(152, 102, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(153, 102, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(154, 102, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(155, 102, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 0, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(156, 102, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(157, 102, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(158, 102, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(159, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(160, 102, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(161, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(162, 102, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(163, 102, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(164, 102, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(165, 102, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(166, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(167, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(168, 102, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(169, 102, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(170, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(171, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(172, 102, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'test_admin', 'atmi', '2023-07-03 15:27:39'),
	(173, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(174, 102, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(175, 102, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(176, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 1, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:39'),
	(177, 102, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:39'),
	(178, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(179, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(180, 102, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(181, 102, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 0, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(182, 102, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(183, 102, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(184, 102, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(185, 102, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(186, 102, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(187, 102, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(188, 102, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(189, 102, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(190, 102, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(191, 102, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(192, 102, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(193, 102, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(194, 102, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(195, 102, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(196, 102, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 0, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(197, 102, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(198, 102, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(199, 102, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(200, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(201, 102, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(202, 102, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(203, 102, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(204, 102, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(205, 102, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(206, 102, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(207, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(208, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(209, 102, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(210, 102, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(211, 102, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(212, 102, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(213, 102, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'test_admin', 'atmi', '2023-07-03 15:27:43'),
	(214, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(215, 102, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(216, 102, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(217, 102, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 1, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 15:27:43'),
	(218, 102, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'rdarmawan', 'atmi', '2023-07-03 15:27:43'),
	(219, 127, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(220, 127, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(221, 127, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(222, 127, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 2, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(223, 127, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(224, 127, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 15:28:09'),
	(225, 184, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 3, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 15:28:30'),
	(226, 184, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 15:28:30'),
	(227, 184, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 15:28:30'),
	(228, 184, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 15:28:30'),
	(229, 184, '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 15:28:30'),
	(230, 186, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(231, 186, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(232, 186, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(233, 186, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(234, 186, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(235, 186, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(236, 186, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(237, 186, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:12:35'),
	(238, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(239, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(240, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(241, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 2, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(242, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(243, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(244, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', '2025-09-06', 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(245, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(246, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(247, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(248, 187, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(249, 187, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(250, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(251, 187, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(252, 187, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(253, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(254, 187, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(255, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(256, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(257, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(258, 187, 'FL001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(259, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(260, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', '2027-09-06', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(261, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(262, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(263, 187, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(264, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(265, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(266, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(267, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(268, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(269, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(270, 187, 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(271, 187, 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(272, 187, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(273, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(274, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(275, 187, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(276, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(277, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(278, 187, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(279, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(280, 187, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(281, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '23022023', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(282, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(283, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(284, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(285, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(286, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(287, 187, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(288, 187, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(289, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(290, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(291, 187, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(292, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(293, 187, 'DMG-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(294, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(295, 187, 'FL001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(296, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(297, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(298, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(299, 187, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(300, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 2, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(301, 187, 'FL001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(302, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(303, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(304, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(305, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(306, 187, 'test_location_1', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(307, 187, 'test_location_2', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(308, 187, '1B1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0049', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(309, 187, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(310, 187, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(311, 187, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(312, 187, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(313, 187, '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(314, 187, 'DMG-001-001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(315, 187, 'test_location_1', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(316, 187, 'test_location_2', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(317, 187, 'FL001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(318, 187, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(319, 187, 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(320, 187, '1A1-001-003', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(321, 187, 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(322, 187, 'test_location_1', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 0, 0, 0, 'SET', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:44'),
	(323, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(324, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(325, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(326, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 2, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(327, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(328, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(329, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', '2025-09-06', 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(330, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(331, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(332, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(333, 187, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(334, 187, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(335, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(336, 187, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(337, 187, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(338, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(339, 187, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(340, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(341, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(342, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(343, 187, 'FL001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(344, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(345, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', '2027-09-06', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(346, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(347, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(348, 187, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(349, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(350, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(351, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(352, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 2, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(353, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(354, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(355, 187, 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(356, 187, 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(357, 187, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(358, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(359, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(360, 187, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(361, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(362, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(363, 187, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(364, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(365, 187, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(366, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '23022023', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(367, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(368, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(369, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(370, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(371, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(372, 187, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(373, 187, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(374, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(375, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(376, 187, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(377, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 2, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(378, 187, 'DMG-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(379, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(380, 187, 'FL001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(381, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(382, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(383, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(384, 187, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(385, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 2, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(386, 187, 'FL001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(387, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(388, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(389, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(390, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(391, 187, 'test_location_1', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(392, 187, 'test_location_2', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(393, 187, '1B1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0049', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(394, 187, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(395, 187, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(396, 187, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(397, 187, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(398, 187, '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(399, 187, 'DMG-001-001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(400, 187, 'test_location_1', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(401, 187, 'test_location_2', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(402, 187, 'FL001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(403, 187, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(404, 187, 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', NULL, 2, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(405, 187, '1A1-001-003', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(406, 187, 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(407, 187, 'test_location_1', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 0, 0, 0, 'SET', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:49'),
	(408, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(409, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(410, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(411, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 0, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(412, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(413, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(414, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', '2025-09-06', 1, 0, 0, 'PALLET', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(415, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(416, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(417, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(418, 187, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(419, 187, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(420, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(421, 187, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(422, 187, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(423, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(424, 187, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(425, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(426, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(427, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(428, 187, 'FL001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(429, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(430, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', '2027-09-06', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(431, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(432, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(433, 187, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(434, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 0, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(435, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(436, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(437, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(438, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(439, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(440, 187, 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(441, 187, 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(442, 187, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(443, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(444, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(445, 187, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(446, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(447, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(448, 187, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(449, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(450, 187, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(451, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '23022023', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(452, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(453, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(454, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(455, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(456, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(457, 187, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(458, 187, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(459, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(460, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(461, 187, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(462, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(463, 187, 'DMG-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(464, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(465, 187, 'FL001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(466, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(467, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(468, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(469, 187, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(470, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 1, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(471, 187, 'FL001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(472, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(473, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(474, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(475, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(476, 187, 'test_location_1', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(477, 187, 'test_location_2', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(478, 187, '1B1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0049', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(479, 187, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(480, 187, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(481, 187, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(482, 187, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 1, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(483, 187, '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(484, 187, 'DMG-001-001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(485, 187, 'test_location_1', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(486, 187, 'test_location_2', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(487, 187, 'FL001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(488, 187, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(489, 187, 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(490, 187, '1A1-001-003', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(491, 187, 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(492, 187, 'test_location_1', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'SET', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:21:58'),
	(493, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(494, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(495, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(496, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01', 0, 0, 0, '', 'QR', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(497, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(498, 187, 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '2023-01-13', 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(499, 187, '1A1-001-001', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', '2025-09-06', 1, 0, 0, 'PALLET', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(500, 187, '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(501, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(502, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(503, 187, '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(504, 187, '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(505, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '2023-12-12', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0014', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(506, 187, 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-01-31', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(507, 187, 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(508, 187, 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(509, 187, 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(510, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(511, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(512, 187, '1A1-001-001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(513, 187, 'FL001', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(514, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(515, 187, '1A1-001-002', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', '2027-09-06', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0003', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(516, 187, 'test_location_2', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(517, 187, 'test_location_1', '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0016', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(518, 187, '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01', NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1222-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(519, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 0, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(520, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(521, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '2028-09-23', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(522, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', NULL, 1, 0, 0, 'PALLET', 'AV', 'CBT-GR-0123-0009', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(523, 187, '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(524, 187, '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(525, 187, 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(526, 187, 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31', 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(527, 187, 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(528, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(529, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(530, 187, 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(531, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0001', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(532, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(533, 187, 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(534, 187, 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, NULL, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(535, 187, '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-1022-0043', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(536, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '23022023', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0015', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(537, 187, '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(538, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09', 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(539, 187, '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 0, 0, 0, 'PIECES', 'DMG', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(540, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(541, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(542, 187, '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(543, 187, 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(544, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(545, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(546, 187, 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(547, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 0, 0, 0, 'PACK', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(548, 187, 'DMG-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(549, 187, '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 1, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(550, 187, 'FL001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(551, 187, '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(552, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', '', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(553, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(554, 187, '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0123-0012', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(555, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08', 1, 0, 0, 'ROLL', 'AV', 'CBT-GR-0223-0006', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(556, 187, 'FL001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0001', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(557, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(558, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0003', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(559, 187, '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(560, 187, '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 0, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0002', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(561, 187, 'test_location_1', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(562, 187, 'test_location_2', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0010', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(563, 187, '1B1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0049', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(564, 187, '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 1, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(565, 187, '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(566, 187, 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(567, 187, 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', NULL, 1, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(568, 187, '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(569, 187, 'DMG-001-001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(570, 187, 'test_location_1', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', 1, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(571, 187, 'test_location_2', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'AV', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(572, 187, 'FL001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31', NULL, 0, 0, 'PACK', 'DMG', 'CBT-GR-0323-0005', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(573, 187, '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, NULL, 0, 0, 'SET', 'AV', 'CBT-GR-0123-0007', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(574, 187, 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', NULL, 0, 0, 0, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(575, 187, '1A1-001-003', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', NULL, NULL, 0, 0, 'UNIT', 'AV', 'CBT-GR-0423-0001', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(576, 187, 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, NULL, 0, 0, 'PIECES', 'AV', 'CBT-GR-0523-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05'),
	(577, 187, 'test_location_1', 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 1, 0, 0, 'SET', 'AV', 'CBT-GR-0423-0004', '', 'atmi', 'atmi', '2023-07-03 20:22:05');
/*!40000 ALTER TABLE `t_wh_count_qty` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_detail
DROP TABLE IF EXISTS `t_wh_inbound_detail`;
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

-- Dumping data for table wms.t_wh_inbound_detail: 74 rows
/*!40000 ALTER TABLE `t_wh_inbound_detail` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_detail` (`inbound_planning_no`, `SKU`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty`, `discrepancy`, `uom_name`, `clasification_id`, `stock_id`, `spv_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT0107220002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '123123', '20220101', '1568887-1215', '01', 'BLACK', '47"', '0000-00-00 00:00:00', 10, 0, 'PIECES', 1, '', NULL, 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-14 15:17:54'),
	('CBT0107220002', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '125536', '20', 'BLACK', '32"', NULL, 12, 0, 'PIECES', NULL, '', NULL, NULL, NULL, NULL, NULL),
	('CBT-IN-1022-0044', '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', '', '', '', '', NULL, 20, 0, 'PIECES', 1, '', 'sugeng', 'atmi', '2022-11-06 16:07:24', 'atmi', '2022-11-06 16:51:37'),
	('CBT-IN-1122-0014', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 5, 5, 'PIECES', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 09:45:39'),
	('CBT-IN-1122-0014', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 3, 0, 'PIECES', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 09:45:39'),
	('CBT-IN-1122-0015', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 17:26:09'),
	('CBT-IN-1122-0015', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 17:26:09'),
	('CBT-IN-1122-0016', '32L5995', 'TV Toshiba 32L5995', '1234', '', '', '6780', '', '', NULL, 5, 0, 'PIECES', 2, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-14 14:53:06'),
	('CBT-IN-1122-0016', '75016438', 'DISPLAY PANEL V216B1-L02', '1234', '', '', '6789', '', '', NULL, 10, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-14 14:53:06'),
	('CBT-IN-1122-0017', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 0, 'PIECES', 1, '', 'atmi', NULL, NULL, 'atmi', '2022-11-16 09:07:52'),
	('CBT-IN-1122-0017', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 40, -20, 'PIECES', 1, '', 'atmi', NULL, NULL, 'atmi', '2022-11-16 09:07:52'),
	('CBT-IN-1222-0014', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12 00:00:00', 50, 0, 'PIECES', 1, '', 'test_staff', NULL, NULL, 'test_staff', '2022-12-15 09:45:38'),
	('CBT-IN-1222-0014', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01 00:00:00', 25, 0, 'PIECES', 1, '', 'test_staff', '', '0000-00-00 00:00:00', 'test_staff', '2022-12-15 09:45:38'),
	('CBT-IN-1222-0015', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01 00:00:00', 20, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-12-15 11:55:59'),
	('CBT-IN-1222-0015', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01 00:00:00', 20, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-12-15 11:55:59'),
	('CBT-IN-1222-0016', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06 00:00:00', 50, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-12-15 12:52:28'),
	('CBT-IN-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06 00:00:00', 50, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2022-12-15 12:54:22'),
	('CBT-IN-1122-0017', '112233445', 'Teh Kotak Original', 'test28des22_1', NULL, NULL, NULL, NULL, NULL, '2023-12-28 00:00:00', 25, 0, 'PIECES', 1, '', NULL, NULL, NULL, NULL, NULL),
	('CBT-IN-0123-0001', '112233447', 'Teh Kotak Apel', '03012023', '', '', '', '', '', '2025-01-03 00:00:00', 45, 0, 'PIECES', 1, '', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-03 17:41:57'),
	('CBT-IN-1122-0014', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 2, 0, 'PIECES', 1, 'DMG', 'mariofrans', NULL, NULL, 'mariofrans', '2022-11-09 09:45:39'),
	('CBT-IN-0123-0002', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-09 10:02:34'),
	('CBT-IN-0123-0002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-09 10:02:34'),
	('CBT-IN-0123-0003', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 100, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-09 10:12:36'),
	('CBT-IN-0123-0004', '112233447', 'Teh Kotak Apel', '09012020', '', '', '', '', '', '2025-01-09 00:00:00', 100, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-09 14:19:55'),
	('CBT-IN-0123-0004', '32L5995', 'TV Toshiba 32L5995', '', '32L599509012023', '', '', '', '', NULL, 20, 0, 'SET', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-09 14:19:55'),
	('CBT-IN-0123-0005', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-12 10:14:43'),
	('CBT-IN-0123-0006', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 5, 5, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-12 10:36:54'),
	('CBT-IN-0123-0006', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 5, 5, 'UNIT', 1, 'DMG', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-12 10:36:54'),
	('CBT-IN-0123-0007', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13 00:00:00', 100, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-13 10:18:21'),
	('CBT-IN-0123-0007', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13 00:00:00', 20, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-13 10:18:21'),
	('CBT-IN-0123-0007', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', NULL, 50, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-13 10:18:21'),
	('CBT-IN-0123-0007', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 50, 0, 'SET', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-01-13 10:18:21'),
	('CBT-IN-0123-0009', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 10, 0, 'PALLET', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-17 09:54:01'),
	('CBT-IN-0123-0009', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 20, -10, 'PALLET', 1, 'DMG', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-17 09:54:01'),
	('CBT-IN-0123-0010', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 0, 'SET', 1, 'AV', 'test_staff', NULL, NULL, 'test_staff', '2023-01-19 14:51:07'),
	('CBT-IN-0123-0012', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 50, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-01-24 09:30:22'),
	('CBT-IN-0223-0002', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03 00:00:00', 25, 0, 'PACK', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-03 10:21:46'),
	('CBT-IN-0223-0002', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 20, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-03 10:21:46'),
	('CBT-IN-0223-0003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 0, 'UNIT', 1, 'AV', 'mariofrans', NULL, NULL, 'mariofrans', '2023-02-07 13:33:36'),
	('CBT-IN-0223-0004', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09 00:00:00', 5, 0, 'PACK', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-08 11:41:50'),
	('CBT-IN-0223-0006', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '2023-02-08 00:00:00', 9, 1, 'ROLL', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-08 15:25:24'),
	('CBT-IN-0223-0011', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23 00:00:00', 5, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-16 17:39:08'),
	('CBT-IN-0223-0015', '32L5995', 'TV Toshiba 32L5995', '', '23022023', '', '', '', '', NULL, 100, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-23 16:51:57'),
	('CBT-IN-0223-0015', '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23 00:00:00', 100, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-02-23 16:51:57'),
	('CBT-IN-0323-0001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', '', '', '', '', NULL, 5, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-18 23:16:44'),
	('CBT-IN-0323-0003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 9, 1, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-20 14:42:17'),
	('CBT-IN-0323-0002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-21 09:28:46'),
	('CBT-IN-0323-0004', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 25, 25, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-24 15:04:59'),
	('CBT-IN-0323-0004', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 25, 25, 'PIECES', 1, 'DMG', 'atmi', NULL, NULL, 'atmi', '2023-03-24 15:04:59'),
	('CBT-IN-0323-0005', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 20, 5, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-27 13:52:01'),
	('CBT-IN-0323-0005', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 5, 20, 'PIECES', 1, 'DMG', 'atmi', NULL, NULL, 'atmi', '2023-03-27 13:52:01'),
	('CBT-IN-0323-0005', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 10, 40, 'PACK', 1, 'DMG', 'atmi', NULL, NULL, 'atmi', '2023-03-27 13:52:01'),
	('CBT-IN-0323-0005', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 40, 10, 'PACK', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-03-27 13:52:01'),
	('CBT-IN-0423-0001', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', '', '', 'MERAH', '', NULL, 10, 0, 'PACK', 1, 'AV', 'test_admin', NULL, NULL, 'test_admin', '2023-04-04 14:42:09'),
	('CBT-IN-0423-0001', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', '', '', 'BIRU', '', NULL, 50, 0, 'UNIT', 1, 'AV', 'test_admin', NULL, NULL, 'test_admin', '2023-04-04 14:42:09'),
	('CBT-IN-0223-0010', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 20, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-05 10:42:33'),
	('CBT-IN-0423-0002', 'ABC123', 'Baterai ABC', '', '06042023', '', '', '', '', NULL, 50, 50, 'PIECES', 1, 'DMG', 'atmi', NULL, NULL, 'atmi', '2023-04-06 08:40:11'),
	('CBT-IN-0423-0002', 'ABC123', 'Baterai ABC', '', '06042023', '', '', '', '', NULL, 50, 50, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-06 08:40:11'),
	('CBT-IN-0323-0049', '75016438', 'DISPLAY PANEL V216B1-L02', '', '20230313', '', '', '', '', NULL, 20, 0, 'PIECES', 1, 'AV', NULL, NULL, NULL, 'atmi', '2023-04-06 08:48:42'),
	('CBT-IN-0423-0003', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', 'IM124', 'P124', 'Hijau', '500ml', '2025-09-06 00:00:00', 84, 0, 'PALLET', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-06 12:35:36'),
	('CBT-IN-0423-0003', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', 'IM123', 'P123', 'Merah', '600ml', '2027-09-06 00:00:00', 53, 0, 'PACK', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-06 12:35:36'),
	('CBT-IN-0423-0004', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '17042023', '', '', '', '', NULL, 100, 0, 'UNIT', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-17 14:40:11'),
	('CBT-IN-0423-0004', 'IC0123', 'IC TV Toshiba 32L5995', '', '17042023', '', '', '', '', NULL, 100, 0, 'SET', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-04-17 14:40:11'),
	('CBT-IN-0323-0007', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '', '', '', '0000-00-00 00:00:00', 53, 70, 'PIECES', 4, 'AV', 'atmi', 'atmi', '2023-04-27 10:12:02', NULL, NULL),
	('CBT-IN-0523-0002', '112233446', 'Teh Kotak Lemon', '', '', '', '', '', '', NULL, 50, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-05-21 13:55:23'),
	('CBT-IN-0523-0003', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2026-05-22 00:00:00', 50, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-05-22 09:48:55'),
	('CBT-IN-0523-0003', 'ABC456', 'Sirup ABC Jeruk', '', '', '', '', '', '', '2027-05-22 00:00:00', 49, 1, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-05-22 09:48:55'),
	('CBT-IN-0523-0004', 'ABC123', 'Baterai ABC', '24052023', '', '', '', '', '', NULL, 10, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-05-24 12:02:11'),
	('CBT-IN-0523-0004', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', '', '', '', '', NULL, 10, 0, 'PIECES', 1, 'AV', 'atmi', NULL, NULL, 'atmi', '2023-05-24 12:02:11'),
	('CBT-IN-0824-0001', 'CG001', 'Cengkeh', '', '', '', '', '', '', NULL, 400, 0, 'KG', 1, 'WIP', 'superadmin', NULL, NULL, 'superadmin', '2024-08-26 13:44:24'),
	('CBT-IN-0623-0003', 'ABC123', 'Baterai ABC', '20230626', '', '', '', '', '', NULL, 100, 0, 'PIECES', 1, 'AV', 'superadmin', NULL, NULL, 'superadmin', '2024-08-26 14:25:00'),
	('CBT-IN-0623-0003', 'ABC456', 'Sirup ABC Jeruk', '20230626', '', '', '', '', '', '2024-06-26 00:00:00', 100, 0, 'PIECES', 1, 'AV', 'superadmin', NULL, NULL, 'superadmin', '2024-08-26 14:25:00'),
	('CBT-IN-0623-0002', '112233445', 'Teh Kotak Original', '20230626', '', '', '', '', '', '2026-06-26 00:00:00', 23, 1, 'PIECES', 1, 'AV', 'superadmin', NULL, NULL, 'superadmin', '2024-08-27 16:24:44'),
	('CBT-IN-0824-0002', 'CG001', 'Cengkeh', '', '', '', '', '', '', '2026-12-28 00:00:00', 40, 0, 'Bag', 2, 'AV', 'superadmin', NULL, NULL, 'superadmin', '2024-08-28 11:41:10');
/*!40000 ALTER TABLE `t_wh_inbound_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_detail_copy
DROP TABLE IF EXISTS `t_wh_inbound_detail_copy`;
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
DROP TABLE IF EXISTS `t_wh_inbound_planning`;
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

-- Dumping data for table wms.t_wh_inbound_planning: 70 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning` (`inbound_planning_no`, `wh_id`, `client_project_id`, `supplier_id`, `status_id`, `reference_no`, `receipt_no`, `plan_delivery`, `order_id`, `task_type`, `remarks`, `data_upload1`, `data_upload2`, `data_upload3`, `is_active`, `is_deleted`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-IN-0123-0009', 1, 1, 3, 'FIN', 'TEST BUNGA', 'TEST BUNGA', '2023-01-17 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-17 09:21:12', 'mariofrans', '2023-01-17 09:54:19'),
	('CBT-IN-0123-0008', 1, 1, 3, 'FIN', 'TEST BUNGA', '12345678', '2023-01-17 00:00:00', '2', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-17 09:18:39', 'mariofrans', '2023-01-17 09:39:18'),
	('CBT-IN-0123-0007', 1, 1, 3, 'FIN', 'test_13jan22', 'test_13jan22', '2023-01-13 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-01-13 09:43:31', 'atmi', '2023-01-13 10:43:25'),
	('CBT-IN-0123-0006', 1, 1, 1, 'FIN', 'test12jan2023_2', 'test12jan2023_2', '2023-01-14 00:00:00', '1', 'Single Receive', 'test12jan2023_2', '', '', '', 'Y', 'N', 'mariofrans', '2023-01-12 10:34:40', 'mariofrans', '2023-01-12 10:37:17'),
	('CBT-IN-0123-0005', 1, 1, 1, 'FIN', 'test12jan2023_1', 'test12jan2023_1', '2023-01-13 00:00:00', '1', 'Single Receive', 'test12jan2023_1', '', '', '', 'Y', 'N', 'mariofrans', '2023-01-12 10:11:01', 'mariofrans', '2023-01-12 10:17:58'),
	('CBT-IN-0123-0002', 1, 1, 1, 'FIN', 'test9jan2023_1', 'test9jan2023_1', '2023-01-09 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-09 09:43:31', 'mariofrans', '2023-01-11 18:00:53'),
	('CBT-IN-0123-0003', 1, 1, 1, 'FIN', 'test9jan2023_2', 'test9jan2023_2', '2023-01-09 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-09 10:05:27', 'atmi', '2023-01-09 14:42:50'),
	('CBT-IN-0123-0004', 1, 1, 1, 'FIN', 'test_input_090123', 'test_input_090123', '2023-01-09 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-01-09 14:03:40', 'atmi', '2023-01-09 14:24:55'),
	('CBT-IN-0123-0001', 1, 1, 3, 'FIN', 'test_confirm', 'test_confirm', '2023-01-03 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-03 17:37:22', 'atmi', '2023-01-09 08:48:19'),
	('CBT-IN-1222-0018', 1, 1, 1, 'UIN', 'test29des22_1', 'test29des22_1', '2022-12-30 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-12-29 10:13:59', 'rdarmawan', '2022-12-30 14:51:44'),
	('CBT-IN-1222-0017', 1, 2, 2, 'OPI', '1234', '1234', '2022-12-22 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'rdarmawan', '2022-12-22 10:34:34', NULL, NULL),
	('CBT-IN-1222-0016', 1, 1, 3, 'FIN', 'test_exp_3', 'test_exp_3', '2022-12-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-12-15 12:23:10', 'mariofrans', '2022-12-15 12:56:41'),
	('CBT-IN-1222-0015', 1, 1, 1, 'FIN', 'test_exp_2', 'test_exp_2', '2022-12-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-12-15 11:44:02', 'mariofrans', '2022-12-15 12:02:38'),
	('CBT-IN-1222-0013', 1, 1, 1, 'UIN', 'test bunga', 'test bunga 1', '2022-12-07 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-12-07 15:52:36', 'mariofrans', '2022-12-07 15:59:41'),
	('CBT-IN-1122-0017', 1, 1, 1, 'FIN', 'test_atmi', 'test_atmi', '2022-11-16 00:00:00', '1', 'Single Receive', 'test scenario', '', '', '', 'Y', 'N', 'atmi', '2022-11-16 08:36:34', 'atmi', '2022-11-16 09:23:56'),
	('CBT-IN-1122-0016', 1, 1, 1, 'FIN', 'RBY-1234', 'hai', '2022-11-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-11-14 14:07:58', 'mariofrans', '2022-11-14 14:57:42'),
	('CBT-IN-1222-0014', 1, 1, 3, 'FIN', 'test_exp', 'test_exp', '2022-12-15 00:00:00', '1', 'Single Receive', 'test exp date', '', '', '', 'Y', 'N', 'mariofrans', '2022-12-15 09:28:17', 'mariofrans', '2022-12-15 10:56:23'),
	('CBT-IN-1122-0015', 1, 1, 1, 'FIN', 'test_09nov22_2', 'test_09nov22_2', '2022-11-11 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-11-09 17:22:54', 'mariofrans', '2022-11-09 17:26:17'),
	('CBT-IN-1122-0014', 1, 1, 1, 'FIN', 'test09nov22_1', 'test09nov22_1', '2022-11-11 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-11-09 09:08:23', 'atmi', '2022-12-14 14:37:37'),
	('CBT-IN-1022-0045', 1, 1, 1, 'UIN', 'test_0411_2', '', '2022-11-04 13:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'atmi', '2022-11-04 13:54:14', 'mariofrans', '2022-11-11 16:32:10'),
	('CBT-IN-1022-0044', 1, 1, 1, 'FIN', 'test_0411', '', '2022-11-04 11:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'atmi', '2022-11-04 13:51:51', 'atmi', '2023-05-17 10:21:09'),
	('CBT-IN-0123-0010', 1, 1, 1, 'FIN', 'test19jan23_1', 'test19jan23_1', '2023-01-19 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-01-19 14:42:38', 'test_staff', '2023-01-19 14:51:37'),
	('CBT-IN-0123-0011', 1, 1, 3, 'UIN', 'test_1901', 'test_1901', '2023-01-19 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-01-19 15:19:54', 'atmi', '2023-05-18 13:21:53'),
	('CBT-IN-0123-0012', 1, 1, 1, 'FIN', 'test24jan2023_1', 'test24jan2023_1', '2023-01-24 00:00:00', '1', 'Single Receive', 'test24jan2023_1', '', '', '', 'Y', 'N', 'mariofrans', '2023-01-24 09:27:44', 'mariofrans', '2023-01-24 09:30:34'),
	('CBT-IN-0223-0001', 1, 1, 1, 'UIN', 'test_0202', 'test_0202', '2023-02-02 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-02 11:49:19', 'test_admin', '2023-02-03 17:32:20'),
	('CBT-IN-0223-0002', 1, 1, 1, 'FIN', 'test_0203', 'test_0203', '2023-02-03 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-03 09:56:02', 'atmi', '2023-02-03 10:25:27'),
	('CBT-IN-0223-0003', 1, 1, 1, 'FIN', 'test7feb23_1', 'test7feb23_1', '2023-02-07 00:00:00', '1', 'Single Receive', 'test7feb23_1', '', '', '', 'Y', 'N', 'mariofrans', '2023-02-07 13:31:09', 'mariofrans', '2023-02-07 13:33:52'),
	('CBT-IN-0223-0004', 1, 1, 3, 'FIN', 'TEST ISA', 'TEST ISA', '2023-02-09 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-02-08 11:12:58', 'atmi', '2023-02-08 11:44:51'),
	('CBT-IN-0223-0005', 1, 1, 1, 'UIN', 'test_bugfixing', 'test_bugfixing', '2023-02-08 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-08 14:26:38', 'atmi', '2023-02-08 14:27:01'),
	('CBT-IN-0223-0006', 1, 1, 3, 'FIN', 'TEST 2 -AKMALISA', 'TEST 2 -AKMALISA', '2023-02-08 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-08 15:17:55', 'atmi', '2023-02-09 09:53:14'),
	('CBT-IN-0223-0007', 1, 1, 3, 'UIN', 'aaaa', 'aaaa', '2023-02-09 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans_spv', '2023-02-09 16:31:46', 'mariofrans_spv', '2023-02-09 16:31:55'),
	('CBT-IN-0223-0008', 1, 1, 1, 'UIN', 'test10feb23_1', 'test10feb23_1', '2023-02-10 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-02-10 17:52:13', 'mariofrans', '2023-02-10 17:52:22'),
	('CBT-IN-0223-0009', 1, 1, 1, 'UIN', 'test_0312', 'test_0312', '2023-02-13 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-13 13:34:46', 'atmi', '2023-02-13 13:35:04'),
	('CBT-IN-0223-0010', 1, 1, 3, 'FIN', 'test_1502', 'test_1502', '2023-02-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans_spv', '2023-02-15 14:53:14', 'atmi', '2023-04-05 11:22:03'),
	('CBT-IN-0223-0011', 1, 1, 1, 'FIN', 'test', 'test', '2023-03-03 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-16 17:31:07', 'atmi', '2023-02-16 17:39:35'),
	('CBT-IN-0223-0012', 1, 1, 1, 'UIN', 'test_2102', 'test_2102', '2023-02-21 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans_spv', '2023-02-21 11:23:16', 'mariofrans_spv', '2023-02-21 11:23:27'),
	('CBT-IN-0223-0013', 1, 1, 1, 'UIN', 'test_2302', 'test_2302', '2023-02-23 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-23 09:09:26', 'atmi', '2023-02-23 09:09:38'),
	('CBT-IN-0223-0014', 1, 1, 1, 'UIN', 'test_2303_2', 'test_2303_2', '2023-02-23 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-23 14:47:18', 'atmi', '2023-02-23 14:47:28'),
	('CBT-IN-0223-0015', 1, 1, 1, 'FIN', 'test_2302_03', 'test_2302_03', '2023-02-23 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-02-23 16:27:06', 'atmi', '2023-02-23 16:53:14'),
	('CBT-IN-0323-0001', 1, 1, 1, 'FIN', 'adasfsfafa', 'asdasfasfasf', '2023-03-04 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-03-02 10:55:56', 'atmi', '2023-03-18 23:16:55'),
	('CBT-IN-0323-0002', 1, 1, 4, 'FIN', 'TEST-RFC 1', 'TEST-RFC 1', '2023-03-20 00:00:00', '2', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2023-03-20 14:28:04', 'atmi', '2023-03-21 09:28:53'),
	('CBT-IN-0323-0003', 1, 1, 4, 'FIN', 'TEST RFC-2', 'TEST RFC-2', '2023-03-20 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2023-03-20 14:29:40', 'atmi', '2023-03-20 14:46:03'),
	('CBT-IN-0323-0043', 1, 1, 1, 'UIN', '123', '123', '0000-00-00 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', NULL, '2023-03-24 08:31:19', NULL, NULL),
	('CBT-IN-0323-0044', 1, 1, 1, 'UIN', '123', '123', '0000-00-00 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:32:16', NULL, NULL),
	('CBT-IN-0323-0045', 1, 1, 1, 'UIN', '123', '123', '0000-00-00 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:33:36', NULL, NULL),
	('CBT-IN-0323-0046', 1, 1, 1, 'UIN', '123', '123', '0000-00-00 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:33:57', NULL, NULL),
	('CBT-IN-0323-0047', 1, 1, 1, 'UIN', '123', '123', '2023-03-13 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:39:53', NULL, NULL),
	('CBT-IN-0323-0048', 1, 1, 1, 'UIN', '123', '123', '2023-03-13 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:40:34', NULL, NULL),
	('CBT-IN-0323-0049', 1, 1, 1, 'FIN', '123', '123', '2023-03-13 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-03-24 08:42:38', 'atmi', '2023-04-11 12:01:06'),
	('CBT-IN-0323-0004', 1, 1, 4, 'FIN', 'test_inbound_2403', 'test_inbound_2403', '2023-03-24 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2023-03-24 15:01:17', 'atmi', '2023-03-24 15:50:18'),
	('CBT-IN-0323-0005', 1, 1, 4, 'FIN', 'test_inbound_2703', 'test_inbound_2703', '2023-03-27 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-03-27 13:47:33', 'atmi', '2023-03-27 13:52:17'),
	('CBT-IN-0323-0006', 1, 1, 4, 'OPI', 'awdawd', 'ad', '2023-07-29 00:00:00', '3', 'Partial Receive', NULL, '', '', '', 'Y', 'N', 'bunga', '2023-03-30 13:11:49', 'mariofrans', '2023-05-19 11:23:45'),
	('CBT-IN-0323-0007', 1, 1, 4, 'UIN', 'awdawd', 'ad', '2023-03-31 00:00:00', '3', 'Partial Receive', NULL, '', '', '', 'Y', 'N', 'bunga', '2023-03-30 13:16:35', 'atmi', '2023-04-05 10:19:35'),
	('CBT-IN-0423-0054', 1, 1, 1, 'CIN', '123', '123', '2023-03-29 00:00:00', '1', 'Single Receive', '', '', '', '', 'N', 'N', 'demo', '2023-04-03 08:23:00', 'bunga', '2023-04-04 14:14:59'),
	('CBT-IN-0423-0055', 1, 1, 1, 'FIN', 'test_api', 'test_api', '2023-04-03 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-04-03 08:26:14', 'bunga', '2023-04-04 14:36:41'),
	('CBT-IN-0423-0001', 1, 1, 4, 'FIN', 'RO0123', 'RNO123', '2023-04-05 00:00:00', '3', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2023-04-04 14:17:46', 'test_admin', '2023-04-04 14:43:29'),
	('CBT-IN-0423-0057', 1, 1, 1, 'UIN', 'test_api', 'test_api', '2023-04-06 00:00:00', '1', 'Single Receive', '', '', '', '', 'Y', 'N', 'demo', '2023-04-06 08:31:05', NULL, NULL),
	('CBT-IN-0423-0002', 1, 1, 4, 'FIN', 'test', 'test', '2023-04-06 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-04-06 08:38:19', 'atmi', '2023-04-13 11:45:47'),
	('CBT-IN-0423-0003', 1, 1, 4, 'FIN', 'Ref1234', 'Rec1234', '2023-04-07 00:00:00', '1', 'Single Receive', 'Barang datang dengan mobil fuso', '', '', '', 'Y', 'N', 'test_admin', '2023-04-06 12:09:30', 'atmi', '2023-04-06 12:36:55'),
	('CBT-IN-0423-0004', 1, 1, 4, 'FIN', 'test_1704', 'test_1704', '2023-04-17 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-04-17 13:59:01', 'atmi', '2023-05-16 16:46:04'),
	('CBT-IN-0523-0001', 1, 1, 1, 'UIN', 'test_19mei23_1', 'test_19mei23_1', '2023-05-19 00:00:00', '1', 'Single Receive', 'test_19mei23_1', '', '', '', 'Y', 'N', 'mariofrans', '2023-05-19 10:15:30', 'mariofrans', '2023-05-19 10:15:56'),
	('CBT-IN-0523-0002', 1, 1, 1, 'FIN', 'test_21_05', 'test_21_05', '2023-05-21 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-05-21 13:34:55', 'atmi', '2023-05-21 14:05:59'),
	('CBT-IN-0523-0003', 1, 1, 1, 'FIN', 'test_partial_2205', 'test_partial_2205', '2023-05-22 00:00:00', '1', 'Partial Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-05-22 09:33:07', 'atmi', '2023-05-22 13:52:06'),
	('CBT-IN-0523-0004', 1, 1, 1, 'FIN', 'test_inbound_2405', 'test_inbound_2405', '2023-05-24 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-05-24 11:40:43', 'atmi', '2023-05-24 12:02:42'),
	('CBT-IN-0623-0001', 1, 1, 3, 'OPI', '9999', '999', '2023-06-12 00:00:00', '2', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2023-06-12 14:47:14', NULL, NULL),
	('CBT-IN-0623-0002', 1, 1, 1, 'FIN', 'test_inbound', 'test_inbound', '2023-06-26 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-06-26 14:28:31', 'superadmin', '2024-08-27 16:26:28'),
	('CBT-IN-0623-0003', 1, 1, 1, 'FIN', 'test_2', 'test_2', '2023-06-26 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'atmi', '2023-06-26 14:49:30', 'superadmin', '2024-08-26 14:25:14'),
	('CBT-IN-0724-0001', 1, 1, 3, 'FIN', 'PO123456', '123456', '2024-07-15 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-07-15 17:00:23', 'superadmin', '2024-07-15 17:02:43'),
	('CBT-IN-0824-0001', 1, 1, 1, 'FIN', 'PO123', 'RN123', '2024-08-26 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-08-26 09:08:06', 'superadmin', '2024-08-26 13:44:37'),
	('CBT-IN-0824-0002', 1, 1, 4, 'FIN', 'PO240808001', 'RN240808001', '2024-08-28 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'superadmin', '2024-08-28 11:30:27', 'superadmin', '2024-08-28 11:41:56');
/*!40000 ALTER TABLE `t_wh_inbound_planning` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_2
DROP TABLE IF EXISTS `t_wh_inbound_planning_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_inbound_planning_2: 21 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_2` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning_2` (`id`, `inbound_planning_no`, `wh_id`, `client_project_id`, `supplier_id`, `status_id`, `reference_no`, `receipt_no`, `plan_delivery`, `order_id`, `task_type`, `remarks`, `data_upload1`, `data_upload2`, `data_upload3`, `is_active`, `is_deleted`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 'CBT0107220001', 1, 1, 1, 6, 'PO/11000/Jak-01', NULL, '0000-00-00 00:00:00', '1', 'Single Receive', NULL, NULL, NULL, NULL, 'N', 'N', NULL, NULL, NULL, NULL),
	(2, 'CBT0107220002', 1, 1, 1, 2, 'PO/092022/Jak-02', 'PO/092022/Jak-02', '2022-09-13 14:55:26', '2', 'Single Receive', ' ', NULL, NULL, NULL, 'Y', 'N', 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-20 11:29:30'),
	(6, 'CBT-IN-1022-0009', 1, 1, 1, 6, 'test_04okt2022_1', 'test_04okt2022_1', '2022-10-04 00:00:00', '1', 'Single Receive', '', NULL, NULL, NULL, 'N', 'N', 'mariofrans', '2022-10-04 14:31:41', NULL, NULL),
	(7, 'CBT-IN-1022-0010', 1, 1, 1, 6, 'test_04okt2022_2', 'test_04okt2022_2', '2022-10-04 00:00:00', '1', 'Single Receive', NULL, NULL, NULL, NULL, 'N', 'N', 'mariofrans', '2022-10-04 15:40:30', NULL, NULL),
	(8, 'CBT-IN-1022-0011', 1, 1, 1, 6, 'test_04okt2022_3', 'test_04okt2022_3', '2022-10-04 00:00:00', '1', 'Single Receive', 'test_04okt2022_3 remarks', NULL, NULL, NULL, 'N', 'N', 'mariofrans', '2022-10-04 15:41:39', NULL, NULL),
	(29, 'CBT-IN-1022-0030', 1, 1, 1, 6, 'test_atmi_toshiba', 'test_atmi_toshiba', '2022-10-05 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-05 12:19:40', NULL, NULL),
	(30, 'CBT-IN-1022-0031', 1, 1, 1, 6, 'test_atmi_2', 'test_atmi_2', '2022-10-05 00:00:00', '1', 'Single Receive', 'test notes atmi', '', '', '', 'N', 'N', 'mariofrans', '2022-10-05 13:06:13', NULL, NULL),
	(28, 'CBT-IN-1022-0029', 1, 1, 1, 6, 'test_05okt2022_2', 'test_05okt2022_2', '2022-10-05 00:00:00', '1', 'Single Receive', NULL, 'https://static.rpx.co.id/wms_web_dev/inbound/5FyCp3TzZGnKOuT2I23GvMan3nafbQvzq7q7exe9.png', 'https://static.rpx.co.id/wms_web_dev/inbound/sghZh9NvxAJMNfSKVufMYAwQxVmykiFLWl4cE2uu.png', 'https://static.rpx.co.id/wms_web_dev/inbound/v2jquVdyCssbA6zHMrN8fJJUl5xowdtqmHixNOxX.png', 'N', 'N', 'mariofrans', '2022-10-05 12:09:39', NULL, NULL),
	(18, 'CBT-IN-1022-0019', 1, 1, 1, 6, 'test_05okt2022_1_up', 'test_05okt2022_1', '2022-10-05 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-05 11:43:43', 'mariofrans', '2022-10-05 17:15:33'),
	(31, 'CBT-IN-1022-0032', 1, 1, 1, 6, 'test_10okt22_1', 'test_10okt22_1', '2022-10-25 00:00:00', '1', 'Single Receive', 'undefined', '', '', '', 'N', 'N', 'mariofrans', '2022-10-07 13:36:27', 'mariofrans', '2022-10-07 14:48:08'),
	(32, 'CBT-IN-1022-0033', 1, 1, 1, 6, 'test_upload_atmi', 'test_upload_atmi', '2022-07-10 00:00:00', '2', 'Single Receive', 'test', '', '', '', 'N', 'N', 'mariofrans', '2022-10-07 14:42:03', NULL, NULL),
	(33, 'CBT-IN-1022-0034', 1, 1, 1, 6, 'test_10okt2022_1', 'test_10okt2022_1', '2022-10-10 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-10-10 10:10:30', 'mariofrans', '2022-10-10 10:55:27'),
	(34, 'CBT-IN-1022-0035', 1, 1, 1, 6, 'test_atmi_101022', 'test_atmi_101022', '2022-10-10 00:00:00', '2', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-10 11:00:01', 'mariofrans', '2022-10-10 11:00:32'),
	(35, 'CBT-IN-1022-0036', 1, 1, 1, 6, 'test_10okt2022_2', 'test_10okt2022_2', '2022-10-10 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-10 11:37:46', 'mariofrans', '2022-10-11 16:44:26'),
	(36, 'CBT-IN-1022-0037', 1, 1, 1, 6, 'test_atmi_1110', 'test_atmi_1110', '2022-10-11 00:00:00', '2', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-11 13:53:56', 'mariofrans', '2022-10-11 16:44:01'),
	(37, 'CBT-IN-1022-0038', 1, 1, 1, 6, 'test_11okt2022_1', 'test_11okt2022_1', '2022-10-12 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-11 16:49:01', 'mariofrans', '2022-10-26 08:51:31'),
	(39, 'CBT-IN-1022-0040', 1, 1, 1, 6, 'test_26okt22_1', 'test_26okt22_1', '2022-10-28 00:00:00', '1', 'Single Receive', 'undefined', '', '', '', 'N', 'N', 'mariofrans', '2022-10-26 08:53:45', 'mariofrans', '2022-10-26 08:55:35'),
	(40, 'CBT-IN-1022-0041', 1, 1, 1, 6, 'test_26okt22_1', 'test_26okt22_1', '2022-10-28 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'N', 'N', 'mariofrans', '2022-10-26 09:03:09', 'mariofrans', '2022-10-26 10:11:15'),
	(41, 'CBT-IN-1022-0042', 1, 1, 1, 2, 'test_26okt22_2', 'test_26okt22_2', '2022-10-27 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'test_staff', '2022-10-26 10:12:18', 'test_staff', '2022-10-27 15:59:35'),
	(42, 'CBT-IN-1022-0043', 1, 1, 1, 2, 'test_281022', 'test_281022', '2022-10-28 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-10-28 15:10:08', 'test_admin', '2022-11-03 12:41:01'),
	(43, 'CBT-IN-1122-0013', 1, 1, 1, 2, 'test_01nov2022_1', 'test_01nov2022_1', '2022-11-01 00:00:00', '1', 'Single Receive', NULL, '', '', '', 'Y', 'N', 'mariofrans', '2022-11-01 10:52:40', 'test_staff', '2022-11-01 11:08:23');
/*!40000 ALTER TABLE `t_wh_inbound_planning_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_detail
DROP TABLE IF EXISTS `t_wh_inbound_planning_detail`;
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

-- Dumping data for table wms.t_wh_inbound_planning_detail: 92 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning_detail` (`inbound_planning_no`, `SKU`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty`, `uom_name`, `stock_id`, `clasification_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-IN-0123-0005', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'UNIT', NULL, 1, 'mariofrans', '2023-01-12 10:11:01', NULL, NULL),
	('CBT-IN-0123-0004', '32L5995', 'TV Toshiba 32L5995', '', '32L599509012023', '', '', '', '', NULL, 20, 'SET', NULL, 1, 'atmi', '2023-01-09 14:03:40', NULL, NULL),
	('CBT-IN-0123-0004', '112233447', 'Teh Kotak Apel', '09012020', '', '', '', '', '', '2025-01-09 00:00:00', 100, 'PIECES', NULL, 1, 'atmi', '2023-01-09 14:03:40', NULL, NULL),
	('CBT-IN-0123-0003', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 100, 'UNIT', NULL, 1, 'mariofrans', '2023-01-09 10:05:27', NULL, NULL),
	('CBT-IN-0123-0002', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 'UNIT', NULL, 1, 'mariofrans', '2023-01-09 09:43:31', NULL, NULL),
	('CBT-IN-0123-0002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 'UNIT', NULL, 1, 'mariofrans', '2023-01-09 09:43:31', NULL, NULL),
	('CBT-IN-0123-0001', '112233447', 'Teh Kotak Apel', '03012023', '', '', '', '', '', '2025-01-03 00:00:00', 45, 'PIECES', NULL, 1, 'mariofrans', '2023-01-03 17:37:22', NULL, NULL),
	('CBT-IN-1222-0018', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2022-12-29 10:13:59', NULL, NULL),
	('CBT-IN-1222-0017', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', NULL, 5, 'PIECES', NULL, 1, 'rdarmawan', '2022-12-22 10:34:34', NULL, NULL),
	('CBT-IN-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06 00:00:00', 50, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 12:23:10', NULL, NULL),
	('CBT-IN-1222-0016', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06 00:00:00', 50, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 12:23:10', NULL, NULL),
	('CBT-IN-1222-0015', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01 00:00:00', 20, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 11:44:02', NULL, NULL),
	('CBT-IN-1222-0015', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01 00:00:00', 20, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 11:44:02', NULL, NULL),
	('CBT-IN-1222-0014', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01 00:00:00', 25, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 09:28:17', NULL, NULL),
	('CBT-IN-1222-0014', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12 00:00:00', 50, 'PIECES', NULL, 1, 'mariofrans', '2022-12-15 09:28:17', NULL, NULL),
	('CBT-IN-1222-0013', '32L5995', 'TV Toshiba 32L5995', '123w', '1234', '', '', '', '', NULL, 5, 'PACK', NULL, 1, 'mariofrans', '2022-12-07 15:52:36', NULL, NULL),
	('CBT-IN-1122-0017', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'atmi', '2022-11-16 08:36:34', NULL, NULL),
	('CBT-IN-1122-0017', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'atmi', '2022-11-16 08:36:34', NULL, NULL),
	('CBT-IN-1122-0016', '32L5995', 'TV Toshiba 32L5995', '1234', '', '', '6780', '', '', NULL, 5, 'PIECES', NULL, 2, 'mariofrans', '2022-11-14 14:07:58', NULL, NULL),
	('CBT-IN-1122-0016', '75016438', 'DISPLAY PANEL V216B1-L02', '1234', '', '', '6789', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2022-11-14 14:07:58', NULL, NULL),
	('CBT-IN-1022-0045', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 5, 'PIECES', NULL, 1, 'mdrajat', '2022-11-11 16:31:01', NULL, NULL),
	('CBT-IN-1022-0045', '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mdr', '2022-11-11 16:31:05', NULL, NULL),
	('CBT-IN-1122-0015', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'mariofrans', '2022-11-09 17:22:54', NULL, NULL),
	('CBT-IN-1122-0015', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'mariofrans', '2022-11-09 17:22:54', NULL, NULL),
	('CBT-IN-1122-0014', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2022-11-09 09:08:23', NULL, NULL),
	('CBT-IN-1122-0014', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2022-11-09 09:08:23', NULL, NULL),
	('CBT-IN-1022-0044', '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'atmi', '2022-11-04 14:02:54', NULL, NULL),
	('CBT-IN-0123-0006', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 10, 'UNIT', NULL, 1, 'mariofrans', '2023-01-12 10:34:40', NULL, NULL),
	('CBT-IN-0123-0007', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 50, 'SET', NULL, 1, 'atmi', '2023-01-13 09:46:07', NULL, NULL),
	('CBT-IN-0123-0007', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'atmi', '2023-01-13 09:46:07', NULL, NULL),
	('CBT-IN-0123-0007', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13 00:00:00', 100, 'PIECES', NULL, 1, 'atmi', '2023-01-13 09:46:07', NULL, NULL),
	('CBT-IN-0123-0007', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13 00:00:00', 20, 'PIECES', NULL, 1, 'atmi', '2023-01-13 09:46:07', NULL, NULL),
	('CBT-IN-0123-0008', '32L5995', 'TV Toshiba 32L5995', '12314', '12131', '', '', '', '', NULL, 5, 'PALLET', NULL, 2, 'mariofrans', '2023-01-17 09:18:39', NULL, NULL),
	('CBT-IN-0123-0009', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 10, 'PALLET', NULL, 1, 'mariofrans', '2023-01-17 09:21:12', NULL, NULL),
	('CBT-IN-0123-0010', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 'SET', NULL, 1, 'mariofrans', '2023-01-19 14:42:38', NULL, NULL),
	('CBT-IN-0123-0011', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 20, 'SET', NULL, 1, 'atmi', '2023-01-19 15:19:54', NULL, NULL),
	('CBT-IN-0123-0012', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 50, 'UNIT', NULL, 1, 'mariofrans', '2023-01-24 09:28:11', NULL, NULL),
	('CBT-IN-0223-0001', '32L5995', 'TV Toshiba 32L5995', '', '32L599502FEB', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'atmi', '2023-02-02 11:49:19', NULL, NULL),
	('CBT-IN-0223-0001', '112233445', 'Teh Kotak Original', '02022023', '', '', '', '', '', '2025-02-02 00:00:00', 20, 'PACK', NULL, 1, 'atmi', '2023-02-02 11:49:19', NULL, NULL),
	('CBT-IN-0223-0002', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03 00:00:00', 25, 'PACK', NULL, 1, 'atmi', '2023-02-03 09:57:10', NULL, NULL),
	('CBT-IN-0223-0002', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'atmi', '2023-02-03 09:57:10', NULL, NULL),
	('CBT-IN-0223-0003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'UNIT', NULL, 1, 'mariofrans', '2023-02-07 13:31:09', NULL, NULL),
	('CBT-IN-0223-0004', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09 00:00:00', 5, 'PACK', NULL, 1, 'mariofrans', '2023-02-08 11:12:58', NULL, NULL),
	('CBT-IN-0223-0005', '112233447', 'Teh Kotak Apel', '20230208', '', '', '', '', '', '2025-02-08 00:00:00', 50, 'PIECES', NULL, 1, 'atmi', '2023-02-08 14:26:38', NULL, NULL),
	('CBT-IN-0223-0005', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'atmi', '2023-02-08 14:26:38', NULL, NULL),
	('CBT-IN-0223-0006', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '2023-02-08 00:00:00', 10, 'ROLL', NULL, 1, 'atmi', '2023-02-08 15:17:55', NULL, NULL),
	('CBT-IN-0223-0007', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 2, 'PACK', NULL, 1, 'mariofrans_spv', '2023-02-09 16:31:46', NULL, NULL),
	('CBT-IN-0223-0008', '75016438', 'DISPLAY PANEL V216B1-L02', '', '1234', '', '', '', '', NULL, 20, 'UNIT', NULL, 1, 'mariofrans', '2023-02-10 17:52:13', NULL, NULL),
	('CBT-IN-0223-0008', '32L5995', 'TV Toshiba 32L5995', '', '1234', '', '', '', '', NULL, 30, 'UNIT', NULL, 1, 'mariofrans', '2023-02-10 17:52:13', NULL, NULL),
	('CBT-IN-0223-0009', '32L5995', 'TV Toshiba 32L5995', '', '20230213', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'atmi', '2023-02-13 13:34:46', NULL, NULL),
	('CBT-IN-0223-0009', '112233447', 'Teh Kotak Apel', '20230213', '', '', '', '', '', '2025-02-13 00:00:00', 25, 'PACK', NULL, 1, 'atmi', '2023-02-13 13:34:46', NULL, NULL),
	('CBT-IN-0223-0010', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 20, 'PIECES', NULL, 1, 'mariofrans_spv', '2023-02-15 14:53:14', NULL, NULL),
	('CBT-IN-0223-0011', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23 00:00:00', 5, 'PIECES', NULL, 1, 'atmi', '2023-02-16 17:31:07', NULL, NULL),
	('CBT-IN-0223-0012', '75016438', 'DISPLAY PANEL V216B1-L02', '', '210223', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'mariofrans_spv', '2023-02-21 11:23:16', NULL, NULL),
	('CBT-IN-0223-0013', '112233447', 'Teh Kotak Apel', '23022023', '', '', '', '', '', '2023-02-23 00:00:00', 50, 'PIECES', NULL, 1, 'atmi', '2023-02-23 09:09:26', NULL, NULL),
	('CBT-IN-0223-0013', '75016438', 'DISPLAY PANEL V216B1-L02', '', '23022023', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'atmi', '2023-02-23 09:09:26', NULL, NULL),
	('CBT-IN-0223-0014', '112233447', 'Teh Kotak Apel', '23022023', '', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'atmi', '2023-02-23 14:47:18', NULL, NULL),
	('CBT-IN-0223-0014', '112233445', 'Teh Kotak Original', '23022023', '', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'atmi', '2023-02-23 14:47:18', NULL, NULL),
	('CBT-IN-0223-0015', '32L5995', 'TV Toshiba 32L5995', '', '23022023', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'atmi', '2023-02-23 16:27:06', NULL, NULL),
	('CBT-IN-0223-0015', '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23 00:00:00', 100, 'PIECES', NULL, 1, 'atmi', '2023-02-23 16:27:06', NULL, NULL),
	('CBT-IN-0323-0001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', '', '', '', '', NULL, 5, 'PIECES', NULL, 1, 'atmi', '2023-03-02 10:55:56', NULL, NULL),
	('CBT-IN-0323-0002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'superadmin', '2023-03-20 14:28:04', NULL, NULL),
	('CBT-IN-0323-0003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'superadmin', '2023-03-20 14:29:40', NULL, NULL),
	('CBT-IN-0323-0049', '75016438', 'DISPLAY PANEL V216B1-L02', '', '20230313', '', '', 'Black', '', '0000-00-00 00:00:00', 20, 'PIECES', NULL, 1, 'demo', '2023-03-24 08:42:38', NULL, NULL),
	('CBT-IN-0323-0004', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'superadmin', '2023-03-24 15:01:17', NULL, NULL),
	('CBT-IN-0323-0005', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 50, 'PACK', NULL, 1, 'atmi', '2023-03-27 13:47:33', NULL, NULL),
	('CBT-IN-0323-0005', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31 00:00:00', 25, 'PIECES', NULL, 1, 'atmi', '2023-03-27 13:47:33', NULL, NULL),
	('CBT-IN-0323-0007', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 123, 'PIECES', NULL, 4, 'bunga', '2023-03-30 13:16:35', NULL, NULL),
	('CBT-IN-0423-0054', '75016438', 'DISPLAY PANEL V216B1-L02', '', '20230313', '', '', 'Black', '', '0000-00-00 00:00:00', 20, 'PIECES', NULL, 1, 'demo', '2023-04-03 08:23:00', NULL, NULL),
	('CBT-IN-0423-0055', 'IC0123', 'IC TV Toshiba 32L5995', '', '20230403', '', '', '', '', '0000-00-00 00:00:00', 50, 'PIECES', NULL, 1, 'demo', '2023-04-03 08:26:14', NULL, NULL),
	('CBT-IN-0423-0001', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', '', '', 'MERAH', '', NULL, 10, 'PACK', NULL, 1, 'superadmin', '2023-04-04 14:17:46', NULL, NULL),
	('CBT-IN-0423-0001', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', '', '', 'BIRU', '', NULL, 50, 'UNIT', NULL, 1, 'superadmin', '2023-04-04 14:17:46', NULL, NULL),
	('CBT-IN-0423-0057', 'IC0123', 'IC TV Toshiba 32L5995', '', '20230403', '', '', '', '', '0000-00-00 00:00:00', 50, 'PIECES', NULL, 1, 'demo', '2023-04-06 08:31:05', NULL, NULL),
	('CBT-IN-0423-0002', 'ABC123', 'Baterai ABC', '', '06042023', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'atmi', '2023-04-06 08:38:19', NULL, NULL),
	('CBT-IN-0423-0003', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', 'IM124', 'P124', 'Hijau', '500ml', '2025-09-06 00:00:00', 84, 'PALLET', NULL, 1, 'test_admin', '2023-04-06 12:10:50', NULL, NULL),
	('CBT-IN-0423-0003', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', 'IM123', 'P123', 'Merah', '600ml', '2027-09-06 00:00:00', 53, 'PACK', NULL, 1, 'test_admin', '2023-04-06 12:10:50', NULL, NULL),
	('CBT-IN-0423-0004', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '17042023', '', '', '', '', NULL, 100, 'UNIT', NULL, 1, 'atmi', '2023-04-17 13:59:01', NULL, NULL),
	('CBT-IN-0423-0004', 'IC0123', 'IC TV Toshiba 32L5995', '', '17042023', '', '', '', '', NULL, 100, 'SET', NULL, 1, 'atmi', '2023-04-17 13:59:01', NULL, NULL),
	('CBT-IN-0523-0001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2023-05-19 10:15:30', NULL, NULL),
	('CBT-IN-0323-0006', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'mariofrans', '2023-05-19 11:23:45', NULL, NULL),
	('CBT-IN-0523-0002', '112233446', 'Teh Kotak Lemon', '', '', '', '', '', '', NULL, 50, 'PIECES', NULL, 1, 'atmi', '2023-05-21 13:34:55', NULL, NULL),
	('CBT-IN-0523-0003', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2026-05-22 00:00:00', 50, 'PIECES', NULL, 1, 'atmi', '2023-05-22 09:33:07', NULL, NULL),
	('CBT-IN-0523-0003', 'ABC456', 'Sirup ABC Jeruk', '', '', '', '', '', '', '2027-05-22 00:00:00', 50, 'PIECES', NULL, 1, 'atmi', '2023-05-22 09:33:07', NULL, NULL),
	('CBT-IN-0523-0004', 'ABC123', 'Baterai ABC', '24052023', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'atmi', '2023-05-24 11:40:43', NULL, NULL),
	('CBT-IN-0523-0004', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', '', '', '', '', NULL, 10, 'PIECES', NULL, 1, 'atmi', '2023-05-24 11:40:43', NULL, NULL),
	('CBT-IN-0623-0001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', NULL, 1, 'PALLET', NULL, 1, 'mariofrans', '2023-06-12 14:47:14', NULL, NULL),
	('CBT-IN-0623-0002', '112233445', 'Teh Kotak Original', '20230626', '', '', '', '', '', '2026-06-26 00:00:00', 24, 'PIECES', NULL, 1, 'atmi', '2023-06-26 14:28:31', NULL, NULL),
	('CBT-IN-0623-0003', 'ABC123', 'Baterai ABC', '20230626', '', '', '', '', '', NULL, 100, 'PIECES', NULL, 1, 'atmi', '2023-06-26 14:49:30', NULL, NULL),
	('CBT-IN-0623-0003', 'ABC456', 'Sirup ABC Jeruk', '20230626', '', '', '', '', '', '2024-06-26 00:00:00', 100, 'PIECES', NULL, 1, 'atmi', '2023-06-26 14:49:30', NULL, NULL),
	('CBT-IN-0724-0001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 100, 'UNIT', NULL, 1, 'superadmin', '2024-07-15 17:00:23', NULL, NULL),
	('CBT-IN-0824-0001', 'CG001', 'Cengkeh', '', '', '', '', '', '', NULL, 400, 'KG', NULL, 1, 'superadmin', '2024-08-26 09:08:06', NULL, NULL),
	('CBT-IN-0824-0002', 'CG001', 'Cengkeh', '', '', '', '', '', '', '2026-12-28 00:00:00', 40, 'Bag', NULL, 2, 'superadmin', '2024-08-28 11:30:27', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_inbound_planning_detail_2
DROP TABLE IF EXISTS `t_wh_inbound_planning_detail_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_inbound_planning_detail_2: 27 rows
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail_2` DISABLE KEYS */;
INSERT INTO `t_wh_inbound_planning_detail_2` (`id`, `inbound_id`, `SKU`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `qty_plan`, `qty_receive`, `discrepancy`, `uom_id`, `pallet_id`, `stock_id`, `clasification_id`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	(1, 2, '47RW1EJ', 'TV Toshiba 47RW1EJ', '123123', '20220101', '123123', '01', 'BLACK', '47"', '0000-00-00 00:00:00', 10, 10, 0, 10, '12345', NULL, 1, 1, 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-14 15:17:54'),
	(2, 2, '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '125536', '20', 'BLACK', '32"', NULL, 12, 10, 12, 10, '12346', NULL, 1, 1, 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-16 11:36:33'),
	(4, 6, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_04okt2022_1', NULL, NULL, NULL, NULL, NULL, NULL, 100, 100, NULL, 10, NULL, 'AV', 1, NULL, 'mariofrans', '2022-10-04 14:31:41', NULL, NULL),
	(5, 7, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_04okt2022_2', NULL, NULL, NULL, NULL, NULL, '2023-10-04 00:00:00', 50, 50, NULL, 10, NULL, 'AV', 1, NULL, 'mariofrans', '2022-10-04 15:40:30', NULL, NULL),
	(6, 8, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_04okt2022_3', NULL, NULL, NULL, NULL, NULL, '2024-03-04 00:00:00', 50, 50, NULL, 10, NULL, 'AV', 1, NULL, 'mariofrans', '2022-10-04 15:41:39', NULL, NULL),
	(24, 30, '32L5995', 'TV Toshiba 32L5995', '202210050002', '47RW1EJSD2S', '', '', 'Grey', '', NULL, 5, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-05 13:06:13', NULL, NULL),
	(22, 28, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_05okt2022_2', '', '', '', '', '', NULL, 10, 10, NULL, 10, NULL, 'AV', 1, NULL, 'mariofrans', '2022-10-05 12:09:39', NULL, NULL),
	(23, 29, '75016438', 'DISPLAY PANEL V216B1-L02', '202210050001', '75016438ABCD', '', '', 'Black', '', NULL, 10, 10, NULL, 10, NULL, 'AV', 1, NULL, 'mariofrans', '2022-10-05 12:19:40', NULL, NULL),
	(25, 18, '75016438', 'DISPLAY PANEL V216B1-L02', 'update', '', '', '', '', '', NULL, 50, NULL, NULL, 9, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-05 17:15:33', NULL, NULL),
	(26, 31, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_10okt22_1', '', '', '', '', '', NULL, 20, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-07 13:36:27', NULL, NULL),
	(27, 32, '75016438', 'DISPLAY PANEL V216B1-L02', '7102022', '75016438HDJ', '', '', '', '', NULL, 10, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-07 14:42:03', NULL, NULL),
	(28, 33, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_10okt2022_1', '', '', '', '', '', NULL, 15, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-10 10:10:30', NULL, NULL),
	(29, 33, '32L5995', 'TV Toshiba 32L5995', 'test_10okt2022_1', '', '', '', '', '', NULL, 10, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-10 10:10:30', NULL, NULL),
	(30, 34, '32L5995', 'TV Toshiba 32L5995', '20221010', '20221010', '', '', '', '', NULL, 5, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-10 11:00:01', NULL, NULL),
	(31, 35, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_10okt2022_2', '', '', '', '', '', NULL, 30, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-10 11:37:46', NULL, NULL),
	(32, 35, '32L5995', 'TV Toshiba 32L5995', 'test_10okt2022_2', '', '', '', '', '', NULL, 45, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-10 11:37:46', NULL, NULL),
	(33, 36, '32L5995', 'TV Toshiba 32L5995', '20221011', 'test20221011', '', '', '', '', NULL, 5, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-11 13:53:56', NULL, NULL),
	(34, 37, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_11okt2022_1', '', '', '', '', '', '2022-10-11 00:00:00', 15, 10, 5, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-11 16:49:01', NULL, NULL),
	(35, 37, '32L5995', 'TV Toshiba 32L5995', 'test_11okt2022_1', '', '', '', '', '', NULL, 25, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-11 16:49:01', NULL, NULL),
	(36, 37, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'test_11okt2022_1', '', '', '', '', '', NULL, 20, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-11 16:49:01', NULL, NULL),
	(37, 39, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_26okt22_1', '', '', '', '', '', NULL, 20, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-26 08:53:45', NULL, NULL),
	(38, 40, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_26okt22_1', '', '', '', '', '', NULL, 20, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-26 09:03:09', NULL, NULL),
	(39, 41, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_26okt22_2', '', '', '', '', '', NULL, 100, 100, 0, 1, NULL, NULL, 1, NULL, 'test_staff', '2022-10-26 10:12:18', 'test_staff', '2022-10-27 15:59:35'),
	(40, 42, '75016438', 'DISPLAY PANEL V216B1-L02', '281022', '', '', '', '', '', NULL, 10, 24, -14, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-28 15:10:08', 'test_admin', '2022-11-03 12:41:01'),
	(41, 42, '32L5995', 'TV Toshiba 32L5995', '281022', '', '', '', '', '', NULL, 10, NULL, NULL, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-10-28 15:10:08', NULL, NULL),
	(42, 2, '75016438', 'TV Toshiba 32L5995', '234423', '42132131', '234123', '01', 'BLACK', '32"', NULL, 15, 10, 2, 10, '12346', NULL, 1, 1, 'atmi', '2022-09-13 14:55:26', 'atmi', '2022-09-16 11:36:33'),
	(101, 43, '75016438', 'DISPLAY PANEL V216B1-L02', 'test_01nov2022_1', '', '', '', '', '', '2022-11-26 00:00:00', 100, 1, 99, 10, NULL, NULL, 1, NULL, 'mariofrans', '2022-11-01 10:52:40', 'test_staff', '2022-11-01 11:08:23');
/*!40000 ALTER TABLE `t_wh_inbound_planning_detail_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_location_inventory
DROP TABLE IF EXISTS `t_wh_location_inventory`;
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

-- Dumping data for table wms.t_wh_location_inventory: 89 rows
/*!40000 ALTER TABLE `t_wh_location_inventory` DISABLE KEYS */;
INSERT INTO `t_wh_location_inventory` (`location_id`, `location_type`, `client_project_id`, `pallet_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `clasification_id`, `on_hand_qty`, `allocated_qty`, `picked_qty`, `available_qty`, `uom_name`, `stock_id`, `gr_id`, `gr_datetime`, `last_movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('test_location_1', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 1, 5, 17, 0, 0, 'PACK', 'AV', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0824-0001', 'atmi', '2023-02-03 10:29:14', 'superadmin', '2024-08-28 15:50:44', 'Y'),
	('R1F3', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', NULL, '', '', '', '', NULL, 1, -18, 12, 0, 10, 'PIECES', 'DMG', '', NULL, 'CBT-08-0824-0002', NULL, NULL, 'superadmin', '2024-08-28 15:52:26', 'Y'),
	('1A1-001-002', 'Racking', 1, 'RPX012453', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 1, 55, 23, 0, 72, 'PIECES', 'AV', 'CBT-GR-1022-0043', '2022-11-06 17:01:27', 'CBT-08-0423-0002', 'atmi', '2022-11-07 09:29:01', 'atmi', '2023-05-23 20:17:59', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 1, 45, 7, 4, 34, 'PIECES', 'AV', 'CBT-GR-1022-0043', '2022-11-06 17:01:27', 'CBT-08-0423-0003', 'atmi', '2022-11-07 09:29:01', 'mariofrans_spv', '2023-06-13 17:19:06', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 1, 20, 0, 1, 0, 'PIECES', 'AV', 'CBT-GR-1122-0017', '2022-11-16 09:07:52', 'CBT-01-1122-0020', 'atmi', '2022-11-16 10:27:16', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 10, 10, 1, 8, 'PIECES', 'AV', 'CBT-GR-1122-0017', '2022-11-16 09:07:52', 'CBT-08-1122-0002', 'atmi', '2022-11-16 10:29:40', 'atmi', '2022-11-21 11:35:46', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 10, 0, 1, 4, 'PIECES', 'AV', 'CBT-GR-1122-0017', '2022-11-16 09:07:52', 'CBT-01-1122-0020', 'atmi', '2022-11-16 10:29:51', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 1, 48, 0, 0, 48, 'PIECES', 'AV', '', NULL, NULL, NULL, NULL, 'atmi', '2022-11-24 16:24:45', 'Y'),
	('1A1-002-002', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 17, 0, 0, 17, 'PIECES', 'AV', '', NULL, 'CBT-08-0523-0003', NULL, NULL, 'atmi', '2023-05-04 14:22:11', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 1, 30, 7, 1, 30, 'PIECES', 'AV', 'CBT-GR-1222-0014', '2022-12-15 10:55:31', 'CBT-10-0323-0001', 'mariofrans', '2022-12-15 11:16:20', 'atmi', '2023-03-20 17:01:44', 'Y'),
	('1A1-002-002', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 1, 21, 4, 0, 24, 'PIECES', 'AV', 'CBT-GR-1222-0014', '2022-12-15 10:55:31', 'CBT-08-0523-0005', 'mariofrans', '2022-12-15 11:18:23', 'atmi', '2023-05-04 14:03:44', 'Y'),
	('1A1-001-003', 'Racking', 1, NULL, '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 1, 3, 20, 10, 2, 'PIECES', 'AV', 'CBT-GR-1222-0015', '2022-12-15 12:04:55', 'CBT-08-0323-0001', 'mariofrans', '2022-12-15 12:13:58', 'atmi', '2023-03-20 15:49:55', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 1, 17, 0, 1, 16, 'PIECES', 'AV', 'CBT-GR-1222-0015', '2022-12-15 12:04:55', 'CBT-09-0123-0004', 'mariofrans', '2022-12-15 12:16:28', 'mariofrans', '2023-01-06 15:23:22', 'Y'),
	('1A1-001-003', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 1, 80, 10, 2, 77, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-08-0523-0003', 'mariofrans', '2022-12-15 13:02:40', 'atmi', '2023-05-04 14:22:11', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-09-0223-0001', 'mariofrans', '2022-12-15 13:05:44', 'atmi', '2023-03-30 15:19:57', 'Y'),
	('R1F2', '', 1, NULL, '112233446', 'Teh Kotak Lemon', '20201212', '', '', '', '', '', '2023-12-12', 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-1222-0014', NULL, NULL, 'mariofrans', '2023-01-03 09:12:03', NULL, NULL, 'Y'),
	('RF08-01', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-01-31', 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-1222-0016', NULL, NULL, NULL, NULL, NULL, NULL, 'Y'),
	('RC09-01', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-06-06', 1, 5, -2, 2, 3, 'PIECES', 'AV', 'CBT-GR-1122-0017', NULL, NULL, NULL, NULL, NULL, NULL, 'Y'),
	('R1F3', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-1122-0017', NULL, NULL, 'mariofrans', '2023-01-03 16:28:33', NULL, NULL, 'Y'),
	('R1F3', '', 1, NULL, '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 1, 5, 0, 2, 3, '', 'QR', 'CBT-GR-1222-0015', '2022-12-15 12:04:55', 'CBT-01-1222-0014', 'mariofrans', '2023-01-03 16:32:04', NULL, NULL, 'Y'),
	('R1F2', '', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-01-1222-0014', 'mariofrans', '2023-01-04 12:05:30', NULL, NULL, 'Y'),
	('R1F3', '', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 1, 12, -3, 3, 12, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-09-0123-0005', 'mariofrans', '2023-01-04 12:05:51', 'mariofrans', '2023-01-06 15:23:22', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 5, 0, 0, 5, 'UNIT', 'AV', 'CBT-GR-0123-0006', '2023-01-12 10:36:54', 'CBT-01-0123-0004', 'mariofrans', '2023-01-12 11:14:04', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 5, 0, 0, 5, 'UNIT', 'DMG', 'CBT-GR-0123-0006', '2023-01-12 10:36:54', 'CBT-01-0123-0004', 'mariofrans', '2023-01-12 11:14:04', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 1, 54, 27, 2, 52, 'PIECES', 'AV', 'CBT-GR-0123-0007', '2023-01-13 10:18:21', 'CBT-08-0123-0003', 'atmi', '2023-01-13 11:11:36', 'atmi', '2023-02-24 09:06:44', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13', 1, 30, 0, 0, 30, 'PIECES', 'AV', 'CBT-GR-0123-0007', '2023-01-13 10:18:21', 'CBT-01-0123-0005', 'atmi', '2023-01-13 11:11:36', 'atmi', '2023-02-24 09:06:44', 'Y'),
	('FL001', 'Bulk', 1, '', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', '0000-00-00', 1, 50, 0, 0, 50, 'PIECES', 'AV', 'CBT-GR-0123-0007', '2023-01-13 10:18:21', 'CBT-01-0123-0005', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('1B1-001-001', 'Racking', 1, NULL, 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 1, 50, 10, 10, 20, 'SET', 'AV', 'CBT-GR-0123-0007', '2023-01-13 10:18:21', 'CBT-01-0123-0005', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('R1F3', '', 1, NULL, '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 1, 10, 5, 0, 5, 'PIECES', 'DMG', 'CBT-GR-0123-0007', '2023-01-13 10:18:21', 'CBT-10-0123-0008', 'atmi', '2023-01-13 19:05:17', 'atmi', '2023-01-15 17:39:40', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 1, 5, 1, 1, 3, 'PALLET', 'AV', 'CBT-GR-0123-0009', '2023-01-17 09:54:01', 'CBT-08-0323-0002', 'mariofrans', '2023-01-17 09:58:29', 'atmi', '2023-03-20 16:37:38', 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 1, 20, 3, 5, 10, 'PALLET', 'DMG', 'CBT-GR-0123-0009', '2023-01-17 09:54:01', 'CBT-01-0123-0006', 'mariofrans', '2023-01-17 09:58:29', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '', '', '', '', NULL, NULL, 3, 0, 0, 3, 'PIECES', 'AV', 'CBT-GR-1022-0001', NULL, 'CBT-08-0123-0011', 'mariofrans', '2023-01-19 08:58:15', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, NULL, 25, 5, 1, 14, 'UNIT', 'AV', 'CBT-GR-0123-0012', NULL, 'CBT-08-0123-0015', 'mariofrans', '2023-01-24 09:54:17', 'mariofrans', '2023-01-24 10:08:06', 'Y'),
	('1A1-001-003', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, NULL, 25, 0, 3, 19, 'UNIT', 'AV', 'CBT-GR-0123-0012', NULL, 'CBT-08-0123-0014', 'mariofrans', '2023-01-24 10:01:37', 'mariofrans_spv', '2023-06-13 17:19:06', 'Y'),
	('test_location_2', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 1, 15, 0, 0, 15, 'PIECES', 'AV', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0223-0002', 'atmi', '2023-02-03 10:29:14', 'atmi', '2023-02-03 11:03:33', 'Y'),
	('test_location_2', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 2, 10, 0, 0, 10, 'PACK', 'AV', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0223-0001', 'atmi', '2023-02-03 10:54:27', NULL, NULL, 'Y'),
	('test_location_1', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 1, 4, 0, 0, 4, 'PIECES', 'AV', 'CBT-GR-0223-0002', NULL, 'CBT-08-0223-0002', 'atmi', '2023-02-03 11:03:33', 'atmi', '2023-02-03 11:18:52', 'Y'),
	('test_location_2', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 1, 1, 0, 0, 1, 'PIECES', 'DMG', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0223-0002', 'atmi', '2023-02-03 11:18:52', NULL, NULL, 'Y'),
	('test_location_2', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 2, 5, 0, 0, 5, 'PIECES', 'AV', '', NULL, 'CBT-08-0223-0003', 'atmi', '2023-02-07 09:27:30', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '2023-02-08', 1, 9, 0, 0, 9, 'ROLL', 'AV', 'CBT-GR-0223-0006', '2023-02-08 15:25:24', 'CBT-01-0223-0003', 'atmi', '2023-02-09 09:55:09', NULL, NULL, 'Y'),
	('1A1-001-003', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, NULL, 5, 1, 0, 4, 'PIECES', 'AV', 'CBT-GR-1022-0043', NULL, 'CBT-08-0223-0004', 'atmi', '2023-02-09 10:13:47', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 1, 5, 5, 0, 0, 'PIECES', 'AV', 'CBT-GR-0223-0011', '2023-02-16 17:39:08', 'CBT-01-0223-0004', 'atmi', '2023-02-16 17:41:21', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 1, 80, 0, 0, 80, 'PIECES', 'AV', 'CBT-GR-0223-0015', '2023-02-23 16:51:57', 'CBT-08-0223-0008', 'atmi', '2023-02-23 16:57:22', 'atmi', '2023-02-24 09:01:55', 'Y'),
	('FL001', 'Bulk', 1, NULL, '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 1, 95, 0, 2, 98, 'PIECES', 'AV', 'CBT-GR-0223-0015', '2023-02-23 16:51:57', 'CBT-08-0523-0004', 'atmi', '2023-02-23 16:57:22', 'atmi', '2023-07-03 20:10:23', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '23022023', '', '', '', '', NULL, 1, 100, 0, 0, 100, 'PIECES', 'AV', 'CBT-GR-0223-0015', '2023-02-23 16:51:57', 'CBT-01-0223-0005', 'atmi', '2023-02-23 16:57:22', NULL, NULL, 'Y'),
	('test_location_2', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 1, 20, 0, 0, 20, 'PIECES', 'AV', 'CBT-GR-0223-0015', '2023-02-23 16:51:57', 'CBT-08-0223-0008', 'atmi', '2023-02-24 09:01:55', NULL, NULL, 'Y'),
	('FL001', 'Bulk', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', '', '', '', '', NULL, 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-0323-0001', '2023-03-18 23:16:44', 'CBT-01-0323-0001', 'atmi', '2023-03-18 23:18:33', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 1, 9, 0, 0, 9, 'PIECES', 'AV', 'CBT-GR-0323-0003', '2023-03-20 14:42:17', 'CBT-01-0323-0002', 'atmi', '2023-03-20 15:27:30', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 1, 9, 0, 0, 9, 'PIECES', 'AV', 'CBT-GR-0323-0003', '2023-03-20 14:42:17', 'CBT-01-0323-0002', 'atmi', '2023-03-20 15:27:30', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, NULL, '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 1, 5, 0, 0, 5, 'PALLET', 'AV', 'CBT-GR-0123-0009', '2023-01-17 09:54:01', 'CBT-08-0323-0002', 'atmi', '2023-03-20 16:37:38', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0323-0002', '2023-03-21 09:28:46', 'CBT-02-0323-0001', 'atmi', '2023-03-21 14:35:40', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0323-0002', '2023-03-21 09:28:46', 'CBT-02-0323-0001', 'atmi', '2023-03-21 14:35:40', NULL, NULL, 'Y'),
	('1A1-001-001', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09', 1, 5, 0, 0, 5, 'PACK', 'AV', 'CBT-GR-0223-0004', '2023-02-08 11:41:50', 'CBT-01-0223-0002', 'superadmin', '2023-03-24 09:05:25', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09', 1, 5, 0, 0, 5, 'PACK', 'AV', 'CBT-GR-0223-0004', '2023-02-08 11:41:50', 'CBT-01-0223-0002', 'superadmin', '2023-03-24 09:05:25', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, '', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 1, 10, 0, 2, 5, 'PIECES', 'AV', 'CBT-GR-0323-0004', '2023-03-24 15:04:59', 'CBT-01-0323-0003', 'atmi', '2023-03-24 16:01:25', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, '', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 1, 10, 0, 1, 9, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '2023-03-24 15:04:59', 'CBT-01-0323-0003', 'atmi', '2023-03-24 16:02:02', NULL, NULL, 'Y'),
	('DMG01-001', 'Quarantine', 1, '', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 1, 15, 4, 2, 9, 'PIECES', 'AV', 'CBT-GR-0323-0004', '2023-03-24 15:04:59', 'CBT-01-0323-0003', 'atmi', '2023-03-24 16:02:43', 'atmi', '2023-05-19 16:12:46', 'Y'),
	('test_location_1', 'Racking', 1, '', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 1, 15, 3, 2, 8, 'PIECES', 'DMG', 'CBT-GR-0323-0004', '2023-03-24 15:04:59', 'CBT-09-0323-0001', 'atmi', '2023-03-24 16:03:30', 'superadmin', '2023-03-28 09:12:51', 'Y'),
	('R1F3', '', 1, NULL, 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', '', '', '', '', NULL, 1, 2, 0, 0, 2, 'PIECES', 'DMG', 'CBT-GR-0323-0004', NULL, NULL, 'atmi', '2023-03-27 09:33:09', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, '', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 1, 5, 2, 0, 3, 'PIECES', 'AV', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-08-0523-0006', NULL, NULL, 'atmi', '2023-05-12 15:20:24', 'Y'),
	('1A1-001-002', 'Racking', 1, '', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 1, 10, 7, 0, 3, 'PIECES', 'AV', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-01-0323-0004', NULL, NULL, NULL, NULL, 'Y'),
	('DMG-001-001', 'Racking', 1, '', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 1, 5, 0, 0, 5, 'PIECES', 'DMG', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-01-0323-0004', NULL, NULL, NULL, NULL, 'Y'),
	('DMG-001-001', 'Racking', 1, '', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 1, 5, 0, 1, 4, 'PACK', 'DMG', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-08-0523-0006', NULL, NULL, 'atmi', '2023-05-12 15:20:24', 'Y'),
	('test_location_1', 'Racking', 1, '', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 1, 20, 3, 2, 15, 'PACK', 'AV', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-01-0323-0004', NULL, NULL, 'mariofrans_spv', '2023-06-13 16:39:48', 'Y'),
	('test_location_2', 'Racking', 1, '', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 1, 20, 3, 2, 15, 'PACK', 'AV', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-01-0323-0004', NULL, NULL, 'mariofrans_spv', '2023-06-13 16:39:48', 'Y'),
	('test_location_1', 'Racking', 1, '', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0223-0010', '2023-04-05 13:21:44', 'CBT-01-0423-0001', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, '', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', '', '', 'MERAH', '', NULL, 1, 10, 0, 8, 2, 'PACK', 'AV', 'CBT-GR-0423-0001', '2023-04-04 14:51:04', 'CBT-08-0423-0001', NULL, NULL, 'test_admin', '2023-04-04 15:00:16', 'Y'),
	('1A1-001-003', 'Racking', 1, '', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', '', '', 'BIRU', '', NULL, 1, 50, 0, 0, 50, 'UNIT', 'AV', 'CBT-GR-0423-0001', '2023-04-04 14:51:04', 'CBT-03-0423-0001', NULL, NULL, NULL, NULL, 'Y'),
	('test_location_2', 'Racking', 1, '', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0223-0010', '2023-04-05 13:21:44', 'CBT-01-0423-0001', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, '', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', 'IM124', 'P124', 'Hijau', '500ml', '2025-09-06', 1, 84, 5, 3, 76, 'PALLET', 'AV', 'CBT-GR-0423-0003', '2023-04-06 12:50:03', 'CBT-01-0423-0002', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, '', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', 'IM123', 'P123', 'Merah', '600ml', '2027-09-06', 1, 53, 0, 0, 53, 'PACK', 'AV', 'CBT-GR-0423-0003', '2023-04-06 12:50:03', 'CBT-01-0423-0002', NULL, NULL, NULL, NULL, 'Y'),
	('test_location_2', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-08-0423-0004', 'atmi', '2023-04-19 11:44:18', NULL, NULL, 'Y'),
	('DMG-001-001', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 3, 0, 0, 3, 'PIECES', 'AV', '', NULL, 'CBT-08-0523-0003', 'atmi', '2023-05-04 14:22:11', NULL, NULL, 'Y'),
	('test_location_1', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-1222-0016', '2022-12-15 12:55:16', 'CBT-08-0523-0003', 'atmi', '2023-05-04 14:22:11', NULL, NULL, 'Y'),
	('test_location_1', 'Racking', 1, NULL, '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-0223-0015', '2023-02-23 16:51:57', 'CBT-08-0523-0004', 'atmi', '2023-07-03 20:10:23', NULL, NULL, 'Y'),
	('FL001', 'Bulk', 1, NULL, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 1, 5, 0, 0, 5, 'PACK', 'DMG', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-08-0523-0006', 'atmi', '2023-05-12 15:20:24', NULL, NULL, 'Y'),
	('R1F3', 'Bulk', 1, NULL, '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 1, 5, 0, 0, 5, 'PIECES', 'AV', 'CBT-GR-0323-0005', '2023-03-27 14:05:54', 'CBT-08-0523-0006', 'atmi', '2023-05-12 15:20:24', NULL, NULL, 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '112233445', 'Teh Kotak Original', '20230113', '', NULL, NULL, NULL, NULL, '2025-01-13', NULL, 60, 0, 0, 60, 'PIECES', 'AV', '', NULL, 'CBT-08-0123-0003', 'atmi', '2023-05-24 15:10:26', 'atmi', '2023-05-24 15:24:07', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, 0, 16, 'PIECES', 'DMG', '', NULL, 'CBT-08-0123-0002', 'atmi', '2023-05-24 15:34:06', 'mariofrans_spv', '2023-05-24 15:46:35', 'Y'),
	('1A1-012', 'Bulk', 1, '', 'ABC123', 'Baterai ABC', '24052023', '', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0523-0004', '2023-05-24 18:46:41', 'CBT-01-0523-0001', NULL, NULL, NULL, NULL, 'Y'),
	('FL001', 'Bulk', 1, '', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', '', '', '', '', NULL, 1, 10, 0, 0, 10, 'PIECES', 'AV', 'CBT-GR-0523-0004', '2023-05-24 18:46:41', 'CBT-01-0523-0001', NULL, NULL, NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 292, 0, 0, 292, 'UNIT', 'AV', 'CBT-GR-0423-0004', '2023-06-06 19:34:05', 'CBT-01-0523-0002', 'atmi', '2023-06-06 19:34:05', 'atmi', '2023-06-06 19:53:12', 'Y'),
	('1B1-001-001', 'Racking', 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', 'Black', '', NULL, 1, 20, 0, 0, 20, 'PIECES', 'AV', 'CBT-GR-0323-0049', '2023-06-06 19:41:25', 'CBT-01-0423-0003', 'atmi', '2023-06-06 19:41:25', NULL, NULL, 'Y'),
	('FL001', 'Bulk', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 100, 0, 0, 100, 'UNIT', 'AV', 'CBT-GR-0423-0004', '2023-06-06 19:34:05', 'CBT-01-0523-0002', 'atmi', '2023-06-06 19:34:05', 'atmi', '2023-06-06 19:53:12', 'Y'),
	('test_location_1', 'Racking', 1, NULL, 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 1, 400, 0, 0, 400, 'SET', 'AV', 'CBT-GR-0423-0004', '2023-06-06 19:34:05', 'CBT-01-0523-0002', 'atmi', '2023-06-06 19:34:05', 'atmi', '2023-06-06 19:53:12', 'Y'),
	('1A1-001-002', 'Racking', 1, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 1, 2, 0, 0, 2, 'UNIT', 'AV', 'CBT-GR-0423-0004', '2023-06-06 19:53:12', 'CBT-01-0523-0002', 'atmi', '2023-06-06 19:53:12', NULL, NULL, 'Y'),
	('FL001', 'Bulk', 1, '', 'CG001', 'Cengkeh', '', '', '', '', '', '', '2026-12-28', 2, 40, 0, 0, 40, 'Bag', 'AV', 'CBT-GR-0824-0002', '2024-08-28 11:44:03', 'CBT-01-0824-0004', NULL, NULL, NULL, NULL, 'Y'),
	('', '', 1, NULL, '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 1, 4, 0, 0, 4, 'PACK', 'AV', 'CBT-GR-0223-0002', '2023-02-03 10:21:46', 'CBT-08-0824-0001', 'superadmin', '2024-08-28 15:50:44', NULL, NULL, 'Y'),
	('1A1-001-001', 'Bulk', 1, NULL, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, NULL, 5, 0, 0, 5, 'PIECES', 'DMG', '', NULL, 'CBT-08-0824-0002', 'superadmin', '2024-08-28 15:53:23', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_location_inventory` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_log_api
DROP TABLE IF EXISTS `t_wh_log_api`;
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
DROP TABLE IF EXISTS `t_wh_moved_movement`;
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

-- Dumping data for table wms.t_wh_moved_movement: 11 rows
/*!40000 ALTER TABLE `t_wh_moved_movement` DISABLE KEYS */;
INSERT INTO `t_wh_moved_movement` (`movement_id`, `process_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `expired_date`, `qty`, `uom_name`, `stock_id`, `location_from`, `location_type_from`, `location_to`, `location_type_to`, `warehouseman`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-03-0423-0001', 3, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', '', '0000-00-00 00:00:00', 3, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'test_admin', 'Y', 'test_admin', '2023-06-05 11:47:48', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', 3, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', '', '0000-00-00 00:00:00', 1, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Bulk', 'test_admin', 'Y', 'test_admin', '2023-06-05 11:47:48', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', 3, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', '', '0000-00-00 00:00:00', 1, 'PACK', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'test_admin', 'Y', 'test_admin', '2023-06-05 11:47:48', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 73, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 13:09:07', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 25, 'UNIT', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 13:09:07', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 2, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-06 15:47:17', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 100, 'SET', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-06 16:19:13', NULL, NULL, 'Y'),
	('CBT-01-0423-0003', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 20, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1B1-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-06 19:41:14', NULL, NULL, 'Y'),
	('CBT-01-0423-0004', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 25, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 19:42:41', NULL, NULL, 'Y'),
	('CBT-01-0423-0004', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 25, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-06 19:42:50', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 25, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 19:43:42', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_moved_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_movement
DROP TABLE IF EXISTS `t_wh_movement`;
CREATE TABLE IF NOT EXISTS `t_wh_movement` (
  `movement_id` varchar(50) NOT NULL DEFAULT '',
  `client_project_id` int(11) NOT NULL DEFAULT 0,
  `movement_date` date DEFAULT NULL,
  `status_id` varchar(3) DEFAULT '',
  `user_created` varchar(50) DEFAULT '',
  `datetime_created` datetime DEFAULT NULL,
  `user_updated` varchar(50) DEFAULT NULL,
  `datetime_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`movement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_movement: 43 rows
/*!40000 ALTER TABLE `t_wh_movement` DISABLE KEYS */;
INSERT INTO `t_wh_movement` (`movement_id`, `client_project_id`, `movement_date`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-08-1122-00001', 1, '2022-11-02', 'OPM', 'atmi', NULL, NULL, NULL),
	('CBT-08-1122-0002', 1, '2022-11-18', 'COM', 'atmi', '2022-11-18 15:28:27', 'atmi', '2022-11-21 10:42:46'),
	('CBT-08-0123-0001', 1, NULL, 'OPM', 'mariofrans', '2023-01-11 11:23:02', NULL, NULL),
	('CBT-08-0123-0002', 1, '2023-01-12', 'COM', 'mariofrans', '2023-01-11 11:24:24', 'mariofrans_spv', '2023-05-24 15:46:35'),
	('CBT-08-0123-0003', 1, '2023-01-15', 'MOM', 'atmi', '2023-01-15 15:28:05', 'atmi', '2023-05-24 15:24:07'),
	('CBT-08-0123-0004', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 11:28:42', NULL, NULL),
	('CBT-08-0123-0005', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 11:28:59', NULL, NULL),
	('CBT-08-0123-0006', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 11:29:57', NULL, NULL),
	('CBT-08-0123-0007', 1, '2023-01-16', 'MOM', 'atmi', '2023-01-16 11:58:51', 'atmi', '2023-04-05 14:46:28'),
	('CBT-08-0123-0008', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 12:01:25', 'atmi', '2023-05-23 16:54:15'),
	('CBT-08-0123-0009', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 12:01:28', NULL, NULL),
	('CBT-08-0123-0010', 1, '2023-01-16', 'OPM', 'atmi', '2023-01-16 12:02:58', NULL, NULL),
	('CBT-08-0123-0011', 1, NULL, 'COM', 'mariofrans', '2023-01-18 10:07:45', 'mariofrans', '2023-01-19 08:58:15'),
	('CBT-08-0123-0012', 1, NULL, 'OPM', 'mariofrans', '2023-01-18 10:07:45', NULL, NULL),
	('CBT-08-0123-0013', 1, '2023-01-24', 'COM', 'mariofrans', '2023-01-24 09:34:46', 'mariofrans', '2023-01-24 09:54:17'),
	('CBT-08-0123-0014', 1, NULL, 'COM', 'mariofrans', '2023-01-24 09:59:38', 'mariofrans', '2023-01-24 10:01:37'),
	('CBT-08-0123-0015', 1, NULL, 'CAM', 'mariofrans', '2023-01-24 10:02:20', 'mariofrans', '2023-01-24 10:08:06'),
	('CBT-08-0223-0001', 1, '2023-02-03', 'COM', 'atmi', '2023-02-03 10:45:16', 'atmi', '2023-02-03 10:54:27'),
	('CBT-08-0223-0002', 1, '2023-02-03', 'COM', 'atmi', '2023-02-03 11:01:11', 'atmi', '2023-02-03 11:03:33'),
	('CBT-08-0223-0003', 1, '2023-02-07', 'COM', 'atmi', '2023-02-07 09:26:46', 'atmi', '2023-02-07 09:27:30'),
	('CBT-08-0223-0004', 1, '2023-02-09', 'COM', 'atmi', '2023-02-09 10:11:34', 'atmi', '2023-02-09 10:13:47'),
	('CBT-08-0223-0005', 1, '2023-02-09', 'COM', 'atmi', '2023-02-09 10:15:57', 'atmi', '2023-02-09 10:17:01'),
	('CBT-08-0223-0006', 1, '2023-02-09', 'CAM', 'mariofrans', '2023-02-09 10:17:07', 'mariofrans', '2023-02-09 10:17:20'),
	('CBT-08-0223-0007', 1, NULL, 'CAM', 'atmi', '2023-02-24 08:58:49', 'atmi', '2023-02-24 08:59:05'),
	('CBT-08-0223-0008', 1, '2023-02-24', 'COM', 'atmi', '2023-02-24 09:00:08', 'atmi', '2023-02-24 09:01:55'),
	('CBT-08-0323-0001', 1, '2023-03-20', 'OPM', 'atmi', '2023-03-20 15:49:55', NULL, NULL),
	('CBT-08-0323-0002', 1, '2023-03-20', 'COM', 'atmi', '2023-03-20 15:49:55', 'atmi', '2023-03-20 16:37:38'),
	('CBT-08-0323-0003', 1, '2023-03-31', 'MOM', 'atmi', '2023-03-30 15:14:07', 'atmi', '2023-04-05 15:35:12'),
	('CBT-08-0323-0004', 1, '2023-03-31', 'MOM', 'atmi', '2023-03-30 15:14:07', 'atmi', '2023-03-30 15:15:48'),
	('CBT-08-0423-0001', 1, '2023-04-07', 'COM', 'test_admin', '2023-04-04 14:58:14', 'test_admin', '2023-04-04 15:00:16'),
	('CBT-08-0423-0002', 1, '2023-04-14', 'MOM', 'atmi', '2023-04-14 09:11:24', 'atmi', '2023-05-23 20:26:04'),
	('CBT-08-0423-0003', 1, '2023-04-14', 'MOM', 'atmi', '2023-04-14 09:11:24', 'atmi', '2023-04-19 11:11:54'),
	('CBT-08-0423-0004', 1, '2023-04-14', 'COM', 'atmi', '2023-04-14 09:11:24', 'atmi', '2023-04-19 11:44:18'),
	('CBT-08-0423-0005', 1, '2023-04-27', 'MOM', 'atmi', '2023-04-27 17:37:56', 'atmi', '2023-07-03 15:36:04'),
	('CBT-08-0523-0001', 1, '2023-05-04', 'OPM', 'atmi', '2023-05-04 12:34:58', NULL, NULL),
	('CBT-08-0523-0002', 1, '2023-05-04', 'OPM', 'atmi', '2023-05-04 12:34:58', NULL, NULL),
	('CBT-08-0523-0003', 1, '2023-05-04', 'COM', 'atmi', '2023-05-04 13:46:33', 'atmi', '2023-05-04 14:22:11'),
	('CBT-08-0523-0004', 1, '2023-05-04', 'COM', 'atmi', '2023-05-04 14:03:44', 'atmi', '2023-07-03 20:10:23'),
	('CBT-08-0523-0005', 1, '2023-05-04', 'MOM', 'atmi', '2023-05-04 14:03:44', 'atmi', '2023-05-23 09:28:59'),
	('CBT-08-0523-0006', 1, '2023-05-12', 'COM', 'atmi', '2023-05-12 15:05:10', 'atmi', '2023-05-12 15:20:24'),
	('CBT-08-0623-0001', 1, NULL, 'OPM', 'bunga', '2023-06-13 13:08:28', NULL, NULL),
	('CBT-08-0824-0001', 1, '2024-08-29', 'COM', 'superadmin', '2024-08-28 15:48:55', 'superadmin', '2024-08-28 15:50:44'),
	('CBT-08-0824-0002', 1, '2024-08-28', 'COM', 'superadmin', '2024-08-28 15:52:26', 'superadmin', '2024-08-28 15:53:23');
/*!40000 ALTER TABLE `t_wh_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_movement_detail
DROP TABLE IF EXISTS `t_wh_movement_detail`;
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

-- Dumping data for table wms.t_wh_movement_detail: 63 rows
/*!40000 ALTER TABLE `t_wh_movement_detail` DISABLE KEYS */;
INSERT INTO `t_wh_movement_detail` (`movement_id`, `process_id`, `sku`, `part_name`, `pallet_id`, `serial_no`, `batch_no`, `expired_date`, `location_type_from`, `location_from`, `pallet_id_to`, `location_type_to`, `location_to`, `qty`, `uom_name`, `stock_id`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-01-112022-00001', '1', '32L5995', 'TV Toshiba 32L5995', '12346', '20210612', '456928', NULL, NULL, '1', 'STAGING AREA', 'STAGING AREA', 'R1F2', 10, 'PIECES', 'AV', '', 'atmi', '2022-10-10 09:08:40', NULL, NULL, 'Y'),
	('CBT-01-112022-00002', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', 'test_26okt22_2', NULL, NULL, 'STAGING AREA', 'STAGING AREA', 'STAGING AREA', 'R1F2', 100, 'PIECES', 'AV', '', 'test_staff', '2022-10-27 15:59:35', NULL, NULL, 'Y'),
	('CBT-01-112022-00003', '1', '222231', 'HP', NULL, '', NULL, NULL, NULL, 'STAGING AREA', 'STAGING AREA', 'STAGING AREA', 'R1F2', 50, 'PIECES', NULL, '', NULL, NULL, NULL, NULL, 'Y'),
	('CBT-01-112022-00004', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', NULL, NULL, NULL, 'STAGING AREA', 'STAGING AREA', 'STAGING AREA', 'R1F3', 10, NULL, 'DMG', '', NULL, NULL, NULL, NULL, 'Y'),
	('CBT-08-1122-00001', '8', '32L5995', 'TV Toshiba 32L5995', 'RPX0102054', '20210612', '456928', NULL, 'Racking', '1A1-001-001', 'RPX0102055', 'Racking', '1A1-001-002', 5, 'PIECES', 'AV', 'COM', 'atmi', '2022-11-02 17:23:37', 'atmi', '2022-11-08 17:16:13', 'Y'),
	('CBT-08-1122-00001', '8', '32L5995', 'TV Toshiba 32L5995', 'RPX0102054', '20210613', '456928', NULL, 'Racking', '1A1-001-001', 'RPX0102055', 'Racking', '1A1-001-003', 5, 'PIECES', 'AV', 'OPM', 'atmi', '2022-11-02 17:23:37', 'test_staff', '2022-11-02 17:23:52', 'Y'),
	('CBT-01-1122-00005', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', '123456', '', '20221104', NULL, 'Bulk', 'Stagging Area', '123456', 'Racking', '1A1-001-002', 20, 'PIECES', 'AV', '', 'atmi', '2022-11-06 22:59:28', NULL, NULL, 'Y'),
	('CBT-01-1222-0013', '1', '112233445', 'Teh Kotak Original', NULL, '', '20201212', '2023-12-12', 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-001', 50, 'PIECES', NULL, '', 'mariofrans', '2022-12-15 11:09:23', NULL, NULL, 'Y'),
	('CBT-01-1222-0013', '1', '112233446', 'Teh Kotak Lemon', NULL, '', '20201201', '2023-12-01', 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-002', 25, 'PIECES', NULL, '', 'mariofrans', '2022-12-15 11:08:27', NULL, NULL, 'Y'),
	('CBT-01-1122-0020', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-001', 10, 'PIECES', 'AV', '', 'atmi', '2022-11-16 10:09:35', NULL, NULL, 'Y'),
	('CBT-01-1122-0020', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-001', 10, 'PIECES', 'AV', '', 'atmi', '2022-11-16 10:10:28', NULL, NULL, 'Y'),
	('CBT-01-1222-0014', '1', '112233447', 'Teh Kotak Apel', NULL, '', '20210101', '2024-01-01', 'Bulk', 'STAGING AREA', '', 'Racking', '1A1-001-003', 20, 'PIECES', NULL, '', 'mariofrans', '2022-12-15 12:09:27', NULL, NULL, 'Y'),
	('CBT-01-1222-0014', '1', '112233445', 'Teh Kotak Original', NULL, '', '20210101', '2024-01-01', 'Bulk', 'STAGING AREA', '', 'Racking', '1A1-001-001', 20, 'PIECES', NULL, '', 'mariofrans', '2022-12-15 12:11:00', NULL, NULL, 'Y'),
	('CBT-01-0123-00001', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '20221104', NULL, 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-002', 20, 'PIECES', 'AV', '', 'atmi', '2023-01-09 11:50:02', NULL, NULL, 'Y'),
	('CBT-01-0123-0004', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 5, 'UNIT', 'AV', '', 'mariofrans', '2023-01-12 11:14:04', NULL, NULL, 'Y'),
	('CBT-01-0123-0004', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 5, 'UNIT', 'DMG', '', 'mariofrans', '2023-01-12 11:14:04', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', '1', '112233445', 'Teh Kotak Original', NULL, '', '20230113', '2025-01-13', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 100, 'PIECES', 'AV', '', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', '1', '112233446', 'Teh Kotak Lemon', NULL, '', '20230113', '2025-01-13', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 20, 'PIECES', 'AV', '', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 50, 'PIECES', 'AV', '', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', '1', 'IC0123', 'IC TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1B1-001-001', 50, 'SET', 'AV', '', 'atmi', '2023-01-13 11:11:36', NULL, NULL, 'Y'),
	('CBT-01-0123-0006', '1', '112233447', 'Teh Kotak Apel', NULL, '', '12131', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 10, 'PALLET', 'AV', '', 'mariofrans', '2023-01-17 09:58:29', NULL, NULL, 'Y'),
	('CBT-01-0123-0006', '1', '112233447', 'Teh Kotak Apel', NULL, '', '12131', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 20, 'PALLET', 'DMG', '', 'mariofrans', '2023-01-17 09:58:29', NULL, NULL, 'Y'),
	('CBT-01-0123-0007', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 50, 'UNIT', 'AV', '', 'mariofrans', '2023-01-24 09:31:26', NULL, NULL, 'Y'),
	('CBT-01-0223-0001', '1', '112233446', 'Teh Kotak Lemon', NULL, '', '03022023', '2025-02-03', 'Bulk', 'Staging Area', '', 'Racking', 'test_location_1', 25, 'PACK', 'AV', '', 'atmi', '2023-02-03 10:29:14', NULL, NULL, 'Y'),
	('CBT-01-0223-0001', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', 'test_location_2', 20, 'PIECES', 'AV', '', 'atmi', '2023-02-03 10:29:14', NULL, NULL, 'Y'),
	('CBT-01-0223-0003', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', '2023-02-08', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 9, 'ROLL', 'AV', '', 'atmi', '2023-02-09 09:55:09', NULL, NULL, 'Y'),
	('CBT-01-0223-0004', '1', '112233447', 'Teh Kotak Apel', NULL, '', '', '2028-09-23', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 5, 'PIECES', 'AV', '', 'atmi', '2023-02-16 17:41:21', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', '1', '112233446', 'Teh Kotak Lemon', NULL, '', '23022023', '2024-02-23', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 100, 'PIECES', 'AV', '', 'atmi', '2023-02-23 16:57:22', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', '1', '112233446', 'Teh Kotak Lemon', NULL, '', '23022023', '2024-02-23', 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 100, 'PIECES', 'AV', '', 'atmi', '2023-02-23 16:57:22', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 100, 'PIECES', 'AV', '', 'atmi', '2023-02-23 16:57:22', NULL, NULL, 'Y'),
	('CBT-01-0323-0001', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 5, 'PIECES', 'AV', '', 'atmi', '2023-03-18 23:18:33', NULL, NULL, 'Y'),
	('CBT-01-0323-0002', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 9, 'PIECES', 'AV', '', 'atmi', '2023-03-20 15:27:30', NULL, NULL, 'Y'),
	('CBT-01-0323-0002', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 9, 'PIECES', 'AV', '', 'atmi', '2023-03-20 15:27:30', NULL, NULL, 'Y'),
	('CBT-02-0323-0001', '2', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 10, 'PIECES', 'AV', '', 'atmi', '2023-03-21 14:35:40', NULL, NULL, 'Y'),
	('CBT-02-0323-0001', '2', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 10, 'PIECES', 'AV', '', 'atmi', '2023-03-21 14:35:40', NULL, NULL, 'Y'),
	('CBT-01-0223-0002', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', '2023-02-09', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-001', 5, 'PACK', 'AV', '', 'superadmin', '2023-03-24 09:05:25', NULL, NULL, 'Y'),
	('CBT-01-0223-0002', '1', '32L5995', 'TV Toshiba 32L5995', NULL, '', '', '2023-02-09', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 5, 'PACK', 'AV', '', 'superadmin', '2023-03-24 09:05:25', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', '1', 'ABC123', 'Baterai ABC', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Bulk', '1A1-001-001', 10, 'PIECES', 'AV', '', 'atmi', '2023-03-24 15:55:33', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', '1', 'ABC123', 'Baterai ABC', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-002', 10, 'PIECES', 'DMG', '', 'atmi', '2023-03-24 15:56:06', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', '1', 'ABC123', 'Baterai ABC', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Quarantine', 'DMG01-001', 15, 'PIECES', 'AV', '', 'atmi', '2023-03-24 15:56:53', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', '1', 'ABC123', 'Baterai ABC', NULL, '', '', NULL, 'Bulk', 'Stagging Area', '', 'Racking', 'test_location_1', 15, 'PIECES', 'DMG', '', 'atmi', '2023-03-24 15:57:35', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', '112233447', 'Teh Kotak Apel', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 10, 'PIECES', 'AV', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', '112233447', 'Teh Kotak Apel', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 10, 'PIECES', 'AV', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', '112233447', 'Teh Kotak Apel', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Racking', 'DMG-001-001', 5, 'PIECES', 'DMG', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', 'ABC456', 'Sirup ABC Jeruk', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Racking', 'DMG-001-001', 10, 'PACK', 'DMG', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', 'ABC456', 'Sirup ABC Jeruk', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Racking', 'test_location_1', 20, 'PACK', 'AV', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', '1', 'ABC456', 'Sirup ABC Jeruk', NULL, '', '270323', '2024-03-31', 'Bulk', 'Staging Area', '', 'Racking', 'test_location_2', 20, 'PACK', 'AV', '', 'atmi', '2023-03-27 14:05:54', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', '3', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', 'BO12', NULL, 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 6, 'PACK', 'AV', '', 'test_admin', '2023-04-04 14:51:04', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', '3', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', 'BO12', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 4, 'PACK', 'AV', '', 'test_admin', '2023-04-04 14:51:04', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', '3', 'IC0123', 'IC TV Toshiba 32L5995', NULL, '', 'BO12', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-003', 50, 'UNIT', 'AV', '', 'test_admin', '2023-04-04 14:51:04', NULL, NULL, 'Y'),
	('CBT-01-0423-0001', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', 'test_location_1', 10, 'PIECES', 'AV', '', 'atmi', '2023-04-05 13:21:44', NULL, NULL, 'Y'),
	('CBT-01-0423-0001', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', 'test_location_2', 10, 'PIECES', 'AV', '', 'atmi', '2023-04-05 13:21:44', NULL, NULL, 'Y'),
	('CBT-01-0423-0002', '1', '112233445', 'Teh Kotak Original', NULL, '', 'BO124', '2025-09-06', 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 84, 'PALLET', 'AV', '', 'atmi', '2023-04-06 12:50:03', NULL, NULL, 'Y'),
	('CBT-01-0423-0002', '1', '112233446', 'Teh Kotak Lemon', NULL, '', 'BO123', '2027-09-06', 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 53, 'PACK', 'AV', '', 'atmi', '2023-04-06 12:50:03', NULL, NULL, 'Y'),
	('CBT-01-0523-0001', '1', 'ABC123', 'Baterai ABC', NULL, '', '24052023', NULL, 'Bulk', 'Staging Area', '', 'Bulk', '1A1-012', 10, 'PIECES', 'AV', '', 'atmi', '2023-05-24 18:46:41', NULL, NULL, 'Y'),
	('CBT-01-0523-0001', '1', 'IC0123', 'IC TV Toshiba 32L5995', NULL, '', '24052023', NULL, 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 10, 'PIECES', 'AV', '', 'atmi', '2023-05-24 18:46:41', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 25, 'UNIT', 'AV', '', 'atmi', '2023-06-06 19:53:12', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1A1-001-002', 2, 'UNIT', 'AV', '', 'atmi', '2023-06-06 19:53:12', NULL, NULL, 'Y'),
	('CBT-01-0423-0003', '1', '75016438', 'DISPLAY PANEL V216B1-L02', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', '1B1-001-001', 20, 'PIECES', 'AV', '', 'atmi', '2023-06-06 19:41:25', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', '1', '47RW1EJ', 'TV Toshiba 47RW1EJ', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Bulk', '1A1-001-001', 73, 'UNIT', 'AV', '', 'atmi', '2023-06-06 19:53:12', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', '1', 'IC0123', 'IC TV Toshiba 32L5995', NULL, '', '', NULL, 'Bulk', 'Staging Area', '', 'Racking', 'test_location_1', 100, 'SET', 'AV', '', 'atmi', '2023-06-06 19:53:12', NULL, NULL, 'Y'),
	('CBT-04-0623-0001', '4', '112233446', 'Teh Kotak Lemon', NULL, '', '23022023', '2024-02-23', 'Bulk', 'Stagging Area', '', 'Racking', '1A1-001-002', 25, 'PIECES', 'AVR', '', 'atmi', '2023-06-08 16:23:56', NULL, NULL, 'Y'),
	('CBT-01-0824-0004', '1', 'CG001', 'Cengkeh', NULL, '', '', '2026-12-28', 'Bulk', 'Staging Area', '', 'Bulk', 'FL001', 40, 'Bag', 'AV', '', 'superadmin', '2024-08-28 11:44:03', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_movement_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_attachment
DROP TABLE IF EXISTS `t_wh_outbound_attachment`;
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
DROP TABLE IF EXISTS `t_wh_outbound_detail_sku`;
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

-- Dumping data for table wms.t_wh_outbound_detail_sku: 91 rows
/*!40000 ALTER TABLE `t_wh_outbound_detail_sku` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_detail_sku` (`outbound_planning_no`, `sku`, `batch_no`, `gr_id`, `available_qty`, `allocated_qty`, `expired_date`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1222-0019', '112233446', '20201201', 'CBT-GR-1122-0017', 25, 5, '2023-12-01', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-1222-0024', '32L5995', 'test_26okt22_2', '', 10, 2, NULL, 'mariofrans', '2022-12-24 13:42:31'),
	('CBT-OUT-1222-0024', '32L5995', '456928', 'CBT-GR-1022-0001', 10, 3, NULL, 'mariofrans', '2022-12-24 13:42:31'),
	('CBT-OUT-1222-0024', '75016438', '', '', 48, 10, NULL, 'mariofrans', '2022-12-24 13:42:31'),
	('CBT-OUT-1222-0026', '112233445', '20200606', 'CBT-GR-1222-0016', 50, 10, '2023-06-06', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0026', '112233445', '20201212', 'CBT-GR-1222-0014', 50, 5, '2023-12-12', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0026', '112233446', '20201201', 'CBT-GR-1122-0017', 25, 5, '2023-12-01', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0019', '112233445', '20200606', 'CBT-GR-1222-0016', 50, 2, '2023-06-06', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-1222-0019', '112233446', '20200606', 'CBT-GR-1222-0016', 50, 5, '2023-06-06', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-0123-0001', '112233446', '20200606', 'CBT-GR-1222-0016', 80, 1, '2023-06-06', 'rdarmawan', '2023-01-05 10:31:01'),
	('CBT-OUT-0123-0001', '112233446', '20201201', 'CBT-GR-1122-0017', 28, 4, '2023-12-01', 'rdarmawan', '2023-01-05 10:31:01'),
	('CBT-OUT-0123-0001', '112233447', '20210101', 'CBT-GR-1222-0015', 20, 2, '2024-01-01', 'rdarmawan', '2023-01-05 10:31:01'),
	('CBT-OUT-0123-0003', '112233446', '20200606', 'CBT-GR-1222-0016', 77, 1, '2023-06-06', 'mariofrans', '2023-01-12 14:03:43'),
	('CBT-OUT-0123-0003', '112233446', '20201201', 'CBT-GR-1122-0017', 28, 2, '2023-12-01', 'mariofrans', '2023-01-12 14:03:43'),
	('CBT-OUT-0123-0004', '112233446', '20230113', 'CBT-GR-0123-0007', 20, 5, '2025-01-13', 'atmi', '2023-01-15 17:57:13'),
	('CBT-OUT-0123-0004', 'IC0123', '', 'CBT-GR-0123-0007', 50, 2, NULL, 'atmi', '2023-01-15 17:57:13'),
	('CBT-OUT-0123-0005', 'IC0123', '', 'CBT-GR-0123-0007', 50, 5, NULL, 'atmi', '2023-01-16 11:24:20'),
	('CBT-OUT-0123-0005', '112233447', '20210101', 'CBT-GR-1222-0015', 14, 1, '2024-01-01', 'atmi', '2023-01-16 11:24:20'),
	('CBT-OUT-0123-0006', 'IC0123', '', 'CBT-GR-0123-0007', 50, 10, NULL, 'atmi', '2023-01-17 09:24:31'),
	('CBT-OUT-0123-0007', '112233445', '20230113', 'CBT-GR-0123-0007', 74, 2, '2025-01-13', 'atmi', '2023-01-25 09:12:28'),
	('CBT-OUT-0123-0008', '32L5995', '', 'CBT-GR-1022-0043', 100, 10, NULL, 'atmi', '2023-01-25 09:35:57'),
	('CBT-OUT-0123-0008', 'IC0123', '', 'CBT-GR-0123-0007', 40, 10, NULL, 'atmi', '2023-01-25 09:35:57'),
	('CBT-OUT-0223-0001', '32L5995', '20221104', 'CBT-GR-1022-0043', 80, 2, NULL, 'atmi', '2023-02-03 11:46:35'),
	('CBT-OUT-0223-0001', 'IC0123', '', 'CBT-GR-0123-0007', 30, 10, NULL, 'atmi', '2023-02-03 11:46:35'),
	('CBT-OUT-0223-0002', '112233447', '12131', 'CBT-GR-0123-0009', 30, 3, NULL, 'atmi', '2023-02-03 11:50:49'),
	('CBT-OUT-0223-0003', '112233446', '20200606', 'CBT-GR-1222-0016', 75, 2, '2023-06-06', 'atmi', '2023-02-06 09:32:29'),
	('CBT-OUT-0223-0004', '75016438', '', 'CBT-GR-0123-0012', 50, 2, NULL, 'atmi', '2023-02-07 18:17:31'),
	('CBT-OUT-0223-0005', '112233445', '20200606', 'CBT-GR-1222-0016', 40, 1, '2023-06-06', 'atmi', '2023-02-09 16:15:26'),
	('CBT-OUT-0223-0005', '112233445', '20201212', 'CBT-GR-1222-0014', 29, 1, '2023-12-12', 'atmi', '2023-02-09 16:15:26'),
	('CBT-OUT-0223-0005', '112233445', '20210101', 'CBT-GR-1222-0015', 21, 1, '2024-01-01', 'atmi', '2023-02-09 16:15:26'),
	('CBT-OUT-0223-0005', '112233445', '20230113', 'CBT-GR-0123-0007', 72, 2, '2025-01-13', 'atmi', '2023-02-09 16:15:26'),
	('CBT-OUT-0223-0006', '112233445', '20230113', 'CBT-GR-0123-0007', 70, 5, '2025-01-13', 'atmi', '2023-02-14 09:32:23'),
	('CBT-OUT-0223-0007', '112233447', '12131', 'CBT-GR-0123-0009', 27, 3, NULL, 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233447', '20210101', 'CBT-GR-1222-0015', 14, 2, '2024-01-01', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233445', '20200606', 'CBT-GR-1222-0016', 40, 3, '2023-06-06', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233445', '20201212', 'CBT-GR-1222-0014', 28, 1, '2023-12-12', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233445', '20210101', 'CBT-GR-1222-0015', 19, 1, '2024-01-01', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233445', '20230113', 'CBT-GR-0123-0007', 65, 5, '2025-01-13', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0008', '75016438', '', 'CBT-GR-0123-0012', 57, 5, NULL, 'atmi', '2023-02-15 13:58:19'),
	('CBT-OUT-0223-0009', '112233447', '12131', 'CBT-GR-0123-0009', 23, 5, NULL, 'atmi', '2023-02-21 09:49:16'),
	('CBT-OUT-0223-0010', '112233445', '20230113', 'CBT-GR-0123-0007', 59, 2, '2025-01-13', 'atmi', '2023-02-28 14:14:47'),
	('CBT-OUT-0323-0001', '32L5995', '', 'CBT-GR-1022-0043', 210, 1, NULL, 'atmi', '2023-03-17 09:41:55'),
	('CBT-OUT-0323-0001', '32L5995', '20221104', 'CBT-GR-1022-0043', 78, 1, NULL, 'atmi', '2023-03-17 09:41:55'),
	('CBT-OUT-0323-0002', '32L5995', '', 'CBT-GR-1022-0043', 209, 1, NULL, 'atmi', '2023-03-20 08:21:18'),
	('CBT-OUT-0323-0004', '47RW1EJ', '', 'CBT-GR-1122-0017', 29, 2, NULL, 'superadmin', '2023-03-24 11:20:24'),
	('CBT-OUT-0423-0001', '47RW1EJ', 'BO12', 'CBT-GR-0423-0001', 10, 8, NULL, 'test_admin', '2023-04-04 15:17:25'),
	('CBT-OUT-0423-0002', 'ABC123', '', 'CBT-GR-0323-0004', 50, 5, NULL, 'atmi', '2023-04-06 10:53:28'),
	('CBT-OUT-0423-0002', 'ABC456', '270323', 'CBT-GR-0323-0005', 50, 3, '2024-03-31', 'atmi', '2023-04-06 10:53:28'),
	('CBT-OUT-0423-0003', '75016438', '', 'CBT-GR-0123-0012', 115, 2, NULL, 'atmi', '2023-04-06 14:03:13'),
	('CBT-OUT-0423-0004', 'ABC123', '', 'CBT-GR-0323-0004', 45, 2, NULL, 'atmi', '2023-04-10 10:30:01'),
	('CBT-OUT-0423-0004', 'ABC456', '270323', 'CBT-GR-0323-0005', 47, 1, '2024-03-31', 'atmi', '2023-04-10 10:30:01'),
	('CBT-OUT-0423-0005', '112233445', 'BO124', 'CBT-GR-0423-0003', 84, 5, '2025-09-06', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0005', '112233446', '20200606', 'CBT-GR-1222-0016', 122, 3, '2023-06-06', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0005', '112233447', '270323', 'CBT-GR-0323-0005', 25, 4, '2024-03-31', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0006', 'ABC123', '', 'CBT-GR-0323-0004', 43, 5, NULL, 'atmi', '2023-04-13 09:57:06'),
	('CBT-OUT-0423-0006', 'ABC456', '270323', 'CBT-GR-0323-0005', 46, 5, '2024-03-31', 'atmi', '2023-04-13 09:57:06'),
	('CBT-OUT-0423-0007', '32L5995', '', 'CBT-GR-1022-0043', 218, 2, NULL, 'atmi', '2023-04-17 08:54:51'),
	('CBT-OUT-0423-0008', '112233445', '20201212', 'CBT-GR-1222-0014', 30, 2, '2023-12-12', 'atmi', '2023-04-20 10:15:04'),
	('CBT-OUT-0423-0040', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:19:22'),
	('CBT-OUT-0423-0040', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:19:22'),
	('CBT-OUT-0423-0041', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:19:46'),
	('CBT-OUT-0423-0041', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:19:46'),
	('CBT-OUT-0423-0042', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:22:39'),
	('CBT-OUT-0423-0042', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:22:39'),
	('CBT-OUT-0423-0043', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:24:04'),
	('CBT-OUT-0423-0043', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:24:04'),
	('CBT-OUT-0423-0044', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:25:32'),
	('CBT-OUT-0423-0044', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:25:32'),
	('CBT-OUT-0423-0045', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0045', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0046', '75016438', '', '', 161, 1, NULL, 'demo', '2023-04-25 15:31:26'),
	('CBT-OUT-0423-0046', '32L5995', '', 'CBT-GR-1022-0043', 216, 1, NULL, 'demo', '2023-04-25 15:31:26'),
	('CBT-OUT-0523-0001', '112233446', '23022023', 'CBT-GR-0223-0015', 200, 2, '2024-02-23', 'atmi', '2023-05-09 11:23:02'),
	('CBT-OUT-0523-0001', '112233445', 'BO124', 'CBT-GR-0423-0003', 79, 3, '2025-09-06', 'atmi', '2023-05-09 11:23:02'),
	('CBT-OUT-0523-0002', 'ABC123', '', 'CBT-GR-0323-0004', 38, 5, NULL, 'mariofrans_spv', '2023-05-09 14:31:03'),
	('CBT-OUT-0523-0003', '75016438', '', 'CBT-GR-0123-0012', 113, 5, NULL, 'mariofrans_spv', '2023-05-09 15:49:05'),
	('CBT-OUT-0523-0003', '112233447', '270323', 'CBT-GR-0323-0005', 21, 5, '2024-03-31', 'mariofrans_spv', '2023-05-09 15:49:05'),
	('CBT-OUT-0523-0004', '112233445', '20201212', 'CBT-GR-1222-0014', 30, 5, '2023-12-12', 'atmi', '2023-05-11 10:01:03'),
	('CBT-OUT-0523-0005', '112233446', '23022023', 'CBT-GR-0223-0015', 198, 25, '2024-02-23', 'atmi', '2023-05-11 14:03:02'),
	('CBT-OUT-0523-0006', 'IC0123', '', 'CBT-GR-0123-0007', 20, 20, NULL, 'atmi', '2023-05-24 19:05:56'),
	('CBT-OUT-0523-0006', 'IC0123', '24052023', 'CBT-GR-0523-0004', 10, 10, NULL, 'atmi', '2023-05-24 19:05:56'),
	('CBT-OUT-0523-0006', 'IC0123', 'BO12', 'CBT-GR-0423-0001', 50, 20, NULL, 'atmi', '2023-05-24 19:05:56'),
	('CBT-OUT-0523-0006', 'ABC123', '', 'CBT-GR-0323-0004', 16, 16, NULL, 'atmi', '2023-05-25 10:05:56'),
	('CBT-OUT-0523-0006', 'ABC123', '24052023', 'CBT-GR-0523-0004', 10, 4, NULL, 'atmi', '2023-05-25 10:05:56'),
	('CBT-OUT-0623-0001', 'ABC456', '270323', 'CBT-GR-0323-0005', 32, 2, '2024-03-31', 'mariofrans', '2023-06-13 16:17:18'),
	('CBT-OUT-0623-0002', '75016438', '', 'CBT-GR-0123-0012', 128, 2, NULL, 'mariofrans', '2023-06-13 17:14:37'),
	('CBT-OUT-0623-0002', '32L5995', '', 'CBT-GR-1022-0043', 215, 2, NULL, 'mariofrans', '2023-06-13 17:14:37'),
	('CBT-OUT-0623-0003', 'ABC123', '', 'CBT-GR-0323-0004', 16, 2, NULL, 'atmi', '2023-06-27 11:08:56'),
	('CBT-OUT-0623-0004', '75016438', '', 'CBT-GR-0123-0012', 126, 1, NULL, 'atmi', '2023-06-30 10:06:00'),
	('CBT-OUT-0623-0005', '112233446', '03022023', 'CBT-GR-0223-0002', 15, 1, '2025-02-03', 'atmi', '2023-06-30 10:07:29'),
	('CBT-OUT-0623-0006', 'ABC123', '', 'CBT-GR-0323-0004', 14, 1, NULL, 'mariofrans_spv', '2023-06-30 10:16:44');
/*!40000 ALTER TABLE `t_wh_outbound_detail_sku` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_package
DROP TABLE IF EXISTS `t_wh_outbound_package`;
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

-- Dumping data for table wms.t_wh_outbound_package: 2 rows
/*!40000 ALTER TABLE `t_wh_outbound_package` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_package` (`outbound_planning_no`, `desc_of_goods`, `tot_package`, `actual_weight`, `widhtx`, `lengthx`, `heightx`, `tot_dimensi`, `tot_weight`, `tot_declare_value`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-0423-0045', 'Elektronik', 2, 10, 50, 10, 5, 50, 10, 1000000, 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0046', 'Elektronik', 2, 10, 50, 10, 5, 50, 10, 1000000, 'demo', '2023-04-25 15:31:26');
/*!40000 ALTER TABLE `t_wh_outbound_package` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning
DROP TABLE IF EXISTS `t_wh_outbound_planning`;
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

-- Dumping data for table wms.t_wh_outbound_planning: 59 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_planning` (`outbound_planning_no`, `wh_id`, `client_project_id`, `supplier_id`, `order_id`, `status_id`, `reference_no`, `receipt_no`, `plan_delivery`, `notes`, `cancel_reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-OUT-1122-0001', 1, 1, 3, '1', 'COU', 'OI/21000/JAK-01', 'OI/21000/JAK-01', '2022-12-14', 'hahahaha', NULL, 'rdarmawan', '2022-12-22 14:44:16', 'mariofrans', '2022-12-19 10:11:24'),
	('CBT-OUT-1122-0002', 1, 1, 1, '1', 'ALO', 'OI/21000/JAK-02', 'OI/21000/JAK-02', '2022-12-15', NULL, NULL, NULL, NULL, 'mariofrans', '2022-12-19 10:11:24'),
	('CBT-OUT-1222-0020', 1, 2, 2, '1', 'ALO', 'JT001/002/666', 'JT001/002/777', '2022-12-24', 'Barang Ini harus cepat keluar ya gaes', NULL, 'rdarmawan', '2022-12-22 10:22:07', 'rdarmawan', '2022-12-22 10:31:15'),
	('CBT-OUT-1222-0019', 1, 1, 3, '1', 'DOO', 'JT001/002', 'JT001/003', '2022-12-24', 'Harus Keluar', 'test', 'mariofrans', '2022-12-22 14:31:49', 'mariofrans', '2022-12-30 15:03:49'),
	('CBT-OUT-1222-0021', 1, 1, 1, '1', 'COU', '12345', '12345', '2022-12-23', NULL, 'yes', 'rdarmawan', '2022-12-22 14:43:20', NULL, NULL),
	('CBT-OUT-1222-0025', 1, 1, 3, '1', 'COU', 'JL/00912', 'JL/00912', '2022-12-25', 'proses cepat yah', 'batal yah', 'rdarmawan', '2022-12-24 14:12:33', 'rdarmawan', '2022-12-24 14:17:11'),
	('CBT-OUT-1222-0024', 1, 1, 1, '1', 'COU', 'test24des22_1', 'test24des22_1', '2022-12-24', 'test24des22_1', 'test', 'mariofrans', '2022-12-24 11:59:06', 'mariofrans', '2022-12-24 13:57:47'),
	('CBT-OUT-1222-0026', 1, 1, 3, '1', 'COU', 'JL/00912/99', 'JL/00912/99', '2022-12-27', 'Barang nya harus cepat keluar', NULL, 'rdarmawan', '2022-12-26 08:46:29', 'rdarmawan', '2022-12-26 09:45:18'),
	('CBT-OUT-0123-0001', 1, 1, 3, '1', 'PPO', 'JL720/0002', 'JL726/0006', '2023-01-06', 'Barang nya harus di outbound', NULL, 'rdarmawan', '2023-01-05 10:31:01', 'rdarmawan', '2023-01-05 10:31:30'),
	('CBT-OUT-0123-0002', 1, 1, 3, '1', 'PPO', '12', '13', '2023-01-10', 'Robby Darmawan', NULL, 'rdarmawan', '2023-01-09 15:51:31', 'rdarmawan', '2023-01-09 15:51:50'),
	('CBT-OUT-0123-0003', 1, 1, 1, '1', 'DOO', 'test12jan23_4', 'test12jan23_4', '2023-01-14', 'test12jan23_4', NULL, 'mariofrans', '2023-01-12 14:03:43', 'mariofrans', '2023-01-12 14:04:10'),
	('CBT-OUT-0123-0004', 1, 1, 1, '1', 'ALO', 'test_outbound_1501', 'test_outbound_1501', '2023-01-15', NULL, NULL, 'atmi', '2023-01-15 17:57:13', 'atmi', '2023-01-15 17:57:43'),
	('CBT-OUT-0123-0005', 1, 1, 3, '1', 'DOO', 'test_outbound_1601', 'test_outbound_1601', '2023-01-16', NULL, NULL, 'atmi', '2023-01-16 11:23:22', 'atmi', '2023-02-28 10:21:29'),
	('CBT-OUT-0123-0006', 1, 1, 1, '1', 'PPO', 'test_outbound_1701', 'test_outbound_1701', '2023-01-17', NULL, NULL, 'atmi', '2023-01-17 09:24:31', 'atmi', '2023-01-17 09:24:45'),
	('CBT-OUT-0123-0007', 1, 1, 3, '1', 'ALO', 'test_outbound_2501', 'test_outbound_2501', '2023-01-25', NULL, NULL, 'atmi', '2023-01-25 09:12:28', 'atmi', '2023-01-25 09:12:38'),
	('CBT-OUT-0123-0008', 1, 1, 3, '1', 'DOO', 'test_outbound_2501_2', 'test_outbound_2501_2', '2023-01-25', NULL, NULL, 'atmi', '2023-01-25 09:35:57', 'atmi', '2023-01-25 09:36:11'),
	('CBT-OUT-0223-0001', 1, 1, 1, '1', 'ALO', 'test_0203', 'test_0203', '2023-02-03', NULL, NULL, 'atmi', '2023-02-03 11:46:35', 'atmi', '2023-02-03 11:47:12'),
	('CBT-OUT-0223-0002', 1, 1, 1, '1', 'DOO', 'test_0203_01', 'test_0203_01', '2023-02-03', NULL, NULL, 'atmi', '2023-02-03 11:50:49', 'atmi', '2023-02-03 11:51:00'),
	('CBT-OUT-0223-0003', 1, 1, 1, '1', 'ALO', 'test_outbound_0602', 'test_outbound_0602', '2023-02-06', NULL, NULL, 'atmi', '2023-02-06 09:32:29', 'atmi', '2023-02-06 09:32:38'),
	('CBT-OUT-0223-0004', 1, 1, 1, '1', 'PPO', 'test_0702', 'test_0702', '2023-02-07', NULL, NULL, 'atmi', '2023-02-07 18:17:31', 'atmi', '2023-02-07 18:17:46'),
	('CBT-OUT-0223-0005', 1, 1, 3, '1', 'DOO', 'AKMALISA-TEST1', 'AKMALISA-TEST1', '2023-02-09', NULL, NULL, 'atmi', '2023-02-09 16:15:26', 'atmi', '2023-02-09 16:16:04'),
	('CBT-OUT-0223-0006', 1, 1, 1, '1', 'ALO', 'test_1402', 'test_1402', '2023-02-14', NULL, NULL, 'atmi', '2023-02-14 09:32:23', 'atmi', '2023-02-14 09:32:32'),
	('CBT-OUT-0223-0007', 1, 1, 1, '1', 'ALO', 'test_1502', 'test_1502', '2023-02-15', NULL, NULL, 'atmi', '2023-02-15 09:46:51', 'atmi', '2023-02-15 09:47:00'),
	('CBT-OUT-0223-0008', 1, 1, 1, '1', 'PPO', 'test_1502_2', 'test_1502_2', '2023-02-15', NULL, NULL, 'atmi', '2023-02-15 13:58:19', 'atmi', '2023-02-15 13:58:28'),
	('CBT-OUT-0223-0009', 1, 1, 1, '1', 'PPO', 'test_2102', 'test_2102', '2023-02-21', NULL, NULL, 'atmi', '2023-02-21 09:49:16', 'atmi', '2023-02-21 09:49:31'),
	('CBT-OUT-0223-0010', 1, 1, 1, '1', 'DOO', 'test_2802', 'test_2802', '2023-02-28', NULL, NULL, 'atmi', '2023-02-28 14:14:47', 'atmi', '2023-02-28 14:16:40'),
	('CBT-OUT-0323-0001', 1, 1, 1, '2', 'ALO', '1231545345', '123153453', '2023-03-17', NULL, NULL, 'atmi', '2023-03-17 09:41:55', 'atmi', '2023-03-17 09:42:25'),
	('CBT-OUT-0323-0002', 1, 1, 1, '2', 'ALO', 'test_outbound_1501', 'test_outbound_1501', '2023-03-20', NULL, NULL, 'atmi', '2023-03-20 08:21:18', 'atmi', '2023-03-20 08:21:31'),
	('CBT-OUT-0323-0003', 1, 1, 4, '1', 'DOO', 'TEST RFC 1', 'TEST RFC 1', '2023-03-20', NULL, NULL, 'atmi', '2023-03-20 17:53:01', 'atmi', '2023-03-20 17:53:16'),
	('CBT-OUT-0323-0004', 1, 1, 4, '1', 'PPO', 'test_outbound_2403', 'test_outbound_2403', '2023-03-24', NULL, NULL, 'superadmin', '2023-03-24 11:20:24', 'superadmin', '2023-03-24 11:20:31'),
	('CBT-OUT-0323-0005', 1, 1, 1, '1', 'ALO', '12345678', '11111111', '2023-03-31', NULL, NULL, 'atmi', '2023-03-30 15:31:44', 'atmi', '2023-03-30 15:32:41'),
	('CBT-OUT-0423-0001', 1, 1, 4, '1', 'PPO', 'PO01', 'RN01', '2023-04-12', NULL, NULL, 'test_admin', '2023-04-04 15:17:25', 'test_admin', '2023-04-04 15:17:46'),
	('CBT-OUT-0423-0002', 1, 1, 4, '1', 'PPO', 'test_outbound_0604', 'test_outbound_0604', '2023-04-06', NULL, NULL, 'atmi', '2023-04-06 10:53:28', 'atmi', '2023-04-06 10:53:48'),
	('CBT-OUT-0423-0003', 1, 1, 3, '1', 'DOO', 'test2', 'test2', '2023-04-06', NULL, NULL, 'atmi', '2023-04-06 14:03:13', 'atmi', '2023-05-16 14:46:57'),
	('CBT-OUT-0423-0004', 1, 1, 1, '1', 'ALO', 'test_1004', 'test_1004', '2023-04-10', NULL, NULL, 'atmi', '2023-04-10 10:30:01', 'atmi', '2023-04-10 10:30:30'),
	('CBT-OUT-0423-0005', 1, 1, 1, '1', 'ALO', 'test_1104', 'test_1104', '2023-04-11', NULL, NULL, 'atmi', '2023-04-11 08:53:43', 'atmi', '2023-04-11 09:05:39'),
	('CBT-OUT-0423-0006', 1, 1, 4, '1', 'PPO', 'test_1304', 'test_1304', '2023-04-13', 'test picking hht', NULL, 'atmi', '2023-04-13 09:57:06', 'atmi', '2023-05-19 15:57:54'),
	('CBT-OUT-0423-0007', 1, 1, 4, '1', 'PPO', 'test_1704', 'test_1704', '2023-04-17', NULL, NULL, 'atmi', '2023-04-17 08:54:51', 'atmi', '2023-04-17 08:55:01'),
	('CBT-OUT-0423-0008', 1, 1, 3, '1', 'UNO', 'test-1', 'test-1', '2023-04-20', NULL, NULL, 'atmi', '2023-04-20 10:15:04', NULL, NULL),
	('CBT-OUT-0423-0040', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:19:22', NULL, NULL),
	('CBT-OUT-0423-0041', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:19:46', NULL, NULL),
	('CBT-OUT-0423-0042', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:22:39', NULL, NULL),
	('CBT-OUT-0423-0043', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:24:04', NULL, NULL),
	('CBT-OUT-0423-0044', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:25:32', NULL, NULL),
	('CBT-OUT-0423-0045', 1, 1, 1, '1', 'UNO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:26:58', NULL, NULL),
	('CBT-OUT-0423-0046', 1, 1, 1, '1', 'ALO', '123', '123', '2023-03-15', NULL, NULL, 'demo', '2023-04-25 15:31:26', 'superadmin', '2024-08-26 14:48:00'),
	('CBT-OUT-0523-0001', 1, 1, 1, '1', 'PPO', 'test_outbound_0905', 'test_outbound_0905', '2023-05-09', NULL, NULL, 'atmi', '2023-05-09 11:23:02', 'atmi', '2023-05-09 11:23:19'),
	('CBT-OUT-0523-0002', 1, 1, 1, '1', 'PPO', 'test_outbound_0905_2', 'test_outbound_0905_2', '2023-05-09', 'test transportation', NULL, 'mariofrans_spv', '2023-05-09 14:31:03', 'mariofrans_spv', '2023-05-09 14:40:16'),
	('CBT-OUT-0523-0003', 1, 1, 3, '1', 'ALO', 'test_suggest_picking', 'test_suggest_picking', '2023-05-09', NULL, NULL, 'mariofrans_spv', '2023-05-09 15:49:05', 'mariofrans_spv', '2023-05-09 15:49:17'),
	('CBT-OUT-0523-0004', 1, 1, 4, '1', 'ALO', 'test_outbound_1105', 'test_outbound_1105', '2023-05-11', NULL, NULL, 'atmi', '2023-05-11 10:01:03', 'atmi', '2023-05-11 10:01:19'),
	('CBT-OUT-0523-0005', 1, 1, 4, '1', 'ALO', 'test_outbound_1105_2', 'test_outbound_1105_2', '2023-05-11', NULL, NULL, 'atmi', '2023-05-11 14:03:02', 'atmi', '2023-05-11 14:03:10'),
	('CBT-OUT-0523-0006', 1, 1, 1, '1', 'ALO', 'test_outbound_2405', 'test_outbound_2405', '2023-05-25', NULL, NULL, 'atmi', '2023-05-25 10:05:56', 'atmi', '2023-05-25 10:06:42'),
	('CBT-OUT-0523-0007', 1, 1, 1, '1', 'ALO', 'test_25mei2023_1', 'test_25mei2023_1', '2023-05-25', NULL, NULL, 'mariofrans', '2023-05-25 18:24:34', 'superadmin', '2024-08-26 14:45:19'),
	('CBT-OUT-0623-0001', 1, 1, 1, '1', 'PPO', 'test_hht_01', 'test_hht_01', '2023-06-13', NULL, NULL, 'mariofrans', '2023-06-13 16:17:18', 'mariofrans_spv', '2023-06-13 16:39:48'),
	('CBT-OUT-0623-0002', 1, 1, 1, '1', 'PPO', 'test_hht_02', 'test_hht_02', '2023-06-13', NULL, NULL, 'mariofrans', '2023-06-13 17:14:37', 'mariofrans_spv', '2023-06-13 17:19:06'),
	('CBT-OUT-0623-0003', 1, 1, 1, '1', 'PPO', 'test_dashboard', 'test_dashboard', '2023-06-27', NULL, NULL, 'atmi', '2023-06-27 11:08:56', 'atmi', '2023-06-30 10:08:49'),
	('CBT-OUT-0623-0004', 1, 1, 4, '1', 'PPO', 'test_outbound_3006', 'test_outbound_3006', '2023-06-30', NULL, NULL, 'atmi', '2023-06-30 10:06:00', 'mariofrans_spv', '2023-06-30 10:20:18'),
	('CBT-OUT-0623-0005', 1, 1, 3, '1', 'ALO', 'test_outbound_3006_2', 'test_outbound_3006_2', '2023-06-30', NULL, NULL, 'atmi', '2023-06-30 10:07:29', 'mariofrans_spv', '2023-07-03 15:53:10'),
	('CBT-OUT-0623-0006', 1, 1, 1, '1', 'ALO', 'test_outbound_3006_3', 'test_outbound_3006_3', '2023-06-30', NULL, NULL, 'mariofrans_spv', '2023-06-30 10:16:44', 'superadmin', '2024-03-19 11:56:11');
/*!40000 ALTER TABLE `t_wh_outbound_planning` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning_detail
DROP TABLE IF EXISTS `t_wh_outbound_planning_detail`;
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

-- Dumping data for table wms.t_wh_outbound_planning_detail: 90 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning_detail` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_planning_detail` (`outbound_planning_no`, `sku`, `qty`, `uom_name`, `clasification_id`, `serial_no`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1122-0001', '32L5995', 5, 'PIECES', 1, '12345', 'rdarmawan', '2022-12-15 11:58:13'),
	('CBT-OUT-1122-0001', '112233445', 10, 'PIECES', 1, '67890', 'rdarmawan', '2022-12-15 12:08:12'),
	('CBT-OUT-1222-0021', '47RW1EJ', 1, 'PIECES', 1, '', 'rdarmawan', '2022-12-22 14:40:23'),
	('CBT-OUT-1222-0020', '112233447', 2, 'PIECES', 1, '', 'rdarmawan', '2022-12-22 10:30:33'),
	('CBT-OUT-1222-0020', '600428066', 3, 'PIECES', 1, '', 'rdarmawan', '2022-12-22 10:30:33'),
	('CBT-OUT-1222-0019', '32L5995', 5, 'PIECES', 1, '', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-1222-0019', '112233446', 10, 'PIECES', 1, '', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-1222-0025', '112233446', 10, 'PIECES', 1, '', 'rdarmawan', '2022-12-24 14:12:33'),
	('CBT-OUT-1222-0024', '32L5995', 5, 'UNIT', 1, '', 'mariofrans', '2022-12-24 13:42:31'),
	('CBT-OUT-1222-0024', '75016438', 10, 'UNIT', 1, '', 'mariofrans', '2022-12-24 13:42:31'),
	('CBT-OUT-1222-0025', '32L5995', 5, 'UNIT', 1, '', 'rdarmawan', '2022-12-24 14:12:33'),
	('CBT-OUT-1222-0026', '112233445', 15, 'PIECES', 1, '', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0026', '112233446', 5, 'PIECES', 1, '', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0026', '32L5995', 1, 'UNIT', 1, '', 'rdarmawan', '2022-12-26 08:47:45'),
	('CBT-OUT-1222-0019', '112233445', 2, 'PIECES', 1, '', 'rdarmawan', '2022-12-26 15:45:20'),
	('CBT-OUT-0123-0001', '112233446', 5, 'PIECES', 1, '', 'rdarmawan', '2023-01-05 10:31:01'),
	('CBT-OUT-0123-0001', '112233447', 2, 'PIECES', 1, '', 'rdarmawan', '2023-01-05 10:31:01'),
	('CBT-OUT-0123-0001', '112233445', 5, 'PIECES', 1, NULL, 'rdarmawan', '2023-01-05 16:28:52'),
	('CBT-OUT-0123-0002', '47RW1EJ', 3, 'PIECES', 1, '', 'rdarmawan', '2023-01-09 15:51:31'),
	('CBT-OUT-0123-0003', '112233446', 3, 'UNIT', 1, '', 'mariofrans', '2023-01-12 14:03:43'),
	('CBT-OUT-0123-0003', '47RW1EJ', 3, 'UNIT', 1, '', 'mariofrans', '2023-01-12 14:03:43'),
	('CBT-OUT-0123-0004', '112233446', 5, 'PIECES', 1, '', 'atmi', '2023-01-15 17:57:13'),
	('CBT-OUT-0123-0004', 'IC0123', 2, 'SET', 3, '', 'atmi', '2023-01-15 17:57:13'),
	('CBT-OUT-0123-0005', '112233447', 1, 'PIECES', 1, '', 'atmi', '2023-01-16 11:24:20'),
	('CBT-OUT-0123-0006', 'IC0123', 10, 'UNIT', 3, '', 'atmi', '2023-01-17 09:24:31'),
	('CBT-OUT-0123-0007', '112233445', 2, 'PIECES', 1, '', 'atmi', '2023-01-25 09:12:28'),
	('CBT-OUT-0123-0008', '32L5995', 10, 'PIECES', 1, '', 'atmi', '2023-01-25 09:35:57'),
	('CBT-OUT-0123-0008', 'IC0123', 10, 'SET', 3, '', 'atmi', '2023-01-25 09:35:57'),
	('CBT-OUT-0223-0001', '32L5995', 2, 'PIECES', 1, '', 'atmi', '2023-02-03 11:46:35'),
	('CBT-OUT-0223-0001', 'IC0123', 10, 'PIECES', 1, '', 'atmi', '2023-02-03 11:46:35'),
	('CBT-OUT-0223-0002', '112233447', 3, 'PIECES', 1, '', 'atmi', '2023-02-03 11:50:49'),
	('CBT-OUT-0223-0003', '112233446', 2, 'PIECES', 1, '', 'atmi', '2023-02-06 09:32:29'),
	('CBT-OUT-0223-0004', '75016438', 2, 'PIECES', 1, '', 'atmi', '2023-02-07 18:17:31'),
	('CBT-OUT-0223-0005', '112233445', 5, 'PIECES', 1, '', 'atmi', '2023-02-09 16:15:26'),
	('CBT-OUT-0223-0006', '112233445', 5, 'PIECES', 1, '', 'atmi', '2023-02-14 09:32:23'),
	('CBT-OUT-0223-0007', '112233447', 5, 'PIECES', 1, '', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0007', '112233445', 10, 'PIECES', 1, '123', 'atmi', '2023-02-15 09:46:51'),
	('CBT-OUT-0223-0008', '75016438', 5, 'PIECES', 1, '', 'atmi', '2023-02-15 13:58:19'),
	('CBT-OUT-0223-0009', '112233447', 5, 'PIECES', 1, '', 'atmi', '2023-02-21 09:49:16'),
	('CBT-OUT-0223-0010', '112233445', 2, 'PIECES', 1, '', 'atmi', '2023-02-28 14:14:47'),
	('CBT-OUT-0323-0001', '32L5995', 3, 'DRUM', 1, '', 'atmi', '2023-03-17 09:41:55'),
	('CBT-OUT-0323-0002', '32L5995', 1, 'DRUM', 1, '', 'atmi', '2023-03-20 08:21:18'),
	('CBT-OUT-0323-0003', '112233447', 10, 'PIECES', 1, '', 'atmi', '2023-03-20 17:53:01'),
	('CBT-OUT-0323-0004', '47RW1EJ', 2, 'PIECES', 1, '', 'superadmin', '2023-03-24 11:20:24'),
	('CBT-OUT-0323-0005', '112233446', 10, 'PIECES', 1, '', 'atmi', '2023-03-30 15:31:44'),
	('CBT-OUT-0323-0005', '112233447', 5, 'PIECES', 1, '', 'atmi', '2023-03-30 15:31:44'),
	('CBT-OUT-0423-0001', '47RW1EJ', 8, 'PACK', 1, '', 'test_admin', '2023-04-04 15:17:25'),
	('CBT-OUT-0423-0002', 'ABC123', 5, 'PACK', 1, '', 'atmi', '2023-04-06 10:53:28'),
	('CBT-OUT-0423-0002', 'ABC456', 3, 'PACK', 1, '', 'atmi', '2023-04-06 10:53:28'),
	('CBT-OUT-0423-0003', '75016438', 2, 'PIECES', 1, '', 'atmi', '2023-04-06 14:03:13'),
	('CBT-OUT-0423-0004', 'ABC123', 2, 'PACK', 1, '', 'atmi', '2023-04-10 10:30:01'),
	('CBT-OUT-0423-0004', 'ABC456', 1, 'PIECES', 1, '', 'atmi', '2023-04-10 10:30:01'),
	('CBT-OUT-0423-0005', '112233445', 5, 'PIECES', 1, '', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0005', '112233446', 3, 'PIECES', 1, '', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0005', '112233447', 4, 'PIECES', 1, '', 'atmi', '2023-04-11 08:53:43'),
	('CBT-OUT-0423-0006', 'ABC123', 5, 'PIECES', 1, '', 'atmi', '2023-04-13 09:57:06'),
	('CBT-OUT-0423-0006', 'ABC456', 5, 'PIECES', 1, '', 'atmi', '2023-04-13 09:57:06'),
	('CBT-OUT-0423-0007', '32L5995', 2, 'PIECES', 1, '', 'atmi', '2023-04-17 08:54:51'),
	('CBT-OUT-0423-0008', '112233445', 2, 'PIECES', 1, '', 'atmi', '2023-04-20 10:15:04'),
	('CBT-OUT-0423-0042', '75016438', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:22:39'),
	('CBT-OUT-0423-0042', '32L5995', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:22:39'),
	('CBT-OUT-0423-0043', '75016438', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:24:04'),
	('CBT-OUT-0423-0043', '32L5995', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:24:04'),
	('CBT-OUT-0423-0044', '75016438', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:25:32'),
	('CBT-OUT-0423-0044', '32L5995', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:25:32'),
	('CBT-OUT-0423-0045', '75016438', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0045', '32L5995', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:26:58'),
	('CBT-OUT-0423-0046', '75016438', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:31:26'),
	('CBT-OUT-0423-0046', '32L5995', 1, 'PIECES', 1, '', 'demo', '2023-04-25 15:31:26'),
	('CBT-OUT-0523-0001', '112233446', 2, 'PIECES', 1, '', 'atmi', '2023-05-09 11:23:02'),
	('CBT-OUT-0523-0001', '112233445', 3, 'PIECES', 1, '', 'atmi', '2023-05-09 11:23:02'),
	('CBT-OUT-0523-0002', 'ABC123', 5, 'PIECES', 1, '', 'mariofrans_spv', '2023-05-09 14:31:03'),
	('CBT-OUT-0523-0003', '75016438', 5, 'PIECES', 1, '', 'mariofrans_spv', '2023-05-09 15:49:05'),
	('CBT-OUT-0523-0003', '112233447', 5, 'PIECES', 1, '', 'mariofrans_spv', '2023-05-09 15:49:05'),
	('CBT-OUT-0523-0004', '112233445', 5, 'PIECES', 1, '', 'atmi', '2023-05-11 10:01:03'),
	('CBT-OUT-0523-0005', '112233446', 25, 'PIECES', 1, '', 'atmi', '2023-05-11 14:03:02'),
	('CBT-OUT-0523-0006', 'ABC123', 20, 'PIECES', 1, '', 'atmi', '2023-05-25 10:05:56'),
	('CBT-OUT-0523-0006', 'IC0123', 50, 'PIECES', 1, '', 'atmi', '2023-05-25 10:05:56'),
	('CBT-OUT-0523-0007', '75016438', 10, 'DRUM', 1, '', 'mariofrans', '2023-05-25 18:24:34'),
	('CBT-OUT-0523-0007', '32L5995', 5, 'BARREL', 1, '', 'mariofrans', '2023-05-25 18:24:34'),
	('CBT-OUT-0523-0007', '47RW1EJ', 50, 'PACK', 1, '', 'mariofrans', '2023-05-25 18:24:34'),
	('CBT-OUT-0523-0007', '112233446', 60, 'PALLET', 1, '', 'mariofrans', '2023-05-25 18:24:34'),
	('CBT-OUT-0523-0007', 'IC0123', 90, 'PALLET', 1, '', 'mariofrans', '2023-05-25 18:24:34'),
	('CBT-OUT-0623-0001', 'ABC456', 2, 'PIECES', 1, '', 'mariofrans', '2023-06-13 16:17:18'),
	('CBT-OUT-0623-0002', '75016438', 2, 'PIECES', 1, '', 'mariofrans', '2023-06-13 17:14:37'),
	('CBT-OUT-0623-0002', '32L5995', 2, 'PIECES', 1, '', 'mariofrans', '2023-06-13 17:14:37'),
	('CBT-OUT-0623-0003', 'ABC123', 2, 'PIECES', 1, '', 'atmi', '2023-06-27 11:08:56'),
	('CBT-OUT-0623-0004', '75016438', 1, 'PIECES', 1, '', 'atmi', '2023-06-30 10:06:00'),
	('CBT-OUT-0623-0005', '112233446', 1, 'PIECES', 1, '', 'atmi', '2023-06-30 10:07:29'),
	('CBT-OUT-0623-0006', 'ABC123', 1, 'PIECES', 1, '', 'mariofrans_spv', '2023-06-30 10:16:44');
/*!40000 ALTER TABLE `t_wh_outbound_planning_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_outbound_planning_history
DROP TABLE IF EXISTS `t_wh_outbound_planning_history`;
CREATE TABLE IF NOT EXISTS `t_wh_outbound_planning_history` (
  `outbound_planning_no` varchar(50) NOT NULL,
  `previous_state` varchar(3) DEFAULT NULL,
  `last_status` varchar(3) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_outbound_planning_history: 6 rows
/*!40000 ALTER TABLE `t_wh_outbound_planning_history` DISABLE KEYS */;
INSERT INTO `t_wh_outbound_planning_history` (`outbound_planning_no`, `previous_state`, `last_status`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-1222-0024', 'ALO', 'COU', 'mariofrans', '2022-12-24 11:59:06'),
	('CBT-OUT-1222-0021', 'UNO', 'COU', 'rdarmawan', '2022-12-22 14:42:19'),
	('CBT-OUT-1122-0001', 'ALO', 'COU', 'rdarmawan', '2022-12-14 11:39:33'),
	('CBT-OUT-1222-0025', 'ALO', 'COU', 'rdarmawan', '2022-12-24 14:12:33'),
	('CBT-OUT-1222-0026', 'ALO', 'COU', 'rdarmawan', '2022-12-26 08:46:29'),
	('CBT-OUT-1222-0019', 'RPO', 'CPI', 'mariofrans', '2022-12-30 15:03:49');
/*!40000 ALTER TABLE `t_wh_outbound_planning_history` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_packing
DROP TABLE IF EXISTS `t_wh_packing`;
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

-- Dumping data for table wms.t_wh_packing: 18 rows
/*!40000 ALTER TABLE `t_wh_packing` DISABLE KEYS */;
INSERT INTO `t_wh_packing` (`outbound_planning_no`, `bucket_id`, `carton_id`, `status_id`, `checker`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-OUT-1222-0019', 'RPX123s', '1', 'GIO', 'rdarmawan', 'mariofrans', '2023-01-13 16:22:10', ' ', '2023-01-06 20:18:53'),
	('CBT-OUT-1122-0001', '', '', 'UNC', NULL, 'rdarmawan', '2022-12-22 10:31:15', '', NULL),
	('CBT-OUT-1222-0024', '', '', 'CHE', NULL, 'mariofrans', '2022-12-24 13:56:16', 'mariofrans', '2022-12-24 13:57:47'),
	('CBT-OUT-1222-0025', '', '', 'CAC', NULL, 'rdarmawan', '2022-12-24 14:16:06', 'rdarmawan', '2022-12-24 14:17:11'),
	('CBT-OUT-1222-0026', '', '', 'CAC', NULL, 'rdarmawan', '2022-12-26 08:49:06', 'rdarmawan', '2022-12-26 09:45:18'),
	('CBT-OUT-0123-0003', 'test12jan23_4', '1', 'GIO', NULL, 'mariofrans_spv', '2023-01-13 16:22:10', '', NULL),
	('CBT-OUT-0123-0006', 'bucket123', '1', 'UNP', NULL, 'mariofrans_spv', '2023-01-17 09:34:55', '', NULL),
	('CBT-OUT-0123-0008', 'test_outbound_2501_2', '11', 'GIO', NULL, 'mariofrans_spv', '2023-01-25 09:53:41', '', NULL),
	('CBT-OUT-0223-0002', 'test_123', '2', 'GIO', NULL, 'mariofrans_spv', '2023-02-03 15:44:02', '', NULL),
	('CBT-OUT-0223-0005', '123_by_AKMAL', '1', 'GIO', NULL, 'mariofrans_spv', '2023-02-09 17:11:02', '', NULL),
	('CBT-OUT-0123-0005', '1', '1', 'GIO', NULL, 'mariofrans_spv', '2023-02-28 10:30:03', '', NULL),
	('CBT-OUT-0223-0010', '12', '1', 'GIO', NULL, 'mariofrans_spv', '2023-02-28 17:24:58', '', NULL),
	('CBT-OUT-0323-0003', 'RFC012', '1', 'GIO', NULL, 'mariofrans_spv', '2023-03-20 18:19:47', '', NULL),
	('CBT-OUT-0423-0003', '12', 'ABC123', 'GIO', NULL, 'mariofrans_spv', '2023-04-06 14:53:49', 'atmi', '2023-05-16 14:46:56'),
	('CBT-OUT-0523-0001', 'abc123', '1', 'UNP', NULL, 'mariofrans_spv', '2023-05-09 14:12:29', '', NULL),
	('CBT-OUT-0623-0001', 'test123', '1', 'UNP', NULL, 'mariofrans', '2023-06-13 16:43:34', '', NULL),
	('CBT-OUT-0623-0004', '123', '1', 'UNP', NULL, 'mariofrans_spv', '2023-06-30 10:23:13', '', NULL),
	('CBT-OUT-0623-0003', '123', '1', 'UNP', NULL, 'mariofrans_spv', '2023-06-30 14:59:07', '', NULL);
/*!40000 ALTER TABLE `t_wh_packing` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_picking
DROP TABLE IF EXISTS `t_wh_picking`;
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

-- Dumping data for table wms.t_wh_picking: 49 rows
/*!40000 ALTER TABLE `t_wh_picking` DISABLE KEYS */;
INSERT INTO `t_wh_picking` (`outbound_planning_no`, `movement_id`, `bucket_id`, `status_id`, `picker`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-OUT-1222-0019', '', '', 'PIO', 'rdarmawan', 'mariofrans', '2022-12-23 10:11:24', 'mariofrans', '2022-12-30 15:03:49'),
	('CBT-OUT-1122-0001', '', '', 'CPI', NULL, 'rdarmawan', '2022-12-22 10:31:15', '', NULL),
	('CBT-OUT-1222-0024', '', '', 'CPI', NULL, 'mariofrans', '2022-12-24 13:56:16', 'mariofrans', '2022-12-24 13:57:47'),
	('CBT-OUT-1222-0025', '', '', 'CPI', '', 'rdarmawan', '2022-12-24 14:16:06', 'rdarmawan', '2022-12-24 14:17:11'),
	('CBT-OUT-1222-0026', '', '', 'CPI', NULL, 'rdarmawan', '2022-12-26 08:49:06', 'rdarmawan', '2022-12-26 09:45:18'),
	('CBT-OUT-0123-0001', '', '', 'PIO', 'rdarmawan', 'rdarmawan', '2023-01-05 10:31:30', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-0123-0002', '', '', 'PIO', 'rdarmawan', 'rdarmawan', '2023-01-09 15:51:50', 'rdarmawan', '2023-01-09 16:18:40'),
	('CBT-OUT-0123-0003', '', '', 'PIO', 'mariofrans_spv', 'mariofrans', '2023-01-12 14:04:10', 'mariofrans', '2023-01-12 14:05:05'),
	('CBT-OUT-0123-0004', '', '', 'RPO', NULL, 'atmi', '2023-01-15 17:57:43', '', NULL),
	('CBT-OUT-0123-0006', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-01-17 09:24:45', 'atmi', '2023-01-17 09:26:59'),
	('CBT-OUT-0123-0007', '', '', 'RPO', 'alfian', 'atmi', '2023-01-25 09:12:38', 'atmi', '2023-01-25 09:13:21'),
	('CBT-OUT-0123-0008', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-01-25 09:36:11', 'atmi', '2023-01-25 09:40:45'),
	('CBT-OUT-0223-0001', '', '', 'RPO', 'hari', 'atmi', '2023-02-03 11:47:12', 'atmi', '2023-02-03 11:48:58'),
	('CBT-OUT-0223-0002', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-03 11:51:00', 'atmi', '2023-02-03 11:52:00'),
	('CBT-OUT-0223-0003', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-02-06 09:32:38', 'atmi', '2023-02-06 09:33:34'),
	('CBT-OUT-0223-0004', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-07 18:17:46', 'atmi', '2023-02-07 18:23:41'),
	('CBT-OUT-0223-0005', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-09 16:16:04', 'atmi', '2023-02-09 16:27:49'),
	('CBT-OUT-0223-0006', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-02-14 09:32:32', 'atmi', '2023-02-14 09:58:46'),
	('CBT-OUT-0223-0007', '', '123', 'RPO', 'mariofrans_spv', 'atmi', '2023-02-15 09:47:00', 'mariofrans_spv', '2023-05-22 18:31:14'),
	('CBT-OUT-0223-0008', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-15 13:58:28', 'atmi', '2023-02-15 13:59:50'),
	('CBT-OUT-0223-0009', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-21 09:49:31', 'atmi', '2023-02-21 09:50:45'),
	('CBT-OUT-0123-0005', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-28 10:21:29', 'atmi', '2023-02-28 10:22:15'),
	('CBT-OUT-0223-0010', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-02-28 14:16:40', 'atmi', '2023-02-28 14:33:07'),
	('CBT-OUT-0323-0001', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-03-17 09:42:25', 'atmi', '2023-03-17 09:52:09'),
	('CBT-OUT-0323-0002', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-03-20 08:21:31', 'atmi', '2023-03-20 08:22:03'),
	('CBT-OUT-0323-0003', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-03-20 17:53:16', 'atmi', '2023-03-20 17:57:41'),
	('CBT-OUT-0323-0004', '', '', 'PIO', 'mariofrans_spv', 'superadmin', '2023-03-24 11:20:31', 'superadmin', '2023-03-24 11:21:10'),
	('CBT-OUT-0323-0005', '', '', 'RPO', 'hari', 'atmi', '2023-03-30 15:32:41', 'atmi', '2023-03-30 15:35:08'),
	('CBT-OUT-0423-0001', '', '', 'PIO', 'mariofrans_spv', 'test_admin', '2023-04-04 15:17:46', 'test_admin', '2023-04-04 15:18:51'),
	('CBT-OUT-0423-0002', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-04-06 10:53:45', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0003', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-04-06 14:05:16', 'atmi', '2023-04-06 14:08:45'),
	('CBT-OUT-0423-0004', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-04-10 10:30:30', 'atmi', '2023-04-10 10:46:12'),
	('CBT-OUT-0423-0005', '', '', 'RPO', 'mariofrans_spv', 'atmi', '2023-04-11 09:05:39', 'atmi', '2023-04-11 09:06:23'),
	('CBT-OUT-0423-0006', '', 'ABC123', 'RPO', 'mariofrans_spv', 'atmi', '2023-04-13 09:57:25', 'atmi', '2023-05-19 11:16:45'),
	('CBT-OUT-0423-0007', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-04-17 08:55:01', 'atmi', '2023-04-17 08:55:24'),
	('CBT-OUT-0523-0001', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-05-09 11:23:19', 'atmi', '2023-05-09 11:24:24'),
	('CBT-OUT-0523-0002', '', '', 'PIO', 'mariofrans_spv', 'mariofrans_spv', '2023-05-09 14:40:16', 'mariofrans_spv', '2023-05-09 14:43:07'),
	('CBT-OUT-0523-0003', '', '', 'RPO', 'mariofrans_spv', 'mariofrans_spv', '2023-05-09 15:49:17', 'atmi', '2023-05-09 17:10:39'),
	('CBT-OUT-0523-0004', '', '', 'RPO', NULL, 'atmi', '2023-05-11 10:01:19', '', NULL),
	('CBT-OUT-0523-0005', '', '', 'RPO', NULL, 'atmi', '2023-05-11 14:03:10', '', NULL),
	('CBT-OUT-0523-0006', '', '', 'RPO', NULL, 'atmi', '2023-05-25 10:06:42', '', NULL),
	('CBT-OUT-0623-0001', '', 'test123', 'RPO', 'mariofrans_spv', 'mariofrans', '2023-06-13 16:17:34', 'mariofrans_spv', '2023-06-13 16:34:15'),
	('CBT-OUT-0623-0002', '', 'test02', 'RPO', 'mariofrans_spv', 'mariofrans', '2023-06-13 17:14:54', 'mariofrans_spv', '2023-06-13 17:18:44'),
	('CBT-OUT-0623-0003', '', '', 'PIO', 'mariofrans_spv', 'atmi', '2023-06-30 10:08:49', 'atmi', '2023-06-30 10:09:24'),
	('CBT-OUT-0623-0004', '', '', 'PIO', 'mariofrans_spv', 'mariofrans_spv', '2023-06-30 10:20:18', 'mariofrans_spv', '2023-06-30 10:20:57'),
	('CBT-OUT-0623-0005', '', '', 'RPO', 'mariofrans_spv', 'mariofrans_spv', '2023-07-03 15:53:10', 'mariofrans_spv', '2023-07-03 15:53:28'),
	('CBT-OUT-0623-0006', '', '', 'RPO', NULL, 'superadmin', '2024-03-19 11:56:11', '', NULL),
	('CBT-OUT-0523-0007', '', '', 'RPO', NULL, 'superadmin', '2024-08-26 14:45:19', '', NULL),
	('CBT-OUT-0423-0046', '', '', 'RPO', NULL, 'superadmin', '2024-08-26 14:48:00', '', NULL);
/*!40000 ALTER TABLE `t_wh_picking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_picking_detail
DROP TABLE IF EXISTS `t_wh_picking_detail`;
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

-- Dumping data for table wms.t_wh_picking_detail: 80 rows
/*!40000 ALTER TABLE `t_wh_picking_detail` DISABLE KEYS */;
INSERT INTO `t_wh_picking_detail` (`outbound_planning_no`, `sku`, `batch_no`, `serial_no`, `expired_date`, `pick_qty`, `location_id`, `stock_id`, `gr_id`, `user_created`, `datetime_created`) VALUES
	('CBT-OUT-0123-0001', '112233445', '20201212', '', '2023-12-12', 4, '1A1-001-001', 'AV', 'CBT-GR-1222-0014', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-0123-0001', '112233445', '20210101', '', '2024-01-01', 1, '1A1-001-001', 'AV', 'CBT-GR-1222-0015', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-0123-0001', '112233446', '20200606', '', '2023-06-06', 3, 'R1F3', 'AV', 'CBT-GR-1222-0016', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-0123-0001', '112233446', '20201201', '', '2023-06-06', 2, 'RC09-01', 'AV', 'CBT-GR-1122-0017', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-0123-0001', '112233447', '20210101', '', '2024-01-01', 2, '1A1-001-003', 'AV', 'CBT-GR-1222-0015', 'mariofrans', '2023-01-06 15:12:56'),
	('CBT-OUT-1222-0026', '112233446', '22', '', '2023-01-09', 3, 'DG09', 'AV', '2', '', NULL),
	('CBT-OUT-1222-0026', '112233446', '23', '', '2023-01-10', 1, 'DG09', 'AV', '1', '', NULL),
	('CBT-OUT-0123-0002', '47RW1EJ', '', '', NULL, 3, '1A1-001-002', 'AV', 'CBT-GR-1122-0017', 'rdarmawan', '2023-01-09 16:18:40'),
	('CBT-OUT-0123-0003', '112233446', '20201201', '', '2023-12-01', 1, '1A1-001-001', 'AV', 'CBT-GR-1122-0017', 'mariofrans', '2023-01-12 14:05:05'),
	('CBT-OUT-0123-0003', '112233446', '20200606', '', '2023-06-06', 2, '1A1-001-003', 'AV', 'CBT-GR-1222-0016', 'mariofrans', '2023-01-12 14:05:05'),
	('CBT-OUT-0123-0003', '47RW1EJ', '', '', NULL, 1, '1A1-001-001', 'AV', 'CBT-GR-1122-0017', 'mariofrans', '2023-01-12 14:05:05'),
	('CBT-OUT-0123-0003', '47RW1EJ', '', '', NULL, 2, '1A1-001-002', 'AV', 'CBT-GR-1122-0017', 'mariofrans', '2023-01-12 14:05:05'),
	('CBT-OUT-0123-0006', 'IC0123', '', '', NULL, 10, '1B1-001-001', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-01-17 09:26:59'),
	('CBT-OUT-0123-0007', '112233445', '20230113', '', '2025-01-13', 2, '1A1-001-002', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-01-25 09:13:21'),
	('CBT-OUT-0123-0008', '32L5995', '', '', NULL, 10, '1A1-001-001', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-01-25 09:40:45'),
	('CBT-OUT-0123-0008', 'IC0123', '', '', NULL, 10, '1B1-001-001', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-01-25 09:40:45'),
	('CBT-OUT-0223-0001', '32L5995', '20221104', '', NULL, 2, '1A1-001-002', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-02-03 11:48:58'),
	('CBT-OUT-0223-0001', 'IC0123', '', '', NULL, 10, '1B1-001-001', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-02-03 11:48:58'),
	('CBT-OUT-0223-0002', '112233447', '12131', '', NULL, 2, '1A1-001-001', 'DMG', 'CBT-GR-0123-0009', 'atmi', '2023-02-03 11:52:00'),
	('CBT-OUT-0223-0002', '112233447', '12131', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-0123-0009', 'atmi', '2023-02-03 11:52:00'),
	('CBT-OUT-0223-0003', '112233446', '20200606', '', '2023-06-06', 2, '1A1-001-003', 'AV', 'CBT-GR-1222-0016', 'atmi', '2023-02-06 09:33:34'),
	('CBT-OUT-0223-0004', '75016438', '', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-02-07 18:23:41'),
	('CBT-OUT-0223-0004', '75016438', '', '', NULL, 1, '1A1-001-003', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-02-07 18:23:41'),
	('CBT-OUT-0223-0005', '112233445', '20201212', '', '2023-12-12', 1, '1A1-001-001', 'AV', 'CBT-GR-1222-0014', 'atmi', '2023-02-09 16:27:49'),
	('CBT-OUT-0223-0005', '112233445', '20230113', '', '2025-01-13', 2, '1A1-001-002', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-02-09 16:27:49'),
	('CBT-OUT-0223-0005', '112233445', '20210101', '', '2024-01-01', 2, 'R1F3', 'QR', 'CBT-GR-1222-0015', 'atmi', '2023-02-09 16:27:49'),
	('CBT-OUT-0223-0006', '112233445', '20230113', '', '2023-01-13', 5, 'R1F3', 'DMG', 'CBT-GR-0123-0007', 'atmi', '2023-02-14 09:58:46'),
	('CBT-OUT-0223-0007', '112233445', '20201212', '', '2023-12-12', 5, '1A1-001-001', 'AV', 'CBT-GR-1222-0014', 'atmi', '2023-02-15 09:48:13'),
	('CBT-OUT-0223-0007', '112233445', '20230113', '', '2025-01-13', 5, '1A1-001-002', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-02-15 09:48:13'),
	('CBT-OUT-0223-0007', '112233447', '12131', '', NULL, 3, '1A1-001-001', 'DMG', 'CBT-GR-0123-0009', 'atmi', '2023-02-15 09:48:13'),
	('CBT-OUT-0223-0007', '112233447', '12131', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-0123-0009', 'atmi', '2023-02-15 09:48:13'),
	('CBT-OUT-0223-0007', '112233447', '20210101', '', '2024-01-01', 1, '1A1-001-003', 'AV', 'CBT-GR-1222-0015', 'atmi', '2023-02-15 09:48:13'),
	('CBT-OUT-0223-0008', '75016438', '', '', NULL, 3, '1A1-001-002', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-02-15 13:59:50'),
	('CBT-OUT-0223-0008', '75016438', '', '', NULL, 2, '1A1-001-003', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-02-15 13:59:50'),
	('CBT-OUT-0223-0009', '112233447', '12131', '', NULL, 5, '1A1-001-001', 'DMG', 'CBT-GR-0123-0009', 'atmi', '2023-02-21 09:50:45'),
	('CBT-OUT-0123-0005', '112233447', '20210101', '', '2024-01-01', 1, '1A1-001-003', 'AV', 'CBT-GR-1222-0015', 'atmi', '2023-02-28 10:22:15'),
	('CBT-OUT-0223-0010', '112233445', '20230113', '', '2025-01-13', 2, '1A1-001-002', 'AV', 'CBT-GR-0123-0007', 'atmi', '2023-02-28 14:33:07'),
	('CBT-OUT-0323-0001', '32L5995', '20221104', '', NULL, 1, '1A1-001-003', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-03-17 09:52:09'),
	('CBT-OUT-0323-0001', '32L5995', '20221104', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-03-17 09:52:09'),
	('CBT-OUT-0323-0001', '32L5995', '', '', NULL, 1, '1A1-001-001', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-03-17 09:52:09'),
	('CBT-OUT-0323-0002', '32L5995', '', '', NULL, 1, '1A1-001-001', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-03-20 08:22:03'),
	('CBT-OUT-0323-0003', '112233447', '20210101', '', '2024-01-01', 10, '1A1-001-003', 'AV', 'CBT-GR-1222-0015', 'atmi', '2023-03-20 17:57:41'),
	('CBT-OUT-0323-0004', '47RW1EJ', '', '', NULL, 1, '1A1-001-001', 'AV', 'CBT-GR-1122-0017', 'superadmin', '2023-03-24 11:21:10'),
	('CBT-OUT-0323-0004', '47RW1EJ', '', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-1122-0017', 'superadmin', '2023-03-24 11:21:10'),
	('CBT-OUT-0323-0005', '112233446', '03022023', '', '2025-02-03', 10, 'test_location_1', 'AV', 'CBT-GR-0223-0002', 'atmi', '2023-03-30 15:35:08'),
	('CBT-OUT-0323-0005', '112233447', '', '', '2028-09-23', 5, '1A1-001-001', 'AV', 'CBT-GR-0223-0011', 'atmi', '2023-03-30 15:35:08'),
	('CBT-OUT-0423-0001', '47RW1EJ', 'BO12', 'SO12', NULL, 8, '1A1-001-002', 'AV', 'CBT-GR-0423-0001', 'test_admin', '2023-04-04 15:18:51'),
	('CBT-OUT-0423-0002', 'ABC123', '', 'ABC123123', NULL, 1, '1A1-001-002', 'DMG', 'CBT-GR-0323-0004', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0002', 'ABC123', '', 'ABC123123', NULL, 2, 'DMG01-001', 'AV', 'CBT-GR-0323-0004', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0002', 'ABC123', '', 'ABC123123', NULL, 2, 'test_location_1', 'DMG', 'CBT-GR-0323-0004', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0002', 'ABC456', '270323', '', '2024-03-31', 1, 'DMG-001-001', 'DMG', 'CBT-GR-0323-0005', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0002', 'ABC456', '270323', '', '2024-03-31', 1, 'test_location_1', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0002', 'ABC456', '270323', '', '2024-03-31', 1, 'test_location_2', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-06 11:56:47'),
	('CBT-OUT-0423-0003', '75016438', '', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-04-06 14:08:45'),
	('CBT-OUT-0423-0003', '75016438', '', '', NULL, 1, '1A1-001-003', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-04-06 14:08:45'),
	('CBT-OUT-0423-0004', 'ABC123', '', 'ABC123123', NULL, 1, 'DMG01-001', 'AV', 'CBT-GR-0323-0004', 'atmi', '2023-04-10 10:46:12'),
	('CBT-OUT-0423-0004', 'ABC123', '', 'ABC123123', NULL, 1, 'test_location_1', 'DMG', 'CBT-GR-0323-0004', 'atmi', '2023-04-10 10:46:12'),
	('CBT-OUT-0423-0004', 'ABC456', '270323', '', '2024-03-31', 1, 'test_location_1', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-10 10:46:12'),
	('CBT-OUT-0423-0005', '112233445', 'BO124', 'SO124', '2025-09-06', 5, '1A1-001-001', 'AV', 'CBT-GR-0423-0003', 'atmi', '2023-04-11 09:06:23'),
	('CBT-OUT-0423-0005', '112233446', '20200606', '', '2023-06-06', 3, '1A1-001-003', 'AV', 'CBT-GR-1222-0016', 'atmi', '2023-04-11 09:06:23'),
	('CBT-OUT-0423-0005', '112233447', '270323', '', '2024-03-31', 2, '1A1-001-001', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-11 09:06:23'),
	('CBT-OUT-0423-0005', '112233447', '270323', '', '2024-03-31', 2, '1A1-001-002', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-11 09:06:23'),
	('CBT-OUT-0423-0006', 'ABC123', '', 'ABC123123', NULL, 3, 'DMG01-001', 'AV', 'CBT-GR-0323-0004', 'atmi', '2023-04-13 10:23:39'),
	('CBT-OUT-0423-0006', 'ABC123', '', 'ABC123123', NULL, 2, 'test_location_1', 'DMG', 'CBT-GR-0323-0004', 'atmi', '2023-04-13 10:23:39'),
	('CBT-OUT-0423-0006', 'ABC456', '270323', '', '2024-03-31', 2, 'test_location_1', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-13 10:23:39'),
	('CBT-OUT-0423-0006', 'ABC456', '270323', '', '2024-03-31', 3, 'test_location_2', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-04-13 10:23:39'),
	('CBT-OUT-0423-0007', '32L5995', '', '', NULL, 2, '1A1-001-001', 'AV', 'CBT-GR-1022-0043', 'atmi', '2023-04-17 08:55:24'),
	('CBT-OUT-0523-0001', '112233445', 'BO124', 'SO124', '2025-09-06', 3, '1A1-001-001', 'AV', 'CBT-GR-0423-0003', 'atmi', '2023-05-09 11:24:24'),
	('CBT-OUT-0523-0001', '112233446', '23022023', '', '2024-02-23', 2, 'FL001', 'AV', 'CBT-GR-0223-0015', 'atmi', '2023-05-09 11:24:24'),
	('CBT-OUT-0523-0002', 'ABC123', '', 'ABC123123', NULL, 3, '1A1-001-001', 'AV', 'CBT-GR-0323-0004', 'mariofrans_spv', '2023-05-09 14:43:07'),
	('CBT-OUT-0523-0002', 'ABC123', '', 'ABC123123', NULL, 2, 'test_location_1', 'DMG', 'CBT-GR-0323-0004', 'mariofrans_spv', '2023-05-09 14:43:07'),
	('CBT-OUT-0523-0003', '112233447', '270323', '', '2024-03-31', 5, '1A1-001-002', 'AV', 'CBT-GR-0323-0005', 'atmi', '2023-05-09 17:10:39'),
	('CBT-OUT-0523-0003', '75016438', '', '', NULL, 5, '1A1-001-002', 'AV', 'CBT-GR-0123-0012', 'atmi', '2023-05-09 17:10:39'),
	('CBT-OUT-0623-0001', 'ABC456', '270323', '', '2024-03-31', 1, 'test_location_1', 'AV', 'CBT-GR-0323-0005', 'mariofrans', '2023-06-13 16:18:50'),
	('CBT-OUT-0623-0001', 'ABC456', '270323', '', '2024-03-31', 1, 'test_location_2', 'AV', 'CBT-GR-0323-0005', 'mariofrans', '2023-06-13 16:18:50'),
	('CBT-OUT-0623-0002', '32L5995', '', '', NULL, 2, '1A1-001-001', 'AV', 'CBT-GR-1022-0043', 'mariofrans', '2023-06-13 17:16:02'),
	('CBT-OUT-0623-0002', '75016438', '', '', NULL, 2, '1A1-001-003', 'AV', 'CBT-GR-0123-0012', 'mariofrans', '2023-06-13 17:16:02'),
	('CBT-OUT-0623-0003', 'ABC123', '', 'ABC123123', NULL, 2, '1A1-001-001', 'AV', 'CBT-GR-0323-0004', 'atmi', '2023-06-30 10:09:24'),
	('CBT-OUT-0623-0004', '75016438', '', '', NULL, 1, '1A1-001-002', 'AV', 'CBT-GR-0123-0012', 'mariofrans_spv', '2023-06-30 10:20:57'),
	('CBT-OUT-0623-0005', '112233446', '03022023', '', '2025-02-03', 1, 'test_location_1', 'AV', 'CBT-GR-0223-0002', 'mariofrans_spv', '2023-07-03 15:53:28');
/*!40000 ALTER TABLE `t_wh_picking_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive
DROP TABLE IF EXISTS `t_wh_receive`;
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

-- Dumping data for table wms.t_wh_receive: 49 rows
/*!40000 ALTER TABLE `t_wh_receive` DISABLE KEYS */;
INSERT INTO `t_wh_receive` (`gr_id`, `inbound_planning_no`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-GR-1022-0042', 'CBT0107220002', 'OGR', 'test_staff', '2022-10-27 15:59:35', 'mariofrans', '2022-10-31 12:18:40', 'Y'),
	('CBT-GR-1022-0001', 'CBT0107220002', 'CGR', 'atmi', '2022-10-06 10:38:34', 'atmi', '2022-10-21 10:40:16', 'Y'),
	('CBT0207220001', 'CBT0107220002', 'OGR', 'atmi', '2022-09-16 22:07:26', NULL, NULL, 'Y'),
	('CBT-GR-1022-0043', 'CBT-IN-1022-0044', 'CGR', 'atmi', '2022-11-06 17:01:27', 'atmi', '2022-11-06 22:29:22', 'Y'),
	('CBT-GR-1122-0001', 'CBT-IN-1122-0001', 'CGR', 'atmi', '2022-11-02 07:01:27', 'atmi', '2022-11-06 22:29:22', 'Y'),
	('CBT-GR-1122-0014', 'CBT-IN-1122-0014', 'RGR', 'mariofrans', '2022-11-09 09:45:39', 'atmi', '2022-12-14 14:37:15', 'Y'),
	('CBT-GR-1122-0015', 'CBT-IN-1122-0015', 'RGR', 'mariofrans', '2022-11-09 17:26:09', 'mariofrans', '2022-11-09 17:26:17', 'Y'),
	('CBT-GR-1122-0016', 'CBT-IN-1122-0016', 'RGR', 'mariofrans', '2022-11-14 14:53:06', 'mariofrans', '2022-11-14 14:57:42', 'Y'),
	('CBT-GR-1122-0017', 'CBT-IN-1122-0017', 'CGR', 'atmi', '2022-11-16 09:07:52', 'atmi', '2022-11-16 10:07:25', 'Y'),
	('CBT-GR-1222-0014', 'CBT-IN-1222-0014', 'CGR', 'mariofrans', '2022-12-15 10:55:31', 'mariofrans', '2022-12-15 11:04:20', 'Y'),
	('CBT-GR-1222-0015', 'CBT-IN-1222-0015', 'RGR', 'mariofrans', '2022-12-15 12:01:49', 'mariofrans', '2022-12-15 12:02:38', 'Y'),
	('CBT-GR-1222-0016', 'CBT-IN-1222-0016', 'RGR', 'mariofrans', '2022-12-15 12:55:16', 'mariofrans', '2022-12-15 12:56:41', 'Y'),
	('CBT-GR-0123-0001', 'CBT-IN-0123-0001', 'RGR', 'mariofrans', '2023-01-03 17:41:57', 'atmi', '2023-01-09 08:48:19', 'Y'),
	('CBT-GR-0123-0002', 'CBT-IN-0123-0002', 'RGR', 'mariofrans', '2023-01-09 10:02:34', 'mariofrans', '2023-01-11 18:00:53', 'Y'),
	('CBT-GR-0123-0003', 'CBT-IN-0123-0003', 'RGR', 'mariofrans', '2023-01-09 10:12:36', 'atmi', '2023-01-09 14:42:50', 'Y'),
	('CBT-GR-0123-0004', 'CBT-IN-0123-0004', 'RGR', 'atmi', '2023-01-09 14:19:55', 'atmi', '2023-01-09 14:24:55', 'Y'),
	('CBT-GR-0123-0005', 'CBT-IN-0123-0005', 'RGR', 'mariofrans', '2023-01-12 10:14:43', 'mariofrans', '2023-01-12 10:17:58', 'Y'),
	('CBT-GR-0123-0006', 'CBT-IN-0123-0006', 'CGR', 'mariofrans', '2023-01-12 10:36:54', 'mariofrans', '2023-01-12 11:14:04', 'Y'),
	('CBT-GR-0123-0007', 'CBT-IN-0123-0007', 'CGR', 'atmi', '2023-01-13 10:18:21', 'atmi', '2023-01-13 11:11:36', 'Y'),
	('CBT-GR-0123-0008', 'CBT-IN-0123-0008', 'RGR', 'mariofrans', '2023-01-17 09:32:47', 'mariofrans', '2023-01-17 09:39:18', 'Y'),
	('CBT-GR-0123-0009', 'CBT-IN-0123-0009', 'CGR', 'mariofrans', '2023-01-17 09:54:01', 'mariofrans', '2023-01-17 09:58:29', 'Y'),
	('CBT-GR-0123-0010', 'CBT-IN-0123-0010', 'RGR', 'test_staff', '2023-01-19 14:51:07', 'test_staff', '2023-01-19 14:51:37', 'Y'),
	('CBT-GR-0123-0012', 'CBT-IN-0123-0012', 'CGR', 'mariofrans', '2023-01-24 09:30:22', 'mariofrans', '2023-01-24 09:31:26', 'Y'),
	('CBT-GR-0223-0002', 'CBT-IN-0223-0002', 'CGR', 'atmi', '2023-02-03 10:21:46', 'atmi', '2023-02-03 10:29:14', 'Y'),
	('CBT-GR-0223-0003', 'CBT-IN-0223-0003', 'RGR', 'mariofrans', '2023-02-07 13:33:36', 'mariofrans', '2023-02-07 13:33:52', 'Y'),
	('CBT-GR-0223-0004', 'CBT-IN-0223-0004', 'CGR', 'atmi', '2023-02-08 11:41:50', 'superadmin', '2023-03-24 09:05:25', 'Y'),
	('CBT-GR-0223-0006', 'CBT-IN-0223-0006', 'CGR', 'atmi', '2023-02-08 15:25:24', 'atmi', '2023-02-09 09:55:09', 'Y'),
	('CBT-GR-0223-0011', 'CBT-IN-0223-0011', 'CGR', 'atmi', '2023-02-16 17:39:08', 'atmi', '2023-02-16 17:41:21', 'Y'),
	('CBT-GR-0223-0015', 'CBT-IN-0223-0015', 'CGR', 'atmi', '2023-02-23 16:51:57', 'atmi', '2023-02-23 16:57:22', 'Y'),
	('CBT-GR-0323-0001', 'CBT-IN-0323-0001', 'CGR', 'atmi', '2023-03-18 23:16:44', 'atmi', '2023-03-18 23:18:33', 'Y'),
	('CBT-GR-0323-0003', 'CBT-IN-0323-0003', 'CGR', 'atmi', '2023-03-20 14:42:17', 'atmi', '2023-03-20 15:27:30', 'Y'),
	('CBT-GR-0323-0002', 'CBT-IN-0323-0002', 'CGR', 'atmi', '2023-03-21 09:28:46', 'atmi', '2023-03-21 14:35:40', 'Y'),
	('CBT-GR-0323-0004', 'CBT-IN-0323-0004', 'CGR', 'atmi', '2023-03-24 15:04:59', 'atmi', '2023-06-06 19:43:55', 'Y'),
	('CBT-GR-0323-0005', 'CBT-IN-0323-0005', 'CGR', 'atmi', '2023-03-27 13:52:01', 'atmi', '2023-03-27 14:05:54', 'Y'),
	('CBT-GR-0423-0055', 'CBT-IN-0423-0055', 'RGR', 'bunga', '2023-04-04 14:14:12', 'bunga', '2023-04-04 14:36:41', 'Y'),
	('CBT-GR-0423-0001', 'CBT-IN-0423-0001', 'RGR', 'test_admin', '2023-04-04 14:42:09', 'test_admin', '2023-04-04 14:51:04', 'Y'),
	('CBT-GR-0223-0010', 'CBT-IN-0223-0010', 'CGR', 'atmi', '2023-04-05 10:42:33', 'atmi', '2023-04-05 13:21:44', 'Y'),
	('CBT-GR-0423-0002', 'CBT-IN-0423-0002', 'RGR', 'atmi', '2023-04-06 08:40:11', 'atmi', '2023-04-13 11:45:47', 'Y'),
	('CBT-GR-0323-0049', 'CBT-IN-0323-0049', 'CGR', 'atmi', '2023-04-06 08:57:46', 'atmi', '2023-06-06 19:41:25', 'Y'),
	('CBT-GR-0423-0003', 'CBT-IN-0423-0003', 'CGR', 'atmi', '2023-04-06 12:35:36', 'atmi', '2023-04-06 12:50:03', 'Y'),
	('CBT-GR-0423-0004', 'CBT-IN-0423-0004', 'CGR', 'atmi', '2023-04-17 14:40:11', 'atmi', '2023-06-06 19:53:12', 'Y'),
	('CBT-GR-0523-0002', 'CBT-IN-0523-0002', 'RGR', 'atmi', '2023-05-21 13:55:23', 'atmi', '2023-05-21 14:05:59', 'Y'),
	('CBT-GR-0523-0003', 'CBT-IN-0523-0003', 'RGR', 'atmi', '2023-05-22 09:48:55', 'atmi', '2023-05-22 13:52:06', 'Y'),
	('CBT-GR-0523-0004', 'CBT-IN-0523-0004', 'CGR', 'atmi', '2023-05-24 12:02:11', 'atmi', '2023-05-24 18:46:41', 'Y'),
	('CBT-GR-0724-0001', 'CBT-IN-0724-0001', 'RGR', 'superadmin', '2024-07-15 17:02:23', 'superadmin', '2024-07-15 17:02:43', 'Y'),
	('CBT-GR-0824-0001', 'CBT-IN-0824-0001', 'RGR', 'superadmin', '2024-08-26 13:44:24', 'superadmin', '2024-08-26 13:44:37', 'Y'),
	('CBT-GR-0623-0003', 'CBT-IN-0623-0003', 'RGR', 'superadmin', '2024-08-26 14:25:00', 'superadmin', '2024-08-26 14:25:14', 'Y'),
	('CBT-GR-0623-0002', 'CBT-IN-0623-0002', 'RGR', 'superadmin', '2024-08-27 16:24:44', 'superadmin', '2024-08-27 16:26:28', 'Y'),
	('CBT-GR-0824-0002', 'CBT-IN-0824-0002', 'CGR', 'superadmin', '2024-08-28 11:41:10', 'superadmin', '2024-08-28 11:44:03', 'Y');
/*!40000 ALTER TABLE `t_wh_receive` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_2
DROP TABLE IF EXISTS `t_wh_receive_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='checking and receiving';

-- Dumping data for table wms.t_wh_receive_2: 5 rows
/*!40000 ALTER TABLE `t_wh_receive_2` DISABLE KEYS */;
INSERT INTO `t_wh_receive_2` (`id`, `inbound_id`, `gr_id`, `client_project_id`, `GR_date`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	(1, 0, 'CBT0207220001', 1, '2022-09-16 22:07:26', 2, 'atmi', '2022-09-16 22:07:26', NULL, NULL, 'Y'),
	(2, 0, 'CBT-GR-1022-0001', 1, '2022-10-06 10:38:34', 8, 'atmi', '2022-10-06 10:38:34', 'atmi', '2022-10-21 10:40:16', 'Y'),
	(3, 0, 'CBT-GR-1022-0042', 1, '2022-10-27 15:59:35', 4, 'test_staff', '2022-10-27 15:59:35', 'mariofrans', '2022-10-31 12:18:40', 'Y'),
	(4, 43, 'CBT-GR-1122-0013', 1, '2022-11-01 11:08:23', 4, 'test_staff', '2022-11-01 11:08:23', 'test_staff', '2022-11-01 11:08:37', 'Y'),
	(5, 42, 'CBT-GR-1022-0043', 1, '2022-11-03 12:41:01', 7, 'test_admin', '2022-11-03 12:41:01', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_receive_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_detail
DROP TABLE IF EXISTS `t_wh_receive_detail`;
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_receive_detail: 39 rows
/*!40000 ALTER TABLE `t_wh_receive_detail` DISABLE KEYS */;
INSERT INTO `t_wh_receive_detail` (`gr_id`, `movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-GR-1022-0043', 'CBT-01-1122-00005', 'atmi', '2022-11-06 20:08:32', NULL, NULL, 'Y'),
	('CBT-GR-1022-0001', 'CBT-01-112022-00001', 'test_staff', '2022-10-27 15:59:35', NULL, NULL, 'Y'),
	('CBT0207220001', 'CBT-01-112022-00004', 'atmi', '2022-10-10 09:08:40', NULL, NULL, 'Y'),
	('CBT-GR-1122-0001', 'CBT-08-1122-00001', 'test_staff', '2022-11-02 15:59:35', NULL, NULL, 'Y'),
	('CBT-GR-1122-0017', 'CBT-01-1122-0020', 'atmi', '2022-11-16 09:35:51', NULL, NULL, 'Y'),
	('CBT-GR-1122-0016', 'CBT-01-1122-0019', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-GR-1122-0015', 'CBT-01-1122-0018', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-GR-1122-0014', 'CBT-01-1122-0017', 'mariofrans', '2022-11-09 14:51:38', NULL, NULL, 'Y'),
	('CBT-GR-1222-0014', 'CBT-01-1222-0013', 'mariofrans', '2022-12-15 10:57:39', NULL, NULL, 'Y'),
	('CBT-GR-1222-0015', 'CBT-01-1222-0014', 'mariofrans', '2022-12-15 12:04:55', NULL, NULL, 'Y'),
	('CBT-GR-1222-0016', 'CBT-01-1222-0015', 'mariofrans', '2022-12-15 12:58:07', NULL, NULL, 'Y'),
	('CBT-GR-0123-0001', 'CBT-01-0123-0001', 'atmi', '2023-01-09 09:03:07', NULL, NULL, 'Y'),
	('CBT-GR-0123-0004', 'CBT-01-0123-0002', 'atmi', '2023-01-10 10:07:10', NULL, NULL, 'Y'),
	('CBT-GR-0123-0005', 'CBT-01-0123-0003', 'mariofrans', '2023-01-12 10:25:52', NULL, NULL, 'Y'),
	('CBT-GR-0123-0006', 'CBT-01-0123-0004', 'mariofrans', '2023-01-12 10:52:27', NULL, NULL, 'Y'),
	('CBT-GR-0123-0007', 'CBT-01-0123-0005', 'atmi', '2023-01-13 11:08:53', NULL, NULL, 'Y'),
	('CBT-GR-0123-0009', 'CBT-01-0123-0006', 'mariofrans', '2023-01-17 09:57:31', NULL, NULL, 'Y'),
	('CBT-GR-0123-0012', 'CBT-01-0123-0007', 'mariofrans', '2023-01-24 09:31:18', NULL, NULL, 'Y'),
	('CBT-GR-0223-0002', 'CBT-01-0223-0001', 'atmi', '2023-02-03 10:28:13', NULL, NULL, 'Y'),
	('CBT-GR-0223-0004', 'CBT-01-0223-0002', 'atmi', '2023-02-08 11:52:20', NULL, NULL, 'Y'),
	('CBT-GR-0223-0006', 'CBT-01-0223-0003', 'atmi', '2023-02-09 09:54:25', NULL, NULL, 'Y'),
	('CBT-GR-0223-0011', 'CBT-01-0223-0004', 'atmi', '2023-02-16 17:40:39', NULL, NULL, 'Y'),
	('CBT-GR-0223-0015', 'CBT-01-0223-0005', 'atmi', '2023-02-23 16:56:44', NULL, NULL, 'Y'),
	('CBT-GR-0323-0001', 'CBT-01-0323-0001', 'atmi', '2023-03-18 23:18:17', NULL, NULL, 'Y'),
	('CBT-GR-0323-0003', 'CBT-01-0323-0002', 'atmi', '2023-03-20 15:18:10', NULL, NULL, 'Y'),
	('CBT-GR-0323-0002', 'CBT-02-0323-0001', 'atmi', '2023-03-21 14:03:43', NULL, NULL, 'Y'),
	('CBT-GR-0323-0004', 'CBT-01-0323-0003', 'atmi', '2023-03-24 15:53:43', NULL, NULL, 'Y'),
	('CBT-GR-0323-0005', 'CBT-01-0323-0004', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-GR-0423-0001', 'CBT-03-0423-0001', 'test_admin', '2023-04-04 14:49:57', NULL, NULL, 'Y'),
	('CBT-GR-0223-0010', 'CBT-01-0423-0001', 'atmi', '2023-04-05 13:11:52', NULL, NULL, 'Y'),
	('CBT-GR-0423-0003', 'CBT-01-0423-0002', 'atmi', '2023-04-06 12:45:57', NULL, NULL, 'Y'),
	('CBT-GR-0323-0049', 'CBT-01-0423-0003', 'atmi', '2023-04-11 12:03:09', NULL, NULL, 'Y'),
	('CBT-GR-0423-0002', 'CBT-01-0423-0004', 'atmi', '2023-04-13 11:48:57', NULL, NULL, 'Y'),
	('CBT-GR-0523-0004', 'CBT-01-0523-0001', 'atmi', '2023-05-24 18:46:13', NULL, NULL, 'Y'),
	('CBT-GR-0423-0004', 'CBT-01-0523-0002', 'atmi', '2023-05-26 10:21:22', NULL, NULL, 'Y'),
	('CBT-GR-0824-0001', 'CBT-01-0824-0001', 'superadmin', '2024-08-26 13:46:21', NULL, NULL, 'Y'),
	('CBT-GR-0623-0003', 'CBT-01-0824-0002', 'superadmin', '2024-08-26 14:29:10', NULL, NULL, 'Y'),
	('CBT-GR-0623-0002', 'CBT-01-0824-0003', 'superadmin', '2024-08-27 16:27:23', NULL, NULL, 'Y'),
	('CBT-GR-0824-0002', 'CBT-01-0824-0004', 'superadmin', '2024-08-28 11:43:00', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_receive_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_detail_2
DROP TABLE IF EXISTS `t_wh_receive_detail_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_receive_detail_2: 5 rows
/*!40000 ALTER TABLE `t_wh_receive_detail_2` DISABLE KEYS */;
INSERT INTO `t_wh_receive_detail_2` (`id`, `receive_id`, `movement_id`, `movement_date`, `pallet_id`, `sku`, `part_name`, `serial_no`, `batch_no`, `expired_date`, `location_from`, `location_to`, `qty`, `uom_id`, `stock_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	(1, 2, NULL, NULL, '12346', '32L5995', 'TV Toshiba 32L5995', '20210612', '456928', NULL, '1', '3', 10, 10, 'AV', 'atmi', '2022-10-10 09:08:40', NULL, NULL, 'Y'),
	(2, 3, NULL, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', 'test_26okt22_2', NULL, 'STAGING AREA', 'R1F2', 100, 1, NULL, 'test_staff', '2022-10-27 15:59:35', NULL, NULL, 'Y'),
	(3, 4, NULL, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', 'test_01nov2022_1', '2022-11-26 00:00:00', 'STAGING AREA', NULL, 1, 10, NULL, 'test_staff', '2022-11-01 11:08:23', NULL, NULL, 'Y'),
	(4, 5, NULL, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', '', '281022', NULL, 'STAGING AREA', NULL, 24, 10, NULL, 'test_admin', '2022-11-03 12:41:01', NULL, NULL, 'Y'),
	(5, 5, NULL, NULL, NULL, '32L5995', 'TV Toshiba 32L5995', '', '281022', NULL, 'STAGING AREA', NULL, NULL, 10, NULL, 'test_admin', '2022-11-03 12:41:01', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_receive_detail_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_return
DROP TABLE IF EXISTS `t_wh_receive_return`;
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

-- Dumping data for table wms.t_wh_receive_return: 2 rows
/*!40000 ALTER TABLE `t_wh_receive_return` DISABLE KEYS */;
INSERT INTO `t_wh_receive_return` (`gr_return_id`, `return_no`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-GRR-0523-0001', 'CBT-RTN-0523-0001', 'CRR', 'atmi', '2023-05-17 17:51:33', 'atmi', '2023-06-08 16:31:23', 'Y'),
	('CBT-GRR-0623-0009', 'CBT-RTN-0623-0009', 'CRR', 'mariofrans', '2023-06-13 09:26:00', 'superadmin', '2024-08-28 11:48:41', 'Y');
/*!40000 ALTER TABLE `t_wh_receive_return` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_receive_return_detail
DROP TABLE IF EXISTS `t_wh_receive_return_detail`;
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

-- Dumping data for table wms.t_wh_receive_return_detail: 1 rows
/*!40000 ALTER TABLE `t_wh_receive_return_detail` DISABLE KEYS */;
INSERT INTO `t_wh_receive_return_detail` (`gr_return_id`, `movement_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-GRR-0523-0001', 'CBT-04-0623-0001', 'atmi', '2023-06-07 09:03:54', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_receive_return_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_return
DROP TABLE IF EXISTS `t_wh_return`;
CREATE TABLE IF NOT EXISTS `t_wh_return` (
  `return_no` varchar(20) NOT NULL,
  `client_project_id` int(11) DEFAULT NULL,
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

-- Dumping data for table wms.t_wh_return: 2 rows
/*!40000 ALTER TABLE `t_wh_return` DISABLE KEYS */;
INSERT INTO `t_wh_return` (`return_no`, `client_project_id`, `outbound_reference_no`, `awb`, `reference_no`, `return_date`, `return_from`, `status_id`, `reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-RTN-0523-0001', 1, 'test_outbound_1105_2', '7779254850212', 'RET_001', '2023-05-15', 'ali', 'RER', '', 'atmi', '2023-05-15 09:36:06', NULL, NULL),
	('CBT-RTN-0623-0009', 1, 'test_outbound_2501_2', '999712531548', 'test_outbound_2501_2', '2023-06-13', 'Toko Cahaya Abadi', 'RFR', NULL, 'mariofrans', '2023-06-13 09:23:04', 'superadmin', '2024-08-28 11:46:29');
/*!40000 ALTER TABLE `t_wh_return` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_return_detail
DROP TABLE IF EXISTS `t_wh_return_detail`;
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

-- Dumping data for table wms.t_wh_return_detail: 3 rows
/*!40000 ALTER TABLE `t_wh_return_detail` DISABLE KEYS */;
INSERT INTO `t_wh_return_detail` (`return_no`, `sku`, `item_name`, `batch_no`, `serial_no`, `expired_date`, `part_no`, `imei`, `color`, `size`, `qty`, `uom_name`, `stock_id`, `classification_id`, `item_reason`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-RTN-0523-0001', '112233446', 'Teh Kotak Lemon', '23022023', NULL, '2024-02-23', NULL, NULL, NULL, NULL, 25, 'PIECES', 'AVR', '1', 'kemasan penyok', 'atmi', '2023-05-15 11:54:50', NULL, NULL),
	('CBT-RTN-0623-0009', '32L5995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'PIECES', 'DMGR', '1', 'Rusak', 'mariofrans', '2023-06-13 09:23:04', NULL, NULL),
	('CBT-RTN-0623-0009', 'IC0123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'SET', 'DMGR', '2', 'Rusak', 'mariofrans', '2023-06-13 09:23:04', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_return_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_checking
DROP TABLE IF EXISTS `t_wh_scan_checking`;
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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_scan_checking: 35 rows
/*!40000 ALTER TABLE `t_wh_scan_checking` DISABLE KEYS */;
INSERT INTO `t_wh_scan_checking` (`scan_id`, `outbound_id`, `sku`, `location_id`, `gr_id`, `stock_id`, `batch_no`, `scan_qty`, `user_created`, `datetime_created`) VALUES
	(1, 'CBT-OUT-1222-0019', '112233446', 'RF08-01', '', '', '', 5, 'rdarmawan', '2022-12-30 14:07:46'),
	(2, 'CBT-OUT-1222-0019', '112233446', 'RC09-01', '', '', '', 5, 'rdarmawan', '2022-12-30 14:07:47'),
	(3, 'CBT-OUT-1222-0019', '112233446', 'RF08-01', '', '', '', 1, 'rdarmawan', '2023-01-02 12:36:35'),
	(4, 'CBT-OUT-1222-0026', '112233446', 'DG09', '', '', '', 3, 'rdarmawan', '2023-01-02 12:37:03'),
	(5, 'CBT-OUT-1222-0026', '112233446', 'RY02', '', '', '', 1, 'rdarmawan', '2023-01-02 12:37:51'),
	(6, 'CBT-OUT-0123-0003', '112233446', '1A1-001-001', 'CBT-GR-1122-0017', 'AV', '20201201', 1, 'mariofrans_spv', '2023-01-12 16:08:03'),
	(7, 'CBT-OUT-0123-0003', '112233446', '1A1-001-003', 'CBT-GR-1222-0016', 'AV', '20200606', 2, 'mariofrans_spv', '2023-01-12 16:08:03'),
	(8, 'CBT-OUT-0123-0006', 'IC0123', '1B1-001-001', 'CBT-GR-0123-0007', 'AV', '', 10, 'mariofrans_spv', '2023-01-17 09:33:23'),
	(9, 'CBT-OUT-0123-0008', '32L5995', '1A1-001-001', 'CBT-GR-1022-0043', 'AV', '', 10, 'mariofrans_spv', '2023-01-25 09:53:19'),
	(10, 'CBT-OUT-0123-0008', 'IC0123', '1B1-001-001', 'CBT-GR-0123-0007', 'AV', '', 10, 'mariofrans_spv', '2023-01-25 09:53:36'),
	(11, 'CBT-OUT-0223-0002', '112233447', '1A1-001-001', 'CBT-GR-0123-0009', 'DMG', '12131', 2, 'mariofrans_spv', '2023-02-03 15:41:21'),
	(12, 'CBT-OUT-0223-0002', '112233447', '1A1-001-002', 'CBT-GR-0123-0009', 'AV', '12131', 1, 'mariofrans_spv', '2023-02-03 15:41:21'),
	(13, 'CBT-OUT-0223-0005', '112233445', '1A1-001-001', 'CBT-GR-1222-0014', 'AV', '20201212', 1, 'mariofrans_spv', '2023-02-09 17:10:22'),
	(14, 'CBT-OUT-0223-0005', '112233445', '1A1-001-002', 'CBT-GR-0123-0007', 'AV', '20230113', 2, 'mariofrans_spv', '2023-02-09 17:10:22'),
	(15, 'CBT-OUT-0223-0005', '112233445', 'R1F3', 'CBT-GR-1222-0015', 'QR', '20210101', 2, 'mariofrans_spv', '2023-02-09 17:10:22'),
	(16, 'CBT-OUT-0223-0008', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 3, 'mariofrans_spv', '2023-02-15 14:14:46'),
	(17, 'CBT-OUT-0223-0008', '75016438', '1A1-001-003', 'CBT-GR-0123-0012', 'AV', '', 2, 'mariofrans_spv', '2023-02-15 14:14:46'),
	(18, 'CBT-OUT-0223-0009', '112233447', '1A1-001-001', 'CBT-GR-0123-0009', 'DMG', '12131', 5, 'mariofrans_spv', '2023-02-21 11:11:24'),
	(19, 'CBT-OUT-0123-0005', '112233447', '1A1-001-003', 'CBT-GR-1222-0015', 'AV', '20210101', 1, 'mariofrans_spv', '2023-02-28 10:29:54'),
	(20, 'CBT-OUT-0223-0010', '112233445', '1A1-001-002', 'CBT-GR-0123-0007', 'AV', '20230113', 2, 'mariofrans_spv', '2023-02-28 17:24:48'),
	(21, 'CBT-OUT-0323-0003', '112233447', '1A1-001-003', 'CBT-GR-1222-0015', 'AV', '20210101', 10, 'mariofrans_spv', '2023-03-20 18:19:33'),
	(22, 'CBT-OUT-0423-0002', 'ABC123', '1A1-001-002', 'CBT-GR-0323-0004', 'DMG', '', 1, 'atmi', '2023-04-06 13:54:23'),
	(23, 'CBT-OUT-0423-0002', 'ABC123', 'DMG01-001', 'CBT-GR-0323-0004', 'AV', '', 2, 'atmi', '2023-04-06 13:54:23'),
	(24, 'CBT-OUT-0423-0002', 'ABC123', 'test_location_1', 'CBT-GR-0323-0004', 'DMG', '', 2, 'atmi', '2023-04-06 13:54:23'),
	(25, 'CBT-OUT-0423-0002', 'ABC456', 'DMG-001-001', 'CBT-GR-0323-0005', 'DMG', '270323', 1, 'atmi', '2023-04-06 13:55:47'),
	(26, 'CBT-OUT-0423-0002', 'ABC456', 'test_location_1', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'atmi', '2023-04-06 13:55:47'),
	(27, 'CBT-OUT-0423-0002', 'ABC456', 'test_location_2', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'atmi', '2023-04-06 13:55:47'),
	(28, 'CBT-OUT-0423-0003', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-04-06 14:24:59'),
	(29, 'CBT-OUT-0423-0003', '75016438', '1A1-001-003', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-04-06 14:24:59'),
	(30, 'CBT-OUT-0523-0001', '112233445', '1A1-001-001', 'CBT-GR-0423-0003', 'AV', 'BO124', 3, 'mariofrans_spv', '2023-05-09 14:11:51'),
	(31, 'CBT-OUT-0523-0001', '112233446', 'FL001', 'CBT-GR-0223-0015', 'AV', '23022023', 2, 'mariofrans_spv', '2023-05-09 14:12:10'),
	(32, 'CBT-OUT-0623-0001', 'ABC456', 'test_location_1', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans', '2023-06-13 16:43:24'),
	(33, 'CBT-OUT-0623-0001', 'ABC456', 'test_location_2', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans', '2023-06-13 16:43:24'),
	(34, 'CBT-OUT-0623-0004', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-06-30 10:23:04'),
	(35, 'CBT-OUT-0623-0003', 'ABC123', '1A1-001-001', 'CBT-GR-0323-0004', 'AV', '', 2, 'mariofrans_spv', '2023-06-30 14:58:58');
/*!40000 ALTER TABLE `t_wh_scan_checking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_picking
DROP TABLE IF EXISTS `t_wh_scan_picking`;
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
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_scan_picking: 54 rows
/*!40000 ALTER TABLE `t_wh_scan_picking` DISABLE KEYS */;
INSERT INTO `t_wh_scan_picking` (`scan_id`, `outbound_id`, `sku`, `location_id`, `gr_id`, `stock_id`, `batch_no`, `scan_qty`, `user_created`, `datetime_created`) VALUES
	(1, 'CBT-OUT-1222-0019', '112233446', 'RF08-01', NULL, NULL, NULL, 5, 'rdarmawan', '2022-12-30 14:07:46'),
	(2, 'CBT-OUT-1222-0019', '112233446', 'RC09-01', NULL, NULL, NULL, 5, 'rdarmawan', '2022-12-30 14:07:47'),
	(3, 'CBT-OUT-1222-0019', '112233446', 'RF08-01', NULL, NULL, NULL, 1, 'rdarmawan', '2023-01-02 12:36:35'),
	(4, 'CBT-OUT-1222-0026', '112233446', 'DG09', '2', 'AV', '22', 3, 'rdarmawan', '2023-01-02 12:37:03'),
	(5, 'CBT-OUT-1222-0026', '112233446', 'DG09', '1', 'AV', '23', 1, 'rdarmawan', '2023-01-02 12:37:51'),
	(8, 'CBT-OUT-0123-0001', '112233445', '1A1-001-001', 'CBT-GR-1222-0014', 'AV', '20201212', 4, 'rdarmawan', '2023-01-09 14:19:46'),
	(9, 'CBT-OUT-0123-0001', '112233445', '1A1-001-001', 'CBT-GR-1222-0015', 'AV', '20210101', 1, 'rdarmawan', '2023-01-09 14:19:46'),
	(13, 'CBT-OUT-0123-0001', '112233446', 'R1F3', 'CBT-GR-1222-0016', 'AV', '20200606', 3, 'rdarmawan', '2023-01-09 15:33:49'),
	(14, 'CBT-OUT-0123-0001', '112233446', 'RC09-01', 'CBT-GR-1122-0017', 'AV', '20201201', 2, 'rdarmawan', '2023-01-09 15:36:07'),
	(12, 'CBT-OUT-0123-0001', '112233447', '1A1-001-003', 'CBT-GR-1222-0015', 'AV', '20210101', 2, 'rdarmawan', '2023-01-09 14:33:20'),
	(15, 'CBT-OUT-0123-0002', '47RW1EJ', '1A1-001-002', 'CBT-GR-1122-0017', 'AV', '', 3, 'rdarmawan', '2023-01-09 16:23:37'),
	(27, 'CBT-OUT-0223-0004', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-02-07 18:24:35'),
	(26, 'CBT-OUT-0223-0002', '112233447', '1A1-001-002', 'CBT-GR-0123-0009', 'AV', '12131', 1, 'mariofrans_spv', '2023-02-03 11:53:59'),
	(25, 'CBT-OUT-0223-0002', '112233447', '1A1-001-001', 'CBT-GR-0123-0009', 'DMG', '12131', 2, 'mariofrans_spv', '2023-02-03 11:53:35'),
	(24, 'CBT-OUT-0123-0008', 'IC0123', '1B1-001-001', 'CBT-GR-0123-0007', 'AV', '', 10, 'mariofrans_spv', '2023-01-25 09:50:21'),
	(23, 'CBT-OUT-0123-0008', '32L5995', '1A1-001-001', 'CBT-GR-1022-0043', 'AV', '', 10, 'mariofrans_spv', '2023-01-25 09:49:50'),
	(22, 'CBT-OUT-0123-0006', 'IC0123', '1B1-001-001', 'CBT-GR-0123-0007', 'AV', '', 10, 'mariofrans_spv', '2023-01-17 09:28:04'),
	(28, 'CBT-OUT-0223-0004', '75016438', '1A1-001-003', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-02-07 18:24:49'),
	(29, 'CBT-OUT-0223-0005', '112233445', '1A1-001-001', 'CBT-GR-1222-0014', 'AV', '20201212', 1, 'mariofrans_spv', '2023-02-09 16:29:20'),
	(30, 'CBT-OUT-0223-0005', '112233445', '1A1-001-002', 'CBT-GR-0123-0007', 'AV', '20230113', 2, 'mariofrans_spv', '2023-02-09 16:41:27'),
	(31, 'CBT-OUT-0223-0005', '112233445', 'R1F3', 'CBT-GR-1222-0015', 'QR', '20210101', 2, 'mariofrans_spv', '2023-02-09 16:41:47'),
	(35, 'CBT-OUT-0223-0007', '112233445', '1A1-001-001', 'CBT-GR-1222-0014', 'AV', '20201212', 5, 'mariofrans_spv', '2023-02-15 10:23:16'),
	(36, 'CBT-OUT-0223-0007', '112233445', '1A1-001-002', 'CBT-GR-0123-0007', 'AV', '20230113', 5, 'mariofrans_spv', '2023-02-15 10:48:06'),
	(37, 'CBT-OUT-0223-0008', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 3, 'mariofrans_spv', '2023-02-15 14:02:18'),
	(38, 'CBT-OUT-0223-0008', '75016438', '1A1-001-003', 'CBT-GR-0123-0012', 'AV', '', 2, 'mariofrans_spv', '2023-02-15 14:02:30'),
	(40, 'CBT-OUT-0223-0007', '112233447', '1A1-001-001', 'CBT-GR-0123-0009', 'DMG', '12131', 3, 'mariofrans_spv', '2023-02-15 15:50:20'),
	(42, 'CBT-OUT-0223-0009', '112233447', '1A1-001-001', 'CBT-GR-0123-0009', 'DMG', '12131', 5, 'mariofrans_spv', '2023-02-21 10:37:02'),
	(43, 'CBT-OUT-0123-0005', '112233447', '1A1-001-003', 'CBT-GR-1222-0015', 'AV', '20210101', 1, 'mariofrans_spv', '2023-02-28 10:23:20'),
	(44, 'CBT-OUT-0223-0010', '112233445', '1A1-001-002', 'CBT-GR-0123-0007', 'AV', '20230113', 2, 'mariofrans_spv', '2023-02-28 14:40:09'),
	(45, 'CBT-OUT-0323-0001', '32L5995', '1A1-001-001', 'CBT-GR-1022-0043', 'AV', '', 1, 'mariofrans_spv', '2023-03-17 10:28:35'),
	(46, 'CBT-OUT-0323-0003', '112233447', '1A1-001-003', 'CBT-GR-1222-0015', 'AV', '20210101', 10, 'mariofrans_spv', '2023-03-20 17:59:01'),
	(47, 'CBT-OUT-0323-0004', '47RW1EJ', '1A1-001-001', 'CBT-GR-1122-0017', 'AV', '', 1, 'mariofrans_spv', '2023-03-24 11:22:11'),
	(48, 'CBT-OUT-0323-0004', '47RW1EJ', '1A1-001-002', 'CBT-GR-1122-0017', 'AV', '', 1, 'mariofrans_spv', '2023-03-24 11:22:23'),
	(49, 'CBT-OUT-0423-0001', '47RW1EJ', '1A1-001-002', 'CBT-GR-0423-0001', 'AV', 'BO12', 8, 'mariofrans_spv', '2023-04-04 15:22:55'),
	(50, 'CBT-OUT-0423-0002', 'ABC123', '1A1-001-002', 'CBT-GR-0323-0004', 'DMG', '', 1, 'mariofrans_spv', '2023-04-06 13:44:14'),
	(51, 'CBT-OUT-0423-0002', 'ABC123', 'DMG01-001', 'CBT-GR-0323-0004', 'AV', '', 2, 'mariofrans_spv', '2023-04-06 13:44:36'),
	(52, 'CBT-OUT-0423-0002', 'ABC123', 'test_location_1', 'CBT-GR-0323-0004', 'DMG', '', 2, 'mariofrans_spv', '2023-04-06 13:46:53'),
	(53, 'CBT-OUT-0423-0002', 'ABC456', 'DMG-001-001', 'CBT-GR-0323-0005', 'DMG', '270323', 1, 'mariofrans_spv', '2023-04-06 13:47:59'),
	(54, 'CBT-OUT-0423-0002', 'ABC456', 'test_location_1', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans_spv', '2023-04-06 13:48:17'),
	(55, 'CBT-OUT-0423-0002', 'ABC456', 'test_location_2', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans_spv', '2023-04-06 13:48:49'),
	(56, 'CBT-OUT-0423-0003', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-04-06 14:12:01'),
	(57, 'CBT-OUT-0423-0003', '75016438', '1A1-001-003', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-04-06 14:12:23'),
	(58, 'CBT-OUT-0423-0006', 'ABC123', 'DMG01-001', 'CBT-GR-0323-0004', 'AV', '', 3, 'mariofrans_spv', '2023-04-17 09:17:35'),
	(59, 'CBT-OUT-0423-0007', '32L5995', '1A1-001-001', 'CBT-GR-1022-0043', 'AV', '', 2, 'mariofrans_spv', '2023-04-17 09:41:03'),
	(60, 'CBT-OUT-0523-0001', '112233445', '1A1-001-001', 'CBT-GR-0423-0003', 'AV', 'BO124', 3, 'mariofrans_spv', '2023-05-09 13:38:25'),
	(61, 'CBT-OUT-0523-0001', '112233446', 'FL001', 'CBT-GR-0223-0015', 'AV', '23022023', 2, 'mariofrans_spv', '2023-05-09 13:38:46'),
	(62, 'CBT-OUT-0523-0002', 'ABC123', '1A1-001-001', 'CBT-GR-0323-0004', 'AV', '', 3, 'mariofrans_spv', '2023-05-09 14:43:33'),
	(63, 'CBT-OUT-0523-0002', 'ABC123', 'test_location_1', 'CBT-GR-0323-0004', 'DMG', '', 2, 'mariofrans_spv', '2023-05-09 14:43:49'),
	(68, 'CBT-OUT-0623-0001', 'abc456', 'test_location_1', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans_spv', '2023-06-13 16:23:46'),
	(69, 'CBT-OUT-0623-0001', 'abc456', 'test_location_2', 'CBT-GR-0323-0005', 'AV', '270323', 1, 'mariofrans_spv', '2023-06-13 16:34:15'),
	(70, 'CBT-OUT-0623-0002', '32l5995', '1a1-001-001', 'CBT-GR-1022-0043', 'AV', '', 2, 'mariofrans_spv', '2023-06-13 17:18:05'),
	(71, 'CBT-OUT-0623-0002', '75016438', '1a1-001-003', 'CBT-GR-0123-0012', 'AV', '', 2, 'mariofrans_spv', '2023-06-13 17:18:44'),
	(72, 'CBT-OUT-0623-0003', 'ABC123', '1A1-001-001', 'CBT-GR-0323-0004', 'AV', '', 2, 'mariofrans_spv', '2023-06-30 10:10:37'),
	(73, 'CBT-OUT-0623-0004', '75016438', '1A1-001-002', 'CBT-GR-0123-0012', 'AV', '', 1, 'mariofrans_spv', '2023-06-30 10:21:38');
/*!40000 ALTER TABLE `t_wh_scan_picking` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_qty
DROP TABLE IF EXISTS `t_wh_scan_qty`;
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
) ENGINE=MyISAM AUTO_INCREMENT=221 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_scan_qty: 146 rows
/*!40000 ALTER TABLE `t_wh_scan_qty` DISABLE KEYS */;
INSERT INTO `t_wh_scan_qty` (`scan_id`, `activity_id`, `transport_id`, `pallet_id`, `sku`, `part_name`, `qty_scan`, `uom_name`, `serial_no`, `batch_no`, `stock_id`, `remarks`, `is_submit`, `is_active`, `user_created`, `datetime_created`) VALUES
	(41, 19, 17, '1A1B23', '47RW1EJ', 'TV Toshiba 47RW1EJ', 10, 'PIECES', NULL, '20221104', 'AV', NULL, 'Y', 'N', 'test_staff', '2022-11-11 16:50:55'),
	(40, 17, 16, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 17:25:18'),
	(39, 17, 16, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 17:25:17'),
	(38, 17, 16, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 17:25:09'),
	(36, 15, 15, 'RPX010204', '75016438', 'DISPLAY PANEL V216B1-L02', 3, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 09:34:53'),
	(37, 17, 16, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 17:25:07'),
	(34, 15, 15, 'RPX010205', '75016438', 'DISPLAY PANEL V216B1-L02', 2, 'PIECES', NULL, '', 'DMG', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 09:10:18'),
	(33, 15, 15, 'RPX010203', '32L5995', 'TV Toshiba 32L5995', 2, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 09:10:12'),
	(32, 15, 15, 'RPX010203', '32L5995', 'TV Toshiba 32L5995', 3, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-09 09:10:11'),
	(31, 13, 14, '123456', '47RW1EJ', 'TV Toshiba 47RW1EJ', 20, 'PIECES', '', '20221104', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-04 14:00:00'),
	(30, 9, 12, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 12, 'PIECES', NULL, '281022', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-03 12:37:52'),
	(29, 9, 12, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 12, 'PIECES', NULL, '281022', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-03 12:37:42'),
	(42, 19, 17, '1A1B23', '47RW1EJ', 'TV Toshiba 47RW1EJ', 10, 'PIECES', NULL, '20221104', 'AV', NULL, 'Y', 'N', 'test_staff', '2022-11-11 16:51:41'),
	(43, 22, 18, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 8, 'PIECES', NULL, '1234', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-14 14:45:56'),
	(44, 22, 18, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 2, 'PIECES', NULL, '1234', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-14 14:48:15'),
	(45, 22, 19, NULL, '32L5995', 'TV Toshiba 32L5995', 2, 'PIECES', NULL, '1234', 'DMG', NULL, 'Y', 'Y', 'atmi', '2022-11-14 14:49:01'),
	(46, 22, 19, NULL, '32L5995', 'TV Toshiba 32L5995', 3, 'PIECES', NULL, '1234', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-14 14:49:41'),
	(47, 24, 20, NULL, '32L5995', 'TV Toshiba 32L5995', 20, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-16 08:52:43'),
	(48, 24, 20, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', 20, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2022-11-16 08:53:53'),
	(50, 20, 21, '1A12Z', '32L5995', 'TV Toshiba 32L5995', 4, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-16 13:28:03'),
	(51, 20, 21, '1A12Z', '47RW1EJ', 'TV Toshiba 47RW1EJ', 5, 'PIECES', NULL, '20221104', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-11-16 13:28:56'),
	(52, 20, 21, '2B456', '47RW1EJ', 'TV Toshiba 47RW1EJ', 2, 'PIECES', NULL, '20221104', 'DMG', NULL, 'Y', 'Y', 'test_admin', '2022-11-16 13:29:21'),
	(53, 30, 22, 'tes123', '112233445', 'Teh Kotak Original', 50, 'PIECES', NULL, '20201212', 'AV', NULL, 'Y', 'Y', 'test_staff', '2022-12-15 09:39:00'),
	(54, 30, 22, 'tes123', '112233446', 'Teh Kotak Lemon', 25, 'PIECES', NULL, '20201201', 'AV', NULL, 'Y', 'Y', 'test_staff', '2022-12-15 09:39:25'),
	(55, 32, 23, 'tes456', '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20210101', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-12-15 11:53:47'),
	(56, 32, 23, 'tes456', '112233447', 'Teh Kotak Apel', 20, 'PIECES', NULL, '20210101', 'AV', NULL, 'Y', 'Y', 'test_admin', '2022-12-15 11:53:54'),
	(57, 34, 24, NULL, '112233445', 'Teh Kotak Original', 50, 'PIECES', NULL, '20200606', 'AV', NULL, 'Y', 'Y', 'test_staff', '2022-12-15 12:48:39'),
	(58, 34, 24, NULL, '112233446', 'Teh Kotak Lemon', 50, 'PIECES', NULL, '20200606', 'AV', NULL, 'Y', 'Y', 'test_staff', '2022-12-15 12:48:50'),
	(59, 37, 25, NULL, '112233447', 'Teh Kotak Apel', 45, 'PIECES', NULL, '03012023', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-01-03 17:39:53'),
	(60, 40, 26, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 09:45:56'),
	(61, 40, 26, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 09:45:58'),
	(62, 40, 26, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 09:46:16'),
	(63, 40, 26, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 09:46:19'),
	(64, 41, 27, NULL, '32L5995', 'TV Toshiba 32L5995', 25, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 10:12:02'),
	(65, 41, 27, NULL, '32L5995', 'TV Toshiba 32L5995', 25, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 10:12:04'),
	(66, 41, 28, NULL, '32L5995', 'TV Toshiba 32L5995', 30, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 10:12:12'),
	(67, 41, 28, NULL, '32L5995', 'TV Toshiba 32L5995', 20, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-09 10:12:17'),
	(68, 42, 29, NULL, '112233447', 'Teh Kotak Apel', 50, 'PIECES', NULL, '09012020', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-09 14:14:59'),
	(69, 42, 29, NULL, '112233447', 'Teh Kotak Apel', 50, 'PIECES', NULL, '09012020', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-09 14:15:04'),
	(70, 42, 30, NULL, '32L5995', 'TV Toshiba 32L5995', 20, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-09 14:15:39'),
	(71, 45, 31, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-01-12 10:13:24'),
	(72, 45, 31, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-01-12 10:13:25'),
	(73, 47, 32, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', 5, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-01-12 10:36:25'),
	(74, 47, 32, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', 5, 'UNIT', NULL, '', 'DMG', NULL, 'Y', 'Y', 'test_admin', '2023-01-12 10:36:33'),
	(75, 49, 33, NULL, '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:47'),
	(76, 49, 33, NULL, '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:48'),
	(77, 49, 33, NULL, '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:50'),
	(78, 49, 33, NULL, '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:51'),
	(79, 49, 33, NULL, '112233445', 'Teh Kotak Original', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:52'),
	(80, 49, 33, NULL, '112233446', 'Teh Kotak Lemon', 20, 'PIECES', NULL, '20230113', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 09:52:59'),
	(81, 50, 35, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 50, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-13 10:01:53'),
	(82, 49, 33, NULL, '32L5995', 'TV Toshiba 32L5995', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-13 10:03:36'),
	(83, 55, 36, '12345', '112233447', 'Teh Kotak Apel', 10, 'PALLET', NULL, '12131', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-01-17 09:49:27'),
	(84, 55, 36, '12345', '112233447', 'Teh Kotak Apel', 10, 'PALLET', NULL, '12131', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-01-17 09:49:43'),
	(85, 55, 36, '12345', '112233447', 'Teh Kotak Apel', 10, 'PALLET', NULL, '12131', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-01-17 09:52:04'),
	(86, 60, 37, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-19 14:45:19'),
	(87, 60, 37, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 25, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-19 14:45:22'),
	(88, 60, 37, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 25, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-19 14:45:24'),
	(89, 61, 38, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-01-24 09:30:09'),
	(90, 70, 39, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 10, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-02 11:29:20'),
	(91, 77, 40, NULL, '112233446', 'Teh Kotak Lemon', 25, 'PACK', NULL, '03022023', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-03 10:01:58'),
	(92, 78, 41, NULL, '32L5995', 'TV Toshiba 32L5995', 20, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-02-03 10:03:54'),
	(95, 90, 44, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 10, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-02-07 13:33:03'),
	(99, 88, 43, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-02-08 10:39:59'),
	(96, 87, 42, NULL, '112233445', 'Teh Kotak Original', 10, 'PACK', NULL, '02022023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 09:42:27'),
	(109, 98, 47, '01-000-02', '75016438', 'DISPLAY PANEL V216B1-L02', 9, 'ROLL', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 15:23:40'),
	(108, 96, 46, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 14:29:38'),
	(107, 87, 42, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 13:51:16'),
	(102, 93, 45, 'P-0000-01', '32L5995', 'TV Toshiba 32L5995', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 11:36:30'),
	(103, 93, 45, 'P-0000-01', '32L5995', 'TV Toshiba 32L5995', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 11:36:32'),
	(104, 93, 45, 'P-0000-01', '32L5995', 'TV Toshiba 32L5995', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 11:36:33'),
	(105, 93, 45, 'P-0000-01', '32L5995', 'TV Toshiba 32L5995', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 11:36:51'),
	(106, 93, 45, 'P-0000-01', '32L5995', 'TV Toshiba 32L5995', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-08 11:37:05'),
	(110, 107, 48, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-09 16:34:13'),
	(111, 107, 48, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-09 16:34:41'),
	(112, 107, 48, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 1, 'PACK', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-09 16:34:44'),
	(114, 87, 42, NULL, '112233445', 'Teh Kotak Original', 11, 'PACK', NULL, '02022023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-10 09:54:26'),
	(118, 109, 50, NULL, '32L5995', 'TV Toshiba 32L5995', 10, 'UNIT', '1234', '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-13 09:34:13'),
	(120, 108, 49, NULL, '32L5995', 'TV Toshiba 32L5995', 5, 'UNIT', '1234', '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-02-13 09:34:40'),
	(125, 110, 51, NULL, '112233447', 'Teh Kotak Apel', 5, 'PACK', '', '20230213', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-15 15:13:22'),
	(122, 111, 52, NULL, '112233447', 'Teh Kotak Apel', 10, 'PACK', '', '20230213', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-13 14:55:09'),
	(127, 110, 51, NULL, '112233447', 'Teh Kotak Apel', 10, 'PACK', '', '20230213', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-15 15:16:55'),
	(134, 116, 54, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-21 11:28:38'),
	(129, 112, 53, NULL, '112233447', 'Teh Kotak Apel', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-16 17:34:04'),
	(130, 112, 53, NULL, '112233447', 'Teh Kotak Apel', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-16 17:34:05'),
	(131, 112, 53, NULL, '112233447', 'Teh Kotak Apel', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-16 17:34:06'),
	(132, 112, 53, NULL, '112233447', 'Teh Kotak Apel', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-16 17:34:06'),
	(133, 112, 53, NULL, '112233447', 'Teh Kotak Apel', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-16 17:34:14'),
	(135, 115, 55, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-21 11:33:30'),
	(136, 115, 55, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-21 11:33:40'),
	(137, 110, 51, NULL, '32L5995', 'TV Toshiba 32L5995', 1, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-22 17:09:01'),
	(138, 117, 56, NULL, '112233447', 'Teh Kotak Apel', 10, 'PIECES', NULL, '23022023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 09:11:28'),
	(139, 117, 56, NULL, '112233447', 'Teh Kotak Apel', 5, 'PIECES', NULL, '23022023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 09:11:33'),
	(140, 117, 56, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 09:11:45'),
	(141, 117, 56, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 09:11:47'),
	(142, 118, 57, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-23 09:17:28'),
	(143, 118, 57, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-23 09:17:31'),
	(144, 121, 58, NULL, '32L5995', 'TV Toshiba 32L5995', 50, 'PIECES', '23022023', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 16:39:59'),
	(145, 121, 58, NULL, '112233446', 'Teh Kotak Lemon', 70, 'PIECES', NULL, '23022023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-02-23 16:40:58'),
	(146, 122, 59, NULL, '112233446', 'Teh Kotak Lemon', 30, 'PIECES', NULL, '23022023', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-23 16:48:20'),
	(147, 122, 59, NULL, '32L5995', 'TV Toshiba 32L5995', 50, 'PIECES', '23022023', '', 'AV', NULL, 'Y', 'Y', 'test_staff', '2023-02-23 16:49:05'),
	(148, 129, 60, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 5, 'PIECES', '123', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-18 23:16:09'),
	(149, 131, 61, '01-000-02', '75016438', 'DISPLAY PANEL V216B1-L02', 9, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-20 14:40:33'),
	(150, 137, 62, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-21 09:28:04'),
	(151, 139, 63, NULL, 'ABC123', 'Baterai ABC', 25, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-24 15:04:22'),
	(152, 139, 63, NULL, 'ABC123', 'Baterai ABC', 25, 'PIECES', NULL, '', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-03-24 15:04:26'),
	(153, 141, 64, NULL, '112233447', 'Teh Kotak Apel', 20, 'PIECES', NULL, '270323', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-27 13:50:20'),
	(154, 141, 64, NULL, '112233447', 'Teh Kotak Apel', 5, 'PIECES', NULL, '270323', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-03-27 13:50:29'),
	(155, 141, 64, NULL, 'ABC456', 'Sirup ABC Jeruk', 10, 'PACK', NULL, '270323', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-03-27 13:51:04'),
	(156, 141, 64, NULL, 'ABC456', 'Sirup ABC Jeruk', 40, 'PACK', NULL, '270323', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-03-27 13:51:11'),
	(157, 147, 65, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', 10, 'PACK', NULL, 'BO12', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-04 14:33:28'),
	(158, 147, 65, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 50, 'UNIT', NULL, 'BO12', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-04 14:34:18'),
	(159, 114, 66, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-05 10:33:05'),
	(160, 114, 66, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 10, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-05 10:37:47'),
	(194, 70, 39, '1', 'IC0123', 'IC TV Toshiba 32L5995', 1, 'SET', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 10:52:36'),
	(162, 154, 67, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 25, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-06 08:34:24'),
	(163, 155, 68, NULL, 'ABC123', 'Baterai ABC', 50, 'PIECES', NULL, '', 'DMG', NULL, 'Y', 'Y', 'atmi', '2023-04-06 08:39:36'),
	(164, 155, 68, NULL, 'ABC123', 'Baterai ABC', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-06 08:39:41'),
	(165, 156, 69, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 20, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-06 08:45:31'),
	(166, 157, 70, 'PN01', '112233445', 'Teh Kotak Original', 40, 'PALLET', NULL, 'BO124', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-06 12:22:13'),
	(167, 157, 70, 'PN01', '112233445', 'Teh Kotak Original', 44, 'PALLET', NULL, 'BO124', 'AV', NULL, 'Y', 'Y', 'test_admin', '2023-04-06 12:22:28'),
	(168, 158, 72, 'PO01', '112233446', 'Teh Kotak Lemon', 30, 'PACK', NULL, 'BO123', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-06 12:34:31'),
	(169, 158, 72, 'PO01', '112233446', 'Teh Kotak Lemon', 23, 'PACK', NULL, 'BO123', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-06 12:34:37'),
	(170, 151, 73, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-10 15:01:49'),
	(171, 151, 73, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 3, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-10 15:03:13'),
	(172, 164, 74, NULL, '47RW1EJ', 'TV Toshiba 47RW1EJ', 100, 'UNIT', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-17 14:39:36'),
	(173, 164, 74, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 100, 'SET', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-04-17 14:39:47'),
	(196, 70, 39, '1', 'IC0123', 'IC TV Toshiba 32L5995', 3, 'SET', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 10:53:16'),
	(195, 70, 39, '1', 'IC0123', 'IC TV Toshiba 32L5995', 2, 'SET', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 10:52:51'),
	(197, 70, 39, '1', 'IC0123', 'IC TV Toshiba 32L5995', 4, 'SET', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 10:54:48'),
	(201, 70, 39, '123', 'IC0123', '', 9, '', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 14:51:26'),
	(202, 70, 39, '12', 'IC0123', 'IC TV Toshiba 32L5995', 1, 'SET', '', '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-18 14:52:05'),
	(203, 151, 73, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 70, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-21 12:43:02'),
	(204, 170, 85, NULL, '112233446', 'Teh Kotak Lemon', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-21 13:54:42'),
	(205, 171, 86, NULL, '112233447', 'Teh Kotak Apel', 50, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-22 09:46:02'),
	(206, 171, 86, NULL, 'ABC456', 'Sirup ABC Jeruk', 49, 'PIECES', NULL, '', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-22 09:48:10'),
	(207, 173, 87, NULL, 'ABC123', 'Baterai ABC', 10, 'PIECES', NULL, '24052023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-24 12:01:24'),
	(208, 173, 87, NULL, 'IC0123', 'IC TV Toshiba 32L5995', 10, 'PIECES', NULL, '24052023', 'AV', NULL, 'Y', 'Y', 'atmi', '2023-05-24 12:01:37'),
	(211, 190, 92, '1', 'CG001', 'Cengkeh', 400, 'KG', NULL, '', 'WIP', NULL, 'Y', 'Y', 'superadmin', '2024-08-26 13:44:00'),
	(212, 193, 93, '1', 'ABC123', 'Baterai ABC', 100, 'PIECES', NULL, '20230626', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-26 14:10:48'),
	(213, 193, 93, '1', 'ABC456', 'Sirup ABC Jeruk', 100, 'PIECES', NULL, '20230626', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-26 14:10:59'),
	(214, 196, 94, NULL, '112233445', 'Teh Kotak Original', 23, 'PIECES', NULL, '20230626', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-27 16:23:38'),
	(215, 198, 95, '1', 'CG001', 'Cengkeh', 10, 'Bag', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-28 11:37:15'),
	(216, 198, 95, '2', 'CG001', 'Cengkeh', 10, 'Bag', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-28 11:37:19'),
	(217, 198, 95, '3', 'CG001', 'Cengkeh', 10, 'Bag', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-28 11:37:22'),
	(220, 198, 95, '2', 'CG001', 'Cengkeh', 10, 'Bag', NULL, '', 'AV', NULL, 'Y', 'Y', 'superadmin', '2024-08-28 11:39:59');
/*!40000 ALTER TABLE `t_wh_scan_qty` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_scan_qty_2
DROP TABLE IF EXISTS `t_wh_scan_qty_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_scan_qty_2: 11 rows
/*!40000 ALTER TABLE `t_wh_scan_qty_2` DISABLE KEYS */;
INSERT INTO `t_wh_scan_qty_2` (`scan_id`, `activity_id`, `transport_id`, `spv_id`, `pallet_id`, `sku`, `part_name`, `qty_scan`, `uom_id`, `serial_no`, `batch_no`, `stock_id`, `remarks`, `is_active`, `user_created`, `datetime_created`) VALUES
	(1, 1, 0, NULL, '12346', '32L5995', 'TV Toshiba 32L5995', 10, NULL, '20210612', '456928', 'AV', NULL, 'Y', 'atmi', '2022-10-05 16:24:05'),
	(14, 5, 0, 1, '3', '47RW1EJ', 'TV Toshiba 47RW1EJ', 10, NULL, '', 'test_11okt2022_1', 'DMG', NULL, 'Y', 'test_admin', '2022-10-12 14:53:16'),
	(12, 5, 0, 1, '1', '75016438', 'DISPLAY PANEL V216B1-L02', 10, NULL, '', 'test_11okt2022_1', 'AV', NULL, 'Y', 'test_admin', '2022-10-12 14:53:16'),
	(13, 5, 0, 1, '2', '32L5995', 'TV Toshiba 32L5995', 10, NULL, '', 'test_11okt2022_1', 'DMG', NULL, 'Y', 'test_admin', '2022-10-12 14:53:16'),
	(27, 8, 1, 1, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 25, 1, NULL, 'test_26okt22_2', 'AV', NULL, 'Y', 'test_staff', '2022-10-27 14:48:30'),
	(28, 11, 13, NULL, 'test', '75016438', 'DISPLAY PANEL V216B1-L02', 1, 10, NULL, 'test_01nov2022_1', 'AV', NULL, 'Y', 'test_staff', '2022-11-01 11:08:07'),
	(26, 8, 1, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 25, 1, NULL, 'test_26okt22_2', 'AV', NULL, 'Y', 'test_staff', '2022-10-27 14:48:28'),
	(24, 8, 1, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 20, 1, NULL, 'test_26okt22_2', 'AV', NULL, 'Y', 'test_staff', '2022-10-27 10:40:01'),
	(25, 8, 1, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 30, 1, NULL, 'test_26okt22_2', 'AV', NULL, 'Y', 'test_staff', '2022-10-27 14:48:24'),
	(29, 9, 12, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 12, 10, NULL, '281022', 'AV', NULL, 'Y', 'test_admin', '2022-11-03 12:37:42'),
	(30, 9, 12, NULL, NULL, '75016438', 'DISPLAY PANEL V216B1-L02', 12, 10, NULL, '281022', 'AV', NULL, 'Y', 'test_admin', '2022-11-03 12:37:52');
/*!40000 ALTER TABLE `t_wh_scan_qty_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_shipping_load
DROP TABLE IF EXISTS `t_wh_shipping_load`;
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

-- Dumping data for table wms.t_wh_shipping_load: 3 rows
/*!40000 ALTER TABLE `t_wh_shipping_load` DISABLE KEYS */;
INSERT INTO `t_wh_shipping_load` (`booking_no`, `pickup_name`, `pickup_company`, `pickup_address`, `phone`, `job_no`, `pickup_datetime`, `status_id`, `notes`, `client_project_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-SHIP-0723-0001', 'Fachri', 'PT Maju Jaya', 'Gd. Surya I Lt 12 Jakarta', '081111111', 'CBT-REX-007-001', '2023-07-25 15:04:23', 'PIS', NULL, 1, 'mariofrans', '2023-07-25 15:04:23', 'mariofrans', '2023-07-26 10:31:50'),
	('CBT-SHIP-0723-0002', 'd', 'd', 'd', '2', '2', '2023-07-31 15:55:00', 'PIS', NULL, 1, 'mariofrans', '2023-07-31 15:55:54', 'mariofrans', '2023-07-31 15:57:31'),
	('CBT-SHIP-0823-0001', 'robert', 'rpx', NULL, '8724562156', 'job4', '2023-08-18 16:43:00', 'PIS', NULL, 1, 'mariofrans', '2023-08-18 15:44:09', 'mariofrans', '2023-08-18 15:44:45');
/*!40000 ALTER TABLE `t_wh_shipping_load` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_shipping_load_detail
DROP TABLE IF EXISTS `t_wh_shipping_load_detail`;
CREATE TABLE IF NOT EXISTS `t_wh_shipping_load_detail` (
  `booking_no` varchar(50) NOT NULL,
  `outbound_planning_no` varchar(50) NOT NULL,
  `awb` varchar(50) DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`booking_no`,`outbound_planning_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_shipping_load_detail: 3 rows
/*!40000 ALTER TABLE `t_wh_shipping_load_detail` DISABLE KEYS */;
INSERT INTO `t_wh_shipping_load_detail` (`booking_no`, `outbound_planning_no`, `awb`, `user_created`, `datetime_created`, `remarks`) VALUES
	('CBT-SHIP-0723-0001', 'CBT-OUT-0723-0001', '9999123123', 'mariofrans', '2023-07-25 15:04:23', NULL),
	('CBT-SHIP-0723-0002', 'CBT-OUT-0723-0002', '123', 'mariofrans', '2023-07-31 15:55:54', ''),
	('CBT-SHIP-0823-0001', 'CBT-OUT-0723-0003', '1232132312', 'mariofrans', '2023-08-18 15:44:09', '');
/*!40000 ALTER TABLE `t_wh_shipping_load_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_count
DROP TABLE IF EXISTS `t_wh_stock_count`;
CREATE TABLE IF NOT EXISTS `t_wh_stock_count` (
  `stock_count_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) DEFAULT 0,
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

-- Dumping data for table wms.t_wh_stock_count: 28 rows
/*!40000 ALTER TABLE `t_wh_stock_count` DISABLE KEYS */;
INSERT INTO `t_wh_stock_count` (`stock_count_id`, `client_project_id`, `count_date`, `count_no`, `stock_count_type`, `status_id`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-DCC-1122-0001', 1, '2022-11-28', 'Count 1', 'DCC', 'CFC', 'atmi', '2022-11-28 16:38:42', '', NULL),
	('CBT-DCC-1122-0002', 1, '2022-11-30', 'Count 2', 'DCC', 'ODC', 'atmi', '2022-12-01 17:40:21', 'atmi', '2022-12-13 14:01:29'),
	('CBT-DCC-0123-0001', 1, '2023-01-06', 'Count 1', 'DCC', 'CFC', 'atmi', '2023-01-06 18:15:13', 'atmi', '2023-01-07 21:38:40'),
	('CBT-OPN-0123-0001', 1, '2023-01-06', 'Count 1', 'OPN', 'AOP', 'atmi', '2023-01-06 18:15:52', 'mariofrans', '2023-01-17 09:50:53'),
	('CBT-OPN-0123-0006', 1, '2023-01-17', 'Count 1', 'OPN', 'OOP', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-DCC-0123-0006', 1, '2023-01-24', 'Count 1', 'DCC', 'ADC', 'atmi', '2023-01-24 15:07:07', 'atmi', '2023-01-24 16:22:20'),
	('CBT-OPN-0123-0007', 1, '2023-01-24', 'Count 2', 'OPN', 'OOP', 'mariofrans', '2023-01-24 15:13:13', 'atmi', '2023-06-08 14:38:41'),
	('CBT-OPN-0123-0010', 1, '2023-01-30', 'Count 1', 'OPN', 'AOP', 'mariofrans', '2023-01-30 15:52:52', 'mariofrans', '2023-01-30 16:59:04'),
	('CBT-OPN-0123-0009', 1, '2023-01-30', 'Count 1', 'OPN', 'OOP', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-DCC-0123-0007', 1, '2023-01-31', 'Count 1', 'DCC', 'CFC', 'atmi', '2023-01-31 09:03:06', 'atmi', '2023-01-31 11:10:47'),
	('CBT-OPN-0223-0004', 1, '2023-02-03', 'Count 3', 'OPN', 'CFO', 'test_admin', '2023-02-03 14:51:37', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-DCC-0223-0001', 1, '2023-02-07', 'Count 1', 'DCC', 'CFC', 'atmi', '2023-02-07 15:55:56', 'atmi', '2023-02-07 15:57:43'),
	('CBT-OPN-0223-0005', 1, '2023-02-07', 'Count 2', 'OPN', 'OOP', 'atmi', '2023-02-07 15:59:10', 'atmi', '2023-02-07 16:00:52'),
	('CBT-DCC-0223-0002', 1, '2023-02-08', 'Count 1', 'DCC', 'CTD', 'atmi', '2023-02-08 11:59:52', 'atmi', '2023-07-03 15:28:09'),
	('CBT-DCC-0223-0003', 1, '2023-02-09', 'Count 1', 'DCC', 'CTD', 'atmi', '2023-02-09 15:19:37', 'atmi', '2023-07-03 15:27:43'),
	('CBT-DCC-0223-0004', 1, '2023-02-09', 'Count 3', 'DCC', 'ODC', 'atmi', '2023-02-09 15:29:08', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0323-0001', 1, '2023-03-20', 'Count 1', 'DCC', 'CTD', 'atmi', '2023-03-20 17:07:56', 'atmi', '2023-06-08 14:47:51'),
	('CBT-DCC-0323-0002', 1, '2023-03-20', 'Count 2', 'DCC', 'ODC', 'atmi', '2023-03-20 17:17:55', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0003', 1, '2023-03-20', 'Count 2', 'DCC', 'ODC', 'atmi', '2023-03-20 17:36:59', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0004', 1, '2023-03-24', 'Count 1', 'DCC', 'ODC', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0005', 1, '2023-03-24', 'Count 1', 'DCC', 'ODC', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-OPN-0423-0001', 1, '2023-04-04', 'Count 1', 'OPN', 'CFO', 'atmi', '2023-04-04 09:02:02', 'atmi', '2023-04-04 09:03:17'),
	('CBT-DCC-0423-0001', 1, '2023-04-09', 'Count 1', 'DCC', 'CTD', 'test_admin', '2023-04-04 15:05:38', 'atmi', '2023-07-03 20:12:35'),
	('CBT-DCC-0523-0001', 1, '2023-05-03', 'Count 2', 'DCC', 'ODC', 'atmi', '2023-05-03 14:59:12', 'atmi', '2023-05-03 15:15:35'),
	('CBT-DCC-0623-0001', 1, '2023-06-13', 'Count 2', 'DCC', 'ODC', 'mariofrans', '2023-06-13 15:01:31', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0002', 1, '2023-06-13', 'Count 1', 'DCC', 'CFC', 'atmi', '2023-06-13 17:46:12', 'atmi', '2023-06-13 17:47:32'),
	('CBT-OPN-0623-0001', 1, '2023-06-13', 'Count 1', 'OPN', 'CTO', 'atmi', '2023-06-13 17:52:25', 'atmi', '2023-07-03 15:28:30'),
	('CBT-OPN-0723-0001', 1, '2023-07-03', 'Count 1', 'OPN', 'CTO', 'atmi', '2023-07-03 16:48:48', 'atmi', '2023-07-03 20:22:05');
/*!40000 ALTER TABLE `t_wh_stock_count` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_count_detail
DROP TABLE IF EXISTS `t_wh_stock_count_detail`;
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

-- Dumping data for table wms.t_wh_stock_count_detail: 306 rows
/*!40000 ALTER TABLE `t_wh_stock_count_detail` DISABLE KEYS */;
INSERT INTO `t_wh_stock_count_detail` (`stock_count_id`, `count_no`, `location_id`, `sku`, `item_name`, `batch_no`, `serial_no`, `imei`, `part_no`, `color`, `size`, `expired_date`, `stock_id`, `gr_id`, `count_qty`, `on_hand_qty`, `discrepancy`, `uom_name`, `percentage`, `counter`, `count_status`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-DCC-1122-0001', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', '', 20, 20, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'atmi', '2022-11-29 17:56:23', '', NULL),
	('CBT-DCC-1122-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 10, 10, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'atmi', '2022-11-29 17:57:52', '', NULL),
	('CBT-DCC-1122-0002', 'Count 2', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', '', 20, 20, 0, 'PIECES', '100', 'agus', 'Balance', 'Y', 'atmi', '2022-12-02 09:34:37', 'atmi', '2022-12-13 14:09:43'),
	('CBT-DCC-1122-0002', 'Count 2', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', '', 0, 0, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2022-12-02 09:41:01', '', NULL),
	('CBT-DCC-0123-0001', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 35, 35, 0, 'PIECES', '100', 'agus', 'Balance', 'Y', 'atmi', '2023-01-06 18:19:18', 'atmi', '2023-01-07 21:45:25'),
	('CBT-OPN-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-OPN-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-OPN-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 30, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-OPN-0123-0006', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-OPN-0123-0006', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-OPN-0123-0006', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-17 08:24:43', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 30, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-DCC-0123-0006', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-24 15:07:07', '', NULL),
	('CBT-OPN-0123-0007', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 10, 48, -38, 'PIECES', '21%', 'atmi', 'Loss', 'N', 'atmi', '2023-01-24 15:13:13', 'atmi', '2023-06-08 14:38:41'),
	('CBT-OPN-0123-0007', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 12, 25, -13, 'UNIT', '48%', 'atmi', 'Loss', 'N', 'atmi', '2023-01-24 15:13:13', 'atmi', '2023-06-08 14:38:41'),
	('CBT-OPN-0123-0007', 'Count 1', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 15, 25, -10, 'UNIT', '60%', 'atmi', 'Loss', 'N', 'atmi', '2023-01-24 15:13:13', 'atmi', '2023-06-08 14:38:41'),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 30, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1122-0017', 0, 20, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1222-0014', 0, 25, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 50, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 5, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-01-31', 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 12, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0009', 'Count 1', '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 20, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 10:21:58', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 0, 48, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 25, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-OPN-0123-0010', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', '0', '', '', 'N', 'mariofrans', '2023-01-30 15:52:52', '', NULL),
	('CBT-DCC-0123-0007', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 48, 48, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-01-31 09:03:06', 'atmi', '2023-01-31 11:05:06'),
	('CBT-DCC-0123-0007', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 25, 25, 0, 'UNIT', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-01-31 09:03:06', 'atmi', '2023-01-31 11:06:32'),
	('CBT-DCC-0123-0007', 'Count 1', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 25, 25, 0, 'UNIT', '100', 'test_staff', 'Balance', 'Y', 'atmi', '2023-01-31 09:03:06', 'atmi', '2023-01-31 11:06:24'),
	('CBT-DCC-0123-0007', 'Count 2', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '0000-00-00', 'AV', '', 0, 48, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-01-31 11:20:12', '', NULL),
	('CBT-OPN-0223-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 10, 10, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0001', 'Count 1', 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', '0000-00-00', 'AV', 'CBT-GR-0123-0007', 0, 50, 0, 'PIECES', '0', '', '', 'N', 'mariofrans', '2023-02-01 14:01:08', '', NULL),
	('CBT-OPN-0223-0004', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 64, 64, 0, 'PIECES', '100', 'test_staff', 'Balance', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 6, 5, -1, '', '120', 'test_admin', 'Gain', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 15, 17, 2, 'PIECES', '88', 'test_admin', 'Loss', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 30, 30, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 34, 35, 1, 'PIECES', '97', 'test_admin', 'Loss', 'Y', 'test_admin', '2023-02-03 14:53:44', 'test_admin', '2023-02-03 15:12:14'),
	('CBT-OPN-0223-0004', 'Count 2', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 10, 10, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 2', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 64, 64, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 30, 30, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 17, 17, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 34, 35, 1, 'PIECES', '97', 'test_admin', 'Loss', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 2', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 5, 5, 0, '', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:13:11', 'test_admin', '2023-02-03 15:14:23'),
	('CBT-OPN-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 35, 35, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-OPN-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 17, 17, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-OPN-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 30, 30, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-OPN-0223-0004', 'Count 3', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 64, 64, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-OPN-0223-0004', 'Count 3', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 10, 10, 0, 'PIECES', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-OPN-0223-0004', 'Count 3', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 5, 5, 0, '', '100', 'test_admin', 'Balance', 'Y', 'test_admin', '2023-02-03 15:14:50', 'test_admin', '2023-02-03 15:15:57'),
	('CBT-DCC-0223-0001', 'Count 1', '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 'AV', 'CBT-GR-0123-0007', 50, 50, 0, 'SET', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-07 15:56:58', 'atmi', '2023-02-07 15:57:43'),
	('CBT-OPN-0223-0005', 'Count 1', 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 15, 15, 0, 'PACK', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-07 16:00:02', 'atmi', '2023-02-07 16:00:52'),
	('CBT-OPN-0223-0005', 'Count 1', 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, 'DMG', '', -1, -1, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-07 16:00:02', 'atmi', '2023-02-07 16:00:52'),
	('CBT-OPN-0223-0005', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 60, 65, 5, 'PIECES', '92', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-07 16:00:02', 'atmi', '2023-02-07 16:00:52'),
	('CBT-OPN-0223-0005', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 45, 50, 5, 'PIECES', '90', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-07 16:00:02', 'atmi', '2023-02-07 16:00:52'),
	('CBT-OPN-0223-0005', 'Count 2', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 50, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-07 16:00:52', '', NULL),
	('CBT-OPN-0223-0005', 'Count 2', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 65, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-07 16:00:52', '', NULL),
	('CBT-OPN-0223-0005', 'Count 2', 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, 'DMG', '', 0, -1, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-07 16:00:52', '', NULL),
	('CBT-OPN-0223-0005', 'Count 2', 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 0, 15, 0, 'PACK', '0', '', '', 'N', 'atmi', '2023-02-07 16:00:52', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 30, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0002', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-27 11:27:35', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 0, 15, 0, 'PACK', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, 'DMG', '', 0, -1, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 60, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 50, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1122-0017', 0, 20, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 0, 48, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 20, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1222-0014', 0, 25, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 8, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 50, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 40, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 5, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-01-31', 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 12, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 20, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0007', 0, 50, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 'AV', 'CBT-GR-0123-0007', 0, 50, 0, 'SET', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', 'rdarmawan', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 10, 0, 'PALLET', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0001', 0, 3, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0002', 0, 15, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 0, 10, 0, 'PACK', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0002', 0, 4, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'DMG', 'CBT-GR-0223-0002', 0, 1, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 5, 0, 'PIECES', '0', 'test_admin', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '2023-02-08', 'AV', 'CBT-GR-0223-0006', 0, 9, 0, 'ROLL', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0003', 'Count 1', '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 5, 0, 'PIECES', '0', 'atmi', '', 'Y', 'atmi', '2023-02-09 15:23:34', '', NULL),
	('CBT-DCC-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 35, 35, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 17, 17, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 40, 40, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 3, 5, 2, '', '60', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 63, 64, 1, 'PIECES', '98', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 8, 10, 2, 'PIECES', '80', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-09 15:29:49', 'atmi', '2023-02-09 15:30:40'),
	('CBT-DCC-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 35, 35, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 17, 17, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 2', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 41, 40, -1, 'PIECES', '103', 'atmi', 'Gain', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 2', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 64, 64, 0, 'PIECES', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 2', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 9, 10, 1, 'PIECES', '90', 'atmi', 'Loss', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 2', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 5, 5, 0, '', '100', 'atmi', 'Balance', 'Y', 'atmi', '2023-02-09 15:31:57', 'atmi', '2023-02-09 15:32:47'),
	('CBT-DCC-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 35, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0223-0004', 'Count 3', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 40, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0223-0004', 'Count 3', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 64, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0223-0004', 'Count 3', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0223-0004', 'Count 3', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', '0', '', '', 'N', 'atmi', '2023-02-09 15:32:47', '', NULL),
	('CBT-DCC-0323-0001', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-03-20 17:09:30', '', NULL),
	('CBT-DCC-0323-0002', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 3, 3, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0002', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 5, 5, 0, 'PALLET', '100%', 'test_admin', 'Balance', 'Y', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0002', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 21, 20, 1, 'PALLET', '105%', 'atmi', 'Gain', 'Y', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0002', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 5, 5, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0002', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 5, 5, 0, 'PALLET', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-03-20 17:20:00', 'test_admin', '2023-03-20 17:29:04'),
	('CBT-DCC-0323-0002', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'N', 'test_admin', '2023-03-20 17:29:04', '', NULL),
	('CBT-DCC-0323-0002', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 0, 5, 0, 'PIECES', NULL, '', '', 'N', 'test_admin', '2023-03-20 17:29:04', '', NULL),
	('CBT-DCC-0323-0002', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', NULL, '', '', 'N', 'test_admin', '2023-03-20 17:29:04', '', NULL),
	('CBT-DCC-0323-0002', 'Count 2', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'N', 'test_admin', '2023-03-20 17:29:04', '', NULL),
	('CBT-DCC-0323-0002', 'Count 2', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, '', '', 'N', 'test_admin', '2023-03-20 17:29:04', '', NULL),
	('CBT-DCC-0323-0003', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 3, 3, 0, 'PIECES', '100%', 'atmi', 'Balance', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0003', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 5, 5, 0, 'PALLET', '100%', 'atmi', 'Balance', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0003', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 20, 20, 0, 'PALLET', '100%', 'atmi', 'Balance', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0003', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 20, 5, 15, 'PIECES', '400%', 'atmi', 'Gain', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0003', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 20, 5, 15, 'PALLET', '400%', 'atmi', 'Gain', 'N', 'mariofrans', '2023-06-13 14:59:29', 'atmi', '2023-06-13 17:44:04'),
	('CBT-DCC-0323-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 30, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0004', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 40, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0004', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 54, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0004', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:37:53', '', NULL),
	('CBT-DCC-0323-0005', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-DCC-0323-0005', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-DCC-0323-0005', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-DCC-0323-0005', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 0, 5, 0, 'PIECES', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-DCC-0323-0005', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'N', 'superadmin', '2023-03-24 10:40:19', '', NULL),
	('CBT-OPN-0423-0001', 'Count 1', '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 10, 10, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-04-04 09:02:34', 'atmi', '2023-04-04 09:03:17'),
	('CBT-OPN-0423-0001', 'Count 1', '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 10, 10, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-04-04 09:02:34', 'atmi', '2023-04-04 09:03:17'),
	('CBT-OPN-0423-0001', 'Count 1', 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 15, 15, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-04-04 09:02:34', 'atmi', '2023-04-04 09:03:17'),
	('CBT-OPN-0423-0001', 'Count 1', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 15, 15, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-04-04 09:02:34', 'atmi', '2023-04-04 09:03:17'),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 20, 0, 'PIECES', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0423-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', '', '', 'MERAH', '', NULL, 'AV', 'CBT-GR-0423-0001', 0, 10, 0, 'PACK', NULL, 'atmi', '', 'N', 'atmi', '2023-07-03 16:47:45', '', NULL),
	('CBT-DCC-0523-0001', 'Count 1', '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 9, 10, -1, 'PIECES', '90%', 'atmi', 'Loss', 'Y', 'atmi', '2023-05-03 15:00:29', 'atmi', '2023-05-03 15:15:35'),
	('CBT-DCC-0523-0001', 'Count 1', '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 11, 10, 1, 'PIECES', '110%', 'atmi', 'Gain', 'Y', 'atmi', '2023-05-03 15:00:29', 'atmi', '2023-05-03 15:15:35'),
	('CBT-DCC-0523-0001', 'Count 1', 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 15, 15, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-05-03 15:00:29', 'atmi', '2023-05-03 15:15:35'),
	('CBT-DCC-0523-0001', 'Count 1', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 14, 15, -1, 'PIECES', '93%', 'atmi', 'Loss', 'Y', 'atmi', '2023-05-03 15:00:29', 'atmi', '2023-05-03 15:15:35'),
	('CBT-DCC-0523-0001', 'Count 2', '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-05-03 15:15:35', '', NULL),
	('CBT-DCC-0523-0001', 'Count 2', '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-05-03 15:15:35', '', NULL),
	('CBT-DCC-0523-0001', 'Count 2', 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-05-03 15:15:35', '', NULL),
	('CBT-DCC-0523-0001', 'Count 2', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-05-03 15:15:35', '', NULL),
	('CBT-OPN-0123-0007', 'Count 2', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 15, 25, 0, 'UNIT', NULL, '', '', 'Y', 'atmi', '2023-06-08 14:38:41', '', NULL),
	('CBT-OPN-0123-0007', 'Count 2', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 12, 25, 0, 'UNIT', NULL, '', '', 'Y', 'atmi', '2023-06-08 14:38:41', '', NULL),
	('CBT-OPN-0123-0007', 'Count 2', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 10, 48, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-08 14:38:41', '', NULL),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 3, 3, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 10, 5, 5, 'PALLET', '200%', 'atmi', 'Gain', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 5, 20, -15, 'PALLET', '25%', 'atmi', 'Loss', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 5, 5, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 5, 5, 0, 'PALLET', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 5, 5, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 10, 10, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'DMG', 'CBT-GR-0323-0005', 5, 5, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 1', 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 5, 5, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'mariofrans', '2023-06-13 15:02:56', 'atmi', '2023-06-13 17:41:28'),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 0, 5, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 10, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'DMG', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0623-0001', 'Count 2', 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:41:28', '', NULL),
	('CBT-DCC-0323-0003', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:44:04', '', NULL),
	('CBT-DCC-0323-0003', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 0, 5, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:44:04', '', NULL),
	('CBT-DCC-0323-0003', 'Count 2', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:44:04', '', NULL),
	('CBT-DCC-0323-0003', 'Count 2', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:44:04', '', NULL),
	('CBT-DCC-0323-0003', 'Count 2', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, '', '', 'Y', 'atmi', '2023-06-13 17:44:04', '', NULL),
	('CBT-DCC-0623-0002', 'Count 1', 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 2, 2, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-06-13 17:46:43', 'atmi', '2023-06-13 17:47:32'),
	('CBT-DCC-0623-0002', 'Count 1', 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0523-0004', 10, 10, 0, 'PIECES', '100%', 'atmi', 'Balance', 'Y', 'atmi', '2023-06-13 17:46:43', 'atmi', '2023-06-13 17:47:32'),
	('CBT-OPN-0623-0001', 'Count 1', '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-06-13 17:52:51', '', NULL),
	('CBT-OPN-0623-0001', 'Count 1', '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-06-13 17:52:51', '', NULL),
	('CBT-OPN-0623-0001', 'Count 1', 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-06-13 17:52:51', '', NULL),
	('CBT-OPN-0623-0001', 'Count 1', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-06-13 17:52:51', '', NULL),
	('CBT-OPN-0623-0001', 'Count 1', '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0523-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-06-13 17:52:51', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 0, 9, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, 'DMG', '', 0, -13, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 55, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 45, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1122-0017', 0, 20, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', '', 0, 48, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-002-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 17, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 30, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-002-002', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-12-01', 'AV', 'CBT-GR-1222-0014', 0, 21, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-003', '112233447', 'Teh Kotak Apel', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 3, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'AV', 'CBT-GR-1222-0015', 0, 17, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-003', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 80, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20201212', '', '', '', '', '', '2023-12-12', 'AV', 'CBT-GR-1222-0014', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'RF08-01', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-01-31', 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'RC09-01', '112233446', 'Teh Kotak Lemon', '20201201', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1122-0017', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', 'QR', 'CBT-GR-1222-0015', 0, 5, 0, '', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F2', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1222-0016', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 12, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0006', 0, 5, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 54, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13', 'AV', 'CBT-GR-0123-0007', 0, 30, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', '32L5995', 'TV Toshiba 32L5995', '', '32L5995', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0007', 0, 50, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1B1-001-001', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '123', '', '', NULL, 'AV', 'CBT-GR-0123-0007', 0, 50, 0, 'SET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', 'DMG', 'CBT-GR-0123-0007', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'DMG', 'CBT-GR-0123-0009', 0, 20, 0, 'PALLET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0001', 0, 3, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-003', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0012', 0, 25, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0002', 0, 15, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '112233446', 'Teh Kotak Lemon', '03022023', '', '', '', '', '', '2025-02-03', 'AV', 'CBT-GR-0223-0002', 0, 10, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0002', 0, 4, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, 'DMG', 'CBT-GR-0223-0002', 0, 1, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', '2023-02-08', 'AV', 'CBT-GR-0223-0006', 0, 9, 0, 'ROLL', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-003', '32L5995', 'TV Toshiba 32L5995', '20221104', '', '', '', '', '', NULL, 'AV', 'CBT-GR-1022-0043', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '', '', '', '', '', '', '2028-09-23', 'AV', 'CBT-GR-0223-0011', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 'AV', 'CBT-GR-0223-0015', 0, 80, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 'AV', 'CBT-GR-0223-0015', 0, 95, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '23022023', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0015', 0, 100, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '112233446', 'Teh Kotak Lemon', '23022023', '', '', '', '', '', '2024-02-23', 'AV', 'CBT-GR-0223-0015', 0, 20, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0001', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0003', 0, 9, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0003', 0, 9, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '12131', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0123-0009', 0, 5, 0, 'PALLET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0002', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0002', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09', 'AV', 'CBT-GR-0223-0004', 0, 5, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2023-02-09', 'AV', 'CBT-GR-0223-0004', 0, 5, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'DMG01-001', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'AV', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 15, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', '', '', '', '', NULL, 'DMG', 'CBT-GR-0323-0004', 0, 2, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'DMG-001-001', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'DMG', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'DMG-001-001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 'DMG', 'CBT-GR-0323-0005', 0, 5, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 20, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 20, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0010', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', '', '', 'MERAH', '', NULL, 'AV', 'CBT-GR-0423-0001', 0, 10, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-003', 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', 'SO12', '', '', 'BIRU', '', NULL, 'AV', 'CBT-GR-0423-0001', 0, 50, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '75016438', 'DISPLAY PANEL V216B1-L02', '', '15022023', '', '', '', '', NULL, 'AV', 'CBT-GR-0223-0010', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '112233445', 'Teh Kotak Original', 'BO124', 'SO124', 'IM124', 'P124', 'Hijau', '500ml', '2025-09-06', 'AV', 'CBT-GR-0423-0003', 0, 84, 0, 'PALLET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233446', 'Teh Kotak Lemon', 'BO123', 'SO1234', 'IM123', 'P123', 'Merah', '600ml', '2027-09-06', 'AV', 'CBT-GR-0423-0003', 0, 53, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_2', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'DMG-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', '', 0, 3, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', 'AV', 'CBT-GR-1222-0016', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', 'ABC456', 'Sirup ABC Jeruk', '270323', '', '', '', '', '', '2024-03-31', 'DMG', 'CBT-GR-0323-0005', 0, 5, 0, 'PACK', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'R1F3', '112233447', 'Teh Kotak Apel', '270323', '', '', '', '', '', '2024-03-31', 'AV', 'CBT-GR-0323-0005', 0, 5, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', 'AV', '', 0, 60, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', '', '', '', '', NULL, 'DMG', '', 0, 16, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-012', 'ABC123', 'Baterai ABC', '24052023', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0523-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0523-0004', 0, 10, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0423-0004', 0, 292, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1B1-001-001', '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '', '', 'Black', '', NULL, 'AV', 'CBT-GR-0323-0049', 0, 20, 0, 'PIECES', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'FL001', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0423-0004', 0, 100, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', 'test_location_1', 'IC0123', 'IC TV Toshiba 32L5995', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0423-0004', 0, 400, 0, 'SET', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL),
	('CBT-OPN-0723-0001', 'Count 1', '1A1-001-002', '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', '', '', '', '', NULL, 'AV', 'CBT-GR-0423-0004', 0, 2, 0, 'UNIT', NULL, 'atmi', '', 'Y', 'atmi', '2023-07-03 16:58:05', '', NULL);
/*!40000 ALTER TABLE `t_wh_stock_count_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_transfer
DROP TABLE IF EXISTS `t_wh_stock_transfer`;
CREATE TABLE IF NOT EXISTS `t_wh_stock_transfer` (
  `stock_transfer_id` varchar(30) NOT NULL DEFAULT '',
  `client_project_id` int(11) NOT NULL DEFAULT 0,
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
  PRIMARY KEY (`stock_transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table wms.t_wh_stock_transfer: 25 rows
/*!40000 ALTER TABLE `t_wh_stock_transfer` DISABLE KEYS */;
INSERT INTO `t_wh_stock_transfer` (`stock_transfer_id`, `client_project_id`, `transaction_type`, `remark`, `status_id`, `data_upload1`, `data_upload2`, `data_upload3`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`) VALUES
	('CBT-STR-1122-0001', 1, 'CST', 'Barang stock transfer', 'OST', NULL, NULL, NULL, NULL, NULL, '', NULL),
	('CBT-STR-1122-0002', 1, 'CST', 'test', 'OST', '', '', '', 'test_admin', '2022-11-11 11:26:50', '', NULL),
	('CBT-STR-1122-0003', 1, 'CST', 'Ubah status jadi DMG', 'CST', '', '', '', 'test_admin', '2022-11-14 09:35:43', 'test-admin', '2022-11-14 11:56:52'),
	('CBT-STR-1222-0001', 1, 'CST', 'test28des22_1', 'OST', '', '', '', 'mariofrans', '2022-12-28 16:19:30', '', NULL),
	('CBT-STR-0123-0001', 1, 'PTP', 'test ptp', 'CST', '', '', '', 'mariofrans', '2023-01-03 09:03:26', 'mariofrans', '2023-01-03 09:12:03'),
	('CBT-STR-0123-0002', 1, 'CST', 'test_cst', 'CST', '', '', '', 'mariofrans', '2023-01-03 15:48:03', 'mariofrans', '2023-01-03 15:48:15'),
	('CBT-STR-0123-0003', 1, 'PTP', 'test_ptp2', 'OST', '', '', '', 'mariofrans', '2023-01-03 15:53:59', '', NULL),
	('CBT-STR-0123-0004', 1, 'PTP', 'test_ptp2', 'OST', '', '', '', 'mariofrans', '2023-01-03 15:54:37', '', NULL),
	('CBT-STR-0123-0005', 1, 'PTP', 'test_ptp3', 'OST', '', '', '', 'mariofrans', '2023-01-03 16:00:18', '', NULL),
	('CBT-STR-0123-0006', 1, 'PTP', 'test_ptp4', 'OST', '', '', '', 'mariofrans', '2023-01-03 16:08:59', '', NULL),
	('CBT-STR-0123-0007', 1, 'PTP', 'test_ptp5', 'OST', '', '', '', 'mariofrans', '2023-01-03 16:18:09', '', NULL),
	('CBT-STR-0123-0008', 1, 'PTP', 'tes_ptp6', 'OST', '', '', '', 'mariofrans', '2023-01-03 16:26:46', '', NULL),
	('CBT-STR-0123-0009', 1, 'PTP', 'tes_ptp6', 'CST', '', '', '', 'mariofrans', '2023-01-03 16:27:54', 'mariofrans', '2023-01-03 16:28:33'),
	('CBT-STR-0123-0010', 1, 'CST', 'cst_damage', 'CST', '', '', '', 'mariofrans', '2023-01-03 16:31:28', 'mariofrans', '2023-01-03 16:32:04'),
	('CBT-STR-0123-0011', 1, 'PTP', 'tes_ptp_scenario_1', 'CST', '', '', '', 'mariofrans', '2023-01-04 09:54:34', 'mariofrans', '2023-01-04 12:05:30'),
	('CBT-STR-0123-0012', 1, 'PTP', 'tes_ptp_scenario_2', 'CST', '', '', '', 'mariofrans', '2023-01-04 09:57:16', 'mariofrans', '2023-01-04 12:05:51'),
	('CBT-STR-0123-0013', 1, 'PTP', 'tes_ptp_scenario_3', 'OST', '', '', '', 'mariofrans', '2023-01-04 10:05:35', '', NULL),
	('CBT-STR-0123-0014', 1, 'PTP', 'tes_ptp_scenario_4', 'OST', '', '', '', 'mariofrans', '2023-01-04 12:01:02', '', NULL),
	('CBT-STR-0123-0015', 1, 'PTP', 'tes_ptp_scenario_4', 'OST', '', '', '', 'mariofrans', '2023-01-04 12:03:49', '', NULL),
	('CBT-STR-0123-0016', 1, 'CST', 'test cst', 'CST', '', '', '', 'atmi', '2023-01-13 19:03:18', 'atmi', '2023-01-13 19:05:17'),
	('CBT-STR-0223-0001', 1, 'CST', 'test_cst', 'CST', '', '', '', 'atmi', '2023-02-03 11:13:50', 'atmi', '2023-02-03 11:18:52'),
	('CBT-STR-0223-0002', 1, 'PTP', 'test_ptp', 'CST', '', '', '', 'atmi', '2023-02-24 09:06:30', 'atmi', '2023-02-24 09:06:44'),
	('CBT-STR-0323-0001', 1, 'PTP', 'PTP-TEHKOTAK0-032023', 'CST', '', '', '', 'atmi', '2023-03-20 16:49:50', 'atmi', '2023-03-20 16:50:53'),
	('CBT-STR-0323-0002', 1, 'PTP', 'test_ptp', 'CST', '', '', '', 'atmi', '2023-03-27 09:32:43', 'atmi', '2023-03-27 09:33:09'),
	('CBT-STR-0323-0003', 1, 'PTP', NULL, 'CST', '', '', '', 'atmi', '2023-03-30 15:19:21', 'atmi', '2023-03-30 15:19:57');
/*!40000 ALTER TABLE `t_wh_stock_transfer` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_stock_transfer_detail
DROP TABLE IF EXISTS `t_wh_stock_transfer_detail`;
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

-- Dumping data for table wms.t_wh_stock_transfer_detail: 20 rows
/*!40000 ALTER TABLE `t_wh_stock_transfer_detail` DISABLE KEYS */;
INSERT INTO `t_wh_stock_transfer_detail` (`stock_transfer_id`, `source_sku`, `source_item_name`, `source_batch_no`, `source_serial_no`, `source_imei`, `source_part_no`, `source_color`, `source_size`, `source_exp_date`, `source_pallet_id`, `source_qty`, `source_uom`, `source_stock_id`, `source_location`, `source_gr`, `dest_sku`, `dest_item_name`, `dest_batch_no`, `dest_serial_no`, `dest_imei`, `dest_part_no`, `dest_color`, `dest_size`, `dest_exp_date`, `dest_pallet_id`, `dest_qty`, `dest_uom`, `dest_stock_id`, `dest_location`, `movement_id`, `user_created`, `datetime_created`) VALUES
	('CBT-STR-1122-0003', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2025-01-25', 'RPX012453', 20, 'PIECES', 'AV', '1A1-012', '', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', '2025-01-25', 'RPX012459', 5, 'PIECES', 'DMG', 'DMG-001', '', 'test_admin', '2022-11-14 10:06:24'),
	('CBT-STR-1222-0001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', '', '112233445', 'Teh Kotak Original', 'test28des22_1', '', '', '', '', '', '2023-12-28', '', 25, 'PIECES', 'AV', '1A1-001-002', '', 'mariofrans', '2022-12-28 16:19:30'),
	('CBT-STR-1122-0004', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', '', '112233445', 'Teh Kotak Original', 'test28des22_1', '', '', '', '', '', '2023-12-28', '', 25, 'PIECES', 'AV', '1A1-001-002', '', 'test_admin', '2022-12-29 15:38:12'),
	('CBT-STR-1122-0005', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', '', '112233445', 'Teh Kotak Original', 'test28des22_1', '', '', '', '', '', '2023-12-28', '', 25, 'PIECES', 'AV', '1A1-001-002', '', 'test_admin', '2022-12-29 15:41:31'),
	('CBT-STR-1122-0006', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233445', 'Teh Kotak Original', 'test28des22_1', '', '', '', '', '', '2023-12-28', '', 25, 'PIECES', 'AV', '1A1-001-002', '', 'test_admin', '2022-12-29 15:45:14'),
	('CBT-STR-0123-0001', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0014', '112233446', 'Teh Kotak Lemon', '20201212', '', '', '', '', '', '2023-12-12', '', 5, 'PIECES', 'AV', 'R1F2', '', 'mariofrans', '2023-01-03 09:03:26'),
	('CBT-STR-0123-0002', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', '', 45, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0014', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-12-12', '', 5, 'PIECES', 'DMG', 'RF08-01', '', 'mariofrans', '2023-01-03 15:48:03'),
	('CBT-STR-0123-0009', '32L5995', 'TV Toshiba 32L5995', '', '', '', '', '', '', NULL, '', 50, 'PIECES', 'AV', 'R1F2', 'CBT-GR-1022-0001', '47RW1EJ', 'TV Toshiba 47RW1EJ', 'test', '', '', '', '', '', NULL, '', 5, 'PIECES', 'AV', 'R1F3', '', 'mariofrans', '2023-01-03 16:27:54'),
	('CBT-STR-0123-0010', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', '', 20, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0015', '112233445', 'Teh Kotak Original', '20210101', '', '', '', '', '', '2024-01-01', '', 5, '', 'QR', 'R1F3', '', 'mariofrans', '2023-01-03 16:31:28'),
	('CBT-STR-0123-0011', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', NULL, '', 10, 'PIECES', 'AV', 'R1F2', '', 'mariofrans', '2023-01-04 09:54:34'),
	('CBT-STR-0123-0012', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', '', 10, 'PIECES', 'AV', 'R1F3', '', 'mariofrans', '2023-01-04 09:57:16'),
	('CBT-STR-0123-0013', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, '', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', '', 12, 'PIECES', 'DMG', 'RF08-01', '', 'mariofrans', '2023-01-04 10:05:35'),
	('CBT-STR-0123-0014', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', '', 10, 'PIECES', 'AV', '1A1-001-002', '', 'mariofrans', '2023-01-04 12:01:02'),
	('CBT-STR-0123-0015', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 50, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '20200606', '', '', '', '', '', '2023-06-06', '', 20, 'PIECES', 'DMG', 'RF08-01', '', 'mariofrans', '2023-01-04 12:03:49'),
	('CBT-STR-0123-0016', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', '', 100, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-0123-0007', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2023-01-13', '', 20, 'PIECES', 'DMG', 'R1F3', '', 'atmi', '2023-01-13 19:03:18'),
	('CBT-STR-0223-0001', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, '', 5, '', 'AV', 'test_location_1', 'CBT-GR-0223-0002', '32L5995', 'TV Toshiba 32L5995', '', '20230203', '', '', '', '', NULL, '', 1, 'PIECES', 'DMG', 'test_location_2', '', 'atmi', '2023-02-03 11:13:50'),
	('CBT-STR-0223-0002', '112233445', 'Teh Kotak Original', '20230113', '', '', '', '', '', '2025-01-13', '', 55, 'PIECES', 'AV', '1A1-001-002', 'CBT-GR-0123-0007', '112233446', 'Teh Kotak Lemon', '20230113', '', '', '', '', '', '2025-01-13', '', 10, 'PIECES', 'AV', '1A1-001-002', '', 'atmi', '2023-02-24 09:06:30'),
	('CBT-STR-0323-0001', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 40, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233445', 'Teh Kotak Original', '20201212', '', '', '', '', '', '2023-03-20', '', 5, 'PIECES', 'AV', '1A1-001-001', '', 'atmi', '2023-03-20 16:49:50'),
	('CBT-STR-0323-0002', 'ABC123', 'Baterai ABC', '', 'ABC123123', '', '', '', '', NULL, '', 15, 'PIECES', 'DMG', 'test_location_1', 'CBT-GR-0323-0004', 'IC0123', 'IC TV Toshiba 32L5995', '', 'ABC123123', '', '', '', '', NULL, '', 2, 'PIECES', 'DMG', 'R1F3', 'CBT-11-0323-0001', 'atmi', '2023-03-27 09:32:43'),
	('CBT-STR-0323-0003', '112233445', 'Teh Kotak Original', '20200606', '', '', '', '', '', '2023-06-06', '', 40, 'PIECES', 'AV', '1A1-001-001', 'CBT-GR-1222-0016', '112233446', 'Teh Kotak Lemon', '', '', '', '', '', '', '2023-07-04', '', 40, 'PIECES', 'AV', '1A1-001-003', 'CBT-``-0323-0001', 'atmi', '2023-03-30 15:19:21');
/*!40000 ALTER TABLE `t_wh_stock_transfer_detail` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_supervisor
DROP TABLE IF EXISTS `t_wh_supervisor`;
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
DROP TABLE IF EXISTS `t_wh_temporary_movement`;
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
  `is_scanned` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`movement_id`,`location_to`,`sku`) USING BTREE,
  KEY `uom_id` (`uom_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wms.t_wh_temporary_movement: 82 rows
/*!40000 ALTER TABLE `t_wh_temporary_movement` DISABLE KEYS */;
INSERT INTO `t_wh_temporary_movement` (`movement_id`, `process_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `expired_date`, `qty`, `uom_name`, `stock_id`, `location_from`, `location_type_from`, `location_to`, `location_type_to`, `warehouseman`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-01-1122-0017', 13, '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-00005', 13, '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-00005', 13, '47RW1EJ', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-004', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-0017', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 5, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-09 14:51:38', 'mariofrans', '2022-11-09 15:07:37', 'Y'),
	('CBT-01-1122-0017', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-09 14:51:38', 'mariofrans', '2022-11-09 15:07:37', 'Y'),
	('CBT-01-1122-0018', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 10, '', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 10, '', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 50, '', NULL, 'Staging Area', 'Bulk', '1A1-012', 'Bulk', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 50, '', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '32L5995', 'TV Toshiba 32L5995', '1234', '', NULL, 3, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '1234', '', NULL, 10, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '32L5995', 'TV Toshiba 32L5995', '1234', '', NULL, 2, 'PIECES', NULL, 'Staging Area', 'Bulk', 'DMG01-001', 'Quarantine', 'STAGING AREA', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1222-0013', 1, '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01 00:00:00', 25, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 10:59:59', NULL, NULL, 'Y'),
	('CBT-01-1222-0013', 1, '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12 00:00:00', 50, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 10:59:59', NULL, NULL, 'Y'),
	('CBT-01-1222-0014', 1, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 20, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 12:06:27', NULL, NULL, 'Y'),
	('CBT-01-1222-0014', 1, '112233445', 'Teh Kotak Original', '20210101', '', '2024-01-01 00:00:00', 20, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 12:06:27', NULL, NULL, 'Y'),
	('CBT-01-1222-0015', 1, '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06 00:00:00', 50, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 12:58:33', NULL, NULL, 'Y'),
	('CBT-01-1222-0015', 1, '112233445', 'Teh Kotak Original', '20200606', '', '2023-06-06 00:00:00', 50, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2022-12-15 12:58:33', NULL, NULL, 'Y'),
	('CBT-08-1222-0001', 13, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2022-12-15 16:40:33', NULL, NULL, 'Y'),
	('CBT-01-0123-0001', 1, '112233447', 'Teh Kotak Apel', '03012023', '', '2025-01-03 00:00:00', 45, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-09 09:03:07', NULL, NULL, 'Y'),
	('CBT-08-0123-0001', 13, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-09 11:37:37', NULL, NULL, 'Y'),
	('CBT-01-0123-0002', 1, '112233447', 'Teh Kotak Apel', '09012020', '', '2025-01-09 00:00:00', 50, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-10 10:07:10', NULL, NULL, 'Y'),
	('CBT-01-0123-0002', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 20, 'SET', NULL, 'Staging Area', 'Bulk', '1A1-012', 'Bulk', 'STAGING AREA', 'Y', 'atmi', '2023-01-10 10:07:10', NULL, NULL, 'Y'),
	('CBT-01-0123-0002', 1, '112233447', 'Teh Kotak Apel', '09012020', '', '2025-01-09 00:00:00', 50, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-10 10:07:10', NULL, NULL, 'Y'),
	('CBT-01-0123-0003', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-12 10:25:52', NULL, NULL, 'Y'),
	('CBT-01-0123-0004', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-12 10:52:27', NULL, NULL, 'Y'),
	('CBT-01-0123-0004', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 'UNIT', 'DMG', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-12 10:52:27', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', 1, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 50, 'SET', 'AV', 'Staging Area', 'Bulk', '1B1-001-001', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-13 11:10:48', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', 1, '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13 00:00:00', 100, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-13 11:10:48', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', 1, '112233446', 'Teh Kotak Lemon', '20230113', '', '2025-01-13 00:00:00', 20, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-01-13 11:10:48', NULL, NULL, 'Y'),
	('CBT-01-0123-0005', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'STAGING AREA', 'Y', 'atmi', '2023-01-13 11:10:48', NULL, NULL, 'Y'),
	('CBT-01-0123-0006', 1, '112233447', 'Teh Kotak Apel', '12131', '', NULL, 10, 'PALLET', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-17 09:57:56', NULL, NULL, 'Y'),
	('CBT-01-0123-0006', 1, '112233447', 'Teh Kotak Apel', '12131', '', NULL, 20, 'PALLET', 'DMG', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-17 09:57:56', NULL, NULL, 'Y'),
	('CBT-01-0123-0007', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 50, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'mariofrans', '2023-01-24 09:31:18', NULL, NULL, 'Y'),
	('CBT-01-0223-0001', 1, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', 25, 'PACK', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-02-03 10:28:13', NULL, NULL, 'Y'),
	('CBT-01-0223-0001', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 20, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'test_location_2', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-02-03 10:28:13', NULL, NULL, 'Y'),
	('CBT-01-0223-0002', 1, '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09 00:00:00', 3, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-02-08 11:52:20', NULL, NULL, 'Y'),
	('CBT-01-0223-0002', 1, '32L5995', 'TV Toshiba 32L5995', '', '', '2023-02-09 00:00:00', 2, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'rdarmawan', 'Y', 'atmi', '2023-02-08 11:52:20', NULL, NULL, 'Y'),
	('CBT-01-0223-0003', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', '2023-02-08 00:00:00', 9, 'ROLL', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'STAGING AREA', 'Y', 'atmi', '2023-02-09 09:54:25', NULL, NULL, 'Y'),
	('CBT-01-0223-0004', 1, '112233447', 'Teh Kotak Apel', '', '', '2028-09-23 00:00:00', 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-02-16 17:40:44', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', 1, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-02-23 16:56:44', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 100, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'test_staff', 'Y', 'atmi', '2023-02-23 16:56:44', NULL, NULL, 'Y'),
	('CBT-01-0223-0005', 1, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-02-23 16:56:44', NULL, NULL, 'Y'),
	('CBT-01-0323-0001', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-03-18 23:18:17', NULL, NULL, 'Y'),
	('CBT-01-0323-0002', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 4, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-20 15:20:33', NULL, NULL, 'Y'),
	('CBT-01-0323-0002', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-03-20 15:20:33', NULL, NULL, 'Y'),
	('CBT-02-0323-0001', 2, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-03-21 14:03:43', NULL, NULL, 'Y'),
	('CBT-02-0323-0001', 2, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-21 14:03:43', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-03-24 15:53:43', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 10, 'PIECES', 'DMG', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-24 15:53:43', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 15, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'DMG01-001', 'Quarantine', 'atmi', 'Y', 'atmi', '2023-03-24 15:53:43', NULL, NULL, 'Y'),
	('CBT-01-0323-0003', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 15, 'PIECES', 'DMG', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-24 15:53:43', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31 00:00:00', 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31 00:00:00', 5, 'PIECES', 'DMG', 'Staging Area', 'Bulk', 'DMG-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31 00:00:00', 20, 'PACK', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31 00:00:00', 10, 'PACK', 'DMG', 'Staging Area', 'Bulk', 'DMG-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31 00:00:00', 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-01-0323-0004', 1, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31 00:00:00', 20, 'PACK', 'AV', 'Staging Area', 'Bulk', 'test_location_2', 'Racking', 'atmi', 'Y', 'atmi', '2023-03-27 14:05:23', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', 3, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', '', NULL, 6, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'test_admin', 'Y', 'test_admin', '2023-04-04 14:49:57', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', 3, 'IC0123', 'IC TV Toshiba 32L5995', 'BO12', '', NULL, 50, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', 'test_admin', 'Y', 'test_admin', '2023-04-04 14:49:57', NULL, NULL, 'Y'),
	('CBT-03-0423-0001', 3, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', '', NULL, 4, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'test_staff', 'Y', 'test_admin', '2023-04-04 14:49:57', NULL, NULL, 'Y'),
	('CBT-01-0423-0001', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-04-05 13:11:52', NULL, NULL, 'Y'),
	('CBT-01-0423-0001', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'test_location_2', 'Racking', 'atmi', 'Y', 'atmi', '2023-04-05 13:11:52', NULL, NULL, 'Y'),
	('CBT-01-0423-0002', 1, '112233445', 'Teh Kotak Original', 'BO124', '', '2025-09-06 00:00:00', 84, 'PALLET', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'test_admin', 'Y', 'atmi', '2023-04-06 12:45:57', NULL, NULL, 'Y'),
	('CBT-01-0423-0002', 1, '112233446', 'Teh Kotak Lemon', 'BO123', '', '2027-09-06 00:00:00', 53, 'PACK', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'test_admin', 'Y', 'atmi', '2023-04-06 12:45:57', NULL, NULL, 'Y'),
	('CBT-01-0423-0003', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1B1-001-001', 'Racking', 'atmi', 'Y', 'atmi', '2023-04-11 12:03:29', NULL, NULL, 'Y'),
	('CBT-01-0423-0003', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-04-11 12:03:29', NULL, NULL, 'Y'),
	('CBT-01-0423-0004', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-04-13 11:48:57', NULL, NULL, 'Y'),
	('CBT-01-0423-0004', 1, 'ABC123', 'Baterai ABC', '', '', NULL, 50, 'PIECES', 'DMG', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-04-13 11:48:57', NULL, NULL, 'Y'),
	('CBT-01-0523-0001', 1, 'ABC123', 'Baterai ABC', '24052023', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-012', 'Bulk', 'atmi', 'Y', 'atmi', '2023-05-24 18:46:13', NULL, NULL, 'Y'),
	('CBT-01-0523-0001', 1, 'IC0123', 'IC TV Toshiba 32L5995', '24052023', '', NULL, 10, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-05-24 18:46:13', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 100, 'SET', 'AV', 'Staging Area', 'Bulk', 'test_location_1', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-06 16:19:13', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 50, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 13:09:07', NULL, NULL, 'Y'),
	('CBT-01-0523-0002', 1, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 50, 'UNIT', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'atmi', 'Y', 'atmi', '2023-06-06 13:09:07', NULL, NULL, 'Y'),
	('CBT-04-0623-0001', 4, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 25, 'PIECES', 'AVR', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'atmi', 'Y', 'atmi', '2023-06-08 09:30:24', NULL, NULL, 'Y'),
	('CBT-01-0824-0001', 1, 'CG001', 'Cengkeh', '', '', NULL, 400, 'KG', 'WIP', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', 'whsman01', 'Y', 'superadmin', '2024-08-26 13:46:21', NULL, NULL, 'Y'),
	('CBT-01-0824-0002', 1, 'ABC456', 'Sirup ABC Jeruk', '20230626', '', '2024-06-26 00:00:00', 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-26 14:32:09', NULL, NULL, 'Y'),
	('CBT-01-0824-0002', 1, 'ABC123', 'Baterai ABC', '20230626', '', NULL, 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-26 14:32:09', NULL, NULL, 'Y'),
	('CBT-01-0824-0002', 1, 'ABC123', 'Baterai ABC', '20230626', '', NULL, 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-012', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-26 14:32:09', NULL, NULL, 'Y'),
	('CBT-01-0824-0002', 1, 'ABC456', 'Sirup ABC Jeruk', '20230626', '', '2024-06-26 00:00:00', 50, 'PIECES', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-26 14:32:09', NULL, NULL, 'Y'),
	('CBT-01-0824-0003', 1, '112233445', 'Teh Kotak Original', '20230626', '', '2026-06-26 00:00:00', 23, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-27 16:31:29', NULL, NULL, 'Y'),
	('CBT-01-0824-0004', 1, 'CG001', 'Cengkeh', '', '', '2026-12-28 00:00:00', 40, 'Bag', 'AV', 'Staging Area', 'Bulk', 'FL001', 'Bulk', 'whsman01', 'Y', 'superadmin', '2024-08-28 11:43:18', NULL, NULL, 'Y');
/*!40000 ALTER TABLE `t_wh_temporary_movement` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_temporary_movement_copy
DROP TABLE IF EXISTS `t_wh_temporary_movement_copy`;
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

-- Dumping data for table wms.t_wh_temporary_movement_copy: 67 rows
/*!40000 ALTER TABLE `t_wh_temporary_movement_copy` DISABLE KEYS */;
INSERT INTO `t_wh_temporary_movement_copy` (`movement_id`, `process_id`, `sku`, `part_name`, `batch_no`, `serial_no`, `expired_date`, `qty`, `uom_name`, `stock_id`, `location_from`, `location_type_from`, `location_to`, `location_type_to`, `gr_id`, `is_submit`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`) VALUES
	('CBT-01-1122-00005', 13, '', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-002', 'Racking', '', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-00005', 13, '', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-003', 'Racking', '', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-00005', 13, '', 'TV Toshiba 47RW1EJ', '20221104', '', NULL, 20, 'PIECES', NULL, 'Stagging Area', 'Bulk', '1A1-001-004', 'Racking', '', 'Y', 'atmi', '2022-11-06 21:46:03', NULL, NULL, 'Y'),
	('CBT-01-1122-0017', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 3, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', '', 'Y', 'mariofrans', '2022-11-09 14:51:38', 'mariofrans', '2022-11-09 15:07:37', 'Y'),
	('CBT-01-1122-0017', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', 'AV', 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', '', 'Y', 'mariofrans', '2022-11-09 14:51:38', 'mariofrans', '2022-11-09 15:07:37', 'Y'),
	('CBT-01-1122-0018', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 10, '', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', '', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 10, '', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', '', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 50, '', NULL, 'Staging Area', 'Bulk', '1A1-012', 'Bulk', '', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0018', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 50, '', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', '', 'Y', 'mariofrans', '2022-11-10 14:25:24', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '32L5995', 'TV Toshiba 32L5995', '1234', '', NULL, 3, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-001', 'Racking', '', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '1234', '', NULL, 10, 'PIECES', NULL, 'Staging Area', 'Bulk', '1A1-001-002', 'Racking', '', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1122-0019', 1, '32L5995', 'TV Toshiba 32L5995', '1234', '', NULL, 2, 'PIECES', NULL, 'Staging Area', 'Bulk', 'DMG01-001', 'Quarantine', '', 'Y', 'mariofrans', '2022-11-14 15:03:52', NULL, NULL, 'Y'),
	('CBT-01-1122-0020', 13, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 20, 'PIECES', 'AV', 'Stagging Area', 'Bulk', '1A1-001-001', 'Racking', '', 'Y', 'atmi', '2022-11-16 10:00:23', NULL, NULL, 'Y'),
	('CBT-01-1122-0020', 13, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 'PIECES', 'AV', 'Stagging Area', 'Bulk', '1A1-001-001', 'Racking', '', 'Y', 'atmi', '2022-11-16 10:03:36', NULL, NULL, 'Y'),
	('CBT-01-1122-0020', 13, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 'PIECES', 'AV', 'Stagging Area', 'Bulk', '1A1-001-002', 'Racking', '', 'Y', 'atmi', '2022-11-16 10:03:49', NULL, NULL, 'Y'),
	('CBT-08-1122-0002', 8, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 10, 'PIECES', 'AV', '1A1-001-001', 'Racking', '1A1-001-002', 'Racking', '', 'Y', 'atmi', '2022-11-18 16:28:08', '', NULL, 'Y'),
	('CBT-01-1222-0014', 1, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 20, 'PIECES', '', 'Staging Area', 'Bulk', '1A1-001-003', 'Racking', '', 'Y', 'mariofrans', '2022-12-15 12:06:27', NULL, NULL, 'Y'),
	('CBT-01-1122-0017', 1, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 2, 'PIECES', 'DMG', 'STAGING AREA', 'Bulk', 'DMG01-001', 'Quarantine', '', 'Y', 'mariofrans', '2022-11-09 14:51:38', 'mariofrans', '2022-11-09 15:07:37', 'Y'),
	('CBT-08-0123-0001', 8, '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 4, 'PIECES', 'AV', 'R1F2', 'Racking', '1A1-001-001', 'Racking', '', 'Y', 'mariofrans', '2023-01-11 11:23:02', '', NULL, 'Y'),
	('CBT-08-0123-0002', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 4, 'PIECES', 'DMG', 'R1F3', 'Racking', '1A1-001-002', 'Racking', '', 'Y', 'mariofrans', '2023-01-11 11:24:24', 'atmi', '2023-05-23 16:58:29', 'Y'),
	('CBT-08-0123-0003', 8, '112233445', 'Teh Kotak Original', '20230113', '', '2025-01-13 00:00:00', 20, 'PIECES', 'AV', '1A1-001-001', 'Racking', '1A1-001-002', 'Racking', '', 'Y', 'atmi', '2023-01-15 15:28:05', 'atmi', '2023-05-24 15:09:36', 'Y'),
	('CBT-08-0123-0004', 8, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:28:42', '', NULL, 'Y'),
	('CBT-08-0123-0004', 8, '112233445', 'Teh Kotak Original', '20230113', '', '2023-12-12 00:00:00', 4, 'PIECES', 'AV', '1A1-001-001', 'Racking', '1A1-001-002', '', 'CBT-GR-0123-0007', 'Y', 'atmi', '2023-01-16 11:28:42', '', NULL, 'Y'),
	('CBT-08-0123-0005', 8, '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:28:59', '', NULL, 'Y'),
	('CBT-08-0123-0005', 8, '112233445', 'Teh Kotak Original', '20201212', '', '2023-12-12 00:00:00', 4, 'PIECES', 'AV', '1A1-001-001', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:28:59', '', NULL, 'Y'),
	('CBT-08-0123-0006', 8, '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:29:57', '', NULL, 'Y'),
	('CBT-08-0123-0007', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 5, 'PIECES', 'DMG', 'R1F3', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:58:51', '', NULL, 'Y'),
	('CBT-08-0123-0007', 8, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 5, 'SET', 'AV', '1B1-001-001', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 11:58:51', '', NULL, 'Y'),
	('CBT-08-0123-0008', 8, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 4, 'PIECES', 'AV', '1A1-001-003', 'Racking', 'DMG01-001', 'Quarantine', '', 'Y', 'atmi', '2023-01-16 12:01:25', '', NULL, 'Y'),
	('CBT-08-0123-0008', 8, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 5, 'SET', 'AV', '1B1-001-001', 'Racking', 'FL001', 'Bulk', '', 'Y', 'atmi', '2023-01-16 12:01:25', '', NULL, 'Y'),
	('CBT-08-0123-0009', 8, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 4, 'PIECES', 'AV', '1A1-001-003', 'Racking', 'DMG01-001', 'Quarantine', '', 'Y', 'atmi', '2023-01-16 12:01:28', '', NULL, 'Y'),
	('CBT-08-0123-0009', 8, 'IC0123', 'IC TV Toshiba 32L5995', '', '', NULL, 5, 'SET', 'AV', '1B1-001-001', 'Racking', 'FL001', 'Bulk', '', 'Y', 'atmi', '2023-01-16 12:01:28', '', NULL, 'Y'),
	('CBT-08-0123-0010', 8, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 4, 'PIECES', 'AV', '1A1-001-003', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 12:02:58', '', NULL, 'Y'),
	('CBT-08-0123-0010', 8, '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06 00:00:00', 3, 'PIECES', 'AV', '1A1-001-003', 'Racking', '', '', '', 'Y', 'atmi', '2023-01-16 12:02:58', '', NULL, 'Y'),
	('CBT-08-0123-0011', 8, '32L5995', 'TV Toshiba 32L5995', '456928', '20210612', NULL, 3, 'PIECES', 'AV', 'R1F2', 'Racking', '1A1-001-001', 'Racking', 'CBT-GR-1022-0001', 'Y', 'mariofrans', '2023-01-18 10:07:45', '', NULL, 'Y'),
	('CBT-08-0123-0012', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 'PIECES', 'DMG', 'R1F3', 'Racking', '1A1-001-002', 'Racking', '', 'Y', 'mariofrans', '2023-01-18 10:07:45', '', NULL, 'Y'),
	('CBT-08-0123-0013', 8, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 25, 'UNIT', 'AV', '1A1-001-001', 'Racking', '1A1-001-002', 'Racking', 'CBT-GR-0123-0012', 'Y', 'mariofrans', '2023-01-24 09:34:46', 'mariofrans', '2023-01-24 09:35:57', 'Y'),
	('CBT-08-0123-0014', 8, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 25, 'UNIT', 'AV', '1A1-001-001', 'Racking', '1A1-001-003', 'Racking', 'CBT-GR-0123-0012', 'Y', 'mariofrans', '2023-01-24 09:59:38', 'mariofrans', '2023-01-24 10:00:44', 'Y'),
	('CBT-08-0123-0015', 8, '75016438', 'DISPLAY PANEL V216B1-L02', '', '', NULL, 25, 'UNIT', 'AV', '1A1-001-002', 'Racking', '', '', 'CBT-GR-0123-0012', 'Y', 'mariofrans', '2023-01-24 10:02:20', '', NULL, 'Y'),
	('CBT-08-0223-0001', 8, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', 10, 'PACK', 'AV', 'test_location_1', 'Racking', 'test_location_2', 'Racking', 'CBT-GR-0223-0002', 'Y', 'atmi', '2023-02-03 10:45:16', 'test_staff', '2023-02-03 10:53:56', 'Y'),
	('CBT-08-0223-0002', 8, '32L5995', 'TV Toshiba 32L5995', '', '20230203', NULL, 5, 'PIECES', 'AV', 'test_location_2', 'Racking', 'test_location_1', 'Racking', 'CBT-GR-0223-0002', 'Y', 'atmi', '2023-02-03 11:01:11', 'test_staff', '2023-02-03 11:03:03', 'Y'),
	('CBT-08-0223-0003', 8, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 5, 'PIECES', 'AV', '1A1-002-002', 'Racking', 'test_location_2', 'Racking', '', 'Y', 'atmi', '2023-02-07 09:26:46', 'atmi', '2023-02-07 09:27:25', 'Y'),
	('CBT-08-0223-0004', 8, '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', '1A1-001-003', 'Racking', 'CBT-GR-1022-0043', 'Y', 'atmi', '2023-02-09 10:11:34', 'atmi', '2023-02-09 10:13:08', 'Y'),
	('CBT-08-0223-0005', 8, '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', '1A1-001-002', 'Racking', 'CBT-GR-1022-0043', 'Y', 'atmi', '2023-02-09 10:15:57', '', NULL, 'Y'),
	('CBT-08-0223-0006', 8, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', -3, 'PACK', 'AV', 'test_location_1', 'Racking', 'FL001', 'Bulk', 'CBT-GR-0223-0002', 'Y', 'mariofrans', '2023-02-09 10:17:07', '', NULL, 'Y'),
	('CBT-08-0223-0007', 8, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 50, 'PIECES', 'AV', '1A1-001-001', 'Racking', 'test_location_1', 'Racking', 'CBT-GR-0223-0015', 'Y', 'atmi', '2023-02-24 08:58:49', '', NULL, 'Y'),
	('CBT-08-0223-0008', 8, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 20, 'PIECES', 'AV', '1A1-001-001', 'Racking', 'test_location_2', 'Racking', 'CBT-GR-0223-0015', 'Y', 'atmi', '2023-02-24 09:00:08', 'atmi', '2023-02-24 09:01:18', 'Y'),
	('CBT-08-0323-0001', 8, '112233447', 'Teh Kotak Apel', '20210101', '', '2024-01-01 00:00:00', 5, 'PIECES', 'AV', '1A1-001-003', 'Racking', '1A1-001-001', 'Bulk', 'CBT-GR-1222-0015', 'Y', 'atmi', '2023-03-20 15:49:55', '', NULL, 'Y'),
	('CBT-08-0323-0002', 8, '112233447', 'Teh Kotak Apel', '12131', '', NULL, 5, 'PALLET', 'AV', '1A1-001-002', 'Racking', '1A1-001-001', 'Bulk', 'CBT-GR-0123-0009', 'Y', 'atmi', '2023-03-20 15:49:55', 'atmi', '2023-03-20 16:00:03', 'Y'),
	('CBT-08-0323-0003', 8, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', 5, 'PACK', 'AV', 'test_location_1', 'Racking', '1A1-001-002', 'Racking', 'CBT-GR-0223-0002', 'Y', 'atmi', '2023-03-30 15:14:07', 'atmi', '2023-04-05 15:35:12', 'Y'),
	('CBT-08-0323-0004', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 10, 'PIECES', 'DMG', 'R1F3', 'Racking', '1A1-001-003', 'Racking', '', 'Y', 'atmi', '2023-03-30 15:14:07', 'atmi', '2023-03-30 15:15:48', 'Y'),
	('CBT-08-0423-0001', 8, '47RW1EJ', 'TV Toshiba 47RW1EJ', 'BO12', 'SO12', NULL, 6, 'PACK', 'AV', '1A1-001-001', 'Bulk', '1A1-001-002', 'Racking', 'CBT-GR-0423-0001', 'Y', 'test_admin', '2023-04-04 14:58:14', 'test_admin', '2023-04-04 15:00:09', 'Y'),
	('CBT-08-0423-0002', 8, '32L5995', 'TV Toshiba 32L5995', '20221104', '', NULL, 5, 'PIECES', 'AV', '1A1-001-002', 'Racking', 'test_location_1', 'Racking', 'CBT-GR-1022-0043', 'Y', 'atmi', '2023-04-14 09:11:24', 'atmi', '2023-04-19 11:15:33', 'Y'),
	('CBT-08-0423-0003', 8, '32L5995', 'TV Toshiba 32L5995', '', '', NULL, 5, 'PIECES', 'AV', '1A1-001-001', 'Racking', 'test_location_2', 'Racking', 'CBT-GR-1022-0043', 'Y', 'atmi', '2023-04-14 09:11:24', '', NULL, 'Y'),
	('CBT-08-0423-0004', 8, '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06 00:00:00', 5, 'PIECES', 'AV', '1A1-001-003', 'Racking', 'test_location_2', 'Racking', 'CBT-GR-1222-0016', 'Y', 'atmi', '2023-04-14 09:11:24', 'atmi', '2023-04-19 11:13:15', 'Y'),
	('CBT-08-0423-0005', 8, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31 00:00:00', 2, 'PACK', 'AV', 'test_location_2', 'Racking', '1B1-001-001', 'Racking', 'CBT-GR-0323-0005', 'Y', 'atmi', '2023-04-27 17:30:24', 'atmi', '2023-07-03 15:35:54', 'Y'),
	('CBT-08-0423-0005', 8, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 20, 'PIECES', 'AV', 'FL001', 'Bulk', 'test_location_2', 'Racking', 'CBT-GR-0223-0015', 'Y', 'atmi', '2023-04-27 17:34:32', '', NULL, 'Y'),
	('CBT-08-0523-0001', 8, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', 1, 'PACK', 'AV', 'test_location_1', 'Racking', 'DMG-001-001', 'Racking', 'CBT-GR-0223-0002', 'Y', 'atmi', '2023-05-04 12:34:58', '', NULL, 'Y'),
	('CBT-08-0523-0002', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 2, 'PIECES', 'DMG', 'R1F3', 'Racking', 'DMG01-001', 'Quarantine', '', 'Y', 'atmi', '2023-05-04 12:34:58', '', NULL, 'Y'),
	('CBT-08-0523-0003', 8, '112233446', 'Teh Kotak Lemon', '20200606', '', '2023-06-06 00:00:00', 5, 'PIECES', 'AV', '1A1-001-003', 'Racking', 'test_location_1', 'Racking', 'CBT-GR-1222-0016', 'Y', 'atmi', '2023-05-04 13:44:44', 'atmi', '2023-05-04 14:21:59', 'Y'),
	('CBT-08-0523-0003', 8, '47RW1EJ', 'TV Toshiba 47RW1EJ', '', '', NULL, 3, 'PIECES', 'AV', '1A1-002-002', 'Racking', 'DMG-001-001', 'Racking', '', 'Y', 'atmi', '2023-05-04 13:44:44', 'atmi', '2023-05-04 14:21:59', 'Y'),
	('CBT-08-0523-0004', 8, '112233446', 'Teh Kotak Lemon', '23022023', '', '2024-02-23 00:00:00', 5, 'PIECES', 'AV', 'FL001', 'Bulk', 'test_location_1', 'Racking', 'CBT-GR-0223-0015', 'Y', 'atmi', '2023-05-04 14:03:44', '', NULL, 'Y'),
	('CBT-08-0523-0005', 8, '112233446', 'Teh Kotak Lemon', '20201201', '', '2023-12-01 00:00:00', 4, 'PIECES', 'AV', '1A1-002-002', 'Racking', 'test_location_2', 'Racking', 'CBT-GR-1222-0014', 'Y', 'atmi', '2023-05-04 14:03:44', 'atmi', '2023-05-23 09:28:59', 'Y'),
	('CBT-08-0523-0006', 8, '112233447', 'Teh Kotak Apel', '270323', '', '2024-03-31 00:00:00', 5, 'PIECES', 'AV', '1A1-001-001', 'Bulk', 'R1F3', 'Bulk', 'CBT-GR-0323-0005', 'Y', 'atmi', '2023-05-12 15:05:10', 'atmi', '2023-05-12 15:20:18', 'Y'),
	('CBT-08-0523-0006', 8, 'ABC456', 'Sirup ABC Jeruk', '270323', '', '2024-03-31 00:00:00', 5, 'PACK', 'DMG', 'DMG-001-001', 'Racking', 'FL001', 'Bulk', 'CBT-GR-0323-0005', 'Y', 'atmi', '2023-05-12 15:05:10', 'atmi', '2023-05-12 15:20:18', 'Y'),
	('CBT-08-0824-0001', 8, '112233446', 'Teh Kotak Lemon', '03022023', '', '2025-02-03 00:00:00', 4, 'PACK', 'AV', 'test_location_1', 'Racking', '', '', 'CBT-GR-0223-0002', 'Y', 'superadmin', '2024-08-28 15:48:55', '', NULL, 'Y'),
	('CBT-08-0824-0002', 8, '32L5995', 'TV Toshiba 32L5995', 'test_26okt22_2', '', NULL, 5, 'PIECES', 'DMG', 'R1F3', 'Racking', '1A1-001-001', 'Bulk', '', 'Y', 'superadmin', '2024-08-28 15:52:26', 'superadmin', '2024-08-28 15:53:02', 'Y');
/*!40000 ALTER TABLE `t_wh_temporary_movement_copy` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_transportation
DROP TABLE IF EXISTS `t_wh_transportation`;
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
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC COMMENT='sub menu transportation and unloading on inbound planning';

-- Dumping data for table wms.t_wh_transportation: 81 rows
/*!40000 ALTER TABLE `t_wh_transportation` DISABLE KEYS */;
INSERT INTO `t_wh_transportation` (`transport_id`, `activity_id`, `vehicle_no`, `driver_name`, `arrival_date`, `start_unloading`, `finish_unloading`, `departure_date`, `vehicle_id`, `container_no`, `seal_no`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(21, 20, 'B 123 TST', 'bob', '2022-11-16 13:26:00', '2022-11-16 14:27:00', NULL, NULL, 1, '111111', '222222', 'test_admin', '2022-11-16 13:27:06', NULL, NULL, 'Y', NULL),
	(20, 24, 't3512b', 'budi', '2022-11-16 08:50:00', '2022-11-16 09:00:00', '2022-11-16 11:50:00', '2022-11-16 00:07:00', 1, '123', 'test123', 'atmi', '2022-11-16 08:51:54', 'atmi', '2022-11-16 09:07:28', 'Y', NULL),
	(18, 22, 'B 6917 TTT', 'Joko', '2022-11-15 14:39:00', '2022-11-15 14:44:00', '2022-11-15 14:50:00', '2022-11-15 14:52:00', 1, '56789', '67890', 'atmi', '2022-11-14 14:43:37', 'atmi', '2022-11-14 14:51:42', 'Y', NULL),
	(19, 22, 'B 8910 PIV', 'justin', '2022-11-15 15:43:00', '2022-11-15 16:43:00', '2022-11-15 14:51:00', '2022-11-15 14:51:00', 2, '6666', '7777', 'atmi', '2022-11-14 14:43:37', 'atmi', '2022-11-14 14:51:42', 'Y', NULL),
	(17, 19, 'B1234ABC', 'Bambang', '2022-11-11 17:49:00', '2022-11-11 18:49:00', NULL, NULL, 1, 'test', 'test2', 'test_staff', '2022-11-11 16:49:42', NULL, NULL, 'Y', NULL),
	(16, 17, 'p111p', 'set1', '2022-11-13 17:24:00', '2022-11-15 17:24:00', '2022-11-16 17:25:00', '2022-11-16 17:26:00', 1, 'set1', 'set1', 'test_admin', '2022-11-09 17:24:45', 'test_admin', '2022-11-09 17:26:03', 'Y', NULL),
	(15, 15, 's111s', 'test1', '2022-11-11 09:09:00', '2022-11-11 09:09:00', '2022-11-12 09:42:00', '2022-11-12 09:42:00', 7, 'test1', 'test1', 'test_admin', '2022-11-09 09:09:52', 'test_admin', '2022-11-09 09:42:33', 'Y', NULL),
	(14, 13, 'B1234GH', 'marsono', '2022-11-04 13:00:00', '2022-11-04 13:14:00', '2022-11-04 14:00:00', '2022-11-04 14:30:00', 2, 'test_0411', '0411', 'atmi', '2022-11-04 14:00:00', NULL, NULL, NULL, NULL),
	(13, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 9, 'test_2810', 'test', '2022-10-28 15:30:00', '2022-10-28 15:35:00', NULL, NULL, 1, '2810', '123', 'test_admin', '2022-10-28 15:13:07', NULL, NULL, 'Y', NULL),
	(22, 30, 't123s', 'udin', '2022-12-15 09:30:00', '2022-12-15 09:37:00', '2022-12-15 10:44:00', '2022-12-15 11:00:00', 1, '123', '123', 'test_staff', '2022-12-15 09:43:06', 'test_staff', '2022-12-15 09:44:29', 'Y', NULL),
	(23, 32, 't124s', 'gilang', '2022-12-15 11:40:00', '2022-12-15 11:53:00', '2022-12-15 13:55:00', '2022-12-15 02:00:00', 1, '456', '456', 'test_admin', '2022-12-15 11:53:11', 'test_admin', '2022-12-15 11:55:27', 'Y', NULL),
	(24, 34, 't789s', 'ucok', '2022-12-15 12:40:00', '2022-12-15 12:48:00', '2022-12-15 01:54:00', '2022-12-15 02:00:00', 1, '789', '789', 'test_staff', '2022-12-15 12:48:18', 'test_staff', '2022-12-15 12:52:04', 'Y', NULL),
	(25, 37, 'b1234tes', 'usep', '2023-01-03 17:39:00', '2023-01-03 17:39:00', '2023-01-03 18:41:00', '2023-01-03 18:41:00', 1, '123', '123', 'test_admin', '2023-01-03 17:39:23', 'test_admin', '2023-01-03 17:41:18', 'Y', NULL),
	(26, 40, 'b1234as', 'test9jan2023_1', '2023-01-09 09:45:00', '2023-01-09 09:45:00', '2023-01-10 09:45:00', '2023-01-10 21:45:00', 1, 'test9jan2023_1', 'test9jan2023_1', 'test_staff', '2023-01-09 09:45:27', 'test_staff', '2023-01-09 09:45:39', 'Y', NULL),
	(27, 41, 'b1234s', 'test9jan2023_2', '2023-01-09 10:11:00', '2023-01-09 10:11:00', '2023-01-10 10:11:00', '2023-01-10 10:11:00', 1, 'test9jan2023_2', 'test9jan2023_2', 'test_staff', '2023-01-09 10:11:25', 'test_staff', '2023-01-09 10:11:43', 'Y', NULL),
	(28, 41, 'b4444s', 'test9jan2023_2', '2023-01-09 10:11:00', '2023-01-09 10:11:00', '2023-01-10 10:11:00', '2023-01-10 10:11:00', 2, 'test9jan2023_2', 'test9jan2023_2', 'test_staff', '2023-01-09 10:11:25', 'test_staff', '2023-01-09 10:11:43', 'Y', NULL),
	(29, 42, 'A1234TMI', 'udjo', '2023-01-09 14:09:00', '2023-01-09 15:09:00', '2023-01-09 14:10:00', '2023-01-09 15:10:00', 1, '123', '123', 'atmi', '2023-01-09 14:11:44', 'atmi', '2023-01-09 14:12:05', 'Y', NULL),
	(30, 42, 'A4567SIX', 'ucok', '2023-01-09 14:11:00', '2023-01-09 15:11:00', '2023-01-09 14:11:00', '2023-01-09 15:12:00', 1, '456', '456', 'atmi', '2023-01-09 14:11:44', 'atmi', '2023-01-09 14:12:05', 'Y', NULL),
	(31, 45, 'b1234s', 'test12jan2023_1', '2023-01-12 10:12:00', '2023-01-12 10:12:00', '2023-01-13 10:12:00', '2023-01-13 10:12:00', 1, 'test12jan2023_1', 'test12jan2023_1', 'test_admin', '2023-01-12 10:12:54', 'test_admin', '2023-01-12 10:13:08', 'Y', NULL),
	(32, 47, 'b5555s', 'test12jan2023_2', '2023-01-13 10:35:00', '2023-01-13 10:35:00', '2023-01-14 10:35:00', '2023-01-14 10:35:00', 2, 'test12jan2023_2', 'test12jan2023_2', 'test_admin', '2023-01-12 10:35:54', 'test_admin', '2023-01-12 10:36:08', 'Y', NULL),
	(33, 49, 'B1234TES', 'tessy', '2023-01-13 09:50:00', '2023-01-13 10:50:00', '2023-01-13 11:51:00', '2023-01-13 11:51:00', 7, 'test1', 'test1', 'atmi', '2023-01-13 09:51:14', 'atmi', '2023-01-13 09:52:02', 'Y', NULL),
	(34, 49, 'B1235TES', 'tessa', '2023-01-13 09:51:00', '2023-01-13 10:51:00', '2023-01-13 11:51:00', '2023-01-13 11:51:00', 7, 'test2', 'test2', 'atmi', '2023-01-13 09:51:14', 'atmi', '2023-01-13 09:52:02', 'Y', NULL),
	(35, 50, 'B1236TES', 'jesse', '2023-01-13 09:57:00', '2023-01-13 10:57:00', '2023-01-13 11:58:00', '2023-01-13 11:58:00', 1, 'test3', 'test3', 'test_staff', '2023-01-13 09:57:50', 'test_staff', '2023-01-13 10:00:14', 'Y', NULL),
	(36, 55, '12131313', 'robi', '2023-01-17 09:48:00', '2023-01-17 00:46:00', '2023-01-18 11:53:00', '2023-01-18 00:53:00', 1, '12131', '1213', 'atmi', '2023-01-17 09:46:33', 'atmi', '2023-01-17 09:53:15', 'Y', NULL),
	(37, 60, 'b4444s', 'test19jan23_1', '2023-01-19 14:43:00', '2023-01-19 14:43:00', '2023-01-20 14:43:00', '2023-01-20 14:43:00', 1, 'test19jan23_1', 'test19jan23_1', 'test_staff', '2023-01-19 14:44:38', 'test_staff', '2023-01-19 14:45:01', 'Y', NULL),
	(38, 61, 'b6666s', 'test24jan2023_1', '2023-01-24 09:29:00', '2023-01-24 09:29:00', '2023-01-25 09:29:00', '2023-01-25 09:29:00', 1, 'test24jan2023_1', 'test24jan2023_1', 'test_staff', '2023-01-24 09:29:39', 'test_staff', '2023-01-24 09:29:53', 'Y', NULL),
	(39, 70, 'b6238hsd', 'janu', '2023-02-01 16:54:00', '2023-02-01 17:00:00', NULL, NULL, 1, '6666', '238', 'atmi', '2023-02-01 16:54:58', NULL, NULL, 'Y', NULL),
	(40, 77, 'b1234as', 'sule', '2023-02-03 10:00:00', '2023-02-03 10:03:00', '2023-02-03 10:10:00', '2023-02-03 10:10:00', 1, '123', '123', 'test_staff', '2023-02-03 10:00:47', 'test_staff', '2023-02-03 10:10:33', 'Y', NULL),
	(41, 78, 'b2345sd', 'sueb', '2023-02-03 10:03:00', '2023-02-03 10:06:00', '2023-02-03 11:05:00', '2023-02-03 11:05:00', 2, '234', '234', 'test_admin', '2023-02-03 10:03:28', 'test_admin', '2023-02-03 10:05:44', 'Y', NULL),
	(42, 87, 'b0202tes', 'tes', '2023-02-03 17:36:00', '2023-02-03 17:40:00', '2023-02-03 18:36:00', '2023-02-03 18:40:00', 1, '0202', '0202', 'atmi', '2023-02-03 17:36:19', 'atmi', '2023-02-03 17:37:08', 'Y', NULL),
	(43, 88, 'b0202tis', 'tis', '2023-02-03 17:38:00', '2023-02-03 17:40:00', NULL, NULL, 2, '0202', '0202', 'test_admin', '2023-02-03 17:38:46', NULL, NULL, 'Y', NULL),
	(44, 90, 'b1234s', 'test7feb23_1', '2023-02-07 13:32:00', '2023-02-07 13:32:00', '2023-02-08 13:33:00', '2023-02-08 13:33:00', 1, 'test7feb23_1', 'test7feb23_1', 'test_admin', '2023-02-07 13:32:46', 'test_admin', '2023-02-07 13:33:30', 'Y', NULL),
	(45, 93, 'fuso1', 'driver fuso', '2023-02-08 13:33:00', '2023-02-08 13:50:00', '2023-02-09 14:50:00', '2023-02-08 02:44:00', 2, 'no mandatory', 'no mandatory', 'atmi', '2023-02-08 11:34:31', 'atmi', '2023-02-08 11:41:03', 'Y', NULL),
	(46, 96, 'b2739gk', 'urip', '2023-02-08 14:28:00', '2023-02-08 14:35:00', NULL, NULL, 1, '92', '39', 'atmi', '2023-02-08 14:29:11', NULL, NULL, 'Y', NULL),
	(47, 98, '1777', 'Rafathar', '2023-02-08 15:22:00', '2023-02-08 16:22:00', '2023-02-08 17:24:00', '2023-02-08 17:30:00', 2, 'no_mandatory', 'no_mandatory', 'atmi', '2023-02-08 15:22:46', 'atmi', '2023-02-08 15:24:33', 'Y', NULL),
	(48, 107, '12121', 'Test', '2023-02-09 16:33:00', '2023-02-09 16:33:00', NULL, NULL, 2, 'Test', 'Test', 'atmi', '2023-02-09 16:33:40', NULL, NULL, 'Y', NULL),
	(49, 108, 'b1234s', 'test10feb23_1', '2023-02-10 18:02:00', '2023-02-10 18:02:00', NULL, NULL, 1, 'test10feb23_1', 'test10feb23_1', 'test_admin', '2023-02-10 18:02:28', NULL, NULL, 'Y', NULL),
	(50, 109, 'b4321s', 'test10feb23_1_staff', '2023-02-10 18:03:00', '2023-02-10 18:03:00', NULL, NULL, 2, 'test10feb23_1_staff', 'test10feb23_1_staff', 'test_staff', '2023-02-10 18:04:12', NULL, NULL, 'Y', NULL),
	(51, 110, 'b123b', 'ali', '2023-02-13 13:41:00', '2023-02-13 13:51:00', NULL, NULL, 1, '123', '123', 'atmi', '2023-02-13 13:41:17', NULL, NULL, 'Y', NULL),
	(52, 111, 'b8473bd', 'jali', '2023-02-13 14:00:00', '2023-02-13 14:10:00', NULL, NULL, 2, '569', '658', 'test_staff', '2023-02-13 14:00:54', NULL, NULL, 'Y', NULL),
	(53, 112, 'test', 'test', '2023-02-16 17:33:00', '2023-02-16 17:35:00', '2023-02-17 17:42:00', '2023-02-17 17:43:00', 1, 'test', 'test', 'atmi', '2023-02-16 17:33:20', 'atmi', '2023-02-16 17:37:18', 'Y', NULL),
	(54, 116, 'b5412sd', 'sair', '2023-02-21 11:25:00', '2023-02-21 00:00:00', NULL, NULL, 1, '5412', '5412', 'test_staff', '2023-02-21 11:25:47', NULL, NULL, 'Y', NULL),
	(55, 115, 'b7569sd', 'abi', '2023-02-21 11:32:00', '2023-02-21 00:00:00', NULL, NULL, 1, '3', '35', 'atmi', '2023-02-21 11:33:10', NULL, NULL, 'Y', NULL),
	(56, 117, 'b1545vd', 'vidi', '2023-02-23 09:10:00', '2023-02-23 09:17:00', NULL, NULL, 1, '25', '25', 'atmi', '2023-02-23 09:11:07', NULL, NULL, 'Y', NULL),
	(57, 118, 'b5477ef', 'efi', '2023-02-23 09:13:00', '2023-02-23 09:18:00', NULL, NULL, 1, '25', '65', 'test_staff', '2023-02-23 09:13:39', NULL, NULL, 'Y', NULL),
	(58, 121, 'b6384hj', 'a', '2023-02-23 16:38:00', '2023-02-23 16:45:00', '2023-02-23 16:50:00', '2023-02-23 17:00:00', 1, '12', '12', 'atmi', '2023-02-23 16:39:12', 'atmi', '2023-02-23 16:50:25', 'Y', NULL),
	(59, 122, 'b9364cd', 'c', '2023-02-23 16:43:00', '2023-02-23 16:50:00', '2023-02-23 17:51:00', '2023-02-23 18:51:00', 1, '12', '12', 'test_staff', '2023-02-23 16:43:39', 'test_staff', '2023-02-23 16:51:22', 'Y', NULL),
	(60, 129, 'b2345kn', 'ali', '2023-03-18 23:12:00', '2023-03-18 23:12:00', '2023-03-18 23:16:00', '2023-03-18 23:16:00', 2, '12', '12', 'atmi', '2023-03-18 23:12:20', 'atmi', '2023-03-18 23:16:32', 'Y', NULL),
	(61, 131, 'B1111', 'AKMAL', '2023-03-20 15:37:00', '2023-03-20 16:37:00', '2023-03-20 17:41:00', '2023-03-20 18:41:00', 1, '12345', '12345', 'atmi', '2023-03-20 14:41:28', 'atmi', '2023-03-20 14:41:51', 'Y', NULL),
	(62, 137, 'b1234f', 'bayu', '2023-03-21 09:27:00', '2023-03-21 09:27:00', '2023-03-21 09:28:00', '2023-03-21 09:28:00', 1, '12', '12', 'atmi', '2023-03-21 09:27:39', 'atmi', '2023-03-21 09:28:33', 'Y', NULL),
	(63, 139, 'b123f', 'b', '2023-03-24 15:03:00', '2023-03-24 15:03:00', '2023-03-24 15:04:00', '2023-03-24 15:04:00', 1, '1', '2', 'atmi', '2023-03-24 15:03:58', 'atmi', '2023-03-24 15:04:52', 'Y', NULL),
	(64, 141, 'b1234rt', 'umar', '2023-03-27 13:49:00', '2023-03-27 14:07:00', '2023-03-27 15:51:00', '2023-03-27 16:11:00', 7, '', '', 'atmi', '2023-03-27 13:49:30', 'atmi', '2023-03-27 13:51:53', 'Y', NULL),
	(65, 147, 'B 3039 SKC', 'Adit', '2023-04-05 17:29:00', '2023-04-05 18:00:00', '2023-04-05 12:40:00', '2023-04-05 12:58:00', 2, 'C01', 'S01', 'test_admin', '2023-04-04 14:31:08', 'test_admin', '2023-04-04 14:36:49', 'Y', NULL),
	(66, 114, 'b1234fd', 'as', '2023-04-05 10:25:00', '2023-04-05 10:30:00', '2023-04-05 10:37:00', '2023-04-05 10:44:00', 3, '1', '1', 'test_admin', '2023-04-05 10:25:40', 'test_admin', '2023-04-05 10:38:07', 'Y', NULL),
	(67, 154, 'b123f', 'test', '2023-04-06 08:32:00', '2023-04-06 08:39:00', '2023-04-06 08:34:00', '2023-04-06 08:40:00', 2, '1', '1', 'atmi', '2023-04-06 08:33:07', 'atmi', '2023-04-06 08:40:39', 'Y', NULL),
	(68, 155, 'b345w', 'tes', '2023-04-06 08:39:00', '2023-04-06 08:44:00', '2023-04-06 08:39:00', '2023-04-06 08:45:00', 1, '1', '1', 'atmi', '2023-04-06 08:39:18', 'atmi', '2023-04-06 08:40:03', 'Y', NULL),
	(69, 156, '1', 'test', '2023-04-06 08:44:00', '2023-04-06 08:45:00', '2023-04-06 08:45:00', '2023-04-06 08:46:00', 7, '1', '1', 'atmi', '2023-04-06 08:45:11', 'atmi', '2023-04-06 08:45:51', 'Y', NULL),
	(70, 157, 'B 0852 ICA', 'Budi', '2023-04-07 20:00:00', '2023-04-07 21:00:00', '2023-04-07 05:25:00', '2023-04-07 05:25:00', 2, 'CO1', 'SO1', 'test_admin', '2023-04-06 12:19:31', 'test_admin', '2023-04-06 12:25:56', 'Y', NULL),
	(71, 157, 'B 0853 ICA', 'Buda', '2023-04-07 20:00:00', '2023-04-07 21:00:00', '2023-04-07 05:25:00', '2023-04-07 05:25:00', 1, 'CO1', 'SO1', 'test_admin', '2023-04-06 12:19:31', 'test_admin', '2023-04-06 12:25:56', 'Y', NULL),
	(72, 158, 'B 0854 ICA', 'Bude', '2023-04-07 19:35:00', '2023-04-07 21:33:00', '2023-04-07 12:34:00', '2023-04-07 12:35:00', 2, 'CO01', 'SO01', 'atmi', '2023-04-06 12:33:55', 'atmi', '2023-04-06 12:35:18', 'Y', NULL),
	(73, 151, '2', 'a', '2023-04-10 15:02:00', '2023-04-10 16:01:00', '2023-05-21 12:44:00', '2023-05-21 12:44:00', 2, '2', '2', 'atmi', '2023-04-10 15:01:37', 'atmi', '2023-05-21 12:44:32', 'Y', NULL),
	(74, 164, 'b1512fd', 'asep', '2023-04-17 14:39:00', '2023-04-17 14:39:00', '2023-04-17 14:39:00', '2023-04-17 14:39:00', 4, '12', '12', 'atmi', '2023-04-17 14:39:15', 'atmi', '2023-04-17 14:40:04', 'Y', NULL),
	(75, 157, 'B 0852 ICA', 'Budi', '2022-04-07 20:00:00', '2023-04-07 21:00:00', NULL, NULL, 2, 'CO1', 'SO1', 'atmi', '2023-05-16 22:03:15', NULL, NULL, NULL, NULL),
	(76, 157, 'B 0852 ICA', 'Budi', '2022-04-07 20:00:00', '2023-04-07 21:00:00', NULL, NULL, 2, 'CO1', 'SO1', 'atmi', '2023-05-16 22:06:42', NULL, NULL, NULL, NULL),
	(77, 157, 'B 0852 ICA', 'Budi', '2022-04-07 20:00:00', '2023-04-07 21:00:00', NULL, NULL, 2, 'CO1', 'SO1', 'atmi', '2023-05-16 22:06:58', NULL, NULL, NULL, NULL),
	(78, 157, 'B 0852 ICA', 'Budi', '2022-04-07 20:00:00', '2023-04-07 21:00:00', NULL, NULL, 2, 'CO1', 'SO1', 'atmi', '2023-05-16 22:08:46', NULL, NULL, NULL, NULL),
	(84, 70, 'b123', 'tesalmobile', '2023-05-18 00:00:00', '2023-05-06 00:00:00', NULL, NULL, 1, '21', '123', 'atmi', '2023-05-18 14:08:40', NULL, NULL, NULL, NULL),
	(83, 70, '2', '3', '2023-05-17 00:00:00', '2023-05-17 00:00:00', NULL, NULL, 1, '4', '5', 'atmi', '2023-05-17 13:43:59', NULL, NULL, NULL, NULL),
	(82, 70, '1', '2', '2023-05-17 00:00:00', '2023-05-17 00:00:00', NULL, NULL, 1, '3', '4', 'atmi', '2023-05-17 13:43:59', NULL, NULL, NULL, NULL),
	(85, 170, '21', 'as', '2023-05-21 13:53:00', '2023-05-21 13:54:00', '2023-05-21 13:54:00', '2023-05-21 13:55:00', 1, '121', '22', 'atmi', '2023-05-21 13:54:09', 'atmi', '2023-05-21 13:55:09', 'Y', NULL),
	(86, 171, 'b123s', 'tes', '2023-05-22 09:45:00', '2023-05-22 10:45:00', '2023-05-22 11:48:00', '2023-05-22 00:00:00', 1, '23', '23', 'atmi', '2023-05-22 09:45:42', 'atmi', '2023-05-22 09:48:44', 'Y', NULL),
	(87, 173, 'b1234a', 'q', '2023-05-24 11:55:00', '2023-05-24 11:55:00', '2023-05-24 12:01:00', '2023-05-24 12:01:00', 7, '2', '5', 'atmi', '2023-05-24 11:55:49', 'atmi', '2023-05-24 12:01:57', 'Y', NULL),
	(88, 21, '123', '123', '2023-06-06 00:00:00', '2023-06-06 00:00:00', NULL, NULL, 1, '123', '123', 'atmi', '2023-05-29 15:53:03', NULL, NULL, NULL, NULL),
	(89, 21, '123', '1', '2023-06-07 00:00:00', '2023-06-01 00:00:00', NULL, NULL, 1, '1', '1', 'atmi', '2023-05-29 16:43:50', NULL, NULL, NULL, NULL),
	(90, 21, 'gye', 'ttt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 3, 'ywywy', 'twtwtw', 'atmi', '2023-06-16 15:42:18', NULL, NULL, NULL, NULL),
	(91, 21, 'rgg', 'hbb', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 3, 'BBC ct', 'bc', 'atmi', '2023-07-03 20:00:27', NULL, NULL, NULL, NULL),
	(92, 190, 'b123bbb', 'anto', '2024-08-26 09:40:00', '2024-08-26 09:45:00', '2024-08-26 11:41:00', '2024-08-26 13:41:00', 3, '2', '12', 'superadmin', '2024-08-26 13:42:23', 'superadmin', '2024-08-26 13:42:52', 'Y', NULL),
	(93, 193, 'B123CDS', 'AGA', '2024-08-26 09:08:00', '2024-08-26 09:10:00', '2024-08-26 10:09:00', '2024-08-26 11:09:00', 3, '', '1', 'superadmin', '2024-08-26 14:09:49', 'superadmin', '2024-08-26 14:10:13', 'Y', NULL),
	(94, 196, 'b123zz', 'dimas', '2024-08-27 16:21:00', '2024-08-27 16:21:00', '2024-08-27 16:23:00', '2024-08-27 16:23:00', 3, '', '', 'superadmin', '2024-08-27 16:22:16', 'superadmin', '2024-08-27 16:24:08', 'Y', NULL),
	(95, 198, 'B123ZZZ', 'ANTO', '2024-08-28 08:34:00', '2024-08-28 09:40:00', '2024-08-28 10:37:00', '2024-08-28 10:40:00', 2, '1', '1', 'superadmin', '2024-08-28 11:36:31', 'superadmin', '2024-08-28 11:40:11', 'Y', NULL);
/*!40000 ALTER TABLE `t_wh_transportation` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_transportation_2
DROP TABLE IF EXISTS `t_wh_transportation_2`;
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='sub menu transportation and unloading on inbound planning';

-- Dumping data for table wms.t_wh_transportation_2: 13 rows
/*!40000 ALTER TABLE `t_wh_transportation_2` DISABLE KEYS */;
INSERT INTO `t_wh_transportation_2` (`transport_id`, `activity_id`, `checker`, `supervisor_id`, `arrival_date`, `start_unloading`, `finish_unloading`, `departure_date`, `vehicle_no`, `driver_name`, `vehicle_id`, `container_no`, `seal_no`, `user_created`, `datetime_created`, `user_updated`, `datetime_updated`, `is_active`, `is_deleted`) VALUES
	(1, 0, 'hari', 1, '2022-09-16 15:05:15', NULL, NULL, '2022-09-16 16:26:15', 'B 1524 HS', 'Soni', 2, '254', '15AD25', 'atmi', '2022-09-20 17:41:05', NULL, NULL, 'Y', NULL),
	(2, 0, 'hari', 1, '2022-09-16 16:26:15', NULL, NULL, '2022-09-16 16:26:15', 'B 7618 HA', 'Sono', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 1, 'udin', 1, '2022-10-05 16:49:26', NULL, NULL, '2022-10-05 18:15:17', 'B1234AS', 'Agus', 2, '154', '24AS63', 'atmi', '2022-10-05 17:30:45', NULL, NULL, 'Y', NULL),
	(8, 1, 'hari', 0, '2022-10-12 16:49:26', NULL, NULL, '2022-10-12 18:15:17', 'B1562SA', 'Budi', 2, '', '', 'hari', '2022-10-12 12:00:35', NULL, NULL, 'Y', NULL),
	(7, 1, 'hari', 0, '2022-10-12 16:49:26', NULL, NULL, '2022-10-12 18:15:17', 'B1562SK', 'Joni', 2, '', '', 'hari', '2022-10-12 12:00:35', NULL, NULL, 'Y', NULL),
	(6, 1, 'hari', 1, '2022-10-12 16:49:26', NULL, NULL, '2022-10-12 18:15:17', 'B1562SA', 'Budi', 2, '', '', 'hari', '2022-10-12 12:01:04', NULL, NULL, 'Y', NULL),
	(5, 1, 'hari', 1, '2022-10-12 16:49:26', NULL, NULL, '2022-10-12 18:15:17', 'B1562SK', 'Joni', 2, '', '', 'hari', '2022-10-12 12:01:04', NULL, NULL, 'Y', NULL),
	(4, 5, 'test_admin', 1, '2022-10-12 14:18:00', NULL, NULL, '2022-10-13 14:18:00', 'test', 'test driver', 7, 'test container', 'test seal', 'test_admin', '2022-10-12 14:53:16', NULL, NULL, NULL, NULL),
	(9, 8, 'test_staff', NULL, '2022-10-27 12:30:00', '2022-10-27 12:30:00', '2022-10-28 16:16:00', '2022-10-28 16:16:00', 't123s', 'drv_mobil_1', 1, 'cont_mobil_1', 'seal_mobil_1', 'test_staff', '2022-10-26 11:38:30', 'test_staff', '2022-10-27 11:12:45', 'Y', NULL),
	(10, 8, 'test_staff', NULL, '2022-10-27 12:30:00', '2022-10-27 12:30:00', '2022-10-29 15:16:00', '2022-10-29 15:16:00', 't321s', 'drv_mobil_2', 7, 'cont_mobil_2', 'seal_mobil_2', 'test_staff', '2022-10-26 11:38:30', 'test_staff', '2022-10-27 11:12:45', 'Y', NULL),
	(11, 8, 'test_staff', NULL, '2022-10-28 11:01:00', '2022-10-28 11:01:00', '2022-10-29 11:12:00', '2022-10-27 11:12:00', 't333s', 'drv_mobil_3', 2, 'cont_mobil_3', 'seal_mobil_3', 'test_staff', '2022-10-27 11:03:15', 'test_staff', '2022-10-27 11:12:45', 'Y', NULL),
	(12, 9, 'test_admin', NULL, '2022-10-28 15:30:00', '2022-10-28 15:35:00', '2022-11-03 12:40:00', '2022-11-03 12:40:00', 'test_2810', 'test', 1, '2810', '123', 'test_admin', '2022-10-28 15:13:07', 'test_admin', '2022-11-03 12:40:44', 'Y', NULL),
	(13, 11, 'test_staff', NULL, '2022-11-01 11:07:00', '2022-11-01 11:07:00', '2022-11-02 11:07:00', '2022-11-02 11:07:00', 't333s', 'test', 1, '123', '321', 'test_staff', '2022-11-01 11:07:37', 'test_staff', '2022-11-01 11:07:52', 'Y', NULL);
/*!40000 ALTER TABLE `t_wh_transportation_2` ENABLE KEYS */;

-- Dumping structure for table wms.t_wh_user
DROP TABLE IF EXISTS `t_wh_user`;
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
  PRIMARY KEY (`username`,`user_level_id`,`wh_id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='master user warehouse';

-- Dumping data for table wms.t_wh_user: 2 rows
/*!40000 ALTER TABLE `t_wh_user` DISABLE KEYS */;
INSERT INTO `t_wh_user` (`username`, `user_level_id`, `fullname`, `password`, `wh_id`, `email`, `phone`, `send_email`, `created_by`, `created_on`, `last_login`, `use_hht`, `is_active`, `is_deleted`, `is_android`, `is_web`, `remember_token`, `user_group_id`) VALUES
	('superadmin', 5, 'Super Admin', '$2a$10$ILnXIj7eQK8lSFjUgXDsGuYOjCzCUACRW.tRbguR2cpy.AMmBcvka', 1, NULL, NULL, 'Y', 'mariofrans', '2023-03-20 10:51:54', NULL, NULL, 'Y', NULL, 'Y', 'Y', NULL, 1),
	('whsman01', 3, 'whs man', '$2y$10$seIsBCoStzb/YWNukZC9F.dHr8kvSPAif.vHPt2bOK9RJg5NfYvmK', 1, 'whsman01@test.com', '081111111', 'Y', 'superadmin', '2024-08-26 10:30:36', NULL, NULL, 'Y', NULL, 'Y', 'Y', NULL, NULL);
/*!40000 ALTER TABLE `t_wh_user` ENABLE KEYS */;

-- Dumping structure for table wms.users
DROP TABLE IF EXISTS `users`;
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
