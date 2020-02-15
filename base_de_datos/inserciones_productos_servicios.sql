-- INSERCIÓN DE TIPOS DE PROYECTOS
INSERT INTO tipos_producto (nombre_tipo_producto) VALUES
('BEBIDAS ALCOHÓLICAS'),
('ASEO'),
('BEBIDAS GASEOSAS'),
('GALGUERIAS'),
('GALLETAS'),
('CHOCOLATINAS');


-- INSERCIÓN DE PRODUCTOS
INSERT INTO productos (id_tipo_producto, nombre_producto, valor_producto) VALUES 
(1, 'CERVEZA ANDINA', 3600),
(1, 'CERVEZA CORONA', 7000),
(1, 'WHISKY PASSPORT', 60000),
(1, 'VINO DE LA SUIT', 70000),
(2, 'PAÑUELITOS FAMILIA', 2500),
(2, 'GEL FIJADOR EGO', 2000),
(2, 'CEPILLO DENTAL', 2500),
(2, 'MÁQUINA DE AFEITAR', 5000),
(2, 'CREMA DENTAL PEQUEÑA', 2500),
(2, 'CERA EGO', 2500),
(2, 'CREMA DE PEINAR', 2000),
(2, 'ALKASELTZER', 2000),
(2, 'ASPIRINA ULTRA', 2000),
(2, 'CURITAS', 200),
(2, 'DESODORANTE BALANCE CLINICAL', 2000),
(2, 'LISTERINE', 4000),
(2, 'PROTECTORES DIARIOS NOSOTRAS', 4500),
(2, 'CONDONES TODAY', 5500),
(2, 'SHAMPOO', 2000),
(2, 'SEDA DENTAL', 3000),
(2, 'APRONAX NAPROXENO', 2500),
(2, 'BONFIEST PLUS', 5300),
(2, 'TAMPONES NOSOTRAS', 2400),
(2, 'TOALLAS INVISIBLE', 1500),
(3, 'ENERGIZANTE RED BULL', 8500),
(3, 'BRETAÑA', 3000),
(3, 'AGUA GRANDE', 2000),
(3, 'GASEOSA POSTOBÓN', 3000),
(3, 'GASEOSA COCA COLA LATA', 3000),
(3, 'GASEOSA CANADA DRY', 3000),
(3, 'MR TEA X 500 ML', 3000),
(3, 'JUGOS CAJA HIT', 2000),
(3, 'GATORADE', 4000),
(3, 'JUGOS BOTELLA HIT', 3000),
(4, 'TODO RICO', 2500),
(4, 'GALLETAS MINICHIPS', 2000),
(4, 'PAPAS PRINGLES 40 GR', 5000),
(4, 'TROCIPOLLOS', 1500),
(4, 'CHICHARRÓN', 2500),
(4, 'TAJAMIEL MADURO Y VERDE', 2500),
(4, 'PAPAS SUPER RICAS 25 GR', 2500),
(4, 'PAPAS MARGARITA', 2500),
(4, 'PONQUÉ CHOCORRAMO', 2500),
(4, 'PONQUÉ GALA', 2000),
(4, 'MANÍ LA ESPECIAL SAL', 3000),
(4, 'MANÍ DE ARÁNDANOS', 3000),
(4, 'SALCHICHA ZENU', 5000),
(4, 'DELIMANI', 2000),
(5, 'MORENITAS NESTLÉ', 1200),
(5, 'COCOSETTE', 2000),
(5, 'TOSH', 2000),
(5, 'KIT KAT', 3500),
(5, 'MILO', 2000),
(5, 'WAFER JET', 1500),
(5, 'DEDITOS NESTLÉ', 1200),
(6, 'JUMBO MANÍ', 1200),
(6, 'JET X 12 GR', 1000),
(6, 'NUGGETS DE MILO', 2500);


-- INSERCIÓN DE SERVICIOS
INSERT INTO SERVICIOS (nombre_servicio, valor_servicio, tipo_servicio) VALUES
('LAVADO DE PANTALON', 3000, 'L'),
('LAVADO DE BUSO', 2000, 'L'),
('LAVADO DE SACO', 2000, 'L'),
('LAVADO DE BLAZER', 3500, 'L'),
('LAVADO DE CAMISA', 2000, 'L'),
('LAVADO DE BLUSA', 2000, 'L'),
('LAVADO DE ROPA INTERIOR', 1000, 'L'),
('LAVADO DE SUDADERA', 3000, 'L'),
('LAVADO DE PANTALONETA', 1000, 'L'),
('LAVADO DE MEDIAS', 1000, 'L'),
('LAVADO DE BUFANDA', 1000, 'L'),
('LAVADO DE VESTIDO', 4000, 'L'),
('LAVADO DE FALDA', 3000, 'L'),
('LAVADO DE ZAPATOS', 5000, 'L');