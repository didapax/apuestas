<?php
include "modulo.php";
if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1) {
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
    </head> 
        <style>

            @media screen and (min-width: 385px) {
            body {
                width: 100%;
            }
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
            }

            .dialog-content p{
                color: black;
            }
        </style>
        <script>
            let tabla = [];
            let tarjetas = [];

            function leerHistorial() {
                recuperarTabla();
                recuperarTarjetas();
            }

            function inicio() {
                leerHistorial();
                //myVar = setInterval(leerHistorial, 3000);
            }


            function recuperarTabla() {
                fetch("block?readHistorialAdmin=&cliente=" + document.getElementById('correo').value)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        tabla = data;

                        mostrarTabla();
                        //new DataTable('#example');
                        $('#example').DataTable({
                            responsive: true,
                            paging: true,
                            searching: true

                        });
                        // Aquí puedes procesar los datos recibidos (data)
                        console.log("Datos retiros:", data);
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });

            }

            function mostrarTabla() {
                const tablaCuerpo = document.getElementById("tabla-cuerpo");
                tablaCuerpo.innerHTML = "";

                tabla.forEach((producto, index) => {
                    const fila = document.createElement("tr");
                    fila.innerHTML = `
                            <td>${producto.suscripcion}</td>
                            <td>${Math.round(producto.monto * 100) / 100} USDC</td>
                            <td>${Math.round(producto.intereses * 100) / 100} USDC</td>
                            <td>${producto.cliente} <button class='table-button' onclick="mostrarInfo(${index})">Info</button></td>
                            <td style='background:${producto.color};'>${producto.estatus}</td>                        
                        `;
                    tablaCuerpo.appendChild(fila);
                });
            }

            function mostrarInfo(index) {
                const producto = tabla[index];
                const dialog = document.getElementById("info-dialog");
                dialog.querySelector(".dialog-content").innerHTML = `
                    <p>Tarjeta <b>${producto.tipo}</b></p>
                    <p>Finaliza el <b>${producto.fin}</b> le quedan ${producto.dias} días</p>
                    <p>Usuario Binance: <b>${producto.usuariobinance}</b></p>
                    <p>Wallet Binance: <b>${producto.binance}</b></p>
                    <p>Wallet Bep20: <b>${producto.bep20}</b></p>
                    `;
                dialog.showModal();
            }

            function dibujaTarjeta(acciones, imagen, titulo, texto, mensaje, costo, estrellas) {
                let dibujo = `
        <div class="cover" >
            <div class="content">
                <div class="back-image-front" style="background: url('Assets/${imagen}') no-repeat center/cover;">
                    <div class='glow'>
                        <section class='upper-side'> 
                            <section class='left-side'>
                                <div class='header-container'>
                                    <div class='chip-container'>
                                        <img class='chip' style='width:4.5rem;' src='Assets/vainitas.png'>
                                    </div>
                                    <div class='title-container'>
                                        <h2>${titulo}</h2>
                                    </div>
                                </div>
                                <div class='text-container'>
                                    <p>${texto.slice(0, 130)}</p>
                                </div>
                            </section>
                            <section class='right-side'>
                            ${acciones}
                            </section>
                        </section>   
                        <section class='lower-side'>
                            <div class='cost-container'>
                                <p>COSTO:</p> 
                                <div class='cost'>
                                    <p style='font-size: 2rem;'>${costo}<p> <p style='font-size:1.2rem;'>USDC<p>
                                </div>
                            </div>
                        
                            <div class='star-container'> 
                                <div class='stars'> ${estrellas} </div> 	<div class='message'> ${mensaje} </div>
                            </div>
                        </section>
                    </div>							             
                </div>
                <div class="back-image-back" style="overflow-y: auto;overflow-x: hidden;background: url('Assets/${imagen}') no-repeat center/cover; display:flex;align-items: center;justify-content: center;">
                ${acciones}
                    <div class='text-container' style="overflow-y: auto;overflow-x: hidden; height: 200px;">
                        <p>${texto}</p>
                    </div>
                </div>
            </div>
        </div>`;
                return dibujo;
            }

            function mostrarTarjetas() {
                const caja = document.getElementById("outerCard");
                caja.innerHTML = '';
                tarjetas.forEach((tarjeta) => {
                    let acciones;
                    let texto = tarjeta.analisis;
                    let mensaje = "Suscripcion Abierta";
                    let costo = tarjeta.costo;
                    let estrellas = dibujarEstrellas(tarjeta.estrellas);
                    if (tarjeta.activo) {
                        acciones = "";
                        mensaje = "Suscripcion Activa";
                    }
                    else {
                        acciones = `<button style='float: right;color:black;border:solid 1px black;border-radius:5px;' onclick="renovar('${tarjeta.id}')">Renovar</button>
                          <button style='background:coral;float: right;color:black;border:solid 1px black;border-radius:5px;' onclick="eliminar('${tarjeta.id}')">Eliminar</button>`;
                        mensaje = "Suscripcion Suspendida";
                    }
                    caja.innerHTML += dibujaTarjeta(acciones, tarjeta.imagen, tarjeta.titulo, texto, mensaje, costo, estrellas);
                });
            }


            function recuperarTarjetas() {
                fetch("block?getSuscripciones=&correo=" + document.getElementById('correo').value)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        tarjetas = data;
                        mostrarTarjetas();
                        // Aquí puedes procesar los datos recibidos (data)
                        console.log("Datos Historial:", data);
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });

            }

            function dibujarEstrellas(n) {
                var estrellas = '';
                for (var i = 0; i < n; i++) {
                    estrellas += '★';
                }
                return estrellas;
            }

        </script>

    <body onload="inicio()" id="top">


        <?php $page = "histadmin"; ?>
        <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>
        <section class="hero hero-inside" >
            <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo"
                id="correo">
            <div id="cuerpo" class="cuerpo">
                <dialog id="info-dialog">
                    <div class="dialog-content"></div><br>
                    <button class="add-button" onclick="document.getElementById('info-dialog').close()">Cerrar</button>
                </dialog> 
                <div id="outerCard" class='outerCard-container' style="background:none;"></div>
                <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
                    <div class="vista" id="vista">
                        Client's Subscriptions
                        <hr>
                        <table id='example' class='ui celled table' style='width:100%;'>
                            <thead style="background: #31708f;">
                                <tr>
                                    <th>Suscripcion</th>
                                    <th>Monto</th>
                                    <th>Paga Mensual</th>
                                    <th>Cliente</th>
                                    <th>Estatus</th>
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
            <?php include 'footer.php'; ?>
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
} else {
    header("Location: index.php");
}
?>