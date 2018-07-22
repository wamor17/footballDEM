
function loadDataToModal(num){
    var equipo1 = document.getElementById("E1_"+num+"_left");
    var equipo2 = document.getElementById("E2_"+num+"_right");
    var goles = document.getElementById("goles_"+num);
    var goals = goles.textContent.split(" ");

    document.getElementById("e1").textContent = equipo1.textContent;
    document.getElementById("e2").textContent = equipo2.textContent;
    document.getElementById("e1Goals").value = goals[0];
    document.getElementById("e2Goals").value = goals[2];
}

