
function hello(data1, data2){
    alert("Dato 1 -> "+data1, "Data 2 -> "+data2);
}

function clearBoxes(){
//    loadData();
    var usr = document.getElementById("txtUser").value = "";
    var pwd = document.getElementById("txtPassword").value = "";
}

function closeSession(){
    $.post('Controller/logOutController.php', {datos: "datos"}, function(data){
        
    });

}

function hideAlerts(){
    var danger = document.getElementById("alertDanger");
    var success = document.getElementById("alertSuccess");

    danger.style.display = "none";
    success.style.display = "none";
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

function selectJornada(numJornada){
    var gamesCards = document.getElementById("gamesResultCard");
    var jornada = document.getElementById("jornada").innerHTML = "Resultados de la jornada "+numJornada;

    $.post('Controller/getGamesByJornadas.php', { NumJornada: numJornada }, function(data) {
        dataReceive = JSON.parse(data);

        for( i=0; i<dataReceive.length; i++ ){
            var team1 = document.getElementById("E1_"+i+"_left").innerHTML = dataReceive[i].Equipo_1;
            var goals = document.getElementById("goles_"+i).innerHTML = dataReceive[i].Goles_E1 +" - "+ dataReceive[i].Goles_E2;
            var team1 = document.getElementById("E2_"+i+"_right").innerHTML = dataReceive[i].Equipo_2;
            var hourGame = document.getElementById("hourGame"+i).innerHTML = "Hora: "+dataReceive[i].Hora;
        }
                
//        alert("1. "+dataReceive[0].Equipo_1+"\n"+"2. "+dataReceive[1].Equipo_1);
    });
}

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

function openModal(){
    var instance = M.Modal.getInstance( document.getElementById("modal1") );
    alert(instance)
    instance.open();
//    $('#modal1').modal('open');
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

