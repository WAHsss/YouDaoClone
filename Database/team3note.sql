-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-04-21 02:54:42
-- 服务器版本： 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team3note`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `noteid` int(11) NOT NULL COMMENT '笔记ID',
  `content` text NOT NULL COMMENT '评论内容',
  `filename` text COMMENT '文件名',
  `ext` text COMMENT '文件名后缀',
  `type` text COMMENT '文件类型',
  `filepath` text COMMENT '文件路径',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论创建时间',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `noteid` (`noteid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论';

-- --------------------------------------------------------

--
-- 表的结构 `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `markName` text COMMENT '标签名称',
  `isStart` tinyint(1) NOT NULL COMMENT '是否启用',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '标签创建时间',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `isDelete` tinyint(1) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='标签';

--
-- 转存表中的数据 `mark`
--

INSERT INTO `mark` (`id`, `userid`, `markName`, `isStart`, `createTime`, `updateTime`, `isDelete`) VALUES
(1, 2, 'nb1-b1-m', 12, '2018-04-21 02:52:49', '2018-04-21 02:53:47', 0);

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '笔记ID',
  `notename` text NOT NULL COMMENT '笔记名称',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `content` text COMMENT '内容',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '笔记创建时间',
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '笔记更新时间',
  `markID` int(11) DEFAULT NULL COMMENT '标签ID',
  `notebookID` int(11) NOT NULL COMMENT '笔记本ID',
  `remindTime` timestamp NULL DEFAULT NULL COMMENT '提醒时间',
  `isStart` tinyint(4) NOT NULL COMMENT '是否启用',
  `isShare` tinyint(4) DEFAULT '0' COMMENT '是否对外可视',
  `isDelete` tinyint(4) DEFAULT '0' COMMENT '是否删除',
  `sharedPeople` text COMMENT '对外可视的人',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `notebookID` (`notebookID`),
  KEY `markID` (`markID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='笔记';

--
-- 转存表中的数据 `note`
--

INSERT INTO `note` (`id`, `notename`, `userid`, `content`, `createTime`, `updateTime`, `markID`, `notebookID`, `remindTime`, `isStart`, `isShare`, `isDelete`, `sharedPeople`) VALUES
(1, 'nb1-n1', 2, '<p><span style=\"font-weight: bold; font-size: x-small;\">原价报告卡</span>还是代理费klksjdfl2164<span style=\"text-decoration-line: underline line-through;\">8SLAK<span style=\"background-color: rgb(70, 172, 200);\">JD</span></span><span style=\"background-color: rgb(70, 172, 200);\">HFGAK</span>LSDJH<span style=\"font-weight: bold;\"></span></p>', '2018-04-21 02:52:49', '2018-04-21 02:53:47', 1, 2, NULL, 12, 0, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `notebook`
--

DROP TABLE IF EXISTS `notebook`;
CREATE TABLE IF NOT EXISTS `notebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '笔记本ID',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `bookName` text NOT NULL COMMENT '笔记本名称',
  `isShare` tinyint(4) DEFAULT '0' COMMENT '对他人是否可见',
  `isDelete` tinyint(4) DEFAULT '0' COMMENT '是否被放入回收站',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `isStart` tinyint(4) NOT NULL COMMENT '是否被启用',
  `noteNumber` int(11) NOT NULL DEFAULT '0' COMMENT '含有笔记数量',
  `sharedpeople` text COMMENT '对此笔记本可见的人',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='笔记本';

--
-- 转存表中的数据 `notebook`
--

INSERT INTO `notebook` (`id`, `userid`, `bookName`, `isShare`, `isDelete`, `createTime`, `updateTime`, `isStart`, `noteNumber`, `sharedpeople`) VALUES
(2, 2, 'nb1', 0, 0, '2018-04-21 02:24:01', '2018-04-21 02:24:01', 12, 0, NULL),
(3, 2, '杨廉洁', 0, 0, '2018-04-21 02:32:18', '2018-04-21 02:32:18', 12, 0, NULL),
(4, 2, 'nb2', 0, 0, '2018-04-21 02:33:40', '2018-04-21 02:33:40', 12, 0, NULL),
(5, 2, '你好', 0, 0, '2018-04-21 02:35:03', '2018-04-21 02:35:03', 12, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` text NOT NULL COMMENT '用户名',
  `password` text NOT NULL COMMENT '密码',
  `email` text NOT NULL COMMENT '邮箱',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `createTime`) VALUES
(2, 'ylj', '670b14728ad9902aecba32e22fa4f6bd', '490109054@qq.com', '2018-04-21 02:23:36');

--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`noteid`) REFERENCES `note` (`id`) ON DELETE CASCADE;

--
-- 限制表 `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`notebookID`) REFERENCES `notebook` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_ibfk_3` FOREIGN KEY (`markID`) REFERENCES `mark` (`id`);

--
-- 限制表 `notebook`
--
ALTER TABLE `notebook`
  ADD CONSTRAINT `notebook_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
