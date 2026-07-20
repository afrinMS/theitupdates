-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2026 at 12:14 PM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u256013742_theitup_lander`
--

-- --------------------------------------------------------

--
-- Table structure for table `2b4078_4ways`
--

CREATE TABLE `2b4078_4ways` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2b4078_4ways`
--

INSERT INTO `2b4078_4ways` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `company_name`, `job_title`, `country`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test', 'test', 'test@mail.com', '98776633', 'test', 'test', 'United States', 'No', '103.184.239.197', '2025-07-03 22:48:53'),
(2, 'test', 'test', 'test@mail.com', '9877663356', 'test', 'test', 'United Kingdom', 'No', '103.183.83.84', '2025-07-08 20:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `2b4078_maketesting`
--

CREATE TABLE `2b4078_maketesting` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2b4078_maketesting`
--

INSERT INTO `2b4078_maketesting` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `company_name`, `job_title`, `country`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'Test', 'Test', 'test@test.com', '7894561230', 'Test', 'Test', 'Canada', 'No', '123.252.197.6', '2025-07-02 21:20:55'),
(2, 'test', 'test', 'test@mail.com', '9877663356', 'test', 'test', 'United Kingdom', 'No', '103.183.83.84', '2025-07-08 20:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `2b4078_measuring`
--

CREATE TABLE `2b4078_measuring` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2b4078_measuring`
--

INSERT INTO `2b4078_measuring` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `company_name`, `job_title`, `country`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test', 'test', 'test@mail.com', '98776633', 'test', 'test', 'United Kingdom', 'No', '103.184.239.197', '2025-07-03 22:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `6_strategies_to_boost_sales`
--

CREATE TABLE `6_strategies_to_boost_sales` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adt`
--

CREATE TABLE `adt` (
  `id` int(11) NOT NULL,
  `footage` varchar(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_implified`
--

CREATE TABLE `ai_implified` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `area_interest` varchar(30) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asperafasp`
--

CREATE TABLE `asperafasp` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `notification` varchar(50) NOT NULL,
  `form123456` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b64f96_2025`
--

CREATE TABLE `b64f96_2025` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_function` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `optin` varchar(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b64f96_2025`
--

INSERT INTO `b64f96_2025` (`id`, `email_address`, `first_name`, `last_name`, `job_title`, `job_function`, `industry`, `company_name`, `address_one`, `address_two`, `city`, `state`, `zipcode`, `country`, `phone_number`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test@test.com', 'test', 'test', 'Highest Level Executive', 'Commercialization', 'Diagnostics', 'test', 'test', '', 'test', 'test', '12345', 'Bangladesh', '', 'Yes', '2600:4040:5546:a00:288c:a0ee:688a:6359', '2025-07-01 18:42:16'),
(2, 'test@test.com', 'test', 'test', 'VP', 'Pharmacy', 'Laboratory', 'test', 'test', 'test', 'Test', 'Test', '1253', 'Somalia', '', 'No', '123.252.197.6', '2025-07-01 20:55:29'),
(3, 'test@test.com', 'test', 'test', 'Scientist/Chemist/Analyst', 'IT', 'Marketing/Creative Agency', 'test', 'test', 'test', 'test', 'test', 'test', 'Algeria', '9652345112', 'Yes', '123.252.197.6', '2025-07-01 21:05:46'),
(4, 'test@test.com', 'test', 'test', 'Director', 'Contract Services', 'Hotel', 'test', 'test', '', 'test', 'MA', '12345', 'Bangladesh', '', 'No', '2600:4040:5546:a00:e4ab:64f9:e8d3:c6da', '2025-07-08 04:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `b64f96_establishing`
--

CREATE TABLE `b64f96_establishing` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_function` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `optin` varchar(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b64f96_establishing`
--

INSERT INTO `b64f96_establishing` (`id`, `email_address`, `first_name`, `last_name`, `job_title`, `job_function`, `industry`, `company_name`, `address_one`, `address_two`, `city`, `state`, `zipcode`, `country`, `phone_number`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test@test.com', 'test', 'Test', 'Director', 'Commercialization', 'Audit & Financial Advisory', 'test', 'test', 'test', 'Test', 'Test', '1253', 'Solomon Islands', '', 'No', '123.252.197.6', '2025-07-01 20:55:00'),
(2, 'test@test.com', 'test', 'test', 'Supervisor', 'Contract Services', 'Hotel', 'test', 'test', '', 'test', 'MA', '12345', 'Bangladesh', '', 'No', '2600:4040:5546:a00:e4ab:64f9:e8d3:c6da', '2025-07-08 04:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `b64f96_focus`
--

CREATE TABLE `b64f96_focus` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_function` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `optin` varchar(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b64f96_focus`
--

INSERT INTO `b64f96_focus` (`id`, `email_address`, `first_name`, `last_name`, `job_title`, `job_function`, `industry`, `company_name`, `address_one`, `address_two`, `city`, `state`, `zipcode`, `country`, `phone_number`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test@test.com', 'test', 'Test', 'Manager', 'Compliance', 'Biotech', 'test', 'tes', 'test', 'London', 'Test', '1253', 'Fiji', '7666457938', 'No', '123.252.197.6', '2025-07-01 20:54:37'),
(2, 'test@test.com', 'test', 'test', 'VP', 'Contract Services', 'Biotech', 'test', 'test', '', 'test', 'MA', '12345', 'Bahrain', '', 'No', '2600:4040:5546:a00:e4ab:64f9:e8d3:c6da', '2025-07-08 04:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `b64f96_leveraging`
--

CREATE TABLE `b64f96_leveraging` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_function` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `optin` varchar(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b64f96_leveraging`
--

INSERT INTO `b64f96_leveraging` (`id`, `email_address`, `first_name`, `last_name`, `job_title`, `job_function`, `industry`, `company_name`, `address_one`, `address_two`, `city`, `state`, `zipcode`, `country`, `phone_number`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'test@gmail.com', 'test', 'tester', 'Supervisor', 'Packaging', 'Health Plan/Payer', 'tesert', 'test', '', 'test', 'dfgdf', '435345', 'India', '09874563210', 'No', '2409:4090:8:9c03:51d5:c8df:c6a6:3641', '2025-07-01 20:50:02'),
(2, 'test@test.com', 'test', 'Test', 'VP', 'Commercial Operations', 'Hotel', 'test', 'tes', 'test', 'test', 'Test', '1253', 'Antigua and Barbuda', '9876543210', 'No', '123.252.197.6', '2025-07-01 20:54:07'),
(3, 'test@test.com', 'test', 'test', 'Manager', 'Contract Services', 'Contract Manufacturing Organization (CMO)', 'test', 'test', '', 'test', 'MA', '12345', 'Bangladesh', '', 'No', '2600:4040:5546:a00:e4ab:64f9:e8d3:c6da', '2025-07-08 04:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `benefits_of_cloud`
--

CREATE TABLE `benefits_of_cloud` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bing_lander`
--

CREATE TABLE `bing_lander` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `company` varchar(30) NOT NULL,
  `companyadd` varchar(100) NOT NULL,
  `size` varchar(30) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `code` varchar(20) NOT NULL,
  `text1` varchar(50) NOT NULL,
  `text2` varchar(50) NOT NULL,
  `form123456` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bing_lander1`
--

CREATE TABLE `bing_lander1` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `company` varchar(30) NOT NULL,
  `companyadd` varchar(100) NOT NULL,
  `size` varchar(30) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `code` varchar(20) NOT NULL,
  `text1` varchar(50) NOT NULL,
  `text2` varchar(50) NOT NULL,
  `form123456` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `closing_performance`
--

CREATE TABLE `closing_performance` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_postal_code` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaboration`
--

CREATE TABLE `collaboration` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `jobtitle` varchar(60) NOT NULL,
  `employeeSize` varchar(20) NOT NULL,
  `choose_meeting` varchar(30) NOT NULL,
  `current_meeting` varchar(10) NOT NULL,
  `annual_revenue` varchar(100) NOT NULL,
  `optIn` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connected_retail`
--

CREATE TABLE `connected_retail` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contentemea`
--

CREATE TABLE `contentemea` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `function` varchar(60) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `notification` varchar(60) NOT NULL,
  `form123456` varchar(10) NOT NULL,
  `filename` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_localization`
--

CREATE TABLE `content_localization` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_localization1`
--

CREATE TABLE `content_localization1` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `yes_no` varchar(20) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `core_principles`
--

CREATE TABLE `core_principles` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creative_trends`
--

CREATE TABLE `creative_trends` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `yes_no` varchar(20) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `csize` int(20) NOT NULL,
  `jrole` varchar(60) NOT NULL,
  `phone` int(60) NOT NULL,
  `cregion` varchar(60) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `databricks_big_book`
--

CREATE TABLE `databricks_big_book` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docusign`
--

CREATE TABLE `docusign` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docusigngeomm`
--

CREATE TABLE `docusigngeomm` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `notification` varchar(90) NOT NULL,
  `filename` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docusign_geosmb`
--

CREATE TABLE `docusign_geosmb` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `filename` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e85c33_private`
--

CREATE TABLE `e85c33_private` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e85c33_private`
--

INSERT INTO `e85c33_private` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `company_name`, `job_title`, `country`, `optin`, `ip_address`, `created_at`) VALUES
(1, 'Test', 'Test', 'test@test.com', '7894561230', 'Test', 'Test', 'Azerbaijan', 'No', '123.252.197.6', '2025-07-02 21:20:28'),
(2, 'dvsdvdf', 'dsvsdv', 'dfbdgg@few.com', '6373738383', 'fvdfb', 'kkkk', 'United States Minor Outlying Islands (the)', 'No', '120.138.12.40', '2025-07-02 22:53:48'),
(3, 'dvsdvdf', 'dsvsdv', 'dfbdgg@few.com', '6373738383', 'fvdfb', 'kkkk', 'United States Minor Outlying Islands (the)', 'No', '120.138.12.40', '2025-07-02 22:54:17'),
(4, 'test', 'tester', 'test@gmail.com', '09874563210', 'tesert', 'Developer', 'India', 'Yes', '2409:4090:8:9c03:51d5:c8df:c6a6:3641', '2025-07-03 17:32:42'),
(5, 'jonh', 'clave', 'shaikhafrin33@gmail.com', '616 613-6500', 'GTM', 'hr', 'India', 'Yes', '103.132.29.235', '2025-07-31 16:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `ebk_go_live_fast`
--

CREATE TABLE `ebk_go_live_fast` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebk_servicenow`
--

CREATE TABLE `ebk_servicenow` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebk_turbocharge`
--

CREATE TABLE `ebk_turbocharge` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebooklander`
--

CREATE TABLE `ebooklander` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `job` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `form` varchar(10) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elevating_operations`
--

CREATE TABLE `elevating_operations` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `title` longtext NOT NULL,
  `zipcode` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `csize` int(60) NOT NULL,
  `jrole` varchar(40) NOT NULL,
  `phone` int(20) NOT NULL,
  `cregion` varchar(60) NOT NULL,
  `form` varchar(60) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empower_your_care_teams`
--

CREATE TABLE `empower_your_care_teams` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enable_corporate_agility`
--

CREATE TABLE `enable_corporate_agility` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enable_corporate_agility1`
--

CREATE TABLE `enable_corporate_agility1` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enable_corporate_agility2`
--

CREATE TABLE `enable_corporate_agility2` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `agree2` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enable_corporate_agility3`
--

CREATE TABLE `enable_corporate_agility3` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `agree2` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ent`
--

CREATE TABLE `ent` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `jobtitle` varchar(60) NOT NULL,
  `employeeSize` varchar(20) NOT NULL,
  `choose_meeting` varchar(30) NOT NULL,
  `current_meeting` varchar(10) NOT NULL,
  `annual_revenue` varchar(100) NOT NULL,
  `optIn` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_collaboration`
--

CREATE TABLE `enterprise_collaboration` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essential_guide`
--

CREATE TABLE `essential_guide` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_resilience`
--

CREATE TABLE `fiscal_resilience` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forbes_insights`
--

CREATE TABLE `forbes_insights` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_size` varchar(60) NOT NULL,
  `job_role` varchar(70) NOT NULL,
  `country` varchar(70) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `getrev`
--

CREATE TABLE `getrev` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `optin` varchar(20) NOT NULL,
  `ip_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gtw`
--

CREATE TABLE `gtw` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `jobtitle` varchar(60) NOT NULL,
  `employeeSize` varchar(20) NOT NULL,
  `choose_meeting` varchar(30) NOT NULL,
  `current_meeting` varchar(10) NOT NULL,
  `annual_revenue` varchar(100) NOT NULL,
  `optIn` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holistic_security`
--

CREATE TABLE `holistic_security` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `job` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `form` varchar(10) NOT NULL,
  `file` varchar(100) NOT NULL,
  `notification` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibmaspera`
--

CREATE TABLE `ibmaspera` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `role` varchar(40) NOT NULL,
  `department` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `notification` varchar(50) NOT NULL,
  `form123456` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innovation_on_the_job`
--

CREATE TABLE `innovation_on_the_job` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `area_interest` varchar(30) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intelcsp`
--

CREATE TABLE `intelcsp` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intelnetworktransformation`
--

CREATE TABLE `intelnetworktransformation` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lander31`
--

CREATE TABLE `lander31` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `job` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `form` varchar(10) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lander_types_workplace_culture_great_examples`
--

CREATE TABLE `lander_types_workplace_culture_great_examples` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `company` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `zip_code` text NOT NULL,
  `company_size` text NOT NULL,
  `revenue` text NOT NULL,
  `job_title` text NOT NULL,
  `industry` text NOT NULL,
  `job_function` text NOT NULL,
  `recognition_priority` text NOT NULL,
  `optin` varchar(50) NOT NULL,
  `filename` text NOT NULL,
  `created_at` datetime NOT NULL,
  `ip_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legacy_itsm`
--

CREATE TABLE `legacy_itsm` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lm_opendock`
--

CREATE TABLE `lm_opendock` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `company` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job_role` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `warehouses` varchar(50) NOT NULL,
  `asset_date` varchar(20) DEFAULT '07-14-26',
  `client` varchar(150) DEFAULT 'OpenDock',
  `asset` varchar(255) DEFAULT 'Closing the Gap in Logistics Execution',
  `brand` varchar(150) DEFAULT 'Logistics Management-SCMR',
  `campaign_type` varchar(50) DEFAULT 'White Paper',
  `lead_type` varchar(50) DEFAULT 'Download',
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_strategy`
--

CREATE TABLE `marketing_strategy` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `yes_no` varchar(20) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `midsize_organizations`
--

CREATE TABLE `midsize_organizations` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modernit`
--

CREATE TABLE `modernit` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `job` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `form` varchar(10) NOT NULL,
  `file` varchar(100) NOT NULL,
  `notification` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modular_erp`
--

CREATE TABLE `modular_erp` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modular_erp1`
--

CREATE TABLE `modular_erp1` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modular_erp2`
--

CREATE TABLE `modular_erp2` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `agree2` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modular_erp3`
--

CREATE TABLE `modular_erp3` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `agree2` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myths_of_moving`
--

CREATE TABLE `myths_of_moving` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_size` varchar(60) NOT NULL,
  `job_role` varchar(70) NOT NULL,
  `country` varchar(70) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `observability_campus_network`
--

CREATE TABLE `observability_campus_network` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(15) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operations_campus_network`
--

CREATE TABLE `operations_campus_network` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(15) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `optimizing_sales`
--

CREATE TABLE `optimizing_sales` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `company` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prioritize_security`
--

CREATE TABLE `prioritize_security` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `title` longtext NOT NULL,
  `form` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prioritize_security_operations`
--

CREATE TABLE `prioritize_security_operations` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `title` longtext NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_traffic`
--

CREATE TABLE `program_traffic` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg1`
--

CREATE TABLE `reg1` (
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `mob` varchar(12) NOT NULL,
  `jt` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `cn` varchar(15) NOT NULL,
  `empSize` varchar(10) NOT NULL,
  `industry` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(15) NOT NULL,
  `evaluate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg3`
--

CREATE TABLE `reg3` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg4`
--

CREATE TABLE `reg4` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg5`
--

CREATE TABLE `reg5` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg6`
--

CREATE TABLE `reg6` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reg7`
--

CREATE TABLE `reg7` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cn` varchar(100) NOT NULL,
  `acr` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `evaluate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `jobtitle` varchar(60) NOT NULL,
  `employeeSize` varchar(20) NOT NULL,
  `choose_meeting` varchar(30) NOT NULL,
  `current_meeting` varchar(10) NOT NULL,
  `annual_revenue` varchar(100) NOT NULL,
  `optIn` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seize_the_power`
--

CREATE TABLE `seize_the_power` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `area_of_interest` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `simplify_security`
--

CREATE TABLE `simplify_security` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `six_landers`
--

CREATE TABLE `six_landers` (
  `lid` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `job` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `annual` varchar(60) NOT NULL,
  `size` varchar(20) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(30) NOT NULL,
  `code` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `notification` varchar(10000) NOT NULL,
  `form123456` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smart_building`
--

CREATE TABLE `smart_building` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(15) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smb`
--

CREATE TABLE `smb` (
  `id` int(11) NOT NULL,
  `lander` varchar(100) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `postalCode` varchar(30) NOT NULL,
  `jobtitle` varchar(60) NOT NULL,
  `employeeSize` varchar(20) NOT NULL,
  `choose_meeting` varchar(30) NOT NULL,
  `current_meeting` varchar(10) NOT NULL,
  `annual_revenue` varchar(100) NOT NULL,
  `optIn` varchar(10) NOT NULL,
  `filename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smb_data`
--

CREATE TABLE `smb_data` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `optin` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smb_data`
--

INSERT INTO `smb_data` (`id`, `first_name`, `last_name`, `company`, `email`, `phone`, `country`, `state`, `optin`, `ip_address`, `date`) VALUES
(1, 'TEST', 'TEST', 'TEST', 'Test@test.com', '1234567899', 'Australia', '', 'No', '27.107.108.46', '2026-04-22 20:33:46'),
(2, 'test', 'test', 'TEST', 'test@TEST.COM', 'TEST', 'United States', 'Vermont', 'No', '27.107.108.46', '2026-04-22 20:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `stopping_cyberattacks`
--

CREATE TABLE `stopping_cyberattacks` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `optin1` varchar(20) NOT NULL,
  `optin2` varchar(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_webservice`
--

CREATE TABLE `test_webservice` (
  `id` int(11) NOT NULL,
  `utm_content__c` varchar(20) NOT NULL,
  `Lead_Category__c` varchar(20) NOT NULL,
  `formid` varchar(20) NOT NULL,
  `Lead_Source_Detail__c` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `company` varchar(50) NOT NULL,
  `mainPhone` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `Company_Size__c` varchar(50) NOT NULL,
  `DSCORGPKG__Company_HQ_Address__c` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postalCode` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `Integrations__c` varchar(50) NOT NULL,
  `industry` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `text_messages`
--

CREATE TABLE `text_messages` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `title` longtext NOT NULL,
  `zipcode` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `the_benefits_of_aligning_sales`
--

CREATE TABLE `the_benefits_of_aligning_sales` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `job_role` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `agree1` varchar(20) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `lander_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tips_tricks_deploying`
--

CREATE TABLE `tips_tricks_deploying` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transforming_safety`
--

CREATE TABLE `transforming_safety` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) NOT NULL,
  `title` longtext NOT NULL,
  `zipcode` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transform_network`
--

CREATE TABLE `transform_network` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `title` longtext NOT NULL,
  `company` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `understanding_nvme`
--

CREATE TABLE `understanding_nvme` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `seniority` varchar(100) NOT NULL,
  `job_function` varchar(100) NOT NULL,
  `no_of_employees` varchar(60) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `industry_list` varchar(100) NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip_code` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `checkbox1` varchar(40) NOT NULL,
  `checkbox2` varchar(40) NOT NULL,
  `form` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `csize` int(20) NOT NULL,
  `jrole` varchar(60) NOT NULL,
  `phone` int(60) NOT NULL,
  `cregion` varchar(60) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visualcontent`
--

CREATE TABLE `visualcontent` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `function` varchar(60) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `notification` varchar(60) NOT NULL,
  `form123456` varchar(10) NOT NULL,
  `filename` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visualizing_diversity`
--

CREATE TABLE `visualizing_diversity` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `yes_no` varchar(20) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visual_content`
--

CREATE TABLE `visual_content` (
  `id` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `yes_no` varchar(20) NOT NULL,
  `license` varchar(10) NOT NULL,
  `formname` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2b4078_4ways`
--
ALTER TABLE `2b4078_4ways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2b4078_maketesting`
--
ALTER TABLE `2b4078_maketesting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2b4078_measuring`
--
ALTER TABLE `2b4078_measuring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `6_strategies_to_boost_sales`
--
ALTER TABLE `6_strategies_to_boost_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adt`
--
ALTER TABLE `adt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ai_implified`
--
ALTER TABLE `ai_implified`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asperafasp`
--
ALTER TABLE `asperafasp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b64f96_2025`
--
ALTER TABLE `b64f96_2025`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b64f96_establishing`
--
ALTER TABLE `b64f96_establishing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b64f96_focus`
--
ALTER TABLE `b64f96_focus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b64f96_leveraging`
--
ALTER TABLE `b64f96_leveraging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits_of_cloud`
--
ALTER TABLE `benefits_of_cloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bing_lander`
--
ALTER TABLE `bing_lander`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bing_lander1`
--
ALTER TABLE `bing_lander1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closing_performance`
--
ALTER TABLE `closing_performance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connected_retail`
--
ALTER TABLE `connected_retail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contentemea`
--
ALTER TABLE `contentemea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_localization`
--
ALTER TABLE `content_localization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_localization1`
--
ALTER TABLE `content_localization1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_principles`
--
ALTER TABLE `core_principles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creative_trends`
--
ALTER TABLE `creative_trends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `databricks_big_book`
--
ALTER TABLE `databricks_big_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docusign`
--
ALTER TABLE `docusign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docusigngeomm`
--
ALTER TABLE `docusigngeomm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docusign_geosmb`
--
ALTER TABLE `docusign_geosmb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e85c33_private`
--
ALTER TABLE `e85c33_private`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebk_go_live_fast`
--
ALTER TABLE `ebk_go_live_fast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebk_servicenow`
--
ALTER TABLE `ebk_servicenow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebk_turbocharge`
--
ALTER TABLE `ebk_turbocharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooklander`
--
ALTER TABLE `ebooklander`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elevating_operations`
--
ALTER TABLE `elevating_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empower_your_care_teams`
--
ALTER TABLE `empower_your_care_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enable_corporate_agility`
--
ALTER TABLE `enable_corporate_agility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enable_corporate_agility1`
--
ALTER TABLE `enable_corporate_agility1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enable_corporate_agility2`
--
ALTER TABLE `enable_corporate_agility2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enable_corporate_agility3`
--
ALTER TABLE `enable_corporate_agility3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent`
--
ALTER TABLE `ent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprise_collaboration`
--
ALTER TABLE `enterprise_collaboration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essential_guide`
--
ALTER TABLE `essential_guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fiscal_resilience`
--
ALTER TABLE `fiscal_resilience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forbes_insights`
--
ALTER TABLE `forbes_insights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getrev`
--
ALTER TABLE `getrev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtw`
--
ALTER TABLE `gtw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holistic_security`
--
ALTER TABLE `holistic_security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ibmaspera`
--
ALTER TABLE `ibmaspera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innovation_on_the_job`
--
ALTER TABLE `innovation_on_the_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intelcsp`
--
ALTER TABLE `intelcsp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intelnetworktransformation`
--
ALTER TABLE `intelnetworktransformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lander31`
--
ALTER TABLE `lander31`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lander_types_workplace_culture_great_examples`
--
ALTER TABLE `lander_types_workplace_culture_great_examples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legacy_itsm`
--
ALTER TABLE `legacy_itsm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_opendock`
--
ALTER TABLE `lm_opendock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email_address`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_country` (`country`);

--
-- Indexes for table `marketing_strategy`
--
ALTER TABLE `marketing_strategy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midsize_organizations`
--
ALTER TABLE `midsize_organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modernit`
--
ALTER TABLE `modernit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modular_erp`
--
ALTER TABLE `modular_erp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modular_erp1`
--
ALTER TABLE `modular_erp1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modular_erp2`
--
ALTER TABLE `modular_erp2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modular_erp3`
--
ALTER TABLE `modular_erp3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myths_of_moving`
--
ALTER TABLE `myths_of_moving`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observability_campus_network`
--
ALTER TABLE `observability_campus_network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations_campus_network`
--
ALTER TABLE `operations_campus_network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `optimizing_sales`
--
ALTER TABLE `optimizing_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prioritize_security`
--
ALTER TABLE `prioritize_security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prioritize_security_operations`
--
ALTER TABLE `prioritize_security_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_traffic`
--
ALTER TABLE `program_traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seize_the_power`
--
ALTER TABLE `seize_the_power`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simplify_security`
--
ALTER TABLE `simplify_security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smart_building`
--
ALTER TABLE `smart_building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smb`
--
ALTER TABLE `smb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smb_data`
--
ALTER TABLE `smb_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stopping_cyberattacks`
--
ALTER TABLE `stopping_cyberattacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_webservice`
--
ALTER TABLE `test_webservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_messages`
--
ALTER TABLE `text_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `the_benefits_of_aligning_sales`
--
ALTER TABLE `the_benefits_of_aligning_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tips_tricks_deploying`
--
ALTER TABLE `tips_tricks_deploying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transforming_safety`
--
ALTER TABLE `transforming_safety`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transform_network`
--
ALTER TABLE `transform_network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `understanding_nvme`
--
ALTER TABLE `understanding_nvme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visualcontent`
--
ALTER TABLE `visualcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visualizing_diversity`
--
ALTER TABLE `visualizing_diversity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visual_content`
--
ALTER TABLE `visual_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2b4078_4ways`
--
ALTER TABLE `2b4078_4ways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `2b4078_maketesting`
--
ALTER TABLE `2b4078_maketesting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `2b4078_measuring`
--
ALTER TABLE `2b4078_measuring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `6_strategies_to_boost_sales`
--
ALTER TABLE `6_strategies_to_boost_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adt`
--
ALTER TABLE `adt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_implified`
--
ALTER TABLE `ai_implified`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asperafasp`
--
ALTER TABLE `asperafasp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `b64f96_2025`
--
ALTER TABLE `b64f96_2025`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `b64f96_establishing`
--
ALTER TABLE `b64f96_establishing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `b64f96_focus`
--
ALTER TABLE `b64f96_focus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `b64f96_leveraging`
--
ALTER TABLE `b64f96_leveraging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `benefits_of_cloud`
--
ALTER TABLE `benefits_of_cloud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bing_lander`
--
ALTER TABLE `bing_lander`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bing_lander1`
--
ALTER TABLE `bing_lander1`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `closing_performance`
--
ALTER TABLE `closing_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connected_retail`
--
ALTER TABLE `connected_retail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contentemea`
--
ALTER TABLE `contentemea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_localization`
--
ALTER TABLE `content_localization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_localization1`
--
ALTER TABLE `content_localization1`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `core_principles`
--
ALTER TABLE `core_principles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creative_trends`
--
ALTER TABLE `creative_trends`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databricks_big_book`
--
ALTER TABLE `databricks_big_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docusign`
--
ALTER TABLE `docusign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docusigngeomm`
--
ALTER TABLE `docusigngeomm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docusign_geosmb`
--
ALTER TABLE `docusign_geosmb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e85c33_private`
--
ALTER TABLE `e85c33_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ebk_go_live_fast`
--
ALTER TABLE `ebk_go_live_fast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ebk_servicenow`
--
ALTER TABLE `ebk_servicenow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ebk_turbocharge`
--
ALTER TABLE `ebk_turbocharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ebooklander`
--
ALTER TABLE `ebooklander`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elevating_operations`
--
ALTER TABLE `elevating_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empower_your_care_teams`
--
ALTER TABLE `empower_your_care_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enable_corporate_agility`
--
ALTER TABLE `enable_corporate_agility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enable_corporate_agility1`
--
ALTER TABLE `enable_corporate_agility1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enable_corporate_agility2`
--
ALTER TABLE `enable_corporate_agility2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enable_corporate_agility3`
--
ALTER TABLE `enable_corporate_agility3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ent`
--
ALTER TABLE `ent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enterprise_collaboration`
--
ALTER TABLE `enterprise_collaboration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essential_guide`
--
ALTER TABLE `essential_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fiscal_resilience`
--
ALTER TABLE `fiscal_resilience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forbes_insights`
--
ALTER TABLE `forbes_insights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `getrev`
--
ALTER TABLE `getrev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gtw`
--
ALTER TABLE `gtw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holistic_security`
--
ALTER TABLE `holistic_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ibmaspera`
--
ALTER TABLE `ibmaspera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innovation_on_the_job`
--
ALTER TABLE `innovation_on_the_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intelcsp`
--
ALTER TABLE `intelcsp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intelnetworktransformation`
--
ALTER TABLE `intelnetworktransformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lander31`
--
ALTER TABLE `lander31`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lander_types_workplace_culture_great_examples`
--
ALTER TABLE `lander_types_workplace_culture_great_examples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legacy_itsm`
--
ALTER TABLE `legacy_itsm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lm_opendock`
--
ALTER TABLE `lm_opendock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_strategy`
--
ALTER TABLE `marketing_strategy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `midsize_organizations`
--
ALTER TABLE `midsize_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modernit`
--
ALTER TABLE `modernit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modular_erp`
--
ALTER TABLE `modular_erp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modular_erp1`
--
ALTER TABLE `modular_erp1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modular_erp2`
--
ALTER TABLE `modular_erp2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modular_erp3`
--
ALTER TABLE `modular_erp3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myths_of_moving`
--
ALTER TABLE `myths_of_moving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `observability_campus_network`
--
ALTER TABLE `observability_campus_network`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operations_campus_network`
--
ALTER TABLE `operations_campus_network`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `optimizing_sales`
--
ALTER TABLE `optimizing_sales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prioritize_security`
--
ALTER TABLE `prioritize_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prioritize_security_operations`
--
ALTER TABLE `prioritize_security_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_traffic`
--
ALTER TABLE `program_traffic`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seize_the_power`
--
ALTER TABLE `seize_the_power`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simplify_security`
--
ALTER TABLE `simplify_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smart_building`
--
ALTER TABLE `smart_building`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smb`
--
ALTER TABLE `smb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smb_data`
--
ALTER TABLE `smb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stopping_cyberattacks`
--
ALTER TABLE `stopping_cyberattacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_webservice`
--
ALTER TABLE `test_webservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `text_messages`
--
ALTER TABLE `text_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `the_benefits_of_aligning_sales`
--
ALTER TABLE `the_benefits_of_aligning_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tips_tricks_deploying`
--
ALTER TABLE `tips_tricks_deploying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transforming_safety`
--
ALTER TABLE `transforming_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transform_network`
--
ALTER TABLE `transform_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `understanding_nvme`
--
ALTER TABLE `understanding_nvme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visualcontent`
--
ALTER TABLE `visualcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visualizing_diversity`
--
ALTER TABLE `visualizing_diversity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_content`
--
ALTER TABLE `visual_content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
