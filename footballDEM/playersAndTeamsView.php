<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

    <div class="row">
        <div class="col m1"></div>
        <div class="col m10">
            <h3> Lista de equipos con sus integrantes </h3>
            <button type="button" class="btn modal-trigger" href='#modalInsertTeam'> Agregar nuevo equipo </button>
            <button type="button" class="btn"> Generar jornadas </button>

            <?php
                $num = 1;
                echo "<ul class='collapsible popout'>";
                while( $Equipos = $data->fetch_assoc() ){
                 echo " <li>
                            <div class='collapsible-header'>
                                <i class='material-icons'>expand_more</i> <strong id='nameTeam".$num."'>".$Equipos["Nombre"]."</strong>
                                <i class='right-align material-icons'>edit</i>
                                <i class='right-align material-icons'>delete</i>
                            </div>

                            <!--<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModifyTeam' onclick='loadDataTeamForModify(".$num.")'> Modificar </button>
                                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modalDeleteTeam' onclick='loadDataTeamForDelete(".$num.")'> Eliminar </button> -->
                            
                            <div class='collapsible-body grey lighten-5'>";
                                $getPlayers = "SELECT Nombre, Apellidos, Posicion FROM Jugador INNER JOIN Alumno ON Jugador.ID_Alumno = Alumno.ID_Alumno WHERE ID_Equipo = '".$Equipos['ID_Equipo']."';";
                                $getData = $connection->query($getPlayers);
                                $numPlayer = 1;

                            echo "<div class='row'>
                                    <div class='col m8'>
                                        <table class='table striped'>
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
                                    <div class='col m4'>
                                        <table class='table striped'>
                                            <tr> <td class='center-align'><strong> PJ </strong></td>
                                                <td class='center-align'><strong> PG </strong></td>
                                                <td class='center-align'><strong> PE </strong></td>
                                                <td class='center-align'><strong> PP </strong></td>
                                                <td class='center-align'><strong> GA </strong></td>
                                                <td class='center-align'><strong> GR </strong></td>
                                                <td class='center-align'><strong> Diff </strong></td>
                                                <td class='center-align'><strong> Puntos </strong></td>
                                            </tr>
                                            <tr> <td class='center-align'> ".$Equipos["PJ"]." </td>
                                                <td class='center-align'> ".$Equipos["PG"]." </td>
                                                <td class='center-align'> ".$Equipos["PE"]." </td>
                                                <td class='center-align'> ".$Equipos["PP"]." </td>
                                                <td class='center-align'> ".$Equipos["GA"]." </td>
                                                <td class='center-align'> ".$Equipos["GR"]." </td>
                                                <td class='center-align'> ".$Equipos["Diff"]." </td>
                                                <td class='center-align'> ".$Equipos["Puntos"]."  </td>
                                            </tr>
                                        </table>
                                        <p> Color de uniforme: <div id='colorTeam".$num."' class='squareColor' style='background-color:".$Equipos["Color_Uniforme"]."'></div></p>
                                    </div>
                                </div>

                            </div>
                        </li>
                    ";
                $num++;
                }
                echo "</ul>";
            ?>
        </div>
        <div class="col m1"></div>
    </div>

    <div id="modalInsertTeam" class="modal modal-small modal-fixed-footer">
        
        <div class="modal-content">
            <h4> Nuevo equipo </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nombre del equipo: </label>
                        <input type="text" class="form-control" id="txtNameTeamModal">
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
                    <div id="colorCircle" class="colorSelectedTeam"></div><br>
                </div>
                
                <div class="col-md-12">
                    <div class="alert alert-success" id="correctIns"> Registro correcto </div>
                    <div class="alert alert-danger" id="incorrectIns"> Registro incorrecto </div>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <input type="submit" class="btn" id="btnNewTeam" value="Guardar" onclick="insertTeam()">
            <input type="submit" class="btn modal-close" id="btnCancel" value="Cancelar" data-dismiss="modal">
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
                                    <input id="IDTeamModalModify" class="txtIDTeamModify" type="text" class="form-control">
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
                                    <input type="text" id="colorSelectedUpdate" class="colorSelectedUpdate form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="newColorTeam" class="colorSelectedTeam"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-success" id="correctUP"> Actualizaci&oacute;n correcta </div>
                            <div class="alert alert-danger" id="incorrectUP"> Actualizaci&oacute;n incorrecta </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-warning" id="btnUpdateTeam" value="Guardar" onclick="updateTeam()">
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
                                    <input id="IDTeamModalDelete" class="txtIDTeamDelete" type="text" class="form-control">
                                    <p> ¿Esta seguro que desea sacar al equipo <strong id="nameTeamToDelete"> </strong> del torneo de f&uacute;tbol del DEM Yuriria? Tambi&eacute;n se eliminar&aacute;n los jugadores ligados a este equipo. </p>
                                    <div class="alert alert-success" id="correctDel"> Correcto </div>
                                    <div class="alert alert-danger" id="incorrectDel"> Error </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-danger" id="btnDeleteTeam" value="Borrar equipo" onclick="deleteTeam()">
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
                $('.tabs').tabs();
                $('.collapsible').collapsible();
            });
    </script>

    </body>
</html>
