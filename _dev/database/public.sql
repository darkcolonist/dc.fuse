/*
Navicat PGSQL Data Transfer

Source Server         : localhost
Source Server Version : 80416
Source Host           : 127.0.0.1:5432
Source Database       : dc_deploy
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 80416
File Encoding         : 65001

Date: 2013-04-22 16:53:16
*/


-- ----------------------------
-- Sequence structure for "users_id_seq"
-- ----------------------------
DROP SEQUENCE "users_id_seq";
CREATE SEQUENCE "users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11
 CACHE 1;

-- ----------------------------
-- Table structure for "users"
-- ----------------------------
DROP TABLE "users";
CREATE TABLE "public"."users" (
"id" int8 DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
"first_name" text DEFAULT NULL,
"last_name" text DEFAULT NULL,
CONSTRAINT "users_pkey" PRIMARY KEY ("id")
)
WITH (OIDS=FALSE)
;

ALTER TABLE "public"."users" OWNER TO "postgres";;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "users" VALUES ('1', 'Christian Noel', 'Reyes');
INSERT INTO "users" VALUES ('2', 'Bryan', 'Balintec');
INSERT INTO "users" VALUES ('3', 'Jenny Lou', 'Ocampo');
INSERT INTO "users" VALUES ('4', 'Karlo Andrei', 'Aguilar');
INSERT INTO "users" VALUES ('5', 'Razelle', 'Cuevas');
INSERT INTO "users" VALUES ('6', 'Vincent', 'Bambico');
INSERT INTO "users" VALUES ('7', 'Mark Laurence', 'Ruaro');
INSERT INTO "users" VALUES ('8', 'Jiego', 'Cordoviz');
INSERT INTO "users" VALUES ('9', 'Karlo Adrienne', 'Aguilar');
INSERT INTO "users" VALUES ('10', 'Bryan', 'Basmayor');
INSERT INTO "users" VALUES ('11', 'Donniecar', 'Gesmundo');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "users_id_seq" OWNED BY "users"."id";
