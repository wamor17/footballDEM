<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        <div class="col-md-1"></div>
        <div class="col-md-10 panel">
            <h3> Listado de torneos registrados </h3>
            <div class="row">
                <div class="col-md-12">
                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalInsertTournament'> Agregar un nuevo torneo </button>
                </div>
            </div><br>

            <?php
                $num = 1;
                while( $Torneos = $data->fetch_assoc() ){
                    echo "<div class='well'>";
                        echo "<div class='row'>
                                <div class='col-md-9'>
                                    <input type='text' class='txtID' id='IDSemestre".$num."' value='".$Torneos["ID_Semestre"]."'>
                                    <h2 id='Tournament".$num."' class='panel-title teamNamePanel'>
                                        <strong>".$Torneos["Semestre"]."</strong>
                                    </h2>
                                </div>
                                <div class='col-md-3 btnAlign'>
                                    <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModifyTournament' onclick='loadTournamentToModify(".$num.")'> Modificar </button>
                                    <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modalDeleteTournament' onclick='loadTournamentToDelete(".$num.")'> Eliminar </button>
                                </div>
                            </div>";
                    echo "</div>";
                    $num++;
                }
            ?>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div id="modalInsertTournament" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4> Nuevo torneo </h4>
                    </div>
                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Periodo del torneo </label>
                                    <input type="text" class="form-control" id="txtNewTournament"><br>
                                    <div class="alert alert-success" id="correct"> Registro correcto </div>
                                    <div class="alert alert-danger" id="incorrect"> Registro incorrecto </div>
                                    <div class="alert alert-info">
                                        El periodo del torneo debe estar escrito en el siguiente formato: Ene-Jun 2018
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-primary" id="btnNewTournament" value="Crear torneo" onclick="insertTournament()">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalModifyTournament" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading panelHead">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4> Modificando torneo </h4>
                    </div>

                    <div class="panel-body panelBody panelPaddingBody">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Periodo del torneo </label>
                                    <input type="text" class="form-control" id="txtIDModalModify">
                                    <input type="text" class="form-control" id="txtModifyTournament"><br>
                                    <div class="alert alert-info">
                                        El periodo del torneo debe estar escrito en el siguiente formato: Ene-Jun 2018
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-warning" id="btnNewTeam" value="Actualizar" onclick="updateTournament()">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalDeleteTournament" class="modal fade" role="dialog">
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
                                    <input type="text" id="txtIDModalDelete">
                                    <p> ¿Esta seguro que eliminar el torneo del periodo <strong id="nameTournamentToDelete"> </strong>? </p>
                                    <div class="alert alert-success" id="correctD"> Torneo eliminado correctamente </div>
                                    <div class="alert alert-danger" id="incorrectD"> No se pudo eliminar el torneo </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel-footer panelFooterModal">
                        <input type="submit" class="btn btn-danger" id="btnDeleteTeam" value="Borrar torneo" onclick="deleteTournament()">
                        <input type="submit" class="btn btn-default" id="btnCancel" value="Cancelar" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>

        
    </body>
</html>
