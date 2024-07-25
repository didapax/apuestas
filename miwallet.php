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
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">      
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>          
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

 
        </style>                
        <script> 
            function inicio(){
                leerDatos();
                recuperarRetiros();  
                recuperarDepositos();  
                myVar = setInterval(refrescar, 2000);
            }

            function refrescar(){
                leerDatos();
                recuperarRetiros();  
                recuperarDepositos();                  
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
                    <!--Envia <span id="apuesta"></span><span id="info"></span>-->
                    <br><br> Binance Pay Id  CriptoSignalGroup
                    <input readonly class="datcajero" style="" id="paycajero">
                    <img src="Assets/qrbinance.png"><br>
                    <div id="calculo" style="color:green;float:right; background:white;padding:3px;border:solid 1px; border-radius:5px;"></div><br>
                 <!--   <button title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button>
                    <br>
                    Coloca la Nota Id (txid) de la transferencia realizada:<br>
                    <input required type="text" id="nota" name="nota">-->
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
                        <h3>Depositar Usdc por Binance Pay</h3>
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