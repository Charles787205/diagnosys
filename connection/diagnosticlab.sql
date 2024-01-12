-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 10:06 AM
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
-- Database: `diagnosticlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_ID` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_phone` varchar(11) NOT NULL,
  `appointment_lastname` varchar(50) NOT NULL,
  `appointment_firstname` varchar(50) NOT NULL,
  `appointment_birthdate` date NOT NULL,
  `appointment_age` int(2) NOT NULL,
  `appointment_address` varchar(250) NOT NULL,
  `appointment_amount` int(11) NOT NULL,
  `appointment_test` varchar(50) NOT NULL,
  `appointment_status` enum('0','1','','') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_ID`, `appointment_date`, `appointment_phone`, `appointment_lastname`, `appointment_firstname`, `appointment_birthdate`, `appointment_age`, `appointment_address`, `appointment_amount`, `appointment_test`, `appointment_status`) VALUES
(20, '2023-08-10', ' 0930478321', ' Virador', 'Peter', '2001-11-22', 21, 'Purok 12, San Vicente', 550, 'CBC,Hemoglobin', '1'),
(21, '2023-08-10', '  093047832', ' hhdhdh', 'jsjdjdj', '1999-11-22', 23, 'Purok 12, San Vicente', 300, 'CBC,FBS,HEMOGLOBIN,RBS,Platelet Count ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `register_user`
--

CREATE TABLE `register_user` (
  `register_ID` int(11) NOT NULL,
  `register_lastname` varchar(50) NOT NULL,
  `register_firstname` varchar(50) NOT NULL,
  `register_username` varchar(50) NOT NULL,
  `register_password` varchar(50) NOT NULL,
  `user_type` enum('Outpatient','Cashier','Information Desk Officer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_user`
--

INSERT INTO `register_user` (`register_ID`, `register_lastname`, `register_firstname`, `register_username`, `register_password`, `user_type`) VALUES
(4, 'Ringcunada', 'Jeniel', 'jeniel@gmail.com', 'jeniel12345', 'Outpatient'),
(5, 'Virador', 'John', 'john@gmail.com', 'john12345', 'Information Desk Officer'),
(6, 'Cena', 'John', 'cena@gmail.com', 'cena12345', 'Cashier'),
(18, 'Gojo', 'Kun', 'kun@gmail.com', 'kun12345', 'Outpatient');

-- --------------------------------------------------------

--
-- Table structure for table `request_form`
--

CREATE TABLE `request_form` (
  `request_ID` int(11) NOT NULL,
  `request_lastname` varchar(50) NOT NULL,
  `request_firstname` varchar(50) NOT NULL,
  `request_gender` varchar(10) NOT NULL,
  `request_birthdate` date NOT NULL,
  `request_age` int(2) NOT NULL,
  `request_province` varchar(255) NOT NULL,
  `request_city` varchar(255) NOT NULL,
  `request_barangay` varchar(50) NOT NULL,
  `request_purok` varchar(50) NOT NULL,
  `request_phone` varchar(11) NOT NULL,
  `request_test` varchar(250) NOT NULL,
  `request_status` enum('Pending','Approved','Reject','') NOT NULL DEFAULT 'Pending',
  `request_date` date NOT NULL DEFAULT current_timestamp(),
  `request_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_form`
--

INSERT INTO `request_form` (`request_ID`, `request_lastname`, `request_firstname`, `request_gender`, `request_birthdate`, `request_age`, `request_province`, `request_city`, `request_barangay`, `request_purok`, `request_phone`, `request_test`, `request_status`, `request_date`, `request_amount`) VALUES
(83, 'Virador', ' bernie', ' Male', '2000-04-22', 23, ' Davao del Norte', 'Municipality of Kapalong', 'Maniki (Poblacion)', '12', '09304783241', '', 'Pending', '2023-09-20', 0),
(84, 'Virador', ' bernie', ' Male', '2000-02-22', 23, ' Davao del Norte', 'City of Panabo', 'Maduao', '1', '09304783241', '', 'Pending', '2023-09-20', 0),
(85, 'Virador', ' jeniel', ' Male', '2000-02-22', 23, ' Davao del Norte', 'Municipality of Sto. Tomas', 'Tibal-og', '1', '09304783241', '', 'Pending', '2023-09-20', 0),
(86, 'Virador', ' bernie', ' Male', '2000-02-22', 23, ' Davao del Norte', 'Municipality of Asuncion', 'Magatos', '1', '09304783241', '', 'Approved', '2023-09-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_offered`
--

CREATE TABLE `service_offered` (
  `id` int(11) NOT NULL,
  `Test` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_offered`
--

INSERT INTO `service_offered` (`id`, `Test`, `Price`) VALUES
(1, 'CBC', 100),
(2, 'Hemoglobin', 200),
(3, 'Platelet Count', 300),
(4, 'Blood Typing', 400),
(5, 'HBsAG', 500),
(6, 'VDRL/Syphilis', 600),
(7, 'HA1c  ', 700),
(8, 'TSH    ', 800),
(9, 'T3', 900),
(10, 'URINE ANALYSIS', 1000),
(11, 'Fecalysis', 1100),
(12, 'FBS', 1200),
(13, 'RBS', 1300),
(14, 'LIPID PROFILE', 1400),
(15, 'CHOLESTEROL', 1500),
(16, 'SUA', 1600),
(17, 'GREATININE', 1700),
(18, 'SGPT/ALT ', 1800),
(19, 'SGOT/AST   ', 1900),
(20, 'BUN', 2000),
(21, 'ELECTROLYTES', 2100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_ID`);

--
-- Indexes for table `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_ID`);

--
-- Indexes for table `request_form`
--
ALTER TABLE `request_form`
  ADD PRIMARY KEY (`request_ID`);

--
-- Indexes for table `service_offered`
--
ALTER TABLE `service_offered`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `request_form`
--
ALTER TABLE `request_form`
  MODIFY `request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `service_offered`
--
ALTER TABLE `service_offered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
