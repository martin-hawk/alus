-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 07:23 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alus`
--

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE `beers` (
  `id` int(11) NOT NULL,
  `brewer_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/bokalas.png',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `show_name` tinyint(1) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `show_description` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `beers`
--

INSERT INTO `beers` (`id`, `brewer_id`, `active`, `image`, `name`, `show_name`, `description`, `show_description`) VALUES
(1, 1, 1, 'images/varniuku.png', 'Alus „Varniukų“', 1, 'Tai 5,6 % stiprumo, juodas alus, turintis maloniai saldoką skonį, primenantis močiutės ruginės duonos, bei avižų giros skonį. Silpnas apynių aromatas. Galima ragauti ir gerai pašildytą, įdedant į alų citrinos skiltelę. Šiam alui suteiktas kulinarijos paveldo statusas.', 1),
(2, 1, 1, 'images/chicagos.png', 'Alus „Chicago\'s“', 1, '„Chicago‘s“ alus skirtas aludarių Daujotų giminės senelio ir prosenelio Juozapo Selenio garbei paminėti.\n\n„Chicago‘s“ alus simbolizuoja tradicijos ir istorijos skonį, pasižymi išraiškinga raudonmedžio spalva, o kavos ir karamelės aromatas nustelbiamas gaivaus apynių kartumo. Šis alus – neabejotinas žvarbių rudens ir žiemos vakarų kompanionas.', 1),
(3, 1, 1, 'images/daujotu.png', 'Alus „Daujotų“', 1, 'Lengvas, gintaro spalvos, silpnesnio alaus megėjams. Tai pats populiariausias alaus darykloje ,,Davra\" verdamas alus. Patobulinta receptūra - dar daugiau apynių aromato, dar daugiau išraiškingesnio skonio. Šiam alui taii pat suteiktas kulinarijos paveldo statusas.', 1),
(4, 2, 1, 'images/vilniaus_nefiltruotas.png', 'NEFILTRUOTAS', 1, 'Šis alus gaminamas pagal klasikinę technologiją iš vandens, šviesaus miežių salyklo, karčiųjų bei aromatinių apynių ir alaus mielių. Ilgo brandinimo metu susiformuoja išskirtinis alaus skonis ir aromatas, natūraliai įsotinta angliarūgštė suteikia alui ilgai išliekančią standžią putą. Gamybos metu neatskiriamos mielės, kuriose gausu baltymų, mineralinių medžiagų bei B grupės vitaminų.', 1),
(5, 2, 1, 'images/vilniaus_kvietinis.png', 'KVIETINIS', 1, 'Šis alus gaminamas iš vandens, miežinio ir kvietinio salyklo, apynių ir alaus mielių. Šis alus ypatingai gaivus ir lengvas, šiek tiek karstelėjęs, išsiskiriantis vos juntamu vaisių prieskoniu. Gamybos metu neatskirtos alaus mielės suteikia alui balkšvą matinį atspalvį.', 1),
(6, 2, 1, 'images/vilniaus_tamsusis.png', 'TAMSUSIS', 1, 'Šis alus gaminamas pagal klasikinę technologiją iš vandens, šviesaus miežių salyklo ir karamelinio salyklo, apynių bei alaus mielių. Ilgo brandinimo metu natūraliai įsotinta angliarūgštė suformuoja ilgai išliekančią standžią putą. Alus pasižymi sodria tamsia spalva, salstelėjusiu karamelės prieskoniu ir maloniu aromatu.', 1),
(7, 3, 1, 'images/senasis_porteris.png', 'SENASIS PORTERIS', 1, '7,0 % tūrio alkoholio tamsusis alus. Jo sudėtyje yra karamelinio salyklo, kuris suteikia itin malonų aromatą, subtilų ir harmoningą skonį.', 1),
(8, 6, 1, 'images/jurgenborg.png', 'JURGENBORG', 1, '“Jurgenborg” alus – tai lagerio tipo šviesusis alus, kurio stiprumas 4,8 tūrio proc.<br>\r\nJis verdamas iš šviesaus Pilzeno tipo salyklo, atrinktų aromatinių apynių, naudojamos lagerio mielės.\r\n<br>\r\nBrandinamas ilgiau, kad jame geriau atsiskleistų alaus kūningumas bei kilmingų apynių aromatas.\r\n<br>\r\nŠis alus 2014 m Pakruojo ‘Amatų-muzikos-alaus festivalyje” tarptautinės ekspertų komisijos įvertintas I vieta ir”Rinkis prekę lietuvišką 2014” diplomu.', 1),
(9, 6, 1, 'images/tamsusis_666.png', 'TAMSUSIS 666', 1, 'Tai 6 tūrio proc. stiprumo, juodasis alus. Gaminamas iš keturių rūšių salyklo, juos kruopščiai suderinus, siekiant išgauti tik šiai rūšiai būdingą skonį. Alus pasižymi tamsia spalva ir sodria puta.\r\n<br>\r\nSkonyje dominuoja saldus salyklas, nustelbiantis vos juntamą apynių kartumą ir aromatą.\r\n<br>\r\nŠiam alui suteiktas kulinarijos paveldo statusas. Taip pat įvertintas “Rinkis prekę lietuvišką 2013” diplomu.', 1),
(10, 7, 1, 'images/pasvale_krasta.png', 'PASVALE KRAŠTA', 1, '', 0),
(11, 4, 1, 'images/birzieciu_standartas.png', 'BIRŽIEČIŲ STANDARTAS', 1, '', 0),
(12, 4, 1, 'images/rinkuskiu_nefiltruotas.png', 'RINKUŠKIŲ NEFILTRUOTAS', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brewers`
--

CREATE TABLE `brewers` (
  `id` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `show_name` tinyint(1) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `show_description` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brewers`
--

INSERT INTO `brewers` (`id`, `image`, `name`, `show_name`, `description`, `show_description`) VALUES
(1, 'images/davra.png', 'DAVRA', 1, '', 0),
(2, 'images/vilniaus_alus.png', 'VILNIAUS ALUS', 1, '', 0),
(3, 'images/kauno_alus.png', 'KAUNO ALUS', 1, '', 0),
(4, 'images/rinkuskiai.png', 'RINKUŠKIŲ ALAUS DARYKLA', 1, '', 0),
(5, 'images/gubernija.png', 'GUBERNIJA', 1, '', 0),
(6, 'images/armeniukas.png', 'ARMENIUKAS', 1, '', 0),
(7, 'images/alsteka.png', 'ALSTEKA', 1, '', 0),
(8, 'images/joalda.png', 'JOALDA', 1, '', 0),
(9, 'images/sirvenos_bravoras.png', 'ŠIRVĖNOS BRAVORAS', 1, '', 0),
(10, 'images/sirvenos_bravoras.png', 'PANEVĖŽIO ALUS', 1, '“Panevėžio alus” – mažoji alaus darykla, Lietuviško kapitalo įmonė, veikianti Senamiesčio gatvėje Panevėžyje. Ši alaus darykla buvo įkurta 1997 m., iš pradžių ji buvo pavadinta “TAURA” 2013 metais pavadinimas pakeistas į “Panevėžio alus”.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `content`) VALUES
(1, 'Apie AlusLT', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus in sem risus. Nunc suscipit condimentum nisi, quis maximus erat fringilla ut. Duis consectetur cursus massa in elementum. Donec hendrerit leo at eros venenatis, ut porta nunc rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis vestibulum odio. Etiam laoreet eros at fermentum vehicula. Nunc nec pretium ligula. Nullam fermentum sodales tincidunt. Praesent congue venenatis porta. Aliquam commodo dignissim eros. In velit erat, varius a nisi et, auctor mollis nunc. Nam congue lectus eget justo tempor, sed laoreet purus dapibus. Aliquam at nisl eros. In et lacus in tellus molestie tempus. Ut pretium augue eu ipsum posuere rutrum.</p>\r\n\r\n<p>Maecenas blandit, quam efficitur finibus egestas, dui metus pharetra sapien, ut luctus lacus justo vel leo. Aliquam finibus feugiat lectus ut sodales. Proin porttitor rutrum vulputate. Vestibulum sit amet sapien rutrum, rutrum tortor non, maximus eros. Cras sit amet mauris laoreet sapien sollicitudin molestie sed et mi. Nullam massa diam, rutrum eu elit vitae, pretium viverra lacus. Proin a sodales magna, et scelerisque arcu. Ut eget lacus pretium, bibendum lacus eget, malesuada leo. In hac habitasse platea dictumst. Nunc nibh tortor, finibus nec risus et, fringilla faucibus risus. Cras sagittis mi massa. Integer at odio commodo, accumsan ipsum ac, viverra orci.</p>\r\n'),
(2, 'Kontaktai', '<div style=\"text-align:center\">\n<p>AlusLT.lt parduotuvė</p>\n\n<p>J. Basanavičiaus g. 44 / Muitinės g. 43, Vilnius</p>\n\n<p>Tel.: +370 683 28127</p>\n\n<p>El. pa&scaron;tas: mbavilus@gmail.com</p>\n\n<p>Sekite mus <a href=\"https://www.facebook.com/lietuviskasalus\" target=\"_blank\"><img alt=\"\" src=\"images/facebook.png\" /></a></p>\n\n<p>Dėl &scaron;iuo metu parduodamų&nbsp;alaus rū&scaron;ių galite pasitikslinti&nbsp;telefonu.&nbsp;&nbsp;</p>\n\n<p><iframe allowfullscreen=\"\" frameborder=\"0\" height=\"450\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2306.6717585920846!2d25.259490202023077!3d54.68020556233332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd94735fd00381%3A0xe5f8d764b0636a45!2sMuitin%C4%97s+g.+43%2C+Vilnius+03116!5e0!3m2!1slt!2slt!4v1458202357227\" style=\"border:0\" width=\"600\"></iframe></p>\n</div>\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brewers`
--
ALTER TABLE `brewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`username`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beers`
--
ALTER TABLE `beers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brewers`
--
ALTER TABLE `brewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
