DROP TABLE IF EXISTS vehiculos;
DROP TABLE IF EXISTS tipos_combustible;
DROP TABLE IF EXISTS modelos;
DROP TABLE IF EXISTS marcas;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS historial_direcciones;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS listados_telefonos;
DROP TABLE IF EXISTS viviendas;
DROP TABLE IF EXISTS tipos_vivienda;
DROP TABLE IF EXISTS calles;
DROP TABLE IF EXISTS avenidas;
DROP TABLE IF EXISTS parroquias;
DROP TABLE IF EXISTS municipios;
DROP TABLE IF EXISTS estados;

CREATE TABLE estados (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL UNIQUE,
  iso VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE municipios (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_estado INTEGER NOT NULL,
  nombre VARCHAR(255) NOT NULL,

  FOREIGN KEY (id_estado) REFERENCES estados (id),
  UNIQUE (id_estado, nombre)
);

CREATE TABLE parroquias (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_municipio INTEGER NOT NULL,
  nombre VARCHAR(255) NOT NULL,

  FOREIGN KEY (id_municipio) REFERENCES municipios (id),
  UNIQUE (id_municipio, nombre)
);

CREATE TABLE avenidas (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_parroquia INTEGER NOT NULL,
  nombre VARCHAR(255) NOT NULL,

  FOREIGN KEY (id_parroquia) REFERENCES parroquias (id),
  UNIQUE (id_parroquia, nombre)
);

CREATE TABLE calles (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_avenida INTEGER NOT NULL,
  id_parroquia INTEGER NOT NULL,
  nombre VARCHAR(255) NOT NULL,

  FOREIGN KEY (id_avenida) REFERENCES avenidas (id),
  FOREIGN KEY (id_parroquia) REFERENCES parroquias (id),
  UNIQUE (id_avenida, nombre)
);

CREATE TABLE tipos_vivienda (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  tipo VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE viviendas (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_calle INTEGER NOT NULL,
  id_tipo INTEGER NOT NULL,
  numero VARCHAR(255),

  FOREIGN KEY (id_calle) REFERENCES calles (id),
  FOREIGN KEY (id_tipo) REFERENCES tipos_vivienda (id),
  UNIQUE (id_calle, numero)
);

CREATE TABLE listados_telefonos (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  personal
    VARCHAR(255)
    NOT NULL
    UNIQUE
    CHECK (
      personal LIKE '___________'
      OR personal LIKE '+%'
    ),
  fijo
    VARCHAR(255)
    NOT NULL
    UNIQUE
    CHECK (
      fijo LIKE '___________'
      OR fijo LIKE '+%'
    ),
  opcional
    VARCHAR(255)
    UNIQUE
    CHECK (
      opcional LIKE '___________'
      OR opcional LIKE '+%'
    ),

  CHECK (
    personal != fijo
    AND personal != opcional
    AND fijo != opcional
  )
);

CREATE TABLE clientes (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_telefonos INTEGER NOT NULL,
  nacionalidad ENUM('V', 'E') NOT NULL,
  cedula INTEGER NOT NULL UNIQUE CHECK (cedula > 0),
  primer_nombre VARCHAR(255) NOT NULL,
  segundo_nombre VARCHAR(255),
  primer_apellido VARCHAR(255) NOT NULL,
  segundo_apellido VARCHAR(255),

  FOREIGN KEY (id_telefonos) REFERENCES listados_telefonos (id),
  UNIQUE (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido)
);

CREATE TABLE historial_direcciones (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_cliente INTEGER NOT NULL,
  id_vivienda INTEGER NOT NULL,

  FOREIGN KEY (id_cliente) REFERENCES clientes (id),
  FOREIGN KEY (id_vivienda) REFERENCES viviendas (id)
);

CREATE TABLE roles (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nombre_masculino VARCHAR(255) NOT NULL UNIQUE,
  nombre_femenino VARCHAR(255) UNIQUE
);

CREATE TABLE usuarios (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_rol INTEGER NOT NULL,
  cedula INTEGER NOT NULL UNIQUE CHECK (cedula > 0),
  nacionalidad ENUM('V', 'E') NOT NULL,
  primer_nombre VARCHAR(255) NOT NULL,
  segundo_nombre VARCHAR(255),
  primer_apellido VARCHAR(255) NOT NULL,
  segundo_apellido VARCHAR(255),
  genero ENUM('Masculino', 'Femenino') NOT NULL,
  telefono
    VARCHAR(255)
    NOT NULL
    UNIQUE
    CHECK (
      telefono LIKE '___________'
      OR telefono LIKE '+%'
    ),
  correo VARCHAR(255) NOT NULL UNIQUE CHECK (correo LIKE '%@%'),
  usuario VARCHAR(255) NOT NULL UNIQUE,
  clave VARCHAR(255) NOT NULL,

  FOREIGN KEY (id_rol) REFERENCES roles (id),
  UNIQUE (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido)
);

CREATE TABLE marcas (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE modelos (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_marca INTEGER NOT NULL,
  nombre VARCHAR(255) NOT NULL UNIQUE,

  FOREIGN KEY (id_marca) REFERENCES marcas (id)
);

CREATE TABLE tipos_combustible (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  tipo VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE vehiculos (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  id_cliente INTEGER NOT NULL,
  id_modelo INTEGER NOT NULL,
  id_tipo_combustible INTEGER NOT NULL,
  placa VARCHAR(255) NOT NULL UNIQUE,
  anio INTEGER NOT NULL,

  FOREIGN KEY (id_modelo) REFERENCES modelos (id),
  FOREIGN KEY (id_tipo_combustible) REFERENCES tipos_combustible (id),
  FOREIGN KEY (id_cliente) REFERENCES clientes (id)
);

INSERT INTO roles VALUES
(1, 'Administrador', 'Administradora'),
(2, 'Secretario', 'Secretaria');

INSERT INTO tipos_vivienda VALUES
(1, 'Casa'),
(2, 'Apartamento'),
(3, 'Quinta'),
(4, 'Rancho'),
(5, 'Finca'),
(6, 'Parcela');

INSERT INTO marcas VALUES
(1, 'Chevrolet'),
(2, 'Ford'),
(3, 'Toyota'),
(4, 'Jeep'),
(5, 'Nissan'),
(6, 'Honda'),
(7, 'Mazda'),
(8, 'Kia'),
(9, 'Hyundai'),
(10, 'Volkswagen'),
(11, 'Renault'),
(12, 'Mercedes-Benz'),
(13, 'BMW'),
(14, 'Audi'),
(15, 'Fiat'),
(16, 'Peugeot'),
(17, 'Citroën'),
(18, 'Suzuki'),
(19, 'Volvo'),
(20, 'Subaru'),
(21, 'Mitsubishi'),
(22, 'Chery'),
(23, 'Great Wall'),
(24, 'JAC'),
(25, 'Dongfeng'),
(26, 'BYD'),
(27, 'Geely'),
(28, 'Zotye'),
(29, 'Changan'),
(30, 'Haval'),
(31, 'BAIC'),
(32, 'GAC Motor'),
(33, 'Haima'),
(34, 'Lifan'),
(35, 'MG');

INSERT INTO modelos VALUES
(1, 1, 'Aveo'),
(2, 1, 'Spark'),
(3, 1, 'Optra'),
(4, 1, 'Cruze'),
(5, 1, 'Sail'),
(6, 2, 'Fiesta'),
(7, 2, 'Focus'),
(8, 2, 'Fusion'),
(9, 2, 'Escape'),
(10, 2, 'Explorer'),
(11, 3, 'Corolla'),
(12, 3, 'Yaris'),
(13, 3, 'Camry'),
(14, 3, 'Land Cruiser'),
(15, 3, 'Rav4'),
(16, 4, 'Grand Cherokee'),
(17, 4, 'Wrangler'),
(18, 4, 'Compass'),
(19, 4, 'Renegade'),
(20, 4, 'Cherokee'),
(21, 5, 'Versa'),
(22, 5, 'Sentra'),
(23, 5, 'March'),
(24, 5, 'X-Trail'),
(25, 5, 'Patrol'),
(26, 6, 'Civic'),
(27, 6, 'Accord'),
(28, 6, 'Fit'),
(29, 6, 'CR-V'),
(30, 6, 'HR-V'),
(31, 7, 'Mazda2'),
(32, 7, 'Mazda3'),
(33, 7, 'Mazda6'),
(34, 7, 'CX-3'),
(35, 7, 'CX-5'),
(36, 8, 'Picanto'),
(37, 8, 'Rio'),
(38, 8, 'Forte'),
(39, 8, 'Optima'),
(40, 8, 'Sportage'),
(41, 9, 'Accent'),
(42, 9, 'Elantra'),
(43, 9, 'Tucson'),
(44, 9, 'Santa Fe'),
(45, 9, 'i10'),
(46, 10, 'Gol'),
(47, 10, 'Polo'),
(48, 10, 'Vento'),
(49, 10, 'Jetta');

INSERT INTO tipos_combustible VALUES
(1, 'Gasolina'),
(2, 'Diesel'),
(3, 'Gas'),
(4, 'Híbrido'),
(5, 'Eléctrico');
