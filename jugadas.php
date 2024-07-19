<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">         
    </head>
    <header>
        <style>
         
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
    <?php $page = "jugadas"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->             

        <dialog class="dialog_agregar" id="miWallet" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('miWallet').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>        
        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
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
      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->           
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>