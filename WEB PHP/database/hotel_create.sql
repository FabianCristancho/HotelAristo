/*
 * CREATE ALTER DROP INSERT SELECT FROM INTO VALUES 
 * TABLE ADD
 * INT VARCHAR CHAR DATE DECIMAL NOT NULL CONSTRAINT PRIMARY FOREIGN KEY AUTO_INCREMENT REFERENCES
 * OR AND ORDER GROUP BY 
 * id_ nombre_ estado_ numero_ codigo_ tipo_ fecha_
 */

mysql.exe -u root
use hotelaristo;


DROP TABLE Paises;
DROP TABLE Ciudades;

DROP TABLE registros_habitacion;
DROP TABLE reservas;
DROP TABLE usuarios;
DROP TABLE clientes;
DROP TABLE personas;
DROP TABLE habitaciones;
DROP TABLE servicios;
DROP TABLE cargos;
DROP TABLE empresas;
DROP TABLE profesiones;
DROP TABLE lugares;

CREATE TABLE lugares(
	id_lugar INT(8) NOT NULL AUTO_INCREMENT,
	id_ubicacion INT(8),
	nombre_lugar VARCHAR(100) NOT NULL,
	tipo_lugar CHAR(1) NOT NULL,
	CONSTRAINT lug_pk_idl PRIMARY KEY (id_lugar)
);

CREATE TABLE profesiones(
	id_profesion INT(4) NOT NULL AUTO_INCREMENT,
	nombre_profesion VARCHAR(100) NOT NULL,
	CONSTRAINT pro_pk_idp PRIMARY KEY (id_profesion)
);

CREATE TABLE empresas(
	id_empresa INT(6) NOT NULL AUTO_INCREMENT,
	nombre_empresa VARCHAR(150) NOT NULL,
	nit_empresa VARCHAR(20) NOT NULL,
	correo_empresa VARCHAR(100),
	telefono_empresa VARCHAR(15),
	retefuente BOOLEAN,
	otro_retefuente BOOLEAN,
	CONSTRAINT emp_pk_ide PRIMARY KEY (id_empresa)
);

CREATE TABLE cargos (
	id_cargo INT(2) NOT NULL AUTO_INCREMENT,
	nombre_cargo VARCHAR(40) NOT NULL,
	descripcion_cargo VARCHAR(100),
	CONSTRAINT car_pk_idc PRIMARY KEY (id_cargo)
);

CREATE TABLE servicios(
	id_servicio INT(2) NOT NULL AUTO_INCREMENT,
	nombre_servicio VARCHAR(30) NOT NULL,
	descripcion_servicio VARCHAR(100),
	valor_servicio INT(5) NOT NULL,
	CONSTRAINT ser_pk_ids PRIMARY KEY (id_servicio)
);


CREATE TABLE habitaciones(
	id_habitacion INT(2) NOT NULL AUTO_INCREMENT,
	tipo_habitacion CHAR(1) NOT NULL,
	numero_habitacion INT(3) NOT NULL,
	capacidad_maxima INT(1) NOT NULL,
	estado_habitacion CHAR(1) NOT NULL,
	tarifa_habitacion INT(7) NOT NULL,
	CONSTRAINT hab_pk_idh PRIMARY KEY (id_habitacion)
);

CREATE TABLE personas(
	id_persona INT(8) NOT NULL AUTO_INCREMENT,
	id_lugar_nacimiento INT(8) NOT NULL,
	id_lugar_expedicion INT(8) NOT NULL,
	nombres_persona VARCHAR(150) NOT NULL,
	apellidos_persona VARCHAR(150) NOT NULL,
	tipo_documento VARCHAR(2) NOT NULL,
	numero_documento VARCHAR(20) NOT NULL,
	genero_persona CHAR(1) NOT NULL,
	fecha_nacimiento DATE NOT NULL,
	tipo_sangre_rh VARCHAR(2) NOT NULL,
	telefono_persona VARCHAR(15) NOT NULL,
	correo_persona VARCHAR(100),
	CONSTRAINT per_pk_idp PRIMARY KEY (id_persona)
);

CREATE TABLE personas_auxiliares(
	id_persona_aux INT(8) NOT NULL AUTO_INCREMENT,
	nombres_persona VARCHAR(150) NOT NULL,
	apellidos_persona VARCHAR(150) NOT NULL,
	telefono_persona VARCHAR(15) NOT NULL,
	correo_persona VARCHAR(100),
	CONSTRAINT pax_pk_idp PRIMARY KEY (id_persona_aux)
);

CREATE TABLE clientes(
	id_cliente INT(8) NOT NULL AUTO_INCREMENT,
	id_persona INT(8),
	id_persona_aux INT(8),
	id_empresa INT(6),
	id_profesion INT(4) NOT NULL,
	CONSTRAINT cli_pk_idc PRIMARY KEY (id_cliente)
);


CREATE TABLE usuarios (
	id_usuario INT(2) NOT NULL AUTO_INCREMENT,  
	nombre_usuario VARCHAR(60) NOT NULL,  
	contrasena_usuario VARCHAR(32) NOT NULL,
	id_persona INT(8) NOT NULL,
	id_cargo INT(1) NOT NULL,
	CONSTRAINT usu_pk_idu PRIMARY KEY (id_usuario)  
);

CREATE TABLE reservas (
	id_reserva INT(8) NOT NULL AUTO_INCREMENT,
	id_cliente INT(8) NOT NULL,
	id_usuario INT(2) NOT NULL,
	id_lugar INT(8) NOT NULL,
	observaciones VARCHAR(100) NOT NULL,
	valor_reserva INT(7) NOT NULL,
	medio_pago VARCHAR(2) NOT NULL,
	CONSTRAINT res_pk_idr PRIMARY KEY(id_reserva)
);

CREATE TABLE registros_habitacion(
	id_registro INT(8) NOT NULL AUTO_INCREMENT,
	id_reserva INT(8) NOT NULL,
	id_habitacion INT(2) NOT NULL,
	fecha_ingreso DATE NOT NULL,
	fecha_salida DATE NOT NULL,
	estado_registro VARCHAR(2) NOT NULL,
	CONSTRAINT reg_pk_idr PRIMARY KEY (id_registro)
);


CREATE TABLE impuestos(
	id_impuesto INT(3) NOT NULL AUTO_INCREMENT,
	nombre_impuesto VARCHAR(30) NOT NULL,
	porcentaje_retefuente DECIMAL(6,5) NOT NULL,
	CONSTRAINT imp_pk_idi PRIMARY KEY (id_impuesto)
);

CREATE TABLE tarifas(
	id_tarifa INT(3) NOT NULL AUTO_INCREMENT,
	tipo_desayuno CHAR(1) NOT NULL,
	valor_tarifa DECIMAL INT(6) NOT NULL,
	CONSTRAINT tar_pk_idt PRIMARY KEY (id_tarifa)
);


ALTER TABLE lugares ADD(
	CONSTRAINT lug_fk_idu FOREIGN KEY (id_ubicacion)
	REFERENCES lugares (id_lugar),
	CONSTRAINT lug_ck_tpl CHECK (tipo_lugar in ('P','D','C'))
);

ALTER TABLE habitaciones ADD(
	CONSTRAINT hab_ck_tph CHECK (tipo_habitacion in ('J','H','M','L')),
	CONSTRAINT hab_ck_esh CHECK (tipo_habitacion in ('D','O','M','F'))
);

ALTER TABLE personas ADD(
	CONSTRAINT per_ck_tpd CHECK (tipo_documento in ('CC','TI','CE','PS')),
	CONSTRAINT per_ck_gnr CHECK (genero_persona in ('M','F'))
);

ALTER TABLE clientes ADD(
	CONSTRAINT cli_fk_idp FOREIGN KEY (id_persona)
	REFERENCES personas (id_persona),
	CONSTRAINT cli_fk_idx FOREIGN KEY (id_persona_aux)
	REFERENCES personas_auxiliares (id_persona_aux),
	CONSTRAINT cli_fk_ide FOREIGN KEY (id_empresa)
	REFERENCES empresas (id_empresa)
);

ALTER TABLE usuarios ADD(
	CONSTRAINT usu_fk_idp FOREIGN KEY (id_persona)
	REFERENCES personas (id_persona),
	CONSTRAINT usu_fk_idc FOREIGN KEY (id_cargo)
	REFERENCES cargos (id_cargo)
);

ALTER TABLE reservas ADD (
	CONSTRAINT res_fk_idc FOREIGN KEY (id_cliente)
	REFERENCES clientes (id_cliente),
	CONSTRAINT res_fk_idu FOREIGN KEY (id_usuario)
	REFERENCES usuarios (id_usuario),
	CONSTRAINT res_fk_idl FOREIGN KEY (id_lugar)
	REFERENCES lugares (id_lugar)
);

ALTER TABLE registros_habitacion ADD(
	CONSTRAINT reg_fk_idr FOREIGN KEY (id_reserva)
	REFERENCES reservas (id_reserva),
	CONSTRAINT reg_fk_idh FOREIGN KEY (id_habitacion)
	REFERENCES habitaciones (id_habitacion),
	CONSTRAINT reg_ck_est CHECK (estado_registro in ('CI','CC'))
);


-------------------------------------------------------------
INSERT INTO habitaciones (tipo_habitacion,numero_habitacion,estado_habitacion,tarifa_habitacion) VALUES
('J',201,'D', 50000), ('H',202,'D', 120000), ('J',301,'D', 50000), ('J',302,'D', 50000), 
('J',303,'D', 50000), ('L',304,'D', 50000), ('J',401,'D', 50000), ('J',402,'D', 50000),
('J',403,'D', 50000), ('L',404,'D', 50000), ('J',501,'D', 50000), ('J',502,'D', 50000),
('J',503,'D', 50000), ('L',504,'D', 50000), ('J',601,'D', 50000), ('J',602,'D', 50000),
('M',603,'D', 50000);

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

---------------------------------------Cargos--------------------------------------------------
INSERT INTO cargos (nombre_cargo) VALUES 
('Directora administrativa'),('Coordinadora'),('Recepcionista'),('Camarera'),('Superusuario');
-----------------------------------------------------------------
INSERT INTO profesiones (nombre_profesion) VALUES ('INGENIERO'), 
('ECONOMINSTA'), 
('ESTUDIANTE'), 
('CONDUCTOR'), 
('MECÁNICO'), 
('MODISTA'), 
('ESTILISTA'), 
('PANADERO');
----------------------------------------------------------------------------------------------------
INSERT INTO personas(id_lugar_nacimiento,id_lugar_expedicion,nombres_persona,apellidos_persona,
	tipo_documento,numero_documento,genero_persona,fecha_nacimiento,tipo_sangre_rh,
	telefono_persona,correo_persona, tipo_persona) VALUES
(40040, 39828,'ANDRES FELIPE','CHAPARRO ROSAS','CC','1052411460','M','23/10/1997','A+','3123871293',NULL, 'U'),
(40040, 39828,'FABIAN ALEJANDRO','CRISTANCHO RINCON','CC','1053588031','M','28/05/1999','B+','3125743447',NULL, 'U');
-----------------------------------------------------------------------------------------
INSERT INTO usuarios (nombre_usuario,contrasena_usuario,id_persona, id_cargo) VALUES 
('andres.chaparro',md5('admin'),1,5),
('admin',md5('admin'),2,5);
---------------------------------------Empresas-------------------------------------------------
INSERT INTO empresas (nit_empresa, nombre_empresa, telefono_empresa, retefuente, otro_retefuente) VALUES 
('811028650-1', 'MADECENTRO COLOMBIA SAS', '7603323', 1, 0),
('900548102-0', 'AZTECA COMUNICACIONES SAS', '3124593207', 0, 0),
('830004993-8', 'CASA TORO S.A', '6760022', 1, 1);