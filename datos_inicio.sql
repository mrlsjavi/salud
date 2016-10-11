INSERT INTO rol (id, nombre, estado) VALUES
("", 'admin', 1);


INSERT INTO sensor (id, titulo, descripcion, estado) VALUES
("", 'oxigeno', 'lee oxigeno en la sangre', 1),
("", 'temperatura', 'calor corporal', 1),
("", 'presion', 'lee presion', 1),
("", 'respiracion', 'cantidad de respiraciones', 1),
("", 'pulso', 'cantidad de pulsos', 1);

INSERT INTO unidad_medida (id, titulo, estado) VALUES
("", 'Fahrenheit', 1),
("", 'pulsos', 1),
("", '% oxigeno', 1),
("", 'respiraciones', 1),
("", 'sistolica', 1),
("", 'distolica', 1);


INSERT INTO medida_sensor (id, sensor, unidad_medida, estado) VALUES
("", 1, 3, 1),
("", 2, 1, 1),
("", 3, 5, 1),
("", 3, 6, 1),
("", 4, 4, 1),
("", 5, 2, 1);


INSERT INTO usuario (id, rol, nombre, login, password, direccion, telefono, identificador, estado) VALUES
("", 1, 'admin', 'admin.salud', '21232f297a57a5a743894a0e4a801fc3', 'amatitlan', 58343128, 94110800, 1);


-- ------------------------------------------