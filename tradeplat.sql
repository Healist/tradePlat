-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-17 05:15:50
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradeplat`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telephone` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `telephone`) VALUES
(1, 'Healist', '123456', '18326661399'),
(2, 'Daniel', '8273061', '18326661399'),
(3, 'admin', '123456', '18326661399'),
(8, 'orz', '123456', '18326661399');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceId` int(11) NOT NULL COMMENT '商品ID',
  `userId` int(11) NOT NULL COMMENT '评论人',
  `content` text NOT NULL COMMENT '评论内容',
  `date` date NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`),
  KEY `sourceId` (`sourceId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cut`
--

DROP TABLE IF EXISTS `cut`;
CREATE TABLE IF NOT EXISTS `cut` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cut`
--

INSERT INTO `cut` (`id`, `name`) VALUES
(1, '可讲价'),
(2, '不讲价');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `resourceId` int(11) NOT NULL,
  `type` int(5) NOT NULL,
  `count` int(5) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `resourceId` (`resourceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '商品名称',
  `price` float NOT NULL COMMENT '商品单价',
  `path` varchar(100) NOT NULL COMMENT '图片路径',
  `description` text NOT NULL COMMENT '商品描述',
  `school` int(5) NOT NULL COMMENT '0新区1老区',
  `canCut` int(5) NOT NULL COMMENT '1可以砍价，2不可以',
  `type` int(5) NOT NULL COMMENT '商品类别',
  `date` date NOT NULL COMMENT '发布时间',
  `count` int(11) NOT NULL COMMENT '商品数量',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `school` (`school`),
  KEY `canCut` (`canCut`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `resource`
--

INSERT INTO `resource` (`id`, `userId`, `name`, `price`, `path`, `description`, `school`, `canCut`, `type`, `date`, `count`) VALUES
(2, 1, '帅哥', 0, './upload/317d59dc68a681b58400680d69949c34.jpeg', '帅哥！帅哥！', 0, 1, 7, '2016-05-19', 1),
(3, 1, '帅哥2', 111, './upload/帅哥.jpg', '还在犹豫什么，call me！', 0, 1, 7, '2016-05-19', 1),
(4, 1, '美女', 3333, './upload/0becfd4d09d1cbde60e06eb49a79c800.jpg', '美女哟', 1, 2, 7, '2016-05-19', 1),
(5, 1, '美女2', 9, './upload/6eefcc7ae073fde27a73e014ee16859e.jpg', 'come on  baby!', 0, 2, 7, '2016-05-19', 1),
(6, 1, '人妖', 32312, './upload/人妖.jpg', '我来自泰国', 1, 1, 7, '2016-05-19', 1),
(7, 1, '呆萌娃', 101, './upload/3.png', '别再犹豫啦！', 0, 1, 7, '2016-05-31', 1),
(8, 1, '小鲜肉', 2321, './upload/2.png', '想养一个孩子吗？', 0, 2, 7, '2016-05-31', 1),
(9, 1, '小公举', 3432, './upload/1.jpeg', 'bilibili', 0, 1, 7, '2016-05-31', 1),
(10, 1, '范冰冰', 21313, './upload/bingbing.jpg', '你没有看错！你没有看错！', 0, 1, 7, '2016-05-31', 1),
(14, 1, '别墅', 243243, './upload/bieshu.jpg', '看过来！', 1, 2, 7, '2016-05-31', 1),
(15, 1, '跳棋', 232, './upload/tiaoqi.jpg', '快来买吧', 1, 2, 6, '2016-05-31', 2),
(16, 1, '夏日T恤', 23, './upload/342855abfcf931250ed9043396c477ce.jpg', 'come on ', 1, 2, 5, '2016-05-31', 2),
(17, 1, '武林秘籍', 123, './upload/0696f6543b4e4f60536894a95c082d71.jpg', '想练葵花宝典吗？', 1, 2, 4, '2016-05-31', 22),
(18, 1, '热水壶', 123, './upload/be130c0104884ee3837037be7fecf73f.jpg', 'haha', 1, 2, 3, '2016-05-31', 11),
(19, 1, '单反相机', 1200, './upload/camera.jpg', '绝对保真！八成新！', 1, 2, 1, '2016-06-06', 1),
(20, 1, '数码相机', 1000, './upload/cam.jpg', '高清无码！放心！', 1, 1, 1, '2016-06-06', 1),
(21, 1, '个性自行车', 1000, './upload/che.jpg', '帅气的如此自然！', 0, 1, 2, '2016-06-06', 1),
(22, 1, '九成新电动车', 800, './upload/diandong.jpg', '因为要毕业，所以打算卖出去！', 0, 1, 2, '2016-06-06', 1),
(24, 1, '电饭锅', 180, './upload/9cb09eba69cc540d84c82c1b825ec3ec.jpg', '质量上层，九成新，价格好商量！', 0, 1, 3, '2016-06-17', 1);

-- --------------------------------------------------------

--
-- 表的结构 `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(5) NOT NULL,
  `schName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `school`
--

INSERT INTO `school` (`id`, `schName`) VALUES
(0, '新区'),
(1, '老区');

-- --------------------------------------------------------

--
-- 表的结构 `sourcetype`
--

DROP TABLE IF EXISTS `sourcetype`;
CREATE TABLE IF NOT EXISTS `sourcetype` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sourcetype`
--

INSERT INTO `sourcetype` (`id`, `name`) VALUES
(1, '闲置数码'),
(2, '校园代步'),
(3, '电器日用'),
(4, '图书教材'),
(5, '美妆衣物'),
(6, '运动棋牌'),
(7, '其他');

--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`sourceId`) REFERENCES `resource` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `admin` (`id`);

--
-- 限制表 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`resourceId`) REFERENCES `resource` (`id`);

--
-- 限制表 `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `resource_ibfk_2` FOREIGN KEY (`school`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `resource_ibfk_3` FOREIGN KEY (`canCut`) REFERENCES `cut` (`id`),
  ADD CONSTRAINT `resource_ibfk_4` FOREIGN KEY (`type`) REFERENCES `sourcetype` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
