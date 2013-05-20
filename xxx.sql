-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 20 2013 г., 10:00
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `xxx`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'SuperAdmin', '2013-05-18 00:00:00', '2013-05-18 00:00:00'),
(2, 'Moderator', '2013-05-19 08:40:27', '2013-05-19 08:40:27'),
(3, 'User', '2013-05-19 00:00:00', '2013-05-19 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_permissions`
--

CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` char(36) NOT NULL,
  `permission_id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `groups_permissions`
--

INSERT INTO `groups_permissions` (`id`, `group_id`, `permission_id`) VALUES
(2, '2', '1'),
(3, '2', '2'),
(4, '3', '3'),
(5, '3', '4'),
(6, '3', '5'),
(7, '2', '7'),
(8, '3', '7');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `groups_users`
--

INSERT INTO `groups_users` (`id`, `group_id`, `user_id`) VALUES
(1, '1', '1'),
(2, '2', '2'),
(3, '2', '3'),
(4, '3', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created`, `modified`) VALUES
(1, '*:*', '2013-05-18 00:00:00', '2013-05-18 00:00:00'),
(2, 'posts:*', '2013-05-19 08:39:56', '2013-05-19 08:39:56'),
(3, 'posts:edit', '2013-05-19 00:00:00', '2013-05-19 00:00:00'),
(4, 'posts:add', '2013-05-19 00:00:00', '2013-05-19 00:00:00'),
(5, 'posts:delete', '2013-05-19 00:00:00', '2013-05-19 00:00:00'),
(6, 'posts:delete', '2013-05-19 00:00:00', '2013-05-19 00:00:00'),
(7, 'tags:*', '2013-05-19 00:00:00', '2013-05-19 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` smallint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `message`, `created`, `modified`, `user_id`) VALUES
(10, 'fdgfs', 'fdsfw34', 'feds', '2013-05-13 10:48:51', '2013-05-13 10:48:51', 1),
(11, '4324', 'rewf', 'cfds', '2013-05-13 10:49:04', '2013-05-13 10:49:04', 0),
(12, 'dsasdv', 'vsdvd', 'vds', '2013-05-13 11:00:41', '2013-05-13 11:00:41', 1),
(13, '11111111', '11111111', '111111111', '2013-05-13 11:00:52', '2013-05-13 11:00:52', 0),
(15, '333333', '44444433', '33', '2013-05-13 11:01:12', '2013-05-13 11:01:12', 0),
(16, '444', '44', '44', '2013-05-13 11:01:20', '2013-05-13 11:01:20', 0),
(17, '55', '55', '55dew', '2013-05-13 11:01:27', '2013-05-19 11:31:01', 0),
(18, '66', '66', '66', '2013-05-13 11:01:35', '2013-05-13 11:01:35', 2),
(19, '77', '777', '7', '2013-05-13 11:01:42', '2013-05-13 11:01:42', 0),
(20, '88', '88', '88k', '2013-05-13 11:01:49', '2013-05-19 11:43:41', 0),
(22, '00', '76dejhk', '76', '2013-05-13 11:02:04', '2013-05-19 11:43:54', 0),
(23, 'fds', 'fds', 'fds7', '2013-05-13 20:22:22', '2013-05-19 11:25:42', 0),
(24, 'fdsf', 'fdsfds', 'fds', '2013-05-13 23:42:54', '2013-05-13 23:42:54', 4),
(25, 'dasda', 'dasdsa', 'dasda', '2013-05-13 23:53:08', '2013-05-13 23:53:08', 4),
(27, 'ljlkj', 'jlj', 'kj;', '2013-05-19 09:18:30', '2013-05-19 09:18:30', 3),
(29, 'xxx', 'xxx', 'xxx', '2013-05-19 11:16:16', '2013-05-19 11:16:16', 4),
(32, 'sss', 'sfsdfs', 'fsdfsdfsdfdsfds', '2013-05-19 19:14:47', '2013-05-19 19:14:47', 4),
(33, 'ew', 'ew', 'ew', '2013-05-19 19:22:58', '2013-05-19 19:22:58', 4),
(34, 's', 's', 's', '2013-05-19 19:24:20', '2013-05-19 19:24:20', 4),
(35, 'xsa', 'sa', 'sa', '2013-05-19 19:27:33', '2013-05-19 19:27:33', 2),
(36, 'yyy', 'hhgkljlk', 'iui  iiopi ioi[ij k ljj kj;', '2013-05-19 23:46:48', '2013-05-20 00:25:34', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(127) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `active`, `created`, `modified`) VALUES
(2, 'kopuzja', 'kopuzja', 'kopuzja@ukr.net', '9cbd040c2c19c27a600ccc952b160692e1147af6', 1, '2013-05-19 08:22:41', '2013-05-19 08:22:41'),
(3, 'moderator', 'moderator', 'moderator@ukr.net', 'c22b6f00d4b1b61149818b9925cf6198beec67a9', 1, '2013-05-19 09:14:09', '2013-05-19 09:14:09'),
(4, 'user', 'user', 'user@ukr.net', '3d6521db3a001b659dfc96dd2278535b5634afde', 1, '2013-05-19 09:16:32', '2013-05-19 09:16:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
