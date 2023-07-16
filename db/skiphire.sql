-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 04:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skiptrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artic`
--

CREATE TABLE `artic` (
  `id` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `entry_type` varchar(20) NOT NULL,
  `vehicle_type` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `material` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artic`
--

INSERT INTO `artic` (`id`, `date`, `entry_type`, `vehicle_type`, `size`, `quantity`, `material`) VALUES
(1, '2016-11-16', 'in', 'Artic', '6 cu yd', 1, 'Metal'),
(2, '2016-11-15', 'out', 'Tipper', '8 cu yd', 1, 'Wood'),
(3, '2016-11-15', 'out', 'Artic', '20 cu yd', 1, 'Rubbish'),
(4, '2016-11-15', 'in', 'Artic', '20 cu yd', 1, 'Mixed');

-- --------------------------------------------------------

--
-- Table structure for table `artic_db`
--

CREATE TABLE `artic_db` (
  `id` int(11) NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `name_address` varchar(50) NOT NULL,
  `waster_cariar_lno` varchar(50) NOT NULL,
  `vehicle_reg_no` varchar(20) NOT NULL,
  `d_name` varchar(20) NOT NULL,
  `producer_waste` varchar(50) NOT NULL,
  `collection_address` varchar(50) NOT NULL,
  `west_out` varchar(20) NOT NULL,
  `west_in` varchar(20) NOT NULL,
  `sic_code` varchar(20) NOT NULL,
  `gross` int(10) NOT NULL,
  `tare` int(10) NOT NULL,
  `nett` int(10) NOT NULL,
  `skip_size` varchar(6) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_size` varchar(50) NOT NULL,
  `material` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `cut_date` datetime NOT NULL,
  `next_date` datetime NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `payment_terms` varchar(10) NOT NULL,
  `customer_type_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `mobile`, `email`, `address1`, `address2`, `city`, `post_code`, `payment_terms`, `customer_type_id`) VALUES
(184, 'Jas Brar', '', '', '', '78 Bryat Avenue', '', '', 'SL3 4GJ', '', ''),
(185, 'cornwall ave', '', '', '', '42 cornwall ave', '', '', 'x', '', ''),
(186, 'water', '', 'emil', '', '60 waterbeach road', '', '', 'x', '', ''),
(187, 'Avtar', '', 'avtar', '', 'ruislip', '', '', 'x', '', ''),
(188, 'Goodman park ', '', '07442655272', '', '305 Goodman park', '', '', 'sl25nw', '', ''),
(189, 'Ealing Boards', '', '', '', 'Arundal road', '', '', 'x', '', ''),
(190, 'Cromwell drive', '', '', '', '30 Cromwell drive', '', '', 'sl3 1nf', '', ''),
(191, 'bryant builder', '', '', '', 'the cresent', '', '', '', '', ''),
(192, 'Berryfield', '', '', '', '29 Laggan Road', '', '', 'x', '', ''),
(193, 'Berryfield', '', '', '', '29 Laggan Road', '', '', 'x', '', ''),
(194, 'Celing gardens', '', '', '', '32 Selan gardens', '', '', 'ub40ea', '', ''),
(195, 'Amwell Bunglow', '', '', '', '276 Nelson Road', '', '', 'x', '', ''),
(196, 'Javid', '', '', '', '13 Oakfield Ave ', '', '', 'x', '', ''),
(197, 'st davids drive', '', '07793964166', '', '44 st davids drive', '', '', 'tw200ba', '', ''),
(198, 'woodlands', '', '07780677625', '', '10 woodlands', '', '', 'x', '', ''),
(199, 'stockdales rd', '', '07772292713', '', '21 stockdales rd', '', '', 'sl4 6lb', '', ''),
(200, 'ascot gard', '', '07915380527', '', '130 ascot gard', '', '', 'x', '', ''),
(201, 'emil', '', 'emil', '', 'woking', '', '', '', '', ''),
(202, 'singh saba wexham', '', '', '', 'singh saba wexham', '', '', '', '', ''),
(203, 'mbs', '', '', '', '220 uxbridge road', '', '', 'ub13dz', '', ''),
(204, 'royal lane', '', '07759422626', '', '33  royal lane', '', '', '', '', ''),
(205, 'polish builder', '', '', '', '94 totteridge lane ', '', '', 'hp137pn', '', ''),
(206, 'hatton ave', '', '', '', '32 hatton ave', '', '', '', '', ''),
(207, 'maswell park', '', '07932606949', '', '61 maswell park cresent', '', '', 'tw32d5', '', ''),
(208, 'jota', '', '', '', 'yew tree house beconsfield rd', '', '', '', '', ''),
(209, 'amersham', '', '', '', 'winstone close', '', '', 'hp65pj', '', ''),
(210, 'dartmouth road', '', '07849835346', '', '97 dartmouth road', '', '', 'ha40dg', '', ''),
(211, 'islip gardens', '', '07849835346', '', '39 islip gardens', '', '', 'ub55by', '', ''),
(212, 'cumberland ave', '', '07989633501', '', '80 comberland ave', '', '', '', '', ''),
(213, 'hampshire ave', '', '', '', '23 hampshire ave', '', '', '', '', ''),
(214, 'Greenford gardens ', '', '02085755508', '', '17 Greenford gardens ', '', '', 'Ub69ly', '', ''),
(215, 'hounslow road', '', '07951444356', '', '305 hounslow road', '', '', 'tw135jq', '', ''),
(216, 'buckhurst', '', '', '', 'stuart green', '', '', 'sl62jf', '', ''),
(217, 'thorny lane', '', '', '', 'thorny lane', '', '', '', '', ''),
(218, 'waterbeach', '', '', '', '45 waterbeach road', '', '', '', '', ''),
(219, 'wesley road', '', '', '', '16 wesley road', '', '', '', '', ''),
(220, 'Jaspinder Singh Brar', '7792560326', '7792560326', '', '37 Hatton Avneue', '', 'Slough', '', '', '1'),
(221, 'Billa ', '', '078', '', '522', '', '', '252', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`id`, `name`) VALUES
(1, 'Residential'),
(2, 'Commercial');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `customer_id`, `address1`, `address2`, `city`, `post_code`) VALUES
(273, 184, '78 Bryat Avenue', '', 'Hayes', 'SL3 4GJ'),
(274, 185, '42 cornwall ave', '', 'slough', 'x'),
(275, 186, '60 waterbeach road', '', 'slough', 'x'),
(276, 187, 'ruislip', '', 'Ruislip', 'x'),
(277, 188, '305 Goodman park', '', 'slough', 'sl25nw'),
(278, 189, 'Arundal road', '', 'uxbridge', 'x'),
(279, 190, '30 Cromwell drive', '', 'slough', 'sl3 1nf'),
(280, 191, 'the cresent', '', 'slough', ''),
(281, 192, '29 Laggan Road', '', 'maidenhead', 'x'),
(282, 193, '29 Laggan Road', '', 'maidenhead', 'x'),
(283, 194, '32 Selan gardens', '', 'hayes', 'ub40ea'),
(284, 195, '276 Nelson Road', '', 'whitton', 'x'),
(285, 196, '13 Oakfield Ave ', '', 'slough', 'x'),
(286, 192, '33 cotswold close', '', 'uxbridge ', 'x'),
(287, 197, '44 st davids drive', '', 'englefield green', 'tw200ba'),
(288, 198, '10 woodlands', '', ' GX', 'x'),
(289, 199, '21 stockdales rd', '', 'slough', 'sl4 6lb'),
(290, 200, '130 ascot gard', '', 'southall', 'x'),
(291, 201, 'woking', '', 'woking', ''),
(292, 202, 'singh saba wexham', '', 'slough', ''),
(293, 203, '220 uxbridge road', '', 'southall', 'ub13dz'),
(294, 204, '33  royal lane', '', 'west drayton', ''),
(295, 205, '94 totteridge lane ', '', 'high wycombe', 'hp137pn'),
(296, 206, '32 hatton ave', '', 'slough', ''),
(297, 207, '61 maswell park cresent', '', 'hounslow', 'tw32d5'),
(298, 205, '81 st georges drive', '', 'slough', ''),
(299, 208, 'yew tree house beconsfield rd', '', 'farnham common', ''),
(300, 201, '', '', 'slough', ''),
(301, 209, 'winstone close', '', 'amersham', 'hp65pj'),
(302, 210, '97 dartmouth road', '', 'Ruislip', 'ha40dg'),
(303, 211, '39 islip gardens', '', 'northolt', 'ub55by'),
(304, 212, '80 comberland ave', '', 'slough', ''),
(305, 213, '23 hampshire ave', '', 'slough', ''),
(306, 214, '17 Greenford gardens ', '', 'Greenford ', 'Ub69ly'),
(307, 215, '305 hounslow road', '', 'felthem', 'tw135jq'),
(308, 216, 'stuart green', '', 'slough', 'sl62jf'),
(309, 217, 'thorny lane', '', 'iver', ''),
(310, 191, '2 Hilperton road', '', 'slough', ''),
(311, 218, '45 waterbeach road', '', 'slough', ''),
(312, 219, '16 wesley road', '', 'harrow', ''),
(313, 202, 'Ramgarh', '', '', ''),
(314, 221, '522', '', '52', '252');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(6) NOT NULL,
  `license_type` varchar(20) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `license_document` varchar(20) NOT NULL,
  `passport` varchar(20) NOT NULL,
  `p45` varchar(20) NOT NULL,
  `emergency_contact` varchar(30) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `emergency_phone` int(11) NOT NULL,
  `job_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone`, `mobile`, `email`, `address1`, `address2`, `city`, `post_code`, `license_type`, `license_number`, `photo`, `license_document`, `passport`, `p45`, `emergency_contact`, `relation`, `emergency_phone`, `job_title`) VALUES
(1, 'Happy', '', '7860604690', '', '', '', 'London', '', '', '', '', '', '', '', '', '', 0, '1'),
(3, 'Kamal', '', '7860604690', '', '', '', 'London', '', '', '', '', '', '', '', '', '', 0, '1'),
(4, 'Raju', '', '7860604690', '', '', '', 'London', '', '', '', '', '', '', '', '', '', 0, '1'),
(5, 'Sukhraj', '', '7860604690', '', '', '', 'London', '', '', '', '', '', '', '', '', '', 0, '1'),
(6, 'Other', '', '7860604690', '', '', '', 'London', '', '', '', '', '', '', '', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`) VALUES
(1, 'ajaj'),
(2, 'Parwez Alam');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `vat_p` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `nett` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `permit` decimal(10,2) NOT NULL,
  `gross` decimal(10,2) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `post_code` varchar(12) NOT NULL,
  `invoice_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`customer_id`, `date`, `sub_total`, `vat_p`, `paid`, `due`, `nett`, `vat`, `permit`, `gross`, `notes`, `status`, `address1`, `address2`, `city`, `post_code`, `invoice_no`) VALUES
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 125),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 126),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 127),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 128),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 129),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 130),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 131),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 132),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 133),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 134),
(220, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Send payment  now', 'N', '', '', '', '', 135),
(195, '2017-02-26', '400.00', '0.00', '0.00', '0.00', '400.00', '0.00', '0.00', '400.00', 'Comments', 'N', '', '', '', '', 136);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `srno` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `srno`, `item_id`, `unit_price`, `qty`, `sub_total`) VALUES
(80, 127, 1, 2, '200.00', 2, '400.00'),
(79, 126, 1, 2, '200.00', 2, '400.00'),
(78, 125, 1, 2, '200.00', 2, '400.00'),
(81, 128, 1, 2, '200.00', 2, '400.00'),
(82, 129, 1, 2, '200.00', 2, '400.00'),
(83, 130, 1, 2, '200.00', 2, '400.00'),
(84, 131, 1, 2, '200.00', 2, '400.00'),
(85, 132, 1, 2, '200.00', 2, '400.00'),
(86, 133, 1, 2, '200.00', 2, '400.00'),
(87, 134, 1, 2, '200.00', 2, '400.00'),
(88, 135, 1, 2, '200.00', 2, '400.00'),
(89, 136, 1, 3, '200.00', 2, '400.00');

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `name`) VALUES
(1, 'ajaj');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`) VALUES
(1, 'Delivery'),
(2, 'Collection'),
(3, 'Exchange');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `total_amount`, `status`, `customer_id`) VALUES
(291, '0000-00-00 00:00:00', '200.00', '1', 0),
(293, '0000-00-00 00:00:00', '0.00', '2', 0),
(294, '0000-00-00 00:00:00', '0.00', '2', 0),
(295, '0000-00-00 00:00:00', '0.00', '2', 0),
(296, '0000-00-00 00:00:00', '0.00', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `location_id` varchar(5) NOT NULL,
  `skip_id` int(11) NOT NULL,
  `exchange_skip_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `job_type` int(2) NOT NULL,
  `end_date` date NOT NULL,
  `due_days` int(4) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `skips` int(10) NOT NULL,
  `order_status` varchar(4) NOT NULL,
  `tip_status` varchar(3) NOT NULL,
  `tip_date` date NOT NULL,
  `tip_driver_id` int(11) NOT NULL,
  `tip_yard_id` int(11) NOT NULL,
  `tip_lorry_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `payment_status` int(11) NOT NULL,
  `skip_location` varchar(50) NOT NULL,
  `delivery_slot` varchar(5) NOT NULL,
  `invoice` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `permit` decimal(10,2) NOT NULL,
  `nett` decimal(10,2) NOT NULL,
  `gross` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `customer_id`, `location_id`, `skip_id`, `exchange_skip_id`, `company_id`, `vehicle_id`, `start_date`, `job_type`, `end_date`, `due_days`, `driver_id`, `skips`, `order_status`, `tip_status`, `tip_date`, `tip_driver_id`, `tip_yard_id`, `tip_lorry_id`, `comments`, `payment_status`, `skip_location`, `delivery_slot`, `invoice`, `amount`, `vat`, `permit`, `nett`, `gross`) VALUES
(304, 291, 221, '314', 1, 1, 0, 0, '2017-02-07', 1, '0000-00-00', 0, 0, 1, '', '1', '0000-00-00', 0, 0, 0, 'No Comments', 2, 'driveway', 'AM', 0, '200.00', '0.00', '0.00', '0.00', '0.00'),
(306, 293, 192, '286', 1, 1, 0, 0, '2017-02-26', 1, '0000-00-00', 0, 2, 1, '', '2', '2017-02-26', 2, 1, 1, 'No Comments', 1, 'driveway', 'AM', 0, '0.00', '0.00', '0.00', '0.00', '0.00'),
(307, 294, 200, '290', 1, 1, 0, 0, '2017-02-26', 1, '0000-00-00', 0, 2, 1, '', '1', '0000-00-00', 0, 0, 0, 'No Comments', 1, 'driveway', 'AM', 0, '0.00', '0.00', '0.00', '0.00', '0.00'),
(308, 295, 210, '302', 1, 1, 0, 0, '2017-02-26', 1, '0000-00-00', 0, 2, 1, '', '1', '0000-00-00', 0, 0, 0, 'No Comments', 1, 'driveway', 'AM', 0, '0.00', '0.00', '0.00', '0.00', '0.00'),
(309, 296, 200, '290', 1, 1, 0, 0, '2017-02-26', 2, '0000-00-00', 0, 1, 1, '', '1', '0000-00-00', 0, 0, 0, 'No Comments', 1, 'driveway', 'AM', 0, '0.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Not Done'),
(2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`) VALUES
(1, 'Fully Paid'),
(2, 'Not Paid'),
(3, 'Part Paid'),
(4, 'Cash on Delivery'),
(5, 'Full Paid in Account');

-- --------------------------------------------------------

--
-- Table structure for table `skips`
--

CREATE TABLE `skips` (
  `id` int(11) NOT NULL,
  `srno` int(11) NOT NULL,
  `size` varchar(30) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `owned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skips`
--

INSERT INTO `skips` (`id`, `srno`, `size`, `current_stock`, `price`, `owned`) VALUES
(1, 1, '6 cu yd', 168, '220.00', 2),
(2, 2, '8 cu yd', 9, '185.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skip_locations`
--

CREATE TABLE `skip_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skip_locations`
--

INSERT INTO `skip_locations` (`id`, `name`) VALUES
(1, 'Driveway'),
(2, 'Allyway'),
(3, 'Off the Road'),
(4, 'On the Road'),
(5, 'Neighbour'),
(6, 'Building Site');

-- --------------------------------------------------------

--
-- Table structure for table `tip_jobs`
--

CREATE TABLE `tip_jobs` (
  `id` int(11) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `lorry` varchar(50) NOT NULL,
  `paid` varchar(10) NOT NULL,
  `yard` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `job_id` int(11) NOT NULL,
  `tip_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tip_status`
--

CREATE TABLE `tip_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tip_status`
--

INSERT INTO `tip_status` (`id`, `name`) VALUES
(1, 'Not Done'),
(2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `source_id` int(11) NOT NULL,
  `transaction_type` varchar(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `current_bal` decimal(10,2) NOT NULL,
  `details` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `role`) VALUES
(3, 'Admin', 'Admin', 'skiphire', '3460', 'admin', ''),
(12, 'Happy', 'Singh', 'happy', '1234', 'happy', 'driver'),
(14, 'Kam', 'Dhillon', 'kam', '1234', 'kam', ''),
(15, 'Jas', 'Brar', 'jas', '12', 'jas', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `reg_plate` varchar(11) NOT NULL,
  `mileage` varchar(10) NOT NULL,
  `mot_date` date NOT NULL,
  `service_date` date NOT NULL,
  `road_tax` date NOT NULL,
  `pmi_date` date NOT NULL,
  `taco_date` date NOT NULL,
  `insurance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `reg_plate`, `mileage`, `mot_date`, `service_date`, `road_tax`, `pmi_date`, `taco_date`, `insurance_date`) VALUES
(1, 'LT09 ZVA', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(2, 'LT09 ZTP', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `yards`
--

CREATE TABLE `yards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yards`
--

INSERT INTO `yards` (`id`, `name`) VALUES
(1, 'T Fowles'),
(2, 'Hawk'),
(3, 'John Simpson'),
(4, 'B & K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artic`
--
ALTER TABLE `artic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artic_db`
--
ALTER TABLE `artic_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD UNIQUE KEY `id` (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skips`
--
ALTER TABLE `skips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skip_locations`
--
ALTER TABLE `skip_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_jobs`
--
ALTER TABLE `tip_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_status`
--
ALTER TABLE `tip_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yards`
--
ALTER TABLE `yards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `artic`
--
ALTER TABLE `artic`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `artic_db`
--
ALTER TABLE `artic_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `skips`
--
ALTER TABLE `skips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `skip_locations`
--
ALTER TABLE `skip_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tip_jobs`
--
ALTER TABLE `tip_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tip_status`
--
ALTER TABLE `tip_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `yards`
--
ALTER TABLE `yards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
