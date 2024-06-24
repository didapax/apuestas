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
                let orderDesafio = 0;
                let orderDesafiox1_5 = 0;
                let orderDesafiox3 = 0;
                let orderFavorito = 0;
                if(document.getElementById('desafio').checked === true){
                    orderDesafio = 1;
                }
                if(document.getElementById('desafiox1_5').checked === true){
                    orderDesafiox1_5 = 1;
                }
                if(document.getElementById('desafiox3').checked === true){
                    orderDesafiox3 = 1;
                }
                if(document.getElementById('favorito').checked === true){
                    orderFavorito = 1;
                }

                document.getElementById("btncrear").disabled = true;
                $.post("block",{
                    crear: "",
                    cajero: document.getElementById("correo").value,
                    nombre: document.getElementById("nombre").value,
                    equipo1:document.getElementById("equipo1").value,
                    equipo2: document.getElementById("equipo2").value,
                    descripcion: document.getElementById("descripcion").value,
                    wallet: document.getElementById("wallet").value,
                    min: document.getElementById("min").value,
                    max: document.getElementById("max").value,
                    rate: document.getElementById("rate").value,
                    desafio: orderDesafio,
                    desafiox1_5: orderDesafiox1_5,
                    desafiox3: orderDesafiox3,
                    favorito: orderFavorito
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('agregar').close();
                });
            }

            function borrar(id){
                var r = confirm("Estas Seguro de Eliminar el Juego.?");
                if (r == true) {
                    $.post("block",{
                        borrar: id
                    },function(data){
                        leerVista();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }

            function cerrar(id){
                    $.post("block",{
                        cerrar: id
                    },function(data){
                        leerVista();
                    });
            }            

            function leerVista(){
                $.get("block?readJuegos=", function(data){
                $("#vista").html(data);
                });
            }

            function inicio(){
                leerDatos();
                leerVista();
            }

            function showDialog(){
                document.getElementById('agregar').show();
            }    
            
            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,
                    wallet: document.getElementById("wallet").value,
                    payeer: document.getElementById("payeer").value
                },function(data){
                    leerDatos();
                    document.getElementById('miWallet').close();
                });
            }

            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("payeer").value = datos.payeer;
                        document.getElementById("wallet").value = datos.wallet;
                        /*document.getElementById("cliente").value = datos.wallet;*/
                        if(datos.wallet.length>0){
                            /*document.getElementById("guardar").disabled = true;*/
                            /*document.getElementById("wallet").readOnly = true;*/
                        }
                        if(datos.payeer.length>0){
                            /*document.getElementById("guardar").disabled = true;*/
                            /*document.getElementById("payeer").readOnly = true;*/
                        }
                    });
                }
            }                        
        </script>
    </header>
    <body onload="inicio()">
        <div id="cabeza" class="cabeza">
            <a href='index'>Home</a>
            <a onclick="document.getElementById('miWallet').show()">Mi Wallet</a>
            <a href='historialadmin'>Historial</a>  
            <a href='trabajos'>Trabajos</a>
            <a href='jugadas'>Jugadas</a>
            <a href='promo'>Promociones</a>
            <a href='block?cerrarSesion'>Cerrar Sesion</a>
        </div>
        <dialog class="dialog_agregar" id="miWallet" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('miWallet').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>        
        <div id="cuerpo" class="cuerpo">
        <div class="menu" id="menu">
            <button type="button" onclick="showDialog()">Agregar +</button>
        </div>
        <dialog class="dialog_agregar" id="agregar" close>
            <form action="jugadas">
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                Nombre Juego: <input type="text" id="nombre"><br>
                Configuracion Equipo 1<br>
                Solo Juego: <input title="Ninguno de los otros" type="radio" id="ninguno" name="selectx">
                Favorito: <input title="Favorito" type="radio" id="favorito" name="selectx">
                x1.5: <input title="Desafio" type="radio" id="desafiox1_5" name="selectx">
                x3: <input title="Desafio" type="radio" id="desafiox3" name="selectx"> 
                x4: <input title="Desafio" type="radio" id="desafio" name="selectx"> 
                <br>
                Equipo 1: <input type="text" id="equipo1"><br>
                Equipo 2: <input type="text" id="equipo2"><br>
                Descripcion: <input type="text" id="descripcion"><br>
                <!--Wallet Trc20:--> <input type="hidden" id="wallet"><br>
                Limite de Jugadores: <input type="number" id="min" value="10"><br>
                Maximo por Apuesta: <input type="number" id="max" value="10"><br>            
                Estrellas: <input type="number" id="rate" min="0" max="5" value="0"><br>
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