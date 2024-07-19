<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] >= 0){
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
            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);     
                        $("#saldo").html("Saldo "+datos.saldo+" USDT");                      
                        document.getElementById("payeer").value = datos.payeer;
                        document.getElementById("wallet").value = datos.wallet;
                        if(datos.wallet != null && datos.wallet.length > 0){
                            document.getElementById("wallet").readOnly = true;
                        }
                        if(datos.payeer != null && datos.payeer.length > 0){
                            document.getElementById("payeer").readOnly = true;
                            $("#botonVer").css("display","none");
                        }
                        else{                            
                            $("#myInput").css("display","none");
                            $("#copyButton").css("display","none");
                        }
                    });
                }
            }


            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,
                    wallet: document.getElementById("wallet").value,
                    payeer: document.getElementById("payeer").value
                },function(data){
                    /*leerDatos();
                    document.getElementById('agregar').close();*/
                    window.location.href="referidos";
                });
            }

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
            }   
               


            function inicio(){
              leerDatos();
    $.post("block",{
  				verChatApp: document.getElementById('ticked').value
  			},function(data) {
  				$("#chat").html(data);
  			});    
  	myVar = setInterval(myTimer, 2000);
  }

  function myTimer() {
  	try {
  		$.post("block",{
  				verChatApp: document.getElementById('ticked').value
  			},function(data) {
  				$("#chat").html(data);
  			});
  	}catch (err) {

  	}
  }

  function chat(){
    document.getElementById("btnEnviar").disabled = true;
    $.post("block", 
  	  {
  	    insertmychat: "Donald",
  	    tickedchat: document.getElementById('ticked').value,
  	    email: document.getElementById('envia').value,
  	    mensaje: document.getElementById('mensaje').value
  	  },
  	  function(data){
          document.getElementById("btnEnviar").disabled = false;
  		  document.getElementById("mensaje").value="";
  		  document.getElementById("mensaje").focus();
  	  });
  }

 /* function myFunction(event){
  	var x = event.key;
  	if (x == "Enter" || x == "Intro"){
  		chat();}
  }*/

  </script>
    </header>
    <body onload="inicio()">
        <?php $page = "chat"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->     

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <dialog class="dialog_agregar" id="agregar" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>      
        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;"> 
        <?php
  echo "
  <input type='hidden' id='ticked' value='0001'>
  <input type='hidden' id='envia' value='".readClienteId($_SESSION['user'])['CORREO']."'>
  ";
   ?>
<!-- partial:index.partial.html -->
<h3>CHAT FORTUNA ROYAL</h3>
     <p>
      JUEGA Y DIVIERTETE
    </p>
    <div style='color:black;border-top-left-radius: 5px; border-top-right-radius: 5px; background:#D4DEE2; width: 96%; height: 400px; overflow-x: hidden;overflow-y: scroll;' id='chat'></div>
    <div style='border-bottom-left-radius:5px; border-bottom-right-radius: 5px; background: transparent; width:96%; height: 70px;'>
      <input autocomplete='off' style='font-size:16px; border: 0; border-radius: 3px; outline:0; color: #333;display:inline-block; width: 60%;padding: 21px;' type='text' id='mensaje' >
      <button style='display:inline-block;cursor:pointer; font-weight: 600; border: 1px solid #333; border-radius: 5px; font-size: 16px;font-weight: bold; color:#fff;padding: 21px; background:#EA4040;' onclick="chat()" id="btnEnviar">Enviar</button>
    </div>
    <br><br>
        </div>

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

<?php
}
else{
    header("Location: index.php");
}
?>