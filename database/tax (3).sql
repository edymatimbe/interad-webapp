-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 08:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tax`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  `nib` varchar(100) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `owner` varchar(45) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `code` varchar(10) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `video_duration` text DEFAULT NULL,
  `area_location` decimal(16,2) NOT NULL,
  `coordinates` varchar(255) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `link`, `description`, `image`, `title`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `code`, `company_id`, `type`, `path`, `video_duration`, `area_location`, `coordinates`, `customer_id`) VALUES
(1, NULL, '', NULL, 'test1', '2024-04-03 10:42:53', '2024-04-03 10:42:53', 4, 4, 1, '0001', NULL, 'video/mp4', 'upload/Coca-Cola®_Obra_de_Arte1.mp4', '00 : 30', '8419.65', '(-25.34916813521957, 32.480128918637796)', 4),
(2, NULL, '', NULL, 'Chocolate', '2024-04-03 10:54:59', '2024-04-03 10:54:59', 4, 4, 1, '0002', NULL, 'video/mp4', 'upload/The_Gucci_Aria_Advertising_Campaign.mp4', '01 : 27', '3205.30', '(37.78456015495154, -122.45560553645305)', 4),
(3, NULL, '', NULL, 'Cinematic', '2024-04-03 11:07:15', '2024-04-03 11:07:15', 4, 4, 1, '0003', NULL, 'video/mp4', 'upload/Coca-Cola_-_4K_Commercial_-_Product_Video.mp4', '00 : 17', '4132.55', '(37.76453292667618, -122.43260291194133)', 4),
(4, NULL, '', NULL, 'Choco', '2024-04-03 11:09:44', '2024-04-03 11:09:44', 4, 4, 1, '0004', NULL, 'video/webm', 'upload/CHOCOLATE_(4K).webm', '00 : 17', '3244.43', '(37.756661664289524, -122.42333319758586)', 4),
(5, NULL, '', NULL, 'gucci', '2024-04-03 11:16:12', '2024-04-03 11:16:12', 4, 4, 1, '0005', NULL, 'video/mp4', 'upload/The_Gucci_Aria_Advertising_Campaign1.mp4', '01 : 27', '4646.59', '(37.78705639294919, -122.44358924006633)', 4),
(6, NULL, 'ssssssssss', NULL, 'Camanha text', '2024-04-04 12:42:25', '2024-04-04 12:42:25', 4, 4, 1, '0006', NULL, 'video/mp4', 'upload/Coca-Cola®_Obra_de_Arte2.mp4', '00 : 30', '3614.49', '(-25.934549943239233, 32.57951612586253)', 4);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `code`, `active`, `company_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', NULL, 1, NULL, 2, 2, '2024-04-04 14:44:13', '2024-04-04 14:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `is_service` tinyint(1) DEFAULT 0,
  `in_invoice` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `code`, `parent_id`, `active`, `created_at`, `created_by`, `updated_by`, `company_id`, `updated_at`, `is_service`, `in_invoice`) VALUES
(1, 'Corola', NULL, NULL, NULL, 1, '2024-04-04 14:44:24', 2, 2, NULL, '2024-04-04 14:44:24', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `nuit` varchar(20) DEFAULT NULL,
  `slogan` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `time_in_saturday` time DEFAULT NULL,
  `time_out_saturday` time DEFAULT NULL,
  `interval_begin` time DEFAULT NULL,
  `interval_end` time DEFAULT NULL,
  `working_days` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `currency_decimals` int(11) DEFAULT 2,
  `currency_dec_point` char(1) DEFAULT ',',
  `currency_thousand_sep` char(1) DEFAULT '.',
  `currency_code` char(3) DEFAULT 'MZN',
  `currency_code_position` enum('start','end') DEFAULT 'end',
  `show_currency` tinyint(1) DEFAULT 0,
  `show_currency_code_symbol` enum('code','symbol') DEFAULT 'symbol',
  `irps_min_salary` decimal(16,2) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `notification_stock_min` text NOT NULL,
  `language` text NOT NULL,
  `message_error` text NOT NULL,
  `message_warning` text NOT NULL,
  `message_success` text NOT NULL,
  `notification_product_due_date` text NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `invoice_note` text NOT NULL,
  `state_region` varchar(50) NOT NULL,
  `resposible_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `address`, `phone`, `phone2`, `telephone`, `name`, `nuit`, `slogan`, `email`, `country`, `province_id`, `city`, `image`, `time_in`, `time_out`, `time_in_saturday`, `time_out_saturday`, `interval_begin`, `interval_end`, `working_days`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `currency_decimals`, `currency_dec_point`, `currency_thousand_sep`, `currency_code`, `currency_code_position`, `show_currency`, `show_currency_code_symbol`, `irps_min_salary`, `company_id`, `notification_stock_min`, `language`, `message_error`, `message_warning`, `message_success`, `notification_product_due_date`, `site_url`, `invoice_note`, `state_region`, `resposible_id`, `password`, `first_name`, `last_name`) VALUES
(1, 'Av. ', '8400000000', '', '', 'FORTY ONE BUSINESS CENTER', '4000000000', 'Ok', 'info@41bc.co.mz', 1, 6, 'Maputo', 'companies/FORTY_ONE_BUSINESS_CENTER/logo.jpg', '08:30:00', '17:30:00', '09:00:00', '13:00:00', '13:00:00', '14:00:00', '[{\"id\":\"1\"},{\"id\":\"2\"},{\"id\":\"3\"},{\"id\":\"4\"},{\"id\":\"5\"},{\"id\":\"6\"}]', 1, 1, 1, '2021-07-30 11:03:46', '2023-11-22 10:49:30', 2, ',', '.', 'MZN', 'end', 1, 'symbol', '22000.00', 1, '\"[{\\\"color\\\":\\\"danger\\\",\\\"from\\\":\\\"top\\\",\\\"align\\\":\\\"center\\\"}]\"', '', '', 'bottom-start', 'center', '', '', '', 'Sul', 1, 'd41d8cd98f00b204e9800998ecf8427e', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE `controller` (
  `id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `count_tax` int(20) NOT NULL,
  `multiplier` decimal(16,2) NOT NULL,
  `periodicity` int(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `banner_id` int(10) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `cost` decimal(16,2) NOT NULL,
  `status` enum('pago','pendente','expirou') NOT NULL DEFAULT 'pendente',
  `init_date` date NOT NULL,
  `final_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id`, `code`, `count_tax`, `multiplier`, `periodicity`, `active`, `company_id`, `banner_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `cost`, `status`, `init_date`, `final_date`) VALUES
(1, '0001', 1, '200.00', 7, 1, NULL, 1, NULL, NULL, '2024-04-03 12:42:54', '2024-04-03 12:42:54', '700.00', 'pendente', '2024-04-03', '2024-04-10'),
(2, '0002', 1, '200.00', 8, 1, NULL, 2, NULL, NULL, '2024-04-03 12:54:59', '2024-04-03 12:54:59', '448.00', 'pendente', '2024-04-03', '2024-04-11'),
(3, '0003', 1, '200.00', 8, 1, NULL, 3, NULL, NULL, '2024-04-03 13:07:15', '2024-04-03 13:07:15', '448.00', 'pago', '2024-04-03', '2024-04-11'),
(4, '0004', 1, '200.00', 8, 1, NULL, 4, NULL, NULL, '2024-04-03 13:09:44', '2024-04-03 13:09:44', '448.00', 'expirou', '2024-04-03', '2024-04-11'),
(5, '0005', 1, '200.00', 8, 1, NULL, 5, NULL, NULL, '2024-04-03 13:16:12', '2024-04-03 13:16:12', '2320.00', 'expirou', '2024-04-03', '2024-04-11'),
(6, '0006', 3, '200.00', 7, 1, NULL, 6, NULL, NULL, '2024-04-04 14:42:25', '2024-04-04 14:42:25', '2100.00', 'pendente', '2024-04-04', '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `controller_tax`
--

CREATE TABLE `controller_tax` (
  `id` int(10) NOT NULL,
  `controller_id` int(10) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company_id` int(10) DEFAULT NULL,
  `views` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `controller_tax`
--

INSERT INTO `controller_tax` (`id`, `controller_id`, `tax_id`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`, `views`) VALUES
(1, 6, 1, 1, NULL, NULL, '2024-04-05 08:17:24', '2024-04-05 09:20:11', NULL, 1),
(2, 1, 1, 1, NULL, NULL, '2024-04-05 08:17:42', '2024-04-05 09:11:12', NULL, 8),
(3, 2, 1, 1, NULL, NULL, '2024-04-05 08:18:17', '2024-04-05 09:11:43', NULL, 4),
(4, 3, 1, 1, NULL, NULL, '2024-04-05 08:23:46', '2024-04-05 08:56:44', NULL, 2),
(5, 4, 1, 1, NULL, NULL, '2024-04-05 08:26:05', '2024-04-05 08:57:02', NULL, 2),
(6, 5, 1, 1, NULL, NULL, '2024-04-05 08:26:43', '2024-04-05 08:57:19', NULL, 2),
(7, 3, NULL, 1, NULL, NULL, '2024-04-05 13:46:00', '2024-04-05 13:46:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `name` varchar(20) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`name`, `code`, `symbol`) VALUES
('Leke', 'ALL', 'Lek'),
('Dollars', 'USD', '$'),
('Afghanis', 'AFN', '؋'),
('Pesos', 'ARS', '$'),
('Guilders', 'AWG', 'ƒ'),
('Dollars', 'AUD', '$'),
('New Manats', 'AZN', 'ман'),
('Dollars', 'BSD', '$'),
('Dollars', 'BBD', '$'),
('Rubles', 'BYR', 'p.'),
('Euro', 'EUR', '€'),
('Dollars', 'BZD', 'BZ$'),
('Dollars', 'BMD', '$'),
('Bolivianos', 'BOB', '$b'),
('Convertible Marka', 'BAM', 'KM'),
('Pula', 'BWP', 'P'),
('Leva', 'BGN', 'лв'),
('Reais', 'BRL', 'R$'),
('Pounds', 'GBP', '£'),
('Dollars', 'BND', '$'),
('Riels', 'KHR', '៛'),
('Dollars', 'CAD', '$'),
('Dollars', 'KYD', '$'),
('Pesos', 'CLP', '$'),
('Yuan Renminbi', 'CNY', '¥'),
('Pesos', 'COP', '$'),
('Colón', 'CRC', '₡'),
('Kuna', 'HRK', 'kn'),
('Pesos', 'CUP', '₱'),
('Koruny', 'CZK', 'Kč'),
('Kroner', 'DKK', 'kr'),
('Pesos', 'DOP', 'RD$'),
('Dollars', 'XCD', '$'),
('Pounds', 'EGP', '£'),
('Colones', 'SVC', '$'),
('Pounds', 'FKP', '£'),
('Dollars', 'FJD', '$'),
('Cedis', 'GHC', '¢'),
('Pounds', 'GIP', '£'),
('Quetzales', 'GTQ', 'Q'),
('Pounds', 'GGP', '£'),
('Dollars', 'GYD', '$'),
('Lempiras', 'HNL', 'L'),
('Dollars', 'HKD', '$'),
('Forint', 'HUF', 'Ft'),
('Kronur', 'ISK', 'kr'),
('Rupees', 'INR', 'Rp'),
('Rupiahs', 'IDR', 'Rp'),
('Rials', 'IRR', '﷼'),
('Pounds', 'IMP', '£'),
('New Shekels', 'ILS', '₪'),
('Dollars', 'JMD', 'J$'),
('Yen', 'JPY', '¥'),
('Pounds', 'JEP', '£'),
('Tenge', 'KZT', 'лв'),
('Won', 'KPW', '₩'),
('Won', 'KRW', '₩'),
('Soms', 'KGS', 'лв'),
('Kips', 'LAK', '₭'),
('Lati', 'LVL', 'Ls'),
('Pounds', 'LBP', '£'),
('Dollars', 'LRD', '$'),
('Switzerland Francs', 'CHF', 'CHF'),
('Litai', 'LTL', 'Lt'),
('Denars', 'MKD', 'ден'),
('Ringgits', 'MYR', 'RM'),
('Rupees', 'MUR', '₨'),
('Pesos', 'MXN', '$'),
('Tugriks', 'MNT', '₮'),
('Meticais', 'MZN', 'MT'),
('Dollars', 'NAD', '$'),
('Rupees', 'NPR', '₨'),
('Guilders', 'ANG', 'ƒ'),
('Dollars', 'NZD', '$'),
('Cordobas', 'NIO', 'C$'),
('Nairas', 'NGN', '₦'),
('Krone', 'NOK', 'kr'),
('Rials', 'OMR', '﷼'),
('Rupees', 'PKR', '₨'),
('Balboa', 'PAB', 'B/.'),
('Guarani', 'PYG', 'Gs'),
('Nuevos Soles', 'PEN', 'S/.'),
('Pesos', 'PHP', 'Php'),
('Zlotych', 'PLN', 'zł'),
('Rials', 'QAR', '﷼'),
('New Lei', 'RON', 'lei'),
('Rubles', 'RUB', 'руб'),
('Pounds', 'SHP', '£'),
('Riyals', 'SAR', '﷼'),
('Dinars', 'RSD', 'Дин.'),
('Rupees', 'SCR', '₨'),
('Dollars', 'SGD', '$'),
('Dollars', 'SBD', '$'),
('Shillings', 'SOS', 'S'),
('Rand', 'ZAR', 'R'),
('Rupees', 'LKR', '₨'),
('Kronor', 'SEK', 'kr'),
('Dollars', 'SRD', '$'),
('Pounds', 'SYP', '£'),
('New Dollars', 'TWD', 'NT$'),
('Baht', 'THB', '฿'),
('Dollars', 'TTD', 'TT$'),
('Lira', 'TRY', '₺'),
('Liras', 'TRL', '£'),
('Dollars', 'TVD', '$'),
('Hryvnia', 'UAH', '₴'),
('Pesos', 'UYU', '$U'),
('Sums', 'UZS', 'лв'),
('Bolivares Fuertes', 'VEF', 'Bs'),
('Dong', 'VND', '₫'),
('Rials', 'YER', '﷼'),
('Zimbabwe Dollars', 'ZWD', 'Z$'),
('Rupees', 'INR', '₹');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nuit` varchar(45) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `type` enum('pessoa','empresa') NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `responsible_name` varchar(45) DEFAULT NULL,
  `responsible_id` varchar(45) DEFAULT NULL,
  `responsible_office` varchar(45) DEFAULT NULL,
  `registration_number` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `active` tinyint(1) DEFAULT 1,
  `image` varchar(100) DEFAULT NULL,
  `credit` int(2) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `period_pay` int(11) DEFAULT 0,
  `max_credit` decimal(16,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_group_batch`
--

CREATE TABLE `customer_group_batch` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `id` int(11) NOT NULL,
  `merchandise_type` varchar(150) DEFAULT NULL,
  `regime` varchar(50) DEFAULT NULL,
  `transport` varchar(50) DEFAULT NULL,
  `other_reference` varchar(150) DEFAULT NULL,
  `waybill` varchar(150) DEFAULT NULL,
  `supplier` varchar(200) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `invoice_number` varchar(20) DEFAULT NULL,
  `fob` decimal(16,2) DEFAULT NULL,
  `cif` decimal(16,2) DEFAULT NULL,
  `fret_insurance` decimal(16,2) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `transport_doc` varchar(50) DEFAULT NULL,
  `terminal` varchar(100) DEFAULT NULL,
  `exchange` decimal(16,2) DEFAULT NULL,
  `cif_mt` decimal(16,2) DEFAULT NULL,
  `du` varchar(50) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_note`
--

CREATE TABLE `delivery_note` (
  `id` int(11) NOT NULL,
  `fatura_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `province_id`, `company_id`) VALUES
(1, 'Ancuabe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(2, 'Balama', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(3, 'Chiúre', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(4, 'Ibo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(5, 'Macomia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(6, 'Mecúfi', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(7, 'Meluco', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(8, 'Mocímboa da Praia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(9, 'Montepuez', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(10, 'Mueda', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(11, 'Muidumbe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(12, 'Namuno', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(13, 'Nangade', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(14, 'Palma', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(15, 'Pemba-Metuge', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(16, 'Quissanga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(17, 'Distrito Urbano de Nlhamankulu', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(18, 'Distrito Urbano de KaMaxaquene', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(19, 'Distrito Urbano de KaMavota', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(20, 'Distrito Municipal de KaMubukwane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(21, 'Distrito Municipal de KaTembe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(22, 'Distrito Municipal de KaNyaka', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(23, 'Bilene Macia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(24, 'Chibuto', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(25, 'Chicualacuala', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(26, 'Chigubo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(27, 'Chókwè', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(28, 'Guijá', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(29, 'Mabalane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(30, 'Manjacaze', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(31, 'Massangena', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(32, 'Massingir', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(33, 'Xai-Xai', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 3, 1),
(34, 'Funhalouro', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(35, 'Govuro', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(36, 'Homoíne', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(37, 'Inharrime', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(38, 'Inhassoro', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(39, 'Jangamo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(40, 'Mabote', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(41, 'Massinga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(42, 'Cidade de Maxixe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(43, 'Morrumbene', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(44, 'Panda', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(45, 'Vilanculos', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(46, 'Zavala', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(47, 'Bárue', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(48, 'Cidade de  Chimoio', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(49, 'Gondola', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(50, 'Macate', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(51, '[[Vanduzi (distrito)|Vanduzi]', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(52, 'Guro', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(53, 'Mossurize', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(54, 'Machaze', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(55, 'Macossa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(56, 'Manica', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(57, 'Vanduzi', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(58, 'Sussundenga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(59, 'Tambara', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 5, 1),
(60, 'Matola', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(61, 'Boane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(62, 'Magude', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(63, 'Manhiça', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(64, 'Marracuene', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(65, 'Matutuíne', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(66, 'Moamba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(67, 'Namaacha', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 6, 1),
(68, 'Cidade de Nampula', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(69, 'Angoche', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(70, 'Eráti', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(71, 'Ilha de Mocambique', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(72, 'Lalaua', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(73, 'Malema', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(74, 'Meconta', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(75, 'Mecubúri', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(76, 'Memba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(77, 'Mogincual', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(78, 'Mogovolas', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(79, 'Moma', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(80, 'Monapo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(81, 'Mossuril', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(82, 'Muecate', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(83, 'Murrupula', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(84, 'Cidade de Nacala Porto', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(85, 'Nacala-a-Velha', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(86, 'Nacarôa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(87, 'Rapale', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(88, 'Ribaué', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 7, 1),
(89, 'Cuamba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(90, 'Lago', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(91, 'Lichinga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(92, 'Majune', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(93, 'Mandimba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(94, 'Marrupa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(95, 'Maúa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(96, 'Mavago', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(97, 'Mecanhelas', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(98, 'Mecula', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(99, 'Metarica', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(100, 'Muembe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(101, 'N\'gauma', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(102, 'Nipepe', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(103, 'Sanga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1),
(104, 'Cidade de  Beira', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(105, 'Búzi', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(106, 'Caia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(107, 'Chemba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(108, 'Cheringoma', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(109, 'Chibabava', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(110, 'Dondo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(111, 'Gorongosa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(112, 'Machanga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(113, 'Maringué', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(114, 'Marromeu', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(115, 'Muanza', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(116, 'Nhamatanda', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 9, 1),
(117, 'Angónia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(118, 'Cahora-Bassa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(119, 'Changara', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(120, 'Chifunde', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(121, 'Chiuta', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(122, 'Macanga', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(123, 'Magoé', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(124, 'Marávia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(125, 'Moatize', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(126, 'Mutarara', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(127, 'Tsangano', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(128, 'Zumbo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 10, 1),
(129, 'Alto Molócue', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(130, 'Chinde', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(131, 'Gilé', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(132, 'Gurué', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(133, 'Ile', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(134, 'Inhassunge', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(135, 'Lugela', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(136, 'Maganja da Costa', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(137, 'Milange', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(138, 'Mocuba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(139, 'Mopeia', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(140, 'Morrumbala', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(141, 'Namacurra', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(142, 'Namarroi', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(143, 'Nicoadala', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(144, 'Pebane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(145, 'Teste D', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(146, 'Distrito KaMpfumo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 2, 1),
(147, 'Pemba', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 1, 1),
(148, 'Cidade de Inhambane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 4, 1),
(150, 'Quelimane', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(151, 'Luabo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(152, 'Derre', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(153, 'Mulevala', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(154, 'Mocubela', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(155, 'Molumbo', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 11, 1),
(156, 'Chimbunila', 1, '2022-04-21 13:00:34', '2022-04-21 13:00:34', 1, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `issued_in` varchar(100) DEFAULT NULL,
  `issued_at` date DEFAULT NULL,
  `expiry_at` date DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `employee_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `note` longtext DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `character` int(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`, `company_id`) VALUES
(1, 'super admin', 'Super admin', 1, '2023-11-22 12:17:37', 1, '2023-11-22 12:16:46', 1, 1),
(2, 'admin', 'admin', 1, '2023-11-22 12:18:26', NULL, '2023-11-22 12:18:26', NULL, 1),
(3, 'Clientes', 'Clientes', 1, '2024-03-15 11:00:20', NULL, '2024-03-15 11:00:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `controller_tax_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `reason_note` text DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `is_service` tinyint(1) DEFAULT 1,
  `number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `note_product`
--

CREATE TABLE `note_product` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(16,2) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `note_reason`
--

CREATE TABLE `note_reason` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `in_select` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `icon`, `parent_id`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `in_select`) VALUES
(1, 'Numerário', NULL, NULL, 0, 1, 1, '2021-02-01 09:13:13', '2021-02-01 09:13:13', 1),
(2, 'Banco', 'fa fa-bank fa-2x', NULL, 0, 1, 1, '2021-02-01 09:13:13', '2021-02-01 09:13:13', 0),
(3, 'Cheque', 'fa fa-money-check fa-2x ', 2, 1, 1, 1, '2021-02-08 20:31:14', '2021-02-08 20:31:14', 1),
(4, 'Celular', NULL, NULL, 1, 1, 1, '2021-02-08 20:55:44', '2021-02-08 20:55:44', 0),
(5, 'Cartão de crédito', 'fa fa-credit-card fa-2x ', 2, 0, 1, 1, '2021-02-08 21:01:55', '2021-02-08 21:01:55', 0),
(6, 'Cartão de Débito', 'fa fa-credit-card fa-2x ', 2, 0, 1, 1, '2021-02-08 21:01:55', '2021-02-08 21:01:55', 0),
(7, 'Cartão Ponto-24', 'fa fa-credit-card fa-2x ', 2, 0, 1, 1, '2021-02-08 21:01:55', '2021-02-08 21:01:55', 0),
(8, 'M-Pesa', NULL, 4, 1, 1, 1, '2021-02-08 21:03:56', '2021-02-08 21:03:56', 1),
(9, 'M-Kesh', NULL, 4, 0, 1, 1, '2021-02-08 21:03:56', '2021-02-08 21:03:56', 0),
(10, 'E-Mola', NULL, 4, 0, 1, 1, '2021-02-08 21:03:56', '2021-02-08 21:03:56', 0),
(11, 'Conta Móvel', 'feather icon-phone', 4, 1, 1, 1, '2021-05-28 09:49:24', '2021-05-28 09:49:24', 1),
(12, 'Transferência', NULL, 2, 1, 1, 1, '2021-05-28 13:19:20', '2021-05-28 13:19:20', 1),
(13, 'POS', NULL, 2, 1, 1, 1, '2021-08-31 10:04:12', '2021-08-31 10:04:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `position`, `company_id`) VALUES
(1, 'Cabo Delgado', 10, 1),
(2, 'Cidade de Maputo', 1, 1),
(3, 'Gaza', 3, 1),
(4, 'Inhambane', 4, 1),
(5, 'Manica', 6, 1),
(6, 'Maputo', 2, 1),
(7, 'Nampula', 9, 1),
(8, 'Niassa', 11, 1),
(9, 'Sofala', 5, 1),
(10, 'Tete', 7, 1),
(11, 'Zambézia', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(13, 'access_management_create'),
(14, 'access_management_read'),
(15, 'access_management_update'),
(4, 'banner_create'),
(5, 'banner_read'),
(6, 'banner_update'),
(7, 'config_create'),
(8, 'config_read'),
(9, 'config_update'),
(1, 'tax_create'),
(2, 'tax_read'),
(3, 'tax_update'),
(10, 'user_create'),
(11, 'user_read'),
(12, 'user_update');

-- --------------------------------------------------------

--
-- Table structure for table `role_group`
--

CREATE TABLE `role_group` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_group`
--

INSERT INTO `role_group` (`id`, `role_id`, `group_id`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `company_id`) VALUES
(1, 1, 2, 1, 1, 1, '2023-11-22 12:21:30', '2023-11-22 11:21:30', 1),
(2, 2, 2, 1, 1, 1, '2023-11-22 12:21:32', '2023-11-22 11:21:32', 1),
(3, 3, 2, 1, 1, 1, '2023-11-22 12:21:33', '2023-11-22 11:21:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `is_bank` tinyint(1) DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `active`, `is_bank`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BCI', 1, 1, 1, 1, '2021-08-03 16:17:37', '2021-09-14 07:12:37'),
(2, 'Millenium BIM', 1, 1, 1, 1, '2021-08-06 07:59:43', '2021-09-14 07:13:57'),
(3, 'M-Pesa', 1, 0, 1, 1, '2021-08-07 07:22:56', '2021-08-07 07:22:56'),
(4, 'M-Kesh', 1, 0, 1, 1, '2021-08-07 07:36:20', '2021-08-07 07:36:20'),
(5, 'E-Mola', 0, 0, 1, 4, '2021-08-07 07:37:15', '2022-02-08 15:14:01'),
(6, 'Standar bank', 1, 1, 1, 1, '2021-09-14 07:14:25', '2021-09-14 07:14:25'),
(7, 'Banco ABCS', 1, 1, 1, 1, '2021-09-14 07:15:51', '2021-09-14 07:16:01'),
(8, 'Conta Móvel', 1, 0, 3, 3, '2021-08-31 21:02:32', '2021-08-31 21:02:32'),
(9, 'NEDBANK', 1, 1, 3, 3, '2021-08-31 21:06:38', '2021-08-31 21:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `nuit` varchar(20) DEFAULT NULL,
  `slogan` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `time_in_saturday` time DEFAULT NULL,
  `time_out_saturday` time DEFAULT NULL,
  `interval_begin` time DEFAULT NULL,
  `interval_end` time DEFAULT NULL,
  `working_days` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `currency_decimals` int(11) DEFAULT 2,
  `currency_dec_point` char(1) DEFAULT ',',
  `currency_thousand_sep` char(1) DEFAULT '.',
  `currency_code` char(3) DEFAULT 'MZN',
  `currency_code_position` enum('start','end') DEFAULT 'end',
  `show_currency` tinyint(1) DEFAULT 0,
  `show_currency_code_symbol` enum('code','symbol') DEFAULT 'symbol',
  `irps_min_salary` decimal(16,2) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `notification_stock_min` text NOT NULL,
  `language` text NOT NULL,
  `message_error` text NOT NULL,
  `message_warning` text NOT NULL,
  `message_success` text NOT NULL,
  `notification_product_due_date` text NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `invoice_note` text NOT NULL,
  `state_region` varchar(50) NOT NULL,
  `resposible_id` int(11) NOT NULL,
  `multiplier` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `address`, `phone`, `phone2`, `telephone`, `name`, `nuit`, `slogan`, `email`, `country`, `province_id`, `city`, `image`, `time_in`, `time_out`, `time_in_saturday`, `time_out_saturday`, `interval_begin`, `interval_end`, `working_days`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `currency_decimals`, `currency_dec_point`, `currency_thousand_sep`, `currency_code`, `currency_code_position`, `show_currency`, `show_currency_code_symbol`, `irps_min_salary`, `company_id`, `notification_stock_min`, `language`, `message_error`, `message_warning`, `message_success`, `notification_product_due_date`, `site_url`, `invoice_note`, `state_region`, `resposible_id`, `multiplier`) VALUES
(1, 'Av. Eduardo Mondlane', '444444444', '444444444', NULL, 'gffffffff', '444444444', 'Ok', 'shivaenterprise@info.co.mz', 1, 6, 'Maputo', 'public/img/logo/logo_db.png', '08:31:00', '17:30:00', '09:00:00', '13:00:00', '13:00:00', '14:00:00', '[{\"id\":\"1\"},{\"id\":\"2\"},{\"id\":\"3\"},{\"id\":\"4\"},{\"id\":\"5\"},{\"id\":\"6\"}]', 1, 1, 2, '2021-07-30 11:03:46', '2022-02-08 03:45:35', 3, ',', '.', 'MZN', 'end', 1, 'symbol', '12.00', 0, '\"[{\\\"color\\\":\\\"primary\\\",\\\"from\\\":\\\"top\\\",\\\"align\\\":\\\"center\\\"}]\"', 'en', 'center', 'center', 'center-start', '', '', '', '', 0, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `subsidy`
--

CREATE TABLE `subsidy` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nuit` varchar(45) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `type` enum('pessoa','empresa') NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `responsible_name` varchar(45) DEFAULT NULL,
  `responsible_id` varchar(45) DEFAULT NULL,
  `responsible_office` varchar(45) DEFAULT NULL,
  `registration_number` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_group`
--

CREATE TABLE `supplier_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `is_service` tinyint(1) DEFAULT 0,
  `has_tax` tinyint(1) DEFAULT 0,
  `price` decimal(16,2) DEFAULT NULL,
  `registration` varchar(20) NOT NULL,
  `access_code` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `image`, `name`, `category_id`, `brand_id`, `description`, `barcode`, `sku`, `active`, `company_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `is_service`, `has_tax`, `price`, `registration`, `access_code`, `code`) VALUES
(1, NULL, 'Florencio', 1, 1, '', '', NULL, 1, NULL, 2, 2, '2024-04-04 14:44:40', '2024-04-04 14:44:40', 0, 0, NULL, 'mLY 92 55', '25f9e794323b453885f5181f1b624d0b', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit_measurement`
--

CREATE TABLE `unit_measurement` (
  `id` int(11) NOT NULL,
  `description` varchar(80) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_measurement`
--

INSERT INTO `unit_measurement` (`id`, `description`, `unit`, `company_id`) VALUES
(1, 'Quilowatt', 'Kw', 1),
(2, 'volume', 'm3', 1),
(3, 'unidade', 'unidade', 1),
(4, 'Quilograma', 'Kg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `nuit` varchar(12) DEFAULT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `created_at`, `updated_at`, `updated_by`, `created_by`, `nuit`, `phone2`, `address`, `image`, `note`, `city`, `position`, `company_id`, `description`) VALUES
(1, '', '41bc', '$2y$10$ymhnvzgfqRwSTBZDhPZGhORuZsaQ50NSbLk6WSqfOrSCzwGoBAQd.', '41@bc.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1626, 1712237479, 1, '41', 'Business Center', 'Green Revolution', '8752521556', '2021-07-14 12:25:39', '2021-07-14 12:25:39', 1, NULL, '', '', 'Av. Agostinho neto', NULL, '', '', '', 1, ''),
(2, '::1', 'admin', '$2y$12$oUUX1CbSA.9FGPMxE9XbI.5mj9UeMZIDMRs.8xcB4N0Pbo8E9jRtm', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1642499142, 1712325692, 1,'41', 'Business Center',  '41Business Center', '8752521556', '2022-01-18 11:45:42', '2022-01-18 11:45:42', 1, 1, '111111', '8752521556', 'Rua Amizade', NULL, '', 'Maputo', 'Software Manager', 1, ''),
(3, '197.249.254.12', 'edy', '$2y$12$/u4pyh2RFLhGK7zUOZ5BLukYyASheI1F.P9qgV/dkkt8Bfm/1zBRi', 'comercial@amyndm.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1698053087, 1698155807, 1, 'Edy', 'Matimbe', NULL, '872877088', '2023-10-23 03:24:47', '2023-10-23 03:24:47', 1, 1, '', '', '', NULL, '', '', '', 1, ''),
(4, '::1', 'filip', '$2y$10$8jN7PHJxPOeZ6yvR0DIxVuQoZ7dnrl3CYB13IenXaTcMQFPmbbsRS', 'neveswutang@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1710495289, 1712305515, 1, 'Cau', 'Florencio', 'Mr Cau', '877788001', '2024-03-15 11:34:49', '2024-03-15 11:34:49', NULL, NULL, '1422201122', '85666621', 'laulane', NULL, NULL, NULL, NULL, 1, ''),
(5, '192.168.43.114', 'Milton33', '$2y$10$ZLQTMrzMlvoL1FNZnNdPPeKa8F/Io4HOLvBRQMdQhfCqJyFlP3Ooq', 'miltonchiluane33@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1710497077, 1712302041, 1, 'MILTON', 'CHILUVANE', 'Electro Muhlengwe', '+258842788001', '2024-03-15 12:04:37', '2024-03-15 12:04:37', 2, NULL, '', '+258877788001', '', NULL, '', '', '', NULL, ''),
(6, '::1', 'jorge', '$2y$10$tpMI3T1VjBGgYl/0HKGP4.2n1FwhalopMqFxzUMFcy4flSdSDCdOG', 'jorge@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1711458066, NULL, 1, 'Jorge', 'Jorge', '41BC', '8400000000', '2024-03-26 15:01:06', '2024-03-26 15:01:06', NULL, NULL, NULL, '84200000', NULL, NULL, NULL, NULL, NULL, 1, ''),
(7, '192.168.43.117', 'Edy33', '$2y$10$RjR4OZOBa1OTFO3DMy.cQewrqmhqJ9nREUtE3O13yvDhptMgIK1Hy', 'electro@41bc.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1712138389, NULL, 1, 'Edy', 'Matimbe', '41BC', '65465465', '2024-04-03 11:59:49', '2024-04-03 11:59:49', NULL, NULL, '158273', '45465465', 'Rua da Amizade nº 41 RC, Maputo', NULL, NULL, NULL, NULL, 1, ''),
(8, '192.168.43.117', 'Edy33m', '$2y$10$GtC0B.EW.JU29AT83l8cv.h3dzDduL56YLnPEY4Hx2fFfKClN96X.', 'miltonchiane33@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1712138813, NULL, 1, 'Edy', 'Matimbe', '41BC', '65465465', '2024-04-03 12:06:53', '2024-04-03 12:06:53', NULL, NULL, '158273', '45465465', 'Rua da Amizade nº 41 RC, Maputo', NULL, NULL, NULL, NULL, 1, ''),
(9, '192.168.43.117', 'wutang', '$2y$10$2Vg9sEuy6GVvUdHUqZE4Duh89t9KgUX4x0GOzNwBtJ./bIAPQlh3y', 'miltonchiluvane33@gmail.co', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1712139618, NULL, 1, 'Edy', 'Matimbe', '41BC', '65465465', '2024-04-03 12:20:18', '2024-04-03 12:20:18', NULL, NULL, '158273', '45465465', 'Rua da Amizade nº 41 RC, Maputo', NULL, NULL, NULL, NULL, 1, ''),
(10, '192.168.43.117', 'wutang33', '$2y$10$R.COX/VASHL0vwr/YJcRZ.rTTruG1QcVQdztRkGu/9j046FglFYKC', 'miltonchiluvane33@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1712139858, NULL, 1, 'Edy', 'Matimbe', '41BC', '65465465', '2024-04-03 12:24:19', '2024-04-03 12:24:19', NULL, NULL, '158273', '45465465', 'Rua da Amizade nº 41 RC, Maputo', NULL, NULL, NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`, `active`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 2, 1),
(4, 4, 3, 1),
(5, 5, 3, 1),
(6, 6, 3, 1),
(7, 7, 3, 1),
(8, 8, 3, 1),
(9, 9, 3, 1),
(10, 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `name`, `active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `district_id`, `company_id`) VALUES
(1, 'Aeroporto A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(2, 'Aeroporto B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(3, 'Xipamanine', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(4, 'Minkadjuíne', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(5, 'Unidade 7', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(6, 'Chamanculo A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(7, 'Chamanculo B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(8, 'Chamanculo C', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(9, 'Chamanculo D', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(10, 'Malanga', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(11, 'Munhuana', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 17, 1),
(12, 'Mafalala', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(13, 'Maxaquene A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(14, 'Maxaquene B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(15, 'Maxaquene C', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(16, 'Maxaquene D', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(17, 'Polana Caniço A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(18, 'Polana Caniço B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(19, 'Urbanização', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 18, 1),
(20, 'Mavalane A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(21, 'Mavalane B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(22, 'FPLM', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(23, 'Hulene A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(24, 'Hulene B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(25, 'Ferroviário', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(26, 'Laulane', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(27, '3 de Fevereiro', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(28, 'Mahotas', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(29, 'Albazine', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(30, 'Costa do Sol', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 19, 1),
(31, 'Bagamoyo', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(32, 'George Dimitrov (Benfica)', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(33, 'Inhagoia A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(34, 'Inhagoia B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(35, 'Jardim', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(36, 'Luís Cabral', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(37, 'Magoanine', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(38, 'Malhazine', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(39, 'Nsalene', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(40, '25 de Junho A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(41, '25 de Junho B(Choupal)', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(42, 'Zimpeto', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 20, 1),
(43, 'Gwachene', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 21, 1),
(44, 'Chale', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 21, 1),
(45, 'Inguice', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 21, 1),
(46, 'Ncassene', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 21, 1),
(47, 'Xamissava', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 21, 1),
(48, 'Ingwane', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 22, 1),
(49, 'Ribjene', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 22, 1),
(50, 'Nhaquene', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 22, 1),
(51, 'Central A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(52, 'Central B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(53, 'Central C', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(54, 'Alto Maé A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(55, 'Alto Maé B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(56, 'Malhangalene A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(57, 'Malhangalene B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(58, ' Polana Cimento A', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(59, ' Polana Cimento B', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(60, 'Coop', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(61, 'Sommerschield', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', NULL, NULL, 146, 1),
(62, 'Liberdade', 1, '2022-04-21 13:04:27', '2022-04-21 13:04:27', 2, 2, 60, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_company_id_fk` (`company_id`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_company_id_fk` (`company_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_category_id_fk` (`parent_id`),
  ADD KEY `category_company_id_fk` (`company_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_province_id_fk` (`province_id`);

--
-- Indexes for table `controller`
--
ALTER TABLE `controller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controller_tax`
--
ALTER TABLE `controller_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_customer_group_id_fk` (`group_id`),
  ADD KEY `customer_company_id_fk` (`company_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_group_name_uindex` (`name`),
  ADD KEY `customer_group_company_id_fk` (`company_id`);

--
-- Indexes for table `customer_group_batch`
--
ALTER TABLE `customer_group_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_note`
--
ALTER TABLE `delivery_note`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fatura_id` (`fatura_id`),
  ADD KEY `delivery_note_company_id_fk` (`company_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_product`
--
ALTER TABLE `note_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_reason`
--
ALTER TABLE `note_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_method_name_uindex` (`name`),
  ADD KEY `payment_method_payment_method_id_fk` (`parent_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `province_name_uindex` (`name`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name_uindex` (`name`);

--
-- Indexes for table `role_group`
--
ALTER TABLE `role_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_province_id_fk` (`province_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_supplier_group_id_fk` (`group_id`),
  ADD KEY `supplier_company_id_fk` (`company_id`);

--
-- Indexes for table `supplier_group`
--
ALTER TABLE `supplier_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_group_name_uindex` (`name`),
  ADD KEY `supplier_group_company_id_fk` (`company_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_fk` (`category_id`),
  ADD KEY `product_brand_id_fk` (`brand_id`),
  ADD KEY `product_company_id_fk` (`company_id`);

--
-- Indexes for table `unit_measurement`
--
ALTER TABLE `unit_measurement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `users_username_uindex` (`username`),
  ADD KEY `users_company_id_fk` (`company_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `controller`
--
ALTER TABLE `controller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `controller_tax`
--
ALTER TABLE `controller_tax`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_group_batch`
--
ALTER TABLE `customer_group_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_note`
--
ALTER TABLE `delivery_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_product`
--
ALTER TABLE `note_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_reason`
--
ALTER TABLE `note_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_group`
--
ALTER TABLE `role_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_group`
--
ALTER TABLE `supplier_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_measurement`
--
ALTER TABLE `unit_measurement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
