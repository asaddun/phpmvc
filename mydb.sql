-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2025 at 01:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_meets`
--

CREATE TABLE `booking_meets` (
  `id` int NOT NULL,
  `room` tinyint NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `user` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_meets`
--

INSERT INTO `booking_meets` (`id`, `room`, `start_time`, `end_time`, `user`, `created_at`) VALUES
(1, 1, '2025-03-04 15:30:00', '2025-03-04 16:30:00', 'User', '2025-03-03 08:10:56'),
(2, 2, '2025-03-04 09:00:00', '2025-03-04 10:30:00', 'Asad', '2025-03-04 02:34:25'),
(3, 3, '2025-03-04 10:00:00', '2025-03-04 12:00:00', 'Admin', '2025-03-04 02:35:00'),
(9, 1, '2025-03-04 12:00:00', '2025-03-04 13:00:00', 'Asad', '2025-03-04 09:15:47'),
(10, 2, '2025-03-05 10:00:00', '2025-03-05 11:00:00', 'Asad', '2025-03-05 03:06:43'),
(11, 3, '2025-03-04 13:00:00', '2025-03-04 14:00:00', 'Asad', '2025-03-05 03:06:58'),
(12, 2, '2025-03-03 09:30:00', '2025-03-03 10:30:00', 'Asad', '2025-03-05 03:08:01'),
(15, 3, '2025-03-05 13:00:00', '2025-03-05 14:00:00', 'Admin', '2025-03-05 07:02:22'),
(27, 2, '2025-03-07 13:00:00', '2025-03-07 14:30:00', 'Asad', '2025-03-07 04:43:00'),
(29, 1, '2025-03-08 10:00:00', '2025-03-08 11:00:00', 'Muhammad Asad', '2025-03-07 08:18:13'),
(30, 3, '2025-03-07 15:30:00', '2025-03-07 16:30:00', 'ICT', '2025-03-07 08:20:40'),
(31, 2, '2025-03-07 16:00:00', '2025-03-07 17:00:00', 'Muhammad Asad', '2025-03-07 08:30:23'),
(32, 2, '2025-03-11 09:00:00', '2025-03-11 11:00:00', 'Asad ICT', '2025-03-11 01:09:27'),
(33, 3, '2025-03-11 13:00:00', '2025-03-11 14:00:00', 'Muhammad Asad', '2025-03-11 01:16:04'),
(34, 1, '2025-03-11 10:00:00', '2025-03-11 11:00:00', 'QADC', '2025-03-11 01:18:21'),
(35, 3, '2025-03-11 11:00:00', '2025-03-11 12:00:00', 'HRGA', '2025-03-11 01:23:13'),
(36, 1, '2025-03-11 15:00:00', '2025-03-11 16:00:00', 'Asad - ICT', '2025-03-11 01:24:27'),
(37, 4, '2025-03-11 09:00:00', '2025-03-11 12:00:00', 'Marketing', '2025-03-11 01:35:13'),
(38, 2, '2025-03-13 16:00:00', '2025-03-13 17:00:00', 'Asad', '2025-03-13 08:36:48'),
(39, 3, '2025-03-17 09:00:00', '2025-03-17 10:00:00', 'Asad ICT', '2025-03-14 04:29:26'),
(40, 2, '2025-03-17 11:00:00', '2025-03-17 12:00:00', 'Muhammad Asad', '2025-03-14 04:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `bookstore_authors`
--

CREATE TABLE `bookstore_authors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookstore_authors`
--

INSERT INTO `bookstore_authors` (`id`, `name`, `bio`) VALUES
(1, 'J.K. Rowling', 'Penulis asal Inggris yang terkenal dengan seri Harry Potter.'),
(2, 'George Orwell', 'Penulis fiksi politik dan distopia.'),
(3, 'Muhammad Asad', 'Jago ngarang cerita');

-- --------------------------------------------------------

--
-- Table structure for table `bookstore_books`
--

CREATE TABLE `bookstore_books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `year` year DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT '0',
  `description` text,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookstore_books`
--

INSERT INTO `bookstore_books` (`id`, `title`, `author_id`, `category_id`, `publisher`, `year`, `isbn`, `price`, `stock`, `description`, `cover`, `created_at`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 1, 1, 'Bloomsbury', '1997', '9780747532699', 150000.00, 20, 'Buku pertama dari seri Harry Potter.', 'hp1.jpg', '2025-05-08 10:04:36'),
(2, '1984', 2, 4, 'Secker & Warburg', '1949', '9780451524935', 120000.00, 15, 'Novel distopia tentang dunia totaliter.', '1984.jpg', '2025-05-08 10:04:36'),
(3, 'The Shining', 3, 3, 'Doubleday', '1977', '9780307743657', 135000.00, 10, 'Novel horor klasik karya Stephen King.', 'shining.jpg', '2025-05-08 10:04:36'),
(4, 'Animal Farm', 2, 4, 'Penguin Books', '1945', '9780141036137', 100000.00, 12, 'Sebuah alegori satir tentang revolusi Rusia.', 'animalfarm.jpg', '2025-05-08 10:04:36'),
(5, 'Harry Potter and the Chamber of Secrets', 1, 1, 'Bloomsbury', '1998', '9780747538493', 155000.00, 18, 'Buku kedua dari seri Harry Potter.', 'hp2.jpg', '2025-05-08 10:04:36'),
(6, 'Business example employee chance international.', 1, 1, 'Hill LLC', '1954', '9780475711342', 62063.66, 19, 'Daughter month stage every already group quality. Your allow those fill.', 'cover_1.jpg', '2025-05-08 06:56:42'),
(7, 'Could network ability ok pretty customer.', 2, 4, 'Cooper, Walter and Ramos', '1992', '9780690757149', 174363.56, 50, 'Play party per show stuff happen least drug. Mouth southern number one morning laugh appear.', 'cover_2.jpg', '2025-05-08 06:56:42'),
(8, 'Consumer event Democrat.', 3, 2, 'Baker-French', '1952', '9781253815047', 126455.32, 21, 'Model night safe go pass. Free matter television thank everything.', 'cover_3.jpg', '2025-05-08 06:56:42'),
(9, 'Realize station entire else night.', 2, 4, 'Cox, Perez and Sanders', '2010', '9781231845684', 143916.81, 26, 'Behavior base visit parent color under development. Take child herself knowledge.\nWeek least of.', 'cover_4.jpg', '2025-05-08 06:56:42'),
(10, 'When without assume begin none.', 3, 3, 'Hill LLC', '1985', '9781795709781', 143607.26, 44, 'Great you east. Third remember water relate.', 'cover_5.jpg', '2025-05-08 06:56:42'),
(11, 'Listen personal could carry network.', 2, 1, 'Richard Ltd', '1991', '9780015283698', 133345.19, 5, 'Set pass you score. Late own message police push direction beyond.', 'cover_6.jpg', '2025-05-08 06:56:42'),
(12, 'Sister again particularly relationship.', 1, 2, 'Fisher-Brown', '1999', '9781828942482', 176882.40, 34, 'Thank cut meet heart mouth home across cell. Wind wrong rock couple. Give bed despite anyone we.', 'cover_7.jpg', '2025-05-08 06:56:42'),
(13, 'Type raise bill laugh dinner suffer.', 1, 5, 'Stanton, Aguilar and Hayes', '1968', '9780791611425', 64808.87, 14, 'Election similar film. Bed us record few executive financial.', 'cover_8.jpg', '2025-05-08 06:56:42'),
(14, 'Heavy poor simple me gas.', 3, 5, 'Hicks, Alvarez and Walter', '1994', '9780657628031', 115916.29, 23, 'Receive shoulder last there same her paper.', 'cover_9.jpg', '2025-05-08 06:56:42'),
(15, 'Economy administration huge social threat population.', 1, 2, 'Ross Group', '2010', '9780553681116', 161960.47, 9, 'Throw commercial task class beat health community. Meeting important scene discover best.', 'cover_10.jpg', '2025-05-08 06:56:42'),
(16, 'Similar magazine film exactly.', 2, 5, 'Lopez-Mckee', '1951', '9780042926223', 189735.53, 15, 'Clear road recent difficult. Miss other full political.', 'cover_11.jpg', '2025-05-08 06:56:42'),
(17, 'Speech mind chance stock.', 3, 1, 'Carter-Conley', '1971', '9781175967657', 63832.46, 32, 'Blue him much art attorney require cut.\nHold administration main major onto.', 'cover_12.jpg', '2025-05-08 06:56:42'),
(18, 'American wrong themselves represent.', 2, 4, 'George Ltd', '1988', '9780360772311', 147376.64, 41, 'Establish property add. System physical collection value southern agreement know.', 'cover_13.jpg', '2025-05-08 06:56:42'),
(19, 'Far should positive although type tonight.', 1, 2, 'Ramsey, Berry and Jackson', '2016', '9780205815012', 144844.25, 17, 'Machine tree radio. Expect management compare outside interest pay. Though every century from.', 'cover_14.jpg', '2025-05-08 06:56:42'),
(20, 'Then clear organization.', 1, 1, 'Cooper PLC', '2001', '9780862333447', 50444.02, 19, 'Floor woman line detail protect difference. Wind new business include gun.', 'cover_15.jpg', '2025-05-08 06:56:42'),
(21, 'Teacher near speech.', 2, 2, 'Diaz Inc', '1973', '9780142434796', 64815.62, 25, 'Strategy make be where employee while. Staff method what effort. Small whole feel race debate.', 'cover_16.jpg', '2025-05-08 06:56:42'),
(22, 'Reflect or my.', 3, 5, 'Ortiz, Wheeler and Hodges', '1962', '9780158249032', 102872.62, 15, 'Difficult use available. Which central at growth job fast mouth.', 'cover_17.jpg', '2025-05-08 06:56:42'),
(23, 'Reach should third must view this during.', 1, 3, 'Lopez-Pena', '2007', '9781190976290', 145372.13, 31, 'Sense such fund describe. Pm level area increase him bank help national.', 'cover_18.jpg', '2025-05-08 06:56:42'),
(24, 'Sometimes foreign teach research step character.', 1, 1, 'Ball Ltd', '1962', '9781139561785', 173343.68, 38, 'Themselves back management head determine program moment. Air agency until.', 'cover_19.jpg', '2025-05-08 06:56:42'),
(25, 'Subject organization charge.', 1, 5, 'Franco-Thompson', '2012', '9780588736409', 131819.44, 33, 'Role issue set environmental team production. Write successful similar tonight my action focus.', 'cover_20.jpg', '2025-05-08 06:56:42'),
(26, 'Practice receive financial into world early.', 2, 4, 'Powers, Pruitt and Anderson', '2004', '9781839955563', 123166.31, 43, 'Degree miss hour you court dark improve. Item next everybody store.', 'cover_21.jpg', '2025-05-08 06:56:42'),
(27, 'Would southern court education deal.', 3, 4, 'Mckenzie LLC', '1963', '9781832782715', 134675.68, 34, 'Boy through everyone these kid social newspaper economy. Effort mission president deep successful.', 'cover_22.jpg', '2025-05-08 06:56:42'),
(28, 'Grow statement data.', 1, 3, 'Roberts Inc', '1993', '9781392826171', 50136.24, 12, 'Chance heart past fill soldier. Dark even shoulder should. Front always sister agree.', 'cover_23.jpg', '2025-05-08 06:56:42'),
(29, 'Identify arrive area third.', 2, 5, 'Hayes Ltd', '1981', '9781667445755', 65685.74, 7, 'Project sing owner contain. Middle rock amount.', 'cover_24.jpg', '2025-05-08 06:56:42'),
(30, 'Out hit case how around rise.', 3, 5, 'Mendoza, Hanson and Nelson', '2007', '9780268443351', 96127.14, 49, 'Wall suggest here price either every popular. Wind together eight.', 'cover_25.jpg', '2025-05-08 06:56:42'),
(31, 'Offer three trial.', 1, 2, 'Reynolds-Anderson', '2007', '9781930816947', 169011.19, 28, 'Congress our at possible defense. Theory field join ball small your street identify.', 'cover_26.jpg', '2025-05-08 06:56:42'),
(32, 'Summer idea support.', 1, 3, 'Rios, Gregory and Lucero', '1988', '9781545234808', 185706.03, 20, 'Stock make bed watch. Value table game radio seven. Piece time three.', 'cover_27.jpg', '2025-05-08 06:56:42'),
(33, 'Director help station.', 3, 5, 'Simmons, Mcbride and Yates', '1950', '9781758088786', 97854.08, 26, 'Season method well drive question country quickly. Act prepare trade stuff.', 'cover_28.jpg', '2025-05-08 06:56:42'),
(34, 'Spend meet free star born.', 2, 2, 'Trevino-Wilson', '1978', '9780379656664', 124703.67, 15, 'Example recently page service successful size. Relate agree two.', 'cover_29.jpg', '2025-05-08 06:56:42'),
(35, 'May discuss morning.', 3, 2, 'Adams-Mueller', '2014', '9781467665070', 121773.42, 34, 'Late three deep message add. Buy wide get less.\nCheck law few from. Reason international suddenly.', 'cover_30.jpg', '2025-05-08 06:56:42'),
(36, 'Lawyer school before evening pick.', 1, 3, 'Spencer, Johnson and Smith', '2002', '9780681516403', 76202.44, 6, 'Relationship morning area above yeah space including eight.', 'cover_31.jpg', '2025-05-08 06:56:42'),
(37, 'Generation analysis cold religious sit.', 1, 3, 'Brown Inc', '1985', '9780796831095', 156595.88, 26, 'Life face seven describe standard particularly. Sort grow modern hair he establish.', 'cover_32.jpg', '2025-05-08 06:56:42'),
(38, 'Feel father bag.', 1, 2, 'Smith, Rogers and Gardner', '2002', '9781648652165', 148626.44, 47, 'Whom yourself total protect. Direction country medical cut she player class.', 'cover_33.jpg', '2025-05-08 06:56:42'),
(39, 'Possible over improve.', 2, 2, 'Landry-Hanna', '1973', '9781052630728', 130958.13, 9, 'Just agency those. Crime far gas reach.', 'cover_34.jpg', '2025-05-08 06:56:42'),
(40, 'Sing safe live pressure.', 3, 5, 'Dean-Jackson', '1954', '9781242633409', 59860.80, 37, 'Case entire impact town nearly able.\nSend power support.', 'cover_35.jpg', '2025-05-08 06:56:42'),
(41, 'Material serious attention.', 1, 5, 'Webster Inc', '2016', '9781533968531', 66462.75, 32, 'Way find believe news station everybody. Medical day accept.', 'cover_36.jpg', '2025-05-08 06:56:42'),
(42, 'Once red machine various.', 2, 1, 'Chavez, Munoz and Clark', '2016', '9781979421997', 186511.56, 11, 'Career wind among able race. Two idea buy drive wish here young.', 'cover_37.jpg', '2025-05-08 06:56:42'),
(43, 'Politics hope themselves high hour grow become.', 2, 1, 'Brooks, Garcia and Bailey', '1981', '9781898619437', 160051.84, 38, 'Collection day none. According section window even physical win bring.', 'cover_38.jpg', '2025-05-08 06:56:42'),
(44, 'Small church institution throughout view catch.', 2, 5, 'Carson, Carpenter and Moore', '1989', '9781188996392', 162400.06, 7, 'Item operation know gun interest take. Cold result around do nature sing.', 'cover_39.jpg', '2025-05-08 06:56:42'),
(45, 'Interview charge star prevent.', 3, 5, 'Robbins-Allen', '2003', '9780741572080', 173176.58, 19, 'Last hear alone trouble one probably. Administration course simple. Boy leader our value.', 'cover_40.jpg', '2025-05-08 06:56:42'),
(46, 'Back tax mother wind short standard.', 1, 1, 'Anderson-Fleming', '2011', '9781006763090', 96714.83, 22, 'Prevent discover religious when despite. Second decade professor bag great tree.', 'cover_41.jpg', '2025-05-08 06:56:42'),
(47, 'Draw political which minute page.', 3, 1, 'Cunningham-Carter', '2014', '9781678162153', 85059.11, 17, 'Main project wrong degree might three box.', 'cover_42.jpg', '2025-05-08 06:56:42'),
(48, 'Everyone form culture out.', 1, 5, 'Mcdowell Ltd', '1965', '9780026144490', 78542.08, 26, 'Point training argue administration art late. Believe outside fish go even family fish.', 'cover_43.jpg', '2025-05-08 06:56:42'),
(49, 'Even truth prove data range.', 3, 4, 'Caldwell LLC', '1994', '9781123760187', 132487.68, 19, 'Itself PM talk. Above break bad wish year program. Owner that performance source not increase.', 'cover_44.jpg', '2025-05-08 06:56:42'),
(50, 'Take church hour up energy family.', 2, 2, 'Burns and Sons', '1974', '9780948769894', 131039.93, 9, 'Board page court this others. Investment seat side budget no open network.', 'cover_45.jpg', '2025-05-08 06:56:42'),
(51, 'Executive because movie.', 2, 2, 'Schultz and Sons', '2005', '9781678690106', 194404.95, 30, 'Finally church short long sense. Teacher police evidence standard.', 'cover_46.jpg', '2025-05-08 06:56:42'),
(52, 'Top feel need positive.', 3, 4, 'Rodriguez-Waters', '1973', '9780508952209', 83446.25, 36, 'Region ten attack mouth social this. Worry direction pull out lose.', 'cover_47.jpg', '2025-05-08 06:56:42'),
(53, 'North pattern point information whatever together.', 1, 1, 'Pollard and Sons', '1984', '9781980086642', 132640.66, 33, 'Week draw whose no. Age long consumer knowledge unit bar. Stage employee let free.', 'cover_48.jpg', '2025-05-08 06:56:42'),
(54, 'Point teach general miss his cup.', 3, 3, 'Greene-Richardson', '2022', '9781754615849', 99855.01, 12, 'That popular speak base political.', 'cover_49.jpg', '2025-05-08 06:56:42'),
(55, 'Hundred despite company.', 2, 3, 'Hanna, Taylor and Whitaker', '1998', '9781140395942', 103354.46, 29, 'Whatever article continue rock effect at certain. Nearly sometimes show push TV health according.', 'cover_50.jpg', '2025-05-08 06:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `bookstore_cart`
--

CREATE TABLE `bookstore_cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookstore_categories`
--

CREATE TABLE `bookstore_categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookstore_categories`
--

INSERT INTO `bookstore_categories` (`id`, `name`) VALUES
(1, 'Fantasi'),
(2, 'Fiksi Ilmiah'),
(3, 'Horror'),
(4, 'Politik'),
(5, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nomor` varchar(25) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `nama`, `nomor`, `pekerjaan`, `email`) VALUES
(1, 'Muhammad Asad', '081284113960', 'Mechanic Engineer', 'asad@email.com'),
(2, 'Ahmad Ramdhani', '089764532876', 'Information Technology Support', 'dhaan@email.com'),
(3, 'Yuta Nakamura', '085892851903', 'Mechanic Supervisor', 'yuta@email.com'),
(7, 'Asad', '081284113960', 'IT Technical Support', 'muhammadasaddun@gmail.com'),
(8, 'Ahmad Ramdhania', '08121243687', 'Production Supervisor', 'admina@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `asset_id` varchar(20) NOT NULL,
  `value` varchar(10) NOT NULL,
  `version` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`asset_id`, `value`, `version`) VALUES
('1000000', '001', '4.1.1'),
('1000002', '003', '4.1.1'),
('1000003', '004', '4.1.1'),
('1000004', '005', '4.1.1'),
('1000015', '017', '4.1.1'),
('1000016', '018', '4.1.1'),
('1000017', '019', '4.1.1'),
('1000018', '020', '4.1.1'),
('1000040', '042', '4.1.1'),
('1000041', '043', '4.1.1'),
('1000042', '044', '4.1.1'),
('1000043', '045', '4.1.1'),
('1000044', '046', '4.1.1'),
('1000045', '047', '4.1.1'),
('1000046', '048', '4.1.1'),
('1000047', '049', '4.1.1'),
('1000048', '050', '4.1.1'),
('1000049', '051', '4.1.1'),
('1000050', '052', '4.1.1'),
('1000051', '053', '4.1.1'),
('1000052', '054', '4.1.1'),
('1000053', '055', '4.1.1'),
('1000054', '056', '4.1.1'),
('1000055', '057', '4.1.1'),
('1000056', '058', '4.1.1'),
('1000065', '070', '4.1.1'),
('1000066', '061', '4.1.1'),
('1000067', '062', '4.1.1'),
('1000068', '063', '4.1.1'),
('1000070', '068', '4.1.1'),
('1000071', '069', '4.1.1'),
('1000072', '071', '4.1.1'),
('1000073', '072', '4.1.1'),
('1000074', '076', '4.1.1'),
('1000075', '077', '4.1.1'),
('1000076', '078', '4.1.1'),
('1000077', '079', '4.1.1'),
('1000079', '080', '4.1.1'),
('1000080', '081', '4.1.1'),
('1000081', '082', '4.1.1'),
('1000082', '083', '4.1.1'),
('1000083', '084', '4.1.1'),
('1000101', '085', '4.1.1'),
('1000102', '086', '4.1.1'),
('1000105', '087', '4.1.1'),
('1000106', '088', '4.1.1'),
('1000107', '089', '4.1.1'),
('1000108', '090', '4.1.1'),
('1000109', '091', '4.1.1'),
('1000110', '092', '4.1.1'),
('1000111', '093', '4.1.1'),
('1000112', '094', '4.1.1'),
('1000115', '095', '4.1.1'),
('1000116', '096', '4.1.1'),
('1000120', '101', '4.1.1'),
('1000121', '102', '4.1.1'),
('1000122', '098', '4.1.1'),
('1000123', '099', '4.1.1'),
('1000124', '100', '4.1.1'),
('1000125', '097', '4.1.1'),
('1000126', '103', '4.1.1'),
('1000127', '104', '4.1.1'),
('1000128', '105', '4.1.1'),
('1000129', '106', '4.1.1'),
('1000130', '107', '4.1.1'),
('1000131', '108', '4.1.1'),
('1000132', '109', '4.1.1'),
('1000133', '110', '4.1.1'),
('1000134', '111', '4.1.1'),
('1000135', '112', '4.1.1'),
('1000136', '114', '4.1.1'),
('1000137', '115', '4.1.1'),
('1000138', '116', '4.1.1'),
('1000139', '117', '4.1.1');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `asset_id` varchar(20) NOT NULL,
  `waktu_mulai` timestamp NOT NULL,
  `status` tinyint NOT NULL,
  `user_id` int DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `deskripsi`, `asset_id`, `waktu_mulai`, `status`, `user_id`, `waktu_selesai`) VALUES
(1, 'tes problem pertama', '1000000', '2025-02-06 06:47:44', 1, 1, NULL),
(3, 'xaasdsd', '1000018', '2025-02-07 06:23:06', 1, 1, NULL),
(4, 'ada masalah ni bos', '1000042', '2025-02-07 06:36:47', 1, 1, NULL),
(5, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus culpa pariatur, sint sunt non mollitia ducimus veritatis exercitationem. Nesciunt ipsum eum dignissimos eos aspernatur consectetur omnis dolor praesentium voluptate natus.', '1000121', '2025-02-07 07:54:59', 1, 1, NULL),
(6, 'nondonoansdlacnas', '1000045', '2025-02-07 08:03:02', 1, 3, NULL),
(10, 'dassdada', '1000015', '2025-02-07 08:34:32', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problems_action_log`
--

CREATE TABLE `problems_action_log` (
  `id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `problem_id` int NOT NULL,
  `user_id` int NOT NULL,
  `waktu_catat` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int NOT NULL,
  `code` varchar(5) NOT NULL,
  `type` char(2) NOT NULL,
  `number` int NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `called_at` datetime DEFAULT NULL,
  `counter` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `code`, `type`, `number`, `status`, `created_at`, `called_at`, `counter`) VALUES
(2, 'A001', 'A', 1, 4, '2025-04-10 22:55:18', '2025-04-10 22:56:36', 1),
(3, 'B001', 'B', 1, 4, '2025-04-10 22:55:47', '2025-04-10 22:59:56', 1),
(4, 'A002', 'A', 2, 4, '2025-04-10 22:57:16', '2025-04-10 22:57:34', 2),
(5, 'A003', 'A', 3, 4, '2025-04-10 22:58:00', '2025-04-10 23:02:23', 2),
(6, 'A001', 'A', 1, 4, '2025-04-11 07:57:13', '2025-04-11 08:05:24', 3),
(7, 'C001', 'C', 1, 4, '2025-04-11 08:11:52', '2025-04-11 08:12:03', 2),
(8, 'B001', 'B', 1, 4, '2025-04-11 08:13:15', '2025-04-11 08:13:34', 1),
(9, 'A002', 'A', 2, 4, '2025-04-11 10:06:07', '2025-04-11 10:18:41', 4),
(10, 'C002', 'C', 2, 4, '2025-04-11 10:17:02', '2025-04-11 10:41:20', 4),
(11, 'A003', 'A', 3, 4, '2025-04-11 15:47:30', '2025-04-11 16:12:21', 1),
(12, 'B002', 'B', 2, 4, '2025-04-11 16:04:49', '2025-04-11 16:41:50', 1),
(13, 'C003', 'C', 3, 4, '2025-04-11 16:05:04', '2025-04-11 16:43:05', 1),
(14, 'A004', 'A', 4, 4, '2025-04-11 16:43:22', '2025-04-11 16:43:28', 2),
(15, 'A005', 'A', 5, 3, '2025-04-11 16:50:24', '2025-04-11 16:54:10', 3),
(16, 'B003', 'B', 3, 2, '2025-04-11 16:53:57', '2025-04-11 16:54:31', 4),
(21, 'A001', 'A', 1, 3, '2025-04-14 15:44:16', '2025-04-14 15:57:55', 1),
(22, 'B001', 'B', 1, 3, '2025-04-14 15:44:31', '2025-04-14 16:04:17', 2),
(24, 'C001', 'C', 1, 3, '2025-04-14 15:56:00', '2025-04-14 16:05:20', 4),
(25, 'A002', 'A', 2, 3, '2025-04-14 15:59:59', '2025-04-14 16:04:43', 3),
(26, 'B002', 'B', 2, 1, '2025-04-14 16:01:35', NULL, NULL),
(27, 'A003', 'A', 3, 1, '2025-04-14 16:01:41', NULL, NULL),
(28, 'C002', 'C', 2, 1, '2025-04-14 16:03:20', NULL, NULL),
(29, 'A004', 'A', 4, 1, '2025-04-14 16:03:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services_category`
--

CREATE TABLE `services_category` (
  `id` int NOT NULL,
  `value` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services_category`
--

INSERT INTO `services_category` (`id`, `value`, `name`) VALUES
(1, 1, 'Engine'),
(2, 2, 'Transmission'),
(3, 3, 'Suspension'),
(4, 4, 'Brakes'),
(5, 5, 'Turbo'),
(6, 6, 'Trunk'),
(7, 7, 'Bodykits'),
(8, 8, 'Tint'),
(9, 9, 'Tire'),
(10, 10, 'Horn'),
(11, 11, 'Color'),
(12, 12, 'Headlight'),
(13, 13, 'Neon'),
(14, 14, 'Additional');

-- --------------------------------------------------------

--
-- Table structure for table `services_log`
--

CREATE TABLE `services_log` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `vehicle` varchar(20) NOT NULL,
  `services` varchar(255) NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services_log`
--

INSERT INTO `services_log` (`id`, `name`, `phone`, `vehicle`, `services`, `total`, `created_at`) VALUES
(3, 'Muhammad Asad', '1232132', 'Blista', '12,44,23,23', 3690, '2025-03-24 09:04:29'),
(4, 'Yuta Nakamura', '1061114', 'ZR350', '38,23,23', 4320, '2025-03-25 03:19:45'),
(5, 'Ahmad Ramdhani', '904423', 'Rebel', '8,33,39,46,47', 3285, '2025-03-25 05:34:53'),
(6, 'Muhammad Asad', '1061114', 'ZR350', '51', 180, '2025-03-26 04:06:59'),
(7, 'Muhammad Asad', '284483', 'Faggio', '18,42', 2655, '2025-03-27 02:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `services_prices`
--

CREATE TABLE `services_prices` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `category` int NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_prices`
--

INSERT INTO `services_prices` (`id`, `name`, `price`, `category`, `level`) VALUES
(1, 'Engine Stock', 500, 1, 1),
(2, 'Engine Stage I', 700, 1, 2),
(3, 'Engine Stage II', 850, 1, 3),
(4, 'Engine Stage III', 1300, 1, 4),
(5, 'Engine Stage IV', 1500, 1, 5),
(6, 'Transmission Stock', 400, 2, 1),
(7, 'Transmission Street', 650, 2, 2),
(8, 'Transmission Sport', 800, 2, 3),
(9, 'Transmission Race', 1150, 2, 4),
(10, 'Suspension Stock', 350, 3, 1),
(11, 'Suspension Lower', 550, 3, 2),
(12, 'Suspension Street', 800, 3, 3),
(13, 'Suspension Sport', 1000, 3, 4),
(14, 'Suspension Race', 1300, 3, 5),
(15, 'Brakes Stock', 350, 4, 1),
(16, 'Brakes Street', 500, 4, 2),
(17, 'Brakes Sport', 750, 4, 3),
(18, 'Brakes Race', 1150, 4, 4),
(19, 'No Turbo', 400, 5, 1),
(20, 'Turbo', 2100, 5, 2),
(21, 'Trunk Capacity/kg', 300, 6, 1),
(22, 'Trunk Slot/slot', 550, 6, 2),
(23, 'Bodykits', 1500, 7, 1),
(24, 'No Tint', 100, 8, 1),
(25, 'Tint Slight', 550, 8, 2),
(26, 'Tint Moderate', 700, 8, 3),
(27, 'Tint Full', 800, 8, 4),
(28, 'Tire Rims', 750, 9, 1),
(29, 'Tire Smoke', 1000, 9, 2),
(30, 'Tire Radius', 750, 9, 3),
(31, 'Tire Width', 750, 9, 4),
(32, 'Tire Chamber', 750, 9, 5),
(33, 'Tire Suspension Height', 750, 9, 6),
(34, 'Horn Stock', 200, 10, 1),
(35, 'Horn Truck', 600, 10, 2),
(36, 'Horn Police', 600, 10, 3),
(37, 'Horn Clown', 600, 10, 4),
(38, 'Full Color', 1800, 11, 1),
(39, 'Primary Color', 900, 11, 2),
(40, 'Secondary Color', 900, 11, 3),
(41, 'Rims Color', 900, 11, 4),
(42, 'Pearlescent Color', 1800, 11, 5),
(43, 'Headlight Stock', 300, 12, 1),
(44, 'Headlight White Xenon', 300, 12, 2),
(45, 'Headlight Color Xenon', 800, 12, 3),
(46, 'Neon', 900, 13, 1),
(47, 'Custom Plate', 300, 14, 1),
(48, 'Engine Swap', 950, 14, 2),
(49, 'Backfire/Anti-lag', 1000, 14, 3),
(52, 'Tire Drift', 1500, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL,
  `nomor_tiket` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subjek` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `queued_at` timestamp NULL DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `nomor_tiket`, `subjek`, `deskripsi`, `status`, `user_id`, `created_at`, `queued_at`, `tindakan`) VALUES
(1, 'TWK202501080001', 'Testing Ticket', 'deskripsi atau detail tentang ticket', 5, 1, '2025-01-08 09:11:53', '2025-01-16 06:58:11', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia fuga aliquam atque, odio labore praesentium? Eum inventore eos quam sint voluptatum totam quasi architecto omnis nostrum? Eaque ullam quibusdam cumque?'),
(2, 'TWK202501090001', 'Test dari Admin', 'test detail dari ticket yang dibuat oleh admin', 5, 2, '2025-01-09 13:12:11', '2025-01-15 02:03:49', 'sudah selesai'),
(3, 'TWK202501100001', 'Test dari Asad', 'deskripsi tes ticket asad nambah dari form', 6, 1, '2025-01-10 08:53:00', '2025-01-15 02:03:34', 'selesai'),
(4, 'TWK202501140001', 'Test nomor tiket', 'Tes tiket untuk menguji nomor tiket', 5, 1, '2025-01-14 06:26:25', '2025-01-15 02:01:52', 'selesaii'),
(5, 'TWK202501140002', 'Test nomor tiket 2', 'tiket nomor 2 untuk mengetes nomor tiket', 5, 1, '2025-01-14 06:36:48', '2025-01-15 02:03:38', 'selesai dengan tenang'),
(6, 'TWK202501140003', 'Test nomor tiket3', 'test nomor tiket 3-1', 5, 1, '2025-01-14 06:45:56', '2025-01-16 06:50:32', 'seleesai'),
(11, 'TWK202501220001', 'TEESSST TIKET CANCEL', 'TES DOANG BANG BAKAL DICANCEL KOK', 6, 1, '2025-01-22 09:45:18', '2025-01-22 09:45:21', 'selesais'),
(12, 'TWK202502100001', 'Tiket 10/02', 'tes tiket di tanggal 10/02', 5, 1, '2025-02-10 08:28:07', '2025-02-10 08:28:10', 'Documentation and examples for showing pagination to indicate a series of related content exists across multiple pages.');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int NOT NULL,
  `title` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `title`, `deskripsi`, `status`) VALUES
(1, 'Makan', 'Lapeer baang kalo engga makan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `token` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(65) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'asad', 'Muhammad Asad', 'asad@email.com', '$2y$10$KMfaXxo7rfrETZCBJlETVumvdCup7T5M35PpQ6kJHZCM3i2jvKN8.', 2, '2025-01-02 07:41:54'),
(2, 'admin', 'Admin', 'admin@email.com', '$2y$10$NpCq38KnJVSAFv.ULagyaeBBHZlxoZEWNOei9Rss5YRPIpuvnK2ky', 2, '2025-01-08 09:13:05'),
(3, 'guest', 'Guest', 'guest@email.com', '$2y$10$D3Rr/ZFpUIu3Aj/qITk6Xu40e81WuSZr66dzuHk2JW1r0WDOifdTW', 1, '2025-01-20 01:24:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_meets`
--
ALTER TABLE `booking_meets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookstore_authors`
--
ALTER TABLE `bookstore_authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookstore_books`
--
ALTER TABLE `bookstore_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `bookstore_cart`
--
ALTER TABLE `bookstore_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `bookstore_categories`
--
ALTER TABLE `bookstore_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `asset_id` (`asset_id`) USING BTREE;

--
-- Indexes for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_category`
--
ALTER TABLE `services_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indexes for table `services_log`
--
ALTER TABLE `services_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_prices`
--
ALTER TABLE `services_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_meets`
--
ALTER TABLE `booking_meets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bookstore_authors`
--
ALTER TABLE `bookstore_authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookstore_books`
--
ALTER TABLE `bookstore_books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `bookstore_cart`
--
ALTER TABLE `bookstore_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookstore_categories`
--
ALTER TABLE `bookstore_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `services_category`
--
ALTER TABLE `services_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services_log`
--
ALTER TABLE `services_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services_prices`
--
ALTER TABLE `services_prices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookstore_books`
--
ALTER TABLE `bookstore_books`
  ADD CONSTRAINT `bookstore_books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `bookstore_authors` (`id`),
  ADD CONSTRAINT `bookstore_books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `bookstore_categories` (`id`);

--
-- Constraints for table `bookstore_cart`
--
ALTER TABLE `bookstore_cart`
  ADD CONSTRAINT `bookstore_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookstore_cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `bookstore_books` (`id`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `problems_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `mesin` (`asset_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  ADD CONSTRAINT `problems_action_log_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `problems_action_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `services_prices`
--
ALTER TABLE `services_prices`
  ADD CONSTRAINT `services_prices_ibfk_1` FOREIGN KEY (`category`) REFERENCES `services_category` (`value`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
