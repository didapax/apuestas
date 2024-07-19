<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>
<html style="overflow: scroll;">
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
        <style>
  
        </style>        
        <script>

/*function myFunction() {
                var copyText = document.getElementById("cajero");
                copyText.select();
                copyText.setSelectionRange(0, 99999); 
                navigator.clipboard.writeText(copyText.value);
            }*/

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
            }  

            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,
                    wallet: document.getElementById("wallet").value,
                    payeer: document.getElementById("payeer").value
                },function(data){
                    leerDatos();
                    document.getElementById('agregar').close();
                });
            }

            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario: "", 
                        sesion: true,
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("payeer").value = datos.payeer;
                        document.getElementById("wallet").value = datos.wallet;
                        document.getElementById("wallet_payeer").value = datos.payeer;
                        document.getElementById("wallet_usdt").value = datos.wallet; 
                        document.getElementById("actualsaldo").value = datos.saldo; 
                        document.getElementById("cantidad").max = datos.saldo;
                        $("#saldo").html("Saldo "+datos.saldo+" USDT");                      
                        if(datos.wallet != null && datos.wallet.length > 0){
                            document.getElementById("wallet").readOnly = true;
                        }
                        if(datos.payeer != null && datos.payeer.length > 0){
                            document.getElementById("payeer").readOnly = true;
                        }
                    });
                }
            }

            function leerJuegos(){
                $.get("block?getJugadas=", function(data){
                $("#vista").html(data);
                });
            }

            function bloque(){
                alert("Juego Cerrado");
            }

            function initsession(){
                window.location.href="sesion";
            }

            function trade(id){                
                if((document.getElementById("actualsaldo").value *1) > 0 ){
                    
                    $.get("block?datosJuego&idjuego="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#calculo").html("");
                        $("#apuesta").html("");                        
                        /*$("#info").html("");*/
                        /*$("#detalles").css("display","none");*/
                        $("#equipos").html("<option id='equipos_back'></option><option value='"+datos.equipo1+"'>"+datos.equipo1+"</option><option value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option>Empate</option>");
                        if(datos.desafio == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox4)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }
                        if(datos.desafiox1_5 == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox1_5)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }
                        if(datos.desafiox3 == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox3)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }                                        
                        document.getElementById("desafiox1_5").value = datos.desafiox1_5;
                        document.getElementById("desafiox3").value = datos.desafiox3;
                        document.getElementById("desafiox4").value = datos.desafio;
                        document.getElementById("idjugada").value = datos.id;
                        document.getElementById("cantidad").value=0;
                        /*document.getElementById("cantidad").max = datos.max;*/
                        document.getElementById("referencia").value = datos.referencia; 
                        /*document.getElementById("emailCajero").value = datos.cajero;*/
                        document.getElementById("eljuego").value =  datos.id;
                        $("#equipos").css("display","inline-block");
                        /*document.getElementById("este").selected = true;*/
                        document.getElementById("jugar").disabled = false;
                        /*document.getElementById("nota").value="";*/
                        /*document.getElementById("comopago_back").selected = true;*/
                        document.getElementById("equipos_back").selected = true;
                        document.getElementById('jugada').show();
                    });
                }else{
                    alert("Saldo No Disponible");
                }

            }

            function setTipo(){
                if($("#equipos").val() == "Empate"){
                    document.getElementById('tipo').value = "Empate";
                }
                else{
                    document.getElementById('tipo').value = "Ganador";
                }                
            }

           /* function selpago(){
                if($("#comopago").val() == "USDT"){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("emailCajero").value
                    },function(data){
                        var datos= JSON.parse(data);                        
                        document.getElementById("cantidad").min = 10;
                        document.getElementById("cantidad").value = 0;
                        document.getElementById("cajero").value = datos.wallet;
                        $("#info").html("USDT + Comision a la Wallet USDT TRC20:");
                        $("#detalles").css("display","inline-block")
                    });
                }

                if($("#comopago").val() == "PAYEER"){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("emailCajero").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("cantidad").min = 5;
                        document.getElementById("cantidad").value = 0;
                        document.getElementById("cajero").value = datos.payeer;
                        $("#info").html("USDT + Comision a la Cuenta de Payeer:");
                        $("#detalles").css("display","inline-block");
                    });
                }                
            }*/

            function jugar_back(){
                if((document.getElementById("cantidad").value *1) > 0 && (document.getElementById("cantidad").value *1) <= (document.getElementById("actualsaldo").value *1)){
                    lanzar();
                }
                else{
                    alert("Sin Apuesta Minima o Saldo no disponible..!");
                }          
            }

            function lanzar(){
                if(document.getElementById("equipos").value.length>0){
                    document.getElementById("jugar").disabled = true;
                $.post("block",{
                        jugar:"",
                        cantidad: document.getElementById("cantidad").value,
                        equipos: document.getElementById("equipos").value,
                        tipo: document.getElementById("tipo").value,
                        wallet_usdt: document.getElementById("wallet_usdt").value,
                        wallet_payeer: document.getElementById("wallet_payeer").value,
                        eljuego: document.getElementById("eljuego").value,
                        correo: document.getElementById("correo").value,
                        referencia: document.getElementById("referencia").value
                    },function(data){
                        document.getElementById('jugada').close();
                        leerDatos();
                        if(data.length>0){
                            alert(data);
                        }
                    });  
                }else{
                    alert("No hay Jugada a Realizar...");
                }         
            }

            function calculo(){
                var ganancia=0;
                ganancia = document.getElementById("cantidad").value *2;
                if($("#desafiox1_5").val() == 1){
                    ganancia = document.getElementById("cantidad").value *1.5;
                }
                if($("#desafiox3").val() == 1){
                    ganancia = document.getElementById("cantidad").value *3;
                }                
                if($("#desafiox4").val() == 1){
                    ganancia = document.getElementById("cantidad").value *4;
                }                
                $("#calculo").html("Usted Gana: "+ ganancia + "USDT");                
                $("#apuesta").html(document.getElementById("cantidad").value);
            }
             
            function inicio(){                
                leerJuegos();
                leerDatos();
                myVar = setInterval(leerJuegos, 3000);
            }
        </script>
    <?php
            if(isset($_SESSION['user'])){
                echo "<body onload='inicio()'>";
            }else{
                echo "<body>"; 
            }

    ?>        
      <?php $page = "home"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->        

        <?php
           if(!isset($_SESSION['user'])){
            echo "<div id=\"cuerpo\" class=\"cuerpo\">
            <div id=\"vista\" class=\"grid-container app-grid\"></div>
        </div>";
            promoFlotante();
        }else{
            promoFlotante();
        
        ?>        
        <dialog class="dialog_agregar" id="agregar" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>
        <dialog class="dialog_agregar" id="jugada" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('jugada').close()">X</a><br>
            <form method="post" action="index">
                <input hidden type="number" id="actualsaldo">
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" name="idjugada" id="idjugada" >
                <input type="hidden" name="cliente" id="cliente">
                <input type="hidden" name="eljuego" id="eljuego">
                <input type="hidden" name="referencia" id="referencia">
                <!--<input type="hidden" name="emailCajero" id="emailCajero">-->
                <input type="hidden" name="wallet_usdt" id="wallet_usdt">
                <input type="hidden" name="wallet_payeer" id="wallet_payeer">
                <input type="hidden" name="desafiox1_5" id="desafiox1_5">
                <input type="hidden" name="desafiox3" id="desafiox3">
                <input type="hidden" name="desafiox4" id="desafiox4">
                Selecciona tu Equipo o Jugada: <select onchange="setTipo()" required name="equipos" id="equipos"></select><br>
                <input hidden type="text" id="tipo" name="tipo"><br>
                <!--Como Vas a Pagar: <select required onchange="selpago()" name="comopago" id="comopago"><option id="comopago_back" value=""></option><option value="USDT">USDT Tron Trc20</option><option value="PAYEER">Payeer</option></select>-->
                <div id="detalles" >
                    Cantidad a Jugar: <input required type="number" name="cantidad" id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" min="1" max="50" step="1"><br>
                    <div id="calculo" style="color:green;float:right; background:white;padding:3px; border-radius:3px;"></div><br>
                    <!--Envia <span id="apuesta"></span><span id="info"></span>
                    <input readonly class="datcajero" style="" id="cajero">
                    <button title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button>
                    <br>
                    Coloca la Nota Id (txid) de la transferencia realizada:<br>
                    <input required type="text" id="nota" name="nota">-->
                </div><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;" type="button" id="jugar" name="jugar">Jugar</button>
            </form>
        </dialog>        
        <div id="cuerpo" class="cuerpo">
            <div id="vista" class="grid-container app-grid"></div>
        </div>
        <?php
        }
        ?>      

      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     

    <script>

function myFunctionMenu() {    
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
    </body>
</html>
