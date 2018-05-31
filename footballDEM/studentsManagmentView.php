<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> Administraci&oacute;n del torneo </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body>

    <?php
        include "Model/connectionModel.php";
        include "Templates/adminMenuBar.php";
    ?>

    <div class="row teams">
        <div class="col-md-1"></div>
        <div class="col-md-7">
            <h3> Lista de alumnos que se registraron en el torneo </h3>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsertStudent"> Nuevo alumno </button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-default" style="margin-left: 15px;"> Generar reporte </button>
        </div>
        <div class="col-md-1"></div>
    </div>

    <?php 
        $getStudents = "SELECT *FROM Alumno;";
        $data = $connection->query($getStudents);
    ?>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class='panel panel'>
                <div class='panel-body'>
                    <?php
                        echo "<table class='table table-striped table-hover'>
                                <tr>
                                    <th> Nombre </th>
                                    <th> NUA </th>
                                    <th> Edad </th>
                                    <th> Carrera </th>
                                </tr>";
                        $numStudent=1;
                        while( $Students = $data->fetch_assoc() ){
                            echo "<tr>
                                    <td>". $numStudent .". ". $Students['Nombre']." ".$Students['Apellidos'] ."</td>
                                    <td>". $Students['NUA'] ."</td>
                                    <td>". $Students['Edad'] ."</td>
                                    <td>". $Students['Carrera'] ."</td>
                                </tr>";
                            $numStudent++;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div id="modalInsertStudent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> Registrar un nuevo estudiante al torneo </h4>
                </div>

                <div class="modal-body">
                    <div class"row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Nombre: </label>
                                <input type="text" id="txtName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Edad: </label>
                                <input type="text" id="txtAge" class="form-control">                            
                            </div>
                        </div>
                    </div>

                    <div class"row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Apellidos: </label>
                                <input type="text" id="txtLastName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> NUA: </label>
                                <input type="text" id="txtNUA" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class"row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Carrera: </label> <br>
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

                    <div class="row">
                        <div class="col-md-6">
                            <label></label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="btnNewStudent" value="Agregar">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                </div>
            </div>
        </div>
    </div>

        
    </body>
</html>