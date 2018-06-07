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
            <div class="row">
                <div class="col-md-4">
                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalInsertTeam'> Agregar nuevo equipo </button>
                    <button type="button" class="btn btn-default txtRight" style="margin-left: 15px;"> Generar jornadas </button><br><br>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-info alert-dismissible alertSize">
                        Recargue la p&aacute;gina para ver los cambios
                    </div>                
                </div>
            </div>

            <?php
                $num = 1;
                echo "<div class='panel-group' id='accordion'>";
                while( $Equipos = $data->fetch_assoc() ){
                    echo "  <div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <div class='row'>
                                        <div class='col-md-9 cursorPointer' data-toggle='collapse' data-parent='#accordion' href='#collapse".$num."'>
                                            <h4 id='nameTeam".$num."' class='panel-title teamNamePanel'>
                                                <strong>".$Equipos["Nombre"]."</strong>
                                            </h4>
                                        </div>
                                        <div class='col-md-3 btnAlign'>
                                            <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModifyTeam' onclick='loadDataTeamForModify(".$num.")'> Modificar </button>
                                            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modalDeleteTeam' onclick='loadDataTeamForDelete(".$num.")'> Eliminar </button>
                                        </div>
                                    </div>
                                </div>
                                <div id='collapse".$num."' class='panel-collapse collapse out'>
                                    <div class='panel-body'>";

                                        $getPlayers = "SELECT Nombre, Apellidos, Posicion FROM Jugador INNER JOIN Alumno ON Jugador.ID_Alumno = Alumno.ID_Alumno WHERE ID_Equipo = '".$Equipos['ID_Equipo']."';";
                                        $getData = $connection->query($getPlayers);
                                        $numPlayer = 1;

                                        echo "<div class='row'>
                                                <div class='col-md-7'>
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
                                                <div class='col-md-4'>
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
                                                    <p> Color de uniforme: <div id='colorTeam".$num."' class='squareColor' style='background-color:".$Equipos["Color_Uniforme"]."'></div></p>
                                                </div>
                                                <div class='col-md-1'></div>
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

    <div id="modalInsertTeam" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4> Nuevo equipo </h4>
                    </div>
                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre del equipo: </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Color del uniforme: </label>
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                            Seleccione un color
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li id="cWhite" onclick="colorSelected('blanco')"><a href="#"> Blanco </a></li>
                                            <li id="cBlack" onclick="colorSelected('negro')"><a href="#"> Negro </a></li>
                                            <li id="cRed" onclick="colorSelected('rojo')"><a href="#"> Rojo </a></li>
                                            <li id="cOrange" onclick="colorSelected('naranja')"><a href="#"> Naranja </a></li>
                                            <li id="cPink" onclick="colorSelected('rosa')"><a href="#"> Rosa </a></li>
                                            <li id="cGreen" onclick="colorSelected('verde')"><a href="#"> Verde </a></li>
                                            <li id="cBlue" onclick="colorSelected('azul')"><a href="#"> Azul </a></li>
                                            <li id="cGray" onclick="colorSelected('gris')"><a href="#"> Gris </a></li>
                                            <li id="cDBlue" onclick="colorSelected('azul_marino')"><a href="#"> Azul Marino </a></li>
                                            <li id="cYellow" onclick="colorSelected('amarillo')"><a href="#"> Amarillo </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="colorCircle" class="colorSelectedTeam"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-primary" id="btnNewTeam" value="Guardar">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalModifyTeam" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5> Modifique el equipo seleccionado </h5>
                    </div>
                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre del equipo: </label>
                                    <input id="newNameTeam" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Color del uniforme </label>
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                            Seleccione un color
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li id="cWhite" onclick="colorSelectedU('blanco')"><a href="#"> Blanco </a></li>
                                            <li id="cBlack" onclick="colorSelectedU('negro')"><a href="#"> Negro </a></li>
                                            <li id="cRed" onclick="colorSelectedU('rojo')"><a href="#"> Rojo </a></li>
                                            <li id="cOrange" onclick="colorSelectedU('naranja')"><a href="#"> Naranja </a></li>
                                            <li id="cPink" onclick="colorSelectedU('rosa')"><a href="#"> Rosa </a></li>
                                            <li id="cGreen" onclick="colorSelectedU('verde')"><a href="#"> Verde </a></li>
                                            <li id="cBlue" onclick="colorSelectedU('azul')"><a href="#"> Azul </a></li>
                                            <li id="cGray" onclick="colorSelectedU('gris')"><a href="#"> Gris </a></li>
                                            <li id="cDBlue" onclick="colorSelectedU('azul_marino')"><a href="#"> Azul Marino </a></li>
                                            <li id="cYellow" onclick="colorSelectedU('amarillo')"><a href="#"> Amarillo </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="newColorTeam" class="colorSelectedTeam"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-warning" id="btnUpdateTeam" value="Guardar">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalDeleteTeam" class="modal fade" role="dialog">
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
                                    <p> ¿Esta seguro que desea sacar al equipo <strong id="nameTeamToDelete"> </strong> del torneo de f&uacute;tbol del DEM Yuriria? </p>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-danger" id="btnDeleteTeam" value="Borrar equipo">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

        
    </body>
</html>
