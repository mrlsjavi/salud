INSERT INTO rol (id, nombre, estado) VALUES
("", 'admin', 1);
("", 'usuario', 1);

INSERT INTO usuario (id, rol, nombre, login, password, direccion, telefono, identificador, estado) VALUES
("", 1, 'admin', 'admin.salud', '21232f297a57a5a743894a0e4a801fc3', 'amatitlan', 58343128, 94110800, 1);




INSERT INTO sensor (id, titulo, descripcion, tipo, estado) VALUES
("", 'oxigeno', 'lee oxigeno en la sangre', '', 1),
("", 'temperatura', 'calor corporal', 'TP', 1),
("", 'presion', 'lee presion', 'BP', 1),
("", 'respiracion', 'cantidad de respiraciones', 'BS', 1),
("", 'pulso', 'cantidad de pulsos', 'PO', 1);

INSERT INTO unidad_medida (id, titulo, estado) VALUES
("", 'PRbpm', 1),
("", 'Bpm', 1),
("", 'SISmmHg', 1),
("", 'DIAmmHg', 1),
("", '%SPo2', 1),
("", 'C', 1);


INSERT INTO medida_sensor (id, sensor, unidad_medida, estado) VALUES
("", 5, 1, 1),
("", 4, 2, 1),
("", 3, 3, 1),
("", 3, 4, 1),
("", 1, 5, 1),
("", 2, 6, 1);


INSERT INTO pagina (id, nombre, alias, orden, estado) VALUES
("", "perfil", "Perfil", 1, 1),
("", "rol", "Roles", 2, 1),
("", "usuario", "Usuarios", 3, 1),
("", "pagina", "Roles", 4, 1),
("", "permiso", "Permisos", 5, 1),
("", "sensor", "Sensor", 6, 1),
("", "unidad_medida", "Unidades", 7, 1),
("", "medida_sensor", "Medidas", 8, 1),
("", "dispositivo", "Dispositivos", 9, 1),
("", "alerta", "Alerta", 10, 1),
("", "usuario_alerta", "Asignar Alerta", 11, 1),
("", "live", "Monitor", 12, 1);


INSERT INTO permiso_rol(id, rol, pagina, estado) VALUES 
("", 1, 2, 1),
("", 1, 3, 1),
("", 1, 4, 1),
("", 1, 5, 1),
("", 1, 6, 1),
("", 1, 7, 1),
("", 1, 8, 1),
("", 1, 9, 1),
("", 2, 1, 1),
("", 2, 10, 1),
("", 2, 11, 1),
("", 2, 12, 1);

-- ------------------------------------------