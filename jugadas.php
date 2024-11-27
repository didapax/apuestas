<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>

<head>
        <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">        
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
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />        
    </head> 
        <style>

.dataTables_wrapper .dataTables_sort_icon {
    display: none;
}

          .textAreaContainer{
            background:#363e4a;
            color: white;
         }
         textarea{
            background:#363e4a;
            color:white;
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
         

input[type="text"] {
margin: 5px;
border-radius: 3px;
border: 0;
outline: 0;
padding: 2px;
width: 80px;
text-transform: uppercase;
}

input[type="checkbox"] {
  margin: 5px;
  border-radius: 3px;
  border: 0;
  padding: 3px;
  text-transform: uppercase;
}

         .dialog_crear{
            position: fixed;
                top: 49%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: white;   
                width: 80%;   
                height: 88%;
                overflow-y: auto;                             
                z-index: 1000;
                border: solid 1px gray;            
        }   

        .regalo-dialog{
            position: fixed;
            top: 49%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: black;
            color:white;
            width: 320px; 
            height: 250px;            
            z-index: 1000000;
            border: solid 1px gray;
        }
        dialog {
                position: fixed;
                top: 49%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: black;
                color:white;
                width: 80%; 
                height: 88%;
                overflow-y: auto;                   
                z-index: 1000000;
                border: solid 1px gray;            
            }

            dialog h2,h3{
                font-size: 1rem;
                color:white;
            }

            .dialog-content {
                text-align: center;
            }

            .dialog-content p{
                color: white;
            }

            .trumbowyg-modal {
                z-index: 1000050 !important; /* Ajusta este valor según sea necesario */
            }

            .trumbowyg-editor, .trumbowyg-textarea {
            background: #363e4a;
            color: white;
            }            
        </style>        
        <script>
            let orderFavorito = 0;
            let orderAdelantado = 0;
            let devuelveCapital = 0;            

            function calcularInteresMensual(capital, tasaInteresAnual, meses) {
                // Convertir la tasa de interés anual a mensual
                let tasaInteresMensual = tasaInteresAnual / 12 / 100;

                let cuotaMensual, interesMensual;

                // Si la tasa de interés es cero, la cuota mensual es simplemente el capital dividido por el número de meses
                if (tasaInteresMensual === 0) {
                    cuotaMensual = capital / meses;
                    interesMensual = 0;
                } else {
                    // Calcular el interés mensual
                    interesMensual = capital * tasaInteresMensual;

                    // Calcular la cuota mensual
                    cuotaMensual = capital * tasaInteresMensual / (1 - Math.pow(1 + tasaInteresMensual, -meses));
                }

                return {
                    interesMensual: interesMensual,
                    cuotaMensual: cuotaMensual
                };
            }

            function calcular() {
                let capital = document.getElementById("monto").value;
                let interes = document.getElementById("porciento").value;
                let tipo = document.getElementById("tipoJuego").value;
                let numMes;

                switch (tipo) {
                    case 'MENSUAL':
                        numMes = 1;
                        break;
                    case 'TRIMESTRAL':
                        numMes = 3;
                        break;
                    case 'SEMESTRAL':
                        numMes = 6;
                        break;
                    case 'ANUAL':
                        numMes = 12;
                        break;
                    default:
                        numMes = 1;
                        break;
                }

                if(capital *1 > 0 ){
                    let resultados = calcularInteresMensual(capital, interes, numMes);
                    $("#calculos").html(`Interes Mensuales: ${(Math.round(resultados['interesMensual'] * 100) / 100)}<br>
                    Cuota Mensual de: ${(Math.round(resultados['cuotaMensual'] * 100) / 100)}`);
                }
                else{
                    document.getElementById("monto").focus();                    
                }
            }

            function crear(){
                let titulo = document.getElementById("nombre").value;

                document.getElementById('modalOverlay').close();
                
                if(document.getElementById('adelantado').checked){
                    orderAdelantado = 1;
                }

                if(document.getElementById('devuelve_capital').checked){
                    devuelveCapital = 1;
                }

                document.getElementById("btncrear").disabled = true;
                if(titulo){

                    Swal.fire({
                                        title: 'Suscripciones',
                                        text: `Estas Seguro de Crear esta Tarjeta en el Sistema`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Crear',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                crear: "",
                                                cajero: document.getElementById("correo").value,
                                                nombre: document.getElementById("nombre").value,
                                                descripcion: document.getElementById("summernote").value,
                                                max: document.getElementById("max").value,
                                                rate: document.getElementById("rate").value,
                                                favorito: orderFavorito,
                                                tipo: document.getElementById("tipoJuego").value,
                                                monto: document.getElementById("monto").value,
                                                porciento: document.getElementById("porciento").value,
                                                poradelantado: orderAdelantado,
                                                devuelveCapital: devuelveCapital,
                                                imagen: document.getElementById("imagen").value,
                                                foreground: document.getElementById("foreground").value,
                                                selectTipo: document.getElementById("selectTipo").value,
                                                variableInversion: document.getElementById("variableInversion").value
                                            },function(data){
                                                //leerVista();
                                                document.getElementById("btncrear").disabled = false;                                                
                                                window.location.href="jugadas";
                                            });
                                            }
                                        });                  
                }
                else{
                    Swal.fire({
                                        title: 'Producto',
                                        text: `No se pudo crear la  Tarjeta en el Sistema`,
                                        icon: 'error',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'ok',
                                        });
                }
            }

            function borrar(id){
                Swal.fire({
                                        title: 'Productos',
                                        text: `Estas Seguro de Eliminar la Suscripcion del Sistema`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    borrar: id
                                                },function(data){
                                                    //leerVista();
                                                    window.location.href="jugadas";
                                                });  
                                            }
                                        });  
            }

            function cerrar(id){
                    $.post("block",{
                        cerrar: id
                    },function(data){
                        //leerVista();
                        window.location.href="jugadas";
                    });
            }      
            
            function setAnalis(){ 
                $.post("block",{
                        setAnalis: document.getElementById('idAnalisis').value,
                        analisis: document.getElementById('summerNoteAnalisis').value
                    },function(data){
                        document.getElementById('modalOverlay2').close();
                        //leerVista();
                        window.location.href="jugadas";
                    });
            }
            
            function leerVista(){
                $.get("block?readJuegos=", function(data){
                    $("#tabla-cuerpo").html(data);
                    //new DataTable('#example');
                    $('#example').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true
                    });

                });
            }

            function inicio(){
                leerVista();
            }

            function showDialog(){
                $("#groupTipoJuego").css("display","none");
                $("#groupCosto").css("display","none");
                $("#groupInversion").css("display","none");
                $("#groupETF").css("display","none");                   
                document.getElementById('modalOverlay').show();
            }

            function analisis(id){    
                document.getElementById('idAnalisis').value = id;
                $.get("block?datosJuego=&idjuego="+id, function(data){
                    var datos= JSON.parse(data);                    
                    $("#nameAnalisis").html(datos.juego);
                    $("#analisisDescripcion").html(datos.descripcion);
                    $('#summerNoteAnalisis').trumbowyg('html', datos.analisis);
                });
                document.getElementById('modalOverlay2').show();
            }

            function pagaIntereses(){                
                if(document.getElementById('paga_intereses').checked){
                    $("#zona_intereses").css("display","block");
                }
                else{
                    document.getElementById('porciento').value=0;
                    $("#zona_intereses").css("display","none");                    
                }                
            }

            function ifAdelantado(){
                if(document.getElementById('adelantado').checked){
                    document.getElementById('devuelve_capital').checked = true;
                }
                else{
                    document.getElementById('devuelve_capital').checked = false;
                }
            }

            function enviar_regalo(id){
                const dialog = document.getElementById("info-dialog");
                dialog.querySelector(".dialog-content").innerHTML = `
                <p>Correo Cliente: <input type="email" id="enviar_correo" ></p>
                <p><button type="button" onclick="regalar(${id})" class="binance-button">Regalar</button></p>
                `;
                dialog.show();
            }

            function regalar(id){
                const correo = document.getElementById("enviar_correo");
                const dialog = document.getElementById("info-dialog");
                if(correo.value){
                    Swal.fire({
                        title: 'Cryptosignal',
                        text: `Estas Seguro de Enviar una Tarjeta de Regalo a  ${correo.value}`,
                        icon: 'warning',
                        confirmButtonColor: '#EC7063',
                        confirmButtonText: 'Si Enviar',
                        showCancelButton: true,
                        cancelButtonText: "No Espera"
                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    verifiUser: true,
                                                    correo: correo.value
                                                },function(data){
                                                    var datos= JSON.parse(data);
                                                    if(datos.exist){
                                                        $.post("block",{
                                                        jugar:"",
                                                        idjuego: id,
                                                        correo: correo.value
                                                        },function(data){
                                                        dialog.close();
                                                        Swal.fire({
                                                            title: 'Crytosignal',
                                                            text: `Tarjeta de regalo enviada al destinatario ${correo.value}`,
                                                            icon: 'info',
                                                            confirmButtonColor: '#EC7063',
                                                            confirmButtonText: 'Ok',
                                                            });
                                                        });
                                                    }else{
                                                        Swal.fire({
                                                            title: 'Crytosignal',
                                                            text: `El correo ${correo.value} no existe en el sistema`,
                                                            icon: 'warning',
                                                            confirmButtonColor: '#EC7063',
                                                            confirmButtonText: 'Ok',
                                                        });
                                                    }
                                                    
                                                });  
                                            }
                                        });
                }
                else{
                    Swal.fire({
                        title: 'Crytosignal',
                        text: "Alerta! Correo No Valido o esta vacio..",
                        icon: 'warning',
                        confirmButtonColor: '#EC7063',
                        confirmButtonText: 'Ok',
                    });
                }
            }

            function clickSelectTipo(){
                const tipo = document.getElementById("selectTipo");                
                const valueTipo = tipo.value;
                if(valueTipo){
                    switch (valueTipo) {
                        case "INVERSION":
                            $("#groupInversion").css("display","block");
                            $("#groupTipoJuego").css("display","block");
                            $("#groupCosto").css("display","block");
                            orderFavorito = 0;
                            break;
                        case "REGALO":
                            $("#groupInversion").css("display","block");
                            $("#groupTipoJuego").css("display","block");
                            $("#groupCosto").css("display","block");
                            orderFavorito = 1;
                            break;
                        case "ETF":
                            $("#groupETF").css("display","block");
                            $("#groupTipoJuego").css("display","none");
                            $("#groupCosto").css("display","none");
                            $("#groupInversion").css("display","none");
                            orderFavorito = 0;
                            orderAdelantado = 0;
                            devuelveCapital = 0;                            
                            break;                            
                        default:
                        $("#groupTipoJuego").css("display","block");
                        $("#groupCosto").css("display","block");
                        $("#groupInversion").css("display","none");
                        $("#groupETF").css("display","none");                        
                        orderFavorito = 0;
                        orderAdelantado = 0;
                        devuelveCapital = 0;
                        break;
                    }

                }
            }
        </script>
    <body onload="inicio()" id="top">
    <?php $page = "jugadas"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>
        <section class="hero hero-inside" >
        <div id="cuerpo" class="cuerpo">
        <dialog id="info-dialog" class="regalo-dialog">
            <div style="display:grid;">
            <div class="dialog-content"></div>
            <button class="add-button" style="background:none; border:1px solid white;" onclick="document.getElementById('info-dialog').close()">Cerrar</button>            
            </div>
        </dialog>        
        <input type="hidden" value="<?php if(isset($_SESSION['user'])) echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
        <input type="hidden"  id="idAnalisis">
        <div class="button-menu" id="menu">
            <button class='add-button' type="button" onclick="showDialog()">Agregar +</button>
        </div>

        <dialog id="modalOverlay" class="dialog-crear">
        <span id="closeModalBtn" class="close-btn" onclick="document.getElementById('modalOverlay').close();">X</span>
                <h2 style="font-size:2rem;">Agregar Tarjeta</h2>                           
                    <div >
                        <h3>Tipo: </h3>
                        <div style='display: flex;gap: 1rem;'>
                            <select id="selectTipo" onchange="clickSelectTipo()"> 
                                <option value=''>Seleccione...</option>
                                <option value='INVERSION'>Inversion</option>
                                <option value='SUSCRIPCION'>Suscripcion</option>
                                <option value='REGALO'>Regalo</option>
                                <option value='ETF'>ETF Fondo</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <h3>Titulo:</h3> 
                        <input type="text" id="nombre" style="width: 80%;">
                    </div>                                       
                    <div id="groupTipoJuego">
                        <h3>Periodo:</h3> 

                        <select id="tipoJuego" >
                            <option value="INDEFINIDA">Duracion..</option>
                            <option value="MENSUAL">Mensual</option>
                            <option value="TRIMESTRAL">Trimestral</option>
                            <option value="SEMESTRAL">Semestral</option>
                            <option value="ANUAL">ANUAL</option>
                        </select>
                    </div>
                    
                    <div >
                        <h3>Color de Fondo:</h3> 
                        <select id="imagen" >
                            <option value="azul.png">Color de Fondo..</option>
                            <option value="amarillo.png">Dorado</option>
                            <option value="azul.png">Azul</option>
                            <option value="azul_oscuro.png">Azul Oscuro</option>
                            <option value="verde.png">Verde</option>                    
                            <option value="naranja.png">Naranja</option>                    
                            <option value="rojo.png">Rojo</option>
                            <option value="plateado.png">Plata</option>
                            <option value="bitcoin.png">Bitcoin</option>
                            <option value="ether.png">Etherer</option>
                        </select>
                    </div>
                    
                    <div >
                        <h3>Color de Letra:</h3> 
                        <select id="foreground" >
                            <option value="white">Color de Letra..</option>
                            <option value="yellow">Amarillo</option>
                            <option value="blue">Azul</option>
                            <option value="red">Rojo</option>
                            <option value="white">Blanco</option>
                            <option value="black">Negro</option>
                            <option value="green">Verde</option>
                        </select>   
                    </div>
    
                    <div id="groupCosto">
                        <h3>Costo:</h3> 
                        <input required type="number" id="monto" value="0" style="color:black;" step="1"><span style='color:green;'>Usdc</span>
                    </div>

                    <div id="groupETF" style="display: none;">
                        <div>
                            <h3>Variable Inversion:</h3> 
                            <select id="variableInversion">
                                <option value=''>Seleccione...</option>
                                <option value="__FBTC__">Fondo Bitcoin</option>
                                <option value="__FETH__">Fondo Ether</option>
                            </select>
                        </div> 
                    </div>

                    <div id="groupInversion" style="display: none;">
                            <h3>Paga Intereses: </h3>
                        <div >   
                            Si:   <input title="Paga Intereses.." type="checkbox" value="1" id="paga_intereses" onchange="pagaIntereses()">              
                        </div>

                        <div id="zona_intereses" style="display:none;">
                            <div style='display: flex;align-items: flex-start;'>   
                                Paga intereses Por Adelantado: <input title="se paga por Adelantado" type="checkbox" value="1" id="adelantado" onchange="ifAdelantado()"><br>
                            </div>
                            <div style='display: flex;align-items: flex-start;'>   
                                Devuelve Capital: <input title="Devuelve el capital.." type="checkbox" value="1" id="devuelve_capital" >  <br>                    
                            </div>
                        <div >
                            <h3>Interes Anual:</h3> 
                            <input required type="number" id="porciento" onchange="calcular()" onkeyup="calcular()" value="0" style="color:black;"  step="1"> % <br>                        </div>
                            <div id="calculos" style="color:black; background:white;"></div>
                        </div>
                    </div> 

                    <div >
                        <h3>Descripcion:</h3> 
                        <textarea  id="summernote"></textarea>
                    </div>

                    <div >
                        <h3>Cantidad de Tarjetas a la Venta:</h3> 
                        <input type="number" id="max" value="1000">
                    </div>

                    <div >
                        <h3>Estrellas:</h3> 
                        <input type="number" id="rate" min="0" max="5" value="0">
                    </div>

                    <div style='display: flex;align-self: end;align-items: center;justify-content: center;'>
                        <button style='margin-bottom:2rem;' class='add-button' type="button" id="btncrear" onclick="crear()">Agregar</button>
                    </div>
        </dialog>

        <dialog id="modalOverlay2">
            <span id="closeModalBtn" class="close-btn" onclick="document.getElementById('modalOverlay2').close();">X</span>
                <h2>Analisis Tecnico</h2>
                <div id="nameAnalisis"></div>
                <div id="analisisDescripcion"></div>
                
                <textarea  id="summerNoteAnalisis"></textarea>

                <button class='add-button' style="float:right;" type="button" id="btncrear" onclick="setAnalis()">Enviar Analisis</button>
        </dialog>
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div class="vista" id="vista">
        <table id='example' class="ui celled table" style='width:100%; '> 
                        <thead>
                            <tr>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-cuerpo">
                        </tbody>
                    </table>        
        </div>
        </div>
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
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js"></script>
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
            $('#summerNoteAnalisis').trumbowyg();
            //$('#example').addClass('ui celled table');
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