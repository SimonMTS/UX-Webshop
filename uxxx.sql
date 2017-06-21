-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 jun 2017 om 16:52
-- Serverversie: 10.1.10-MariaDB
-- PHP-versie: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uxxx`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `game`
--

CREATE TABLE `game` (
  `id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(10) NOT NULL,
  `descr` longtext NOT NULL,
  `cover` varchar(256) NOT NULL,
  `views` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `game`
--

INSERT INTO `game` (`id`, `name`, `price`, `descr`, `cover`, `views`) VALUES
('5937af0d2b36c820981205', 'For Honor', 60, 'For Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.', 'assets/img/forhonor.jpg', 36),
('5937af0d6569c468558245', 'Red Dead Redemtion 2', 60, 'Red Dead Redemption 2 is een action-adventurespel in ontwikkeling bij verschillende Rockstar studio''s. Het spel wordt uitgegeven door Rockstar Games en zal in de lente van 2018 uitkomen voor PlayStation 4 en Xbox One.or Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.', 'assets/img/rdr2.jpg', 8),
('5937af0d95eea244515985', 'Resident Evil 7', 60, 'Resident Evil 7: Biohazard is een survival horror-spel ontwikkeld en uitgegeven door Capcom. Het spel werd in januari 2017 wereldwijd uitgebracht voor Windows, PlayStation 4 en Xbox One. De PlayStation 4-versie ondersteunt PlayStation VR.', 'assets/img/res7.jpg', 2),
('5937af0d9e485477646037', 'Middle-earth: Shadow of War', 60, 'Middle-earth: Shadow of War is een action-adventurespel in ontwikkeling bij Monolith Productions. Het spel wordt uitgegeven door WB Games en zal in Europa op 25 augustus 2017 uitkomen voor de PlayStation 4, Windows en de Xbox One.', 'assets/img/shadowofwar.jpg', 1),
('5937af0dad207904318043', 'The Legend of Zelda Breath of the Wild', 60, 'The Legend of Zelda: Breath of the Wild is een action-adventure-computerspel dat ontwikkeld is door Nintendo met een team onder leiding van ontwerper Eiji Aonuma.', 'assets/img/zeldabotw.jpg', 13),
('5937af0dc9d01675431110', 'Mass Effect: Andromeda', 60, 'Mass Effect: Andromeda is een actierollenspel ontwikkeld door BioWare en uitgebracht door Electronic Arts voor PlayStation 4, Xbox One en Windows. Het spel werd wereldwijd uitgebracht in maart 2017.', 'assets/img/masseffect.jpg', 3),
('5937af0dd1ef5167887134', 'Tom Clancy''s Ghost Recon Wildlands', 60, 'Tom Clancy''s Ghost Recon Wildlands is een tactisch schietspel ontwikkeld door Ubisoft Paris. Het spel werd op 7 maart 2017 uitgebracht voor Windows, PlayStation 4 en Xbox One.', 'assets/img/ghostrecon.jpg', 2),
('5937af0ddf66a931028384', 'Horizon Zero Dawn', 60, 'Horizon Zero Dawn is een actierollenspel ontwikkeld door Guerrilla Games. Het spel wordt uitgegeven door Sony Interactive Entertainment en is in Europa op 1 maart 2017 uitgekomen voor de PlayStation 4.', 'assets/img/horizon.jpg', 33),
('5937af0de4f42073588856', 'Test Game 1', 60, 'ksdj jf sdjf sdj fsdjf', 'assets/img/59438497d24e347202493101_Multimeter_Tutorial-04.jpg', 64),
('5937af0dea3fa326635724', 'Test Game 2', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 5),
('5937af0e00e6e960484822', 'Test Game 3', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 2),
('5937af0e06618500134428', 'Test Game 4', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e13e2a627269263', 'Test Game 5', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e2938d479588177', 'Test Game 6', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e3f48a200308692', 'Test Game 7', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e4a453358809404', 'Test Game 8', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e5246d879245352', 'Test Game 9', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 1),
('5937af0e5511c342337742', 'Test Game 10', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e5a6d3006195198', 'Test Game 11', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e5ff78970581099', 'Test Game 12', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e67fbc870773335', 'Test Game 13', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e6d8a2841028600', 'Test Game 14', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e72d63269408533', 'Test Game 15', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e82423139403204', 'Test Game 16', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e90ad5009485913', 'Test Game 17', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e962c4655725052', 'Test Game 18', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0e9b8c3883643493', 'Test Game 19', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0),
('5937af0ea11a1564063025', 'Test Game 20', 60, 'Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.', 'assets/img/noPicture.png', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `game_order`
--

CREATE TABLE `game_order` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `game_name` varchar(256) NOT NULL,
  `game_id` varchar(256) NOT NULL,
  `amount` int(10) NOT NULL,
  `method` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `paidDatetime` varchar(256) NOT NULL,
  `details_consumerName` varchar(256) NOT NULL,
  `details_consumerAccount` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `game_order`
--

INSERT INTO `game_order` (`id`, `user_id`, `game_name`, `game_id`, `amount`, `method`, `status`, `paidDatetime`, `details_consumerName`, `details_consumerAccount`) VALUES
('3WE4rgkJVj', '591acd7a744f2478214843', 'Tom Clancy''s Ghost Recon Wildlands', '5937af0dd1ef5167887134', 60, 'paypal', 'paid', '2017-06-20T10:20:55.0Z', 'Test Consumer', 'consumer@example.com'),
('B857SJTus2', '591acd7a744f2478214843', 'Mass Effect: Andromeda', '5937af0dc9d01675431110', 60, 'banktransfer', 'paid', '2017-06-20T10:20:34.0Z', 'T. TEST', 'NL91ABNA0417164300'),
('hrEnGvVyvz', '591acd7a744f2478214843', 'For Honor', '5937af0d2b36c820981205', 60, 'belfius', 'paid', '2017-06-20T10:37:51.0Z', 'Achiel Peeters', 'BE91777000000076'),
('HT3RFnBGEx', '591acd7a744f2478214843', 'The Legend of Zelda Breath of the Wild', '5937af0dad207904318043', 60, 'sofort', 'paid', '2017-06-20T10:20:14.0Z', 'Musterman, Petra', 'DE89370400440532013000'),
('J2MhqqhVFy', '591acd7a744f2478214843', 'Red Dead Redemtion 2', '5937af0d6569c468558245', 60, 'creditcard', 'paid', '2017-06-20T10:19:43.0Z', 'unknown', 'unknown'),
('TrcgP8228F', '591acd7a744f2478214843', 'Resident Evil 7', '5937af0d95eea244515985', 60, 'paysafecard', 'paid', '2017-06-20T10:38:13.0Z', 'unknown', 'unknown'),
('UKDzn7Angp', '591acd7a744f2478214843', 'Red Dead Redemtion 2', '5937af0d6569c468558245', 60, 'kbc', 'paid', '2017-06-20T10:38:03.0Z', 'Koen Willems', 'BE06447000000022'),
('VHvzq7qEHU', '591acd7a744f2478214843', 'For Honor', '5937af0d2b36c820981205', 60, 'mistercash', 'paid', '2017-06-20T10:07:04.0Z', 'unknown', 'unknown'),
('yrA9JWEdCA', '591acd7a744f2478214843', 'Resident Evil 7', '5937af0d95eea244515985', 60, 'mistercash', 'paid', '2017-06-20T10:19:54.0Z', 'unknown', 'unknown'),
('zyMqzTcMjE', '591acd7a744f2478214843', 'Horizon Zero Dawn', '5937af0ddf66a931028384', 60, 'bitcoin', 'paid', '2017-06-20T10:21:24.0Z', 'unknown', 'unknown');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `role` int(6) NOT NULL,
  `pic` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `salt`, `role`, `pic`) VALUES
('591acd7a744f2478214843', 'Simon', '24d802b145245d7fc4400c898af6eddc8e89dd05506f2af39b2612ead8970e31b8522aab07d51c1de0068768ad2ab3fcdf33d66da3ea878ceaf656f469e581dc', '', 777, 'assets/img/594382081949606429440021697_original.jpg'),
('5937ab63cce8e960615900', 'test01', '1f5680fe6d39fdffdc68fae731be329e018f665fdf83cd4f196e3b3b59aa8e9108e399b053cfc654c21d9f2c795742e55fae93493bf8bebe4bd261ba4c4aff52', '', 1, 'assets/img/5943885f47713312928727catfish.jpg'),
('5937ac17ebde5613244338', 'test02', 'e8cd83d585d557af4a830674cbbe2a5ce54e0c86e2eb31a8e80b8b8964d4ccf0ac576c5bbc3e2730c134a10fd0a0e6d80c3a631f0115ccf91e751ef343947fc5', '', 1, 'assets/img/user.png'),
('5937ace41154a103245194', 'test03', '2f73167b08ba331a17b72c3f6d52ebbf8267765c78f51fbe09aba6e32a6069a53842235eac3c2fc5f283babc229946e8afe74dd54bf1d68f0c6888a010865b18', '', 1, 'assets/img/user.png'),
('5937b26d8389e571803395', 'test07', '860d0b5eaa5483dac470b26fd07aa345a777baaa32cd8de63a714817ff655e4a63a36e6c4e99641be4988903ea7cf507676aa2d8338a867f3fb595bc2ae284a5', '', 1, 'assets/img/user.png'),
('5937ccb890e00359844796', 'test1', 'b16ed7d24b3ecbd4164dcdad374e08c0ab7518aa07f9d3683f34c2b3c67a15830268cb4a56c1ff6f54c8e54a795f5b87c08668b51f82d0093f7baee7d2981181', '', 1, 'assets/img/user.png'),
('5937ccb930abd185766412', 'test2', '6d201beeefb589b08ef0672dac82353d0cbd9ad99e1642c83a1601f3d647bcca003257b5e8f31bdc1d73fbec84fb085c79d6e2677b7ff927e823a54e789140d9', '', 1, 'assets/img/user.png'),
('5937ccb942259056381081', 'test3', 'cb872de2b8d2509c54344435ce9cb43b4faa27f97d486ff4de35af03e4919fb4ec53267caf8def06ef177d69fe0abab3c12fbdc2f267d895fd07c36a62bff4bf', '', 1, 'assets/img/user.png'),
('5937ccb94a477589496677', 'test4', '2257aab44b42813142aa8ac4767116ad5bd41e94a79aa0672cc962128ed4809f50ed38d35ba945a80799976c9efa9b686f28d18036134bc2bb0ac2de96ec6280', '', 1, 'assets/img/user.png'),
('5937ccb9525da566694075', 'test5', '64c26ffe3b35c65dfb93a8fd9a91828c57ed76d3809d06b03e17128125b48e5d01b37bb605a0a0305eff8341fbd56096664597f5cd091bf036e4ca31b304a9cc', '', 1, 'assets/img/user.png'),
('5937ccb955239629658940', 'test6', '30634fc2dd28e412a684771875fd805747fb3bd9760a085efb554a0a4233223a4d98f6da2336179ca33d1170e6e27b18be4588978c35115a43aef6ddc226c808', '', 1, 'assets/img/user.png'),
('5937ccb957b61845116688', 'test7', 'cee1ffdc30e05765a4b478378902339d7ebe426574d04eaf04a4c943cb9b499dcaeb7665fd5c3bd39bcd92945442a3687d901c406a2d8eb956d54ec757d33a76', '', 1, 'assets/img/user.png'),
('5937ccb95a923628436891', 'test8', '9d8c92f94dfc83818245501756afcfb5ca850ebd488a9b0bc195f1c026d98306e13a9c86aa423ca1c2e87c9e0f187bd465306930c25b596ff4e23be21b6037b0', '', 1, 'assets/img/user.png'),
('5937ccb95fee6039832001', 'test9', '0b3d1be846a4812b7043157e6e95d720341bff4dc1e437dd26ba96cec8735c9c74ebcf770cb0fe45dd3e4d04cd59b026240d540db03abf10b1f6e2f4dafcadce', '', 1, 'assets/img/user.png'),
('5937ccb968345998968323', 'test10', '763d665f054d187c0ecdeaae277cdcfefd986378befb18b5f232997a3c4c802ed317ee64e7bb91ff5be50f09e4cbd11176488a4982de05bf075b02c84385a525', '', 1, 'assets/img/user.png'),
('5937ccb96d752605790127', 'test11', 'b29a87341af71f2a8a3da8fb4ad4dc2ba17dd4b7ffb9a6c20ec7c24b8f2f8fdebf5b14bf72efb2ddf4637b66d00a178a8683f028c3903fb94032fea199246f80', '', 1, 'assets/img/user.png'),
('5937ccb970477713700204', 'test12', '3f08b178cf44b2ba1745bd72cf6c7db6f5097385511e85ca9f210f12376ea0a43bc8323b0ec4a6b92c5ab3912bb7cc1b4b043ac811f664ba4af7f3c51974935c', '', 1, 'assets/img/user.png'),
('5937ccb980257094028700', 'test13', 'dd21c93f6078b4f46095d4a02b3af2cb14dca8d6f3234d7561f3063a4a457039849fd893c06982c6a4c2887038501240ceec2fe1b72ea5d47e42bb497ebb4204', '', 1, 'assets/img/user.png'),
('5937ccb988c9a592158479', 'test14', '34cd3f0aaeb346ae2c3b0153583d6308dc77c0c2cee97da5dcd4537b52aae6e71610acb44d79465d28438c6f37d00e3c15284c9b0ffdc9048af320985d3fa144', '', 1, 'assets/img/user.png'),
('5937ccb98e01d316724135', 'test15', '018523c54a860ac1e571dc00860cafecebf7a355c5de9d4d8379c1d71a7d1d7fae21c7e4ffdfd0d2093b4b6005536a3a778f7edd0c36324e5b335c5a7c183b2a', '', 1, 'assets/img/user.png'),
('5937ccb9990b2603094191', 'test16', 'c5eecd8c9b6f354081da30182252b1b3836e685faeec825ec67b13a946d66aa93f02dec8c787527e5683b212f84bc313c76607e25dd502d3e3ba2f981c9ddee2', '', 1, 'assets/img/user.png'),
('5937ccb99e489261085315', 'test17', '3155f11a99b480ed77307e7e04f0c0e55485c21cf1cf41b021df6852d5150ec4a90e7cf55c4df253b22a23edef157fc643666f8fa8050114246630a679315592', '', 1, 'assets/img/user.png'),
('5937ccb9a3e75427712991', 'test18', '45dc30bf5dc3abefcd499e95251d4d25a32ddb672fc7aa39e574ae3985b32be3f0494ad5aab9bdd4631f56fe4b32cd27c48f0b6457fc2883ec45443e1e53b695', '', 1, 'assets/img/user.png'),
('5937ccb9a9219097661896', 'test19', 'a02289a978c64dc08e5afa3c603b339dea9a7502edca04dd43250d33b27e77798d1e174509168418ae3d01e7578e901553e6e1be839c27f25c98f02990d4efb9', '', 1, 'assets/img/user.png'),
('5937ccd233c78092660784', 'test20', '1ed6698314bffb1731c524873210ca9a870df546afc88e33deec8a0cdc8b4ac76c8e1a65d4c3d7c3ac14ada481d479d9b6a64cd46caee635a99112a5432a6bea', '', 1, 'assets/img/user.png'),
('59424f3a30288893880130', 'salt1', '72a8a6602d3d2f1fea84287a5b875bb1c8fc4d1bb627fcab66556f7a69bb9c114ce01afa6748ab164deb3c2815f00329c112f2f007f04ca48e7b0fa1cddf26c9', '59424f3a3027c187415497', 1, 'assets/img/59424f3a2a09d594617674Bass-trombone.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `game_order`
--
ALTER TABLE `game_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
