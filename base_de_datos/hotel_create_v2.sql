/*
 * BASE DE DATOS QUE PRESENTA LA CREACIÓN DE LAS TABLAS USADAS PARA EL ALMACENAMIENTO DE LA INFORMACIÓN QUE SE MANEJA EN EL HOTEL
 * CREADA POR: ANDRÉS FELIPE CHAPARRO ROSAS - FABIAN ALEJANDRO CRISTANCHO RINCÓN
 * FECHA DE CREACIÓN: 22/01/2019
 * VERSIÓN: 1.1
 */

mysql.exe -u root
use hotelaristo;

/**Borrado de tablas en caso de que existan**/
DROP TABLE IF EXISTS Paises;
DROP TABLE IF EXISTS Ciudades;

DROP TABLE IF EXISTS facturas;
DROP TABLE IF EXISTS control_diario;
DROP TABLE IF EXISTS registros_habitacion;
DROP TABLE IF EXISTS reservas;
DROP TABLE IF EXISTS personas;
DROP TABLE IF EXISTS lugares;
DROP TABLE IF EXISTS habitaciones;
DROP TABLE IF EXISTS tarifas;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS tipos_habitacion;
DROP TABLE IF EXISTS tipos_producto;
DROP TABLE IF EXISTS servicios;
DROP TABLE IF EXISTS empresas;
DROP TABLE IF EXISTS cargos;
DROP TABLE IF EXISTS profesiones;



/**Creación de tablas**/

CREATE TABLE IF NOT EXISTS profesiones(
	id_profesion INT(4) NOT NULL AUTO_INCREMENT,
	nombre_profesion VARCHAR(100) NOT NULL,
	CONSTRAINT prof_pk_idp PRIMARY KEY (id_profesion)
);


CREATE TABLE IF NOT EXISTS cargos (
	id_cargo INT(2) NOT NULL AUTO_INCREMENT,
	nombre_cargo VARCHAR(40) NOT NULL,
	descripcion_cargo VARCHAR(100),
	CONSTRAINT car_pk_idc PRIMARY KEY (id_cargo)
);


CREATE TABLE IF NOT EXISTS empresas(
	id_empresa INT(6) NOT NULL AUTO_INCREMENT,
	nombre_empresa VARCHAR(150) NOT NULL,
	nit_empresa VARCHAR(20) NOT NULL,
	correo_empresa VARCHAR(100),
	telefono_empresa VARCHAR(15),
	retefuente BOOLEAN,
	ica BOOLEAN,
	CONSTRAINT emp_pk_ide PRIMARY KEY (id_empresa)
);


CREATE TABLE IF NOT EXISTS servicios(
	id_servicio INT(2) NOT NULL AUTO_INCREMENT,
	nombre_servicio VARCHAR(30) NOT NULL,
	descripcion_servicio VARCHAR(100),
	valor_servicio INT(5) NOT NULL,
	CONSTRAINT ser_pk_ids PRIMARY KEY (id_servicio)
);


CREATE TABLE IF NOT EXISTS tipos_producto(
	id_tipo_producto INT(3) NOT NULL AUTO_INCREMENT,
	nombre_tipo_producto VARCHAR(50) NOT NULL,
	CONSTRAINT tipro_pk_idt PRIMARY KEY (id_tipo_producto)
);


CREATE TABLE IF NOT EXISTS productos(
	id_producto INT(3) NOT NULL AUTO_INCREMENT,
	id_tipo_producto INT(3) NOT NULL,
	nombre_producto VARCHAR(150) NOT NULL,
	valor_producto INT(6) NOT NULL,
	CONSTRAINT prod_pk_idp PRIMARY KEY (id_producto)
);


CREATE TABLE IF NOT EXISTS tipos_habitacion(
	id_tipo_habitacion INT(2) NOT NULL AUTO_INCREMENT,
	nombre_tipo_habitacion VARCHAR(30) NOT NULL,
	CONSTRAINT tih_pk_idt PRIMARY KEY(id_tipo_habitacion)
);


CREATE TABLE IF NOT EXISTS tarifas(
	id_tarifa INT(3) NOT NULL AUTO_INCREMENT,
	id_tipo_habitacion INT(2) NOT NULL,
	cantidad_huespedes INT(2) NOT NULL,
	derecho_desayuno BOOLEAN NOT NULL, 
	valor_ocupacion  INT(7) NOT NULL,
	CONSTRAINT tar_pk_idt PRIMARY KEY(id_tarifa)
);


CREATE TABLE IF NOT EXISTS habitaciones(
	id_habitacion INT(2) NOT NULL AUTO_INCREMENT,
	id_tipo_habitacion INT(2) NOT NULL,
	numero_habitacion INT(3) NOT NULL,
	estado_habitacion CHAR(1) NOT NULL,
	CONSTRAINT hab_pk_idh PRIMARY KEY (id_habitacion)
);


CREATE TABLE IF NOT EXISTS lugares(
	id_lugar INT(8) NOT NULL AUTO_INCREMENT,
	id_ubicacion INT(8),
	nombre_lugar VARCHAR(100) NOT NULL,
	tipo_lugar CHAR(1) NOT NULL,
	CONSTRAINT lug_pk_idl PRIMARY KEY (id_lugar)
);


CREATE TABLE IF NOT EXISTS personas(
	id_persona INT(8) NOT NULL AUTO_INCREMENT,
	id_lugar_nacimiento INT(8),
	id_lugar_expedicion INT(8),
	id_profesion INT(4),
	id_empresa INT(6),
	id_cargo INT(1),
	nombres_persona VARCHAR(150) NOT NULL,
	apellidos_persona VARCHAR(150) NOT NULL,
	tipo_documento VARCHAR(2),
	numero_documento VARCHAR(20),
	genero_persona CHAR(1),
	fecha_nacimiento DATE,
	tipo_sangre_rh VARCHAR(2),
	telefono_persona VARCHAR(15) NOT NULL,
	correo_persona VARCHAR(100),
	tipo_persona CHAR(1) NOT NULL,
	nombre_usuario VARCHAR(60) DEFAULT 'No asignado' INVISIBLE,  
	contrasena_usuario VARCHAR(32)  DEFAULT 'No asignado' INVISIBLE, 
	CONSTRAINT per_pk_idp PRIMARY KEY (id_persona)
);


CREATE TABLE IF NOT EXISTS reservas (
	id_reserva INT(8) NOT NULL AUTO_INCREMENT,
	id_usuario INT(2) NOT NULL,
	id_titular INT(8) NOT NULL,
	fecha_ingreso DATE NOT NULL,
	fecha_salida DATE NOT NULL,
	observaciones VARCHAR(100),
	medio_pago CHAR(2) NOT NULL,
	estado_pago_reserva CHAR(1) NOT NULL,
	estado_reserva VARCHAR(2) NOT NULL,
	CONSTRAINT res_pk_idr PRIMARY KEY(id_reserva)
);


CREATE TABLE IF NOT EXISTS registros_habitacion(
	id_registro_habitacion INT(8) NOT NULL AUTO_INCREMENT,
	id_reserva INT(8) NOT NULL,
	id_habitacion INT(2) NOT NULL,
	id_tarifa INT(3) NOT NULL,
	estado_registro VARCHAR(3) NOT NULL,
	CONSTRAINT reg_pk_idr PRIMARY KEY (id_registro_habitacion)
);


CREATE TABLE IF NOT EXISTS registros_huesped(
	id_registro_huesped INT(8) NOT NULL AUTO_INCREMENT,
	id_huesped INT(8) NOT NULL,
	id_registro_habitacion INT(8) NOT NULL,
	CONSTRAINT regh_pk_idh PRIMARY KEY (id_registro_huesped)
);


CREATE TABLE IF NOT EXISTS control_diario(
   	id_control INT(8) NOT NULL AUTO_INCREMENT,
   	id_registro_habitacion INT(8) NOT NULL,
   	id_servicio INT(2),
   	id_producto INT(3), 
   	fecha_solicitud_compra DATE NOT NULL,
   	medio_pago CHAR(2) NOT NULL,
   	estado_saldo CHAR(1) NOT NULL,
   	cantidad_producto INT(2),
   	CONSTRAINT con_pk_idc PRIMARY KEY(id_control)
);


CREATE TABLE IF NOT EXISTS facturas(
   	id_factura INT(5) NOT NULL AUTO_INCREMENT,
   	id_reserva INT(8) NOT NULL,
   	id_control INT(8) NOT NULL,
   	serie_factura VARCHAR(5) NOT NULL,
   	medio_pago_factura CHAR(2) NOT NULL,
   	estado_factura CHAR(1) NOT NULL,
   	tipo_factura CHAR(1) NOT NULL,
   	CONSTRAINT fac_pk_idf PRIMARY KEY(id_factura)
);


/** Actualización de tablas **/

ALTER TABLE servicios ADD(
	CONSTRAINT serv_ck_val CHECK (valor_servicio > 0)
);


ALTER TABLE productos ADD(
	CONSTRAINT prod_fk_idtp FOREIGN KEY (id_tipo_producto) REFERENCES tipos_producto(id_tipo_producto),
	CONSTRAINT prod_ck_val CHECK (valor_producto > 0)
);


ALTER TABLE tarifas ADD(
	CONSTRAINT tar_fk_idt FOREIGN KEY (id_tipo_habitacion) REFERENCES tipos_habitacion(id_tipo_habitacion),
	CONSTRAINT tar_ck_val CHECK (valor_ocupacion > 0)
);


ALTER TABLE habitaciones ADD(
	CONSTRAINT hab_fk_idt FOREIGN KEY (id_tipo_habitacion) REFERENCES tipos_habitacion(id_tipo_habitacion),
	CONSTRAINT hab_ck_est CHECK (estado_habitacion IN ('O' /*OCUPADA*/, 'R' /*CON RESERVA*/, 'L' /*LIBRE*/, 'X' /*FUERA DE SERVICIO*/))
);


ALTER TABLE lugares ADD(
	CONSTRAINT lug_fk_idu FOREIGN KEY (id_ubicacion) REFERENCES lugares (id_lugar),
	CONSTRAINT lug_ck_tpl CHECK (tipo_lugar IN ('P' /*PAIS*/, 'D' /*DEPARTAMENTO*/, 'C' /*CIUDAD*/))
);


ALTER TABLE personas ADD(
	CONSTRAINT per_ck_tpd CHECK (tipo_documento IN ('CC' /*CÉDULA DE CIUDADANÍA*/, 'TI' /*TARJETA DE IDENTIDAD*/, 'CE' /*CÉDULA DE EXTRANJERÍA*/, 'PS' /*PASAPORTE*/)),
	CONSTRAINT per_ck_gnr CHECK (genero_persona IN ('M' /*MASCULINO*/, 'F' /*FEMENINO*/, 'O'/*OTRO*/)),
	CONSTRAINT per_ck_tpp CHECK (tipo_persona IN ('U' /*USUARIO*/, 'C'/*CLIENTE*/,'A' /*AMBOS*/)),
	CONSTRAINT per_fk_idln FOREIGN KEY (id_lugar_nacimiento) REFERENCES lugares (id_lugar),
	CONSTRAINT per_fk_idle FOREIGN KEY (id_lugar_expedicion) REFERENCES lugares (id_lugar),
	CONSTRAINT per_fk_idp FOREIGN KEY (id_profesion) REFERENCES profesiones (id_profesion),
	CONSTRAINT per_fk_ide FOREIGN KEY (id_empresa) REFERENCES empresas (id_empresa),
	CONSTRAINT per_fk_idc FOREIGN KEY (id_cargo) REFERENCES cargos (id_cargo)
);


ALTER TABLE reservas ADD (
	CONSTRAINT res_ck_estr CHECK (estado_reserva IN ('AC'/*Activa*/,'RE'/*Recibida*/,'CA'/*Cancelada*/)),
	CONSTRAINT res_ck_estp CHECK (estado_pago_reserva IN ('C'/*COMPLETO*/, 'I'/*INCOMPLETO*/)),
	CONSTRAINT res_ck_med CHECK (medio_pago IN ('E'/*EFECTIVO*/, 'T'/*TARJETA*/,'C'/*CONSIGNACIÓN*/, 'CC'/*CUENTAS POR COBRAR*/)),
	CONSTRAINT res_fk_idu FOREIGN KEY (id_usuario) REFERENCES personas (id_persona),
	CONSTRAINT res_fk_idp FOREIGN KEY (id_titular) REFERENCES personas (id_persona)
);


ALTER TABLE registros_habitacion ADD(
	CONSTRAINT reg_fk_idr FOREIGN KEY (id_reserva) REFERENCES reservas (id_reserva),
	CONSTRAINT reg_fk_idh FOREIGN KEY (id_habitacion) REFERENCES habitaciones (id_habitacion),
	CONSTRAINT reg_fk_idt FOREIGN KEY (id_tarifa) REFERENCES tarifas (id_tarifa),
	CONSTRAINT reg_ck_est CHECK (estado_registro IN ('CI' /*CHECK-IN*/, 'COT'/*CHECK-OUT*/, 'CU' /*CHECK-UP*/, 'CON'/*CHECK-ON*/))
);


ALTER TABLE registros_huesped ADD(
	CONSTRAINT regh_fk_idp FOREIGN KEY (id_huesped) REFERENCES personas (id_persona),
	CONSTRAINT regh_fk_idr FOREIGN KEY (id_registro_habitacion) REFERENCES registros_habitacion (id_registro_habitacion)
);


ALTER TABLE control_diario ADD (
	CONSTRAINT con_ck_ess CHECK (estado_saldo IN ('C'/*COMPLETO*/, 'I'/*INCOMPLETO*/)),
	CONSTRAINT con_ck_med CHECK (medio_pago IN ('E'/*EFECTIVO*/, 'T'/*TARJETA*/,'C'/*CONSIGNACIÓN*/, 'CC'/*CUENTAS POR COBRAR*/)),
   	CONSTRAINT con_fk_idr FOREIGN KEY (id_registro_habitacion) REFERENCES registros_habitacion(id_registro_habitacion),
   	CONSTRAINT con_fk_ids FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio),
   	CONSTRAINT con_fk_idp FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);


ALTER TABLE facturas ADD(
	CONSTRAINT fac_fk_idr FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva),
   	CONSTRAINT fac_fk_idc FOREIGN KEY (id_control) REFERENCES control_diario(id_control),
   	CONSTRAINT fac_ck_tip CHECK (tipo_factura IN ('N' /*FACTURA NORMAL*/, 'O' /*ORDEN DE SERVICIO*/)),
   	CONSTRAINT fac_ck_med CHECK (medio_pago_factura IN ('E'/*EFECTIVO*/, 'T'/*TARJETA*/, 'M' /*MIXTO*/, 'C'/*CONSIGNACIÓN*/, 'CC'/*CUENTAS POR COBRAR*/)),
   	CONSTRAINT fac_ck_es CHECK (estado_factura IN ('C' /*COBRADA*/, 'A' /*ANULADA*/))
);



/** Asignación de tablas */
----------------------------------------------------------------------------------------------
INSERT INTO lugares (nombre_lugar,tipo_lugar) (
	SELECT Pais, 'P' FROM paises
);

-------------------------------------------------------------------------------------------------
INSERT INTO lugares (id_ubicacion,nombre_lugar,tipo_lugar) (
	SELECT id_lugar,Ciudad, 'C' 
	FROM ciudades,(SELECT id_lugar,codigo
		FROM lugares, paises
		WHERE nombre_lugar=pais) pais
	WHERE paises_codigo=codigo
);