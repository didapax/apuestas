<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){
?>
<html>
    <head> 
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">                
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />
        <script src="Javascript/miwallet.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>               
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">    
    </head>
    <header>
        <style>
            .textAreaContainer{
            background:white;
            color: black;
         }
            
         select{
            color:black;
         }
        </style>             
        <script>
        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "wallet"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->     

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['SALDO']; ?>"  id="tsaldo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['BINANCE']; ?>" id="wallet_binance">        
        <input type="hidden" name="cajero" id="cajero" value="">
        <input type="hidden" name="tipo" id="tipo">
        <input type="hidden" id="recibe">
        <input type="hidden" id="comision_retiro">

        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem; overflow-x: hidden; padding:5rem; min-height: calc(100vh - 24rem);'>

        <div id="modalOverlay" class="modal-overlay">
            <div class="modal">
                <span id="closeModalBtn" class="close-btn">X</span>
                <h2>Depositar</h2>
                Selecciona un Cajero: 
                <select onchange="selcajero()" id="micajero" style="color:black;">
                </select>
                <br>                
                Como Vas a Pagar: 
                <select required onchange="selpago()" id="comopago" style="color:black;">            
                </select>
                <div id="detalles" style="display:none;width:100%;">
                    Cantidad a Depositar: 
                    <input style="border:none;outline: none;" type="number"  id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" step="0.01" style="color:black;"><br>
                    <div id="calculo" style="width:100%;color:black;float:right; background:white;padding:3px;border:none border-radius:5px;"></div><br>                    
                    <br><br> <div id='descripcionMetodo'></div>
                    <input readonly class="datcajero" style="width:100%;border:none;outline: none;" id="paycajero"><br>
                    <img style="" id='QRdeposito' src=""><br>                    
                </div><br><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;color:black;padding:8px;" type="button" id="jugar" name="jugar">Depositar</button>
            </div>
        </div>

        <div id="modalOverlay2" class="modal-overlay">
            <div class="modal">
                <span id="closeModalBtn2" class="close-btn">X</span>
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
                <div id="detalles_retiro" style="display:none;width:100%;">
                    Cantidad a Retirar: 
                    <input style="border:none;outline: none;" type="number" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0" style="color:black;"  step="1"><br>
                    <div id="calculo_retiro" style="width:100%;color:black;float:right; background:white;padding:3px;border:none border-radius:5px;"></div><br><br>
                    <br><br><div id='descripcionMetodoRetiro'></div>
                    <input readonly class="datcajero" style="width:100%;border:none;outline: none;" id="paycliente">                    
                    <br>
                </div><br><br>
                <button onclick="retirar_back()" class='appbtn' style="float:right;color:black;padding:8px;" type="button" id="retirar_btn" name="retirar_btn">Retirar</button>
            </div>
        </div>

            <br>
           <!-- <div id="saldo"></div>        -->

      <!-- Inicio de la pestaña -->
      <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" style="color:black;" href="#home" onclick="inicio()">Mi Perfil</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#depositos" onclick="recuperarDepositos()">Depositos</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#retiros" onclick="recuperarRetiros()">Retiros</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#historial" onclick="recuperarHistorial()">Mis Compras</a></li>
            </ul>
            
            <div class="tab-content">

                <div id="home" class="tab-pane fade in active">
                    <div class="tab-title">
                        <h3>Editar mi perfil</h3>
                    </div>
                    <div class="vista" id="vista">
                    <div class="dialog-wallet" id="agregar">                                   
                        Esta Direccion de Binance Pay Id y Bep-20 seran Utlizadas para los Depositos y Retiros, 
                        asegurate que sea correcta, CryptoSignal Group no se hace responsable por la informacion 
                        erronea que suministres.<br><br>
                        
                        <section class='dialog-wallet-content'> 
                            <div class='binance-form-outer-container'>
                                <div class='binance-form-container'>
                                    <div class='binance-input-container'> 
                                        <div> 
                                            <h4>Mi Pay ID:</h4> <input type="text" class='binance-input' id="payid">
                                        </div>    
                                        <button id="guardar" class='binance-button' type="button" onclick="guardar()">Guardar</button>
                                    </div>
                                    <div class='binance-input-container'>
                                        <div>  
                                            <h4> Wallet BSC Bep-20:</h4> <input class='binance-input' type="text" id="bep20">
                                        </div> 
                                        <button id="guardarbep20" class='binance-button' type="button" onclick="savebep20()">Guardar</button>                        
                                    </div>
                                </div>
                                
                                <div class='binance-image-container'>
                                    <image src="Assets/minibina.png">
                                </div>
                            </div>
                        </section>
                    
                    </div> 
                    </div>
                </div>
                
                <div id="depositos" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Depositar Usdc de Forma Facil y Segura</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button id="buttonDeposito" class='deposit-button' onclick="initDeposito()"><img style='width:1.2rem' src='Assets/icons/cash_icon.png'>Depositar</button>
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
                        <h3>Retirar Tus Usdc de la Plataforma</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button id="buttonRetiro" class='retire-button' onclick="document.getElementById('modalOverlay2').style.display = 'flex';"><img style='width:1.2rem' src='Assets/icons/withdrawal_icon.png'> Retirar</button>

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
                                            <th>Capital + Interes</th>
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

        <!-- Fin de la pestaña -->

        </div>


      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     

    <script src='https://code.jquery.com/jquery-3.7.1.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.semanticui.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 

    <script>
        new DataTable('#example');
        new DataTable('#example1');
        new DataTable('#example2');
    </script>

<script>
   $(document).ready(function(){
        $('.nav-tabs a').click(function(){
            $(this).tab('show');
        });
    });

    function myFunctionMenu() {    
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>    
<script>
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalOverlay2 = document.getElementById('modalOverlay2');
        const closeModalBtn2 = document.getElementById('closeModalBtn2');        

        // Función para cerrar el modal
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera de él
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }
        });

        // Función para cerrar el modal2
        closeModalBtn2.addEventListener('click', () => {
            modalOverlay2.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera de él
        modalOverlay2.addEventListener('click', (e) => {
            if (e.target === modalOverlay2) {
                modalOverlay2.style.display = 'none';
            }
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
