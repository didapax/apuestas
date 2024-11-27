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
            .dialog-add {
                position: fixed;
                top: 49%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: gray;   
                width: 350px; 
                height: 450px;
                overflow-y: hidden;                   
                z-index: 1000;
                border: solid 1px gray;            
            }         
        </style>        
        <script>
            let monedas = [];

            function recuperarMonedas() {
                fetch("block?listMonedas=")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        monedas = data;    
                        mostrarTablaMonedas();
                        new DataTable('#example');
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });
                
                }

                function mostrarTablaMonedas() {
                    const tablaCuerpo = document.getElementById("tabla-cuerpo-monedas");
                    tablaCuerpo.innerHTML = "";

                    monedas.forEach((producto, index) => {
                        const fila = document.createElement("tr");
                        fila.innerHTML = `
                            <td>${producto.MONEDA}</td>
                            <td>${producto.BALANCE}</td>
                            <td>${producto.PRECIO}</td>
                            <td>${producto.ACCIONES}</td>
                            <td>
                            <button class="retire-button" type="button" onclick="borrar('${producto.MONEDA}')">Borrar</button>
                            <button class="retire-button" style="background:none;border:1px solid white;margin-top:5px;" type="button" onclick="editar('${producto.MONEDA}')">Edit</button>
                            </td>
                        `;
                        tablaCuerpo.appendChild(fila);
                    });
                }

function clickEditar(){
    document.getElementById("btneditar").disabled = true;
                moneda = document.getElementById("editMoneda");
                asset = document.getElementById("editAsset");

                if (moneda.value.length > 0 && asset.value.length > 0) {
                $.post("block",{
                    editpar:"",
                    moneda: moneda.value.toUpperCase(),
                    asset: asset.value.toUpperCase(),
                    precio: document.getElementById("editPrecio").value,
                    balance: document.getElementById("editBalance").value,
                    acciones: document.getElementById("editAcciones").value
                },function(data){
                    leerVista();
                    document.getElementById("btneditar").disabled = false;
                    document.getElementById('modalEdit').close();
                });
                }
                else{
                    Swal.fire({
                                            title: 'Criptomonedas',
                                            text: "Dede colocar una Moneda Par valida",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });  
                }
}

function editar(moneda){
    const ficha = monedas.find(key => key.MONEDA === moneda);

    if (ficha) {
        document.getElementById("editMoneda").value = ficha.MONEDA;
        document.getElementById("editAsset").value = ficha.ASSET;
        document.getElementById("editPrecio").value = ficha.PRECIO;
        document.getElementById("editBalance").value = ficha.BALANCE;
        document.getElementById("editAcciones").value = ficha.ACCIONES;
        document.getElementById('modalEdit').show();
    }
}

           function crear(){
                document.getElementById("btncrear").disabled = true;
                moneda = document.getElementById("moneda");
                asset = document.getElementById("asset");

                if (moneda.value.length > 0 && asset.value.length > 0) {
                $.post("block",{
                    addpar:"",
                    moneda: moneda.value.toUpperCase(),
                    asset: asset.value.toUpperCase(),
                    precio: document.getElementById("precio").value,
                    balance: document.getElementById("balance").value,
                    acciones: document.getElementById("acciones").value
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('modalOverlay').close();
                });
                }
                else{
                    Swal.fire({
                                            title: 'Criptomonedas',
                                            text: "Dede colocar una Moneda Par valida",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });  
                }
            }

            function borrar(codigo){
                Swal.fire({
                                        title: 'Criptomonedas',
                                        text: `Estas Seguro de Eliminar la Criptomoneda ${codigo}, se borrarn los registros de precios y calculostambien..?`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "No Todavia No"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    deletepar: codigo
                                                },function(data){
                                                    leerVista();
                                                });  
                                            }
                                        });  
            }      

            function leerVista(){
                recuperarMonedas();         
            }
            

            function inicio(){                
                leerVista();
            }

            function showDialog(){
                document.getElementById('modalOverlay').show();
            }            
        </script>

    <body onload="inicio()">
    <?php $page = "criptos"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>

        <section class="hero hero-inside" >
        <div id="cuerpo" class="cuerpo">
        <div class="menu" id="menu">
            <button type="button" class="add-button" onclick="showDialog()">Incluir Cripto +</button>
        </div>
        <dialog id="modalOverlay" class="dialog-add">
            <div style="color:black;font-weight:300;">
                <span id="closeModalBtn" class="close-btn" onclick="document.getElementById('modalOverlay').close()">X</span>
                <h2>Agregar Criptomoneda</h2>
                Moneda Par <br><input style="width:300px;" title="Par Existente en Binance: BTCUSDT, HNTBUSD" type="text" maxlength="10" id="moneda" value=""><br>
                Asset <br><input style="width:120px;" title="Abreviacion de la Moneda: HNT, BNB, BTC" type="text" maxlength="10" id="asset" value=""><br>
                Precio <br><input style="width:120px;" title="" type="number" id="precio" value="0"><br>
                Balance <br><input style="width:120px;" title="" type="number" id="balance" value="0"><br>
                Numero Acciones <br><input style="width:120px;" title="" type="number" id="acciones" value="0"><br>
                <button class='deposit-button' style="margin-top: 15px;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </div>
        </dialog>
        <dialog id="modalEdit" class="dialog-add">
            <div style="color:black;font-weight:300;">
                <span id="closeModalBtn" class="close-btn" onclick="document.getElementById('modalEdit').close()">X</span>
                <h2>Editar</h2>
                Moneda Par <br><input readonly style="width:300px;" title="Par Existente en Binance: BTCUSDT, HNTBUSD" type="text" maxlength="10" id="editMoneda" value=""><br>
                Asset <br><input readonly style="width:120px;" title="Abreviacion de la Moneda: HNT, BNB, BTC" type="text" maxlength="10" id="editAsset" value=""><br>
                Precio <br><input style="width:120px;" title="" type="number" id="editPrecio" value="0"><br>
                Balance <br><input style="width:120px;" title="" type="number" id="editBalance" value="0"><br>
                Numero Acciones <br><input style="width:120px;" title="" type="number" id="editAcciones" value="0"><br>
                <button class='deposit-button' style="margin-top: 15px;" type="button" id="btneditar" onclick="clickEditar()">Save</button>
            </div>
        </dialog>        
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div class="vista" id="vista">
        <table id='example' class='ui celled table' style='width:100%; '> 
                                    <thead>
                                        <tr>
                                            <th>Moneda</th>
                                            <th>Balance</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-monedas">
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