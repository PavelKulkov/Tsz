-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 23 2013 г., 17:38
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `regportal_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `module_location`
--

CREATE TABLE IF NOT EXISTS `module_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_module` int(10) unsigned NOT NULL DEFAULT '0',
  `locationNum` int(10) unsigned DEFAULT NULL,
  `id_template` int(10) unsigned NOT NULL DEFAULT '0',
  `id_locationType` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_module` (`id_module`,`locationNum`) USING BTREE,
  KEY `temp_mod` (`id_template`,`id_module`) USING BTREE,
  KEY `id_template` (`id_template`),
  KEY `id_locationType` (`id_locationType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Разположение модулей' AUTO_INCREMENT=213 ;

--
-- Дамп данных таблицы `module_location`
--

INSERT INTO `module_location` (`id`, `id_module`, `locationNum`, `id_template`, `id_locationType`) VALUES
(158, 3, 53, 1, 1),
(159, 1, 1, 1, 1),
(160, 4, 51, 1, 1),
(161, 4, NULL, 1, 2),
(162, 5, 0, 1, 2),
(175, 6, 7, 1, 2),
(176, 7, 37, 1, 2),
(177, 8, NULL, 1, 2),
(178, 9, 17, 2, 1),
(179, 5, 51, 2, 2),
(180, 3, 53, 2, 1),
(181, 4, 51, 2, 2),
(182, 10, NULL, 1, 2),
(183, 11, 53, 1, 2),
(185, 3, NULL, 2, 2),
(186, 9, 17, 1, 1),
(187, 12, 14, 1, 1),
(188, 12, 14, 2, 1),
(189, 13, NULL, 1, 2),
(190, 14, 55, 1, 1),
(191, 14, NULL, 1, 2),
(192, 13, NULL, 2, 2),
(193, 17, 666, 1, 1),
(194, 17, 666, 3, 1),
(195, 18, 667, 3, 1),
(196, 12, 14, 3, 1),
(197, 9, 17, 3, 1),
(199, 4, NULL, 3, 2),
(200, 4, 51, 3, 1),
(201, 10, NULL, 3, 2),
(202, 4, 51, 4, 1),
(203, 4, NULL, 4, 2),
(204, 9, 17, 4, 1),
(205, 12, 14, 4, 1),
(206, 18, 667, 4, 1),
(207, 17, 666, 4, 1),
(208, 10, NULL, 4, 2),
(209, 16, 16, 3, 1),
(210, 7, 37, 3, 2),
(211, 5, 0, 3, 2),
(212, 5, 0, 4, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `module_location`
--
ALTER TABLE `module_location`
  ADD CONSTRAINT `FK_LOCATIONTYPE` FOREIGN KEY (`id_locationType`) REFERENCES `locationtype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MODULE` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TEMPLATE` FOREIGN KEY (`id_template`) REFERENCES `templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
