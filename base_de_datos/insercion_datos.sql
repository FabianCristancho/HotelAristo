/*
 * INSERCIÓN DE DATOS EN TABLAS
 * CREADA POR: ANDRÉS FELIPE CHAPARRO ROSAS - FABIAN ALEJANDRO CRISTANCHO RINCÓN
 * FECHA DE CREACIÓN: 23/01/2019
 * VERSIÓN: 1.1
 */

-- ==========================================CARGOS============================================
INSERT INTO cargos (nombre_cargo) VALUES 
('Directora administrativa'),('Coordinadora'),('Recepcionista'),('Camarera'),('Superusuario');
-- ==========================================CARGOS============================================




-- ==========================================PROFESIONES (EJEMPLO)==============================================================
INSERT INTO profesiones (nombre_profesion) VALUES 
('INGENIERO'), ('ECONOMINSTA'), ('ESTUDIANTE'), ('CONDUCTOR'), ('MECÁNICO'), ('MODISTA'), ('ESTILISTA'), ('PANADERO');
-- ===================================================================================================================




-- ==========================================PERSONAS (USUARIOS)=========================================================================================
INSERT INTO personas(id_lugar_nacimiento,id_lugar_expedicion,nombres_persona,apellidos_persona, tipo_documento,numero_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh, telefono_persona,correo_persona, tipo_persona, id_cargo, nombre_usuario, contrasena_usuario) VALUES
(40040, 39828,'ANDRES FELIPE','CHAPARRO ROSAS','CC','1052411460','M','1997-10-23','A+','3123871293',NULL, 'U',5,'andres.chaparro',md5('admin')),
(40040, 39828,'FABIAN ALEJANDRO','CRISTANCHO RINCON','CC','1053588031','M','1999-05-29','B+','3125743447',NULL, 'U',5,'fabian.cristancho',md5('admin'));
-- =====================================================================================================================================================




-- ==========================================PERSONAS (CLIENTES) (EJEMPLO)==================================================================================================================================================================================================
INSERT INTO personas (`id_lugar_nacimiento`, `id_lugar_expedicion`, `id_empresa`, `nombres_persona`, `apellidos_persona`, `tipo_documento`, `numero_documento`, `genero_persona`, `fecha_nacimiento`, `tipo_sangre_rh`, `telefono_persona`, `tipo_persona`) VALUES 
(40040, 39828, 1, 'CARLOS ANDRES','CHAPARRO RINCON','CC','1052434460','M','1987-11-25','B+','3125671293', 'C'),
(40040, 39828, 1, 'FELIPE ANTOIO','ROSAS BARRERA','CC','1045411460','M','1990-10-19','O+','3122371293', 'C'), 
(40040, 39828, 1, 'FABIAN ALEJANDRO','CRISTANCHO RINCON','CC','1052451460','M','1999-05-28','B+','3125743447', 'C'), 
(40040, 39828, 1, 'MARIA HELENA','ROJAS VELEZ','TI','10534567654','F','1988-12-21','O-','3103321293', 'C'),
(40040, 39828, 1, 'MARIA FERNANDA','TELLEZ PEREZ','CC','1051451460','M','1998-11-23','A+','3123878793', 'C'), 
(40040, 39828, 2, 'ERNESTO','CHAPARRO ROSAS','CC','1053455460','M','2000-10-23','B+','3103471293', 'C'),
(40040, 39828, 2, 'CAMILO ANDRES','BARRERA ROSAS','CC','10504563728','M','1993-10-23','B+','3123982293', 'C'), 
(40040, 39828, 2, 'ANA PATRICIA','CARDENAS PEREZ','CC','1052391460','F','1992-03-04','B+','3123871293', 'C'),
(40040, 39828, 1, 'ANA DEISY','SEPULVEDA GIRALDO','CC','10535446732','F','1990-05-26','A+','3123871323', 'C'), 
(40040, 39828, 3, 'FELIPE ALEJANDRO','ROSAS RINCON','CC','1053565460','M','1994-11-27','B+','3123871293', 'C');
-- ==============================================================================================================================================================




-- ==========================================EMPRESAS (EJEMPLO)============================
INSERT INTO empresas (nit_empresa, nombre_empresa, telefono_empresa, retefuente) VALUES 
('811028650-1', 'MADECENTRO COLOMBIA SAS', '7603323', 1),
('900548102-0', 'AZTECA COMUNICACIONES SAS', '3124593207', 0),
('830004993-8', 'CASA TORO S.A', '6760022', 1);
-- ========================================================================================




-- ==========================================SERVICIOS===============================================
INSERT INTO servicios (`nombre_servicio`, `descripcion_servicio`, `valor_servicio`) VALUES 
('LAVANDERIA', 'SE COBRA DEPENDIENDO DE LA PRENDA', 12000),
('RESTAURANTE', 'SE COBRA DEPENDIENDO DEL PLATO', 12000),
('MINIBAR', 'SE COBRA DEPENDIENDO DEL PRODUCTO', 5000);
-- ==================================================================================================




-- ==========================================TIPOS PRODUCTO==================================================================================================
INSERT INTO tipos_producto (nombre_tipo_producto) VALUES
('BEBIDAS ALCOHÓLICAS'),
('ASEO'),
('BEBIDAS GASEOSAS'),
('GALGUERIAS'),
('GALLETAS'),
('CHOCOLATINAS');
-- ========================================================================================================================================================




-- ==========================================PRODUCTOS==================================================================================================
INSERT INTO productos (`id_tipo_producto`, `nombre_producto`, `valor_producto`) VALUES 
(1, 'CERVEZA ANDINA', 1),
(1, 'CERVEZA CORONA', 1),
(1, 'WHISKY', 1),
(1, 'VINO', 1),
(2, 'PAÑUELITOS', 1),
(2, 'GEL EGO', 1),
(2, 'CEPILLO DE DIENTES', 1),
(2, 'MÁQUINA DE AFEITAR', 1),
(2, 'CREMA DENTAL', 1),
(2, 'CERA EGO', 1),
(2, 'CREMA DE PEINAR', 1),
(2, 'ALKASELTZER', 1),
(2, 'ASPIRINA', 1),
(2, 'CURITAS', 1),
(2, 'DESODORANTE', 1),
(2, 'LISTERINE', 1),
(2, 'PROTECTORES DIARIOS', 1),
(2, 'CONDONES TODAY', 1),
(2, 'SHAMPOO', 1),
(2, 'SEDA DENTAL', 1),
(2, 'ACETAMINOFEN', 1),
(2, 'BONFIEST PLUS', 1),
(2, 'BUSCAPINA', 1),
(2, 'DURAFLEX', 1),
(3, 'RED BULL', 1),
(3, 'BRETAÑA', 1),
(3, 'AGUA GRANDE', 1),
(3, 'GASEOSA MANZANA', 1),
(3, 'GASEOSA COLOMBIANA', 1),
(3, 'CANADA DRY', 1),
(3, 'MR TEA DE LIMÓN', 1),
(3, 'MR TEA DE DURAZNO', 1),
(3, 'GATORADE', 1),
(3, 'JUGOS BOTELLA', 1),
(3, 'COCA COLA', 1),
(4, 'TODORICOS', 1),
(4, 'MINICHIPS', 1),
(4, 'PAPAS PRINGLES', 1),
(4, 'TROCIPOLLOS', 1),
(4, 'CHICHARRÓN', 1),
(4, 'TAJAMIEL', 1),
(4, 'PAPAS SUPER RICAS', 1),
(4, 'DETODITO', 1),
(4, 'CHOCORRAMO', 1),
(4, 'PONQUÉ GALA', 1),
(4, 'MANÍ ESPECIAL', 1),
(4, 'MANÍ DE ARÁNDANOS', 1),
(4, 'SALCHICHAS', 1),
(5, 'MORENITAS', 1),
(5, 'COCOSETTE', 1),
(5, 'TOSH', 1),
(5, 'DUX', 1),
(5, 'MILO', 1),
(5, 'WAFER JET', 1),
(5, 'DEDITOS', 1),
(6, 'JUMBO MANÍ', 1),
(6, 'JET', 1),
(6, 'NUGGETS DE MILO', 1);
-- =====================================================================================================================================================




-- ==========================================TIPOS HABITACION (EJEMPLO)==========================================================================================
INSERT INTO tipos_habitacion (nombre_tipo_habitacion) VALUES 
('JOLIOT'),
('HAWKING'),
('LISPECTOR'),
('MAKKAH');
-- ==============================================================================================================================================================




-- ==========================================TARIFAS (EJEMPLO)===================================================================================================
INSERT INTO tarifas (id_tipo_habitacion, cantidad_huespedes, valor_desayuno, valor_ocupacion) VALUES 
(1,1,0,75000),(1,1,1,85000),(1,2,0,110000),(1,2,1,120000),(1,2,1,135000),(1,3,1,165000),(1,4,1,195000),
(2,1,0,75000),(2,1,1,85000),(2,2,0,110000),(2,2,1,120000),(2,2,1,135000),(2,3,1,165000),(2,4,1,195000),
(3,1,0,75000),(3,1,1,85000),
(4,1,0,75000),(4,2,1,165000);
-- ===============================================================================================================================================================




-- ==========================================HABITACIONES (EJEMPLO)=====================================================================================================
INSERT INTO habitaciones (id_tipo_habitacion, numero_habitacion, estado_habitacion) VALUES
(1, 201, 'O'),
(2, 202, 'R'),
(1, 301, 'O'),
(1, 302, 'R'),
(1, 303, 'L'),
(3, 304, 'O'),
(1, 401, 'R'),
(1, 402, 'L'),
(1, 403, 'L'),
(3, 404, 'O'),
(1, 501, 'R'),
(1, 502, 'R'),
(1, 503, 'X'),
(3, 504, 'R'),
(1, 601, 'X'),
(1, 602, 'L'),
(4, 603, 'L');
-- ======================================================================================================================================================================




-- ==========================================RESERVAS (EJEMPLO)=====================================================================================================
INSERT into reservas (`id_usuario`, `id_titular`, `fecha_ingreso`, `fecha_salida`, `medio_pago`, `estado_pago_reserva`, `estado_reserva`) VALUES 
(1, 1,  '2020-01-15', '2020-01-22', 'E', 'C', 'RE'),
(1, 2,  '2020-01-17', '2020-01-25', 'E', 'C', 'RE'),
(1, 3,  '2020-01-19', '2020-01-26', 'E', 'C', 'AC'),
(1, 4,  '2020-01-18', '2020-01-27', 'E', 'C', 'RE'),
(1, 5,  '2020-01-18', '2020-01-28', 'E', 'C', 'RE'),
(1, 6,  '2020-01-13', '2020-01-22', 'E', 'C', 'RE'),
(1, 7,  '2020-01-16', '2020-01-21', 'E', 'C', 'AC'),
(1, 8,  '2020-01-13', '2020-01-22', 'E', 'C', 'RE'),
(1, 9,  '2020-01-14', '2020-01-27', 'E', 'C', 'CA'),
(1, 10, '2020-01-15', '2020-01-23', 'E', 'C', 'RE');
-- =====================================================================================================================================================




-- ==========================================REGISTROS HABITACION (EJEMPLO)===============================================================================
INSERT INTO registros_habitacion (id_reserva, id_habitacion, id_tarifa, estado_registro) VALUES
(1, 3, 1, 'CI'),
(2, 4, 3, 'COT'),
(3, 1, 5, 'CI'),
(6, 11, 5, 'CU');
-- =================================================================================================================================================================




-- ==========================================REGISTROS HUESPED (EJEMPLO)=================================================================================
INSERT INTO registros_huesped (id_huesped, id_registro_habitacion) VALUES
(3, 1),
(6, 1),
(7, 1),
(4, 4),
(1, 4),
(8, 3),
(5, 2),
(9, 2),
(10, 2);

-- =================================================================================================================================================================




-- ==========================================CONTROL DIARIO==================================================================================================
INSERT INTO control_diario (`id_registro_habitacion`, `id_servicio`, `id_producto`, `fecha_solicitud_compra`, `medio_pago`, `estado_saldo`, `cantidad_producto`) VALUES 
(1, 1, 1, '2020-01-23', 'E', 'C', 5),
(2, 2, NULL, '2020-01-20', 'E', 'I', NULL),
(3, NULL, 3, '2020-01-21', 'T', 'C', 2);