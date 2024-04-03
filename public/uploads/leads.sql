-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 02:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pricing`
--

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `vnr` text DEFAULT NULL,
  `customer_number` text DEFAULT NULL,
  `form_id` text DEFAULT NULL,
  `firstname` text DEFAULT NULL,
  `lastname` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `cfdb7_status` text DEFAULT NULL,
  `hinundrueck` text DEFAULT NULL,
  `start` text DEFAULT NULL,
  `hinfahrt` text DEFAULT NULL,
  `menu_731` text DEFAULT NULL,
  `ziel` text DEFAULT NULL,
  `rueckfahrtt` text DEFAULT NULL,
  `menu_732` text DEFAULT NULL,
  `pax` text DEFAULT NULL,
  `grund` text DEFAULT NULL,
  `reisebudget` text DEFAULT NULL,
  `firmaoptional` text DEFAULT NULL,
  `schuleUniversitt` text DEFAULT NULL,
  `verein` text DEFAULT NULL,
  `behoerdenname` text DEFAULT NULL,
  `bemerkung` text DEFAULT NULL,
  `datenschutz` text DEFAULT NULL,
  `hinfahrt_other_stops` text DEFAULT NULL,
  `rueckfahrtt_other_stops` text DEFAULT NULL,
  `phase` text NOT NULL DEFAULT 'Details',
  `in_deal` int(11) NOT NULL DEFAULT 0,
  `partner_firmnname` text DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `stadt` text DEFAULT NULL,
  `bundesland` int(11) DEFAULT NULL,
  `plz` text DEFAULT NULL,
  `bustype` int(11) DEFAULT NULL,
  `resuorceid` text DEFAULT NULL,
  `resourceuri` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `vnr`, `customer_number`, `form_id`, `firstname`, `lastname`, `email`, `phone`, `cfdb7_status`, `hinundrueck`, `start`, `hinfahrt`, `menu_731`, `ziel`, `rueckfahrtt`, `menu_732`, `pax`, `grund`, `reisebudget`, `firmaoptional`, `schuleUniversitt`, `verein`, `behoerdenname`, `bemerkung`, `datenschutz`, `hinfahrt_other_stops`, `rueckfahrtt_other_stops`, `phase`, `in_deal`, `partner_firmnname`, `adresse`, `stadt`, `bundesland`, `plz`, `bustype`, `resuorceid`, `resourceuri`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '2000', '15802', '2', 'Wolfgang', 'ksdghksajgfka', 'wolfgang.reurthmanns@t-onlie.de', '02152-51168', 'read', 'Hin und Rückfahrt', '47906 Kempen', '2024-01-21', '9:00', '51515 Kürten', '2024-01-21', '18:00', '1', 'Privat', NULL, '', '', '', '', 'Wir sind ca. 30 Personen', '1', 'dsjksrhygsferjs', 'ytewrfgyjgfsdaj', 'Abwicklung', 1, 'new firm', 'dfhsjkghghghghghghfyjwer', '43546', 8, 'bmngvbcn', 9, '3d309cd3-767d-45ec-9d48-cfde88e514ed', 'https://api.lexoffice.io/v1/contacts/3d309cd3-767d-45ec-9d48-cfde88e514ed', '2024-03-31 07:44:26', NULL, 0),
(2, '2001', '15803', '3', 'Heike', 'Lilienthal', 'heike.lilienthal@eah-jena.de', '03641-205800', 'read', 'Hin und Rückfahrt', 'Jena', '2023-12-01', '8:00', 'Torgau', '2023-12-01', '15:30', '25', 'Schule&#047;Universität', NULL, '', 'Ernst-Abbe-Hochschule Jena', '', '', 'Sehr geehrte Damen und Herren,\r\n\r\nwir suchen eine Transportmöglichkeit für ca. 25 Personen von Jena nach Torgau und zurück. \r\n\r\nMit freundlichen Grüßen\r\nHeike Lilienthal', '1', NULL, NULL, 'Nachfassen', 0, NULL, NULL, NULL, NULL, NULL, NULL, '594cb5d1-86ec-47e7-87af-7f5a17b83f84', 'https://api.lexoffice.io/v1/contacts/594cb5d1-86ec-47e7-87af-7f5a17b83f84', '2024-03-31 07:44:28', NULL, 0),
(3, '2002', '15804', '4', 'Katharina ', 'Bußfeld', 'k.bussfeld@sk-werl.de', '0176 64656010', 'read', 'Hin und Rückfahrt', 'Kucklermühlenweg, 59457 Werl', '2024-06-24', '7:30', 'Rekenerstr. 234, 45721 Haltern am See', '2024-06-24', '14:30', '100', 'Schule&#047;Universität', NULL, '', 'Sälzer Sekundarschule', '', '', '', '1', NULL, NULL, 'Details', 1, NULL, NULL, NULL, NULL, NULL, NULL, '04f61619-1748-48ad-8d07-2d5687444212', 'https://api.lexoffice.io/v1/contacts/04f61619-1748-48ad-8d07-2d5687444212', '2024-03-31 07:44:30', NULL, 0),
(4, '2003', '15805', '5', 'Barbara ', 'Lütz', 'barbara.luetz@gymnasium-alleestrasse.de', '02241&#047;1026600', 'read', 'Hin und Rückfahrt', 'Siegburg', '2023-12-13', '8:00', 'Frankfurt aM.', '2023-12-13', '15:30', '80', 'Schule&#047;Universität', NULL, '', 'Gymnasium Siegburg Alleestrasse', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '3faacb2f-3f8e-4b11-aaaa-fda3e1be81b9', 'https://api.lexoffice.io/v1/contacts/3faacb2f-3f8e-4b11-aaaa-fda3e1be81b9', '2024-03-31 07:44:32', NULL, 0),
(5, '2004', '15806', '6', 'Ruben', 'Jacob', 'rujacob1608@gmail.com', '01745444176', 'read', 'Hin und Rückfahrt', 'Zimmerloh 10, 08258 Markneukirchen', '2023-12-03', '15:00', 'Karlsbad', '2023-12-03', '23:00', '50', 'Verein', NULL, '', '', 'SpVgg Grün-Weiss Wernitzgrün', '', '', '1', NULL, NULL, 'Bussuche', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'c5aba87f-e204-4d94-8323-b545ddf4e314', 'https://api.lexoffice.io/v1/contacts/c5aba87f-e204-4d94-8323-b545ddf4e314', '2024-03-31 07:44:34', NULL, 0),
(6, '2005', '15807', '7', 'Ruben', 'Jacob', 'rujacob1608@gmail.com', '01745444176', 'read', 'Hin und Rückfahrt', 'Busbahnhof, 08258 Markneukirchen', '2023-12-02', '15:00', 'Karlsbad', '2023-12-02', '23:30', '50', 'Verein', NULL, '', '', 'SpVggGrün-Weiss Wernitzgrün', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'e24da16e-1c0b-4784-8869-892c3ad15bfe', 'https://api.lexoffice.io/v1/contacts/e24da16e-1c0b-4784-8869-892c3ad15bfe', '2024-03-31 07:44:36', NULL, 0),
(7, '2006', '15808', '8', 'Aleyna', 'Kaya', 'aleynakaya2605@gmail.com', '015752541077', 'read', 'Hin und Rückfahrt', 'Aachen', '2023-11-19', '7:00', 'Bottrop', '2023-11-19', '18:00', '15', 'Privat', NULL, '', '', '', '', '&#047;', '1', NULL, NULL, 'Nachfassen', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'aedf81b1-3398-4eb8-b4d4-b3d23f8a2860', 'https://api.lexoffice.io/v1/contacts/aedf81b1-3398-4eb8-b4d4-b3d23f8a2860', '2024-03-31 07:44:38', NULL, 0),
(8, '2007', '15809', '9', 'Maren', 'Töws', 'maren.toews@lremsbueren.de', '01606312329', 'read', 'Hin und Rückfahrt', 'Hanwische Straße 11, 48488 Emsbüren', '2023-12-11', '8:30', 'Jugendherberge Gemen, Gemen Borken', '2023-12-13', '15:00', '70', 'Schule&#047;Universität', NULL, '', 'Liudger-Realschule Emsbüren ', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '5478aaab-7099-4890-9841-88ba21153394', 'https://api.lexoffice.io/v1/contacts/5478aaab-7099-4890-9841-88ba21153394', '2024-03-31 07:44:40', NULL, 0),
(9, '2008', '15810', '10', 'Torsten', 'Franz', 'familiefranz.2018@gmail.com', '015738080840', 'read', 'Hin und Rückfahrt', 'Leipzig ', '2024-09-25', '5:00', 'Wiesn in München', '2023-11-25', '24:00', '28', 'Privat', NULL, '', '', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'f60df8d8-af14-4725-beb1-f58844de8aa0', 'https://api.lexoffice.io/v1/contacts/f60df8d8-af14-4725-beb1-f58844de8aa0', '2024-03-31 07:44:42', NULL, 0),
(10, '2009', '15811', '11', 'Torsten', 'Franz', 'familiefranz.2018@gmail.com', '015738080840', 'read', 'Hin und Rückfahrt', 'Leipzig ', '2024-09-25', '5:00', 'Wiesn in München', '2024-09-25', '24:00', '28', 'Privat', NULL, '', '', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'e0165e05-2764-4534-bf19-5baf69af896e', 'https://api.lexoffice.io/v1/contacts/e0165e05-2764-4534-bf19-5baf69af896e', '2024-03-31 07:44:44', NULL, 0),
(11, '2010', '15812', '12', 'Pamela', 'Drathjer ', 'pamela.drathjer@gmail.com', '015152553061', 'read', 'Hin und Rückfahrt', '26842 Ostrhauderfehn', '2024-10-04', '24:00', 'Flughafen Düsseldorf', '2024-10-11', '20:00', '11', 'Privat', NULL, '', '', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '5ee30cf7-64ea-40e0-b02f-f2291fa501a5', 'https://api.lexoffice.io/v1/contacts/5ee30cf7-64ea-40e0-b02f-f2291fa501a5', '2024-03-31 07:44:45', NULL, 0),
(12, '2011', '15813', '13', 'Claudia ', 'Yeler', 'yeler@dachdecker-sh.de', '04315477613', 'read', 'Hin und Rückfahrt', 'Kiel', '2024-05-23', '9:30', 'goslar', '2023-11-25', '10:00', '30', 'Verein', NULL, '', '', 'Dachdeckerinnung Kiel-Plön', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '833ad69a-1e39-495d-863a-7067646da209', 'https://api.lexoffice.io/v1/contacts/833ad69a-1e39-495d-863a-7067646da209', '2024-03-31 07:44:47', NULL, 0),
(13, '2012', '15814', '14', 'Hartmut', 'Brummack', 'hartmut.brummack@rbz-technik.de', '0431 1698 770', 'read', 'Hin und Rückfahrt', 'Geschwister-Scholl-Str. 9, 24143 Kiel', '2023-12-19', '8:00', 'Holstendamm 2, 25572 Büttel', '2023-12-19', '17:30', '44', 'Schule&#047;Universität', NULL, '', 'RBZ Technik', '', '', 'Sehr geehrte Damen und Herren,\r\nwir planen mit 44 Personen eine Betriebsbesichtigung bei der Firma\r\nYara Brunsbüttel GmbH\r\nHolstendamm 2 Büttel\r\nD-25572 Büttel, Germany\r\nam 19.12.2023.\r\nVorgesehenes Programm:\r\n08:15 Abfahrt am RBZ-Technik Kiel - Haupteingang\r\nAnreise bis 10:00 Uhr nach Büttel an der Pförtnerei , hier bitte einmal anmelden und ich hole Sie ab.\r\n    Kurze Unterweisung im Schulungsraum Ausbildung\r\n    Rundfahrt mit dem Bus durch die Anlage mit Erläuterungen Unterstützung von Herr Petersen\r\n    Stopp in der Harnstofflagerhalle BAU 651 – Herr Schmerder\r\n11:00 – 12:30 Uhr   Ausbildungszentrum und Labor jeweils eine Gruppe im Wechsel   Herrn Dunker &#047; Schwardt &#047; Petersen &#047; Schmerder\r\n12:30 – 13:00 Uhr   Mittagspause\r\n13:15 – 14:45 Uhr   Ausbildungszentrum und Labor jeweils eine Gruppe im Wechsel   Herrn Dunker &#047; Schwardt &#047; Petersen &#047; Schmerder\r\n14:45 -  15:15 Uhr   Fragestunde &#047; Abschlussgespräch mit  Herrn Dunker &#047; Schwardt &#047; Petersen &#047; Schmerder\r\n15:15 -  15:45 Uhr   Fahrt mit dem Bus in den Hafen Ostermoor ( Voraussetzung kein NH3 Schiff in Beladung) Herr Schmerder\r\n Ab 15:45 Uhr Heimfahrt nach Kiel\r\n17:30 Uhr Ankunft in Kiel - RBZ-Technik - Haupteingang', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'a902dd70-103c-4cd0-83ce-31f4d5695b38', 'https://api.lexoffice.io/v1/contacts/a902dd70-103c-4cd0-83ce-31f4d5695b38', '2024-03-31 07:44:49', NULL, 0),
(14, '2013', '15815', '15', 'Merdjan', 'Jakupov', 'info@amarodrom.de', '03061620011', 'read', 'Hin und Rückfahrt', 'Str. der Pariser Kommune 35, 10243 Berlin ', '2023-12-12', '9:00', 'D-16798 Fürstenberg I Straße der Nationen', '2023-12-12', '16:00', '34', 'Verein', NULL, '', 'Amaro Drom', 'Amaro Drom e.V.', '', 'Abfahrt erfolgt vor dem Hostel &quot; Pegasus Hostel Berlin&quot;  - Str. der Pariser Kommune 35, 10243 Berlin am 12.12.23 um 09:00Uhr zum Mahn- und Gedenkstätte Ravensbrück I Stiftung Brandenburgische Gedenkstätten\r\nD-16798 Fürstenberg I Straße der Nationen. Die Rückfahrt ist am gleichem Tag um 16 Uhr. \r\nEs werden insgesamt 34 Personen sein.\r\n', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'e2bbeaf8-d100-4c03-ba6f-812f8336253c', 'https://api.lexoffice.io/v1/contacts/e2bbeaf8-d100-4c03-ba6f-812f8336253c', '2024-03-31 07:44:51', NULL, 0),
(15, '2014', '15816', '16', 'Wendy', 'Daelman', 'WendyDaelman@gmx.net', '02384-941323', 'read', 'Hin und Rückfahrt', 'Ostbusch 5, 59514 Welver', '2024-03-02', '6:30', 'ARENA Kreis Düren, Nippesstr. 4, 52349 Düren', '2024-03-02', '22:00', '82', 'Verein', NULL, '', '', 'TV Flerke', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'f1e6f0de-fdaa-4f62-a92d-77d8871ddd2c', 'https://api.lexoffice.io/v1/contacts/f1e6f0de-fdaa-4f62-a92d-77d8871ddd2c', '2024-03-31 07:44:53', NULL, 0),
(16, '2015', '15817', '17', 'Marcel', 'Kaiser', 'm.kaiser@praxis-drmkaiser.de', '0170 4631626', 'read', 'Hin und Rückfahrt', 'Alte Oper, Frankfurt', '2023-11-25', '13:30', 'Deutsche Nationalbibliothek Frankfurt, Adickesallee 1', '2023-11-25', '15:30', '19', 'Privat', NULL, '', '', '', '', 'Suche Shuttle-Service für 19 Personen am 25. 11. 2023. Abfahrt um 13:30 Uhr an der Alten Oper, Frankfurt zur Deutschen Nationalbibliothek, Adickesallee 1. Rückfahrt gleicher Tag um 15:40 Uhr, dann zu Cafe Laumer in der Bockenheimer Landstraße 67. Jeweils 19 Personen. Bitte um Angebot. Danke.', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '556116b2-e674-4b63-bf20-2b1978a944fa', 'https://api.lexoffice.io/v1/contacts/556116b2-e674-4b63-bf20-2b1978a944fa', '2024-03-31 07:44:55', NULL, 0),
(17, '2016', '15818', '18', 'Ivonne ', 'Polauke ', 'hortkind0815@gmail.com', '+491799295769', 'read', 'Hin und Rückfahrt', 'Tieckstr 38, Fredersdorf Vogelsdorf ', '2024-03-11', '9:00', 'Frauensee 1 15754 Heidesee OT Gräbendorf', '2024-03-13', '12:30', '27', 'Schule&#047;Universität', NULL, '', 'Fred-vogel-grundschule', '', '', '', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, '99498794-15cb-4372-b157-8ea1a595561d', 'https://api.lexoffice.io/v1/contacts/99498794-15cb-4372-b157-8ea1a595561d', '2024-03-31 07:44:57', NULL, 0),
(18, '2017', '15819', '19', 'Jennifer ', 'Schmidt', 'jenny98schmidt@gmail.com', '01785801497', 'read', 'Hin und Rückfahrt', 'Frankfurt', '2023-11-25', '7:00', 'Bochum', '2023-11-25', '20:00', '59', 'Privat', NULL, '', '', 'Christ in ', '', 'Wir bräuchten bitte einmal hin und Rückfahrt nur. Vor Ort brauchen wir keine Fahrten. ', '1', NULL, NULL, 'Details', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'aea766a3-80d2-487e-bee4-7cca343f0eff', 'https://api.lexoffice.io/v1/contacts/aea766a3-80d2-487e-bee4-7cca343f0eff', '2024-03-31 07:44:59', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
