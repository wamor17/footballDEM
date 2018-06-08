
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
}

function loadDataTeamForDelete(num){
    var nameTeam = document.getElementById("nameTeam"+num).textContent.trim();
    document.getElementById("nameTeamToDelete").textContent = nameTeam;
}

function loadMoreDataStudentInfo(num){
    // NOMBRE DEL ALUMNO
    var name = document.getElementById("studentName"+num).textContent;
    var lastName = document.getElementById("studentLastName"+num).textContent;
    var completeName = name +" "+ lastName;
    document.getElementById("nameStudentInfo").textContent = completeName;

    // EQUIPO
    document.getElementById("teamInfo").value = document.getElementById("playerTeam"+num).value;
    
    // POSICION
    document.getElementById("positionInfo").value = document.getElementById("playerPosition"+num).value;
    
    // GOLES
    document.getElementById("goalsInfo").value = document.getElementById("playerGoals"+num).value;
}

function loadMoreDataStudentModify(num){
    // NOMBRE
    document.getElementById("txtNameM").value = document.getElementById("studentName"+num).textContent;
    // APELLIDOS
    document.getElementById("txtLastNameM").value = document.getElementById("studentLastName"+num).textContent;
    // EDAD
    document.getElementById("txtAgeM").value = document.getElementById("studentOld"+num).textContent;
    // NUA
    document.getElementById("txtNUAM").value = document.getElementById("studentNUA"+num).textContent;
    // CARRERA
    document.getElementById("txtCarrierM").value = document.getElementById("studentCarrier"+num).textContent;
    // POSICION
    document.getElementById("txtPlayerPositionM").value = document.getElementById("playerPosition"+num).value;
    // EQUIPO
    document.getElementById("txtTeamM").value = document.getElementById("playerTeam"+num).value;
    // GOLES ANOTADOS
    document.getElementById("txtGoalsM").value = document.getElementById("playerGoals"+num).value;
}

function loadNameStudentToDelete(num){
    document.getElementById("nameStudentToDelete").textContent = document.getElementById("studentName"+num).textContent + " " + document.getElementById("studentLastName"+num).textContent;
}




