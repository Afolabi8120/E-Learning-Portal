-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2023 at 10:23 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblassignment`
--

CREATE TABLE `tblassignment` (
  `id` bigint(50) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `document` varchar(300) NOT NULL,
  `description` longtext NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblassignment`
--

INSERT INTO `tblassignment` (`id`, `course_code`, `course_title`, `level`, `document`, `description`, `lecturer_id`, `date_added`, `status`) VALUES
(1, 'COM 311', 'Operating System 1', 'HND 1', 'COM 313-2020-2021-FIRST SEMESTER-UPLOAD.pdf', 'Answer all question in the document file&lt;br&gt;', 2, '2023-01-02 21:37:32', 0),
(2, 'COM 426', 'Computer Security', 'HND 2', 'InstaHealth Business Proposal.pdf', '&lt;b&gt;Executive Summary:\r\n&lt;/b&gt;&lt;br&gt;&lt;i&gt;InstaHealt&lt;/i&gt;h is a healthcare app designed to connect patients with healthcare providers in a&lt;br&gt;seamless and convenient way. &lt;i&gt;InstaHealth&lt;/i&gt; aims to improve access to healthcare services and&lt;br&gt;increase patient engagement in their own health management by offering a variety of&lt;br&gt;features and functions, including a directory of healthcare providers, appointment booking,&lt;br&gt;virtual visits, vitals tracking, medication reminders, and more.\r\n\r\n\r\n&lt;br&gt;&lt;br&gt;', 2, '2023-05-09 10:26:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblfile`
--

CREATE TABLE `tblfile` (
  `id` bigint(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` text NOT NULL,
  `level` varchar(20) NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `staff_id` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfile`
--

INSERT INTO `tblfile` (`id`, `course_code`, `course_title`, `level`, `document_name`, `description`, `staff_id`, `status`, `added_date`, `file_type`) VALUES
(1, 'COM 311', 'Operating System 1', 'HND 1', 'COM 313-2020-2021-FIRST SEMESTER-UPLOAD.pdf', 'A sample assignment on OS 1&lt;br&gt;', 'S-192892', 'Active', '2023-01-02 21:33:42', 'Document'),
(2, 'COM 311', 'Operating System 1', 'HND 1', '6_For_6.mp3', 'A sample audio on OS 1&lt;br&gt;', 'S-192892', 'Active', '2023-01-02 21:34:21', 'Audio'),
(3, 'COM 311', 'Operating System 1', 'HND 1', 'VID-20211031-WA0068.mp4', 'A sample video on OS 1&lt;br&gt;', 'S-192892', 'Active', '2023-01-02 21:34:55', 'Video'),
(4, 'COM 426', 'Computer Security', 'HND 2', '4CC511_Assignment_2fiver.docx', '&lt;b&gt;Executive Summary:\r\n&lt;/b&gt;&lt;br&gt;InstaHealth is a healthcare app designed to connect patients with healthcare providers in a&lt;br&gt;seamless and convenient way. InstaHealth aims to improve access to healthcare services and&lt;br&gt;increase patient engagement in their own health management by offering a variety of&lt;br&gt;features and functions, including a directory of healthcare providers, appointment booking,&lt;br&gt;&lt;div&gt;virtual visits, vitals tracking, medication reminders, and more. &lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;b&gt;Market Analysis:\r\n&lt;/b&gt;&lt;br&gt;The healthcare industry is a rapidly growing and constantly evolving market. With the rise of&lt;br&gt;telemedicine and mobile health technology, there is a growing demand for healthcare apps&lt;br&gt;that can provide convenient and accessible healthcare services. The global digital health&lt;br&gt;market is expected to grow at a CAGR of 13.4% from 2020 to 2027, with a market size of $509.2&lt;br&gt;billion by 2027 (source: Grand View Research).\r\n\r\n\r\n&lt;br&gt;Target Market:\r\n&lt;br&gt;&lt;ul&gt;&lt;li&gt;Our target market includes healthcare consumers who are looking for convenient and&lt;/li&gt;&lt;li&gt;accessible healthcare services, particularly those who are digitally savvy and comfortable&lt;/li&gt;&lt;li&gt;using mobile apps for healthcare management. This includes individuals of all ages and&lt;/li&gt;&lt;li&gt;demographics who are seeking healthcare services, as well as healthcare providers who want&lt;/li&gt;&lt;li&gt;to increase their online presence and reach new patients.\r\n\r\n\r\n&lt;/li&gt;&lt;li&gt;Product Offering:\r\n&lt;/li&gt;&lt;li&gt;InstaHealth will offer a range of features and functions to help patients manage their&lt;/li&gt;&lt;li&gt;healthcare needs, including&lt;/li&gt;&lt;li&gt;Q Find a Doctor: A directory of healthcare providers in the user&#039;s area, with filters for&lt;/li&gt;&lt;li&gt;specialty, location, insurance, and more%&lt;/li&gt;&lt;li&gt;Q Book an Appointment: The ability to schedule appointments with healthcare providers&lt;/li&gt;&lt;li&gt;directly from the app%&lt;/li&gt;&lt;li&gt;Q Vitals Tracker: A tool for users to input and track their personal health data, such as blood&lt;/li&gt;&lt;li&gt;pressure, weight, and heart rate%&lt;/li&gt;&lt;li&gt;Q Medication Reminders: The ability to set reminders for taking medication on a regular&lt;/li&gt;&lt;li&gt;schedule%&lt;/li&gt;&lt;li&gt;Q Health Library: A comprehensive library of health information and resources, such as&lt;/li&gt;&lt;li&gt;articles, videos, and other educational materials%&lt;/li&gt;&lt;li&gt;Q Virtual Visits: The ability to connect with healthcare providers remotely through video&lt;/li&gt;&lt;li&gt;conferencing or other virtual visit options%&lt;/li&gt;&lt;li&gt;Q Insurance &amp;amp; Billing: Information on insurance coverage, as well as options for paying bills&lt;/li&gt;&lt;li&gt;and managing healthcare expenses%&lt;/li&gt;&lt;li&gt;Q Emergency Services: Quick acce&lt;/li&gt;&lt;/ul&gt;', 'S-192892', 'Active', '2023-05-09 10:41:12', 'Document'),
(5, 'COM 426', 'Computer Security', 'HND 2', 'Dave_Ft_Burna_Boy_-_Location.mp3', '&lt;b&gt;Executive Summary:\r\n&lt;/b&gt;&lt;br&gt;InstaHealth is a healthcare app designed to connect patients with healthcare providers in a&lt;br&gt;seamless and convenient way. InstaHealth aims to improve access to healthcare services and&lt;br&gt;increase patient engagement in their own health management by offering a variety of&lt;br&gt;features and functions, including a directory of healthcare providers, appointment booking,&lt;br&gt;&lt;br&gt;', 'S-192892', 'Active', '2023-05-09 10:42:05', 'Audio'),
(6, 'COM 426', 'Computer Security', 'HND 2', 'A DAY IN THE LIFE OF A SOFTWARE ENGINEER.mp4', 'Executive Summary:\r\n&lt;br&gt;InstaHealth is a healthcare app designed to connect patients with healthcare providers in a&lt;br&gt;seamless and convenient way. InstaHealth aims to improve access to healthcare services and&lt;br&gt;increase patient engagement in their own health management by offering a variety of&lt;br&gt;features and functions, including a directory of healthcare providers, appointment booking,&lt;br&gt;virtual visits, vitals tracking, medication reminders, and more.\r\n\r\n\r\n&lt;br&gt;&lt;br&gt;', 'S-192892', 'Active', '2023-05-09 10:42:59', 'Video');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `id` bigint(50) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` longtext CHARACTER SET utf8 NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_status` int(11) NOT NULL,
  `receiver_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`id`, `sender_id`, `receiver_id`, `message`, `date`, `sender_status`, `receiver_status`) VALUES
(9, 10, 2, 'Hello Sir', '2023-05-09 10:39:31', 1, 1),
(10, 2, 10, 'How are you?', '2023-05-09 10:39:57', 1, 0),
(11, 11, 2, 'hello', '2023-05-10 12:36:14', 1, 1),
(12, 2, 11, 'hi', '2023-05-10 12:38:56', 1, 1),
(13, 3, 5, 'Hello Sir\n', '2023-05-16 21:47:33', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubmitassignment`
--

CREATE TABLE `tblsubmitassignment` (
  `id` bigint(50) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `submitted_status` int(11) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubmitassignment`
--

INSERT INTO `tblsubmitassignment` (`id`, `lecturer_id`, `assignment_id`, `student_id`, `file`, `score`, `submitted_status`, `date_submitted`) VALUES
(1, 2, 1, '2017070510111', 'Proposal on Electronic Student Learning Portal.docx', 18.00, 1, '2023-01-02 21:40:57'),
(2, 2, 1, '20200705010092', '0b379e57353d4e729706e847cefc99b8.jpg', 17.00, 1, '2023-04-13 20:06:49'),
(3, 2, 2, '2017070510109', 'pitch.pdf', 16.00, 1, '2023-05-09 10:38:09'),
(4, 2, 1, '2019245020028', '284-Programming-in-Quick-Basic.pdf', 15.00, 1, '2023-05-10 12:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` bigint(20) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `mstatus` varchar(20) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `userid`, `fullname`, `gender`, `mstatus`, `religion`, `position`, `email`, `phone`, `dob`, `password`, `address`, `picture`, `status`, `usertype`, `session`, `reg_date`, `chat_code`) VALUES
(1, 'Afolabi8120', 'AFOLABI TEMIDAYO TIMOTHY', 'Male', 'Single', 'Christian', 'Admin', 'afolabi8120@gmail.com', '08090949669', '1997-07-09', '$2y$10$s3fq2pAhVlUme6.hC15aA..k/vyRgOUtShU6/lcZEl7YzQjUa2b8y', 'Ore, Ondo State', '1535977355150.jpg', 'Active', 'Super Admin', '471o675fjc3i094qgjj43pgarq', '2022-06-22 18:39:02', '0d7c0a8b'),
(2, 'S-192892', 'ALBERT FAITH SEGUN', 'Male', 'Single', 'Christian', 'Lecturer', 'albert@gmail.com', '08090949669', '1970-04-07', '$2y$10$s3fq2pAhVlUme6.hC15aA..k/vyRgOUtShU6/lcZEl7YzQjUa2b8y', 'Lagos State', '1550665235338.jpg', 'Active', 'Lecturer', 'pkdssq6udrh1rqdgbbviim23v2', '2022-07-12 19:38:45', '50ba1d0c'),
(3, '2017070510111', 'AFOLABI TEMITOPE EMMANUEL', 'Male', 'Single', 'Christian', 'HND 1', 'tpex@gmail.com', '08090949669', '2005-12-15', '$2y$10$s3fq2pAhVlUme6.hC15aA..k/vyRgOUtShU6/lcZEl7YzQjUa2b8y', 'Osapa', '1578415618998.jpg', 'Active', 'Student', 'pkdssq6udrh1rqdgbbviim23v2', '2022-07-18 16:29:58', 'c717d9ab'),
(4, '2017070510630', 'OLADITI MICHEAL PELUMI', 'Male', 'Single', 'Christian', 'HND 1', 'm.oladiti1@gmail.com', '08090949669', '', '$2y$10$Nyv8b.ajwfGXXo52PGCRvebRnlOeXqIDP.J.vgCmLV7L3M60tXu3S', '', '1535977355150.jpg', 'Active', 'Student', 't2kp1u2rovchkopohhgsorvcau', '2022-07-18 17:21:13', '2b4ad83c'),
(5, 'DS-9u678', 'MR G.G.O Egbedokun', 'Male', 'Single', 'Christian', 'HOD', 'egbedokun@gmail.com', '08090949669', '1969-02-02', '$2y$10$grtOq0tk7FRc7LozzP6uqOQDuHdW2QuUCZDcuOJuOCGyYw6iiD.IC', '', 'default.jpg', 'Active', 'Lecturer', 'pkdssq6udrh1rqdgbbviim23v2', '2022-07-18 21:50:24', '5cad7b32'),
(6, 'Admin', 'ALL THAT GLITTERS IS NOT GOLD', 'Male', 'Single', 'Christian', '', 'admin@gmail.com', '08090949669', '1990-12-07', '$2y$10$hCcSTOs4j66QLuMh7Rn9h.qAibIQqagfEZDIVAygBeL0SAi/iy5dq', 'N/A', 'default.jpg', 'Active', 'Admin', 'k9s90tnd6ojtfaonkicp9gioif', '2022-07-18 21:51:31', '4bd201ca'),
(7, '2017070510126', 'AFOLABI OLAONIPEKUN', 'Female', 'Single', 'Christian', 'HND 1', 'ola.afo@gmail.com', '09098494944', '2022-10-12', '$2y$10$9CLob/9viEGFUrOH3mGv9ej2MaOfBgKx5gow69vfS8CwAUIwEnMfC', 'N/A', 'default.jpg', 'Active', 'Student', 'j3jkjh3299lcjng1o6aqne0uqm', '2022-07-31 23:16:50', 'da5bc412'),
(8, '45728929', 'IDOWU EMMANUEL TOBILOBA', 'Male', 'Single', 'Christian', 'Lecturer', 'emma@gmail.com', '07049269626', '2022-12-27', '$2y$10$D7xu..EStNU.JYqcnPVbBerNRsRjuWF5QAPXx9pY.CDtbQdU4qjTC', 'N/A', 'default.jpg', 'Active', 'Lecturer', NULL, '2023-01-02 21:28:36', 'c160bad9'),
(10, '2017070510109', 'ADELEKE JOHN', 'Male', 'Single', 'Christian', 'HND 2', 'johnadeleke@gmail.com', '08090949600', '2023-05-03', '$2y$10$8q8.JFjv2OhXnpg2MnYRwuIPz0vUng3rTQCjAmzIRv3Ty2BHkZqZO', 'N/A', '1535977355150.jpg', 'Active', 'Student', 'vcifv3h8j27e9pb0raamp2lcf3', '2023-05-09 10:08:01', 'a0c50b3d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblassignment`
--
ALTER TABLE `tblassignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubmitassignment`
--
ALTER TABLE `tblsubmitassignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblassignment`
--
ALTER TABLE `tblassignment`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblfile`
--
ALTER TABLE `tblfile`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblsubmitassignment`
--
ALTER TABLE `tblsubmitassignment`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
