#SELECCIONAMOS LA BASE DE DATOS
USE footballDEM;

#VALORES PARA LA TABLA 'Usuario'
INSERT INTO Usuario(Usuario, Contraseña, Tipo) VALUES('walter','root','Administrador');
INSERT INTO Usuario(Usuario, Contraseña, Tipo) VALUES('admin','root','Administrador');
INSERT INTO Usuario(Usuario, Contraseña, Tipo) VALUES('balta','balta17','Estudiante');

#VALORES PARA LA TABLA 'Alumno'
INSERT INTO Alumno(Nombre, Apellidos, NUA, Edad, Carrera) VALUES
('Walter Alejandro', 'Moreno Ramírez', 810243, 22, 'Ing. en Sistemas computacionales');
INSERT INTO Alumno(Nombre, Apellidos, NUA, Edad, Carrera) VALUES
('José Baltazar', 'Ramírez Rodriguez', 712093, 23, 'Ing. en Sistemas computacionales');
INSERT INTO Alumno(Nombre, Apellidos, NUA, Edad, Carrera) VALUES
('Fernando', 'Gonzalez Valtierra', 810324, 25, 'Ing. en Comunicaciones y Electrónica');
INSERT INTO Alumno(Nombre, Apellidos, NUA, Edad, Carrera) VALUES
('Oscar', 'Anguiano', 781203, 28, 'Lic. en Gestion Empresarial');

#VALORES PARA LA TABLA 'Equipo'
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Ingeniebrios','Blanco',1,1,0,0,10,0,10,3);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Nyupis','Azul Marino',1,0,0,1,0,10,-10,0);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Malumas','Marillo',1,0,0,1,0,20,-20,0);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Abejas Sport','Negro',1,0,0,1,3,5,-2,0);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Campesinos','Blanco',1,1,0,0,5,3,2,3);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Valler','Verde',1,1,0,0,0,5,0,3);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Sin nombre','Rojo',1,0,0,0,0,5,0,0);
INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES
('Dream team','Morado',1,1,0,0,5,0,0,3);

#VALORES PARA LA TABLA 'Jugador'
INSERT INTO Jugador(ID_Alumno, ID_Equipo, Posicion, Goles_Marcados) VALUES (1,1,'Defensa',10);
INSERT INTO Jugador(ID_Alumno, ID_Equipo, Posicion, Goles_Marcados) VALUES (2,2,'Delantero',0);
INSERT INTO Jugador(ID_Alumno, ID_Equipo, Posicion, Goles_Marcados) VALUES (3,1,'Medio',0);
INSERT INTO Jugador(ID_Alumno, ID_Equipo, Posicion, Goles_Marcados) VALUES (3,2,'Contension',0);

#VALORES PARA LA TABLA 'Arbitro'
INSERT INTO Arbitro(ID_Alumno) VALUES(4);

#VALORES PARA LA TABLA 'Partido'
INSERT INTO Partido(ID_Arbitro, Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora) VALUES
(1, 'Malumas', 4, 'Sin nombre', 4, '2018-01-17', '10:00');
INSERT INTO Partido(ID_Arbitro, Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora) VALUES
(1, 'Valler', 6, 'Abejas Sport', 3, '2018-01-17', '11:00');
INSERT INTO Partido(ID_Arbitro, Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora) VALUES
(1, 'Campesinos', 4, 'Niupy', 6, '2018-01-17', '12:00');
INSERT INTO Partido(ID_Arbitro, Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora) VALUES
(1, 'Dream team', 6, 'Ingeniebrios', 3, '2018-01-17', '01:00');

#VALORES PARA LA TABLA 'Jornada'
INSERT INTO Jornada(ID_Partido, Num_Jornada, Fecha) VALUES (1, 1, '2018-01-17');

#VALORES PARA LA TABLA 'Semestre'
INSERT INTO Semestre(ID_Jornada, Semestre) VALUES(1, 'Ene-Jun 2018');
