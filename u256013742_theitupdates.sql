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
-- Database: `u256013742_theitupdates`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `login_attempts` tinyint(3) UNSIGNED DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `company`, `phone`, `password`, `login_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@theitupdates.com', 'TheITUpdates', '9874563210', '$2y$10$AkRYpf4zixDw7JjxbVE09OaXMie4mKDrS0Y8zuEvHOdu2g1VNDV9y', 0, NULL, '2026-07-08 14:30:20', '2026-07-13 16:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `c_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext DEFAULT NULL,
  `subject_area` varchar(1000) DEFAULT NULL,
  `keywords` varchar(1000) DEFAULT NULL,
  `author` varchar(500) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `customquestion` varchar(10) NOT NULL DEFAULT 'no',
  `image` varchar(200) NOT NULL DEFAULT 'admin/books/book.gif',
  `type` varchar(100) DEFAULT NULL,
  `europe` varchar(10) DEFAULT NULL,
  `google` varchar(10) DEFAULT NULL,
  `top` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `file1` varchar(1000) DEFAULT NULL,
  `file2` varchar(1000) DEFAULT NULL,
  `file3` varchar(1000) DEFAULT NULL,
  `file4` varchar(1000) DEFAULT NULL,
  `file5` varchar(1000) DEFAULT NULL,
  `username` varchar(1000) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `user_id`, `c_id`, `name`, `description`, `subject_area`, `keywords`, `author`, `company`, `url`, `customquestion`, `image`, `type`, `europe`, `google`, `top`, `file1`, `file2`, `file3`, `file4`, `file5`, `username`, `ip_address`, `user_agent`, `date`) VALUES
(1, 1, 2, 'The 3 Leadership Behaviors that Drive \r\nFierce Loyalty & Extreme Engagement', '', 'Marketing', '', '', '', '', 'no', '1.JPG', 'Visible to all', 'non-Europe', '', 0, '1.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(2, 1, 1, '3 challenges of securing \r\nand connecting \r\napplication services', '', 'IT', '', '', '', '', 'no', '2.JPG', 'Visible to all', 'non-Europe', '', 0, '2.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(3, 1, 1, '4 Ways to Simplify Your Global M&A With an EOR', '', 'IT', '', '', '', '', 'no', '3.JPG', 'Visible to all', 'non-Europe', '', 0, '3.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(4, 1, 1, 'Securing GenAI', '', 'IT', '', '', '', '', 'no', '4.JPG', 'Visible to all', 'non-Europe', '', 0, '4.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(5, 1, 1, 'Pitfalls That Undermine Your AI Readiness', '', 'IT', '', '', '', '', 'no', '5.JPG', 'Visible to all', 'non-Europe', '', 0, '5.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(6, 1, 2, '5 Ways to Make Your Data Visualizations Pop — and Persuade', '', 'Marketing', '', '', '', '', 'no', '6.JPG', 'Visible to all', 'non-Europe', '', 0, '6.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(7, 1, 5, '7 Compliance Challenges Companies Face When Growing Globally', '', 'Operations', '', '', '', '', 'no', '7.JPG', 'Visible to all', 'non-Europe', '', 0, '7.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(8, 1, 5, '14 Steps to Evaluating & Selecting Business Continuity Software', '', 'Operations', '', '', '', '', 'no', '8.JPG', 'Visible to all', 'non-Europe', '', 0, '8.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(9, 1, 5, 'The golobal EHS Readiness index (GERI) Report', '', 'Operations', '', '', '', '', 'no', '9.JPG', 'Visible to all', 'non-Europe', '', 0, '9.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(10, 1, 4, 'Strategic alignment for Executive, HR, Finance, and Legal leaders.', '', 'HR', '', '', '', '', 'no', '10.JPG', 'Visible to all', 'non-Europe', '', 0, '10.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(11, 1, 4, '2024 Global Workforce Trends How the Global Mindset will Shape the World of Work', '', 'HR', '', '', '', '', 'no', '11.JPG', 'Visible to all', 'non-Europe', '', 0, '11.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(12, 1, 4, 'Global Employer of Record Services', '', 'HR', '', '', '', '', 'no', '12.JPG', 'Visible to all', 'non-Europe', '', 0, '12.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(13, 1, 1, 'AI at Work 2025 Report', '', 'IT', '', '', '', '', 'no', '13.JPG', 'Visible to all', 'non-Europe', '', 0, '13.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(14, 1, 1, 'Enterprise Checklist for AI Governance, Security, and Privacy', '', 'IT', '', '', '', '', 'no', '14.JPG', 'Visible to all', 'non-Europe', '', 0, '14.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(15, 1, 1, 'Accelerate innovation with the latest technology', '', 'IT', '', '', '', '', 'no', '15.JPG', 'Visible to all', 'non-Europe', '', 0, '15.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(16, 1, 2, 'Unify your customer data and transform the customer experience.', '', 'Marketing', '', '', '', '', 'no', '16.JPG', 'Visible to all', 'non-Europe', '', 0, '16.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(17, 1, 1, 'Content management system buyer’s guide.', '', 'IT', '', '', '', '', 'no', '17.JPG', 'Visible to all', 'non-Europe', '', 0, '17.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(18, 1, 1, 'After AI Reinventing Data, Insights, and Action Amidst the Noise', '', 'IT', '', '', '', '', 'no', '18.JPG', 'Visible to all', 'non-Europe', '', 0, '18.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(19, 1, 1, 'AI at Work: Unlocking Global Opportunities', '', 'IT', '', '', '', '', 'no', '19.JPG', 'Visible to all', 'non-Europe', '', 0, '19.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(20, 1, 1, 'A practitioner’s guide to data integration for AI', '', 'IT', '', '', '', '', 'no', '20.JPG', 'Visible to all', 'non-Europe', '', 0, '20.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(21, 1, 2, 'Transformation der Lieferkette für Obst und Gemüse Expertenperspektiven', '', 'Marketing', '', '', '', '', 'no', '21.JPG', 'Visible to all', 'non-Europe', '', 0, '21.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(22, 1, 2, 'Trend- und Technologie-Report für die Lebensmittel- und Getränkebranche', '', 'Marketing', '', '', '', '', 'no', '22.JPG', 'Visible to all', 'non-Europe', '', 0, '22.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(23, 1, 2, 'Food and Beverage Technology and Trends Report', '', 'Marketing', '', '', '', '', 'no', '23.JPG', 'Visible to all', 'non-Europe', '', 0, '23.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(24, 1, 4, 'Acht Schritte zur Implementierung eines ERP-Systems in Ihrem Obst und Gemüse Handelsunternehmen', '', 'HR', '', '', '', '', 'no', '24.JPG', 'Visible to all', 'non-Europe', '', 0, '24.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(25, 1, 1, '4 ways generative AI will transform the way you manage software testing', '', 'IT', '', '', '', '', 'no', '25.JPG', 'Visible to all', 'non-Europe', '', 0, '25.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(26, 1, 2, '7 Planning Activities to Drive ABM Success', '', 'Marketing', '', '', '', '', 'no', '26.JPG', 'Visible to all', 'non-Europe', '', 0, '26.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(27, 1, 1, 'AI Strategies That Will Define GTM Success in 2025', '', 'IT', '', '', '', '', 'no', '27.JPG', 'Visible to all', 'non-Europe', '', 0, '27.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(28, 1, 1, 'Surmonter la complexité : pourquoi les tests de performance sont la clé d’un environnement SAP intég', '', 'IT', '', '', '', '', 'no', '28.JPG', 'Visible to all', 'non-Europe', '', 0, '28.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(29, 1, 1, 'NeoLoad vs LoadRunner : guide comparatif', '', 'IT', '', '', '', '', 'no', '29.JPG', 'Visible to all', 'non-Europe', '', 0, '29.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(30, 1, 3, 'The B2B Marketing & Sales Orchestration Playbook', '', 'Sales', '', '', '', '', 'no', '30.JPG', 'Visible to all', 'non-Europe', '', 0, '30.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(31, 1, 2, 'The Definitive Guide to Choosing an Account-Based Marketing Platform', '', 'Marketing', '', '', '', '', 'no', '31.JPG', 'Visible to all', 'non-Europe', '', 0, '31.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(32, 1, 2, 'Demandbase Advertising Playbook.', '', 'Marketing', '', '', '', '', 'no', '32.JPG', 'Visible to all', 'non-Europe', '', 0, '32.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(33, 1, 1, 'Overcome complexity: Why performance testing is the key to an integrated and modernized SAP environm', '', 'IT', '', '', '', '', 'no', '33.JPG', 'Visible to all', 'non-Europe', '', 0, '33.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(34, 1, 1, 'Address 3 central performance engineering challenges with browserbased testing', '', 'IT', '', '', '', '', 'no', '34.JPG', 'Visible to all', 'non-Europe', '', 0, '34.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(35, 1, 1, 'Early insights, better outcomes: Shifting-left with observability', '', 'IT', '', '', '', '', 'no', '35.JPG', 'Visible to all', 'non-Europe', '', 0, '35.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(36, 1, 5, 'How Automated Testing Helps Improve the Constituent Experience', '', 'Operations', '', '', '', '', 'no', '36.JPG', 'Visible to all', 'non-Europe', '', 0, '36.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(37, 1, 1, 'Redefining the testing center of excellence in the age of Agile, DevOps, and AI', '', 'IT', '', '', '', '', 'no', '37.JPG', 'Visible to all', 'non-Europe', '', 0, '37.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(38, 1, 2, 'Safeguarding SAP performance: Why enterprise SAP teams are switching from LoadRunner to NeoLoad', '', 'Marketing', '', '', '', '', 'no', '38.JPG', 'Visible to all', 'non-Europe', '', 0, '38.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(39, 1, 2, '3 proven ways government agencies can streamline SAP upgrades and migrations', '', 'Marketing', '', '', '', '', 'no', '39.JPG', 'Visible to all', 'non-Europe', '', 0, '39.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(40, 1, 1, 'A guide to getting started in DevOps', '', 'IT', '', '', '', '', 'no', '40.JPG', 'Visible to all', 'non-Europe', '', 0, '40.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(41, 1, 1, 'The Beginner’s Guide to Building Secure Software', '', 'IT', '', '', '', '', 'no', '41.JPG', 'Visible to all', 'non-Europe', '', 0, '41.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(42, 1, 1, 'How to get started using AI in software development', '', 'IT', '', '', '', '', 'no', '42.JPG', 'Visible to all', 'non-Europe', '', 0, '42.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(43, 1, 4, 'So erschließen Sie das volle Potential von KMU* im Zahlungsverkehr', '', 'HR', '', '', '', '', 'no', '43.JPG', 'Visible to all', 'non-Europe', '', 0, '43.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(44, 1, 2, 'Cloudflare Security Brief', '', 'Marketing', '', '', '', '', 'no', '44.JPG', 'Visible to all', 'non-Europe', '', 0, '44.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(45, 1, 1, 'Connectivity cloud, explained:', '', 'IT', '', '', '', '', 'no', '45.JPG', 'Visible to all', 'non-Europe', '', 0, '45.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(46, 1, 4, 'Build your international teams quickly and easily with G-P.', '', 'HR', '', '', '', '', 'no', '46.JPG', 'Visible to all', 'non-Europe', '', 0, '46.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(47, 1, 1, 'Building a Cyberresilient Data Recovery Strategy', '', 'IT', '', '', '', '', 'no', '47.JPG', 'Visible to all', 'non-Europe', '', 0, '47.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(48, 1, 2, 'The Buyer’s Guide', '', 'Marketing', '', '', '', '', 'no', '48.JPG', 'Visible to all', 'non-Europe', '', 0, '48.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(49, 1, 2, 'Leitfaden zur digitalen Transformation für Chief Data Officer', '', 'Marketing', '', '', '', '', 'no', '49.JPG', 'Visible to all', 'non-Europe', '', 0, '49.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(50, 1, 2, 'Le guide du Chief Data Officer pour la transformation numérique', '', 'Marketing', '', '', '', '', 'no', '50.JPG', 'Visible to all', 'non-Europe', '', 0, '50.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(51, 1, 3, 'Charitable Support Across Generations in the UK and Ireland', '', 'Sales', '', '', '', '', 'no', '51.JPG', 'Visible to all', 'non-Europe', '', 0, '51.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(52, 1, 1, 'A CIO’s guide to data lake management for generative AI', '', 'IT', '', '', '', '', 'no', '52.JPG', 'Visible to all', 'non-Europe', '', 0, '52.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(53, 1, 1, 'IP Endpoints: \r\n10 Features on \r\nIntegrators’ Wish List', '', 'IT', '', '', '', '', 'no', '53.JPG', 'Visible to all', 'non-Europe', '', 0, '53.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(54, 1, 1, 'Scaling NiFi for the Enterprise with Cloudera', '', 'IT', '', '', '', '', 'no', '54.JPG', 'Visible to all', 'non-Europe', '', 0, '54.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(55, 1, 1, 'Apache NIFI Dummies', '', 'IT', '', '', '', '', 'no', '55.JPG', 'Visible to all', 'non-Europe', '', 0, '55.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(56, 1, 4, 'Compliance Playbook: How to Improve Global Speed-to-Hire', '', 'HR', '', '', '', '', 'no', '56.JPG', 'Visible to all', 'non-Europe', '', 0, '56.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(57, 1, 4, 'Compliance Workbook for Global Hiring', '', 'HR', '', '', '', '', 'no', '57.JPG', 'Visible to all', 'non-Europe', '', 0, '57.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(58, 1, 5, 'Contact Center Challenges and Trends', '', 'Operations', '', '', '', '', 'no', '58.JPG', 'Visible to all', 'non-Europe', '', 0, '58.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(59, 1, 2, 'The beginner\'s guide to B2C CRM', '', 'Marketing', '', '', '', '', 'no', '59.JPG', 'Visible to all', 'non-Europe', '', 0, '59.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(60, 1, 3, 'Crafting AI Policies in Education BALANCING INNOVATION AND RISK', '', 'Sales', '', '', '', '', 'no', '60.JPG', 'Visible to all', 'non-Europe', '', 0, '60.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(61, 1, 2, 'Transform content creation with Creative Cloud.', '', 'Marketing', '', '', '', '', 'no', '61.JPG', 'Visible to all', 'non-Europe', '', 0, '61.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(62, 1, 2, 'Creating Quick-fire Content with Adobe Express', '', 'Marketing', '', '', '', '', 'no', '62.JPG', 'Visible to all', 'non-Europe', '', 0, '62.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(63, 1, 2, 'CSR Software Buyer’s Guide', '', 'Marketing', '', '', '', '', 'no', '63.JPG', 'Visible to all', 'non-Europe', '', 0, '63.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(64, 1, 4, 'Darum lohnt sich die Investition in die Mitarbeitergesundheit', '', 'HR', '', '', '', '', 'no', '64.JPG', 'Visible to all', 'non-Europe', '', 0, '64.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(65, 1, 1, 'Centralizing data to accelerate enterprise analytics and AI:', '', 'IT', '', '', '', '', 'no', '65.JPG', 'Visible to all', 'non-Europe', '', 0, '65.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(66, 1, 1, 'Deliver a smooth technology experience to employees and your community with ChromeOS', '', 'IT', '', '', '', '', 'no', '66.JPG', 'Visible to all', 'non-Europe', '', 0, '66.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(67, 1, 4, 'Recruitment Reimagined: A Fresh Perspective on the Private School Faculty Pipeline', '', 'HR', '', '', '', '', 'no', '67.JPG', 'Visible to all', 'non-Europe', '', 0, '67.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(68, 1, 2, 'Why data sharing is a game-changer', '', 'Marketing', '', '', '', '', 'no', '68.JPG', 'Visible to all', 'non-Europe', '', 0, '68.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(69, 1, 1, 'SASE & SSE Platform', '', 'IT', '', '', '', '', 'no', '69.JPG', 'Visible to all', 'non-Europe', '', 0, '69.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(70, 1, 1, 'Modernize security', '', 'IT', '', '', '', '', 'no', '70.JPG', 'Visible to all', 'non-Europe', '', 0, '70.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(71, 1, 3, 'An operating system for the future of public sector work', '', 'Sales', '', '', '', '', 'no', '71.JPG', 'Visible to all', 'non-Europe', '', 0, '71.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(72, 1, 1, 'The AI business revolution: A UK perspective', '', 'IT', '', '', '', '', 'no', '72.JPG', 'Visible to all', 'non-Europe', '', 0, '72.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(73, 1, 1, 'The AI business revolution: A UK perspective', '', 'IT', '', '', '', '', 'no', '73.JPG', 'Visible to all', 'non-Europe', '', 0, '73.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(74, 1, 1, 'An introduction to AI in customer service', '', 'IT', '', '', '', '', 'no', '213.JPG', 'Visible to all', 'non-Europe', '', 0, '213.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(75, 1, 2, 'Exploring CX strategy and technology adoption: A decision maker’s chart', '', 'Marketing', '', '', '', '', 'no', '214.JPG', 'Visible to all', 'non-Europe', '', 0, '214.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(76, 1, 5, 'How long hold times affect your customers’ experience (and your bottom line)', '', 'Operations', '', '', '', '', 'no', '215.JPG', 'Visible to all', 'non-Europe', '', 0, '215.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(77, 1, 1, 'Next-Gen Cloud Contact Center', '', 'IT', '', '', '', '', 'no', '216.JPG', 'Visible to all', 'non-Europe', '', 0, '216.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(78, 1, 5, 'RingCentral Custom Research Study: Wait Times and Customer Service', '', 'Operations', '', '', '', '', 'no', '217.JPG', 'Visible to all', 'non-Europe', '', 0, '217.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(79, 1, 1, '7 steps to a risk-free cloud migration', '', 'IT', '', '', '', '', 'no', '218.JPG', 'Visible to all', 'non-Europe', '', 0, '218.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(80, 1, 1, '2025 trends in cloud communications: The CIO guide', '', 'IT', '', '', '', '', 'no', '219.JPG', 'Visible to all', 'non-Europe', '', 0, '219.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(81, 1, 2, 'Boost Revenue with Smarter Customer Experience', '', 'Marketing', '', '', '', '', 'no', '220.JPG', 'Visible to all', 'non-Europe', '', 0, '220.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(82, 1, 1, 'The CISO guide to cloud communications security', '', 'IT', '', '', '', '', 'no', '221.JPG', 'Visible to all', 'non-Europe', '', 0, '221.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(83, 1, 4, 'Empower Your Frontline Workforce to Drive Business Transformation', '', 'HR', '', '', '', '', 'no', '222.JPG', 'Visible to all', 'non-Europe', '', 0, '222.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(84, 1, 5, 'How RingCentral has modernized some of today’s biggest businesses', '', 'Operations', '', '', '', '', 'no', '223.JPG', 'Visible to all', 'non-Europe', '', 0, '223.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(85, 1, 4, 'How to improve your customer experience by elevating your employee experience', '', 'HR', '', '', '', '', 'no', '224.JPG', 'Visible to all', 'non-Europe', '', 0, '224.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(86, 1, 2, 'How to unlock revenue through connected business communications', '', 'Marketing', '', '', '', '', 'no', '225.JPG', 'Visible to all', 'non-Europe', '', 0, '225.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(87, 1, 1, 'IT Guide to Generative AI in Business Communication', '', 'IT', '', '', '', '', 'no', '226.JPG', 'Visible to all', 'non-Europe', '', 0, '226.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(88, 1, 1, 'IT Guide to Generative AI in Business Communication', '', 'IT', '', '', '', '', 'no', '227.JPG', 'Visible to all', 'non-Europe', '', 0, '227.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(89, 1, 1, 'Navigating AI with RingCentral', '', 'IT', '', '', '', '', 'no', '228.JPG', 'Visible to all', 'non-Europe', '', 0, '228.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(90, 1, 4, '7 reasons to switch your ? on-premises PBX to the cloud', '', 'HR', '', '', '', '', 'no', '229.JPG', 'Visible to all', 'non-Europe', '', 0, '229.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(91, 1, 1, 'Hybrid Work Why it\'s time to move your on-premises PBX to the cloud', '', 'IT', '', '', '', '', 'no', '230.JPG', 'Visible to all', 'non-Europe', '', 0, '230.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(92, 1, 2, 'Responsible AI, governance, and trust in workplace communications', '', 'Marketing', '', '', '', '', 'no', '231.JPG', 'Visible to all', 'non-Europe', '', 0, '231.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(93, 1, 1, 'The key to building a customer-centric culture Combining your unified communications and contact cen', '', 'IT', '', '', '', '', 'no', '232.JPG', 'Visible to all', 'non-Europe', '', 0, '232.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(94, 1, 1, 'Unified Communications as a Service', '', 'IT', '', '', '', '', 'no', '233.JPG', 'Visible to all', 'non-Europe', '', 0, '233.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(95, 1, 1, 'Why now is the best time to move your phone system to the cloud', '', 'IT', '', '', '', '', 'no', '234.JPG', 'Visible to all', 'non-Europe', '', 0, '234.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(96, 1, 2, '7 steps to a risk-free cloud migration', '', 'Marketing', '', '', '', '', 'no', '235.JPG', 'Visible to all', 'non-Europe', '', 0, '235.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(97, 1, 5, '2025 trends in cloud communications: The CIO guide', '', 'Operations', '', '', '', '', 'no', '236.JPG', 'Visible to all', 'non-Europe', '', 0, '236.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(98, 1, 5, 'Boost Revenue with Smarter Customer Experience', '', 'Operations', '', '', '', '', 'no', '237.JPG', 'Visible to all', 'non-Europe', '', 0, '237.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(99, 1, 6, 'The CISO guide to cloud communications security', '', 'Finance', '', '', '', '', 'no', '238.JPG', 'Visible to all', 'non-Europe', '', 0, '238.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(100, 1, 1, 'Empower Your Frontline Workforce to Drive Business Transformation', '', 'IT', '', '', '', '', 'no', '239.JPG', 'Visible to all', 'non-Europe', '', 0, '239.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(101, 1, 1, 'How RingCentral has modernized some of today’s biggest businesses', '', 'IT', '', '', '', '', 'no', '240.JPG', 'Visible to all', 'non-Europe', '', 0, '240.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(102, 1, 2, 'How to improve your customer experience by elevating your employee experience', '', 'Marketing', '', '', '', '', 'no', '241.JPG', 'Visible to all', 'non-Europe', '', 0, '241.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(103, 1, 1, 'How to unlock revenue through connected business communications', '', 'IT', '', '', '', '', 'no', '242.JPG', 'Visible to all', 'non-Europe', '', 0, '242.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(104, 1, 4, 'IT Guide to Generative AI in Business Communication', '', 'HR', '', '', '', '', 'no', '243.JPG', 'Visible to all', 'non-Europe', '', 0, '243.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(105, 1, 5, 'IT Guide to Generative AI in Business Communication', '', 'Operations', '', '', '', '', 'no', '244.JPG', 'Visible to all', 'non-Europe', '', 0, '244.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(106, 1, 4, 'Navigating AI with RingCentral', '', 'HR', '', '', '', '', 'no', '245.JPG', 'Visible to all', 'non-Europe', '', 0, '245.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(107, 1, 4, '7 reasons to switch your ? on-premises PBX to the cloud', '', 'HR', '', '', '', '', 'no', '246.JPG', 'Visible to all', 'non-Europe', '', 0, '246.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(108, 1, 1, 'Hybrid Work Why it\'s time to move your on-premises PBX to the cloud', '', 'IT', '', '', '', '', 'no', '247.JPG', 'Visible to all', 'non-Europe', '', 0, '247.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(109, 1, 1, 'Responsible AI, governance, and trust in workplace communications', '', 'IT', '', '', '', '', 'no', '248.JPG', 'Visible to all', 'non-Europe', '', 0, '248.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(110, 1, 1, 'The key to building a customer-centric culture', '', 'IT', '', '', '', '', 'no', '249.JPG', 'Visible to all', 'non-Europe', '', 0, '249.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(111, 1, 5, 'Unified Communications as a Service', '', 'Operations', '', '', '', '', 'no', '250.JPG', 'Visible to all', 'non-Europe', '', 0, '250.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(112, 1, 5, 'Why now is the best time to move your phone system to the cloud', '', 'Operations', '', '', '', '', 'no', '251.JPG', 'Visible to all', 'non-Europe', '', 0, '251.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(113, 1, 1, '7 reasons to switch ? your on-premises PBX ? to the cloud', '', 'IT', '', '', '', '', 'no', '252.JPG', 'Visible to all', 'non-Europe', '', 0, '252.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(114, 1, 1, '7 steps to a risk-free cloud migration', '', 'IT', '', '', '', '', 'no', '253.JPG', 'Visible to all', 'non-Europe', '', 0, '253.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(115, 1, 1, 'Advanced guide to cloud migration: Minimizing downtime and maximizing ROI', '', 'IT', '', '', '', '', 'no', '254.JPG', 'Visible to all', 'non-Europe', '', 0, '254.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(116, 1, 5, 'From copper to cloud: Why replacing POTS lines is the smart move', '', 'Operations', '', '', '', '', 'no', '255.JPG', 'Visible to all', 'non-Europe', '', 0, '255.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(117, 1, 5, 'Secrets revealed: How moving to the cloud delivers next-level customer experiences', '', 'Operations', '', '', '', '', 'no', '256.JPG', 'Visible to all', 'non-Europe', '', 0, '256.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(118, 1, 5, 'ROI of moving on-premise communications systems to the cloud', '', 'Operations', '', '', '', '', 'no', '257.JPG', 'Visible to all', 'non-Europe', '', 0, '257.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(119, 1, 5, 'Why now is the best time to move your phone system to the cloud', '', 'Operations', '', '', '', '', 'no', '258.JPG', 'Visible to all', 'non-Europe', '', 0, '258.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(120, 1, 5, 'How RingCentral has modernized some of today’s biggest businesses', '', 'Operations', '', '', '', '', 'no', '259.JPG', 'Visible to all', 'non-Europe', '', 0, '259.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(121, 1, 5, 'How to unlock revenue through connected business communications', '', 'Operations', '', '', '', '', 'no', '260.JPG', 'Visible to all', 'non-Europe', '', 0, '260.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(122, 1, 1, 'Navigating AI with RingCentral', '', 'IT', '', '', '', '', 'no', '261.JPG', 'Visible to all', 'non-Europe', '', 0, '261.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(123, 1, 1, '5 ways AI can transform your customer experience', '', 'IT', '', '', '', '', 'no', '262.JPG', 'Visible to all', 'non-Europe', '', 0, '262.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(124, 1, 1, 'An introduction to AI in customer service', '', 'IT', '', '', '', '', 'no', '263.JPG', 'Visible to all', 'non-Europe', '', 0, '263.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(125, 1, 1, 'Measuring CX success: KPIs every business should track', '', 'IT', '', '', '', '', 'no', '264.JPG', 'Visible to all', 'non-Europe', '', 0, '264.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(126, 1, 1, 'Next-Gen Cloud Contact Center', '', 'IT', '', '', '', '', 'no', '265.JPG', 'Visible to all', 'non-Europe', '', 0, '265.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(127, 1, 1, 'Stemming the Tide on the New Era of Fraud', '', 'IT', '', '', '', '', 'no', '266.JPG', 'Visible to all', 'non-Europe', '', 0, '266.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(128, 1, 1, 'What to Say When You Need Them to Pay', '', 'IT', '', '', '', '', 'no', '267.JPG', 'Visible to all', 'non-Europe', '', 0, '267.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(129, 1, 1, '3 WAYS TO EXPAND TECHNOLOGY SERVICES AND STILL CUT COSTS', '', 'IT', '', '', '', '', 'no', '268.JPG', 'Visible to all', 'non-Europe', '', 0, '268.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(130, 1, 1, 'I TAM 2024: The CxO perspective', '', 'IT', '', '', '', '', 'no', '269.JPG', 'Visible to all', 'non-Europe', '', 0, '269.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(131, 1, 5, 'MODERNIZE IT SERVICES AND OPERATIONS WITH AI', '', 'Operations', '', '', '', '', 'no', '270.JPG', 'Visible to all', 'non-Europe', '', 0, '270.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(132, 1, 5, 'REIMAGINE IT SERVICE DELIVERY & OPERATIONS WITH AI AUTOMATION', '', 'Operations', '', '', '', '', 'no', '271.JPG', 'Visible to all', 'non-Europe', '', 0, '271.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(133, 1, 1, 'REVOLUTIONIZING THE LOW-CODE EXPERIENCE: THE POWER OF GENERATIVE AI', '', 'IT', '', '', '', '', 'no', '272.JPG', 'Visible to all', 'non-Europe', '', 0, '272.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(134, 1, 1, 'THE BUSINESS CASE FOR LOW CODE: 4 STRATEGIES FOR AI-LED INNOVATION', '', 'IT', '', '', '', '', 'no', '273.JPG', 'Visible to all', 'non-Europe', '', 0, '273.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(135, 1, 1, 'A HUMAN-CENTERED APPROACH TO THE CONTEMPORARY GLOBAL WORKFORCE', '', 'IT', '', '', '', '', 'no', '274.JPG', 'Visible to all', 'non-Europe', '', 0, '274.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(136, 1, 1, 'A HUMAN-CENTERED APPROACH TO THE CONTEMPORARY GLOBAL WORKFORCE', '', 'IT', '', '', '', '', 'no', '275.JPG', 'Visible to all', 'non-Europe', '', 0, '275.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(137, 1, 1, 'A HUMAN-CENTERED APPROACH TO THE CONTEMPORARY GLOBAL WORKFORCE', '', 'IT', '', '', '', '', 'no', '276.JPG', 'Visible to all', 'non-Europe', '', 0, '276.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(138, 1, 1, 'AECDataInsights Report', '', 'IT', '', '', '', '', 'no', '277.JPG', 'Visible to all', 'non-Europe', '', 0, '277.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(139, 1, 6, 'BUILDING AN AI-READY Data Foundation and Strategy for Financial Services Marketing', '', 'Finance', '', '', '', '', 'no', '278.JPG', 'Visible to all', 'non-Europe', '', 0, '278.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(140, 1, 2, 'Beyond Blueprints A GUIDE TO DATA-DRIVEN DESIGN AND CONSTRUCTION', '', 'Marketing', '', '', '', '', 'no', '279.JPG', 'Visible to all', 'non-Europe', '', 0, '279.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(141, 1, 2, 'GBBN Architects Improves Work-Life Balance With Egnyte', '', 'Marketing', '', '', '', '', 'no', '280.JPG', 'Visible to all', 'non-Europe', '', 0, '280.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(142, 1, 2, 'PCL Construction Reduces IT Costs Despite Doubling Data', '', 'Marketing', '', '', '', '', 'no', '281.JPG', 'Visible to all', 'non-Europe', '', 0, '281.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(143, 1, 2, 'Why Top-Ranked ENR Firms Are Fast-Tracking Digital Transformation With E', '', 'Marketing', '', '', '', '', 'no', '282.JPG', 'Visible to all', 'non-Europe', '', 0, '282.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(144, 1, 6, 'BUILDING AN AI-READY Data Foundation and Strategy for Financial Services Marketing', '', 'Finance', '', '', '', '', 'no', '283.JPG', 'Visible to all', 'non-Europe', '', 0, '283.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(145, 1, 2, 'The evolution of asset defect elimination', '', 'Marketing', '', '', '', '', 'no', '284.JPG', 'Visible to all', 'non-Europe', '', 0, '284.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(146, 1, 2, 'The evolution of asset defect elimination', '', 'Marketing', '', '', '', '', 'no', '285.JPG', 'Visible to all', 'non-Europe', '', 0, '285.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(147, 1, 2, 'The Retailization of the Private Markets', '', 'Marketing', '', '', '', '', 'no', '286.JPG', 'Visible to all', 'non-Europe', '', 0, '286.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(148, 1, 1, 'The Role of Software in Improving Business Resilience', '', 'IT', '', '', '', '', 'no', '287.JPG', 'Visible to all', 'non-Europe', '', 0, '287.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(149, 1, 1, 'The Secret to Scale: Adobe Express', '', 'IT', '', '', '', '', 'no', '288.JPG', 'Visible to all', 'non-Europe', '', 0, '288.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(150, 1, 1, 'The Top Risks Facing Australian Businesses Today', '', 'IT', '', '', '', '', 'no', '289.JPG', 'Visible to all', 'non-Europe', '', 0, '289.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(151, 1, 3, 'The Total Economic Impact™ Of Salesforce For Consumer Goods', '', 'Sales', '', '', '', '', 'no', '290.JPG', 'Visible to all', 'non-Europe', '', 0, '290.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(152, 1, 1, 'The Importance of Charity Fundraising Technology', '', 'IT', '', '', '', '', 'no', '291.JPG', 'Visible to all', 'non-Europe', '', 0, '291.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(153, 1, 1, 'Thrive in the cookieless future with smart data.', '', 'IT', '', '', '', '', 'no', '292.JPG', 'Visible to all', 'non-Europe', '', 0, '292.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(154, 1, 1, 'TRENDS 2025 What to watch in the retirement industry', '', 'IT', '', '', '', '', 'no', '293.JPG', 'Visible to all', 'non-Europe', '', 0, '293.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(155, 1, 1, 'O potencial inexplorado dos dados não estruturados', '', 'IT', '', '', '', '', 'no', '294.JPG', 'Visible to all', 'non-Europe', '', 0, '294.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(156, 1, 3, 'Why cloud? Why now?', '', 'Sales', '', '', '', '', 'no', '295.JPG', 'Visible to all', 'non-Europe', '', 0, '295.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(157, 1, 3, 'World at Work The Future of Global Employment', '', 'Sales', '', '', '', '', 'no', '296.JPG', 'Visible to all', 'non-Europe', '', 0, '296.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(158, 1, 3, 'Your Global Growth Playbook: How to Build and Scale a Successful Remote-First Company', '', 'Sales', '', '', '', '', 'no', '297.JPG', 'Visible to all', 'non-Europe', '', 0, '297.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(159, 1, 3, 'CSR Technology That Supports All Stakeholders', '', 'Sales', '', '', '', '', 'no', '298.JPG', 'Visible to all', 'non-Europe', '', 0, '298.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(160, 1, 3, 'Powering Purpose, Influencing Impact', '', 'Sales', '', '', '', '', 'no', '299.JPG', 'Visible to all', 'non-Europe', '', 0, '299.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(161, 1, 3, 'Zscaler ThreatLabz 2024 VPN Risk Report', '', 'Sales', '', '', '', '', 'no', '300.JPG', 'Visible to all', 'non-Europe', '', 0, '300.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(162, 1, 3, 'Zscaler ThreatLabz 2024 AI Security Report', '', 'Sales', '', '', '', '', 'no', '301.JPG', 'Visible to all', 'non-Europe', '', 0, '301.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(163, 1, 3, 'The top 3 benefits of SASE and how to achieve them', '', 'Sales', '', '', '', '', 'no', '302.JPG', 'Visible to all', 'non-Europe', '', 0, '302.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(164, 1, 1, 'Rethinking Enterprise SD-WAN with Zero Trust', '', 'IT', '', '', '', '', 'no', '303.JPG', 'Visible to all', 'non-Europe', '', 0, '303.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(165, 1, 1, 'THE BLUEPRINT: GOING BEYOND TRADITIONAL\r\nBUSINESS INTENT DATA', '', 'IT', '', '', '', '', 'no', '318.JPG', 'Visible to all', 'non-Europe', '', 0, '318.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(166, 1, 1, 'Apple Device Security', '', 'IT', '', '', '', '', 'no', '319.JPG', 'Visible to all', 'non-Europe', '', 0, '319.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(167, 1, 1, 'Filling the Gap: macOS Security', '', 'IT', '', '', '', '', 'no', '320.JPG', 'Visible to all', 'non-Europe', '', 0, '320.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(168, 1, 1, 'MacManagement', '', 'IT', '', '', '', '', 'no', '321.JPG', 'Visible to all', 'non-Europe', '', 0, '321.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(169, 1, 1, 'Mac Management and Security in the Enterprise', '', 'IT', '', '', '', '', 'no', '322.JPG', 'Visible to all', 'non-Europe', '', 0, '322.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(170, 1, 1, 'Modern Management: 3 Benefits of Adopting Declarative Device Management Today', '', 'IT', '', '', '', '', 'no', '323.JPG', 'Visible to all', 'non-Europe', '', 0, '323.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(171, 1, 1, 'Top Security Practices for Mac Management', '', 'IT', '', '', '', '', 'no', '324.JPG', 'Visible to all', 'non-Europe', '', 0, '324.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(172, 1, 1, 'Automate away your biggest source-to-pay challenges', '', 'IT', '', '', '', '', 'no', '325.JPG', 'Visible to all', 'non-Europe', '', 0, '325.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(173, 1, 5, '4 benefits of automating your source-to-pay operations', '', 'Operations', '', '', '', '', 'no', '326.JPG', 'Visible to all', 'non-Europe', '', 0, '326.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(174, 1, 6, 'Future of Finance and Supply Chain Processes', '', 'Finance', '', '', '', '', 'no', '327.JPG', 'Visible to all', 'non-Europe', '', 0, '327.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(175, 1, 1, '6 steps to a stronger security posture through automation', '', 'IT', '', '', '', '', 'no', '328.JPG', 'Visible to all', 'non-Europe', '', 0, '328.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(176, 1, 5, 'Security Operations Use Case Guide', '', 'Operations', '', '', '', '', 'no', '329.JPG', 'Visible to all', 'non-Europe', '', 0, '329.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(177, 1, 5, 'Security Operations Use Case Guide', '', 'Operations', '', '', '', '', 'no', '330.JPG', 'Visible to all', 'non-Europe', '', 0, '330.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(178, 1, 1, '3 WAYS TO EXPAND TECHNOLOGY SERVICES AND STILL CUT COSTS', '', 'IT', '', '', '', '', 'no', '331.JPG', 'Visible to all', 'non-Europe', '', 0, '331.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(179, 1, 5, 'MODERNIZE IT SERVICES AND OPERATIONS WITH AI', '', 'Operations', '', '', '', '', 'no', '332.JPG', 'Visible to all', 'non-Europe', '', 0, '332.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(180, 1, 5, 'REIMAGINE IT SERVICE DELIVERY & OPERATIONS WITH AI AUTOMATION', '', 'Operations', '', '', '', '', 'no', '333.JPG', 'Visible to all', 'non-Europe', '', 0, '333.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(181, 1, 1, '5 ways AI can transform your customer experience', '', 'IT', '', '', '', '', 'no', '334.JPG', 'Visible to all', 'non-Europe', '', 0, '334.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(182, 1, 1, 'Accelerating intelligence: the AI highway for automotive advancements', '', 'IT', '', '', '', '', 'no', '335.JPG', 'Visible to all', 'non-Europe', '', 0, '335.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(183, 1, 1, 'Tackle Data Center Construction Demands Head-On With Vertical Supply Chain Integration', '', 'IT', '', '', '', '', 'no', '336.JPG', 'Visible to all', 'non-Europe', '', 0, '336.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(184, 1, 1, 'How to comply with RED DA, the CRA and other new EU cybersecurity regulations', '', 'IT', '', '', '', '', 'no', '337.JPG', 'Visible to all', 'non-Europe', '', 0, '337.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(185, 1, 1, 'Integrating Scenario Planning with Grant Strategy', '', 'IT', '', '', '', '', 'no', '338.JPG', 'Visible to all', 'non-Europe', '', 0, '338.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(186, 1, 2, 'Small Business, Big Opportunities: How to Win the Untapped SMB Market', '', 'Marketing', '', '', '', '', 'no', '339.JPG', 'Visible to all', 'non-Europe', '', 0, '339.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(187, 1, 1, 'Large health system partners with Labcorp to reduce employee onboarding time and solve staffing chal', '', 'IT', '', '', '', '', 'no', '340.JPG', 'Visible to all', 'non-Europe', '', 0, '340.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(188, 1, 1, 'AI + DATA PREDICTIONS 2025', '', 'IT', '', '', '', '', 'no', '341.JPG', 'Visible to all', 'non-Europe', '', 0, '341.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(189, 1, 1, 'Eye-opening research about who is shopping for life insurance', '', 'IT', '', '', '', '', 'no', '342.JPG', 'Visible to all', 'non-Europe', '', 0, '342.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(190, 1, 2, 'How B2B marketers are refining content strategy for the AI era', '', 'Marketing', '', '', '', '', 'no', '343.JPG', 'Visible to all', 'non-Europe', '', 0, '343.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(191, 1, 1, 'Quality Matters A Performance Improvement Guide for Healthcare Providers', '', 'IT', '', '', '', '', 'no', '344.JPG', 'Visible to all', 'non-Europe', '', 0, '344.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(192, 1, 1, 'Revolutionizing Biopharma Customer Engagement Leveraging genAI and Agentforce to create a frictionle', '', 'IT', '', '', '', '', 'no', '345.JPG', 'Visible to all', 'non-Europe', '', 0, '345.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(193, 1, 1, '2025 Leave of Absence Forecast', '', 'IT', '', '', '', '', 'no', '346.JPG', 'Visible to all', 'non-Europe', '', 0, '346.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(194, 1, 1, 'SPV Global Outlook 2025', '', 'IT', '', '', '', '', 'no', '347.JPG', 'Visible to all', 'non-Europe', '', 0, '347.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(195, 1, 1, 'The Ul??mate Guide to Business Analy??cs So??ware: Challenges, Solu??ons, and Best Prac??ces', '', 'IT', '', '', '', '', 'no', '348.JPG', 'Visible to all', 'non-Europe', '', 0, '348.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(196, 1, 1, 'Risk doesn’t stand still. Neither should your ERM', '', 'IT', '', '', '', '', 'no', '349.JPG', 'Visible to all', 'non-Europe', '', 0, '349.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(197, 1, 1, 'Whistleblowing and Incident Management Benchmark Report', '', 'IT', '', '', '', '', 'no', '350.JPG', 'Visible to all', 'non-Europe', '', 0, '350.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(198, 1, 1, 'AI INFRA Summit', '', 'IT', '', '', '', '', 'no', '351.JPG', 'Visible to all', 'non-Europe', '', 0, '351.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(199, 1, 1, '5 Ways to Improve Profitability with Lean Workflows', '', 'IT', '', '', '', '', 'no', '352.JPG', 'Visible to all', 'non-Europe', '', 0, '352.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(200, 1, 1, 'The Supply Chain Back Office Is Broken', '', 'IT', '', '', '', '', 'no', '353.JPG', 'Visible to all', 'non-Europe', '', 0, '353.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(201, 1, 6, 'How to lead complex change when adopting AI in finance', '', 'Finance', '', '', '', '', 'no', '354.JPG', 'Visible to all', 'non-Europe', '', 0, '354.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(202, 1, 1, '2025 KI- und digitale Trends_ Daten und Erkenntnisse', '', 'IT', '', '', '', '', 'no', '355.JPG', 'Visible to all', 'non-Europe', '', 0, '355.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(203, 1, 6, 'Financial Services Security and Performance:', '', 'Finance', '', '', '', '', 'no', '356.JPG', 'Visible to all', 'non-Europe', '', 0, '356.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(204, 1, 1, 'Four pain points in healthcare data migration — and how AI can help', '', 'IT', '', '', '', '', 'no', '357.JPG', 'Visible to all', 'non-Europe', '', 0, '357.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(205, 1, 1, 'How security data fabric is weaving a new era of cybersecurity', '', 'IT', '', '', '', '', 'no', '358.JPG', 'Visible to all', 'non-Europe', '', 0, '358.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(206, 1, 1, '7 steps to a risk-free cloud migration', '', 'IT', '', '', '', '', 'no', '359.JPG', 'Visible to all', 'non-Europe', '', 0, '359.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(207, 1, 1, '2025 trends in cloud communications: The CIO guide', '', 'IT', '', '', '', '', 'no', '360.JPG', 'Visible to all', 'non-Europe', '', 0, '360.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(208, 1, 1, 'Boost Revenue with Smarter Customer Experience', '', 'IT', '', '', '', '', 'no', '361.JPG', 'Visible to all', 'non-Europe', '', 0, '361.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(209, 1, 1, 'The CISO guide to cloud communications security', '', 'IT', '', '', '', '', 'no', '362.JPG', 'Visible to all', 'non-Europe', '', 0, '362.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(210, 1, 1, 'Empower Your Frontline Workforce to Drive Business Transformation', '', 'IT', '', '', '', '', 'no', '363.JPG', 'Visible to all', 'non-Europe', '', 0, '363.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(211, 1, 1, 'How RingCentral has modernized some of today’s biggest businesses', '', 'IT', '', '', '', '', 'no', '364.JPG', 'Visible to all', 'non-Europe', '', 0, '364.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(212, 1, 1, 'How to improve your customer experience by elevating your employee experience', '', 'IT', '', '', '', '', 'no', '365.JPG', 'Visible to all', 'non-Europe', '', 0, '365.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(213, 1, 1, 'How to unlock revenue through connected business communications', '', 'IT', '', '', '', '', 'no', '366.JPG', 'Visible to all', 'non-Europe', '', 0, '366.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(214, 1, 2, 'IT Guide to Generative AI in Business Communication', '', 'Marketing', '', '', '', '', 'no', '367.JPG', 'Visible to all', 'non-Europe', '', 0, '367.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(215, 1, 5, 'Navigating AI with RingCentral', '', 'Operations', '', '', '', '', 'no', '368.JPG', 'Visible to all', 'non-Europe', '', 0, '368.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57');
INSERT INTO `books` (`book_id`, `user_id`, `c_id`, `name`, `description`, `subject_area`, `keywords`, `author`, `company`, `url`, `customquestion`, `image`, `type`, `europe`, `google`, `top`, `file1`, `file2`, `file3`, `file4`, `file5`, `username`, `ip_address`, `user_agent`, `date`) VALUES
(216, 1, 1, '7 reasons to switch your on premises PBX to the cloud', '', 'IT', '', '', '', '', 'no', '369.JPG', 'Visible to all', 'non-Europe', '', 0, '369.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(217, 1, 5, 'Hybrid Work Why it\'s time to move your on-premises PBX to the cloud', '', 'Operations', '', '', '', '', 'no', '370.JPG', 'Visible to all', 'non-Europe', '', 0, '370.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(218, 1, 1, 'Responsible AI, governance, and trust in workplace communications', '', 'IT', '', '', '', '', 'no', '371.JPG', 'Visible to all', 'non-Europe', '', 0, '371.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(219, 1, 1, 'The key to building a customer-centric culture', '', 'IT', '', '', '', '', 'no', '372.JPG', 'Visible to all', 'non-Europe', '', 0, '372.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(220, 1, 2, 'UCaas for Dummies', '', 'Marketing', '', '', '', '', 'no', '373.JPG', 'Visible to all', 'non-Europe', '', 0, '373.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(221, 1, 1, 'Why now is the best time to move your phone system to the cloud', '', 'IT', '', '', '', '', 'no', '374.JPG', 'Visible to all', 'non-Europe', '', 0, '374.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(222, 1, 4, '2025 trends in cloud communications: The CIO guide', '', 'HR', '', '', '', '', 'no', '375.JPG', 'Visible to all', 'non-Europe', '', 0, '375.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(223, 1, 5, 'Boost Revenue with Smarter Customer Experience', '', 'Operations', '', '', '', '', 'no', '376.JPG', 'Visible to all', 'non-Europe', '', 0, '376.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(224, 1, 4, 'The CISO guide to cloud communications security', '', 'HR', '', '', '', '', 'no', '377.JPG', 'Visible to all', 'non-Europe', '', 0, '377.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(225, 1, 2, '7 reasons to switch your on premises PBX to the cloud', '', 'Marketing', '', '', '', '', 'no', '378.JPG', 'Visible to all', 'non-Europe', '', 0, '378.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(226, 1, 1, 'An introduction to AI in customer service', '', 'IT', '', '', '', '', 'no', '379.JPG', 'Visible to all', 'non-Europe', '', 0, '379.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(227, 1, 1, 'Exploring CX strategy and technology adoption: A decisionmaker’s chart', '', 'IT', '', '', '', '', 'no', '380.JPG', 'Visible to all', 'non-Europe', '', 0, '380.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(228, 1, 1, 'From UCaaS to CCaaS: When your business needs a dedicated contact center', '', 'IT', '', '', '', '', 'no', '381.JPG', 'Visible to all', 'non-Europe', '', 0, '381.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(229, 1, 1, 'Measuring CX success: KPIs every business should track', '', 'IT', '', '', '', '', 'no', '382.JPG', 'Visible to all', 'non-Europe', '', 0, '382.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(230, 1, 4, 'Next-Gen Cloud Contact Centers For Dummies', '', 'HR', '', '', '', '', 'no', '383.JPG', 'Visible to all', 'non-Europe', '', 0, '383.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(231, 1, 1, 'An AI-powered contact center', '', 'IT', '', '', '', '', 'no', '384.JPG', 'Visible to all', 'non-Europe', '', 0, '384.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(232, 1, 2, 'How long hold times affect your customers’ experience (and your bottom line)', '', 'Marketing', '', '', '', '', 'no', '385.JPG', 'Visible to all', 'non-Europe', '', 0, '385.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(233, 1, 1, 'RingCentral Custom Research Study: Wait Times and Customer Service', '', 'IT', '', '', '', '', 'no', '386.JPG', 'Visible to all', 'non-Europe', '', 0, '386.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(234, 1, 1, 'Using RingCX to boost your KPIs', '', 'IT', '', '', '', '', 'no', '387.JPG', 'Visible to all', 'non-Europe', '', 0, '387.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(235, 1, 1, '5 reasons why cloud communications help scale your business', '', 'IT', '', '', '', '', 'no', '388.JPG', 'Visible to all', 'non-Europe', '', 0, '388.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(236, 1, 1, '7 reasons to switch your on-premises PBX to the cloud', '', 'IT', '', '', '', '', 'no', '389.JPG', 'Visible to all', 'non-Europe', '', 0, '389.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(237, 1, 2, 'Advanced guide to cloud migration: Minimizing downtime and maximizing ROI', '', 'Marketing', '', '', '', '', 'no', '390.JPG', 'Visible to all', 'non-Europe', '', 0, '390.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(238, 1, 1, 'From copper to cloud: Why replacing POTS lines is the smart move', '', 'IT', '', '', '', '', 'no', '391.JPG', 'Visible to all', 'non-Europe', '', 0, '391.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(239, 1, 4, 'Secrets revealed: How moving to the cloud delivers next-level customer experiences', '', 'HR', '', '', '', '', 'no', '392.JPG', 'Visible to all', 'non-Europe', '', 0, '392.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(240, 1, 5, 'ROI of moving on-premise communications systems to the cloud', '', 'Operations', '', '', '', '', 'no', '393.JPG', 'Visible to all', 'non-Europe', '', 0, '393.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(241, 1, 4, 'Driving loyalty with experience', '', 'HR', '', '', '', '', 'no', '394.JPG', 'Visible to all', 'non-Europe', '', 0, '394.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(242, 1, 2, '4 Common FinOps Mistakes and How to Avoid Them', '', 'Marketing', '', '', '', '', 'no', '395.JPG', 'Visible to all', 'non-Europe', '', 0, '395.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(243, 1, 1, 'The 2025 State of eClose Adoption Report', '', 'IT', '', '', '', '', 'no', '396.JPG', 'Visible to all', 'non-Europe', '', 0, '396.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(244, 1, 1, 'PULLEYS \r\nAND BELT \r\nDRIVES', '', 'IT', '', '', '', '', 'no', '424.JPG', 'Visible to all', 'non-Europe', '', 0, '424.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(245, 1, 1, 'DNS and the \r\nThreat of DDoS', '', 'IT', '', '', '', '', 'no', '426.JPG', 'Visible to all', 'non-Europe', '', 0, '426.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(246, 1, 1, 'DOL Final Overtime Rules\r\nQuickstart Guide for Employer', '', 'IT', '', '', '', '', 'no', '427.JPG', 'Visible to all', 'non-Europe', '', 0, '427.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(247, 1, 4, 'The Supply Chain Executive’s Guide', '', 'HR', '', '', '', '', 'no', '428.JPG', 'Visible to all', 'non-Europe', '', 0, '428.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(248, 1, 1, 'Trade Turbulence: \r\nHarnessing AI to Navigate \r\nthe Global Trade Stage', '', 'IT', '', '', '', '', 'no', '429.JPG', 'Visible to all', 'non-Europe', '', 0, '429.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(249, 1, 2, 'Travel & \r\nExpense 2025', '', 'Marketing', '', '', '', '', 'no', '430.JPG', 'Visible to all', 'non-Europe', '', 0, '430.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(250, 1, 1, 'Employee travel \r\nand expense 2.0: \r\nNew realities, new \r\nsolutions', '', 'IT', '', '', '', '', 'no', '431.JPG', 'Visible to all', 'non-Europe', '', 0, '431.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(251, 1, 1, 'Leading the charge, \r\nleading the change \r\nin travel management', '', 'IT', '', '', '', '', 'no', '432.JPG', 'Visible to all', 'non-Europe', '', 0, '432.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(252, 1, 2, 'Embracing an \r\nEvolving World: \r\nNew and Growing \r\nAsset Classes in \r\nPrivate Markets', '', 'Marketing', '', '', '', '', 'no', '433.JPG', 'Visible to all', 'non-Europe', '', 0, '433.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(253, 1, 1, 'Social media \r\nbenchmarks', '', 'IT', '', '', '', '', 'no', '434.JPG', 'Visible to all', 'non-Europe', '', 0, '434.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(254, 1, 1, 'Employee vs. Contractor:\r\nThe Complete Guide to International \r\nWorker Classification', '', 'IT', '', '', '', '', 'no', '435.JPG', 'Visible to all', 'non-Europe', '', 0, '435.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(255, 1, 1, 'The Essential \r\nEmployee Management\r\nToolkit for HR Leaders ', '', 'IT', '', '', '', '', 'no', '436.JPG', 'Visible to all', 'non-Europe', '', 0, '436.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(256, 1, 2, 'Encouraging \r\nEmployee Generosity', '', 'Marketing', '', '', '', '', 'no', '437.JPG', 'Visible to all', 'non-Europe', '', 0, '437.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(257, 1, 1, 'Ensuring Document Security', '', 'IT', '', '', '', '', 'no', '438.JPG', 'Visible to all', 'non-Europe', '', 0, '438.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(259, 1, 5, 'Scale content \r\ncreation with \r\nAdobe Express', '', 'Operations', '', '', '', '', 'no', '441.JPG', 'Visible to all', 'non-Europe', '', 0, '441.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(260, 1, 2, 'Redefining Connectivity \r\nfor AI-Driven Enterprises', '', 'Marketing', '', '', '', '', 'no', '442.JPG', 'Visible to all', 'non-Europe', '', 0, '442.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(261, 1, 1, 'Creative Trends 2025', '', 'IT', '', '', '', '', 'no', '443.JPG', 'Visible to all', 'non-Europe', '', 0, '443.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(262, 1, 1, 'THE FIRST 90 DAYS: ENGAGEMENT CHECKLIST', '', 'IT', '', '', '', '', 'no', '444.JPG', 'Visible to all', 'non-Europe', '', 0, '444.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(263, 1, 1, 'Flexible Fitness und Wellness Benefits', '', 'IT', '', '', '', '', 'no', '445.JPG', 'Visible to all', 'non-Europe', '', 0, '445.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(264, 1, 2, 'PERSISTENT RISKS OF\r\nCONNECTED MEDICAL DEVICES', '', 'Marketing', '', '', '', '', 'no', '450.JPG', 'Visible to all', 'non-Europe', '', 0, '450.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(265, 1, 1, 'How to Effectively Implement \r\nISA 99 / IEC 62443', '', 'IT', '', '', '', '', 'no', '451.JPG', 'Visible to all', 'non-Europe', '', 0, '451.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(266, 1, 1, 'Reach Zero Trust\r\nMandates with an \r\nAdaptive Approach', '', 'IT', '', '', '', '', 'no', '454.JPG', 'Visible to all', 'non-Europe', '', 0, '454.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(269, 1, 5, 'Deploying a Single Multicloud Networking \r\nOperational Model with Aviatrix and Equinix or \r\nMegaport', '', 'Operations', '', '', '', '', 'no', '459.JPG', 'Visible to all', 'non-Europe', '', 0, '459.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(271, 1, 1, 'Gesunde Führung', '', 'IT', '', '', '', '', 'no', '463.JPG', 'Visible to all', 'non-Europe', '', 0, '463.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(272, 1, 1, 'Give customers \r\nself-service options \r\nwith ChromeOS', '', 'IT', '', '', '', '', 'no', '466.JPG', 'Visible to all', 'non-Europe', '', 0, '466.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(274, 1, 4, 'Global Guide to Hiring \r\nIndependent Contractors:\r\nUS & Canada', '', 'HR', '', '', '', '', 'no', '468.JPG', 'Visible to all', 'non-Europe', '', 0, '468.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(275, 1, 4, 'global hiring guide for Startup', '', 'HR', '', '', '', '', 'no', '469.JPG', 'Visible to all', 'non-Europe', '', 0, '469.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(276, 1, 4, 'Global Hiring Guide:\r\nTop Emerging Tech Hubs', '', 'HR', '', '', '', '', 'no', '470.JPG', 'Visible to all', 'non-Europe', '', 0, '470.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(277, 1, 5, 'Preparing for a Future \r\nPowered by Generative AI', '', 'Operations', '', '', '', '', 'no', '471.JPG', 'Visible to all', 'non-Europe', '', 0, '471.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(278, 1, 1, 'Job Accommodations \r\nForecast', '', 'IT', '', '', '', '', 'no', '473.JPG', 'Visible to all', 'non-Europe', '', 0, '473.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(279, 1, 1, 'How to Modernize \r\nand Automate \r\nFMLA Management', '', 'IT', '', '', '', '', 'no', '474.JPG', 'Visible to all', 'non-Europe', '', 0, '474.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(280, 1, 5, 'Minds:\r\n5 Pillars for Improving \r\nMental Health at Scale \r\nwith Digital Apps', '', 'Operations', '', '', '', '', 'no', '475.JPG', 'Visible to all', 'non-Europe', '', 0, '475.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(281, 1, 5, 'How to Get in \r\nShape for AI', '', 'Operations', '', '', '', '', 'no', '484.JPG', 'Visible to all', 'non-Europe', '', 0, '484.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(282, 1, 1, 'How to leverage business \r\nAI in travel and expense \r\nto gain a competitive\r\nadvantage', '', 'IT', '', '', '', '', 'no', '485.JPG', 'Visible to all', 'non-Europe', '', 0, '485.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(283, 1, 1, 'How Slack AI \r\nmoves work \r\nforward faster', '', 'IT', '', '', '', '', 'no', '486.JPG', 'Visible to all', 'non-Europe', '', 0, '486.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(284, 1, 5, 'How to Choose \r\na Fundraising \r\nCRM Solution', '', 'Operations', '', '', '', '', 'no', '488.JPG', 'Visible to all', 'non-Europe', '', 0, '488.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(285, 1, 5, 'HR in 2025:\r\nInsights & Predictions', '', 'Operations', '', '', '', '', 'no', '489.JPG', 'Visible to all', 'non-Europe', '', 0, '489.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(286, 1, 6, 'How to Modernize \r\nand Automate \r\nFMLA Management', '', 'Finance', '', '', '', '', 'no', '490.JPG', 'Visible to all', 'non-Europe', '', 0, '490.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(287, 1, 1, 'Is Your Next Hire Hiding in Plain Sight?\r\nHR’s Guide to Internal Recruiting', '', 'IT', '', '', '', '', 'no', '491.JPG', 'Visible to all', 'non-Europe', '', 0, '491.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(288, 1, 2, 'IDC MarketScape: Worldwide Customer Data Platforms \r\nFocused on B2C Users 2024–2025 Vendor Assessmen', '', 'Marketing', '', '', '', '', 'no', '494.JPG', 'Visible to all', 'non-Europe', '', 0, '494.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(289, 1, 5, 'Industry Insights \r\nReport: AI Edition', '', 'Operations', '', '', '', '', 'no', '495.JPG', 'Visible to all', 'non-Europe', '', 0, '495.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(290, 1, 6, 'ENSURING \r\nENTERPRISE-GRADE\r\nNETWORK SERVICES \r\nFOR AWS', '', 'Finance', '', '', '', '', 'no', '496.JPG', 'Visible to all', 'non-Europe', '', 0, '496.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(291, 1, 5, 'Optimizing Cloud Migrations and \r\nHybrid Cloud Operations', '', 'Operations', '', '', '', '', 'no', '498.JPG', 'Visible to all', 'non-Europe', '', 0, '498.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(292, 1, 5, 'Optimizing Cloud Migrations and Hybrid\r\nCloud Operations', '', 'Operations', '', '', '', '', 'no', '499.JPG', 'Visible to all', 'non-Europe', '', 0, '499.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(293, 1, 6, 'STREAMLINE \r\nYOUR MOVE \r\nTO AWS', '', 'Finance', '', '', '', '', 'no', '501.JPG', 'Visible to all', 'non-Europe', '', 0, '501.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(294, 1, 1, 'Investing in HR Software', '', 'IT', '', '', '', '', 'no', '503.JPG', 'Visible to all', 'non-Europe', '', 0, '503.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(295, 1, 1, 'How JB Hi-Fi ?\r\nis winning online \r\nretail with Shopify', '', 'IT', '', '', '', '', 'no', '504.JPG', 'Visible to all', 'non-Europe', '', 0, '504.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(296, 1, 4, 'Ensuring School Safety trough', '', 'HR', '', '', '', '', 'no', '509.JPG', 'Visible to all', 'non-Europe', '', 0, '509.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(297, 1, 4, 'KPMG global tech \r\nreport: Consumer \r\nand retail insights', '', 'HR', '', '', '', '', 'no', '510.JPG', 'Visible to all', 'non-Europe', '', 0, '510.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(298, 1, 2, 'Accounts Payable Automation', '', 'Marketing', '', '', '', '', 'no', '511.JPG', 'Visible to all', 'non-Europe', '', 0, '511.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(299, 1, 2, 'Your\r\n Automation\r\nJourney\r\n', '', 'Marketing', '', '', '', '', 'no', '513.JPG', 'Visible to all', 'non-Europe', '', 0, '513.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(300, 1, 6, 'The Finance Automation Handbook for Busniess Leaders', '', 'Finance', '', '', '', '', 'no', '515.JPG', 'Visible to all', 'non-Europe', '', 0, '515.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(301, 1, 6, 'Your Guide To The Lastest Trends In Finance', '', 'Finance', '', '', '', '', 'no', '517.JPG', 'Visible to all', 'non-Europe', '', 0, '517.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(302, 1, 1, 'Top 7 Global Employment \r\nChallenges', '', 'IT', '', '', '', '', 'no', '520.JPG', 'Visible to all', 'non-Europe', '', 0, '520.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(303, 1, 1, 'Top 8 Crisis & Security \r\nThreats to Watch \r\nin 2025', '', 'IT', '', '', '', '', 'no', '521.JPG', 'Visible to all', 'non-Europe', '', 0, '521.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(304, 1, 2, '2025 Microsoft Vulnerabilities Report', '', 'Marketing', '', '', '', '', 'no', '74.jpg', 'Visible to all', 'non-Europe', '', 0, '74.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(305, 1, 1, 'Generative AI Gifts', '', 'IT', '', '', '', '', 'no', '75.jpg', 'Visible to all', 'non-Europe', '', 0, '75.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(306, 1, 1, '5 Laptop Manageability Challenges for IT Teams and Resellers', '', 'IT', '', '', '', '', 'no', '76.jpg', 'Visible to all', 'non-Europe', '', 0, '76.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(307, 1, 1, 'Cloud Collaboration Powering the Future of Hybrid Work', '', 'IT', '', '', '', '', 'no', '77.jpg', 'Visible to all', 'non-Europe', '', 0, '77.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(308, 1, 1, 'Why Suppliers Play a Key Role in Your Sustainability Efforts', '', 'IT', '', '', '', '', 'no', '78.jpg', 'Visible to all', 'non-Europe', '', 0, '78.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(309, 1, 1, 'Real-World Data Enriches Clinical Study Data for Deeper Insights', '', 'IT', '', '', '', '', 'no', '79.jpg', 'Visible to all', 'non-Europe', '', 0, '79.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(310, 1, 4, 'The top 5 HR trends today', '', 'HR', '', '', '', '', 'no', '80.jpg', 'Visible to all', 'non-Europe', '', 0, '80.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(311, 1, 4, 'Cloud for CFOs infographic', '', 'HR', '', '', '', '', 'no', '81.jpg', 'Visible to all', 'non-Europe', '', 0, '81.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(312, 1, 1, 'There and Back Again: The Resilience Blueprint', '', 'IT', '', '', '', '', 'no', '82.jpg', 'Visible to all', 'non-Europe', '', 0, '82.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(313, 1, 1, 'Building Readiness for AI Agents in Healthcare', '', 'IT', '', '', '', '', 'no', '83.jpg', 'Visible to all', 'non-Europe', '', 0, '83.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(314, 1, 6, 'The Financial Services\r\nPlaybook for Effective\r\nData Maturity', '', 'Finance', '', '', '', '', 'no', '84.jpg', 'Visible to all', 'non-Europe', '', 0, '84.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(315, 1, 6, 'The Connected\r\nFinancial Services\r\nReport', '', 'Finance', '', '', '', '', 'no', '85.jpg', 'Visible to all', 'non-Europe', '', 0, '85.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(316, 1, 6, 'The Industry CRM Impact\r\nIn Financial Services', '', 'Finance', '', '', '', '', 'no', '86.jpg', 'Visible to all', 'non-Europe', '', 0, '86.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(317, 1, 1, 'State of\r\nService', '', 'IT', '', '', '', '', 'no', '87.jpg', 'Visible to all', 'non-Europe', '', 0, '87.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(318, 1, 2, 'Three mistakes\r\nProcurement\r\nmakes in category\r\nmanagement\r\n', '', 'Marketing', '', '', '', '', 'no', '88.jpg', 'Visible to all', 'non-Europe', '', 0, '88.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(319, 1, 1, 'The state of\r\npersonalization\r\nmaturity in\r\ne-commerce', '', 'IT', '', '', '', '', 'no', '89.jpg', 'Visible to all', 'non-Europe', '', 0, '89.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(320, 1, 1, 'Leveling Up Cybersecurity', '', 'IT', '', '', '', '', 'no', '90.jpg', 'Visible to all', 'non-Europe', '', 0, '90.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(321, 1, 3, 'The Complete Guide to CX Transformation', '', 'Sales', '', '', '', '', 'no', '91.jpg', 'Visible to all', 'non-Europe', '', 0, '91.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(322, 1, 1, 'A Guide to Testing Equipment\r\nModernization', '', 'IT', '', '', '', '', 'no', '92.jpg', 'Visible to all', 'non-Europe', '', 0, '92.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(323, 1, 1, '6 ways Agile teams can streamline regression testing', '', 'IT', '', '', '', '', 'no', '93.jpg', 'Visible to all', 'non-Europe', '', 0, '93.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(324, 1, 1, 'Top 10 security must haves for your credit union\r\n', '', 'IT', '', '', '', '', 'no', '94.jpg', 'Visible to all', 'non-Europe', '', 0, '94.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(325, 1, 2, 'Next-generation methods for today\'s pharmaceutical marketing campaigns', '', 'Marketing', '', '', '', '', 'no', '95.jpg', 'Visible to all', 'non-Europe', '', 0, '95.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(326, 1, 1, 'Arbella Modernizes\r\nIts Contact Center\r\nin Four Phases', '', 'IT', '', '', '', '', 'no', '96.jpg', 'Visible to all', 'non-Europe', '', 0, '96.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(327, 1, 6, 'Legal Tracker Amazon Case Study', '', 'Finance', '', '', '', '', 'no', '97.jpg', 'Visible to all', 'non-Europe', '', 0, '97.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(328, 1, 6, 'Legal Tracker Legal Spend Reduction Any CFO Can Embrace Case Study', '', 'Finance', '', '', '', '', 'no', '98.jpg', 'Visible to all', 'non-Europe', '', 0, '98.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(329, 1, 1, 'Make machine learning\r\na reality across your\r\nmodern business', '', 'IT', '', '', '', '', 'no', '99.jpg', 'Visible to all', 'non-Europe', '', 0, '99.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(330, 1, 2, 'Manage content at the speed of digital business', '', 'Marketing', '', '', '', '', 'no', '100.jpg', 'Visible to all', 'non-Europe', '', 0, '100.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(331, 1, 1, 'Adobe MAX 2024: A new era of creativity', '', 'IT', '', '', '', '', 'no', '101.jpg', 'Visible to all', 'non-Europe', '', 0, '101.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(332, 1, 3, 'Maximize Data Impact Common Use Cases for a Unified Data Platform', '', 'Sales', '', '', '', '', 'no', '102.jpg', 'Visible to all', 'non-Europe', '', 0, '102.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(333, 1, 1, 'Mentale Gesundheit am Arbeitsplatz', '', 'IT', '', '', '', '', 'no', '103.jpg', 'Visible to all', 'non-Europe', '', 0, '103.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(334, 1, 1, 'Mergers and Acquisitions Playbook', '', 'IT', '', '', '', '', 'no', '104.jpg', 'Visible to all', 'non-Europe', '', 0, '104.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(335, 1, 1, 'Mitarbeitende\r\nbinden mit\r\nsteuerfreien Benefits:\r\nso gehts', '', 'IT', '', '', '', '', 'no', '105.jpg', 'Visible to all', 'non-Europe', '', 0, '105.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(336, 1, 5, 'Mit Sportroutinen zu mentalem Wohlbefinden', '', 'Operations', '', '', '', '', 'no', '106.jpg', 'Visible to all', 'non-Europe', '', 0, '106.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(337, 1, 2, 'Ofrecer experiencias\r\npersonalizadas en\r\ntiempos de cambio', '', 'Marketing', '', '', '', '', 'no', '525.JPG', 'Visible to all', 'non-Europe', '', 0, '525.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(338, 1, 1, 'Cinco pasos para\r\nsimplificar tu solución\r\nde Data Mart y BI', '', 'IT', '', '', '', '', 'no', '526.png', 'Visible to all', 'non-Europe', '', 0, '526.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(339, 1, 1, 'Análisis sin límites con \r\nAzure Synapse\r\n', '', 'IT', '', '', '', '', 'no', '527.png', 'Visible to all', 'non-Europe', '', 0, '527.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(340, 1, 1, 'La tecnología puede ayudar \r\na revelar un nuevo futuro para \r\nlos trabajadores de primera línea', '', 'IT', '', '', '', '', 'no', '528.png', 'Visible to all', 'non-Europe', '', 0, '528.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(341, 1, 1, 'La guía para la innovación del modelo de negocio del director de finanzas futurista', '', 'IT', '', '', '', '', 'no', '529.png', 'Visible to all', 'non-Europe', '', 0, '529.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(342, 1, 2, 'State of Sales', '', 'Marketing', '', '', '', '', 'no', '530.png', 'Visible to all', 'non-Europe', '', 0, '530.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(343, 1, 5, 'State of Service', '', 'Operations', '', '', '', '', 'no', '531.png', 'Visible to all', 'non-Europe', '', 0, '531.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(344, 1, 5, 'Step by Step Methodology and Solutions for Connecting and Disconnecting a Supply Voltage Line', '', 'Operations', '', '', '', '', 'no', '532.png', 'Visible to all', 'non-Europe', '', 0, '532.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(345, 1, 5, 'Expert Forum: Healthcare leaders say the next phase of connectivity is a transition from data collec', '', 'Operations', '', '', '', '', 'no', '533.jpeg', 'Visible to all', 'non-Europe', '', 0, '533.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(346, 1, 4, 'Streamlining DevOps in Hybrid? Multi?cloud? On?premises? and Edge Environment', '', 'HR', '', '', '', '', 'no', '534.png', 'Visible to all', 'non-Europe', '', 0, '534.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(347, 1, 4, 'Successful Enterprise Application Modernization Requires Hybrid Cloud Infrastructure', '', 'HR', '', '', '', '', 'no', '535.png', 'Visible to all', 'non-Europe', '', 0, '535.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(348, 1, 4, 'SUNGARD AVAILABILITY SERVICES', '', 'HR', '', '', '', '', 'no', '536.png', 'Visible to all', 'non-Europe', '', 0, '536.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(349, 1, 1, 'Nio nya trender för framtidens ekonomichefer', '', 'IT', '', '', '', '', 'no', '537.png', 'Visible to all', 'non-Europe', '', 0, '537.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(350, 1, 1, 'Bortom CRM: Ekonomichefens guide till ökade försäljningsintäkter och sänkta säljkostnader', '', 'IT', '', '', '', '', 'no', '538.png', 'Visible to all', 'non-Europe', '', 0, '538.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(351, 1, 1, 'Leverera personligt anpassade upplevelser i tider av förändring', '', 'IT', '', '', '', '', 'no', '539.png', 'Visible to all', 'non-Europe', '', 0, '539.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(352, 1, 2, 'Fem steg för att förenkla din data mart- och BI-lösning', '', 'Marketing', '', '', '', '', 'no', '540.png', 'Visible to all', 'non-Europe', '', 0, '540.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(353, 1, 1, 'Teknik kan bidra till att ge yrkesverksamma i förstaledet en ny framtid', '', 'IT', '', '', '', '', 'no', '541.png', 'Visible to all', 'non-Europe', '', 0, '541.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(354, 1, 1, 'En ny affärsmodell för framtidens ekonomichef', '', 'IT', '', '', '', '', 'no', '542.png', 'Visible to all', 'non-Europe', '', 0, '542.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(355, 1, 1, 'Fünf Schritte zur Vereinfachung Ihrer Data Mart- und BI-Lösung', '', 'IT', '', '', '', '', 'no', '543.png', 'Visible to all', 'non-Europe', '', 0, '543.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(356, 1, 1, 'Grenzenlose Analytics mit Azure Synapse', '', 'IT', '', '', '', '', 'no', '544.png', 'Visible to all', 'non-Europe', '', 0, '544.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(357, 1, 2, 'Technologie eröffnet Mitarbeitenden in Service und Produktion eine neue Zukunft', '', 'Marketing', '', '', '', '', 'no', '545.png', 'Visible to all', 'non-Europe', '', 0, '545.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(358, 1, 2, 'Convince your boss Tableau is right for your team', '', 'Marketing', '', '', '', '', 'no', '546.png', 'Visible to all', 'non-Europe', '', 0, '546.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(359, 1, 2, 'Visualize to monetize', '', 'Marketing', '', '', '', '', 'no', '547.png', 'Visible to all', 'non-Europe', '', 0, '547.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(360, 1, 4, 'Business Value in \r\nData-Driven Organizations', '', 'HR', '', '', '', '', 'no', '548.jpeg', 'Visible to all', 'non-Europe', '', 0, '548.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(361, 1, 1, 'Take Away AP \r\nPain with a \r\nStrong Vendor \r\nInvoice Policy\r\nTemplate', '', 'IT', '', '', '', '', 'no', '549.jpeg', 'Visible to all', 'non-Europe', '', 0, '549.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(362, 1, 2, 'Technology Can Help \r\nUnlock a New Future for \r\nFrontline Workers', '', 'Marketing', '', '', '', '', 'no', '550.jpeg', 'Visible to all', 'non-Europe', '', 0, '550.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(363, 1, 1, 'If you landed here, you’ve probably \r\nheard the terms “search engine \r\noptimization” or “SEO.', '', 'IT', '', '', '', '', 'no', '551.jpeg', 'Visible to all', 'non-Europe', '', 0, '551.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(364, 1, 1, 'In 2004, when Facebook first started, \r\nit was an invite-only platform for \r\ncollege students', '', 'IT', '', '', '', '', 'no', '552.jpeg', 'Visible to all', 'non-Europe', '', 0, '552.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(365, 1, 1, 'The Business Value of the \r\nTransformative Mainframe', '', 'IT', '', '', '', '', 'no', '553.jpeg', 'Visible to all', 'non-Europe', '', 0, '553.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(366, 1, 3, 'The COO’s \r\nPocket Guide \r\nto Enterprisewide \r\nIntelligent \r\nAutomation \r\n', '', 'Sales', '', '', '', '', 'no', '554.jpeg', 'Visible to all', 'non-Europe', '', 0, '554.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(367, 1, 2, 'Modern HR \r\nAnalytics', '', 'Marketing', '', '', '', '', 'no', '555.jpeg', 'Visible to all', 'non-Europe', '', 0, '555.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(368, 1, 2, 'The Essential Guide to \r\nModern Supply Chain Analytics', '', 'Marketing', '', '', '', '', 'no', '556.jpeg', 'Visible to all', 'non-Europe', '', 0, '556.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(369, 1, 1, 'The Hidden Costs \r\nof Static Planning', '', 'IT', '', '', '', '', 'no', '557.jpeg', 'Visible to all', 'non-Europe', '', 0, '557.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(370, 1, 1, 'Are You Getting The Most \r\nFrom Your Hybrid Cloud?', '', 'IT', '', '', '', '', 'no', '558.jpeg', 'Visible to all', 'non-Europe', '', 0, '558.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(371, 1, 1, 'White Paper\r\nThe Mighty Struggle to Migrate SAP to the Cloud May Be Over', '', 'IT', '', '', '', '', 'no', '559.jpeg', 'Visible to all', 'non-Europe', '', 0, '559.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(372, 1, 5, 'THE MODERN GUIDE TO HR ANALYTICS: \r\nMake proactive \r\npeople decisions \r\nwith confidence.', '', 'Operations', '', '', '', '', 'no', '560.jpeg', 'Visible to all', 'non-Europe', '', 0, '560.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(373, 1, 1, 'The path to \r\nmodern planning\r\n', '', 'IT', '', '', '', '', 'no', '561.jpeg', 'Visible to all', 'non-Europe', '', 0, '561.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(374, 1, 2, 'The State \r\nof Salesforce\r\nFuture of \r\nBusiness', '', 'Marketing', '', '', '', '', 'no', '562.jpeg', 'Visible to all', 'non-Europe', '', 0, '562.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(375, 1, 2, 'The Time for \r\nCloud MDM \r\nis Now', '', 'Marketing', '', '', '', '', 'no', '563.jpeg', 'Visible to all', 'non-Europe', '', 0, '563.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(376, 1, 1, 'The Total Economic Impact™ \r\nOf IBM FlashSystem', '', 'IT', '', '', '', '', 'no', '564.jpeg', 'Visible to all', 'non-Europe', '', 0, '564.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(377, 1, 1, 'The state \r\nof electronic \r\nsignature', '', 'IT', '', '', '', '', 'no', '565.jpeg', 'Visible to all', 'non-Europe', '', 0, '565.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(378, 1, 1, 'GLOBAL HIRING GUIDE:\r\nTOP EMERGING TECH HUBS', '', 'IT', '', '', '', '', 'no', '566.jpeg', 'Visible to all', 'non-Europe', '', 0, '566.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(379, 1, 4, '2022\r\nTop Trends in \r\nData Protection', '', 'HR', '', '', '', '', 'no', '567.jpeg', 'Visible to all', 'non-Europe', '', 0, '567.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(380, 1, 2, 'Total Economic Impact da plataforma de comunicacoes unificadas da Zoom', '', 'Marketing', '', '', '', '', 'no', '568.jpeg', 'Visible to all', 'non-Europe', '', 0, '568.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(381, 1, 1, 'Transceiver with Scalable \r\nPower and Performance: \r\nA Solution to Mission \r\nCritical Communication', '', 'IT', '', '', '', '', 'no', '569.jpeg', 'Visible to all', 'non-Europe', '', 0, '569.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(382, 1, 4, 'Transformational analytics: How to empower better decisions, faster, with modern BI', '', 'HR', '', '', '', '', 'no', '570.PNG', 'Visible to all', 'non-Europe', '', 0, '570.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(383, 1, 1, 'Trends in SALES OPS', '', 'IT', '', '', '', '', 'no', '571.PNG', 'Visible to all', 'non-Europe', '', 0, '571.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(384, 1, 2, 'Kann Ihr Netzwerk die heutigen Anforderungen am Arbeitsplatz erfüllen?', '', 'Marketing', '', '', '', '', 'no', '572.PNG', 'Visible to all', 'non-Europe', '', 0, '572.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(385, 1, 2, 'Unified Infrastructure von Aruba', '', 'Marketing', '', '', '', '', 'no', '573.PNG', 'Visible to all', 'non-Europe', '', 0, '573.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(386, 1, 2, 'Automation: The Key to Optimized Server Management', '', 'Marketing', '', '', '', '', 'no', '574.PNG', 'Visible to all', 'non-Europe', '', 0, '574.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(387, 1, 3, 'Optimizing Performance with Frequent Server Replacements for Enterprises', '', 'Sales', '', '', '', '', 'no', '575.PNG', 'Visible to all', 'non-Europe', '', 0, '575.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(388, 1, 1, 'Your Ultimate Guide to ? ML Experiment Tracking', '', 'IT', '', '', '', '', 'no', '576.PNG', 'Visible to all', 'non-Europe', '', 0, '576.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(389, 1, 1, 'With an Image-On-Demand and Image Archive Solution, a Top Uniform Services Company Boosts Efficiency', '', 'IT', '', '', '', '', 'no', '577.PNG', 'Visible to all', 'non-Europe', '', 0, '577.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(390, 1, 1, 'Unlocking the power of the Digital Clinical Workspace', '', 'IT', '', '', '', '', 'no', '578.PNG', 'Visible to all', 'non-Europe', '', 0, '578.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(391, 1, 1, 'Veeam and Azure Customer Reference Stories', '', 'IT', '', '', '', '', 'no', '579.PNG', 'Visible to all', 'non-Europe', '', 0, '579.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(392, 1, 4, 'What Are the Best Applications for IoT in the New World of IC Power Management?', '', 'HR', '', '', '', '', 'no', '580.PNG', 'Visible to all', 'non-Europe', '', 0, '580.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(393, 1, 4, 'What-if scenario planning:', '', 'HR', '', '', '', '', 'no', '581.PNG', 'Visible to all', 'non-Europe', '', 0, '581.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(394, 1, 5, 'Financial Services Excellence', '', 'Operations', '', '', '', '', 'no', '582.PNG', 'Visible to all', 'non-Europe', '', 0, '582.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(395, 1, 2, 'GETTING IT RIGHT FROM THE START', '', 'Marketing', '', '', '', '', 'no', '583.PNG', 'Visible to all', 'non-Europe', '', 0, '583.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(396, 1, 3, 'Why Your Law Firm’s Online Reviews & Reputation Impact Your Bottom Line', '', 'Sales', '', '', '', '', 'no', '584.PNG', 'Visible to all', 'non-Europe', '', 0, '584.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(397, 1, 2, 'Why choose DocuSign eSignature', '', 'Marketing', '', '', '', '', 'no', '585.PNG', 'Visible to all', 'non-Europe', '', 0, '585.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(398, 1, 2, 'Why aren’t factories as smart as they could be?', '', 'Marketing', '', '', '', '', 'no', '586.PNG', 'Visible to all', 'non-Europe', '', 0, '586.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(399, 1, 2, 'Why it pays to use electronic signature', '', 'Marketing', '', '', '', '', 'no', '587.PNG', 'Visible to all', 'non-Europe', '', 0, '587.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(400, 1, 4, '6 steps to creating an employee experience (EX) strategy', '', 'HR', '', '', '', '', 'no', '588.PNG', 'Visible to all', 'non-Europe', '', 0, '588.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(401, 1, 1, 'How to plan an employee experience (EX) strategy with Workplace', '', 'IT', '', '', '', '', 'no', '589.PNG', 'Visible to all', 'non-Europe', '', 0, '589.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(402, 1, 1, 'Flat Networks Inevitably Fall Flat When Attacked —Using Secure Segmentation To Protect Your Business', '', 'IT', '', '', '', '', 'no', '590.PNG', 'Visible to all', 'non-Europe', '', 0, '590.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(403, 1, 4, 'Turning roadblocks into pathways to success', '', 'HR', '', '', '', '', 'no', '591.PNG', 'Visible to all', 'non-Europe', '', 0, '591.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(404, 1, 2, 'Your Definitive Guide to Paid Advertising', '', 'Marketing', '', '', '', '', 'no', '592.PNG', 'Visible to all', 'non-Europe', '', 0, '592.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(405, 1, 1, 'YOUR GLOBAL CONTRACTOR CHECKLIST', '', 'IT', '', '', '', '', 'no', '593.PNG', 'Visible to all', 'non-Europe', '', 0, '593.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(406, 1, 1, 'More Bang for Your Boost: \r\nDriving Heavier Loads with \r\nLower Battery Voltages', '', 'IT', '', '', '', '', 'no', '594.PNG', 'Visible to all', 'non-Europe', '', 0, '594.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(407, 1, 3, 'Move business \r\noutcomes forward.\r\nMake the business case for 3D design tools.', '', 'Sales', '', '', '', '', 'no', '595.PNG', 'Visible to all', 'non-Europe', '', 0, '595.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(408, 1, 1, 'Multicloud data \r\nintegration for\r\n? data leaders\r\n', '', 'IT', '', '', '', '', 'no', '596.PNG', 'Visible to all', 'non-Europe', '', 0, '596.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(409, 1, 1, 'Need Clinical-Grade PPG \r\nfrom Your Wearable? \r\nSometimes It Pays NOT to \r\nShine a Light on a Proble', '', 'IT', '', '', '', '', 'no', '597.PNG', 'Visible to all', 'non-Europe', '', 0, '597.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(410, 1, 1, 'Negen opkomende \r\ntrends voor de CFO \r\nvan de toekomst', '', 'IT', '', '', '', '', 'no', '598.PNG', 'Visible to all', 'non-Europe', '', 0, '598.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(411, 1, 2, 'Meer dan alleen CRM: hoe \r\nverhoog je de omzet en \r\nverlaag je de saleskosten \r\nvoor CFO\'s?', '', 'Marketing', '', '', '', '', 'no', '599.PNG', 'Visible to all', 'non-Europe', '', 0, '599.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(412, 1, 5, 'Gepersonaliseerde ervaringen \r\nleveren in tijden van verandering\r\n', '', 'Operations', '', '', '', '', 'no', '600.PNG', 'Visible to all', 'non-Europe', '', 0, '600.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(413, 1, 1, 'Vijf stappen om je \r\ndatamart- en BI-oplossing \r\nte vereenvoudigen', '', 'IT', '', '', '', '', 'no', '601.PNG', 'Visible to all', 'non-Europe', '', 0, '601.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(414, 1, 5, 'Onbeperkte analytics \r\nmet Azure Synapse \r\n', '', 'Operations', '', '', '', '', 'no', '602.PNG', 'Visible to all', 'non-Europe', '', 0, '602.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(415, 1, 1, 'Technologie kan een nieuwe \r\ntoekomst voor eerstelijns medewerkers ontgrendelen', '', 'IT', '', '', '', '', 'no', '603.PNG', 'Visible to all', 'non-Europe', '', 0, '603.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(416, 1, 1, 'Business Model Innovation: \r\nde leidraad voor de \r\ntoekomstgerichte CFO', '', 'IT', '', '', '', '', 'no', '604.PNG', 'Visible to all', 'non-Europe', '', 0, '604.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(417, 1, 2, 'Increasing Cash Velocity \r\nwith Paystand’s NetSuite \r\nIntegration: the Antidote to \r\nInflation Woes', '', 'Marketing', '', '', '', '', 'no', '605.PNG', 'Visible to all', 'non-Europe', '', 0, '605.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(418, 1, 1, 'New Single Pair Ethernet: \r\nHigh Quality Asset Health \r\nInsights and Power on Two Wires for \r\nCondit', '', 'IT', '', '', '', '', 'no', '606.PNG', 'Visible to all', 'non-Europe', '', 0, '606.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(419, 1, 4, 'Modernise Your Java Apps', '', 'HR', '', '', '', '', 'no', '607.PNG', 'Visible to all', 'non-Europe', '', 0, '607.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(420, 1, 5, 'Fem trinn for å forenkle \r\ndatatorg- og BI-løsningen\r\n', '', 'Operations', '', '', '', '', 'no', '608.PNG', 'Visible to all', 'non-Europe', '', 0, '608.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(421, 1, 4, 'Ubegrenset analyse \r\nmed Azure Synapse', '', 'HR', '', '', '', '', 'no', '609.PNG', 'Visible to all', 'non-Europe', '', 0, '609.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(422, 1, 2, 'Teknologi kan bidra til en ny \r\nfremtid for frontlinjearbeidere', '', 'Marketing', '', '', '', '', 'no', '610.PNG', 'Visible to all', 'non-Europe', '', 0, '610.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(423, 1, 1, 'OPERATIONALIZING FRAUD \r\nPREVENTION ON IBM Z16', '', 'IT', '', '', '', '', 'no', '611.PNG', 'Visible to all', 'non-Europe', '', 0, '611.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(424, 1, 1, 'How physicians\' attitudes on the healthcare \r\nindustry differ by specialty', '', 'IT', '', '', '', '', 'no', '612.PNG', 'Visible to all', 'non-Europe', '', 0, '612.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(425, 1, 1, 'The Controller’s Guide \r\nto B2B Payments \r\nOptimization', '', 'IT', '', '', '', '', 'no', '613.PNG', 'Visible to all', 'non-Europe', '', 0, '613.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(426, 1, 4, 'WORLDWIDE TECHNOLOGY \r\nLEADER ELIMINATES \r\nSTAGGERING FEES WITH \r\nDIGITIZED BANK TRANSFERS', '', 'HR', '', '', '', '', 'no', '614.PNG', 'Visible to all', 'non-Europe', '', 0, '614.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(427, 1, 1, 'Payments and AR \r\nAutomation for Sage \r\nIntacct', '', 'IT', '', '', '', '', 'no', '615.PNG', 'Visible to all', 'non-Europe', '', 0, '615.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(428, 1, 2, 'Choose Your Perfect \r\nPayments App for Sage \r\nIntacct: A Checklist', '', 'Marketing', '', '', '', '', 'no', '616.PNG', 'Visible to all', 'non-Europe', '', 0, '616.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(429, 1, 1, 'Digitizing Your \r\nAccounts Receivable \r\nCash Cycle with \r\nNetSuite', '', 'IT', '', '', '', '', 'no', '617.PNG', 'Visible to all', 'non-Europe', '', 0, '617.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(430, 1, 1, 'Automating Your \r\nMonth-End Tasks \r\nwith NetSuite', '', 'IT', '', '', '', '', 'no', '618.PNG', 'Visible to all', 'non-Europe', '', 0, '618.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(431, 1, 1, 'The 2022 Ransomware \r\nSurvival Guide', '', 'IT', '', '', '', '', 'no', '619.PNG', 'Visible to all', 'non-Europe', '', 0, '619.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(432, 1, 2, 'Breaking Down BEC', '', 'Marketing', '', '', '', '', 'no', '620.PNG', 'Visible to all', 'non-Europe', '', 0, '620.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(433, 1, 5, 'Managing the \r\nCybersecurity \r\nSkills Shortage', '', 'Operations', '', '', '', '', 'no', '621.PNG', 'Visible to all', 'non-Europe', '', 0, '621.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57');
INSERT INTO `books` (`book_id`, `user_id`, `c_id`, `name`, `description`, `subject_area`, `keywords`, `author`, `company`, `url`, `customquestion`, `image`, `type`, `europe`, `google`, `top`, `file1`, `file2`, `file3`, `file4`, `file5`, `username`, `ip_address`, `user_agent`, `date`) VALUES
(434, 1, 5, 'The Business \r\nEmail Compromise \r\n(BEC) Handbook', '', 'Operations', '', '', '', '', 'no', '622.PNG', 'Visible to all', 'non-Europe', '', 0, '622.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(435, 1, 6, 'Cloud Account Compromise and Takeover', '', 'Finance', '', '', '', '', 'no', '623.PNG', 'Visible to all', 'non-Europe', '', 0, '623.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(436, 1, 1, 'Planning for Your Next Phase of Work \r\nDigital Guide', '', 'IT', '', '', '', '', 'no', '624.PNG', 'Visible to all', 'non-Europe', '', 0, '624.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(437, 1, 1, 'Solutions \r\nponctuelles \r\nou intégrées : \r\nLaquelle offre le \r\nmeilleur retour sur \r\ninvestissement ', '', 'IT', '', '', '', '', 'no', '625.PNG', 'Visible to all', 'non-Europe', '', 0, '625.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(438, 1, 2, 'Cinco Passos para \r\nSimplificar o Data Mart \r\ne a Solução de BI', '', 'Marketing', '', '', '', '', 'no', '626.PNG', 'Visible to all', 'non-Europe', '', 0, '626.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(439, 1, 1, 'Análises ilimitadas com o \r\nAzure Synapse\r\n', '', 'IT', '', '', '', '', 'no', '627.PNG', 'Visible to all', 'non-Europe', '', 0, '627.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(440, 1, 4, 'A tecnologia pode ajudar \r\na desbloquear um novo \r\nfuturo para os trabalhadores \r\nda linha da frente', '', 'HR', '', '', '', '', 'no', '628.PNG', 'Visible to all', 'non-Europe', '', 0, '628.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(441, 1, 5, 'Critical Considerations \r\nWhen Evaluating\r\nSASE Solutions', '', 'Operations', '', '', '', '', 'no', '629.PNG', 'Visible to all', 'non-Europe', '', 0, '629.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(442, 1, 4, 'How SD-WAN Makes \r\nLTE/5G Simple, \r\nResilient, and Secure', '', 'HR', '', '', '', '', 'no', '630.PNG', 'Visible to all', 'non-Europe', '', 0, '630.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(443, 1, 4, 'Why Security Is a Top \r\nInfluencer of Network \r\nPerformance', '', 'HR', '', '', '', '', 'no', '631.PNG', 'Visible to all', 'non-Europe', '', 0, '631.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(444, 1, 1, 'Seven Major Challenges \r\nImpeding Digital \r\nAcceleration', '', 'IT', '', '', '', '', 'no', '632.PNG', 'Visible to all', 'non-Europe', '', 0, '632.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(445, 1, 1, 'R und visuelle Analyse – \r\nLeistungsfähigkeit', '', 'IT', '', '', '', '', 'no', '633.PNG', 'Visible to all', 'non-Europe', '', 0, '633.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(446, 1, 1, 'Puissance de R et \r\nanalyses visuelles', '', 'IT', '', '', '', '', 'no', '634.PNG', 'Visible to all', 'non-Europe', '', 0, '634.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(447, 1, 5, 'The Power of R\r\nand Visual Analytics', '', 'Operations', '', '', '', '', 'no', '635.PNG', 'Visible to all', 'non-Europe', '', 0, '635.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(448, 1, 5, 'PrizmDoc\r\nViewer', '', 'Operations', '', '', '', '', 'no', '636.PNG', 'Visible to all', 'non-Europe', '', 0, '636.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(449, 1, 1, 'Say Hello to \r\nDecision Intelligence', '', 'IT', '', '', '', '', 'no', '637.PNG', 'Visible to all', 'non-Europe', '', 0, '637.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(450, 1, 1, 'Quad Output Power \r\nReference Design with \r\nInput Fault Protection for \r\nAutomotive Applications', '', 'IT', '', '', '', '', 'no', '638.PNG', 'Visible to all', 'non-Europe', '', 0, '638.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(451, 1, 1, 'RANSOMWARE \r\nAND THE LEGAL \r\nPROFESSION\r\n', '', 'IT', '', '', '', '', 'no', '639.PNG', 'Visible to all', 'non-Europe', '', 0, '639.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(452, 1, 5, 'Ransomware Resiliency \r\nin 2022 ', '', 'Operations', '', '', '', '', 'no', '640.PNG', 'Visible to all', 'non-Europe', '', 0, '640.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(453, 1, 5, 'Redefining \r\nModern \r\nMaster Data \r\nManagement \r\nin the Cloud\r\n', '', 'Operations', '', '', '', '', 'no', '641.PNG', 'Visible to all', 'non-Europe', '', 0, '641.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(454, 1, 5, 'Redefining safe workplace \r\nplaybook management', '', 'Operations', '', '', '', '', 'no', '642.PNG', 'Visible to all', 'non-Europe', '', 0, '642.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(455, 1, 5, 'Reducing Cost\r\nWithout Sacrificing \r\nCustomer Experience', '', 'Operations', '', '', '', '', 'no', '643.PNG', 'Visible to all', 'non-Europe', '', 0, '643.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(456, 1, 5, 'Reimagining Work - Harvard Business Review Article Collection', '', 'Operations', '', '', '', '', 'no', '644.PNG', 'Visible to all', 'non-Europe', '', 0, '644.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(457, 1, 5, 'Remote, On-Site, or Hybrid Work – A Guide and Insights For Your Team', '', 'Operations', '', '', '', '', 'no', '645.PNG', 'Visible to all', 'non-Europe', '', 0, '645.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(458, 1, 1, 'report enterprise labeling for dummies', '', 'IT', '', '', '', '', 'no', '646.PNG', 'Visible to all', 'non-Europe', '', 0, '646.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(459, 1, 1, 'Returning to the Office \r\nwith Power Over Ethernet 2', '', 'IT', '', '', '', '', 'no', '647.PNG', 'Visible to all', 'non-Europe', '', 0, '647.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(460, 1, 1, 'Rolling forecasts:\r\nhow to achieve business agility \r\nwith dynamic planning.', '', 'IT', '', '', '', '', 'no', '648.PNG', 'Visible to all', 'non-Europe', '', 0, '648.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(461, 1, 1, '7 Key Challenges of \r\nPharmaceutical Labeling', '', 'IT', '', '', '', '', 'no', '649.PNG', 'Visible to all', 'non-Europe', '', 0, '649.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(462, 1, 1, 'SALES PITFALLS\r\n8 Productivity Mistakes to Avoid', '', 'IT', '', '', '', '', 'no', '650.PNG', 'Visible to all', 'non-Europe', '', 0, '650.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(463, 1, 1, 'Intelligent Process Automation (IPA) – Solution Provider Landscape with PEAK Matrix® Assessment 2022', '', 'IT', '', '', '', '', 'no', '651.PNG', 'Visible to all', 'non-Europe', '', 0, '651.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(464, 1, 1, 'Le changement en toute \r\nconfiance', '', 'IT', '', '', '', '', 'no', '652.PNG', 'Visible to all', 'non-Europe', '', 0, '652.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(465, 1, 1, 'Le marché évolue, \r\nvotre station de \r\ntravail doit en \r\nfaire autant.', '', 'IT', '', '', '', '', 'no', '653.PNG', 'Visible to all', 'non-Europe', '', 0, '653.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(466, 1, 1, 'Secure Hybrid Cloud for Dummies', '', 'IT', '', '', '', '', 'no', '654.PNG', 'Visible to all', 'non-Europe', '', 0, '654.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(467, 1, 5, 'Six raisons de migrer vos \r\napplications Office vers \r\nle Cloud dès maintenant', '', 'Operations', '', '', '', '', 'no', '655.PNG', 'Visible to all', 'non-Europe', '', 0, '655.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(468, 1, 5, 'Small IT \r\nDepartment \r\nStructure: \r\nMeeting The \r\nNeeds of Business', '', 'Operations', '', '', '', '', 'no', '656.PNG', 'Visible to all', 'non-Europe', '', 0, '656.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(469, 1, 1, 'SMALL BUSINESSES’ \r\nDIGITIZATION PROGRAM \r\nGUIDE: HOW TO PLAN, \r\nEXECUTE AND ELEVATE \r\nYOUR COMPANY ', '', 'IT', '', '', '', '', 'no', '657.PNG', 'Visible to all', 'non-Europe', '', 0, '657.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(470, 1, 1, 'Software-Configurable \r\nAnalog I/O Heralds More \r\nCompact and Convenient \r\nCalibrators', '', 'IT', '', '', '', '', 'no', '658.PNG', 'Visible to all', 'non-Europe', '', 0, '658.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(471, 1, 1, 'BRING ORDER TO CHAOS; \r\nENSURE COMPLIANCE AND CUT COSTS', '', 'IT', '', '', '', '', 'no', '659.PNG', 'Visible to all', 'non-Europe', '', 0, '659.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(472, 1, 1, 'IRON MOUNTAIN \r\nSMART SORT', '', 'IT', '', '', '', '', 'no', '660.PNG', 'Visible to all', 'non-Europe', '', 0, '660.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(473, 1, 1, 'Nueve tendencias \r\nemergentes para el \r\ndirector financiero \r\ndel futuro', '', 'IT', '', '', '', '', 'no', '661.PNG', 'Visible to all', 'non-Europe', '', 0, '661.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(474, 1, 1, 'Más que una solución \r\nCRM: la guía para impulsar \r\nlos ingresos de las ventas \r\ny reducir los coste', '', 'IT', '', '', '', '', 'no', '662.PNG', 'Visible to all', 'non-Europe', '', 0, '662.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(475, 1, 6, 'How to Integrate Data Into Your Daily Decisions to Drive Team Alignment and Agility', '', 'Finance', '', '', '', '', 'no', '663.JPG', 'Visible to all', 'non-Europe', '', 0, '663.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(476, 1, 2, 'ACCELERATING ACCOUNTS PAYABLE', '', 'Marketing', '', '', '', '', 'no', '664.JPG', 'Visible to all', 'non-Europe', '', 0, '664.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(477, 1, 2, 'How to Scale Today’s Data Science Initiatives', '', 'Marketing', '', '', '', '', 'no', '665.JPG', 'Visible to all', 'non-Europe', '', 0, '665.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(478, 1, 2, 'Why Smart Businesses View a Data Fabric as an Inevitable Approach to Becoming Data-driven', '', 'Marketing', '', '', '', '', 'no', '666.JPG', 'Visible to all', 'non-Europe', '', 0, '666.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(479, 1, 2, 'Harvard Business Review: Designing the Hybrid Office', '', 'Marketing', '', '', '', '', 'no', '667.JPG', 'Visible to all', 'non-Europe', '', 0, '667.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(480, 1, 6, 'Hybrid isn’t the destination', '', 'Finance', '', '', '', '', 'no', '668.JPG', 'Visible to all', 'non-Europe', '', 0, '668.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(481, 1, 2, 'IBM Cloud for VMware Regulated Workloads', '', 'Marketing', '', '', '', '', 'no', '669.JPG', 'Visible to all', 'non-Europe', '', 0, '669.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(482, 1, 2, 'IBM Cloud Object Storage System Product Guide', '', 'Marketing', '', '', '', '', 'no', '670.JPG', 'Visible to all', 'non-Europe', '', 0, '670.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(483, 1, 2, 'IBM FlashSystem 5000 and 5200 for Mid-Market', '', 'Marketing', '', '', '', '', 'no', '671.JPG', 'Visible to all', 'non-Europe', '', 0, '671.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(484, 1, 1, 'Navigating your hybrid cloud vision', '', 'IT', '', '', '', '', 'no', '672.JPG', 'Visible to all', 'non-Europe', '', 0, '672.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(485, 1, 1, 'A fashionably late fall season', '', 'IT', '', '', '', '', 'no', '673.JPG', 'Visible to all', 'non-Europe', '', 0, '673.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(486, 1, 1, 'AI-Powered Automation in the Telecommunications Sector', '', 'IT', '', '', '', '', 'no', '674.JPG', 'Visible to all', 'non-Europe', '', 0, '674.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(487, 1, 3, 'Automation Disruptors Realize 1.5x Higher Revenue Growth', '', 'Sales', '', '', '', '', 'no', '675.JPG', 'Visible to all', 'non-Europe', '', 0, '675.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(488, 1, 1, 'Accelerating Transformation Through AI-Powered Automation in Financial Services', '', 'IT', '', '', '', '', 'no', '676.JPG', 'Visible to all', 'non-Europe', '', 0, '676.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(489, 1, 1, 'AI-Powered Automation in the Telecommunications Sector', '', 'IT', '', '', '', '', 'no', '677.JPG', 'Visible to all', 'non-Europe', '', 0, '677.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(490, 1, 1, 'The Business Value of IBM AI-Powered Automation Solutions', '', 'IT', '', '', '', '', 'no', '678.JPG', 'Visible to all', 'non-Europe', '', 0, '678.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(491, 1, 1, 'THIS IDC MARKETSCAPE EXCERPT FEATURES QUADIENT', '', 'IT', '', '', '', '', 'no', '679.JPG', 'Visible to all', 'non-Europe', '', 0, '679.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(492, 1, 3, 'SECURE AND PRODUCTIVE FROM ANYWHERE', '', 'Sales', '', '', '', '', 'no', '680.JPG', 'Visible to all', 'non-Europe', '', 0, '680.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(493, 1, 3, 'Imprivata delivers fast, secure application access on VMware Horizon Cloud on Microsoft Azure', '', 'Sales', '', '', '', '', 'no', '681.JPG', 'Visible to all', 'non-Europe', '', 0, '681.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(494, 1, 3, 'Imprivata Virtual Desktop Access', '', 'Sales', '', '', '', '', 'no', '682.JPG', 'Visible to all', 'non-Europe', '', 0, '682.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(495, 1, 3, 'Improving Employee Engagement', '', 'Sales', '', '', '', '', 'no', '683.JPG', 'Visible to all', 'non-Europe', '', 0, '683.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(496, 1, 3, 'Global Leader in Plastics Simplifies Networking for Branch Locations with Infoblox’s Cloud-Based Net', '', 'Sales', '', '', '', '', 'no', '684.JPG', 'Visible to all', 'non-Europe', '', 0, '684.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(497, 1, 3, 'Port of Antwerp, the Gateway to Europe, Relies on Infoblox to Keep Shipping Lanes Open 24x7x365', '', 'Sales', '', '', '', '', 'no', '685.JPG', 'Visible to all', 'non-Europe', '', 0, '685.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(498, 1, 3, 'CORE NETWORK SERVICES FOR THE MODERN HYBRID WORKPLACE', '', 'Sales', '', '', '', '', 'no', '686.JPG', 'Visible to all', 'non-Europe', '', 0, '686.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(499, 1, 3, 'Enterprise Edge networking', '', 'Sales', '', '', '', '', 'no', '687.JPG', 'Visible to all', 'non-Europe', '', 0, '687.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(500, 1, 1, 'Improve Business Outcomes With SaaSManaged Network Services', '', 'IT', '', '', '', '', 'no', '688.JPG', 'Visible to all', 'non-Europe', '', 0, '688.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(501, 1, 1, 'Modernizing Core Network Services to Support Cloud-First Networking', '', 'IT', '', '', '', '', 'no', '689.JPG', 'Visible to all', 'non-Europe', '', 0, '689.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(502, 1, 1, 'The Total Economic Impact™ Of Infoblox BloxOne DDI', '', 'IT', '', '', '', '', 'no', '690.JPG', 'Visible to all', 'non-Europe', '', 0, '690.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(503, 1, 1, 'CLOUD-MANAGED NETWORK SERVICES', '', 'IT', '', '', '', '', 'no', '691.JPG', 'Visible to all', 'non-Europe', '', 0, '691.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(504, 1, 1, 'Information Blocking Rule 101: Just the beginning of connecting the dots to enable true interoperabi', '', 'IT', '', '', '', '', 'no', '692.JPG', 'Visible to all', 'non-Europe', '', 0, '692.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(505, 1, 1, 'Ignite Your Innovation Engine', '', 'IT', '', '', '', '', 'no', '693.JPG', 'Visible to all', 'non-Europe', '', 0, '693.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(506, 1, 1, 'INSIGHTS IN THE FAST LANE', '', 'IT', '', '', '', '', 'no', '694.JPG', 'Visible to all', 'non-Europe', '', 0, '694.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(507, 1, 1, 'Inspire Evolve: communications built for the future', '', 'IT', '', '', '', '', 'no', '695.JPG', 'Visible to all', 'non-Europe', '', 0, '695.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(508, 1, 1, '10 Möglichkeiten für Versicherer, ihre digitale Transformation mit PayPal voranzutreiben', '', 'IT', '', '', '', '', 'no', '696.JPG', 'Visible to all', 'non-Europe', '', 0, '696.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(509, 1, 5, '5 Gründe, warum Versicherer ihren Auszahlungsprozess modernisieren sollten.', '', 'Operations', '', '', '', '', 'no', '697.JPG', 'Visible to all', 'non-Europe', '', 0, '697.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(510, 1, 6, 'Gaining Business Value from People Analytics', '', 'Finance', '', '', '', '', 'no', '698.JPG', 'Visible to all', 'non-Europe', '', 0, '698.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(511, 1, 1, 'Intelligent Automation Platforms Take Aim At Workforce Orchestration', '', 'IT', '', '', '', '', 'no', '699.JPG', 'Visible to all', 'non-Europe', '', 0, '699.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(512, 1, 5, 'THE IMPACT OF A DIGITAL WORKPLACE INVESTMENT', '', 'Operations', '', '', '', '', 'no', '700.JPG', 'Visible to all', 'non-Europe', '', 0, '700.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(513, 1, 5, 'Introduction Guide to the IBM Elastic Storage System', '', 'Operations', '', '', '', '', 'no', '701.JPG', 'Visible to all', 'non-Europe', '', 0, '701.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(514, 1, 1, 'Five Steps to Simplify Your Data Mart and BI Solution', '', 'IT', '', '', '', '', 'no', '702.JPG', 'Visible to all', 'non-Europe', '', 0, '702.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(515, 1, 5, 'Limitless Analytics with Azure Synapse', '', 'Operations', '', '', '', '', 'no', '703.JPG', 'Visible to all', 'non-Europe', '', 0, '703.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(516, 1, 5, 'Technology Can Help Unlock a New Future for Frontline Workers', '', 'Operations', '', '', '', '', 'no', '704.JPG', 'Visible to all', 'non-Europe', '', 0, '704.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(517, 1, 1, 'TRANSFORM YOUR ACCOUNTS PAYABLE (AP) PROCESSES', '', 'IT', '', '', '', '', 'no', '705.JPG', 'Visible to all', 'non-Europe', '', 0, '705.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(518, 1, 1, 'IT Service Management for SMBs in a Remote-First World', '', 'IT', '', '', '', '', 'no', '706.JPG', 'Visible to all', 'non-Europe', '', 0, '706.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(519, 1, 1, '9 tendenze emergenti per il CFO del futuro', '', 'IT', '', '', '', '', 'no', '707.JPG', 'Visible to all', 'non-Europe', '', 0, '707.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(520, 1, 1, 'Oltre il CRM: guida per i CFO all’aumento dei ricavi dalle vendite e alla riduzione dei costi di ven', '', 'IT', '', '', '', '', 'no', '708.JPG', 'Visible to all', 'non-Europe', '', 0, '708.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(521, 1, 1, 'Come offrire esperienze personalizzate in tempi di cambiamento', '', 'IT', '', '', '', '', 'no', '709.JPG', 'Visible to all', 'non-Europe', '', 0, '709.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(522, 1, 2, 'Cinque passaggi per semplificare la soluzione di data mart e BI', '', 'Marketing', '', '', '', '', 'no', '710.JPG', 'Visible to all', 'non-Europe', '', 0, '710.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(523, 1, 1, 'Analisi illimitate con Azure Synapse', '', 'IT', '', '', '', '', 'no', '711.JPG', 'Visible to all', 'non-Europe', '', 0, '711.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(524, 1, 1, 'La tecnologia può aprire la strada a un nuovo futuro per gli operatori in prima linea', '', 'IT', '', '', '', '', 'no', '712.JPG', 'Visible to all', 'non-Europe', '', 0, '712.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(525, 1, 1, 'Guida all’innovazione dei modelli di business per il CFO del futuro', '', 'IT', '', '', '', '', 'no', '713.JPG', 'Visible to all', 'non-Europe', '', 0, '713.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(526, 1, 2, 'Juxto Automates Payment Collection in NetSuite with Paystand', '', 'Marketing', '', '', '', '', 'no', '714.JPG', 'Visible to all', 'non-Europe', '', 0, '714.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(527, 1, 1, 'L\'AIOps plus intelligente', '', 'IT', '', '', '', '', 'no', '715.JPG', 'Visible to all', 'non-Europe', '', 0, '715.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(528, 1, 1, 'LAW.COM AND iMANAGE SURVEY ATTORNEYS ABOUT LEGAL TECHNOLOGY USAGE AND INVESTMENTS', '', 'IT', '', '', '', '', 'no', '716.JPG', 'Visible to all', 'non-Europe', '', 0, '716.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(529, 1, 1, 'Analyse illimitée avec Azure Synapse', '', 'IT', '', '', '', '', 'no', '717.JPG', 'Visible to all', 'non-Europe', '', 0, '717.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(530, 1, 1, 'Boost security, flexibility, and scale at the edge with Red Hat Enterprise Linux', '', 'IT', '', '', '', '', 'no', '718.JPG', 'Visible to all', 'non-Europe', '', 0, '718.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(531, 1, 1, 'Build a foundation for zero trust in Linux environments', '', 'IT', '', '', '', '', 'no', '719.JPG', 'Visible to all', 'non-Europe', '', 0, '719.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(532, 1, 1, 'Fünf Schritte zur Vereinfachung Ihrer Data Mart- und BI-Lösung', '', 'IT', '', '', '', '', 'no', '720.JPG', 'Visible to all', 'non-Europe', '', 0, '720.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(533, 1, 1, 'Grenzenlose Analytics mit Azure Synapse', '', 'IT', '', '', '', '', 'no', '721.JPG', 'Visible to all', 'non-Europe', '', 0, '721.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(534, 1, 1, 'Mainframe 2020: A catalyst for transformation', '', 'IT', '', '', '', '', 'no', '722.JPG', 'Visible to all', 'non-Europe', '', 0, '722.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(535, 1, 1, '10 Ways to Add Value to Your Dashboards with Maps', '', 'IT', '', '', '', '', 'no', '723.JPG', 'Visible to all', 'non-Europe', '', 0, '723.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(536, 1, 1, '10 Ways to Add Value to Your Dashboards with Maps', '', 'IT', '', '', '', '', 'no', '724.JPG', 'Visible to all', 'non-Europe', '', 0, '724.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(537, 1, 6, '10 Möglichkeiten zur Aufwertung Ihres Dashboards mithilfe von Karten', '', 'Finance', '', '', '', '', 'no', '725.JPG', 'Visible to all', 'non-Europe', '', 0, '725.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(538, 1, 1, '10 conseils pour améliorer vos tableaux de bord avec des cartes', '', 'IT', '', '', '', '', 'no', '726.JPG', 'Visible to all', 'non-Europe', '', 0, '726.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(539, 1, 6, 'Measuring Employee Enagement', '', 'Finance', '', '', '', '', 'no', '727.JPG', 'Visible to all', 'non-Europe', '', 0, '727.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(540, 1, 1, 'Melhore a performance de suas aplicações por um custo mais baixo com a AWS', '', 'IT', '', '', '', '', 'no', '728.JPG', 'Visible to all', 'non-Europe', '', 0, '728.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(541, 1, 1, 'Mergers & Acquisitions', '', 'IT', '', '', '', '', 'no', '729.JPG', 'Visible to all', 'non-Europe', '', 0, '729.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(542, 1, 1, 'The Benefits of Truly Unified Communications for SMBs', '', 'IT', '', '', '', '', 'no', '730.JPG', 'Visible to all', 'non-Europe', '', 0, '730.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(543, 1, 1, 'Execute suas workloads do Windows na AWS', '', 'IT', '', '', '', '', 'no', '731.JPG', 'Visible to all', 'non-Europe', '', 0, '731.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(544, 1, 1, 'Making an impact with Modern Data Protection', '', 'IT', '', '', '', '', 'no', '732.JPG', 'Visible to all', 'non-Europe', '', 0, '732.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(545, 1, 1, 'MODERNIZE AND MONETIZE', '', 'IT', '', '', '', '', 'no', '733.JPG', 'Visible to all', 'non-Europe', '', 0, '733.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(546, 1, 1, 'Modernize your IA for AI and hybrid cloud', '', 'IT', '', '', '', '', 'no', '734.JPG', 'Visible to all', 'non-Europe', '', 0, '734.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(547, 1, 1, 'XDR Simplified What it is and how it’s filling the gaps for small security teams', '', 'IT', '', '', '', '', 'no', '735.JPG', 'Visible to all', 'non-Europe', '', 0, '735.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(548, 1, 1, '3 Reasons the Campus Is the Heart of Enterprise Security', '', 'IT', '', '', '', '', 'no', '736.JPG', 'Visible to all', 'non-Europe', '', 0, '736.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(549, 1, 1, 'The Ultimate Guide to MLOps', '', 'IT', '', '', '', '', 'no', '737.JPG', 'Visible to all', 'non-Europe', '', 0, '737.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(550, 1, 2, 'Comprehensive, Easy Cybersecurity for Lean IT Security Teams Starts with Extended Detection and Resp', '', 'Marketing', '', '', '', '', 'no', '738.JPG', 'Visible to all', 'non-Europe', '', 0, '738.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(551, 1, 5, 'Evaluating SASE for the Work-From-Anywhere Era', '', 'Operations', '', '', '', '', 'no', '739.JPG', 'Visible to all', 'non-Europe', '', 0, '739.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(552, 1, 1, 'Six Building Blocks of a Next-Generation Software-Defined Campus LAN', '', 'IT', '', '', '', '', 'no', '740.JPG', 'Visible to all', 'non-Europe', '', 0, '740.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(553, 1, 5, 'The State of CUSTOMER EXPERIENCE Trends and predictions for CCM and CXM in 2022 and beyond', '', 'Operations', '', '', '', '', 'no', '741.JPG', 'Visible to all', 'non-Europe', '', 0, '741.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(554, 1, 1, 'he Dark Side 7 Considerations CISOs With Small Security Teams Must Address When Evaluating an EDR of', '', 'IT', '', '', '', '', 'no', '742.JPG', 'Visible to all', 'non-Europe', '', 0, '742.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(555, 1, 1, 'Connect with Hannah Neprash, Ph.D.', '', 'IT', '', '', '', '', 'no', '743.JPG', 'Visible to all', 'non-Europe', '', 0, '743.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(556, 1, 2, 'EDR Buyer\'s Guide', '', 'Marketing', '', '', '', '', 'no', '744.JPG', 'Visible to all', 'non-Europe', '', 0, '744.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(557, 1, 1, 'Building Effective Machine Learning Teams', '', 'IT', '', '', '', '', 'no', '745.JPG', 'Visible to all', 'non-Europe', '', 0, '745.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(558, 1, 4, 'EMPLOYEE VS. CONTRACTOR:', '', 'HR', '', '', '', '', 'no', '746.JPG', 'Visible to all', 'non-Europe', '', 0, '746.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(559, 1, 5, 'Enabling 5G and DSRC V2X in Autonomous Driving Vehicles', '', 'Operations', '', '', '', '', 'no', '747.JPG', 'Visible to all', 'non-Europe', '', 0, '747.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(560, 1, 4, 'Enterprise Buyer’s Guide for Data Protection', '', 'HR', '', '', '', '', 'no', '748.JPG', 'Visible to all', 'non-Europe', '', 0, '748.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(561, 1, 2, 'AWS PARA SERVICIOS DE MIGRACIÓN Migración de SAP a la nube Cómo transformar la red troncal de su emp', '', 'Marketing', '', '', '', '', 'no', '749.JPG', 'Visible to all', 'non-Europe', '', 0, '749.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(562, 1, 1, 'Revolutionizing the Lending Process with IBM Cloud Paks', '', 'IT', '', '', '', '', 'no', '750.JPG', 'Visible to all', 'non-Europe', '', 0, '750.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(563, 1, 1, 'Introducing IBM Security QRadar XDR', '', 'IT', '', '', '', '', 'no', '751.JPG', 'Visible to all', 'non-Europe', '', 0, '751.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(564, 1, 1, 'Storage’s Role in Addressing the Challenges of Ensuring Cyber Resilience', '', 'IT', '', '', '', '', 'no', '752.JPG', 'Visible to all', 'non-Europe', '', 0, '752.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(565, 1, 1, 'Cyber-resiliency Maturity in Servers', '', 'IT', '', '', '', '', 'no', '753.JPG', 'Visible to all', 'non-Europe', '', 0, '753.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(566, 1, 4, 'Everest Group Peak Matrix for Application Transformation Services Providers 2021', '', 'HR', '', '', '', '', 'no', '754.JPG', 'Visible to all', 'non-Europe', '', 0, '754.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(567, 1, 1, 'Field guide to application modernization on IBM Power', '', 'IT', '', '', '', '', 'no', '755.JPG', 'Visible to all', 'non-Europe', '', 0, '755.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(568, 1, 2, 'CFOs Eager to Expand Globally but Face Pressing Resistance', '', 'Marketing', '', '', '', '', 'no', '756.JPG', 'Visible to all', 'non-Europe', '', 0, '756.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(569, 1, 1, 'Tietovarasto- ja BI-ratkaisun yksinkertaistamisen viisi vaihetta', '', 'IT', '', '', '', '', 'no', '757.JPG', 'Visible to all', 'non-Europe', '', 0, '757.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(570, 1, 1, 'Rajatonta analytiikkaa Azure Synapsella', '', 'IT', '', '', '', '', 'no', '758.JPG', 'Visible to all', 'non-Europe', '', 0, '758.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(571, 1, 1, 'Teknologia voi tarjota etulinjan työntekijöille uudenlaisen tulevaisuuden', '', 'IT', '', '', '', '', 'no', '759.JPG', 'Visible to all', 'non-Europe', '', 0, '759.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(572, 1, 1, 'ERP Modernization and Growing Data Challenges Drive 91% of Enterprises to Modernize Integration Solu', '', 'IT', '', '', '', '', 'no', '760.JPG', 'Visible to all', 'non-Europe', '', 0, '760.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(573, 1, 2, 'The Total Economic Impact™ Of IBM Spectrum Scale', '', 'Marketing', '', '', '', '', 'no', '761.JPG', 'Visible to all', 'non-Europe', '', 0, '761.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(574, 1, 1, 'Créez en un temps record', '', 'IT', '', '', '', '', 'no', '762.JPG', 'Visible to all', 'non-Europe', '', 0, '762.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(575, 1, 4, 'Imaginez un plus bel environnement créé avec lenovo', '', 'HR', '', '', '', '', 'no', '763.JPG', 'Visible to all', 'non-Europe', '', 0, '763.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(576, 1, 5, 'Cinq étapes pour simplifier vos solutions de Data Mart et de BI', '', 'Operations', '', '', '', '', 'no', '764.JPG', 'Visible to all', 'non-Europe', '', 0, '764.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(577, 1, 4, 'New Technology: The Projected Total Economic Impact™ Of IBM Cloud Pak For Data', '', 'HR', '', '', '', '', 'no', '765.JPG', 'Visible to all', 'non-Europe', '', 0, '765.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(578, 1, 2, 'The Total Economic Impact™ Of IBM Watson Assistant', '', 'Marketing', '', '', '', '', 'no', '766.JPG', 'Visible to all', 'non-Europe', '', 0, '766.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(579, 1, 1, 'The Total Economic Impact™ Of IBM Spectrum Virtualize', '', 'IT', '', '', '', '', 'no', '767.JPG', 'Visible to all', 'non-Europe', '', 0, '767.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(580, 1, 1, 'Building Data Literacy The Key To Better Decisions, Greater Productivity, And Data-Driven Organizati', '', 'IT', '', '', '', '', 'no', '768.JPG', 'Visible to all', 'non-Europe', '', 0, '768.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(581, 1, 1, 'Aufbau von Datenkompetenz Der Schlüssel zu besseren Entscheidungen, höherer Produktivität und dateng', '', 'IT', '', '', '', '', 'no', '769.JPG', 'Visible to all', 'non-Europe', '', 0, '769.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(582, 1, 1, 'Modernize Your Server Infrastructure For Speed And Security', '', 'IT', '', '', '', '', 'no', '770.JPG', 'Visible to all', 'non-Europe', '', 0, '770.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(583, 1, 4, 'THE DATA PROTECTION GUIDE FOR ENTERPRISE MODERNIZATION', '', 'HR', '', '', '', '', 'no', '771.JPG', 'Visible to all', 'non-Europe', '', 0, '771.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(584, 1, 1, 'Return on cloud – why a razor-sharp focus on management is key', '', 'IT', '', '', '', '', 'no', '772.JPG', 'Visible to all', 'non-Europe', '', 0, '772.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(585, 1, 2, 'Future-Proofed The Journey Toward Quantum-Safe Security', '', 'Marketing', '', '', '', '', 'no', '773.JPG', 'Visible to all', 'non-Europe', '', 0, '773.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(586, 1, 1, 'Get a truly consistent experience with AWS hybrid and edge solutions—helping organizations solve IT ', '', 'IT', '', '', '', '', 'no', '774.JPG', 'Visible to all', 'non-Europe', '', 0, '774.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(587, 1, 1, 'Getting the Most from Microsoft Teams', '', 'IT', '', '', '', '', 'no', '775.JPG', 'Visible to all', 'non-Europe', '', 0, '775.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(588, 1, 2, 'Global Guide to Hiring Contractors: EMEA', '', 'Marketing', '', '', '', '', 'no', '776.JPG', 'Visible to all', 'non-Europe', '', 0, '776.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(589, 1, 1, 'Global Guide to Hiring Independent Contractors: US & Canada', '', 'IT', '', '', '', '', 'no', '777.JPG', 'Visible to all', 'non-Europe', '', 0, '777.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(590, 1, 1, 'The Goldilocks Budget', '', 'IT', '', '', '', '', 'no', '778.JPG', 'Visible to all', 'non-Europe', '', 0, '778.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(591, 1, 1, 'The Voice Choice', '', 'IT', '', '', '', '', 'no', '779.JPG', 'Visible to all', 'non-Europe', '', 0, '779.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(592, 1, 2, 'RETENTION ACCELERATOR GUIDEBOOK', '', 'Marketing', '', '', '', '', 'no', '780.JPG', 'Visible to all', 'non-Europe', '', 0, '780.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(593, 1, 1, 'Guide to electronic signatures', '', 'IT', '', '', '', '', 'no', '781.JPG', 'Visible to all', 'non-Europe', '', 0, '781.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(594, 1, 1, 'Healthcare without boundaries', '', 'IT', '', '', '', '', 'no', '782.JPG', 'Visible to all', 'non-Europe', '', 0, '782.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(595, 1, 5, 'How a Stronger Online Reputation Helps Home Services Companies Build Trust & Win Jobs', '', 'Operations', '', '', '', '', 'no', '783.JPG', 'Visible to all', 'non-Europe', '', 0, '783.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(596, 1, 2, 'How four leading businesses optimized real-time advertising performance', '', 'Marketing', '', '', '', '', 'no', '784.JPG', 'Visible to all', 'non-Europe', '', 0, '784.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(597, 1, 1, 'How IBM Cloud for VMware Helps Enterprises Save on Mission-Critical Workloads', '', 'IT', '', '', '', '', 'no', '785.JPG', 'Visible to all', 'non-Europe', '', 0, '785.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(598, 1, 1, 'How Next-Generation Isolated Sigma-Delta Modulators Improve Your System-Level Current Measurement', '', 'IT', '', '', '', '', 'no', '786.JPG', 'Visible to all', 'non-Europe', '', 0, '786.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(599, 1, 1, 'How to Choose the Best MEMS Sensor for a Wireless Condition-Based Monitoring System—Part 2: How to D', '', 'IT', '', '', '', '', 'no', '787.JPG', 'Visible to all', 'non-Europe', '', 0, '787.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(600, 1, 2, 'How to Choose the Right Azure Services for Your Applications – It’s Not A or B', '', 'Marketing', '', '', '', '', 'no', '788.JPG', 'Visible to all', 'non-Europe', '', 0, '788.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(601, 1, 1, 'How to Design a Good Vibration Sensor Enclosure Using Modal Analysis', '', 'IT', '', '', '', '', 'no', '789.JPG', 'Visible to all', 'non-Europe', '', 0, '789.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(602, 1, 1, 'How to Remain Connected to Remote Workers', '', 'IT', '', '', '', '', 'no', '790.JPG', 'Visible to all', 'non-Europe', '', 0, '790.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(603, 1, 6, 'How to run virtually any workload in the cloud', '', 'Finance', '', '', '', '', 'no', '791.JPG', 'Visible to all', 'non-Europe', '', 0, '791.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(604, 1, 1, 'INFORMATICA REDUCING COSTS WITH CLOUD MODERNIZATION', '', 'IT', '', '', '', '', 'no', '792.JPG', 'Visible to all', 'non-Europe', '', 0, '792.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(605, 1, 5, 'Charting a new course: combating burnout in healthcare', '', 'Operations', '', '', '', '', 'no', '793.JPG', 'Visible to all', 'non-Europe', '', 0, '793.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(606, 1, 1, 'How 5 companies keep their hybrid workforce connected', '', 'IT', '', '', '', '', 'no', '794.JPG', 'Visible to all', 'non-Europe', '', 0, '794.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(607, 1, 1, 'How Self-Service Technology Is Transforming Client Journeys in Financial Services', '', 'IT', '', '', '', '', 'no', '795.JPG', 'Visible to all', 'non-Europe', '', 0, '795.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(608, 1, 1, 'How to Build Dashboards that Persuade, Inform, and Engage', '', 'IT', '', '', '', '', 'no', '796.JPG', 'Visible to all', 'non-Europe', '', 0, '796.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(609, 1, 1, 'Active Intelligence The Next Era of Business Intelligence', '', 'IT', '', '', '', '', 'no', '797.JPG', 'Visible to all', 'non-Europe', '', 0, '797.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(610, 1, 4, 'Advanced Analytics with Tableau', '', 'HR', '', '', '', '', 'no', '798.JPG', 'Visible to all', 'non-Europe', '', 0, '798.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(611, 1, 4, 'Fortgeschrittene Analytics\r\nmit Tableau', '', 'HR', '', '', '', '', 'no', '799.JPG', 'Visible to all', 'non-Europe', '', 0, '799.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(612, 1, 4, 'L\'analytique avancée avec Tableau', '', 'HR', '', '', '', '', 'no', '800.JPG', 'Visible to all', 'non-Europe', '', 0, '800.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(613, 1, 5, 'Agile integration drives digital business for mid-market companies', '', 'Operations', '', '', '', '', 'no', '801.JPG', 'Visible to all', 'non-Europe', '', 0, '801.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(614, 1, 1, 'Supporting PCI-DSS Compliance for Cloud Native Environments', '', 'IT', '', '', '', '', 'no', '802.JPG', 'Visible to all', 'non-Europe', '', 0, '802.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(615, 1, 1, 'The complete checklist When to use Aqua Trivy or Aqua Enterprise', '', 'IT', '', '', '', '', 'no', '803.JPG', 'Visible to all', 'non-Europe', '', 0, '803.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(616, 1, 5, 'Five stories of creating better customer experiences through cloud migration', '', 'Operations', '', '', '', '', 'no', '804.JPG', 'Visible to all', 'non-Europe', '', 0, '804.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(617, 1, 5, 'Fünf Schritte zur Vereinfachung Ihrer Data Mart- und BI-Lösung', '', 'Operations', '', '', '', '', 'no', '805.JPG', 'Visible to all', 'non-Europe', '', 0, '805.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(618, 1, 1, 'Technologie eröffnet Mitarbeitenden in Service und Produktion eine neue Zukunft', '', 'IT', '', '', '', '', 'no', '806.JPG', 'Visible to all', 'non-Europe', '', 0, '806.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(619, 1, 5, 'The machine learning journey', '', 'Operations', '', '', '', '', 'no', '807.JPG', 'Visible to all', 'non-Europe', '', 0, '807.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(620, 1, 5, 'Top Five Software CPO Priorities', '', 'Operations', '', '', '', '', 'no', '808.JPG', 'Visible to all', 'non-Europe', '', 0, '808.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(621, 1, 6, 'Employee Engagement Survey', '', 'Finance', '', '', '', '', 'no', '809.JPG', 'Visible to all', 'non-Europe', '', 0, '809.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(622, 1, 1, '5 capabilities for the best Azure backup and recovery', '', 'IT', '', '', '', '', 'no', '810.JPG', 'Visible to all', 'non-Europe', '', 0, '810.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(623, 1, 2, 'Savings at the center of your solar system', '', 'Marketing', '', '', '', '', 'no', '811.JPG', 'Visible to all', 'non-Europe', '', 0, '811.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(624, 1, 5, 'Beginner’s Guide to SEO', '', 'Operations', '', '', '', '', 'no', '812.JPG', 'Visible to all', 'non-Europe', '', 0, '812.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(625, 1, 6, 'Beyond CRM: The CFO’s Guide\r\nto Driving Sales Revenue and\r\nReducing Sales Costs', '', 'Finance', '', '', '', '', 'no', '813.JPG', 'Visible to all', 'non-Europe', '', 0, '813.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(626, 1, 5, 'BIG PAYOFFS FROM BIG BETS IN AI-POWERED AUTOMATION', '', 'Operations', '', '', '', '', 'no', '814.JPG', 'Visible to all', 'non-Europe', '', 0, '814.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(627, 1, 5, 'Building a\r\nBusiness Case for\r\nAP Automation', '', 'Operations', '', '', '', '', 'no', '815.JPG', 'Visible to all', 'non-Europe', '', 0, '815.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(628, 1, 6, 'Building the Ideal\r\nMaster Data\r\nManagement RFP', '', 'Finance', '', '', '', '', 'no', '816.JPG', 'Visible to all', 'non-Europe', '', 0, '816.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(629, 1, 1, 'Building\r\nan Inclusive\r\nWorkplace', '', 'IT', '', '', '', '', 'no', '817.JPG', 'Visible to all', 'non-Europe', '', 0, '817.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(630, 1, 1, 'Building a digital infrastructure for the entire organization', '', 'IT', '', '', '', '', 'no', '818.JPG', 'Visible to all', 'non-Europe', '', 0, '818.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(631, 1, 4, 'Essential tips for finding your ideal ITSM solution', '', 'HR', '', '', '', '', 'no', '819.png', 'Visible to all', 'non-Europe', '', 0, '819.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(632, 1, 4, 'Choosing an SD-WAN for Secure WAN Edge\r\nTransformation: 7 Requisite Capabilities', '', 'HR', '', '', '', '', 'no', '820.JPG', 'Visible to all', 'non-Europe', '', 0, '820.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(633, 1, 2, 'Assessing Enterprise with Free Open Source Options in the Public Sector', '', 'Marketing', '', '', '', '', 'no', '821.JPG', 'Visible to all', 'non-Europe', '', 0, '821.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(634, 1, 2, 'Security Approaches for Hybrid Cloud\r\nEnvironments', '', 'Marketing', '', '', '', '', 'no', '822.JPG', 'Visible to all', 'non-Europe', '', 0, '822.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(635, 1, 6, 'Security Approaches for Hybrid Cloud\r\nEnvironments', '', 'Finance', '', '', '', '', 'no', '823.JPG', 'Visible to all', 'non-Europe', '', 0, '823.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(636, 1, 6, 'Cloud Migration And App Modernization: Complements Of A Successful Cloud-Native Strategy', '', 'Finance', '', '', '', '', 'no', '824.JPG', 'Visible to all', 'non-Europe', '', 0, '824.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(637, 1, 1, 'CLOUD MODERNIZATION POWERED BY DATA', '', 'IT', '', '', '', '', 'no', '825.JPG', 'Visible to all', 'non-Europe', '', 0, '825.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(638, 1, 1, 'Standardizing the ML Experimentation Process', '', 'IT', '', '', '', '', 'no', '826.png', 'Visible to all', 'non-Europe', '', 0, '826.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(639, 1, 2, 'COMPLIANCE PLAYBOOK: HOW TO IMPROVE GLOBAL SPEED-TO-HIRE', '', 'Marketing', '', '', '', '', 'no', '827.JPG', 'Visible to all', 'non-Europe', '', 0, '827.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(640, 1, 1, 'Consiga más rendimiento para sus aplicaciones a menor costo con AWS', '', 'IT', '', '', '', '', 'no', '828.JPG', 'Visible to all', 'non-Europe', '', 0, '828.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(641, 1, 1, 'Conversational azure backup best practices', '', 'IT', '', '', '', '', 'no', '829.JPG', 'Visible to all', 'non-Europe', '', 0, '829.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(642, 1, 1, 'Create 3D assets with a 2D skillset using the Adobe Substance 3D Collection', '', 'IT', '', '', '', '', 'no', '830.JPG', 'Visible to all', 'non-Europe', '', 0, '830.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(643, 1, 1, 'Customer 360 for data leaders', '', 'IT', '', '', '', '', 'no', '831.JPG', 'Visible to all', 'non-Europe', '', 0, '831.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(644, 1, 1, 'Windows 365 eBook: The only constant is change', '', 'IT', '', '', '', '', 'no', '832.JPG', 'Visible to all', 'non-Europe', '', 0, '832.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57');
INSERT INTO `books` (`book_id`, `user_id`, `c_id`, `name`, `description`, `subject_area`, `keywords`, `author`, `company`, `url`, `customquestion`, `image`, `type`, `europe`, `google`, `top`, `file1`, `file2`, `file3`, `file4`, `file5`, `username`, `ip_address`, `user_agent`, `date`) VALUES
(645, 1, 4, 'Entering the cloud: A guide for small cybersecurity teams', '', 'HR', '', '', '', '', 'no', '833.JPG', 'Visible to all', 'non-Europe', '', 0, '833.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(646, 1, 4, 'Implementing zero trust: Key considerations before you begin', '', 'HR', '', '', '', '', 'no', '834.JPG', 'Visible to all', 'non-Europe', '', 0, '834.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(647, 1, 1, 'Data Analytics Buyer\'s Guide Top Questions to Ask When Choosing a BI Tool', '', 'IT', '', '', '', '', 'no', '835.JPG', 'Visible to all', 'non-Europe', '', 0, '835.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(648, 1, 1, 'Daten jens eit s von Dashb oards: Dialogorientierte Analyse für blitzschnelle Erkenntnisse', '', 'IT', '', '', '', '', 'no', '836.JPG', 'Visible to all', 'non-Europe', '', 0, '836.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(649, 1, 6, 'Los datos más allá de los cuadros de mando: Analítica conversacional para obtener información instan', '', 'Finance', '', '', '', '', 'no', '837.JPG', 'Visible to all', 'non-Europe', '', 0, '837.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(650, 1, 6, 'L a data au - delà de s t ableaux de bord : l\'analyse conversationnelle pour des perspectives instan', '', 'Finance', '', '', '', '', 'no', '838.JPG', 'Visible to all', 'non-Europe', '', 0, '838.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(651, 1, 6, 'Dati oltre le dashboard: analytics conversazionali per intuizioni immediate', '', 'Finance', '', '', '', '', 'no', '839.JPG', 'Visible to all', 'non-Europe', '', 0, '839.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(652, 1, 1, 'Data Beyond Dashb oards: Conversational Analytics for Instant Insights', '', 'IT', '', '', '', '', 'no', '840.JPG', 'Visible to all', 'non-Europe', '', 0, '840.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(653, 1, 2, 'Data governance and privacy for data leaders', '', 'Marketing', '', '', '', '', 'no', '841.JPG', 'Visible to all', 'non-Europe', '', 0, '841.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(654, 1, 1, 'IBM Cloud for Financial Services', '', 'IT', '', '', '', '', 'no', '842.JPG', 'Visible to all', 'non-Europe', '', 0, '842.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(655, 1, 1, 'Slash Non-Billable Hours and Risk with a Little Technology', '', 'IT', '', '', '', '', 'no', '843.JPG', 'Visible to all', 'non-Europe', '', 0, '843.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(656, 1, 3, 'Defining the Next Normal for Projects', '', 'Sales', '', '', '', '', 'no', '844.JPG', 'Visible to all', 'non-Europe', '', 0, '844.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(657, 1, 1, 'Delivering Personalized Experiences in Times of Change', '', 'IT', '', '', '', '', 'no', '845.JPG', 'Visible to all', 'non-Europe', '', 0, '845.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(658, 1, 1, '9 Emerging Trends for the Futurist CFO', '', 'IT', '', '', '', '', 'no', '846.JPG', 'Visible to all', 'non-Europe', '', 0, '846.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(659, 1, 1, 'Beyond CRM_ The CFO\'s Guide to Driving Sales Revenue and Reducing Sales Costs', '', 'IT', '', '', '', '', 'no', '847.JPG', 'Visible to all', 'non-Europe', '', 0, '847.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(660, 1, 2, 'Delivering Personalized Experiences in Times of Change', '', 'Marketing', '', '', '', '', 'no', '848.JPG', 'Visible to all', 'non-Europe', '', 0, '848.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(661, 1, 1, 'Five Steps to Simplify Your Data Mart and BI Solution', '', 'IT', '', '', '', '', 'no', '849.JPG', 'Visible to all', 'non-Europe', '', 0, '849.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(662, 1, 6, 'Limitless Analytics - Abbreviated', '', 'Finance', '', '', '', '', 'no', '850.JPG', 'Visible to all', 'non-Europe', '', 0, '850.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(663, 1, 6, 'Technology Can Help Unlock a New Future with Frontline Workers', '', 'Finance', '', '', '', '', 'no', '851.JPG', 'Visible to all', 'non-Europe', '', 0, '851.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(664, 1, 1, 'The Futurist CFO\'s Guide to Business Model Innovation', '', 'IT', '', '', '', '', 'no', '852.JPG', 'Visible to all', 'non-Europe', '', 0, '852.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(665, 1, 2, 'Deskless Not Voiceless The 2021 Frontline Barometer', '', 'Marketing', '', '', '', '', 'no', '853.JPG', 'Visible to all', 'non-Europe', '', 0, '853.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(666, 1, 1, 'Die Rolle der Datenspeicherung für die Herstellung echter Cyberresilienz', '', 'IT', '', '', '', '', 'no', '854.JPG', 'Visible to all', 'non-Europe', '', 0, '854.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(667, 1, 3, 'DIGITIZING 101 FOR\r\nRECORDS AND\r\nINFORMATION\r\nMANAGEMENT', '', 'Sales', '', '', '', '', 'no', '855.JPG', 'Visible to all', 'non-Europe', '', 0, '855.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(668, 1, 1, 'Dr. Patrice Harris Shares her Vision for a Thriving Healthcare Ecosystem', '', 'IT', '', '', '', '', 'no', '856.JPG', 'Visible to all', 'non-Europe', '', 0, '856.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(669, 1, 1, 'Driving Higher Levels of Flexibility, Productivity, and Sustainability in Smart Manufacturing', '', 'IT', '', '', '', '', 'no', '857.JPG', 'Visible to all', 'non-Europe', '', 0, '857.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(670, 1, 1, 'Driving Profitability in Manufacturing : 5 Successful Customer Portals Built with Liferay', '', 'IT', '', '', '', '', 'no', '858.JPG', 'Visible to all', 'non-Europe', '', 0, '858.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(671, 1, 5, 'Du rôle du stockage pour relever les défis de la cyber-résilience', '', 'Operations', '', '', '', '', 'no', '859.JPG', 'Visible to all', 'non-Europe', '', 0, '859.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(672, 1, 2, 'Required Capabilities for Effective and Secure SD-WAN: The Network Leader’s Guide', '', 'Marketing', '', '', '', '', 'no', '860.JPG', 'Visible to all', 'non-Europe', '', 0, '860.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(673, 1, 1, 'How to build a security Framework If You\'re a Resource Drained IT Security Team', '', 'IT', '', '', '', '', 'no', '861.JPG', 'Visible to all', 'non-Europe', '', 0, '861.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(674, 1, 1, 'RETENTION ROADMAP: WAYS TO REDUCE TALENT TURNOVER IN 2022 AND BEYON', '', 'IT', '', '', '', '', 'no', '862.JPG', 'Visible to all', 'non-Europe', '', 0, '862.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(675, 1, 1, 'The Age of Anytime, Anywhere: Flexible Working is a Must-Have', '', 'IT', '', '', '', '', 'no', '863.JPG', 'Visible to all', 'non-Europe', '', 0, '863.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(676, 1, 1, '7 KEY TRAITS OF AN E-COMMERCE LOGISTICS PROVIDER', '', 'IT', '', '', '', '', 'no', '864.JPG', 'Visible to all', 'non-Europe', '', 0, '864.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(677, 1, 2, '_A Simpler Way to Modernize Your Supply Chain(HBR Article)_', '', 'Marketing', '', '', '', '', 'no', '865.PNG', 'Visible to all', 'non-Europe', '', 0, '865.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(678, 1, 5, '5 Tips for Easing Common IT Frustrations', '', 'Operations', '', '', '', '', 'no', '866.PNG', 'Visible to all', 'non-Europe', '', 0, '866.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(679, 1, 5, '5 ways to engage and support patients with chronic conditions', '', 'Operations', '', '', '', '', 'no', '867.PNG', 'Visible to all', 'non-Europe', '', 0, '867.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(680, 1, 5, '5 Ways to Embrace the Future of Remote & Hybrid Work', '', 'Operations', '', '', '', '', 'no', '868.PNG', 'Visible to all', 'non-Europe', '', 0, '868.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(681, 1, 4, 'The Ultimate Guide to Paid Advertising in the Legal Sector', '', 'HR', '', '', '', '', 'no', '869.PNG', 'Visible to all', 'non-Europe', '', 0, '869.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(682, 1, 4, 'The State of Commerce 2022', '', 'HR', '', '', '', '', 'no', '870.PNG', 'Visible to all', 'non-Europe', '', 0, '870.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(683, 1, 4, 'How to Make the Hybrid Model Work for Your Team', '', 'HR', '', '', '', '', 'no', '871.PNG', 'Visible to all', 'non-Europe', '', 0, '871.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(684, 1, 1, 'Cloud Migration And App Modernization: Complements Of A Successful Cloud-Native Strategy', '', 'IT', '', '', '', '', 'no', '872.PNG', 'Visible to all', 'non-Europe', '', 0, '872.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(685, 1, 1, 'The Total Economic Impact™ Of IBM Watson Assistant', '', 'IT', '', '', '', '', 'no', '873.PNG', 'Visible to all', 'non-Europe', '', 0, '873.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(686, 1, 1, 'Successful Enterprise Application Modernization Requires Hybrid Cloud Infrastructure', '', 'IT', '', '', '', '', 'no', '874.PNG', 'Visible to all', 'non-Europe', '', 0, '874.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(687, 1, 2, 'Unified Endpoint Management and Security in a Work-from-anywhere World', '', 'Marketing', '', '', '', '', 'no', '875.PNG', 'Visible to all', 'non-Europe', '', 0, '875.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(688, 1, 1, 'Cloud Migration And App Modernization: Complements Of A Successful Cloud-Native Strategy', '', 'IT', '', '', '', '', 'no', '876.PNG', 'Visible to all', 'non-Europe', '', 0, '876.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(689, 1, 1, '‘Tis the season for online shopping', '', 'IT', '', '', '', '', 'no', '877.PNG', 'Visible to all', 'non-Europe', '', 0, '877.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(690, 1, 1, 'Six Myths of SIEM', '', 'IT', '', '', '', '', 'no', '878.PNG', 'Visible to all', 'non-Europe', '', 0, '878.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(691, 1, 1, 'Introducing IBM Security QRadar XDR', '', 'IT', '', '', '', '', 'no', '879.PNG', 'Visible to all', 'non-Europe', '', 0, '879.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(692, 1, 2, 'Streamlining DevOps in Hybrid? Multi?cloud? On?premises? and Edge Environments', '', 'Marketing', '', '', '', '', 'no', '880.PNG', 'Visible to all', 'non-Europe', '', 0, '880.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(693, 1, 2, 'The COO’s Pocket Guide to Enterprisewide Intelligent Automation', '', 'Marketing', '', '', '', '', 'no', '881.PNG', 'Visible to all', 'non-Europe', '', 0, '881.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(694, 1, 2, 'The Total Economic Impact™ Of IBM Cloud For VMware Solutions', '', 'Marketing', '', '', '', '', 'no', '882.PNG', 'Visible to all', 'non-Europe', '', 0, '882.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(695, 1, 4, '4 Ways to Drive Supply Chain Resilience with Data', '', 'HR', '', '', '', '', 'no', '883.PNG', 'Visible to all', 'non-Europe', '', 0, '883.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(696, 1, 1, '4 Azure Considerations To Reduce Costs', '', 'IT', '', '', '', '', 'no', '884.PNG', 'Visible to all', 'non-Europe', '', 0, '884.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(697, 1, 2, '4 Steps to Master Remote Work', '', 'Marketing', '', '', '', '', 'no', '885.PNG', 'Visible to all', 'non-Europe', '', 0, '885.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(698, 1, 1, '4 ways predictive analytics takes IT from stressed to strategic', '', 'IT', '', '', '', '', 'no', '886.PNG', 'Visible to all', 'non-Europe', '', 0, '886.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(699, 1, 1, 'The Commerce Protection Buyer’s Guide', '', 'IT', '', '', '', '', 'no', '887.PNG', 'Visible to all', 'non-Europe', '', 0, '887.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(700, 1, 1, '5 Steps to Strategic Spend Management', '', 'IT', '', '', '', '', 'no', '888.PNG', 'Visible to all', 'non-Europe', '', 0, '888.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(701, 1, 3, '6 Strategien zur Modernisierung Ihres drahtlosen Netzwerks', '', 'Sales', '', '', '', '', 'no', '889.PNG', 'Visible to all', 'non-Europe', '', 0, '889.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(702, 1, 2, 'Build.com – the fastest growing online home improvement retailer in the US', '', 'Marketing', '', '', '', '', 'no', '890.PNG', 'Visible to all', 'non-Europe', '', 0, '890.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(703, 1, 2, '7 steps to connect and empower 7your frontline workers', '', 'Marketing', '', '', '', '', 'no', '891.PNG', 'Visible to all', 'non-Europe', '', 0, '891.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(704, 1, 1, '7 reasons to expand e-signature usage', '', 'IT', '', '', '', '', 'no', '892.PNG', 'Visible to all', 'non-Europe', '', 0, '892.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(705, 1, 1, '8 Questions to Help Assess Your T&E Program', '', 'IT', '', '', '', '', 'no', '893.PNG', 'Visible to all', 'non-Europe', '', 0, '893.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(706, 1, 1, '9 Emerging Trends for the Futurist CFO', '', 'IT', '', '', '', '', 'no', '894.PNG', 'Visible to all', 'non-Europe', '', 0, '894.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(707, 1, 5, 'Optimizing HR Management with Modern Analytics', '', 'Operations', '', '', '', '', 'no', '895.PNG', 'Visible to all', 'non-Europe', '', 0, '895.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(708, 1, 1, 'Improving Supply Chain Performance with Modern Analytics', '', 'IT', '', '', '', '', 'no', '896.PNG', 'Visible to all', 'non-Europe', '', 0, '896.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(709, 1, 2, '10 Best Practices for Building Effective Dashboards', '', 'Marketing', '', '', '', '', 'no', '897.PNG', 'Visible to all', 'non-Europe', '', 0, '897.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(710, 1, 2, 'F r o s t R a d a r ™ : US e C o m m e r c e F r a u d P r e v e n t i o n , 2 0 2 2', '', 'Marketing', '', '', '', '', 'no', '898.PNG', 'Visible to all', 'non-Europe', '', 0, '898.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(711, 1, 1, '10 ways to optimise IT services for hybrid work realities', '', 'IT', '', '', '', '', 'no', '899.PNG', 'Visible to all', 'non-Europe', '', 0, '899.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(712, 1, 1, '10BASE-T1L: Extending the Scope for Big Data Analytics to the Edge of the Factory Network', '', 'IT', '', '', '', '', 'no', '900.PNG', 'Visible to all', 'non-Europe', '', 0, '900.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(713, 1, 1, '10 reasons to adopt e-signature', '', 'IT', '', '', '', '', 'no', '901.PNG', 'Visible to all', 'non-Europe', '', 0, '901.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(714, 1, 4, 'Best practices for deploying a legal transaction management solution', '', 'HR', '', '', '', '', 'no', '902.PNG', 'Visible to all', 'non-Europe', '', 0, '902.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(715, 1, 2, 'MODERN SUPPLY CHAINS DEMAND AGILE LOGISTICS', '', 'Marketing', '', '', '', '', 'no', '903.PNG', 'Visible to all', 'non-Europe', '', 0, '903.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(716, 1, 1, 'SUPPLY CHAIN DISRUPTIONS WILL END; WHEN IS AN OPEN QUESTION', '', 'IT', '', '', '', '', 'no', '904.PNG', 'Visible to all', 'non-Europe', '', 0, '904.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(717, 1, 4, '5 FORCES THAT ARE TRANSFORMING FULFILLMENT', '', 'HR', '', '', '', '', 'no', '905.PNG', 'Visible to all', 'non-Europe', '', 0, '905.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(718, 1, 1, 'How to Leverage Sage Intacct to Thrive During a Recession', '', 'IT', '', '', '', '', 'no', '906.PNG', 'Visible to all', 'non-Europe', '', 0, '906.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(719, 1, 2, '7 Ways to Recession-proof your Business With Modern B2B Payments and NetSuite', '', 'Marketing', '', '', '', '', 'no', '907.PNG', 'Visible to all', 'non-Europe', '', 0, '907.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(720, 1, 2, 'Monetarisierung durch Visualisierung', '', 'Marketing', '', '', '', '', 'no', '908.PNG', 'Visible to all', 'non-Europe', '', 0, '908.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(721, 1, 2, 'Visualisation et monétisation', '', 'Marketing', '', '', '', '', 'no', '909.PNG', 'Visible to all', 'non-Europe', '', 0, '909.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(722, 1, 3, 'A 5-Step Blueprint for Master Data Management Success', '', 'Sales', '', '', '', '', 'no', '910.PNG', 'Visible to all', 'non-Europe', '', 0, '910.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(723, 1, 1, 'A C-SUITE BLUEPRINT FOR EMPOWERING FIRSTLINE WORKERS', '', 'IT', '', '', '', '', 'no', '911.PNG', 'Visible to all', 'non-Europe', '', 0, '911.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(724, 1, 1, 'A Human Resource Leader’s Guide:', '', 'IT', '', '', '', '', 'no', '912.PNG', 'Visible to all', 'non-Europe', '', 0, '912.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(725, 1, 1, 'A Strategy for Performance & Retention', '', 'IT', '', '', '', '', 'no', '913.PNG', 'Visible to all', 'non-Europe', '', 0, '913.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(726, 1, 1, 'Accelerate innovation with AWS', '', 'IT', '', '', '', '', 'no', '914.PNG', 'Visible to all', 'non-Europe', '', 0, '914.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(727, 1, 4, 'Access new levels of creative freedom and control with 3D-powered design.', '', 'HR', '', '', '', '', 'no', '915.PNG', 'Visible to all', 'non-Europe', '', 0, '915.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(728, 1, 4, 'Activating Intelligence for HCM', '', 'HR', '', '', '', '', 'no', '916.PNG', 'Visible to all', 'non-Europe', '', 0, '916.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(729, 1, 5, 'Capture the Moment with Action-Oriented Analytics', '', 'Operations', '', '', '', '', 'no', '917.PNG', 'Visible to all', 'non-Europe', '', 0, '917.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(730, 1, 2, 'Capture the Moment with Analytics-Ready, Real-Time Data', '', 'Marketing', '', '', '', '', 'no', '918.PNG', 'Visible to all', 'non-Europe', '', 0, '918.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(731, 1, 3, 'LA PRÓXIMA ERA DEL BUSINESS INTELLIGENCE', '', 'Sales', '', '', '', '', 'no', '919.PNG', 'Visible to all', 'non-Europe', '', 0, '919.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57'),
(732, 1, 2, 'State of Commerce', '', 'Marketing', '', '', '', '', 'no', '920.PNG', 'Visible to all', 'non-Europe', '', 0, '920.pdf', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, '2026-07-08 17:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(100) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `user_id`, `ip_address`, `user_agent`, `date`, `category_name`) VALUES
(1, 1, NULL, NULL, '2026-05-08', 'IT'),
(2, 1, NULL, NULL, '2026-05-08', 'Marketing'),
(3, 1, NULL, NULL, '2026-05-08', 'Sales'),
(4, 1, NULL, NULL, '2026-05-08', 'HR'),
(5, 1, NULL, NULL, '2026-05-08', 'Operations'),
(6, 1, NULL, NULL, '2026-05-08', 'Finance'),
(7, 1, NULL, NULL, '2026-05-08', 'Current Media');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `company` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `company`, `message`, `user_id`, `ip_address`, `user_agent`, `email_sent`, `created_at`, `updated_at`) VALUES
(1, 'xdd', 'shaikhafrin33@gmail.com', 'yer', 'er6ter', 0, '106.222.207.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 0, '2026-07-08 15:39:26', '2026-07-08 15:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `dnc`
--

CREATE TABLE `dnc` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `communication_opt_in` varchar(10) NOT NULL DEFAULT 'No',
  `created_at` datetime NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iframe`
--

CREATE TABLE `iframe` (
  `iframe_id` int(11) UNSIGNED NOT NULL,
  `website` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `iframe_url` varchar(1000) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `optin` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-04-27-000001', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1778255625, 1),
(2, '2025-04-27-000002', 'App\\Database\\Migrations\\CreateBooksTable', 'default', 'App', 1778255625, 1),
(3, '2025-04-27-000003', 'App\\Database\\Migrations\\CreateTblQuestionsTable', 'default', 'App', 1778255625, 1),
(4, '2025-04-27-000004', 'App\\Database\\Migrations\\CreateTblQuestionsTextTable', 'default', 'App', 1778255625, 1),
(5, '2025-06-02-000000', 'App\\Database\\Migrations\\CreateDncTable', 'default', 'App', 1778255625, 1),
(6, '2026-04-15-070621', 'App\\Database\\Migrations\\CreateAdminsTable', 'default', 'App', 1778255625, 1),
(7, '2026-04-20-000001', 'App\\Database\\Migrations\\CreateContactUsTable', 'default', 'App', 1778255625, 1),
(8, '2026-04-24-000001', 'App\\Database\\Migrations\\CreatePublishTable', 'default', 'App', 1778255625, 1),
(9, '2026-04-24-000002', 'App\\Database\\Migrations\\CreateSubscribeTable', 'default', 'App', 1778255625, 1),
(10, '2026-04-27-000005', 'App\\Database\\Migrations\\AlterWhitepaperTrackingFields', 'default', 'App', 1778255625, 1),
(11, '2026-04-27-000006', 'App\\Database\\Migrations\\AlterLeadTablesTrackingFields', 'default', 'App', 1778255625, 1),
(12, '2026-04-28-000003', 'App\\Database\\Migrations\\CreateIframeTable', 'default', 'App', 1778255625, 1),
(13, '2026-05-01-000001', 'App\\Database\\Migrations\\CreateSurveyLanderTable', 'default', 'App', 1778255625, 1),
(14, '2026-05-01-000002', 'App\\Database\\Migrations\\CreateSurveyQuestionsTable', 'default', 'App', 1778255625, 1),
(15, '2026-05-01-000003', 'App\\Database\\Migrations\\AlterSurveyTrackingFields', 'default', 'App', 1778255625, 1),
(16, '2026-05-01-000004', 'App\\Database\\Migrations\\CreateDirectUploadsTable', 'default', 'App', 1778255625, 1),
(17, '2026-05-01-000005', 'App\\Database\\Migrations\\AlterAdminsAddProfileFields', 'default', 'App', 1778255625, 1),
(18, '2026-05-01-000006', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1778255625, 1),
(19, '2026-05-04-000001', 'App\\Database\\Migrations\\AddAuditColumnsToIframe', 'default', 'App', 1778255625, 1),
(20, '2026-05-04-000001', 'App\\Database\\Migrations\\CreatePartneringTable', 'default', 'App', 1778255625, 1),
(21, '2026-05-04-000001', 'App\\Database\\Migrations\\CreatePasswordResetsTable', 'default', 'App', 1778255625, 1),
(22, '2026-05-04-000002', 'App\\Database\\Migrations\\AlterMissingTrackingFields', 'default', 'App', 1778255625, 1),
(23, '2026-05-04-000003', 'App\\Database\\Migrations\\AlterLoginAttemptFields', 'default', 'App', 1778255625, 1),
(24, '2026-05-08-142922', 'App\\Database\\Migrations\\CreateTblSurveySubmit', 'default', 'App', 1778255625, 1),
(25, '2026-05-08-143659', 'App\\Database\\Migrations\\AddIpUaToSurveySubmit', 'default', 'App', 1778255625, 1),
(26, '2026-05-08-145823', 'App\\Database\\Migrations\\AddCreatedAtToSurveySubmit', 'default', 'App', 1778255625, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partnering`
--

CREATE TABLE `partnering` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

CREATE TABLE `publish` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(190) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(190) NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `Qid` int(11) UNSIGNED NOT NULL COMMENT 'Question ID',
  `Sid` int(11) DEFAULT NULL COMMENT 'Survey ID of tbl_survey',
  `book_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `Question` longtext NOT NULL COMMENT 'Question',
  `Option1` varchar(100) DEFAULT NULL COMMENT 'Option1',
  `Option2` varchar(100) DEFAULT NULL COMMENT 'Option2',
  `Option3` varchar(100) DEFAULT NULL COMMENT 'Option3',
  `Option4` varchar(100) DEFAULT NULL COMMENT 'Option4',
  `Option5` varchar(100) DEFAULT NULL COMMENT 'Option5',
  `Option6` varchar(100) DEFAULT NULL COMMENT 'Option6',
  `textbox` mediumtext DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions_text`
--

CREATE TABLE `tbl_questions_text` (
  `Qid` int(11) UNSIGNED NOT NULL COMMENT 'Question ID',
  `Sid` int(11) DEFAULT NULL COMMENT 'Survey ID of tbl_survey',
  `book_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `Question` longtext NOT NULL COMMENT 'Question',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey`
--

CREATE TABLE `tbl_survey` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_name` varchar(255) NOT NULL,
  `button_value` varchar(100) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_mime` varchar(100) DEFAULT NULL,
  `file_size` int(11) DEFAULT 0,
  `img_title` varchar(255) DEFAULT NULL,
  `img_desc` text DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `privacy` text DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_questions`
--

CREATE TABLE `tbl_survey_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `question_type` enum('textbox','options') NOT NULL DEFAULT 'options',
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `sort_order` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_submit`
--

CREATE TABLE `tbl_survey_submit` (
  `id` int(11) NOT NULL,
  `survey_id` varchar(255) NOT NULL,
  `Questionno` text NOT NULL,
  `answers` text NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

CREATE TABLE `tbl_uploads` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `file` varchar(255) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `img_title` varchar(255) NOT NULL,
  `img_desc` text NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `CampaignId` varchar(100) NOT NULL,
  `google` varchar(10) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`id`, `user_id`, `file`, `type`, `size`, `img_title`, `img_desc`, `img_path`, `CampaignId`, `google`, `ip_address`, `user_agent`, `date`, `created_at`, `updated_at`) VALUES
(1, 0, '49692-Game Changing M365 Backup Service What Small Business Need to Know POC.pdf', 'application/pdf', 393260, 'Test', 'Test', 'test image.JPG', 'test', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(2, 0, '60214-2025 FSP Trends Report.pdf', 'application/pdf', 342760, 'Two Thousand Twenty Five FSP Trends Report', 'The current drug development landscape demands flexible models that leverage innovative strategies and transformative technologies to best support sponsor needs. The future of drug developers’ success hinges on their ability to leverage these technologies and strategies while overcoming industry challenges. Selecting the right outsourcing models enables them to maximize quality, realize operational success and achieve efficiencies.', 'Image.JPG', 'CN41', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(3, 0, '21472-Leveraging remote based.pdf', 'application/pdf', 714458, 'Leveraging remote based regional hubs in FSP partnerships', 'The biopharmaceutical industry faces mounting challenges, from rising drug development costs to high-pressure timelines. Over the past decade, the time required to complete a clinical trial has increased by 20–30%, while the cost of bringing a new drug to market has surged to approximately $2.6 billion. These pressures require innovative solutions to streamline processes, optimize resources and accelerate clinical development without compromising quality.', 'Image2.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(4, 0, '38411-Focus on biotech Harnessing.pdf', 'application/pdf', 344957, 'Focus on biotech Harnessing FSP engagements to deliver on time on budget', 'Biotech companies of all sizes make use of contract research organizations (CROs) to fulfill trial-related functions and services. CROs enable these companies to navigate the financial aspects of their studies by providing transparent, consistent and understandable forecasting and reporting that enables better budget confidence for teams, boards and investors. These outsourced capabilities are most often delivered through a full-service outsourcing (FSO) model, an FSP model', 'Image2.JPG', 'CN41', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(5, 0, '40523-Establishing a Bespoke.pdf', 'application/pdf', 732432, 'Establishing a Bespoke Outsourcing Arrangement with Hybrid FSP FSO Partnerships', 'Outsourcing has taken a growing role in the clinical trial landscape, becoming more popular as drug developers lean on clinical research organizations (CROs) to address clinical trial complexity, expand their capabilities, recruit valuable talent and more. However, outsourcing is not a one-size-fits-all solution and can be employed in a variety of models to fit specific research needs.', 'Image2.JPG', 'CN41', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(6, 0, '26111-Make-testing-a-competitive-advantage-1.pdf', 'application/pdf', 15149251, 'Make testing a competitive advantage How to build towards strategic testing', 'We need to change how we deliver software across the business. The challenge is different for each organization. It could be decentralized automation efforts limiting the ability to scale, legacy tools preventing migration to Agile in a regulated environment, or fragmented analytics and reporting delaying informed decision making.', '6db27fa8-capture.jpeg', 'CN40', 'Yes', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(7, 0, '97366-4 ways.pdf', 'application/pdf', 239367, '4 ways generative AI will transform the way you manage testing', 'With the meteoric advent of generative AI in the last 18 months, organizations on every level have seen incredible opportunities to improve their IT processes from a rapidly growing number of new tools.', '8d14011e-image.jpeg', 'CN40', 'Yes', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(8, 0, '15909-Measuring the software quality.pdf', 'application/pdf', 3050057, 'Measuring the software quality metrics that matter most for DevOps success', 'Over the last eight years, more than 32,000 global IT professionals have participated in the Accelerate State of DevOps reports, making it the largest and longest-running research of its kind. The reports, published by Google Cloud’s DevOps Research and Assessment (DORA) team, provide data-driven industry insights into the capabilities and practices that drive operational and organizational excellence in DevOps.', '4d5a6a82-image.jpeg', 'CN40', 'Yes', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(9, 0, '85277-Monetization.pdf', 'application/pdf', 14161559, 'Monetization in Action Turning audience engagement into revenue and profit', 'It doesn\'t matter how big your audience is or how many users engage with your company on a daily basis if that customer interest doesn\'t impact the bottom line. That’s why brands need to go beyond traditional messaging and engagement efforts and provide the kind of value that inspires completed transactions, repeat purchases, and increased lifetime value LTV.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(10, 0, '56669-TheTEIOfClo.pdf', 'application/pdf', 795659, 'Analyst Paper The Total Economic Impact Of Cloudflare’s Connectivity Cloud Forrester TEI en', 'Enterprises are seeing increased complexity with distributed employees, distributed applications, and myriad siloed networks and vendors. With this growing complexity comes a more dangerous threat landscape highlighting the importance of investing in a purpose-built platform to reduce attack surfaces and improve performance across a wide array of enterprise assets.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(11, 0, '24169-Forrester.pdf', 'application/pdf', 7095034, 'Analyst paper Forrester Regaining Control with a Connectivity Cloud en', 'The security landscape is rapidly evolving. Businesses once had a set number of locations to secure with on premises operations in designated offices. Now, with the adoption of the public cloud, software as a service SaaS applications, and anywhere work, security teams must secure and provide access to infinite locations. These new domains permit less visibility and control than the previous, on-premises environments and require more complex integration efforts.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(12, 0, '32219-IMEA FMCG.pdf', 'application/pdf', 6246304, 'IMEA FMCG Case study Dairy', 'A dairy production Fast-Moving Consumer Goods FMCG company in West Africa that has a strong commitment to producing quality, healthy and nutritious products for its consumers partnered with Maersk to enhance their supply chain.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(14, 0, '52683-Turning Resistance.pdf', 'application/pdf', 4211008, 'Turning Resistance into Opportunity for Organisational Transformation Success', 'While employee adoption is essential for the high performance of any organisational transformation initiative, resistance is a natural human reaction to change. But what if we reframed resistance as an opportunity, not an obstacle?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(18, 0, '76684-Change to Fail.pdf', 'application/pdf', 6511711, 'Change Done Right eBook', 'Digital transformation projects that once had comfortable multiyear timelines are now compressed into months. Workplaces continue to evolve as companies balance remote flexibility with collaborative innovation. AI has upended every aspect of business from how we work to what we sell. Meanwhile, economic uncertainty, global supply chain vulnerabilities, and talent shortages create additional layers of complexity.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(19, 0, '4647-The C Suite.pdf', 'application/pdf', 435879, 'The C Suite Guide to GenAI Risk Management', 'Generative AI GenAI is rapidly transforming businesses, offering unprecedented opportunities for innovation and efficiency. From streamlining processes to unlocking new avenues of creativity, the potential is immense. But with great power comes great responsibility. The rapid adoption of GenAI brings with it a new frontier of security challenges that every organization must navigate.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(20, 0, '23695-securing genai.pdf', 'application/pdf', 5032073, 'securing genai whitepaper', 'Generative AI GenAI has seen a remarkable surge in popularity, transforming productivity across a wide range of sectors and everyday tasks. However, this rapid adoption has also introduced significant security challenges. What new risks and attack vectors have emerged? How severe are they? And can traditional security solutions effectively safeguard the use of AI?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(21, 0, '24930-Change Done Right.pdf', 'application/pdf', 6522141, 'Change Done Right eBook', 'Digital transformation projects that once had comfortable multiyear timelines are now compressed into months. Workplaces continue to evolve as companies balance remote flexibility with collaborative innovation. AI has upended every aspect of business from how we work to what we sell. Meanwhile, economic uncertainty, global supply chain vulnerabilities, and talent shortages create additional layers of complexity.', 'Image2.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(22, 0, '24887-Turning Resistance.pdf', 'application/pdf', 4211008, 'Turning Resistance into Opportunity for Organisational Transformation Success', 'While employee adoption is essential for the high performance of any organisational transformation initiative, resistance is a natural human reaction to change. But what if we reframed resistance as an opportunity, not an obstacle?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(23, 0, '46013-Turning Resistance.pdf', 'application/pdf', 4221490, 'Rencontrez vous des résistances ? Transformez les en opportunité pour réussir la transformation', 'Si l’adoption par les employés est essentielle à la haute performance de toute initiative de transformation organisationnelle, la résistance est une réaction humaine naturelle au changement. Mais que se passerait il si nous considérions la résistance comme une opportunité, et non comme un obstacle ?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(24, 0, '59604-Change Done Right.pdf', 'application/pdf', 6201105, 'Pouvez vous vous permettre que votre changement échoue ?', 'Le rythme, la complexité et l’importance du changement pour la réussite de votre organisation s’accélèrent. Mais qu’est ce qui distingue les organisations résilientes des autres ? Ce n’est pas leur capacité à prédire le changement, mais leur capacité à y répondre avec agilité et détermination.', 'Image2.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(25, 0, '44538-Convertir.pdf', 'application/pdf', 4221490, 'Convertir la résistance en opportunité pour réussir la transformation organisationnelle', 'Si l’adoption par les employés est essentielle à la haute performance de toute initiative de transformation organisationnelle, la résistance est une réaction humaine naturelle au changement. Mais que se passerait il si nous considérions la résistance comme une opportunité, et non comme un obstacle ?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(26, 0, '74579-business case for AI.pdf', 'application/pdf', 5366342, 'How to build a business case for AI', 'As customer experience (CX) takes center stage, stakeholders are increasingly open to AI apps and appreciate the potential value. And executives might be actively pushing your teams to incorporate AI because they’re hearing how other businesses are implementing AI and winning at CX.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(27, 0, '6161-AI adoption model.pdf', 'application/pdf', 90312, 'AI adoption model', 'Realizing returns and minimizing risk with AI requires a thoughtful strategy. Genesys takes a framework-based approach to AI adoption that balances short-term value realization with long-term strategy. In each step of this model, you’ll adopt capabilities that deliver quick returns while laying the groundwork for even greater value later.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(28, 0, '69894-age of AI.pdf', 'application/pdf', 2919997, 'CX in the age of AI report', 'Forward thinking organizations have been reaping the benefits of artificial intelligence (AI) for years, enhancing customer experiences, streamlining operations and empowering employees with the necessary technology to be more productive. The recent buzz around generative AI has opened everyone’s eyes to even more possibilities especially when it comes to the vast potential in the world of customer experience (CX).', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(29, 0, '22697-Securing GenAI.pdf', 'application/pdf', 5032073, 'Securing Gen AI', 'Generative AI (GenAI) has seen a remarkable surge in popularity, transforming productivity across a wide range of sectors and everyday tasks. However, this rapid adoption has also introduced significant security challenges. What new risks and attack vectors have emerged? How severe are they? And can traditional security solutions effectively safeguard the use of AI?', 'Image2.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(30, 0, '4435-Accelerate-Time-to-Value-with-a-Modern-Data-Stack.pdf', 'application/pdf', 8088104, 'Accelerate Time to Value with a Modern Data Stack', 'In modern business, data is central to almost all activities – and the scale of the data deployed to make key decisions grows by the second. In fact, more than 400 million terabytes1 of data are produced every day. But it’s not how much data you have that matters – it’s what you do with it.', 'Capture.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(31, 0, '46829-enterprise.pdf', 'application/pdf', 4330889, 'eBook The enterprise guide to securing and scaling AI en', 'AI is a uniquely fast developing field. According to McKinsey’s Global Survey on AI, 71ps of surveyed organizations already use generative AI (GenAI) in at least one business function, from generating text and images to writing computer code, creating video and audio content, and more.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(32, 0, '77871-Zoom Workplace.pdf', 'application/pdf', 6273829, 'Zoom Workplace vs. Microsoft Teams: Which is best for your organization?', 'Organizations need a seamless collaboration platform that works for employees and administrators, boosting engagement, productivity, and connection. But which collaboration platform is right for your organization?', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(33, 0, '50014-How AI-powered.pdf', 'application/pdf', 7406147, 'How AI-powered Phones are Changing the Modern Workplace', 'The art of how people work together has been in a constant state of change. Working across different time zones, continents, schedules, and work locations has always been a challenge, but this time it feels different. Remote workers, hybrid workers, and in-office workers are all trying to sync together in new ways. Some of these more flexible working styles have created new gaps, and as people include artificial intelligence AI innovations as part of their solutions, businesses need to reimagine how their teams communicate and collaborate.', 'How AI powered Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(34, 0, '49877-The value of Red Hat.pdf', 'application/pdf', 786295, 'The value of the Red Hat OpenShift Virtualization partner ecosystem', 'Many are looking for solutions to move their virtual machines (VMs) to unified platforms where those VMs can sit beside containers and cloud-native architectures. Red Hat® OpenShift® Virtualization technologies, included in Red Hat OpenShift solutions, address these needs by combining the proven Red Hat OpenShift platform with strong virtualization capabilities.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(35, 0, '7158-Techniques.pdf', 'application/pdf', 242980, '451 Research: Techniques to build trustworthy IT auto-remediation processes', 'IT organizations are overwhelmed. The complexity of their ever growing hybrid IT estates is driving them to seek innovative ways to improve the efficiency and output of their existing IT resources. High on their list of priorities is to use technology to increase the rate at which faults or anomalies in infrastructure and applications are detected and remediated without the need for human intervention. They know that many IT processes are manual, mundane and repetitive, making them ripe for auto-remediation techniques. But this is not a new pursuit; previous efforts fell short and often required scarce skilled IT resources to intervene, prohibiting them from focusing on more strategic enterprise initiatives.', 'Techniques Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(36, 0, '81147-IDC Ensure Digital and AI Success.pdf', 'application/pdf', 911266, 'IDC: Ensure Digital and AI Success with a Modern Hybrid Cloud Strategy Focused on Data and Workload Needs', 'This Spotlight explores the hybrid cloud, cloud-native, and data capabilities stemming from the partnership between Red Hat and Cloudera and examines the impact of this deep integration of technologies on the provision of turnkey solutions to organizations. It analyzes the key differentiators of the joint technology offering and explains how it can help businesses to meet a wide array of business outcomes from security and sovereignty to data readiness, hybrid cloud, and AI success.', 'Ensure Digital Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(37, 0, '38671-Network automation for everyone.pdf', 'application/pdf', 1375229, 'Network automation for everyone', 'A foundation for building and operating automation at scale, Red Hat Ansible Automation Platform lets you create and orchestrate complete IT workflows that support your business goals. Multiple domain teams can use the platform, allowing you to build, scale, and deploy automation across your entire organization.', 'NETWORK Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(38, 0, '60292-Overview Accelerate modern virtualization.pdf', 'application/pdf', 237824, 'Overview: Accelerate modern virtualization with Red Hat and Portworx by Pure Storage', 'Organizations find themselves at a crossroads with their virtualization strategies. While virtualization remains crucial for running critical workloads, the rise of cloud computing, evolving application development practices, and marketplace shifts are challenging traditional approaches. These challenges, such as unsustainable costs, limited innovation, and the complexity of migrating to the cloud, necessitate a fresh perspective. Red Hat and Portworx offer a powerful alternative that addresses these challenges, providing a robust path for modernizing infrastructure and data management while retaining and optimizing existing virtual machine (VM) workloads.', 'Accelerate modern virtualization Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(39, 0, '43359-Achieve a strong.pdf', 'application/pdf', 252582, 'Overview: Achieve a strong, steady IT security posture with automation', 'Organizations are deploying open source applications, automated IT infrastructures, and DevOps methodologies to speed development and innovation. Across these environments, every application, script, automation tool, and other non-human identity relies on some form of privileged credential to access tools, applications, and data.', 'Achieve a strong Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(41, 0, '7881-Tactical Buyers Guide.pdf', 'application/pdf', 375337, 'Tactical Buyers Guide Why NetApp for Red Hat OpenShift', 'For the third year in a row, Gartner has named NetApp the 1 primary storage platform for container use cases. Only NetApp offers intelligent data infrastructure across hybrid cloud environments, increasing flexibility, security, simplicity, and return on investment.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(42, 0, '89409-The New Rules.pdf', 'application/pdf', 1801659, 'Keeping Out Fraudsters Not Customers The New Rules of Fraud Prevention', 'Fraud has reached a new evolutionary stage, and if organizations don’t adapt they could be facing extinction. Artificial intelligence AI has provided bad actors with a variety of new tools, like synthetic identities and deepfakes, to employ in their schemes emboldening fraudsters to increase their attacks on businesses and consumers.', 'Ping Identity Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(43, 0, '93896-The Hidden Costs of Fraud.pdf', 'application/pdf', 2525450, 'The Hidden Costs of Fraud', 'Fraud has evolved into a complex business challenge that amounts to more than just monetary loss. Fraud losses due to account takeover ATO and new account fraud NAF are costing enterprises billions annually. Additionally, new and innovative attack vectors, fueled by the rise of artificial intelligence AI, are growing at alarming rates.', 'The Hidden Costs Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(44, 0, '18780-The Ultimate Guide.pdf', 'application/pdf', 1483192, 'The Ultimate Guide to Online Fraud Prevention', 'Account takeover is a form of online identity theft in which a cybercriminal illegally gains unauthorized access to an account belonging to someone else. Once the fraudster has used the stolen credentials to log into an account, they may do one of several things. The most straightforward and obvious option is to use the payment method on file to make a purchase. However, there are several other actions the fraudster might take, all of which ultimately lead to a financial loss for the account holder, the business, and/or even an unrelated third party.', 'The Ultimate Guide Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(45, 0, '34972-Fraud Readiness Checklist.pdf', 'application/pdf', 387844, 'Fraud Readiness Checklist for Financial Services', 'Fraud in financial services is a constantly evolving threat, with bad actors leveraging sophisticated techniques to exploit vulnerabilities in identity systems. From onboarding fraud to account takeovers and data breaches, the stakes are high. Financial service providers must stay one step ahead by adopting comprehensive customer, workforce, and B2B identity and access management IAM solutions that ensure security, compliance, and customer satisfaction. This checklist is designed to guide industry decision-makers in assessing their fraud readiness, equipping them to implement robust strategies and technologies across customer and workforce access ecosystems.', 'Fraud Readiness Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(46, 0, '88020-MCN.pdf', 'application/pdf', 5503938, 'Redefining Payer Operations Data Driven Strategies for the Future of Healthcare', 'Administrative inefficiencies and fragmented data systems cost U.S. healthcare payers billions each year, driving unnecessary spending and delaying critical interventions. In 2024 alone, highdollar claims and operational bottlenecks contributed to a projected $4.9 trillion in healthcare spending—a challenge that demands immediate action.', 'Breaking Media Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(47, 0, '49536-Benefits.pdf', 'application/pdf', 238750, 'Benefits Engagement is a Team Sport Action Guide', 'Engaging employees early and often demands a team approach! A close alignment with your vendor partners and collaboration across the organization is key to success. Effectively engaging employees with their benefits falls on HR, however, it is ultimately a marketing function. Thinking like a marketer and borrowing best practices from your marketing colleagues is a great first step to driving action!', 'Benefits Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(48, 0, '12665-Implementation.pdf', 'application/pdf', 260240, 'Implementation Checklist', 'The right partner makes rolling out a new health solution seamless—building trust, driving engagement, and setting the stage for lasting impact. Use this checklist to launch with confidence.', 'Implementation Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(50, 0, '40297-ACH Real Time Payments.pdf', 'application/pdf', 1680401, 'ACH Real Time Payments How to Strike the Right Balance in Your Credit Union', 'The webinar opened with a poll asking attendees to identify their primary goal for payments modernization. The leading response was offering faster, more flexible payment options.', 'Image.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(51, 0, '76208-Supercharge.pdf', 'application/pdf', 350704, 'Point of Care Lifts Reps Efforts', 'Healthcare providers are clear about what they want from pharma engagement, and it’s opening the door to deeper and more strategic conversations. For leadership teams, this represents a pivotal opportunity: to reimagine how your rep efforts can be amplified.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(52, 0, '16366-8 real life.pdf', 'application/pdf', 7010110, 'Rising to the challenge: 8 real life customer solutions', 'The most impactful IT teams aren’t just fixing problems, they’re leading transformation. Across industries like architecture, manufacturing, transportation, tech, and beyond, IT leaders are using Zoom Workplace and Zoom Phone to rethink how work gets done.', '8 real Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(53, 0, '70139-phone system.pdf', 'application/pdf', 4055917, 'Whats the cost of keeping your on premises phone system?', 'If you’re still holding on to your on-premises phone system, dealing with clunky infrastructure and costly upkeep, you’re not alone. Nearly 50% of organizations still have at least a partial deployment of on-premises phone systems, and 70% of those systems were purchased more than five years ago.', 'Whats Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(54, 0, '91473-Enable.pdf', 'application/pdf', 5629370, 'Enable best in class, integrated experiences with Zoom Phone and Microsoft Teams Solution Brief', 'Bring reliable enterprise-grade calling, meetings, SMS, and AI Companion capabilities to Microsoft Teams seamlessly. Discover how Zoom integrates directly with Teams to enhance productivity, reduce complexity, and enable your teams to connect and collaborate more efficiently.', 'Enable Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(55, 0, '88957-4 benefits.pdf', 'application/pdf', 6393248, 'More than a dial tone 4 benefits of Zoom Phone with AI Companion in your workday', 'Business phone systems can vary widely, from outdated, clunky on-premises infrastructure to modern cloud phone solutions that integrate with the rest of your collaboration tools. Some of the latest technology to hit phones incorporates AI capabilities like summarization and analyzing conversations to provide key insights.', '4 benefits Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(56, 0, '53373-Instant Payments.pdf', 'application/pdf', 967404, 'The Business Case for Real Time Payments: A Use Case Framework', 'The demand for instant, 24/7 payments is accelerating, creating both a challenge and a significant opportunity for credit unions. To stay competitive, you must move beyond simply offering real-time payments and build a strategy around high-value use cases that drive adoption, revenue, and client loyalty.', 'The Business Case for Real-Time Payments_Cover Image (1).png', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(57, 0, '65215-Tier 2 555 guide.pdf', 'application/pdf', 611985, 'Tier 2 Asset: 555 Guide for Practitioners', 'The days of the traditional SOC model have come to an end due to the volume and velocity of modern attacks. The tiered model — where analysts watch screens for incoming events, manually triage them, and then escalate or close out tickets — is too slow and cumbersome to keep pace with cloud attacks. The amount of data we expect SOC analysts to consume, understand, and act upon is already unsustainable.', '555 Guide Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(58, 0, '46948-CSR Software.pdf', 'application/pdf', 2323459, 'CSR Software Buyer\'s Guide UK', 'The right technology can transform the way your organisation does Corporate Social Responsibility CSR, enabling you to create more impact with fewer resources. Whether you’re looking for a CSR platform for the first time or considering switching vendors, this guide will help you assess your options. We’ll give you step by step guidance on how to match your CSR programme’s goals and needs to the right software solution.', 'CSR Software Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(59, 0, '10079-Changes 2025.pdf', 'application/pdf', 10062417, 'Avalara Tax Changes 2025', 'If 2024 brought us stranded astronauts and a troop of escaped monkeys, what 2025 might bring is anyone’s guess. One thing is certain Businesses worldwide will need to navigate new tax obligations.', '2025 Tax Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(60, 0, '75990-know your nexus ebook.pdf', 'application/pdf', 911282, 'Know Your Nexus', 'Getting tax compliance right is important. The first step is understanding where your business has nexus, or where you need to collect and remit sales and use tax. Nexus is ever-changing and it can be confusing for even savvy professionals.', 'know your nexus ebook.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(61, 0, '28939-Career Benefits blog.pdf', 'application/pdf', 251901, 'The Fidelity Advantage Benefits of Building Your Career at a Fidelity Branch', 'Fidelity branches are rooted in the local community and give clients the chance to interact with associates face to face. Clients can walk in or schedule appointments to get their questions answered, complete transactions, and plan for their short and long term goals. We create a presence in the community that empowers clients with in person support and easy access to services, said Samir, a financial consultant. It brings peace of mind that clients have someone to help in their local community.', 'career benefits Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(62, 0, '90824-Convertir.pdf', 'application/pdf', 4221490, 'Vous faites face à de la résistance au changement ? Transformez-la en levier stratégique', 'Si l’adoption par les employés est essentielle à la haute performance de toute initiative de transformation organisationnelle, la résistance est une réaction humaine naturelle au changement. Mais que se passerait-il si nous considérions la résistance comme une opportunité, et non comme un obstacle ?', 'Convertir Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(63, 0, '4927-Pouvez.pdf', 'application/pdf', 1811291, 'Pouvez-vous vous permettre que votre changement échoue ?', 'Le rythme, la complexité et l’importance du changement pour la réussite de votre organisation s’accélèrent. Mais qu’est-ce qui distingue les organisations résilientes des autres ? Ce n’est pas leur capacité à prédire le changement, mais leur capacité à y répondre avec agilité et détermination.', 'Pouvez Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(64, 0, '92963-Turning.pdf', 'application/pdf', 4211008, 'Facing Resistance to Organisational Change? Turn It into Your Advantage', 'While employee adoption is essential for the high performance of any organisational transformation initiative, resistance is a natural human reaction to change. But what if we reframed resistance as an opportunity, not an obstacle?', 'Turning Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(65, 0, '65408-Change to Fail.pdf', 'application/pdf', 16196291, 'Can you afford your change to fail?', 'Change is accelerating in pace, complexity, and criticality to your business success. But, what distinguishes resilient organisations isn’t their ability to predict change, but their capacity to respond to it with agility and purpose.', 'Change to Fail Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(66, 0, '95831-Planit AI Driven Adm Services.pdf', 'application/pdf', 4239202, 'AI-Driven ADM Services', 'The application services outsourcing market is undergoing significant transformations as enterprises increasingly prioritise deriving strategic value from outsourcing partnerships.', 'ISG Image.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(67, 0, '54416-Global Quality Index 2025 26.pdf', 'application/pdf', 2483018, 'Global Quality Index 2025 26', 'The Planit Global Quality Index 2025/26 Report is an essential resource for organisations seeking to navigate the dynamic field of software Quality Engineering (QE). Based on survey data from over 200 quality leaders, it reveals pivotal trends, strategies, and practices that are shaping the future of QE. As businesses manoeuvre through the complexities of digital transformation, ensuring high-quality software has become a business necessity.', 'Global Image.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(68, 0, '20740-testing of ai systems.pdf', 'application/pdf', 4704074, 'testing of ai systems', 'There is now a growing investment into the AI market. Recently, Accenture announced it will invest US$ 3 billion around generative and predictive AI, and will double its data and AI practice in the process.', 'Image.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(69, 0, '41220-Six Keys.pdf', 'application/pdf', 385990, 'Choosing the Right Agrochemical Partner Six Considerations You Can’t Ignore', 'How do you choose the right formulation partner for agrochemical development? It’s important to have a development partner who understands the challenges faced by the agrochemical industry and has the capacity and vision to solve them. Here are six key traits agrochemical companies should look for when choosing a development partner.', 'Battelle-logo.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(70, 0, '86070-Migrating.pdf', 'application/pdf', 297578, 'Migrating from VMware to Red Hat OpenShift Virtualization Using F5 3', 'Migrating workloads from VMware to Red Hat OpenShift Virtualization is a complex process that involves several critical steps, such as network reconfiguration, security policy changes, and managing VM and application downtime. F5 offers a comprehensive suite of products specifically designed to ensure application availability and security throughout the migration process. Initially, customers may choose to migrate less critical workloads to minimize risk and disruption. However, when it comes to mission-critical workloads, the migration process is more challenging and typically entails significant downtime. This document provides an overview on how F5 can streamline the migration from VMware to OpenShift Virtualization by addressing network challenges and ensuring secure, uninterrupted application availability.', 'Migrating Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(71, 0, '29110-Veeam.pdf', 'application/pdf', 1086563, 'Veeam Kasten and Red Hat OpenShift Virtualization reference architecture 4', 'Red Hat OpenShift has become the de facto standard for enterprise cloud native orchestration platforms. OpenShift offers wide support for multiple hardware and infrastructure platforms, both on premises and in the public cloud. With the introduction of Red Hat OpenShift Virtualization, where virtual machines VMs can run adjacent to containerized applications in one platform, comes additional agility and flexibility for customers who embrace cloud native architecture and IT transformation. As organizations modernize from an infrastructure centric virtualization approach toward the application centric approach of cloud native computing, OpenShift Virtualization provides the platform, tooling, and ecosystem required to support an array of use cases at scale.', 'Veeam Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(72, 0, '64849-TWENTY.pdf', 'application/pdf', 1597617, 'Twenty Reasons To Move From Excel To CANDY Estimating Software', 'The cost associated with the bidding process and winning of tenders is not insignificant, contractors must refine their internal processes to ensure best practice efficiencies that lead to a greater chance of winning projects. Many contractors still opt for spreadsheet platforms to perform their estimation calculations. Whilst this may seem like a cheaper option, the operational and productivity inefficiency losses far outweigh the perceived cost savings of the platform.', 'TWENTY Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(73, 0, '87825-Construction.pdf', 'application/pdf', 6865802, 'Are Your Construction Estimates Holding You Back', 'In today’s fast-paced construction sector, estimators are vital to project success. They are in charge of determining material quantities, price, labor, and equipment requirements – all while handling massive volumes of data and navigating complicated processes', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(74, 0, '95766-Ten Key.pdf', 'application/pdf', 4624997, 'Controlling Project Budget From Breaking Ground To Hand-Over', 'Today, all businesses need deeper transparency within the performance of their projects. None more so than in the construction industry where budgets have become much tighter and investors, stakeholders and business owners feel the impact where any over run or overspend will have an amplified impact', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(75, 0, '70601-The New HR Must.pdf', 'application/pdf', 142034, 'The New HR Must Have: Responsible AI Experiences', 'It’s time to put responsible AI to work to help HR teams reduce administrative burden and make it easier for employees to instantly get what they need when they need it, right from the palm of their hand.', 'HR Image.JPG', 'CN40', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(76, 0, '87931-Understanding.pdf', 'application/pdf', 1998100, 'Understanding the Employee Experience with Cancer', 'Unfortunately, cancer is not like other diseases or conditions. Many employers look for lower cost treatment options or screening programs but those measures alone won’t address the many root causes of increased costs or the different ways in which cancer impacts patients and caregivers.', 'Understanding Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(77, 0, '78972-Working.pdf', 'application/pdf', 336481, 'Working with Cancer Conversation Guide', 'Approval to take the pledge typically comes from the CEO, often based on recommendations given from senior leaders like a Chief Human Resources Officer or Chief Communications Officer. You can reach out directly to these individuals if you feel comfortable; or consider collaborating with a senior-level employee impacted by cancer.', 'Working Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(78, 0, '87565-DMSO for solvent-.pdf', 'application/pdf', 583043, 'DMSO for solvent-induced polymer phase inversion', 'A solvent exchange-based in situ forming implant system is comprised of a water insoluble polymer that is dissolved in an organic, water miscible solvent, which may incorporate the drug. When the system is introduced into an aqueous environment (blood or body fluids), the organic solvent dissipates out of the system and the water ingresses via diffusion4 . This exchange of solvents results in sol to gel transformation causing polymer precipitation that leads to implant formation.', 'DMSO for solvent-induced Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(79, 0, '75340-Skin Penetration.pdf', 'application/pdf', 400932, 'DMSO as Skin Penetration Enhancer', 'Effective topical drug delivery depends on overcoming the skin’s natural barrier primarily the stratum corneum. DMSO facilitates this through a multi faceted mechanism involving lipid disruption, protein modification, and enhanced solubility of active ingredients.', 'Skin Penetration Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(80, 0, '81525-The Adoption.pdf', 'application/pdf', 2064651, 'The Adoption Advantage:Why GenAI’s True Value Lies in Everyone’s Hands', 'Amara’s Chief People Officer wants to create a mandate for how to use GenAI. Amara knows that the real value emerges when employees themselves identify and shape the use cases.', 'Adoption Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(81, 0, '93291-Blueprint.pdf', 'application/pdf', 2701643, 'A Blueprint for Value. From employee satisfaction to transformational use of GenAI and all that’s in between.', 'Jacob’s CEO is disappointed at GenAI’s lack of productivity gains. Jacob knows employee satisfaction is a better measure of ROI, and there’s a lot more to gain than productivity.', 'Blueprint Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(82, 0, '70159-ASUG report.pdf', 'application/pdf', 2727444, 'ASUG report: Connecting Real Estate, People, and Processes with SAP and Planon', 'Real estate and facilities are among the biggest line items in any budget, yet the systems used to manage them often lag behind. Data scattered across spreadsheets, aging applications, and disconnected tools leaves leaders without a reliable view of costs, risks, or performance.', 'ASUG report Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(83, 0, '67683-8 trends.pdf', 'application/pdf', 2448217, '8 trends that will shape real estate and facility management by 2027', 'The advancing field of technology continues to drive development in the world of real estate and facility management. Over the years, it has yielded a plethora of advantages for managers in this sector. It can help predict potential issues, reduce administrative work, assist organisations in complying with industry standards, and generally make buildings better places for people to spend their time.', '8 Trends Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(84, 0, '15335-Building.pdf', 'application/pdf', 1564818, 'Cyber Resilient Data Recovery Strategy', 'The NIST Cybersecurity Framework (CSF) 2.0, released in Feb. 2024, builds on previous versions and brings several significant changes that reflect the evolution of the cybersecurity landscape and feedback received from the community', 'Building Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(85, 0, '84860-Transforming.pdf', 'application/pdf', 318098, 'Transforming IT with Cyber Resilience for SMBs', 'Organizations, regardless of size, are turning to IT and utilizing data to its fullest to drive their business transformation and gain a competitive advantage. However, these efforts also present challenges, including an increased risk of cyberattacks — which is further magnified by limited available resources and skills. In this scenario, small and medium-sized businesses (SMBs) must use technology wisely to achieve their digital transformation and business continuity goals while defending against cyberthreats.', 'Transforming Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(86, 0, '59825-Easy.pdf', 'application/pdf', 487042, '5 Easy Steps to Achieve Microsoft 365 Cyber Resilience', 'MFA is an essential security measure that requires users to provide two or more verification factors to gain access to digital resources, such as email accounts, business applications, and online services. There are many benefits of MFA, for example, MFA can defend against the consequences of common cyberattacks such as phishing.', 'Easy Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(87, 0, '93379-backup and recovery.pdf', 'application/pdf', 4651377, 'Buyers Guide: Backup and Recovery Through the Small and Medium Business Lens', 'All of the above require a highly versatile backup solution that meets your organization’s expertise, time, and budget requirements. The best place to start is determining which backup platform elements your business should prioritize when assessing different vendor solutions.', 'Backup Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(88, 0, '61731-Reinventing.pdf', 'application/pdf', 3879265, 'e-book: Reinventing Backup and Recovery with AI & ML: A Smart Solution for Small Businesses', 'To gain further insight into these trends, TechTarget’s Enterprise Strategy Group surveyed 375 IT and data professionals familiar with and/or responsible for data protection (including backup and recovery) decisions and data science for their organization.', 'Reinventing Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(89, 0, '40401-CROSS SKILLING.pdf', 'application/pdf', 67340, 'CROSS SKILLING ADVANTAGE BUILDING FUTURE-READY AGILE GOVT. TEAMS', 'Government agencies today face familiar but growing challenges: rising demand, shrinking budgets, workforce constraints, and ever-evolving technologies like AI, cloud, and cybersecurity. Traditional hiring and reskilling models can\'t keep pace', 'The Cross Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(90, 0, '2669-Big Book.pdf', 'application/pdf', 3974439, 'big-book-generative-ai', 'Table 1 shows the quality of DBRX Instruct and leading established, open models. DBRX Instruct is the leading model on composite benchmarks, programming and mathematics benchmarks, and MMLU. It surpasses all chat or instruction fine-tuned models on standard benchmarks.', 'Big Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(91, 0, '59430-big book generative ai DE.pdf', 'application/pdf', 2930633, 'big-book-generative-ai DE', 'Je stärker Unternehmen auf GenAI-Anwendungen setzen, um sich Wettbewerbsvorteile zu sichern, desto wichtiger wird eine zugrunde liegende Dateninfrastruktur, die diese modernen Technologien sicher und skalierbar unterstützt.', 'Der kompakte Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(92, 0, '35436-Engineering.pdf', 'application/pdf', 5816172, 'big-book-of-data-engineering', 'Die Datenaufnahme bezeichnet den Prozess, bei dem Daten aus einer oder mehreren Quellen auf eine Datenplattform übertragen werden. Solche Quellen können lokal oder in der Cloud gespeicherte Dateien, Datenbanken, Anwendungen oder zunehmend auch Datenströme sein, die Ergebnisse in Echtzeit liefern', 'Kompakter Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(93, 0, '50385-Guide pratique.pdf', 'application/pdf', 2919914, 'big-book-generative-ai FR', 'Les LLM peuvent être combinés à la génération augmentée par récupération. Celle-ci améliore leurs capacités en puisant des informations pertinentes dans des bases de données ou de connaissances externes. Grâce à cette approche qui associe la puissance de la génération à des informations factuelles, le modèle se tient informé sur des sujets spécifiques et produit des résultats plus précis.', 'Le guide Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL);
INSERT INTO `tbl_uploads` (`id`, `user_id`, `file`, `type`, `size`, `img_title`, `img_desc`, `img_path`, `CampaignId`, `google`, `ip_address`, `user_agent`, `date`, `created_at`, `updated_at`) VALUES
(94, 0, '98104-4 Benefits.pdf', 'application/pdf', 7376664, '4 Benefits of a Backup Service', 'An effective IT team is responsible for a large and complex array of tasks within traditional backup environments. These include items such as effective management, regular maintenance, and robust security measures (including timely fixes and patches), all of which are key to a successful backup strategy.', '4 Benefits Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(95, 0, '98980-maximize your.pdf', 'application/pdf', 2359842, 'maximize your organizations potential data and ai', 'The Databricks Data Intelligence Platform provides a unified platform for data and AI, allowing organizations to democratize data and build AI applications. Teams can collaborate and break down data silos, creating a culture of data driven decision-making. Fully capitalize on your own data assets, leveraging traditional and generative AI, data warehousing, business intelligence, and governance.', 'data intelligence Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(96, 0, '77419-Tap the full potential of LLMs.pdf', 'application/pdf', 682711, 'Tap the full potential of LLMs', 'Initial attempts are made to map hard rules around languages and follow logical steps to accomplish tasks like translating a sentence from one language to another.', 'potential Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(97, 0, '44110-Financial Automation.pdf', 'application/pdf', 1405863, 'Using Financial Automation and AI to Cut Costs and Improve Compliance', 'Companies that delay utilizing automation and AI-powered solutions risk being outpaced by faster-moving competitors and paying the price in errors and ine ciencies.', 'Financial Automation Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(98, 0, '29466-harnessing-ai-guide-enus_v1.pdf', 'application/pdf', 2202516, 'AI in HR: Harnessing AI Guide', 'Across many fields, companies are experiencing skills gaps and talent shortages, and perpetual change makes it difficult for HR leaders to recruit and care for their company’s humans while producing the many other business outcomes expected of them.', 'Harnessing Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(99, 0, '52434-HCM and Payroll.pdf', 'application/pdf', 2494407, 'HCM and Payroll Buyer’s Guide', 'Given the changes in the way we work, how workplaces and workforces are organized, and the relationship between workers and AI technology, organizations have a rare opportunity to rethink how a people data platform that elevates HR and payroll can help them master the future of work.', 'HCM and Payroll Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(100, 0, '92296-Three Reasons.pdf', 'application/pdf', 2119007, 'Reasons Workday HCM Enables Modern HR eBook', 'The problem is that breaking away from the crowd has traditionally been difficult. Many legacy systems were implemented decades ago with a patchwork of hard-coded applications and inflexible processes, and this has created stark silos between departments, including HR and finance.', 'Reasons Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(101, 0, '75300-flexible.pdf', 'application/pdf', 484747, 'A flexible path to modern end-user computing with Cameyo by Google Greenfield', 'Cameyo by Google is a modern alternative to VDI designed specifically to solve the legacy app gap without the overhead of traditional virtual desktops. Instead of streaming a full, resource-heavy desktop, Cameyo’s Virtual App Delivery VAD technology delivers only the applications users need, securely to any device.', 'VDI Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(102, 0, '40715-Economic Benefits.pdf', 'application/pdf', 591634, 'Analyzing the Economic Benefits of ChromeOS and Cameyo Greenfield', 'As hybrid work continues to proliferate in businesses of all types, IT departments are challenged to provide their end users with an experience that can keep them productive wherever they work. Additionally, they struggle to maintain a high level of security, scalability, and end user support without access to the user, their device, and their network. Organizations are now embracing virtual application delivery VAD and secure devices as a solution.', 'Ownership Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(103, 0, '40744-Organization.pdf', 'application/pdf', 4880152, 'How to Detect and Defend Against Shadow AI in Your Organization Checklist', 'Generative AI GenAI is both reshaping how employees work and expanding the enterprise attack surface. While tools like ChatGPT, Gemini, Microsoft Copilot and Claude offer powerful productivity gains, their unsanctioned usage known as Shadow AI can quietly introduce serious data security and compliance risks.', 'Organization Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(104, 0, '62973-Lock Down.pdf', 'application/pdf', 11235768, 'Lock Down Your Cloud: Best Practices for Securing Mission Critical Applications', 'Cloud environments allow organizations to quickly ramp up resources, roll out new services, and slash infrastructure costs compared to old-school, on premises setups. By prioritizing cloud adoption for mission-critical workloads, businesses can swiftly adapt, innovate, and thrive in today\'s dynamic landscape.', 'Mission Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(105, 0, '69519-CISO’s Guide.pdf', 'application/pdf', 8565013, 'The CISO\'s Guide to Future-Proof Data Security with AI powered DSPM', 'The exponential growth and dispersion of data across multiple platforms have increased complexity, cost and risks for many organizations. Security leaders now face significant challenges in deeply understanding and controlling their critical data. Compounding this complexity is the rapid adoption of AI which further scatters data, leaving organizations more vulnerable to data and compliance risks.', 'CISO Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(106, 0, '47184-5 Factors.pdf', 'application/pdf', 14907127, 'Top 5 Requirements for Your Next Data Security Posture Management DSPM Solution', 'In today’s landscape, the widespread adoption of multicloud infrastructures has led to a new era of security challenges. It expanded the attack surface, resulting in greater complexity, obscured visibility, and security vulnerabilities. Simultaneously, organizations are migrating vast volumes of data to the cloud. This shift has compounded these challenges, scattering sensitive and business-critical data across various cloud platforms, leading to the emergence of shadow data unmanaged data residing outside a security team’s control.', '5 Factors Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(107, 0, '16944-Zscaler ThreatLabz.pdf', 'application/pdf', 26587510, 'Zscaler ThreatLabz 2026 AI Security Report', 'Enterprises now rely on artificial intelligence and machine learning AI/ML across the business to move faster, automate decisions, and increase productivity. AI supports development, communications, research, and operations at a pace that would have seemed unrealistic just a few years ago. But this acceleration has also come with more and more tradeoffs: more sensitive data flows through more AI/ML applications, often with less visibility and fewer guardrails.', 'ThreatLabz Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(108, 0, '32441-Artificial intelligence.pdf', 'application/pdf', 45271039, 'AI Powered Customer Engagement', 'Artificial intelligence is increasingly playing a central role in customer engagement, building excitement for marketers and driving success for early adopters. But it\'s not too late for brands that haven\'t yet embraced AI to see its value: According to Deloitte, 73ps of businesses expect AI to be critical to their success going forward, highlighting the widespread value of this technology', 'AI-Powered Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(109, 0, '65884-Accelerating AI.pdf', 'application/pdf', 2800901, 'Accelerating AI, automation, and innovation in modern enterprises 25', 'With growing IT complexity, increasingly prevalent skills shortages, and mounting pressures to modernize legacy infrastructure and introduce AI applications, organizations are seeking solutions that can alleviate these challenges. Automation and generative artificial intelligence (AI) are leading the way as critical enablers for improving processes and supporting innovation initiatives, all while helping to combat problems such as time spent on repetitive, manual tasks; the learning curve and skills gaps across growing technology stacks; and even ensuring ongoing operational efficiency.', 'Accelerating Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(115, 0, '53759-An IT.pdf', 'application/pdf', 348566, 'An IT executive guide to automation 28', 'While many organizations have started automating, they often do so in a disparate, task focused manner. A holistic, strategic approach is needed to support enterprise wide automation that frees your organization to take advantage of the opportunities presented by emerging technologies like artificial intelligence AI.', 'executive Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(118, 0, '58697-ThreatLabz.pdf', 'application/pdf', 26586946, 'Zscaler ThreatLabz 2026 AI Security Report', 'That expanding AI footprint has widened the enterprise attack surface, and threat actors were quick to follow over the past year. Lower barriers and higher realism have made attacks faster and more convincing, while early signs of agentic and semi-autonomous AI misuse pointed to a shift in how threats are evolving. At the same time, organizations are contending with a growing mix of risks from shadow and embedded AI to hallucinations and unsecured private models.', 'ThreatLabz Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(119, 0, '59133-Maximize.pdf', 'application/pdf', 1427991, 'Maximize productivity and safeguard data with Chrome Enterprise', 'Today\'s workplace moves fast and teams need powerful tools that don’t compromise security. Chrome Enterprise gives your organization built in AI features designed to increase productivity while keeping your company data safe.', 'Transform Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(120, 0, '34102-benefits.pdf', 'application/pdf', 251901, 'The Fidelity Advantage: Benefits of Building Your Career at a Fidelity Branch', 'A lot of people want to do things face to face, said Janine, Financial Consultant. We want to make it as easy as possible for clients to do business with us. This face to face component deepens relationships and elevates the level of customer service with a personal touch. “The branches are designed for one on one relationships and to provide clients with white glove service, said Samir.', 'fida56c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(121, 0, '39183-Engineering.pdf', 'application/pdf', 14437838, 'big book of data engineering', 'Data engineering is the practice of taking raw data from a data source and processing it so it’s stored and organized for a downstream use case, such as data analytics, BI or machine learning ML model training. In other words, it’s the process of preparing data so that value can be extracted from it.', 'Engineering Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(122, 0, '52046-potential.pdf', 'application/pdf', 682711, 'tap full potential llm', 'Large language models are AI systems that are designed to process and analyze vast amounts of natural language data and then use that information to generate responses to user prompts. These systems are trained on massive datasets using advanced machine learning algorithms to learn the patterns and structures of human language, and are capable of generating natural language responses to a wide range of written inputs. Large language models are becoming increasingly important in a variety of applications such as natural language processing, machine translation, code and text generation, and more.', 'image.original.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(123, 0, '92641-Warehousing.pdf', 'application/pdf', 3288757, 'big book data warehousing and bi', 'The Databricks Lakebridge solution accelerates this journey. It automates schema conversion, data movement and workload replatforming. Whether you’re migrating dashboards, retiring legacy ETL jobs or modernizing AI ML pipelines, Lakebridge enables a fast, predictable data warehouse migration. Successful teams focus on phased delivery targeting high-impact workloads first, validating performance early and establishing strong financial operations FinOps visibility throughout.', 'Warehousing Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(124, 0, '15959-ROI.pdf', 'application/pdf', 598883, 'boost genai roi ai agents', 'Databricks Mosaic AI empowers organizations to build and deploy high-quality AI agent systems. Built on lakehouse architecture, Mosaic AI allows secure customization with enterprise data, ensuring accurate, domain-specific outputs. It offers a secure way to connect to open source or commercial models, providing the flexibility to choose the best fit solutions.', 'ROI Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(125, 0, '28033-Redefining.pdf', 'application/pdf', 4564593, 'redefining modern semantic layer', 'The cracks in today’s data foundations are visible everywhere. Revenue numbers shift depending on the tool used to calculate them. Meetings open with reconciliation instead of decision. AI assistants answer instantly but with definitions that do not match finance reports.', 'Redefining Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(126, 0, '65570-machine.pdf', 'application/pdf', 11448251, 'the big book of machine learning use cases', 'Organizations across many industries are using machine learning to power new customer experiences, optimize business processes and improve employee productivity. From detecting financial fraud to improving the play by play decision making for professional sports teams, this book brings together a multitude of practical use cases to get you started on your machine learning journey. The collection also serves as a guide including code samples and notebooks so you can roll up your sleeves and dive into machine learning on the Databricks Lakehouse.', 'machine Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(127, 0, '29871-MLOps.pdf', 'application/pdf', 12615179, 'the big book of mlops', 'Machine learning operations MLOps is a rapidly evolving field where building and maintaining robust, flexible and efficient workflows is critical. At Databricks, we view MLOps as the set of processes and automation for managing data, code and models to improve performance stability and long term efficiency in ML systems.', 'MLOps Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(128, 0, '53829-lakehousedummies.pdf', 'application/pdf', 3846760, 'the data lakehouse for dummies', 'Every company today aims to be a data and artificial intelligence AI driven organization. This was once a contentious idea, but now it’s widely accepted. This approach is no longer just about data AI is essential to success. But finding this type of success at scale is difficult for most organizations that need high quality data that is both secure and consumable across the organization.', 'Lakehouse Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(129, 0, '14950-Modernizing.pdf', 'application/pdf', 457395, 'upgrade your data architecture', 'To stay competitive and thrive in a constantly changing environment, organizations are collecting and analyzing larger amounts of diverse data. As part of this process, they often realize that their current data management environment is not sufficient for their needs. In a recent TDWI survey, for instance, the top technical challenge cited by respondents preventing them from moving forward with analytics was their data infrastructure.1 Many survey respondents realize that their data warehouse will not support the move to more advanced analytics such as machine learning that may utilize high volumes of unstructured or semistructured data.', 'Modernize Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(130, 0, '99495-Blackbaud-Moments that Matter UK ASSET.pdf', 'application/pdf', 3858248, 'Moments That Matter: CSR Campaign Planning Checklist', 'This resource will equip you with the tools you need to align your community impact programmes with significant moments throughout the year and ensure that every moment counts toward purpose.', 'Movements.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(131, 0, '85692-document avalara tax changes 2026.pdf', 'application/pdf', 6953987, 'Avalara Tax Changes 2026', 'Trade policies remain in flux; as you’ll see in the global tax chapter, there’s no saying what will happen with tariffs in 2026. And though the full force of the One Big Beautiful Bill Act (OBBBA) won’t be felt for quite some time, OBBBA is already influencing 2026 state tax policies. States must assess how federal tariff, tax, and spending policies will impact their bottom line in 2026 and beyond and what to do about it.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(132, 0, '67054-document buyers guide to tax compliance automation.pdf', 'application/pdf', 488595, 'Buyers guide to tax compliance automation', 'Tax compliance automation, supported by AI-enabled capabilities, can help businesses manage growing compliance demands more effectively by improving efficiency, reducing risk, and increasing visibility across tax obligations', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(133, 0, '55788-know your nexus ebook.pdf', 'application/pdf', 911282, 'Know Your Nexus', 'Getting tax compliance right is important. The first step is understanding where your business has nexus, or where you need to collect and remit sales and use tax. Nexus is ever-changing and it can be confusing for even savvy professionals.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(134, 0, '43348-mergers and acquisitions sales.pdf', 'application/pdf', 541439, 'Mergers and Acquisitions: A sales tax compliance overview to help reduce your risk', 'In recent years, businesses have learned to expect only two constants: volatility and uncertainty. And this feeling isn’t industry specific. Players from every corner of the business world are riding the waves of change brought on by inflation, talent shortages, geopolitical risks, and more. In an effort to remain agile and competitive despite adversity, businesses are turning to mergers and acquisitions M&A. This reaction isn’t so surprising, as mergers and acquisitions remain a leading growth driver and help companies become more efficient and more profitable, and help them provide additional products and resources to their customers.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(135, 0, '4708-document state of financeaieinvoicingagents.pdf', 'application/pdf', 4985650, 'Reinventing finance and tax: Leaders see AI and e-invoiving as agents of change', 'Finance and tax teams are embracing a new era: one where artificial intelligence and automation are not just tools for improving efficiency but serious powerhouses in ensuring compliance across an increasingly complex regulatory landscape.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(136, 0, '81630-document buyers guide to tax compliance automation.pdf', 'application/pdf', 488595, 'Buyers guide to tax compliance automation', 'As operations grow, companies must manage higher transaction volumes across broader geographic and organizational footprints while maintaining accuracy and consistency.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(137, 0, '10306-document navigating mna tax compliance product guide.pdf', 'application/pdf', 8559326, 'Navigating M&A tax compliance', 'Target companies can turn to Avalara for help assessing and documenting their sales tax compliance posture. With proper authorization, Avalara AI agents can scan historical filings to flag missed registrations, unfiled returns, or gaps in remittance. This information gives target companies an opportunity to address issues before due diligence or provide clearer documentation during review', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(138, 0, '37635-atc-2026-manufacturing-guide.pdf', 'application/pdf', 7861467, 'Avalara 2026 manufacturing tax changes guide', 'Tariffs didn’t dominate every tax discussion in 2025, though sometimes it felt like they did. There was also the One Big Beautiful Bill Act of 2025, which established federal tax and spending policies that will reverberate for years. And states enacted a plethora of tax changes that reduced income or property taxes, expanded sales tax bases, and carved out new sales tax exemptions.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(139, 0, '11976-critical-saas-data-risks-small-teams.pdf', 'application/pdf', 3290507, '4 Critical SaaS Risks Every Small Team Faces', 'Every team knows the feeling: the wrong file deleted, a folder synced incorrectly, a shared document overwritten, or a permission changed without anyone noticing. These everyday mistakes seem minor, but in SaaS environments like Microsoft 365, they can have immediate and far reaching impact.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(140, 0, '43311-saas-backup-data-resilience-essentials.pdf', 'application/pdf', 3130149, '5 Essentials for Effortless SaaS Data Resilience', 'Accidental deletions, permission mistakes, sync issues, and misconfigurations happen every day. Meanwhile, Entra ID is now blocking more than 500 million attacks each day, because a single compromised login is capable of reshaping mailboxes, files, Teams content, and app permissions in one sweep. And because Microsoft’s Shared Responsibility Model places data protection in your hands, any loss or corruption becomes your problem to fix.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(141, 0, '96617-en-whitepaper-your-modernization-journey-achieving-hybrid-resilience.pdf', 'application/pdf', 3411913, 'Your Modernization Journey Achieving Hybrid Resilience', 'Die Landschaft der Unternehmensvirtualisierung steht vor einem entscheidenden Moment. Die jüngsten Marktveränderungen haben den Wandel eines Status Quo beschleunigt, der viele Jahre lang sicher, zuverlässig und vertraut war. Umfangreiche Übernahmen und Lizenzierungsüberarbeitungen haben die Kosten in die Höhe getrieben und Bedenken hinsichtlich der Anbieterbindung und der langfristigen Zukunftsfähigkeit geweckt. IT-Führungskräfte überdenken jetzt ihre langjährigen Annahmen darüber, wo und wie ihre virtuellen Maschinen (VMs) ausgeführt werden sollten, als Teil einer breiteren Strategie zur Einführung moderner Anwendungsplattformen.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(142, 0, '91714-en-whitepaper-your-modernization-journey-achieving-hybrid-resilience (1).pdf', 'application/pdf', 3411913, 'Your Modernization Journey Achieving Hybrid Resilience', 'Die Landschaft der Unternehmensvirtualisierung steht vor einem entscheidenden Moment. Die jüngsten Marktveränderungen haben den Wandel eines Status Quo beschleunigt, der viele Jahre lang sicher, zuverlässig und vertraut war. Umfangreiche Übernahmen und Lizenzierungsüberarbeitungen haben die Kosten in die Höhe getrieben und Bedenken hinsichtlich der Anbieterbindung und der langfristigen Zukunftsfähigkeit geweckt. IT-Führungskräfte überdenken jetzt ihre langjährigen Annahmen darüber, wo und wie ihre virtuellen Maschinen (VMs) ausgeführt werden sollten, als Teil einer breiteren Strategie zur Einführung moderner Anwendungsplattformen.', 'DE.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(143, 0, '95796-AI Survey Report ASSET.pdf', 'application/pdf', 142034, 'AI Sentiments Survey', 'AI is here to stay and it’s influencing how HR leaders work. At Transcarent, we wanted to understand the trends, impact, and what’s next for HR and benefits so we surveyed 1,340 HR decision makers at self funded employers about their top challenges and priorities. The findings were clear: even with existing resources, HR leaders are overwhelmed by time consuming benefits administration tasks and answering benefits questions from employees.', 'Ayan.jpeg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(144, 0, '89287-Cancer Survey ASSET.pdf', 'application/pdf', 14825159, 'Cancer Survey', 'Employers, as well as their employees, face mounting challenges when it comes to managing the physical, emotional, and financial toll of cancer in the workplace. Costs are rising, information is constantly changing, quality providers can be hard to find, and the healthcare system leaves employees and their loved ones confused and frustrated. With such a complex disease, employers may struggle to identify ways in which they can positively impact their employees’ experience and outcomes. So how do we move forward to provide holistic support to employees while also managing costs to both them and the business?', 'Captureq.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(145, 0, '82504-Working With Cancer Conversation Guide ASSET.pdf', 'application/pdf', 336481, 'Working with Cancer Conversation Guide', 'Approval to take the pledge typically comes from the CEO, often based on recommendations given from senior leaders like a Chief Human Resources Officer or Chief Communications Officer. You can reach out directly to these individuals if you feel comfortable; or consider collaborating with a senior-level employee impacted by cancer.', 'Image.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(146, 0, '72575-Implementation Checklist ASSET.pdf', 'application/pdf', 260240, 'Implementation Checklist', 'The right partner makes rolling out a new health solution seamless building trust, driving engagement, and setting the stage for lasting impact. Use this checklist to launch with confidence.', 'a.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(147, 0, '25478-benefits-engagement-is-a-team-sport-action-guide.pdf', 'application/pdf', 238750, 'Benefits Engagement is a Team Sport Action Guide', 'Engaging employees early and often demands a team approach! A close alignment with your vendor partners and collaboration across the organization is key to success. Effectively engaging employees with their benefits falls on HR, however, it is ultimately a marketing function. Thinking like a marketer and borrowing best practices from your marketing colleagues is a great first step to driving action!', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(148, 0, '56742-7-steps-to-avoid-kubernetes-ransomware-disasters.pdf', 'application/pdf', 2712605, '7 Steps to Avoid Kubernetes Ransomware Disasters', 'Native de Google1 et adoptée par de nombreux acteurs de l\'industrie, Kubernetes s\'est imposée comme LA plateforme de conteneurs pour microservices. Maintenant dans sa dixième année d’adoption publique, Kubernetes suscite toujours le scepticisme quant à sa sécurité, ce qui a conduit les organisations à remettre en question sa préparation à une adoption généralisée. Les préoccupations en matière de sécurité sont exacerbées par les rapports sur les ransomwares.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(149, 0, '74151-Asset The-Data-Intelligence-Platform-For-Dummies-2nd-Databricks-Special-Edition.pdf', 'application/pdf', 2164271, 'maximize-your-organizations-potential-data-and-ai 2', 'The Databricks Data Intelligence Platform unlocks entirely new data and AI use cases, powering data-intelligent applications with open data formats, unified governance, and composable agents that know your business. It’s built on a data lakehouse, which provides a unified platform for data and AI stacks, helps your organization democratize data, build AI applications, better align with shared metrics, break down data silos, and establish operating models to move from pilots into the core of the business. Fully capitalize on your own data assets, leveraging traditional and generative AI (GenAI), data warehousing, business intelligence, online transaction processing, and governance.', 'a.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(150, 0, '21135-hands-on-guide-apps-databricks.pdf', 'application/pdf', 3140948, 'hands-guide-apps-databricks', 'Data teams today have powerful tools for exploration and analysis. Notebooks support rapid iteration, dashboards enable broad visibility and models drive prediction and automation. But when business requirements shift to an interactive application that combines live data with user input — such as an AI assistant embedded in a workflow or a custom tool tailored to a specific operational process — teams often hit a wall.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(151, 0, '64035-2026-01-eb-compact-guide-to-data-analytics-ss-200175.pdf', 'application/pdf', 2265160, 'your-compact-guide-modern-analytics', 'Analytics is changing fast. Business intelligence (BI) tools and warehouses that once powered reporting now struggle with scale, real-time expectations and the rise of AI. Organizations need a new foundation: one that simplifies data architecture, unifies governance and infuses AI into the analytics workflows. This foundation must also empower every user to ask and answer questions about their data.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(152, 0, '85078-comprehensive-guide-to-data-and-ai-governance.pdf', 'application/pdf', 4650282, 'data-analytics-and-ai-governance', 'Data governance is a framework of principles, practices and tooling that helps manage the complete lifecycle of your data and aligns data-related requirements to the business strategy. A pragmatic data governance strategy gives data teams superior data management, visibility and auditing of data access patterns across their organization. Implementing an effective data governance solution helps companies protect their data from unauthorized access and ensures that rules are in place to comply with regulatory requirements. Many organizations have leveraged their strong stance on data governance as a competitive differentiator to earn and maintain customer trust, ensure sound data and privacy practices and protect their data assets.', 'a.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(153, 0, '96522-4069-Asset 2026-01-eb-compact-guide-to-ai-agents-ss-200607_Interactive.pdf', 'application/pdf', 678299, 'boost-genai-roi-ai-agents', 'Scaling GenAI apps into production using AI agent systems Generative AI holds enormous promise, but for many organizations, transitioning from pilot projects to fully deployed applications remains a significant challenge. According to a recent Economist report, “Unlocking Enterprise AI,” 85% of global enterprises are already using GenAI, a number expected to reach 99% by 2027. However, many organizations face challenges in scaling these projects effectively. The report also states that only 22% of enterprises are confident their infrastructure is ready for AI, and just 37% believe their GenAI models are truly production-ready. These gaps highlight the need for a robust infrastructure and advanced tools to ensure GenAI applications meet the high standards required for success.', 'a.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(154, 0, '73514-where-is-your-warehouse-on-the-maturity-curve-ebook-aptean.pdf', 'application/pdf', 3064411, 'Warehouse Maturity eBook', 'Labour and equipment remain two of the most costly and constrained resources in a warehouse operation. Persistent skills shortages and rising employment costs have increased pressure on warehouse managers to drive greater productivity improvements and extract more value from their existing resources, rather than relying on additional headcount or capital investment. We consistently hear of warehouse managers being tasked to ‘achieve more, with fewer or the same level of resources’ – it’s a difficult balance to achieve without the right support.', 'asd.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(155, 0, '43387-Aptean WMS - Annaghmore Case Study - DIGITAL.pdf', 'application/pdf', 3733048, 'Annaghmore Case Study', 'Established in 1977, Annaghmore is Ireland’s leading furniture importer and wholesaler. An Irish owned family business, the company distributes its products throughout the UK and Ireland. Based near Portadown, Co Armagh, Ireland, Annaghmore strives to consistently deliver market leading products that are innovative, creative and, above all, competitively priced.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(156, 0, '60204-Contrast-A DevSecOps Buyer’s Guide for Application Security ASSET.pdf', 'application/pdf', 2917366, 'A DevSecOps Buyer’s Guide for Application Security', 'Today, application security (AppSec) faces unprecedented challenges. As software architectures become more complex—spanning enterprise and web applications, application programming interfaces (APIs), microservices, and cloud environments—the attack surface dramatically expands. Cyber threats such as zero-day exploits and supply chain attacks are becoming more sophisticated, rendering traditional security approaches insufficient.', 'A DevSecOps Buyer’s Guide for Application Security.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(157, 0, '47057-Constrast-Backbase case study ASSET.pdf', 'application/pdf', 209280, 'Backbase case study', 'Because ADR instruments applications at runtime, it could be introduced without requiring application code changes, a critical factor for a platform with hundreds of customer-specific deployments. Unlike traditional AppSec tools that analyze code statically, ADR instruments applications at runtime, revealing which code paths and libraries actually execute in production, which vulnerabilities are reachable and exploitable, how attackers are probing applications and provides real-time blocking of exploitation attempts.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(159, 0, '3407-CS_Solutionbrief_Get Mythos ready.pdf', 'application/pdf', 3569668, 'Get Mythos ready: Secure your apps against AI', 'Anthropic\'s Claude Mythos Preview is an AI that autonomously finds and exploits software vulnerabilities. It found zero days hiding for decades, including a 17-year-old remote code execution flaw in FreeBSD. It built working Linux kernel privilege-escalation exploits for under $2,000 each. Every AI lab is building a version of this. The threat is not theoretical. Unauthorized actors accessed Mythos on the day it was announced. Automated exploit development has removed the skill barrier that once slowed attackers down. Your existing tools were not designed for a world where that barrier no longer exists. Here is what to do about it.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(160, 0, '59680-AI scanning.pdf', 'application/pdf', 1315178, 'Mythos, AI Scanning, and the Security Program You Actually Need', 'Jeff Williams is the co-founder of Contrast Security and the creator of the OWASP Top 10. Dave Lindner is the CISO at Contrast Security. Below, they answer the questions security leaders are asking about AI-assisted exploitation, the real cost of AI scanning, and what to do about both.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(161, 0, '21127-Contrast Revolutionizing.pdf', 'application/pdf', 414438, 'Revolutionizing DAST with IAST: A new era in application security', 'Dynamic Application Security Testing (DAST) has been used to test the security of software for many years. DAST tools operate by simulating attacks on an application from the outside, much like how a hacker might try to find weaknesses.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(162, 0, '11060-CS Guide Collapse AppSec backlog.pdf', 'application/pdf', 2635357, 'Three steps to collapse your AppSec vulnerability backlog with runtime context', 'Every enterprise AppSec team runs a vulnerability backlog and for most teams, it has passed the point of human triage. In a Ponemon study,1 66% of security leaders reported open vulnerability counts exceeding 100,000, and Edgescan’s 2025 report4 found that 45.4% of discovered vulnerabilities remain unpatched a full year later. The cause is arithmetic, not effort: Industry benchmarks show a typical application accumulates around 17 new vulnerabilities per month6 while AppSec teams close about 6 of them. Detection has outpaced remediation for two decades and the gap compounds every sprint.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(163, 0, '39470-AI-generated code attacks.pdf', 'application/pdf', 1696406, 'Three steps to detecting and blocking AI-generated attacks', 'Threat actors now leverage AI to identify and weaponize vulnerabilities at a significant pace. This process involves using AI to analyze library code and identify vulnerabilities within specific components. For custom applications, these actors deploy AI to crawl apps and APIs while generating probes to find and exploit unique security flaws. This shift enables the rapid transformation of code analysis into active exploits in both third-party and proprietary software environments.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(164, 0, '43820-konsultan-pajak-arunika-tax.pdf', 'application/pdf', 57875, 'Strategi Mengembangkan Bisnis di Tengah Perubahan Ekonomi dan Regulasi', 'Perkembangan dunia bisnis yang semakin dinamis menuntut para pelaku usaha untuk mampu beradaptasi dengan berbagai perubahan yang terjadi. Perubahan kondisi ekonomi, perkembangan teknologi, serta regulasi yang terus diperbarui menjadi faktor yang memengaruhi cara perusahaan menjalankan operasionalnya. Oleh karena itu, setiap pemilik usaha perlu memiliki strategi yang tepat agar dapat mempertahankan daya saing sekaligus menciptakan peluang pertumbuhan yang berkelanjutan.\r\n\r\nSalah satu faktor utama yang menentukan keberhasilan sebuah bisnis adalah kemampuan dalam mengelola sumber daya secara efektif. Sumber daya tersebut tidak hanya mencakup modal dan tenaga kerja, tetapi juga informasi, teknologi, serta sistem administrasi yang mendukung kegiatan operasional. Perusahaan yang mampu mengelola seluruh aspek tersebut dengan baik umumnya memiliki peluang lebih besar untuk bertahan dalam menghadapi berbagai tantangan pasar.\r\n\r\nDi era digital seperti saat ini, penggunaan teknologi menjadi kebut', 'layanan-spt-pribadi.jpg', '1234567', 'Yes', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(165, 0, '35105-w_nits09.pdf', 'application/pdf', 1154058, 'Nucleus™ Your AI Engine', 'Your expertise is too valuable to be spent on manual prep. Nucleus connects the dots across your client’s entire profile so you’re ready for every meeting.', 'w_nits09c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(166, 0, '66702-w_nits08.pdf', 'application/pdf', 40852770, 'The 1040 as a Planning Asset', 'A client\'s 1040 isn\'t just a record of the past. It\'s a diagnostic tool. These five steps help you identify planning gaps, surface held-away assets, and start conversations that build trust without crossing into tax advice.', 'w_nits08c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(167, 0, '62711-w_nits10.pdf', 'application/pdf', 59976966, 'The Advisor \'s Client Meeting Playbook', 'You spend hours preparing for client meetings. Reviewing portfolios. Analyzing risk. Building plans. But here’s the question worth asking: Do your clients leave the room understanding the full value of your advice? The stakes are higher than you might think. In Nitrogen’s Firm Growth Survey, 68% of clients said they would consider leaving their current advisor for one who provides more personalized communication and technology-driven insights. Not because of poor performance but because of poor clarity', 'w_nits10c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(168, 0, '55899-Palo Alto Networks NGFW Assessment Summary CONFIDENTIAL SR241211C (2) (1).pdf', 'application/pdf', 437112, 'miercom-cloud-ngfw-competitive-assessment', 'In fourth quarter 2024 Miercom conducted an independent industry wide study on Cloud NGFW products. Palo Alto Networks submitted their Cloud Next Generation Firewall for evaluation.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(169, 0, '3268-the total economic impact of palo alto networks.pdf', 'application/pdf', 1231795, 'The Total Economic Impact of Palo Alto Networks Software Firewalls', 'As the name suggests, Palo Alto Networks Software Firewalls are firewalls in software form rather than physical. These firewalls can be deployed for cloud platforms like AWS or Azure and virtual machines or containers, and they are governed by Panorama, Palo Alto Networks’ centralized firewall management platform that provides unified rulemaking and visibility.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(170, 0, '33403-2026 The CFO perspective Whitepaper.pdf', 'application/pdf', 5419734, 'The CFO Perspective: Why Maternity Benefits Are a Smart Business Move', 'Women’s health benefits, spanning fertility, family building, and maternity, are no longer “nice-tohave.” They’ve become pivotal for employers aiming to attract and retain talent. In fact, 69% of benefits leaders say women’s healthcare solutions are an essential part of their benefits ecosystem.', 'w_prpa239c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(171, 0, '78509-2026 Strategic questions for 2027 benefits planning Guide.pdf', 'application/pdf', 427268, '10 Value-Driving Questions for 2027 Benefits Planning', 'Healthcare costs are expected to continue to rise throughout 2026, intensifying pressure on organizations to contain spend while improving outcomes and simplifying vendor management. All stakeholders—including employers, consultants, and strategic partners—play a critical role in navigating these challenges. This guide provides 10 essential questions for planning sessions, along with guidance on what strong answers should include—helping organizations identify solutions that deliver measurable ROI and meaningful employee impact.', 'w_prpa240c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(172, 0, '23837-Nucleus Prompting Guide - 2026.pdf', 'application/pdf', 2405392, 'Nucleus Prompting Guide - 2026', 'Your expertise is too valuable to be spent on manual prep. Nucleus connects the dots across your client’s entire profile so you’re ready for every meeting.', 'a.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(173, 0, '62801-2026 Member Health Goals Report.pdf', 'application/pdf', 8021748, 'The 2027 Renewal Crisis: Predictive Insights for Your Benefits Strategy (Member Health Goals)', 'For the 4th year in a row, HealthJoy analyzed the self-reported health goals, concerns, and intentions of 100,000+ members. What that data reveals isn \'t just a snapshot of workforce health. It\' s a forward-looking map of where your claims are headed — and a window of opportunity to act before the cost arrives. The 2025 data is alarming, and early 2026 data confirms the trends aren \'t softening.', 'w_heat04c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(174, 0, '59335-2026 BRMS-Axene Savings Report.pdf', 'application/pdf', 5826992, 'The Proven Impact of Intelligent Steerage on Medical Spend (BRMS-Axene)', 'In the era of rising healthcare costs, passive plan design is no longer sufficient to control spend. HealthJoy’s Benefits Operating System transforms the fragmented benefits landscape into a unified engine for cost control, replacing confusion with clarity and ensuring that members are intelligently steered toward high-quality, cost-efficient care at the moment they need it most.', 'w_heat03c8.jpg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(175, 0, '82769-miercom-cloud-ngfw-competitive-assessment.pdf', 'application/pdf', 440121, 'miercom-cloud-ngfw-competitive-assessment', 'See how Cloud NGFW outperforms cloud native firewalls in this unsponsored independent Miercom competitive review', 'Image 1.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(176, 0, '54891-The Total Economic Impact of Palo Alto Networks Software Firewalls.pdf', 'application/pdf', 1231795, 'The Total Economic Impact of Palo Alto Networks Software Firewalls', 'It is paramount for organizations to maintain adequate security postures in cloud and virtualized environments and to do so without wasting time and effort on troubleshooting when they could be improving security', 'image 2.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(177, 0, '18335-Orkin_Warehouse_Pest_Management_Guide_2025_Update.pdf', 'application/pdf', 22955135, 'Warehouse Pest Control Management Guide', 'Preparedness is at the heart of Integrated Pest Management (IPM). The goal is to help prevent pest problems before they happen, prioritizing warehouse maintenance and sanitation first, rather than relying solely on specialized treatments. With IPM, you become an active partner in your facility’s pest control program to help prevent and identify pest problems.', 'image_orkin_202606.jpeg', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(178, 0, '77616-BDES-7791_SimpleWay-to-Efficient-IT.pdf', 'application/pdf', 2723529, 'The simple way to efficient IT', 'Like many technology leaders, you’re probably pursuing multiple initiatives to make your agency run more efficiently and to deliver higher-quality services', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(179, 0, '55969-Cloudflare_TT_Responsible AI Adoption_TJ_FINAL 2.pdf', 'application/pdf', 1372623, 'How to prepare your agency for responsible AI adoption', 'The federal government is under pressure to move faster, cut costs and prove impact. As the White House prioritizes military readiness, border security and boosting efficiency, agencies must still deliver secure digital services, resilient infrastructure and tangible results.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(180, 0, '99630-Government Lab Customer Case Study - 071125_FINAL.pdf', 'application/pdf', 92544, 'A government research laboratory uses Cloudflare?s security solutions to detect and block 40% of unwanted traffic at the edge', 'After moving its website behind Cloudflare?s DNS and DDoS protection, the lab saw an immediate 20% drop in traffic — harmful requests were being blocked at the edge. But the biggest insight came with the rollout of Cloudflare?s bot management tools: another 20% of traffic disappeared.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(181, 0, '18598-Three Steps to Use runtime Truth asset.pdf', 'application/pdf', 2628502, 'Three Steps to Use runtime Truth', 'AI coding assistants have dramatically increased the amount of code teams ship, but they are not inventing new categories of vulnerability. They are amplifying the vulnerabilities that were already latent in the open-source ecosystem and in familiar coding patterns.', 'Capture.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL);
INSERT INTO `tbl_uploads` (`id`, `user_id`, `file`, `type`, `size`, `img_title`, `img_desc`, `img_path`, `CampaignId`, `google`, `ip_address`, `user_agent`, `date`, `created_at`, `updated_at`) VALUES
(182, 0, '89414-Running.pdf', 'application/pdf', 15447667, 'Running on Reliable Data: What the Best 3PLs Do Differently', 'The ceiling has raised For decades, periodic inventory verification set the standard for warehouse accuracy. Cycle counts, wall-to-wall audits, and manual sampling pushed barcoding and manual labor to their limit, and running that program well was the mark of operational excellence. That was the ceiling, and the best operators were pressed against it.', 'Running Image-3.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(183, 0, '99868-CATO_eBook_AI_Security_Buyers_Guide.pdf', 'application/pdf', 14213855, 'The right way to buy AI security: A guide for CISOs and security leaders', 'Most enterprises began their AI journey with informal experimentation: employees using public generative AI tools, small pilots built by innovation teams, and AI features embedded quietly into SaaS products. In many cases, adoption outpaced governance and security awareness.', 'Image-3.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(184, 0, '30714-forrester_tel_the_total_economic_impact_of_cato_sase_platform.pdf', 'application/pdf', 1068943, 'Forrester Consulting Total Economic Impact™ study quantifies the financial and operational impact of Cato SASE Platform', 'Cato Networks commissioned Forrester Consulting to conduct a Total Economic Impact™ (TEI) study and examine the potential return on investment (ROI) enterprises may realize by deploying Cato SASE Platform. The purpose of this study is to provide readers with a framework to evaluate the potential financial impact of Cato SASE on their organizations.', 'Capture-3.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(185, 0, '24641-CATO_eBook_Solving_Ai_Fomu.pdf', 'application/pdf', 8837357, 'Fighting the FOMU: A Board-ready blueprint for secure AI adoption', 'Fear of Messing Up (FOMU) is holding many CISOs back from realizing AI’s full potential. Boards, regulators, and customers demand secure, responsible use, and accountability sits squarely with the CISO.', 'Capture-3.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL),
(186, 0, '78917-From Yard Chaos to Dock Control Closing the Gap in Logistics Execution.pdf', 'application/pdf', 4454427, 'From Yard Chaos to Dock Control Closing the Gap in Logistics Execution', 'All the software in the world can’t make up for a dock that’s still running on outdated processes, even though it sits at one of the most vital connection points between carrier and warehouse', 'Image 2-3.JPG', 'CN60', 'No', NULL, NULL, '2026-07-17 16:44:07', '2026-07-17 16:44:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `optin` tinyint(1) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `linkedin_flag` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_attempts` tinyint(3) UNSIGNED DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `dnc`
--
ALTER TABLE `dnc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `iframe`
--
ALTER TABLE `iframe`
  ADD PRIMARY KEY (`iframe_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partnering`
--
ALTER TABLE `partnering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_id_token` (`user_id`,`token`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `token` (`token`);

--
-- Indexes for table `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribe_email_unique` (`email`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`Qid`);

--
-- Indexes for table `tbl_questions_text`
--
ALTER TABLE `tbl_questions_text`
  ADD PRIMARY KEY (`Qid`);

--
-- Indexes for table `tbl_survey`
--
ALTER TABLE `tbl_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_questions`
--
ALTER TABLE `tbl_survey_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `tbl_survey_submit`
--
ALTER TABLE `tbl_survey_submit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CampaignId` (`CampaignId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `company` (`company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=733;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dnc`
--
ALTER TABLE `dnc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iframe`
--
ALTER TABLE `iframe`
  MODIFY `iframe_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `partnering`
--
ALTER TABLE `partnering`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publish`
--
ALTER TABLE `publish`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `Qid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Question ID';

--
-- AUTO_INCREMENT for table `tbl_questions_text`
--
ALTER TABLE `tbl_questions_text`
  MODIFY `Qid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Question ID';

--
-- AUTO_INCREMENT for table `tbl_survey`
--
ALTER TABLE `tbl_survey`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_survey_questions`
--
ALTER TABLE `tbl_survey_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_survey_submit`
--
ALTER TABLE `tbl_survey_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
