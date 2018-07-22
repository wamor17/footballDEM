<!-- 
    Document   : adminView
    Created on : 24-ene-2018, 13:06:59
    Author     : walter
-->

<?php
    include "Model/connectionModel.php";
    include "Templates/adminMenuBar.php";
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
            <div class="col s12 m12 l10 offset-l1">
                <div class="card grey darken-1">
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
                                        <a class='dropdown-trigger btn grey lighten-1' href='#' data-target='ddJornadas'>
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
                                echo "  <div class='card hoverable cardSize modal-trigger cardEdit' onclick='loadDataToModal($num)' href='#modalModifyGame'>

                                            <div class='card-content'>
                                                <div class='row rowCardOptions'>
                                                    <div class='col s12 m12'>
                                                        <span class='card-title'><a class='modal-trigger editColor' onclick='loadDataToModal($num)' href='#modalModifyGame'><i class='material-icons sizeEdit right'>edit</i></a></span>
                                                    </div>
                                                </div>

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

    <div id="modalModifyGame" class="modal modal-fixed-footer bottom-sheet">
        <div class="modal-content">

            <br><br>
            <div class="row">
                <div class="col s4 m4">
                    <div class="team1Modal center-align" id="e1"></div>
                </div>

                <div class="col s4 m4">
                    <div class="col m5">
                        <input type="text" id="e1Goals" class="form-control">
                    </div>
                    <div class="col m2">__</div>
                    <div class="col m5">
                        <input type="text" id="e2Goals" class="form-control">
                    </div>
                </div>

                <div class="col s4 m4">
                    <div class="team2Modal center-align" id="e2"></div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <a class="waves-effect waves-light btn grey lighten-1 center"> <i class="material-icons left">check</i> Aplicar cambios </a>
            <a class="modal-close waves-effect waves-light btn grey lighten-1"> <i class="material-icons left">close</i> Cancelar </a>
        </div>
    </div>

    </body>
</html>
