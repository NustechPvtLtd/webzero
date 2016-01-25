-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2016 at 09:43 PM
-- Server version: 5.5.47-37.7
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webzero_masterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_upgrade`
--

CREATE TABLE IF NOT EXISTS `account_upgrade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `upgrade_by` varchar(28) NOT NULL,
  `notes` text,
  `upgrade_from` int(11) NOT NULL,
  `upgrade_to` int(11) NOT NULL,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_upgrade_user_id_index` (`user_id`),
  KEY `upgrade_from_plan_id` (`upgrade_from`),
  KEY `upgrade_to_plan_id` (`upgrade_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `addon_domain_order`
--

CREATE TABLE IF NOT EXISTS `addon_domain_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `addon_domain` varchar(255) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `subtotal` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `tax_id` (`tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `addon_domain_transaction`
--

CREATE TABLE IF NOT EXISTS `addon_domain_transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `payment_gateway_name` varchar(50) NOT NULL,
  `payment_gateway_transaction_id` varchar(100) NOT NULL,
  `payment_gateway_response` text NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'failed',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `amazon_media_storage`
--

CREATE TABLE IF NOT EXISTS `amazon_media_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bucket_name` varchar(64) NOT NULL,
  `uri` varchar(128) NOT NULL,
  `media_name` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE IF NOT EXISTS `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) NOT NULL,
  `config_value` text NOT NULL,
  `config_default` text NOT NULL,
  `config_description` text NOT NULL,
  `config_required` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` char(3) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'active',
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(256) CHARACTER SET utf8 NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 NOT NULL,
  `state` int(11) NOT NULL,
  `zipcode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country` int(11) NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type` enum('billing','shipping') CHARACTER SET utf8 NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE IF NOT EXISTS `customer_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `response` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--

CREATE TABLE IF NOT EXISTS `frames` (
  `frames_id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_id` int(11) NOT NULL,
  `sites_id` int(11) NOT NULL,
  `frames_content` text NOT NULL,
  `frames_height` int(4) NOT NULL,
  `frames_original_url` varchar(255) NOT NULL,
  `frames_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`frames_id`),
  KEY `pages_id` (`pages_id`),
  KEY `sites_id` (`sites_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `visibility` int(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(20) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `invoice_date` int(11) NOT NULL,
  `due_date` int(11) NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_education`
--

CREATE TABLE IF NOT EXISTS `jobseeker_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `from_date` varchar(40) DEFAULT NULL,
  `to_date` varchar(40) DEFAULT NULL,
  `degree` varchar(40) DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `page_id_2` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_email`
--

CREATE TABLE IF NOT EXISTS `jobseeker_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `email_subject` varchar(100) NOT NULL,
  `email_contents` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_lang_skills`
--

CREATE TABLE IF NOT EXISTS `jobseeker_lang_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `rating` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_profile`
--

CREATE TABLE IF NOT EXISTS `jobseeker_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL COMMENT 'indicate site id',
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume_headline` varchar(200) DEFAULT NULL,
  `summery` text,
  `company` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `notice_period` int(5) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `preff_location` varchar(200) DEFAULT NULL,
  `salary` varchar(40) DEFAULT NULL,
  `expected_salary` varchar(40) DEFAULT NULL,
  `total_exp` int(11) DEFAULT NULL,
  `created_date` varchar(200) DEFAULT NULL,
  `last_updated` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_prof_skills`
--

CREATE TABLE IF NOT EXISTS `jobseeker_prof_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `experience` varchar(100) NOT NULL,
  `rating` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_work_exp`
--

CREATE TABLE IF NOT EXISTS `jobseeker_work_exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `Company_name` varchar(100) NOT NULL,
  `designation` varchar(40) NOT NULL,
  `profile` text NOT NULL,
  `from_date` varchar(40) NOT NULL,
  `to_date` varchar(40) NOT NULL,
  `location` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `sites_id` int(11) NOT NULL,
  `pages_name` varchar(255) NOT NULL,
  `pages_timestamp` int(11) NOT NULL,
  `pages_title` varchar(255) NOT NULL,
  `pages_meta_keywords` text NOT NULL,
  `pages_meta_description` text NOT NULL,
  `pages_header_includes` text NOT NULL,
  `pages_trashed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pages_id`),
  KEY `sites_id` (`sites_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `premium_domain`
--

CREATE TABLE IF NOT EXISTS `premium_domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domainname` varchar(256) NOT NULL,
  `orderid` int(11) NOT NULL,
  `actiontype` varchar(256) DEFAULT NULL,
  `actiontypedesc` varchar(256) DEFAULT NULL,
  `actionid` int(11) DEFAULT NULL,
  `actionstatus` varchar(256) DEFAULT NULL,
  `actionstatusdesc` varchar(256) DEFAULT NULL,
  `invoiceid` int(11) NOT NULL,
  `sellingcurrencysymbol` varchar(256) DEFAULT NULL,
  `sellingamount` double DEFAULT NULL,
  `unutilisedsellingamount` double DEFAULT NULL,
  `customerid` int(11) NOT NULL,
  `siteid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `price_plan`
--

CREATE TABLE IF NOT EXISTS `price_plan` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `discount_type` varchar(50) NOT NULL DEFAULT 'percentage',
  `discount` decimal(10,4) DEFAULT NULL,
  `expiration_type` varchar(50) NOT NULL DEFAULT 'days',
  `expiration` int(14) NOT NULL,
  `recommended` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` char(15) NOT NULL DEFAULT 'active',
  `visitor_count` varchar(15) NOT NULL DEFAULT 'inactive',
  `eccommerce` varchar(15) NOT NULL DEFAULT 'inactive',
  `premium_domain` varchar(15) NOT NULL DEFAULT 'inactive',
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `price_plan_order`
--

CREATE TABLE IF NOT EXISTS `price_plan_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `plan_id` int(11) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `subtotal` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax_percent` decimal(4,2) NOT NULL DEFAULT '0.00',
  `tax_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `status` char(15) NOT NULL DEFAULT 'incomplete',
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`,`plan_id`,`tax_id`),
  KEY `fk_price_plan_order_plan` (`plan_id`),
  KEY `fk_price_plan_order_tax` (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `price_plan_order_transaction`
--

CREATE TABLE IF NOT EXISTS `price_plan_order_transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `payment_gateway_name` varchar(50) NOT NULL,
  `payment_gateway_transaction_id` varchar(100) NOT NULL,
  `payment_gateway_response` text NOT NULL,
  `status` char(15) NOT NULL DEFAULT 'failed',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `sites_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL,
  `sites_name` varchar(255) NOT NULL,
  `sites_created_on` varchar(100) NOT NULL,
  `sites_lastupdate_on` varchar(100) NOT NULL,
  `domain_ok` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  `remote_url` varchar(255) NOT NULL,
  `sites_trashed` int(1) NOT NULL DEFAULT '0',
  `has_password` enum('0','1') NOT NULL DEFAULT '0',
  `site_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sites_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `percent` decimal(4,2) NOT NULL DEFAULT '0.00',
  `is_global` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` char(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`tax_id`),
  KEY `country_id` (`country_id`,`zone_id`),
  KEY `fk_tax_zone` (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `social_account` text,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `price_plan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `parent_id` (`parent_id`),
  KEY `users_price_plan_fk` (`price_plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_address`
--

CREATE TABLE IF NOT EXISTS `users_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` int(11) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `country` int(11) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `type` enum('billing','shipping') NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state` (`state`),
  KEY `country` (`country`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_domains`
--

CREATE TABLE IF NOT EXISTS `users_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `domain` varchar(128) NOT NULL,
  `url_option` varchar(50) NOT NULL,
  `domain_publish` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE IF NOT EXISTS `users_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image1` text NOT NULL,
  `price` double(15,4) NOT NULL,
  `site_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_basic`
--

CREATE TABLE IF NOT EXISTS `visitor_basic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `visitor_ip` varchar(20) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `hitcount` int(11) NOT NULL DEFAULT '0',
  `isp` varchar(255) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `region` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `zipcode` varchar(32) DEFAULT NULL,
  `country_code` varchar(3) DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`visitor_ip`,`site_id`,`page_id`),
  KEY `page_id` (`page_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'active',
  `date_added` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `fk_zone_country1_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3970 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_upgrade`
--
ALTER TABLE `account_upgrade`
  ADD CONSTRAINT `account_upgrade_price_plan_fk1` FOREIGN KEY (`upgrade_from`) REFERENCES `price_plan` (`plan_id`),
  ADD CONSTRAINT `account_upgrade_price_plan_fk2` FOREIGN KEY (`upgrade_to`) REFERENCES `price_plan` (`plan_id`),
  ADD CONSTRAINT `account_upgrade_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `frames`
--
ALTER TABLE `frames`
  ADD CONSTRAINT `frames_ibfk_1` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`pages_id`),
  ADD CONSTRAINT `frames_ibfk_2` FOREIGN KEY (`sites_id`) REFERENCES `sites` (`sites_id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`sites_id`) REFERENCES `sites` (`sites_id`);

--
-- Constraints for table `premium_domain`
--
ALTER TABLE `premium_domain`
  ADD CONSTRAINT `premium_domain_fk1` FOREIGN KEY (`siteid`) REFERENCES `sites` (`sites_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `price_plan_order`
--
ALTER TABLE `price_plan_order`
  ADD CONSTRAINT `fk_price_plan_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_price_plan_order_plan` FOREIGN KEY (`plan_id`) REFERENCES `price_plan` (`plan_id`),
  ADD CONSTRAINT `fk_price_plan_order_tax` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`tax_id`);

--
-- Constraints for table `price_plan_order_transaction`
--
ALTER TABLE `price_plan_order_transaction`
  ADD CONSTRAINT `fk_price_plan_order_transaction_price_plan_order` FOREIGN KEY (`order_id`) REFERENCES `price_plan_order` (`order_id`);

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tax`
--
ALTER TABLE `tax`
  ADD CONSTRAINT `fk_tax_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tax_zone` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`zone_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_price_plan_fk` FOREIGN KEY (`price_plan_id`) REFERENCES `price_plan` (`plan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_address`
--
ALTER TABLE `users_address`
  ADD CONSTRAINT `fk_country_address_key` FOREIGN KEY (`country`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `fk_users_address_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_zone_address_key` FOREIGN KEY (`state`) REFERENCES `zone` (`zone_id`);

--
-- Constraints for table `users_domains`
--
ALTER TABLE `users_domains`
  ADD CONSTRAINT `users_domains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_domains_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`sites_id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `visitor_basic`
--
ALTER TABLE `visitor_basic`
  ADD CONSTRAINT `visitor_basic_fk1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`sites_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `visitor_basic_fk2` FOREIGN KEY (`page_id`) REFERENCES `pages` (`pages_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zone`
--
ALTER TABLE `zone`
  ADD CONSTRAINT `fk_zone_country_key` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
