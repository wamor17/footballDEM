
<?php
    include "../Model/connectionModel.php";
    session_start();

    $user = $_POST["user"];
    $password = $_POST["password"];
    $query = "SELECT *FROM Usuario WHERE Usuario = '$user';";
    $resultSet = $connection->query($query);
    $usuario = $resultSet->fetch_assoc();
    $nombre = $usuario["Usuario"];

    if( $usuario["Pwd"] == $password ){
        $tipo = $usuario["Tipo"];
        $_SESSION["usuario"] = $user;
    }else{
        $tipo = "null";
        session_destroy();
    }

    echo json_encode($tipo);
?>
