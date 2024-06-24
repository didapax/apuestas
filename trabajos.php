<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <header>
        <style>
            html, body {
                margin: 0;
                background: #f0f0f5;
                width: 100%;
            }             
            /* width */
            ::-webkit-scrollbar {
            width: 5px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            background: #263238;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #263238;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #263238;
            }            
            .cabeza{
                width:100%;
                height: 55px;    
                text-align:right;    
                background: #111111;
                font-weight:bold;       
                
            }

            .cabeza a{
                color: white; 
            }
            .cuerpo{
                width:100%;
                height: 500px;
                background: transparent;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .menu{
                width:98%;
                height: 20px;
                background: gray;
                overflow-y: hidden;
                overflow-x: hidden;
                padding:8px;
            }

            .vista{
                width:100%;
                height: 440px;
                background: transparent;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .pie{
                width:100%;
                height: 13px;
                text-align:center;
            }
            button{
                padding: 5px;
                border: 0;
                border-radius: 3px;
            }
            a{
                padding:3px;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
            }

            a:hover{
                text-decoration:underline;
            }
            .dialog_agregar{
                width:350px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #c1cae0;
                border-radius: 5px;
                z-index: 1000;
            }

            input[type="text"]{
                padding: 5px;
                font-size: 13px;
                width: 60%;
                margin:5px;
            }    
            @media (max-width: 600px) {
                label{
                    display:none;
                }
                .cabeza{
                    font-size: 13px;
                }                
                input[type="text"]{
                    padding: 3px;
                    font-size: 11px;
                    width: 60%;
                    margin:3px;
                }          

                input[type="number"] {
                    padding: 3px;
                    font-size: 11px;
                    width: 60%;
                    margin:3px;
                }

                table{
                    width: 100%;
                    font-size: 11px;
                }

                a{
                    font-size:15px;
                }                

            }                       
        </style>        
        <script>
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("wallet");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);
                /* Alert the copied text
                alert("Copied the text: " + copyText.value);*/
            }

            function ver(id){
                $.get("block?datosApuesta&idapuesta="+id,
                function(data){
                    var datos= JSON.parse(data);
                    $("#evento").html(datos.nombre);
                    $("#emailCliente").html(datos.cliente);
                    $("#mediopago").html(datos.mediopago);
                    $("#wallet").val(datos.wallet);
                    $("#idapuesta").val(datos.id);
                    $("#monto").html((datos.monto *1).toFixed(2)+" USDT");
                    $("#notaid").html(datos.notaid);
                    $("#tipo").html(datos.tipo);
                    $("#equipo").html(datos.apuesta);
                    $("#recibe").html((datos.recibe *1).toFixed(2)+" USDT");
                    $("#estatus").html(datos.estatus);
                    $("#resultados").css("display","none");
                    document.getElementById("este").selected = true;
                    document.getElementById("resultados").value = "";

                    if(datos.tipo.includes("Deposito")){
                        document.getElementById("apostado").disabled = true;
                        document.getElementById("ganador").disabled = true;
                        document.getElementById("perdiste").disabled = true;
                        document.getElementById("pagado").disabled = false;  
                    }
                    else if(datos.tipo.includes("Retiro")){
                        document.getElementById("apostado").disabled = true;
                        document.getElementById("ganador").disabled = true;
                        document.getElementById("perdiste").disabled = true;
                        document.getElementById("pagado").disabled = false;  
                    }
                    else if(datos.tipo.includes("PREMIO")){
                        document.getElementById("apostado").disabled = true;
                        document.getElementById("perdiste").disabled = true;
                        document.getElementById("pagado").disabled = true;
                    }
                    else if(datos.tipo.includes("Empate")){
                        document.getElementById("pagado").disabled = true;
                    }
                    else if(datos.tipo.includes("Ganador")){
                        document.getElementById("pagado").disabled = true;
                    }
                    else{
                        document.getElementById("apostado").disabled = false;
                        document.getElementById("ganador").disabled = false;
                        document.getElementById("perdiste").disabled = false; 
                        document.getElementById("pagado").disabled = false;   
                    }
                    
                    document.getElementById('ver').show();
                });
            }

            function borrar(id){
                var r = confirm("Estas Seguro de Cancelar la Apuesta.?");
                if (r == true) {
                    $.post("block",{
                        cancelar: id
                    },function(data){
                        leerTrabajos();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }

            function tomar(id){
                    $.post("block",{
                        tomar: id,
                        correo: document.getElementById("correo").value
                    },function(data){
                        leerTrabajos();
                    });
            }        
            

            function enviar(){
                if(document.getElementById("resultados").value.length > 0){
                    $.post("block",{
                        enviar: document.getElementById("idapuesta").value,
                        resultado: document.getElementById("resultados").value
                    },function(data){
                        leerTrabajos();
                        document.getElementById('ver').close();
                    });
                }else{
                    document.getElementById('ver').close();
                }                
            }               

            function leerTrabajos(){
                $.get("block?estadisticas=",
                function(data){
                    var datos= JSON.parse(data);
                    $("#estad").html("Usuarios "+datos.totalReg);
                    $("#reg").html("Referidos "+datos.totalRef);
                });                

                $.get("block?readTrabajos=", function(data){
                $("#vista").html(data);
                });
            } 

            function inicio(){
                leerTrabajos();
                myVar = setInterval(leerTrabajos, 3000);
            }

            function showDialog(){
                document.getElementById('agregar').show();
            }
            
            function selestatus(){
                if(document.getElementById("selestatus").value=="GANADOR"){
                    $("#resultados").css("display","inline-block");
                }

                $.post("block",{
                        setEstatus: document.getElementById("selestatus").value,
                        idapuesta: document.getElementById("idapuesta").value
                    },function(data){
                        leerTrabajos();
                    });
            }
        </script>
    </header>
    <body onload="inicio()">
        <div id="cabeza" class="cabeza">
            <a href='index'>Home</a>
            <a href='historialadmin'>Historial</a>              
            <a href='trabajos'>Trabajos</a>
            <a href='jugadas'>Jugadas</a>
            <a href='promo'>Promociones</a>
            <a href='block?cerrarSesion'>Cerrar Sesion</a> 
        </div>
        <div id="cuerpo" class="cuerpo">
            <div class="menu" id="menu">
                <label style="margin-left:1px; font-weight:bold;" id="estad"></label>
                <label style="margin-left:13px; font-weight:bold;" id="reg"></label>
            </div>
            <dialog class="dialog_agregar" id="ver" close>
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('ver').close()">X</a><br>
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" id="idapuesta">
                Evento: <span id="evento"></span><br>
                Cliente: <span id="emailCliente"></span><br>
                Wallet <span id="mediopago"></span><br><input style="background:transparent; outline:0;border:0;width:300px;" type="text" readonly id="wallet">
                <button title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button><br>
                Monto: <span id="monto"></span><br>
                Nota ID: <span id="notaid"></span><br>
                Apuesta a: <span id="tipo"></span><br>
                Equipo: <span id="equipo"></span><br>
                Recibe: <span id="recibe"></span><br>
                Estatus:<span id="estatus"></span> 
                <select id="selestatus" onchange="selestatus()">
                    <option id="este"></option>
                    <option value="EN REVISION">En Revision</option>
                    <option value="EN PROCESO">En Proceso</option>
                    <option id="apostado" value="APOSTADO">Apostado</option>
                    <option id="ganador" value="GANADOR">Ganador</option>
                    <option id="pagado" value="PAGADO">Pagado</option>
                    <option id="perdiste" value="PERDISTE">Perdiste</option>
                </select><br>
                Resultados: <input type="text" id="resultados" >
                <button class='appbtn' style="float:right;" type="button" id="btnenviar" onclick="enviar()">Enviar</button>
            </dialog>        
            <div class="vista" id="vista"></div>
        </div>
        <div id="pie" class="pie"><span>Copyring (c) 2022 Red Triangle Corporation</span></div>
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>