-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 10:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatari_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tat_attendance_time`
--

CREATE TABLE `tat_attendance_time` (
  `time_attendance_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `attendance_date` varchar(255) NOT NULL,
  `clock_in` varchar(255) NOT NULL,
  `clock_in_ip_address` varchar(255) NOT NULL,
  `clock_out` varchar(255) NOT NULL,
  `clock_out_ip_address` varchar(255) NOT NULL,
  `clock_in_out` varchar(255) NOT NULL,
  `time_late` varchar(255) NOT NULL,
  `early_leaving` varchar(255) NOT NULL,
  `overtime` varchar(255) NOT NULL,
  `total_work` varchar(255) NOT NULL,
  `total_rest` varchar(255) NOT NULL,
  `attendance_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_attendance_time`
--

INSERT INTO `tat_attendance_time` (`time_attendance_id`, `employee_id`, `attendance_date`, `clock_in`, `clock_in_ip_address`, `clock_out`, `clock_out_ip_address`, `clock_in_out`, `time_late`, `early_leaving`, `overtime`, `total_work`, `total_rest`, `attendance_status`) VALUES
(2, 7, '2021-07-21', '2021-07-21 03:10:00', '', '2021-07-21 01:05:00', '', '0', '2021-07-21 03:10:00', '2021-07-21 01:05:00', '2021-07-21 01:05:00', '2:5', '', 'Present'),
(3, 2, '2021-07-16', '2021-07-16 14:10:00', '', '2021-07-16 20:45:00', '', '0', '2021-07-16 14:10:00', '2021-07-16 20:45:00', '2021-07-16 20:45:00', '6:35', '', 'Present'),
(4, 7, '2021-07-28', '2021-07-28 04:15:00', '', '2021-07-28 06:05:00', '', '0', '2021-07-28 04:15:00', '2021-07-28 06:05:00', '2021-07-28 06:05:00', '1:50', '', 'Present'),
(5, 2, '2021-08-13', '2021-08-13 00:29:46', '::1', '2021-08-13 00:30:30', '::1', '0', '2021-08-13 00:29:46', '2021-08-13 00:30:30', '2021-08-13 00:30:30', '0:0', '', 'Present'),
(6, 2, '2021-08-20', '2021-08-20 10:50:00', '127.0.0.1', '2021-08-20 23:16:00', '127.0.0.1', '0', '2021-08-20 10:50:00', '2021-08-20 23:16:00', '2021-08-20 23:16:00', '12:26', '', 'Present'),
(7, 2, '2021-08-21', '2021-08-21 15:32:12', '::1', '', '', '1', '2021-08-21 15:32:12', '2021-08-21 15:32:12', '2021-08-21 15:32:12', '', '', 'Present'),
(8, 8, '2021-08-25', '2021-08-25 21:11:45', '::1', '', '', '1', '2021-08-25 21:11:45', '2021-08-25 21:11:45', '2021-08-25 21:11:45', '', '', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `tat_attendance_time_request`
--

CREATE TABLE `tat_attendance_time_request` (
  `time_request_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `request_date_request` varchar(255) NOT NULL,
  `request_clock_in` varchar(200) NOT NULL,
  `request_clock_out` varchar(200) NOT NULL,
  `total_hours` varchar(255) NOT NULL,
  `request_reason` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tat_companies`
--

CREATE TABLE `tat_companies` (
  `company_id` int(111) NOT NULL,
  `type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `trading_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `government_tax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `address_1` mediumtext NOT NULL,
  `address_2` mediumtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `is_active` int(11) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_companies`
--

INSERT INTO `tat_companies` (`company_id`, `type_id`, `name`, `trading_name`, `username`, `password`, `registration_no`, `government_tax`, `email`, `logo`, `contact_number`, `website_url`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `is_active`, `added_by`, `created_at`) VALUES
(1, 4, 'EMPDE', 'Ethiopian Educational Materials Production and Distribution Enterprise ', 'EMPDE', '', 'xdfgd54', '', 'hq@empde.com', 'logo_1628809005.png', '25111234568', 'empde.com.et', 'Megenagna', 'Gurd Shola', 'Addis Ababa', 'Addis Ababa', '14322', 67, 0, 1, '22-04-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_company_info`
--

CREATE TABLE `tat_company_info` (
  `company_info_id` int(111) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo_second` varchar(255) NOT NULL,
  `sign_in_logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `website_url` mediumtext NOT NULL,
  `starting_year` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_1` mediumtext NOT NULL,
  `address_2` mediumtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_company_info`
--

INSERT INTO `tat_company_info` (`company_info_id`, `logo`, `logo_second`, `sign_in_logo`, `favicon`, `website_url`, `starting_year`, `company_name`, `company_email`, `company_contact`, `contact_person`, `email`, `phone`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `updated_at`) VALUES
(1, 'logo.png', 'logo2.png', 'signin_logo.png', 'fav1.png', '', '', 'EMPDE', '', '', 'Tatari Contact', 'info@tatari.com', '+2512323232', 'Megenagna', 'Address 2', 'Addis Ababa', 'State', '1000', 67, '2021-05-20 12:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `tat_company_type`
--

CREATE TABLE `tat_company_type` (
  `type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_company_type`
--

INSERT INTO `tat_company_type` (`type_id`, `name`, `created_at`) VALUES
(1, 'Governmental', ''),
(2, 'Private Limited Company', ''),
(3, 'Partnership', ''),
(4, 'Enterprise', ''),
(5, 'Limited Liability Company', '');

-- --------------------------------------------------------

--
-- Table structure for table `tat_countries`
--

CREATE TABLE `tat_countries` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_flag` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_countries`
--

INSERT INTO `tat_countries` (`country_id`, `country_code`, `country_name`, `country_flag`) VALUES
(67, 'ET', 'Ethiopia', '');

-- --------------------------------------------------------

--
-- Table structure for table `tat_database_backup`
--

CREATE TABLE `tat_database_backup` (
  `backup_id` int(111) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_database_backup`
--

INSERT INTO `tat_database_backup` (`backup_id`, `backup_file`, `created_at`) VALUES
(3, 'backup_21-08-2021_23_12_02.sql.gz', '21-08-2021 23:12:04'),
(4, 'backup_21-08-2021_23_17_21.sql.gz', '21-08-2021 23:17:21'),
(5, 'backup_25-08-2021_21_57_01.sql.gz', '25-08-2021 21:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `tat_departments`
--

CREATE TABLE `tat_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_departments`
--

INSERT INTO `tat_departments` (`department_id`, `department_name`, `company_id`, `location_id`, `employee_id`, `added_by`, `created_at`, `status`) VALUES
(1, 'Human Resource', 1, 1, 7, 0, '06-05-2021', 1),
(2, 'Finances', 1, 1, 2, 1, '06-05-2021', 1),
(3, 'Manufacturing', 1, 1, 2, 1, '2021-05-23 01:27:13', 1),
(4, 'Distribution', 1, 1, 2, 1, '2021-05-23 03:53:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tat_designations`
--

CREATE TABLE `tat_designations` (
  `designation_id` int(11) NOT NULL,
  `top_designation_id` int(11) NOT NULL DEFAULT 0,
  `department_id` int(200) NOT NULL,
  `sub_department_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `designation_name` varchar(200) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_designations`
--

INSERT INTO `tat_designations` (`designation_id`, `top_designation_id`, `department_id`, `sub_department_id`, `company_id`, `designation_name`, `added_by`, `created_at`, `status`) VALUES
(9, 0, 1, 0, 1, 'HR Administrator', 1, '06-05-2021', 1),
(10, 0, 2, 10, 1, 'Head of Finance', 1, '18-05-2021', 1),
(12, 0, 2, 0, 1, 'Manager', 1, '23-05-2021', 1),
(13, 0, 3, 0, 1, 'Operator', 1, '23-05-2021', 1),
(14, 0, 2, 0, 1, 'Senior Accountant', 1, '14-07-2021', 1),
(15, 0, 1, 0, 1, 'HR Officer', 1, '14-07-2021', 1),
(16, 0, 3, 0, 1, 'Head of Technical', 1, '16-07-2021', 1),
(17, 0, 2, 0, 1, 'Cashier', 1, '22-07-2021', 1),
(18, 0, 4, 0, 1, 'Sales Person', 1, '24-08-2021', 1),
(19, 0, 4, 0, 1, 'ner', 1, '24-08-2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tat_document_type`
--

CREATE TABLE `tat_document_type` (
  `document_type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_document_type`
--

INSERT INTO `tat_document_type` (`document_type_id`, `company_id`, `document_type`, `created_at`) VALUES
(1, 1, 'Driver\'s License', '03-08-2021 10:39:05'),
(2, 1, 'Tax Payer\'s ID', '03-08-2021 12:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `tat_email_template`
--

CREATE TABLE `tat_email_template` (
  `template_id` int(111) NOT NULL,
  `template_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_email_template`
--

INSERT INTO `tat_email_template` (`template_id`, `template_code`, `name`, `subject`, `message`, `status`) VALUES
(1, 'code1', 'Forgot Password', 'Forgot Password', '&lt;p&gt;There was recently a request for password for your {var site_name}Â account.&lt;/p&gt;&lt;p&gt;If this was a mistake, just ignore this email and nothing will happen.&lt;br&gt;&lt;/p&gt;&lt;p&gt;To reset your password, visit the following link &lt;a href=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot; admin=\\\\&quot;\\\\&quot; auth=\\\\&quot;\\\\&quot; password=\\\\&quot;\\\\&quot; change=\\\\&quot;true&amp;email={var\\\\&quot; title=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot;&gt;&lt;a href=\\\\&quot;{var site_url}admin/auth/reset_password/?change=true&amp;email={var email}\\\\&quot; title=\\\\&quot;reset_password\\\\&quot;&gt;Reset Password&lt;/a&gt;&lt;/a&gt;&lt;a href=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot; admin=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot; auth=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot; title=\\\\&quot;\\\\\\\\\\\\\\\\\\\\&quot;&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;Thank you,&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(2, 'code2', 'Password Changed Successfully', 'Password Changed Successfully', '&lt;p&gt;Hello,&lt;/p&gt;&lt;p&gt;Congratulations! Your password has been updated successfully.&lt;/p&gt;&lt;p&gt;Your new password is: {var password}&lt;/p&gt;&lt;p&gt;Thank you,&lt;br&gt;Tatari System&lt;br&gt;&lt;/p&gt;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tat_employees`
--

CREATE TABLE `tat_employees` (
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `office_shift_id` int(111) DEFAULT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_of_birth` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `e_status` int(11) NOT NULL,
  `user_role_id` int(100) NOT NULL,
  `department_id` int(100) NOT NULL,
  `sub_department_id` int(11) NOT NULL,
  `designation_id` int(100) NOT NULL,
  `company_id` int(111) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `view_companies_id` varchar(255) NOT NULL,
  `salary_template` varchar(255) NOT NULL,
  `hourly_grade_id` int(111) NOT NULL,
  `monthly_grade_id` int(111) NOT NULL,
  `date_of_joining` varchar(200) NOT NULL,
  `date_of_leaving` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `salary` varchar(200) NOT NULL,
  `wages_type` int(11) NOT NULL,
  `basic_salary` varchar(200) NOT NULL DEFAULT '0',
  `daily_wages` varchar(200) NOT NULL DEFAULT '0',
  `salary_ssempee` varchar(200) NOT NULL DEFAULT '0',
  `salary_ssempeer` varchar(200) DEFAULT '0',
  `salary_income_tax` varchar(200) NOT NULL DEFAULT '0',
  `salary_overtime` varchar(200) NOT NULL DEFAULT '0',
  `salary_commission` varchar(200) NOT NULL DEFAULT '0',
  `salary_claims` varchar(200) NOT NULL DEFAULT '0',
  `salary_paid_leave` varchar(200) NOT NULL DEFAULT '0',
  `salary_director_fees` varchar(200) NOT NULL DEFAULT '0',
  `salary_bonus` varchar(200) NOT NULL DEFAULT '0',
  `salary_advance_paid` varchar(200) NOT NULL DEFAULT '0',
  `address` mediumtext NOT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `zipcode` varchar(200) NOT NULL,
  `profile_picture` mediumtext NOT NULL,
  `profile_background` mediumtext NOT NULL,
  `resume` mediumtext NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `last_login_date` varchar(255) NOT NULL,
  `last_logout_date` varchar(255) NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `is_logged_in` int(111) NOT NULL,
  `online_status` int(111) NOT NULL,
  `fixed_header` varchar(150) NOT NULL,
  `compact_sidebar` varchar(150) NOT NULL,
  `boxed_wrapper` varchar(150) NOT NULL,
  `leave_categories` varchar(255) NOT NULL DEFAULT '0',
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employees`
--

INSERT INTO `tat_employees` (`user_id`, `employee_id`, `office_shift_id`, `first_name`, `last_name`, `username`, `email`, `password`, `date_of_birth`, `gender`, `e_status`, `user_role_id`, `department_id`, `sub_department_id`, `designation_id`, `company_id`, `location_id`, `view_companies_id`, `salary_template`, `hourly_grade_id`, `monthly_grade_id`, `date_of_joining`, `date_of_leaving`, `marital_status`, `salary`, `wages_type`, `basic_salary`, `daily_wages`, `salary_ssempee`, `salary_ssempeer`, `salary_income_tax`, `salary_overtime`, `salary_commission`, `salary_claims`, `salary_paid_leave`, `salary_director_fees`, `salary_bonus`, `salary_advance_paid`, `address`, `state`, `city`, `zipcode`, `profile_picture`, `profile_background`, `resume`, `contact_no`, `is_active`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_logged_in`, `online_status`, `fixed_header`, `compact_sidebar`, `boxed_wrapper`, `leave_categories`, `created_at`) VALUES
(1, 'tatari', 2, 'System', 'Administrator', 'tatari', 'administrator@tatari.com', '$2y$12$mI2HopUi9y0K3UvzXxlfYO1ZywUhi/mGsU3NdO6eqj4/Bci.6Pqfy', '1995-03-28', 'Male', 0, 1, 2, 0, 10, 1, 1, '0', 'monthly', 0, 0, '2021-05-01', '', 'Single', '', 1, '1000', '0', '8', '17', '10', '0', '1', '2', '3', '0', '0', '0', 'Addis Ababa', '', '', '', 'profile_1628712687.png', 'profile_background_1519924152.jpg', '', '12345678900', 1, '25-08-2021 22:50:39', '25-08-2021 22:50:41', '::1', 0, 1, 'fixed_layout_tatari', '', '', '0,1,2', '2021-05-10 08:32:44'),
(2, 'abebe', 2, 'Abebe', 'Balacha', 'abebe', 'arefat2005@gmail.com', '$2y$12$SFa6icZPwZr5CjS0C8.GP.jQHtDB/uBWkQ7QUdbwnpk4/hswVx49G', '1998-03-28', 'Male', 0, 4, 1, 0, 9, 1, 1, '', 'monthly', 0, 0, '2021-05-02', '', 'Single', '', 1, '10000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'Piassa Taytu Hotel around Dz', '', '', '', 'profile_1627464651.png', '', '', '1232', 1, '25-08-2021 21:10:17', '25-08-2021 21:10:23', '::1', 0, 1, '', '', '', '0,1,2', '2021-05-14 07:17:04'),
(7, '1231244', 2, 'Semira', 'Umer', 'semira', 'semira@gmail.com', '$2y$12$PWlvsn46Xm3RuKjxYhD11uBzFh8E.0qBEhBCVJyxnTgIutTDhuoKO', '1995-05-02', 'Female', 0, 3, 3, 0, 16, 1, 1, '', 'monthly', 0, 0, '2021-05-03', '', 'Single', '', 1, '12300', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'piassa', '', '', '', 'profile_1627464663.png', '', '', '251534535', 0, '21-08-2021 16:29:40', '', '::1', 1, 0, '', '', '', '0,1,2', '2021-05-23 04:32:01'),
(8, 'dereje', 2, 'Dereje', 'Yalew', 'dereje', 'dereje@yahoo.com', '$2y$12$tvj8Y8o/3YL.Uxcs3e9qr.ylxnhL6QkQWkaBrGyqOutyaOo0.4lUu', '1973-08-08', 'Male', 0, 2, 1, 0, 15, 1, 1, '', '', 0, 0, '2006-08-09', '', 'Single', '', 1, '7000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'Addis Ababa', '', '', '', '', '', '', '092123445', 1, '25-08-2021 21:11:11', '', '::1', 1, 0, '', '', '', '0', '2021-08-23 09:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_bankaccount`
--

CREATE TABLE `tat_employee_bankaccount` (
  `bankaccount_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `is_primary` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_code` varchar(255) NOT NULL,
  `bank_branch` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_bankaccount`
--

INSERT INTO `tat_employee_bankaccount` (`bankaccount_id`, `employee_id`, `is_primary`, `account_title`, `account_number`, `bank_name`, `bank_code`, `bank_branch`, `created_at`) VALUES
(1, 2, 0, 'ADSAD', '32342342342', 'CBE', '324', 'SARID', '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_complaints`
--

CREATE TABLE `tat_employee_complaints` (
  `complaint_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `complaint_from` int(111) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `complaint_date` varchar(255) NOT NULL,
  `complaint_against` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_complaints`
--

INSERT INTO `tat_employee_complaints` (`complaint_id`, `company_id`, `complaint_from`, `title`, `complaint_date`, `complaint_against`, `description`, `attachment`, `status`, `created_at`) VALUES
(1, 1, 2, 'Noise', '2021-05-18', '2', 'Noise around machines', '', 0, '23-05-2021'),
(6, 1, 7, 'dfg', '2021-08-25', '7', 'dfg', NULL, 0, '11-08-2021'),
(7, 1, 7, 'dfg', '2021-08-10', '2', 'dfg', NULL, 0, '11-08-2021'),
(8, 1, 7, 'dfs', '2021-08-25', '2', 'sdf', 'complaints_1628713002.png', 1, '11-08-2021'),
(9, 1, 7, 'fdg', '2021-08-17', '2', '', NULL, 0, '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_contacts`
--

CREATE TABLE `tat_employee_contacts` (
  `contact_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `is_primary` int(111) NOT NULL,
  `is_dependent` int(111) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `address_1` mediumtext NOT NULL,
  `address_2` mediumtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_contacts`
--

INSERT INTO `tat_employee_contacts` (`contact_id`, `employee_id`, `relation`, `is_primary`, `is_dependent`, `contact_name`, `work_phone`, `mobile_phone`, `home_phone`, `work_email`, `personal_email`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `created_at`) VALUES
(2, 2, 'Parent', 0, 0, 'Balcha Negusse', '2515235235', '2515234345', '', 'balch@neg.com', '', 'Addis Ababa', '', 'Addis Ababa', 'AA', '2342', '67', '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_documents`
--

CREATE TABLE `tat_employee_documents` (
  `document_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `document_type_id` int(111) NOT NULL,
  `date_of_expiry` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notification_email` varchar(255) NOT NULL,
  `is_alert` tinyint(1) NOT NULL,
  `description` mediumtext NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_documents`
--

INSERT INTO `tat_employee_documents` (`document_id`, `employee_id`, `document_type_id`, `date_of_expiry`, `title`, `notification_email`, `is_alert`, `description`, `document_file`, `created_at`) VALUES
(3, 2, 1, '2021-08-10', 'fh', 'hg@sa', 2, 'sad', 'document_1628711958.docx', '11-08-2021'),
(7, 7, 2, '2021-08-16', 'sdad', '', 0, 'asd', 'document_1628711740.docx', '11-08-2021'),
(8, 1, 1, '2021-08-31', 'dfs', '', 0, 'sdf', 'document_1628713995.png', '11-08-2021'),
(9, 7, 1, '2035-08-23', 'sda', '', 0, 'asdf', 'document_1629911196.pdf', '25-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_location`
--

CREATE TABLE `tat_employee_location` (
  `office_location_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_promotions`
--

CREATE TABLE `tat_employee_promotions` (
  `promotion_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `designation_id` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `promotion_date` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_promotions`
--

INSERT INTO `tat_employee_promotions` (`promotion_id`, `company_id`, `employee_id`, `designation_id`, `title`, `promotion_date`, `description`, `added_by`, `created_at`) VALUES
(1, 1, 2, 9, 'HR Manager', '2021-05-28', 'New Management Decision Approved', 1, '23-05-2021'),
(2, 1, 7, 0, 'Head of Technical Dept', '2021-07-17', 'Expansion', 1, '16-07-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_qualification`
--

CREATE TABLE `tat_employee_qualification` (
  `qualification_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `education_level_id` int(111) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `language_id` int(111) NOT NULL,
  `to_year` varchar(255) NOT NULL,
  `skill_id` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_qualification`
--

INSERT INTO `tat_employee_qualification` (`qualification_id`, `employee_id`, `name`, `education_level_id`, `from_year`, `language_id`, `to_year`, `skill_id`, `description`, `created_at`) VALUES
(2, 2, 'Addis Ababa University', 2, '2021-08-18', 1, '2021-08-23', '1', 'With Honors', '11-08-2021'),
(3, 7, 'sdf', 2, '2021-08-17', 1, '2021-08-16', '2', 'sdf', '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_resignations`
--

CREATE TABLE `tat_employee_resignations` (
  `resignation_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `resignation_date` varchar(255) NOT NULL,
  `reason` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_terminations`
--

CREATE TABLE `tat_employee_terminations` (
  `termination_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `terminated_by` int(111) NOT NULL,
  `termination_type_id` int(111) NOT NULL,
  `termination_date` varchar(255) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_terminations`
--

INSERT INTO `tat_employee_terminations` (`termination_id`, `company_id`, `employee_id`, `terminated_by`, `termination_type_id`, `termination_date`, `notice_date`, `description`, `status`, `attachment`, `created_at`) VALUES
(1, 1, 7, 1, 1, '2021-05-27', '2021-05-17', 'on her own recognizance', 1, '', '23-05-2021'),
(3, 1, 2, 1, 1, '2021-08-24', '2021-08-03', 'asd', 0, 'termination_1628713444.png', '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_transfer`
--

CREATE TABLE `tat_employee_transfer` (
  `transfer_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `transfer_date` varchar(255) NOT NULL,
  `transfer_department` int(111) NOT NULL,
  `transfer_location` int(111) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_transfer`
--

INSERT INTO `tat_employee_transfer` (`transfer_id`, `company_id`, `employee_id`, `transfer_date`, `transfer_department`, `transfer_location`, `description`, `status`, `added_by`, `created_at`) VALUES
(1, 1, 2, '2021-05-06', 2, 1, 'health', 1, 1, '23-05-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_warnings`
--

CREATE TABLE `tat_employee_warnings` (
  `warning_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `warning_to` int(111) NOT NULL,
  `warning_by` int(111) NOT NULL,
  `warning_date` varchar(255) NOT NULL,
  `warning_type_id` int(111) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_warnings`
--

INSERT INTO `tat_employee_warnings` (`warning_id`, `company_id`, `warning_to`, `warning_by`, `warning_date`, `warning_type_id`, `attachment`, `subject`, `description`, `status`, `created_at`) VALUES
(1, 1, 2, 2, '2021-05-11', 1, '', 'Lateness', 'Warning about Punctuality', 0, '23-05-2021'),
(3, 1, 7, 2, '2021-07-07', 1, '', 'sdfsf', '', 0, '30-07-2021'),
(4, 1, 2, 7, '2021-08-09', 1, 'warning_1628712427.jpg', 'xcvcv', 'xcv', 0, '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_employee_work_experience`
--

CREATE TABLE `tat_employee_work_experience` (
  `work_experience_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_employee_work_experience`
--

INSERT INTO `tat_employee_work_experience` (`work_experience_id`, `employee_id`, `company_name`, `from_date`, `to_date`, `post`, `description`, `created_at`) VALUES
(2, 2, 'dfsfsd', '2021-08-12', '2021-08-15', 'sdfsdf', 'sdfs', '11-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_expenses`
--

CREATE TABLE `tat_expenses` (
  `expense_id` int(11) NOT NULL,
  `employee_id` int(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `expense_type_id` int(200) NOT NULL,
  `billcopy_file` mediumtext NOT NULL,
  `amount` varchar(200) NOT NULL,
  `purchase_date` varchar(200) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `status_remarks` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_expense_type`
--

CREATE TABLE `tat_expense_type` (
  `expense_type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_expense_type`
--

INSERT INTO `tat_expense_type` (`expense_type_id`, `company_id`, `name`, `status`, `created_at`) VALUES
(1, 1, 'Utilities', 1, '15-08-2020 09:36:53'),
(2, 1, 'Raw Materials Purchase', 1, '05-08-2020 09:36:53'),
(3, 1, 'Payroll', 1, '05-08-2020 09:36:53'),
(4, 1, 'Operational Cost', 1, '05-08-2020 10:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_bankcash`
--

CREATE TABLE `tat_finance_bankcash` (
  `bankcash_id` int(111) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_balance` varchar(255) NOT NULL,
  `account_opening_balance` varchar(200) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `bank_branch` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_finance_bankcash`
--

INSERT INTO `tat_finance_bankcash` (`bankcash_id`, `account_name`, `account_balance`, `account_opening_balance`, `account_number`, `branch_code`, `bank_branch`, `created_at`) VALUES
(1, 'EMPDE Government Total Budget', '32042656', '32000000', '100032343322', 'CBE', 'Megenagna', '19-08-2021 02:00:43'),
(2, 'EMPDE Government Approved Budget', '10038372.65', '12400684.65', '100032345456', 'CBE', 'Piassa', '19-08-2021 02:01:25'),
(3, 'EMPDE Operational ', '2042000', '2100000', '10003223223', 'DAS', 'Bole Main', '19-08-2021 02:02:10'),
(4, 'EMPDE Printing Budget', '1999000', '2000000', '100023423423', 'CBE', 'Gurd shola', '25-08-2021 09:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_deposit`
--

CREATE TABLE `tat_finance_deposit` (
  `deposit_id` int(111) NOT NULL,
  `account_type_id` int(111) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `deposit_date` varchar(255) NOT NULL,
  `category_id` int(111) NOT NULL,
  `payer_id` int(111) NOT NULL,
  `payment_method` int(111) NOT NULL,
  `deposit_reference` varchar(255) NOT NULL,
  `deposit_file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_expense`
--

CREATE TABLE `tat_finance_expense` (
  `expense_id` int(111) NOT NULL,
  `account_type_id` int(111) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `expense_date` varchar(255) NOT NULL,
  `category_id` int(111) NOT NULL,
  `payee_id` int(111) NOT NULL,
  `payment_method` int(111) NOT NULL,
  `expense_reference` varchar(255) NOT NULL,
  `expense_file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_payees`
--

CREATE TABLE `tat_finance_payees` (
  `payee_id` int(11) NOT NULL,
  `payee_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_finance_payees`
--

INSERT INTO `tat_finance_payees` (`payee_id`, `payee_name`, `contact_number`, `created_at`) VALUES
(1, 'ETM Import & Export', '0932324343', '19-08-2021 02:09:03'),
(2, 'Mesfin Industrial Engineering', '251222413434', '19-08-2021 02:09:30'),
(3, 'Nikad Wood Works', '25192342234', '19-08-2021 02:10:08'),
(4, 'Asab Shipping PLC', '+23213413414', '21-08-2021 07:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_payers`
--

CREATE TABLE `tat_finance_payers` (
  `payer_id` int(11) NOT NULL,
  `payer_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_finance_payers`
--

INSERT INTO `tat_finance_payers` (`payer_id`, `payer_name`, `contact_number`, `created_at`) VALUES
(1, 'Bahir Dar University', '251232234234', '19-08-2021 02:10:33'),
(2, 'Selale University', '+25134232323', '19-08-2021 02:11:12'),
(3, 'Addis Ababa Institute of Technology', '+251923223233', '19-08-2021 02:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_transaction`
--

CREATE TABLE `tat_finance_transaction` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `transaction_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `dr_cr` enum('dr','cr') NOT NULL,
  `transaction_cat_id` int(11) NOT NULL,
  `payer_payee_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `invoice_type` varchar(100) DEFAULT NULL,
  `attachment_file` varchar(100) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tat_finance_transaction`
--

INSERT INTO `tat_finance_transaction` (`transaction_id`, `account_id`, `company_id`, `transaction_date`, `description`, `amount`, `transaction_type`, `dr_cr`, `transaction_cat_id`, `payer_payee_id`, `payment_method_id`, `reference`, `invoice_id`, `client_id`, `invoice_type`, `attachment_file`, `created_at`) VALUES
(1, 3, 0, '2021-08-10', 'New Purchase', 32000, 'income', 'dr', 2, 2, 2, '1232214', 0, 0, NULL, 'no_file', '2021-08-19 15:19:45'),
(2, 2, 1, '2021-08-16', 'Daily Maintenance Cost', 12000, 'expense', 'cr', 4, 7, 2, '12a12121bbc', 0, 0, NULL, 'no_file', '2021-08-19 15:26:20'),
(3, 1, 0, '2021-08-17', 'Management Decision for Approval', 15000, 'transfer', 'cr', 0, 0, 1, 'CBE1288912VV', 0, 0, NULL, '', '2021-08-19 15:27:17'),
(4, 2, 0, '2021-08-17', 'Management Decision for Approval', 15000, 'transfer', 'dr', 0, 0, 1, 'CBE1288912VV', 0, 0, NULL, '', '2021-08-19 15:27:17'),
(5, 3, 1, '2021-08-16', 'Payroll for this Month', 20000, 'expense', 'cr', 3, 7, 3, '234234dsfdf', 0, 0, NULL, 'no_file', '2021-08-19 15:54:01'),
(6, 3, 0, '2021-08-10', '', 15000, 'transfer', 'cr', 0, 0, 2, 'asdas`1213', 0, 0, NULL, '', '2021-08-19 15:55:02'),
(7, 1, 0, '2021-08-10', '', 15000, 'transfer', 'dr', 0, 0, 2, 'asdas`1213', 0, 0, NULL, '', '2021-08-19 15:55:03'),
(8, 3, 0, '2021-08-10', 'asd', 55000, 'transfer', 'cr', 0, 0, 2, 'asd', 0, 0, NULL, '', '2021-08-19 15:57:58'),
(9, 1, 0, '2021-08-10', 'asd', 55000, 'transfer', 'dr', 0, 0, 2, 'asd', 0, 0, NULL, '', '2021-08-19 15:57:58'),
(10, 1, 0, '2021-08-21', 'Invoice Payments', 30446.2, 'income', 'cr', 0, 0, 3, 'Invoice Payments', 3, 0, NULL, NULL, '2021-08-21 03:17:50'),
(11, 2, 1, '2021-08-25', 'sdfsdfs', 12000, 'expense', 'cr', 2, 7, 1, '123123sdfsdfs', 0, 0, NULL, 'no_file', '2021-08-24 03:41:56'),
(12, 1, 0, '2021-08-02', 'ewewer', 12344, 'transfer', 'cr', 0, 0, 2, 'rwerqw45345', 0, 0, NULL, '', '2021-08-24 04:21:59'),
(13, 2, 0, '2021-08-02', 'ewewer', 12344, 'transfer', 'dr', 0, 0, 2, 'rwerqw45345', 0, 0, NULL, '', '2021-08-24 04:21:59'),
(14, 4, 1, '2021-08-23', 'sdfsd', 1000, 'expense', 'cr', 4, 8, 1, 'hgasdg234', 0, 0, NULL, 'no_file', '2021-08-25 21:36:38'),
(15, 2, 1, '2021-08-02', '', 2365660, 'expense', 'cr', 2, 7, 2, 'hjjh', 0, 0, NULL, 'no_file', '2021-08-25 21:42:35'),
(16, 1, 0, '2021-08-25', 'Invoice Payments', 10395, 'income', 'cr', 0, 0, 3, 'Invoice Payments', 4, 0, NULL, NULL, '2021-08-25 21:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_transactions`
--

CREATE TABLE `tat_finance_transactions` (
  `transaction_id` int(111) NOT NULL,
  `account_type_id` int(111) NOT NULL,
  `deposit_id` int(111) NOT NULL,
  `expense_id` int(111) NOT NULL,
  `transfer_id` int(111) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `transaction_debit` varchar(255) NOT NULL,
  `transaction_credit` varchar(255) NOT NULL,
  `transaction_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_finance_transfer`
--

CREATE TABLE `tat_finance_transfer` (
  `transfer_id` int(111) NOT NULL,
  `from_account_id` int(111) NOT NULL,
  `to_account_id` int(111) NOT NULL,
  `transfer_date` varchar(255) NOT NULL,
  `transfer_amount` varchar(255) NOT NULL,
  `payment_method` varchar(111) NOT NULL,
  `transfer_reference` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_income_categories`
--

CREATE TABLE `tat_income_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_income_categories`
--

INSERT INTO `tat_income_categories` (`category_id`, `name`, `status`, `created_at`) VALUES
(1, 'Ordinary Deposit', 1, '15-08-2020 09:37:17'),
(2, 'Direct Deposit', 1, '10-08-2020 07:07:17'),
(3, 'Transfer', 1, '10-08-2020 08:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `tat_jobs`
--

CREATE TABLE `tat_jobs` (
  `job_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `job_url` varchar(255) NOT NULL,
  `job_type` int(225) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `type_url` varchar(255) NOT NULL,
  `job_vacancy` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `minimum_experience` varchar(255) NOT NULL,
  `date_of_closing` varchar(200) NOT NULL,
  `short_description` mediumtext NOT NULL,
  `long_description` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_jobs`
--

INSERT INTO `tat_jobs` (`job_id`, `dept_id`, `company_id`, `job_title`, `designation_id`, `job_url`, `job_type`, `is_featured`, `type_url`, `job_vacancy`, `gender`, `minimum_experience`, `date_of_closing`, `short_description`, `long_description`, `status`, `created_at`) VALUES
(1, 1, 0, 'IT Specialist', 0, 'uT09y1Nbk3zYfWnPjVaxFOvMQAqHec8ZgRm5DlpK', 2, 1, '', 5, '2', '4', '2021-08-25', 'sdfsdfsdfsdf', '&lt;p&gt;&lt;strong&gt;asdfsdfsadf&lt;/strong&gt;&lt;/p&gt;', 1, '2021-08-10 11:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `tat_job_applications`
--

CREATE TABLE `tat_job_applications` (
  `application_id` int(111) NOT NULL,
  `job_id` int(111) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `job_resume` mediumtext NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 0,
  `application_remarks` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_job_applications`
--

INSERT INTO `tat_job_applications` (`application_id`, `job_id`, `full_name`, `email`, `message`, `job_resume`, `application_status`, `application_remarks`, `created_at`) VALUES
(1, 1, 'Aster Mengestu', 'aster.sa@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'resume_1628585578.pdf', 3, '', '2021-08-10 11:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `tat_job_type`
--

CREATE TABLE `tat_job_type` (
  `job_type_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type_url` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_job_type`
--

INSERT INTO `tat_job_type` (`job_type_id`, `company_id`, `type`, `type_url`, `created_at`) VALUES
(1, 1, 'Full Time', 'full-time', '07-08-2021 08:19:48'),
(2, 1, 'Part Time', 'part-time', '07-08-2021 08:14:48'),
(3, 1, 'Contractual', 'contracts', '07-08-2021 08:13:48'),
(5, 1, 'Internship', 'internship', '07-08-2021 08:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `tat_languages`
--

CREATE TABLE `tat_languages` (
  `language_id` int(111) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(255) NOT NULL,
  `language_flag` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_languages`
--

INSERT INTO `tat_languages` (`language_id`, `language_name`, `language_code`, `language_flag`, `is_active`, `created_at`) VALUES
(1, 'English', 'english', 'en.png', 1, '2021-08-21 08:32:33'),
(2, 'Amharic', 'amharic', 'am.png', 1, '2021-08-21 08:32:33'),
(3, 'Afaan Oromo', 'oromiffa', 'or.png', 1, '2021-08-21 08:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tat_leave_applications`
--

CREATE TABLE `tat_leave_applications` (
  `leave_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(222) NOT NULL,
  `department_id` int(11) NOT NULL,
  `leave_type_id` int(222) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `applied_on` varchar(200) NOT NULL,
  `reason` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_half_day` tinyint(1) DEFAULT NULL,
  `is_notify` int(11) NOT NULL,
  `leave_attachment` varchar(255) DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_leave_applications`
--

INSERT INTO `tat_leave_applications` (`leave_id`, `company_id`, `employee_id`, `department_id`, `leave_type_id`, `from_date`, `to_date`, `applied_on`, `reason`, `remarks`, `status`, `is_half_day`, `is_notify`, `leave_attachment`, `created_at`) VALUES
(1, 1, 2, 0, 2, '2021-07-29', '2021-07-30', '2021-07-29 05:02:17', 'Medical Reasons - COVID-19 Positive', '&lt;p&gt;&lt;strong&gt;COVID-19 Symptoms&lt;/strong&gt;&lt;/p&gt;', 2, 0, 0, '', '2021-07-29 05:02:17'),
(2, 1, 2, 0, 1, '2021-08-19', '2021-08-21', '2021-08-20 11:17:38', 'rest', 'leave', 2, 0, 0, '', '2021-08-20 11:17:38'),
(3, 1, 7, 0, 1, '2021-08-24', '2021-08-25', '2021-08-20 11:28:00', 'leave', 'leave', 2, 0, 0, '', '2021-08-20 11:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tat_leave_type`
--

CREATE TABLE `tat_leave_type` (
  `leave_type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  `days_per_year` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_leave_type`
--

INSERT INTO `tat_leave_type` (`leave_type_id`, `company_id`, `type_name`, `days_per_year`, `status`, `created_at`) VALUES
(1, 1, 'Annual Leave', '15', 1, '19-07-2021 07:26:20'),
(2, 1, 'Sick Leave', '2', 1, '19-07-2021 07:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `tat_office_location`
--

CREATE TABLE `tat_office_location` (
  `location_id` int(11) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_head` int(111) NOT NULL,
  `location_manager` int(111) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `address_1` mediumtext NOT NULL,
  `address_2` mediumtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_office_location`
--

INSERT INTO `tat_office_location` (`location_id`, `company_id`, `location_head`, `location_manager`, `location_name`, `email`, `phone`, `fax`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `added_by`, `created_at`, `status`) VALUES
(1, 1, 2, 0, 'Addis Ababa Head Quarters', 'mainoffice@tatari.com', '2515345343', '2515345345', 'Gurd Shola', 'Megenagna', 'Addis Ababa', 'A.A.', '34232', 67, 1, '18-05-2021', 1),
(2, 1, 2, 0, 'Bahir Dar', 'empde-bd@empde.com.et', '25121212121', '', 'Bahir Dar', 'new town', 'Bahir Dar', 'Amhara', '', 67, 1, '23-05-2021', 1),
(0, 1, 7, 0, 'Hawassa Branch', '', '', '', '', '', 'Hawassa', '', '', 67, 1, '14-07-2021', 1),
(0, 1, 7, 0, 'Mekelle', 'meq@empde.et', '342423423', '234234234', 'Mekelle', '', 'Mekelle', '', '2332', 67, 1, '22-07-2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tat_office_shift`
--

CREATE TABLE `tat_office_shift` (
  `office_shift_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `default_shift` int(111) NOT NULL,
  `monday_in_time` varchar(222) NOT NULL,
  `monday_out_time` varchar(222) NOT NULL,
  `tuesday_in_time` varchar(222) NOT NULL,
  `tuesday_out_time` varchar(222) NOT NULL,
  `wednesday_in_time` varchar(222) NOT NULL,
  `wednesday_out_time` varchar(222) NOT NULL,
  `thursday_in_time` varchar(222) NOT NULL,
  `thursday_out_time` varchar(222) NOT NULL,
  `friday_in_time` varchar(222) NOT NULL,
  `friday_out_time` varchar(222) NOT NULL,
  `saturday_in_time` varchar(222) NOT NULL,
  `saturday_out_time` varchar(222) NOT NULL,
  `sunday_in_time` varchar(222) NOT NULL,
  `sunday_out_time` varchar(222) NOT NULL,
  `created_at` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_office_shift`
--

INSERT INTO `tat_office_shift` (`office_shift_id`, `company_id`, `shift_name`, `default_shift`, `monday_in_time`, `monday_out_time`, `tuesday_in_time`, `tuesday_out_time`, `wednesday_in_time`, `wednesday_out_time`, `thursday_in_time`, `thursday_out_time`, `friday_in_time`, `friday_out_time`, `saturday_in_time`, `saturday_out_time`, `sunday_in_time`, `sunday_out_time`, `created_at`) VALUES
(2, 1, 'Basic Schedule', 1, '02:00', '11:00', '02:00', '11:00', '02:00', '11:00', '02:00', '11:00', '02:00', '11:00', '02:00', '11:00', '', '', '2021-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `tat_overtime_request`
--

CREATE TABLE `tat_overtime_request` (
  `time_request_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `request_date_request` varchar(255) NOT NULL,
  `request_clock_in` varchar(200) NOT NULL,
  `request_clock_out` varchar(200) NOT NULL,
  `total_hours` varchar(255) NOT NULL,
  `request_reason` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tat_overtime_request`
--

INSERT INTO `tat_overtime_request` (`time_request_id`, `company_id`, `employee_id`, `request_date`, `request_date_request`, `request_clock_in`, `request_clock_out`, `total_hours`, `request_reason`, `is_approved`, `created_at`) VALUES
(1, 1, 2, '2021-08-03', '2021-08', '2021-08-03 02:10:00', '2021-08-03 10:25:00', '8:15', 'Unscheduled Entry', 2, ''),
(2, 1, 2, '2021-08-10', '2021-08', '2021-08-10 03:15:00', '2021-08-10 06:35:00', '3:20', 'extra shift', 1, ''),
(3, 1, 7, '2021-04-14', '2021-08', '2021-04-14 10:15:00', '2021-04-14 10:20:00', '0:5', 'dfs', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `tat_payment_method`
--

CREATE TABLE `tat_payment_method` (
  `payment_method_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `method_name` varchar(255) NOT NULL,
  `payment_percentage` varchar(200) DEFAULT NULL,
  `account_number` varchar(200) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_payment_method`
--

INSERT INTO `tat_payment_method` (`payment_method_id`, `company_id`, `method_name`, `payment_percentage`, `account_number`, `created_at`) VALUES
(1, 1, 'Cash', '20', NULL, '10-08-2020 07:07:17'),
(2, 1, 'Bank Transfer', '0', '121212', '10-08-2020 09:07:17'),
(3, 1, 'Cheque', '10', NULL, '10-08-2020 10:07:17'),
(4, 1, 'CPO', NULL, NULL, '10-08-2020 12:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `tat_qualification_education_level`
--

CREATE TABLE `tat_qualification_education_level` (
  `education_level_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_qualification_education_level`
--

INSERT INTO `tat_qualification_education_level` (`education_level_id`, `company_id`, `name`, `created_at`) VALUES
(1, 1, 'High School Diploma', '09-05-2021 07:11:59'),
(2, 1, 'University Degree', '19-07-2021 12:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `tat_qualification_language`
--

CREATE TABLE `tat_qualification_language` (
  `language_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_qualification_language`
--

INSERT INTO `tat_qualification_language` (`language_id`, `company_id`, `name`, `created_at`) VALUES
(1, 1, 'English', '09-08-2021 03:12:03'),
(2, 1, 'Amharic', '09-08-2021 05:12:03'),
(3, 1, 'Afaan Oromo', '09-08-2021 09:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `tat_qualification_skill`
--

CREATE TABLE `tat_qualification_skill` (
  `skill_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_qualification_skill`
--

INSERT INTO `tat_qualification_skill` (`skill_id`, `company_id`, `name`, `created_at`) VALUES
(1, 1, 'Leadership Cerified', '09-08-2021 03:19:08'),
(2, 1, 'Language Cerified', '09-08-2021 06:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_allowances`
--

CREATE TABLE `tat_salary_allowances` (
  `allowance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `is_allowance_taxable` int(11) NOT NULL,
  `allowance_title` varchar(200) DEFAULT NULL,
  `allowance_amount` varchar(200) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_salary_allowances`
--

INSERT INTO `tat_salary_allowances` (`allowance_id`, `employee_id`, `is_allowance_taxable`, `allowance_title`, `allowance_amount`, `created_at`) VALUES
(0, 2, 1, 'sdf', '1233', NULL),
(0, 8, 0, 'card', '500', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_commissions`
--

CREATE TABLE `tat_salary_commissions` (
  `salary_commissions_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `commission_title` varchar(200) DEFAULT NULL,
  `commission_amount` varchar(200) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_salary_commissions`
--

INSERT INTO `tat_salary_commissions` (`salary_commissions_id`, `employee_id`, `commission_title`, `commission_amount`, `created_at`) VALUES
(1, 2, 'dfsdf', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_loan_deductions`
--

CREATE TABLE `tat_salary_loan_deductions` (
  `loan_deduction_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `loan_options` int(11) NOT NULL,
  `loan_deduction_title` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `monthly_installment` varchar(200) NOT NULL,
  `loan_time` varchar(200) NOT NULL,
  `loan_deduction_amount` varchar(200) NOT NULL,
  `total_paid` varchar(200) NOT NULL,
  `reason` text NOT NULL,
  `status` int(11) NOT NULL,
  `is_deducted_from_salary` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_models`
--

CREATE TABLE `tat_salary_models` (
  `salary_model_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `salary_grades` varchar(255) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `overtime_rate` varchar(255) NOT NULL,
  `medical_allowance` varchar(255) NOT NULL,
  `tax_deduction` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_allowance` varchar(255) NOT NULL,
  `total_deduction` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_other_payments`
--

CREATE TABLE `tat_salary_other_payments` (
  `other_payments_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `payments_title` varchar(200) DEFAULT NULL,
  `payments_amount` varchar(200) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_salary_other_payments`
--

INSERT INTO `tat_salary_other_payments` (`other_payments_id`, `employee_id`, `payments_title`, `payments_amount`, `created_at`) VALUES
(1, 2, 'sdf', '324', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_overtime`
--

CREATE TABLE `tat_salary_overtime` (
  `salary_overtime_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `overtime_type` varchar(200) NOT NULL,
  `no_of_days` varchar(100) NOT NULL DEFAULT '0',
  `overtime_hours` varchar(100) NOT NULL DEFAULT '0',
  `overtime_rate` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_salary_overtime`
--

INSERT INTO `tat_salary_overtime` (`salary_overtime_id`, `employee_id`, `overtime_type`, `no_of_days`, `overtime_hours`, `overtime_rate`) VALUES
(1, 2, 'shift change', '4', '8', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslips`
--

CREATE TABLE `tat_salary_payslips` (
  `payslip_id` int(11) NOT NULL,
  `payslip_key` varchar(200) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `wages_type` int(11) NOT NULL,
  `payslip_type` varchar(50) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `daily_wages` varchar(200) NOT NULL,
  `is_half_monthly_payroll` tinyint(1) NOT NULL,
  `hours_worked` varchar(50) NOT NULL DEFAULT '0',
  `total_allowances` varchar(200) NOT NULL,
  `total_commissions` varchar(200) NOT NULL,
  `total_statutory_deductions` varchar(200) NOT NULL,
  `total_other_payments` varchar(200) NOT NULL,
  `total_loan` varchar(200) NOT NULL,
  `total_overtime` varchar(200) NOT NULL,
  `statutory_deductions` varchar(200) NOT NULL,
  `net_salary` varchar(200) NOT NULL,
  `grand_net_salary` varchar(200) NOT NULL,
  `other_payment` varchar(200) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `pay_comments` mediumtext NOT NULL,
  `is_payment` int(11) NOT NULL,
  `year_to_date` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_salary_payslips`
--

INSERT INTO `tat_salary_payslips` (`payslip_id`, `payslip_key`, `employee_id`, `department_id`, `company_id`, `location_id`, `designation_id`, `salary_month`, `wages_type`, `payslip_type`, `basic_salary`, `daily_wages`, `is_half_monthly_payroll`, `hours_worked`, `total_allowances`, `total_commissions`, `total_statutory_deductions`, `total_other_payments`, `total_loan`, `total_overtime`, `statutory_deductions`, `net_salary`, `grand_net_salary`, `other_payment`, `payment_method`, `pay_comments`, `is_payment`, `year_to_date`, `status`, `created_at`) VALUES
(0, 'tVW9mA5zbL6s4QXxOYBrTKwIDgNpMSoRJUuZPfih', 2, 1, 1, 0, 9, '2021-05', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:07:41'),
(0, 'RdLpIyM6iVrEonKkYwlXPSQD3g8q7sjv91aUzu5f', 7, 3, 1, 0, 16, '2021-05', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:07:41'),
(0, 'BEitDlpoAb8knzxXvJhRaS4eW5ZNUCqI0cusjLH2', 2, 1, 1, 0, 9, '2021-01', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:32'),
(0, 'YeW4XqfIGkThvPirQNszpKBb5F60JmjCax398twl', 7, 3, 1, 0, 16, '2021-01', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:32'),
(0, 'YTx6Xke4FOEiyvHAG7L9zphngmfSWDbucM0KrtB8', 2, 1, 1, 0, 9, '2021-02', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 2, '24-08-2021 04:09:36'),
(0, 'MPLBgUeT4nkJu29SZxEo5Hld76bqN18QmcvGsh0R', 7, 3, 1, 0, 16, '2021-02', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:36'),
(0, 'AXeFd1OEm94YuzWjnJyf8xra2lKPkLhqbwCIv76S', 2, 1, 1, 0, 9, '2021-03', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:39'),
(0, '8JGWYHqh7rna5ow6pPcdX1uLzxAVKSF32ZtM9fQm', 7, 3, 1, 0, 16, '2021-03', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:39'),
(0, 'QMWc9AIErm2GD8HJPja4g3Llw7zYepXk0utbx6NB', 2, 1, 1, 0, 9, '2021-04', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:42'),
(0, '7XMybUq8KW5oN31kHIGEjzatv2hQ0YwAlBTsJpc9', 7, 3, 1, 0, 16, '2021-04', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:42'),
(0, 'kqjEJivd05HyPGzWrfXu42pNTaM39hnLSZFmlUQc', 2, 1, 1, 0, 9, '2021-05', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:47'),
(0, 'Xw9yj7lLxp3turEPNVsZ20dBHzJ1CFiDhgAnUfe8', 7, 3, 1, 0, 16, '2021-05', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:47'),
(0, 'Z1PvD6LzIw7tRrNH5quBkfUEm3eFhAc4aTgW0OKQ', 2, 1, 1, 0, 9, '2021-06', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:53'),
(0, 'Y5NO98tPGHKoWx2FLkEDVdefRAi1SzwZpbvmC0nj', 7, 3, 1, 0, 16, '2021-06', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:09:53'),
(0, 'h4TFlPBGo6q9yaw7jDZpJKvRfmOxXkdNrsVL28I0', 2, 1, 1, 0, 9, '2021-09', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:10'),
(0, 'ZyTViBmbKuHCaAr9z6j0xJMcYe3qwFD42dsg7pW8', 7, 3, 1, 0, 16, '2021-09', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:10'),
(0, 'Vd90iqs5AntBDumUESyGTgWQlrfYH3w1ZJjMFk4R', 2, 1, 1, 0, 9, '2021-09', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:15'),
(0, '4VuS5k9iysm8RxJaPqMBCdoHcbQ3vLrAU1Xh20Z7', 7, 3, 1, 0, 16, '2021-09', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:15'),
(0, 'wL8hWocFsVb7DXKGB1d2qI3Pjil6eMCSYAyUxugk', 2, 1, 1, 1, 9, '2021-10', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:24'),
(0, 'kXtYISRMbvg7U2efCLZB5hG1Jac8w3KExdD9TpNy', 7, 3, 1, 1, 16, '2021-10', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 04:10:26'),
(0, 'X7sdnmZUEQ0blvFhSKyTiAYDPH15CzuRjqVwNe2x', 2, 1, 1, 0, 9, '2021-08', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '1200', '324', '0', '16', '', '10496.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:21:27'),
(0, 'E9rLMUXpA01PCtaxjd5OFYnVJDkquiybo3IRKwe2', 7, 3, 1, 0, 16, '2021-08', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:21:27'),
(0, 'XRFUgGlc83YZSJ12vLMVy7nu0BN6xoQWzOitT59e', 8, 4, 1, 0, 18, '2021-08', 1, 'full_monthly', '7000', '', 0, '0', '0', '0', '210', '0', '0', '0', '', '6790.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:21:27'),
(0, 'TkIh94l2vWD6ACHpdguLOjKbRnSr1J3ePNzx8XUs', 2, 1, 1, 0, 9, '2021-09', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '0', '324', '0', '16', '', '11696.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:03'),
(0, 'uHrpqY4i7nbGk35Mo0NXUDBVcFOTIyL6xPAaRtvK', 7, 3, 1, 0, 16, '2021-09', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:03'),
(0, 'jzrUtgeOD2CWIKNxaHdJLnos5qw37PYyMBk6QZAh', 8, 4, 1, 0, 18, '2021-09', 1, 'full_monthly', '7000', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '7000.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:03'),
(0, 'IlqJaXYTcCUvjOez0x26PVQgpwA3Bu4dymoGsWnZ', 2, 1, 1, 0, 9, '2021-11', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '0', '324', '0', '16', '', '11696.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:08'),
(0, 'DYMazA50Ze2vWrflO4iNqJPsyHLB86IEdmQkVuXK', 7, 3, 1, 0, 16, '2021-11', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:08'),
(0, 'YhBbg67p2sNJ3wf8ArOavmqDu4HE5VSxUPFLZdRy', 8, 4, 1, 0, 18, '2021-11', 1, 'full_monthly', '7000', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '7000.00', '', '', 0, '', 1, '24-08-2021', 0, '24-08-2021 09:26:09'),
(0, '96LEQ1rS5GIO7d0xi3PFuYXzoglhNWBKb8ZkCpfs', 8, 1, 1, 1, 15, '2021-04', 1, 'full_monthly', '7000', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '7000.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:19:19'),
(0, 'D2kru6TdHQsl5wYSamRpJofOhZGKLP3eWqIXyciN', 8, 1, 1, 1, 15, '2020-04', 1, 'full_monthly', '7000', '', 0, '0', '500', '0', '0', '0', '0', '0', '', '7500.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:20:06'),
(0, 'NhYV4rFykCB1EJZ7M58PLzvpbHRWAltU9fwd3ST0', 2, 1, 1, 0, 9, '2021-02', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '0', '324', '0', '16', '', '11696.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:22'),
(0, 'eYiTr2aSIsW7u9bhZDXkvE1nKFM8R4QjBAzCNyo3', 7, 3, 1, 0, 16, '2021-02', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:22'),
(0, '05EHoPzclLWTnXQSYIN3OZUesaK79rpdVRtfGvBm', 8, 1, 1, 0, 15, '2021-02', 1, 'full_monthly', '7000', '', 0, '0', '500', '0', '0', '0', '0', '0', '', '7500.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:22'),
(0, 'sc5m7YATBai2GwgHz6IE8M91VSqoNKu4Dy3CbXQP', 2, 1, 1, 0, 9, '2021-02', 1, 'full_monthly', '10000', '', 0, '0', '1233', '123', '0', '324', '0', '16', '', '11696.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:38'),
(0, 'tmiRwTHaEZY3odrb0VkDhJ14LOSq5BnCK7GlvpXc', 7, 3, 1, 0, 16, '2021-02', 1, 'full_monthly', '12300', '', 0, '0', '0', '0', '0', '0', '0', '0', '', '12300.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:38'),
(0, '4CIFPfcNtBbGviaXOnoE6783MyAqV21QWLrgszKw', 8, 1, 1, 0, 15, '2021-02', 1, 'full_monthly', '7000', '', 0, '0', '500', '0', '0', '0', '0', '0', '', '7500.00', '', '', 0, '', 1, '25-08-2021', 0, '25-08-2021 08:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_allowances`
--

CREATE TABLE `tat_salary_payslip_allowances` (
  `payslip_allowances_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `allowance_title` varchar(200) NOT NULL,
  `allowance_amount` varchar(200) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_commissions`
--

CREATE TABLE `tat_salary_payslip_commissions` (
  `payslip_commissions_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `commission_title` varchar(200) NOT NULL,
  `commission_amount` varchar(200) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_loan`
--

CREATE TABLE `tat_salary_payslip_loan` (
  `payslip_loan_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `loan_title` varchar(200) NOT NULL,
  `loan_amount` varchar(200) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_other_payments`
--

CREATE TABLE `tat_salary_payslip_other_payments` (
  `payslip_other_payment_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `payments_title` varchar(200) NOT NULL,
  `payments_amount` varchar(200) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_overtime`
--

CREATE TABLE `tat_salary_payslip_overtime` (
  `payslip_overtime_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `overtime_title` varchar(200) NOT NULL,
  `overtime_salary_month` varchar(200) NOT NULL,
  `overtime_no_of_days` varchar(200) NOT NULL,
  `overtime_hours` varchar(200) NOT NULL,
  `overtime_rate` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_payslip_statutory_deductions`
--

CREATE TABLE `tat_salary_payslip_statutory_deductions` (
  `payslip_deduction_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `deduction_title` varchar(200) NOT NULL,
  `deduction_amount` varchar(200) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_salary_statutory_deductions`
--

CREATE TABLE `tat_salary_statutory_deductions` (
  `statutory_deductions_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `statutory_options` int(11) NOT NULL,
  `deduction_title` varchar(200) DEFAULT NULL,
  `deduction_amount` varchar(200) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_sub_departments`
--

CREATE TABLE `tat_sub_departments` (
  `sub_department_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_sub_departments`
--

INSERT INTO `tat_sub_departments` (`sub_department_id`, `department_id`, `department_name`, `created_at`) VALUES
(1, 1, 'Human Resources Unit', '2021-05-15 00:22:13'),
(2, 1, 'General Services Unit', '2021-05-15 00:22:21'),
(3, 2, 'Finance Unit', '2021-05-15 00:22:26'),
(12, 3, 'Cashier', '2021-05-23 03:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `tat_system_setting`
--

CREATE TABLE `tat_system_setting` (
  `setting_id` int(111) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `default_currency` varchar(255) NOT NULL,
  `default_currency_id` int(11) NOT NULL,
  `default_currency_symbol` varchar(255) NOT NULL,
  `show_currency` varchar(255) NOT NULL,
  `currency_position` varchar(255) NOT NULL,
  `notification_position` varchar(255) NOT NULL,
  `notification_close_btn` varchar(255) NOT NULL,
  `notification_bar` varchar(255) NOT NULL,
  `enable_registration` varchar(255) NOT NULL,
  `login_with` varchar(255) NOT NULL,
  `date_format_xi` varchar(255) NOT NULL,
  `employee_manage_own_contact` varchar(255) NOT NULL,
  `employee_manage_own_profile` varchar(255) NOT NULL,
  `employee_manage_own_qualification` varchar(255) NOT NULL,
  `employee_manage_own_work_experience` varchar(255) NOT NULL,
  `employee_manage_own_picture` varchar(255) NOT NULL,
  `employee_manage_own_bank_account` varchar(255) NOT NULL,
  `enable_attendance` varchar(255) NOT NULL,
  `enable_clock_in_btn` varchar(255) NOT NULL,
  `enable_email_notification` varchar(255) NOT NULL,
  `enable_layout` varchar(255) NOT NULL,
  `compact_sidebar` varchar(255) NOT NULL,
  `fixed_header` varchar(255) NOT NULL,
  `fixed_sidebar` varchar(255) NOT NULL,
  `boxed_wrapper` varchar(255) NOT NULL,
  `layout_static` varchar(255) NOT NULL,
  `system_skin` varchar(255) NOT NULL,
  `animation_effect` varchar(255) NOT NULL,
  `animation_effect_modal` varchar(255) NOT NULL,
  `animation_effect_topmenu` varchar(255) NOT NULL,
  `is_ssl_available` varchar(50) NOT NULL,
  `is_active_sub_departments` varchar(10) NOT NULL,
  `default_language` varchar(200) NOT NULL,
  `system_timezone` varchar(200) NOT NULL,
  `system_ip_address` varchar(255) NOT NULL,
  `system_ip_restriction` varchar(200) NOT NULL,
  `module_language` varchar(100) NOT NULL,
  `module_recruitment` varchar(100) NOT NULL,
  `module_orgchart` varchar(100) NOT NULL,
  `module_finance` varchar(100) NOT NULL,
  `enable_page_rendered` varchar(255) NOT NULL,
  `statutory_fixed` varchar(100) NOT NULL,
  `enable_current_year` varchar(255) NOT NULL,
  `employee_login_id` varchar(200) NOT NULL,
  `enable_auth_background` varchar(11) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `module_payroll` varchar(10) NOT NULL,
  `is_half_monthly` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_system_setting`
--

INSERT INTO `tat_system_setting` (`setting_id`, `application_name`, `default_currency`, `default_currency_id`, `default_currency_symbol`, `show_currency`, `currency_position`, `notification_position`, `notification_close_btn`, `notification_bar`, `enable_registration`, `login_with`, `date_format_xi`, `employee_manage_own_contact`, `employee_manage_own_profile`, `employee_manage_own_qualification`, `employee_manage_own_work_experience`, `employee_manage_own_picture`, `employee_manage_own_bank_account`, `enable_attendance`, `enable_clock_in_btn`, `enable_email_notification`, `enable_layout`, `compact_sidebar`, `fixed_header`, `fixed_sidebar`, `boxed_wrapper`, `layout_static`, `system_skin`, `animation_effect`, `animation_effect_modal`, `animation_effect_topmenu`, `is_ssl_available`, `is_active_sub_departments`, `default_language`, `system_timezone`, `system_ip_address`, `system_ip_restriction`, `module_language`, `module_recruitment`, `module_orgchart`, `module_finance`, `enable_page_rendered`, `statutory_fixed`, `enable_current_year`, `employee_login_id`, `enable_auth_background`, `updated_at`, `module_payroll`, `is_half_monthly`) VALUES
(1, 'Tatari', 'ETB - Br ', 1, 'ETB - Br ', 'symbol', 'Prefix', 'toast-top-right', 'true', 'true', 'no', 'username', 'M-d-Y', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '', 'yes', 'yes', 'sidebar_layout_tatari', '', 'fixed-sidebar', 'boxed_layout_tatari', '', 'skin-default', 'fadeInDown', 'tada', 'tada', '', '', 'english', 'Africa/Addis_Ababa', '::1', '', 'true', 'true', 'true', 'true', '', '', 'yes', 'username', 'yes', '2021-04-28 04:27:32', 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tat_tatari_invoices`
--

CREATE TABLE `tat_tatari_invoices` (
  `invoice_id` int(111) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `issued_to` varchar(255) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_due_date` varchar(255) NOT NULL,
  `sub_total_amount` varchar(255) NOT NULL,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` varchar(255) NOT NULL,
  `total_tax` varchar(255) NOT NULL,
  `total_discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `invoice_note` mediumtext NOT NULL,
  `city` varchar(200) NOT NULL DEFAULT 'null',
  `countryid` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_tatari_invoices`
--

INSERT INTO `tat_tatari_invoices` (`invoice_id`, `invoice_number`, `issued_to`, `invoice_date`, `invoice_due_date`, `sub_total_amount`, `discount_type`, `discount_figure`, `total_tax`, `total_discount`, `grand_total`, `invoice_note`, `city`, `countryid`, `status`, `created_at`) VALUES
(3, 'INV-0001', 'DS Importers', '2021-08-11', '2021-08-24', '30446.25', '1', '0', '138.75', '0', '30446.25', '', 'null', 0, 1, '21-08-2021 03:15:59'),
(4, 'INV-0004', 'AB Metal', '2021-08-24', '2021-08-26', '10500.00', '2', '1', '500.00', '105.00', '10395.00', 'adgh ', 'null', 0, 1, '25-08-2021 21:52:13'),
(5, 'INV-0005', 'AB metal', '2021-08-16', '2021-08-31', '1020.00', '1', '0', '20.00', '0', '1020.00', '', 'null', 0, 0, '25-08-2021 21:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `tat_tatari_invoices_items`
--

CREATE TABLE `tat_tatari_invoices_items` (
  `invoice_item_id` int(111) NOT NULL,
  `invoice_id` int(111) NOT NULL,
  `issued_to` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_tax_type` varchar(255) NOT NULL,
  `item_tax_rate` varchar(255) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` varchar(255) NOT NULL,
  `item_sub_total` varchar(255) NOT NULL,
  `sub_total_amount` varchar(255) NOT NULL,
  `total_tax` varchar(255) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount_figure` varchar(255) NOT NULL,
  `total_discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_tatari_invoices_items`
--

INSERT INTO `tat_tatari_invoices_items` (`invoice_item_id`, `invoice_id`, `issued_to`, `item_name`, `item_tax_type`, `item_tax_rate`, `item_qty`, `item_unit_price`, `item_sub_total`, `sub_total_amount`, `total_tax`, `discount_type`, `discount_figure`, `total_discount`, `grand_total`, `created_at`) VALUES
(3, 3, 'DS Importers', 'Wooden Chairs', '1', '38.25', '25', '255', '7331.25', '30446.25', '138.75', 1, '0', '0', '30446.25', '21-08-2021 03:15:59'),
(4, 3, 'DS Importers', 'Bunk Beds', '1', '100.5', '30', '670', '23115.00', '30446.25', '138.75', 1, '0', '0', '30446.25', '21-08-2021 03:15:59'),
(5, 4, 'AB Metal', 'Metal Rod', '4', '500', '10', '1000', '10500.00', '10500.00', '500.00', 2, '1', '105.00', '10395.00', '25-08-2021 21:52:13'),
(6, 5, 'AB metal', 'Metal Sheet', '2', '20', '1', '1000', '1020.00', '1020.00', '20.00', 1, '0', '0', '1020.00', '25-08-2021 21:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `tat_tatari_module_attributes`
--

CREATE TABLE `tat_tatari_module_attributes` (
  `custom_field_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `attribute_label` varchar(255) NOT NULL,
  `attribute_type` varchar(255) NOT NULL,
  `validation` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tat_tatari_module_attributes_select_value`
--

CREATE TABLE `tat_tatari_module_attributes_select_value` (
  `attributes_select_value_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `select_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tat_tatari_module_attributes_values`
--

CREATE TABLE `tat_tatari_module_attributes_values` (
  `attributes_value_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_attributes_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tat_tax_types`
--

CREATE TABLE `tat_tax_types` (
  `tax_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_tax_types`
--

INSERT INTO `tat_tax_types` (`tax_id`, `name`, `rate`, `type`, `description`, `created_at`) VALUES
(1, 'VAT', '15', 'percentage', 'The rate of VAT is 15% of the value for every taxable transaction by a registered\r\nperson, all imported goods other than an exempt import and an import of services.', '20-07-2020'),
(2, 'Excise Tax', '2', 'percentage', 'This is imposed and payable on selected goods, such as, luxury goods and basic goods\r\nwhich are demand inelastic. In addition, it is believed that imposing the tax on goods that\r\nare hazardous to health and which are cause to social problems will reduce the\r\nconsumption thereof', '20-07-2020'),
(3, 'Turnover Tax', '2', 'percentage', 'This is an equalization tax imposed on persons not registered for value-added tax to fulfil\r\ntheir obligations and also to enhance fairness in commercial relations and to complete the\r\ncoverage of the tax system', '20-07-2020'),
(4, 'Income Tax', '5', 'percentage', 'Income from employment;\r\n- Income from business activities;\r\n- Income derived by an entertainer, musician, or sports person from his personal\r\nactivities;\r\n- Income from entrepreneurial activities carried out by a non-resident through a\r\npermanent establishment in Ethiopia;\r\n- Income from movable property attributable to a permanent establishment in\r\nEthiopia;', '20-07-2020'),
(5, 'Business profit tax', '30', 'percentage', 'Taxable business income of bodies is taxable at the rate of 30%\r\n- Taxable business income of other taxpayers shall be taxed', '20-07-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tat_termination_type`
--

CREATE TABLE `tat_termination_type` (
  `termination_type_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_termination_type`
--

INSERT INTO `tat_termination_type` (`termination_type_id`, `company_id`, `type`, `created_at`) VALUES
(1, 1, 'Voluntary Termination', '22-05-2021 01:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `tat_theme_settings`
--

CREATE TABLE `tat_theme_settings` (
  `theme_settings_id` int(11) NOT NULL,
  `fixed_layout` varchar(200) NOT NULL,
  `fixed_footer` varchar(200) NOT NULL,
  `boxed_layout` varchar(200) NOT NULL,
  `page_header` varchar(200) NOT NULL,
  `footer_layout` varchar(200) NOT NULL,
  `statistics_cards` varchar(200) NOT NULL,
  `animation_style` varchar(100) NOT NULL,
  `theme_option` varchar(100) NOT NULL,
  `dashboard_option` varchar(100) NOT NULL,
  `dashboard_calendar` varchar(100) NOT NULL,
  `login_page_options` varchar(100) NOT NULL,
  `sub_menu_icons` varchar(100) NOT NULL,
  `statistics_cards_background` varchar(200) NOT NULL,
  `employee_cards` varchar(200) NOT NULL,
  `card_border_color` varchar(200) NOT NULL,
  `compact_menu` varchar(200) NOT NULL,
  `flipped_menu` varchar(200) NOT NULL,
  `right_side_icons` varchar(200) NOT NULL,
  `bordered_menu` varchar(200) NOT NULL,
  `form_design` varchar(200) NOT NULL,
  `is_semi_dark` int(11) NOT NULL,
  `semi_dark_color` varchar(200) NOT NULL,
  `top_nav_dark_color` varchar(200) NOT NULL,
  `menu_color_option` varchar(200) NOT NULL,
  `export_orgchart` varchar(100) NOT NULL,
  `export_file_title` mediumtext NOT NULL,
  `org_chart_layout` varchar(200) NOT NULL,
  `org_chart_zoom` varchar(100) NOT NULL,
  `org_chart_pan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_theme_settings`
--

INSERT INTO `tat_theme_settings` (`theme_settings_id`, `fixed_layout`, `fixed_footer`, `boxed_layout`, `page_header`, `footer_layout`, `statistics_cards`, `animation_style`, `theme_option`, `dashboard_option`, `dashboard_calendar`, `login_page_options`, `sub_menu_icons`, `statistics_cards_background`, `employee_cards`, `card_border_color`, `compact_menu`, `flipped_menu`, `right_side_icons`, `bordered_menu`, `form_design`, `is_semi_dark`, `semi_dark_color`, `top_nav_dark_color`, `menu_color_option`, `export_orgchart`, `export_file_title`, `org_chart_layout`, `org_chart_zoom`, `org_chart_pan`) VALUES
(1, 'false', 'true', 'false', 'breadcrumb-transparent', 'footer-dark', '4', 'fadeInDown', 'template_1', 'dashboard_1', 'true', 'login_page_2', 'fa-caret-right', '', '', '', 'true', 'false', 'false', 'false', 'basic_form', 1, 'bg-primary', 'bg-blue-grey', 'menu-dark', 'true', 'Tatari', 't2b', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tat_users`
--

CREATE TABLE `tat_users` (
  `user_id` int(11) NOT NULL,
  `user_role` varchar(30) NOT NULL DEFAULT 'administrator',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `profile_background` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `last_login_date` varchar(255) NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `is_logged_in` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tat_user_roles`
--

CREATE TABLE `tat_user_roles` (
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `role_access` varchar(200) NOT NULL,
  `role_resources` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_user_roles`
--

INSERT INTO `tat_user_roles` (`role_id`, `company_id`, `role_name`, `role_access`, `role_resources`, `created_at`) VALUES
(1, 1, 'Super Admin', '1', '0,103,13,13,201,202,203,372,373,393,393,394,395,396,351,92,88,23,23,204,205,206,231,400,22,12,14,14,207,208,209,232,15,15,210,211,212,233,16,16,213,214,215,234,406,407,408,17,17,216,217,218,235,18,18,219,220,221,236,19,19,222,223,224,237,20,20,225,226,227,238,21,21,228,229,230,239,2,3,3,240,241,242,4,4,243,244,245,249,5,5,246,247,248,6,6,250,251,252,11,11,254,255,256,257,9,9,258,259,260,96,24,25,25,262,263,264,265,26,26,266,267,268,97,98,98,269,270,271,272,99,99,273,274,275,276,27,28,28,397,10,10,253,261,29,29,381,30,30,277,278,279,310,401,401,402,403,31,7,7,280,281,282,2822,311,8,8,283,284,285,46,46,287,288,289,290,286,312,48,49,49,291,292,293,50,51,51,294,295,387,52,52,296,297,388,32,36,36,313,314,37,37,391,404,405,40,41,41,298,299,300,301,42,42,302,303,304,305,43,43,306,307,308,309,104,44,44,315,316,317,318,45,45,319,320,321,322,122,122,331,332,333,106,107,107,334,335,336,108,108,338,339,340,47,53,54,54,341,342,343,344,55,55,345,346,347,56,56,348,349,350,57,60,61,118,62,63,93,71,72,72,352,353,354,73,74,75,75,355,356,357,76,76,358,359,360,77,77,361,362,363,78,79,80,80,364,365,366,81,81,367,368,369,82,83,84,85,86,87,119,119,323,324,325,326,410,411,412,413,414,420,415,416,417,418,419,121,121,120,328,329,330,89,89,370,371,90,91,94,95,110,111,112,113,114,115,116,117,409', '28-05-2021'),
(2, 1, 'Employee', '2', '0,22,401,401,402,403,79,80,80,364,365,366,81,81,367,368,369,75,355,356,87,121,121,120,328,329,330,82,83,84,85,86', '21-05-2021'),
(3, 0, 'Basic Account', '2', '0,401', '21-08-2021'),
(4, 0, 'HR Dept Employee', '2', '0,13,13,201,202,203,372,373,351,15,15,210,211,212,233,16,16,213,214,215,234,406,407,408,18,18,219,220,221,236', '25-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `tat_warning_type`
--

CREATE TABLE `tat_warning_type` (
  `warning_type_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tat_warning_type`
--

INSERT INTO `tat_warning_type` (`warning_type_id`, `company_id`, `type`, `created_at`) VALUES
(1, 1, 'First Warning Notice', '20-05-2021 01:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tat_attendance_time`
--
ALTER TABLE `tat_attendance_time`
  ADD PRIMARY KEY (`time_attendance_id`);

--
-- Indexes for table `tat_attendance_time_request`
--
ALTER TABLE `tat_attendance_time_request`
  ADD PRIMARY KEY (`time_request_id`);

--
-- Indexes for table `tat_companies`
--
ALTER TABLE `tat_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tat_company_info`
--
ALTER TABLE `tat_company_info`
  ADD PRIMARY KEY (`company_info_id`);

--
-- Indexes for table `tat_company_type`
--
ALTER TABLE `tat_company_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tat_countries`
--
ALTER TABLE `tat_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tat_database_backup`
--
ALTER TABLE `tat_database_backup`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `tat_departments`
--
ALTER TABLE `tat_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tat_designations`
--
ALTER TABLE `tat_designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `tat_document_type`
--
ALTER TABLE `tat_document_type`
  ADD PRIMARY KEY (`document_type_id`);

--
-- Indexes for table `tat_email_template`
--
ALTER TABLE `tat_email_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tat_employees`
--
ALTER TABLE `tat_employees`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tat_employee_bankaccount`
--
ALTER TABLE `tat_employee_bankaccount`
  ADD PRIMARY KEY (`bankaccount_id`);

--
-- Indexes for table `tat_employee_complaints`
--
ALTER TABLE `tat_employee_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tat_employee_contacts`
--
ALTER TABLE `tat_employee_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tat_employee_documents`
--
ALTER TABLE `tat_employee_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `tat_employee_location`
--
ALTER TABLE `tat_employee_location`
  ADD PRIMARY KEY (`office_location_id`);

--
-- Indexes for table `tat_employee_promotions`
--
ALTER TABLE `tat_employee_promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `tat_employee_qualification`
--
ALTER TABLE `tat_employee_qualification`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `tat_employee_resignations`
--
ALTER TABLE `tat_employee_resignations`
  ADD PRIMARY KEY (`resignation_id`);

--
-- Indexes for table `tat_employee_terminations`
--
ALTER TABLE `tat_employee_terminations`
  ADD PRIMARY KEY (`termination_id`);

--
-- Indexes for table `tat_employee_transfer`
--
ALTER TABLE `tat_employee_transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `tat_employee_warnings`
--
ALTER TABLE `tat_employee_warnings`
  ADD PRIMARY KEY (`warning_id`);

--
-- Indexes for table `tat_employee_work_experience`
--
ALTER TABLE `tat_employee_work_experience`
  ADD PRIMARY KEY (`work_experience_id`);

--
-- Indexes for table `tat_expenses`
--
ALTER TABLE `tat_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tat_expense_type`
--
ALTER TABLE `tat_expense_type`
  ADD PRIMARY KEY (`expense_type_id`);

--
-- Indexes for table `tat_finance_bankcash`
--
ALTER TABLE `tat_finance_bankcash`
  ADD PRIMARY KEY (`bankcash_id`);

--
-- Indexes for table `tat_finance_deposit`
--
ALTER TABLE `tat_finance_deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `tat_finance_expense`
--
ALTER TABLE `tat_finance_expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tat_finance_payees`
--
ALTER TABLE `tat_finance_payees`
  ADD PRIMARY KEY (`payee_id`);

--
-- Indexes for table `tat_finance_payers`
--
ALTER TABLE `tat_finance_payers`
  ADD PRIMARY KEY (`payer_id`);

--
-- Indexes for table `tat_finance_transaction`
--
ALTER TABLE `tat_finance_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tat_finance_transactions`
--
ALTER TABLE `tat_finance_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tat_finance_transfer`
--
ALTER TABLE `tat_finance_transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `tat_income_categories`
--
ALTER TABLE `tat_income_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tat_jobs`
--
ALTER TABLE `tat_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tat_job_applications`
--
ALTER TABLE `tat_job_applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `tat_job_type`
--
ALTER TABLE `tat_job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `tat_languages`
--
ALTER TABLE `tat_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tat_leave_applications`
--
ALTER TABLE `tat_leave_applications`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tat_leave_type`
--
ALTER TABLE `tat_leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `tat_office_shift`
--
ALTER TABLE `tat_office_shift`
  ADD PRIMARY KEY (`office_shift_id`);

--
-- Indexes for table `tat_overtime_request`
--
ALTER TABLE `tat_overtime_request`
  ADD PRIMARY KEY (`time_request_id`);

--
-- Indexes for table `tat_payment_method`
--
ALTER TABLE `tat_payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `tat_qualification_education_level`
--
ALTER TABLE `tat_qualification_education_level`
  ADD PRIMARY KEY (`education_level_id`);

--
-- Indexes for table `tat_qualification_language`
--
ALTER TABLE `tat_qualification_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tat_qualification_skill`
--
ALTER TABLE `tat_qualification_skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `tat_salary_commissions`
--
ALTER TABLE `tat_salary_commissions`
  ADD PRIMARY KEY (`salary_commissions_id`);

--
-- Indexes for table `tat_salary_loan_deductions`
--
ALTER TABLE `tat_salary_loan_deductions`
  ADD PRIMARY KEY (`loan_deduction_id`);

--
-- Indexes for table `tat_salary_models`
--
ALTER TABLE `tat_salary_models`
  ADD PRIMARY KEY (`salary_model_id`);

--
-- Indexes for table `tat_salary_other_payments`
--
ALTER TABLE `tat_salary_other_payments`
  ADD PRIMARY KEY (`other_payments_id`);

--
-- Indexes for table `tat_salary_overtime`
--
ALTER TABLE `tat_salary_overtime`
  ADD PRIMARY KEY (`salary_overtime_id`);

--
-- Indexes for table `tat_sub_departments`
--
ALTER TABLE `tat_sub_departments`
  ADD PRIMARY KEY (`sub_department_id`);

--
-- Indexes for table `tat_system_setting`
--
ALTER TABLE `tat_system_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tat_tatari_invoices`
--
ALTER TABLE `tat_tatari_invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tat_tatari_invoices_items`
--
ALTER TABLE `tat_tatari_invoices_items`
  ADD PRIMARY KEY (`invoice_item_id`);

--
-- Indexes for table `tat_tatari_module_attributes`
--
ALTER TABLE `tat_tatari_module_attributes`
  ADD PRIMARY KEY (`custom_field_id`);

--
-- Indexes for table `tat_tatari_module_attributes_select_value`
--
ALTER TABLE `tat_tatari_module_attributes_select_value`
  ADD PRIMARY KEY (`attributes_select_value_id`);

--
-- Indexes for table `tat_tatari_module_attributes_values`
--
ALTER TABLE `tat_tatari_module_attributes_values`
  ADD PRIMARY KEY (`attributes_value_id`);

--
-- Indexes for table `tat_tax_types`
--
ALTER TABLE `tat_tax_types`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tat_termination_type`
--
ALTER TABLE `tat_termination_type`
  ADD PRIMARY KEY (`termination_type_id`);

--
-- Indexes for table `tat_theme_settings`
--
ALTER TABLE `tat_theme_settings`
  ADD PRIMARY KEY (`theme_settings_id`);

--
-- Indexes for table `tat_users`
--
ALTER TABLE `tat_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tat_user_roles`
--
ALTER TABLE `tat_user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tat_warning_type`
--
ALTER TABLE `tat_warning_type`
  ADD PRIMARY KEY (`warning_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tat_attendance_time`
--
ALTER TABLE `tat_attendance_time`
  MODIFY `time_attendance_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tat_attendance_time_request`
--
ALTER TABLE `tat_attendance_time_request`
  MODIFY `time_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_companies`
--
ALTER TABLE `tat_companies`
  MODIFY `company_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_company_info`
--
ALTER TABLE `tat_company_info`
  MODIFY `company_info_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_company_type`
--
ALTER TABLE `tat_company_type`
  MODIFY `type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tat_countries`
--
ALTER TABLE `tat_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tat_database_backup`
--
ALTER TABLE `tat_database_backup`
  MODIFY `backup_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tat_departments`
--
ALTER TABLE `tat_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_designations`
--
ALTER TABLE `tat_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tat_document_type`
--
ALTER TABLE `tat_document_type`
  MODIFY `document_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_email_template`
--
ALTER TABLE `tat_email_template`
  MODIFY `template_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_employees`
--
ALTER TABLE `tat_employees`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tat_employee_bankaccount`
--
ALTER TABLE `tat_employee_bankaccount`
  MODIFY `bankaccount_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_employee_complaints`
--
ALTER TABLE `tat_employee_complaints`
  MODIFY `complaint_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tat_employee_contacts`
--
ALTER TABLE `tat_employee_contacts`
  MODIFY `contact_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_employee_documents`
--
ALTER TABLE `tat_employee_documents`
  MODIFY `document_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tat_employee_location`
--
ALTER TABLE `tat_employee_location`
  MODIFY `office_location_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_employee_promotions`
--
ALTER TABLE `tat_employee_promotions`
  MODIFY `promotion_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_employee_qualification`
--
ALTER TABLE `tat_employee_qualification`
  MODIFY `qualification_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_employee_resignations`
--
ALTER TABLE `tat_employee_resignations`
  MODIFY `resignation_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_employee_terminations`
--
ALTER TABLE `tat_employee_terminations`
  MODIFY `termination_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_employee_transfer`
--
ALTER TABLE `tat_employee_transfer`
  MODIFY `transfer_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_employee_warnings`
--
ALTER TABLE `tat_employee_warnings`
  MODIFY `warning_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_employee_work_experience`
--
ALTER TABLE `tat_employee_work_experience`
  MODIFY `work_experience_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_expenses`
--
ALTER TABLE `tat_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_expense_type`
--
ALTER TABLE `tat_expense_type`
  MODIFY `expense_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_finance_bankcash`
--
ALTER TABLE `tat_finance_bankcash`
  MODIFY `bankcash_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_finance_deposit`
--
ALTER TABLE `tat_finance_deposit`
  MODIFY `deposit_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_finance_expense`
--
ALTER TABLE `tat_finance_expense`
  MODIFY `expense_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_finance_payees`
--
ALTER TABLE `tat_finance_payees`
  MODIFY `payee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_finance_payers`
--
ALTER TABLE `tat_finance_payers`
  MODIFY `payer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_finance_transaction`
--
ALTER TABLE `tat_finance_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tat_finance_transactions`
--
ALTER TABLE `tat_finance_transactions`
  MODIFY `transaction_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_finance_transfer`
--
ALTER TABLE `tat_finance_transfer`
  MODIFY `transfer_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_income_categories`
--
ALTER TABLE `tat_income_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_jobs`
--
ALTER TABLE `tat_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_job_applications`
--
ALTER TABLE `tat_job_applications`
  MODIFY `application_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_job_type`
--
ALTER TABLE `tat_job_type`
  MODIFY `job_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tat_leave_applications`
--
ALTER TABLE `tat_leave_applications`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_leave_type`
--
ALTER TABLE `tat_leave_type`
  MODIFY `leave_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_office_shift`
--
ALTER TABLE `tat_office_shift`
  MODIFY `office_shift_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_overtime_request`
--
ALTER TABLE `tat_overtime_request`
  MODIFY `time_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_payment_method`
--
ALTER TABLE `tat_payment_method`
  MODIFY `payment_method_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tat_qualification_education_level`
--
ALTER TABLE `tat_qualification_education_level`
  MODIFY `education_level_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_qualification_language`
--
ALTER TABLE `tat_qualification_language`
  MODIFY `language_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tat_qualification_skill`
--
ALTER TABLE `tat_qualification_skill`
  MODIFY `skill_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tat_salary_commissions`
--
ALTER TABLE `tat_salary_commissions`
  MODIFY `salary_commissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_salary_loan_deductions`
--
ALTER TABLE `tat_salary_loan_deductions`
  MODIFY `loan_deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_salary_models`
--
ALTER TABLE `tat_salary_models`
  MODIFY `salary_model_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_salary_other_payments`
--
ALTER TABLE `tat_salary_other_payments`
  MODIFY `other_payments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_salary_overtime`
--
ALTER TABLE `tat_salary_overtime`
  MODIFY `salary_overtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_sub_departments`
--
ALTER TABLE `tat_sub_departments`
  MODIFY `sub_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tat_system_setting`
--
ALTER TABLE `tat_system_setting`
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_tatari_invoices`
--
ALTER TABLE `tat_tatari_invoices`
  MODIFY `invoice_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tat_tatari_invoices_items`
--
ALTER TABLE `tat_tatari_invoices_items`
  MODIFY `invoice_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tat_tatari_module_attributes`
--
ALTER TABLE `tat_tatari_module_attributes`
  MODIFY `custom_field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_tatari_module_attributes_select_value`
--
ALTER TABLE `tat_tatari_module_attributes_select_value`
  MODIFY `attributes_select_value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_tatari_module_attributes_values`
--
ALTER TABLE `tat_tatari_module_attributes_values`
  MODIFY `attributes_value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_tax_types`
--
ALTER TABLE `tat_tax_types`
  MODIFY `tax_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tat_termination_type`
--
ALTER TABLE `tat_termination_type`
  MODIFY `termination_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_theme_settings`
--
ALTER TABLE `tat_theme_settings`
  MODIFY `theme_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tat_users`
--
ALTER TABLE `tat_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tat_user_roles`
--
ALTER TABLE `tat_user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
