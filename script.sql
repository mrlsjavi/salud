

-- Create tables section -------------------------------------------------

-- Table usuario

CREATE TABLE usuario
(
  id Int NOT NULL AUTO_INCREMENT,
  rol Int,
  nombre Varchar(200),
  login Varchar(100),
  password Varchar(100),
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship5 ON usuario (rol)
;

-- Table alerta

CREATE TABLE alerta
(
  id Int NOT NULL AUTO_INCREMENT,
  usuario Int,
  medida_sensor Int,
  umbral_min Double,
  umbral_max Double,
  mail Varchar(75),
  notificacion Int,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship2 ON alerta (usuario)
;

CREATE INDEX IX_Relationship15 ON alerta (medida_sensor)
;

-- Table unidad_medida

CREATE TABLE unidad_medida
(
  id Int NOT NULL AUTO_INCREMENT,
  titulo Varchar(35),
  estado Int,
  PRIMARY KEY (id)
)
;

-- Table sensor

CREATE TABLE sensor
(
  id Int NOT NULL AUTO_INCREMENT,
  titulo Varchar(30),
  descripcion Varchar(75),
  estado Int,
  PRIMARY KEY (id)
)
;

-- Table bitacora

CREATE TABLE bitacora
(
  id Int NOT NULL AUTO_INCREMENT,
  usuario Int,
  medida_sensor Int,
  dato Double,
  fecha_hora Datetime,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship1 ON bitacora (usuario)
;

CREATE INDEX IX_Relationship14 ON bitacora (medida_sensor)
;

-- Table rol

CREATE TABLE rol
(
  id Int NOT NULL AUTO_INCREMENT,
  nombre Varchar(30),
  estado Int,
  PRIMARY KEY (id)
)
;

-- Table pagina

CREATE TABLE pagina
(
  id Int NOT NULL AUTO_INCREMENT,
  nombre Varchar(30),
  alias Varchar(50),
  orden Int,
  estado Int,
  PRIMARY KEY (id)
)
;

-- Table permisos_rol

CREATE TABLE permisos_rol
(
  id Int NOT NULL AUTO_INCREMENT,
  rol Int,
  pagina Int,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship10 ON permisos_rol (rol)
;

CREATE INDEX IX_Relationship11 ON permisos_rol (pagina)
;

-- Table tipo_dato_extra

CREATE TABLE tipo_dato_extra
(
  id Int NOT NULL AUTO_INCREMENT,
  nombre Varchar(30),
  estado Int,
  PRIMARY KEY (id)
)
;

-- Table dispositivo

CREATE TABLE dispositivo
(
  id Int NOT NULL AUTO_INCREMENT,
  usuario Int,
  ip Varchar(20),
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship3 ON dispositivo (usuario)
;

-- Table dato_extra

CREATE TABLE dato_extra
(
  id Int NOT NULL AUTO_INCREMENT,
  usuario Int,
  tipo_dato_extra Int,
  valor Varchar(50) NOT NULL,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship4 ON dato_extra (usuario)
;

CREATE INDEX IX_Relationship9 ON dato_extra (tipo_dato_extra)
;

-- Table medida_sensor

CREATE TABLE medida_sensor
(
  id Int NOT NULL AUTO_INCREMENT,
  sensor Int,
  unidad_medida Int,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship12 ON medida_sensor (sensor)
;

CREATE INDEX IX_Relationship13 ON medida_sensor (unidad_medida)
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE bitacora ADD CONSTRAINT Relationship1 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE alerta ADD CONSTRAINT Relationship2 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE dispositivo ADD CONSTRAINT Relationship3 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE dato_extra ADD CONSTRAINT Relationship4 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE usuario ADD CONSTRAINT Relationship5 FOREIGN KEY (rol) REFERENCES rol (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE dato_extra ADD CONSTRAINT Relationship9 FOREIGN KEY (tipo_dato_extra) REFERENCES tipo_dato_extra (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE permisos_rol ADD CONSTRAINT Relationship10 FOREIGN KEY (rol) REFERENCES rol (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE permisos_rol ADD CONSTRAINT Relationship11 FOREIGN KEY (pagina) REFERENCES pagina (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE medida_sensor ADD CONSTRAINT Relationship12 FOREIGN KEY (sensor) REFERENCES sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE medida_sensor ADD CONSTRAINT Relationship13 FOREIGN KEY (unidad_medida) REFERENCES unidad_medida (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE bitacora ADD CONSTRAINT Relationship14 FOREIGN KEY (medida_sensor) REFERENCES medida_sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE alerta ADD CONSTRAINT Relationship15 FOREIGN KEY (medida_sensor) REFERENCES medida_sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;
