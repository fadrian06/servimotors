CREATE TABLE estados (
  estadoId int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreEstado varchar(50) NOT NULL UNIQUE
);

CREATE TABLE municipios (
  municipioId int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreMunicipio varchar(50) NOT NULL,
  estadoId int(11) NOT NULL,

  UNIQUE (nombreMunicipio, estadoId),
  FOREIGN KEY (estadoId) REFERENCES estados (estadoId)
);

CREATE TABLE parroquias (
  parroquiaId int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreParroquia varchar(50) NOT NULL,
  municipioId int(11) NOT NULL,

  UNIQUE (nombreParroquia, municipioId),
  FOREIGN KEY (municipioId) REFERENCES municipios (municipioId)
);

CREATE TABLE avenidas (
  avenidaId int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreAvenida varchar(50) NOT NULL,
  parroquiaId int(11) NOT NULL,

  UNIQUE (nombreAvenida, parroquiaId),
  FOREIGN KEY (parroquiaId) REFERENCES parroquias (parroquiaId)
);

CREATE TABLE calles (
  calleId int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreCalle varchar(50) NOT NULL,
  avenidaId int(11) NOT NULL,

  UNIQUE (nombreCalle, avenidaId),
  FOREIGN KEY (avenidaId) REFERENCES avenidas (avenidaId)
);

CREATE TABLE casasapartamentos (
  casaApartamentoId int(11) PRIMARY KEY AUTO_INCREMENT,
  calleId int(11) NOT NULL,
  detalleCasaApartamento varchar(50) NOT NULL,

  UNIQUE (detalleCasaApartamento, calleId),
  FOREIGN KEY (calleId) REFERENCES calles (calleId)
);

CREATE TABLE clientes (
  cedula varchar(8) PRIMARY KEY,
  primerNombre varchar(30) NOT NULL,
  segundoNombre varchar(30) DEFAULT NULL,
  primerApellido varchar(30) NOT NULL,
  segundoApellido varchar(30) DEFAULT NULL
);

CREATE TABLE rolusuario (
  idRol int(11) PRIMARY KEY AUTO_INCREMENT,
  nombreRol varchar(255) NOT NULL UNIQUE
);

CREATE TABLE usuarios (
  cedula varchar(8) PRIMARY KEY,
  idRol int(11) NOT NULL,
  nombreUsuario varchar(50) NOT NULL UNIQUE,
  contrasena varchar(255) NOT NULL,

  FOREIGN KEY (idRol) REFERENCES rolusuario (idRol)
);

CREATE TABLE contactosusuario (
  cedula varchar(8) NOT NULL,
  telefono varchar(11) NOT NULL UNIQUE,
  correo varchar(254) NOT NULL UNIQUE,

  FOREIGN KEY (cedula) REFERENCES usuarios (cedula)
);

CREATE TABLE datosusuario (
  cedula varchar(8) DEFAULT NULL,
  primerNombre varchar(30) NOT NULL,
  segundoNombre varchar(30) NOT NULL,
  primerApellido varchar(30) NOT NULL,
  segundoApellido varchar(30) DEFAULT NULL,

  FOREIGN KEY (cedula) REFERENCES usuarios (cedula)
);

CREATE TABLE direcciones (
  cedulaCliente varchar(8) NOT NULL,
  casaApartamentoId int(11) NOT NULL,

  FOREIGN KEY (cedulaCliente) REFERENCES clientes (cedula),
  FOREIGN KEY (casaApartamentoId) REFERENCES casasapartamentos (casaApartamentoId)
);

CREATE TABLE telefonos (
  cedulaCliente varchar(8) NOT NULL,
  telefonoPersonal varchar(255) DEFAULT NULL,
  telefonoFijo varchar(255) DEFAULT NULL,
  telefonoOpcional varchar(255) DEFAULT NULL,

  FOREIGN KEY (cedulaCliente) REFERENCES clientes (cedula)
);

CREATE TABLE marcas (
  marcaId INT PRIMARY KEY AUTO_INCREMENT,
  nombreMarca VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE modelos (
  modeloId INT PRIMARY KEY AUTO_INCREMENT,
  marcaId INT NOT NULL,
  nombreModelo VARCHAR(255) NOT NULL UNIQUE,

  FOREIGN KEY (marcaId) REFERENCES marcas (marcaId)
);

CREATE TABLE tipos_combustible (
  tipoCombustibleId INT PRIMARY KEY AUTO_INCREMENT,
  tipoCombustible VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE vehiculos (
  placa VARCHAR(15) PRIMARY KEY,
  cedulaCliente VARCHAR(15) NOT NULL,
  modeloId INT NOT NULL,
  tipoCombustibleId INT NOT NULL,
  anio INT NOT NULL,

  -- FOREIGN KEY (cedulaCliente) REFERENCES clientes (cedula),
  FOREIGN KEY (marcaId) REFERENCES marcas (marcaId),
  FOREIGN KEY (modeloId) REFERENCES modelos (modeloId),
  FOREIGN KEY (tipoCombustibleId) REFERENCES tipos_combustible (tipoCombustibleId)
);

INSERT INTO marcas (nombreMarca) VALUES
  ('Chevrolet'), ('Ford'), ('Toyota'), ('Hyundai'), ('Kia'), ('Mitsubishi'),
  ('Nissan'), ('Renault'), ('Volkswagen'), ('BMW'), ('Mercedes Benz'),
  ('Audi'), ('Jeep'), ('Honda'), ('Suzuki'), ('Mazda'), ('Fiat'), ('Peugeot'),
  ('Volvo'), ('Subaru'), ('Chery'), ('Geely'), ('BYD'), ('Great Wall'),
  ('JAC'), ('Dongfeng'), ('Zotye');

INSERT into modelos (modeloId, marcaId, nombreModelo) VALUES
  (1, 1, 'Aveo'), (2, 1, 'Optra'), (3, 1, 'Spark'), (4, 1, 'Cruze'),
  (5, 2, 'Fiesta'), (6, 2, 'Focus'), (7, 2, 'Escape'), (8, 2, 'Explorer'),
  (9, 3, 'Corolla'), (10, 3, 'Yaris'), (11, 3, 'Hilux'), (12, 3, 'Fortuner'),
  (13, 4, 'Accent'), (14, 4, 'Elantra'), (15, 4, 'Tucson'), (16, 4, 'Santa Fe'),
  (17, 5, 'Rio'), (18, 5, 'Cerato'), (19, 5, 'Sportage'), (20, 5, 'Sorento'),
  (21, 6, 'Lancer'), (22, 6, 'Mirage'), (23, 6, 'Outlander'), (24, 6, 'Montero'),
  (25, 7, 'Sentra'), (26, 7, 'Versa'), (27, 7, 'X-Trail'), (28, 7, 'Pathfinder'),
  (29, 8, 'Clio'), (30, 8, 'Duster'), (31, 8, 'Kwid'), (32, 8, 'Koleos'),
  (33, 9, 'Gol'), (34, 9, 'Polo'), (35, 9, 'Vento'), (36, 9, 'Tiguan'),
  (37, 10, 'Serie 1'), (38, 10, 'Serie 3'), (39, 10, 'Serie 5'), (40, 10, 'X1'),
  (41, 11, 'Clase A'), (42, 11, 'Clase C'), (43, 11, 'Clase E'), (44, 11, 'GLA'),
  (45, 12, 'A3'), (46, 12, 'A4'), (47, 12, 'A6'), (48, 12, 'Q3'),
  (49, 13, 'Renegade'), (50, 13, 'Compass'), (51, 13, 'Cherokee'), (52, 13, 'Wrangler'),
  (53, 14, 'Civic'), (54, 14, 'Fit'), (55, 14, 'HR-V'), (56, 14, 'CR-V'),
  (57, 15, 'Swift'), (58, 15, 'Ciaz'), (59, 15, 'Vitara'), (60, 15, 'Jimny'),
  (61, 16, '2'), (62, 16, '3'), (63, 16, '6'), (64, 16, 'CX-5'),
  (65, 17, '500'), (66, 17, 'Uno'), (67, 17, 'Mobi'), (68, 17, 'Toro'),
  (69, 18, '208'), (70, 18, '2008'), (71, 18, '301'), (72, 18, '3008'),
  (73, 19, 'S60'), (74, 19, 'XC40'), (75, 19, 'XC60'), (76, 19, 'XC90'),
  (77, 20, 'Impreza'), (78, 20, 'Forester'), (79, 20, 'Outback'), (80, 20, 'XV'),
  (81, 21, 'Tiggo 2'), (82, 21, 'Tiggo 3'), (83, 21, 'Tiggo 4'), (84, 21, 'Tiggo 7'),
  (85, 22, 'Emgrand X7'), (86, 22, 'Emgrand GS'), (87, 22, 'Emgrand 7'), (88, 22, 'Emgrand 9'),
  (89, 23, 'S6'), (90, 23, 'S5'), (91, 23, 'S3'), (92, 23, 'S2'),
  (93, 24, 'T600'), (94, 24, 'T500'), (95, 24, 'T3000');

INSERT INTO tipos_combustible (tipoCombustible) VALUES
  ('Gasolina'), ('Diesel'), ('Gas'), ('Eléctrico'), ('Híbrido');

INSERT INTO rolusuario (idRol, nombreRol) VALUES
(1, 'Administrador'),
(2, 'Secretaría');

INSERT INTO usuarios (cedula, idRol, nombreUsuario, contrasena) VALUES
(
  '29634134',
  1,
  'Ander',
  /* 12345678 */ '$2y$10$8SM1F2hEGucr9BZ94u5k1.SADFHs9du0XwEJST8mWuDHKHuChbTEO'
);

INSERT INTO `contactosusuario` (`cedula`, `telefono`, `correo`) VALUES
('29634134', '04147510509', 'andersonlobo20@hotmail.com');

INSERT INTO `datosusuario` (`cedula`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`) VALUES
('29634134', 'Anderson', 'Alejandro', 'lobo', 'uzcategui');
