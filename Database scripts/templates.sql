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
-- Структура таблицы `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `domain_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(45) NOT NULL DEFAULT '',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `style` varchar(20) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `DOMAINID` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `templates`
--

INSERT INTO `templates` (`id`, `name`, `description`, `is_deleted`, `domain_id`, `lang`, `is_admin`, `style`, `type`) VALUES
(1, 'light', 'Begin', 0, 1, 'ru', 0, 'light', 'index'),
(2, 'light', 'Admin', 0, 1, 'ru', 1, 'light', 'index'),
(3, 'default_index', 'Begin', 0, 1, 'ru', 0, 'default', 'index'),
(4, 'default_pages', 'Begin', 0, 1, 'ru', 0, 'default', 'pages');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `FK_DOMAIN` FOREIGN KEY (`domain_id`) REFERENCES `domens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
