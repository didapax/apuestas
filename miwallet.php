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
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
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
                background: url(Assets/ayudabinance.jpg) no-repeat center / cover;
        }  

        #modalOverlay{
            display: flex;
            justify-content: space-between;
        }

        #modalOverlay2{
            display: flex;
            justify-content: space-between;
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

    <section class='overlay-common-dialog' id='overlay-common-dialog-2'>
        <div class='common-dialog' id='modalOverlay'>
            <span id="closeModalBtn" class="close-btn" onclick="closeOverlayModal();">X</span>
                <h2 class='dialog-title'>Deposit</h2>
                Choose a checkout operator: 
                <select onchange="selcajero()" id="micajero" class='select'>
                </select>
                <br>                 
                Choice of Deposit: 
                <select onchange="selpago()" id="comopago" style="margin-bottom: 2rem;" class='select'></select>
                StableCoin:
                <select id="establecoin" style="margin-bottom: 2rem;" class='select'>
                    <option selected value="USDC">USDC</option>
                    <option value= "USDT">USDT</option>
                </select>
                <div id="detalles" style="display:none;width:100%;">
                    Cantidad a Depositar: 
                    <input style="border: 1px solid #7aa891eb;outline: none;background: #42f87863;border-radius: 5px;padding: 3px;" type="number"  id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" step="0.01" style="color:black;"><br>
                    <div id="calculo" style="width: 100%;float: right;background: #24262f;border: none; border-radius:5px;margin: 1rem 0;padding: 1rem;border: double 1px #337ab77d;color: white;"></div><br>                    
                    <br><br> <div id='descripcionMetodo'></div>
                    <input readonly class="datcajero" style="width: 100%;border: none;outline: none;background: #00000000;text-align: center;text-decoration: underline;margin-bottom: 1rem;font-size: 1.8rem;" id="paycajero"><br>
                    <div style="width:100%;text-align: center;">
                        <img id='QRdeposito' src="">
                    </div>
                    <br>                    
                </div><br><br>
                <button onclick="jugar_back()" class='deposit-button' style="float:right;width:auto;" type="button" id="jugar" name="jugar"><img style='width:1.2rem' src='./index-assets/img/in.png'>Deposit</button>
        </div>
    </section>    
    <section class='overlay-common-dialog' id='overlay-common-dialog-3'>
        <div class='common-dialog' id='modalOverlay2'>    
        <span id="closeModalBtn2" class="close-btn" onclick="closeOverlayModal2();">X</span>
                <h2 class='dialog-title'>Withdraw</h2>
                <input type="hidden" id="tipo_retiro" name="tipo_retiro">
                <br>
                Choose a checkout operator: 
                <select onchange="selcajero_retiro()" id="micajero_retiro" style="margin-bottom:2rem;" class='select'>
                </select>
                <br>
                Withdraw with: 
                <select required onchange="selretiro()" id="como_retiro" style="margin-bottom:2rem;" class='select'>
                </select>
                StableCoin:
                <select id="establecoin_retiro" style="margin-bottom:2rem;" class='select'>
                    <option selected value="USDC">USDC</option>
                    <option value= "USDT">USDT</option>
                </select>                
                <div id="detalles_retiro" style="display:none;width:100%;">
                    Quantity: 
                    <input style="border: 1px solid #905353eb;outline: none;background: #f8425357;border-radius: 5px;padding: 3px;" type="number"  id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo()" value="0" step="0.01" type="number" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0"  step="1"><br>
                    <div id="calculo_retiro"  style="width: 100%;float: right;background: #24262f;border: none; border-radius:5px;margin: 1rem 0;padding: 1rem;border: double 1px #337ab77d;color: white;"></div><br><br>
                    <br><br><div style='text-align:center;' id='descripcionMetodoRetiro'></div>
                    <input readonly class="datcajero" style="width: 100%;border: none;outline: none;background: #00000000;text-align: center;text-decoration: underline;margin-bottom: 1rem;font-size: 1.8rem;" id="paycliente">                    
                    <br>
                </div><br><br>
                <button onclick="retirar_back()" class='retire-button' style="float:right;width:auto;" type="button" id="retirar_btn" name="retirar_btn"><img style='width:1.2rem' src='./index-assets/img/out.png'> Withdraw</button>
            </div>
        </section>

            <br>
           <!-- <div id="saldo"></div>        -->

      <!-- Inicio de la pestaña -->
      <div >
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" style="color:acua;" href="#home">Wallets</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#depositos" onClick="recalcDepositos()">Deposits</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#retiros" onClick="recalcRetiros()">Withdrawals</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#send" onClick="recalcSend()">Send</a></li>
                <li><a data-toggle="pill" style="color:acua;" href="#historial" onClick="recalcHistorial()">Acquisitions</a></li>
            </ul>
            
            <div class="tab-content">

                <div id="home" class="tab-pane fade in active">
                    
                    <div class="tab-title">
                        <h3>Manage Wallets</h3>
                    </div>                    

                    <!-- Dialogo de informacion del usuario binance -->
                     
                    <dialog id="info-dialog" style='background: linear-gradient(45deg, #6d6d6d, #309ccf5e);text-align: center;'>
                        <div class="dialog-content">
                            <img src="Assets/ayudabinance.jpg" alt="" style='width: 100%;width: -moz-available;width: -webkit-fill-available;'>
                        </div>
                        <br>
                        <button class="add-button" onclick="document.getElementById('info-dialog').close()">Cerrar</button>
                    </dialog>  
                    <!-- Dialogo de Asistencia Tecnica -->

                    <section class='overlay-common-dialog' id='overlay-common-dialog-1'>
                    <div class='common-dialog' id='tecno-dialog'>
                        <div class="tecno-content">
                        <h3 class='dialog-title'>Technical Assistance</h3>
                        <label>Issue:</label><input type="text" id="asuntoTecno">
                        <br>
                        <label>Message:</label>
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
                        <section > 
                        <p style="margin: 0; padding-left: 1rem;">
                            Your Binance email address and BSC BEP-20 wallet (which can be Metamask, Trust, or any other compatible with BSC BEP-20) will be used for deposits and withdrawals. Please ensure that this information is correct. CryptoSignal is not responsible for any errors in the information you provide.<br><br>
                            </p>
                            <div style='padding-left:1rem;padding-left: 1rem;display: flex;flex-direction: column;gap: 1rem;'>
                            <div> 
                                <h4>Binance Username:</h4> <input type="text" class='binance-input' style="color:white;" id="userBinance"><span title="Donde Buscar" style="color:black;margin-left:5px;cursor:pointer;" onclick="mostrarAyudaBinance()"> &#10068;</span>
                            </div>

                            <div style="width: 100%;"> 
                                <h4>Binance Email:</h4> <input type="text" class='binance-input' style="width: 50%;color:white;" id="payid">
                            </div>

                            <div  style="width: 100%;">
                                <div style="width: 80%;">  
                                    <h4> Wallet BSC Bep-20 (Metamask, Trust)</h4> <input class='binance-input' style="width: 100%;color:white;" type="text" id="bep20">
                                </div>                                        
                            </div>

                            <button id="Save" class='binance-button' style="margin-top:25px;width: 10rem;" type="button" onclick="guardar()">Save</button><br>
                            </div>
                            <div class='binance-image-container' style="margin-right: 15px;">
                                <image src="Assets/minibina.png">
                            </div>

                        </section>
                        <br>
                    </div>
                </div>
                
                
                <div id="depositos" class="tab-pane fade" >
                    <div class="tab-title">
                        <h3>Deposit stablecoins easily and securely</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <div class='button-container'><button id="buttonDeposito" class='deposit-button' onclick="initDeposito()">Depositar</button> </div>
                                <table id='example' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ticket N.</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-depositos">
                                    </tbody>
                                </table>
                    </div>
                                        
                </div> 

                <div id="retiros" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Withdraw your StableCoins</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                    <div class='button-container'>   <button id="buttonRetiro" class='retire-button' onclick="showModalOverlay2();">Retirar</button> </div>

                                <table id='example1' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ticket N.</th>
                                            <th>Description</th>
                                            <th>Payment</th>                                            
                                            <th>Fee</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-retiro">
                                    </tbody>
                                </table>
                    </div>
                                        
                </div>

                <div id="send" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Send USDC Stablecoin</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                    <div class='button-container' style="display: contents;justify-content: flex-start; align-items: flex-end;">
                        <div style="width: 100%;"> 
                            <h4>Cryptosignal Email:</h4>
                            <input type="text" class='binance-input' style="width: 250px;color:white;" id="sendTo">
                        </div>
                        <div style="width: 100%;"> 
                            <h4>Usdc Amount:</h4>
                            <input type="number" min="1" value="1" step="0.1" class='binance-input' style="width: 180px;color:white;" id="amountTo">
                        </div>                        
                        <button id="buttonSend" class='binance-button' style="margin-top:25px;width: 10rem;" onclick="sendToEmail()">Send</button>
                    </div>
                                <table id='tableSend' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ticket N.</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-send">
                                    </tbody>
                                </table>
                    </div>
                                        
                </div>                

                <div id="historial" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Purchase and Subscription Record</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                                <table id='example2' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Ends:</th>
                                            <th>Days</th>
                                            <th>Subscription</th>
                                            <th>Cost</th>
                                            <th>Status</th>
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
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
            
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
            <script type="text/javascript" charset="utf8"src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
            
            <!--<script src="bower_components/retina.js/dist/retina.js"></script>-->
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
