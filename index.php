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
    <body onload="clearBoxes()">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-inverse navbar-fixed-top navbarColor">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand textLogo" href="index.html"> Liga DEM Yuriria </a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li><a href="#" data-toggle="modal" data-target="#modalLogIn" class="textLogo"> Iniciar sesion </a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row content">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h2 class="resultadoJornada"> Resultados Jornada 7 </h2>
                <?php
                    $getPartidos = "SELECT *FROM Partido;";
                    $Partidos = $connection->query($getPartidos);

                    if( $Partidos->num_rows > 0 ){
                        $num = 1;
                        while( $Resultados = $Partidos->fetch_assoc() ){
                            echo " <div class='panel panel-default'>
                                    <div class='panel-body panelBody'>";
                                    echo" <div class='col-md-1'> </div> ";

                                    echo" <div class='col-md-4 col-sm-5'> ";
                                        echo" <div class='alert alert-success teamSize' id='E1_".$num."_left'>". $Resultados["Equipo_1"] ."</div>";
                                    echo" </div> ";

                                    echo" <div class='col-md-2  col-sm-2 golesSize'>";
                                        echo" <h5 id='goles_".$num."' class='golesSize'><strong>".$Resultados["Goles_E1"]." - ". $Resultados["Goles_E2"]."</strong></h5> ";
                                    echo" </div> ";

                                    echo" <div class='col-md-4 col-sm-4 teamSize'>
                                            <div class='alert alert-success teamSize' id='E2_".$num."_right'>". $Resultados["Equipo_2"] ." </div> ";
                                    echo" </div> ";

                                    echo "<div class='col-md-1'></div>";
                                echo "</div>";
                                echo "<div class='panel-footer panelFooter hourSize'> Final </div>";//"Hora: ".$Resultados["Hora"]." </div>";                                
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
            <div class="col-md-1"></div>
        </div>



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

