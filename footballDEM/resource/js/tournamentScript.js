
function loadTournamentToModify(num){
    document.getElementById("txtModifyTournament").value = document.getElementById("Tournament"+num).textContent.trim();
    document.getElementById("txtIDModalModify").value = document.getElementById("IDSemestre"+num).value;
}

function loadTournamentToDelete(num){
    document.getElementById("nameTournamentToDelete").textContent = document.getElementById("Tournament"+num).textContent;
    document.getElementById("txtIDModalDelete").value = document.getElementById("IDSemestre"+num).value;
}

function insertTournament(){
    var newTournament = document.getElementById("txtNewTournament").value;

    $.post('Controller/tournaments/insertTournamentController.php', { nuevoTorneo: newTournament }, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive = "correct" ){
            document.getElementById("correct").style.display = "block";
            document.getElementById("incorrect").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correct").style.display = "none";
            document.getElementById("incorrect").style.display = "block";
        }
    });
}

function updateTournament(){
    var idTournament = document.getElementById("txtIDModalModify").value;
    var nameTorneo = document.getElementById("txtModifyTournament").value;
//    alert(idTournament+" "+nameTorneo);

    $.post('Controller/tournaments/updateTournamentController.php', { ID_Tournament: idTournament, Semestre: nameTorneo }, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive = "correct" ){
            document.getElementById("correct").style.display = "block";
            document.getElementById("incorrect").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correct").style.display = "none";
            document.getElementById("incorrect").style.display = "block";
        }
    });
}

function deleteTournament(){
    var idTournament = document.getElementById("txtIDModalDelete").value;

    $.post('Controller/tournaments/deleteTournamentController.php', { ID_Torneo: idTournament }, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive = "correct" ){
            document.getElementById("correctD").style.display = "block";
            document.getElementById("incorrectD").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correctD").style.display = "none";
            document.getElementById("incorrectD").style.display = "block";
        }
    });    
}
