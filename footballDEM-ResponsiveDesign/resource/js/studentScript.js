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
