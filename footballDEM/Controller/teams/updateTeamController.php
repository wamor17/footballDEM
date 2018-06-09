<?php
    include "../../Model/connectionModel.php";

    $IDTeam = $_POST["IDTeam"];
    $NameTeam = $_POST["NewTeam"];
    $ColorTeam = $_POST["newColor"];
    $query = "UPDATE Equipo SET Nombre = '$NameTeam', Color_Uniforme = $ColorTeam WHERE ID_Equipo = $IDTeam;";

    if ( $resultSet = $connection->query($query) ){
        $message = "correct";    
    }else{
        $message = "incorrect";
    }

    echo json_encode($message);
    // Jul-Dic 2018
?>