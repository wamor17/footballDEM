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
    ?>

    <div class="row teams">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h3> Lista de equipos con sus respectivos integrantes </h3>
        </div>
        <div class="col-md-2">
<!--            <button type="button" class="btn btn-primary"> Nuevo alumno </button> -->
        </div>
        <div class="col-md-1"></div>
    </div>

    <?php 
        $getTeams = "SELECT *FROM Equipo;";
        $data = $connection->query($getTeams);
    ?>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?php 

                while( $Equipos = $data->fetch_assoc() ){
                    echo "<div class='panel panel'>
                          <div class='panel-heading'> <h4> ". $Equipos["Nombre"] ."</h4></div>
                            <div class='panel-body'>";
                            $getPlayers = "SELECT Nombre, Apellidos FROM Jugador INNER JOIN Alumno ON Jugador.ID_Alumno = Alumno.ID_Alumno WHERE ID_Equipo = '".$Equipos['ID_Equipo']."';";
                            $getData = $connection->query($getPlayers);
                            $numPlayer=1;

                            echo "<ul>";
                            while( $Jugadores = $getData->fetch_assoc() ){
                                echo "<li>".$Jugadores["Nombre"]." ".$Jugadores["Apellidos"]."</li>";
                                $numPlayer++;
                            }
                            echo "</ul>";
                    echo"   </div>
                         </div>";
                }
            ?>
        </div>
        <div class="col-md-5">
            <?php 
                
            ?>
            <div class="panel panel">
                <div class="panel-heading"> <p> <?php echo $Equipos["Nombre"]; ?> </p></div>
                <div class="panel-body"></div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

        
    </body>
</html>
