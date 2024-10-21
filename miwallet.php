<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 && isset($_SESSION['secured'])){
?>
<html lang="es">
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
        <script src="Javascript/miwallet.js"></script>
    </head>
        <style> 
            .textAreaContainer{
            background:white;
            color: black;
         }
            
         select{
            color:black;
         }

         dialog {
            position: absolute;   
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: white;   
            width: 100%; 
            z-index: 1000;
            border: solid 1px gray;            
        }

        .dialog-content {
                text-align: center;
                background: url('Assets/ayudabinance.jpg') no-repeat center/cover;

        }  


            .contenido h3{
                text-align: center;
            }

            @media screen and (max-width: 1150px)
            {
            
            .nav-tabs{display: flex;align-items: center;flex-wrap: wrap;justify-content: center;}
            
            }

            #tecnoDialog, #overlay-common-dialog-1{
                display:none;
            }

        </style>             
        <script>
        </script>

    <body onload="inicio()" id="top">
    <?php $page = "wallet"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>   

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['SALDO']; ?>"  id="tsaldo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['BINANCE']; ?>" id="wallet_binance">        
        <input type="hidden" name="cajero" id="cajero" value="">
        <input type="hidden" name="tipo" id="tipo">
        <input type="hidden" id="recibe">
        <input type="hidden" id="comision_retiro">

        <section class="hero hero-inside" >
        <div id="cuerpo" class="cuerpo">
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div class="vista" id="vista" >

        
        <dialog id="modalOverlay" >
            <span id="closeModalBtn" class="close-btn" onclick="document.getElementById('modalOverlay').close();">X</span>
                <h2>Depositar</h2>
                Selecciona un Cajero: 
                <select onchange="selcajero()" id="micajero" style="color:black;">
                </select>
                <br>                 
                Como Vas a Depositar: 
                <select onchange="selpago()" id="comopago" style="color:black;"></select>
                Establecoin:
                <select id="establecoin" style="color:black;">
                    <option selected value="USDC">USDC</option>
                    <option value= "USDT">USDT</option>
                </select>
                <div id="detalles" style="display:none;width:100%;">
                    Cantidad a Depositar: 
                    <input style="border:1px solid yellow;outline: none;background:olive;border-radius:5px; padding:3px;" type="number"  id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" step="0.01" style="color:black;"><br>
                    <div id="calculo" style="width:100%;color:black;float:right; background:white;padding:3px;border:none border-radius:5px;"></div><br>                    
                    <br><br> <div id='descripcionMetodo'></div>
                    <input readonly class="datcajero" style="width:100%;border:none;outline: none;" id="paycajero"><br>
                    <div style="width:100%;text-align: center;">
                        <img style="" id='QRdeposito' src="">
                    </div>
                    <br>                    
                </div><br><br>
                <button onclick="jugar_back()" class='deposit-button' style="float:right;color:black;padding:8px;" type="button" id="jugar" name="jugar"><img style='width:1.2rem' src='./index-assets/img/in.png'>Depositar</button>
        </dialog>

        <dialog id="modalOverlay2">
        <span id="closeModalBtn2" class="close-btn" onclick="document.getElementById('modalOverlay2').close();">X</span>
                <h2>Retiros</h2>
                <input type="hidden" id="tipo_retiro" name="tipo_retiro">
                <br>
                Selecciona un Cajero: 
                <select onchange="selcajero_retiro()" id="micajero_retiro" style="color:black;">
                </select>
                <br>
                Retirar con: 
                <select required onchange="selretiro()" id="como_retiro" style="color:black;">
                </select>
                Establecoin:
                <select id="establecoin_retiro" style="color:black;">
                    <option selected value="USDC">USDC</option>
                    <option value= "USDT">USDT</option>
                </select>                
                <div id="detalles_retiro" style="display:none;width:100%;">
                    Cantidad a Retirar: 
                    <input style="border:1px solid yellow;outline: none;background:olive;border-radius:5px; padding:3px;" type="number" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0" style="color:black;"  step="1"><br>
                    <div id="calculo_retiro" style="width:100%;color:black;float:right; background:white;padding:3px;border:none border-radius:5px;"></div><br><br>
                    <br><br><div id='descripcionMetodoRetiro'></div>
                    <input readonly class="datcajero" style="width:100%;border:none;outline: none;" id="paycliente">                    
                    <br>
                </div><br><br>
                <button onclick="retirar_back()" class='retire-button' style="float:right;color:black;padding:8px;" type="button" id="retirar_btn" name="retirar_btn"><img style='width:1.2rem' src='./index-assets/img/out.png'> Retirar</button>
        </dialog>

            <br>
           <!-- <div id="saldo"></div>        -->

      <!-- Inicio de la pestaña -->
      <div >
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" style="color:acua;" href="#home">Mis Wallet</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#depositos" onClick="recalcDepositos()">Depositos</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#retiros" onClick="recalcRetiros()">Retiros</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#historial" onClick="recalcHistorial()">Mis Compras</a></li>
            </ul>
            
            <div class="tab-content">

                <div id="home" class="tab-pane fade in active">
                    
                    <div class="tab-title">
                        <h3>Gestionar mis Wallet</h3>
                    </div>                    

                    <!-- Dialogo de informacion del usuario binance -->
                    <dialog id="info-dialog">
                        <div class="dialog-content"></div>
                        <br>
                        <button class="add-button" onclick="document.getElementById('info-dialog').close()">Cerrar</button>
                    </dialog>  
                    <!-- Dialogo de Asistencia Tecnica -->

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

                    <div id="agregar">
                    <a class='binance-button'  style=" cursor:pointer;background: antiquewhite; margin-top:25px;font-size:13px;text-decoration:none;color:black;" onclick="mostrarTecnoDialog()">
                    Soporte Técnico Asistencia en Linea (click)
                    </a>                                
                    <br>
                        <p style="margin: 21 0 1em;">
                        Con tu Direccion de Correo Binance y la wallet BSC Bep-20 (Puede ser Metamask, Trust o cualquier otra que maneje BSC Bep-20)seran Utlizadas para los Depositos y Retiros, 
                        asegurate que sea correcta, CryptoSignal no se hace responsable por la informacion 
                        erronea que suministres.<br><br>
                        </p>
                        <section > 
                            <div >
                                <div >
                                <div > 
                                        <div> 
                                            <h4>Nombre de Usuario Binance:</h4> <input type="text" class='binance-input' style="color:white;" id="userBinance"><span title="Donde Buscar" style="color:black;margin-left:5px;cursor:pointer;" onclick="mostrarAyudaBinance()"> &#10068;</span>
                                        </div>                                        
                                    </div>                                    
                                    <div > 
                                        <div style="width: 100%;"> 
                                            <h4>Correo Binance:</h4> <input type="text" class='binance-input' style="width: 50%;color:white;" id="payid">
                                        </div>
                                    </div>
                                    <div  style="width: 100%;">
                                        <div style="width: 80%;">  
                                            <h4> Wallet BSC Bep-20 (Metamask, Trust)</h4> <input class='binance-input' style="width: 100%;color:white;" type="text" id="bep20">
                                        </div>                                        
                                    </div>
                                </div>
                                <button id="guardar" class='binance-button' style="margin-top:25px;" type="button" onclick="guardar()">Guardar</button><br>
                                <div class='binance-image-container' style="margin-right: 15px;">
                                    <image src="Assets/minibina.png">
                                </div>
                            </div>
                        </section>
                    
                    </div> 
                    </div>
                
                
                <div id="depositos" class="tab-pane fade" >
                    <div class="tab-title">
                        <h3>Depositar Establecoin de Forma Facil y Segura</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <div class='button-container'><button id="buttonDeposito" class='deposit-button' onclick="initDeposito()">Depositar</button> </div>
                                <table id='example' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Ticket N.</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
                                            <th>Calificacion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-depositos">
                                    </tbody>
                                </table>
                    </div>
                                        
                </div> 

                <div id="retiros" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Retirar Tus Establecoin de la Plataforma</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                    <div class='button-container'>   <button id="buttonRetiro" class='retire-button' onclick="document.getElementById('modalOverlay2').show()">Retirar</button> </div>

                                <table id='example1' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Ticket N.</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
                                            <th>Calificacion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-retiro">
                                    </tbody>
                                </table>
                    </div>
                                        
                </div>

                <div id="historial" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Historial de Compras y Suscripciones</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                                <table id='example2' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Finaliza</th>
                                            <th>Dias</th>
                                            <th>Suscripcion</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-historial">
                                    </tbody>
                                </table>                        
                    </div>
                                        
                </div>                

            </div>
        </div>
        </div>
        </div>

        <!-- Fin de la pestaña -->

        </div>

        </section>
      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     
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

            <script>
      $(document).ready(function() {
           /* $('#example').DataTable({
                responsive: true,
                paging: true,
                searching: true
            });

            $('#example1').DataTable({
                responsive: true,
                paging: true,
                searching: true
            });
            
            $('#example2').DataTable({
                responsive: true,
                paging: true,
                searching: true
            });     */       

        });              
            </script>
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>
