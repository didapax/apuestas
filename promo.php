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
                input[type="number"] {
                    margin: 3px;
                    border-radius: 3px;
                    border: 0;
                    padding: 3px;
                    font-size: 11px;
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
            function crear(){
                document.getElementById("btncrear").disabled = true;
                let ganador = 0;
                let difusion = 0;
                let flotante = 0;

                if(document.getElementById('difuGanador').checked === true){
                    ganador = 1;
                }
                if(document.getElementById('difu').checked === true){
                    difusion = 1;
                }
                if(document.getElementById('difuFlotante').checked === true){
                    flotante = 1;
                }                                                

                $.post("block",{
                    crearPromo: "",
                    nombre: document.getElementById("nombre").value,
                    mensaje:document.getElementById("mensaje").value,
                    numpromo:document.getElementById("numpromo").value,
                    premio:document.getElementById("premio").value,
                    promoGanador: ganador,
                    promoDifu: difusion,
                    promoFlotante: flotante
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('agregar').close();
                });
            }

            function borrar(codigo){
                var r = confirm("Estas Seguro de Eliminar la Promocion.?");
                if (r == true) {
                    $.post("block",{
                        borrarPromo: codigo
                    },function(data){
                        leerVista();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }      

            function leerVista(){
                
                $.get("block?readPromos=", function(data){
                $("#vista").html(data);
                });

                $.get("block?estatuslista=", function(data){
                    var datos= JSON.parse(data);
                    if(datos.reset == true){
                        $("#btn_reset").css("display","inline-block");
                        $("#btn_difundir").css("display","none");
                    }else{
                        document.getElementById("btn_difundir").disabled = datos.status;
                    }
                    
                });                
            }

            function reset(){
                $.post("block",{
                    resetlista: ""
                    },function(data){
                        /*leerVista();*/
                        window.location.href="promo";
                    });                               
            }   
            
            function difundir(){
                $.post("block",{
                    sendlista: ""
                    },function(data){
                        leerVista();
                        alert("Correos Enviados");
                        /*window.location.href="promo";*/
                    });                               
            }              

            function inicio(){                
                leerVista();
            }

            function showDialog(){
                document.getElementById('agregar').show();
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
            <button type="button" onclick="showDialog()">Crear Promocion</button>
            <button style="margin-left:21px;" id="btn_difundir" type="button" onclick="difundir()">Difundir Promocion</button>
            <button style="margin-left:21px; background:#E9B2B2; display:none;" id="btn_reset" type="button" onclick="reset()">Reset Promocion</button>
        </div>
        <dialog class="dialog_agregar" id="agregar" close>
            <form action="promo">
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
                Nombre Promo: <input type="text" id="nombre"><br>
                Detalle:<br> <textarea id="mensaje"></textarea><br>
                Maximo de Triunfos: <input type="number" id="numpromo" value="5"><br>
                Premio en USDT: <input type="number" id="premio" value="0"><br>
                <label for="difuGanador">Ganador </label><input type="radio" id="difuGanador" name="idpromo"><br>
                <label for="difuFlotante">Flotante </label><input type="radio" id="difuFlotante" name="idpromo"><br>
                <label for="difu"> Difusion </label><input type="radio" id="difu" name="idpromo">&#128266;<br>
                <button class='appbtn' style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </form>
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