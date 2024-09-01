<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>

<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Soporte</title>
  <link rel="shortcut icon" href="Assets/favicon.png">
  <!--<link rel="stylesheet" href="./style2.css">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link rel="stylesheet" type="text/css" href="css/Account.css">
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <!-- Font Awesome -->

        <!--BOXICONS-->
        <link rel="stylesheet" type="text/css" href="css/icons.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" type="text/css" href="css/animate.min.css">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script> 
    <!-- Incluir Bootstrap CSS -->
     <!-- Incluir Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
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
function dibujarEstrellas(n) {
    var estrellas = '';
    for (var i = 0; i < n; i++) {
        estrellas += '⭐';
    }
    return estrellas;
}
  
  function inicio(){
  	myVar = setInterval(myTimer, 2000);
  }

  function readTicket(){
    let id = document.getElementById('ticked').value;
    let envia = document.getElementById('envia').value;
    $.get("serverChat.php?tiketPedido=&idpedido="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        let msj = "Monto: ";
                        let monto = datos.monto;
                        if(datos.tipo == "RETIRO"){
                          monto = datos.recibe;
                          msj = "Recibes menos Comisiones: ";
                        }
                        $("#usuario").html(`${datos.cajero} ${dibujarEstrellas(datos.estrellas)}`);
                        document.getElementById('recibe').value=datos.idCajero;
                        $("#fecha").html(datos.fecha);
                        $("#metodoPago").html(datos.medio_pago);
                        $("#msj").html(msj);
                        $("#totalPagar").html(monto+"<span style='font-size:10px;'>"+datos.moneda+"<span>");
                        $("#estado").html(datos.estatus);                        
                        //$("#wallet").html(datos.origen);
                        $("#detalle").html(`${datos.tipo} #${datos.ticket}`);
                    });

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
    $.post("block",
  	  {
        setEstatus: document.getElementById("cambioEstado").value,      
  	    idapuesta: document.getElementById('ticked').value
  	  },
  	  function(data){
  		  $("#estado").html(data);  		  
  	  });    
  }

    
function seltickect(){
  document.getElementById('ticked').value = document.getElementById('selectTicket').value;
  readTicket();
  inicio();
  $("#input-chat").css("display","flex");
}

  </script>
<body >

<?php $page = "chat"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

  <?php  
  $notificaciones = "0";
  $ticket = "0";
  if(isset($_GET['notif'])) $notificaciones= $_GET['notif'];
  if(isset($_GET['ticket'])){
    $idCliente= readClienteId($_SESSION['user'])['ID'];
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
<div id="cuerpo" class="cuerpo" style='margin-top: 8rem; padding:5rem; min-height: calc(100vh - 24rem);'>
<div class="progress-container">
    <div class="progress-label" id="label1"></div>
    <div class="progress-label" id="label2"></div>
    <div class="progress-label" id="label3"></div>
    <div class="progress-bar" id="my-progress"></div>
</div>

<div class='chatOuterContainer'> 
<section class='dataSec'>
<div class='data'>
  <h3 >SOPORTE CRYPTOSIGNAL</h3>
    <div>
      Seleccione un Ticket Abierto: 
      <select id="selectTicket" onchange="seltickect()" style="color:black;">
      <option value="">seleccione</option>
      <?php 
        $correo= readClienteId($_SESSION['user'])['CORREO'];
        $resultado = sqlconector("SELECT * FROM TRANSACCIONES WHERE PAGADO=0 AND CLIENTE='$correo'");
        while($row = mysqli_fetch_array($resultado)){
          $ticket = $row['TICKET'];
          $monto = price($row['MONTO']);
          $moneda = $row['MONEDA'];
          echo "<option value='{$ticket}'>".$row['DESCRIPCION']." por {$monto}{$moneda}</option>";
        }        
      ?>
      </select>     
      <br>
      Fecha: <span id=fecha></span><br>
    </div>

</div>

<div>
  <div id="wallet">Calificaciones</div>
  <b><span id="detalle"></span></b><br>
  <span id="msj"></span> <b><span class='pay' id=totalPagar></span></b> <span style='font-size:1rem;'></span><br>
  Metodo de Pago: <b><span id=metodoPago></span></b><br>

</div>

<div class='estadoContainer'>
    <p>

      Estatus en : <span id=estado></span>
      <?php 
        if($_SESSION['nivel']==1){
          ?>
        <select id="cambioEstado" name="estado" onchange="cambiarEstado()">
            <option id="">selecciona...</option>
            <option id="REVISION" value="REVISION">En Revision</option>
            <option id="ESPERA" value="ESPERA">En Proceso</option>
            <option id="EXITOSO" value="EXITOSO">Exitoso</option>
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
        <h3 ><?php if($_SESSION['nivel']==1) echo "Cliente: "; else echo "Cajero: ";?> <span id=usuario></span></h3>
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
        <!--Iniciar footer-->
              <?php include 'footer.php';?>
        <!--FIN footer-->    
<script>
$("#input-chat").css("display","none");
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
</body>
</html>
