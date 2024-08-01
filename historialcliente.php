<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){
?>
<html>
    <head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />           
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
    </head>
    <header>
        <style>
        </style>        
        <script>

            function leerHistorial(){
                $.get("block?getSuscripciones=&correo="+document.getElementById('correo').value, function(data){
                $("#vista").html(data);
                });
            } 

            function inicio(){
                leerHistorial();
                /*myVar = setInterval(leerHistorial, 3000);*/
            }
            
            function renovar(id){
                Swal.fire({
                title: 'Suscripciones',
                text: "Bienvenido a Renovar tu Suscripcion, la Renovacion es Automatica y estaras disfrutando del servicio rapidamente.",
                icon: 'info',
                confirmButtonColor: '#117A65',
                confirmButtonText: 'Renovar',
                cancelButtonColor: '#AEB6BF',
                showCancelButton: true,
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                            //aqui va la logiba de comunicacion con el backed
                            $.post("block",{
                            refreshSuscripcion: id
                            }, 
                            function(data){
                                var datos= JSON.parse(data);
                                if(datos.result == false){
                                    Swal.fire({
                                            title: 'Suscripciones',
                                            text: "Saldo Insuficiente para Realizar esta Operacion.",
                                            icon: 'error',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            }); 
                                }else{
                                    window.location.href="historialcliente"; 
                                }
                            }
                        );                            

                    }
                }); 
            }

            function eliminar(id){
                Swal.fire({
                title: 'Suscripciones',
                text: "Estas Seguro de Eliminar tu Suscripcion.? puedes comprarla nuevamente cuando quieras en la Tienda.",
                icon: 'warning',
                confirmButtonColor: 'coral',
                confirmButtonText: 'Eliminar',
                cancelButtonColor: '#AEB6BF',
                showCancelButton: true,
                cancelButtonText: "Seguir Suscrito"
                }).then((result) => {
                    if (result.isConfirmed) {
                        //aqui va la logica de eliminar
                        $.post("block",{
                            deleteSuscripcion: id
                        }, 
                        function(data){
                            window.location.href="historialcliente"; 
                        }); 
                    }
                });                 
            }            

        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "histcliente"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <input type="hidden" id="correo" value="<?php if(isset($_SESSION['user'])) echo readClienteId($_SESSION['user'])['CORREO']; ?>" >
        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
        <div id="vista" class="grid-container app-grid"></div>
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