-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 28 2014 г., 15:57
-- Версия сервера: 5.5.40-0ubuntu1
-- Версия PHP: 5.5.12-2ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cf_comments`
--

CREATE TABLE IF NOT EXISTS `cf_comments` (
`id_comment` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `text_comment` text,
  `date_create` datetime DEFAULT NULL,
  `model_id` tinyint(1) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_gallery`
--

CREATE TABLE IF NOT EXISTS `cf_gallery` (
`id_gallery` int(11) NOT NULL,
  `name_gallery` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `folder_gallery` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `min_resize` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `type_resize` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `is_gallery` tinyint(1) DEFAULT '1',
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(5) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_images`
--

CREATE TABLE IF NOT EXISTS `cf_images` (
`id_img` int(11) NOT NULL,
  `model_id` tinyint(2) DEFAULT NULL,
  `fk_id` int(11) DEFAULT NULL,
  `name_img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alt_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sort_img` int(11) DEFAULT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=247 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_items`
--

CREATE TABLE IF NOT EXISTS `cf_items` (
`id_item` int(11) NOT NULL,
  `name_item` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type_item` int(5) DEFAULT NULL,
  `slug_item` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status_id` tinyint(2) DEFAULT NULL,
  `sort_item` int(11) DEFAULT NULL,
  `data_options` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `desc_item` text CHARACTER SET utf8
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_item_type`
--

CREATE TABLE IF NOT EXISTS `cf_item_type` (
`id_type` int(11) NOT NULL,
  `name_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `action_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `transmit_id` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_menu`
--

CREATE TABLE IF NOT EXISTS `cf_menu` (
`id_menu` int(11) NOT NULL,
  `name_menu` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_menu_items`
--

CREATE TABLE IF NOT EXISTS `cf_menu_items` (
`id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_metadata`
--

CREATE TABLE IF NOT EXISTS `cf_metadata` (
`id_meta` int(11) NOT NULL,
  `model_id` tinyint(2) DEFAULT NULL,
  `fk_id` int(11) DEFAULT NULL,
  `name_meta` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `title_meta` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `desc_meta` text CHARACTER SET utf8,
  `kay_meta` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_models`
--

CREATE TABLE IF NOT EXISTS `cf_models` (
`id_model` int(3) NOT NULL,
  `name_model` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `type_model` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_modules`
--

CREATE TABLE IF NOT EXISTS `cf_modules` (
`id_mod` int(11) NOT NULL,
  `sis_name_mod` varchar(255) DEFAULT NULL,
  `name_mod` varchar(255) DEFAULT NULL,
  `desc_mod` text,
  `status_mod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_pages`
--

CREATE TABLE IF NOT EXISTS `cf_pages` (
`id_page` int(11) NOT NULL,
  `name_page` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `brief_text_page` text CHARACTER SET utf8,
  `text_page` text CHARACTER SET utf8,
  `slug_page` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` tinyint(2) DEFAULT NULL,
  `sort_page` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_page_item`
--

CREATE TABLE IF NOT EXISTS `cf_page_item` (
`id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_site_options`
--

CREATE TABLE IF NOT EXISTS `cf_site_options` (
`id_option` int(11) NOT NULL,
  `name_option` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value_option` varchar(255) CHARACTER SET utf8 NOT NULL,
  `model_id` tinyint(1) NOT NULL,
  `label_option` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблицы `cf_status`
--

CREATE TABLE IF NOT EXISTS `cf_status` (
`id_status` int(2) NOT NULL,
  `name_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cf_comments`
--
ALTER TABLE `cf_comments`
 ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `cf_gallery`
--
ALTER TABLE `cf_gallery`
 ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `cf_images`
--
ALTER TABLE `cf_images`
 ADD PRIMARY KEY (`id_img`);

--
-- Indexes for table `cf_items`
--
ALTER TABLE `cf_items`
 ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `cf_item_type`
--
ALTER TABLE `cf_item_type`
 ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `cf_menu`
--
ALTER TABLE `cf_menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `cf_menu_items`
--
ALTER TABLE `cf_menu_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cf_metadata`
--
ALTER TABLE `cf_metadata`
 ADD PRIMARY KEY (`id_meta`);

--
-- Indexes for table `cf_models`
--
ALTER TABLE `cf_models`
 ADD PRIMARY KEY (`id_model`);

--
-- Indexes for table `cf_modules`
--
ALTER TABLE `cf_modules`
 ADD PRIMARY KEY (`id_mod`);

--
-- Indexes for table `cf_pages`
--
ALTER TABLE `cf_pages`
 ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `cf_page_item`
--
ALTER TABLE `cf_page_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cf_site_options`
--
ALTER TABLE `cf_site_options`
 ADD PRIMARY KEY (`id_option`);

--
-- Indexes for table `cf_status`
--
ALTER TABLE `cf_status`
 ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_migration`
--
ALTER TABLE `tbl_migration`
 ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cf_comments`
--
ALTER TABLE `cf_comments`
MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cf_gallery`
--
ALTER TABLE `cf_gallery`
MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cf_images`
--
ALTER TABLE `cf_images`
MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `cf_items`
--
ALTER TABLE `cf_items`
MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cf_item_type`
--
ALTER TABLE `cf_item_type`
MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `cf_menu`
--
ALTER TABLE `cf_menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cf_menu_items`
--
ALTER TABLE `cf_menu_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `cf_metadata`
--
ALTER TABLE `cf_metadata`
MODIFY `id_meta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cf_models`
--
ALTER TABLE `cf_models`
MODIFY `id_model` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cf_modules`
--
ALTER TABLE `cf_modules`
MODIFY `id_mod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cf_pages`
--
ALTER TABLE `cf_pages`
MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cf_page_item`
--
ALTER TABLE `cf_page_item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `cf_site_options`
--
ALTER TABLE `cf_site_options`
MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cf_status`
--
ALTER TABLE `cf_status`
MODIFY `id_status` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
