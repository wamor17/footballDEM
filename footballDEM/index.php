<!-- 
    Document   : index
    Created on : 20-ene-2018, 14:26:55
    Author     : walter
-->

<?php
    include "Model/connectionModel.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Torneo del futbol del DEM Yuriria</title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body onload="loadData()">
        
        <div class="mainBody">
             <div class="navbar-fixed">
                <nav class="blue-grey darken-4">
                <div class="row">
                    <div class="col m1"></div>
                    <div class="col m10">
                        <div class="nav-wrapper">
                            <a href="index.php" class="brand-logo"> <i class="large licon material-icons left">school</i> Liga DEM Yuriria </a>
                            <ul class="right hide-on-med-and-down">
                                <a class="waves-effect waves-light modal-trigger" href="#modalLogIn">
                                    Iniciar sesi&oacute;n <i class="material-icons left">lock_open</i>
                                </a>
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
                <div class="col s12 m12 l10 offset-l1">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text center-align">
                            <p class="principalBanner"> Torneo de f&uacute;tbol del semestre <?php echo $Semester["Semestre"] ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
            <div class="col l1 "></div>
            <div class="col s12 m12 l5">
                    <?php
                        $getJornadas = "SELECT DISTINCT Num_Jornada FROM Jornada ORDER BY Num_Jornada ASC;";
                        $dataJornadas = $connection->query($getJornadas);

                        echo "<div class='row marginJornadas'>
                                <div class='col m7 left-align'>
                                    <p id='jornada' class='sizeTextJornadas'></p>
                                </div>
                                <div class='col m5'>
                                    <div class='dropdown right-align'>
                                        <a class='dropdown-trigger btn blue-grey lighten-1' href='#' data-target='ddJornadas'>
                                            Cambiar jornada <i class='small material-icons right'>arrow_drop_down</i>
                                        </a>

                                        <ul id='ddJornadas' class='dropdown-content'>";
                                            if( $dataJornadas->num_rows > 0 ){
                                                while( $Jornadas = $dataJornadas->fetch_assoc() ){
                                                    echo "<li class='black-text' id='j".$Jornadas["Num_Jornada"]."' onclick='selectJornada(".$Jornadas["Num_Jornada"].")'><a href='#'> Jornada ".$Jornadas["Num_Jornada"]." </a></li>";
                                                }
                                            }
                        echo           "</ul>
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
                                echo "  <div class='card hoverable cardSize'>

                                            <div class='card-content'>
                                                <div class='row rowCardResultGame'>
                                                    <div class='col s5 m5 center-align sizeTeams' id='E1_".$num."_left'> </div>
                                                    <div class='col s2 m2 center-align border-lr sizeGoals' id='goles_".$num."'> </div>
                                                    <div class='col s5 m5 center-align sizeTeams' id='E2_".$num."_right'> </div>
                                                </div>
                                            </div>
                                            
                                            <div class='card-action grey lighten-5'>
                                                <div class='center-align marginHour' id='hourGame".$num."'> Hora</div>
                                            </div>

                                        </div>";
                                $num++;
                            }
                        }
                    ?>
            </div>

            <div class="col s12 m12 l5">
                <div class="card hoverable">
                    <div class="card-content noPaddingCard">
                        <div class="card-title center-align tgTitleSize"> Tabla general </div>
                        <div class="divider"></div>
                        <table class="table striped">
                            <tr>
                                <th class="center-align"> EQUIPO </th>
                                <th class="center-align"> PJ </th>
                                <th class="center-align"> G </th>
                                <th class="center-align"> E </th>
                                <th class="center-align"> P </th>
                                <th class="center-align"> GF </th>
                                <th class="center-align"> GE </th>
                                <th class="center-align"> DIF </th>
                                <th class="center-align"> PTS </th>
                            </tr>

                            <?php
                                $query = "SELECT *FROM Equipo ORDER BY Puntos DESC";
                                $data = $connection->query($query);

                                if( $data->num_rows > 0 ){
                                    $npos = 1;
                                    while( $equipo = $data->fetch_assoc() ){
                                        echo "<tr>";
                                            echo "<td>". $npos.". ". $equipo["Nombre"]."</td>"; 
                                            echo "<td class='center-align'>". $equipo["PJ"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["PG"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["PE"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["PP"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["GA"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["GR"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["Diff"] ."</td>";
                                            echo "<td class='center-align'>". $equipo["Puntos"] ."</td>";
                                        echo "</tr>";
                                        $npos++;
                                    }
                                }
                            ?>
                        </table>
                    </div>

                    <div class="card-action glMargin grey lighten-5">
                        <div class="row">
                            <div class="col s12 m12">
                                <p class="glSize textGlosary"> <i class="gliconSize small material-icons left">book</i> GLOSARIO </p>
                            </div>

                            <div class="col s4 m4">
                                <p class="glSize"> PJ: Partidos jugados </p>
                                <p class="glSize"> P: Partidos perdidos </p>
                            </div>

                            <div class="col s4 m4">
                                <p class="glSize">  G: Partidos ganados </p>
                                <p class="glSize">  GF: Goles a favor</p>
                            </div>

                            <div class="col s4 m4">
                                <p class="glSize"> E: Partidos empatados </p>
                                <p class="glSize"> GE: Goles en contra </p>
                            </div>
                        </div>                  
                    </div>

                </div>

                <div class="card hoverable">
                    <div class="card-content noPaddingCard">
                        <div class="card-title center-align tgTitleSize"> Tabla de goleo </div>
                        <div class="divider"></div>
                        
                        <table class="table striped">
                            <tr>
                                <th class="center-align"> Nombre </th>
                                <th class="center-align"> Equipo </th>
                                <th class="center-align"> Goles </th>
                            </tr>

                            <?php
                                $query = "SELECT Alumno.Nombre AS NameAlumno, Apellidos, Equipo.Nombre AS NameTeam, Jugador.Goles_Marcados FROM Alumno INNER JOIN Jugador ON Jugador.ID_Alumno = Alumno.ID_Alumno INNER JOIN Equipo ON Jugador.ID_Equipo = Equipo.ID_Equipo ORDER BY Goles_Marcados DESC LIMIT 5;";
                                $data = $connection->query($query);

                                if( $data->num_rows > 0 ){
                                    $npos = 1;
                                    while( $goleador = $data->fetch_assoc() ){
                                        echo "<tr>";
                                            echo "<td class='left-align'>". $goleador["NameAlumno"]." ". $goleador["Apellidos"]."</td>";
                                            echo "<td class='left-align'>". $goleador["NameTeam"] ."</td>";
                                            echo "<td class='center-align'>". $goleador["Goles_Marcados"] ."</td>";
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
            <div class="col l1"></div>
        </div>
        <br><br>

     <!-- MODAL QUE MUESTRA EL FORMULARIO DE LOGIN PARA LOS DIFERENTES USUARIOS -->
        <div id="modalLogIn" class="modal modal-fixed-footer">

            <div class="modal-content">
                <h4> Inicio de sesi&oacute;n </h4><br>
                <div class="input-field">
                    <input id="txtUser" type="text" class="validate">
                    <label for="txtUser"> Nombre de usuario </label>
                </div>

                <div class="input-field">
                    <input id="txtPassword" type="password" class="validate">
                    <label for="txtPassword"> Contraseña </label>
                </div>

                <div class="red-text" id="alertDanger" style="display: none;">
                    <p> <strong> Usuario </strong> o <strong> contraseña </strong> incorrectos </p>
                </div>

                <div class="green-text" id="alertSuccess" style="display: none;">
                    <p> <strong> Bienvenido </strong> </p>
                </div>
            </div>

            <div class="modal-footer">
                <a class="waves-effect waves-light btn blue-grey lighten-1" onclick="verifyDataUser()"> <i class="material-icons left">check</i> Ingresar </a>
                <a class="modal-close waves-effect waves-light btn blue-grey lighten-1"> <i class="material-icons left">close</i> Salir </a>
            </div>

        </div>
    </div>

        </div>


    <script>
        $(document).ready(function(){
            $('.dropdown-trigger').dropdown();
            $('.modal').modal();
        });
    </script>

    </body>
</html>
