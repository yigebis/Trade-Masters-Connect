<?php

//connect to the db
require('createConn.php');

//create customer table
$sql = "CREATE TABLE `customer` (
    `UserName` VARCHAR(30) NOT NULL,
    `First Name` VARCHAR(30) NOT NULL,
    `Father Name` VARCHAR(30) NOT NULL,
    `Grand Father Name` VARCHAR(30) NOT NULL,
    `Gender` CHAR(1) NOT NULL,
    `DOB` DATE DEFAULT NULL,
    `Phone Number` VARCHAR(13) DEFAULT NULL,
    `Photo Link` VARCHAR(50) DEFAULT NULL,
    `Email` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$conn -> query($sql);

//create technician table

$sql = "CREATE TABLE `technician` (
    `UserName` VARCHAR(30) NOT NULL,
    `First Name` VARCHAR(30) NOT NULL,
    `Father Name` VARCHAR(30) NOT NULL,
    `Grand Father Name` VARCHAR(30) NOT NULL,
    `Gender` CHAR(1) NOT NULL,
    `DOB` DATE NOT NULL,
    `Phone Number` VARCHAR(13) NOT NULL,
    `Email` VARCHAR(50) NOT NULL,
    `Work Address` VARCHAR(50) NOT NULL,
    `Photo` VARCHAR(50) NOT NULL,
    `Identifier Link` VARCHAR(50) NOT NULL,
    `Bio` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$conn -> query($sql);

//create skill table
$sql = "CREATE TABLE `skill` (
  `Title` varchar(30) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$conn -> query($sql);

//create customer_credentials table
$sql = "CREATE TABLE `customer_credentials` (
  `UserName` varchar(30) NOT NULL,
  `PassHash` varchar(255) NOT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$conn -> query($sql);

//create technician_credentials table
$sql = "CREATE TABLE technician_credentials (
    UserName VARCHAR(30) NOT NULL,
    PassHash VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$conn -> query($sql);

//create technician_skill table
$sql = "CREATE TABLE technician_skill (
    TechUserName VARCHAR(30) NOT NULL,
    SkillTitle VARCHAR(30) NOT NULL,
    Experience INT(11) NOT NULL,
    Rating float NOT NULL,
    RatedBy INT NOT NULL DEFAULT '0',
    CertificateLink VARCHAR(50) NOT NULL,
    PRIMARY KEY (`TechUserName`, `SkillTitle`),
    FOREIGN KEY (`TechUserName`) REFERENCES `technician` (`UserName`),
    FOREIGN KEY (`SkillTitle`) REFERENCES `skill` (`Title`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
$conn -> query($sql);

//create request table
$sql = "CREATE TABLE `requests` (
    `TechUserName` VARCHAR(30) NOT NULL,
    `CustUserName` VARCHAR(30) NOT NULL,
    `Skill Title` VARCHAR(30) NOT NULL,
    `Location` VARCHAR(255) NOT NULL,
    `Description` VARCHAR(255) NOT NULL,
    `Rating` INT(11) DEFAULT NULL,
    `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `Status` CHAR(1) NOT NULL,
    `CustSeen` VARCHAR(1) NOT NULL DEFAULT 'N',
    `TechSeen` VARCHAR(1) NOT NULL DEFAULT 'N',
    PRIMARY KEY (`TechUserName`, `CustUserName`, `Skill Title`, `Date`),
    FOREIGN KEY (`TechUserName`) REFERENCES `Technician` (`UserName`),
    FOREIGN KEY (`CustUserName`) REFERENCES `Customer` (`UserName`),
    FOREIGN KEY (`Skill Title`) REFERENCES `Skill` (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$conn -> query($sql);

?>