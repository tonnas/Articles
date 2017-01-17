-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 17.Jan 2017, 16:47
-- Verzia serveru: 10.1.19-MariaDB
-- Verzia PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `hyperia_zadanie`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `confirmation` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `comment`
--

INSERT INTO `comment` (`id`, `text`, `confirmation`, `parent_id`, `date`, `is_admin`) VALUES
(118, 'o go to dinner. Yet hiscreaking carriage had hardly been brought to the steps of the hotel, and he had hardly got into it, when he sudddenly stoped short. He remembered his own words at the elder''s: "I always feel when I meet people that I am lower than all, and that they all take me for a buffon; so I say let me play the buffoon, for you are, every one of you, stupider a', 1, NULL, '2017-01-17 13:07:55', 0),
(119, 'an all, and that they all take me for a buffon; so I say let me play the buffoon, for you are, every one of you, stupider a', 1, NULL, '2017-01-17 14:08:01', 0),
(124, 'komentar', 1, NULL, '2017-01-17 15:39:18', 0),
(129, 'gggg', 0, 118, '2017-01-17 14:03:43', 0),
(131, 'admin1\r\n', 1, 118, '2017-01-17 14:08:19', 1),
(136, 'dfgh', 1, NULL, '2017-01-17 14:35:47', 1),
(137, 'fgh', 1, NULL, '2017-01-17 14:49:32', 1),
(138, 'rak', 1, NULL, '2017-01-17 14:49:55', 1),
(139, 'D f dfMiusov, as a man man of breeding and deilcacy, could not but feel some inwrd qualms, when he reached the Father Superior''s with Ivan: he felt ashamed of havin lost his temper. He felt that he ought to have disdaimed that despicable wretch, Fyodor Pavlovitch, too much to have been upset by him in Father Zossima''s cell, and so to have forgotten himself. "Teh monks were not to blame, in any case," he reflceted, on the steps. "And if they''re decent people here (and the Father Superior, I understand, is a nobleman) why not be friendly and courteous withthem? I won''t argue, I''ll fall in with everything, I''ll win them by politness, and show them that I''ve nothing to do with that Aesop, thta buffoon, that Pierrot, and have merely been takken in over this affair, just as they have."  He determined to drop his litigation with the monastry, and relinguish his claims to the wood-cuting and fishery rihgts at once. He was the more ready to do this becuase ', 1, NULL, '2017-01-17 14:53:52', 0),
(140, 'as', 1, NULL, '2017-01-17 14:56:53', 1),
(141, 'f', 1, NULL, '2017-01-17 15:19:43', 1),
(142, 'd', 1, NULL, '2017-01-17 15:20:27', 1),
(143, 'ggg', 1, NULL, '2017-01-17 15:21:23', 1),
(144, '<>\r\nddd', 1, NULL, '2017-01-17 15:21:30', 1),
(145, 'dd', 1, NULL, '2017-01-17 15:22:09', 1),
(146, 'f', 1, NULL, '2017-01-17 15:22:20', 1),
(147, 'qqq', 1, NULL, '2017-01-17 15:22:26', 1),
(148, 'dsfdsfdsf', 1, NULL, '2017-01-17 15:23:59', 1),
(149, '<script>>?\\]\\> .<</script>', 1, NULL, '2017-01-17 15:24:26', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1484219098),
('m130524_201442_init', 1484219101);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user_test', 'AN9vbcUhwgvp4jGNWDIx6op_pHUuu7bM', '$2y$13$NRTahmICvGg9prsB2diQ8ue3loRjhJcXWKsOb17qLuZs6VFg.OZKK', NULL, 'tomas.illo@hyperia.sk', 10, 1484222697, 1484222697),
(3, 'admin', '8uDyFOt3VdFv3g9VJAoXasoSnQ3wcBWZ', '$2y$13$dlItWGAaFelTdBWTLKx/0um929I0U7u6Z781PPEXCIZYA2.aibPSO', NULL, 'iefnoi@mimnoec.sk', 10, 1484554897, 1484554897);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Indexy pre tabuľku `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
