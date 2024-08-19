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
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">                
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />
        <script src="Javascript/miwallet.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>               
    </head>
    <header>
        <style>


            .dialog_agregar{
                width:400px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #16A085;              
                color:white;
                font-weight:bold;
                border-radius: 5px;
                z-index: 1000;
            } 


            .dialog_retirar{
                width:350px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #CD6155;              
                color:white;
                font-weight:bold;
                border-radius: 5px;
                z-index: 1000;
            } 

            .dialog_wallet{
                display:inline-block;
                padding:5px;
                margin:2px;
                width:400px;
                height: 330px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #1B2224;              
                color:white;
                font-weight:bold;
                border-radius: 5px;
                z-index: 1000;
            }

            .textAreaContainer{
            background:white;
            color: black;
         }
         input[type=text]{
            color:black;
         }
         input[type=number]{
            color:black;
         }       
         
         select{
            color:black;
         }
         button{
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

        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem;padding:1rem;'>

        <dialog class="dialog_agregar" style='width:400px;' id="jugada" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('jugada').close()">X</a><br>
            <form >
                <br>
                Selecciona un Cajero: 
                <select onchange="selcajero()" id="micajero" style="color:black;">
                </select>
                <br>                
                Como Vas a Pagar: 
                <select required onchange="selpago()" id="comopago" style="color:black;">            
                </select>
                <div id="detalles" style="display:none;width:100%;">
                    Cantidad a Depositar: 
                    <input required type="number"  id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" step="0.01" style="color:black;"><br>
                    <br><br> <div id='descripcionMetodo'></div>
                    <input readonly class="datcajero" style="width:100%;" id="paycajero"><br>
                    <img id='QRdeposito' src=""><br>
                    <div id="calculo" style="width:100%;color:black;float:right; background:white;padding:3px;border:solid 1px; border-radius:5px;"></div><br>
                </div><br><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;color:black;padding:8px;" type="button" id="jugar" name="jugar">Depositar</button>
            </form>
        </dialog>

        <dialog class="dialog_retirar" style='width:400px;' id="retirar" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('retirar').close()">X</a><br>
            <form >
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
                    <input required type="number" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0" style="color:black;"  step="1"><br>
                    <div id="calculo_retiro" style="width:100%;color:black;float:right; background:white;padding:3px; border:solid 1px; border-radius:3px;"></div><br><br>
                    <br><br><div id='descripcionMetodoRetiro'></div>
                    <input readonly class="datcajero" style="width:100%;" id="paycliente">                    
                    <br>
                </div><br><br>
                <button onclick="retirar_back()" class='appbtn' style="float:right;color:black;padding:8px;" type="button" id="retirar_btn" name="retirar_btn">Retirar</button>
            </form>
        </dialog>

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
                    <div class="dialog_wallet" id="agregar">                                   
                        Esta Direccion de Binance Pay Id y Bep-20 seran Utlizadas para los Depositos y Retiros, 
                        asegurate que sea correcta, Cripto Signal Group no se hace responsable por la informacion 
                        erronea que suministres.<br><br>
                        <image src="Assets/minibina.png"><br>
                        Mi Pay ID: <br> <input style="width:300px; color:black;" type="text" id="payid">
                        <button id="guardar" class='appbtn' style="float:right; color:black;" type="button" onclick="guardar()">Guardar</button>
                        <br>
                        Wallet BSC Bep-20: <br> <input style="width:300px; color:black;" type="text" id="bep20">
                        <button id="guardarbep20" class='appbtn' style="float:right; color:black;" type="button" onclick="savebep20()">Guardar</button>                        
                    </div> 
                    </div>
                </div>
                
                        
                <div id="depositos" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Depositar Usdc de Forma Facil y Segura</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button id="buttonDeposito" onclick="initDeposito()">Depositar</button>
                        <section class='table-section' style='padding:3.5rem;'>  

                            <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
                                <table style='width: 100%;'> 
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
                        </section>                          
                    </div>
                                        
                </div>

                <div id="retiros" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Retirar Tus Usdc de la Plataforma</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button id="buttonRetiro" onclick="document.getElementById('retirar').show();">Retirar</button>
                        <section class='table-section' style='padding:3.5rem;'>  

                            <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
                                <table style='width: 100%;'> 
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
                        </section>                        
                    </div>
                                        
                </div>

                <div id="historial" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Historial de Compras y Suscripciones</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <section class='table-section' style='padding:3.5rem;'>  

                            <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
                                <table style='width: 100%;'> 
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
                        </section>                        
                    </div>
                                        
                </div>                

            </div>
        </div>

        <!-- Fin de la pestaña -->

        </div>


      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     

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
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>