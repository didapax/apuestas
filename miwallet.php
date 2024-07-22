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
function myFunction() {
                var copyText = document.getElementById("cajero");
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */
                navigator.clipboard.writeText(copyText.value);
            }

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
            }  

            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,                    
                    payid: document.getElementById("payid").value
                },function(data){
                    var datos= JSON.parse(data);
                    console.log("result:", data)
                    if(datos.result){
                        Swal.fire({
                                    title: 'Wallet',
                                    text: "Tu Wallet de PayId ha sigo Guardada con exito..!",
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    });                                            
                        leerDatos();
                        document.getElementById('agregar').close();    
                    }
                });
            }

            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario:"", 
                        sesion: true,
                        correo: document.getElementById("correo").value
                    },function(data){
                        console.log("datos: ",data);
                        var datos= JSON.parse(data);
                        document.getElementById("payid").value = datos.binance;
                        //document.getElementById("wallet_binance").value = datos.binance;  
                        $("#saldo").html("Saldo "+datos.saldo+" USDC"); 

                        if(datos.binance != null && datos.binance.length > 0){
                            document.getElementById("payid").readOnly = true;
                        }
                    });
                }
            }

            function initsession(){
                window.location.href="sesion";
            }

            function selpago(){
                if(document.getElementById("payid").value.length >0){
                    if($("#comopago").val() == "BINANCE"){                    
                    $.post("block",{
                        getUsuario:"",
                        sesion: true,
                        correo: document.getElementById("cajero").value
                    },function(data){
                        var datos= JSON.parse(data);                        
                        document.getElementById("cantidad").value = 0;
                        document.getElementById("paycajero").value = datos.binance;
                        //$("#info").html(" USDC + Comision por Uso de Red");
                        $("#detalles").css("display","inline-block")
                        document.getElementById('tipo').value = "Deposito Binance Pay";
                    });
                }
                }   
                else{
                    Swal.fire({
                                    title: 'Depositos',
                                    text: "Debe Tener un Binance Pay ID Valido Para los Depositar..!",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    });                    
                }             
           
            }

            function selretiro(){
                if($("#como_retiro").val() == "BINANCE"){
                    if(document.getElementById("payid").value.length >0){
                        $.post("block",{
                        getUsuario:"",
                        sesion: true,
                        correo: document.getElementById("correo").value
                        },function(data){
                            var datos= JSON.parse(data);                        
                            //document.getElementById("cantidad_retiro").min = 10;
                            //document.getElementById("cantidad_retiro").value = 0;
                            //$("#info_retiro").html("USDC - Comision de Red");
                            $("#detalles_retiro").css("display","inline-block");
                            document.getElementById('tipo_retiro').value = "Retiro Binance Pay";
                            document.getElementById("cajero_retiro").value = document.getElementById("wallet_binance").value;
                        });
                    }
                    else{
                        Swal.fire({
                                    title: 'Retiros',
                                    text: "Debe Tener un Binance Pay ID Valido Para los retiros..!",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    });
                    }
                }
            }

            function retirar_back(){

                Swal.fire({
                            title: 'Retirar',
                            text: "Estas Seguro de realizar el Retiro de tu cuenta, los retiros tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red. ",
                            icon: 'info',
                            confirmButtonColor: '#EC7063',
                            confirmButtonText: 'Si Retirar',
                            showCancelButton: true,
                            cancelButtonText: "Cancelar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if($("#como_retiro").val() == "BINANCE" && (document.getElementById("cantidad_retiro").value*1) > 0){
                                        if((document.getElementById("tsaldo").value*1) >= (document.getElementById("cantidad_retiro").value*1)){
                                            retirar();
                                        }
                                        else{
                                            Swal.fire({
                                                        title: 'Retiros',
                                                        text: "Saldo USDC Insuficiente",
                                                        icon: 'warning',
                                                        confirmButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ok'
                                                        });
                                        }
                                    }
                                    else{
                                        Swal.fire({
                                                        title: 'Retiros',
                                                        text: "Los retiros debe ser minimo 1 USDC",
                                                        icon: 'warning',
                                                        confirmButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ok'
                                                        });
                                    }                                   
                                }
                                else{
                                    window.location.href="miwallet";
                                }
                            });    
       
            }


            function jugar_back(){
                Swal.fire({
                            title: 'Depositos',
                            text: "Bienvenido Deposito a tu cuenta CriptoSignalGroup, los depositos tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red. ",
                            icon: 'info',
                            confirmButtonColor: '#117A65',
                            confirmButtonText: 'Depositar',
                            cancelButtonColor: '#AEB6BF',
                            showCancelButton: true,
                            cancelButtonText: "Cancelar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if($("#comopago").val() == "BINANCE" && document.getElementById("cantidad").value > 0){
                                        lanzar();
                                    }                
                                    else{
                                        Swal.fire({
                                                        title: 'Depositos',
                                                        text: "Los depositos debe ser al menos 1 USDC, o otro monto",
                                                        icon: 'warning',
                                                        confirmButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ok'
                                                        });                    
                                    }                                  
                                }else{
                                    window.location.href="miwallet";
                                }
                            });            
            }

            function retirar(){
                if(document.getElementById("cantidad_retiro").value.length>0 && document.getElementById("como_retiro").value.length>0){
                    document.getElementById("retirar_btn").disabled = true;
                $.post("block",{
                        retirar:"",                        
                        tipo: document.getElementById("tipo_retiro").value,
                        comopago: document.getElementById("como_retiro").value,
                        wallet: document.getElementById("wallet_binance").value,
                        correo: document.getElementById("correo").value,
                        cajero: document.getElementById("cajero").value,
                        monto: document.getElementById("cantidad_retiro").value,                        
                        recibe: document.getElementById("recibe").value,
                        comision: document.getElementById("comision_retiro").value
                    },function(data){
                        document.getElementById('retirar').close();
                        document.getElementById("retirar_btn").disabled = false;
                        if(data.length>0){
                            document.getElementById("retirar_btn").disabled = false;
                        }
                        window.location.href="historialcliente";
                    });  
                }else{
                    Swal.fire({
                                    title: 'Retirar',
                                    text: "No se puede realizar el retiro o faltan datos",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    });
                }         
            }

            function lanzar(){
                if(document.getElementById("cantidad").value.length>0 && document.getElementById("comopago").value.length>0){
                    document.getElementById("jugar").disabled = true;
                $.post("block",{
                        depositar:"",
                        nota: document.getElementById("wallet_binance").value,
                        cantidad: document.getElementById("cantidad").value,
                        tipo: document.getElementById("tipo").value,
                        comopago: document.getElementById("comopago").value,
                        cajero: document.getElementById("cajero").value,
                        correo: document.getElementById("correo").value
                    },function(data){
                        document.getElementById('jugada').close();
                        document.getElementById("jugar").disabled = false;
                        if(data.length>0){
                            document.getElementById("jugar").disabled = false;
                        }
                        window.location.href="historialcliente";
                    });  
                }else{
                    Swal.fire({
                                    title: 'Depositos',
                                    text: "No se puede realizar el deposito o faltan datos",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    });                    
                }         
            }

            function calculo_retiro(){
                let cantidad = document.getElementById("cantidad_retiro").value *1;
                let comision = 0;
                let porcentaje = 3; 
                let total = 0;

                comision = (cantidad * porcentaje) / 100;
                total = cantidad - comision;
                document.getElementById("recibe").value = Math.round(total * 100) / 100;
                document.getElementById("comision_retiro").value = Math.round(comision * 100) / 100;
                $("#calculo_retiro").html("<li>Retiro por =  "+ cantidad + " USDC</li>"+"<li>Comision de Red "+porcentaje+"% =  "+ Math.round(comision * 100) / 100 + " USDC</li>"+"<li>Usted Recibe =  <b>"+ Math.round(total * 100) / 100 + "</b> USDC</li>");

            }

            function calculo(){
                let cantidad = document.getElementById("cantidad").value *1;
                let comision = 0;
                let porcentaje = 0; 
                let total = 0;

                comision = (cantidad * porcentaje) / 100;
                total = cantidad - comision;
                $("#calculo").html("<li>Deposito =  "+ cantidad + " USDC</li>"+"<li>Comision de Red "+porcentaje+"% =  "+ Math.round(comision * 100) / 100 + " USDC</li>"+"<li>Usted Recibe =  <b>"+ Math.round(total * 100) / 100 + "</b> USDC</li>");
            }
             
             function inicio(){
                leerDatos();
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
                    </div>
                                        
                </div>

                <div id="retiros" class="tab-pane fade">
                    <div class="tab-title">
                        <h3>Retirar Tus Usdc de la Plataforma</h3>
                    </div>
                    <div class="container mt-5 mb-5">
                        <button onclick="document.getElementById('retirar').show();">Retirar</button>
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