
function colorSelected(color){
    switch(color){
        case "blanco": document.getElementById("colorCircle").style.background = "white";
        break;
        case "negro": document.getElementById("colorCircle").style.background = "black";
        break;
        case "rojo": document.getElementById("colorCircle").style.background = "red";
        break;
        case "naranja": document.getElementById("colorCircle").style.background = "orange";
        break;
        case "rosa": document.getElementById("colorCircle").style.background = "pink";
        break;
        case "verde": document.getElementById("colorCircle").style.background = "green";
        break;
        case "azul": document.getElementById("colorCircle").style.background = "blue";
        break;
        case "gris": document.getElementById("colorCircle").style.background = "gray";
        break;
        case "azul_marino": document.getElementById("colorCircle").style.background = "darkblue";
        break;
        default: document.getElementById("colorCircle").style.background = "yellow";
    }
}

function colorSelectedU(color){
    switch(color){
        case "blanco": document.getElementById("newColorTeam").style.background = "white";
        break;
        case "negro": document.getElementById("newColorTeam").style.background = "black";
        break;
        case "rojo": document.getElementById("newColorTeam").style.background = "red";
        break;
        case "naranja": document.getElementById("newColorTeam").style.background = "orange";
        break;
        case "rosa": document.getElementById("newColorTeam").style.background = "pink";
        break;
        case "verde": document.getElementById("newColorTeam").style.background = "green";
        break;
        case "azul": document.getElementById("newColorTeam").style.background = "blue";
        break;
        case "gris": document.getElementById("newColorTeam").style.background = "gray";
        break;
        case "azul_marino": document.getElementById("newColorTeam").style.background = "darkblue";
        break;
        default: document.getElementById("newColorTeam").style.background = "yellow";
    }
}

function loadDataTeamForModify(num){
    var nameTeam = document.getElementById("nameTeam"+num).textContent.trim();
    var colorTeam = document.getElementById("colorTeam"+num);

    document.getElementById("newNameTeam").value = nameTeam;
    document.getElementById("newColorTeam").style.background = getComputedStyle(colorTeam, null)["backgroundColor"];
    document.getElementById("IDTeamModalModify").value = document.getElementById("IDTeam"+num).value;
}

function loadDataTeamForDelete(num){
    var nameTeam = document.getElementById("nameTeam"+num).textContent.trim();
    document.getElementById("nameTeamToDelete").textContent = nameTeam;
    document.getElementById("IDTeamModalDelete").value = document.getElementById("IDTeam"+num).value;
}

function insertTeam(){
    var nameTeam = document.getElementById("txtNameTeamModal").value;
    var colorTeam = getComputedStyle(colorCircle, null)["backgroundColor"];

    $.post('Controller/teams/insertTeamController.php', { NewTeam: nameTeam, ColorTeam: colorTeam }, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive = "correct" ){
            document.getElementById("correctIns").style.display = "block";
            document.getElementById("incorrectIns").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correctIns").style.display = "none";
            document.getElementById("incorrectIns").style.display = "block";
        }
    });
}

function updateTeam(){
    var ID_Team = document.getElementById("IDTeamModalModify").value;
    var newName = document.getElementById("newNameTeam").value;
    var color = window.getComputedStyle(newColorTeam, null)["backgroundColor"];
    var newColorU = color.toString();

    $.post('Controller/teams/updateTeamController.php', {IDTeam: ID_Team, NewTeam: newName, NewColor: newColorU}, function(data) {
        dataReceive = JSON.parse(data);
        alert(dataReceive);

        if( dataReceive = "correct" ){
            document.getElementById("correctUP").style.display = "block";
            document.getElementById("incorrectUP").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correctUP").style.display = "none";
            document.getElementById("incorrectUP").style.display = "block";
        }
    });
}

function deleteTeam(){
    var ID_Team = document.getElementById("IDTeamModalDelete").value;

    $.post('Controller/teams/deleteTeamController.php', {IDTeam: ID_Team}, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive = "correct" ){
            document.getElementById("correctDel").style.display = "block";
            document.getElementById("incorrectDel").style.display = "none";
            setTimeout(window.location.reload(), 3000);
        }else{
            document.getElementById("correctDel").style.display = "none";
            document.getElementById("incorrectDel").style.display = "block";
        }
    });
}
