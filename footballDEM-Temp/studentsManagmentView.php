<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
        <title> Administraci&oacute;n del torneo </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body>

    <?php
        include "Model/connectionModel.php";
        include "Templates/adminMenuBar.php";
        
        $getStudents = "SELECT Alumno.Nombre AS NameAlumno, Apellidos, Edad, NUA, Carrera, Equipo.Nombre AS NameTeam, Posicion, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo;";
        $data = $connection->query($getStudents);
    ?>

    <div class="row teams">
        <div class="col-md-1"></div>
        <div class="col-md-10 panel">
            <h3> Lista de alumnos que se registraron en el torneo </h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsertStudent"> Nuevo alumno </button> <br><br>
<!--            <button type="button" class="btn btn-default" style="margin-left: 15px;"> Generar reporte </button><br><br>
            
            <div class="alert alert-info">
                El generador de reportes toma solo la informaci&oacute;n correspondiente a los alumnos (nombre, NUA y carrera)
                con el fin de brindar un apoyo para la solicitud de cr&eacute;ditos. Se genera un documento PDF con dicha informaci&oacute;n.
            </div>
-->
            <?php
                echo "<table class='table table-striped table-hover'>
                        <tr>
                            <th class='textAlignStudent'> Nombre </th>
                            <th class='textAlignStudent'> Apellidos </th>
                            <th class='textAlignStudent'> NUA </th>
                            <th class='textAlignStudent'> Edad </th>
                            <th class='textAlignStudent'> Carrera </th>
                            <th class='textAlignStudent'> M&aacute;s informaci&oacute;n </th>
                        </tr>";
                $numStudent=1;
                while( $Students = $data->fetch_assoc() ){
                    echo "<tr>
                            <td id='studentName".$numStudent."'>".$Students['NameAlumno']."</td>
                            <td id='studentLastName".$numStudent."'>". $Students['Apellidos']."</td>
                            <td id='studentNUA".$numStudent."'>". $Students['NUA'] ."</td>
                            <td id='studentOld".$numStudent."'>". $Students['Edad'] ." años </td>
                            <td id='studentCarrier".$numStudent."'>". $Students['Carrera'] ."</td>
                            <td class='textAlignStudent'>
                                <button class='btn btn-info' id='btnShowInforStudent' data-toggle='modal' data-target='#modalMoreInformationStudent' onclick=loadMoreDataStudentInfo(".$numStudent.")> M&aacute;s informaci&oacute;n </button>
                                <button class='btn btn-warning' id='btnModifyStudent' data-toggle='modal' data-target='#modalModifyStudent' onclick=loadMoreDataStudentModify(".$numStudent.")> Modificar </button>
                                <button class='btn btn-danger' id='btnDeleteStudent' data-toggle='modal' data-target='#modalDeleteStudent' onclick='loadNameStudentToDelete(".$numStudent.")'> Eliminar </button>
                            </td>
                            <input class='hideTexbox' type='text' id='playerTeam".$numStudent."' value='".$Students['NameTeam']."'>
                            <input class='hideTexbox' type='text' id='playerPosition".$numStudent."' value='".$Students['Posicion']."'>
                            <input class='hideTexbox' type='text' id='playerGoals".$numStudent."' value='".$Students['Goles_Marcados']."'>
                        </tr>";
                    $numStudent++;
                }
                echo "</table><br><br>";
            ?>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div id="modalInsertStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> Registro de un nuevo alumno al torneo de f&uacute;tbol del DEM Yurira </h4>
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
                                <input type="text" id="txtName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Apellidos </label>
                                <input type="text" id="txtLastName" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Posici&oacute;n como jugador </label>
                                <input type="text" id="txtPlayerPosition" class="form-control">
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
                                <input type="text" id="txtAge" class="form-control">                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> NUA </label>
                                <input type="text" id="txtNUA" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        </div>
                    </div>

                    <div class"row">
                        <div class="col-md-8">
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
                    </div><br><br>

                    <div class="row">
                        <div class="col-md-6">
                            <label></label>
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

    <div id="modalModifyStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> Modificando un jugador registrado en el torneo de f&uacute;tbol del DEM Yurira </h4>
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

    </body>
</html>