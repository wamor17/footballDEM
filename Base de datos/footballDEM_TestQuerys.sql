USE footballDEM;
SELECT *FROM Equipo;
SELECT *FROM Jugador;
SELECT *FROM Alumno;
SELECT *FROM Jornada;
SELECT *FROM Partido;
SELECT *FROM Semestre;
SELECT *FROM Usuario;
DROP DATABASE footballDEM;

SELECT DISTINCT Num_Jornada FROM Jornada ORDER BY Num_Jornada ASC;
SELECT *FROM Jornada ORDER BY Num_Jornada ASC;
SELECT CONVERT(Alumno.Nombre USING utf8) AS NameAlumno, CONVERT(Apellidos USING utf8) AS Apellidos, Edad, NUA, CONVERT(Carrera USING utf8) AS Carrera, Equipo.Nombre AS NameTeam, Posicion, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo;
DELETE FROM Equipo WHERE ID_Equipo = 1;
UPDATE Equipo SET Equipo.ID_Equipo = 0 WHERE ID_Equipo = 1;
UPDATE Jugador SET Jugador.ID_Equipo = 0 WHERE ID_Equipo = 1;

INSERT INTO Equipo(Nombre, Color_Uniforme, PJ, PG, PE, PP, GA, GR, Diff, Puntos) VALUES('INTER','BEIGE',0,0,0,0,0,0,0,0);
UPDATE Equipo SET Nombre = 'Ingeniebrios', Color_Uniforme = 'rgb(100,100,0)' WHERE ID_Equipo = 1;
DELETE FROM Semestre WHERE ID_Semestre = 4;
SELECT ID_Semestre, Semestre FROM Semestre;

SELECT COUNT(ID_Equipo) AS NumTeams FROM Equipo;

UPDATE Semestre SET Semestre = 'Walter' WHERE ID_Semestre = 1;

SELECT Alumno.Nombre AS NameAlumno, Apellidos, Equipo.Nombre AS NameTeam, Jugador.Goles_Marcados
FROM Alumno
INNER JOIN Jugador
ON Jugador.ID_Alumno = Alumno.ID_Alumno
INNER JOIN Equipo
ON Jugador.ID_Equipo = Equipo.ID_Equipo;

SELECT Alumno.Nombre AS NameAlumno, Apellidos, NUA, Carrera, Equipo.Nombre AS NameTeam, Jugador.Goles_Marcados
FROM Alumno
INNER JOIN Jugador
ON Jugador.ID_Alumno = Alumno.ID_Alumno
INNER JOIN Equipo
ON Jugador.ID_Equipo = Equipo.ID_Equipo;

SELECT Num_Jornada, Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora FROM Partido INNER JOIN Jornada ON Partido.ID_Jornada = Jornada.ID_Jornada WHERE Jornada.ID_Jornada = 1;

SELECT Equipo_1, Goles_E1, Equipo_2, Goles_E2, Dia, Hora FROM Partido INNER JOIN Jornada ON Partido.ID_Jornada = Jornada.ID_Jornada WHERE Jornada.ID_Jornada = 2;
SELECT *FROM Jornada ORDER BY Num_Jornada DESC LIMIT 1;
