-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2018 at 06:57 PM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.2.11

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
-- Table structure for table `Coffee`
--

CREATE TABLE `Coffee` (
  `productCode` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `viewCount` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(120) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `Coffee`
--

INSERT INTO `Coffee` (`productCode`, `name`, `country`, `price`, `description`, `viewCount`, `thumbnail`) VALUES
(0, 'Agaro Duromina Cooperative', 'Ethiopia', '6.75', 'Duromina has an intense cup profile at a wide range of roasts, honey sweetness accented by notes of peach and nectarine, orange marmalade, fruit-infused green tea, a kaffir lime floral aroma, and so much more. City to Full City. Good for espresso.', 10, 'ethiopia-agaro-duromina-cooperative-coffee-8.jpg'),
(1, 'Don Oscar La Montaña', 'Costa Rica', '6.60', 'Mouth pleasing brilliance like lemon-herb tea, simple raw sugar backdrop helping understated notes of raisin, walnut, and dried apple stand out. Toasted graham finish. City to Full City+.', 10, 'CostaRicaDonOscarLaMontaña.jpg'),
(2, 'Dry Process Ranaka Robusta', 'Flores', '9.31', 'Robusta is a wild ride compared to even your most basic Arabica coffee. It\'s bittering, has flavors of unsweetened cocoa and almond powder, roasted barley tea, and any sweetness little more than accents. In many ways it\'s the inverse of our other offers! But it\'s one of the best Robustas we\'ve seen in a while, and an example of what good processing practices and cherry selection can bring to the cup. City+ to Vienna. Good for blending.', 6, 'FloresDryProcessRanakaRobusta.jpg'),
(3, 'Guji Shakiso Sewana Site', 'Ethiopia', '6.70', 'Light roasts of Sewana Site have archetypal \"Guji\" flavors: strong jasmine florals, black tea notes, and citrus hints. Acidity is mouthcleansing, the finish marked by mango tea, berry, and passion fruit. City to City+.', 10, 'EthiopiaGujiShakisoSewanaSite.jpg'),
(4, 'Inzá Las Estrellas', 'Colombia', '6.65', 'Las Estrellas shines bright with fruited vibrance, base flavors from raw honey to fresh cane juice, hints of golden raisin, white grape and apple juices. Mild dark chocolate and mulling spice notes accent the finish. City to Full City+. Good for espresso.', 8, 'colombia-inza-cauca-coffee-asorcafe-14.jpg'),
(5, 'Nyeri Ichamama AA', 'Kenya', '7.95', 'Complex, dessert-type coffee; red fruit punch, pineapple, orange, and berry juices, as well as hints of raspberry, cherry, passion fruit, and guava. Intense Kenya AA and best kept to lighter roasting. City to City+.', 19, 'KenyaNyeriIchamamaAA.jpg'),
(6, 'Ratnagiri Pearl Mountain Peaberry', 'India', '5.60', 'Sweet/savory, and bittersweet aspects are at the core of this PB. Dark cacao and baking cocoa, hazelnut chocolate, burned sugar, Thai basil, and opaque body. City+ to Full City+. Good espresso.', 2, 'India_Ratnagiri_Pearl_Mountain_Peaberry.jpg'),
(7, 'Karongi Nyarubuye Station', 'Rwanda', '6.10', 'The coffee exhibits a sound base of dark sugary sweetness from aromatics on into the brewed coffee, almond brittle candy, caramel pudding, cardamom spice, and aromatic wood. City+ to Full City.', 17, 'rwanda-kivu-karongi-nyarubuye-coffee-7.jpg'),
(8, 'Dry Process Shakiso Kayon', 'Ethiopia', '6.95', 'Kayon natural is brimming with fruited notes of raspberry, blackberry, blueberry, dried tamarind and cherry, and a honeysuckle aroma. I\'d be remiss if I didn\'t mention cocoa powder too, the level of which is determined by roast degree. City to Full City+. Good for espresso.', 5, 'ethiopia-guji-coffee-kayon-mountain-farm-5.jpg'),
(9, 'Kiganda Murambi Lot #2187\r\n', 'Burundi', '6.00', 'Murambi is a medium bodied cup, with mouth-cleansing aciity, undertones of raw sugars, and pressed cane juice, and top notes of black currant, red apple, and spiced finish. Really sweet and complex from City to Full City roast levels.', 11, 'burundi-kiganda-murambi-coffee-10_1.jpg'),
(10, 'Murang\'a Mutitu AA - 1 & 2 LB Only', 'Kenya', '7.85', 'Fruited aspects shape shift from tropical mango and black plum, to citrus flavors like pink grapefruit and lemon grass. Slightly carbonized sugars and spice cookies accent the finish. A vibrant cup. City to City+.', 5, 'kenya-coffee-muraga-mutitu-3_1.jpg'),
(11, 'Organic Belen La Lesquiñada', 'Honduras', '6.15', 'Middle roasts have balanced sweetness, with raisin, cardamom, herbal, and almond notes, and soft acidity. Full City harnesses a mix of high % cacao bar and a tropical fruit accent. City+ to Full City+. Good for espresso. ', 10, 'honduras-coffee-corquin-lesquinada-1.jpg'),
(13, 'Mbozi Nonde Station', 'Tanzania', '5.90', 'Malt and grain notes are balaced by rustic palm sugar sweetness at City+, with savory roasted barley, green tea, and an interesting pumpernickel note in the finish. Chocolatey bittersweet with darker roasting. City+ to Full City. Good for espresso.', 45, 'tanzania-mbozi-mbeya-general-coffee-4_1.jpg'),
(14, 'Sunda Gunung Jaladri', 'Java', '6.95', ' Jaladri is such a clean tasting Javanese coffee, with inky body at all roasts, toffee sweetness, and capable of heavy chocolate roast tone. Top notes of dried apple, chopped date, and walnut. City to Full City+. Good for espresso.', 34, 'java-coffee-sunda-8.jpg'),
(15, 'Nariño Rio Juanambú', 'Colombia', '5.90', 'A crowd pleasing, bittersweet cup at a wide roast range. Buttery toffee, caramel coated almond, coffee cake crumble, loads of bittersweet cocoa, and an apple/malic impression. City+ to Full City+. Good for espresso.', 4, 'colombia-narino-rio-juanambu-1_3.jpg'),
(16, 'Dipilto Finca La Laguna', 'Nicaragua', '5.85', 'Unrefined sugars and roasted nut flavors are core aspects of La Laguna, flavors of sweetened peanut butter, molasses drizzled almonds, and a bittersweet cocoa counterpoint. Full City to Full City+. Good for espresso.', 20, 'nicaragua-dipilto-coffee-la-laguna-6.jpg'),
(17, 'Mokha Matari', 'Arabia', '9.75', 'Leather, tobacco, savory herbs, chicory root, and more, with glimpses of dried mango and overripe apple, and an interesting tamarind note. Full City has dark grape & high% cacao bar. City+ to Full City+. Best with rest. Good for espresso.', 38, 'yemen-gart-harazi-coffee-4.jpg');

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
('Bardolatry', 'Bardolatry', 'playaagotsmmail@aol.com', 'Ciao! That is an important offers offering for you.  Try and be our next winner. http://bit.ly/2J9HotF'),
('Sara', 'GoodJoe', 'sgc@gmail.com', 'I am writing to let you know that your coffee is the best I have ever had.  I am telling all of my friends about Roncabeanz.  \r\n\r\nI was wondering if you have thought about Roncabeanz gift packs and gift cards.  With Christmas coming soon, I would love to give Roncabeanz to all of my friends and family. \r\n\r\nAnyway, just an idea.  Thanks for helping me to start my days well.  With great coffee.  Sara');

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
  `streetAddress` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `apt` varchar(8) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zipCode` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `homePhone` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `cellPhonePhone` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `groupID` enum('Administrator','Customer') COLLATE utf8mb4_bin DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`firstName`, `lastName`, `emailAddress`, `password`, `streetAddress`, `apt`, `city`, `state`, `zipCode`, `homePhone`, `cellPhonePhone`, `groupID`) VALUES
('Alfred', 'Bravo', 'ab@charlie.com', '123', '1234 My Street', '', 'Anytown', 'CA', '95000', '4085551234', '4085551235', 'Customer'),
('Hannah', 'Pointe', 'balletgirl@gmail.com', 'blue18', '456 My Street', '', 'MyTowm', 'CA', '95032', '9045551212', '9045551213', 'Customer'),
('Billybob', 'Bodine', 'bbodine@gamil.com', 'password', '789 1st Ave', '', 'Georgetown', 'CA', '95648', '4155551212', '4155551213', 'Customer'),
('Wilma', 'Flinstone', 'cavewoman@aol.com', 'password', '1 Rocky Point Ave', '', 'Rocksberg', 'AZ', '87674', '4805551234', '4805551235', 'Customer'),
('Walter', 'White', 'chemnerd@gmail.com', 'password', '25Trailer Trash Way', '', 'Hicksville', 'AL', '46578', '2065558676', '2065558677', 'Customer'),
('Nick', 'Dundee', 'crocjock@gmail.com', 'password', '10 Down Under Path', '', 'Destin ', 'FL', '32556', '9045557865', '9045557866', 'Customer'),
('Chia-Tea', 'Tu', 'ctt@hotmail.com', 'password', '97 Carl Bandt Dr', '', 'Shalimar ', 'FL', '32579', '9046661342', '9046661343', 'Customer'),
('Jon-boy', 'Discman', 'frisbeefan@gmail.com', 'password', '8 Dull Road', '', 'Lamesville', 'MO', '62345', '8065551756', '8065551757', 'Customer'),
('Lizzy', 'Bordon', 'hatchetgal@yahoo.com', 'password', '1 Psycopath Way', '', 'Pittsburgh', 'PA', '23657', '6652348576', '6652348577', 'Customer'),
('I.M.', 'Wired', 'imwired@roncabeanz.com', 'adminPassword', '', '', '', '', '', '', '', 'Administrator'),
('Tony', 'Stark', 'ironman@gmail.com', 'password', '12 Pacific Coast Highway', '', 'Malibu', 'CA', '92567', '2135556789', '2135556788', 'Customer'),
('Jessica', 'Jones', 'jj@gmail.com', 'password', '1 B Street', '', 'Placerville', 'CA', '95667', '5125558675', '5125558676', 'Customer'),
('John Q', 'Public', 'jqp@gmail.com', 'password', '123 4th St', '', 'Shalimar ', 'FL', '32579', '9045553456', '9045553457', 'Customer'),
('Lois', 'Lane', 'lois@dailyplanet.com', 'password', '1123 Manhattan Way', '', 'New York City', 'NY', '98761', '8345551234', '8345551235', 'Customer'),
('Jesse ', 'Pinkman', 'methhead@gmail.com', 'password', '24 Trailer Trash Way', '', 'Hicksville', 'AL', '46578', '2065558476', '2065558477', 'Customer'),
('Nick', 'Caffeine', 'ncaffeine@gmail.com', 'freshroast', '26 Tenth St', '', 'Los Gatos', 'CA', '95032', '4085557654', '4085557655', 'Customer'),
('Noah', 'Justice', 'nojustice@hotmail.com', 'password', '123 Bad Luck Way', '6', 'Baton Rouge', 'LA', '54367', '3875554327', '3875554328', 'Customer'),
('Ruby', 'Reddress', 'psych@gmail.com', 'password', '9876 Any Street', '', 'Blah', 'PA', '24567', '2675556789', '2675556790', 'Customer'),
('Saul', 'Goodman', 'saul@goodman.com', 'password', '23 Trailer Trash Way', '', 'Hicksville', 'AL', '46758', '2065558475', '2065558476', 'Customer'),
('Wanda', 'Moca', 'wmoca@yahoo.com', 'loveMocha', '12993 Grizzley Rock Road', '', 'Los Gatos', 'CA', '95032', '4085554234', '4085554235', 'Customer'),
('Jack', 'Yukon', 'yj@gmail.cpom', 'password', '123 LaLa Lane', '', 'Wherever', 'IA', '56783', '8765553456', '8765553457', 'Customer');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`name`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
