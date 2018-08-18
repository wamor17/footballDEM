<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title> Administraci&oacute;n del torneo </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body>

    <?php
        include "Model/connectionModel.php";
        include "Templates/adminMenuBar.php";
        
//        $getStudents = "SELECT Alumno.Nombre AS NameAlumno, Apellidos, Edad, NUA, Carrera, Equipo.Nombre AS NameTeam, Posicion, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo LIMIT 10;";
        $getStudents = "SELECT Alumno.Nombre AS NameAlumno, Apellidos, Edad, NUA, Carrera, Equipo.Nombre AS NameTeam, Posicion, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo LIMIT 3;";
        $data = $connection->query($getStudents);
    ?>

    <div class="row">
        <div class="col m1"></div>
        <div class="col m10">
            <h4> Lista de alumnos que se registraron en el torneo </h4>
            <a class="btn modal-trigger" href="#modalInsertStudent"> Nuevo alumno </a>
            <a class="btn indigo darken-4"> Generar reporte </a><br>
            
            <div class="card-panel hoverable">
                <span>
                    El generador de reportes toma solo la informaci&oacute;n correspondiente a los alumnos (nombre, NUA y carrera)
                    con el fin de brindar un apoyo para la solicitud de cr&eacute;ditos. Se genera un documento PDF con dicha informaci&oacute;n.
                </span>
            </div>

            <div class='card hoverable'>
                <div class="card-content">
            <?php
                echo "<table class='table'>
                        <tr>
                            <th class='center-align'> Nombre </th>
                            <th class='center-align'> Apellidos </th>
                            <th class='center-align'> NUA </th>
                            <th class='center-align'> Edad </th>
                            <th class='center-align'> Carrera </th>
                            <th class='center-align'> M&aacute;s acciones </th>
                        </tr>";
                $numStudent=1;
                while( $Students = $data->fetch_assoc() ){
                    echo "<tr>
                            <td class='center-align' id='studentName".$numStudent."'>".$Students['NameAlumno']."</td>
                            <td class='center-align' id='studentLastName".$numStudent."'>". $Students['Apellidos']."</td>
                            <td class='center-align' id='studentNUA".$numStudent."'>". $Students['NUA'] ."</td>
                            <td class='center-align' id='studentOld".$numStudent."'>". $Students['Edad'] ." años </td>
                            <td class='center-align' id='studentCarrier".$numStudent."'>". $Students['Carrera'] ."</td>
                            <td class='center-align'>
                                <a class='modal-trigger iconColor' id='btnShowInforStudent' href='#modalMoreInformationStudent' onclick=loadMoreDataStudentInfo(".$numStudent.")> <i class='material-icons'>local_library</i> </button>
                                <a class='modal-trigger iconColor' id='btnModifyStudent' href='#modalModifyStudent' onclick=loadMoreDataStudentModify(".$numStudent.")> <i class='material-icons'>edit</i> </button>
                                <a class='modal-trigger iconColor' id='btnDeleteStudent' href='#modalDeleteStudent' onclick='loadNameStudentToDelete(".$numStudent.")'> <i class='material-icons'>delete</i> </button>
                            </td>
                            <input class='hideTexbox' type='text' id='playerTeam".$numStudent."' value='".$Students['NameTeam']."'>
                            <input class='hideTexbox' type='text' id='playerPosition".$numStudent."' value='".$Students['Posicion']."'>
                            <input class='hideTexbox' type='text' id='playerGoals".$numStudent."' value='".$Students['Goles_Marcados']."'>
                        </tr>";
                    $numStudent++;
                }
                echo "</table>";
            ?>
            </div>
            </div>
        </div>
        <div class="col m1"></div>
    </div>

    <div id="modalInsertStudent" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4> Registrar nuevo alumno </h4>

            <div class"row">
                <div class="col m12">
                    <div class="form-group">
                        <label> Nombre </label>
                        <input type="text" id="txtName" class="form-control">
                    </div>

                    <div class="form-group">
                        <label> Apellidos </label>
                        <input type="text" id="txtLastName" class="form-control">
                    </div>

                    <div class="form-group">
                        <label> Edad </label>
                        <input type="text" id="txtAge" class="form-control">                            
                    </div>

                    <div class="form-group">
                        <label> NUA </label>
                        <input type="text" id="txtNUA" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label> Posici&oacute;n como jugador </label>
                        <input type="text" id="txtPlayerPosition" class="form-control">
                    </div>
                
                    <?php
                        $query = "SELECT *FROM Equipo;";
                        $resultSet = $connection->query($query);
                    ?>

                    <div class="form-group">
                        <label> Seleccione un equipo </label> <br>
                        <select class="btn btn-default">
                            <option> Equipos registrados en el torneo </option>
                            <?php
                                while( $Team = $resultSet->fetch_assoc() ){
                                    echo "<option> ".$Team["Nombre"]." </option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label> Carrera </label> <br>
                        <select class="btn btn-default">
                            <option> Seleccione una carrera </option>
                            <option> Lic. en Ing. Comunicaciones y electronica </option>
                            <option> Lic. Gestion empresarial </option>
                            <option> Lic. Enseñanza del ingles </option>
                            <option> Lic. en Ing. Sistemas computacionales </option>
                            <option> Maestria en Electronica Aplicada </option>
                            <option> Maestria en Administracion de las Tecnologias </option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="modal-footer">
            <input type="submit" class="btn" id="btnNewStudent" value="Agregar jugador">
            <input type="submit" class="btn modal-close" id="btnCancel" value="Cancelar" data-dismiss="modal">
        </div>
    </div>

    <div id="modalModifyStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> Modificando un alumno registrado </h4>
                </div>

                <div class="modal-body">
                    <div class"row">
                        <div class="col-md-8">
                            <h4> Datos del alumno </h4><br>
                        </div>
                        <div class="col-md-4">
                            <h4> Datos del jugador </h4><br>
                        </div>
                    </div>

                    <div class"row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" id="txtNameM" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Apellidos </label>
                                <input type="text" id="txtLastNameM" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Posici&oacute;n como jugador </label>
                                <input type="text" id="txtPlayerPositionM" class="form-control">
                            </div>
                        </div>
                    </div>

                    <?php
                        $query = "SELECT *FROM Equipo;";
                        $resultSet = $connection->query($query);
                    ?>

                    <div class"row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Edad </label>
                                <input type="text" id="txtAgeM" class="form-control">                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> NUA </label>
                                <input type="text" id="txtNUAM" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Equipo registrado </label>
                                <input type="text" id="txtTeamM" class="form-control" disabled><br>
                            </div>
                        </div>
                    </div>

                    <div class"row">
                        <div class="col-md-4">
                            <label> Carrera registrada </label>
                            <input type="text" id="txtCarrierM" class="form-control"><br>                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <label> Seleccione un nuevo equipo </label> <br>
                            <select class="btn btn-default">
                                <option> Equipos registrados en el torneo </option>
                                <?php
                                    while( $Team = $resultSet->fetch_assoc() ){
                                        echo "<option> ".$Team["Nombre"]." </option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div><br><br>
                    
                    <div class="row">
                        <div class="col-md-8 paddingModal">
                            <label> Carreras </label><br>
                            <select class="btn btn-default">
                                <option> Seleccione una nueva carrera </option>
                                <option> Lic. en Ing. Comunicaciones y electronica </option>
                                <option> Lic. Gestion empresarial </option>
                                <option> Lic. Enseñanza del ingles </option>
                                <option> Lic. en Ing. Sistemas computacionales </option>
                                <option> Maestria en Electronica Aplicada </option>
                                <option> Maestria en Administracion de las Tecnologias </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Goles anotados </label>
                                <input type="text" id="txtGoalsM" class="form-control"><br>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="btnNewStudent" value="Agregar jugador">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                </div>
            </div>
        </div>
    </div>

    <input class='hideTexbox' type='text' id='playerTeam".$numStudent."' value='".$Students['NameTeam']."'>
    <input class='hideTexbox' type='text' id='playerPosition".$numStudent."' value='".$Students['Posicion']."'>
    <input class='hideTexbox' type='text' id='playerGoals".$numStudent."' value='".$Students['Goles_Marcados']."'>

    <div id="modalMoreInformationStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> Informacio&oacute;n del jugador </h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label id='nameStudentInfo'>  </label><br><br>
                        <label> Equipo </label>
                        <input type="text" id="teamInfo" class="form-control" disabled><br>

                        <label> Posici&oacute;n de jugador </label>
                        <input type="text" id="positionInfo" class="form-control" disabled><br>

                        <label> Goles marcados </label>
                        <input type="text" id="goalsInfo" class="form-control" disabled>
                    </div>
                </div>

                <div class="modal-footer">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cerrar" data-dismiss="modal">
                </div>
            </div>
        </div>
    </div>
    
    <div id="modalDeleteStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5> Confirmaci&oacute;n de acci&oacute;n </h5>
                    </div>
                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="resource/images/danger1.png" class="imgDangerDelete">
                                <div class="form-group">
                                    <p> ¿Esta seguro que desea sacar a <strong id="nameStudentToDelete"> </strong> del torneo de f&uacute;tbol del DEM Yuriria? </p>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-danger" id="btnDeleteTeam" value="Borrar jugador">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
            $(document).ready(function(){
                $('.dropdown-trigger').dropdown();
                $('.modal').modal();
                $('.sidenav').sidenav();
            });
    </script>

    </body>
</html>
