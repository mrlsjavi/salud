/*
Created: 03/09/2016
Modified: 15/10/2016
Model: MySQL 5.5
Database: MySQL 5.5
*/


-- Create tables section -------------------------------------------------

-- Table usuario

CREATE TABLE usuario
(
  id Int NOT NULL AUTO_INCREMENT,
  rol Int,
  nombre Varchar(200),
  login Varchar(100),
  password Varchar(100),
  direccion Varchar(200),
  telefono Int,
  identificador Int,
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
  medida_sensor Int,
  nombre Varchar(100),
  umbral_min Double,
  umbral_max Double,
  estado Int,
  PRIMARY KEY (id)
)
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
  tipo Varchar(2),
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

-- Table permiso_rol

CREATE TABLE permiso_rol
(
  id Int NOT NULL AUTO_INCREMENT,
  rol Int,
  pagina Int,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship10 ON permiso_rol (rol)
;

CREATE INDEX IX_Relationship11 ON permiso_rol (pagina)
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

-- Table usuario_alerta

CREATE TABLE usuario_alerta
(
  id Int NOT NULL AUTO_INCREMENT,
  usuario Int,
  alerta Int,
  mail Varchar(150),
  notificacion Int,
  estado Int,
  PRIMARY KEY (id)
)
;

CREATE INDEX IX_Relationship16 ON usuario_alerta (usuario)
;

CREATE INDEX IX_Relationship17 ON usuario_alerta (alerta)
;

-- Table notificacion

CREATE TABLE notificacion
(
  usuario Int,
  token Varchar(1024)
)
;

CREATE INDEX IX_Relationship18 ON notificacion (usuario)
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE bitacora ADD CONSTRAINT Relationship1 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE dispositivo ADD CONSTRAINT Relationship3 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE usuario ADD CONSTRAINT Relationship5 FOREIGN KEY (rol) REFERENCES rol (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE permiso_rol ADD CONSTRAINT Relationship10 FOREIGN KEY (rol) REFERENCES rol (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE permiso_rol ADD CONSTRAINT Relationship11 FOREIGN KEY (pagina) REFERENCES pagina (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE medida_sensor ADD CONSTRAINT Relationship12 FOREIGN KEY (sensor) REFERENCES sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE medida_sensor ADD CONSTRAINT Relationship13 FOREIGN KEY (unidad_medida) REFERENCES unidad_medida (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE bitacora ADD CONSTRAINT Relationship14 FOREIGN KEY (medida_sensor) REFERENCES medida_sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE alerta ADD CONSTRAINT Relationship15 FOREIGN KEY (medida_sensor) REFERENCES medida_sensor (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE usuario_alerta ADD CONSTRAINT Relationship16 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE usuario_alerta ADD CONSTRAINT Relationship17 FOREIGN KEY (alerta) REFERENCES alerta (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE notificacion ADD CONSTRAINT Relationship18 FOREIGN KEY (usuario) REFERENCES usuario (id) ON DELETE RESTRICT ON UPDATE RESTRICT
;
