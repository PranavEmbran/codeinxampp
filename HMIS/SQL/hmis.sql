-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 02:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Userid` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Userid`, `Password`) VALUES
('HemaP', '123'),
('PranavES', '123'),
('SivaDE', '123');

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

CREATE TABLE `patientdetails` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `gender` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientdetails`
--

INSERT INTO `patientdetails` (`id`, `firstname`, `lastname`, `age`, `phoneno`, `gender`) VALUES
(9, 'Hema', 'Ammal', 55, '9877654332', 'F'),
(10, 'Vignesh', 'Sharma', 33, '8947563829', 'M'),
(11, 'Parthasarathi', 'Sharma', 45, '3465789654', 'M'),
(13, 'Gopal', 'Krishna', 55, '1265347833', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `visitdetails`
--

CREATE TABLE `visitdetails` (
  `id` int(11) NOT NULL,
  `Patient_id` int(11) NOT NULL,
  `Reason_for_visit` text NOT NULL,
  `Discharge_status` varchar(15) NOT NULL,
  `IP_OP` varchar(5) NOT NULL,
  `Consultation_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Procedure_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Lab_charge` decimal(10,2) NOT NULL,
  `Equipment_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Medicine_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Room_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Miscellaneous_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Visit_Date` date NOT NULL,
  `Bill_Date` date DEFAULT NULL,
  `Total_amount` decimal(10,2) GENERATED ALWAYS AS (`Consultation_fee` + `Procedure_charge` + `Equipment_charge` + `Medicine_charge` + `Room_charge` + `Lab_charge` + `Miscellaneous_charge`) STORED,
  `Payed_amount` decimal(10,2) DEFAULT NULL,
  `Payable_amount` decimal(10,2) GENERATED ALWAYS AS (`Total_amount` - coalesce(`Payed_amount`,0)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitdetails`
--

INSERT INTO `visitdetails` (`id`, `Patient_id`, `Reason_for_visit`, `Discharge_status`, `IP_OP`, `Consultation_fee`, `Procedure_charge`, `Lab_charge`, `Equipment_charge`, `Medicine_charge`, `Room_charge`, `Miscellaneous_charge`, `Visit_Date`, `Bill_Date`, `Payed_amount`) VALUES
(31, 9, 'Headache', 'Active', 'OP', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2025-04-21', NULL, NULL),
(33, 11, 'Fever', 'Discharged', 'IP', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2025-04-21', NULL, NULL),
(34, 10, 'Headache', 'Active', 'OP', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2025-04-22', '2025-04-22', '0.00'),
(36, 11, 'Nausea', 'Discharged', 'OP', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2025-04-20', NULL, NULL),
(38, 13, 'Headache', 'Active', 'OP', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2025-04-22', NULL, NULL),
(39, 10, 'Legache', 'Active', 'OP', '100.00', '0.00', '100.00', '0.00', '0.00', '0.00', '0.00', '2025-04-22', '2025-04-22', '50.00'),
(40, 13, 'Nausea', 'Active', 'OP', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '150.00', '2025-04-23', '2025-04-22', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Userid`);

--
-- Indexes for table `patientdetails`
--
ALTER TABLE `patientdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitdetails`
--
ALTER TABLE `visitdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Patient_id` (`Patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patientdetails`
--
ALTER TABLE `patientdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visitdetails`
--
ALTER TABLE `visitdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visitdetails`
--
ALTER TABLE `visitdetails`
  ADD CONSTRAINT `visitdetails_ibfk_1` FOREIGN KEY (`Patient_id`) REFERENCES `patientdetails` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
