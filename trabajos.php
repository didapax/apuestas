<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html> 
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
           dialog {
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

            .dialog-content {
                text-align: center;
            }
        </style>        
        <script>
            let trabajos = [];            

            function ver(id){
                
                const selectedId = id.toString();
                const datos = trabajos.find(p => p.id === selectedId);
                if (datos) {  
                    
                    let monto = datos.monto;
                    let destino = `${datos.tipo} de: <b>${datos.usuariobinance}</b><br>Origen: ${datos.origen}<br>Wallet de Destino: ${datos.destino}`
                    if(datos.tipo == "RETIRO"){
                        monto = datos.recibe;
                        //destino = `Wallet de Destino: ${datos.origen}`
                    }
                    
                    $("#evento").html(datos.tipo);
                    $("#emailCliente").html(datos.cliente);
                    $("#mediopago").html(datos.medio_pago);
                    $("#wallet").html(destino);
                    $("#monto").html((monto *1).toFixed(2)+" "+datos.moneda);
                    $("#estatus").html(datos.estatus);
                    $("#idapuesta").val(datos.ticket);
                          
                    document.getElementById(datos.estatus).selected = true;
                    document.getElementById('modalOverlay').show();
                }

            }

            function borrar(id){
                var r = confirm("Estas Seguro de Cancelar la Apuesta.?");
                if (r == true) {
                    $.post("block",{
                        cancelar: id
                    },function(data){
                        //leerTrabajos();
                        window.location.href="trabajos";
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }

            function tomar(id){
                    $.post("block",{
                        tomar: id,
                        correo: document.getElementById("correo").value
                    },function(data){
                        //leerTrabajos();
                        window.location.href="trabajos";
                    });
            }        
            

            function enviar(){ 
                Swal.fire({
                                        title: 'Promocion',
                                        text: `Estas seguro de cambiar es estatus de la orden?`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Cambiar Estatus',
                                        showCancelButton: true,
                                        cancelButtonText: "No Estoy Seguro"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                setEstatus: document.getElementById("selestatus").value,
                                                idapuesta: document.getElementById("idapuesta").value
                                            },function(data){
                                                //leerTrabajos();
                                                document.getElementById('modalOverlay').close();
                                                window.location.href="trabajos";
                                            });
                                            }
                                            else{
                                                document.getElementById('modalOverlay').close();
                                            }
                                        });
            }


            function leerTrabajos(){
                recuperarTrabajos();
            } 

            function recuperarTrabajos() {
                fetch("block?readTrabajos=1&correo="+document.getElementById('correo').value)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        trabajos = data;  
                        
                        mostrarTablaTrabajos();
                        //new DataTable('#example');
                        $('#example').DataTable({
                            responsive: true,
                            paging: true,
                            searching: true
                        });
                        // Aquí puedes procesar los datos recibidos (data)
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });
    
            }

            function mostrarTablaTrabajos() {
                const tablaCuerpo = document.getElementById("tabla-cuerpo-depositos");
                tablaCuerpo.innerHTML = "";

                trabajos.forEach((producto, index) => {
                    let monto = producto.monto;
                    let color_estatus="#FAD7A0";

                    if(producto.tipo == "RETIRO"){
                        monto= producto.recibe;
                    }

                    switch (producto.estatus) {
                        case 'REVISION':
                            color_estatus="#4caf50";
                            break;
                            case 'ESPERA':
                                color_estatus="#2196f3";
                                break;        

                            case 'EXITOSO':
                                color_estatus="#ff9800";
                                break;        
                        default:
                            color_estatus="#FAD7A0";
                            break;
                    }                 
                    const fila = document.createElement("tr");
                    fila.innerHTML = `
                        <td>${producto.tipo}</td>
                        <td>${producto.cliente}</td>
                        <td>${producto.medio_pago}</td>
                        <td>${Math.round(monto * 100) / 100} ${producto.moneda}</td>
                        <td style='background:${color_estatus}'>${producto.estatus}</td>
                        <td>
                            <!--<button type='button' onclick='borrar(${producto.id})' >Delete</button>-->                            
                            <button type='button' class='add-button' onclick='ver(${producto.id})' >Detalles</button>
                            <a  class='add-button' style='background:#ede0af;' href='chatAdmin?ticket=${producto.ticket}'>Chat<sup style='color:red; font-weight: bold;'>${producto.notif}</sup></a>                            
                        </td>
                    `;
                    tablaCuerpo.appendChild(fila);
                });
            }              

            function inicio(){
                leerTrabajos();
                //myVar = setInterval(leerTrabajos, 3000);
            }
            
        </script>
    <body onload="inicio()" id="top">
    <?php $page = "trabajos"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section> 
        <section class="hero hero-inside" >
        <div id="cuerpo" class="cuerpo" >
            <!--<div class="menu" id="menu">
                <label style="margin-left:1px; font-weight:bold;" id="estad"></label>
                <label style="margin-left:13px; font-weight:bold;" id="reg"></label>
            </div> -->
        <dialog id="modalOverlay">
                <span id="closeModalBtn" class="close-btn" style="color:black;" onclick="document.getElementById('modalOverlay').close();">X</span>
                <h2><span id="evento"></span></h2>
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" id="idapuesta">
                Transaccion: <br>
                Cliente: <span id="emailCliente"></span><br>
                Medio de Pago: <span id="mediopago"></span><br>
                <span style='background:yellow;' id="wallet"></span>
                <br>
                Monto: <span id="monto"></span><br>
                Estatus:<span id="estatus"></span><br>
                Cambiar: <select id="selestatus" >
                    <option id="">selecciona estatus...</option>
                    <option id="REVISION" value="REVISION">En Revision</option>
                    <option id="ESPERA" value="ESPERA">En Espera</option>
                    <option id="EXITOSO" value="EXITOSO">Exitoso</option>
                    <option id="FALLIDO" value="FALLIDO">Fallido</option> 
                </select><br><br>
                <button class='add-button' style="float:right;" type="button" id="btnenviar" onclick="enviar()">Cambiar Estatus</button>
        </dialog>
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
            <div class="vista" id="vista">
                    <table id='example' class='ui celled table' style='width:100%; '> 
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <th>Medio</th>
                                <th>Monto</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-cuerpo-depositos">
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

<?php
}
else{
    header("Location: index.php");
}
?>