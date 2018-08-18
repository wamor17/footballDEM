<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title> Torneos registrados </title>
        <?php include "Templates/metaInformation.php" ?>
    </head>
    <body>

    <?php
        include "Model/connectionModel.php";
        include "Templates/adminMenuBar.php";

        $getTournaments = "SELECT ID_Semestre, Semestre FROM Semestre;";
        $data = $connection->query($getTournaments);
    ?>

    <div class="row teams">
        <div class="col m1"></div>
        <div class="col s12 m10">
            <h3> Listado de torneos registrados </h3>
            <div class="row">
                <div class="col s12 m12">
                    <button type='button' class='btn grey lighten-1 modal-trigger' href='#modalInsertTournament'> Agregar un nuevo torneo </button>
                </div>
            </div>
            <?php
                $num = 1;
                while( $Torneos = $data->fetch_assoc() ){
                    echo "<div class='card hoverable'>";
                    echo "  <div class='card-content'>
                                <div class='row marginBottom'>
                                    <div class='col s8 m10'>
                                        <input type='text' class='txtID' id='IDSemestre".$num."' value='".$Torneos["ID_Semestre"]."'>
                                        <span id='Tournament".$num."' class='card-title'><strong>".$Torneos["Semestre"]."</strong> </span>
                                    </div>
                                    <div class='col s4 m2 right-align'>
                                        <a class='modal-trigger iconColor' href='#modalModifyTournament' onclick='loadTournamentToModify(".$num.")'> <i class='material-icons'>edit</i> </a>
                                        <a class='modal-trigger iconColor' href='#modalDeleteTournament' onclick='loadTournamentToDelete(".$num.")'> <i class='material-icons'>delete</i> </a>
                                    </div>
                                </div>
                            </div>";
                    echo "</div>";
                    $num++;
                }
            ?>
        </div>
        <div class="col m1"></div>
    </div>

    <div id="modalInsertTournament" class="modal">
        <div class="modal-content">
            <h4> Nuevo torneo </h4>
            <label> Periodo del torneo </label>
            <input type="text" class="form-control" id="txtNewTournament"><br>

            <div class="alert alert-success" id="correct"> Registro correcto </div>
            <div class="alert alert-danger" id="incorrect"> Registro incorrecto </div>
            <div class="alert alert-info">
                El periodo del torneo debe estar escrito en el siguiente formato: Ene-Jun 2018
            </div>
        </div>
        
        <div class="modal-footer">
            <a href='#' class="btn waves-effect" id="btnNewTournament" value="Crear torneo" onclick="insertTournament()"> Agregar </a>
            <a href='#' class="btn waves-effect modal-close" value="Cancelar"> Cancelar </a>
        </div>
    </div>

    <div id="modalModifyTournament" class="modal">
        <div class="modal-content">
            <h4> Modificando torneo </h4>
            <label> Periodo del torneo </label>
            <input type="text" class="form-control" id="txtIDModalModify">
            <input type="text" class="form-control" id="txtModifyTournament"><br>
            <div class="alert alert-info">
                El periodo del torneo debe estar escrito en el siguiente formato: Ene-Jun 2018
            </div>
        </div>

        <div class="modal-footer">
            <input type="submit" class="btn btn-warning" id="btnNewTeam" value="Actualizar" onclick="updateTournament()">
            <input type="submit" class="btn modal-close" id="btnCancel" value="Cancelar" data-dismiss="modal">
        </div>
    </div>

    <div id="modalDeleteTournament" class="modal">
        <div class="modal-content center-align">
            <i class='large material-icons'>info_outline</i>
            <input type="text" id="txtIDModalDelete">
            <p> ¿Esta seguro que eliminar el torneo del periodo <strong id="nameTournamentToDelete"> </strong>? </p>

            <div class="alert alert-success" id="correctD"> Torneo eliminado correctamente </div>
            <div class="alert alert-danger" id="incorrectD"> No se pudo eliminar el torneo </div>
        </div>

        <div class="modal-footer">
            <a class="btn btn-danger waves-effect" id="btnDeleteTeam" onclick="deleteTournament()"> Aceptar </a>
            <a class="btn modal-close waves-effect">Cancelar</a>
        </div>
    </div>

    <script>
            $(document).ready(function(){
                $('.dropdown-trigger').dropdown();
                $('.modal').modal();
                $('.sidenav').sidenav();
            });
    </script>
        
    </body>
</html>
