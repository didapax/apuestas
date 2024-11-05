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
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: white;   
                width: 80%; 
                z-index: 1000;
                border: solid 1px gray;            
            }

            .dialog-content {
                text-align: center;
            }
        </style>        
        <script>
            function crear(){
                document.getElementById("btncrear").disabled = true;
                let difusion = 0;
                let flotante = 0;

                if(document.getElementById('difu').checked === true){
                    difusion = 1;
                }
                if(document.getElementById('difuFlotante').checked === true){
                    flotante = 1;
                }                                                

                $.post("block",{
                    crearPromo: "",
                    nombre: document.getElementById("nombre").value,
                    mensaje:document.getElementById("summernote").value,
                    promoDifu: difusion,
                    promoFlotante: flotante
                },function(data){
                    //leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('modalOverlay').close();
                    window.location.href="promo";
                });
            }

            function borrar(codigo){
                Swal.fire({
                                        title: 'Promocion',
                                        text: `Estas Seguro de Eliminar la Promocion del Sistema`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    borrarPromo: codigo
                                                },function(data){
                                                    //leerVista();
                                                    window.location.href="promo";
                                                });  
                                            }
                                        });  
            }      

            function leerVista(){
                
                $.get("block?readPromos=", 
                function(data){
                    $("#tabla-cuerpo").html(data);
                    //new DataTable('#example');
                    $('#example').DataTable({                        
                        responsive: true,
                        paging: true,
                        searching: true
                    });
                });

            }

            function reset(){
                $.post("block",{
                    resetlista: ""
                    },function(data){
                        /*leerVista();*/
                        window.location.href="promo";
                    });                               
            }   
            
            function difundir(){
                $.post("block",{
                    sendlista: ""
                    },function(data){
                        leerVista();
                        Swal.fire({
                                    title: 'Difucion',
                                    text: "Los Correos con la promocion han sido Enviados..",
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Continuar'
                                    }); 
                    });                               
            }              

            function inicio(){                
                leerVista();
            }

            function showDialog(){
                document.getElementById('modalOverlay').show();
            }            
        </script>

    <body onload="inicio()" id="top">
    <?php $page = "promo"; ?>
        <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section> 
        <section class="hero hero-inside" >
        <div id="cuerpo" class="cuerpo" >
        <div class="menu" id="menu">
            <button class='add-button' type="button" onclick="showDialog()">Crear Promocion +</button>
            <button style="display:none;margin-left:21px;" id="btn_difundir" type="button" onclick="difundir()">Difundir Promocion</button>
            <button style="display:none;margin-left:21px; background:#E9B2B2; display:none;" id="btn_reset" type="button" onclick="reset()">Reset Promocion</button>
        </div>
        <dialog id="modalOverlay" >
        <span id="closeModalBtn" class="close-btn" style="color:black;" onclick="document.getElementById('modalOverlay').close();">X</span>
                <h2>Agregar una Promocion</h2>
                Titulo: <input type="text" id="nombre"><br>
                Detalle:<br>
                <textarea id="summernote"></textarea><br>
                <label for="difuFlotante">Flotante </label><input type="radio" id="difuFlotante" name="idpromo">
                <label for="difu"> Difusion </label><input type="radio" id="difu" name="idpromo"><br><br>
                <button style='margin-bottom:2rem;' class='add-button'  style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>

        </dialog>
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div class="vista" id="vista">
                    <table id='example' class='ui celled table' style='width:100%; '> 
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Texto</th>
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