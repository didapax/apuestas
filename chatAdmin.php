<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>

<!DOCTYPE html>
<html lang="es" >
<head> 
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">        
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />        
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <link rel="stylesheet" type="text/css" href="index-assets/css/datatables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="index-assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="index-assets/css/jquery.fancybox.css">
        <link rel="stylesheet" href="index-assets/css/flexslider.css">
        <link rel="stylesheet" href="index-assets/css/styles.css">
        <link rel="stylesheet" href="index-assets/css/queries.css">
        <link rel="stylesheet" href="index-assets/css/etline-font.css">
        <link rel="stylesheet" href="index-assets/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
<style>
.progress-container {
    width: 100%;
    background-color: #f1f1f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .progress-bar {
    width: 0;
    height: 30px;
    background-color: #4caf50;
    line-height: 30px;
    color: white;
  }

  .progress-label {
    flex: 1;
    text-align: center;
    font-weight: bold;
    color: white;
  }

  #label1 { background-color: #4caf50; }
  #label2 { background-color: #2196f3; }
  #label3 { background-color: #ff9800; }
  #label4 { background-color: #f44336; }

  /* width */
  ::-webkit-scrollbar {
    width: 5px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #1B183E;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #1B183E;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #1B183E;
  }

  .mi-div-con-scroll {
    overflow-x: hidden;
    overflow-y: scroll;
    scroll-behavior: smooth;
    color: black;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    background: linear-gradient(45deg, #f1f1f1, transparent);
    width: 100%;
    height: 25rem; 
}


.chatOuterContainer{
  display: inline-block;
  width:100%;
  flex-direction: row;
  justify-content: space-between;
}

.chatData{
  border: solid 1px #e1e1e1;
  box-shadow: 0px 2px 5px 0px #c3c3c3;
  padding: .7rem;
  font-size: 1.4rem;
}

.chatContainer{
  border: 1px solid #dddddd;
}

.chatBox{
  border: 1px solid #c9c9c9;
  box-shadow: -2px 6px 11px 4px #f3f3f3;
}

.inputChatContainer{
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  background: transparent;
  width: 100%;
  height: 70px;
  display: flex;
  align-items: center;
  padding-left: 0.3rem;
  padding-right: 0.3rem;
}

.inputChat{
    font-size: 16px;
    color: #414141;
    display: inline-block;
    border: none;
    padding: 21px;
    background: #efefef;
    padding: 0.2rem;
    border-radius: 2rem;
}

.sendButton{
  display: inline-block;
    cursor: pointer;
    font-weight: 600;
    border-radius: 5px;
    font-size: 26px;
    font-weight: bold;
    color: #fff;
    background: none;
    border: none;
    color: #ff7380;
    display: flex;
}

.sendButton:hover{
  color: #ff4f5f;
}

.chatSec{
  display: inline;
}

.data{
  /*display: flex;*/
  gap: 3rem;
  border-bottom: 1px solid #a7a7a7;
}

.dataSec{
  border-right: 1px solid #e7e7e7;
    border-bottom: 1px solid #dddddd;
    border-left: 1px solid #f1f1f1;
    padding: 1rem;
    background: linear-gradient(45deg, whitesmoke, transparent);
}

.pay{
  font-size:2rem;
  color:red;
}

.estadoContainer{
  border-top: 1px solid gray;
    margin-top: 1rem;
    padding-top: 1rem;
}
  </style>

<script>
  function inicio(){
    readTicket();
  	myVar = setInterval(myTimer, 2000);    
  }

  function readTicket(){
    let id = document.getElementById('ticked').value;
    let envia = document.getElementById('envia').value;
    $.get("serverChat.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#numTicket").html(datos.ticket);
                        $("#usuario").html(datos.cliente); 
                        document.getElementById('recibe').value=datos.idCliente;
                        $("#fecha").html(datos.fecha);
                        $("#metodoPago").html(datos.medio_pago);
                        $("#totalPagar").html(datos.monto+"<span style='font-size:10px;'>"+datos.moneda+"<span>");
                        $("#estado").html(datos.estatus);                        
                        $("#wallet").html(`Origen: ${datos.origen}<br>Destino: ${datos.destino}`);
                        $("#tipo").html(datos.tipo);
                        document.getElementById(datos.estatus).selected = true;
                    });
    
    /*$("#input-chat").css("display","flex");*/
    
    $.get("modulo.php?marcarNotif=&idpedido="+id+"&user="+envia,function(data){});      

  }

  function myTimer() {
  	try {
  			$.post("serverChat.php",{
  				verChatApp: document.getElementById('ticked').value,
          IDusuario: document.getElementById('envia').value
  			},function(data) {           
  				$("#chat").html(data);
          $('#chat').scrollTop($('#chat').prop('scrollHeight'));
  			});
  	}catch (err) {

  	}
  }

  function chat(){
  	  $.post("serverChat.php",
  	  {
  	    insertchat: "Donald",
  	    tickedchat: document.getElementById('ticked').value,
  	    envia: document.getElementById('envia').value,
        recibe: document.getElementById('recibe').value,
        pedido: document.getElementById('ticked').value,
  	    mensaje: document.getElementById('mensaje').value
  	  },
  	  function(data){
  		  document.getElementById("mensaje").value="";
  		  document.getElementById("mensaje").focus();
  	  });
  }

  function myFunction(event){
  	var x = event.key;
  	if (x == "Enter" || x == "Intro"){
  		chat();}
  }

  function cambiarEstado() { 
    Swal.fire({
                                        title: 'Promocion',
                                        text: `Estas seguro de cambiar es estatus de la orden?`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Cambiar Estatus',
                                        showCancelButton: true,
                                        cancelButtonText: "No Estoy Seguro"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                              $.post("block",
                                              {
                                                setEstatus: document.getElementById("cambioEstado").value,
                                                idapuesta: document.getElementById('ticked').value
                                              },
                                              function(data){
                                              });
                                            }
                                            else{
                                                document.getElementById('ver').close();
                                            }
                                        });

  }

    
function seltickect(){

}

  </script>
<body onload="inicio()" id="top">

<?php $page = "chat"; ?>
<section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
</section> 

  <?php

  $notificaciones = "0";
  $ticket = "0";
  if(isset($_GET['notif'])) $notificaciones= $_GET['notif'];

  if(isset($_GET['ticket'])){
    $idCliente= $_SESSION['user'];
    $ticket= $_GET['ticket'];
    $consulta = "UPDATE CHAT SET ACTIVO=1 WHERE IDPEDIDO='$ticket' AND AMO='$idCliente'";    
    sqlconector($consulta);    
    notif($_SESSION['user']);        
  } 

  echo "
  <input type='hidden' id='ticked' value='".$ticket."'>
  <input type='hidden' id='envia' value='".$_SESSION['user']."'>
  <input type='hidden' id='recibe' value=''>
  <input type='hidden' id='notif' value='{$notificaciones}'>";
   ?>
<!-- partial:index.partial.html -->
<section class="hero hero-inside" >
<div id="cuerpo" class="cuerpo">
<div class="progress-container">
    <div class="progress-label" id="label1"></div>
    <div class="progress-label" id="label2"></div>
    <div class="progress-label" id="label3"></div>
    <div class="progress-bar" id="my-progress"></div>
</div>

<div class='chatOuterContainer'> 
<section class='dataSec'>
<div class='data'>
  <h3 >SOPORTE CRIPTO SIGNAL GROUP</h3>
    <div>
      Ticket Abierto: 
      <span id="numTicket"></span>
      <br>
      Fecha: <span id=fecha></span><br>
    </div>

</div>

<div>
  Estas Procesando un  <b><span id="tipo"></span></b><br>
  Datos Wallet: <div id="wallet"></div>  
  Monto: <b><span class='pay' id=totalPagar></span></b> <span style='font-size:2rem;'></span><br>
  Metodo de Pago: <b><span id=metodoPago></span></b><br>

</div>

<div class='estadoContainer'>
    <p>

      Cambiar Estatus: 
      <?php 
        if($_SESSION['nivel']==1){
          ?>
        <select id="cambioEstado" name="cambioEstado" onchange="cambiarEstado()">
            <option id="">selecciona...</option>
            <option id="REVISION" value="REVISION">En Revision</option>
            <option id="ESPERA" value="ESPERA">En Espera</option>
            <option id="EXITOSO" value="EXITOSO">Exitoso</option>                    
            <option id="APOSTADO" value="APOSTADO">Apostado</option>
            <option id="GANADOR" value="GANADOR">Ganador</option>                    
            <option id="FALLIDO" value="FALLIDO">Fallido</option> 
        </select>
          <?php
        }
      ?>
      <br>
    </p>
</div>
</section>

    <section class='chatSec'>
      <div class='chatData'>
        <h3 ><?php if($_SESSION['nivel']==1) echo "Cliente: "; else echo "Usuario: ";?> <span id=usuario></span></h3>
      </div>

      <div class='chatBox'>

        <div class="mi-div-con-scroll" id='chat'></div>

        <div class='inputChatContainer' id="input-chat">
        <input class='inputChat' style='width: 100%;' autocomplete='off' id="mensaje"  onkeyup='myFunction(event)'>
        
        <button class='sendButton' onclick="chat()"><i class='bx--send'></i></button>
      </div>
   </section>


    <br><br>
</div>
<br><br>
<?php
if(isset($_SESSION['nivel']) && $_SESSION['nivel']==0){
?>

<?php
}
?>
</div>
</section> 
        <!--Iniciar footer-->
              <?php include 'footer.php';?>
        <!--FIN footer-->    
<script>
/*$("#input-chat").css("display","none");*/
const progressBar = document.getElementById("my-progress");

let progressValue = 0; // Cambia este valor según el progreso real

function updateProgressBar(label) {
  switch (label) {
    case "REVISION":
      document.getElementById("label1").innerText =  "";
      document.getElementById("label2").innerText =  "";
      document.getElementById("label1").innerText =  "EN REVISION";
      progressValue += 20;
    break;
    case "ESPERA":
      document.getElementById("label1").innerText =  "EN REVISION";
      document.getElementById("label2").innerText =  "EN ESPERA";
      progressValue += 40;
    break;
    case "EXITOSO":
      document.getElementById("label1").innerText =  "EN REVISION";
      document.getElementById("label2").innerText =  "EN ESPERA";
      document.getElementById("label3").innerText =  "EXITOSO";
      progressValue += 80;
    break;     
    case "FALLIDO":
      document.getElementById("label1").innerText =  "";
      document.getElementById("label2").innerText =  "";
      document.getElementById("label3").innerText =  "FALLIDO";
      progressValue += 100;
    break;       
  }
  //progressBar.style.width = `${progressValue}%`;
  
  //progressBar.innerText = labels[Math.floor(progressValue / 20)];
}

setInterval(() => {
  let id = document.getElementById('ticked').value;
    $.get("serverChat.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        updateProgressBar(datos.estatus);
                    });  
  
}, 3000);
</script>

<script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        this.parentElement.classList.toggle("active");

                        var pannel = this.nextElementSibling;

                        if (pannel.style.display === "block") {
                            pannel.style.display = "none";
                        } else {
                            pannel.style.display = "block";
                        }
                    });
                }
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
            <script type="text/javascript" charset="utf8"src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
            
            <script src="bower_components/retina.js/dist/retina.js"></script>
            <script src="index-assets/js/jquery.fancybox.pack.js"></script>
            <script src="index-assets/js/vendor/bootstrap.min.js"></script>
            <script src="index-assets/js/scripts.js"></script>
            <script src="index-assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
            <script src="index-assets/js/jquery.flexslider-min.js"></script>
            <script src="index-assets/bower_components/classie/classie.js"></script>
            <script src="index-assets/bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>
            <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>

            <script>
                    (function (b, o, i, l, e, r) {
                        b.GoogleAnalyticsObject = l; b[l] || (b[l] =
                            function () { (b[l].q = b[l].q || []).push(arguments) }); b[l].l = +new Date;
                        e = o.createElement(i); r = o.getElementsByTagName(i)[0];
                        e.src = '//www.google-analytics.com/analytics.js';
                        r.parentNode.insertBefore(e, r)
                    }(window, document, 'script', 'ga'));
                ga('create', 'UA-XXXXX-X', 'auto'); ga('send', 'pageview');
            </script>
            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        this.parentElement.classList.toggle("active");

                        var pannel = this.nextElementSibling;

                        if (pannel.style.display === "block") {
                            pannel.style.display = "none";
                        } else {
                            pannel.style.display = "block";
                        }
                    });
                }
            </script>  
</body>
</html>
