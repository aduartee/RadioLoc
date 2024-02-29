
USE radioloc

-- Table structure for table `movementhistory`
CREATE TABLE `movementhistory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipmentId` int DEFAULT NULL,
  `newLocation` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int DEFAULT '1',
  `movementType` varchar(255) DEFAULT NULL,
  `fromCustomer` int DEFAULT NULL,
  `toCustomer` int DEFAULT NULL,
  `equipamentSituation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `equipmentId` (`equipmentId`)
);

-- Table structure for table `equipment`
CREATE TABLE `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `clientName` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serialNumber` varchar(255) DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `additionalNotes` text,
  `lastMovement` date DEFAULT NULL,
  `customerID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer` (`customerID`)
);

-- Table structure for table `customer`
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customerName` varchar(255) DEFAULT NULL,
  `equipamentNumber` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lastMovement` varchar(255) DEFAULT NULL,
  `itemID` int DEFAULT NULL,
  `status` int DEFAULT '1',
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipment` (`itemID`)
);


