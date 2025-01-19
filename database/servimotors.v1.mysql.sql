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

INSERT into modelos (marcaId, nombreModelo) VALUES
  (1, 'Aveo'), (1, 'Spark'), (1, 'Optra'), (1, 'Cruze'), (1, 'Sail'),
  (2, 'Fiesta'), (2, 'Focus'), (2, 'Escape'), (2, 'Explorer'), (2, 'Ranger'),
  (3, 'Corolla'), (3, 'Yaris'), (3, 'Fortuner'), (3, 'Hilux'), (3, 'Prado'),
  (4, 'Accent'), (4, 'Elantra'), (4, 'Tucson'), (4, 'Santa Fe'), (4, 'Grand i10'),
  (5, 'Picanto'), (5, 'Rio'), (5, 'Sportage'), (5, 'Sorento'), (5, 'Cerato'),
  (6, 'Lancer'), (6, 'Outlander'), (6, 'Montero'), (6, 'Mirage'), (6, 'ASX'),
  (7, 'Sentra'), (7, 'Versa'), (7, 'X-Trail'), (7, 'Pathfinder'), (7, 'Frontier'),
  (8, 'Logan'), (8, 'Duster'), (8, 'Kwid'), (8, 'Sandero'), (8, 'Stepway'),
  (9, 'Gol'), (9, 'Polo'), (9, 'Vento'), (9, 'Tiguan'), (9, 'Amarok'),
  (10, 'Serie 1'), (10, 'Serie 2'), (10, 'Serie 3'), (10, 'Serie 4'), (10, 'X1'),
  (11, 'Clase A'), (11, 'Clase C'), (11, 'Clase E'), (11, 'Clase G'), (11, 'Clase S'),
  (12, 'A1'), (12, 'A3'), (12, 'A4'), (12, 'A5'), (12, 'Q3'),
  (13, 'Renegade'), (13, 'Compass'), (13, 'Cherokee'), (13, 'Wrangler'), (13, 'Grand Cherokee'),
  (14, 'Civic'), (14, 'Fit'), (14, 'HR-V'), (14, 'CR-V'), (14, 'Pilot'),
  (15, 'Swift'), (15, 'Vitara'), (15, 'Jimny'), (15, 'Grand Vitara'), (15, 'Celerio'),
  (16, 'Mazda2'), (16, 'Mazda3'), (16, 'Mazda6'), (16, 'CX-3'), (16, 'CX-5'),
  (17, '500'), (17, '500X'), (17, '500L'), (17, 'Panda'), (17, 'Tipo'),
  (18, '208'), (18, '2008'), (18, '301'), (18, '308'), (18, '3008'),
  (19, 'S60'), (19, 'S90'), (19, 'XC40'), (19, 'XC60'), (19, 'XC90'),
  (20, 'Impreza'), (20, 'Legacy'), (20, 'Forester'), (20, 'Outback'), (20, 'XV'),
  (21, 'Arauca'), (21, 'Orinoco'), (21, 'Tiggo 2'), (21, 'Tiggo 3'), (21, 'Tiggo 4'),
  (22, 'Emgrand 7'), (22, 'GS'), (22, 'GS Sport'), (22, 'X7'), (22, 'X9'),
  (23, 'S6'), (23, 'S30'), (23, 'S50'), (23, 'S500'), (23, 'S560'),
  (24, 'Haval H1'), (24, 'Haval H2'), (24, 'Haval H6'), (24, 'Haval H9'), (24, 'Haval H5'),
  (25, 'S3'), (25, 'S2'), (25, 'S5'), (25, 'S7'), (25, 'S4'),
  (26, 'S30'), (26, 'S50'), (26, 'S560'), (26, 'S500'), (26, 'S6');

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
