
function loadData(){
//  Cargando los elementos de Materialize que utilizan javascript
    $(document).ready(function(){
        $('.dropdown-trigger').dropdown();
        $('.modal').modal();
    });

//  CARGANDO AL INICIAR LA PAGINA LA ULTIMA JORNADA JUGADA
    $.post('Controller/loadData.php', { }, function(data) {
        dataReceive = JSON.parse(data);
        selectJornada(dataReceive[0].Num_Jornada);
    });
}

function selectJornada(numJornada){
    var gamesCards = document.getElementById("gamesResultCard");
    var jornada = document.getElementById("jornada").innerHTML = "Resultados de la jornada "+numJornada;

    $.post('Controller/getGamesByJornadas.php', { NumJornada: numJornada }, function(data) {
        dataReceive = JSON.parse(data);

        for( i=0; i<dataReceive.length; i++ ){
            document.getElementById("idGame_"+i).innerHTML = dataReceive[i].ID_Partido;
            document.getElementById("idGame_"+i).style.display = "none";
            document.getElementById("jornada_"+i).innerHTML = numJornada;
            document.getElementById("jornada_"+i).style.display = "none";

            document.getElementById("E1_"+i+"_left").innerHTML = dataReceive[i].Equipo_1;
            document.getElementById("goles_"+i).innerHTML = dataReceive[i].Goles_E1 +" - "+ dataReceive[i].Goles_E2;
            document.getElementById("E2_"+i+"_right").innerHTML = dataReceive[i].Equipo_2;
            document.getElementById("dateGame"+i).innerHTML =  dataReceive[i].Dia+", "+dataReceive[i].Hora +" "+ specificTime(dataReceive[i].Hora);
        }
    });
}

function specificTime(time){
    var t = time.split(":");
    var hour = t[0];
    var minutes = t[1];

    if( hour >= 8 && hour <= 11  )
        return "am";
    else
        return "pm";
}

function loadDataToModify(num){
    var equipo1 = document.getElementById("E1_"+num+"_left");
    var equipo2 = document.getElementById("E2_"+num+"_right");
    var goles = document.getElementById("goles_"+num);
    var goals = goles.textContent.split(" ");
    var idGame = document.getElementById("idGame_"+num);
    var numJornada  = document.getElementById("jornada_"+num);
    var dateGame = document.getElementById("dateGame"+num).textContent;
    var Date = dateGame.split(",")[0];
    var Hour = dateGame.split(",")[1].split(" ")[1];

    document.getElementById("e1").textContent = equipo1.textContent;
    document.getElementById("e2").textContent = equipo2.textContent;

    var txtG1 = document.getElementById("e1Goals");
    var txtG2 = document.getElementById("e2Goals");
    txtG1.value = goals[0];
    txtG2.value = goals[2];
    txtG1.style.borderBottomWidth = "1px";
    txtG1.style.borderBottomColor = "gray";
    txtG2.style.borderBottomWidth = "1px";
    txtG2.style.borderBottomColor = "gray";

    document.getElementById("idGameModal").textContent = idGame.textContent;
    document.getElementById("idGameModal").style.display = "none";
    document.getElementById("idJornadaModal").textContent = numJornada.textContent;
    document.getElementById("idJornadaModal").style.display = "none";
    document.getElementById("setDateModal").value = Date;
    document.getElementById("setHourModal").value = Hour;
}

function ModifyResultGames(){
//    var e1 = document.getElementById("e1").value;
//    var e2 = document.getElementById("e2").value;
    var goals1 = document.getElementById("e1Goals");
    var goals2 = document.getElementById("e2Goals");
    var idGame = document.getElementById("idGameModal").textContent;
    var numJornada = document.getElementById("idJornadaModal").textContent;
    var DateG = document.getElementById("setDateModal").value;
    var HourG = document.getElementById("setHourModal").value;

    if( !isNaN(goals1.value) && !isNaN(goals2.value)){
        $.post('Controller/index/updateResultGames.php', { e1Goals: goals1.value, e2Goals: goals2.value, Date: DateG, Hour: HourG, ID_Game: idGame }, function(data) {
            dataReceived = JSON.parse(data);
    
            if( dataReceive = "Correct" ){
                //  AGREGAR COMPONENTE DE MATERIALIZE PARA INDICAR LA ACTUALIZACION CORRECTA
                $('.modal').modal('close');
                selectJornada(numJornada);
                var status = updateGeneralTable();

                if( startus = "Correct" )
                    M.toast({html: '¡Datos actualizados correctamente!', classes: 'rounded green darken-2'});
                else
                    M.toast({html: '¡Error! No se pudo actualizar la tabla general', classes: 'rounded deep-orange darken-4'});
            }else{
                M.toast({html: '¡Error! No se pudo actualizar el marcador', classes: 'rounded deep-orange darken-4'});
            }
        });

        goals1.style.borderBottomWidth = "1px";
        goals1.style.borderBottomColor = "gray";
        goals2.style.borderBottomWidth = "1px";
        goals2.style.borderBottomColor = "gray";
    }else{
        if( isNaN(goals1.value) ){
            goals1.style.borderBottomWidth = "2px";
            goals1.style.borderBottomColor = "red";
            M.toast({html: '¡Error! Solo debe teclear números en los campos indicados.', classes: 'rounded deep-orange darken-4'});
        }else{
            goals1.style.borderBottomWidth = "1px";
            goals1.style.borderBottomColor = "gray";
        }

        if( isNaN(goals2.value)){
            goals2.style.borderBottomWidth = "2px";
            goals2.style.borderBottomColor = "red";
            M.toast({html: '¡Error! Solo debe teclear números en los campos indicados.', classes: 'rounded deep-orange darken-4'});
        }else{
            goals2.style.borderBottomWidth = "1px";
            goals2.style.borderBottomColor = "gray";
        }
    }
}

function updateGeneralTable(){
    $.post('Controller/index/updateGeneralTable.php', {}, function(data) {
        dataReceive = JSON.parse(data);

        if( dataReceive == 'Correct' )
            return 'Correct';
        else
            return 'Failed!';
    });
}

function clearBoxes(){
//    loadData();
    var usr = document.getElementById("txtUser").value = "";
    var pwd = document.getElementById("txtPassword").value = "";
}

function verifyDataUser(){
    var usr = document.getElementById("txtUser").value;
    var pwd = document.getElementById("txtPassword").value;
    var danger = document.getElementById("alertDanger");
    var success = document.getElementById("alertSuccess");

    $.post('Controller/logInController.php', { user: usr, password: pwd }, function(data) {
        dataReceive = JSON.parse(data);
//        alert(dataReceive);
//        document.getElementById("").innerHTML = dataReceive;
        if( dataReceive === "null" ){
            danger.style.display = "block";
            success.style.display = "none";
        }else if( dataReceive === "Administrador" ){
            danger.style.display = "none";
            success.style.display = "block";

            location.href ="adminView.php";
        }
    });
}






function closeSession(){
    $.post('Controller/logOutController.php', {datos: "datos"}, function(data){
        
    });

}

// PROTOTIPO DE UNA PETICION AJAX
function getData(){
    $.ajax({
        // la URL para la petición
        url : '/logInController',
        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data : { user : $("#txtUser"), password : $("#txtPassword") },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'json',

        // código a ejecutar si la petición es satisfactoria;
        // la respuesta es pasada como argumento a la función
        success : function(dataOutput) {
            alert("Response -> "+ dataOutput);
        },

        // código a ejecutar si la petición falla;
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },

        // código a ejecutar sin importar si la petición falló o no
        complete : function(xhr, status) {
            alert('Petición realizada');
        }
    });
}

