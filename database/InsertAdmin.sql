INSERT INTO adminis (departamento) VALUES ( "Administración" );

INSERT INTO usuarios (name, apellido1, apellido2, dni, email, direccion, pass, hash_pass, idadmini)
VALUES ("Admin", "Admin1", "Admin2", "00000000A", "admin@admin.admin", "C/ Admin admin3B Adminlandia CP admin" ,
		"at6Ztun3N", "$2y$10$aJkzGTNoPB/i22gN3qCRtuVflQ/3kdwSV59CX7i4pxsfROf6/KrW2", 1);

INSERT INTO reg_usuarios ( fecha, hora, tipo, idusuario ) VALUES ( "15-09-05","13:21:20.000","Administrador", 1);

INSERT INTO cuentas (num_cuenta, saldo_actual, tipo, idusuario) VALUES (1, 1, "Corriente", 1);


