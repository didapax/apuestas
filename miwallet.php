<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">                
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />           
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
        <script src="Javascript/miwallet.js"></script>
    </head>
    <header>
        <style>


            .dialog_agregar{
                width:350px;
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
                width:360px;
                height: 290px;
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
            function inicio(){
                leerDatos();
                recuperarRetiros();  
                recuperarDepositos();  
                recuperarHistorial();  
                myVar = setInterval(refrescar, 2000);
            }

            function refrescar(){
                leerDatos();
                recuperarRetiros();  
                recuperarDepositos();  
                recuperarHistorial();                  
            }
                        
        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "wallet"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->     

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['SALDO']; ?>" name="tsaldo" id="tsaldo">
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['BINANCE']; ?>" name="wallet_binance" id="wallet_binance">        
        <input type="hidden" name="cajero" id="cajero" value="alfonsi.acosta@gmail.com">
        <input type="hidden" name="tipo" id="tipo">
        <input type="hidden" id="recibe">
        <input type="hidden" id="comision_retiro">

        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">

        <dialog class="dialog_agregar" id="jugada" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('jugada').close()">X</a><br>
            <form method="post" action="miwallet">
                <br>
                Como Vas a Pagar: 
                <select required onchange="selpago()" name="comopago" id="comopago" style="color:black;">
                    <option id="comopago_back" value=""></option>
                    <option value="BINANCE">Binance Pay</option>                
                </select>
                <div id="detalles" style="display:none;">
                    Cantidad a Depositar: 
                    <input required type="number"  id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" step="0.01" style="color:black;"><br>
                    <br><br> Binance Pay Id  CriptoSignalGroup
                    <input readonly class="datcajero" style="" id="paycajero">
                    <img src="Assets/qrbinance.png"><br>
                    <div id="calculo" style="color:green;float:right; background:white;padding:3px;border:solid 1px; border-radius:5px;"></div><br>
                </div><br><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;color:black;" type="button" id="jugar" name="jugar">Depositar</button>
            </form>
        </dialog>

        <dialog class="dialog_retirar" id="retirar" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('retirar').close()">X</a><br>
            <form method="post" action="miwallet">
                <input type="hidden" id="tipo_retiro" name="tipo_retiro"><br>
                Retirar con: 
                <select required onchange="selretiro()" name="como_retiro" id="como_retiro" style="color:black;">
                    <option id="comopago_back" value=""></option>
                    <option value="BINANCE">Binance Pay</option>
                </select>
                <div id="detalles_retiro" style="display:none;">
                    Cantidad a Retirar: 
                    <input required type="number" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0" style="color:black;"  step="1"><br>
                    <div id="calculo_retiro" style="color:green;float:right; background:white;padding:3px; border:solid 1px; border-radius:3px;"></div><br><br>
                    <!--Recibe <span id="apuesta_retiro"></span><span id="info_retiro"></span>-->
                    <br><br>Mi Binance Pay Id:
                    <input readonly class="datcajero" style="" id="cajero_retiro">                    
                    <br>
                </div><br>
                <button onclick="retirar_back()" class='appbtn' style="float:right;color:black;" type="button" id="retirar_btn" name="retirar_btn">Retirar</button>
            </form>
        </dialog>

            <br>
           <!-- <div id="saldo"></div>        -->

      <!-- Inicio de la pestaña -->
      <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" style="color:black;" href="#home">Editar mi perfil</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#depositos">Depositos</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#retiros">Retiros</a></li>
                <li><a data-toggle="pill" style="color:black;" href="#historial">Mis Compras</a></li>
            </ul>
            
            <div class="tab-content">

                <div id="home" class="tab-pane fade in active">
                    <div class="tab-title">
                        <h3>Editar mi perfil</h3>
                    </div>
                    <div class="vista" id="vista">
                    <div class="dialog_wallet" id="agregar">                                   
                        Esta Direccion  de Binance Pay Id de sera Utlizada para los Depositos y Retiros, 
                        asegurate que sea correcta, Cripto Signal Group no se hace responsable por la informacion 
                        erronea que suministres.<br><br>
                        <image src="Assets/minibina.png"><br>
                        Mi Pay ID: <br> <input style="width:300px; color:black;" type="text" id="payid"><br>
                        <button id="guardar" class='appbtn' style="float:right; color:black;" type="button" onclick="guardar()">Guardar</button>
                    </div> 
                    </div>
                </div>
                
                        
                <div id="depositos" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Depositar Usdc de Forma Facil y Segura</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button onclick="document.getElementById('jugada').show();">Depositar</button>
                        <section class='table-section' style='padding:3.5rem;'>  

                            <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
                                <table style='width: 100%;'> 
                                    <thead>
                                        <tr>
                                            <th>Ticket N.</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
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
                        <button onclick="document.getElementById('retirar').show();">Retirar</button>
                        <section class='table-section' style='padding:3.5rem;'>  

                            <div class='InventarioBox' style='height: 27rem;  width: auto; overflow-y: scroll;'> 
                                <table style='width: 100%;'> 
                                    <thead>
                                        <tr>
                                            <th>Ticket N.</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
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