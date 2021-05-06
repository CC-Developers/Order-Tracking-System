-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2014 at 02:45 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `awots`
--

-- --------------------------------------------------------

--
-- Table structure for table `cbn_audit`
--

CREATE TABLE IF NOT EXISTS `cbn_audit` (
  `IdAudit` int(21) NOT NULL AUTO_INCREMENT,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `AuditContent` text NOT NULL,
  PRIMARY KEY (`IdAudit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_phase`
--

CREATE TABLE IF NOT EXISTS `cbn_phase` (
  `PhaseId` int(3) NOT NULL AUTO_INCREMENT,
  `PhaseName` varchar(100) NOT NULL,
  `PhaseColor` varchar(255) NOT NULL,
  `PhaseOrder` int(11) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`PhaseId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_phase`
--

INSERT INTO `cbn_phase` (`PhaseId`, `PhaseName`, `PhaseColor`, `PhaseOrder`, `IsActive`, `CreatedDate`, `CreatedUser`, `LastUpdateDate`, `LastUpdateUser`) VALUES
(1, 'Planned', '#ffb700', 1, 1, '2014-08-09 03:00:00', 1, '2014-09-04 22:46:04', 'Comestoarra Labs');

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tclients`
--

CREATE TABLE IF NOT EXISTS `cbn_tclients` (
  `IdClient` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(255) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MailingAddress` longtext NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `CellPhone` varchar(200) NOT NULL,
  `Notes` text NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `LastLoginDate` datetime NOT NULL,
  `LastLoginIp` varchar(100) NOT NULL,
  `IsLogin` int(3) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `isArchived` int(3) NOT NULL,
  `archiveDate` date NOT NULL,
  PRIMARY KEY (`IdClient`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_tclients`
--

INSERT INTO `cbn_tclients` (`IdClient`, `FullName`, `Username`, `Password`, `Email`, `MailingAddress`, `Phone`, `CellPhone`, `Notes`, `ProfilePicture`, `IsActive`, `LastUpdateDate`, `LastUpdateUser`, `LastLoginDate`, `LastLoginIp`, `IsLogin`, `CreatedDate`, `CreatedUser`, `isArchived`, `archiveDate`) VALUES
(1, 'Client', 'client', '$2y$12$2g8s2gVGhcJoz1jKY6SZy.8NUNKT7j4ORkBOQ6ELqeN.szlcThcnq', 'client@mail.com', 'Bandung', '087824280960', '08562233262', 'Notes', 'rizkiwisnuaji.jpg', 1, '2014-09-11 19:45:02', 'Comestoarra Labs', '2014-09-11 19:45:19', '127.0.0.1', 0, '2014-08-06 02:00:00', 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tcurrency`
--

CREATE TABLE IF NOT EXISTS `cbn_tcurrency` (
  `CurrencyId` int(3) NOT NULL AUTO_INCREMENT,
  `CurrencyName` varchar(100) NOT NULL,
  `CurrencySymbol` varchar(255) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`CurrencyId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cbn_tcurrency`
--

INSERT INTO `cbn_tcurrency` (`CurrencyId`, `CurrencyName`, `CurrencySymbol`, `IsActive`, `CreatedDate`, `CreatedUser`, `LastUpdateDate`, `LastUpdateUser`) VALUES
(1, 'Indonesian Rupiah', 'IDR', 1, '2014-08-01 04:00:00', 1, '2014-09-09 00:05:13', 'Comestoarra Labs'),
(2, 'US Dollar', '$', 1, '2014-08-14 10:37:04', 1, '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tinvoiceitems`
--

CREATE TABLE IF NOT EXISTS `cbn_tinvoiceitems` (
  `ItemId` int(11) NOT NULL AUTO_INCREMENT,
  `IdClient` int(11) NOT NULL,
  `IdProject` int(11) NOT NULL,
  `invoiceId` int(11) NOT NULL,
  `ItemTitle` varchar(255) NOT NULL,
  `ItemDesc` varchar(255) NOT NULL,
  `ItemQty` double NOT NULL,
  `ItemAmount` double NOT NULL,
  `ItemTotalAmount` double NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`ItemId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tmailbox`
--

CREATE TABLE IF NOT EXISTS `cbn_tmailbox` (
  `IdMail` int(5) NOT NULL AUTO_INCREMENT,
  `SenderId` int(5) NOT NULL DEFAULT '0',
  `ReceiverId` int(5) NOT NULL DEFAULT '0',
  `MailTitle` varchar(255) NOT NULL,
  `MailContent` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sentDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isRead` int(1) NOT NULL DEFAULT '0',
  `isArchived` int(1) NOT NULL DEFAULT '0',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `DeletedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastUpdatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`IdMail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectattachment`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectattachment` (
  `IdAttachment` int(11) NOT NULL AUTO_INCREMENT,
  `IdProject` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `AttachmentTitle` varchar(255) NOT NULL,
  `AttachmentNotes` text NOT NULL,
  `AttachmentType` varchar(255) NOT NULL,
  `AttachmentSize` varchar(255) NOT NULL,
  `AttachmentUrl` varchar(255) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdAttachment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectfinances`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectfinances` (
  `IdFinance` int(11) NOT NULL AUTO_INCREMENT,
  `IdProject` int(11) NOT NULL,
  `FinanceTitle` varchar(255) NOT NULL,
  `FinanceDesc` varchar(255) NOT NULL,
  `FinanceType` varchar(100) NOT NULL,
  `FinanceAmount` varchar(50) NOT NULL,
  `FinanceDate` date NOT NULL,
  `FinanceNotes` text NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdFinance`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectinvoices`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectinvoices` (
  `invoiceId` int(21) NOT NULL AUTO_INCREMENT,
  `IdClient` int(11) NOT NULL,
  `IdProject` int(11) NOT NULL,
  `invoiceNumber` varchar(155) NOT NULL,
  `invoiceClientReference` varchar(255) NOT NULL,
  `invoiceCompanyReference` varchar(255) NOT NULL,
  `invoiceDate` date NOT NULL,
  `invoiceDueDate` date NOT NULL,
  `invoiceCurrency` int(3) NOT NULL,
  `invoiceSubtotal` double NOT NULL,
  `invoiceTax` double NOT NULL,
  `invoiceTotalPaid` double NOT NULL,
  `invoiceTotalDue` double NOT NULL,
  `invoiceNote` text NOT NULL,
  `invoiceTaxRate` double NOT NULL,
  `invoiceClientAddress` text NOT NULL,
  `invoiceAddress` text NOT NULL,
  `invoiceStatus` int(1) NOT NULL DEFAULT '0',
  `isSync` int(1) NOT NULL,
  `isGenerated` int(1) NOT NULL,
  `IsCompleted` int(3) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`invoiceId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectmember`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectmember` (
  `IdMember` int(11) NOT NULL AUTO_INCREMENT,
  `IdProject` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `RoleId` int(3) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdMember`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectpayments`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectpayments` (
  `IdPayment` int(11) NOT NULL AUTO_INCREMENT,
  `IdClient` int(11) NOT NULL,
  `IdProject` int(11) NOT NULL,
  `invoiceId` int(21) NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `paymentAmount` varchar(50) NOT NULL,
  `paymentNotes` text NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`IdPayment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojects`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojects` (
  `IdProject` int(11) NOT NULL AUTO_INCREMENT,
  `IdClient` int(11) NOT NULL,
  `TypeId` int(5) NOT NULL,
  `ProjectProgress` int(3) NOT NULL,
  `ProjectStatus` int(3) NOT NULL,
  `ProjectCurrency` int(3) NOT NULL,
  `ProjectNotes` longtext NOT NULL,
  `ProjectStart` date NOT NULL,
  `ProjectDeadline` date NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `isArchived` int(3) NOT NULL,
  `archiveDate` date NOT NULL,
  `IsComplete` int(3) NOT NULL,
  PRIMARY KEY (`IdProject`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_tprojects`
--

INSERT INTO `cbn_tprojects` (`IdProject`, `IdClient`, `TypeId`, `ProjectProgress`, `ProjectStatus`, `ProjectCurrency`, `ProjectNotes`, `ProjectStart`, `ProjectDeadline`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`, `isArchived`, `archiveDate`, `IsComplete`) VALUES
(1, 1, 1, 0, 1, 1, 'Notes', '2014-09-10', '2014-09-19', '0000-00-00 00:00:00', '', '2014-09-10 20:22:21', 1, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojectschedule`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojectschedule` (
  `IdSchedule` int(11) NOT NULL AUTO_INCREMENT,
  `IdProject` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `ScheduleDesc` varchar(255) NOT NULL,
  `ScheduleTimeStart` varchar(10) NOT NULL,
  `ScheduleTimeEnd` varchar(10) NOT NULL,
  `ScheduleDueDate` date NOT NULL,
  `ScheduleNotes` text NOT NULL,
  `IsFinish` int(3) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdSchedule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tprojecttask`
--

CREATE TABLE IF NOT EXISTS `cbn_tprojecttask` (
  `IdTask` int(11) NOT NULL AUTO_INCREMENT,
  `IdProject` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `TaskDesc` varchar(255) NOT NULL,
  `TaskDate` date NOT NULL,
  `TaskDueDate` date NOT NULL,
  `TaskNotes` text NOT NULL,
  `TaskProgress` int(3) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdTask`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_tprojecttask`
--

INSERT INTO `cbn_tprojecttask` (`IdTask`, `IdProject`, `IdClient`, `TaskDesc`, `TaskDate`, `TaskDueDate`, `TaskNotes`, `TaskProgress`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`) VALUES
(1, 1, 1, 'Contract', '2014-09-10', '2014-09-30', 'Contract', 0, '0000-00-00 00:00:00', '', '2014-09-10 20:22:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbn_trequests`
--

CREATE TABLE IF NOT EXISTS `cbn_trequests` (
  `IdRequest` int(11) NOT NULL AUTO_INCREMENT,
  `IdClient` int(11) NOT NULL,
  `TypeId` int(5) NOT NULL,
  `ProjectCurrency` int(3) NOT NULL,
  `ProjectNotes` longtext NOT NULL,
  `ProjectStart` date NOT NULL,
  `ProjectDeadline` date NOT NULL,
  `RequestStatus` int(1) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdRequest`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_trequests`
--

INSERT INTO `cbn_trequests` (`IdRequest`, `IdClient`, `TypeId`, `ProjectCurrency`, `ProjectNotes`, `ProjectStart`, `ProjectDeadline`, `RequestStatus`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`) VALUES
(1, 1, 1, 1, 'Notes', '2014-09-10', '2014-09-30', 0, '0000-00-00 00:00:00', '', '2014-09-10 21:37:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbn_trole`
--

CREATE TABLE IF NOT EXISTS `cbn_trole` (
  `RoleId` int(3) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(100) NOT NULL,
  `RoleDesc` varchar(255) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `GeneralEdit` int(10) DEFAULT NULL,
  `TaskView` int(10) DEFAULT NULL,
  `TaskCreate` int(10) DEFAULT NULL,
  `TaskEdit` int(10) DEFAULT NULL,
  `TaskDelete` int(10) DEFAULT NULL,
  `ScheduleView` int(10) DEFAULT NULL,
  `ScheduleCreate` int(10) DEFAULT NULL,
  `ScheduleEdit` int(10) DEFAULT NULL,
  `ScheduleDelete` int(10) DEFAULT NULL,
  `MemberView` int(10) NOT NULL,
  `MemberCreate` int(10) NOT NULL,
  `MemberEdit` int(10) NOT NULL,
  `MemberDelete` int(10) NOT NULL,
  `FinanceView` int(10) NOT NULL,
  `FinanceCreate` int(10) NOT NULL,
  `FinanceEdit` int(10) NOT NULL,
  `FinanceDelete` int(10) NOT NULL,
  `AttachmentView` int(10) NOT NULL,
  `AttachmentCreate` int(10) NOT NULL,
  `AttachmentEdit` int(10) NOT NULL,
  `AttachmentDelete` int(10) NOT NULL,
  `InvoiceView` int(10) NOT NULL,
  `InvoiceCreate` int(10) NOT NULL,
  `InvoiceEdit` int(10) NOT NULL,
  `InvoiceDelete` int(10) NOT NULL,
  `InvoiceGenerate` int(10) NOT NULL,
  `InvoiceSendMail` int(10) NOT NULL,
  `PaymentCreate` int(10) NOT NULL,
  `PaymentEdit` int(10) NOT NULL,
  `PaymentDelete` int(10) NOT NULL,
  `ItemCreate` int(10) NOT NULL,
  `ItemEdit` int(10) NOT NULL,
  `ItemDelete` int(10) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tsettings`
--

CREATE TABLE IF NOT EXISTS `cbn_tsettings` (
  `settingsId` int(3) NOT NULL AUTO_INCREMENT,
  `appUrl` varchar(100) NOT NULL,
  `appName` varchar(255) NOT NULL,
  `ownerName` varchar(255) NOT NULL,
  `ownerAddress` longtext NOT NULL,
  `ownerEmail` varchar(255) NOT NULL,
  `ownerPhone` varchar(255) NOT NULL,
  `uploadPath` varchar(255) NOT NULL,
  `filesAllowed` varchar(255) NOT NULL,
  `AppLogo` varchar(255) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  PRIMARY KEY (`settingsId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_tsettings`
--

INSERT INTO `cbn_tsettings` (`settingsId`, `appUrl`, `appName`, `ownerName`, `ownerAddress`, `ownerEmail`, `ownerPhone`, `uploadPath`, `filesAllowed`, `AppLogo`, `LastUpdateDate`, `LastUpdateUser`) VALUES
(1, 'http://localhost/awots/', 'Advanced Work Order Tracking System  V.1.1', 'Comestoarra Labs, Inc.', 'Jalan Titimplik No.25, Bandung, West Java, Indonesia, 40133', 'labs@comestoarra.com', '087824280960', 'uploads/workorders/', 'jpg,pdf,doc,xls,psd,ppt', 'Comestoarra.jpg', '2014-09-10 20:44:25', 'Comestoarra Labs');

-- --------------------------------------------------------

--
-- Table structure for table `cbn_tuser`
--

CREATE TABLE IF NOT EXISTS `cbn_tuser` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) NOT NULL,
  `MailingAddress` text NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `CellPhone` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `IsActive` char(1) NOT NULL,
  `Level` char(1) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastLoginIP` varchar(100) NOT NULL,
  `IsLogin` int(3) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_tuser`
--

INSERT INTO `cbn_tuser` (`IdUser`, `FullName`, `MailingAddress`, `Phone`, `CellPhone`, `Email`, `IsActive`, `Level`, `Username`, `Password`, `ProfilePicture`, `LastLogin`, `LastLoginIP`, `IsLogin`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`) VALUES
(1, 'Comestoarra Labs', 'Jl. Titimplik No.25, bandung, West Java, Indonesia, 40133', '0222506902', '087824280960', 'labs@comestoarra.com', '1', '1', 'admin', '$2y$12$HHLTORAMkkUQ4zRxXG4obOMNXmyPqMjXBAvJp4rQODV5f6uCNgvGO', 'admin.jpg', '2014-09-11 19:44:03', '127.0.0.1', 0, '2014-09-10 21:23:42', 'Comestoarra Labs', '2014-08-01 05:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbn_twotype`
--

CREATE TABLE IF NOT EXISTS `cbn_twotype` (
  `TypeId` int(5) NOT NULL AUTO_INCREMENT,
  `TypeTitle` varchar(255) NOT NULL,
  `TypeCode` varchar(100) NOT NULL,
  `TypeDesc` longtext NOT NULL,
  `IsActive` int(1) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`TypeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cbn_twotype`
--

INSERT INTO `cbn_twotype` (`TypeId`, `TypeTitle`, `TypeCode`, `TypeDesc`, `IsActive`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`) VALUES
(1, 'Web Development', '1001', 'Web Development', 1, '0000-00-00 00:00:00', '', '2014-09-10 20:22:01', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
