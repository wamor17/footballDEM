<!-- 
    Document   : index
    Created on : 20-ene-2018, 14:26:55
    Author     : walter
-->

<?php include "Model/connectionModel.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Torneo del futbol del DEM Yuriria</title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body onload="loadData()">

        <div class="navbar-fixed">
            <nav class="blue-grey darken-4">
            <div class="row">
                <div class="col m1"></div>
                <div class="col m10">
                    <div class="nav-wrapper">
                        <a href="index.php" class="brand-logo"> Liga DEM Yuriria </a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#" data-toggle="modal" data-target="#modalLogIn" class="textLogo"> Iniciar sesion </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col m1"></div>
            </div>
            </nav>
        </div>

        <?php
            $getChamp = "SELECT *FROM Semestre;";
            $dataChampionship = $connection->query($getChamp);

            if( $dataChampionship->num_rows > 0 ){
                $Semester = $dataChampionship->fetch_assoc();
            }
        ?>

        <br>
        <div class="row">
            <div class="col m10 offset-m1">
                <div class="card blue-grey darken">
                    <div class="card-content white-text center-align">
                        <p class="principalBanner"> Torneo de f&uacute;tbol del Semestre <?php echo $Semester["Semestre"] ?> </p>
                    </div>
                </div>
            </div>
        </div>
        <br>

<!--content-->
        <div class="row">
        <div class="col m1"></div>
        <div class="col m5">
                <?php
                    $getJornadas = "SELECT DISTINCT Num_Jornada FROM Jornada ORDER BY Num_Jornada ASC;";
                    $dataJornadas = $connection->query($getJornadas);

                    echo "<div class='row'>
                            <div class='col m7'>
                                <p id='jornada'></p>
                            </div>
                            <div class='col m5'>
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
                            echo " <div class='card'>
                                        <div class='card-content panelBody'>";
                                        echo" <div class='col m1'> </div> ";

                                        echo" <div class='col m4'> ";
                                            echo" <div class='alert alert-success teamSize' id='E1_".$num."_left'> </div>";
                                        echo" </div> ";

                                        echo" <div class='col m2'>";
                                            echo" <h4 id='goles_".$num."' class='golesSize'><strong> </strong></h4> ";
                                        echo" </div> ";

                                        echo" <div class='col m4'>
                                                <div class='alert alert-success  teamSize' id='E2_".$num."_right'> </div> ";
                                        echo" </div> ";

                                        echo "<div class='col m1'></div>";
                                    echo "</div>";
                                    echo "<div id='hourGame".$num."' class='panel-footer panelFooter'> </div>";
                            echo "</div>";
                            $num++;
                        }
                    }
                ?>
        </div>
        
        <div class="col m5">
            <div class="card hoverable">
                <div class="card-content">
                <span class="card-title"> <h2> Tabla general </h2> </span>
                    <table class="table">
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
        <div class="col m1 s1"></div>
    </div>
    <br><br>

 <!-- MODAL QUE MUESTRA EL FORMULARIO DE LOGIN PARA LOS DIFERENTES USUARIOS -->
    <div id="modalLogIn" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Inicio de sesi&oacute;n </h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>Usuario:</label>
                    <input class="form-control" id="txtUser" name="txtUser">
                </div>

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                </div>

                <div class="alert alert-danger" id="alertDanger" style="display: none;">
                    <p> <strong> Usuario </strong> o <strong> contraseña </strong> incorrectos </p>
                </div>

                <div class="alert alert-success" id="alertSuccess" style="display: none;">
                    <p> Bienvenido </p>
                </div>
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" id="btnIngress" value="Ingresar" onclick="verifyDataUser()">
            </div>
        </div>

    </div>
</div>


    </body>
</html>