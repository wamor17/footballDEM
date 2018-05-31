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
    <body>
        <div class="row content">
        <div class="col-md-1 col-xs-1"></div>
        <div class="col-md-5">
            <h2> Resultados Jornada 7 </h2>
                <?php
                    $getPartidos = "SELECT *FROM Partido;";
                    $Partidos = $connection->query($getPartidos);

                    if( $Partidos->num_rows > 0 ){
                        $num = 1;
                        while( $Resultados = $Partidos->fetch_assoc() ){
                            echo " <div class='panel panel-default'>
                                        <div class='panel-body panelBody'>";
                                        echo" <div class='col-md-1'> </div> ";

                                        echo" <div class='col-md-4 col-xs-5 col-sm-5'> ";
                                            echo" <div class='alert alert-success teamSize' id='E1_".$num."_left'>". $Resultados["Equipo_1"] ."</div>";
                                        echo" </div> ";

                                        echo" <div class='col-md-2 col-xs-2 col-sm-2'>";
                                            echo" <h4 id='goles_".$num."' class='golesSize'><strong>".$Resultados["Goles_E1"]." - ". $Resultados["Goles_E2"]."</strong></h4> ";
                                        echo" </div> ";

                                        echo" <div class='col-md-4 col-xs-4 col-sm-4'>
                                                <div class='alert alert-success  teamSize' id='E2_".$num."_right'>". $Resultados["Equipo_2"] ." </div> ";
                                        echo" </div> ";

                                        echo "<div class='col-md-1'>
                                                <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalModifyGame' onclick='loadDataToModal($num)'> <span class='glyphicon glyphicon-pencil'> </span> </button>
                                            </div>";
                                    echo "</div>";
                                    echo "<div class='panel-footer panelFooter'> Hora: ".$Resultados["Hora"]."</div>";
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
                            <th> Equipo </th>
                            <th> PJ </th>
                            <th> PG </th>
                            <th> PE </th>
                            <th> PP </th>
                            <th> GA </th>
                            <th> GR </th>
                            <th> Diff </th>
                            <th> Pts </th>
                        </tr>

                        <?php
                            $query = "SELECT *FROM Equipo ORDER BY Puntos DESC";
                            $data = $connection->query($query);

                            if( $data->num_rows > 0 ){
                                $npos = 1;
                                while( $equipo = $data->fetch_assoc() ){
                                    echo "<tr>";
                                        echo "<td>". $equipo["Nombre"]."</td>"; 
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
        </div>
        <div class="col-md-1 col-xs-1"></div>
    </div>

    <div id="modalModifyGame" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-body">
                <div class='panel panel-default'>
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class='panel-body panelBody panelPaddingBody'>
                        <div class="row">
                            <div class='col-md-3 col-xs-3'>
                                <div class="alert alert-success teamSize" id="e1"></div>
                            </div>

                            <div class="col-md-8">
                                <div class="col-md-5 col-xs-5">
                                    <input type="text" id="e1Goals" class="form-control">
                                </div>

                                <div class="col-md-2 col-xs-2"> _ </div>

                                <div class="col-md-5 col-xs-5">
                                    <input type="text" id="e2Goals" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <div class="alert alert-success teamSize" id="e2"></div>
                            </div>
                        </div>
                    </div>
                    <div class='panel-footer panelFooterModal'>
                        <input type="submit" class="btn btn-primary" id="btnNewStudent" value="Guardar">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
