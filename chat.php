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
    background: url(./index-assets/img/charge.png);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-size: cover;
    border-radius: 3rem;
    margin-bottom: 2rem;
    margin-top: 1rem;
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

  #label1 { background-color: #4caf50; border-radius: 51px 0px 0px 51px; }
  #label2 { background-color: #2196f3; }
  #label3 { background-color: #ff9800; border-radius: 0 51px 51px 0px; }
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
    background:linear-gradient(45deg, #000000, #292c37c2);
    height: 25rem; 
}


.chatOuterContainer{
  width:100%;
  justify-content: space-between;
  background: #254b6a;
  display: flex;
  flex-direction: row;
}

.chatData{
  border: solid 1px black;
  box-shadow: 0px 2px 5px 0px black;
  padding: .7rem;
  font-size: 1.4rem;
}

.chatContainer{
  border: 1px solid #dddddd;
}

.chatBox{
  border: 1px solid black;
  box-shadow: 0px 1px 5px 1px black;
  height: 34.5rem;
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
    color: #ffffff;
    display: inline-block;
    border: none;
    padding: 21px;
    background: linear-gradient(45deg, #000000, #292c37c2);
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
  width: 50%;
}

.data{
  /*display: flex;*/
  gap: 3rem;
  border-bottom: 1px solid #a7a7a7;
}

.dataSec{
    width: 50%;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    padding: 1rem;
    background: linear-gradient(45deg, #000000, #292c37c2);
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
dialog {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border: none;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: white;
            }

            .dialog-content {
                text-align: center;
                background: url('Assets/ayudabinance.jpg') no-repeat center/cover;
                height: 200px;
                width: 400px;
            }  

            .contenido {
                background: antiquewhite;
                height: 250px;
                width: 300px;
            } 

            .contenido textarea{
                height: 150px;
                width: 300px;                
            }

            .contenido h3{
                text-align: center;
            }

            .tab-section{
              display: flex;
              justify-content: center;
              display:none;
            }

            @media screen and (max-width: 950px) {

              .dataSec {
                width: 100%;
              }

              .chatSec {
                width: 100%;
                display: none;
              }

              .tab-section{
              display:block;
              justify-content: center;
              display: flex;
            }

          }

  </style>

<script>

function closeTecnoDialog() {
            document.getElementById('tecno-dialog').style.display = 'none';
            document.getElementById("overlay-common-dialog-1").style.display = 'none';
        }
        
        
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
  /*$("#input-chat").css("display","flex");*/
}

function mostrarTecnoDialog() {
            const tecnoDialog = document.getElementById("tecno-dialog");
            tecnoDialog.showModal();
}

function enviarAsistencia(){
            const tecnoDialog = document.getElementById("tecno-dialog");
            const cliente = document.getElementById("correo").value;
            const asunto = document.getElementById("asuntoTecno").value;
            const mensaje = document.getElementById("mensajeTecno").value;
            if(asunto && mensaje){
                tecnoDialog.close();
                Swal.fire({
                    title: 'Cryptosignal',
                    text: `Se procedera a Abrir un Ticket de Soporte con su Caso ${asunto}`,
                    icon: 'warning',
                    confirmButtonColor: '#EC7063',
                    confirmButtonText: 'Si Gracias',
                    showCancelButton: true,
                    cancelButtonText: "No Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {    
                            $.post("servermail",{
                                sendmailtecno: "",
                                cliente: cliente,
                                asunto: asunto,
                                mensaje: mensaje
                            },function(data){
                                    Swal.fire({
                                                title: 'Soporte Tecnico Asistencia',
                                                text: "Tu Ticket de Asistencia esta en proceso en un plazo de 24 a 48 horas seras atendido en tu correo registrado en la plataforma,  esta atento Gracias y disculpe los inconvenientes",
                                                icon: 'info',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Ok'
                                                });
                            });     
                        }
                    });             
            }
            else{
                tecnoDialog.close();
                Swal.fire({
                    title: 'Cryptosignal',
                    text: "Faltan datos no se puede crear un ticket vacio.!",
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                });
            }
        }

  </script>
<body id="top">

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
<input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
<section class="hero hero-inside" >
<div id="cuerpo" class="cuerpo" >

<section class='overlay-common-dialog' id='overlay-common-dialog-1'>
                    <div class='common-dialog' id='tecno-dialog'>
                        <div class="tecno-content">
                        <h3 class='dialog-title'>Asistencia Tecnica</h3>
                        <label>Asunto Requerido:</label><input type="text" id="asuntoTecno">
                        <br>
                        <label>Mensaje:</label>
                        <br><textarea id="mensajeTecno"></textarea>
                        <div style='margin-top:1rem'>
                            <button class="closeDialog-btn" onclick="closeTecnoDialog()">Cancelar</button>
                            <button class="add-button" onclick="enviarAsistencia()">Enviar</button>
                        </div>

                        </div>
                        <br>
                    </div>  
                  </section>

<div class="progress-container">
    <h5 style='position:absolute;text-align:center;left:48%;opacity: 0.5;'>Progress</h5>
    <div class="progress-label" id="label1"></div>
    <div class="progress-label" id="label2"></div>
    <div class="progress-label" id="label3"></div>
    <div class="progress-bar" id="my-progress"></div>
</div>
<section class='tab-section'>
  <ul class='nav nav-tabs'>
  <li onclick="swapZIndex(document.getElementById('dataSec'), document.getElementById('chatSec'))">
  <a>Datos</a> </li>

  <li onclick="swapZIndex(document.getElementById('chatSec'), document.getElementById('dataSec'))">
  <a>Chat</a>
</li>

  </ul>
</section> 
<div class='chatOuterContainer'> 
<section class='dataSec' id='dataSec'>
<div class='data'>
  <h3 >SOPORTE CRYPTOSIGNAL</h3>
  <a class='binance-button'  style=" cursor:pointer;background: antiquewhite; margin-top:25px;font-size:1rem;text-decoration:none;color:black;" onclick="mostrarTecnoDialog()">
  Ayuda Asistencia en Linea
  </a><br>  
    <div style="margin-top:21px;">
      <h5 style='margin: 0;'>Chat directo con el Cajero</h5>
      <span style='font-size: 1.2rem;font-weight: bold;'>Fecha:</span> <span id=fecha style='font-size: 1.2rem;font-weight: bold;'></span><br>

      <div style='border-bottom: 1px solid gray;margin-top: 1rem;'>
      <span style="font-size:1.4rem; font-weight:bold;">Seleccione un Deposito/Retiro Activo: </span>
      <select id="selectTicket" onchange="seltickect()" style="width:60%;color:black;">
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
      <div>    
      <br>
    </div>

</div>

<div style='padding-top: 1rem;'>
  <b><span id="detalle"></span></b><br>
  <span id="msj"></span> <b><span class='pay' id=totalPagar></span></b> <span style='font-size:1rem;'></span><br>
  Metodo de Pago: <b><span id=metodoPago></span></b><br>

</div>

<div class='estadoContainer'>
    <p>

      Estatus en : <span id=estado ></span>
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

    <section class='chatSec' id='chatSec'>
      <div class='chatData'>
        <h5 ><?php if($_SESSION['nivel']==1) echo "Cliente: "; else echo "Cajero: ";?> <span id=usuario></span></h5>
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

            <script>
            function swapZIndex(element,element2) {
              // Obtener los valores actuales de z-index de los elementos
              element.style.display = 'block';
              element2.style.display = 'none';
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
