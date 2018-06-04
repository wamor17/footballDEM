<!-- 
    Document   : adminView
    Created on : 24-ene-2018, 13:06:59
    Author     : walter
-->

<?php
    include "Model/connectionModel.php";
    include "Templates/adminMenuBar.php";

    if( $_SESSION["usuario"] ){
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Administraci&oacute;n del torneo </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body onload="loadData()">
        <?php
            $getChamp = "SELECT *FROM Semestre;";
            $dataChampionship = $connection->query($getChamp);

            if( $dataChampionship->num_rows > 0 ){
                $Semester = $dataChampionship->fetch_assoc();
            }
        ?>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 txtCenter principalBanner"> <h1> Torneo de f&uacute;tbol del Semestre <?php echo $Semester["Semestre"] ?> </h1> </div>
            <div class="col-md-1"></div>
        </div><br><br>

<!--content-->
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
                <?php
                    $getJornadas = "SELECT *FROM Jornada ORDER BY ID_Jornada ASC";
                    $dataJornadas = $connection->query($getJornadas);

                    echo "<div class='row'>
                            <div class='col-md-7'>
                                <p id='jornada'></p>
                            </div>
                            <div class='col-md-5'>
                                <div class='dropdown dropdownAlign'>
                                    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>
                                        Seleccionar jornada
                                    <span class='caret'></span></button>
                                    
                                    <ul class='dropdown-menu'>";
                                        if( $dataJornadas->num_rows > 0 ){
                                            while( $Jornadas = $dataJornadas->fetch_assoc() ){
                                                echo "<li id='j".$Jornadas["Num_Jornada"]."' onclick='selectJornada(".$Jornadas["Num_Jornada"].")'><a href='#'> Jornada ".$Jornadas["Num_Jornada"]." </a></li>";
                                            }
                                        }
                                echo"</ul>
                                </div>
                            </div>
                          </div>
                        <br>
                        ";
                    
                    $getPartidos = "SELECT *FROM Partido LIMIT 4;";
                    $Partidos = $connection->query($getPartidos);

                    if( $Partidos->num_rows > 0 ){
                        $num = 0;
                        while( $Resultados = $Partidos->fetch_assoc() ){
                            echo " <div class='panel panel-default'>
                                        <div class='panel-body panelBody'>";
                                        echo" <div class='col-md-1'> </div> ";

                                        echo" <div class='col-md-4 col-xs-5 col-sm-5'> ";
                                            echo" <div class='alert alert-success teamSize' id='E1_".$num."_left'> </div>";
                                        echo" </div> ";

                                        echo" <div class='col-md-2 col-xs-2 col-sm-2'>";
                                            echo" <h4 id='goles_".$num."' class='golesSize'><strong> </strong></h4> ";
                                        echo" </div> ";

                                        echo" <div class='col-md-4 col-xs-4 col-sm-4'>
                                                <div class='alert alert-success  teamSize' id='E2_".$num."_right'> </div> ";
                                        echo" </div> ";

                                        echo "<div class='col-md-1'>
                                                <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalModifyGame' onclick='loadDataToModal($num)'> <span class='glyphicon glyphicon-pencil'> </span> </button>
                                            </div>";
                                    echo "</div>";
                                    echo "<div id='hourGame".$num."' class='panel-footer panelFooter'> </div>";
                            echo "</div>";
                            $num++;
                        }
                    }
                ?>
        </div>
        
        <div class="col-md-5">
            <h2> Tabla general </h2>
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th> EQUIPO </th>
                            <th> PJ </th>
                            <th> PG </th>
                            <th> PE </th>
                            <th> PP </th>
                            <th> GF </th>
                            <th> GC </th>
                            <th> DIF </th>
                            <th> PTS </th>
                        </tr>

                        <?php
                            $query = "SELECT *FROM Equipo ORDER BY Puntos DESC";
                            $data = $connection->query($query);

                            if( $data->num_rows > 0 ){
                                $npos = 1;
                                while( $equipo = $data->fetch_assoc() ){
                                    echo "<tr>";
                                        echo "<td>". $npos.". ". $equipo["Nombre"]."</td>"; 
                                        echo "<td>". $equipo["PJ"] ."</td>";
                                        echo "<td>". $equipo["PG"] ."</td>";
                                        echo "<td>". $equipo["PE"] ."</td>";
                                        echo "<td>". $equipo["PP"] ."</td>";
                                        echo "<td>". $equipo["GA"] ."</td>";
                                        echo "<td>". $equipo["GR"] ."</td>";
                                        echo "<td>". $equipo["Diff"] ."</td>";
                                        echo "<td>". $equipo["Puntos"] ."</td>";
                                    echo "</tr>";
                                    $npos++;
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>

            <h2> Tabla de goleo </h2>
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th class="txtCenter"> Nombre </th>
                            <th> Equipo </th>
                            <th class="txtCenter"> Goles </th>
                        </tr>

                        <?php
                            $query = "SELECT Alumno.Nombre AS NameAlumno, Apellidos, Equipo.Nombre AS NameTeam, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo ON Jugador.ID_Equipo = Equipo.ID_Equipo ORDER BY Goles_Marcados DESC LIMIT 5;";
                            $data = $connection->query($query);

                            if( $data->num_rows > 0 ){
                                $npos = 1;
                                while( $goleador = $data->fetch_assoc() ){
                                    echo "<tr>";
                                        echo "<td>". $goleador["NameAlumno"]." ". $goleador["Apellidos"]."</td>";
                                        echo "<td>". $goleador["NameTeam"] ."</td>";
                                        echo "<td class='txtCenter'>". $goleador["Goles_Marcados"] ."</td>";
                                    echo "</tr>";
                                    $npos++;
                                }
                            }
                            $connection->close();
                        ?>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-1 col-xs-1"></div>
    </div>
    <br><br>

    <div id="modalModifyGame" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="alert alert-success teamSize teamModal1" id="e1"></div>
                            </div>

                            <div class="col-md-6 goalsModal">
                                <div class="col-md-4">
                                    <br><input type="text" id="e1Goals" class="form-control">
                                </div> <br>
                                <div class="col-md-2"> _ </div>
                                <div class="col-md-4">
                                    <input type="text" id="e2Goals" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="alert alert-success teamSize teamModal2" id="e2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-primary" id="btnNewStudent" value="Guardar">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
