/*
Navicat MySQL Data Transfer

Source Server         : wxopen
Source Server Version : 50629
Source Host           : joinusad.mysql.rds.aliyuncs.com:3306
Source Database       : wxopen

Target Server Type    : MYSQL
Target Server Version : 50629
File Encoding         : 65001

Date: 2016-09-21 15:29:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for apre_auth_code
-- ----------------------------
DROP TABLE IF EXISTS `apre_auth_code`;
CREATE TABLE `apre_auth_code` (
  `component_appid` varchar(20) NOT NULL,
  `pre_auth_code` varchar(100) NOT NULL,
  `expires_in` int(11) NOT NULL,
  UNIQUE KEY `component_appid` (`component_appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for authorizer_access_token
-- ----------------------------
DROP TABLE IF EXISTS `authorizer_access_token`;
CREATE TABLE `authorizer_access_token` (
  `authorizer_appid` varchar(20) NOT NULL,
  `authorizer_access_token` varchar(200) NOT NULL,
  `expires_in` int(11) NOT NULL,
  `authorizer_refresh_token` varchar(100) NOT NULL,
  `func_info` varchar(1000) DEFAULT NULL,
  UNIQUE KEY `authorizer_appid` (`authorizer_appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for component_access_token
-- ----------------------------
DROP TABLE IF EXISTS `component_access_token`;
CREATE TABLE `component_access_token` (
  `component_appid` varchar(20) NOT NULL,
  `component_access_token` varchar(100) NOT NULL,
  `expires_in` int(11) NOT NULL,
  UNIQUE KEY `component_appid` (`component_appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for component_verify_ticket
-- ----------------------------
DROP TABLE IF EXISTS `component_verify_ticket`;
CREATE TABLE `component_verify_ticket` (
  `component_appid` varchar(20) NOT NULL,
  `createtime` int(11) NOT NULL,
  `infotype` varchar(50) NOT NULL,
  `componentverifyticket` varchar(150) NOT NULL,
  UNIQUE KEY `component_appid` (`component_appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for jsapi_ticket
-- ----------------------------
DROP TABLE IF EXISTS `jsapi_ticket`;
CREATE TABLE `jsapi_ticket` (
  `authorizer_appid` varchar(20) NOT NULL,
  `ticket` varchar(200) NOT NULL,
  `expires_in` int(11) NOT NULL,
  UNIQUE KEY `authorizer_appid` (`authorizer_appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wx_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `wx_userinfo`;
CREATE TABLE `wx_userinfo` (
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `sex` char(2) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `headimgurl` varchar(600) DEFAULT NULL,
  `privilege` varchar(500) DEFAULT NULL,
  `unionid` varchar(100) DEFAULT NULL,
  `expires_in` int(11) NOT NULL,
  `appid` varchar(60) NOT NULL,
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
