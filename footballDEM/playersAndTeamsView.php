<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Administraci&oacute;n del torneo </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body>

    <?php
        include "Model/connectionModel.php";
        include "Templates/adminMenuBar.php";

        $getTeams = "SELECT *FROM Equipo;";
        $data = $connection->query($getTeams);
    ?>

    <div class="row teams">
        <div class="col-md-1"></div>
        <div class="col-md-10 panel">
            <h3> Lista de equipos con sus respectivos integrantes </h3>
            <button type="button" class="btn btn-primary btnAlign"> Agregar equipo </button><br><br>

            <?php
                $num = 1;
                echo "<div class='panel-group' id='accordion'>";
                while( $Equipos = $data->fetch_assoc() ){
                    echo "  <div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <div class='row'>
                                        <div class='col-md-2 cursorPointer' data-toggle='collapse' data-parent='#accordion' href='#collapse".$num."'>
                                            <h4 class='panel-title teamNamePanel'>
                                                <strong>".$Equipos["Nombre"]."</strong>
                                            </h4>
                                        </div>
                                        <div class='col-md-7 cursorPointer' data-toggle='collapse' data-parent='#accordion' href='#collapse".$num."'>
                                            <div class='squareColor' style='background-color:".$Equipos["Color_Uniforme"]."'></div>
                                        </div>
                                        <div class='col-md-3 btnAlign'>
                                            <button type='button' class='btn btn-warning'> Modificar </button>
                                            <button type='button' class='btn btn-danger'> Eliminar </button>
                                        </div>
                                    </div>
                                </div>
                                <div id='collapse".$num."' class='panel-collapse collapse out'>
                                    <div class='panel-body'>";

                                        $getPlayers = "SELECT Nombre, Apellidos, Posicion FROM Jugador INNER JOIN Alumno ON Jugador.ID_Alumno = Alumno.ID_Alumno WHERE ID_Equipo = '".$Equipos['ID_Equipo']."';";
                                        $getData = $connection->query($getPlayers);
                                        $numPlayer = 1;

                                        echo "<div class='row'>
                                                <div class='col-md-8'>
                                                    <table class='table'>
                                                        <tr>
                                                            <th><strong> Nombre </strong></th>
                                                            <th><strong> Posici&oacute;n </strong></th>
                                                        </tr>";

                                                        while( $Jugadores = $getData->fetch_assoc() ){
                                                            echo "<tr>";
                                                            echo "<td>".$Jugadores["Nombre"]." ".$Jugadores["Apellidos"]."</td>";
                                                            echo "<td>".$Jugadores["Posicion"]." </td>";
                                                            echo "</tr>";
                                                            $numPlayer++;
                                                        }
                                                        echo "</table>
                                                </div>
                                                <div class='col-md-2'>
                                                    <table class='table'>
                                                        <tr> <td><strong> PJ </strong></td>
                                                             <td><strong> PG </strong></td>
                                                             <td><strong> PE </strong></td>
                                                             <td><strong> PP </strong></td>
                                                             <td><strong> GA </strong></td>
                                                             <td><strong> GR </strong></td>
                                                             <td><strong> Diff </strong></td>
                                                             <td><strong> Puntos </strong></td>
                                                        </tr>
                                                        <tr> <td class='txtCenter'> ".$Equipos["PJ"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["PG"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["PE"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["PP"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["GA"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["GR"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["Diff"]." </td>
                                                             <td class='txtCenter'> ".$Equipos["Puntos"]."  </td>
                                                        </tr>
                                                    </table>
                                                    <p> Color de uniforme: <div class='squareColor' style='background-color:".$Equipos["Color_Uniforme"]."'></div></p>
                                                </div>
                                            </div>";
                            echo    "</div>";
                        echo    "</div>";
                      echo "</div>";
                      $num++;
                }
                echo "</div>";
            ?>
        </div>
        <div class="col-md-1"></div>
    </div>
        
    </body>
</html>
