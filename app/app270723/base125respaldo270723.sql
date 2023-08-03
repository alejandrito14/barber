/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:8889
 Source Schema         : base125

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 27/07/2023 16:27:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acceso_sucursal_empleado
-- ----------------------------
DROP TABLE IF EXISTS `acceso_sucursal_empleado`;
CREATE TABLE `acceso_sucursal_empleado` (
  `idsucursales` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `descripcion` text,
  `idaccesosucursalempleado` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idaccesosucursalempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acceso_sucursal_empleado
-- ----------------------------
BEGIN;
INSERT INTO `acceso_sucursal_empleado` VALUES (1, 1, NULL, 1);
INSERT INTO `acceso_sucursal_empleado` VALUES (2, 1, NULL, 2);
COMMIT;

-- ----------------------------
-- Table structure for anuncios
-- ----------------------------
DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE `anuncios` (
  `idanuncio` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(11) DEFAULT '0',
  PRIMARY KEY (`idanuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of anuncios
-- ----------------------------
BEGIN;
INSERT INTO `anuncios` VALUES (4, 'prueba', 'valor prueba', 'splas.png', 1, '2022-07-15 13:26:28', 1);
INSERT INTO `anuncios` VALUES (5, 'prueba2', 'valor', 'Splas2.png', 1, '2023-02-22 13:04:06', 3);
COMMIT;

-- ----------------------------
-- Table structure for bitacora
-- ----------------------------
DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora` (
  `idbitacora` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `direccion_ip` varchar(45) NOT NULL,
  `sistema_operativo` varchar(45) NOT NULL,
  `navegador` varchar(45) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  PRIMARY KEY (`idbitacora`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bitacora
-- ----------------------------
BEGIN;
INSERT INTO `bitacora` VALUES (1, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-30 08:31:07');
INSERT INTO `bitacora` VALUES (2, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-30 08:52:07');
INSERT INTO `bitacora` VALUES (3, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-30 21:56:20');
INSERT INTO `bitacora` VALUES (4, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-30 23:54:42');
INSERT INTO `bitacora` VALUES (5, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-31 09:24:13');
INSERT INTO `bitacora` VALUES (6, 1, '::1', 'Mac OS X', 'Chrome', '2023-01-31 20:15:51');
INSERT INTO `bitacora` VALUES (7, 1, '::1', 'Mac OS X', 'Chrome', '2023-02-03 08:28:10');
INSERT INTO `bitacora` VALUES (8, 1, '187.190.135.190', 'Mac OS X', 'Chrome', '2023-05-02 15:44:32');
INSERT INTO `bitacora` VALUES (9, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-20 13:23:41');
INSERT INTO `bitacora` VALUES (10, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-22 11:26:09');
INSERT INTO `bitacora` VALUES (11, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-22 15:32:48');
INSERT INTO `bitacora` VALUES (12, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-23 17:06:29');
INSERT INTO `bitacora` VALUES (13, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-23 17:08:04');
INSERT INTO `bitacora` VALUES (14, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-24 11:35:21');
INSERT INTO `bitacora` VALUES (15, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-25 11:34:56');
INSERT INTO `bitacora` VALUES (16, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-25 13:09:58');
INSERT INTO `bitacora` VALUES (17, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-26 13:10:01');
INSERT INTO `bitacora` VALUES (18, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-27 11:45:49');
INSERT INTO `bitacora` VALUES (19, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-29 14:50:25');
INSERT INTO `bitacora` VALUES (20, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-29 15:19:41');
INSERT INTO `bitacora` VALUES (21, 1, '::1', 'Mac OS X', 'Chrome', '2023-05-30 11:39:00');
INSERT INTO `bitacora` VALUES (22, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-02 13:36:32');
INSERT INTO `bitacora` VALUES (23, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-02 14:55:47');
INSERT INTO `bitacora` VALUES (24, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-02 16:27:29');
INSERT INTO `bitacora` VALUES (25, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-02 16:38:23');
INSERT INTO `bitacora` VALUES (26, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-02 18:30:41');
INSERT INTO `bitacora` VALUES (27, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-05 15:09:56');
INSERT INTO `bitacora` VALUES (28, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-07 08:07:40');
INSERT INTO `bitacora` VALUES (29, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-08 17:53:40');
INSERT INTO `bitacora` VALUES (30, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-09 15:06:42');
INSERT INTO `bitacora` VALUES (31, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-13 12:53:43');
INSERT INTO `bitacora` VALUES (32, 1, '::1', 'Mac OS X', 'Chrome', '2023-06-15 13:02:03');
INSERT INTO `bitacora` VALUES (33, 1, '::1', 'Mac OS X', 'Chrome', '2023-07-24 15:07:55');
INSERT INTO `bitacora` VALUES (34, 1, '::1', 'Mac OS X', 'Chrome', '2023-07-25 12:32:36');
INSERT INTO `bitacora` VALUES (35, 1, '::1', 'Mac OS X', 'Chrome', '2023-07-25 17:18:05');
INSERT INTO `bitacora` VALUES (36, 1, '::1', 'Mac OS X', 'Chrome', '2023-07-27 11:30:23');
COMMIT;

-- ----------------------------
-- Table structure for bitacora_clientes
-- ----------------------------
DROP TABLE IF EXISTS `bitacora_clientes`;
CREATE TABLE `bitacora_clientes` (
  `idbitacora_clientes` int(11) NOT NULL AUTO_INCREMENT,
  `direccionip` varchar(250) DEFAULT NULL,
  `sistema_operativo` varchar(250) DEFAULT NULL,
  `navegador` varchar(250) DEFAULT NULL,
  `fecha_ingreso` varchar(45) DEFAULT NULL,
  `idcliente` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbitacora_clientes`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for bitacora_movimientos
-- ----------------------------
DROP TABLE IF EXISTS `bitacora_movimientos`;
CREATE TABLE `bitacora_movimientos` (
  `idbitacora_movimientos` int(11) NOT NULL AUTO_INCREMENT,
  `idbitacora` int(11) NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` varchar(45) DEFAULT NULL,
  `tipousuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbitacora_movimientos`) USING BTREE,
  KEY `fk_bitacora_movimientos_bitacora1` (`idbitacora`) USING BTREE,
  CONSTRAINT `bitacora_movimientos_ibfk_1` FOREIGN KEY (`idbitacora`) REFERENCES `bitacora` (`idbitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bitacora_movimientos
-- ----------------------------
BEGIN;
INSERT INTO `bitacora_movimientos` VALUES (1, 4, 'perfiles', 'Modificacion del perfil creado -1', '2023-01-31 00:02:53', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (2, 4, 'perfiles', 'Modificacion del perfil creado -1', '2023-01-31 08:29:15', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (3, 4, 'perfiles', 'Modificacion del perfil creado -1', '2023-01-31 08:31:39', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (4, 7, 'perfiles', 'Modificacion del perfil creado -1', '2023-02-03 08:32:14', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (5, 10, 'Producto', 'Nueva producto creado con el ID-1', '2023-05-22 12:24:36', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (6, 10, 'Paquetes', 'Nuevo paquete creado con el ID-92', '2023-05-22 12:35:31', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (7, 12, 'Paquetes', 'Modificacion de paquete con el ID-36', '2023-05-23 16:07:02', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (17, 13, 'Paquetes', 'Modificacion de paquete con el ID-80', '2023-05-23 17:30:32', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (18, 14, 'Paquetes', 'Modificacion de paquete con el ID-80', '2023-05-24 11:03:17', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (19, 14, 'Paquetes', 'Modificacion de paquete con el ID-36', '2023-05-24 15:46:20', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (20, 14, 'Paquetes', 'Modificacion de paquete con el ID-37', '2023-05-24 15:47:32', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (21, 14, 'Paquetes', 'Modificacion de paquete con el ID-38', '2023-05-24 15:48:17', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (22, 14, 'Paquetes', 'Modificacion de paquete con el ID-37', '2023-05-24 15:59:10', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (23, 14, 'Paquetes', 'Modificacion de paquete con el ID-38', '2023-05-24 15:59:42', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (27, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:09:48', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (28, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:10:57', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (29, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:11:52', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (30, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:12:57', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (31, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:27:45', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (32, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:36:04', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (33, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:36:14', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (34, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:37:48', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (35, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:40:26', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (36, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:42:03', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (37, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:47:34', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (38, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 15:56:49', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (39, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 16:04:10', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (40, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 16:04:40', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (41, 16, 'Empresas', 'Modificación de la empresa -1', '2023-05-25 16:07:07', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (42, 16, 'tableroanuncios', 'Se elimino el Id :12', '2023-05-25 16:48:17', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (43, 17, 'sucursales', 'Modificación de sucursal -1', '2023-05-26 12:20:27', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (44, 17, 'sucursales', 'Modificación de sucursal -1', '2023-05-26 12:20:35', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (45, 17, 'perfiles', 'Modificacion del perfil creado -1', '2023-05-26 12:27:19', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (46, 17, 'Categoria', 'Modificación de la categoria -2', '2023-05-26 13:07:55', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (47, 17, 'Categoria', 'Modificación de la categoria -2', '2023-05-26 13:08:06', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (48, 17, 'Categoria', 'Modificación de la categoria -2', '2023-05-26 13:08:17', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (49, 17, 'Categoria', 'Modificación de la categoria -3', '2023-05-26 13:11:15', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (50, 17, 'Categoria', 'Modificación de la categoria -3', '2023-05-26 13:11:24', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (51, 17, 'Categoria', 'Nueva categoria creado con el ID-4', '2023-05-26 13:12:13', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (52, 18, 'Categoria paquete', 'Modificación de la categoria -3', '2023-05-27 11:12:17', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (53, 18, 'Categoria paquete', 'Modificación de la categoria -3', '2023-05-27 11:25:11', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (54, 18, 'Categoria paquete', 'Modificación de la categoria -3', '2023-05-27 11:25:21', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (55, 18, 'perfiles', 'Se elimino el Id :5', '2023-05-27 12:02:37', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (56, 18, 'perfiles', 'Se elimino el Id :4', '2023-05-27 12:02:40', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (57, 18, 'perfiles', 'Se elimino el Id :3', '2023-05-27 12:02:42', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (58, 18, 'perfiles', 'Se elimino el Id :2', '2023-05-27 12:02:46', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (59, 18, 'sucursales', 'Modificación de sucursal -1', '2023-05-27 13:22:49', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (60, 21, 'Paquetes', 'Nuevo paquete creado con el ID-93', '2023-05-30 12:30:30', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (61, 21, 'sucursales', 'Modificación de sucursal -1', '2023-05-30 13:57:09', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (62, 21, 'sucursales', 'Modificación de sucursal -1', '2023-05-30 14:24:11', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (63, 21, 'sucursales', 'Modificación de sucursal -1', '2023-05-30 14:27:44', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (64, 25, 'sucursales', 'Modificación de sucursal -1', '2023-06-02 15:38:51', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (65, 26, 'sucursales', 'Modificación de sucursal -1', '2023-06-02 17:49:02', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (66, 26, 'sucursales', 'Modificación de sucursal -1', '2023-06-02 17:53:37', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (67, 28, 'Paquetes', 'Modificacion de paquete con el ID-80', '2023-06-07 07:28:03', NULL, NULL);
INSERT INTO `bitacora_movimientos` VALUES (68, 29, 'perfiles', 'Modificacion del perfil creado -1', '2023-06-08 16:57:26', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for calificacion
-- ----------------------------
DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE `calificacion` (
  `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idsucursal` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `calificacion` varchar(45) DEFAULT NULL,
  `idpaquete` int(11) DEFAULT '0',
  `idcita` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT '0',
  `comentario` text,
  PRIMARY KEY (`idcalificacion`),
  KEY `fk_calificacion_sucursal1_idx` (`idsucursal`),
  KEY `fk_calificacion_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_calificacion_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of calificacion
-- ----------------------------
BEGIN;
INSERT INTO `calificacion` VALUES (10, 1, 62, '8', 0, 40, '2023-04-14 11:27:41', 1, 'todo muy bien');
COMMIT;

-- ----------------------------
-- Table structure for carrito
-- ----------------------------
DROP TABLE IF EXISTS `carrito`;
CREATE TABLE `carrito` (
  `idcarrito` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT '0',
  `costounitario` float(12,2) DEFAULT '0.00',
  `costototal` float(12,2) DEFAULT NULL,
  `idsucursal` int(11) DEFAULT '0',
  `idespecialista` int(11) DEFAULT '0',
  `idcitaapartada` int(11) DEFAULT '0',
  `nombrepaquete` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `titulosgrupos` text,
  `preciooriginal` varchar(255) DEFAULT '0',
  PRIMARY KEY (`idcarrito`),
  KEY `fk_carrito_usuarios1_idx` (`idusuarios`),
  KEY `fk_carrito_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_carrito_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrito_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carrito
-- ----------------------------
BEGIN;
INSERT INTO `carrito` VALUES (210, 64, 80, 1, 300.00, 300.00, 1, 3, 122, 'Corte de barba', 1, '2023-05-03 12:07:22', '', '0');
INSERT INTO `carrito` VALUES (212, 64, 13, 1, 320.00, 320.00, 1, 0, 0, 'THE GOOD GUYS VERDE STRONG', 1, '2023-05-03 12:09:20', '', '0');
INSERT INTO `carrito` VALUES (214, 64, 48, 1, 500.00, 500.00, 1, 0, 0, 'DON JULIO REPOSADO', 1, '2023-05-03 12:11:15', '', '0');
INSERT INTO `carrito` VALUES (217, 97, 69, 1, 100.00, 100.00, 1, 1, 127, 'Corte de cabello', 2, '2023-05-03 13:44:16', '', '0');
INSERT INTO `carrito` VALUES (220, 97, 80, 1, 250.00, 250.00, 1, 1, 128, 'Corte de barba', 2, '2023-05-11 12:17:57', '', '0');
INSERT INTO `carrito` VALUES (225, 97, 80, 1, 200.00, 200.00, 1, 2, 132, 'Corte de barba', 2, '2023-05-12 16:42:11', '', '0');
INSERT INTO `carrito` VALUES (226, 97, 69, 1, 100.00, 100.00, 1, 1, 133, 'Corte de cabello', 2, '2023-05-13 10:46:35', '', '0');
INSERT INTO `carrito` VALUES (227, 99, 80, 1, 200.00, 200.00, 1, 4, 134, 'Corte de barba', 2, '2023-05-14 14:56:36', '', '0');
INSERT INTO `carrito` VALUES (228, 99, 13, 2, 320.00, 640.00, 1, 0, 0, 'THE GOOD GUYS VERDE STRONG', 2, '2023-05-14 14:56:47', '', '0');
INSERT INTO `carrito` VALUES (229, 99, 69, 1, 100.00, 100.00, 1, 5, 135, 'Corte de cabello', 2, '2023-05-14 14:57:11', '', '0');
INSERT INTO `carrito` VALUES (230, 99, 69, 1, 200.00, 200.00, 1, 3, 136, 'Corte de cabello', 2, '2023-05-14 15:01:08', '', '0');
INSERT INTO `carrito` VALUES (231, 99, 49, 2, 500.00, 1000.00, 1, 0, 0, 'FERNANDO DE CASTILLA', 2, '2023-05-14 15:02:22', '', '0');
INSERT INTO `carrito` VALUES (233, 97, 69, 1, 100.00, 100.00, 1, 1, 137, 'Corte de cabello', 2, '2023-05-19 12:54:13', '', '0');
INSERT INTO `carrito` VALUES (234, 97, 69, 1, 100.00, 100.00, 1, 1, 138, 'Corte de cabello', 2, '2023-07-24 17:20:02', '', '0');
INSERT INTO `carrito` VALUES (235, 97, 8, 1, 850.00, 850.00, 1, 0, 0, 'SHAMPOO FORTIFICANTE INSIGHT LOSS CONTROL', 2, '2023-07-26 10:56:17', '', '0');
COMMIT;

-- ----------------------------
-- Table structure for categoriapaquete
-- ----------------------------
DROP TABLE IF EXISTS `categoriapaquete`;
CREATE TABLE `categoriapaquete` (
  `idcategoriapaquete` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) DEFAULT NULL,
  `iddepende` int(11) DEFAULT '0',
  `estatus` int(11) DEFAULT '0',
  `orden` int(11) DEFAULT '0',
  PRIMARY KEY (`idcategoriapaquete`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categoriapaquete
-- ----------------------------
BEGIN;
INSERT INTO `categoriapaquete` VALUES (1, 'Servicios', '2023-04-17 14:03:53', 'servicios.png', 0, 1, 1);
INSERT INTO `categoriapaquete` VALUES (2, 'Productos', '2023-04-17 14:04:02', 'Productos.png', 0, 1, 2);
INSERT INTO `categoriapaquete` VALUES (3, 'Bar', '2023-04-17 15:46:11', '2023-05-27_12:12:17-3.jpg', 0, 1, 3);
INSERT INTO `categoriapaquete` VALUES (4, 'Shampoo', '2023-04-20 15:41:33', 'SHAMPOO.png', 2, 1, 4);
INSERT INTO `categoriapaquete` VALUES (5, 'Ceras', '2023-04-20 15:42:01', 'ceras.png', 2, 1, 5);
INSERT INTO `categoriapaquete` VALUES (6, 'Jabones', '2023-04-20 15:42:29', 'JABONES.png', 2, 1, 6);
INSERT INTO `categoriapaquete` VALUES (7, 'Otros', '2023-04-20 15:42:48', 'otros.png', 2, 1, 7);
COMMIT;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idcategorias` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0' COMMENT '0.-inactivo\n1.-activo',
  `cantidad` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcategorias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
BEGIN;
INSERT INTO `categorias` VALUES (1, 'Restaurante', NULL, 0, NULL, 2, 'restaurant.png');
INSERT INTO `categorias` VALUES (2, 'Barberias', NULL, 1, NULL, 1, 'barberia.png');
INSERT INTO `categorias` VALUES (3, 'Gimnasios', NULL, 0, NULL, 3, 'gimnasio.png');
COMMIT;

-- ----------------------------
-- Table structure for chat
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL AUTO_INCREMENT,
  `iduserenvio` int(11) DEFAULT NULL,
  `iduserrecibe` int(11) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`idchat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for citaapartado
-- ----------------------------
DROP TABLE IF EXISTS `citaapartado`;
CREATE TABLE `citaapartado` (
  `idcitaapartado` int(11) NOT NULL AUTO_INCREMENT,
  `horainicial` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `idsucursal` varchar(45) DEFAULT NULL,
  `idpaquete` varchar(45) DEFAULT NULL,
  `idespecialista` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `costo` float(12,2) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcitaapartado`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of citaapartado
-- ----------------------------
BEGIN;
INSERT INTO `citaapartado` VALUES (120, '17:00', '18:00', '1', '80', '1', '2023-05-08', 0, 96, NULL, '2023-05-03 12:02:51');
INSERT INTO `citaapartado` VALUES (121, '13:00', '14:00', '1', '80', '1', '2023-05-08', 0, 96, NULL, '2023-05-03 12:03:44');
INSERT INTO `citaapartado` VALUES (122, '16:00', '17:00', '1', '80', '3', '2023-05-27', 0, 64, NULL, '2023-05-03 12:07:22');
INSERT INTO `citaapartado` VALUES (123, '10:00', '11:00', '1', '80', '1', '2023-05-04', 0, 97, NULL, '2023-05-03 12:09:08');
INSERT INTO `citaapartado` VALUES (124, '18:00', '19:00', '1', '80', '1', '2023-05-13', 0, 97, NULL, '2023-05-03 12:10:20');
INSERT INTO `citaapartado` VALUES (127, '10:00', '11:00', '1', '69', '1', '2023-05-08', 0, 97, NULL, '2023-05-03 13:44:16');
INSERT INTO `citaapartado` VALUES (128, '10:00', '11:00', '1', '80', '1', '2023-05-12', 0, 97, NULL, '2023-05-11 12:17:57');
INSERT INTO `citaapartado` VALUES (132, '10:00', '11:00', '1', '80', '2', '2023-05-15', 0, 97, NULL, '2023-05-12 16:42:11');
INSERT INTO `citaapartado` VALUES (133, '10:00', '11:00', '1', '69', '1', '2023-05-16', 0, 97, NULL, '2023-05-13 10:46:35');
INSERT INTO `citaapartado` VALUES (134, '14:00', '15:00', '1', '80', '4', '2023-05-24', 0, 99, NULL, '2023-05-14 14:56:36');
INSERT INTO `citaapartado` VALUES (135, '14:00', '15:00', '1', '69', '5', '2023-05-24', 0, 99, NULL, '2023-05-14 14:57:11');
INSERT INTO `citaapartado` VALUES (136, '17:00', '18:00', '1', '69', '3', '2023-05-15', 0, 99, NULL, '2023-05-14 15:01:08');
INSERT INTO `citaapartado` VALUES (137, '12:00', '13:00', '1', '69', '1', '2023-05-19', 0, 97, NULL, '2023-05-19 12:54:13');
INSERT INTO `citaapartado` VALUES (138, '11:00', '12:00', '1', '69', '1', '2023-07-24', 0, 97, NULL, '2023-07-24 17:20:02');
COMMIT;

-- ----------------------------
-- Table structure for citas
-- ----------------------------
DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `horacita` varchar(45) DEFAULT NULL,
  `fechacita` varchar(45) DEFAULT NULL,
  `asuntocita` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0' COMMENT '0.-pendiente\n1.-proceso\n2.-finalizado\n\n',
  `orden` int(11) DEFAULT '0' COMMENT '0.-apartado\n1.-activa\n2.-cancelada\n',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idsucursal` int(11) NOT NULL,
  `horainicial` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `idpaquete` int(11) NOT NULL,
  `idespecialista` int(11) NOT NULL,
  `costo` float(12,2) DEFAULT NULL,
  `idusuarios` int(11) NOT NULL,
  `idqrgenerado` int(11) DEFAULT '0',
  `checkin` int(11) DEFAULT '0',
  `fechacheckin` varchar(45) DEFAULT NULL,
  `conceptocita` text,
  `finalizacita` varchar(45) DEFAULT NULL,
  `tiempotranscurrido` varchar(45) DEFAULT NULL,
  `idusuariocheckin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcita`),
  KEY `fk_citas_sucursal1_idx` (`idsucursal`),
  KEY `fk_citas_paquetes1_idx` (`idpaquete`),
  KEY `fk_citas_especialista1_idx` (`idespecialista`),
  KEY `fk_citas_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_citas_especialista1` FOREIGN KEY (`idespecialista`) REFERENCES `especialista` (`idespecialista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of citas
-- ----------------------------
BEGIN;
INSERT INTO `citas` VALUES (47, '10:00', '2023-05-08', '', 2, 0, '2023-05-03 13:46:24', 1, '10:00', '11:00', 69, 1, 100.00, 97, 75, 1, '2023-05-13 10:44:57', NULL, '2023-05-19 18:51:24', NULL, NULL);
INSERT INTO `citas` VALUES (48, '10:00', '2023-05-12', '', 1, 0, '2023-05-13 10:25:16', 1, '10:00', '11:00', 80, 1, 250.00, 97, 72, 1, '2023-05-13 10:39:46', NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (49, '10:00', '2023-05-15', '', 1, 0, '2023-05-13 10:25:16', 1, '10:00', '11:00', 80, 2, 200.00, 97, 70, 1, '2023-05-13 10:30:29', NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (50, '10:00', '2023-05-16', '', 1, 0, '2023-05-13 10:46:55', 1, '10:00', '11:00', 69, 1, 100.00, 97, 78, 1, '2023-05-13 10:48:08', NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (51, '14:00', '2023-05-24', '', 0, 0, '2023-05-14 14:59:56', 1, '14:00', '15:00', 80, 4, 200.00, 99, 0, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (52, '14:00', '2023-05-24', '', 0, 0, '2023-05-14 14:59:56', 1, '14:00', '15:00', 69, 5, 100.00, 99, 0, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (53, '17:00', '2023-05-15', '', 0, 0, '2023-05-14 15:01:54', 1, '17:00', '18:00', 69, 3, 200.00, 99, 0, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (54, '12:00', '2023-05-19', '', 0, 0, '2023-05-19 12:56:38', 1, '12:00', '13:00', 69, 1, 100.00, 97, 0, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `citas` VALUES (55, '11:00', '2023-07-24', '', 0, 0, '2023-07-24 17:21:56', 1, '11:00', '12:00', 69, 1, 100.00, 97, 0, 0, NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for clientetoken
-- ----------------------------
DROP TABLE IF EXISTS `clientetoken`;
CREATE TABLE `clientetoken` (
  `idclientetoken` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL COMMENT '	',
  `token` varchar(255) DEFAULT NULL,
  `dispositivo` varchar(45) DEFAULT NULL,
  `fecharegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uuid` varchar(45) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idclientetoken`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for codigopostal
-- ----------------------------
DROP TABLE IF EXISTS `codigopostal`;
CREATE TABLE `codigopostal` (
  `codigo` varchar(255) DEFAULT NULL,
  `asenta` varchar(255) DEFAULT NULL,
  `tipo_asenta` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `c_estado` varchar(255) DEFAULT NULL,
  `c_tipoasentamiento` varchar(255) DEFAULT NULL,
  `c_municipio` varchar(255) DEFAULT NULL,
  `d_zona` varchar(255) DEFAULT NULL,
  `c_cve_ciudad` varchar(255) DEFAULT NULL,
  `idcodigopostal` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idcodigopostal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for companiaseguro
-- ----------------------------
DROP TABLE IF EXISTS `companiaseguro`;
CREATE TABLE `companiaseguro` (
  `idcompaniaseguro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcompaniaseguro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for configuracionapp
-- ----------------------------
DROP TABLE IF EXISTS `configuracionapp`;
CREATE TABLE `configuracionapp` (
  `idconfiguracionapp` int(11) NOT NULL AUTO_INCREMENT,
  `botonescolorfondo` varchar(45) DEFAULT NULL,
  `botonescolorletra` varchar(45) DEFAULT NULL,
  `invitadocolorfondo` varchar(45) DEFAULT NULL,
  `invitadocolorletra` varchar(45) DEFAULT NULL,
  `bienvenidacolorletra` varchar(45) DEFAULT NULL,
  `bienvenidafondoletra` varchar(45) DEFAULT NULL,
  `nombresucursal2colorfondo` varchar(45) DEFAULT NULL,
  `nombresucursal2colorletra` varchar(45) DEFAULT NULL,
  `titulopromocolorfondo` varchar(45) DEFAULT NULL,
  `titulopromocolorletra` varchar(45) DEFAULT NULL,
  `categorianombrecolorfondo` varchar(45) DEFAULT NULL,
  `categorianombrecolorletra` varchar(45) DEFAULT NULL,
  `categoriaslidercolorfondo` varchar(45) DEFAULT NULL,
  `categoriaslidercolorletra` varchar(45) DEFAULT NULL,
  `paquetetitulocolorfondo` varchar(45) DEFAULT NULL,
  `paquetetitulocolorletra` varchar(45) DEFAULT NULL,
  `regresarcolorfondo` varchar(45) DEFAULT NULL,
  `regresarcolorletra` varchar(45) DEFAULT NULL,
  `botonesaccioncolorfondo` varchar(45) DEFAULT NULL,
  `botonesaccioncolorletra` varchar(45) DEFAULT NULL,
  `divisionescolorfondo` varchar(45) DEFAULT NULL,
  `divisionescolorletra` varchar(45) DEFAULT NULL,
  `precioxcolorletra` varchar(45) DEFAULT NULL,
  `cantidadxcolorletra` varchar(45) DEFAULT NULL,
  `subdivisionescolorfondo` varchar(45) DEFAULT NULL COMMENT '		',
  `subdivisionescolorletra` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idconfiguracionapp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cuponclientes
-- ----------------------------
DROP TABLE IF EXISTS `cuponclientes`;
CREATE TABLE `cuponclientes` (
  `idcuponcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idcuponcliente`),
  KEY `fk_cuponclientes_cupones1_idx` (`idcupon`),
  KEY `fk_cuponclientes_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_cuponclientes_cupones1` FOREIGN KEY (`idcupon`) REFERENCES `cupones` (`idcupon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuponclientes_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for cupones
-- ----------------------------
DROP TABLE IF EXISTS `cupones`;
CREATE TABLE `cupones` (
  `idcupon` int(11) NOT NULL AUTO_INCREMENT,
  `codigocupon` varchar(10) NOT NULL,
  `fechainicial` varchar(45) DEFAULT NULL COMMENT 'Vigencia inicial',
  `fechafinal` varchar(45) DEFAULT NULL COMMENT 'Vigencia final',
  `horainicial` varchar(45) DEFAULT NULL COMMENT 'Hora inicial',
  `horafinal` varchar(45) DEFAULT NULL COMMENT 'Hora final',
  `tipodescuento` tinyint(1) NOT NULL COMMENT '0-porcentaje,1-monto',
  `descuento` float(12,2) NOT NULL COMMENT 'puede ir porcentaje o el monto',
  `lusocliente` int(11) DEFAULT NULL COMMENT 'limite de uso por cliente, si esta en 0 ilimitado',
  `lusodia` int(11) DEFAULT NULL COMMENT 'limite por dia ,si esta en 0 es ilimitado',
  `lusosucursal` int(11) DEFAULT NULL COMMENT 'limite por sucursal,si esta en 0 ilimitado',
  `lusototal` int(11) DEFAULT NULL COMMENT 'limite total, si esta en 0 ilimitado',
  `tsucursales` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-todas,0 que sucursal esta relacionada al cupon',
  `tpaquetes` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-todos,0 que paquetes tienen el cupon',
  `tclientes` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-todos,0 que clientes tiene relacionado el cupon',
  `aplicarsobrepromo` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 si aplica, 0 no aplica',
  `montocompra` float(12,2) NOT NULL DEFAULT '0.00' COMMENT 'monto minimo que debe llevar la compra para aplicacar cupon',
  `cantidadcompra` int(11) NOT NULL DEFAULT '0' COMMENT 'minimo de paquetes ',
  `estatus` tinyint(1) NOT NULL DEFAULT '0',
  `secuenciaventa` varchar(25) DEFAULT NULL COMMENT 'establece un valor en total de ventas que se hallan realizado para poder mostrar',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `automatico` int(11) DEFAULT '0' COMMENT 'Bandera para que el cupon se valide desde el carrito y aparezca automáticamente al entrar en la vista',
  PRIMARY KEY (`idcupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for cuponpaquetes
-- ----------------------------
DROP TABLE IF EXISTS `cuponpaquetes`;
CREATE TABLE `cuponpaquetes` (
  `idcuponpaquete` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  PRIMARY KEY (`idcuponpaquete`),
  KEY `fk_cuponpaquetes_cupones1_idx` (`idcupon`),
  CONSTRAINT `fk_cuponpaquetes_cupones1` FOREIGN KEY (`idcupon`) REFERENCES `cupones` (`idcupon`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for cuponsucursales
-- ----------------------------
DROP TABLE IF EXISTS `cuponsucursales`;
CREATE TABLE `cuponsucursales` (
  `idcuponsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idcuponsucursal`),
  KEY `fk_cuponsucursales_cupones1_idx` (`idcupon`),
  CONSTRAINT `fk_cuponsucursales_cupones1` FOREIGN KEY (`idcupon`) REFERENCES `cupones` (`idcupon`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for customerstripe
-- ----------------------------
DROP TABLE IF EXISTS `customerstripe`;
CREATE TABLE `customerstripe` (
  `idcustomerstripe` int(11) NOT NULL AUTO_INCREMENT,
  `skeystripe` text,
  `idusuarios` int(11) DEFAULT NULL COMMENT '	',
  `customerid_stripe` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idcustomerstripe`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customerstripe
-- ----------------------------
BEGIN;
INSERT INTO `customerstripe` VALUES (1, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 7, 'cus_NPZlTTTzvadcJ7');
INSERT INTO `customerstripe` VALUES (2, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 14, 'cus_NRTTUsi1xaFipQ');
INSERT INTO `customerstripe` VALUES (3, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 15, 'cus_NRUs6DtkkOSJNE');
INSERT INTO `customerstripe` VALUES (4, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 16, 'cus_NUUzeAAUGRIYHK');
INSERT INTO `customerstripe` VALUES (5, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 38, 'cus_NhZcBSHDUHsM3E');
INSERT INTO `customerstripe` VALUES (6, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 55, 'cus_NhxlMf0ZeO9m4u');
INSERT INTO `customerstripe` VALUES (7, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 56, 'cus_NhxyG1aVn2bqKN');
INSERT INTO `customerstripe` VALUES (8, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 57, 'cus_NhzC12td8wShN3');
INSERT INTO `customerstripe` VALUES (9, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 63, 'cus_NiGXYajl9aeMNv');
INSERT INTO `customerstripe` VALUES (10, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 62, 'cus_NiGtvr6FFOS02b');
INSERT INTO `customerstripe` VALUES (11, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 65, 'cus_NiRHU0OVnOTG42');
INSERT INTO `customerstripe` VALUES (12, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 84, 'cus_NnVvACx2xG49Ov');
INSERT INTO `customerstripe` VALUES (13, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 3, 'cus_Np5LjWGwPkOaNJ');
INSERT INTO `customerstripe` VALUES (14, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 94, 'cus_Np5ZvPcRgr2mNv');
INSERT INTO `customerstripe` VALUES (15, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 97, 'cus_NpQTebjbu5H5gC');
INSERT INTO `customerstripe` VALUES (16, 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 99, 'cus_NtZ9WYajBh6TTe');
COMMIT;

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(45) DEFAULT NULL,
  `f_municipio` varchar(45) DEFAULT NULL,
  `f_estado` varchar(45) DEFAULT NULL,
  `f_pais` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of empresa
-- ----------------------------
BEGIN;
INSERT INTO `empresa` VALUES (1, 'GRUPO INVERSA1', 'Grupo Inversa es líder mundial en el desarrollo e ingeniería de tecnologías electrónicas  y soluciones para consumidores en aplicaciones residenciales, no-residenciales, movilidad y personales. Desde su fundación en 1918, la compañía se ha expandido globalmente y ahora opera más de 500 compañías consolidadas alrededor del mundo, recolectando ventas netas de 7.30 trillones de yenes al año que terminó en marzo 31 de 2013. Comprometida en perseguir un nuevo valor a través de la innovación cruzando líneas divisorias, la compañía se esfuerza por crear una vida mejor para sus clientes.', '2023-05-25_17:07:07-1.jpg', NULL, NULL, NULL, '090909090', 'asas@gmail.com');
COMMIT;

-- ----------------------------
-- Table structure for entradas
-- ----------------------------
DROP TABLE IF EXISTS `entradas`;
CREATE TABLE `entradas` (
  `identrada` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `tipo` varchar(45) DEFAULT NULL COMMENT '1.-imagen\n2.-video\n3.-texto',
  `imagen` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT '0',
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`identrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for entradasproducto
-- ----------------------------
DROP TABLE IF EXISTS `entradasproducto`;
CREATE TABLE `entradasproducto` (
  `identradasproducto` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadentrada` varchar(45) DEFAULT NULL,
  `fechaentrada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(11) DEFAULT '0',
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`identradasproducto`),
  KEY `fk_entradasproducto_productos1_idx` (`idproducto`),
  CONSTRAINT `fk_entradasproducto_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for especialista
-- ----------------------------
DROP TABLE IF EXISTS `especialista`;
CREATE TABLE `especialista` (
  `idespecialista` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `bloqueo` int(11) DEFAULT '0',
  `descripcionespecialista` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idespecialista`),
  KEY `fk_especialista_usuarios1_idx` (`idusuarios`),
  KEY `fk_especialista_sucursal1_idx` (`idsucursal`),
  CONSTRAINT `fk_especialista_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_especialista_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of especialista
-- ----------------------------
BEGIN;
INSERT INTO `especialista` VALUES (1, 4, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (2, 5, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (3, 8, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (4, 100, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (5, 101, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (6, 102, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
INSERT INTO `especialista` VALUES (7, 103, 1, 0, 'Barbero profesional con siete años de experiencia en el mundo del estilismo masculino. Poseo habilidades en cortes para niños y adultos, afeitado tradicional y afeitado moderno. He trabajado en varios salones y barberías reconocidas en Madrid, como Shave ');
COMMIT;

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(2) NOT NULL COMMENT 'CVE_ENT - Clave de la entidad',
  `nombre` varchar(40) NOT NULL COMMENT 'NOM_ENT - Nombre de la entidad',
  `abrev` varchar(10) NOT NULL COMMENT 'NOM_ABR - Nombre abreviado de la entidad',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `idpais` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_estados_pais1_idx` (`idpais`) USING BTREE,
  CONSTRAINT `fk_estados_pais1` FOREIGN KEY (`idpais`) REFERENCES `pais` (`idpais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='Estados de la República Mexicana';

-- ----------------------------
-- Records of estados
-- ----------------------------
BEGIN;
INSERT INTO `estados` VALUES (1, '01', 'Aguascalientes', 'Ags.', 1, 1);
INSERT INTO `estados` VALUES (2, '02', 'Baja California', 'BC', 1, 1);
INSERT INTO `estados` VALUES (3, '03', 'Baja California Sur', 'BCS', 1, 1);
INSERT INTO `estados` VALUES (4, '04', 'Campeche', 'Camp.', 1, 1);
INSERT INTO `estados` VALUES (5, '05', 'Coahuila de Zaragoza', 'Coah.', 1, 1);
INSERT INTO `estados` VALUES (6, '06', 'Colima', 'Col.', 1, 1);
INSERT INTO `estados` VALUES (7, '07', 'Chiapas', 'Chis.', 1, 1);
INSERT INTO `estados` VALUES (8, '08', 'Chihuahua', 'Chih.', 1, 1);
INSERT INTO `estados` VALUES (9, '09', 'Ciudad de México', 'CDMX', 1, 1);
INSERT INTO `estados` VALUES (10, '10', 'Durango', 'Dgo.', 1, 1);
INSERT INTO `estados` VALUES (11, '11', 'Guanajuato', 'Gto.', 1, 1);
INSERT INTO `estados` VALUES (12, '12', 'Guerrero', 'Gro.', 1, 1);
INSERT INTO `estados` VALUES (13, '13', 'Hidalgo', 'Hgo.', 1, 1);
INSERT INTO `estados` VALUES (14, '14', 'Jalisco', 'Jal.', 1, 1);
INSERT INTO `estados` VALUES (15, '15', 'México', 'Mex.', 1, 1);
INSERT INTO `estados` VALUES (16, '16', 'Michoacán de Ocampo', 'Mich.', 1, 1);
INSERT INTO `estados` VALUES (17, '17', 'Morelos', 'Mor.', 1, 1);
INSERT INTO `estados` VALUES (18, '18', 'Nayarit', 'Nay.', 1, 1);
INSERT INTO `estados` VALUES (19, '19', 'Nuevo León', 'NL', 1, 1);
INSERT INTO `estados` VALUES (20, '20', 'Oaxaca', 'Oax.', 1, 1);
INSERT INTO `estados` VALUES (21, '21', 'Puebla', 'Pue.', 1, 1);
INSERT INTO `estados` VALUES (22, '22', 'Querétaro', 'Qro.', 1, 1);
INSERT INTO `estados` VALUES (23, '23', 'Quintana Roo', 'Q. Roo', 1, 1);
INSERT INTO `estados` VALUES (24, '24', 'San Luis Potosí', 'SLP', 1, 1);
INSERT INTO `estados` VALUES (25, '25', 'Sinaloa', 'Sin.', 1, 1);
INSERT INTO `estados` VALUES (26, '26', 'Sonora', 'Son.', 1, 1);
INSERT INTO `estados` VALUES (27, '27', 'Tabasco', 'Tab.', 1, 1);
INSERT INTO `estados` VALUES (28, '28', 'Tamaulipas', 'Tamps.', 1, 1);
INSERT INTO `estados` VALUES (29, '29', 'Tlaxcala', 'Tlax.', 1, 1);
INSERT INTO `estados` VALUES (30, '30', 'Veracruz de Ignacio de la Llave', 'Ver.', 1, 1);
INSERT INTO `estados` VALUES (31, '31', 'Yucatán', 'Yuc.', 1, 1);
INSERT INTO `estados` VALUES (32, '32', 'Zacatecas', 'Zac.', 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for formapago
-- ----------------------------
DROP TABLE IF EXISTS `formapago`;
CREATE TABLE `formapago` (
  `cformapago` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for grupo
-- ----------------------------
DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombregrupo` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `sincoprecio` int(11) DEFAULT NULL COMMENT '0.-sin precio/1.-con precio',
  `multiple` int(11) DEFAULT NULL COMMENT '0.-unico/1.-multiple',
  `estatus` int(11) DEFAULT NULL,
  `tope` int(11) DEFAULT NULL,
  `obligatorio` int(11) DEFAULT NULL COMMENT '0.-no es obligatorio',
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for grupoopcion
-- ----------------------------
DROP TABLE IF EXISTS `grupoopcion`;
CREATE TABLE `grupoopcion` (
  `idgrupoopcion` int(11) NOT NULL,
  `opcion` varchar(255) DEFAULT NULL,
  `costo` varchar(45) DEFAULT NULL,
  `idgrupo` int(11) NOT NULL,
  PRIMARY KEY (`idgrupoopcion`),
  KEY `fk_grupoopcion_grupo1_idx` (`idgrupo`),
  CONSTRAINT `fk_grupoopcion_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for grupopaquetes
-- ----------------------------
DROP TABLE IF EXISTS `grupopaquetes`;
CREATE TABLE `grupopaquetes` (
  `idgrupopaquetes` int(11) NOT NULL AUTO_INCREMENT,
  `idgrupo` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `topesecundario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idgrupopaquetes`),
  KEY `fk_grupopaquetes_grupo1_idx` (`idgrupo`),
  KEY `fk_grupopaquetes_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_grupopaquetes_grupo1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupopaquetes_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for horarioespecialista
-- ----------------------------
DROP TABLE IF EXISTS `horarioespecialista`;
CREATE TABLE `horarioespecialista` (
  `idhorarioespecialista` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(45) DEFAULT NULL,
  `horainicial` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `idespecialista` int(11) NOT NULL,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idhorarioespecialista`),
  KEY `fk_horarioespecialista_especialista1_idx` (`idespecialista`),
  CONSTRAINT `fk_horarioespecialista_especialista1` FOREIGN KEY (`idespecialista`) REFERENCES `especialista` (`idespecialista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of horarioespecialista
-- ----------------------------
BEGIN;
INSERT INTO `horarioespecialista` VALUES (1, '1', '10:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (2, '2', '10:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (3, '3', '10:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (4, '4', '10:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (5, '5', '10:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (6, '6', '11:00', '19:00', 1, 1);
INSERT INTO `horarioespecialista` VALUES (7, '1', '10:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (8, '2', '10:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (9, '3', '10:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (10, '4', '10:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (11, '5', '10:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (12, '6', '11:00', '19:00', 2, 1);
INSERT INTO `horarioespecialista` VALUES (13, '1', '10:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (14, '2', '10:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (15, '3', '10:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (16, '4', '10:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (17, '5', '10:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (18, '6', '11:00', '19:00', 3, 1);
INSERT INTO `horarioespecialista` VALUES (19, '1', '10:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (20, '2', '10:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (21, '3', '10:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (22, '4', '10:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (23, '5', '10:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (24, '6', '11:00', '19:00', 4, 1);
INSERT INTO `horarioespecialista` VALUES (25, '1', '10:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (26, '2', '10:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (27, '3', '10:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (28, '4', '10:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (29, '5', '10:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (30, '6', '11:00', '19:00', 5, 1);
INSERT INTO `horarioespecialista` VALUES (31, '1', '10:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (32, '2', '10:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (33, '3', '10:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (34, '4', '10:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (35, '5', '10:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (36, '6', '11:00', '19:00', 6, 1);
INSERT INTO `horarioespecialista` VALUES (37, '1', '10:00', '19:00', 7, 1);
INSERT INTO `horarioespecialista` VALUES (38, '2', '10:00', '19:00', 7, 1);
INSERT INTO `horarioespecialista` VALUES (39, '3', '10:00', '19:00', 7, 1);
INSERT INTO `horarioespecialista` VALUES (40, '4', '10:00', '19:00', 7, 1);
INSERT INTO `horarioespecialista` VALUES (41, '5', '10:00', '19:00', 7, 1);
INSERT INTO `horarioespecialista` VALUES (42, '6', '11:00', '19:00', 7, 1);
COMMIT;

-- ----------------------------
-- Table structure for horariosausente
-- ----------------------------
DROP TABLE IF EXISTS `horariosausente`;
CREATE TABLE `horariosausente` (
  `idhorariospartados` int(11) NOT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `horainicial` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `idespecialista` int(11) NOT NULL,
  PRIMARY KEY (`idhorariospartados`),
  KEY `fk_horariospartados_especialista1_idx` (`idespecialista`),
  CONSTRAINT `fk_horariospartados_especialista1` FOREIGN KEY (`idespecialista`) REFERENCES `especialista` (`idespecialista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for horarioservicio
-- ----------------------------
DROP TABLE IF EXISTS `horarioservicio`;
CREATE TABLE `horarioservicio` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT '0',
  `horainicial` varchar(45) DEFAULT NULL,
  `horafinal` varchar(45) DEFAULT NULL,
  `idpaquete` int(11) NOT NULL,
  PRIMARY KEY (`idhorario`),
  KEY `fk_horarioservicio_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_horarioservicio_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for horariossucursal
-- ----------------------------
DROP TABLE IF EXISTS `horariossucursal`;
CREATE TABLE `horariossucursal` (
  `idhorariosucursal` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT NULL COMMENT '0.-domingo\n1.-lunes\n2.-martes\n3.-miercoles\n4.-jueves\n5.-viernes\n6.-sábado',
  `horainicial` varchar(255) DEFAULT NULL,
  `horafinal` varchar(255) DEFAULT NULL,
  `idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idhorariosucursal`),
  KEY `fk_horariosservicio_servicios1_idx` (`idsucursal`),
  CONSTRAINT `fk_horariosservicio_servicios1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of horariossucursal
-- ----------------------------
BEGIN;
INSERT INTO `horariossucursal` VALUES (73, 1, '10:00', '23:54', 1);
INSERT INTO `horariossucursal` VALUES (74, 2, '10:00', '23:00', 1);
INSERT INTO `horariossucursal` VALUES (75, 3, '10:00', '23:00', 1);
INSERT INTO `horariossucursal` VALUES (76, 4, '10:00', '23:00', 1);
INSERT INTO `horariossucursal` VALUES (77, 5, '10:00', '23:55', 1);
INSERT INTO `horariossucursal` VALUES (78, 6, '12:00', '23:59', 1);
COMMIT;

-- ----------------------------
-- Table structure for imagencita
-- ----------------------------
DROP TABLE IF EXISTS `imagencita`;
CREATE TABLE `imagencita` (
  `idimagencita` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT '0',
  `idcita` int(11) NOT NULL,
  PRIMARY KEY (`idimagencita`),
  KEY `fk_citaimagen_citas1_idx` (`idcita`),
  CONSTRAINT `fk_citaimagen_citas1` FOREIGN KEY (`idcita`) REFERENCES `citas` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of imagencita
-- ----------------------------
BEGIN;
INSERT INTO `imagencita` VALUES (1, '2023-05-18 17:24:59_1684452297193.jpg', '2023-05-18 17:25:04', 1, 47);
COMMIT;

-- ----------------------------
-- Table structure for imagenpromocional
-- ----------------------------
DROP TABLE IF EXISTS `imagenpromocional`;
CREATE TABLE `imagenpromocional` (
  `idimagenpromocionales` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL COMMENT '			',
  `estatus` int(11) DEFAULT NULL,
  `idseccion` int(11) NOT NULL,
  PRIMARY KEY (`idimagenpromocionales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for intentospagosfallidos
-- ----------------------------
DROP TABLE IF EXISTS `intentospagosfallidos`;
CREATE TABLE `intentospagosfallidos` (
  `idpagostripe` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaccion` varchar(255) DEFAULT NULL,
  `idnotaremision` varchar(255) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `digitostarjeta` varchar(45) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `fechatransaccion` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(11) DEFAULT NULL COMMENT '1.-pagomembresia\n2.-pagoservicio',
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpagostripe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for interesespersonales
-- ----------------------------
DROP TABLE IF EXISTS `interesespersonales`;
CREATE TABLE `interesespersonales` (
  `idintereses` int(11) NOT NULL AUTO_INCREMENT,
  `interes` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idintereses`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of interesespersonales
-- ----------------------------
BEGIN;
INSERT INTO `interesespersonales` VALUES (2, 'Coser', 1);
INSERT INTO `interesespersonales` VALUES (3, 'Jugar Naipes', 1);
INSERT INTO `interesespersonales` VALUES (4, 'Idiomas', 1);
INSERT INTO `interesespersonales` VALUES (5, 'Extranjeros', 1);
INSERT INTO `interesespersonales` VALUES (6, 'Futbol', 1);
INSERT INTO `interesespersonales` VALUES (7, 'Deportes', 1);
INSERT INTO `interesespersonales` VALUES (8, 'Actividades', 1);
INSERT INTO `interesespersonales` VALUES (9, 'Religiosas', 1);
INSERT INTO `interesespersonales` VALUES (10, 'Escuchar Radio', 1);
INSERT INTO `interesespersonales` VALUES (11, 'Caminar', 1);
INSERT INTO `interesespersonales` VALUES (12, 'Reparar Autos', 1);
INSERT INTO `interesespersonales` VALUES (13, 'Escribir', 1);
INSERT INTO `interesespersonales` VALUES (14, 'Bailar', 1);
INSERT INTO `interesespersonales` VALUES (15, 'Jugar Golf', 1);
INSERT INTO `interesespersonales` VALUES (16, 'Comida', 1);
INSERT INTO `interesespersonales` VALUES (17, 'Música', 1);
INSERT INTO `interesespersonales` VALUES (18, 'Popular', 1);
INSERT INTO `interesespersonales` VALUES (19, 'Corte de cabello', 1);
INSERT INTO `interesespersonales` VALUES (20, 'Armar Puzzles', 1);
INSERT INTO `interesespersonales` VALUES (21, 'Celebrar días', 1);
INSERT INTO `interesespersonales` VALUES (22, 'Festivos', 1);
INSERT INTO `interesespersonales` VALUES (23, 'Películas', 1);
INSERT INTO `interesespersonales` VALUES (24, 'Peinados', 1);
INSERT INTO `interesespersonales` VALUES (25, 'Clásica', 1);
INSERT INTO `interesespersonales` VALUES (26, 'Tennis', 1);
INSERT INTO `interesespersonales` VALUES (27, 'Conferencias', 1);
INSERT INTO `interesespersonales` VALUES (28, 'Nadar', 1);
INSERT INTO `interesespersonales` VALUES (29, 'Jugar Bolos', 1);
INSERT INTO `interesespersonales` VALUES (30, 'Ir de Visita', 1);
INSERT INTO `interesespersonales` VALUES (31, 'Arreglar Ropa', 1);
INSERT INTO `interesespersonales` VALUES (32, 'Ajedrez', 1);
INSERT INTO `interesespersonales` VALUES (33, 'Hacer Asado', 1);
INSERT INTO `interesespersonales` VALUES (34, 'Leer', 1);
INSERT INTO `interesespersonales` VALUES (35, 'Viajar', 1);
INSERT INTO `interesespersonales` VALUES (36, 'Fiestas', 1);
INSERT INTO `interesespersonales` VALUES (37, 'Practicar Artes', 1);
INSERT INTO `interesespersonales` VALUES (38, 'Marciales', 1);
INSERT INTO `interesespersonales` VALUES (39, 'Padel', 1);
INSERT INTO `interesespersonales` VALUES (40, 'Limpiar la Casa', 1);
INSERT INTO `interesespersonales` VALUES (41, 'Juegos', 1);
INSERT INTO `interesespersonales` VALUES (42, 'Armables ', 1);
COMMIT;

-- ----------------------------
-- Table structure for membresia
-- ----------------------------
DROP TABLE IF EXISTS `membresia`;
CREATE TABLE `membresia` (
  `idmembresia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `costo` float(12,2) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `orden` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidaddias` varchar(255) DEFAULT NULL COMMENT 'Unidad mínima que se debe configurar para saber la duración en que va durar la membresía',
  `tiempodepago` varchar(45) DEFAULT NULL COMMENT 'Es el tiempo que se le da para el usuario que  tenga la membresía  lo pueda pagar',
  `descripcion` text,
  `pordia` int(11) DEFAULT '0',
  `pormes` int(11) DEFAULT '0',
  `poranio` int(11) DEFAULT '0',
  `numerodia` varchar(45) DEFAULT NULL,
  `apartirdefecha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idmembresia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for metodopago
-- ----------------------------
DROP TABLE IF EXISTS `metodopago`;
CREATE TABLE `metodopago` (
  `c_metodopago` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `idmodulos` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '0',
  `estatus` int(1) DEFAULT '1' COMMENT '0 - No activo\\n1 - Activo',
  `icono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmodulos`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modulos
-- ----------------------------
BEGIN;
INSERT INTO `modulos` VALUES (1, 'Configuración general', 1, 1, 'mdi mdi-contacts');
INSERT INTO `modulos` VALUES (2, 'Configuración de servicios', 6, 1, 'mdi mdi-clipboard-text');
INSERT INTO `modulos` VALUES (9, 'Gestión de clientes', 9, 1, 'mdi mdi-ticket-account');
INSERT INTO `modulos` VALUES (21, 'Blog', 5, 1, NULL);
INSERT INTO `modulos` VALUES (22, 'Tablero de anuncios', 3, 1, NULL);
INSERT INTO `modulos` VALUES (23, 'Splash de anuncios', 2, 1, NULL);
INSERT INTO `modulos` VALUES (24, 'Banner de publicidad', 4, 1, NULL);
INSERT INTO `modulos` VALUES (25, 'Asignar Clientes/Servicios', 7, 1, NULL);
INSERT INTO `modulos` VALUES (27, 'Membresías', 8, 1, NULL);
INSERT INTO `modulos` VALUES (28, 'Asignar Clientes/Descuentos', 10, 1, NULL);
INSERT INTO `modulos` VALUES (29, 'Asignar Clientes/Membresias', 11, 1, NULL);
INSERT INTO `modulos` VALUES (30, 'Descuentos', 8, 1, NULL);
INSERT INTO `modulos` VALUES (31, 'Encuestas', 11, 1, NULL);
INSERT INTO `modulos` VALUES (32, 'Deportes', 11, 1, NULL);
INSERT INTO `modulos` VALUES (33, 'Pagos', 10, 1, NULL);
INSERT INTO `modulos` VALUES (34, 'Armar juego', 15, 1, NULL);
INSERT INTO `modulos` VALUES (35, 'Punto de venta', 14, 0, NULL);
INSERT INTO `modulos` VALUES (36, 'Reportes', 15, 1, NULL);
INSERT INTO `modulos` VALUES (37, 'Catálogos', 4, 1, NULL);
COMMIT;

-- ----------------------------
-- Table structure for modulos_menu
-- ----------------------------
DROP TABLE IF EXISTS `modulos_menu`;
CREATE TABLE `modulos_menu` (
  `idmodulos_menu` int(11) NOT NULL AUTO_INCREMENT,
  `idmodulos` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `ubicacion_archivo` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '0',
  `estatus` int(1) DEFAULT '1' COMMENT '0 - No activo\\n1 - Activo',
  `icono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmodulos_menu`) USING BTREE,
  KEY `modulos_menu_ibfk_1_idx` (`idmodulos`) USING BTREE,
  CONSTRAINT `modulos_menu_ibfk_1` FOREIGN KEY (`idmodulos`) REFERENCES `modulos` (`idmodulos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modulos_menu
-- ----------------------------
BEGIN;
INSERT INTO `modulos_menu` VALUES (1, 1, 'Catálogos', 'vi_catalogo.php', 'administrador/', 1, 0, NULL);
INSERT INTO `modulos_menu` VALUES (2, 1, 'Usuarios', 'vi_usuarios.php', 'administrador/', 4, 1, NULL);
INSERT INTO `modulos_menu` VALUES (3, 1, 'Perfiles de Usuarios', 'vi_perfiles.php', 'administrador/', 2, 1, NULL);
INSERT INTO `modulos_menu` VALUES (4, 1, 'Módulos', 'vi_modulos.php', 'administrador/', 1, 1, NULL);
INSERT INTO `modulos_menu` VALUES (29, 2, 'Estados', 'vi_destinos.php', 'catalogos/ubicacion/', 10, 0, NULL);
INSERT INTO `modulos_menu` VALUES (36, 2, 'Ciudades', 'vi_ciudades.php', 'catalogos/ubicacion/', 11, 0, NULL);
INSERT INTO `modulos_menu` VALUES (86, 37, 'Complementos', 'vi_grupo.php', 'catalogos/grupo/', 4, 1, NULL);
INSERT INTO `modulos_menu` VALUES (87, 1, 'Configuración de la empresa', 'vi_empresas.php', 'catalogos/empresa/', 5, 1, NULL);
INSERT INTO `modulos_menu` VALUES (89, 37, 'Categorías', 'vi_categoriaspaquete.php', 'catalogos/categoriapaquete/', 2, 1, NULL);
INSERT INTO `modulos_menu` VALUES (93, 2, 'Tipo de pago', 'vi_tipodepagos.php', 'catalogos/tipodepagos/', 8, 0, NULL);
INSERT INTO `modulos_menu` VALUES (101, 23, 'Config. de anuncios', 'vi_anuncios.php', 'catalogos/anuncios/', 14, 1, NULL);
INSERT INTO `modulos_menu` VALUES (106, 1, 'Tipos de usuario', 'vi_tipousuario.php', 'administrador/tipousuario/', 3, 1, NULL);
INSERT INTO `modulos_menu` VALUES (107, 24, 'Config. de publicidad', 'vi_publicidad.php', 'catalogos/publicidad/', 3, 1, NULL);
INSERT INTO `modulos_menu` VALUES (110, 22, 'Config. de anuncios', 'vi_anuncios.php', 'catalogos/tableroanuncios/', 9, 1, NULL);
INSERT INTO `modulos_menu` VALUES (123, 33, 'Notas de pagos', 'vi_notaspago.php', 'catalogos/notaspago/', 1, 1, NULL);
INSERT INTO `modulos_menu` VALUES (129, 1, 'Tipo de pago', 'vi_tipodepagos.php', 'catalogos/tipodepagos/', 8, 1, NULL);
INSERT INTO `modulos_menu` VALUES (133, 33, 'Monedero', 'vi_monedero.php', 'catalogos/monedero/', 3, 1, NULL);
INSERT INTO `modulos_menu` VALUES (134, 37, 'Productos', 'vi_productos.php', 'catalogos/productos/', 0, 1, NULL);
INSERT INTO `modulos_menu` VALUES (135, 35, 'Familia de productos', 'vi_categoriasproductos.php', 'catalogos/categoriasproducto/', 2, 1, NULL);
INSERT INTO `modulos_menu` VALUES (138, 36, 'Reportes', 'vi_reportes.php', 'catalogos/reportes/', 1, 1, NULL);
INSERT INTO `modulos_menu` VALUES (139, 37, 'Paquetes', 'vi_paquetes.php', 'catalogos/paquetes/', 2, 1, NULL);
INSERT INTO `modulos_menu` VALUES (140, 37, 'Sucursales', 'vi_sucursal.php', 'catalogos/sucursal/', 1, 1, NULL);
INSERT INTO `modulos_menu` VALUES (141, 37, 'Categorias de sucursal', 'vi_categorias.php', 'catalogos/categorias/', 0, 1, NULL);
INSERT INTO `modulos_menu` VALUES (142, 37, 'Especialistas', 'vi_especialista.php', 'catalogos/especialistas/', 8, 1, NULL);
COMMIT;

-- ----------------------------
-- Table structure for municipios
-- ----------------------------
DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) NOT NULL,
  `clave` varchar(3) NOT NULL COMMENT 'CVE_MUN – Clave del municipio',
  `nombre` varchar(100) NOT NULL COMMENT 'NOM_MUN – Nombre del municipio',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `web` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_municipios_estados1_idx` (`estado_id`) USING BTREE,
  CONSTRAINT `fk_municipios_estados1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2464 DEFAULT CHARSET=utf8 COMMENT='Municipios de la República Mexicana';

-- ----------------------------
-- Records of municipios
-- ----------------------------
BEGIN;
INSERT INTO `municipios` VALUES (1, 1, '001', 'Aguascalientes', 1, 1);
INSERT INTO `municipios` VALUES (2, 1, '002', 'Asientos', 1, 0);
INSERT INTO `municipios` VALUES (3, 1, '003', 'Calvillo', 1, 0);
INSERT INTO `municipios` VALUES (4, 1, '004', 'Cosío', 1, NULL);
INSERT INTO `municipios` VALUES (5, 1, '005', 'Jesús María', 1, NULL);
INSERT INTO `municipios` VALUES (6, 1, '006', 'Pabellón de Arteaga', 1, NULL);
INSERT INTO `municipios` VALUES (7, 1, '007', 'Rincón de Romos', 1, NULL);
INSERT INTO `municipios` VALUES (8, 1, '008', 'San José de Gracia', 1, NULL);
INSERT INTO `municipios` VALUES (9, 1, '009', 'Tepezalá', 1, NULL);
INSERT INTO `municipios` VALUES (10, 1, '010', 'El Llano', 1, NULL);
INSERT INTO `municipios` VALUES (11, 1, '011', 'San Francisco de los Romo', 1, NULL);
INSERT INTO `municipios` VALUES (12, 2, '001', 'Ensenada', 1, 1);
INSERT INTO `municipios` VALUES (13, 2, '002', 'Mexicali', 1, 1);
INSERT INTO `municipios` VALUES (14, 2, '003', 'Tecate', 1, 1);
INSERT INTO `municipios` VALUES (15, 2, '004', 'Tijuana', 1, 1);
INSERT INTO `municipios` VALUES (16, 2, '005', 'Playas de Rosarito', 1, NULL);
INSERT INTO `municipios` VALUES (17, 3, '001', 'Comondú', 1, NULL);
INSERT INTO `municipios` VALUES (18, 3, '002', 'Mulegé', 1, NULL);
INSERT INTO `municipios` VALUES (19, 3, '003', 'La Paz', 1, 1);
INSERT INTO `municipios` VALUES (20, 3, '008', 'Los Cabos', 1, 1);
INSERT INTO `municipios` VALUES (21, 3, '009', 'Loreto', 1, NULL);
INSERT INTO `municipios` VALUES (22, 4, '001', 'Calkiní', 1, NULL);
INSERT INTO `municipios` VALUES (23, 4, '002', 'Campeche', 1, 1);
INSERT INTO `municipios` VALUES (24, 4, '003', 'Carmen', 1, 1);
INSERT INTO `municipios` VALUES (25, 4, '004', 'Champotón', 1, NULL);
INSERT INTO `municipios` VALUES (26, 4, '005', 'Hecelchakán', 1, NULL);
INSERT INTO `municipios` VALUES (27, 4, '006', 'Hopelchén', 1, NULL);
INSERT INTO `municipios` VALUES (28, 4, '007', 'Palizada', 1, NULL);
INSERT INTO `municipios` VALUES (29, 4, '008', 'Tenabo', 1, NULL);
INSERT INTO `municipios` VALUES (30, 4, '009', 'Escárcega', 1, NULL);
INSERT INTO `municipios` VALUES (31, 4, '010', 'Calakmul', 1, NULL);
INSERT INTO `municipios` VALUES (32, 4, '011', 'Candelaria', 1, NULL);
INSERT INTO `municipios` VALUES (33, 5, '001', 'Abasolo', 1, NULL);
INSERT INTO `municipios` VALUES (34, 5, '002', 'Acuña', 1, NULL);
INSERT INTO `municipios` VALUES (35, 5, '003', 'Allende', 1, NULL);
INSERT INTO `municipios` VALUES (36, 5, '004', 'Arteaga', 1, 1);
INSERT INTO `municipios` VALUES (37, 5, '005', 'Candela', 1, NULL);
INSERT INTO `municipios` VALUES (38, 5, '006', 'Castaños', 1, NULL);
INSERT INTO `municipios` VALUES (39, 5, '007', 'Cuatro Ciénegas', 1, NULL);
INSERT INTO `municipios` VALUES (40, 5, '008', 'Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (41, 5, '009', 'Francisco I. Madero', 1, NULL);
INSERT INTO `municipios` VALUES (42, 5, '010', 'Frontera', 1, NULL);
INSERT INTO `municipios` VALUES (43, 5, '011', 'General Cepeda', 1, NULL);
INSERT INTO `municipios` VALUES (44, 5, '012', 'Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (45, 5, '013', 'Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (46, 5, '014', 'Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (47, 5, '015', 'Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (48, 5, '016', 'Lamadrid', 1, NULL);
INSERT INTO `municipios` VALUES (49, 5, '017', 'Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (50, 5, '018', 'Monclova', 1, NULL);
INSERT INTO `municipios` VALUES (51, 5, '019', 'Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (52, 5, '020', 'Múzquiz', 1, NULL);
INSERT INTO `municipios` VALUES (53, 5, '021', 'Nadadores', 1, NULL);
INSERT INTO `municipios` VALUES (54, 5, '022', 'Nava', 1, NULL);
INSERT INTO `municipios` VALUES (55, 5, '023', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (56, 5, '024', 'Parras', 1, NULL);
INSERT INTO `municipios` VALUES (57, 5, '025', 'Piedras Negras', 1, NULL);
INSERT INTO `municipios` VALUES (58, 5, '026', 'Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (59, 5, '027', 'Ramos Arizpe', 1, 1);
INSERT INTO `municipios` VALUES (60, 5, '028', 'Sabinas', 1, NULL);
INSERT INTO `municipios` VALUES (61, 5, '029', 'Sacramento', 1, NULL);
INSERT INTO `municipios` VALUES (62, 5, '030', 'Saltillo', 1, 1);
INSERT INTO `municipios` VALUES (63, 5, '031', 'San Buenaventura', 1, NULL);
INSERT INTO `municipios` VALUES (64, 5, '032', 'San Juan de Sabinas', 1, NULL);
INSERT INTO `municipios` VALUES (65, 5, '033', 'San Pedro', 1, NULL);
INSERT INTO `municipios` VALUES (66, 5, '034', 'Sierra Mojada', 1, NULL);
INSERT INTO `municipios` VALUES (67, 5, '035', 'Torreón', 1, 1);
INSERT INTO `municipios` VALUES (68, 5, '036', 'Viesca', 1, NULL);
INSERT INTO `municipios` VALUES (69, 5, '037', 'Villa Unión', 1, NULL);
INSERT INTO `municipios` VALUES (70, 5, '038', 'Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (71, 6, '001', 'Armería', 1, 1);
INSERT INTO `municipios` VALUES (72, 6, '002', 'Colima', 1, 1);
INSERT INTO `municipios` VALUES (73, 6, '003', 'Comala', 1, NULL);
INSERT INTO `municipios` VALUES (74, 6, '004', 'Coquimatlán', 1, NULL);
INSERT INTO `municipios` VALUES (75, 6, '005', 'Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (76, 6, '006', 'Ixtlahuacán', 1, NULL);
INSERT INTO `municipios` VALUES (77, 6, '007', 'Manzanillo', 1, 1);
INSERT INTO `municipios` VALUES (78, 6, '008', 'Minatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (79, 6, '009', 'Tecomán', 1, 1);
INSERT INTO `municipios` VALUES (80, 6, '010', 'Villa de Álvarez', 1, 1);
INSERT INTO `municipios` VALUES (81, 7, '001', 'Acacoyagua', 1, NULL);
INSERT INTO `municipios` VALUES (82, 7, '002', 'Acala', 1, NULL);
INSERT INTO `municipios` VALUES (83, 7, '003', 'Acapetahua', 1, NULL);
INSERT INTO `municipios` VALUES (84, 7, '004', 'Altamirano', 1, NULL);
INSERT INTO `municipios` VALUES (85, 7, '005', 'Amatán', 1, NULL);
INSERT INTO `municipios` VALUES (86, 7, '006', 'Amatenango de la Frontera', 1, NULL);
INSERT INTO `municipios` VALUES (87, 7, '007', 'Amatenango del Valle', 1, NULL);
INSERT INTO `municipios` VALUES (88, 7, '008', 'Angel Albino Corzo', 1, NULL);
INSERT INTO `municipios` VALUES (89, 7, '009', 'Arriaga', 1, NULL);
INSERT INTO `municipios` VALUES (90, 7, '010', 'Bejucal de Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (91, 7, '011', 'Bella Vista', 1, NULL);
INSERT INTO `municipios` VALUES (92, 7, '012', 'Berriozábal', 1, NULL);
INSERT INTO `municipios` VALUES (93, 7, '013', 'Bochil', 1, NULL);
INSERT INTO `municipios` VALUES (94, 7, '014', 'El Bosque', 1, NULL);
INSERT INTO `municipios` VALUES (95, 7, '015', 'Cacahoatán', 1, NULL);
INSERT INTO `municipios` VALUES (96, 7, '016', 'Catazajá', 1, NULL);
INSERT INTO `municipios` VALUES (97, 7, '017', 'Cintalapa', 1, NULL);
INSERT INTO `municipios` VALUES (98, 7, '018', 'Coapilla', 1, NULL);
INSERT INTO `municipios` VALUES (99, 7, '019', 'Comitán de Domínguez', 1, NULL);
INSERT INTO `municipios` VALUES (100, 7, '020', 'La Concordia', 1, NULL);
INSERT INTO `municipios` VALUES (101, 7, '021', 'Copainalá', 1, NULL);
INSERT INTO `municipios` VALUES (102, 7, '022', 'Chalchihuitán', 1, NULL);
INSERT INTO `municipios` VALUES (103, 7, '023', 'Chamula', 1, NULL);
INSERT INTO `municipios` VALUES (104, 7, '024', 'Chanal', 1, NULL);
INSERT INTO `municipios` VALUES (105, 7, '025', 'Chapultenango', 1, NULL);
INSERT INTO `municipios` VALUES (106, 7, '026', 'Chenalhó', 1, NULL);
INSERT INTO `municipios` VALUES (107, 7, '027', 'Chiapa de Corzo', 1, NULL);
INSERT INTO `municipios` VALUES (108, 7, '028', 'Chiapilla', 1, NULL);
INSERT INTO `municipios` VALUES (109, 7, '029', 'Chicoasén', 1, NULL);
INSERT INTO `municipios` VALUES (110, 7, '030', 'Chicomuselo', 1, NULL);
INSERT INTO `municipios` VALUES (111, 7, '031', 'Chilón', 1, NULL);
INSERT INTO `municipios` VALUES (112, 7, '032', 'Escuintla', 1, NULL);
INSERT INTO `municipios` VALUES (113, 7, '033', 'Francisco León', 1, NULL);
INSERT INTO `municipios` VALUES (114, 7, '034', 'Frontera Comalapa', 1, NULL);
INSERT INTO `municipios` VALUES (115, 7, '035', 'Frontera Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (116, 7, '036', 'La Grandeza', 1, NULL);
INSERT INTO `municipios` VALUES (117, 7, '037', 'Huehuetán', 1, NULL);
INSERT INTO `municipios` VALUES (118, 7, '038', 'Huixtán', 1, NULL);
INSERT INTO `municipios` VALUES (119, 7, '039', 'Huitiupán', 1, NULL);
INSERT INTO `municipios` VALUES (120, 7, '040', 'Huixtla', 1, NULL);
INSERT INTO `municipios` VALUES (121, 7, '041', 'La Independencia', 1, NULL);
INSERT INTO `municipios` VALUES (122, 7, '042', 'Ixhuatán', 1, NULL);
INSERT INTO `municipios` VALUES (123, 7, '043', 'Ixtacomitán', 1, NULL);
INSERT INTO `municipios` VALUES (124, 7, '044', 'Ixtapa', 1, NULL);
INSERT INTO `municipios` VALUES (125, 7, '045', 'Ixtapangajoya', 1, NULL);
INSERT INTO `municipios` VALUES (126, 7, '046', 'Jiquipilas', 1, NULL);
INSERT INTO `municipios` VALUES (127, 7, '047', 'Jitotol', 1, NULL);
INSERT INTO `municipios` VALUES (128, 7, '048', 'Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (129, 7, '049', 'Larráinzar', 1, NULL);
INSERT INTO `municipios` VALUES (130, 7, '050', 'La Libertad', 1, NULL);
INSERT INTO `municipios` VALUES (131, 7, '051', 'Mapastepec', 1, NULL);
INSERT INTO `municipios` VALUES (132, 7, '052', 'Las Margaritas', 1, NULL);
INSERT INTO `municipios` VALUES (133, 7, '053', 'Mazapa de Madero', 1, NULL);
INSERT INTO `municipios` VALUES (134, 7, '054', 'Mazatán', 1, NULL);
INSERT INTO `municipios` VALUES (135, 7, '055', 'Metapa', 1, NULL);
INSERT INTO `municipios` VALUES (136, 7, '056', 'Mitontic', 1, NULL);
INSERT INTO `municipios` VALUES (137, 7, '057', 'Motozintla', 1, NULL);
INSERT INTO `municipios` VALUES (138, 7, '058', 'Nicolás Ruíz', 1, NULL);
INSERT INTO `municipios` VALUES (139, 7, '059', 'Ocosingo', 1, NULL);
INSERT INTO `municipios` VALUES (140, 7, '060', 'Ocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (141, 7, '061', 'Ocozocoautla de Espinosa', 1, NULL);
INSERT INTO `municipios` VALUES (142, 7, '062', 'Ostuacán', 1, NULL);
INSERT INTO `municipios` VALUES (143, 7, '063', 'Osumacinta', 1, NULL);
INSERT INTO `municipios` VALUES (144, 7, '064', 'Oxchuc', 1, NULL);
INSERT INTO `municipios` VALUES (145, 7, '065', 'Palenque', 1, NULL);
INSERT INTO `municipios` VALUES (146, 7, '066', 'Pantelhó', 1, NULL);
INSERT INTO `municipios` VALUES (147, 7, '067', 'Pantepec', 1, NULL);
INSERT INTO `municipios` VALUES (148, 7, '068', 'Pichucalco', 1, NULL);
INSERT INTO `municipios` VALUES (149, 7, '069', 'Pijijiapan', 1, NULL);
INSERT INTO `municipios` VALUES (150, 7, '070', 'El Porvenir', 1, NULL);
INSERT INTO `municipios` VALUES (151, 7, '071', 'Villa Comaltitlán', 1, NULL);
INSERT INTO `municipios` VALUES (152, 7, '072', 'Pueblo Nuevo Solistahuacán', 1, NULL);
INSERT INTO `municipios` VALUES (153, 7, '073', 'Rayón', 1, NULL);
INSERT INTO `municipios` VALUES (154, 7, '074', 'Reforma', 1, NULL);
INSERT INTO `municipios` VALUES (155, 7, '075', 'Las Rosas', 1, NULL);
INSERT INTO `municipios` VALUES (156, 7, '076', 'Sabanilla', 1, NULL);
INSERT INTO `municipios` VALUES (157, 7, '077', 'Salto de Agua', 1, NULL);
INSERT INTO `municipios` VALUES (158, 7, '078', 'San Cristóbal de las Casas', 1, 1);
INSERT INTO `municipios` VALUES (159, 7, '079', 'San Fernando', 1, NULL);
INSERT INTO `municipios` VALUES (160, 7, '080', 'Siltepec', 1, NULL);
INSERT INTO `municipios` VALUES (161, 7, '081', 'Simojovel', 1, NULL);
INSERT INTO `municipios` VALUES (162, 7, '082', 'Sitalá', 1, NULL);
INSERT INTO `municipios` VALUES (163, 7, '083', 'Socoltenango', 1, NULL);
INSERT INTO `municipios` VALUES (164, 7, '084', 'Solosuchiapa', 1, NULL);
INSERT INTO `municipios` VALUES (165, 7, '085', 'Soyaló', 1, NULL);
INSERT INTO `municipios` VALUES (166, 7, '086', 'Suchiapa', 1, NULL);
INSERT INTO `municipios` VALUES (167, 7, '087', 'Suchiate', 1, NULL);
INSERT INTO `municipios` VALUES (168, 7, '088', 'Sunuapa', 1, NULL);
INSERT INTO `municipios` VALUES (169, 7, '089', 'Tapachula', 1, NULL);
INSERT INTO `municipios` VALUES (170, 7, '090', 'Tapalapa', 1, NULL);
INSERT INTO `municipios` VALUES (171, 7, '091', 'Tapilula', 1, NULL);
INSERT INTO `municipios` VALUES (172, 7, '092', 'Tecpatán', 1, NULL);
INSERT INTO `municipios` VALUES (173, 7, '093', 'Tenejapa', 1, NULL);
INSERT INTO `municipios` VALUES (174, 7, '094', 'Teopisca', 1, NULL);
INSERT INTO `municipios` VALUES (175, 7, '096', 'Tila', 1, NULL);
INSERT INTO `municipios` VALUES (176, 7, '097', 'Tonalá', 1, NULL);
INSERT INTO `municipios` VALUES (177, 7, '098', 'Totolapa', 1, NULL);
INSERT INTO `municipios` VALUES (178, 7, '099', 'La Trinitaria', 1, NULL);
INSERT INTO `municipios` VALUES (179, 7, '100', 'Tumbalá', 1, NULL);
INSERT INTO `municipios` VALUES (180, 7, '101', 'Tuxtla Gutiérrez', 1, 1);
INSERT INTO `municipios` VALUES (181, 7, '102', 'Tuxtla Chico', 1, NULL);
INSERT INTO `municipios` VALUES (182, 7, '103', 'Tuzantán', 1, NULL);
INSERT INTO `municipios` VALUES (183, 7, '104', 'Tzimol', 1, NULL);
INSERT INTO `municipios` VALUES (184, 7, '105', 'Unión Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (185, 7, '106', 'Venustiano Carranza', 1, NULL);
INSERT INTO `municipios` VALUES (186, 7, '107', 'Villa Corzo', 1, NULL);
INSERT INTO `municipios` VALUES (187, 7, '108', 'Villaflores', 1, NULL);
INSERT INTO `municipios` VALUES (188, 7, '109', 'Yajalón', 1, NULL);
INSERT INTO `municipios` VALUES (189, 7, '110', 'San Lucas', 1, NULL);
INSERT INTO `municipios` VALUES (190, 7, '111', 'Zinacantán', 1, NULL);
INSERT INTO `municipios` VALUES (191, 7, '112', 'San Juan Cancuc', 1, NULL);
INSERT INTO `municipios` VALUES (192, 7, '113', 'Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (193, 7, '114', 'Benemérito de las Américas', 1, NULL);
INSERT INTO `municipios` VALUES (194, 7, '115', 'Maravilla Tenejapa', 1, NULL);
INSERT INTO `municipios` VALUES (195, 7, '116', 'Marqués de Comillas', 1, NULL);
INSERT INTO `municipios` VALUES (196, 7, '117', 'Montecristo de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (197, 7, '118', 'San Andrés Duraznal', 1, NULL);
INSERT INTO `municipios` VALUES (198, 7, '119', 'Santiago el Pinar', 1, NULL);
INSERT INTO `municipios` VALUES (199, 7, '120', 'Capitán Luis Ángel Vidal', 1, NULL);
INSERT INTO `municipios` VALUES (200, 7, '121', 'Rincón Chamula San Pedro', 1, NULL);
INSERT INTO `municipios` VALUES (201, 7, '122', 'El Parral', 1, NULL);
INSERT INTO `municipios` VALUES (202, 7, '123', 'Emiliano Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (203, 7, '124', 'Mezcalapa', 1, NULL);
INSERT INTO `municipios` VALUES (204, 8, '001', 'Ahumada', 1, NULL);
INSERT INTO `municipios` VALUES (205, 8, '002', 'Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (206, 8, '003', 'Allende', 1, NULL);
INSERT INTO `municipios` VALUES (207, 8, '004', 'Aquiles Serdán', 1, NULL);
INSERT INTO `municipios` VALUES (208, 8, '005', 'Ascensión', 1, NULL);
INSERT INTO `municipios` VALUES (209, 8, '006', 'Bachíniva', 1, NULL);
INSERT INTO `municipios` VALUES (210, 8, '007', 'Balleza', 1, NULL);
INSERT INTO `municipios` VALUES (211, 8, '008', 'Batopilas de Manuel Gómez Morín', 1, NULL);
INSERT INTO `municipios` VALUES (212, 8, '009', 'Bocoyna', 1, NULL);
INSERT INTO `municipios` VALUES (213, 8, '010', 'Buenaventura', 1, NULL);
INSERT INTO `municipios` VALUES (214, 8, '011', 'Camargo', 1, 1);
INSERT INTO `municipios` VALUES (215, 8, '012', 'Carichí', 1, NULL);
INSERT INTO `municipios` VALUES (216, 8, '013', 'Casas Grandes', 1, 1);
INSERT INTO `municipios` VALUES (217, 8, '014', 'Coronado', 1, NULL);
INSERT INTO `municipios` VALUES (218, 8, '015', 'Coyame del Sotol', 1, NULL);
INSERT INTO `municipios` VALUES (219, 8, '016', 'La Cruz', 1, NULL);
INSERT INTO `municipios` VALUES (220, 8, '017', 'Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (221, 8, '018', 'Cusihuiriachi', 1, NULL);
INSERT INTO `municipios` VALUES (222, 8, '019', 'Chihuahua', 1, 1);
INSERT INTO `municipios` VALUES (223, 8, '020', 'Chínipas', 1, NULL);
INSERT INTO `municipios` VALUES (224, 8, '021', 'Delicias', 1, 1);
INSERT INTO `municipios` VALUES (225, 8, '022', 'Dr. Belisario Domínguez', 1, NULL);
INSERT INTO `municipios` VALUES (226, 8, '023', 'Galeana', 1, NULL);
INSERT INTO `municipios` VALUES (227, 8, '024', 'Santa Isabel', 1, NULL);
INSERT INTO `municipios` VALUES (228, 8, '025', 'Gómez Farías', 1, NULL);
INSERT INTO `municipios` VALUES (229, 8, '026', 'Gran Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (230, 8, '027', 'Guachochi', 1, NULL);
INSERT INTO `municipios` VALUES (231, 8, '028', 'Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (232, 8, '029', 'Guadalupe y Calvo', 1, NULL);
INSERT INTO `municipios` VALUES (233, 8, '030', 'Guazapares', 1, NULL);
INSERT INTO `municipios` VALUES (234, 8, '031', 'Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (235, 8, '032', 'Hidalgo del Parral', 1, 1);
INSERT INTO `municipios` VALUES (236, 8, '033', 'Huejotitán', 1, NULL);
INSERT INTO `municipios` VALUES (237, 8, '034', 'Ignacio Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (238, 8, '035', 'Janos', 1, NULL);
INSERT INTO `municipios` VALUES (239, 8, '036', 'Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (240, 8, '037', 'Cd.Juárez', 1, 1);
INSERT INTO `municipios` VALUES (241, 8, '038', 'Julimes', 1, NULL);
INSERT INTO `municipios` VALUES (242, 8, '039', 'López', 1, NULL);
INSERT INTO `municipios` VALUES (243, 8, '040', 'Madera', 1, NULL);
INSERT INTO `municipios` VALUES (244, 8, '041', 'Maguarichi', 1, NULL);
INSERT INTO `municipios` VALUES (245, 8, '042', 'Manuel Benavides', 1, NULL);
INSERT INTO `municipios` VALUES (246, 8, '043', 'Matachí', 1, NULL);
INSERT INTO `municipios` VALUES (247, 8, '044', 'Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (248, 8, '045', 'Meoqui', 1, NULL);
INSERT INTO `municipios` VALUES (249, 8, '046', 'Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (250, 8, '047', 'Moris', 1, NULL);
INSERT INTO `municipios` VALUES (251, 8, '048', 'Namiquipa', 1, NULL);
INSERT INTO `municipios` VALUES (252, 8, '049', 'Nonoava', 1, NULL);
INSERT INTO `municipios` VALUES (253, 8, '050', 'Nuevo Casas Grandes', 1, NULL);
INSERT INTO `municipios` VALUES (254, 8, '051', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (255, 8, '052', 'Ojinaga', 1, NULL);
INSERT INTO `municipios` VALUES (256, 8, '053', 'Praxedis G. Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (257, 8, '054', 'Riva Palacio', 1, NULL);
INSERT INTO `municipios` VALUES (258, 8, '055', 'Rosales', 1, NULL);
INSERT INTO `municipios` VALUES (259, 8, '056', 'Rosario', 1, NULL);
INSERT INTO `municipios` VALUES (260, 8, '057', 'San Francisco de Borja', 1, NULL);
INSERT INTO `municipios` VALUES (261, 8, '058', 'San Francisco de Conchos', 1, NULL);
INSERT INTO `municipios` VALUES (262, 8, '059', 'San Francisco del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (263, 8, '060', 'Santa Bárbara', 1, NULL);
INSERT INTO `municipios` VALUES (264, 8, '061', 'Satevó', 1, NULL);
INSERT INTO `municipios` VALUES (265, 8, '062', 'Saucillo', 1, NULL);
INSERT INTO `municipios` VALUES (266, 8, '063', 'Temósachic', 1, NULL);
INSERT INTO `municipios` VALUES (267, 8, '064', 'El Tule', 1, NULL);
INSERT INTO `municipios` VALUES (268, 8, '065', 'Urique', 1, NULL);
INSERT INTO `municipios` VALUES (269, 8, '066', 'Uruachi', 1, NULL);
INSERT INTO `municipios` VALUES (270, 8, '067', 'Valle de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (271, 9, '002', 'Azcapotzalco', 1, 1);
INSERT INTO `municipios` VALUES (272, 9, '003', 'Coyoacán', 1, 1);
INSERT INTO `municipios` VALUES (273, 9, '004', 'Cuajimalpa de Morelos', 1, 1);
INSERT INTO `municipios` VALUES (274, 9, '005', 'Gustavo A. Madero', 1, 1);
INSERT INTO `municipios` VALUES (275, 9, '006', 'Iztacalco', 1, 1);
INSERT INTO `municipios` VALUES (276, 9, '007', 'Iztapalapa', 1, 1);
INSERT INTO `municipios` VALUES (277, 9, '008', 'La Magdalena Contreras', 1, 1);
INSERT INTO `municipios` VALUES (278, 9, '009', 'Milpa Alta', 1, NULL);
INSERT INTO `municipios` VALUES (279, 9, '010', 'Álvaro Obregón', 1, 1);
INSERT INTO `municipios` VALUES (280, 9, '011', 'Tláhuac', 1, 1);
INSERT INTO `municipios` VALUES (281, 9, '012', 'Tlalpan', 1, 1);
INSERT INTO `municipios` VALUES (282, 9, '013', 'Xochimilco', 1, 1);
INSERT INTO `municipios` VALUES (283, 9, '014', 'Benito Juárez', 1, 1);
INSERT INTO `municipios` VALUES (284, 9, '015', 'Cuauhtémoc', 1, 1);
INSERT INTO `municipios` VALUES (285, 9, '016', 'Miguel Hidalgo', 1, 1);
INSERT INTO `municipios` VALUES (286, 9, '017', 'Venustiano Carranza', 1, 1);
INSERT INTO `municipios` VALUES (287, 10, '001', 'Canatlán', 1, NULL);
INSERT INTO `municipios` VALUES (288, 10, '002', 'Canelas', 1, NULL);
INSERT INTO `municipios` VALUES (289, 10, '003', 'Coneto de Comonfort', 1, NULL);
INSERT INTO `municipios` VALUES (290, 10, '004', 'Cuencamé', 1, NULL);
INSERT INTO `municipios` VALUES (291, 10, '005', 'Durango', 1, 1);
INSERT INTO `municipios` VALUES (292, 10, '006', 'General Simón Bolívar', 1, NULL);
INSERT INTO `municipios` VALUES (293, 10, '007', 'Gómez Palacio', 1, 1);
INSERT INTO `municipios` VALUES (294, 10, '008', 'Guadalupe Victoria', 1, 1);
INSERT INTO `municipios` VALUES (295, 10, '009', 'Guanaceví', 1, NULL);
INSERT INTO `municipios` VALUES (296, 10, '010', 'Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (297, 10, '011', 'Indé', 1, NULL);
INSERT INTO `municipios` VALUES (298, 10, '012', 'Lerdo', 1, 1);
INSERT INTO `municipios` VALUES (299, 10, '013', 'Mapimí', 1, NULL);
INSERT INTO `municipios` VALUES (300, 10, '014', 'Mezquital', 1, NULL);
INSERT INTO `municipios` VALUES (301, 10, '015', 'Nazas', 1, NULL);
INSERT INTO `municipios` VALUES (302, 10, '016', 'Nombre de Dios', 1, 1);
INSERT INTO `municipios` VALUES (303, 10, '017', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (304, 10, '018', 'El Oro', 1, NULL);
INSERT INTO `municipios` VALUES (305, 10, '019', 'Otáez', 1, NULL);
INSERT INTO `municipios` VALUES (306, 10, '020', 'Pánuco de Coronado', 1, 1);
INSERT INTO `municipios` VALUES (307, 10, '021', 'Peñón Blanco', 1, NULL);
INSERT INTO `municipios` VALUES (308, 10, '022', 'Poanas', 1, NULL);
INSERT INTO `municipios` VALUES (309, 10, '023', 'Pueblo Nuevo', 1, NULL);
INSERT INTO `municipios` VALUES (310, 10, '024', 'Rodeo', 1, NULL);
INSERT INTO `municipios` VALUES (311, 10, '025', 'San Bernardo', 1, NULL);
INSERT INTO `municipios` VALUES (312, 10, '026', 'San Dimas', 1, NULL);
INSERT INTO `municipios` VALUES (313, 10, '027', 'San Juan de Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (314, 10, '028', 'San Juan del Río', 1, NULL);
INSERT INTO `municipios` VALUES (315, 10, '029', 'San Luis del Cordero', 1, NULL);
INSERT INTO `municipios` VALUES (316, 10, '030', 'San Pedro del Gallo', 1, NULL);
INSERT INTO `municipios` VALUES (317, 10, '031', 'Santa Clara', 1, NULL);
INSERT INTO `municipios` VALUES (318, 10, '032', 'Santiago Papasquiaro', 1, NULL);
INSERT INTO `municipios` VALUES (319, 10, '033', 'Súchil', 1, NULL);
INSERT INTO `municipios` VALUES (320, 10, '034', 'Tamazula', 1, NULL);
INSERT INTO `municipios` VALUES (321, 10, '035', 'Tepehuanes', 1, NULL);
INSERT INTO `municipios` VALUES (322, 10, '036', 'Tlahualilo', 1, NULL);
INSERT INTO `municipios` VALUES (323, 10, '037', 'Topia', 1, NULL);
INSERT INTO `municipios` VALUES (324, 10, '038', 'Vicente Guerrero', 1, 1);
INSERT INTO `municipios` VALUES (325, 10, '039', 'Nuevo Ideal', 1, NULL);
INSERT INTO `municipios` VALUES (326, 11, '001', 'Abasolo', 1, 1);
INSERT INTO `municipios` VALUES (327, 11, '002', 'Acámbaro', 1, 1);
INSERT INTO `municipios` VALUES (328, 11, '003', 'San Miguel de Allende', 1, 1);
INSERT INTO `municipios` VALUES (329, 11, '004', 'Apaseo el Alto', 1, 1);
INSERT INTO `municipios` VALUES (330, 11, '005', 'Apaseo el Grande', 1, 1);
INSERT INTO `municipios` VALUES (331, 11, '006', 'Atarjea', 1, NULL);
INSERT INTO `municipios` VALUES (332, 11, '007', 'Celaya', 1, 1);
INSERT INTO `municipios` VALUES (333, 11, '008', 'Manuel Doblado', 1, NULL);
INSERT INTO `municipios` VALUES (334, 11, '009', 'Comonfort', 1, 1);
INSERT INTO `municipios` VALUES (335, 11, '010', 'Coroneo', 1, NULL);
INSERT INTO `municipios` VALUES (336, 11, '011', 'Cortazar', 1, 1);
INSERT INTO `municipios` VALUES (337, 11, '012', 'Cuerámaro', 1, NULL);
INSERT INTO `municipios` VALUES (338, 11, '013', 'Doctor Mora', 1, NULL);
INSERT INTO `municipios` VALUES (339, 11, '014', 'Dolores Hidalgo Cuna de la Independencia Nacional', 1, 1);
INSERT INTO `municipios` VALUES (340, 11, '015', 'Guanajuato', 1, 1);
INSERT INTO `municipios` VALUES (341, 11, '016', 'Huanímaro', 1, NULL);
INSERT INTO `municipios` VALUES (342, 11, '017', 'Irapuato', 1, 1);
INSERT INTO `municipios` VALUES (343, 11, '018', 'Jaral del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (344, 11, '019', 'Jerécuaro', 1, NULL);
INSERT INTO `municipios` VALUES (345, 11, '020', 'León', 1, NULL);
INSERT INTO `municipios` VALUES (346, 11, '021', 'Moroleón', 1, 1);
INSERT INTO `municipios` VALUES (347, 11, '022', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (348, 11, '023', 'Pénjamo', 1, 1);
INSERT INTO `municipios` VALUES (349, 11, '024', 'Pueblo Nuevo', 1, NULL);
INSERT INTO `municipios` VALUES (350, 11, '025', 'Purísima del Rincón', 1, NULL);
INSERT INTO `municipios` VALUES (351, 11, '026', 'Romita', 1, NULL);
INSERT INTO `municipios` VALUES (352, 11, '027', 'Salamanca', 1, 1);
INSERT INTO `municipios` VALUES (353, 11, '028', 'Salvatierra', 1, 1);
INSERT INTO `municipios` VALUES (354, 11, '029', 'San Diego de la Unión', 1, NULL);
INSERT INTO `municipios` VALUES (355, 11, '030', 'San Felipe', 1, NULL);
INSERT INTO `municipios` VALUES (356, 11, '031', 'San Francisco del Rincón', 1, 1);
INSERT INTO `municipios` VALUES (357, 11, '032', 'San José Iturbide', 1, 1);
INSERT INTO `municipios` VALUES (358, 11, '033', 'San Luis de la Paz', 1, NULL);
INSERT INTO `municipios` VALUES (359, 11, '034', 'Santa Catarina', 1, NULL);
INSERT INTO `municipios` VALUES (360, 11, '035', 'Santa Cruz de Juventino Rosas', 1, NULL);
INSERT INTO `municipios` VALUES (361, 11, '036', 'Santiago Maravatío', 1, NULL);
INSERT INTO `municipios` VALUES (362, 11, '037', 'Silao de la Victoria', 1, 1);
INSERT INTO `municipios` VALUES (363, 11, '038', 'Tarandacuao', 1, NULL);
INSERT INTO `municipios` VALUES (364, 11, '039', 'Tarimoro', 1, NULL);
INSERT INTO `municipios` VALUES (365, 11, '040', 'Tierra Blanca', 1, NULL);
INSERT INTO `municipios` VALUES (366, 11, '041', 'Uriangato', 1, 1);
INSERT INTO `municipios` VALUES (367, 11, '042', 'Valle de Santiago', 1, 1);
INSERT INTO `municipios` VALUES (368, 11, '043', 'Victoria', 1, NULL);
INSERT INTO `municipios` VALUES (369, 11, '044', 'Villagrán', 1, 1);
INSERT INTO `municipios` VALUES (370, 11, '045', 'Xichú', 1, NULL);
INSERT INTO `municipios` VALUES (371, 11, '046', 'Yuriria', 1, 1);
INSERT INTO `municipios` VALUES (372, 12, '001', 'Acapulco de Juárez', 1, 1);
INSERT INTO `municipios` VALUES (373, 12, '002', 'Ahuacuotzingo', 1, NULL);
INSERT INTO `municipios` VALUES (374, 12, '003', 'Ajuchitlán del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (375, 12, '004', 'Alcozauca de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (376, 12, '005', 'Alpoyeca', 1, NULL);
INSERT INTO `municipios` VALUES (377, 12, '006', 'Apaxtla', 1, NULL);
INSERT INTO `municipios` VALUES (378, 12, '007', 'Arcelia', 1, NULL);
INSERT INTO `municipios` VALUES (379, 12, '008', 'Atenango del Río', 1, NULL);
INSERT INTO `municipios` VALUES (380, 12, '009', 'Atlamajalcingo del Monte', 1, NULL);
INSERT INTO `municipios` VALUES (381, 12, '010', 'Atlixtac', 1, NULL);
INSERT INTO `municipios` VALUES (382, 12, '011', 'Atoyac de Álvarez', 1, NULL);
INSERT INTO `municipios` VALUES (383, 12, '012', 'Ayutla de los Libres', 1, NULL);
INSERT INTO `municipios` VALUES (384, 12, '013', 'Azoyú', 1, NULL);
INSERT INTO `municipios` VALUES (385, 12, '014', 'Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (386, 12, '015', 'Buenavista de Cuéllar', 1, NULL);
INSERT INTO `municipios` VALUES (387, 12, '016', 'Coahuayutla de José María Izazaga', 1, NULL);
INSERT INTO `municipios` VALUES (388, 12, '017', 'Cocula', 1, NULL);
INSERT INTO `municipios` VALUES (389, 12, '018', 'Copala', 1, NULL);
INSERT INTO `municipios` VALUES (390, 12, '019', 'Copalillo', 1, NULL);
INSERT INTO `municipios` VALUES (391, 12, '020', 'Copanatoyac', 1, NULL);
INSERT INTO `municipios` VALUES (392, 12, '021', 'Coyuca de Benítez', 1, NULL);
INSERT INTO `municipios` VALUES (393, 12, '022', 'Coyuca de Catalán', 1, NULL);
INSERT INTO `municipios` VALUES (394, 12, '023', 'Cuajinicuilapa', 1, NULL);
INSERT INTO `municipios` VALUES (395, 12, '024', 'Cualác', 1, NULL);
INSERT INTO `municipios` VALUES (396, 12, '025', 'Cuautepec', 1, NULL);
INSERT INTO `municipios` VALUES (397, 12, '026', 'Cuetzala del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (398, 12, '027', 'Cutzamala de Pinzón', 1, NULL);
INSERT INTO `municipios` VALUES (399, 12, '028', 'Chilapa de Álvarez', 1, NULL);
INSERT INTO `municipios` VALUES (400, 12, '029', 'Chilpancingo de los Bravo', 1, 1);
INSERT INTO `municipios` VALUES (401, 12, '030', 'Florencio Villarreal', 1, NULL);
INSERT INTO `municipios` VALUES (402, 12, '031', 'General Canuto A. Neri', 1, NULL);
INSERT INTO `municipios` VALUES (403, 12, '032', 'General Heliodoro Castillo', 1, NULL);
INSERT INTO `municipios` VALUES (404, 12, '033', 'Huamuxtitlán', 1, NULL);
INSERT INTO `municipios` VALUES (405, 12, '034', 'Huitzuco de los Figueroa', 1, NULL);
INSERT INTO `municipios` VALUES (406, 12, '035', 'Iguala de la Independencia', 1, 1);
INSERT INTO `municipios` VALUES (407, 12, '036', 'Igualapa', 1, NULL);
INSERT INTO `municipios` VALUES (408, 12, '037', 'Ixcateopan de Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (409, 12, '038', 'Zihuatanejo de Azueta', 1, 1);
INSERT INTO `municipios` VALUES (410, 12, '039', 'Juan R. Escudero', 1, NULL);
INSERT INTO `municipios` VALUES (411, 12, '040', 'Leonardo Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (412, 12, '041', 'Malinaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (413, 12, '042', 'Mártir de Cuilapan', 1, NULL);
INSERT INTO `municipios` VALUES (414, 12, '043', 'Metlatónoc', 1, NULL);
INSERT INTO `municipios` VALUES (415, 12, '044', 'Mochitlán', 1, NULL);
INSERT INTO `municipios` VALUES (416, 12, '045', 'Olinalá', 1, NULL);
INSERT INTO `municipios` VALUES (417, 12, '046', 'Ometepec', 1, NULL);
INSERT INTO `municipios` VALUES (418, 12, '047', 'Pedro Ascencio Alquisiras', 1, NULL);
INSERT INTO `municipios` VALUES (419, 12, '048', 'Petatlán', 1, NULL);
INSERT INTO `municipios` VALUES (420, 12, '049', 'Pilcaya', 1, NULL);
INSERT INTO `municipios` VALUES (421, 12, '050', 'Pungarabato', 1, NULL);
INSERT INTO `municipios` VALUES (422, 12, '051', 'Quechultenango', 1, NULL);
INSERT INTO `municipios` VALUES (423, 12, '052', 'San Luis Acatlán', 1, NULL);
INSERT INTO `municipios` VALUES (424, 12, '053', 'San Marcos', 1, NULL);
INSERT INTO `municipios` VALUES (425, 12, '054', 'San Miguel Totolapan', 1, NULL);
INSERT INTO `municipios` VALUES (426, 12, '055', 'Taxco de Alarcón', 1, 1);
INSERT INTO `municipios` VALUES (427, 12, '056', 'Tecoanapa', 1, NULL);
INSERT INTO `municipios` VALUES (428, 12, '057', 'Técpan de Galeana', 1, NULL);
INSERT INTO `municipios` VALUES (429, 12, '058', 'Teloloapan', 1, NULL);
INSERT INTO `municipios` VALUES (430, 12, '059', 'Tepecoacuilco de Trujano', 1, NULL);
INSERT INTO `municipios` VALUES (431, 12, '060', 'Tetipac', 1, NULL);
INSERT INTO `municipios` VALUES (432, 12, '061', 'Tixtla de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (433, 12, '062', 'Tlacoachistlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (434, 12, '063', 'Tlacoapa', 1, NULL);
INSERT INTO `municipios` VALUES (435, 12, '064', 'Tlalchapa', 1, NULL);
INSERT INTO `municipios` VALUES (436, 12, '065', 'Tlalixtaquilla de Maldonado', 1, NULL);
INSERT INTO `municipios` VALUES (437, 12, '066', 'Tlapa de Comonfort', 1, NULL);
INSERT INTO `municipios` VALUES (438, 12, '067', 'Tlapehuala', 1, NULL);
INSERT INTO `municipios` VALUES (439, 12, '068', 'La Unión de Isidoro Montes de Oca', 1, NULL);
INSERT INTO `municipios` VALUES (440, 12, '069', 'Xalpatláhuac', 1, NULL);
INSERT INTO `municipios` VALUES (441, 12, '070', 'Xochihuehuetlán', 1, NULL);
INSERT INTO `municipios` VALUES (442, 12, '071', 'Xochistlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (443, 12, '072', 'Zapotitlán Tablas', 1, NULL);
INSERT INTO `municipios` VALUES (444, 12, '073', 'Zirándaro', 1, NULL);
INSERT INTO `municipios` VALUES (445, 12, '074', 'Zitlala', 1, NULL);
INSERT INTO `municipios` VALUES (446, 12, '075', 'Eduardo Neri', 1, NULL);
INSERT INTO `municipios` VALUES (447, 12, '076', 'Acatepec', 1, NULL);
INSERT INTO `municipios` VALUES (448, 12, '077', 'Marquelia', 1, NULL);
INSERT INTO `municipios` VALUES (449, 12, '078', 'Cochoapa el Grande', 1, NULL);
INSERT INTO `municipios` VALUES (450, 12, '079', 'José Joaquín de Herrera', 1, NULL);
INSERT INTO `municipios` VALUES (451, 12, '080', 'Juchitán', 1, NULL);
INSERT INTO `municipios` VALUES (452, 12, '081', 'Iliatenco', 1, NULL);
INSERT INTO `municipios` VALUES (453, 13, '001', 'Acatlán', 1, NULL);
INSERT INTO `municipios` VALUES (454, 13, '002', 'Acaxochitlán', 1, NULL);
INSERT INTO `municipios` VALUES (455, 13, '003', 'Actopan', 1, NULL);
INSERT INTO `municipios` VALUES (456, 13, '004', 'Agua Blanca de Iturbide', 1, NULL);
INSERT INTO `municipios` VALUES (457, 13, '005', 'Ajacuba', 1, NULL);
INSERT INTO `municipios` VALUES (458, 13, '006', 'Alfajayucan', 1, NULL);
INSERT INTO `municipios` VALUES (459, 13, '007', 'Almoloya', 1, NULL);
INSERT INTO `municipios` VALUES (460, 13, '008', 'Apan', 1, NULL);
INSERT INTO `municipios` VALUES (461, 13, '009', 'El Arenal', 1, NULL);
INSERT INTO `municipios` VALUES (462, 13, '010', 'Atitalaquia', 1, NULL);
INSERT INTO `municipios` VALUES (463, 13, '011', 'Atlapexco', 1, NULL);
INSERT INTO `municipios` VALUES (464, 13, '012', 'Atotonilco el Grande', 1, NULL);
INSERT INTO `municipios` VALUES (465, 13, '013', 'Atotonilco de Tula', 1, NULL);
INSERT INTO `municipios` VALUES (466, 13, '014', 'Calnali', 1, NULL);
INSERT INTO `municipios` VALUES (467, 13, '015', 'Cardonal', 1, NULL);
INSERT INTO `municipios` VALUES (468, 13, '016', 'Cuautepec de Hinojosa', 1, NULL);
INSERT INTO `municipios` VALUES (469, 13, '017', 'Chapantongo', 1, NULL);
INSERT INTO `municipios` VALUES (470, 13, '018', 'Chapulhuacán', 1, NULL);
INSERT INTO `municipios` VALUES (471, 13, '019', 'Chilcuautla', 1, NULL);
INSERT INTO `municipios` VALUES (472, 13, '020', 'Eloxochitlán', 1, NULL);
INSERT INTO `municipios` VALUES (473, 13, '021', 'Emiliano Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (474, 13, '022', 'Epazoyucan', 1, NULL);
INSERT INTO `municipios` VALUES (475, 13, '023', 'Francisco I. Madero', 1, NULL);
INSERT INTO `municipios` VALUES (476, 13, '024', 'Huasca de Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (477, 13, '025', 'Huautla', 1, NULL);
INSERT INTO `municipios` VALUES (478, 13, '026', 'Huazalingo', 1, NULL);
INSERT INTO `municipios` VALUES (479, 13, '027', 'Huehuetla', 1, NULL);
INSERT INTO `municipios` VALUES (480, 13, '028', 'Huejutla de Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (481, 13, '029', 'Huichapan', 1, NULL);
INSERT INTO `municipios` VALUES (482, 13, '030', 'Ixmiquilpan', 1, NULL);
INSERT INTO `municipios` VALUES (483, 13, '031', 'Jacala de Ledezma', 1, NULL);
INSERT INTO `municipios` VALUES (484, 13, '032', 'Jaltocán', 1, NULL);
INSERT INTO `municipios` VALUES (485, 13, '033', 'Juárez Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (486, 13, '034', 'Lolotla', 1, NULL);
INSERT INTO `municipios` VALUES (487, 13, '035', 'Metepec', 1, NULL);
INSERT INTO `municipios` VALUES (488, 13, '036', 'San Agustín Metzquititlán', 1, NULL);
INSERT INTO `municipios` VALUES (489, 13, '037', 'Metztitlán', 1, NULL);
INSERT INTO `municipios` VALUES (490, 13, '038', 'Mineral del Chico', 1, NULL);
INSERT INTO `municipios` VALUES (491, 13, '039', 'Mineral del Monte', 1, NULL);
INSERT INTO `municipios` VALUES (492, 13, '040', 'La Misión', 1, NULL);
INSERT INTO `municipios` VALUES (493, 13, '041', 'Mixquiahuala de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (494, 13, '042', 'Molango de Escamilla', 1, NULL);
INSERT INTO `municipios` VALUES (495, 13, '043', 'Nicolás Flores', 1, NULL);
INSERT INTO `municipios` VALUES (496, 13, '044', 'Nopala de Villagrán', 1, NULL);
INSERT INTO `municipios` VALUES (497, 13, '045', 'Omitlán de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (498, 13, '046', 'San Felipe Orizatlán', 1, NULL);
INSERT INTO `municipios` VALUES (499, 13, '047', 'Pacula', 1, NULL);
INSERT INTO `municipios` VALUES (500, 13, '048', 'Pachuca de Soto', 1, 1);
INSERT INTO `municipios` VALUES (501, 13, '049', 'Pisaflores', 1, NULL);
INSERT INTO `municipios` VALUES (502, 13, '050', 'Progreso de Obregón', 1, NULL);
INSERT INTO `municipios` VALUES (503, 13, '051', 'Mineral de la Reforma', 1, NULL);
INSERT INTO `municipios` VALUES (504, 13, '052', 'San Agustín Tlaxiaca', 1, NULL);
INSERT INTO `municipios` VALUES (505, 13, '053', 'San Bartolo Tutotepec', 1, NULL);
INSERT INTO `municipios` VALUES (506, 13, '054', 'San Salvador', 1, NULL);
INSERT INTO `municipios` VALUES (507, 13, '055', 'Santiago de Anaya', 1, NULL);
INSERT INTO `municipios` VALUES (508, 13, '056', 'Santiago Tulantepec de Lugo Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (509, 13, '057', 'Singuilucan', 1, NULL);
INSERT INTO `municipios` VALUES (510, 13, '058', 'Tasquillo', 1, NULL);
INSERT INTO `municipios` VALUES (511, 13, '059', 'Tecozautla', 1, NULL);
INSERT INTO `municipios` VALUES (512, 13, '060', 'Tenango de Doria', 1, NULL);
INSERT INTO `municipios` VALUES (513, 13, '061', 'Tepeapulco', 1, NULL);
INSERT INTO `municipios` VALUES (514, 13, '062', 'Tepehuacán de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (515, 13, '063', 'Tepeji del Río de Ocampo', 1, 1);
INSERT INTO `municipios` VALUES (516, 13, '064', 'Tepetitlán', 1, NULL);
INSERT INTO `municipios` VALUES (517, 13, '065', 'Tetepango', 1, NULL);
INSERT INTO `municipios` VALUES (518, 13, '066', 'Villa de Tezontepec', 1, NULL);
INSERT INTO `municipios` VALUES (519, 13, '067', 'Tezontepec de Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (520, 13, '068', 'Tianguistengo', 1, NULL);
INSERT INTO `municipios` VALUES (521, 13, '069', 'Tizayuca', 1, NULL);
INSERT INTO `municipios` VALUES (522, 13, '070', 'Tlahuelilpan', 1, NULL);
INSERT INTO `municipios` VALUES (523, 13, '071', 'Tlahuiltepa', 1, NULL);
INSERT INTO `municipios` VALUES (524, 13, '072', 'Tlanalapa', 1, NULL);
INSERT INTO `municipios` VALUES (525, 13, '073', 'Tlanchinol', 1, NULL);
INSERT INTO `municipios` VALUES (526, 13, '074', 'Tlaxcoapan', 1, NULL);
INSERT INTO `municipios` VALUES (527, 13, '075', 'Tolcayuca', 1, NULL);
INSERT INTO `municipios` VALUES (528, 13, '076', 'Tula de Allende', 1, 1);
INSERT INTO `municipios` VALUES (529, 13, '077', 'Tulancingo de Bravo', 1, 1);
INSERT INTO `municipios` VALUES (530, 13, '078', 'Xochiatipan', 1, NULL);
INSERT INTO `municipios` VALUES (531, 13, '079', 'Xochicoatlán', 1, NULL);
INSERT INTO `municipios` VALUES (532, 13, '080', 'Yahualica', 1, NULL);
INSERT INTO `municipios` VALUES (533, 13, '081', 'Zacualtipán de Ángeles', 1, NULL);
INSERT INTO `municipios` VALUES (534, 13, '082', 'Zapotlán de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (535, 13, '083', 'Zempoala', 1, NULL);
INSERT INTO `municipios` VALUES (536, 13, '084', 'Zimapán', 1, NULL);
INSERT INTO `municipios` VALUES (537, 14, '001', 'Acatic', 1, NULL);
INSERT INTO `municipios` VALUES (538, 14, '002', 'Acatlán de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (539, 14, '003', 'Ahualulco de Mercado', 1, NULL);
INSERT INTO `municipios` VALUES (540, 14, '004', 'Amacueca', 1, NULL);
INSERT INTO `municipios` VALUES (541, 14, '005', 'Amatitán', 1, NULL);
INSERT INTO `municipios` VALUES (542, 14, '006', 'Ameca', 1, NULL);
INSERT INTO `municipios` VALUES (543, 14, '007', 'San Juanito de Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (544, 14, '008', 'Arandas', 1, NULL);
INSERT INTO `municipios` VALUES (545, 14, '009', 'El Arenal', 1, NULL);
INSERT INTO `municipios` VALUES (546, 14, '010', 'Atemajac de Brizuela', 1, NULL);
INSERT INTO `municipios` VALUES (547, 14, '011', 'Atengo', 1, NULL);
INSERT INTO `municipios` VALUES (548, 14, '012', 'Atenguillo', 1, NULL);
INSERT INTO `municipios` VALUES (549, 14, '013', 'Atotonilco el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (550, 14, '014', 'Atoyac', 1, NULL);
INSERT INTO `municipios` VALUES (551, 14, '015', 'Autlán de Navarro', 1, NULL);
INSERT INTO `municipios` VALUES (552, 14, '016', 'Ayotlán', 1, NULL);
INSERT INTO `municipios` VALUES (553, 14, '017', 'Ayutla', 1, NULL);
INSERT INTO `municipios` VALUES (554, 14, '018', 'La Barca', 1, 1);
INSERT INTO `municipios` VALUES (555, 14, '019', 'Bolaños', 1, NULL);
INSERT INTO `municipios` VALUES (556, 14, '020', 'Cabo Corrientes', 1, NULL);
INSERT INTO `municipios` VALUES (557, 14, '021', 'Casimiro Castillo', 1, NULL);
INSERT INTO `municipios` VALUES (558, 14, '022', 'Cihuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (559, 14, '023', 'Zapotlán el Grande', 1, 1);
INSERT INTO `municipios` VALUES (560, 14, '024', 'Cocula', 1, NULL);
INSERT INTO `municipios` VALUES (561, 14, '025', 'Colotlán', 1, NULL);
INSERT INTO `municipios` VALUES (562, 14, '026', 'Concepción de Buenos Aires', 1, NULL);
INSERT INTO `municipios` VALUES (563, 14, '027', 'Cuautitlán de García Barragán', 1, NULL);
INSERT INTO `municipios` VALUES (564, 14, '028', 'Cuautla', 1, NULL);
INSERT INTO `municipios` VALUES (565, 14, '029', 'Cuquío', 1, NULL);
INSERT INTO `municipios` VALUES (566, 14, '030', 'Chapala', 1, NULL);
INSERT INTO `municipios` VALUES (567, 14, '031', 'Chimaltitán', 1, NULL);
INSERT INTO `municipios` VALUES (568, 14, '032', 'Chiquilistlán', 1, NULL);
INSERT INTO `municipios` VALUES (569, 14, '033', 'Degollado', 1, NULL);
INSERT INTO `municipios` VALUES (570, 14, '034', 'Ejutla', 1, NULL);
INSERT INTO `municipios` VALUES (571, 14, '035', 'Encarnación de Díaz', 1, NULL);
INSERT INTO `municipios` VALUES (572, 14, '036', 'Etzatlán', 1, NULL);
INSERT INTO `municipios` VALUES (573, 14, '037', 'El Grullo', 1, NULL);
INSERT INTO `municipios` VALUES (574, 14, '038', 'Guachinango', 1, NULL);
INSERT INTO `municipios` VALUES (575, 14, '039', 'Guadalajara', 1, NULL);
INSERT INTO `municipios` VALUES (576, 14, '040', 'Hostotipaquillo', 1, NULL);
INSERT INTO `municipios` VALUES (577, 14, '041', 'Huejúcar', 1, NULL);
INSERT INTO `municipios` VALUES (578, 14, '042', 'Huejuquilla el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (579, 14, '043', 'La Huerta', 1, NULL);
INSERT INTO `municipios` VALUES (580, 14, '044', 'Ixtlahuacán de los Membrillos', 1, NULL);
INSERT INTO `municipios` VALUES (581, 14, '045', 'Ixtlahuacán del Río', 1, NULL);
INSERT INTO `municipios` VALUES (582, 14, '046', 'Jalostotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (583, 14, '047', 'Jamay', 1, NULL);
INSERT INTO `municipios` VALUES (584, 14, '048', 'Jesús María', 1, NULL);
INSERT INTO `municipios` VALUES (585, 14, '049', 'Jilotlán de los Dolores', 1, NULL);
INSERT INTO `municipios` VALUES (586, 14, '050', 'Jocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (587, 14, '051', 'Juanacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (588, 14, '052', 'Juchitlán', 1, NULL);
INSERT INTO `municipios` VALUES (589, 14, '053', 'Lagos de Moreno', 1, 1);
INSERT INTO `municipios` VALUES (590, 14, '054', 'El Limón', 1, NULL);
INSERT INTO `municipios` VALUES (591, 14, '055', 'Magdalena', 1, NULL);
INSERT INTO `municipios` VALUES (592, 14, '056', 'Santa María del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (593, 14, '057', 'La Manzanilla de la Paz', 1, NULL);
INSERT INTO `municipios` VALUES (594, 14, '058', 'Mascota', 1, NULL);
INSERT INTO `municipios` VALUES (595, 14, '059', 'Mazamitla', 1, NULL);
INSERT INTO `municipios` VALUES (596, 14, '060', 'Mexticacán', 1, NULL);
INSERT INTO `municipios` VALUES (597, 14, '061', 'Mezquitic', 1, NULL);
INSERT INTO `municipios` VALUES (598, 14, '062', 'Mixtlán', 1, NULL);
INSERT INTO `municipios` VALUES (599, 14, '063', 'Ocotlán', 1, 1);
INSERT INTO `municipios` VALUES (600, 14, '064', 'Ojuelos de Jalisco', 1, NULL);
INSERT INTO `municipios` VALUES (601, 14, '065', 'Pihuamo', 1, NULL);
INSERT INTO `municipios` VALUES (602, 14, '066', 'Poncitlán', 1, NULL);
INSERT INTO `municipios` VALUES (603, 14, '067', 'Puerto Vallarta', 1, 1);
INSERT INTO `municipios` VALUES (604, 14, '068', 'Villa Purificación', 1, NULL);
INSERT INTO `municipios` VALUES (605, 14, '069', 'Quitupan', 1, NULL);
INSERT INTO `municipios` VALUES (606, 14, '070', 'El Salto', 1, 1);
INSERT INTO `municipios` VALUES (607, 14, '071', 'San Cristóbal de la Barranca', 1, NULL);
INSERT INTO `municipios` VALUES (608, 14, '072', 'San Diego de Alejandría', 1, NULL);
INSERT INTO `municipios` VALUES (609, 14, '073', 'San Juan de los Lagos', 1, 1);
INSERT INTO `municipios` VALUES (610, 14, '074', 'San Julián', 1, NULL);
INSERT INTO `municipios` VALUES (611, 14, '075', 'San Marcos', 1, NULL);
INSERT INTO `municipios` VALUES (612, 14, '076', 'San Martín de Bolaños', 1, NULL);
INSERT INTO `municipios` VALUES (613, 14, '077', 'San Martín Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (614, 14, '078', 'San Miguel el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (615, 14, '079', 'Gómez Farías', 1, NULL);
INSERT INTO `municipios` VALUES (616, 14, '080', 'San Sebastián del Oeste', 1, NULL);
INSERT INTO `municipios` VALUES (617, 14, '081', 'Santa María de los Ángeles', 1, NULL);
INSERT INTO `municipios` VALUES (618, 14, '082', 'Sayula', 1, NULL);
INSERT INTO `municipios` VALUES (619, 14, '083', 'Tala', 1, NULL);
INSERT INTO `municipios` VALUES (620, 14, '084', 'Talpa de Allende', 1, NULL);
INSERT INTO `municipios` VALUES (621, 14, '085', 'Tamazula de Gordiano', 1, NULL);
INSERT INTO `municipios` VALUES (622, 14, '086', 'Tapalpa', 1, NULL);
INSERT INTO `municipios` VALUES (623, 14, '087', 'Tecalitlán', 1, NULL);
INSERT INTO `municipios` VALUES (624, 14, '088', 'Tecolotlán', 1, NULL);
INSERT INTO `municipios` VALUES (625, 14, '089', 'Techaluta de Montenegro', 1, NULL);
INSERT INTO `municipios` VALUES (626, 14, '090', 'Tenamaxtlán', 1, NULL);
INSERT INTO `municipios` VALUES (627, 14, '091', 'Teocaltiche', 1, NULL);
INSERT INTO `municipios` VALUES (628, 14, '092', 'Teocuitatlán de Corona', 1, NULL);
INSERT INTO `municipios` VALUES (629, 14, '093', 'Tepatitlán de Morelos', 1, 1);
INSERT INTO `municipios` VALUES (630, 14, '094', 'Tequila', 1, NULL);
INSERT INTO `municipios` VALUES (631, 14, '095', 'Teuchitlán', 1, NULL);
INSERT INTO `municipios` VALUES (632, 14, '096', 'Tizapán el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (633, 14, '097', 'Tlajomulco de Zúñiga', 1, 1);
INSERT INTO `municipios` VALUES (634, 14, '098', 'San Pedro Tlaquepaque', 1, 1);
INSERT INTO `municipios` VALUES (635, 14, '099', 'Tolimán', 1, NULL);
INSERT INTO `municipios` VALUES (636, 14, '100', 'Tomatlán', 1, NULL);
INSERT INTO `municipios` VALUES (637, 14, '101', 'Tonalá', 1, 1);
INSERT INTO `municipios` VALUES (638, 14, '102', 'Tonaya', 1, NULL);
INSERT INTO `municipios` VALUES (639, 14, '103', 'Tonila', 1, NULL);
INSERT INTO `municipios` VALUES (640, 14, '104', 'Totatiche', 1, NULL);
INSERT INTO `municipios` VALUES (641, 14, '105', 'Tototlán', 1, NULL);
INSERT INTO `municipios` VALUES (642, 14, '106', 'Tuxcacuesco', 1, NULL);
INSERT INTO `municipios` VALUES (643, 14, '107', 'Tuxcueca', 1, NULL);
INSERT INTO `municipios` VALUES (644, 14, '108', 'Tuxpan', 1, NULL);
INSERT INTO `municipios` VALUES (645, 14, '109', 'Unión de San Antonio', 1, NULL);
INSERT INTO `municipios` VALUES (646, 14, '110', 'Unión de Tula', 1, NULL);
INSERT INTO `municipios` VALUES (647, 14, '111', 'Valle de Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (648, 14, '112', 'Valle de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (649, 14, '113', 'San Gabriel', 1, NULL);
INSERT INTO `municipios` VALUES (650, 14, '114', 'Villa Corona', 1, NULL);
INSERT INTO `municipios` VALUES (651, 14, '115', 'Villa Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (652, 14, '116', 'Villa Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (653, 14, '117', 'Cañadas de Obregón', 1, NULL);
INSERT INTO `municipios` VALUES (654, 14, '118', 'Yahualica de González Gallo', 1, NULL);
INSERT INTO `municipios` VALUES (655, 14, '119', 'Zacoalco de Torres', 1, NULL);
INSERT INTO `municipios` VALUES (656, 14, '120', 'Zapopan', 1, 0);
INSERT INTO `municipios` VALUES (657, 14, '121', 'Zapotiltic', 1, NULL);
INSERT INTO `municipios` VALUES (658, 14, '122', 'Zapotitlán de Vadillo', 1, NULL);
INSERT INTO `municipios` VALUES (659, 14, '123', 'Zapotlán del Rey', 1, NULL);
INSERT INTO `municipios` VALUES (660, 14, '124', 'Zapotlanejo', 1, 1);
INSERT INTO `municipios` VALUES (661, 14, '125', 'San Ignacio Cerro Gordo', 1, NULL);
INSERT INTO `municipios` VALUES (662, 15, '001', 'Acambay de Ruíz Castañeda', 1, NULL);
INSERT INTO `municipios` VALUES (663, 15, '002', 'Acolman', 1, NULL);
INSERT INTO `municipios` VALUES (664, 15, '003', 'Aculco', 1, NULL);
INSERT INTO `municipios` VALUES (665, 15, '004', 'Almoloya de Alquisiras', 1, NULL);
INSERT INTO `municipios` VALUES (666, 15, '005', 'Almoloya de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (667, 15, '006', 'Almoloya del Río', 1, NULL);
INSERT INTO `municipios` VALUES (668, 15, '007', 'Amanalco', 1, NULL);
INSERT INTO `municipios` VALUES (669, 15, '008', 'Amatepec', 1, NULL);
INSERT INTO `municipios` VALUES (670, 15, '009', 'Amecameca', 1, NULL);
INSERT INTO `municipios` VALUES (671, 15, '010', 'Apaxco', 1, NULL);
INSERT INTO `municipios` VALUES (672, 15, '011', 'Atenco', 1, NULL);
INSERT INTO `municipios` VALUES (673, 15, '012', 'Atizapán', 1, 1);
INSERT INTO `municipios` VALUES (674, 15, '013', 'Atizapán de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (675, 15, '014', 'Atlacomulco', 1, 1);
INSERT INTO `municipios` VALUES (676, 15, '015', 'Atlautla', 1, NULL);
INSERT INTO `municipios` VALUES (677, 15, '016', 'Axapusco', 1, NULL);
INSERT INTO `municipios` VALUES (678, 15, '017', 'Ayapango', 1, NULL);
INSERT INTO `municipios` VALUES (679, 15, '018', 'Calimaya', 1, NULL);
INSERT INTO `municipios` VALUES (680, 15, '019', 'Capulhuac', 1, NULL);
INSERT INTO `municipios` VALUES (681, 15, '020', 'Coacalco de Berriozábal', 1, NULL);
INSERT INTO `municipios` VALUES (682, 15, '021', 'Coatepec Harinas', 1, NULL);
INSERT INTO `municipios` VALUES (683, 15, '022', 'Cocotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (684, 15, '023', 'Coyotepec', 1, NULL);
INSERT INTO `municipios` VALUES (685, 15, '024', 'Cuautitlán', 1, 1);
INSERT INTO `municipios` VALUES (686, 15, '025', 'Chalco', 1, 1);
INSERT INTO `municipios` VALUES (687, 15, '026', 'Chapa de Mota', 1, NULL);
INSERT INTO `municipios` VALUES (688, 15, '027', 'Chapultepec', 1, NULL);
INSERT INTO `municipios` VALUES (689, 15, '028', 'Chiautla', 1, NULL);
INSERT INTO `municipios` VALUES (690, 15, '029', 'Chicoloapan', 1, NULL);
INSERT INTO `municipios` VALUES (691, 15, '030', 'Chiconcuac', 1, 1);
INSERT INTO `municipios` VALUES (692, 15, '031', 'Chimalhuacán', 1, 1);
INSERT INTO `municipios` VALUES (693, 15, '032', 'Donato Guerra', 1, NULL);
INSERT INTO `municipios` VALUES (694, 15, '033', 'Ecatepec de Morelos', 1, 1);
INSERT INTO `municipios` VALUES (695, 15, '034', 'Ecatzingo', 1, NULL);
INSERT INTO `municipios` VALUES (696, 15, '035', 'Huehuetoca', 1, NULL);
INSERT INTO `municipios` VALUES (697, 15, '036', 'Hueypoxtla', 1, NULL);
INSERT INTO `municipios` VALUES (698, 15, '037', 'Huixquilucan', 1, 1);
INSERT INTO `municipios` VALUES (699, 15, '038', 'Isidro Fabela', 1, NULL);
INSERT INTO `municipios` VALUES (700, 15, '039', 'Ixtapaluca', 1, 1);
INSERT INTO `municipios` VALUES (701, 15, '040', 'Ixtapan de la Sal', 1, NULL);
INSERT INTO `municipios` VALUES (702, 15, '041', 'Ixtapan del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (703, 15, '042', 'Ixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (704, 15, '043', 'Xalatlaco', 1, NULL);
INSERT INTO `municipios` VALUES (705, 15, '044', 'Jaltenco', 1, NULL);
INSERT INTO `municipios` VALUES (706, 15, '045', 'Jilotepec', 1, 1);
INSERT INTO `municipios` VALUES (707, 15, '046', 'Jilotzingo', 1, NULL);
INSERT INTO `municipios` VALUES (708, 15, '047', 'Jiquipilco', 1, NULL);
INSERT INTO `municipios` VALUES (709, 15, '048', 'Jocotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (710, 15, '049', 'Joquicingo', 1, NULL);
INSERT INTO `municipios` VALUES (711, 15, '050', 'Juchitepec', 1, NULL);
INSERT INTO `municipios` VALUES (712, 15, '051', 'Lerma', 1, 1);
INSERT INTO `municipios` VALUES (713, 15, '052', 'Malinalco', 1, NULL);
INSERT INTO `municipios` VALUES (714, 15, '053', 'Melchor Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (715, 15, '054', 'Metepec', 1, 1);
INSERT INTO `municipios` VALUES (716, 15, '055', 'Mexicaltzingo', 1, NULL);
INSERT INTO `municipios` VALUES (717, 15, '056', 'Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (718, 15, '057', 'Naucalpan de Juárez', 1, 1);
INSERT INTO `municipios` VALUES (719, 15, '058', 'Nezahualcóyotl', 1, 1);
INSERT INTO `municipios` VALUES (720, 15, '059', 'Nextlalpan', 1, NULL);
INSERT INTO `municipios` VALUES (721, 15, '060', 'Nicolás Romero', 1, 1);
INSERT INTO `municipios` VALUES (722, 15, '061', 'Nopaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (723, 15, '062', 'Ocoyoacac', 1, 1);
INSERT INTO `municipios` VALUES (724, 15, '063', 'Ocuilan', 1, NULL);
INSERT INTO `municipios` VALUES (725, 15, '064', 'El Oro', 1, NULL);
INSERT INTO `municipios` VALUES (726, 15, '065', 'Otumba', 1, NULL);
INSERT INTO `municipios` VALUES (727, 15, '066', 'Otzoloapan', 1, NULL);
INSERT INTO `municipios` VALUES (728, 15, '067', 'Otzolotepec', 1, 1);
INSERT INTO `municipios` VALUES (729, 15, '068', 'Ozumba', 1, NULL);
INSERT INTO `municipios` VALUES (730, 15, '069', 'Papalotla', 1, NULL);
INSERT INTO `municipios` VALUES (731, 15, '070', 'La Paz', 1, NULL);
INSERT INTO `municipios` VALUES (732, 15, '071', 'Polotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (733, 15, '072', 'Rayón', 1, NULL);
INSERT INTO `municipios` VALUES (734, 15, '073', 'San Antonio la Isla', 1, NULL);
INSERT INTO `municipios` VALUES (735, 15, '074', 'San Felipe del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (736, 15, '075', 'San Martín de las Pirámides', 1, NULL);
INSERT INTO `municipios` VALUES (737, 15, '076', 'San Mateo Atenco', 1, 1);
INSERT INTO `municipios` VALUES (738, 15, '077', 'San Simón de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (739, 15, '078', 'Santo Tomás', 1, NULL);
INSERT INTO `municipios` VALUES (740, 15, '079', 'Soyaniquilpan de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (741, 15, '080', 'Sultepec', 1, NULL);
INSERT INTO `municipios` VALUES (742, 15, '081', 'Tecámac', 1, NULL);
INSERT INTO `municipios` VALUES (743, 15, '082', 'Tejupilco', 1, NULL);
INSERT INTO `municipios` VALUES (744, 15, '083', 'Temamatla', 1, NULL);
INSERT INTO `municipios` VALUES (745, 15, '084', 'Temascalapa', 1, NULL);
INSERT INTO `municipios` VALUES (746, 15, '085', 'Temascalcingo', 1, NULL);
INSERT INTO `municipios` VALUES (747, 15, '086', 'Temascaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (748, 15, '087', 'Temoaya', 1, NULL);
INSERT INTO `municipios` VALUES (749, 15, '088', 'Tenancingo', 1, 1);
INSERT INTO `municipios` VALUES (750, 15, '089', 'Tenango del Aire', 1, NULL);
INSERT INTO `municipios` VALUES (751, 15, '090', 'Tenango del Valle', 1, 1);
INSERT INTO `municipios` VALUES (752, 15, '091', 'Teoloyucan', 1, NULL);
INSERT INTO `municipios` VALUES (753, 15, '092', 'Teotihuacán', 1, NULL);
INSERT INTO `municipios` VALUES (754, 15, '093', 'Tepetlaoxtoc', 1, NULL);
INSERT INTO `municipios` VALUES (755, 15, '094', 'Tepetlixpa', 1, NULL);
INSERT INTO `municipios` VALUES (756, 15, '095', 'Tepotzotlán', 1, NULL);
INSERT INTO `municipios` VALUES (757, 15, '096', 'Tequixquiac', 1, NULL);
INSERT INTO `municipios` VALUES (758, 15, '097', 'Texcaltitlán', 1, NULL);
INSERT INTO `municipios` VALUES (759, 15, '098', 'Texcalyacac', 1, NULL);
INSERT INTO `municipios` VALUES (760, 15, '099', 'Texcoco', 1, 1);
INSERT INTO `municipios` VALUES (761, 15, '100', 'Tezoyuca', 1, NULL);
INSERT INTO `municipios` VALUES (762, 15, '101', 'Tianguistenco', 1, 1);
INSERT INTO `municipios` VALUES (763, 15, '102', 'Timilpan', 1, NULL);
INSERT INTO `municipios` VALUES (764, 15, '103', 'Tlalmanalco', 1, NULL);
INSERT INTO `municipios` VALUES (765, 15, '104', 'Tlalnepantla de Baz', 1, 1);
INSERT INTO `municipios` VALUES (766, 15, '105', 'Tlatlaya', 1, NULL);
INSERT INTO `municipios` VALUES (767, 15, '106', 'Toluca', 1, 1);
INSERT INTO `municipios` VALUES (768, 15, '107', 'Tonatico', 1, NULL);
INSERT INTO `municipios` VALUES (769, 15, '108', 'Tultepec', 1, NULL);
INSERT INTO `municipios` VALUES (770, 15, '109', 'Tultitlán', 1, 1);
INSERT INTO `municipios` VALUES (771, 15, '110', 'Valle de Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (772, 15, '111', 'Villa de Allende', 1, NULL);
INSERT INTO `municipios` VALUES (773, 15, '112', 'Villa del Carbón', 1, NULL);
INSERT INTO `municipios` VALUES (774, 15, '113', 'Villa Guerrero', 1, 1);
INSERT INTO `municipios` VALUES (775, 15, '114', 'Villa Victoria', 1, NULL);
INSERT INTO `municipios` VALUES (776, 15, '115', 'Xonacatlán', 1, 1);
INSERT INTO `municipios` VALUES (777, 15, '116', 'Zacazonapan', 1, NULL);
INSERT INTO `municipios` VALUES (778, 15, '117', 'Zacualpan', 1, NULL);
INSERT INTO `municipios` VALUES (779, 15, '118', 'Zinacantepec', 1, 1);
INSERT INTO `municipios` VALUES (780, 15, '119', 'Zumpahuacán', 1, NULL);
INSERT INTO `municipios` VALUES (781, 15, '120', 'Zumpango', 1, NULL);
INSERT INTO `municipios` VALUES (782, 15, '121', 'Cuautitlán Izcalli', 1, 1);
INSERT INTO `municipios` VALUES (783, 15, '122', 'Valle de Chalco Solidaridad', 1, NULL);
INSERT INTO `municipios` VALUES (784, 15, '123', 'Luvianos', 1, NULL);
INSERT INTO `municipios` VALUES (785, 15, '124', 'San José del Rincón', 1, NULL);
INSERT INTO `municipios` VALUES (786, 15, '125', 'Tonanitla', 1, NULL);
INSERT INTO `municipios` VALUES (787, 16, '001', 'Acuitzio', 1, NULL);
INSERT INTO `municipios` VALUES (788, 16, '002', 'Aguililla', 1, NULL);
INSERT INTO `municipios` VALUES (789, 16, '003', 'Álvaro Obregón', 1, NULL);
INSERT INTO `municipios` VALUES (790, 16, '004', 'Angamacutiro', 1, NULL);
INSERT INTO `municipios` VALUES (791, 16, '005', 'Angangueo', 1, NULL);
INSERT INTO `municipios` VALUES (792, 16, '006', 'Apatzingán', 1, 1);
INSERT INTO `municipios` VALUES (793, 16, '007', 'Aporo', 1, NULL);
INSERT INTO `municipios` VALUES (794, 16, '008', 'Aquila', 1, NULL);
INSERT INTO `municipios` VALUES (795, 16, '009', 'Ario', 1, NULL);
INSERT INTO `municipios` VALUES (796, 16, '010', 'Arteaga', 1, NULL);
INSERT INTO `municipios` VALUES (797, 16, '011', 'Briseñas', 1, NULL);
INSERT INTO `municipios` VALUES (798, 16, '012', 'Buenavista', 1, NULL);
INSERT INTO `municipios` VALUES (799, 16, '013', 'Carácuaro', 1, NULL);
INSERT INTO `municipios` VALUES (800, 16, '014', 'Coahuayana', 1, NULL);
INSERT INTO `municipios` VALUES (801, 16, '015', 'Coalcomán de Vázquez Pallares', 1, NULL);
INSERT INTO `municipios` VALUES (802, 16, '016', 'Coeneo', 1, NULL);
INSERT INTO `municipios` VALUES (803, 16, '017', 'Contepec', 1, NULL);
INSERT INTO `municipios` VALUES (804, 16, '018', 'Copándaro', 1, NULL);
INSERT INTO `municipios` VALUES (805, 16, '019', 'Cotija', 1, NULL);
INSERT INTO `municipios` VALUES (806, 16, '020', 'Cuitzeo', 1, NULL);
INSERT INTO `municipios` VALUES (807, 16, '021', 'Charapan', 1, NULL);
INSERT INTO `municipios` VALUES (808, 16, '022', 'Charo', 1, NULL);
INSERT INTO `municipios` VALUES (809, 16, '023', 'Chavinda', 1, NULL);
INSERT INTO `municipios` VALUES (810, 16, '024', 'Cherán', 1, NULL);
INSERT INTO `municipios` VALUES (811, 16, '025', 'Chilchota', 1, NULL);
INSERT INTO `municipios` VALUES (812, 16, '026', 'Chinicuila', 1, NULL);
INSERT INTO `municipios` VALUES (813, 16, '027', 'Chucándiro', 1, NULL);
INSERT INTO `municipios` VALUES (814, 16, '028', 'Churintzio', 1, NULL);
INSERT INTO `municipios` VALUES (815, 16, '029', 'Churumuco', 1, NULL);
INSERT INTO `municipios` VALUES (816, 16, '030', 'Ecuandureo', 1, NULL);
INSERT INTO `municipios` VALUES (817, 16, '031', 'Epitacio Huerta', 1, NULL);
INSERT INTO `municipios` VALUES (818, 16, '032', 'Erongarícuaro', 1, NULL);
INSERT INTO `municipios` VALUES (819, 16, '033', 'Gabriel Zamora', 1, NULL);
INSERT INTO `municipios` VALUES (820, 16, '034', 'Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (821, 16, '035', 'La Huacana', 1, NULL);
INSERT INTO `municipios` VALUES (822, 16, '036', 'Huandacareo', 1, NULL);
INSERT INTO `municipios` VALUES (823, 16, '037', 'Huaniqueo', 1, NULL);
INSERT INTO `municipios` VALUES (824, 16, '038', 'Huetamo', 1, NULL);
INSERT INTO `municipios` VALUES (825, 16, '039', 'Huiramba', 1, NULL);
INSERT INTO `municipios` VALUES (826, 16, '040', 'Indaparapeo', 1, NULL);
INSERT INTO `municipios` VALUES (827, 16, '041', 'Irimbo', 1, NULL);
INSERT INTO `municipios` VALUES (828, 16, '042', 'Ixtlán', 1, NULL);
INSERT INTO `municipios` VALUES (829, 16, '043', 'Jacona', 1, 1);
INSERT INTO `municipios` VALUES (830, 16, '044', 'Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (831, 16, '045', 'Jiquilpan', 1, NULL);
INSERT INTO `municipios` VALUES (832, 16, '046', 'Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (833, 16, '047', 'Jungapeo', 1, NULL);
INSERT INTO `municipios` VALUES (834, 16, '048', 'Lagunillas', 1, NULL);
INSERT INTO `municipios` VALUES (835, 16, '049', 'Madero', 1, NULL);
INSERT INTO `municipios` VALUES (836, 16, '050', 'Maravatío', 1, NULL);
INSERT INTO `municipios` VALUES (837, 16, '051', 'Marcos Castellanos', 1, NULL);
INSERT INTO `municipios` VALUES (838, 16, '052', 'Lázaro Cárdenas', 1, 1);
INSERT INTO `municipios` VALUES (839, 16, '053', 'Morelia', 1, 1);
INSERT INTO `municipios` VALUES (840, 16, '054', 'Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (841, 16, '055', 'Múgica', 1, NULL);
INSERT INTO `municipios` VALUES (842, 16, '056', 'Nahuatzen', 1, NULL);
INSERT INTO `municipios` VALUES (843, 16, '057', 'Nocupétaro', 1, NULL);
INSERT INTO `municipios` VALUES (844, 16, '058', 'Nuevo Parangaricutiro', 1, NULL);
INSERT INTO `municipios` VALUES (845, 16, '059', 'Nuevo Urecho', 1, NULL);
INSERT INTO `municipios` VALUES (846, 16, '060', 'Numarán', 1, NULL);
INSERT INTO `municipios` VALUES (847, 16, '061', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (848, 16, '062', 'Pajacuarán', 1, NULL);
INSERT INTO `municipios` VALUES (849, 16, '063', 'Panindícuaro', 1, NULL);
INSERT INTO `municipios` VALUES (850, 16, '064', 'Parácuaro', 1, NULL);
INSERT INTO `municipios` VALUES (851, 16, '065', 'Paracho', 1, NULL);
INSERT INTO `municipios` VALUES (852, 16, '066', 'Pátzcuaro', 1, 1);
INSERT INTO `municipios` VALUES (853, 16, '067', 'Penjamillo', 1, NULL);
INSERT INTO `municipios` VALUES (854, 16, '068', 'Peribán', 1, NULL);
INSERT INTO `municipios` VALUES (855, 16, '069', 'La Piedad', 1, 1);
INSERT INTO `municipios` VALUES (856, 16, '070', 'Purépero', 1, NULL);
INSERT INTO `municipios` VALUES (857, 16, '071', 'Puruándiro', 1, NULL);
INSERT INTO `municipios` VALUES (858, 16, '072', 'Queréndaro', 1, NULL);
INSERT INTO `municipios` VALUES (859, 16, '073', 'Quiroga', 1, NULL);
INSERT INTO `municipios` VALUES (860, 16, '074', 'Cojumatlán de Régules', 1, NULL);
INSERT INTO `municipios` VALUES (861, 16, '075', 'Los Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (862, 16, '076', 'Sahuayo', 1, 1);
INSERT INTO `municipios` VALUES (863, 16, '077', 'San Lucas', 1, NULL);
INSERT INTO `municipios` VALUES (864, 16, '078', 'Santa Ana Maya', 1, NULL);
INSERT INTO `municipios` VALUES (865, 16, '079', 'Salvador Escalante', 1, NULL);
INSERT INTO `municipios` VALUES (866, 16, '080', 'Senguio', 1, NULL);
INSERT INTO `municipios` VALUES (867, 16, '081', 'Susupuato', 1, NULL);
INSERT INTO `municipios` VALUES (868, 16, '082', 'Tacámbaro', 1, NULL);
INSERT INTO `municipios` VALUES (869, 16, '083', 'Tancítaro', 1, NULL);
INSERT INTO `municipios` VALUES (870, 16, '084', 'Tangamandapio', 1, NULL);
INSERT INTO `municipios` VALUES (871, 16, '085', 'Tangancícuaro', 1, NULL);
INSERT INTO `municipios` VALUES (872, 16, '086', 'Tanhuato', 1, NULL);
INSERT INTO `municipios` VALUES (873, 16, '087', 'Taretan', 1, NULL);
INSERT INTO `municipios` VALUES (874, 16, '088', 'Tarímbaro', 1, NULL);
INSERT INTO `municipios` VALUES (875, 16, '089', 'Tepalcatepec', 1, NULL);
INSERT INTO `municipios` VALUES (876, 16, '090', 'Tingambato', 1, NULL);
INSERT INTO `municipios` VALUES (877, 16, '091', 'Tingüindín', 1, NULL);
INSERT INTO `municipios` VALUES (878, 16, '092', 'Tiquicheo de Nicolás Romero', 1, NULL);
INSERT INTO `municipios` VALUES (879, 16, '093', 'Tlalpujahua', 1, NULL);
INSERT INTO `municipios` VALUES (880, 16, '094', 'Tlazazalca', 1, NULL);
INSERT INTO `municipios` VALUES (881, 16, '095', 'Tocumbo', 1, NULL);
INSERT INTO `municipios` VALUES (882, 16, '096', 'Tumbiscatío', 1, NULL);
INSERT INTO `municipios` VALUES (883, 16, '097', 'Turicato', 1, NULL);
INSERT INTO `municipios` VALUES (884, 16, '098', 'Tuxpan', 1, NULL);
INSERT INTO `municipios` VALUES (885, 16, '099', 'Tuzantla', 1, NULL);
INSERT INTO `municipios` VALUES (886, 16, '100', 'Tzintzuntzan', 1, NULL);
INSERT INTO `municipios` VALUES (887, 16, '101', 'Tzitzio', 1, NULL);
INSERT INTO `municipios` VALUES (888, 16, '102', 'Uruapan', 1, 1);
INSERT INTO `municipios` VALUES (889, 16, '103', 'Venustiano Carranza', 1, NULL);
INSERT INTO `municipios` VALUES (890, 16, '104', 'Villamar', 1, NULL);
INSERT INTO `municipios` VALUES (891, 16, '105', 'Vista Hermosa', 1, NULL);
INSERT INTO `municipios` VALUES (892, 16, '106', 'Yurécuaro', 1, NULL);
INSERT INTO `municipios` VALUES (893, 16, '107', 'Zacapu', 1, 1);
INSERT INTO `municipios` VALUES (894, 16, '108', 'Zamora', 1, 1);
INSERT INTO `municipios` VALUES (895, 16, '109', 'Zináparo', 1, NULL);
INSERT INTO `municipios` VALUES (896, 16, '110', 'Zinapécuaro', 1, NULL);
INSERT INTO `municipios` VALUES (897, 16, '111', 'Ziracuaretiro', 1, NULL);
INSERT INTO `municipios` VALUES (898, 16, '112', 'Zitácuaro', 1, 0);
INSERT INTO `municipios` VALUES (899, 16, '113', 'José Sixto Verduzco', 1, NULL);
INSERT INTO `municipios` VALUES (900, 17, '001', 'Amacuzac', 1, NULL);
INSERT INTO `municipios` VALUES (901, 17, '002', 'Atlatlahucan', 1, NULL);
INSERT INTO `municipios` VALUES (902, 17, '003', 'Axochiapan', 1, NULL);
INSERT INTO `municipios` VALUES (903, 17, '004', 'Ayala', 1, NULL);
INSERT INTO `municipios` VALUES (904, 17, '005', 'Coatlán del Río', 1, NULL);
INSERT INTO `municipios` VALUES (905, 17, '006', 'Cuautla', 1, 1);
INSERT INTO `municipios` VALUES (906, 17, '007', 'Cuernavaca', 1, 1);
INSERT INTO `municipios` VALUES (907, 17, '008', 'Emiliano Zapata', 1, 1);
INSERT INTO `municipios` VALUES (908, 17, '009', 'Huitzilac', 1, NULL);
INSERT INTO `municipios` VALUES (909, 17, '010', 'Jantetelco', 1, NULL);
INSERT INTO `municipios` VALUES (910, 17, '011', 'Jiutepec', 1, 1);
INSERT INTO `municipios` VALUES (911, 17, '012', 'Jojutla', 1, NULL);
INSERT INTO `municipios` VALUES (912, 17, '013', 'Jonacatepec de Leandro Valle', 1, NULL);
INSERT INTO `municipios` VALUES (913, 17, '014', 'Mazatepec', 1, NULL);
INSERT INTO `municipios` VALUES (914, 17, '015', 'Miacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (915, 17, '016', 'Ocuituco', 1, NULL);
INSERT INTO `municipios` VALUES (916, 17, '017', 'Puente de Ixtla', 1, NULL);
INSERT INTO `municipios` VALUES (917, 17, '018', 'Temixco', 1, 1);
INSERT INTO `municipios` VALUES (918, 17, '019', 'Tepalcingo', 1, NULL);
INSERT INTO `municipios` VALUES (919, 17, '020', 'Tepoztlán', 1, 1);
INSERT INTO `municipios` VALUES (920, 17, '021', 'Tetecala', 1, NULL);
INSERT INTO `municipios` VALUES (921, 17, '022', 'Tetela del Volcán', 1, NULL);
INSERT INTO `municipios` VALUES (922, 17, '023', 'Tlalnepantla', 1, NULL);
INSERT INTO `municipios` VALUES (923, 17, '024', 'Tlaltizapán de Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (924, 17, '025', 'Tlaquiltenango', 1, NULL);
INSERT INTO `municipios` VALUES (925, 17, '026', 'Tlayacapan', 1, NULL);
INSERT INTO `municipios` VALUES (926, 17, '027', 'Totolapan', 1, NULL);
INSERT INTO `municipios` VALUES (927, 17, '028', 'Xochitepec', 1, 1);
INSERT INTO `municipios` VALUES (928, 17, '029', 'Yautepec', 1, 1);
INSERT INTO `municipios` VALUES (929, 17, '030', 'Yecapixtla', 1, NULL);
INSERT INTO `municipios` VALUES (930, 17, '031', 'Zacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (931, 17, '032', 'Zacualpan de Amilpas', 1, NULL);
INSERT INTO `municipios` VALUES (932, 17, '033', 'Temoac', 1, NULL);
INSERT INTO `municipios` VALUES (933, 18, '001', 'Acaponeta', 1, NULL);
INSERT INTO `municipios` VALUES (934, 18, '002', 'Ahuacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (935, 18, '003', 'Amatlán de Cañas', 1, NULL);
INSERT INTO `municipios` VALUES (936, 18, '004', 'Compostela', 1, NULL);
INSERT INTO `municipios` VALUES (937, 18, '005', 'Huajicori', 1, NULL);
INSERT INTO `municipios` VALUES (938, 18, '006', 'Ixtlán del Río', 1, NULL);
INSERT INTO `municipios` VALUES (939, 18, '007', 'Jala', 1, NULL);
INSERT INTO `municipios` VALUES (940, 18, '008', 'Xalisco', 1, 1);
INSERT INTO `municipios` VALUES (941, 18, '009', 'Del Nayar', 1, NULL);
INSERT INTO `municipios` VALUES (942, 18, '010', 'Rosamorada', 1, NULL);
INSERT INTO `municipios` VALUES (943, 18, '011', 'Ruíz', 1, NULL);
INSERT INTO `municipios` VALUES (944, 18, '012', 'San Blas', 1, NULL);
INSERT INTO `municipios` VALUES (945, 18, '013', 'San Pedro Lagunillas', 1, NULL);
INSERT INTO `municipios` VALUES (946, 18, '014', 'Santa María del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (947, 18, '015', 'Santiago Ixcuintla', 1, NULL);
INSERT INTO `municipios` VALUES (948, 18, '016', 'Tecuala', 1, NULL);
INSERT INTO `municipios` VALUES (949, 18, '017', 'Tepic', 1, 1);
INSERT INTO `municipios` VALUES (950, 18, '018', 'Tuxpan', 1, NULL);
INSERT INTO `municipios` VALUES (951, 18, '019', 'La Yesca', 1, NULL);
INSERT INTO `municipios` VALUES (952, 18, '020', 'Bahía de Banderas', 1, 1);
INSERT INTO `municipios` VALUES (953, 19, '001', 'Abasolo', 1, NULL);
INSERT INTO `municipios` VALUES (954, 19, '002', 'Agualeguas', 1, NULL);
INSERT INTO `municipios` VALUES (955, 19, '003', 'Los Aldamas', 1, NULL);
INSERT INTO `municipios` VALUES (956, 19, '004', 'Allende', 1, NULL);
INSERT INTO `municipios` VALUES (957, 19, '005', 'Anáhuac', 1, NULL);
INSERT INTO `municipios` VALUES (958, 19, '006', 'Apodaca', 1, 1);
INSERT INTO `municipios` VALUES (959, 19, '007', 'Aramberri', 1, NULL);
INSERT INTO `municipios` VALUES (960, 19, '008', 'Bustamante', 1, NULL);
INSERT INTO `municipios` VALUES (961, 19, '009', 'Cadereyta Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (962, 19, '010', 'El Carmen', 1, NULL);
INSERT INTO `municipios` VALUES (963, 19, '011', 'Cerralvo', 1, NULL);
INSERT INTO `municipios` VALUES (964, 19, '012', 'Ciénega de Flores', 1, NULL);
INSERT INTO `municipios` VALUES (965, 19, '013', 'China', 1, NULL);
INSERT INTO `municipios` VALUES (966, 19, '014', 'Doctor Arroyo', 1, NULL);
INSERT INTO `municipios` VALUES (967, 19, '015', 'Doctor Coss', 1, NULL);
INSERT INTO `municipios` VALUES (968, 19, '016', 'Doctor González', 1, NULL);
INSERT INTO `municipios` VALUES (969, 19, '017', 'Galeana', 1, NULL);
INSERT INTO `municipios` VALUES (970, 19, '018', 'García', 1, NULL);
INSERT INTO `municipios` VALUES (971, 19, '019', 'San Pedro Garza García', 1, 1);
INSERT INTO `municipios` VALUES (972, 19, '020', 'General Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (973, 19, '021', 'General Escobedo', 1, 1);
INSERT INTO `municipios` VALUES (974, 19, '022', 'General Terán', 1, NULL);
INSERT INTO `municipios` VALUES (975, 19, '023', 'General Treviño', 1, NULL);
INSERT INTO `municipios` VALUES (976, 19, '024', 'General Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (977, 19, '025', 'General Zuazua', 1, NULL);
INSERT INTO `municipios` VALUES (978, 19, '026', 'Guadalupe', 1, 1);
INSERT INTO `municipios` VALUES (979, 19, '027', 'Los Herreras', 1, NULL);
INSERT INTO `municipios` VALUES (980, 19, '028', 'Higueras', 1, NULL);
INSERT INTO `municipios` VALUES (981, 19, '029', 'Hualahuises', 1, NULL);
INSERT INTO `municipios` VALUES (982, 19, '030', 'Iturbide', 1, NULL);
INSERT INTO `municipios` VALUES (983, 19, '031', 'Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (984, 19, '032', 'Lampazos de Naranjo', 1, NULL);
INSERT INTO `municipios` VALUES (985, 19, '033', 'Linares', 1, NULL);
INSERT INTO `municipios` VALUES (986, 19, '034', 'Marín', 1, NULL);
INSERT INTO `municipios` VALUES (987, 19, '035', 'Melchor Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (988, 19, '036', 'Mier y Noriega', 1, NULL);
INSERT INTO `municipios` VALUES (989, 19, '037', 'Mina', 1, NULL);
INSERT INTO `municipios` VALUES (990, 19, '038', 'Montemorelos', 1, NULL);
INSERT INTO `municipios` VALUES (991, 19, '039', 'Monterrey', 1, 1);
INSERT INTO `municipios` VALUES (992, 19, '040', 'Parás', 1, NULL);
INSERT INTO `municipios` VALUES (993, 19, '041', 'Pesquería', 1, NULL);
INSERT INTO `municipios` VALUES (994, 19, '042', 'Los Ramones', 1, NULL);
INSERT INTO `municipios` VALUES (995, 19, '043', 'Rayones', 1, NULL);
INSERT INTO `municipios` VALUES (996, 19, '044', 'Sabinas Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (997, 19, '045', 'Salinas Victoria', 1, NULL);
INSERT INTO `municipios` VALUES (998, 19, '046', 'San Nicolás de los Garza', 1, 1);
INSERT INTO `municipios` VALUES (999, 19, '047', 'Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1000, 19, '048', 'Santa Catarina', 1, 1);
INSERT INTO `municipios` VALUES (1001, 19, '049', 'Santiago', 1, NULL);
INSERT INTO `municipios` VALUES (1002, 19, '050', 'Vallecillo', 1, NULL);
INSERT INTO `municipios` VALUES (1003, 19, '051', 'Villaldama', 1, NULL);
INSERT INTO `municipios` VALUES (1004, 20, '001', 'Abejones', 1, NULL);
INSERT INTO `municipios` VALUES (1005, 20, '002', 'Acatlán de Pérez Figueroa', 1, NULL);
INSERT INTO `municipios` VALUES (1006, 20, '003', 'Asunción Cacalotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1007, 20, '004', 'Asunción Cuyotepeji', 1, NULL);
INSERT INTO `municipios` VALUES (1008, 20, '005', 'Asunción Ixtaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1009, 20, '006', 'Asunción Nochixtlán', 1, NULL);
INSERT INTO `municipios` VALUES (1010, 20, '007', 'Asunción Ocotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1011, 20, '008', 'Asunción Tlacolulita', 1, NULL);
INSERT INTO `municipios` VALUES (1012, 20, '009', 'Ayotzintepec', 1, NULL);
INSERT INTO `municipios` VALUES (1013, 20, '010', 'El Barrio de la Soledad', 1, NULL);
INSERT INTO `municipios` VALUES (1014, 20, '011', 'Calihualá', 1, NULL);
INSERT INTO `municipios` VALUES (1015, 20, '012', 'Candelaria Loxicha', 1, NULL);
INSERT INTO `municipios` VALUES (1016, 20, '013', 'Ciénega de Zimatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1017, 20, '014', 'Ciudad Ixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1018, 20, '015', 'Coatecas Altas', 1, NULL);
INSERT INTO `municipios` VALUES (1019, 20, '016', 'Coicoyán de las Flores', 1, NULL);
INSERT INTO `municipios` VALUES (1020, 20, '017', 'La Compañía', 1, NULL);
INSERT INTO `municipios` VALUES (1021, 20, '018', 'Concepción Buenavista', 1, NULL);
INSERT INTO `municipios` VALUES (1022, 20, '019', 'Concepción Pápalo', 1, NULL);
INSERT INTO `municipios` VALUES (1023, 20, '020', 'Constancia del Rosario', 1, NULL);
INSERT INTO `municipios` VALUES (1024, 20, '021', 'Cosolapa', 1, NULL);
INSERT INTO `municipios` VALUES (1025, 20, '022', 'Cosoltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1026, 20, '023', 'Cuilápam de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1027, 20, '024', 'Cuyamecalco Villa de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1028, 20, '025', 'Chahuites', 1, NULL);
INSERT INTO `municipios` VALUES (1029, 20, '026', 'Chalcatongo de Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1030, 20, '027', 'Chiquihuitlán de Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1031, 20, '028', 'Heroica Ciudad de Ejutla de Crespo', 1, NULL);
INSERT INTO `municipios` VALUES (1032, 20, '029', 'Eloxochitlán de Flores Magón', 1, NULL);
INSERT INTO `municipios` VALUES (1033, 20, '030', 'El Espinal', 1, NULL);
INSERT INTO `municipios` VALUES (1034, 20, '031', 'Tamazulápam del Espíritu Santo', 1, NULL);
INSERT INTO `municipios` VALUES (1035, 20, '032', 'Fresnillo de Trujano', 1, NULL);
INSERT INTO `municipios` VALUES (1036, 20, '033', 'Guadalupe Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1037, 20, '034', 'Guadalupe de Ramírez', 1, NULL);
INSERT INTO `municipios` VALUES (1038, 20, '035', 'Guelatao de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1039, 20, '036', 'Guevea de Humboldt', 1, NULL);
INSERT INTO `municipios` VALUES (1040, 20, '037', 'Mesones Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1041, 20, '038', 'Villa Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1042, 20, '039', 'Heroica Ciudad de Huajuapan de León', 1, NULL);
INSERT INTO `municipios` VALUES (1043, 20, '040', 'Huautepec', 1, NULL);
INSERT INTO `municipios` VALUES (1044, 20, '041', 'Huautla de Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (1045, 20, '042', 'Ixtlán de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1046, 20, '043', 'Heroica Ciudad de Juchitán de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1047, 20, '044', 'Loma Bonita', 1, 1);
INSERT INTO `municipios` VALUES (1048, 20, '045', 'Magdalena Apasco', 1, NULL);
INSERT INTO `municipios` VALUES (1049, 20, '046', 'Magdalena Jaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1050, 20, '047', 'Santa Magdalena Jicotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1051, 20, '048', 'Magdalena Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1052, 20, '049', 'Magdalena Ocotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1053, 20, '050', 'Magdalena Peñasco', 1, NULL);
INSERT INTO `municipios` VALUES (1054, 20, '051', 'Magdalena Teitipac', 1, NULL);
INSERT INTO `municipios` VALUES (1055, 20, '052', 'Magdalena Tequisistlán', 1, NULL);
INSERT INTO `municipios` VALUES (1056, 20, '053', 'Magdalena Tlacotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1057, 20, '054', 'Magdalena Zahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1058, 20, '055', 'Mariscala de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1059, 20, '056', 'Mártires de Tacubaya', 1, NULL);
INSERT INTO `municipios` VALUES (1060, 20, '057', 'Matías Romero Avendaño', 1, NULL);
INSERT INTO `municipios` VALUES (1061, 20, '058', 'Mazatlán Villa de Flores', 1, NULL);
INSERT INTO `municipios` VALUES (1062, 20, '059', 'Miahuatlán de Porfirio Díaz', 1, NULL);
INSERT INTO `municipios` VALUES (1063, 20, '060', 'Mixistlán de la Reforma', 1, NULL);
INSERT INTO `municipios` VALUES (1064, 20, '061', 'Monjas', 1, NULL);
INSERT INTO `municipios` VALUES (1065, 20, '062', 'Natividad', 1, NULL);
INSERT INTO `municipios` VALUES (1066, 20, '063', 'Nazareno Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1067, 20, '064', 'Nejapa de Madero', 1, NULL);
INSERT INTO `municipios` VALUES (1068, 20, '065', 'Ixpantepec Nieves', 1, NULL);
INSERT INTO `municipios` VALUES (1069, 20, '066', 'Santiago Niltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1070, 20, '067', 'Oaxaca de Juárez', 1, 1);
INSERT INTO `municipios` VALUES (1071, 20, '068', 'Ocotlán de Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1072, 20, '069', 'La Pe', 1, NULL);
INSERT INTO `municipios` VALUES (1073, 20, '070', 'Pinotepa de Don Luis', 1, NULL);
INSERT INTO `municipios` VALUES (1074, 20, '071', 'Pluma Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1075, 20, '072', 'San José del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (1076, 20, '073', 'Putla Villa de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1077, 20, '074', 'Santa Catarina Quioquitani', 1, NULL);
INSERT INTO `municipios` VALUES (1078, 20, '075', 'Reforma de Pineda', 1, NULL);
INSERT INTO `municipios` VALUES (1079, 20, '076', 'La Reforma', 1, NULL);
INSERT INTO `municipios` VALUES (1080, 20, '077', 'Reyes Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1081, 20, '078', 'Rojas de Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (1082, 20, '079', 'Salina Cruz', 1, NULL);
INSERT INTO `municipios` VALUES (1083, 20, '080', 'San Agustín Amatengo', 1, NULL);
INSERT INTO `municipios` VALUES (1084, 20, '081', 'San Agustín Atenango', 1, NULL);
INSERT INTO `municipios` VALUES (1085, 20, '082', 'San Agustín Chayuco', 1, NULL);
INSERT INTO `municipios` VALUES (1086, 20, '083', 'San Agustín de las Juntas', 1, NULL);
INSERT INTO `municipios` VALUES (1087, 20, '084', 'San Agustín Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1088, 20, '085', 'San Agustín Loxicha', 1, NULL);
INSERT INTO `municipios` VALUES (1089, 20, '086', 'San Agustín Tlacotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1090, 20, '087', 'San Agustín Yatareni', 1, NULL);
INSERT INTO `municipios` VALUES (1091, 20, '088', 'San Andrés Cabecera Nueva', 1, NULL);
INSERT INTO `municipios` VALUES (1092, 20, '089', 'San Andrés Dinicuiti', 1, NULL);
INSERT INTO `municipios` VALUES (1093, 20, '090', 'San Andrés Huaxpaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1094, 20, '091', 'San Andrés Huayápam', 1, NULL);
INSERT INTO `municipios` VALUES (1095, 20, '092', 'San Andrés Ixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1096, 20, '093', 'San Andrés Lagunas', 1, NULL);
INSERT INTO `municipios` VALUES (1097, 20, '094', 'San Andrés Nuxiño', 1, NULL);
INSERT INTO `municipios` VALUES (1098, 20, '095', 'San Andrés Paxtlán', 1, NULL);
INSERT INTO `municipios` VALUES (1099, 20, '096', 'San Andrés Sinaxtla', 1, NULL);
INSERT INTO `municipios` VALUES (1100, 20, '097', 'San Andrés Solaga', 1, NULL);
INSERT INTO `municipios` VALUES (1101, 20, '098', 'San Andrés Teotilálpam', 1, NULL);
INSERT INTO `municipios` VALUES (1102, 20, '099', 'San Andrés Tepetlapa', 1, NULL);
INSERT INTO `municipios` VALUES (1103, 20, '100', 'San Andrés Yaá', 1, NULL);
INSERT INTO `municipios` VALUES (1104, 20, '101', 'San Andrés Zabache', 1, NULL);
INSERT INTO `municipios` VALUES (1105, 20, '102', 'San Andrés Zautla', 1, NULL);
INSERT INTO `municipios` VALUES (1106, 20, '103', 'San Antonino Castillo Velasco', 1, NULL);
INSERT INTO `municipios` VALUES (1107, 20, '104', 'San Antonino el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (1108, 20, '105', 'San Antonino Monte Verde', 1, NULL);
INSERT INTO `municipios` VALUES (1109, 20, '106', 'San Antonio Acutla', 1, NULL);
INSERT INTO `municipios` VALUES (1110, 20, '107', 'San Antonio de la Cal', 1, NULL);
INSERT INTO `municipios` VALUES (1111, 20, '108', 'San Antonio Huitepec', 1, NULL);
INSERT INTO `municipios` VALUES (1112, 20, '109', 'San Antonio Nanahuatípam', 1, NULL);
INSERT INTO `municipios` VALUES (1113, 20, '110', 'San Antonio Sinicahua', 1, NULL);
INSERT INTO `municipios` VALUES (1114, 20, '111', 'San Antonio Tepetlapa', 1, NULL);
INSERT INTO `municipios` VALUES (1115, 20, '112', 'San Baltazar Chichicápam', 1, NULL);
INSERT INTO `municipios` VALUES (1116, 20, '113', 'San Baltazar Loxicha', 1, NULL);
INSERT INTO `municipios` VALUES (1117, 20, '114', 'San Baltazar Yatzachi el Bajo', 1, NULL);
INSERT INTO `municipios` VALUES (1118, 20, '115', 'San Bartolo Coyotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1119, 20, '116', 'San Bartolomé Ayautla', 1, NULL);
INSERT INTO `municipios` VALUES (1120, 20, '117', 'San Bartolomé Loxicha', 1, NULL);
INSERT INTO `municipios` VALUES (1121, 20, '118', 'San Bartolomé Quialana', 1, NULL);
INSERT INTO `municipios` VALUES (1122, 20, '119', 'San Bartolomé Yucuañe', 1, NULL);
INSERT INTO `municipios` VALUES (1123, 20, '120', 'San Bartolomé Zoogocho', 1, NULL);
INSERT INTO `municipios` VALUES (1124, 20, '121', 'San Bartolo Soyaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1125, 20, '122', 'San Bartolo Yautepec', 1, NULL);
INSERT INTO `municipios` VALUES (1126, 20, '123', 'San Bernardo Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1127, 20, '124', 'San Blas Atempa', 1, NULL);
INSERT INTO `municipios` VALUES (1128, 20, '125', 'San Carlos Yautepec', 1, NULL);
INSERT INTO `municipios` VALUES (1129, 20, '126', 'San Cristóbal Amatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1130, 20, '127', 'San Cristóbal Amoltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1131, 20, '128', 'San Cristóbal Lachirioag', 1, NULL);
INSERT INTO `municipios` VALUES (1132, 20, '129', 'San Cristóbal Suchixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1133, 20, '130', 'San Dionisio del Mar', 1, NULL);
INSERT INTO `municipios` VALUES (1134, 20, '131', 'San Dionisio Ocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1135, 20, '132', 'San Dionisio Ocotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1136, 20, '133', 'San Esteban Atatlahuca', 1, NULL);
INSERT INTO `municipios` VALUES (1137, 20, '134', 'San Felipe Jalapa de Díaz', 1, NULL);
INSERT INTO `municipios` VALUES (1138, 20, '135', 'San Felipe Tejalápam', 1, NULL);
INSERT INTO `municipios` VALUES (1139, 20, '136', 'San Felipe Usila', 1, NULL);
INSERT INTO `municipios` VALUES (1140, 20, '137', 'San Francisco Cahuacuá', 1, NULL);
INSERT INTO `municipios` VALUES (1141, 20, '138', 'San Francisco Cajonos', 1, NULL);
INSERT INTO `municipios` VALUES (1142, 20, '139', 'San Francisco Chapulapa', 1, NULL);
INSERT INTO `municipios` VALUES (1143, 20, '140', 'San Francisco Chindúa', 1, NULL);
INSERT INTO `municipios` VALUES (1144, 20, '141', 'San Francisco del Mar', 1, NULL);
INSERT INTO `municipios` VALUES (1145, 20, '142', 'San Francisco Huehuetlán', 1, NULL);
INSERT INTO `municipios` VALUES (1146, 20, '143', 'San Francisco Ixhuatán', 1, NULL);
INSERT INTO `municipios` VALUES (1147, 20, '144', 'San Francisco Jaltepetongo', 1, NULL);
INSERT INTO `municipios` VALUES (1148, 20, '145', 'San Francisco Lachigoló', 1, NULL);
INSERT INTO `municipios` VALUES (1149, 20, '146', 'San Francisco Logueche', 1, NULL);
INSERT INTO `municipios` VALUES (1150, 20, '147', 'San Francisco Nuxaño', 1, NULL);
INSERT INTO `municipios` VALUES (1151, 20, '148', 'San Francisco Ozolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1152, 20, '149', 'San Francisco Sola', 1, NULL);
INSERT INTO `municipios` VALUES (1153, 20, '150', 'San Francisco Telixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1154, 20, '151', 'San Francisco Teopan', 1, NULL);
INSERT INTO `municipios` VALUES (1155, 20, '152', 'San Francisco Tlapancingo', 1, NULL);
INSERT INTO `municipios` VALUES (1156, 20, '153', 'San Gabriel Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1157, 20, '154', 'San Ildefonso Amatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1158, 20, '155', 'San Ildefonso Sola', 1, NULL);
INSERT INTO `municipios` VALUES (1159, 20, '156', 'San Ildefonso Villa Alta', 1, NULL);
INSERT INTO `municipios` VALUES (1160, 20, '157', 'San Jacinto Amilpas', 1, NULL);
INSERT INTO `municipios` VALUES (1161, 20, '158', 'San Jacinto Tlacotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1162, 20, '159', 'San Jerónimo Coatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1163, 20, '160', 'San Jerónimo Silacayoapilla', 1, NULL);
INSERT INTO `municipios` VALUES (1164, 20, '161', 'San Jerónimo Sosola', 1, NULL);
INSERT INTO `municipios` VALUES (1165, 20, '162', 'San Jerónimo Taviche', 1, NULL);
INSERT INTO `municipios` VALUES (1166, 20, '163', 'San Jerónimo Tecóatl', 1, NULL);
INSERT INTO `municipios` VALUES (1167, 20, '164', 'San Jorge Nuchita', 1, NULL);
INSERT INTO `municipios` VALUES (1168, 20, '165', 'San José Ayuquila', 1, NULL);
INSERT INTO `municipios` VALUES (1169, 20, '166', 'San José Chiltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1170, 20, '167', 'San José del Peñasco', 1, NULL);
INSERT INTO `municipios` VALUES (1171, 20, '168', 'San José Estancia Grande', 1, NULL);
INSERT INTO `municipios` VALUES (1172, 20, '169', 'San José Independencia', 1, NULL);
INSERT INTO `municipios` VALUES (1173, 20, '170', 'San José Lachiguiri', 1, NULL);
INSERT INTO `municipios` VALUES (1174, 20, '171', 'San José Tenango', 1, NULL);
INSERT INTO `municipios` VALUES (1175, 20, '172', 'San Juan Achiutla', 1, NULL);
INSERT INTO `municipios` VALUES (1176, 20, '173', 'San Juan Atepec', 1, NULL);
INSERT INTO `municipios` VALUES (1177, 20, '174', 'Ánimas Trujano', 1, NULL);
INSERT INTO `municipios` VALUES (1178, 20, '175', 'San Juan Bautista Atatlahuca', 1, NULL);
INSERT INTO `municipios` VALUES (1179, 20, '176', 'San Juan Bautista Coixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1180, 20, '177', 'San Juan Bautista Cuicatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1181, 20, '178', 'San Juan Bautista Guelache', 1, NULL);
INSERT INTO `municipios` VALUES (1182, 20, '179', 'San Juan Bautista Jayacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1183, 20, '180', 'San Juan Bautista Lo de Soto', 1, NULL);
INSERT INTO `municipios` VALUES (1184, 20, '181', 'San Juan Bautista Suchitepec', 1, NULL);
INSERT INTO `municipios` VALUES (1185, 20, '182', 'San Juan Bautista Tlacoatzintepec', 1, NULL);
INSERT INTO `municipios` VALUES (1186, 20, '183', 'San Juan Bautista Tlachichilco', 1, NULL);
INSERT INTO `municipios` VALUES (1187, 20, '184', 'San Juan Bautista Tuxtepec', 1, 1);
INSERT INTO `municipios` VALUES (1188, 20, '185', 'San Juan Cacahuatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1189, 20, '186', 'San Juan Cieneguilla', 1, NULL);
INSERT INTO `municipios` VALUES (1190, 20, '187', 'San Juan Coatzóspam', 1, NULL);
INSERT INTO `municipios` VALUES (1191, 20, '188', 'San Juan Colorado', 1, NULL);
INSERT INTO `municipios` VALUES (1192, 20, '189', 'San Juan Comaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1193, 20, '190', 'San Juan Cotzocón', 1, NULL);
INSERT INTO `municipios` VALUES (1194, 20, '191', 'San Juan Chicomezúchil', 1, NULL);
INSERT INTO `municipios` VALUES (1195, 20, '192', 'San Juan Chilateca', 1, NULL);
INSERT INTO `municipios` VALUES (1196, 20, '193', 'San Juan del Estado', 1, NULL);
INSERT INTO `municipios` VALUES (1197, 20, '194', 'San Juan del Río', 1, NULL);
INSERT INTO `municipios` VALUES (1198, 20, '195', 'San Juan Diuxi', 1, NULL);
INSERT INTO `municipios` VALUES (1199, 20, '196', 'San Juan Evangelista Analco', 1, NULL);
INSERT INTO `municipios` VALUES (1200, 20, '197', 'San Juan Guelavía', 1, NULL);
INSERT INTO `municipios` VALUES (1201, 20, '198', 'San Juan Guichicovi', 1, NULL);
INSERT INTO `municipios` VALUES (1202, 20, '199', 'San Juan Ihualtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1203, 20, '200', 'San Juan Juquila Mixes', 1, NULL);
INSERT INTO `municipios` VALUES (1204, 20, '201', 'San Juan Juquila Vijanos', 1, NULL);
INSERT INTO `municipios` VALUES (1205, 20, '202', 'San Juan Lachao', 1, NULL);
INSERT INTO `municipios` VALUES (1206, 20, '203', 'San Juan Lachigalla', 1, NULL);
INSERT INTO `municipios` VALUES (1207, 20, '204', 'San Juan Lajarcia', 1, NULL);
INSERT INTO `municipios` VALUES (1208, 20, '205', 'San Juan Lalana', 1, NULL);
INSERT INTO `municipios` VALUES (1209, 20, '206', 'San Juan de los Cués', 1, NULL);
INSERT INTO `municipios` VALUES (1210, 20, '207', 'San Juan Mazatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1211, 20, '208', 'San Juan Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1212, 20, '209', 'San Juan Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1213, 20, '210', 'San Juan Ñumí', 1, NULL);
INSERT INTO `municipios` VALUES (1214, 20, '211', 'San Juan Ozolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1215, 20, '212', 'San Juan Petlapa', 1, NULL);
INSERT INTO `municipios` VALUES (1216, 20, '213', 'San Juan Quiahije', 1, NULL);
INSERT INTO `municipios` VALUES (1217, 20, '214', 'San Juan Quiotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1218, 20, '215', 'San Juan Sayultepec', 1, NULL);
INSERT INTO `municipios` VALUES (1219, 20, '216', 'San Juan Tabaá', 1, NULL);
INSERT INTO `municipios` VALUES (1220, 20, '217', 'San Juan Tamazola', 1, NULL);
INSERT INTO `municipios` VALUES (1221, 20, '218', 'San Juan Teita', 1, NULL);
INSERT INTO `municipios` VALUES (1222, 20, '219', 'San Juan Teitipac', 1, NULL);
INSERT INTO `municipios` VALUES (1223, 20, '220', 'San Juan Tepeuxila', 1, NULL);
INSERT INTO `municipios` VALUES (1224, 20, '221', 'San Juan Teposcolula', 1, NULL);
INSERT INTO `municipios` VALUES (1225, 20, '222', 'San Juan Yaeé', 1, NULL);
INSERT INTO `municipios` VALUES (1226, 20, '223', 'San Juan Yatzona', 1, NULL);
INSERT INTO `municipios` VALUES (1227, 20, '224', 'San Juan Yucuita', 1, NULL);
INSERT INTO `municipios` VALUES (1228, 20, '225', 'San Lorenzo', 1, NULL);
INSERT INTO `municipios` VALUES (1229, 20, '226', 'San Lorenzo Albarradas', 1, NULL);
INSERT INTO `municipios` VALUES (1230, 20, '227', 'San Lorenzo Cacaotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1231, 20, '228', 'San Lorenzo Cuaunecuiltitla', 1, NULL);
INSERT INTO `municipios` VALUES (1232, 20, '229', 'San Lorenzo Texmelúcan', 1, NULL);
INSERT INTO `municipios` VALUES (1233, 20, '230', 'San Lorenzo Victoria', 1, NULL);
INSERT INTO `municipios` VALUES (1234, 20, '231', 'San Lucas Camotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1235, 20, '232', 'San Lucas Ojitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1236, 20, '233', 'San Lucas Quiaviní', 1, NULL);
INSERT INTO `municipios` VALUES (1237, 20, '234', 'San Lucas Zoquiápam', 1, NULL);
INSERT INTO `municipios` VALUES (1238, 20, '235', 'San Luis Amatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1239, 20, '236', 'San Marcial Ozolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1240, 20, '237', 'San Marcos Arteaga', 1, NULL);
INSERT INTO `municipios` VALUES (1241, 20, '238', 'San Martín de los Cansecos', 1, NULL);
INSERT INTO `municipios` VALUES (1242, 20, '239', 'San Martín Huamelúlpam', 1, NULL);
INSERT INTO `municipios` VALUES (1243, 20, '240', 'San Martín Itunyoso', 1, NULL);
INSERT INTO `municipios` VALUES (1244, 20, '241', 'San Martín Lachilá', 1, NULL);
INSERT INTO `municipios` VALUES (1245, 20, '242', 'San Martín Peras', 1, NULL);
INSERT INTO `municipios` VALUES (1246, 20, '243', 'San Martín Tilcajete', 1, NULL);
INSERT INTO `municipios` VALUES (1247, 20, '244', 'San Martín Toxpalan', 1, NULL);
INSERT INTO `municipios` VALUES (1248, 20, '245', 'San Martín Zacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1249, 20, '246', 'San Mateo Cajonos', 1, NULL);
INSERT INTO `municipios` VALUES (1250, 20, '247', 'Capulálpam de Méndez', 1, NULL);
INSERT INTO `municipios` VALUES (1251, 20, '248', 'San Mateo del Mar', 1, NULL);
INSERT INTO `municipios` VALUES (1252, 20, '249', 'San Mateo Yoloxochitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1253, 20, '250', 'San Mateo Etlatongo', 1, NULL);
INSERT INTO `municipios` VALUES (1254, 20, '251', 'San Mateo Nejápam', 1, NULL);
INSERT INTO `municipios` VALUES (1255, 20, '252', 'San Mateo Peñasco', 1, NULL);
INSERT INTO `municipios` VALUES (1256, 20, '253', 'San Mateo Piñas', 1, NULL);
INSERT INTO `municipios` VALUES (1257, 20, '254', 'San Mateo Río Hondo', 1, NULL);
INSERT INTO `municipios` VALUES (1258, 20, '255', 'San Mateo Sindihui', 1, NULL);
INSERT INTO `municipios` VALUES (1259, 20, '256', 'San Mateo Tlapiltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1260, 20, '257', 'San Melchor Betaza', 1, NULL);
INSERT INTO `municipios` VALUES (1261, 20, '258', 'San Miguel Achiutla', 1, NULL);
INSERT INTO `municipios` VALUES (1262, 20, '259', 'San Miguel Ahuehuetitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1263, 20, '260', 'San Miguel Aloápam', 1, NULL);
INSERT INTO `municipios` VALUES (1264, 20, '261', 'San Miguel Amatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1265, 20, '262', 'San Miguel Amatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1266, 20, '263', 'San Miguel Coatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1267, 20, '264', 'San Miguel Chicahua', 1, NULL);
INSERT INTO `municipios` VALUES (1268, 20, '265', 'San Miguel Chimalapa', 1, NULL);
INSERT INTO `municipios` VALUES (1269, 20, '266', 'San Miguel del Puerto', 1, NULL);
INSERT INTO `municipios` VALUES (1270, 20, '267', 'San Miguel del Río', 1, NULL);
INSERT INTO `municipios` VALUES (1271, 20, '268', 'San Miguel Ejutla', 1, NULL);
INSERT INTO `municipios` VALUES (1272, 20, '269', 'San Miguel el Grande', 1, NULL);
INSERT INTO `municipios` VALUES (1273, 20, '270', 'San Miguel Huautla', 1, NULL);
INSERT INTO `municipios` VALUES (1274, 20, '271', 'San Miguel Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1275, 20, '272', 'San Miguel Panixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1276, 20, '273', 'San Miguel Peras', 1, NULL);
INSERT INTO `municipios` VALUES (1277, 20, '274', 'San Miguel Piedras', 1, NULL);
INSERT INTO `municipios` VALUES (1278, 20, '275', 'San Miguel Quetzaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1279, 20, '276', 'San Miguel Santa Flor', 1, NULL);
INSERT INTO `municipios` VALUES (1280, 20, '277', 'Villa Sola de Vega', 1, NULL);
INSERT INTO `municipios` VALUES (1281, 20, '278', 'San Miguel Soyaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1282, 20, '279', 'San Miguel Suchixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1283, 20, '280', 'Villa Talea de Castro', 1, NULL);
INSERT INTO `municipios` VALUES (1284, 20, '281', 'San Miguel Tecomatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1285, 20, '282', 'San Miguel Tenango', 1, NULL);
INSERT INTO `municipios` VALUES (1286, 20, '283', 'San Miguel Tequixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1287, 20, '284', 'San Miguel Tilquiápam', 1, NULL);
INSERT INTO `municipios` VALUES (1288, 20, '285', 'San Miguel Tlacamama', 1, NULL);
INSERT INTO `municipios` VALUES (1289, 20, '286', 'San Miguel Tlacotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1290, 20, '287', 'San Miguel Tulancingo', 1, NULL);
INSERT INTO `municipios` VALUES (1291, 20, '288', 'San Miguel Yotao', 1, NULL);
INSERT INTO `municipios` VALUES (1292, 20, '289', 'San Nicolás', 1, NULL);
INSERT INTO `municipios` VALUES (1293, 20, '290', 'San Nicolás Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1294, 20, '291', 'San Pablo Coatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1295, 20, '292', 'San Pablo Cuatro Venados', 1, NULL);
INSERT INTO `municipios` VALUES (1296, 20, '293', 'San Pablo Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1297, 20, '294', 'San Pablo Huitzo', 1, NULL);
INSERT INTO `municipios` VALUES (1298, 20, '295', 'San Pablo Huixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1299, 20, '296', 'San Pablo Macuiltianguis', 1, NULL);
INSERT INTO `municipios` VALUES (1300, 20, '297', 'San Pablo Tijaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1301, 20, '298', 'San Pablo Villa de Mitla', 1, NULL);
INSERT INTO `municipios` VALUES (1302, 20, '299', 'San Pablo Yaganiza', 1, NULL);
INSERT INTO `municipios` VALUES (1303, 20, '300', 'San Pedro Amuzgos', 1, NULL);
INSERT INTO `municipios` VALUES (1304, 20, '301', 'San Pedro Apóstol', 1, NULL);
INSERT INTO `municipios` VALUES (1305, 20, '302', 'San Pedro Atoyac', 1, NULL);
INSERT INTO `municipios` VALUES (1306, 20, '303', 'San Pedro Cajonos', 1, NULL);
INSERT INTO `municipios` VALUES (1307, 20, '304', 'San Pedro Coxcaltepec Cántaros', 1, NULL);
INSERT INTO `municipios` VALUES (1308, 20, '305', 'San Pedro Comitancillo', 1, NULL);
INSERT INTO `municipios` VALUES (1309, 20, '306', 'San Pedro el Alto', 1, NULL);
INSERT INTO `municipios` VALUES (1310, 20, '307', 'San Pedro Huamelula', 1, NULL);
INSERT INTO `municipios` VALUES (1311, 20, '308', 'San Pedro Huilotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1312, 20, '309', 'San Pedro Ixcatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1313, 20, '310', 'San Pedro Ixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1314, 20, '311', 'San Pedro Jaltepetongo', 1, NULL);
INSERT INTO `municipios` VALUES (1315, 20, '312', 'San Pedro Jicayán', 1, NULL);
INSERT INTO `municipios` VALUES (1316, 20, '313', 'San Pedro Jocotipac', 1, NULL);
INSERT INTO `municipios` VALUES (1317, 20, '314', 'San Pedro Juchatengo', 1, NULL);
INSERT INTO `municipios` VALUES (1318, 20, '315', 'San Pedro Mártir', 1, NULL);
INSERT INTO `municipios` VALUES (1319, 20, '316', 'San Pedro Mártir Quiechapa', 1, NULL);
INSERT INTO `municipios` VALUES (1320, 20, '317', 'San Pedro Mártir Yucuxaco', 1, NULL);
INSERT INTO `municipios` VALUES (1321, 20, '318', 'San Pedro Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1322, 20, '319', 'San Pedro Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1323, 20, '320', 'San Pedro Molinos', 1, NULL);
INSERT INTO `municipios` VALUES (1324, 20, '321', 'San Pedro Nopala', 1, NULL);
INSERT INTO `municipios` VALUES (1325, 20, '322', 'San Pedro Ocopetatillo', 1, NULL);
INSERT INTO `municipios` VALUES (1326, 20, '323', 'San Pedro Ocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1327, 20, '324', 'San Pedro Pochutla', 1, NULL);
INSERT INTO `municipios` VALUES (1328, 20, '325', 'San Pedro Quiatoni', 1, NULL);
INSERT INTO `municipios` VALUES (1329, 20, '326', 'San Pedro Sochiápam', 1, NULL);
INSERT INTO `municipios` VALUES (1330, 20, '327', 'San Pedro Tapanatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1331, 20, '328', 'San Pedro Taviche', 1, NULL);
INSERT INTO `municipios` VALUES (1332, 20, '329', 'San Pedro Teozacoalco', 1, NULL);
INSERT INTO `municipios` VALUES (1333, 20, '330', 'San Pedro Teutila', 1, NULL);
INSERT INTO `municipios` VALUES (1334, 20, '331', 'San Pedro Tidaá', 1, NULL);
INSERT INTO `municipios` VALUES (1335, 20, '332', 'San Pedro Topiltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1336, 20, '333', 'San Pedro Totolápam', 1, NULL);
INSERT INTO `municipios` VALUES (1337, 20, '334', 'Villa de Tututepec', 1, NULL);
INSERT INTO `municipios` VALUES (1338, 20, '335', 'San Pedro Yaneri', 1, NULL);
INSERT INTO `municipios` VALUES (1339, 20, '336', 'San Pedro Yólox', 1, NULL);
INSERT INTO `municipios` VALUES (1340, 20, '337', 'San Pedro y San Pablo Ayutla', 1, NULL);
INSERT INTO `municipios` VALUES (1341, 20, '338', 'Villa de Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1342, 20, '339', 'San Pedro y San Pablo Teposcolula', 1, NULL);
INSERT INTO `municipios` VALUES (1343, 20, '340', 'San Pedro y San Pablo Tequixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1344, 20, '341', 'San Pedro Yucunama', 1, NULL);
INSERT INTO `municipios` VALUES (1345, 20, '342', 'San Raymundo Jalpan', 1, NULL);
INSERT INTO `municipios` VALUES (1346, 20, '343', 'San Sebastián Abasolo', 1, NULL);
INSERT INTO `municipios` VALUES (1347, 20, '344', 'San Sebastián Coatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1348, 20, '345', 'San Sebastián Ixcapa', 1, NULL);
INSERT INTO `municipios` VALUES (1349, 20, '346', 'San Sebastián Nicananduta', 1, NULL);
INSERT INTO `municipios` VALUES (1350, 20, '347', 'San Sebastián Río Hondo', 1, NULL);
INSERT INTO `municipios` VALUES (1351, 20, '348', 'San Sebastián Tecomaxtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1352, 20, '349', 'San Sebastián Teitipac', 1, NULL);
INSERT INTO `municipios` VALUES (1353, 20, '350', 'San Sebastián Tutla', 1, NULL);
INSERT INTO `municipios` VALUES (1354, 20, '351', 'San Simón Almolongas', 1, NULL);
INSERT INTO `municipios` VALUES (1355, 20, '352', 'San Simón Zahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1356, 20, '353', 'Santa Ana', 1, NULL);
INSERT INTO `municipios` VALUES (1357, 20, '354', 'Santa Ana Ateixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1358, 20, '355', 'Santa Ana Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (1359, 20, '356', 'Santa Ana del Valle', 1, NULL);
INSERT INTO `municipios` VALUES (1360, 20, '357', 'Santa Ana Tavela', 1, NULL);
INSERT INTO `municipios` VALUES (1361, 20, '358', 'Santa Ana Tlapacoyan', 1, NULL);
INSERT INTO `municipios` VALUES (1362, 20, '359', 'Santa Ana Yareni', 1, NULL);
INSERT INTO `municipios` VALUES (1363, 20, '360', 'Santa Ana Zegache', 1, NULL);
INSERT INTO `municipios` VALUES (1364, 20, '361', 'Santa Catalina Quierí', 1, NULL);
INSERT INTO `municipios` VALUES (1365, 20, '362', 'Santa Catarina Cuixtla', 1, NULL);
INSERT INTO `municipios` VALUES (1366, 20, '363', 'Santa Catarina Ixtepeji', 1, NULL);
INSERT INTO `municipios` VALUES (1367, 20, '364', 'Santa Catarina Juquila', 1, NULL);
INSERT INTO `municipios` VALUES (1368, 20, '365', 'Santa Catarina Lachatao', 1, NULL);
INSERT INTO `municipios` VALUES (1369, 20, '366', 'Santa Catarina Loxicha', 1, NULL);
INSERT INTO `municipios` VALUES (1370, 20, '367', 'Santa Catarina Mechoacán', 1, NULL);
INSERT INTO `municipios` VALUES (1371, 20, '368', 'Santa Catarina Minas', 1, NULL);
INSERT INTO `municipios` VALUES (1372, 20, '369', 'Santa Catarina Quiané', 1, NULL);
INSERT INTO `municipios` VALUES (1373, 20, '370', 'Santa Catarina Tayata', 1, NULL);
INSERT INTO `municipios` VALUES (1374, 20, '371', 'Santa Catarina Ticuá', 1, NULL);
INSERT INTO `municipios` VALUES (1375, 20, '372', 'Santa Catarina Yosonotú', 1, NULL);
INSERT INTO `municipios` VALUES (1376, 20, '373', 'Santa Catarina Zapoquila', 1, NULL);
INSERT INTO `municipios` VALUES (1377, 20, '374', 'Santa Cruz Acatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1378, 20, '375', 'Santa Cruz Amilpas', 1, NULL);
INSERT INTO `municipios` VALUES (1379, 20, '376', 'Santa Cruz de Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (1380, 20, '377', 'Santa Cruz Itundujia', 1, NULL);
INSERT INTO `municipios` VALUES (1381, 20, '378', 'Santa Cruz Mixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1382, 20, '379', 'Santa Cruz Nundaco', 1, NULL);
INSERT INTO `municipios` VALUES (1383, 20, '380', 'Santa Cruz Papalutla', 1, NULL);
INSERT INTO `municipios` VALUES (1384, 20, '381', 'Santa Cruz Tacache de Mina', 1, NULL);
INSERT INTO `municipios` VALUES (1385, 20, '382', 'Santa Cruz Tacahua', 1, NULL);
INSERT INTO `municipios` VALUES (1386, 20, '383', 'Santa Cruz Tayata', 1, NULL);
INSERT INTO `municipios` VALUES (1387, 20, '384', 'Santa Cruz Xitla', 1, NULL);
INSERT INTO `municipios` VALUES (1388, 20, '385', 'Santa Cruz Xoxocotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1389, 20, '386', 'Santa Cruz Zenzontepec', 1, NULL);
INSERT INTO `municipios` VALUES (1390, 20, '387', 'Santa Gertrudis', 1, NULL);
INSERT INTO `municipios` VALUES (1391, 20, '388', 'Santa Inés del Monte', 1, NULL);
INSERT INTO `municipios` VALUES (1392, 20, '389', 'Santa Inés Yatzeche', 1, NULL);
INSERT INTO `municipios` VALUES (1393, 20, '390', 'Santa Lucía del Camino', 1, NULL);
INSERT INTO `municipios` VALUES (1394, 20, '391', 'Santa Lucía Miahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1395, 20, '392', 'Santa Lucía Monteverde', 1, NULL);
INSERT INTO `municipios` VALUES (1396, 20, '393', 'Santa Lucía Ocotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1397, 20, '394', 'Santa María Alotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1398, 20, '395', 'Santa María Apazco', 1, NULL);
INSERT INTO `municipios` VALUES (1399, 20, '396', 'Santa María la Asunción', 1, NULL);
INSERT INTO `municipios` VALUES (1400, 20, '397', 'Heroica Ciudad de Tlaxiaco', 1, NULL);
INSERT INTO `municipios` VALUES (1401, 20, '398', 'Ayoquezco de Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (1402, 20, '399', 'Santa María Atzompa', 1, NULL);
INSERT INTO `municipios` VALUES (1403, 20, '400', 'Santa María Camotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1404, 20, '401', 'Santa María Colotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1405, 20, '402', 'Santa María Cortijo', 1, NULL);
INSERT INTO `municipios` VALUES (1406, 20, '403', 'Santa María Coyotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1407, 20, '404', 'Santa María Chachoápam', 1, NULL);
INSERT INTO `municipios` VALUES (1408, 20, '405', 'Villa de Chilapa de Díaz', 1, NULL);
INSERT INTO `municipios` VALUES (1409, 20, '406', 'Santa María Chilchotla', 1, NULL);
INSERT INTO `municipios` VALUES (1410, 20, '407', 'Santa María Chimalapa', 1, NULL);
INSERT INTO `municipios` VALUES (1411, 20, '408', 'Santa María del Rosario', 1, NULL);
INSERT INTO `municipios` VALUES (1412, 20, '409', 'Santa María del Tule', 1, 1);
INSERT INTO `municipios` VALUES (1413, 20, '410', 'Santa María Ecatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1414, 20, '411', 'Santa María Guelacé', 1, NULL);
INSERT INTO `municipios` VALUES (1415, 20, '412', 'Santa María Guienagati', 1, NULL);
INSERT INTO `municipios` VALUES (1416, 20, '413', 'Santa María Huatulco', 1, NULL);
INSERT INTO `municipios` VALUES (1417, 20, '414', 'Santa María Huazolotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1418, 20, '415', 'Santa María Ipalapa', 1, NULL);
INSERT INTO `municipios` VALUES (1419, 20, '416', 'Santa María Ixcatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1420, 20, '417', 'Santa María Jacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1421, 20, '418', 'Santa María Jalapa del Marqués', 1, NULL);
INSERT INTO `municipios` VALUES (1422, 20, '419', 'Santa María Jaltianguis', 1, NULL);
INSERT INTO `municipios` VALUES (1423, 20, '420', 'Santa María Lachixío', 1, NULL);
INSERT INTO `municipios` VALUES (1424, 20, '421', 'Santa María Mixtequilla', 1, NULL);
INSERT INTO `municipios` VALUES (1425, 20, '422', 'Santa María Nativitas', 1, NULL);
INSERT INTO `municipios` VALUES (1426, 20, '423', 'Santa María Nduayaco', 1, NULL);
INSERT INTO `municipios` VALUES (1427, 20, '424', 'Santa María Ozolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1428, 20, '425', 'Santa María Pápalo', 1, NULL);
INSERT INTO `municipios` VALUES (1429, 20, '426', 'Santa María Peñoles', 1, NULL);
INSERT INTO `municipios` VALUES (1430, 20, '427', 'Santa María Petapa', 1, NULL);
INSERT INTO `municipios` VALUES (1431, 20, '428', 'Santa María Quiegolani', 1, NULL);
INSERT INTO `municipios` VALUES (1432, 20, '429', 'Santa María Sola', 1, NULL);
INSERT INTO `municipios` VALUES (1433, 20, '430', 'Santa María Tataltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1434, 20, '431', 'Santa María Tecomavaca', 1, NULL);
INSERT INTO `municipios` VALUES (1435, 20, '432', 'Santa María Temaxcalapa', 1, NULL);
INSERT INTO `municipios` VALUES (1436, 20, '433', 'Santa María Temaxcaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1437, 20, '434', 'Santa María Teopoxco', 1, NULL);
INSERT INTO `municipios` VALUES (1438, 20, '435', 'Santa María Tepantlali', 1, NULL);
INSERT INTO `municipios` VALUES (1439, 20, '436', 'Santa María Texcatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1440, 20, '437', 'Santa María Tlahuitoltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1441, 20, '438', 'Santa María Tlalixtac', 1, NULL);
INSERT INTO `municipios` VALUES (1442, 20, '439', 'Santa María Tonameca', 1, NULL);
INSERT INTO `municipios` VALUES (1443, 20, '440', 'Santa María Totolapilla', 1, NULL);
INSERT INTO `municipios` VALUES (1444, 20, '441', 'Santa María Xadani', 1, NULL);
INSERT INTO `municipios` VALUES (1445, 20, '442', 'Santa María Yalina', 1, NULL);
INSERT INTO `municipios` VALUES (1446, 20, '443', 'Santa María Yavesía', 1, NULL);
INSERT INTO `municipios` VALUES (1447, 20, '444', 'Santa María Yolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1448, 20, '445', 'Santa María Yosoyúa', 1, NULL);
INSERT INTO `municipios` VALUES (1449, 20, '446', 'Santa María Yucuhiti', 1, NULL);
INSERT INTO `municipios` VALUES (1450, 20, '447', 'Santa María Zacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1451, 20, '448', 'Santa María Zaniza', 1, NULL);
INSERT INTO `municipios` VALUES (1452, 20, '449', 'Santa María Zoquitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1453, 20, '450', 'Santiago Amoltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1454, 20, '451', 'Santiago Apoala', 1, NULL);
INSERT INTO `municipios` VALUES (1455, 20, '452', 'Santiago Apóstol', 1, NULL);
INSERT INTO `municipios` VALUES (1456, 20, '453', 'Santiago Astata', 1, NULL);
INSERT INTO `municipios` VALUES (1457, 20, '454', 'Santiago Atitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1458, 20, '455', 'Santiago Ayuquililla', 1, NULL);
INSERT INTO `municipios` VALUES (1459, 20, '456', 'Santiago Cacaloxtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1460, 20, '457', 'Santiago Camotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1461, 20, '458', 'Santiago Comaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1462, 20, '459', 'Santiago Chazumba', 1, NULL);
INSERT INTO `municipios` VALUES (1463, 20, '460', 'Santiago Choápam', 1, NULL);
INSERT INTO `municipios` VALUES (1464, 20, '461', 'Santiago del Río', 1, NULL);
INSERT INTO `municipios` VALUES (1465, 20, '462', 'Santiago Huajolotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1466, 20, '463', 'Santiago Huauclilla', 1, NULL);
INSERT INTO `municipios` VALUES (1467, 20, '464', 'Santiago Ihuitlán Plumas', 1, NULL);
INSERT INTO `municipios` VALUES (1468, 20, '465', 'Santiago Ixcuintepec', 1, NULL);
INSERT INTO `municipios` VALUES (1469, 20, '466', 'Santiago Ixtayutla', 1, NULL);
INSERT INTO `municipios` VALUES (1470, 20, '467', 'Santiago Jamiltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1471, 20, '468', 'Santiago Jocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1472, 20, '469', 'Santiago Juxtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1473, 20, '470', 'Santiago Lachiguiri', 1, NULL);
INSERT INTO `municipios` VALUES (1474, 20, '471', 'Santiago Lalopa', 1, NULL);
INSERT INTO `municipios` VALUES (1475, 20, '472', 'Santiago Laollaga', 1, NULL);
INSERT INTO `municipios` VALUES (1476, 20, '473', 'Santiago Laxopa', 1, NULL);
INSERT INTO `municipios` VALUES (1477, 20, '474', 'Santiago Llano Grande', 1, NULL);
INSERT INTO `municipios` VALUES (1478, 20, '475', 'Santiago Matatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1479, 20, '476', 'Santiago Miltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1480, 20, '477', 'Santiago Minas', 1, NULL);
INSERT INTO `municipios` VALUES (1481, 20, '478', 'Santiago Nacaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1482, 20, '479', 'Santiago Nejapilla', 1, NULL);
INSERT INTO `municipios` VALUES (1483, 20, '480', 'Santiago Nundiche', 1, NULL);
INSERT INTO `municipios` VALUES (1484, 20, '481', 'Santiago Nuyoó', 1, NULL);
INSERT INTO `municipios` VALUES (1485, 20, '482', 'Santiago Pinotepa Nacional', 1, NULL);
INSERT INTO `municipios` VALUES (1486, 20, '483', 'Santiago Suchilquitongo', 1, NULL);
INSERT INTO `municipios` VALUES (1487, 20, '484', 'Santiago Tamazola', 1, NULL);
INSERT INTO `municipios` VALUES (1488, 20, '485', 'Santiago Tapextla', 1, NULL);
INSERT INTO `municipios` VALUES (1489, 20, '486', 'Villa Tejúpam de la Unión', 1, NULL);
INSERT INTO `municipios` VALUES (1490, 20, '487', 'Santiago Tenango', 1, NULL);
INSERT INTO `municipios` VALUES (1491, 20, '488', 'Santiago Tepetlapa', 1, NULL);
INSERT INTO `municipios` VALUES (1492, 20, '489', 'Santiago Tetepec', 1, NULL);
INSERT INTO `municipios` VALUES (1493, 20, '490', 'Santiago Texcalcingo', 1, NULL);
INSERT INTO `municipios` VALUES (1494, 20, '491', 'Santiago Textitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1495, 20, '492', 'Santiago Tilantongo', 1, NULL);
INSERT INTO `municipios` VALUES (1496, 20, '493', 'Santiago Tillo', 1, NULL);
INSERT INTO `municipios` VALUES (1497, 20, '494', 'Santiago Tlazoyaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1498, 20, '495', 'Santiago Xanica', 1, NULL);
INSERT INTO `municipios` VALUES (1499, 20, '496', 'Santiago Xiacuí', 1, NULL);
INSERT INTO `municipios` VALUES (1500, 20, '497', 'Santiago Yaitepec', 1, NULL);
INSERT INTO `municipios` VALUES (1501, 20, '498', 'Santiago Yaveo', 1, NULL);
INSERT INTO `municipios` VALUES (1502, 20, '499', 'Santiago Yolomécatl', 1, NULL);
INSERT INTO `municipios` VALUES (1503, 20, '500', 'Santiago Yosondúa', 1, NULL);
INSERT INTO `municipios` VALUES (1504, 20, '501', 'Santiago Yucuyachi', 1, NULL);
INSERT INTO `municipios` VALUES (1505, 20, '502', 'Santiago Zacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1506, 20, '503', 'Santiago Zoochila', 1, NULL);
INSERT INTO `municipios` VALUES (1507, 20, '504', 'Nuevo Zoquiápam', 1, NULL);
INSERT INTO `municipios` VALUES (1508, 20, '505', 'Santo Domingo Ingenio', 1, NULL);
INSERT INTO `municipios` VALUES (1509, 20, '506', 'Santo Domingo Albarradas', 1, NULL);
INSERT INTO `municipios` VALUES (1510, 20, '507', 'Santo Domingo Armenta', 1, NULL);
INSERT INTO `municipios` VALUES (1511, 20, '508', 'Santo Domingo Chihuitán', 1, NULL);
INSERT INTO `municipios` VALUES (1512, 20, '509', 'Santo Domingo de Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1513, 20, '510', 'Santo Domingo Ixcatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1514, 20, '511', 'Santo Domingo Nuxaá', 1, NULL);
INSERT INTO `municipios` VALUES (1515, 20, '512', 'Santo Domingo Ozolotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1516, 20, '513', 'Santo Domingo Petapa', 1, NULL);
INSERT INTO `municipios` VALUES (1517, 20, '514', 'Santo Domingo Roayaga', 1, NULL);
INSERT INTO `municipios` VALUES (1518, 20, '515', 'Santo Domingo Tehuantepec', 1, NULL);
INSERT INTO `municipios` VALUES (1519, 20, '516', 'Santo Domingo Teojomulco', 1, NULL);
INSERT INTO `municipios` VALUES (1520, 20, '517', 'Santo Domingo Tepuxtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1521, 20, '518', 'Santo Domingo Tlatayápam', 1, NULL);
INSERT INTO `municipios` VALUES (1522, 20, '519', 'Santo Domingo Tomaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1523, 20, '520', 'Santo Domingo Tonalá', 1, NULL);
INSERT INTO `municipios` VALUES (1524, 20, '521', 'Santo Domingo Tonaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1525, 20, '522', 'Santo Domingo Xagacía', 1, NULL);
INSERT INTO `municipios` VALUES (1526, 20, '523', 'Santo Domingo Yanhuitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1527, 20, '524', 'Santo Domingo Yodohino', 1, NULL);
INSERT INTO `municipios` VALUES (1528, 20, '525', 'Santo Domingo Zanatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1529, 20, '526', 'Santos Reyes Nopala', 1, NULL);
INSERT INTO `municipios` VALUES (1530, 20, '527', 'Santos Reyes Pápalo', 1, NULL);
INSERT INTO `municipios` VALUES (1531, 20, '528', 'Santos Reyes Tepejillo', 1, NULL);
INSERT INTO `municipios` VALUES (1532, 20, '529', 'Santos Reyes Yucuná', 1, NULL);
INSERT INTO `municipios` VALUES (1533, 20, '530', 'Santo Tomás Jalieza', 1, NULL);
INSERT INTO `municipios` VALUES (1534, 20, '531', 'Santo Tomás Mazaltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1535, 20, '532', 'Santo Tomás Ocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1536, 20, '533', 'Santo Tomás Tamazulapan', 1, NULL);
INSERT INTO `municipios` VALUES (1537, 20, '534', 'San Vicente Coatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1538, 20, '535', 'San Vicente Lachixío', 1, NULL);
INSERT INTO `municipios` VALUES (1539, 20, '536', 'San Vicente Nuñú', 1, NULL);
INSERT INTO `municipios` VALUES (1540, 20, '537', 'Silacayoápam', 1, NULL);
INSERT INTO `municipios` VALUES (1541, 20, '538', 'Sitio de Xitlapehua', 1, NULL);
INSERT INTO `municipios` VALUES (1542, 20, '539', 'Soledad Etla', 1, NULL);
INSERT INTO `municipios` VALUES (1543, 20, '540', 'Villa de Tamazulápam del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (1544, 20, '541', 'Tanetze de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1545, 20, '542', 'Taniche', 1, NULL);
INSERT INTO `municipios` VALUES (1546, 20, '543', 'Tataltepec de Valdés', 1, NULL);
INSERT INTO `municipios` VALUES (1547, 20, '544', 'Teococuilco de Marcos Pérez', 1, NULL);
INSERT INTO `municipios` VALUES (1548, 20, '545', 'Teotitlán de Flores Magón', 1, NULL);
INSERT INTO `municipios` VALUES (1549, 20, '546', 'Teotitlán del Valle', 1, NULL);
INSERT INTO `municipios` VALUES (1550, 20, '547', 'Teotongo', 1, NULL);
INSERT INTO `municipios` VALUES (1551, 20, '548', 'Tepelmeme Villa de Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1552, 20, '549', 'Heroica Villa Tezoatlán de Segura y Luna, Cuna de la Independencia de Oaxaca', 1, NULL);
INSERT INTO `municipios` VALUES (1553, 20, '550', 'San Jerónimo Tlacochahuaya', 1, NULL);
INSERT INTO `municipios` VALUES (1554, 20, '551', 'Tlacolula de Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (1555, 20, '552', 'Tlacotepec Plumas', 1, NULL);
INSERT INTO `municipios` VALUES (1556, 20, '553', 'Tlalixtac de Cabrera', 1, NULL);
INSERT INTO `municipios` VALUES (1557, 20, '554', 'Totontepec Villa de Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1558, 20, '555', 'Trinidad Zaachila', 1, NULL);
INSERT INTO `municipios` VALUES (1559, 20, '556', 'La Trinidad Vista Hermosa', 1, NULL);
INSERT INTO `municipios` VALUES (1560, 20, '557', 'Unión Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1561, 20, '558', 'Valerio Trujano', 1, NULL);
INSERT INTO `municipios` VALUES (1562, 20, '559', 'San Juan Bautista Valle Nacional', 1, NULL);
INSERT INTO `municipios` VALUES (1563, 20, '560', 'Villa Díaz Ordaz', 1, NULL);
INSERT INTO `municipios` VALUES (1564, 20, '561', 'Yaxe', 1, NULL);
INSERT INTO `municipios` VALUES (1565, 20, '562', 'Magdalena Yodocono de Porfirio Díaz', 1, NULL);
INSERT INTO `municipios` VALUES (1566, 20, '563', 'Yogana', 1, NULL);
INSERT INTO `municipios` VALUES (1567, 20, '564', 'Yutanduchi de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1568, 20, '565', 'Villa de Zaachila', 1, NULL);
INSERT INTO `municipios` VALUES (1569, 20, '566', 'San Mateo Yucutindoo', 1, NULL);
INSERT INTO `municipios` VALUES (1570, 20, '567', 'Zapotitlán Lagunas', 1, NULL);
INSERT INTO `municipios` VALUES (1571, 20, '568', 'Zapotitlán Palmas', 1, NULL);
INSERT INTO `municipios` VALUES (1572, 20, '569', 'Santa Inés de Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1573, 20, '570', 'Zimatlán de Álvarez', 1, NULL);
INSERT INTO `municipios` VALUES (1574, 21, '001', 'Acajete', 1, NULL);
INSERT INTO `municipios` VALUES (1575, 21, '002', 'Acateno', 1, NULL);
INSERT INTO `municipios` VALUES (1576, 21, '003', 'Acatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1577, 21, '004', 'Acatzingo', 1, NULL);
INSERT INTO `municipios` VALUES (1578, 21, '005', 'Acteopan', 1, NULL);
INSERT INTO `municipios` VALUES (1579, 21, '006', 'Ahuacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1580, 21, '007', 'Ahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1581, 21, '008', 'Ahuazotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1582, 21, '009', 'Ahuehuetitla', 1, NULL);
INSERT INTO `municipios` VALUES (1583, 21, '010', 'Ajalpan', 1, NULL);
INSERT INTO `municipios` VALUES (1584, 21, '011', 'Albino Zertuche', 1, NULL);
INSERT INTO `municipios` VALUES (1585, 21, '012', 'Aljojuca', 1, NULL);
INSERT INTO `municipios` VALUES (1586, 21, '013', 'Altepexi', 1, NULL);
INSERT INTO `municipios` VALUES (1587, 21, '014', 'Amixtlán', 1, NULL);
INSERT INTO `municipios` VALUES (1588, 21, '015', 'Amozoc', 1, 1);
INSERT INTO `municipios` VALUES (1589, 21, '016', 'Aquixtla', 1, NULL);
INSERT INTO `municipios` VALUES (1590, 21, '017', 'Atempan', 1, NULL);
INSERT INTO `municipios` VALUES (1591, 21, '018', 'Atexcal', 1, NULL);
INSERT INTO `municipios` VALUES (1592, 21, '019', 'Atlixco', 1, 1);
INSERT INTO `municipios` VALUES (1593, 21, '020', 'Atoyatempan', 1, NULL);
INSERT INTO `municipios` VALUES (1594, 21, '021', 'Atzala', 1, NULL);
INSERT INTO `municipios` VALUES (1595, 21, '022', 'Atzitzihuacán', 1, NULL);
INSERT INTO `municipios` VALUES (1596, 21, '023', 'Atzitzintla', 1, NULL);
INSERT INTO `municipios` VALUES (1597, 21, '024', 'Axutla', 1, NULL);
INSERT INTO `municipios` VALUES (1598, 21, '025', 'Ayotoxco de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1599, 21, '026', 'Calpan', 1, NULL);
INSERT INTO `municipios` VALUES (1600, 21, '027', 'Caltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1601, 21, '028', 'Camocuautla', 1, NULL);
INSERT INTO `municipios` VALUES (1602, 21, '029', 'Caxhuacan', 1, NULL);
INSERT INTO `municipios` VALUES (1603, 21, '030', 'Coatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1604, 21, '031', 'Coatzingo', 1, NULL);
INSERT INTO `municipios` VALUES (1605, 21, '032', 'Cohetzala', 1, NULL);
INSERT INTO `municipios` VALUES (1606, 21, '033', 'Cohuecan', 1, NULL);
INSERT INTO `municipios` VALUES (1607, 21, '034', 'Coronango', 1, NULL);
INSERT INTO `municipios` VALUES (1608, 21, '035', 'Coxcatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1609, 21, '036', 'Coyomeapan', 1, NULL);
INSERT INTO `municipios` VALUES (1610, 21, '037', 'Coyotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1611, 21, '038', 'Cuapiaxtla de Madero', 1, NULL);
INSERT INTO `municipios` VALUES (1612, 21, '039', 'Cuautempan', 1, NULL);
INSERT INTO `municipios` VALUES (1613, 21, '040', 'Cuautinchán', 1, NULL);
INSERT INTO `municipios` VALUES (1614, 21, '041', 'Cuautlancingo', 1, NULL);
INSERT INTO `municipios` VALUES (1615, 21, '042', 'Cuayuca de Andrade', 1, NULL);
INSERT INTO `municipios` VALUES (1616, 21, '043', 'Cuetzalan del Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (1617, 21, '044', 'Cuyoaco', 1, NULL);
INSERT INTO `municipios` VALUES (1618, 21, '045', 'Chalchicomula de Sesma', 1, NULL);
INSERT INTO `municipios` VALUES (1619, 21, '046', 'Chapulco', 1, NULL);
INSERT INTO `municipios` VALUES (1620, 21, '047', 'Chiautla', 1, NULL);
INSERT INTO `municipios` VALUES (1621, 21, '048', 'Chiautzingo', 1, NULL);
INSERT INTO `municipios` VALUES (1622, 21, '049', 'Chiconcuautla', 1, NULL);
INSERT INTO `municipios` VALUES (1623, 21, '050', 'Chichiquila', 1, NULL);
INSERT INTO `municipios` VALUES (1624, 21, '051', 'Chietla', 1, NULL);
INSERT INTO `municipios` VALUES (1625, 21, '052', 'Chigmecatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1626, 21, '053', 'Chignahuapan', 1, NULL);
INSERT INTO `municipios` VALUES (1627, 21, '054', 'Chignautla', 1, NULL);
INSERT INTO `municipios` VALUES (1628, 21, '055', 'Chila', 1, NULL);
INSERT INTO `municipios` VALUES (1629, 21, '056', 'Chila de la Sal', 1, NULL);
INSERT INTO `municipios` VALUES (1630, 21, '057', 'Honey', 1, NULL);
INSERT INTO `municipios` VALUES (1631, 21, '058', 'Chilchotla', 1, NULL);
INSERT INTO `municipios` VALUES (1632, 21, '059', 'Chinantla', 1, NULL);
INSERT INTO `municipios` VALUES (1633, 21, '060', 'Domingo Arenas', 1, NULL);
INSERT INTO `municipios` VALUES (1634, 21, '061', 'Eloxochitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1635, 21, '062', 'Epatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1636, 21, '063', 'Esperanza', 1, NULL);
INSERT INTO `municipios` VALUES (1637, 21, '064', 'Francisco Z. Mena', 1, NULL);
INSERT INTO `municipios` VALUES (1638, 21, '065', 'General Felipe Ángeles', 1, NULL);
INSERT INTO `municipios` VALUES (1639, 21, '066', 'Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (1640, 21, '067', 'Guadalupe Victoria', 1, NULL);
INSERT INTO `municipios` VALUES (1641, 21, '068', 'Hermenegildo Galeana', 1, NULL);
INSERT INTO `municipios` VALUES (1642, 21, '069', 'Huaquechula', 1, NULL);
INSERT INTO `municipios` VALUES (1643, 21, '070', 'Huatlatlauca', 1, NULL);
INSERT INTO `municipios` VALUES (1644, 21, '071', 'Huauchinango', 1, NULL);
INSERT INTO `municipios` VALUES (1645, 21, '072', 'Huehuetla', 1, NULL);
INSERT INTO `municipios` VALUES (1646, 21, '073', 'Huehuetlán el Chico', 1, NULL);
INSERT INTO `municipios` VALUES (1647, 21, '074', 'Huejotzingo', 1, 1);
INSERT INTO `municipios` VALUES (1648, 21, '075', 'Hueyapan', 1, NULL);
INSERT INTO `municipios` VALUES (1649, 21, '076', 'Hueytamalco', 1, NULL);
INSERT INTO `municipios` VALUES (1650, 21, '077', 'Hueytlalpan', 1, NULL);
INSERT INTO `municipios` VALUES (1651, 21, '078', 'Huitzilan de Serdán', 1, NULL);
INSERT INTO `municipios` VALUES (1652, 21, '079', 'Huitziltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1653, 21, '080', 'Atlequizayan', 1, NULL);
INSERT INTO `municipios` VALUES (1654, 21, '081', 'Ixcamilpa de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1655, 21, '082', 'Ixcaquixtla', 1, NULL);
INSERT INTO `municipios` VALUES (1656, 21, '083', 'Ixtacamaxtitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1657, 21, '084', 'Ixtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1658, 21, '085', 'Izúcar de Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (1659, 21, '086', 'Jalpan', 1, NULL);
INSERT INTO `municipios` VALUES (1660, 21, '087', 'Jolalpan', 1, NULL);
INSERT INTO `municipios` VALUES (1661, 21, '088', 'Jonotla', 1, NULL);
INSERT INTO `municipios` VALUES (1662, 21, '089', 'Jopala', 1, NULL);
INSERT INTO `municipios` VALUES (1663, 21, '090', 'Juan C. Bonilla', 1, NULL);
INSERT INTO `municipios` VALUES (1664, 21, '091', 'Juan Galindo', 1, NULL);
INSERT INTO `municipios` VALUES (1665, 21, '092', 'Juan N. Méndez', 1, NULL);
INSERT INTO `municipios` VALUES (1666, 21, '093', 'Lafragua', 1, NULL);
INSERT INTO `municipios` VALUES (1667, 21, '094', 'Libres', 1, NULL);
INSERT INTO `municipios` VALUES (1668, 21, '095', 'La Magdalena Tlatlauquitepec', 1, NULL);
INSERT INTO `municipios` VALUES (1669, 21, '096', 'Mazapiltepec de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1670, 21, '097', 'Mixtla', 1, NULL);
INSERT INTO `municipios` VALUES (1671, 21, '098', 'Molcaxac', 1, NULL);
INSERT INTO `municipios` VALUES (1672, 21, '099', 'Cañada Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1673, 21, '100', 'Naupan', 1, NULL);
INSERT INTO `municipios` VALUES (1674, 21, '101', 'Nauzontla', 1, NULL);
INSERT INTO `municipios` VALUES (1675, 21, '102', 'Nealtican', 1, NULL);
INSERT INTO `municipios` VALUES (1676, 21, '103', 'Nicolás Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (1677, 21, '104', 'Nopalucan', 1, NULL);
INSERT INTO `municipios` VALUES (1678, 21, '105', 'Ocotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1679, 21, '106', 'Ocoyucan', 1, NULL);
INSERT INTO `municipios` VALUES (1680, 21, '107', 'Olintla', 1, NULL);
INSERT INTO `municipios` VALUES (1681, 21, '108', 'Oriental', 1, NULL);
INSERT INTO `municipios` VALUES (1682, 21, '109', 'Pahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1683, 21, '110', 'Palmar de Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (1684, 21, '111', 'Pantepec', 1, NULL);
INSERT INTO `municipios` VALUES (1685, 21, '112', 'Petlalcingo', 1, NULL);
INSERT INTO `municipios` VALUES (1686, 21, '113', 'Piaxtla', 1, NULL);
INSERT INTO `municipios` VALUES (1687, 21, '114', 'Puebla', 1, 1);
INSERT INTO `municipios` VALUES (1688, 21, '115', 'Quecholac', 1, NULL);
INSERT INTO `municipios` VALUES (1689, 21, '116', 'Quimixtlán', 1, NULL);
INSERT INTO `municipios` VALUES (1690, 21, '117', 'Rafael Lara Grajales', 1, NULL);
INSERT INTO `municipios` VALUES (1691, 21, '118', 'Los Reyes de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1692, 21, '119', 'San Andrés Cholula', 1, 1);
INSERT INTO `municipios` VALUES (1693, 21, '120', 'San Antonio Cañada', 1, NULL);
INSERT INTO `municipios` VALUES (1694, 21, '121', 'San Diego la Mesa Tochimiltzingo', 1, NULL);
INSERT INTO `municipios` VALUES (1695, 21, '122', 'San Felipe Teotlalcingo', 1, NULL);
INSERT INTO `municipios` VALUES (1696, 21, '123', 'San Felipe Tepatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1697, 21, '124', 'San Gabriel Chilac', 1, NULL);
INSERT INTO `municipios` VALUES (1698, 21, '125', 'San Gregorio Atzompa', 1, NULL);
INSERT INTO `municipios` VALUES (1699, 21, '126', 'San Jerónimo Tecuanipan', 1, NULL);
INSERT INTO `municipios` VALUES (1700, 21, '127', 'San Jerónimo Xayacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1701, 21, '128', 'San José Chiapa', 1, NULL);
INSERT INTO `municipios` VALUES (1702, 21, '129', 'San José Miahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1703, 21, '130', 'San Juan Atenco', 1, NULL);
INSERT INTO `municipios` VALUES (1704, 21, '131', 'San Juan Atzompa', 1, NULL);
INSERT INTO `municipios` VALUES (1705, 21, '132', 'San Martín Texmelucan', 1, 1);
INSERT INTO `municipios` VALUES (1706, 21, '133', 'San Martín Totoltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1707, 21, '134', 'San Matías Tlalancaleca', 1, NULL);
INSERT INTO `municipios` VALUES (1708, 21, '135', 'San Miguel Ixitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1709, 21, '136', 'San Miguel Xoxtla', 1, NULL);
INSERT INTO `municipios` VALUES (1710, 21, '137', 'San Nicolás Buenos Aires', 1, NULL);
INSERT INTO `municipios` VALUES (1711, 21, '138', 'San Nicolás de los Ranchos', 1, NULL);
INSERT INTO `municipios` VALUES (1712, 21, '139', 'San Pablo Anicano', 1, NULL);
INSERT INTO `municipios` VALUES (1713, 21, '140', 'San Pedro Cholula', 1, 1);
INSERT INTO `municipios` VALUES (1714, 21, '141', 'San Pedro Yeloixtlahuaca', 1, NULL);
INSERT INTO `municipios` VALUES (1715, 21, '142', 'San Salvador el Seco', 1, NULL);
INSERT INTO `municipios` VALUES (1716, 21, '143', 'San Salvador el Verde', 1, NULL);
INSERT INTO `municipios` VALUES (1717, 21, '144', 'San Salvador Huixcolotla', 1, NULL);
INSERT INTO `municipios` VALUES (1718, 21, '145', 'San Sebastián Tlacotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1719, 21, '146', 'Santa Catarina Tlaltempan', 1, NULL);
INSERT INTO `municipios` VALUES (1720, 21, '147', 'Santa Inés Ahuatempan', 1, NULL);
INSERT INTO `municipios` VALUES (1721, 21, '148', 'Santa Isabel Cholula', 1, NULL);
INSERT INTO `municipios` VALUES (1722, 21, '149', 'Santiago Miahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1723, 21, '150', 'Huehuetlán el Grande', 1, NULL);
INSERT INTO `municipios` VALUES (1724, 21, '151', 'Santo Tomás Hueyotlipan', 1, NULL);
INSERT INTO `municipios` VALUES (1725, 21, '152', 'Soltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1726, 21, '153', 'Tecali de Herrera', 1, NULL);
INSERT INTO `municipios` VALUES (1727, 21, '154', 'Tecamachalco', 1, 1);
INSERT INTO `municipios` VALUES (1728, 21, '155', 'Tecomatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1729, 21, '156', 'Tehuacán', 1, 1);
INSERT INTO `municipios` VALUES (1730, 21, '157', 'Tehuitzingo', 1, NULL);
INSERT INTO `municipios` VALUES (1731, 21, '158', 'Tenampulco', 1, NULL);
INSERT INTO `municipios` VALUES (1732, 21, '159', 'Teopantlán', 1, NULL);
INSERT INTO `municipios` VALUES (1733, 21, '160', 'Teotlalco', 1, NULL);
INSERT INTO `municipios` VALUES (1734, 21, '161', 'Tepanco de López', 1, NULL);
INSERT INTO `municipios` VALUES (1735, 21, '162', 'Tepango de Rodríguez', 1, NULL);
INSERT INTO `municipios` VALUES (1736, 21, '163', 'Tepatlaxco de Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1737, 21, '164', 'Tepeaca', 1, NULL);
INSERT INTO `municipios` VALUES (1738, 21, '165', 'Tepemaxalco', 1, NULL);
INSERT INTO `municipios` VALUES (1739, 21, '166', 'Tepeojuma', 1, NULL);
INSERT INTO `municipios` VALUES (1740, 21, '167', 'Tepetzintla', 1, NULL);
INSERT INTO `municipios` VALUES (1741, 21, '168', 'Tepexco', 1, NULL);
INSERT INTO `municipios` VALUES (1742, 21, '169', 'Tepexi de Rodríguez', 1, NULL);
INSERT INTO `municipios` VALUES (1743, 21, '170', 'Tepeyahualco', 1, NULL);
INSERT INTO `municipios` VALUES (1744, 21, '171', 'Tepeyahualco de Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (1745, 21, '172', 'Tetela de Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (1746, 21, '173', 'Teteles de Avila Castillo', 1, NULL);
INSERT INTO `municipios` VALUES (1747, 21, '174', 'Teziutlán', 1, 1);
INSERT INTO `municipios` VALUES (1748, 21, '175', 'Tianguismanalco', 1, NULL);
INSERT INTO `municipios` VALUES (1749, 21, '176', 'Tilapa', 1, NULL);
INSERT INTO `municipios` VALUES (1750, 21, '177', 'Tlacotepec de Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1751, 21, '178', 'Tlacuilotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1752, 21, '179', 'Tlachichuca', 1, NULL);
INSERT INTO `municipios` VALUES (1753, 21, '180', 'Tlahuapan', 1, NULL);
INSERT INTO `municipios` VALUES (1754, 21, '181', 'Tlaltenango', 1, NULL);
INSERT INTO `municipios` VALUES (1755, 21, '182', 'Tlanepantla', 1, NULL);
INSERT INTO `municipios` VALUES (1756, 21, '183', 'Tlaola', 1, NULL);
INSERT INTO `municipios` VALUES (1757, 21, '184', 'Tlapacoya', 1, NULL);
INSERT INTO `municipios` VALUES (1758, 21, '185', 'Tlapanalá', 1, NULL);
INSERT INTO `municipios` VALUES (1759, 21, '186', 'Tlatlauquitepec', 1, NULL);
INSERT INTO `municipios` VALUES (1760, 21, '187', 'Tlaxco', 1, NULL);
INSERT INTO `municipios` VALUES (1761, 21, '188', 'Tochimilco', 1, NULL);
INSERT INTO `municipios` VALUES (1762, 21, '189', 'Tochtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1763, 21, '190', 'Totoltepec de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1764, 21, '191', 'Tulcingo', 1, NULL);
INSERT INTO `municipios` VALUES (1765, 21, '192', 'Tuzamapan de Galeana', 1, NULL);
INSERT INTO `municipios` VALUES (1766, 21, '193', 'Tzicatlacoyan', 1, NULL);
INSERT INTO `municipios` VALUES (1767, 21, '194', 'Venustiano Carranza', 1, NULL);
INSERT INTO `municipios` VALUES (1768, 21, '195', 'Vicente Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1769, 21, '196', 'Xayacatlán de Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (1770, 21, '197', 'Xicotepec', 1, NULL);
INSERT INTO `municipios` VALUES (1771, 21, '198', 'Xicotlán', 1, NULL);
INSERT INTO `municipios` VALUES (1772, 21, '199', 'Xiutetelco', 1, NULL);
INSERT INTO `municipios` VALUES (1773, 21, '200', 'Xochiapulco', 1, NULL);
INSERT INTO `municipios` VALUES (1774, 21, '201', 'Xochiltepec', 1, NULL);
INSERT INTO `municipios` VALUES (1775, 21, '202', 'Xochitlán de Vicente Suárez', 1, NULL);
INSERT INTO `municipios` VALUES (1776, 21, '203', 'Xochitlán Todos Santos', 1, NULL);
INSERT INTO `municipios` VALUES (1777, 21, '204', 'Yaonáhuac', 1, NULL);
INSERT INTO `municipios` VALUES (1778, 21, '205', 'Yehualtepec', 1, NULL);
INSERT INTO `municipios` VALUES (1779, 21, '206', 'Zacapala', 1, NULL);
INSERT INTO `municipios` VALUES (1780, 21, '207', 'Zacapoaxtla', 1, NULL);
INSERT INTO `municipios` VALUES (1781, 21, '208', 'Zacatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1782, 21, '209', 'Zapotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1783, 21, '210', 'Zapotitlán de Méndez', 1, NULL);
INSERT INTO `municipios` VALUES (1784, 21, '211', 'Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1785, 21, '212', 'Zautla', 1, NULL);
INSERT INTO `municipios` VALUES (1786, 21, '213', 'Zihuateutla', 1, NULL);
INSERT INTO `municipios` VALUES (1787, 21, '214', 'Zinacatepec', 1, NULL);
INSERT INTO `municipios` VALUES (1788, 21, '215', 'Zongozotla', 1, NULL);
INSERT INTO `municipios` VALUES (1789, 21, '216', 'Zoquiapan', 1, NULL);
INSERT INTO `municipios` VALUES (1790, 21, '217', 'Zoquitlán', 1, NULL);
INSERT INTO `municipios` VALUES (1791, 22, '001', 'Amealco de Bonfil', 1, NULL);
INSERT INTO `municipios` VALUES (1792, 22, '002', 'Pinal de Amoles', 1, NULL);
INSERT INTO `municipios` VALUES (1793, 22, '003', 'Arroyo Seco', 1, NULL);
INSERT INTO `municipios` VALUES (1794, 22, '004', 'Cadereyta de Montes', 1, NULL);
INSERT INTO `municipios` VALUES (1795, 22, '005', 'Colón', 1, NULL);
INSERT INTO `municipios` VALUES (1796, 22, '006', 'Corregidora', 1, 0);
INSERT INTO `municipios` VALUES (1797, 22, '007', 'Ezequiel Montes', 1, 1);
INSERT INTO `municipios` VALUES (1798, 22, '008', 'Huimilpan', 1, NULL);
INSERT INTO `municipios` VALUES (1799, 22, '009', 'Jalpan de Serra', 1, NULL);
INSERT INTO `municipios` VALUES (1800, 22, '010', 'Landa de Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (1801, 22, '011', 'El Marqués', 1, 1);
INSERT INTO `municipios` VALUES (1802, 22, '012', 'Pedro Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (1803, 22, '013', 'Peñamiller', 1, NULL);
INSERT INTO `municipios` VALUES (1804, 22, '014', 'Querétaro', 1, 1);
INSERT INTO `municipios` VALUES (1805, 22, '015', 'San Joaquín', 1, NULL);
INSERT INTO `municipios` VALUES (1806, 22, '016', 'San Juan del Río', 1, 1);
INSERT INTO `municipios` VALUES (1807, 22, '017', 'Tequisquiapan', 1, 1);
INSERT INTO `municipios` VALUES (1808, 22, '018', 'Tolimán', 1, NULL);
INSERT INTO `municipios` VALUES (1809, 23, '001', 'Cozumel', 1, NULL);
INSERT INTO `municipios` VALUES (1810, 23, '002', 'Felipe Carrillo Puerto', 1, 1);
INSERT INTO `municipios` VALUES (1811, 23, '003', 'Isla Mujeres', 1, NULL);
INSERT INTO `municipios` VALUES (1812, 23, '004', 'Othón P. Blanco', 1, 1);
INSERT INTO `municipios` VALUES (1813, 23, '005', 'Benito Juárez', 1, 1);
INSERT INTO `municipios` VALUES (1814, 23, '006', 'José María Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1815, 23, '007', 'Lázaro Cárdenas', 1, NULL);
INSERT INTO `municipios` VALUES (1816, 23, '008', 'Solidaridad', 1, 1);
INSERT INTO `municipios` VALUES (1817, 23, '009', 'Tulum', 1, NULL);
INSERT INTO `municipios` VALUES (1818, 23, '010', 'Bacalar', 1, NULL);
INSERT INTO `municipios` VALUES (1819, 23, '011', 'Puerto Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1820, 24, '001', 'Ahualulco', 1, NULL);
INSERT INTO `municipios` VALUES (1821, 24, '002', 'Alaquines', 1, NULL);
INSERT INTO `municipios` VALUES (1822, 24, '003', 'Aquismón', 1, NULL);
INSERT INTO `municipios` VALUES (1823, 24, '004', 'Armadillo de los Infante', 1, NULL);
INSERT INTO `municipios` VALUES (1824, 24, '005', 'Cárdenas', 1, NULL);
INSERT INTO `municipios` VALUES (1825, 24, '006', 'Catorce', 1, NULL);
INSERT INTO `municipios` VALUES (1826, 24, '007', 'Cedral', 1, NULL);
INSERT INTO `municipios` VALUES (1827, 24, '008', 'Cerritos', 1, NULL);
INSERT INTO `municipios` VALUES (1828, 24, '009', 'Cerro de San Pedro', 1, NULL);
INSERT INTO `municipios` VALUES (1829, 24, '010', 'Ciudad del Maíz', 1, NULL);
INSERT INTO `municipios` VALUES (1830, 24, '011', 'Ciudad Fernández', 1, NULL);
INSERT INTO `municipios` VALUES (1831, 24, '012', 'Tancanhuitz', 1, NULL);
INSERT INTO `municipios` VALUES (1832, 24, '013', 'Ciudad Valles', 1, 1);
INSERT INTO `municipios` VALUES (1833, 24, '014', 'Coxcatlán', 1, NULL);
INSERT INTO `municipios` VALUES (1834, 24, '015', 'Charcas', 1, NULL);
INSERT INTO `municipios` VALUES (1835, 24, '016', 'Ebano', 1, 1);
INSERT INTO `municipios` VALUES (1836, 24, '017', 'Guadalcázar', 1, NULL);
INSERT INTO `municipios` VALUES (1837, 24, '018', 'Huehuetlán', 1, NULL);
INSERT INTO `municipios` VALUES (1838, 24, '019', 'Lagunillas', 1, NULL);
INSERT INTO `municipios` VALUES (1839, 24, '020', 'Matehuala', 1, NULL);
INSERT INTO `municipios` VALUES (1840, 24, '021', 'Mexquitic de Carmona', 1, NULL);
INSERT INTO `municipios` VALUES (1841, 24, '022', 'Moctezuma', 1, NULL);
INSERT INTO `municipios` VALUES (1842, 24, '023', 'Rayón', 1, NULL);
INSERT INTO `municipios` VALUES (1843, 24, '024', 'Rioverde', 1, NULL);
INSERT INTO `municipios` VALUES (1844, 24, '025', 'Salinas', 1, NULL);
INSERT INTO `municipios` VALUES (1845, 24, '026', 'San Antonio', 1, NULL);
INSERT INTO `municipios` VALUES (1846, 24, '027', 'San Ciro de Acosta', 1, NULL);
INSERT INTO `municipios` VALUES (1847, 24, '028', 'San Luis Potosí', 1, 1);
INSERT INTO `municipios` VALUES (1848, 24, '029', 'San Martín Chalchicuautla', 1, NULL);
INSERT INTO `municipios` VALUES (1849, 24, '030', 'San Nicolás Tolentino', 1, NULL);
INSERT INTO `municipios` VALUES (1850, 24, '031', 'Santa Catarina', 1, NULL);
INSERT INTO `municipios` VALUES (1851, 24, '032', 'Santa María del Río', 1, NULL);
INSERT INTO `municipios` VALUES (1852, 24, '033', 'Santo Domingo', 1, NULL);
INSERT INTO `municipios` VALUES (1853, 24, '034', 'San Vicente Tancuayalab', 1, NULL);
INSERT INTO `municipios` VALUES (1854, 24, '035', 'Soledad de Graciano Sánchez', 1, 1);
INSERT INTO `municipios` VALUES (1855, 24, '036', 'Tamasopo', 1, NULL);
INSERT INTO `municipios` VALUES (1856, 24, '037', 'Tamazunchale', 1, NULL);
INSERT INTO `municipios` VALUES (1857, 24, '038', 'Tampacán', 1, NULL);
INSERT INTO `municipios` VALUES (1858, 24, '039', 'Tampamolón Corona', 1, NULL);
INSERT INTO `municipios` VALUES (1859, 24, '040', 'Tamuín', 1, 1);
INSERT INTO `municipios` VALUES (1860, 24, '041', 'Tanlajás', 1, NULL);
INSERT INTO `municipios` VALUES (1861, 24, '042', 'Tanquián de Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (1862, 24, '043', 'Tierra Nueva', 1, NULL);
INSERT INTO `municipios` VALUES (1863, 24, '044', 'Vanegas', 1, NULL);
INSERT INTO `municipios` VALUES (1864, 24, '045', 'Venado', 1, NULL);
INSERT INTO `municipios` VALUES (1865, 24, '046', 'Villa de Arriaga', 1, NULL);
INSERT INTO `municipios` VALUES (1866, 24, '047', 'Villa de Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (1867, 24, '048', 'Villa de la Paz', 1, NULL);
INSERT INTO `municipios` VALUES (1868, 24, '049', 'Villa de Ramos', 1, NULL);
INSERT INTO `municipios` VALUES (1869, 24, '050', 'Villa de Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (1870, 24, '051', 'Villa Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1871, 24, '052', 'Villa Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1872, 24, '053', 'Axtla de Terrazas', 1, NULL);
INSERT INTO `municipios` VALUES (1873, 24, '054', 'Xilitla', 1, NULL);
INSERT INTO `municipios` VALUES (1874, 24, '055', 'Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (1875, 24, '056', 'Villa de Arista', 1, NULL);
INSERT INTO `municipios` VALUES (1876, 24, '057', 'Matlapa', 1, NULL);
INSERT INTO `municipios` VALUES (1877, 24, '058', 'El Naranjo', 1, NULL);
INSERT INTO `municipios` VALUES (1878, 25, '001', 'Ahome', 1, 1);
INSERT INTO `municipios` VALUES (1879, 25, '002', 'Angostura', 1, NULL);
INSERT INTO `municipios` VALUES (1880, 25, '003', 'Badiraguato', 1, NULL);
INSERT INTO `municipios` VALUES (1881, 25, '004', 'Concordia', 1, NULL);
INSERT INTO `municipios` VALUES (1882, 25, '005', 'Cosalá', 1, NULL);
INSERT INTO `municipios` VALUES (1883, 25, '006', 'Culiacán', 1, 1);
INSERT INTO `municipios` VALUES (1884, 25, '007', 'Choix', 1, NULL);
INSERT INTO `municipios` VALUES (1885, 25, '008', 'Elota', 1, NULL);
INSERT INTO `municipios` VALUES (1886, 25, '009', 'Escuinapa', 1, NULL);
INSERT INTO `municipios` VALUES (1887, 25, '010', 'El Fuerte', 1, NULL);
INSERT INTO `municipios` VALUES (1888, 25, '011', 'Guasave', 1, 1);
INSERT INTO `municipios` VALUES (1889, 25, '012', 'Mazatlán', 1, 1);
INSERT INTO `municipios` VALUES (1890, 25, '013', 'Mocorito', 1, NULL);
INSERT INTO `municipios` VALUES (1891, 25, '014', 'Rosario', 1, NULL);
INSERT INTO `municipios` VALUES (1892, 25, '015', 'Salvador Alvarado', 1, 1);
INSERT INTO `municipios` VALUES (1893, 25, '016', 'San Ignacio', 1, NULL);
INSERT INTO `municipios` VALUES (1894, 25, '017', 'Sinaloa', 1, NULL);
INSERT INTO `municipios` VALUES (1895, 25, '018', 'Navolato', 1, NULL);
INSERT INTO `municipios` VALUES (1896, 26, '001', 'Aconchi', 1, 0);
INSERT INTO `municipios` VALUES (1897, 26, '002', 'Agua Prieta', 1, NULL);
INSERT INTO `municipios` VALUES (1898, 26, '003', 'Alamos', 1, NULL);
INSERT INTO `municipios` VALUES (1899, 26, '004', 'Altar', 1, NULL);
INSERT INTO `municipios` VALUES (1900, 26, '005', 'Arivechi', 1, NULL);
INSERT INTO `municipios` VALUES (1901, 26, '006', 'Arizpe', 1, NULL);
INSERT INTO `municipios` VALUES (1902, 26, '007', 'Atil', 1, NULL);
INSERT INTO `municipios` VALUES (1903, 26, '008', 'Bacadéhuachi', 1, NULL);
INSERT INTO `municipios` VALUES (1904, 26, '009', 'Bacanora', 1, NULL);
INSERT INTO `municipios` VALUES (1905, 26, '010', 'Bacerac', 1, NULL);
INSERT INTO `municipios` VALUES (1906, 26, '011', 'Bacoachi', 1, NULL);
INSERT INTO `municipios` VALUES (1907, 26, '012', 'Bácum', 1, NULL);
INSERT INTO `municipios` VALUES (1908, 26, '013', 'Banámichi', 1, NULL);
INSERT INTO `municipios` VALUES (1909, 26, '014', 'Baviácora', 1, NULL);
INSERT INTO `municipios` VALUES (1910, 26, '015', 'Bavispe', 1, NULL);
INSERT INTO `municipios` VALUES (1911, 26, '016', 'Benjamín Hill', 1, NULL);
INSERT INTO `municipios` VALUES (1912, 26, '017', 'Caborca', 1, NULL);
INSERT INTO `municipios` VALUES (1913, 26, '018', 'Cajeme', 1, 1);
INSERT INTO `municipios` VALUES (1914, 26, '019', 'Cananea', 1, NULL);
INSERT INTO `municipios` VALUES (1915, 26, '020', 'Carbó', 1, NULL);
INSERT INTO `municipios` VALUES (1916, 26, '021', 'La Colorada', 1, NULL);
INSERT INTO `municipios` VALUES (1917, 26, '022', 'Cucurpe', 1, NULL);
INSERT INTO `municipios` VALUES (1918, 26, '023', 'Cumpas', 1, NULL);
INSERT INTO `municipios` VALUES (1919, 26, '024', 'Divisaderos', 1, NULL);
INSERT INTO `municipios` VALUES (1920, 26, '025', 'Empalme', 1, NULL);
INSERT INTO `municipios` VALUES (1921, 26, '026', 'Etchojoa', 1, NULL);
INSERT INTO `municipios` VALUES (1922, 26, '027', 'Fronteras', 1, NULL);
INSERT INTO `municipios` VALUES (1923, 26, '028', 'Granados', 1, NULL);
INSERT INTO `municipios` VALUES (1924, 26, '029', 'Guaymas', 1, 1);
INSERT INTO `municipios` VALUES (1925, 26, '030', 'Hermosillo', 1, 1);
INSERT INTO `municipios` VALUES (1926, 26, '031', 'Huachinera', 1, NULL);
INSERT INTO `municipios` VALUES (1927, 26, '032', 'Huásabas', 1, NULL);
INSERT INTO `municipios` VALUES (1928, 26, '033', 'Huatabampo', 1, NULL);
INSERT INTO `municipios` VALUES (1929, 26, '034', 'Huépac', 1, NULL);
INSERT INTO `municipios` VALUES (1930, 26, '035', 'Imuris', 1, NULL);
INSERT INTO `municipios` VALUES (1931, 26, '036', 'Magdalena', 1, NULL);
INSERT INTO `municipios` VALUES (1932, 26, '037', 'Mazatán', 1, NULL);
INSERT INTO `municipios` VALUES (1933, 26, '038', 'Moctezuma', 1, NULL);
INSERT INTO `municipios` VALUES (1934, 26, '039', 'Naco', 1, NULL);
INSERT INTO `municipios` VALUES (1935, 26, '040', 'Nácori Chico', 1, NULL);
INSERT INTO `municipios` VALUES (1936, 26, '041', 'Nacozari de García', 1, NULL);
INSERT INTO `municipios` VALUES (1937, 26, '042', 'Navojoa', 1, NULL);
INSERT INTO `municipios` VALUES (1938, 26, '043', 'Nogales', 1, NULL);
INSERT INTO `municipios` VALUES (1939, 26, '044', 'Onavas', 1, NULL);
INSERT INTO `municipios` VALUES (1940, 26, '045', 'Opodepe', 1, NULL);
INSERT INTO `municipios` VALUES (1941, 26, '046', 'Oquitoa', 1, NULL);
INSERT INTO `municipios` VALUES (1942, 26, '047', 'Pitiquito', 1, NULL);
INSERT INTO `municipios` VALUES (1943, 26, '048', 'Puerto Peñasco', 1, NULL);
INSERT INTO `municipios` VALUES (1944, 26, '049', 'Quiriego', 1, NULL);
INSERT INTO `municipios` VALUES (1945, 26, '050', 'Rayón', 1, NULL);
INSERT INTO `municipios` VALUES (1946, 26, '051', 'Rosario', 1, NULL);
INSERT INTO `municipios` VALUES (1947, 26, '052', 'Sahuaripa', 1, NULL);
INSERT INTO `municipios` VALUES (1948, 26, '053', 'San Felipe de Jesús', 1, NULL);
INSERT INTO `municipios` VALUES (1949, 26, '054', 'San Javier', 1, NULL);
INSERT INTO `municipios` VALUES (1950, 26, '055', 'San Luis Río Colorado', 1, NULL);
INSERT INTO `municipios` VALUES (1951, 26, '056', 'San Miguel de Horcasitas', 1, NULL);
INSERT INTO `municipios` VALUES (1952, 26, '057', 'San Pedro de la Cueva', 1, NULL);
INSERT INTO `municipios` VALUES (1953, 26, '058', 'Santa Ana', 1, NULL);
INSERT INTO `municipios` VALUES (1954, 26, '059', 'Santa Cruz', 1, NULL);
INSERT INTO `municipios` VALUES (1955, 26, '060', 'Sáric', 1, NULL);
INSERT INTO `municipios` VALUES (1956, 26, '061', 'Soyopa', 1, NULL);
INSERT INTO `municipios` VALUES (1957, 26, '062', 'Suaqui Grande', 1, NULL);
INSERT INTO `municipios` VALUES (1958, 26, '063', 'Tepache', 1, NULL);
INSERT INTO `municipios` VALUES (1959, 26, '064', 'Trincheras', 1, NULL);
INSERT INTO `municipios` VALUES (1960, 26, '065', 'Tubutama', 1, NULL);
INSERT INTO `municipios` VALUES (1961, 26, '066', 'Ures', 1, NULL);
INSERT INTO `municipios` VALUES (1962, 26, '067', 'Villa Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (1963, 26, '068', 'Villa Pesqueira', 1, NULL);
INSERT INTO `municipios` VALUES (1964, 26, '069', 'Yécora', 1, NULL);
INSERT INTO `municipios` VALUES (1965, 26, '070', 'General Plutarco Elías Calles', 1, NULL);
INSERT INTO `municipios` VALUES (1966, 26, '071', 'Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (1967, 26, '072', 'San Ignacio Río Muerto', 1, NULL);
INSERT INTO `municipios` VALUES (1968, 27, '001', 'Balancán', 1, NULL);
INSERT INTO `municipios` VALUES (1969, 27, '002', 'Cárdenas', 1, 1);
INSERT INTO `municipios` VALUES (1970, 27, '003', 'Centla', 1, NULL);
INSERT INTO `municipios` VALUES (1971, 27, '004', 'Centro', 1, 1);
INSERT INTO `municipios` VALUES (1972, 27, '005', 'Comalcalco', 1, 1);
INSERT INTO `municipios` VALUES (1973, 27, '006', 'Cunduacán', 1, NULL);
INSERT INTO `municipios` VALUES (1974, 27, '007', 'Emiliano Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (1975, 27, '008', 'Huimanguillo', 1, NULL);
INSERT INTO `municipios` VALUES (1976, 27, '009', 'Jalapa', 1, NULL);
INSERT INTO `municipios` VALUES (1977, 27, '010', 'Jalpa de Méndez', 1, NULL);
INSERT INTO `municipios` VALUES (1978, 27, '011', 'Jonuta', 1, NULL);
INSERT INTO `municipios` VALUES (1979, 27, '012', 'Macuspana', 1, 1);
INSERT INTO `municipios` VALUES (1980, 27, '013', 'Nacajuca', 1, NULL);
INSERT INTO `municipios` VALUES (1981, 27, '014', 'Paraíso', 1, 1);
INSERT INTO `municipios` VALUES (1982, 27, '015', 'Tacotalpa', 1, NULL);
INSERT INTO `municipios` VALUES (1983, 27, '016', 'Teapa', 1, NULL);
INSERT INTO `municipios` VALUES (1984, 27, '017', 'Tenosique', 1, NULL);
INSERT INTO `municipios` VALUES (1985, 28, '001', 'Abasolo', 1, NULL);
INSERT INTO `municipios` VALUES (1986, 28, '002', 'Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (1987, 28, '003', 'Altamira', 1, 1);
INSERT INTO `municipios` VALUES (1988, 28, '004', 'Antiguo Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (1989, 28, '005', 'Burgos', 1, NULL);
INSERT INTO `municipios` VALUES (1990, 28, '006', 'Bustamante', 1, NULL);
INSERT INTO `municipios` VALUES (1991, 28, '007', 'Camargo', 1, NULL);
INSERT INTO `municipios` VALUES (1992, 28, '008', 'Casas', 1, NULL);
INSERT INTO `municipios` VALUES (1993, 28, '009', 'Ciudad Madero', 1, 1);
INSERT INTO `municipios` VALUES (1994, 28, '010', 'Cruillas', 1, NULL);
INSERT INTO `municipios` VALUES (1995, 28, '011', 'Gómez Farías', 1, NULL);
INSERT INTO `municipios` VALUES (1996, 28, '012', 'González', 1, NULL);
INSERT INTO `municipios` VALUES (1997, 28, '013', 'Güémez', 1, NULL);
INSERT INTO `municipios` VALUES (1998, 28, '014', 'Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (1999, 28, '015', 'Gustavo Díaz Ordaz', 1, NULL);
INSERT INTO `municipios` VALUES (2000, 28, '016', 'Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (2001, 28, '017', 'Jaumave', 1, NULL);
INSERT INTO `municipios` VALUES (2002, 28, '018', 'Jiménez', 1, NULL);
INSERT INTO `municipios` VALUES (2003, 28, '019', 'Llera', 1, NULL);
INSERT INTO `municipios` VALUES (2004, 28, '020', 'Mainero', 1, NULL);
INSERT INTO `municipios` VALUES (2005, 28, '021', 'El Mante', 1, 1);
INSERT INTO `municipios` VALUES (2006, 28, '022', 'Matamoros', 1, 1);
INSERT INTO `municipios` VALUES (2007, 28, '023', 'Méndez', 1, NULL);
INSERT INTO `municipios` VALUES (2008, 28, '024', 'Mier', 1, NULL);
INSERT INTO `municipios` VALUES (2009, 28, '025', 'Miguel Alemán', 1, 1);
INSERT INTO `municipios` VALUES (2010, 28, '026', 'Miquihuana', 1, NULL);
INSERT INTO `municipios` VALUES (2011, 28, '027', 'Nuevo Laredo', 1, 1);
INSERT INTO `municipios` VALUES (2012, 28, '028', 'Nuevo Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (2013, 28, '029', 'Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (2014, 28, '030', 'Padilla', 1, NULL);
INSERT INTO `municipios` VALUES (2015, 28, '031', 'Palmillas', 1, NULL);
INSERT INTO `municipios` VALUES (2016, 28, '032', 'Reynosa', 1, 1);
INSERT INTO `municipios` VALUES (2017, 28, '033', 'Río Bravo', 1, 1);
INSERT INTO `municipios` VALUES (2018, 28, '034', 'San Carlos', 1, NULL);
INSERT INTO `municipios` VALUES (2019, 28, '035', 'San Fernando', 1, NULL);
INSERT INTO `municipios` VALUES (2020, 28, '036', 'San Nicolás', 1, NULL);
INSERT INTO `municipios` VALUES (2021, 28, '037', 'Soto la Marina', 1, NULL);
INSERT INTO `municipios` VALUES (2022, 28, '038', 'Tampico', 1, 1);
INSERT INTO `municipios` VALUES (2023, 28, '039', 'Tula', 1, NULL);
INSERT INTO `municipios` VALUES (2024, 28, '040', 'Valle Hermoso', 1, NULL);
INSERT INTO `municipios` VALUES (2025, 28, '041', 'Victoria', 1, 1);
INSERT INTO `municipios` VALUES (2026, 28, '042', 'Villagrán', 1, NULL);
INSERT INTO `municipios` VALUES (2027, 28, '043', 'Xicoténcatl', 1, NULL);
INSERT INTO `municipios` VALUES (2028, 29, '001', 'Amaxac de Guerrero', 1, NULL);
INSERT INTO `municipios` VALUES (2029, 29, '002', 'Apetatitlán de Antonio Carvajal', 1, NULL);
INSERT INTO `municipios` VALUES (2030, 29, '003', 'Atlangatepec', 1, NULL);
INSERT INTO `municipios` VALUES (2031, 29, '004', 'Atltzayanca', 1, NULL);
INSERT INTO `municipios` VALUES (2032, 29, '005', 'Apizaco', 1, 1);
INSERT INTO `municipios` VALUES (2033, 29, '006', 'Calpulalpan', 1, NULL);
INSERT INTO `municipios` VALUES (2034, 29, '007', 'El Carmen Tequexquitla', 1, NULL);
INSERT INTO `municipios` VALUES (2035, 29, '008', 'Cuapiaxtla', 1, NULL);
INSERT INTO `municipios` VALUES (2036, 29, '009', 'Cuaxomulco', 1, NULL);
INSERT INTO `municipios` VALUES (2037, 29, '010', 'Chiautempan', 1, 1);
INSERT INTO `municipios` VALUES (2038, 29, '011', 'Muñoz de Domingo Arenas', 1, NULL);
INSERT INTO `municipios` VALUES (2039, 29, '012', 'Españita', 1, NULL);
INSERT INTO `municipios` VALUES (2040, 29, '013', 'Huamantla', 1, 1);
INSERT INTO `municipios` VALUES (2041, 29, '014', 'Hueyotlipan', 1, NULL);
INSERT INTO `municipios` VALUES (2042, 29, '015', 'Ixtacuixtla de Mariano Matamoros', 1, NULL);
INSERT INTO `municipios` VALUES (2043, 29, '016', 'Ixtenco', 1, NULL);
INSERT INTO `municipios` VALUES (2044, 29, '017', 'Mazatecochco de José María Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (2045, 29, '018', 'Contla de Juan Cuamatzi', 1, NULL);
INSERT INTO `municipios` VALUES (2046, 29, '019', 'Tepetitla de Lardizábal', 1, NULL);
INSERT INTO `municipios` VALUES (2047, 29, '020', 'Sanctórum de Lázaro Cárdenas', 1, NULL);
INSERT INTO `municipios` VALUES (2048, 29, '021', 'Nanacamilpa de Mariano Arista', 1, NULL);
INSERT INTO `municipios` VALUES (2049, 29, '022', 'Acuamanala de Miguel Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (2050, 29, '023', 'Natívitas', 1, NULL);
INSERT INTO `municipios` VALUES (2051, 29, '024', 'Panotla', 1, NULL);
INSERT INTO `municipios` VALUES (2052, 29, '025', 'San Pablo del Monte', 1, NULL);
INSERT INTO `municipios` VALUES (2053, 29, '026', 'Santa Cruz Tlaxcala', 1, NULL);
INSERT INTO `municipios` VALUES (2054, 29, '027', 'Tenancingo', 1, NULL);
INSERT INTO `municipios` VALUES (2055, 29, '028', 'Teolocholco', 1, NULL);
INSERT INTO `municipios` VALUES (2056, 29, '029', 'Tepeyanco', 1, NULL);
INSERT INTO `municipios` VALUES (2057, 29, '030', 'Terrenate', 1, NULL);
INSERT INTO `municipios` VALUES (2058, 29, '031', 'Tetla de la Solidaridad', 1, NULL);
INSERT INTO `municipios` VALUES (2059, 29, '032', 'Tetlatlahuca', 1, NULL);
INSERT INTO `municipios` VALUES (2060, 29, '033', 'Tlaxcala', 1, 1);
INSERT INTO `municipios` VALUES (2061, 29, '034', 'Tlaxco', 1, NULL);
INSERT INTO `municipios` VALUES (2062, 29, '035', 'Tocatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2063, 29, '036', 'Totolac', 1, NULL);
INSERT INTO `municipios` VALUES (2064, 29, '037', 'Ziltlaltépec de Trinidad Sánchez Santos', 1, NULL);
INSERT INTO `municipios` VALUES (2065, 29, '038', 'Tzompantepec', 1, NULL);
INSERT INTO `municipios` VALUES (2066, 29, '039', 'Xaloztoc', 1, NULL);
INSERT INTO `municipios` VALUES (2067, 29, '040', 'Xaltocan', 1, NULL);
INSERT INTO `municipios` VALUES (2068, 29, '041', 'Papalotla de Xicohténcatl', 1, 1);
INSERT INTO `municipios` VALUES (2069, 29, '042', 'Xicohtzinco', 1, NULL);
INSERT INTO `municipios` VALUES (2070, 29, '043', 'Yauhquemehcan', 1, NULL);
INSERT INTO `municipios` VALUES (2071, 29, '044', 'Zacatelco', 1, NULL);
INSERT INTO `municipios` VALUES (2072, 29, '045', 'Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (2073, 29, '046', 'Emiliano Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (2074, 29, '047', 'Lázaro Cárdenas', 1, NULL);
INSERT INTO `municipios` VALUES (2075, 29, '048', 'La Magdalena Tlaltelulco', 1, NULL);
INSERT INTO `municipios` VALUES (2076, 29, '049', 'San Damián Texóloc', 1, NULL);
INSERT INTO `municipios` VALUES (2077, 29, '050', 'San Francisco Tetlanohcan', 1, NULL);
INSERT INTO `municipios` VALUES (2078, 29, '051', 'San Jerónimo Zacualpan', 1, NULL);
INSERT INTO `municipios` VALUES (2079, 29, '052', 'San José Teacalco', 1, NULL);
INSERT INTO `municipios` VALUES (2080, 29, '053', 'San Juan Huactzinco', 1, NULL);
INSERT INTO `municipios` VALUES (2081, 29, '054', 'San Lorenzo Axocomanitla', 1, NULL);
INSERT INTO `municipios` VALUES (2082, 29, '055', 'San Lucas Tecopilco', 1, NULL);
INSERT INTO `municipios` VALUES (2083, 29, '056', 'Santa Ana Nopalucan', 1, NULL);
INSERT INTO `municipios` VALUES (2084, 29, '057', 'Santa Apolonia Teacalco', 1, NULL);
INSERT INTO `municipios` VALUES (2085, 29, '058', 'Santa Catarina Ayometla', 1, NULL);
INSERT INTO `municipios` VALUES (2086, 29, '059', 'Santa Cruz Quilehtla', 1, NULL);
INSERT INTO `municipios` VALUES (2087, 29, '060', 'Santa Isabel Xiloxoxtla', 1, NULL);
INSERT INTO `municipios` VALUES (2088, 30, '001', 'Acajete', 1, NULL);
INSERT INTO `municipios` VALUES (2089, 30, '002', 'Acatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2090, 30, '003', 'Acayucan', 1, 1);
INSERT INTO `municipios` VALUES (2091, 30, '004', 'Actopan', 1, NULL);
INSERT INTO `municipios` VALUES (2092, 30, '005', 'Acula', 1, NULL);
INSERT INTO `municipios` VALUES (2093, 30, '006', 'Acultzingo', 1, NULL);
INSERT INTO `municipios` VALUES (2094, 30, '007', 'Camarón de Tejeda', 1, NULL);
INSERT INTO `municipios` VALUES (2095, 30, '008', 'Alpatláhuac', 1, NULL);
INSERT INTO `municipios` VALUES (2096, 30, '009', 'Alto Lucero de Gutiérrez Barrios', 1, NULL);
INSERT INTO `municipios` VALUES (2097, 30, '010', 'Altotonga', 1, NULL);
INSERT INTO `municipios` VALUES (2098, 30, '011', 'Alvarado', 1, NULL);
INSERT INTO `municipios` VALUES (2099, 30, '012', 'Amatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2100, 30, '013', 'Naranjos Amatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2101, 30, '014', 'Amatlán de los Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (2102, 30, '015', 'Angel R. Cabada', 1, NULL);
INSERT INTO `municipios` VALUES (2103, 30, '016', 'La Antigua', 1, NULL);
INSERT INTO `municipios` VALUES (2104, 30, '017', 'Apazapan', 1, NULL);
INSERT INTO `municipios` VALUES (2105, 30, '018', 'Aquila', 1, NULL);
INSERT INTO `municipios` VALUES (2106, 30, '019', 'Astacinga', 1, NULL);
INSERT INTO `municipios` VALUES (2107, 30, '020', 'Atlahuilco', 1, NULL);
INSERT INTO `municipios` VALUES (2108, 30, '021', 'Atoyac', 1, NULL);
INSERT INTO `municipios` VALUES (2109, 30, '022', 'Atzacan', 1, NULL);
INSERT INTO `municipios` VALUES (2110, 30, '023', 'Atzalan', 1, NULL);
INSERT INTO `municipios` VALUES (2111, 30, '024', 'Tlaltetela', 1, NULL);
INSERT INTO `municipios` VALUES (2112, 30, '025', 'Ayahualulco', 1, NULL);
INSERT INTO `municipios` VALUES (2113, 30, '026', 'Banderilla', 1, 1);
INSERT INTO `municipios` VALUES (2114, 30, '027', 'Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (2115, 30, '028', 'Boca del Río', 1, 1);
INSERT INTO `municipios` VALUES (2116, 30, '029', 'Calcahualco', 1, NULL);
INSERT INTO `municipios` VALUES (2117, 30, '030', 'Camerino Z. Mendoza', 1, 1);
INSERT INTO `municipios` VALUES (2118, 30, '031', 'Carrillo Puerto', 1, NULL);
INSERT INTO `municipios` VALUES (2119, 30, '032', 'Catemaco', 1, NULL);
INSERT INTO `municipios` VALUES (2120, 30, '033', 'Cazones de Herrera', 1, NULL);
INSERT INTO `municipios` VALUES (2121, 30, '034', 'Cerro Azul', 1, NULL);
INSERT INTO `municipios` VALUES (2122, 30, '035', 'Citlaltépetl', 1, NULL);
INSERT INTO `municipios` VALUES (2123, 30, '036', 'Coacoatzintla', 1, NULL);
INSERT INTO `municipios` VALUES (2124, 30, '037', 'Coahuitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2125, 30, '038', 'Coatepec', 1, 1);
INSERT INTO `municipios` VALUES (2126, 30, '039', 'Coatzacoalcos', 1, 1);
INSERT INTO `municipios` VALUES (2127, 30, '040', 'Coatzintla', 1, 1);
INSERT INTO `municipios` VALUES (2128, 30, '041', 'Coetzala', 1, NULL);
INSERT INTO `municipios` VALUES (2129, 30, '042', 'Colipa', 1, NULL);
INSERT INTO `municipios` VALUES (2130, 30, '043', 'Comapa', 1, NULL);
INSERT INTO `municipios` VALUES (2131, 30, '044', 'Córdoba', 1, 1);
INSERT INTO `municipios` VALUES (2132, 30, '045', 'Cosamaloapan de Carpio', 1, 1);
INSERT INTO `municipios` VALUES (2133, 30, '046', 'Cosautlán de Carvajal', 1, NULL);
INSERT INTO `municipios` VALUES (2134, 30, '047', 'Coscomatepec', 1, NULL);
INSERT INTO `municipios` VALUES (2135, 30, '048', 'Cosoleacaque', 1, NULL);
INSERT INTO `municipios` VALUES (2136, 30, '049', 'Cotaxtla', 1, 1);
INSERT INTO `municipios` VALUES (2137, 30, '050', 'Coxquihui', 1, NULL);
INSERT INTO `municipios` VALUES (2138, 30, '051', 'Coyutla', 1, NULL);
INSERT INTO `municipios` VALUES (2139, 30, '052', 'Cuichapa', 1, NULL);
INSERT INTO `municipios` VALUES (2140, 30, '053', 'Cuitláhuac', 1, 1);
INSERT INTO `municipios` VALUES (2141, 30, '054', 'Chacaltianguis', 1, NULL);
INSERT INTO `municipios` VALUES (2142, 30, '055', 'Chalma', 1, NULL);
INSERT INTO `municipios` VALUES (2143, 30, '056', 'Chiconamel', 1, NULL);
INSERT INTO `municipios` VALUES (2144, 30, '057', 'Chiconquiaco', 1, NULL);
INSERT INTO `municipios` VALUES (2145, 30, '058', 'Chicontepec', 1, NULL);
INSERT INTO `municipios` VALUES (2146, 30, '059', 'Chinameca', 1, NULL);
INSERT INTO `municipios` VALUES (2147, 30, '060', 'Chinampa de Gorostiza', 1, NULL);
INSERT INTO `municipios` VALUES (2148, 30, '061', 'Las Choapas', 1, NULL);
INSERT INTO `municipios` VALUES (2149, 30, '062', 'Chocamán', 1, NULL);
INSERT INTO `municipios` VALUES (2150, 30, '063', 'Chontla', 1, NULL);
INSERT INTO `municipios` VALUES (2151, 30, '064', 'Chumatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2152, 30, '065', 'Emiliano Zapata', 1, NULL);
INSERT INTO `municipios` VALUES (2153, 30, '066', 'Espinal', 1, NULL);
INSERT INTO `municipios` VALUES (2154, 30, '067', 'Filomeno Mata', 1, NULL);
INSERT INTO `municipios` VALUES (2155, 30, '068', 'Fortín', 1, 1);
INSERT INTO `municipios` VALUES (2156, 30, '069', 'Gutiérrez Zamora', 1, NULL);
INSERT INTO `municipios` VALUES (2157, 30, '070', 'Hidalgotitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2158, 30, '071', 'Huatusco', 1, NULL);
INSERT INTO `municipios` VALUES (2159, 30, '072', 'Huayacocotla', 1, NULL);
INSERT INTO `municipios` VALUES (2160, 30, '073', 'Hueyapan de Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (2161, 30, '074', 'Huiloapan de Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (2162, 30, '075', 'Ignacio de la Llave', 1, NULL);
INSERT INTO `municipios` VALUES (2163, 30, '076', 'Ilamatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2164, 30, '077', 'Isla', 1, NULL);
INSERT INTO `municipios` VALUES (2165, 30, '078', 'Ixcatepec', 1, NULL);
INSERT INTO `municipios` VALUES (2166, 30, '079', 'Ixhuacán de los Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (2167, 30, '080', 'Ixhuatlán del Café', 1, NULL);
INSERT INTO `municipios` VALUES (2168, 30, '081', 'Ixhuatlancillo', 1, NULL);
INSERT INTO `municipios` VALUES (2169, 30, '082', 'Ixhuatlán del Sureste', 1, NULL);
INSERT INTO `municipios` VALUES (2170, 30, '083', 'Ixhuatlán de Madero', 1, NULL);
INSERT INTO `municipios` VALUES (2171, 30, '084', 'Ixmatlahuacan', 1, NULL);
INSERT INTO `municipios` VALUES (2172, 30, '085', 'Ixtaczoquitlán', 1, 1);
INSERT INTO `municipios` VALUES (2173, 30, '086', 'Jalacingo', 1, NULL);
INSERT INTO `municipios` VALUES (2174, 30, '087', 'Xalapa', 1, 1);
INSERT INTO `municipios` VALUES (2175, 30, '088', 'Jalcomulco', 1, NULL);
INSERT INTO `municipios` VALUES (2176, 30, '089', 'Jáltipan', 1, NULL);
INSERT INTO `municipios` VALUES (2177, 30, '090', 'Jamapa', 1, NULL);
INSERT INTO `municipios` VALUES (2178, 30, '091', 'Jesús Carranza', 1, NULL);
INSERT INTO `municipios` VALUES (2179, 30, '092', 'Xico', 1, NULL);
INSERT INTO `municipios` VALUES (2180, 30, '093', 'Jilotepec', 1, NULL);
INSERT INTO `municipios` VALUES (2181, 30, '094', 'Juan Rodríguez Clara', 1, NULL);
INSERT INTO `municipios` VALUES (2182, 30, '095', 'Juchique de Ferrer', 1, NULL);
INSERT INTO `municipios` VALUES (2183, 30, '096', 'Landero y Coss', 1, NULL);
INSERT INTO `municipios` VALUES (2184, 30, '097', 'Lerdo de Tejada', 1, NULL);
INSERT INTO `municipios` VALUES (2185, 30, '098', 'Magdalena', 1, NULL);
INSERT INTO `municipios` VALUES (2186, 30, '099', 'Maltrata', 1, NULL);
INSERT INTO `municipios` VALUES (2187, 30, '100', 'Manlio Fabio Altamirano', 1, NULL);
INSERT INTO `municipios` VALUES (2188, 30, '101', 'Mariano Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (2189, 30, '102', 'Martínez de la Torre', 1, NULL);
INSERT INTO `municipios` VALUES (2190, 30, '103', 'Mecatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2191, 30, '104', 'Mecayapan', 1, NULL);
INSERT INTO `municipios` VALUES (2192, 30, '105', 'Medellín de Bravo', 1, 0);
INSERT INTO `municipios` VALUES (2193, 30, '106', 'Miahuatlán', 1, NULL);
INSERT INTO `municipios` VALUES (2194, 30, '107', 'Las Minas', 1, NULL);
INSERT INTO `municipios` VALUES (2195, 30, '108', 'Minatitlán', 1, 1);
INSERT INTO `municipios` VALUES (2196, 30, '109', 'Misantla', 1, NULL);
INSERT INTO `municipios` VALUES (2197, 30, '110', 'Mixtla de Altamirano', 1, NULL);
INSERT INTO `municipios` VALUES (2198, 30, '111', 'Moloacán', 1, NULL);
INSERT INTO `municipios` VALUES (2199, 30, '112', 'Naolinco', 1, NULL);
INSERT INTO `municipios` VALUES (2200, 30, '113', 'Naranjal', 1, NULL);
INSERT INTO `municipios` VALUES (2201, 30, '114', 'Nautla', 1, NULL);
INSERT INTO `municipios` VALUES (2202, 30, '115', 'Nogales', 1, 1);
INSERT INTO `municipios` VALUES (2203, 30, '116', 'Oluta', 1, NULL);
INSERT INTO `municipios` VALUES (2204, 30, '117', 'Omealca', 1, NULL);
INSERT INTO `municipios` VALUES (2205, 30, '118', 'Orizaba', 1, 1);
INSERT INTO `municipios` VALUES (2206, 30, '119', 'Otatitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2207, 30, '120', 'Oteapan', 1, NULL);
INSERT INTO `municipios` VALUES (2208, 30, '121', 'Ozuluama de Mascareñas', 1, NULL);
INSERT INTO `municipios` VALUES (2209, 30, '122', 'Pajapan', 1, NULL);
INSERT INTO `municipios` VALUES (2210, 30, '123', 'Pánuco', 1, NULL);
INSERT INTO `municipios` VALUES (2211, 30, '124', 'Papantla', 1, 1);
INSERT INTO `municipios` VALUES (2212, 30, '125', 'Paso del Macho', 1, NULL);
INSERT INTO `municipios` VALUES (2213, 30, '126', 'Paso de Ovejas', 1, NULL);
INSERT INTO `municipios` VALUES (2214, 30, '127', 'La Perla', 1, NULL);
INSERT INTO `municipios` VALUES (2215, 30, '128', 'Perote', 1, NULL);
INSERT INTO `municipios` VALUES (2216, 30, '129', 'Platón Sánchez', 1, NULL);
INSERT INTO `municipios` VALUES (2217, 30, '130', 'Playa Vicente', 1, NULL);
INSERT INTO `municipios` VALUES (2218, 30, '131', 'Poza Rica de Hidalgo', 1, 1);
INSERT INTO `municipios` VALUES (2219, 30, '132', 'Las Vigas de Ramírez', 1, NULL);
INSERT INTO `municipios` VALUES (2220, 30, '133', 'Pueblo Viejo', 1, NULL);
INSERT INTO `municipios` VALUES (2221, 30, '134', 'Puente Nacional', 1, NULL);
INSERT INTO `municipios` VALUES (2222, 30, '135', 'Rafael Delgado', 1, NULL);
INSERT INTO `municipios` VALUES (2223, 30, '136', 'Rafael Lucio', 1, NULL);
INSERT INTO `municipios` VALUES (2224, 30, '137', 'Los Reyes', 1, NULL);
INSERT INTO `municipios` VALUES (2225, 30, '138', 'Río Blanco', 1, 1);
INSERT INTO `municipios` VALUES (2226, 30, '139', 'Saltabarranca', 1, NULL);
INSERT INTO `municipios` VALUES (2227, 30, '140', 'San Andrés Tenejapan', 1, NULL);
INSERT INTO `municipios` VALUES (2228, 30, '141', 'San Andrés Tuxtla', 1, NULL);
INSERT INTO `municipios` VALUES (2229, 30, '142', 'San Juan Evangelista', 1, NULL);
INSERT INTO `municipios` VALUES (2230, 30, '143', 'Santiago Tuxtla', 1, NULL);
INSERT INTO `municipios` VALUES (2231, 30, '144', 'Sayula de Alemán', 1, NULL);
INSERT INTO `municipios` VALUES (2232, 30, '145', 'Soconusco', 1, NULL);
INSERT INTO `municipios` VALUES (2233, 30, '146', 'Sochiapa', 1, NULL);
INSERT INTO `municipios` VALUES (2234, 30, '147', 'Soledad Atzompa', 1, NULL);
INSERT INTO `municipios` VALUES (2235, 30, '148', 'Soledad de Doblado', 1, NULL);
INSERT INTO `municipios` VALUES (2236, 30, '149', 'Soteapan', 1, NULL);
INSERT INTO `municipios` VALUES (2237, 30, '150', 'Tamalín', 1, NULL);
INSERT INTO `municipios` VALUES (2238, 30, '151', 'Tamiahua', 1, NULL);
INSERT INTO `municipios` VALUES (2239, 30, '152', 'Tampico Alto', 1, NULL);
INSERT INTO `municipios` VALUES (2240, 30, '153', 'Tancoco', 1, NULL);
INSERT INTO `municipios` VALUES (2241, 30, '154', 'Tantima', 1, NULL);
INSERT INTO `municipios` VALUES (2242, 30, '155', 'Tantoyuca', 1, NULL);
INSERT INTO `municipios` VALUES (2243, 30, '156', 'Tatatila', 1, NULL);
INSERT INTO `municipios` VALUES (2244, 30, '157', 'Castillo de Teayo', 1, NULL);
INSERT INTO `municipios` VALUES (2245, 30, '158', 'Tecolutla', 1, NULL);
INSERT INTO `municipios` VALUES (2246, 30, '159', 'Tehuipango', 1, NULL);
INSERT INTO `municipios` VALUES (2247, 30, '160', 'Álamo Temapache', 1, 1);
INSERT INTO `municipios` VALUES (2248, 30, '161', 'Tempoal', 1, NULL);
INSERT INTO `municipios` VALUES (2249, 30, '162', 'Tenampa', 1, NULL);
INSERT INTO `municipios` VALUES (2250, 30, '163', 'Tenochtitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2251, 30, '164', 'Teocelo', 1, NULL);
INSERT INTO `municipios` VALUES (2252, 30, '165', 'Tepatlaxco', 1, NULL);
INSERT INTO `municipios` VALUES (2253, 30, '166', 'Tepetlán', 1, NULL);
INSERT INTO `municipios` VALUES (2254, 30, '167', 'Tepetzintla', 1, NULL);
INSERT INTO `municipios` VALUES (2255, 30, '168', 'Tequila', 1, NULL);
INSERT INTO `municipios` VALUES (2256, 30, '169', 'José Azueta', 1, NULL);
INSERT INTO `municipios` VALUES (2257, 30, '170', 'Texcatepec', 1, NULL);
INSERT INTO `municipios` VALUES (2258, 30, '171', 'Texhuacán', 1, NULL);
INSERT INTO `municipios` VALUES (2259, 30, '172', 'Texistepec', 1, NULL);
INSERT INTO `municipios` VALUES (2260, 30, '173', 'Tezonapa', 1, NULL);
INSERT INTO `municipios` VALUES (2261, 30, '174', 'Tierra Blanca', 1, 1);
INSERT INTO `municipios` VALUES (2262, 30, '175', 'Tihuatlán', 1, 1);
INSERT INTO `municipios` VALUES (2263, 30, '176', 'Tlacojalpan', 1, NULL);
INSERT INTO `municipios` VALUES (2264, 30, '177', 'Tlacolulan', 1, NULL);
INSERT INTO `municipios` VALUES (2265, 30, '178', 'Tlacotalpan', 1, NULL);
INSERT INTO `municipios` VALUES (2266, 30, '179', 'Tlacotepec de Mejía', 1, NULL);
INSERT INTO `municipios` VALUES (2267, 30, '180', 'Tlachichilco', 1, NULL);
INSERT INTO `municipios` VALUES (2268, 30, '181', 'Tlalixcoyan', 1, NULL);
INSERT INTO `municipios` VALUES (2269, 30, '182', 'Tlalnelhuayocan', 1, NULL);
INSERT INTO `municipios` VALUES (2270, 30, '183', 'Tlapacoyan', 1, NULL);
INSERT INTO `municipios` VALUES (2271, 30, '184', 'Tlaquilpa', 1, NULL);
INSERT INTO `municipios` VALUES (2272, 30, '185', 'Tlilapan', 1, NULL);
INSERT INTO `municipios` VALUES (2273, 30, '186', 'Tomatlán', 1, 1);
INSERT INTO `municipios` VALUES (2274, 30, '187', 'Tonayán', 1, NULL);
INSERT INTO `municipios` VALUES (2275, 30, '188', 'Totutla', 1, NULL);
INSERT INTO `municipios` VALUES (2276, 30, '189', 'Tuxpan', 1, 1);
INSERT INTO `municipios` VALUES (2277, 30, '190', 'Tuxtilla', 1, NULL);
INSERT INTO `municipios` VALUES (2278, 30, '191', 'Ursulo Galván', 1, NULL);
INSERT INTO `municipios` VALUES (2279, 30, '192', 'Vega de Alatorre', 1, NULL);
INSERT INTO `municipios` VALUES (2280, 30, '193', 'Veracruz', 1, 1);
INSERT INTO `municipios` VALUES (2281, 30, '194', 'Villa Aldama', 1, NULL);
INSERT INTO `municipios` VALUES (2282, 30, '195', 'Xoxocotla', 1, NULL);
INSERT INTO `municipios` VALUES (2283, 30, '196', 'Yanga', 1, 1);
INSERT INTO `municipios` VALUES (2284, 30, '197', 'Yecuatla', 1, NULL);
INSERT INTO `municipios` VALUES (2285, 30, '198', 'Zacualpan', 1, NULL);
INSERT INTO `municipios` VALUES (2286, 30, '199', 'Zaragoza', 1, NULL);
INSERT INTO `municipios` VALUES (2287, 30, '200', 'Zentla', 1, NULL);
INSERT INTO `municipios` VALUES (2288, 30, '201', 'Zongolica', 1, NULL);
INSERT INTO `municipios` VALUES (2289, 30, '202', 'Zontecomatlán de López y Fuentes', 1, NULL);
INSERT INTO `municipios` VALUES (2290, 30, '203', 'Zozocolco de Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (2291, 30, '204', 'Agua Dulce', 1, NULL);
INSERT INTO `municipios` VALUES (2292, 30, '205', 'El Higo', 1, NULL);
INSERT INTO `municipios` VALUES (2293, 30, '206', 'Nanchital de Lázaro Cárdenas del Río', 1, NULL);
INSERT INTO `municipios` VALUES (2294, 30, '207', 'Tres Valles', 1, 1);
INSERT INTO `municipios` VALUES (2295, 30, '208', 'Carlos A. Carrillo', 1, NULL);
INSERT INTO `municipios` VALUES (2296, 30, '209', 'Tatahuicapan de Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (2297, 30, '210', 'Uxpanapa', 1, NULL);
INSERT INTO `municipios` VALUES (2298, 30, '211', 'San Rafael', 1, NULL);
INSERT INTO `municipios` VALUES (2299, 30, '212', 'Santiago Sochiapan', 1, NULL);
INSERT INTO `municipios` VALUES (2300, 31, '001', 'Abalá', 1, NULL);
INSERT INTO `municipios` VALUES (2301, 31, '002', 'Acanceh', 1, NULL);
INSERT INTO `municipios` VALUES (2302, 31, '003', 'Akil', 1, NULL);
INSERT INTO `municipios` VALUES (2303, 31, '004', 'Baca', 1, NULL);
INSERT INTO `municipios` VALUES (2304, 31, '005', 'Bokobá', 1, NULL);
INSERT INTO `municipios` VALUES (2305, 31, '006', 'Buctzotz', 1, NULL);
INSERT INTO `municipios` VALUES (2306, 31, '007', 'Cacalchén', 1, NULL);
INSERT INTO `municipios` VALUES (2307, 31, '008', 'Calotmul', 1, NULL);
INSERT INTO `municipios` VALUES (2308, 31, '009', 'Cansahcab', 1, NULL);
INSERT INTO `municipios` VALUES (2309, 31, '010', 'Cantamayec', 1, NULL);
INSERT INTO `municipios` VALUES (2310, 31, '011', 'Celestún', 1, NULL);
INSERT INTO `municipios` VALUES (2311, 31, '012', 'Cenotillo', 1, NULL);
INSERT INTO `municipios` VALUES (2312, 31, '013', 'Conkal', 1, NULL);
INSERT INTO `municipios` VALUES (2313, 31, '014', 'Cuncunul', 1, NULL);
INSERT INTO `municipios` VALUES (2314, 31, '015', 'Cuzamá', 1, NULL);
INSERT INTO `municipios` VALUES (2315, 31, '016', 'Chacsinkín', 1, NULL);
INSERT INTO `municipios` VALUES (2316, 31, '017', 'Chankom', 1, NULL);
INSERT INTO `municipios` VALUES (2317, 31, '018', 'Chapab', 1, NULL);
INSERT INTO `municipios` VALUES (2318, 31, '019', 'Chemax', 1, NULL);
INSERT INTO `municipios` VALUES (2319, 31, '020', 'Chicxulub Pueblo', 1, NULL);
INSERT INTO `municipios` VALUES (2320, 31, '021', 'Chichimilá', 1, NULL);
INSERT INTO `municipios` VALUES (2321, 31, '022', 'Chikindzonot', 1, NULL);
INSERT INTO `municipios` VALUES (2322, 31, '023', 'Chocholá', 1, NULL);
INSERT INTO `municipios` VALUES (2323, 31, '024', 'Chumayel', 1, NULL);
INSERT INTO `municipios` VALUES (2324, 31, '025', 'Dzán', 1, NULL);
INSERT INTO `municipios` VALUES (2325, 31, '026', 'Dzemul', 1, NULL);
INSERT INTO `municipios` VALUES (2326, 31, '027', 'Dzidzantún', 1, NULL);
INSERT INTO `municipios` VALUES (2327, 31, '028', 'Dzilam de Bravo', 1, NULL);
INSERT INTO `municipios` VALUES (2328, 31, '029', 'Dzilam González', 1, NULL);
INSERT INTO `municipios` VALUES (2329, 31, '030', 'Dzitás', 1, NULL);
INSERT INTO `municipios` VALUES (2330, 31, '031', 'Dzoncauich', 1, NULL);
INSERT INTO `municipios` VALUES (2331, 31, '032', 'Espita', 1, NULL);
INSERT INTO `municipios` VALUES (2332, 31, '033', 'Halachó', 1, NULL);
INSERT INTO `municipios` VALUES (2333, 31, '034', 'Hocabá', 1, NULL);
INSERT INTO `municipios` VALUES (2334, 31, '035', 'Hoctún', 1, NULL);
INSERT INTO `municipios` VALUES (2335, 31, '036', 'Homún', 1, NULL);
INSERT INTO `municipios` VALUES (2336, 31, '037', 'Huhí', 1, NULL);
INSERT INTO `municipios` VALUES (2337, 31, '038', 'Hunucmá', 1, NULL);
INSERT INTO `municipios` VALUES (2338, 31, '039', 'Ixil', 1, NULL);
INSERT INTO `municipios` VALUES (2339, 31, '040', 'Izamal', 1, NULL);
INSERT INTO `municipios` VALUES (2340, 31, '041', 'Kanasín', 1, NULL);
INSERT INTO `municipios` VALUES (2341, 31, '042', 'Kantunil', 1, NULL);
INSERT INTO `municipios` VALUES (2342, 31, '043', 'Kaua', 1, NULL);
INSERT INTO `municipios` VALUES (2343, 31, '044', 'Kinchil', 1, NULL);
INSERT INTO `municipios` VALUES (2344, 31, '045', 'Kopomá', 1, NULL);
INSERT INTO `municipios` VALUES (2345, 31, '046', 'Mama', 1, NULL);
INSERT INTO `municipios` VALUES (2346, 31, '047', 'Maní', 1, NULL);
INSERT INTO `municipios` VALUES (2347, 31, '048', 'Maxcanú', 1, NULL);
INSERT INTO `municipios` VALUES (2348, 31, '049', 'Mayapán', 1, NULL);
INSERT INTO `municipios` VALUES (2349, 31, '050', 'Mérida', 1, NULL);
INSERT INTO `municipios` VALUES (2350, 31, '051', 'Mocochá', 1, NULL);
INSERT INTO `municipios` VALUES (2351, 31, '052', 'Motul', 1, NULL);
INSERT INTO `municipios` VALUES (2352, 31, '053', 'Muna', 1, NULL);
INSERT INTO `municipios` VALUES (2353, 31, '054', 'Muxupip', 1, NULL);
INSERT INTO `municipios` VALUES (2354, 31, '055', 'Opichén', 1, NULL);
INSERT INTO `municipios` VALUES (2355, 31, '056', 'Oxkutzcab', 1, NULL);
INSERT INTO `municipios` VALUES (2356, 31, '057', 'Panabá', 1, NULL);
INSERT INTO `municipios` VALUES (2357, 31, '058', 'Peto', 1, NULL);
INSERT INTO `municipios` VALUES (2358, 31, '059', 'Progreso', 1, NULL);
INSERT INTO `municipios` VALUES (2359, 31, '060', 'Quintana Roo', 1, NULL);
INSERT INTO `municipios` VALUES (2360, 31, '061', 'Río Lagartos', 1, NULL);
INSERT INTO `municipios` VALUES (2361, 31, '062', 'Sacalum', 1, NULL);
INSERT INTO `municipios` VALUES (2362, 31, '063', 'Samahil', 1, NULL);
INSERT INTO `municipios` VALUES (2363, 31, '064', 'Sanahcat', 1, NULL);
INSERT INTO `municipios` VALUES (2364, 31, '065', 'San Felipe', 1, NULL);
INSERT INTO `municipios` VALUES (2365, 31, '066', 'Santa Elena', 1, NULL);
INSERT INTO `municipios` VALUES (2366, 31, '067', 'Seyé', 1, NULL);
INSERT INTO `municipios` VALUES (2367, 31, '068', 'Sinanché', 1, NULL);
INSERT INTO `municipios` VALUES (2368, 31, '069', 'Sotuta', 1, NULL);
INSERT INTO `municipios` VALUES (2369, 31, '070', 'Sucilá', 1, NULL);
INSERT INTO `municipios` VALUES (2370, 31, '071', 'Sudzal', 1, NULL);
INSERT INTO `municipios` VALUES (2371, 31, '072', 'Suma', 1, NULL);
INSERT INTO `municipios` VALUES (2372, 31, '073', 'Tahdziú', 1, NULL);
INSERT INTO `municipios` VALUES (2373, 31, '074', 'Tahmek', 1, NULL);
INSERT INTO `municipios` VALUES (2374, 31, '075', 'Teabo', 1, NULL);
INSERT INTO `municipios` VALUES (2375, 31, '076', 'Tecoh', 1, NULL);
INSERT INTO `municipios` VALUES (2376, 31, '077', 'Tekal de Venegas', 1, NULL);
INSERT INTO `municipios` VALUES (2377, 31, '078', 'Tekantó', 1, NULL);
INSERT INTO `municipios` VALUES (2378, 31, '079', 'Tekax', 1, NULL);
INSERT INTO `municipios` VALUES (2379, 31, '080', 'Tekit', 1, NULL);
INSERT INTO `municipios` VALUES (2380, 31, '081', 'Tekom', 1, NULL);
INSERT INTO `municipios` VALUES (2381, 31, '082', 'Telchac Pueblo', 1, NULL);
INSERT INTO `municipios` VALUES (2382, 31, '083', 'Telchac Puerto', 1, NULL);
INSERT INTO `municipios` VALUES (2383, 31, '084', 'Temax', 1, NULL);
INSERT INTO `municipios` VALUES (2384, 31, '085', 'Temozón', 1, NULL);
INSERT INTO `municipios` VALUES (2385, 31, '086', 'Tepakán', 1, NULL);
INSERT INTO `municipios` VALUES (2386, 31, '087', 'Tetiz', 1, NULL);
INSERT INTO `municipios` VALUES (2387, 31, '088', 'Teya', 1, NULL);
INSERT INTO `municipios` VALUES (2388, 31, '089', 'Ticul', 1, NULL);
INSERT INTO `municipios` VALUES (2389, 31, '090', 'Timucuy', 1, NULL);
INSERT INTO `municipios` VALUES (2390, 31, '091', 'Tinum', 1, NULL);
INSERT INTO `municipios` VALUES (2391, 31, '092', 'Tixcacalcupul', 1, NULL);
INSERT INTO `municipios` VALUES (2392, 31, '093', 'Tixkokob', 1, NULL);
INSERT INTO `municipios` VALUES (2393, 31, '094', 'Tixmehuac', 1, NULL);
INSERT INTO `municipios` VALUES (2394, 31, '095', 'Tixpéhual', 1, NULL);
INSERT INTO `municipios` VALUES (2395, 31, '096', 'Tizimín', 1, NULL);
INSERT INTO `municipios` VALUES (2396, 31, '097', 'Tunkás', 1, NULL);
INSERT INTO `municipios` VALUES (2397, 31, '098', 'Tzucacab', 1, NULL);
INSERT INTO `municipios` VALUES (2398, 31, '099', 'Uayma', 1, NULL);
INSERT INTO `municipios` VALUES (2399, 31, '100', 'Ucú', 1, NULL);
INSERT INTO `municipios` VALUES (2400, 31, '101', 'Umán', 1, NULL);
INSERT INTO `municipios` VALUES (2401, 31, '102', 'Valladolid', 1, NULL);
INSERT INTO `municipios` VALUES (2402, 31, '103', 'Xocchel', 1, NULL);
INSERT INTO `municipios` VALUES (2403, 31, '104', 'Yaxcabá', 1, NULL);
INSERT INTO `municipios` VALUES (2404, 31, '105', 'Yaxkukul', 1, NULL);
INSERT INTO `municipios` VALUES (2405, 31, '106', 'Yobaín', 1, NULL);
INSERT INTO `municipios` VALUES (2406, 32, '001', 'Apozol', 1, NULL);
INSERT INTO `municipios` VALUES (2407, 32, '002', 'Apulco', 1, NULL);
INSERT INTO `municipios` VALUES (2408, 32, '003', 'Atolinga', 1, NULL);
INSERT INTO `municipios` VALUES (2409, 32, '004', 'Benito Juárez', 1, NULL);
INSERT INTO `municipios` VALUES (2410, 32, '005', 'Calera', 1, NULL);
INSERT INTO `municipios` VALUES (2411, 32, '006', 'Cañitas de Felipe Pescador', 1, NULL);
INSERT INTO `municipios` VALUES (2412, 32, '007', 'Concepción del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (2413, 32, '008', 'Cuauhtémoc', 1, NULL);
INSERT INTO `municipios` VALUES (2414, 32, '009', 'Chalchihuites', 1, NULL);
INSERT INTO `municipios` VALUES (2415, 32, '010', 'Fresnillo', 1, 1);
INSERT INTO `municipios` VALUES (2416, 32, '011', 'Trinidad García de la Cadena', 1, NULL);
INSERT INTO `municipios` VALUES (2417, 32, '012', 'Genaro Codina', 1, NULL);
INSERT INTO `municipios` VALUES (2418, 32, '013', 'General Enrique Estrada', 1, NULL);
INSERT INTO `municipios` VALUES (2419, 32, '014', 'General Francisco R. Murguía', 1, NULL);
INSERT INTO `municipios` VALUES (2420, 32, '015', 'El Plateado de Joaquín Amaro', 1, NULL);
INSERT INTO `municipios` VALUES (2421, 32, '016', 'General Pánfilo Natera', 1, NULL);
INSERT INTO `municipios` VALUES (2422, 32, '017', 'Guadalupe', 1, NULL);
INSERT INTO `municipios` VALUES (2423, 32, '018', 'Huanusco', 1, NULL);
INSERT INTO `municipios` VALUES (2424, 32, '019', 'Jalpa', 1, NULL);
INSERT INTO `municipios` VALUES (2425, 32, '020', 'Jerez', 1, 1);
INSERT INTO `municipios` VALUES (2426, 32, '021', 'Jiménez del Teul', 1, NULL);
INSERT INTO `municipios` VALUES (2427, 32, '022', 'Juan Aldama', 1, 1);
INSERT INTO `municipios` VALUES (2428, 32, '023', 'Juchipila', 1, NULL);
INSERT INTO `municipios` VALUES (2429, 32, '024', 'Loreto', 1, NULL);
INSERT INTO `municipios` VALUES (2430, 32, '025', 'Luis Moya', 1, NULL);
INSERT INTO `municipios` VALUES (2431, 32, '026', 'Mazapil', 1, NULL);
INSERT INTO `municipios` VALUES (2432, 32, '027', 'Melchor Ocampo', 1, NULL);
INSERT INTO `municipios` VALUES (2433, 32, '028', 'Mezquital del Oro', 1, NULL);
INSERT INTO `municipios` VALUES (2434, 32, '029', 'Miguel Auza', 1, NULL);
INSERT INTO `municipios` VALUES (2435, 32, '030', 'Momax', 1, NULL);
INSERT INTO `municipios` VALUES (2436, 32, '031', 'Monte Escobedo', 1, NULL);
INSERT INTO `municipios` VALUES (2437, 32, '032', 'Morelos', 1, NULL);
INSERT INTO `municipios` VALUES (2438, 32, '033', 'Moyahua de Estrada', 1, NULL);
INSERT INTO `municipios` VALUES (2439, 32, '034', 'Nochistlán de Mejía', 1, NULL);
INSERT INTO `municipios` VALUES (2440, 32, '035', 'Noria de Ángeles', 1, NULL);
INSERT INTO `municipios` VALUES (2441, 32, '036', 'Ojocaliente', 1, NULL);
INSERT INTO `municipios` VALUES (2442, 32, '037', 'Pánuco', 1, NULL);
INSERT INTO `municipios` VALUES (2443, 32, '038', 'Pinos', 1, NULL);
INSERT INTO `municipios` VALUES (2444, 32, '039', 'Río Grande', 1, 1);
INSERT INTO `municipios` VALUES (2445, 32, '040', 'Sain Alto', 1, NULL);
INSERT INTO `municipios` VALUES (2446, 32, '041', 'El Salvador', 1, NULL);
INSERT INTO `municipios` VALUES (2447, 32, '042', 'Sombrerete', 1, 1);
INSERT INTO `municipios` VALUES (2448, 32, '043', 'Susticacán', 1, NULL);
INSERT INTO `municipios` VALUES (2449, 32, '044', 'Tabasco', 1, NULL);
INSERT INTO `municipios` VALUES (2450, 32, '045', 'Tepechitlán', 1, NULL);
INSERT INTO `municipios` VALUES (2451, 32, '046', 'Tepetongo', 1, NULL);
INSERT INTO `municipios` VALUES (2452, 32, '047', 'Teúl de González Ortega', 1, NULL);
INSERT INTO `municipios` VALUES (2453, 32, '048', 'Tlaltenango de Sánchez Román', 1, 1);
INSERT INTO `municipios` VALUES (2454, 32, '049', 'Valparaíso', 1, NULL);
INSERT INTO `municipios` VALUES (2455, 32, '050', 'Vetagrande', 1, NULL);
INSERT INTO `municipios` VALUES (2456, 32, '051', 'Villa de Cos', 1, NULL);
INSERT INTO `municipios` VALUES (2457, 32, '052', 'Villa García', 1, NULL);
INSERT INTO `municipios` VALUES (2458, 32, '053', 'Villa González Ortega', 1, NULL);
INSERT INTO `municipios` VALUES (2459, 32, '054', 'Villa Hidalgo', 1, NULL);
INSERT INTO `municipios` VALUES (2460, 32, '055', 'Villanueva', 1, NULL);
INSERT INTO `municipios` VALUES (2461, 32, '056', 'Zacatecas', 1, 1);
INSERT INTO `municipios` VALUES (2462, 32, '057', 'Trancoso', 1, NULL);
INSERT INTO `municipios` VALUES (2463, 32, '058', 'Santa María de la Paz', 1, NULL);
COMMIT;

-- ----------------------------
-- Table structure for notapago
-- ----------------------------
DROP TABLE IF EXISTS `notapago`;
CREATE TABLE `notapago` (
  `idnotapago` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal` float(12,2) DEFAULT '0.00',
  `iva` float(12,2) DEFAULT '0.00',
  `total` float(12,2) DEFAULT '0.00',
  `comisiontotal` float(12,2) DEFAULT '0.00',
  `montomonedero` float(12,2) DEFAULT '0.00',
  `estatus` int(11) DEFAULT '0' COMMENT '0.-pendiente\n1.-aceptado\n2.-cancelado\n3.-completado',
  `idtipopago` int(11) DEFAULT '0',
  `tipopago` varchar(100) DEFAULT NULL,
  `confoto` varchar(45) DEFAULT NULL,
  `datostarjeta` text,
  `folio` varchar(255) DEFAULT NULL,
  `descuento` float(12,2) DEFAULT NULL,
  `descuentomembresia` float(12,2) DEFAULT NULL,
  `datostarjeta2` text,
  `montovisual` float(12,2) DEFAULT NULL,
  `cambio` float(12,2) DEFAULT NULL,
  `descripcionaceptacion` text,
  `comisionpornota` varchar(45) DEFAULT NULL,
  `tipocomisionpornota` varchar(45) DEFAULT NULL,
  `comisionnota` float(12,2) DEFAULT NULL,
  `requierefactura` int(11) DEFAULT NULL,
  `razonsocial` varchar(255) DEFAULT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `nointerior` varchar(45) DEFAULT NULL,
  `noexterior` varchar(45) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `codigopostal` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `asentamiento` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `formapago` varchar(45) DEFAULT NULL,
  `metodopago` varchar(45) DEFAULT NULL,
  `usocfdi` varchar(45) DEFAULT NULL,
  `imagenconstancia` varchar(45) DEFAULT NULL,
  `idusuariodatofiscal` varchar(45) DEFAULT NULL,
  `fechafactura` varchar(45) DEFAULT NULL,
  `facturanota` int(11) DEFAULT '0',
  `foliofactura` varchar(255) DEFAULT NULL,
  `fechaaceptacion` varchar(255) DEFAULT NULL,
  `idusuarioaceptacion` int(11) DEFAULT '0',
  `fechareporte` varchar(255) DEFAULT NULL,
  `fechacancelacion` varchar(255) DEFAULT NULL,
  `descripcioncancelacion` text,
  `canceladonota` int(11) DEFAULT '0',
  `idusuariocancelado` int(11) DEFAULT NULL,
  `idpagostripe` varchar(45) DEFAULT NULL,
  `completado` int(11) DEFAULT '0',
  `fechacompletado` varchar(45) DEFAULT NULL,
  `confirmaciontermino` int(11) DEFAULT '0',
  PRIMARY KEY (`idnotapago`),
  KEY `fk_notapago_usuarios1_idx` (`idusuario`),
  CONSTRAINT `fk_notapago_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notapago
-- ----------------------------
BEGIN;
INSERT INTO `notapago` VALUES (121, 97, '2023-05-03 13:46:21', 100.00, 0.00, 107.66, 7.66, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '030523458', 0.00, 0.00, '  ****4242  10/24', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-03 13:46:24', NULL, NULL, 0, NULL, '23', 0, NULL, 0);
INSERT INTO `notapago` VALUES (122, 97, '2023-05-13 10:25:12', 450.00, 0.00, 472.27, 22.27, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '130523459', 0.00, 0.00, '  ****4242  10/24', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-13 10:25:16', NULL, NULL, 0, NULL, '24', 0, NULL, 0);
INSERT INTO `notapago` VALUES (123, 97, '2023-05-13 10:46:53', 100.00, 0.00, 107.66, 7.66, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '130523460', 0.00, 0.00, '  ****4242  10/24', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-13 10:46:55', NULL, NULL, 0, NULL, '25', 0, NULL, 0);
INSERT INTO `notapago` VALUES (124, 99, '2023-05-14 14:59:54', 940.00, 0.00, 982.73, 42.73, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '140523461', 0.00, 0.00, '  ****4242  12/26', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-14 14:59:56', NULL, NULL, 0, NULL, '26', 0, NULL, 0);
INSERT INTO `notapago` VALUES (125, 99, '2023-05-14 15:01:52', 200.00, 0.00, 211.83, 11.83, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\" class=\"\">', '140523462', 0.00, 0.00, '  ****4242  12/26', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-14 15:01:54', NULL, NULL, 0, NULL, '27', 0, NULL, 0);
INSERT INTO `notapago` VALUES (126, 99, '2023-05-14 15:02:34', 1000.00, 0.00, 1045.24, 45.24, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '140523463', 0.00, 0.00, '  ****4242  12/26', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-14 15:02:36', NULL, NULL, 0, NULL, '28', 0, NULL, 0);
INSERT INTO `notapago` VALUES (127, 97, '2023-05-19 12:56:35', 100.00, 0.00, 107.66, 7.66, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"https://issoftware1.com.mx/IS-BARBER/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard0\">', '190523464', 0.00, 0.00, '  ****4242  10/24', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-05-19 12:56:38', NULL, NULL, 0, NULL, '29', 0, NULL, 0);
INSERT INTO `notapago` VALUES (128, 97, '2023-07-24 17:21:54', 100.00, 0.00, 107.66, 7.66, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"http://localhost:8888/is-barber/www/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard1\">', '240723465', 0.00, 0.00, '  ****4242  12/23', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-07-24 18:21:56', NULL, NULL, 0, NULL, '30', 0, NULL, 1);
INSERT INTO `notapago` VALUES (129, 97, '2023-07-26 10:57:06', 850.00, 0.00, 888.98, 38.98, 0.00, 1, 3, 'Tarjeta,', '0', '\n            <img src=\"http://localhost:8888/is-barber/www/assets/images/visa.png\" alt=\"card\" style=\"float:left;\" width=\"36\" height=\"32\"><span id=\"datostarjetaspan_opccard1\">', '260723466', 0.00, 0.00, '  ****4242  12/23', NULL, NULL, NULL, '0.00', '0', 0.00, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, 0, NULL, NULL, 0, '2023-07-26 11:57:09', NULL, NULL, 0, NULL, '31', 0, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for notapago_comprobante
-- ----------------------------
DROP TABLE IF EXISTS `notapago_comprobante`;
CREATE TABLE `notapago_comprobante` (
  `idnotapago_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `rutacomprobante` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT '0',
  `comentario` varchar(255) DEFAULT NULL,
  `idnotapago` int(11) NOT NULL,
  PRIMARY KEY (`idnotapago_comprobante`),
  KEY `fk_notapago_comprobante_notapago1_idx` (`idnotapago`),
  CONSTRAINT `fk_notapago_comprobante_notapago1` FOREIGN KEY (`idnotapago`) REFERENCES `notapago` (`idnotapago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notapago_descripcion
-- ----------------------------
DROP TABLE IF EXISTS `notapago_descripcion`;
CREATE TABLE `notapago_descripcion` (
  `idnotapago_descripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idnotapago` int(11) NOT NULL,
  `descripcion` text,
  `cantidad` varchar(45) DEFAULT NULL,
  `monto` varchar(45) DEFAULT NULL,
  `idpaquete` int(11) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idcita` int(11) DEFAULT '0',
  `tipo` int(11) DEFAULT '0' COMMENT '0.-producto,1.-servicio',
  `costounitario` float(12,2) DEFAULT '0.00',
  `entregado` int(11) DEFAULT '0',
  `estatus` int(11) DEFAULT '0',
  `fechaentregado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idnotapago_descripcion`),
  KEY `fk_notapago_descripcion_notapago1_idx` (`idnotapago`),
  CONSTRAINT `fk_notapago_descripcion_notapago1` FOREIGN KEY (`idnotapago`) REFERENCES `notapago` (`idnotapago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notapago_descripcion
-- ----------------------------
BEGIN;
INSERT INTO `notapago_descripcion` VALUES (62, 121, 'Corte de cabello', '1', '100.00', 69, '2023-05-03 13:46:24', 47, 1, 100.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (63, 122, 'Corte de barba', '1', '250.00', 80, '2023-05-13 10:25:16', 48, 1, 250.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (64, 122, 'Corte de barba', '1', '200.00', 80, '2023-05-13 10:25:16', 49, 1, 200.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (65, 123, 'Corte de cabello', '1', '100.00', 69, '2023-05-13 10:46:55', 50, 1, 100.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (66, 124, 'Corte de barba', '1', '200.00', 80, '2023-05-14 14:59:56', 51, 1, 200.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (67, 124, 'THE GOOD GUYS VERDE STRONG', '2', '640.00', 13, '2023-05-14 14:59:56', 0, 0, 320.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (68, 124, 'Corte de cabello', '1', '100.00', 69, '2023-05-14 14:59:56', 52, 1, 100.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (69, 125, 'Corte de cabello', '1', '200.00', 69, '2023-05-14 15:01:54', 53, 1, 200.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (70, 126, 'FERNANDO DE CASTILLA', '2', '1000.00', 49, '2023-05-14 15:02:36', 0, 0, 500.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (71, 127, 'Corte de cabello', '1', '100.00', 69, '2023-05-19 12:56:38', 54, 1, 100.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (72, 128, 'Corte de cabello', '1', '100.00', 69, '2023-07-24 17:21:56', 55, 1, 100.00, 0, 0, NULL);
INSERT INTO `notapago_descripcion` VALUES (73, 129, 'SHAMPOO FORTIFICANTE INSIGHT LOSS CONTROL', '1', '850.00', 8, '2023-07-26 10:57:09', 0, 0, 850.00, 0, 0, NULL);
COMMIT;

-- ----------------------------
-- Table structure for notificacion
-- ----------------------------
DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE `notificacion` (
  `idnotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `mensaje` text,
  `programado` int(11) DEFAULT '0' COMMENT '0-Ahora\n1-programado',
  `fechahora` varchar(255) DEFAULT NULL,
  `seleccionar` int(11) DEFAULT '0' COMMENT '1 clientes\n2 usuarios\n3 clientes/usuarios',
  `todosclientes` int(11) DEFAULT '0',
  `todosadmin` int(11) DEFAULT '0' COMMENT '0 -a todos\n1-a algunos en particular',
  `estatus` int(11) DEFAULT '0' COMMENT '0-activado\n1-desactivado',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enviado` int(11) DEFAULT '0',
  PRIMARY KEY (`idnotificacion`),
  UNIQUE KEY `fechacreacion_UNIQUE` (`fechacreacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notificacionadmin
-- ----------------------------
DROP TABLE IF EXISTS `notificacionadmin`;
CREATE TABLE `notificacionadmin` (
  `idnotificacionadmin` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idnotificacionadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notificacioncliente
-- ----------------------------
DROP TABLE IF EXISTS `notificacioncliente`;
CREATE TABLE `notificacioncliente` (
  `idnotificacioncliente` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL COMMENT '	',
  `ruta` varchar(255) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idnotificacioncliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notificacionescliente
-- ----------------------------
DROP TABLE IF EXISTS `notificacionescliente`;
CREATE TABLE `notificacionescliente` (
  `idnotificacioncliente` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `idnotificacion` int(11) NOT NULL,
  PRIMARY KEY (`idnotificacioncliente`),
  KEY `fk_notificacionescliente_notificaciones1_idx` (`idnotificacion`),
  CONSTRAINT `fk_notificacionescliente_notificaciones1` FOREIGN KEY (`idnotificacion`) REFERENCES `notificacion` (`idnotificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notificacionesusuario
-- ----------------------------
DROP TABLE IF EXISTS `notificacionesusuario`;
CREATE TABLE `notificacionesusuario` (
  `idnotificacionusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `idnotificacion` int(11) NOT NULL,
  PRIMARY KEY (`idnotificacionusuario`),
  KEY `fk_notificacionadmin_notificacion1_idx` (`idnotificacion`),
  CONSTRAINT `fk_notificacionadmin_notificacion1` FOREIGN KEY (`idnotificacion`) REFERENCES `notificacion` (`idnotificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pagina_configuracion
-- ----------------------------
DROP TABLE IF EXISTS `pagina_configuracion`;
CREATE TABLE `pagina_configuracion` (
  `idpagina_configuracion` int(11) NOT NULL AUTO_INCREMENT,
  `telefono` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono01800` varchar(45) DEFAULT NULL,
  `cel` varchar(45) DEFAULT NULL,
  `cel1` varchar(45) DEFAULT NULL,
  `emailsoporte` varchar(45) DEFAULT NULL,
  `emailpedidos` varchar(45) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `rss` varchar(250) DEFAULT NULL,
  `delicious` varchar(250) DEFAULT NULL,
  `linkedin` varchar(250) DEFAULT NULL,
  `flickr` varchar(250) DEFAULT NULL,
  `skype` varchar(45) DEFAULT NULL,
  `instagram` varchar(250) DEFAULT NULL,
  `whatsapp` varchar(45) DEFAULT NULL,
  `whatsapp2` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `googlemap` text,
  `rutarecuperarpass` text,
  `setPublicKey` varchar(45) DEFAULT NULL,
  `setApikey` varchar(45) DEFAULT NULL,
  `pagotarjeta` int(11) DEFAULT NULL,
  `pagooxxopay` int(11) DEFAULT NULL,
  `pagollamada` int(11) DEFAULT '0',
  `pagospei` int(11) DEFAULT '0',
  `nombrenegocio` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `puertoenvio` varchar(255) DEFAULT NULL,
  `nombreusuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `remitente` varchar(255) DEFAULT NULL,
  `remitente_nombre` varchar(255) DEFAULT NULL,
  `r_autenticacion` varchar(255) DEFAULT 'true' COMMENT 'True \nFalse\n',
  `r_ssl` varchar(255) DEFAULT 'ssl' COMMENT 'ssl\ntls\n',
  `habilitartienda` int(11) DEFAULT '1',
  `bienvenida` text,
  `montominimo` float(10,2) DEFAULT NULL COMMENT 'COLOCAMOS LA CANTIDAD MIMINA EN PESOS PARA NO COBRAR \nEL ENVIO EL PEDIDO\n',
  `costoenvio` float(10,2) DEFAULT NULL,
  `dias_vencimiento` int(11) DEFAULT '1' COMMENT 'Campos servirá como bandera de los días para poder pagar servicios en la pagina.',
  `habilitarimgfondo` int(11) DEFAULT NULL,
  `habilitarimgproducto` int(11) DEFAULT NULL,
  `habilitartitulo` int(11) DEFAULT NULL,
  `habilitardescripcion` int(11) DEFAULT NULL,
  `tituloboton` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `colorletra` varchar(45) DEFAULT NULL,
  `colorboton` varchar(45) DEFAULT NULL,
  `habilitarboton` int(11) DEFAULT NULL,
  `nombrenegocio1` varchar(255) DEFAULT NULL,
  `logoreporte` varchar(255) DEFAULT NULL,
  `nombrenegocio2` varchar(45) DEFAULT NULL,
  `versionapp` varchar(45) DEFAULT NULL,
  `pedirdireccionregistro` int(11) DEFAULT '1' COMMENT '0-inactivo-1-activo',
  `claveapigeolocalizacion` varchar(255) DEFAULT NULL,
  `apikeyadmin` varchar(255) DEFAULT NULL,
  `iosmarket` varchar(255) DEFAULT NULL,
  `androidmarket` varchar(255) DEFAULT NULL,
  `textodescarga` text,
  `versionappios` varchar(45) DEFAULT NULL,
  `versionadminandroid` varchar(45) DEFAULT NULL,
  `versionadminios` varchar(45) DEFAULT NULL,
  `rutaadminios` varchar(255) DEFAULT NULL,
  `rutaadminandroid` varchar(255) DEFAULT NULL,
  `textoversionadmin` text,
  `clavetokennotificacion` text,
  `clavetokenadministrador` text,
  `texto1` varchar(255) DEFAULT NULL,
  `mostraranuncios` int(11) DEFAULT '0' COMMENT '0.-no muestra anuncios\n1.- muestra anuncios',
  `activaromitirfinal` int(11) DEFAULT '0',
  `ediciondedatoscliente` int(11) DEFAULT '0' COMMENT '0.- se puede editar\n1.- no se puede editar',
  `intentostarjeta` int(11) DEFAULT NULL,
  `pedirverificaciontelefono` int(11) DEFAULT '0' COMMENT '0.-no pide verificación\n1.- pide verificación',
  `validarversionios` int(11) DEFAULT '1',
  `validarversionandroid` int(11) DEFAULT '1',
  `splasimgprincipal` varchar(255) DEFAULT NULL,
  `habilitarmonedero` int(11) DEFAULT '0',
  `habilitarcupon` int(11) DEFAULT '0',
  `contadorfolio` int(11) DEFAULT '0',
  `activarpopupmembresia` int(11) DEFAULT '0',
  `intervalohorarios` varchar(45) DEFAULT NULL,
  `avatarhombre` varchar(45) DEFAULT NULL,
  `avatarmujer` varchar(45) DEFAULT NULL,
  `politicaprivacidad` text,
  `contadorfoliopago` int(11) DEFAULT NULL,
  `iva` float(12,2) DEFAULT NULL,
  `mensajesoporte` text,
  `telefonosoporte` varchar(45) DEFAULT NULL,
  `botonayuda` int(11) DEFAULT NULL,
  `terminoscondiciones` text,
  `tiempodecancelacion` varchar(45) DEFAULT NULL COMMENT 'Tiempo en minutos',
  `habilitardevolucionmonedero` int(11) DEFAULT '0',
  PRIMARY KEY (`idpagina_configuracion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagina_configuracion
-- ----------------------------
BEGIN;
INSERT INTO `pagina_configuracion` VALUES (1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'logo.jpg', '', '/recuperar.php', 'key_BzYcpsfFVKezDpyyyxxtjcQ', 'key_LU4kYTcsHztbMyK5cH5xFQ', 1, 1, 0, 1, '', 'smtpout.secureserver.net', '587', 'correo@is-u-order.com.mx', 'is-software', 'correo@is-u-order.com.mx', 'Woolis', 'true', 'tls', 0, '<h2 style=\"text-align:center\"><span style=\"color:#e67e22\">Bienvenido a Tecnua</span></h2>\r\n\r\n<p>Somos una empresa 100 % mexicana, preocupada por la salud y el bienestar de nuestros consumidores, mucho m&aacute;s all&aacute; de la nutrici&oacute;n b&aacute;sica.<br />\r\n<br />\r\nTenemos los mejores productos para toda la familia, con el mejor sabor a un precio competitivo.</p>', 350.00, 30.00, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Grupo inversa', '', 'Grupo inversa', '1.0.23', 0, 'AIzaSyAzK22hMENl-zhFKyDd5TW7aO5cWHJGQ1Q', NULL, 'https://apps.apple.com/us/app/woolis/id1644721526', 'https://play.google.com/store/apps/details?id=com.woolis.app', '¡Hay una nueva versión de tu APP!\n', '1.0.23', '1.1.8', '1.1.8', '', '', '¡Hay una nueva versión de tu APP favorita!\n', 'AAAAaWlau64:APA91bGYjpmrXrNETubVwPNOyUB0fYdUHIHlI98hM2CKm9cb-1G_gJsLFtMH1jM5cS2GNGTqk4zEru_pfxZUaOt0KmaAlWmnUovr3n1oZghjjueVMwEBah5oR-KdzgpJ-_CVzePMpJlu', 'AAAAXK-GUvQ:APA91bGkGKIKJtDPriKumepreO21ycvwkmuNdsE_89VgbggDoBHaBlCb-2HA4i4rRD_9PFcS19cg9qPL7IP0F8rbbEVW9Ca9ooSfApT3T24u8yUSchyT1hoh4XMC88hlP7xJUR5mZGF0', 'configurar', 1, 1, 1, 3, 0, 1, 1, 'inicio.png', 0, 0, 467, 0, '60', 'F.png', 'E.png', '\nServicios del Sureste Yaxlum, S.A. de C.V. y/o INNOVATIVE SOFTWARE SERVICES S.A. de C.V., con domicilio en CALLE 9ª. PONIENTE NORTE Nº 437 BIS N, COL. CENTRO, C.P. 29000, TUXTLA GUTIÉRREZ, CHIAPAS, MÉXICO, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección.\n\nSu información personal será utilizada para proveer los servicios y productos que ha solicitado, informarle sobre cambios en los mismos y evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: nombre completo con apellido paterno y apellido materno, número telefónico y número celular, código postal, país, estado, municipio, Direccion completa (Avenida, calle o Boulevard; número exterior, número interior, colonia, referencia, imagen INE (aplica solo para Mexico), correo electrónico y datos fiscales para facturación en México (domicilio fiscal completa, RFC y razón social); y, considerado como sensible según la Ley Federal de Protección de Datos Personales en Posesión de los Particulares: el género y la edad. Nos comprometemos a que los mismos serán tratados bajo las más estrictas medidas de seguridad que garanticen su confidencialidad.\n\nUsted tiene derecho a acceder, rectificar y cancelar sus datos personales, así como de oponerse al tratamiento de estos o revocar el consentimiento que para tal fin nos haya otorgado, a través de los procedimientos que hemos implementado. Para conocer los requisitos y plazos, se puede poner en contacto con nuestro departamento de datos personales con Jonathan de Jesús Cruz Moguel con domicilio en calle 9ª. poniente norte nº 437 bis n, Col. Centro, C.P. 29000, Tuxtla Gutiérrez, Chiapas, México; con teléfono (999) 543 3125 y correo electrónico correo@is-software.com.mx o visitar nuestra página de Internet https://issoftware.com.mx/avisoprivacidad.php \n\nAsimismo, le informamos que sus datos personales no pueden ser transferidos y tratados dentro y fuera del país, por personas distintas a esta empresa; y si usted desea dejar de recibir mensajes promocionales de nuestra parte puede solicitarlo contactándonos por escrito al correo electrónico correo@is-software.com.mx o vía telefónica a los números (55) 2256 2061.\n\nEn todo momento, usted podrá revocar el consentimiento que nos ha otorgado para el tratamiento de sus datos personales, a fin de que dejemos de hacer uso de estos. Para ello es necesario que presente su petición por escrito al correo electrónico correo@is-software.com.mx, su petición deberá ir acompañada de su nombre completo con apellidos, número telefónico de contacto, correo electrónico y software referenciado. En un plazo máximo de 15 días atenderemos su petición y le informaremos sobre la procedencia de la misma.\n\nCualquier modificación a este aviso de privacidad podrá consultarla en nuestra página de Internet https://issoftware.com.mx/avisoprivacidad.php\n', 4, 16.00, '¿Necesitas ayuda?\n¿Deseas conectarte vía whatsap con nosotros?', '529617733821', 1, NULL, NULL, 0);
COMMIT;

-- ----------------------------
-- Table structure for pagos
-- ----------------------------
DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idservicio` int(11) DEFAULT '0',
  `idmembresia` int(11) DEFAULT '0',
  `tipo` int(11) DEFAULT NULL COMMENT '1.-servicio\n2.-membresia',
  `monto` float(12,2) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL COMMENT '0.-inactivo\n1.-activo',
  `fechapago` varchar(255) DEFAULT NULL,
  `tarjeta` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pagado` int(11) DEFAULT NULL COMMENT '0.-no pagado\n1.-pagado',
  `validadoporusuario` int(11) DEFAULT NULL COMMENT '0.-no validado\n1.- validado',
  `digitostarjeta` varchar(45) DEFAULT NULL,
  `tipopago` int(11) DEFAULT NULL COMMENT '1.-tarjeta\n2.-efectivo',
  `fechaevento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pagostripe
-- ----------------------------
DROP TABLE IF EXISTS `pagostripe`;
CREATE TABLE `pagostripe` (
  `idpagostripe` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaccion` varchar(255) DEFAULT NULL,
  `idnotaremision` varchar(255) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `digitostarjeta` varchar(45) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `fechatransaccion` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(11) DEFAULT NULL COMMENT '1.-pagomembresia\n2.-pago servicio',
  `id` int(11) DEFAULT NULL,
  `comision` varchar(45) DEFAULT NULL,
  `comisiontotal` varchar(45) DEFAULT NULL,
  `comisionmonto` varchar(45) DEFAULT NULL,
  `impuestototal` varchar(45) DEFAULT NULL,
  `subtotalsincomision` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `impuesto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpagostripe`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagostripe
-- ----------------------------
BEGIN;
INSERT INTO `pagostripe` VALUES (7, 'pi_3Mg9ebHfhZt076lu1Cb9m2IQ', NULL, 13057, 'pm_1Mf5stHfhZt076luxcmejPJ7', 7, 'succeeded', '1677515661', '2023-02-27 10:34:20', NULL, NULL, '7.392', '8.574720000000001', '3.00', '1.18272', '122.00', '130.57', '16.00');
INSERT INTO `pagostripe` VALUES (8, 'pi_3Mg9h6HfhZt076lu0aCth1LC', NULL, 26392, 'pm_1Mf5stHfhZt076luxcmejPJ7', 7, 'succeeded', '1677515816', '2023-02-27 10:36:55', NULL, NULL, '12.000000000000002', '13.920000000000002', '3.00', '1.9200000000000004', '250.00', '263.92', '16.00');
INSERT INTO `pagostripe` VALUES (9, 'pi_3MgEL7HfhZt076lu0SqYpYs6', NULL, 23475, 'pm_1Mf5stHfhZt076luxcmejPJ7', 7, 'succeeded', '1677533673', '2023-02-27 15:34:32', NULL, NULL, '10.992', '12.750720000000001', '3.00', '1.7587200000000003', '222.00', '234.75', '16.00');
INSERT INTO `pagostripe` VALUES (10, 'pi_3MgaYCHfhZt076lu1pPQBuxP', NULL, 23475, 'pm_1MgaWuHfhZt076lucGKh3j7h', 14, 'succeeded', '1677619052', '2023-02-28 15:17:31', NULL, NULL, '10.992', '12.750720000000001', '3.00', '1.7587200000000003', '222.00', '234.75', '16.00');
INSERT INTO `pagostripe` VALUES (11, 'pi_3MgbteHfhZt076lu1oM4eD7M', NULL, 21183, 'pm_1MgbtUHfhZt076lueF2UWLe1', 15, 'succeeded', '1677624226', '2023-02-28 16:43:44', NULL, NULL, '10.200000000000001', '11.832', '3.00', '1.6320000000000001', '200.00', '211.83', '16.00');
INSERT INTO `pagostripe` VALUES (12, 'pi_3MjVzrHfhZt076lu0TmkQfqF', NULL, 92856, 'pm_1MjVzjHfhZt076luVbrUYQta', 16, 'succeeded', '1678316531', '2023-03-08 17:02:10', NULL, NULL, '34.968', '40.56288000000001', '3.00', '5.594880000000001', '888.00', '928.56', '16.00');
INSERT INTO `pagostripe` VALUES (13, '', NULL, 556, '', 15, '', '', '2023-03-09 11:41:17', NULL, NULL, '3.072', '3.56352', '3.00', '0.49152', '2.00', '5.56', '16.00');
INSERT INTO `pagostripe` VALUES (14, 'pi_3MwAUBHfhZt076lu1mek2i5w', NULL, 61603, 'pm_1MwATnHfhZt076lu4aNkXZHA', 38, 'succeeded', '1681332107', '2023-04-12 14:41:45', NULL, NULL, '24.168000000000003', '28.034880000000005', '3.00', '3.8668800000000005', '588.00', '616.03', '16.00');
INSERT INTO `pagostripe` VALUES (15, 'pi_3MwZRmHfhZt076lu0qQZ27o5', NULL, 392050, 'pm_1MwZQYHfhZt076luh1x00GFi', 56, 'succeeded', '1681428058', '2023-04-13 17:20:53', NULL, NULL, '138.36', '160.4976', '3.00', '22.137600000000003', '3760.00', '3920.50', '16.00');
INSERT INTO `pagostripe` VALUES (16, 'pi_3MwaLJHfhZt076lu0Rjl5OMm', NULL, 10766, 'pm_1MwZQYHfhZt076luh1x00GFi', 56, 'succeeded', '1681431501', '2023-04-13 18:18:20', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (17, 'pi_3MwbAQHfhZt076lu0tqaBJVP', NULL, 10766, 'pm_1MwZQYHfhZt076luh1x00GFi', 56, 'succeeded', '1681434670', '2023-04-13 19:11:09', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (18, 'pi_3MwqONHfhZt076lu16vIDrSp', NULL, 10766, 'pm_1MwqOGHfhZt076luJJkV7FZ6', 62, 'succeeded', '1681493195', '2023-04-14 11:26:34', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (19, 'pi_3MwqP1HfhZt076lu1okglexw', NULL, 10766, 'pm_1MwqOpHfhZt076luopvYRYsZ', 63, 'succeeded', '1681493235', '2023-04-14 11:27:14', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (20, 'pi_3N1uw8HfhZt076lu108qWiFJ', NULL, 153487, 'pm_1N1uvfHfhZt076ludDcRCdTs', 84, 'succeeded', '1682702304', '2023-04-28 11:18:23', NULL, NULL, '55.92000000000001', '64.86720000000001', '3.00', '8.947200000000002', '1470.00', '1534.87', '16.00');
INSERT INTO `pagostripe` VALUES (21, 'pi_3N3RBKHfhZt076lu04xHkUwJ', NULL, 10766, 'pm_1N3RB9HfhZt076lugPkmb6ZV', 3, 'succeeded', '1683064582', '2023-05-02 15:56:20', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (22, 'pi_3N3RSoHfhZt076lu0ptbm9ZG', NULL, 10766, 'pm_1N3ROVHfhZt076ludG2hWVMe', 94, 'succeeded', '1683065666', '2023-05-02 16:14:19', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (23, 'pi_3N3ld4HfhZt076lu0Yybpy8r', NULL, 10766, 'pm_1N3lctHfhZt076luJ2qW7wId', 97, 'succeeded', '1683143182', '2023-05-03 13:46:21', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (24, 'pi_3N7LFvHfhZt076lu1krnXLIY', NULL, 47227, 'pm_1N3lctHfhZt076luJ2qW7wId', 97, 'succeeded', '1683995115', '2023-05-13 10:25:12', NULL, NULL, '19.200000000000003', '22.272000000000002', '3.00', '3.0720000000000005', '450.00', '472.27', '16.00');
INSERT INTO `pagostripe` VALUES (25, 'pi_3N7LasHfhZt076lu1qwgje4C', NULL, 10766, 'pm_1N3lctHfhZt076luJ2qW7wId', 97, 'succeeded', '1683996414', '2023-05-13 10:46:53', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (26, 'pi_3N7m1HHfhZt076lu0dTjsj6Z', NULL, 98273, 'pm_1N7m18HfhZt076luBNT536fx', 99, 'succeeded', '1684097995', '2023-05-14 14:59:54', NULL, NULL, '36.84', '42.73440000000001', '3.00', '5.894400000000001', '940.00', '982.73', '16.00');
INSERT INTO `pagostripe` VALUES (27, 'pi_3N7m3BHfhZt076lu0yETfshv', NULL, 21183, 'pm_1N7m18HfhZt076luBNT536fx', 99, 'succeeded', '1684098113', '2023-05-14 15:01:52', NULL, NULL, '10.200000000000001', '11.832', '3.00', '1.6320000000000001', '200.00', '211.83', '16.00');
INSERT INTO `pagostripe` VALUES (28, 'pi_3N7m3rHfhZt076lu017fzVRT', NULL, 104524, 'pm_1N7m18HfhZt076luBNT536fx', 99, 'succeeded', '1684098155', '2023-05-14 15:02:34', NULL, NULL, '39.00000000000001', '45.24000000000001', '3.00', '6.240000000000001', '1000.00', '1045.24', '16.00');
INSERT INTO `pagostripe` VALUES (29, 'pi_3N9YThHfhZt076lu1O6Jv9Yp', NULL, 10766, 'pm_1N3lctHfhZt076luJ2qW7wId', 97, 'succeeded', '1684522597', '2023-05-19 12:56:35', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (30, 'pi_3NXY4dHfhZt076lu1q91iRlT', NULL, 10766, 'pm_1NW2LUHfhZt076lu8mdq8QeB', 97, 'succeeded', '1690240915', '2023-07-24 17:21:54', NULL, NULL, '6.6000000000000005', '7.656000000000001', '3.00', '1.056', '100.00', '107.66', '16.00');
INSERT INTO `pagostripe` VALUES (31, 'pi_3NYB1LHfhZt076lu1GqPoN8c', NULL, 88898, 'pm_1NW2LUHfhZt076lu8mdq8QeB', 97, 'succeeded', '1690390627', '2023-07-26 10:57:06', NULL, NULL, '33.60000000000001', '38.97600000000001', '3.00', '5.376000000000001', '850.00', '888.98', '16.00');
COMMIT;

-- ----------------------------
-- Table structure for pais
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(45) NOT NULL,
  PRIMARY KEY (`idpais`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pais
-- ----------------------------
BEGIN;
INSERT INTO `pais` VALUES (1, 'MEXICO');
COMMIT;

-- ----------------------------
-- Table structure for paquetefavorito
-- ----------------------------
DROP TABLE IF EXISTS `paquetefavorito`;
CREATE TABLE `paquetefavorito` (
  `idpaquetefavorito` int(11) NOT NULL AUTO_INCREMENT,
  `idpaquete` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idpaquetefavorito`),
  KEY `fk_paquetefavorito_paquetes1_idx` (`idpaquete`),
  KEY `fk_paquetefavorito_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_paquetefavorito_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquetefavorito_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for paquetes
-- ----------------------------
DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE `paquetes` (
  `idpaquete` int(11) NOT NULL AUTO_INCREMENT,
  `nombrepaquete` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `idcategorias` int(11) DEFAULT NULL,
  `promocion` int(11) DEFAULT NULL,
  `fechainicial` varchar(45) DEFAULT NULL,
  `fechafinal` varchar(45) DEFAULT NULL,
  `aplicardirecto` int(11) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `considerar` varchar(45) DEFAULT NULL,
  `definirfecha` int(11) DEFAULT NULL,
  `servicio` int(11) DEFAULT NULL,
  `lunes` int(11) DEFAULT NULL,
  `martes` int(11) DEFAULT NULL,
  `miercoles` int(11) DEFAULT NULL,
  `jueves` int(11) DEFAULT NULL,
  `viernes` int(11) DEFAULT NULL,
  `sabado` int(11) DEFAULT NULL,
  `domingo` int(11) DEFAULT NULL,
  `repetitivo` int(11) DEFAULT NULL,
  `preciofijo` float(12,2) DEFAULT NULL,
  `horainicialpromo` varchar(45) DEFAULT NULL,
  `horafinalpromo` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `activarcomentario` int(11) DEFAULT NULL,
  `mensaje` varchar(45) DEFAULT NULL,
  `siniva` int(11) DEFAULT NULL,
  `iva` varchar(45) DEFAULT NULL,
  `solomostrador` int(11) DEFAULT NULL,
  `visualizarcarrusel` int(11) DEFAULT NULL,
  `intervaloservicio` varchar(45) DEFAULT NULL,
  `idcategoriapaquete` int(11) DEFAULT '0',
  `habilitarcancelacion` int(11) DEFAULT NULL,
  `limitecancelacion` varchar(45) DEFAULT NULL COMMENT 'Tiempo en minutos',
  PRIMARY KEY (`idpaquete`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paquetes
-- ----------------------------
BEGIN;
INSERT INTO `paquetes` VALUES (1, 'INSIGHT EXFOLIANTE CAPILAR', 'INSIGHT EXFOLIANTE CAPILAR', 'INSIGHT-EXFOLIANTE-CAPILAR.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (2, 'DAVINES SOLU SHAMPOO', 'DAVINES SOLU SHAMPOO', 'DAVINES-SOLU-SHAMPOO.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (3, 'DAVINES REBALANCING SHAMPOO', 'DAVINES REBALANCING SHAMPOO', 'DAVINES-REBALANCING-SHAMPOO.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (4, 'DAVINES PURIFYING SHAMPOO', 'DAVINES PURIFYING SHAMPOO', 'DAVINES-PURIFYING-SHAMPOO.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (5, 'TEC ITALY SHAMPOO LUMINA SILVER', 'TEC ITALY SHAMPOO LUMINA SILVER', 'TEC-ITALY-SHAMPOO-LUMINA-SILVER.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (6, 'TEC ITALY SHAMPOO LIMPIEZA PROFUNDA', 'TEC ITALY SHAMPOO LIMPIEZA PROFUNDA', 'TEC-ITALY-SHAMPOO-LIMPIEZA-PROFUNDA.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (7, 'TEC ITALY SHAMPOO GELLINI', 'TEC ITALY SHAMPOO GELLINI', 'TEC-ITALY-SHAMPOO-GELLINI.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (8, 'SHAMPOO FORTIFICANTE INSIGHT LOSS CONTROL', 'SHAMPOO FORTIFICANTE INSIGHT LOSS CONTROL', 'SHAMPOO-FORTIFICANTE-INSIGHT-LOSS-CONTROL.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (9, 'SHAMPOO CON MINOXIDIL IN BELLEZA', 'SHAMPOO CON MINOXIDIL IN BELLEZA', 'SHAMPOO-CON-MINOXIDIL-IN-BELLEZA.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 4, NULL, NULL);
INSERT INTO `paquetes` VALUES (10, 'DEL INDIO PAPAGO JABON DE BERGAMOTA', 'DEL INDIO PAPAGO JABON DE BERGAMOTA', 'DEL-INDIO-PAPAGO-JABON-DE-BERGAMOTA.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 6, NULL, NULL);
INSERT INTO `paquetes` VALUES (11, 'THE GOOD GUYS ROJA ORIGINAL', 'THE GOOD GUYS ROJA ORIGINAL', 'THE-GOOD-GUYS-ROJA-ORIGINAL.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (12, 'THE GOOD GUYS AMARILLA TEXTURE', 'THE GOOD GUYS AMARILLA TEXTURE', 'THE-GOOD-GUYS-AMARILLA-TEXTURE.png', 1, 1, 0, NULL, NULL, 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (13, 'THE GOOD GUYS VERDE STRONG', 'THE GOOD GUYS VERDE STRONG', 'THE-GOOD-GUYS-VERDE-STRONG.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (14, 'NEW WELL XTRA AQUA', 'NEW WELL XTRA AQUA', 'New.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (15, 'NEW WELL STRONG', 'NEW WELL STRONG', 'NEW-WELL-STRONG.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (16, 'NEW WELL GUM MASTIC', 'NEW WELL GUM MASTIC', 'NEW-WELL-GUM-MASTIC.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (17, 'TEC ITALY HI-MOSTURIZING MASCARILLA CAPILAR', 'TEC ITALY HI-MOSTURIZING MASCARILLA CAPILAR', 'TEC-ITALY-HI-MOSTURIZING.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (18, 'TEC ITALY CERA GEL EFECTO HÚMEDO', 'TEC ITALY CERA GEL EFECTO HÚMEDO', 'TEC-ITALY-CERA-GEL-EFECTO-HuMEDO.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (19, 'RED ONE ROJA', 'RED ONE ROJA', 'RED-ONE-ROJA.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (20, 'RED ONE BLANCA', 'RED ONE BLANCA', 'RED-ONE-BLANCA.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (21, 'RED ONE NEGRA', 'RED ONE NEGRA', NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (22, 'ELEGANCE TRIPLE ACTION', 'ELEGANCE TRIPLE ACTION', 'ELEGANCE-TRIPLE-ACTION.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (23, 'HAIR STYLING POWDER', 'HAIR STYLING POWDER', 'HAIR-STYLING-POWDER.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (24, 'NISHMAN HAIR STYLING WAX FLAMING', 'NISHMAN HAIR STYLING WAX FLAMING', 'NISHMAN-HAIR-STYLING-WAX-FLAMING.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (25, 'NISHMAN HAIR STYLING GEL WAX GUM GUM', 'NISHMAN HAIR STYLING GEL WAX GUM GUM', 'NISHMAN-HAIR-STYLING-GEL-WAX-GUM-GUM.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (26, 'NISHMAN HAIR STYLING WAX KERATIN', 'NISHMAN HAIR STYLING WAX KERATIN', 'NISHMAN-HAIR-STYLING-WAX-KERATIN.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (27, 'NISHMAN HAIR STYLING WAX RUGBY', 'NISHMAN HAIR STYLING WAX RUGBY', 'NISHMAN-HAIR-STYLING-WAX-RUGBY.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (28, 'NISHMAN HAIR STYLING GEL WAX COLA', 'NISHMAN HAIR STYLING GEL WAX COLA', 'NISHMAN-HAIR-STYLING-GEL-WAX-COLA.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (29, 'FUSSION', 'FUSSION', 'FUSSION.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (30, 'INSIGHT EXFOLIANTE CAPILAR', 'INSIGHT EXFOLIANTE CAPILAR', 'INSIGHT-EXFOLIANTE-CAPILAR.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL);
INSERT INTO `paquetes` VALUES (31, 'REGROWE BALSAMO PARA BARBA FORTIFICADO', 'REGROWE BALSAMO PARA BARBA FORTIFICADO', 'REGROWE-BALSAMO-PARA-BARBA-FORTIFICADO.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (32, 'DAVINES KIT PARA BARBA (ESPUMA PARA AFEITAR, ', 'DAVINES KIT PARA BARBA (ESPUMA PARA AFEITAR, ', 'DAVINES-KIT-PARA-BARBA.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (33, 'TEC ITALY SILIKA 300ml', 'TEC ITALY SILIKA 300ml', 'TEC-ITALY-SILIKA-300ml.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (34, 'MINOXIDIL KIRKLAND', 'MINOXIDIL KIRKLAND', 'MINOXIDIL-KIRKLAND.png', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (35, 'TEC ITALY AMPOLLETA ANTICAIDA', 'TEC ITALY AMPOLLETA ANTICAIDA', 'TEC-ITALY-AMPOLLETA-ANTICAIDA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 7, NULL, NULL);
INSERT INTO `paquetes` VALUES (36, '1800', '1800', '1800.png', 1, 0, 0, '', '', 0, '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 0, 0, '', 0, '', NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (37, 'ABSOLUT ELIX', 'ABSOLUT ELIX', 'ABSOLUT-ELIX.png', 1, 0, 0, '', '', 0, '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 0, 0, '', 0, '', NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (38, 'ABSOLUT VODKA', 'ABSOLUT VODKA', 'ABSOLUT-VODKA.png', 1, 0, 0, '', '', 0, '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 0, 0, '', 0, '', NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (39, 'AGUA MALDITA', 'AGUA MALDITA', 'AGUA-MALDITA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (40, 'BACARDI', 'BACARDI', 'BACARDI.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (41, 'BAILEYS', 'BAILEYS', 'BAILEYS.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (42, 'BELVEDERE', 'BELVEDERE', 'BELVEDERE.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (43, 'BOMBAY', 'BOMBAY', 'BOMBAY.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (44, 'BROKERS', 'BROKERS', 'BROKERS.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (45, 'BUCHANANS DELUXE', 'BUCHANANS DELUXE', 'BUCHANANS-DELUXE.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (46, 'DON ISIDRO', 'DON ISIDRO', 'DON-ISIDRO.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (47, 'DON JULIO 70', 'DON JULIO 70', 'DON-JULIO-70.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (48, 'DON JULIO REPOSADO', 'DON JULIO REPOSADO', 'DON-JULIO-REPOSADO.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (49, 'FERNANDO DE CASTILLA', 'FERNANDO DE CASTILLA', 'FERNANDO-DE-CASTILLA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (50, 'HERRADURA REPOSADO', 'HERRADURA REPOSADO', 'HERRADURA-REPOSADO.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (51, 'HERRADURA', 'HERRADURA', 'HERRADURA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (52, 'JACK DANIELS', 'JACK DANIELS', 'JACK-DANIELS.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (53, 'JAGER', 'JAGER', 'JAGER.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (54, 'JOSE CUERVO CRISTALINO', 'JOSE CUERVO CRISTALINO', 'JOSE-CUERVO-CRISTALINO.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (55, 'KAHLUA', 'KAHLUA', 'KAHLUA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (56, 'LICOR 43', 'LICOR 43', 'LICOR-43.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (57, 'MOMBASA', 'MOMBASA', 'MOMBASA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (58, 'TORRES 20', 'TORRES 20', 'TORRES-20.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (59, 'RON ZACAPA', 'RON ZACAPA', 'RON-ZACAPA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (60, 'STOLICHNAYA', 'STOLICHNAYA', 'STOLICHNAYA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (61, 'WYBOROWA', 'WYBOROWA', 'WYBOROWA.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (62, 'ZACAPA 12', 'ZACAPA 12', 'ZACAPA-12.png', 1, 1, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 3, NULL, NULL);
INSERT INTO `paquetes` VALUES (69, 'Corte de cabello', 'Corte de cabello', 'CORTECABELLO1.jpg', 1, 1, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 1, NULL, NULL);
INSERT INTO `paquetes` VALUES (80, 'Corte de barba', 'Corte de barba', 'CORTEBARBA1.jpg', 1, 0, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 2, 0, '', 0, '', NULL, 2, '60', 1, NULL, NULL);
INSERT INTO `paquetes` VALUES (81, 'Tinte de cabello', 'Tinte de cabello', 'barber-shop-g3eb2d2db5_1280.jpg', 0, 1, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 0, NULL, NULL);
INSERT INTO `paquetes` VALUES (83, 'Crema para afeitar', 'Crema para afeitar', 'cremaafeitar1.jpg', 0, 1, 1, '', '', 0, '0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, NULL, 0, NULL, NULL);
INSERT INTO `paquetes` VALUES (90, 'Corte de barba', 'Corte de barba', 'CORTEBARBA2.jpg', 1, 1, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 0, NULL, NULL);
INSERT INTO `paquetes` VALUES (91, 'Corte de cabello', 'Corte de cabello', 'CORTECABELLO2.jpg', 1, 1, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 1, 0, NULL, 0, NULL, NULL, 1, '60', 0, NULL, NULL);
INSERT INTO `paquetes` VALUES (92, 'producto1', 'producto', NULL, 1, 1, 0, '', '', 0, '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '00:00', '00:00', 2, 0, '', 0, '0', NULL, NULL, NULL, 0, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for paquetes_especialista
-- ----------------------------
DROP TABLE IF EXISTS `paquetes_especialista`;
CREATE TABLE `paquetes_especialista` (
  `idpaquete` int(11) NOT NULL,
  `idespecialista` int(11) NOT NULL,
  `idpaqueteespecialista` int(11) NOT NULL AUTO_INCREMENT,
  `costo` float(12,2) DEFAULT '0.00',
  PRIMARY KEY (`idpaqueteespecialista`),
  KEY `fk_paquetes_has_especialista_especialista1_idx` (`idespecialista`),
  KEY `fk_paquetes_has_especialista_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_paquetes_has_especialista_especialista1` FOREIGN KEY (`idespecialista`) REFERENCES `especialista` (`idespecialista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquetes_has_especialista_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paquetes_especialista
-- ----------------------------
BEGIN;
INSERT INTO `paquetes_especialista` VALUES (69, 1, 1, 100.00);
INSERT INTO `paquetes_especialista` VALUES (81, 3, 3, 250.00);
INSERT INTO `paquetes_especialista` VALUES (69, 2, 5, 150.00);
INSERT INTO `paquetes_especialista` VALUES (69, 3, 6, 200.00);
INSERT INTO `paquetes_especialista` VALUES (69, 4, 11, 100.00);
INSERT INTO `paquetes_especialista` VALUES (81, 4, 13, 250.00);
INSERT INTO `paquetes_especialista` VALUES (69, 5, 14, 100.00);
INSERT INTO `paquetes_especialista` VALUES (81, 5, 16, 250.00);
INSERT INTO `paquetes_especialista` VALUES (69, 6, 17, 100.00);
INSERT INTO `paquetes_especialista` VALUES (81, 6, 19, 250.00);
INSERT INTO `paquetes_especialista` VALUES (69, 7, 20, 100.00);
INSERT INTO `paquetes_especialista` VALUES (81, 7, 22, 250.00);
INSERT INTO `paquetes_especialista` VALUES (80, 2, 37, 200.00);
INSERT INTO `paquetes_especialista` VALUES (80, 3, 38, 300.00);
INSERT INTO `paquetes_especialista` VALUES (80, 1, 39, 250.00);
INSERT INTO `paquetes_especialista` VALUES (80, 4, 40, 200.00);
INSERT INTO `paquetes_especialista` VALUES (80, 5, 41, 200.00);
INSERT INTO `paquetes_especialista` VALUES (80, 6, 42, 200.00);
INSERT INTO `paquetes_especialista` VALUES (80, 7, 43, 200.00);
COMMIT;

-- ----------------------------
-- Table structure for paquetesimagenes
-- ----------------------------
DROP TABLE IF EXISTS `paquetesimagenes`;
CREATE TABLE `paquetesimagenes` (
  `idpaquetesimagenes` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) DEFAULT NULL,
  `idpaquete` int(11) NOT NULL,
  PRIMARY KEY (`idpaquetesimagenes`),
  KEY `fk_paquetesimagenes_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_paquetesimagenes_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paquetesimagenes
-- ----------------------------
BEGIN;
INSERT INTO `paquetesimagenes` VALUES (1, 'barber-shop-g3eb2d2db5_1280.jpg', 69);
COMMIT;

-- ----------------------------
-- Table structure for paquetesproducto
-- ----------------------------
DROP TABLE IF EXISTS `paquetesproducto`;
CREATE TABLE `paquetesproducto` (
  `idpaqueteproducto` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `cantidad` float(12,2) DEFAULT NULL,
  `medida` varchar(45) DEFAULT NULL,
  `subtotalmedida` varchar(45) DEFAULT NULL,
  `idpaquete` int(11) NOT NULL,
  PRIMARY KEY (`idpaqueteproducto`),
  KEY `fk_paquetesproducto_productos1_idx` (`idproducto`),
  KEY `fk_paquetesproducto_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_paquetesproducto_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquetesproducto_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paquetesproducto
-- ----------------------------
BEGIN;
INSERT INTO `paquetesproducto` VALUES (1, 1, 1.00, '', '', 92);
INSERT INTO `paquetesproducto` VALUES (14, 1, 1.00, '', '', 36);
INSERT INTO `paquetesproducto` VALUES (16, 1, 1.00, '', '', 80);
COMMIT;

-- ----------------------------
-- Table structure for paquetesucursal
-- ----------------------------
DROP TABLE IF EXISTS `paquetesucursal`;
CREATE TABLE `paquetesucursal` (
  `idpaquetesucursal` int(11) NOT NULL AUTO_INCREMENT,
  `idpaquete` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idpaquetesucursal`),
  KEY `fk_paquetesucursal_paquetes1_idx` (`idpaquete`),
  KEY `fk_paquetesucursal_sucursal1_idx` (`idsucursal`),
  CONSTRAINT `fk_paquetesucursal_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquetesucursal_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paquetesucursal
-- ----------------------------
BEGIN;
INSERT INTO `paquetesucursal` VALUES (2, 69, 1);
INSERT INTO `paquetesucursal` VALUES (4, 81, 1);
INSERT INTO `paquetesucursal` VALUES (6, 83, 1);
INSERT INTO `paquetesucursal` VALUES (12, 1, 1);
INSERT INTO `paquetesucursal` VALUES (13, 2, 1);
INSERT INTO `paquetesucursal` VALUES (14, 3, 1);
INSERT INTO `paquetesucursal` VALUES (15, 4, 1);
INSERT INTO `paquetesucursal` VALUES (16, 5, 1);
INSERT INTO `paquetesucursal` VALUES (17, 6, 1);
INSERT INTO `paquetesucursal` VALUES (18, 7, 1);
INSERT INTO `paquetesucursal` VALUES (19, 8, 1);
INSERT INTO `paquetesucursal` VALUES (20, 9, 1);
INSERT INTO `paquetesucursal` VALUES (21, 10, 1);
INSERT INTO `paquetesucursal` VALUES (22, 11, 1);
INSERT INTO `paquetesucursal` VALUES (23, 12, 1);
INSERT INTO `paquetesucursal` VALUES (24, 13, 1);
INSERT INTO `paquetesucursal` VALUES (25, 14, 1);
INSERT INTO `paquetesucursal` VALUES (26, 15, 1);
INSERT INTO `paquetesucursal` VALUES (27, 16, 1);
INSERT INTO `paquetesucursal` VALUES (28, 17, 1);
INSERT INTO `paquetesucursal` VALUES (29, 18, 1);
INSERT INTO `paquetesucursal` VALUES (30, 19, 1);
INSERT INTO `paquetesucursal` VALUES (31, 20, 1);
INSERT INTO `paquetesucursal` VALUES (32, 21, 1);
INSERT INTO `paquetesucursal` VALUES (33, 22, 1);
INSERT INTO `paquetesucursal` VALUES (34, 23, 1);
INSERT INTO `paquetesucursal` VALUES (35, 24, 1);
INSERT INTO `paquetesucursal` VALUES (36, 25, 1);
INSERT INTO `paquetesucursal` VALUES (37, 26, 1);
INSERT INTO `paquetesucursal` VALUES (38, 27, 1);
INSERT INTO `paquetesucursal` VALUES (39, 28, 1);
INSERT INTO `paquetesucursal` VALUES (40, 29, 1);
INSERT INTO `paquetesucursal` VALUES (41, 30, 1);
INSERT INTO `paquetesucursal` VALUES (42, 31, 1);
INSERT INTO `paquetesucursal` VALUES (43, 32, 1);
INSERT INTO `paquetesucursal` VALUES (44, 33, 1);
INSERT INTO `paquetesucursal` VALUES (45, 34, 1);
INSERT INTO `paquetesucursal` VALUES (46, 35, 1);
INSERT INTO `paquetesucursal` VALUES (47, 36, 1);
INSERT INTO `paquetesucursal` VALUES (48, 37, 1);
INSERT INTO `paquetesucursal` VALUES (49, 38, 1);
INSERT INTO `paquetesucursal` VALUES (50, 39, 1);
INSERT INTO `paquetesucursal` VALUES (51, 40, 1);
INSERT INTO `paquetesucursal` VALUES (52, 41, 1);
INSERT INTO `paquetesucursal` VALUES (53, 42, 1);
INSERT INTO `paquetesucursal` VALUES (54, 43, 1);
INSERT INTO `paquetesucursal` VALUES (55, 44, 1);
INSERT INTO `paquetesucursal` VALUES (56, 45, 1);
INSERT INTO `paquetesucursal` VALUES (57, 46, 1);
INSERT INTO `paquetesucursal` VALUES (58, 47, 1);
INSERT INTO `paquetesucursal` VALUES (59, 48, 1);
INSERT INTO `paquetesucursal` VALUES (60, 49, 1);
INSERT INTO `paquetesucursal` VALUES (61, 50, 1);
INSERT INTO `paquetesucursal` VALUES (62, 51, 1);
INSERT INTO `paquetesucursal` VALUES (63, 52, 1);
INSERT INTO `paquetesucursal` VALUES (64, 53, 1);
INSERT INTO `paquetesucursal` VALUES (65, 54, 1);
INSERT INTO `paquetesucursal` VALUES (66, 55, 1);
INSERT INTO `paquetesucursal` VALUES (67, 56, 1);
INSERT INTO `paquetesucursal` VALUES (68, 57, 1);
INSERT INTO `paquetesucursal` VALUES (69, 58, 1);
INSERT INTO `paquetesucursal` VALUES (70, 59, 1);
INSERT INTO `paquetesucursal` VALUES (71, 60, 1);
INSERT INTO `paquetesucursal` VALUES (72, 61, 1);
INSERT INTO `paquetesucursal` VALUES (73, 62, 1);
INSERT INTO `paquetesucursal` VALUES (75, 80, 1);
COMMIT;

-- ----------------------------
-- Table structure for parentesco
-- ----------------------------
DROP TABLE IF EXISTS `parentesco`;
CREATE TABLE `parentesco` (
  `idparentesco` int(11) NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`idparentesco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `idperfiles` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(100) NOT NULL,
  `estatus` int(1) DEFAULT '1' COMMENT '0 - No activo\\n1 - Activo',
  PRIMARY KEY (`idperfiles`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfiles
-- ----------------------------
BEGIN;
INSERT INTO `perfiles` VALUES (1, 'ADMINISTRADOR', 1);
COMMIT;

-- ----------------------------
-- Table structure for perfiles_permisos
-- ----------------------------
DROP TABLE IF EXISTS `perfiles_permisos`;
CREATE TABLE `perfiles_permisos` (
  `idperfiles` int(11) NOT NULL,
  `idmodulos_menu` int(11) NOT NULL,
  `insertar` int(11) DEFAULT '0',
  `borrar` int(11) DEFAULT '0',
  `modificar` int(11) DEFAULT '0',
  KEY `fk_perfiles_has_modulos_menu_modulos_menu1` (`idmodulos_menu`) USING BTREE,
  KEY `fk_perfiles_has_modulos_menu_perfiles1` (`idperfiles`) USING BTREE,
  CONSTRAINT `perfiles_permisos_ibfk_1` FOREIGN KEY (`idmodulos_menu`) REFERENCES `modulos_menu` (`idmodulos_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `perfiles_permisos_ibfk_2` FOREIGN KEY (`idperfiles`) REFERENCES `perfiles` (`idperfiles`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfiles_permisos
-- ----------------------------
BEGIN;
INSERT INTO `perfiles_permisos` VALUES (7, 2, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 4, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 3, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 106, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 2, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 87, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 129, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 101, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 110, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 107, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 134, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 141, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 140, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 89, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 139, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 86, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 142, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 123, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 133, 1, 1, 1);
INSERT INTO `perfiles_permisos` VALUES (1, 138, 1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for precio
-- ----------------------------
DROP TABLE IF EXISTS `precio`;
CREATE TABLE `precio` (
  `idprecio` int(11) NOT NULL AUTO_INCREMENT,
  `precio` varchar(45) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idprecio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of precio
-- ----------------------------
BEGIN;
INSERT INTO `precio` VALUES (1, 'Precio 1', 1, 1);
INSERT INTO `precio` VALUES (2, 'Precio 2', 0, 0);
INSERT INTO `precio` VALUES (3, 'Precio 3', 0, 0);
INSERT INTO `precio` VALUES (4, 'Precio 4', 0, 0);
INSERT INTO `precio` VALUES (5, 'Precio 5', 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for preciopaquete
-- ----------------------------
DROP TABLE IF EXISTS `preciopaquete`;
CREATE TABLE `preciopaquete` (
  `idpreciopaquete` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float(12,2) DEFAULT NULL,
  `idprecio` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  PRIMARY KEY (`idpreciopaquete`),
  KEY `fk_preciopaquetes_precio1_idx` (`idprecio`),
  KEY `fk_preciopaquetes_paquetes1_idx` (`idpaquete`),
  CONSTRAINT `fk_preciopaquetes_paquetes1` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_preciopaquetes_precio1` FOREIGN KEY (`idprecio`) REFERENCES `precio` (`idprecio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1283 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of preciopaquete
-- ----------------------------
BEGIN;
INSERT INTO `preciopaquete` VALUES (1182, 100.00, 1, 69);
INSERT INTO `preciopaquete` VALUES (1184, 200.00, 1, 81);
INSERT INTO `preciopaquete` VALUES (1186, 200.00, 1, 83);
INSERT INTO `preciopaquete` VALUES (1191, 250.00, 1, 90);
INSERT INTO `preciopaquete` VALUES (1192, 250.00, 1, 91);
INSERT INTO `preciopaquete` VALUES (1193, 500.00, 1, 1);
INSERT INTO `preciopaquete` VALUES (1194, 500.00, 1, 2);
INSERT INTO `preciopaquete` VALUES (1195, 450.00, 1, 3);
INSERT INTO `preciopaquete` VALUES (1196, 450.00, 1, 4);
INSERT INTO `preciopaquete` VALUES (1197, 280.00, 1, 5);
INSERT INTO `preciopaquete` VALUES (1198, 280.00, 1, 6);
INSERT INTO `preciopaquete` VALUES (1199, 280.00, 1, 7);
INSERT INTO `preciopaquete` VALUES (1200, 250.00, 1, 14);
INSERT INTO `preciopaquete` VALUES (1201, 250.00, 1, 15);
INSERT INTO `preciopaquete` VALUES (1202, 250.00, 1, 16);
INSERT INTO `preciopaquete` VALUES (1203, 450.00, 1, 33);
INSERT INTO `preciopaquete` VALUES (1204, 850.00, 1, 8);
INSERT INTO `preciopaquete` VALUES (1206, 320.00, 1, 13);
INSERT INTO `preciopaquete` VALUES (1208, 320.00, 1, 34);
INSERT INTO `preciopaquete` VALUES (1209, 320.00, 1, 17);
INSERT INTO `preciopaquete` VALUES (1210, 320.00, 1, 18);
INSERT INTO `preciopaquete` VALUES (1211, 80.00, 1, 10);
INSERT INTO `preciopaquete` VALUES (1212, 50.00, 1, 35);
INSERT INTO `preciopaquete` VALUES (1214, 330.00, 1, 19);
INSERT INTO `preciopaquete` VALUES (1215, 330.00, 1, 20);
INSERT INTO `preciopaquete` VALUES (1216, 330.00, 1, 21);
INSERT INTO `preciopaquete` VALUES (1217, 270.00, 1, 9);
INSERT INTO `preciopaquete` VALUES (1220, 320.00, 1, 12);
INSERT INTO `preciopaquete` VALUES (1221, 320.00, 1, 11);
INSERT INTO `preciopaquete` VALUES (1223, 270.00, 1, 22);
INSERT INTO `preciopaquete` VALUES (1225, 300.00, 1, 23);
INSERT INTO `preciopaquete` VALUES (1226, 320.00, 1, 24);
INSERT INTO `preciopaquete` VALUES (1227, 320.00, 1, 25);
INSERT INTO `preciopaquete` VALUES (1228, 320.00, 1, 26);
INSERT INTO `preciopaquete` VALUES (1229, 320.00, 1, 27);
INSERT INTO `preciopaquete` VALUES (1230, 320.00, 1, 28);
INSERT INTO `preciopaquete` VALUES (1231, 320.00, 1, 29);
INSERT INTO `preciopaquete` VALUES (1232, 450.00, 1, 31);
INSERT INTO `preciopaquete` VALUES (1233, 1050.00, 1, 32);
INSERT INTO `preciopaquete` VALUES (1235, 500.00, 1, 30);
INSERT INTO `preciopaquete` VALUES (1239, 500.00, 1, 39);
INSERT INTO `preciopaquete` VALUES (1240, 500.00, 1, 40);
INSERT INTO `preciopaquete` VALUES (1241, 500.00, 1, 41);
INSERT INTO `preciopaquete` VALUES (1242, 500.00, 1, 42);
INSERT INTO `preciopaquete` VALUES (1243, 500.00, 1, 43);
INSERT INTO `preciopaquete` VALUES (1244, 500.00, 1, 44);
INSERT INTO `preciopaquete` VALUES (1245, 500.00, 1, 45);
INSERT INTO `preciopaquete` VALUES (1246, 500.00, 1, 46);
INSERT INTO `preciopaquete` VALUES (1247, 500.00, 1, 47);
INSERT INTO `preciopaquete` VALUES (1248, 500.00, 1, 48);
INSERT INTO `preciopaquete` VALUES (1249, 500.00, 1, 49);
INSERT INTO `preciopaquete` VALUES (1250, 500.00, 1, 50);
INSERT INTO `preciopaquete` VALUES (1251, 500.00, 1, 51);
INSERT INTO `preciopaquete` VALUES (1252, 500.00, 1, 52);
INSERT INTO `preciopaquete` VALUES (1253, 500.00, 1, 53);
INSERT INTO `preciopaquete` VALUES (1254, 500.00, 1, 54);
INSERT INTO `preciopaquete` VALUES (1255, 500.00, 1, 55);
INSERT INTO `preciopaquete` VALUES (1256, 500.00, 1, 56);
INSERT INTO `preciopaquete` VALUES (1257, 500.00, 1, 57);
INSERT INTO `preciopaquete` VALUES (1258, 500.00, 1, 58);
INSERT INTO `preciopaquete` VALUES (1259, 500.00, 1, 59);
INSERT INTO `preciopaquete` VALUES (1260, 500.00, 1, 60);
INSERT INTO `preciopaquete` VALUES (1261, 500.00, 1, 61);
INSERT INTO `preciopaquete` VALUES (1262, 500.00, 1, 62);
INSERT INTO `preciopaquete` VALUES (1263, 100.00, 1, 92);
INSERT INTO `preciopaquete` VALUES (1276, 500.00, 1, 36);
INSERT INTO `preciopaquete` VALUES (1279, 500.00, 1, 37);
INSERT INTO `preciopaquete` VALUES (1280, 500.00, 1, 38);
INSERT INTO `preciopaquete` VALUES (1282, 200.00, 1, 80);
COMMIT;

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `codigoproducto` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  `idcategorias` int(11) DEFAULT NULL,
  `idtipo_presentacion` int(11) DEFAULT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `descuento` float(10,2) NOT NULL DEFAULT '0.00',
  `foto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pu` float(10,2) DEFAULT '0.00',
  `pv` float(10,2) DEFAULT '0.00' COMMENT 'Va a estar generado por el precio que tiene de venta el insumo.',
  `tipo_descuento` int(11) DEFAULT '2' COMMENT '0 - ninguno\\n1 - niveles\\n2 - rangos ',
  `estatus` int(11) NOT NULL DEFAULT '0' COMMENT '0 - no activo\\\\n1 - activo\\\\n',
  `web` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idtipomedida` int(11) DEFAULT NULL,
  `cantidadactual` varchar(45) COLLATE utf8_spanish_ci DEFAULT '0',
  `cantidadminima` varchar(45) COLLATE utf8_spanish_ci DEFAULT '0',
  PRIMARY KEY (`idproducto`),
  KEY `idtipomedida_idx` (`idtipomedida`),
  CONSTRAINT `idtipomedida` FOREIGN KEY (`idtipomedida`) REFERENCES `tipo_medida` (`idtipo_medida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
BEGIN;
INSERT INTO `productos` VALUES (1, '001', NULL, 0, NULL, 'producto1', 'producto', 0.00, NULL, 0.00, 0.00, 2, 1, NULL, '2023-05-22 12:24:36', 7, '0', '0');
COMMIT;

-- ----------------------------
-- Table structure for publicidad
-- ----------------------------
DROP TABLE IF EXISTS `publicidad`;
CREATE TABLE `publicidad` (
  `idpublicidad` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `orden` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpublicidad`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of publicidad
-- ----------------------------
BEGIN;
INSERT INTO `publicidad` VALUES (17, 'Promoción', 'promo.jpg', 1, 1, '2022-06-22 09:10:33');
INSERT INTO `publicidad` VALUES (18, 'Promoción2', 'promo2.jpg', 1, 2, '2023-02-27 11:19:08');
INSERT INTO `publicidad` VALUES (19, 'Promoción 3', 'promo3.jpg', 1, 3, '2023-02-27 11:19:25');
COMMIT;

-- ----------------------------
-- Table structure for qrgenerados
-- ----------------------------
DROP TABLE IF EXISTS `qrgenerados`;
CREATE TABLE `qrgenerados` (
  `idqrgenerado` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` int(11) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuarios` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `idcita` int(11) NOT NULL,
  `qrgenerado` text,
  PRIMARY KEY (`idqrgenerado`),
  KEY `fk_qrgenerados_citas1_idx` (`idcita`),
  CONSTRAINT `fk_qrgenerados_citas1` FOREIGN KEY (`idcita`) REFERENCES `citas` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qrgenerados
-- ----------------------------
BEGIN;
INSERT INTO `qrgenerados` VALUES (67, 2, '2023-05-13 10:30:07', 97, '97-2023-05-13 10:30:07.png', 48, 'dYHPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdHmNg4A=');
INSERT INTO `qrgenerados` VALUES (68, 2, '2023-05-13 10:30:08', 97, '97-2023-05-13 10:30:08.png', 48, 'dYHPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdHmNg4E=');
INSERT INTO `qrgenerados` VALUES (69, 2, '2023-05-13 10:30:23', 97, '97-2023-05-13 10:30:23.png', 49, 'dYLPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdHmNhXw=');
INSERT INTO `qrgenerados` VALUES (70, 3, '2023-05-13 10:30:23', 97, '97-2023-05-13 10:30:23.png', 49, 'dYLPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdHmNhXw=');
INSERT INTO `qrgenerados` VALUES (71, 2, '2023-05-13 10:39:38', 97, '97-2023-05-13 10:39:38.png', 48, 'dYHPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdIKNhoE=');
INSERT INTO `qrgenerados` VALUES (72, 3, '2023-05-13 10:39:38', 97, '97-2023-05-13 10:39:38.png', 48, 'dYHPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdIKNhoE=');
INSERT INTO `qrgenerados` VALUES (73, 2, '2023-05-13 10:44:39', 97, '97-2023-05-13 10:44:39.png', 47, 'dYDPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdX2NhoI=');
INSERT INTO `qrgenerados` VALUES (74, 2, '2023-05-13 10:44:39', 97, '97-2023-05-13 10:44:39.png', 47, 'dYDPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdX2NhoI=');
INSERT INTO `qrgenerados` VALUES (75, 3, '2023-05-13 10:44:44', 97, '97-2023-05-13 10:44:44.png', 47, 'dYDPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdX2Nh30=');
INSERT INTO `qrgenerados` VALUES (76, 1, '2023-05-13 10:44:44', 97, '97-2023-05-13 10:44:44.png', 47, 'dYDPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdX2Nh30=');
INSERT INTO `qrgenerados` VALUES (77, 2, '2023-05-13 10:48:05', 97, '97-2023-05-13 10:48:05.png', 50, 'dnnPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdYGNg34=');
INSERT INTO `qrgenerados` VALUES (78, 3, '2023-05-13 10:48:05', 97, '97-2023-05-13 10:48:05.png', 50, 'dnnPjIDK0qa+uL2xt8+wyoh1hIZueYiAeoF2doKNdYGNg34=');
INSERT INTO `qrgenerados` VALUES (79, 2, '2023-05-14 15:02:50', 99, '99-2023-05-14 15:02:50.png', 51, 'dnrPjILK0o/Bxaiuz62qu7i3s8GwxaC0t7LLr7PBsMWFg3uBg3WHgHJ9c4R+iIZ3jIhx');
INSERT INTO `qrgenerados` VALUES (80, 1, '2023-05-14 15:02:50', 99, '99-2023-05-14 15:02:50.png', 51, 'dnrPjILK0o/Bxaiuz62qu7i3s8GwxaC0t7LLr7PBsMWFg3uBg3WHgHJ9c4R+iIZ3jIhx');
INSERT INTO `qrgenerados` VALUES (81, 1, '2023-05-14 15:02:56', 99, '99-2023-05-14 15:02:56.png', 52, 'dnvPjILK0o/Bxaiuz62qu7i3s8GwxaC0t7LLr7PBsMWFg3uBg3WHgHJ9c4R+iIZ3jIh3');
INSERT INTO `qrgenerados` VALUES (82, 1, '2023-05-14 15:03:01', 99, '99-2023-05-14 15:03:01.png', 53, 'dnzPjILK0o/Bxaiuz62qu7i3s8GwxaC0t7LLr7PBsMWFg3uBg3WHgHJ9c4R+iIZ4jINy');
COMMIT;

-- ----------------------------
-- Table structure for reportes
-- ----------------------------
DROP TABLE IF EXISTS `reportes`;
CREATE TABLE `reportes` (
  `idreporte` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0' COMMENT '0-DESACTIVADO-1-ACTIVADO',
  `habilitarsucursal` int(11) DEFAULT '0',
  `habilitarfechainicio` int(11) DEFAULT '0',
  `habilitarfechafinal` int(11) DEFAULT '0',
  `funcion` varchar(255) DEFAULT NULL,
  `habilitarhorainicio` int(11) DEFAULT '0',
  `habilitarhorafin` int(11) DEFAULT '0',
  PRIMARY KEY (`idreporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rutaimagenes
-- ----------------------------
DROP TABLE IF EXISTS `rutaimagenes`;
CREATE TABLE `rutaimagenes` (
  `idrutaimagenes` int(11) NOT NULL AUTO_INCREMENT,
  `rutaimagenesapp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idrutaimagenes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for salidasproducto
-- ----------------------------
DROP TABLE IF EXISTS `salidasproducto`;
CREATE TABLE `salidasproducto` (
  `idsalidasproducto` int(11) NOT NULL AUTO_INCREMENT,
  `cantidadsalida` varchar(45) DEFAULT NULL,
  `fechasalida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(11) DEFAULT '0',
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idsalidasproducto`),
  KEY `fk_salidasproducto_productos1_idx` (`idproducto`),
  CONSTRAINT `fk_salidasproducto_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sucursal
-- ----------------------------
DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `estatus` int(11) DEFAULT NULL COMMENT '0.-inactivo\n1.-activo',
  `imagen` varchar(255) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(11) DEFAULT NULL,
  `lunes` int(11) DEFAULT NULL,
  `martes` int(11) DEFAULT NULL,
  `miercoles` int(11) DEFAULT NULL,
  `jueves` int(11) DEFAULT NULL,
  `viernes` int(11) DEFAULT NULL,
  `sabado` int(11) DEFAULT NULL,
  `domingo` int(11) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `iva` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `minutosconsiderados` varchar(45) DEFAULT NULL,
  `iddatofiscal` varchar(45) DEFAULT NULL,
  `solicitarfactura` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `encabezadoticket` varchar(45) DEFAULT NULL,
  `leyendaticket` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `telefono3` varchar(45) DEFAULT NULL,
  `telefono4` varchar(45) DEFAULT NULL,
  `tventa` varchar(45) DEFAULT NULL,
  `tproduccion` varchar(45) DEFAULT NULL,
  `codigopostal` varchar(45) DEFAULT NULL,
  `trecordatorio` varchar(45) DEFAULT NULL,
  `minutosrecordatorio` varchar(45) DEFAULT NULL,
  `mensajesucursal` varchar(45) DEFAULT NULL,
  `mensajecliente` varchar(45) DEFAULT NULL,
  `campomontofactura` varchar(45) DEFAULT NULL,
  `habilitarnotaventa` varchar(45) DEFAULT NULL,
  `mensajesecciontipopago` varchar(45) DEFAULT NULL,
  `idcategorias` int(11) NOT NULL,
  `imagensecundaria` varchar(45) DEFAULT NULL,
  `porbarbero` int(11) DEFAULT NULL,
  `porfecha` int(11) DEFAULT NULL,
  `imagenporbarbero` varchar(45) DEFAULT NULL,
  `imagenporfecha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsucursal`),
  KEY `fk_sucursal_categorias1_idx` (`idcategorias`),
  CONSTRAINT `fk_sucursal_categorias1` FOREIGN KEY (`idcategorias`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sucursal
-- ----------------------------
BEGIN;
INSERT INTO `sucursal` VALUES (1, 'Barbería Porfirio', 'Sucursal Oriente', 1, 'sucursal1.jpg', '2023-01-15 11:22:30', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '(961) 123-4444', '16.75253371425835,-93.11545556969735', 'as', '', '', '0', '1', '7', '180', '0', '0', '', 'as', '', '', '', '', '', '0', '0', '', '0', '', '', '', '', '', '', 2, '2023-05-30_15:27:44-1.jpg', 1, 1, '2023-06-02_18:53:37-1B.jpg', '2023-06-02_18:53:37-1A.jpg');
COMMIT;

-- ----------------------------
-- Table structure for sucursalesimagenes
-- ----------------------------
DROP TABLE IF EXISTS `sucursalesimagenes`;
CREATE TABLE `sucursalesimagenes` (
  `idimagenessucursal` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idimagenessucursal`),
  KEY `fk_imagenessucursal_sucursal1_idx` (`idsucursal`),
  CONSTRAINT `fk_imagenessucursal_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sucursalesimagenes
-- ----------------------------
BEGIN;
INSERT INTO `sucursalesimagenes` VALUES (1, 'porfirio2.jpg', 1, '2023-01-27 08:59:50', 1);
INSERT INTO `sucursalesimagenes` VALUES (2, 'porfirio1.jpg', 1, '2023-02-23 14:26:51', 1);
INSERT INTO `sucursalesimagenes` VALUES (5, 'porfirio3.jpg', 1, '2023-02-27 10:45:58', 1);
COMMIT;

-- ----------------------------
-- Table structure for sucursalfavorita
-- ----------------------------
DROP TABLE IF EXISTS `sucursalfavorita`;
CREATE TABLE `sucursalfavorita` (
  `idsucursalfavorita` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idsucursalfavorita`),
  KEY `fk_sucursalfavorita_usuarios1_idx` (`idusuarios`),
  KEY `fk_sucursalfavorita_sucursal1_idx` (`idsucursal`),
  CONSTRAINT `fk_sucursalfavorita_sucursal1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursalfavorita_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sucursaltipodepago
-- ----------------------------
DROP TABLE IF EXISTS `sucursaltipodepago`;
CREATE TABLE `sucursaltipodepago` (
  `idsucursaltipodepago` int(11) NOT NULL AUTO_INCREMENT,
  `idsucursal` int(11) DEFAULT NULL,
  `idtipodepago` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsucursaltipodepago`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sucursaltipodepago
-- ----------------------------
BEGIN;
INSERT INTO `sucursaltipodepago` VALUES (81, 7, '2');
INSERT INTO `sucursaltipodepago` VALUES (82, 7, '3');
INSERT INTO `sucursaltipodepago` VALUES (83, 7, '4');
INSERT INTO `sucursaltipodepago` VALUES (87, 8, '4');
INSERT INTO `sucursaltipodepago` VALUES (88, 8, '5');
INSERT INTO `sucursaltipodepago` VALUES (89, 8, '6');
COMMIT;

-- ----------------------------
-- Table structure for tableroanuncios
-- ----------------------------
DROP TABLE IF EXISTS `tableroanuncios`;
CREATE TABLE `tableroanuncios` (
  `idtableroanuncio` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(250) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(11) DEFAULT '0',
  `url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtableroanuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tableroanuncios
-- ----------------------------
BEGIN;
INSERT INTO `tableroanuncios` VALUES (11, 'Barber Shop', 'SOLO CANCHAS PROFESIONALES BULLPADEL', 'publicidad.jpg', 1, '2022-06-22 09:12:03', 1, NULL);
INSERT INTO `tableroanuncios` VALUES (13, 'Barbería Porfirio', NULL, 'porfirio1.jpg', 1, '2023-02-27 11:15:42', 3, NULL);
COMMIT;

-- ----------------------------
-- Table structure for tipo_medida
-- ----------------------------
DROP TABLE IF EXISTS `tipo_medida`;
CREATE TABLE `tipo_medida` (
  `idtipo_medida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `medidaminima` float(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Es la unidad mínima de operación ',
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipo_medida`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_medida
-- ----------------------------
BEGIN;
INSERT INTO `tipo_medida` VALUES (1, 'Kg.', 1.00, 1);
INSERT INTO `tipo_medida` VALUES (2, 'L', 1.00, 1);
INSERT INTO `tipo_medida` VALUES (3, 'M', 1.00, 1);
INSERT INTO `tipo_medida` VALUES (7, 'Pza.', 1.00, 1);
COMMIT;

-- ----------------------------
-- Table structure for tipodepago
-- ----------------------------
DROP TABLE IF EXISTS `tipodepago`;
CREATE TABLE `tipodepago` (
  `idtipodepago` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) DEFAULT NULL,
  `estatus` int(11) DEFAULT '1',
  `habilitarfoto` varchar(255) DEFAULT '0',
  `clavepublica` varchar(255) DEFAULT NULL,
  `claveprivada` varchar(255) DEFAULT NULL,
  `constripe` int(11) DEFAULT '0',
  `cuenta` text,
  `habilitarcampomonto` int(11) DEFAULT NULL COMMENT '0-deshabilitado,1-habilitado',
  `habilitarcampomontofactura` int(11) DEFAULT '0' COMMENT '0-deshabilitado,1-habilitado',
  `comisionporcentaje` float(10,2) DEFAULT NULL,
  `comisionmonto` float(10,2) DEFAULT NULL,
  `impuesto` float(10,2) DEFAULT NULL,
  `habilitarapp` int(11) DEFAULT '0',
  `habilitarweb` varchar(45) DEFAULT NULL,
  `comisionpornota` float(10,2) DEFAULT '0.00',
  `tipocomisionpornota` int(11) DEFAULT '0',
  `habilitartiposervicio` int(11) DEFAULT '0',
  `descripciontipopago` varchar(45) DEFAULT NULL,
  `factura` int(11) DEFAULT '0',
  PRIMARY KEY (`idtipodepago`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipodepago
-- ----------------------------
BEGIN;
INSERT INTO `tipodepago` VALUES (-1, 'Sin pago', 0, '0', NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, '0', 0.00, 0, 0, NULL, 0);
INSERT INTO `tipodepago` VALUES (1, 'Depósito', 0, '1', '', '', 0, '1234 1234 1234 1234', 0, 0, 0.00, 0.00, 0.00, 0, '0', 0.00, 0, 0, NULL, 0);
INSERT INTO `tipodepago` VALUES (2, 'Monedero', 0, '0', NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, '0', 0.00, 0, 0, NULL, 0);
INSERT INTO `tipodepago` VALUES (3, 'Tarjeta', 1, '0', 'pk_test_51Gsee5HfhZt076luqmLv27N1v6tKYOkscemmGjdWjVr3tH0KF3UF5ME9dp0TnuvP6FD72xiDlyC5mdWU9CAAIEX700z5FodQAZ', 'sk_test_51Gsee5HfhZt076luMSTImP5xJonHnnEI5FNllfeucsoQJpKovHPsQckBhd1nav8AyuqbCZarJb3doHfXph8SAlqV004L2o7T9B', 1, '', 0, 0, 3.60, 3.00, 16.00, 1, '1', 0.00, 0, 0, NULL, 0);
INSERT INTO `tipodepago` VALUES (4, 'Efectivo', 0, '0', '', '', 0, '', 1, 0, 0.00, 0.00, 0.00, 1, '1', 0.00, 0, 0, NULL, 0);
INSERT INTO `tipodepago` VALUES (5, 'Transferencia', 1, '1', '', '', 0, 'Deposita a la Cuenta 012 100 0047 7148860 9 y sube una captura de tu pago.', 0, 0, 0.00, 0.00, 0.00, 1, '1', 0.00, 0, 0, NULL, 0);
COMMIT;

-- ----------------------------
-- Table structure for tipousuario
-- ----------------------------
DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombretipo` varchar(255) DEFAULT NULL,
  `mostrarenapp` int(11) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL COMMENT '0.-inactivo\n1.-activo',
  `sistema` int(11) DEFAULT '0',
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipousuario
-- ----------------------------
BEGIN;
INSERT INTO `tipousuario` VALUES (3, 'cliente', NULL, 1, 0);
INSERT INTO `tipousuario` VALUES (5, 'especilista', NULL, 1, 1);
INSERT INTO `tipousuario` VALUES (6, 'invitado', NULL, NULL, 0);
INSERT INTO `tipousuario` VALUES (7, 'administrador', NULL, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for usocfdi
-- ----------------------------
DROP TABLE IF EXISTS `usocfdi`;
CREATE TABLE `usocfdi` (
  `c_uso` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usocupon
-- ----------------------------
DROP TABLE IF EXISTS `usocupon`;
CREATE TABLE `usocupon` (
  `idusocupon` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) DEFAULT NULL,
  `codigocupon` varchar(45) DEFAULT NULL,
  `numerodeveces` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusocupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usocuponcliente
-- ----------------------------
DROP TABLE IF EXISTS `usocuponcliente`;
CREATE TABLE `usocuponcliente` (
  `idusocuponcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) DEFAULT NULL,
  `codigocupon` varchar(45) DEFAULT NULL,
  `numerodeveces` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusocuponcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usocupondia
-- ----------------------------
DROP TABLE IF EXISTS `usocupondia`;
CREATE TABLE `usocupondia` (
  `idusocupondia` int(11) NOT NULL AUTO_INCREMENT,
  `idcupon` int(11) DEFAULT NULL,
  `codigocupon` varchar(45) DEFAULT NULL,
  `numerodeveces` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusocupondia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuariodatosalud
-- ----------------------------
DROP TABLE IF EXISTS `usuariodatosalud`;
CREATE TABLE `usuariodatosalud` (
  `idusuariodatosalud` int(11) NOT NULL AUTO_INCREMENT,
  `estatura` varchar(45) DEFAULT NULL,
  `peso` varchar(45) DEFAULT NULL,
  `patologias` varchar(45) DEFAULT NULL,
  `cirugias` varchar(255) DEFAULT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `ortopedicos` varchar(255) DEFAULT NULL,
  `medicamentos` varchar(255) DEFAULT NULL,
  `aceptopoliticas` int(11) DEFAULT NULL,
  `datosverdaderos` int(11) DEFAULT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idusuariodatosalud`),
  KEY `fk_usuariodatosalud_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_usuariodatosalud_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuariodatosemergencia
-- ----------------------------
DROP TABLE IF EXISTS `usuariodatosemergencia`;
CREATE TABLE `usuariodatosemergencia` (
  `idusuariodatosemergencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecontacto` varchar(255) DEFAULT NULL,
  `numeroemergencia` varchar(255) DEFAULT NULL COMMENT '		',
  `alergias` varchar(255) DEFAULT NULL,
  `patologias` varchar(255) DEFAULT NULL,
  `tiposangre` varchar(255) DEFAULT NULL,
  `poliza` varchar(255) DEFAULT NULL COMMENT '	',
  `idusuarios` int(11) NOT NULL,
  `aceptopoliticas` int(11) DEFAULT NULL,
  `datosverdaderos` int(11) DEFAULT NULL,
  `idcompaniaseguro` int(11) NOT NULL,
  `numeroemergencia2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idusuariodatosemergencia`),
  KEY `fk_usuariosdatosemergencia_usuarios1_idx` (`idusuarios`),
  KEY `fk_usuariodatosemergencia_companiaseguro1_idx` (`idcompaniaseguro`),
  CONSTRAINT `fk_usuariodatosemergencia_companiaseguro1` FOREIGN KEY (`idcompaniaseguro`) REFERENCES `companiaseguro` (`idcompaniaseguro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuariosdatosemergencia_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT COMMENT '0 - USUARIOS INTERNOS\\n1 - USUARIOS EXTERNOS',
  `idperfiles` int(11) DEFAULT '0',
  `nombre` varchar(250) DEFAULT NULL,
  `paterno` varchar(250) DEFAULT NULL,
  `materno` varchar(250) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT '----',
  `celular` varchar(100) DEFAULT '----',
  `email` varchar(100) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `tipo` int(1) DEFAULT '1' COMMENT '0 - super usuario\\\\n \n1 -Empleado \\\\n\n2.- Administrador \\\\n\n3.-Alumno\n5.-Coach',
  `estatus` int(1) DEFAULT '1' COMMENT '0.-inactivo\n1.-activo',
  `idempleados` int(11) DEFAULT '0',
  `tokenfirebase` varchar(45) DEFAULT NULL COMMENT '	',
  `so` varchar(45) DEFAULT NULL,
  `fechanacimiento` varchar(100) DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(45) DEFAULT NULL,
  `foto` text,
  `customerid_stripe` varchar(45) DEFAULT NULL,
  `lastcard_stripe` varchar(45) DEFAULT NULL,
  `versionactual` varchar(45) DEFAULT NULL,
  `validartelefono` int(11) DEFAULT NULL,
  `bloquearediciondatos` int(11) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `saldomonedero` float(14,2) DEFAULT NULL,
  `codigopostal` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `tipoasentamiento` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `no_int` varchar(45) DEFAULT NULL,
  `no_ext` varchar(45) DEFAULT NULL,
  `anunciovisto` int(11) DEFAULT '0',
  `sistema` varchar(45) DEFAULT NULL,
  `alias` text,
  `monedero` float(10,4) DEFAULT NULL,
  `celular2` varchar(45) DEFAULT NULL,
  `popupmembresia` int(11) DEFAULT '0',
  `sincel` varchar(45) DEFAULT NULL,
  `celularrespaldo` varchar(45) DEFAULT NULL,
  `aceptopolitica` int(11) DEFAULT '0',
  PRIMARY KEY (`idusuarios`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
BEGIN;
INSERT INTO `usuarios` VALUES (1, 1, 'ADMINISTRADOR', '', '', '----', '--', 'admin', 'admin', 'admin', 0, 1, 0, NULL, NULL, NULL, '2022-03-23 23:38:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'admin', 0.0000, '0', 0, '0', NULL, 0);
INSERT INTO `usuarios` VALUES (4, 0, 'Mauro', 'Martínez', NULL, '----', '(961) 217-0865', 'especialista@gmail.com', 'especialista@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (5, 0, 'Neto', 'Estrada', NULL, '----', '(961) 217-0865', 'especialista2@gmail.com', 'especialista2@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (8, 0, 'Joseph', 'Chang', NULL, '----', '(961) 217-0865', 'especialista3@gmail.com', 'especialista3@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (62, 0, 'Izza', 'urbina', 'Zenteno', '', '(961) 139-7651', 'centenoizza@outlook.com', NULL, '3444', 3, 1, 0, NULL, NULL, '2023-04-14', '2023-04-14 10:34:12', '6992', NULL, NULL, 'pm_1MwqOGHfhZt076luJJkV7FZ6', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'ios', NULL, NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `usuarios` VALUES (63, 0, 'Mónica', 'Soto', 'Gómez', '', '(961) 660-5023', 'monicasiboney_95@hotmail.com', NULL, 'conta1795', 3, 1, 0, NULL, NULL, '1995-01-07', '2023-04-14 10:34:30', '9383', NULL, NULL, 'pm_1MwqOpHfhZt076luopvYRYsZ', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'ios', NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (64, 0, 'Itzel', 'Briseño', 'Ruiz', '', '(961) 292-1246', 'ittzelbr-bm@hotmail.com', NULL, 'gorditobello', 3, 1, 0, NULL, NULL, '2023-04-14', '2023-04-14 10:34:31', '5208', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'android', NULL, NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `usuarios` VALUES (65, 0, 'Adrian', 'Chandoqui', 'Castellanos', '', '(961) 234-9099', 'castellad94@gmail.com', NULL, '1234', 3, 1, 0, NULL, NULL, '1994-03-21', '2023-04-14 10:34:33', '1311', NULL, NULL, 'pm_1Mx0PFHfhZt076luwYrfcEsC', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'android', NULL, NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `usuarios` VALUES (96, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-03 11:59:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (97, 0, 'ale', 'hd', 'g', '', '(961) 217-0864', 'alelike02@gmail.com', NULL, '123456', 3, 1, 0, NULL, NULL, '2023-05-03', '2023-05-03 12:04:28', '2572', NULL, NULL, 'pm_1NW2LUHfhZt076lu8mdq8QeB', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'ios', NULL, NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `usuarios` VALUES (98, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-03 12:24:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (99, 0, 'Jorge', 'Zambrano', 'Mandujano', '', '(961) 132-8099', 'jozama@gmail.com', NULL, '123456', 3, 1, 0, NULL, NULL, '1978-05-15', '2023-05-03 13:48:47', '0292', NULL, NULL, 'pm_1N7m18HfhZt076luBNT536fx', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'ios', NULL, NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `usuarios` VALUES (100, 0, 'Benito', 'Gonzalez', NULL, '----', '(961) 217-0868', 'especialista4@gmail.com', 'especialista4@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (101, 0, 'Emiliano', 'Martínez', NULL, '----', '(961) 217-0870', 'especialista5@gmail.com', 'especialista5@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (102, 0, 'Christian', 'Vargas', NULL, '----', '(961) 217-0871', 'especialista6@gmail.com', 'especialista6@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (103, 0, 'Emanuel', 'Tapia', NULL, '----', '(961) 217-0872', 'especialista7@gmail.com', 'especialista7@gmail.com', '123456', 5, 1, 0, NULL, NULL, NULL, '2023-02-17 08:50:49', NULL, '2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (104, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-12 10:31:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (105, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-12 12:25:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (106, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-13 11:51:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `usuarios` VALUES (107, 0, NULL, NULL, NULL, '----', '----', NULL, NULL, NULL, 6, 1, 0, NULL, NULL, NULL, '2023-05-14 04:49:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
COMMIT;

-- ----------------------------
-- Table structure for usuarios_datosfiscales
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_datosfiscales`;
CREATE TABLE `usuarios_datosfiscales` (
  `idusuariosdatosfiscales` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL COMMENT '	',
  `rfc` varchar(250) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `nointerior` varchar(45) DEFAULT NULL COMMENT '	',
  `noexterior` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL COMMENT '	',
  `municipio` varchar(45) DEFAULT NULL COMMENT '	',
  `estado` varchar(45) DEFAULT NULL,
  `codigopostal` varchar(45) DEFAULT NULL COMMENT '	',
  `correo` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `asentamiento` varchar(45) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `calle1` varchar(255) DEFAULT NULL,
  `calle2` varchar(255) DEFAULT NULL,
  `referencia` text,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idusuariosdatosfiscales`),
  KEY `fk_clientes_datosfiscales_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_clientes_datosfiscales_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuarios_envios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_envios`;
CREATE TABLE `usuarios_envios` (
  `idusuarios_envios` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text,
  `no_ext` varchar(45) DEFAULT NULL,
  `no_int` varchar(45) DEFAULT NULL,
  `col` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `referencia` text,
  `telefono` varchar(255) DEFAULT NULL,
  `principal` int(11) DEFAULT '0',
  `calle` varchar(255) DEFAULT NULL,
  `calle1` varchar(255) DEFAULT NULL,
  `calle2` varchar(255) DEFAULT NULL,
  `asentamiento` varchar(45) DEFAULT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idusuarios_envios`) USING BTREE,
  KEY `fk_uuarios_envios_idx` (`idusuarios`),
  CONSTRAINT `fk_uuarios_envios_idx1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuarios_interesespersonales
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_interesespersonales`;
CREATE TABLE `usuarios_interesespersonales` (
  `idusuarios` int(11) NOT NULL,
  `idintereses` int(11) NOT NULL,
  `idusuariosintereses` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idusuariosintereses`),
  KEY `fk_usuarios_has_interesespersonales_interesespersonales1_idx` (`idintereses`),
  KEY `fk_usuarios_has_interesespersonales_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_usuarios_has_interesespersonales_interesespersonales1` FOREIGN KEY (`idintereses`) REFERENCES `interesespersonales` (`idintereses`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_interesespersonales_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios_interesespersonales
-- ----------------------------
BEGIN;
INSERT INTO `usuarios_interesespersonales` VALUES (64, 20, 69);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 25, 70);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 16, 71);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 19, 72);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 13, 73);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 41, 74);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 34, 75);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 17, 76);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 23, 77);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 18, 78);
INSERT INTO `usuarios_interesespersonales` VALUES (64, 35, 79);
INSERT INTO `usuarios_interesespersonales` VALUES (63, 16, 80);
INSERT INTO `usuarios_interesespersonales` VALUES (63, 19, 81);
INSERT INTO `usuarios_interesespersonales` VALUES (63, 7, 82);
INSERT INTO `usuarios_interesespersonales` VALUES (65, 21, 83);
INSERT INTO `usuarios_interesespersonales` VALUES (65, 16, 84);
INSERT INTO `usuarios_interesespersonales` VALUES (65, 19, 85);
COMMIT;

-- ----------------------------
-- Table structure for usuarios_membresia
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_membresia`;
CREATE TABLE `usuarios_membresia` (
  `idusuarios_membresia` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idmembresia` int(11) NOT NULL,
  `monto` varchar(45) DEFAULT NULL,
  `tarjeta` varchar(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) DEFAULT NULL COMMENT '0.-activa\n1.-inactiva',
  `fechainicial` varchar(255) DEFAULT NULL,
  `fechafinal` varchar(255) DEFAULT NULL,
  `fechapago` varchar(255) DEFAULT NULL,
  `pagado` int(11) DEFAULT NULL COMMENT '0.-no pagado\n1.-pagado',
  PRIMARY KEY (`idusuarios_membresia`),
  KEY `fk_usuarios_has_membresia_membresia1_idx` (`idmembresia`),
  KEY `fk_usuarios_has_membresia_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_usuarios_has_membresia_membresia1` FOREIGN KEY (`idmembresia`) REFERENCES `membresia` (`idmembresia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_membresia_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuarios_sucursal
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_sucursal`;
CREATE TABLE `usuarios_sucursal` (
  `idusuarios_servicios` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aceptarterminos` int(11) DEFAULT '0',
  `fechaaceptacion` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT '0',
  PRIMARY KEY (`idusuarios_servicios`),
  KEY `fk_usuarios_has_servicios_servicios1_idx` (`idservicio`),
  KEY `fk_usuarios_has_servicios_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_usuarios_has_servicios_servicios1` FOREIGN KEY (`idservicio`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_servicios_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuariossecundarios
-- ----------------------------
DROP TABLE IF EXISTS `usuariossecundarios`;
CREATE TABLE `usuariossecundarios` (
  `idusuariossecundario` int(11) NOT NULL AUTO_INCREMENT,
  `idusuariostutor` int(11) DEFAULT NULL,
  `idusuariotutorado` int(11) DEFAULT NULL,
  `idparentesco` int(11) NOT NULL,
  PRIMARY KEY (`idusuariossecundario`),
  KEY `fk_usuariossecundarios_parentesco1_idx` (`idparentesco`),
  CONSTRAINT `fk_usuariossecundarios_parentesco1` FOREIGN KEY (`idparentesco`) REFERENCES `parentesco` (`idparentesco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usuariotoken
-- ----------------------------
DROP TABLE IF EXISTS `usuariotoken`;
CREATE TABLE `usuariotoken` (
  `idusuariotoken` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `dispositivo` varchar(45) DEFAULT NULL,
  `fecharegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uuid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idusuariotoken`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuariotoken
-- ----------------------------
BEGIN;
INSERT INTO `usuariotoken` VALUES (1, 2, 'null', 'desktop', '2023-01-22 12:12:35', '000');
INSERT INTO `usuariotoken` VALUES (2, 2, 'null', 'desktop', '2023-01-22 12:17:22', '000');
INSERT INTO `usuariotoken` VALUES (3, 2, 'null', 'desktop', '2023-01-23 08:38:10', '000');
INSERT INTO `usuariotoken` VALUES (7, 9, 'null', 'android', '2023-02-27 16:38:09', '000');
INSERT INTO `usuariotoken` VALUES (8, 10, 'null', 'ios', '2023-02-27 16:49:33', '000');
INSERT INTO `usuariotoken` VALUES (9, 11, 'null', 'ios', '2023-02-27 16:54:15', '000');
INSERT INTO `usuariotoken` VALUES (10, 12, 'null', 'ios', '2023-02-27 16:56:27', '000');
INSERT INTO `usuariotoken` VALUES (14, 16, 'null', 'ios', '2023-03-08 17:00:15', '000');
INSERT INTO `usuariotoken` VALUES (16, 29, 'null', 'ios', '2023-04-10 14:20:11', '000');
INSERT INTO `usuariotoken` VALUES (17, 29, 'null', 'ios', '2023-04-10 14:26:43', '000');
INSERT INTO `usuariotoken` VALUES (18, 34, 'null', 'ios', '2023-04-10 15:15:37', '000');
INSERT INTO `usuariotoken` VALUES (20, 36, 'null', 'ios', '2023-04-10 15:33:06', '000');
INSERT INTO `usuariotoken` VALUES (29, 64, 'null', 'android', '2023-04-14 10:37:28', '000');
INSERT INTO `usuariotoken` VALUES (32, 65, 'null', 'android', '2023-04-14 10:49:07', '000');
COMMIT;

-- ----------------------------
-- Procedure structure for descargasapp
-- ----------------------------
DROP PROCEDURE IF EXISTS `descargasapp`;
delimiter ;;
CREATE PROCEDURE `base125`.`descargasapp`()
BEGIN
 
SET @ios=(SELECT COUNT(*) as ios FROM (SELECT
clientetoken.*
FROM
clientetoken WHERE idcliente=0  GROUP BY uuid) as tabla WHERE dispositivo='ios');

SET @android=(SELECT COUNT(*) as ios FROM (SELECT
clientetoken.*
FROM
clientetoken WHERE idcliente=0   GROUP BY uuid) as tabla WHERE dispositivo='android');


SELECT @ios as ios,@android as android;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_empleados
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_empleados`;
delimiter ;;
CREATE PROCEDURE `base125`.`p_empleados`(in idempleados int,
in idempresas int,
in estatus int,
in accion varchar(100))
BEGIN
  CASE accion
    WHEN 'bxidempleados' then
          SELECT * FROM empleados WHERE idempleados = idempleados ;
	WHEN 'bxidempresas' then
		  SELECT * FROM empleados WHERE idempresas = idempresas ;
	WHEN 'bxestatus' then
		  SELECT * FROM empleados WHERE estatus = estatus ;
  END CASE;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
