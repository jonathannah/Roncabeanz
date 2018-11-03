-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2018 at 11:46 PM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Roncabeanz`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `customerId` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `addrId` int(11) NOT NULL,
  `streetAddress` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `apt` varchar(8) COLLATE utf8mb4_bin NOT NULL,
  `City` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `State` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zipCode` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `phoneNumber` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Coffee`
--

CREATE TABLE `Coffee` (
  `productCode` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `units` varchar(6) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `viewCount` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(120) COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `Coffee`
--

INSERT INTO `Coffee` (`productCode`, `name`, `country`, `price`, `units`, `description`, `viewCount`, `thumbnail`) VALUES
(0, 'Agaro Duromina Cooperative', 'Ethiopia', '6.75', 'Lbs', 'Duromina has an intense cup profile at a wide range of roasts, honey sweetness accented by notes of peach and nectarine, orange marmalade, fruit-infused green tea, a kaffir lime floral aroma, and so much more. City to Full City. Good for espresso.', 4, 'ethiopia-agaro-duromina-cooperative-coffee-8.jpg'),
(1, 'Don Oscar La Montaña', 'Costa Rica', '6.60', 'Lbs', 'Mouth pleasing brilliance like lemon-herb tea, simple raw sugar backdrop helping understated notes of raisin, walnut, and dried apple stand out. Toasted graham finish. City to Full City+.', 11, 'CostaRicaDonOscarLaMontaña.jpg'),
(2, 'Dry Process Ranaka Robusta', 'Flores', '9.31', 'Lbs', 'Robusta is a wild ride compared to even your most basic Arabica coffee. It\'s bittering, has flavors of unsweetened cocoa and almond powder, roasted barley tea, and any sweetness little more than accents. In many ways it\'s the inverse of our other offers! But it\'s one of the best Robustas we\'ve seen in a while, and an example of what good processing practices and cherry selection can bring to the cup. City+ to Vienna. Good for blending.', 14, 'FloresDryProcessRanakaRobusta.jpg'),
(3, 'Guji Shakiso Sewana Site', 'Ethiopia', '6.70', 'Lbs', 'Light roasts of Sewana Site have archetypal \"Guji\" flavors: strong jasmine florals, black tea notes, and citrus hints. Acidity is mouthcleansing, the finish marked by mango tea, berry, and passion fruit. City to City+.', 13, 'EthiopiaGujiShakisoSewanaSite.jpg'),
(4, 'Inzá Las Estrellas', 'Colombia', '6.65', 'Lbs', 'Las Estrellas shines bright with fruited vibrance, base flavors from raw honey to fresh cane juice, hints of golden raisin, white grape and apple juices. Mild dark chocolate and mulling spice notes accent the finish. City to Full City+. Good for espresso.', 13, 'colombia-inza-cauca-coffee-asorcafe-14.jpg'),
(5, 'Nyeri Ichamama AA', 'Kenya', '7.95', 'Lbs', 'Complex, dessert-type coffee; red fruit punch, pineapple, orange, and berry juices, as well as hints of raspberry, cherry, passion fruit, and guava. Intense Kenya AA and best kept to lighter roasting. City to City+.', 13, 'KenyaNyeriIchamamaAA.jpg'),
(6, 'Ratnagiri Pearl Mountain Peaberry', 'India', '5.60', 'Lbs', 'Sweet/savory, and bittersweet aspects are at the core of this PB. Dark cacao and baking cocoa, hazelnut chocolate, burned sugar, Thai basil, and opaque body. City+ to Full City+. Good espresso.', 10, 'India_Ratnagiri_Pearl_Mountain_Peaberry.jpg'),
(7, 'Karongi Nyarubuye Station', 'Rwanda', '6.10', 'Lbs', 'The coffee exhibits a sound base of dark sugary sweetness from aromatics on into the brewed coffee, almond brittle candy, caramel pudding, cardamom spice, and aromatic wood. City+ to Full City.', 2, 'rwanda-kivu-karongi-nyarubuye-coffee-7.jpg'),
(8, 'Dry Process Shakiso Kayon', 'Ethiopia', '6.95', 'Lbs', 'Kayon natural is brimming with fruited notes of raspberry, blackberry, blueberry, dried tamarind and cherry, and a honeysuckle aroma. I\'d be remiss if I didn\'t mention cocoa powder too, the level of which is determined by roast degree. City to Full City+. Good for espresso.', 0, 'ethiopia-guji-coffee-kayon-mountain-farm-5.jpg'),
(9, 'Kiganda Murambi Lot #2187\r\n', 'Burundi', '6.00', 'Lbs', 'Murambi is a medium bodied cup, with mouth-cleansing aciity, undertones of raw sugars, and pressed cane juice, and top notes of black currant, red apple, and spiced finish. Really sweet and complex from City to Full City roast levels.', 2, 'burundi-kiganda-murambi-coffee-10_1.jpg'),
(10, 'Murang\'a Mutitu AA - 1 & 2 LB Only', 'Kenya', '7.85', 'Lbs', 'Fruited aspects shape shift from tropical mango and black plum, to citrus flavors like pink grapefruit and lemon grass. Slightly carbonized sugars and spice cookies accent the finish. A vibrant cup. City to City+.', 0, 'kenya-coffee-muraga-mutitu-3_1.jpg'),
(11, 'Organic Belen La Lesquiñada', 'Honduras', '6.15', 'Lbs', 'Middle roasts have balanced sweetness, with raisin, cardamom, herbal, and almond notes, and soft acidity. Full City harnesses a mix of high % cacao bar and a tropical fruit accent. City+ to Full City+. Good for espresso. ', 0, 'honduras-coffee-corquin-lesquinada-1.jpg'),
(13, 'Mbozi Nonde Station', 'Tanzania', '5.90', 'Lbs', 'Malt and grain notes are balaced by rustic palm sugar sweetness at City+, with savory roasted barley, green tea, and an interesting pumpernickel note in the finish. Chocolatey bittersweet with darker roasting. City+ to Full City. Good for espresso.', 3, 'tanzania-mbozi-mbeya-general-coffee-4_1.jpg'),
(14, 'Sunda Gunung Jaladri', 'Java', '6.95', 'Lbs', ' Jaladri is such a clean tasting Javanese coffee, with inky body at all roasts, toffee sweetness, and capable of heavy chocolate roast tone. Top notes of dried apple, chopped date, and walnut. City to Full City+. Good for espresso.', 3, 'java-coffee-sunda-8.jpg'),
(15, 'Nariño Rio Juanambú', 'Colombia', '5.90', 'Lbs', 'A crowd pleasing, bittersweet cup at a wide roast range. Buttery toffee, caramel coated almond, coffee cake crumble, loads of bittersweet cocoa, and an apple/malic impression. City+ to Full City+. Good for espresso.', 2, 'colombia-narino-rio-juanambu-1_3.jpg'),
(16, 'Dipilto Finca La Laguna', 'Nicaragua', '5.85', 'Lbs', 'Unrefined sugars and roasted nut flavors are core aspects of La Laguna, flavors of sweetened peanut butter, molasses drizzled almonds, and a bittersweet cocoa counterpoint. Full City to Full City+. Good for espresso.', 1, 'nicaragua-dipilto-coffee-la-laguna-6.jpg'),
(17, 'Mokha Matari', 'Arabia', '9.75', 'Lbs', 'Leather, tobacco, savory herbs, chicory root, and more, with glimpses of dried mango and overripe apple, and an interesting tamarind note. Full City has dark grape & high% cacao bar. City+ to Full City+. Best with rest. Good for espresso.', 4, 'yemen-gart-harazi-coffee-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `name` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `region` varchar(32) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`name`, `region`) VALUES
('Burundi', 'Africa'),
('Ethiopia', 'Africa'),
('Kenya', 'Africa'),
('Rwanda', 'Africa'),
('Tanzania', 'Africa'),
('Uganda', 'Africa'),
('Arabia', 'Asia'),
('India', 'Asia'),
('Costa Rica', 'Central America'),
('Guatamala', 'Central America'),
('Honduras', 'Central America'),
('Mexico', 'Central America'),
('Nicaragua', 'Central America'),
('Flores', 'Indonesia & SE Asia'),
('Java', 'Indonesia & SE Asia'),
('Mayanmar', 'Indonesia & SE Asia'),
('Sumatra', 'Indonesia & SE Asia'),
('Brazil', 'South America'),
('Colombia', 'South America');

-- --------------------------------------------------------

--
-- Table structure for table `CustomerContactRequests`
--

CREATE TABLE `CustomerContactRequests` (
  `firstName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  `comments` varchar(1024) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `CustomerContactRequests`
--

INSERT INTO `CustomerContactRequests` (`firstName`, `lastName`, `email`, `comments`) VALUES
('Billybob', 'Bodine', 'Bodine@gmail.com', 'Man your coffee makes me happier than a pig in a mud puddle. Boy howdy shoot I reckon. '),
('Billy', 'Caffine', 'bc@gmail.com', 'I Love Coffee!'),
('David', 'R', 'jonnah@hotmail.com', 'Blah Bla'),
('Sara', 'GoodJoe', 'sgc@gmail.com', 'I am writing to let you know that your coffee is the best I have ever had.  I am telling all of my friends about Roncabeanz.  \r\n\r\nI was wondering if you have thought about Roncabeanz gift packs and gift cards.  With Christmas coming soon, I would love to give Roncabeanz to all of my friends and family. \r\n\r\nAnyway, just an idea.  Thanks for helping me to start my days well.  With great coffee.  Sara');

-- --------------------------------------------------------

--
-- Table structure for table `OrderItem`
--

CREATE TABLE `OrderItem` (
  `orderId` int(11) NOT NULL,
  `itemNumber` int(11) NOT NULL,
  `productCode` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `OrderItem`
--

INSERT INTO `OrderItem` (`orderId`, `itemNumber`, `productCode`, `quantity`, `price`) VALUES
(2, 0, 1, 1, 6.6),
(2, 1, 3, 1, 6.7),
(2, 2, 6, 1, 5.6),
(3, 0, 4, 1, 6.65),
(3, 1, 2, 1, 9.31),
(3, 2, 0, 1, 6.75),
(4, 0, 1, 1, 6.6),
(4, 1, 5, 1, 7.95),
(5, 0, 2, 1, 9.31),
(5, 1, 3, 1, 6.7);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `orderId` int(11) NOT NULL,
  `customerId` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`orderId`, `customerId`, `orderTime`) VALUES
(2, 'jqp@gmail.com', '2018-10-30 06:38:02'),
(3, 'jqp@gmail.com', '2018-11-01 03:32:08'),
(4, 'jqp@gmail.com', '2018-11-02 07:15:08'),
(5, 'imwired@roncabeanz.com', '2018-11-02 16:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `Region`
--

CREATE TABLE `Region` (
  `name` varchar(32) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Region`
--

INSERT INTO `Region` (`name`) VALUES
('Africa'),
('Asia'),
('Central America'),
('Indonesia & SE Asia'),
('South America');

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE `Team` (
  `Name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `EmailAddress` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `PhoneNumber` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`Name`, `EmailAddress`, `PhoneNumber`) VALUES
('David Ronca', 'david@roncabeanz.com', '4088675309'),
('I.M. Wired', 'im@roncabeanz.com', '4088675308');

-- --------------------------------------------------------

--
-- Table structure for table `Units`
--

CREATE TABLE `Units` (
  `unit_type` varchar(6) COLLATE utf8mb4_bin NOT NULL,
  `details` varchar(32) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Units`
--

INSERT INTO `Units` (`unit_type`, `details`) VALUES
('Lbs.', ''),
('Kg.', '');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `firstName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `emailAddress` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `groupID` enum('Administrator','Customer') COLLATE utf8mb4_bin DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`firstName`, `lastName`, `emailAddress`, `password`, `groupID`) VALUES
('Alfred', 'Bravo', 'ab@charlie.com', '123', 'Customer'),
('Billybob', 'Bodine', 'bbodine@gamil.com', 'password', 'Customer'),
('Billybob', 'Bodine', 'bbodine@gmail.com', 'password', 'Customer'),
('I.M.', 'Wired', 'imwired@roncabeanz.com', 'adminPassword', 'Administrator'),
('John Q', 'Public', 'jqp@gmail.com', 'password', 'Customer'),
('Nick', 'Caffeine', 'ncaffeine@gmail.com', 'freshroast', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`customerId`,`addrId`);

--
-- Indexes for table `Coffee`
--
ALTER TABLE `Coffee`
  ADD PRIMARY KEY (`productCode`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`name`),
  ADD KEY `region` (`region`);

--
-- Indexes for table `CustomerContactRequests`
--
ALTER TABLE `CustomerContactRequests`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `OrderItem`
--
ALTER TABLE `OrderItem`
  ADD PRIMARY KEY (`orderId`,`itemNumber`),
  ADD KEY `productCode` (`productCode`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`orderId`),
  ADD UNIQUE KEY `orderNumber` (`orderId`),
  ADD KEY `Orders_ibfk_1` (`customerId`);

--
-- Indexes for table `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`emailAddress`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Coffee`
--
ALTER TABLE `Coffee`
  ADD CONSTRAINT `Coffee_ibfk_1` FOREIGN KEY (`country`) REFERENCES `Country` (`name`);

--
-- Constraints for table `Country`
--
ALTER TABLE `Country`
  ADD CONSTRAINT `Country_ibfk_1` FOREIGN KEY (`region`) REFERENCES `Region` (`name`),
  ADD CONSTRAINT `Country_ibfk_2` FOREIGN KEY (`region`) REFERENCES `Region` (`name`);

--
-- Constraints for table `OrderItem`
--
ALTER TABLE `OrderItem`
  ADD CONSTRAINT `OrderItem_ibfk_3` FOREIGN KEY (`orderId`) REFERENCES `Orders` (`orderId`),
  ADD CONSTRAINT `OrderItem_ibfk_4` FOREIGN KEY (`productCode`) REFERENCES `Coffee` (`productCode`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `User` (`emailAddress`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
