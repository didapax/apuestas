<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');    
?>
<html style="overflow: scroll;">
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
        <style>
  
        </style>        
        <script> 

            function trade(id){ 
                let etiqueta =  "M"+id;
                if(document.getElementById("actualsaldo").value *1 >= document.getElementById(etiqueta).value *1 ){
                    $.get("block?datosJuego&idjuego="+id,
                                function(data){                        
                                    var datos= JSON.parse(data);
                                    Swal.fire({
                                        title: 'Suscripciones',
                                        text: `Estas Seguro de realizar la Compra de la Suscripcion ${datos.tipo} de ${datos.juego}, las Suscripciones tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red.`,
                                        icon: 'info',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Unirme',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    jugar:"",
                                                    idjuego: datos.id,
                                                    correo: document.getElementById("correo").value
                                                },function(data){
                                                    window.location.href="index";
                                                });  
                                            }
                                        });                                    
                                });
                }else{
                    Swal.fire({
                                    title: 'Suscripciones',
                                    text: "Saldo Insuficiente para realizar esta Operacion..",
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Continuar'
                                    }); 
            }
        }

            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario: "", 
                        sesion: true,
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("actualsaldo").value = datos.saldo; 
                        $("#saldo").html("Saldo "+datos.saldo+" USDT"); 
                    });
                }
            }

            function leerJuegos(){
                let correo = document.getElementById("correo").value;
                $.get("block?getJugadas=&correo="+correo, function(data){
                $("#vista").html(data);
                });
                leerDatos();                
            }

            function initsession(){
                window.location.href="sesion";
            }


            function bloque(){
                Swal.fire({
                        title: 'Bloqueo',
                        text: "Suscripcion Bloqueda, Vuelva a Intentarlo Mas tarde o Elija otra.",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar'
                        });  
            }            
            
            function inicio(){ 
                leerJuegos();
                leerDatos();
                //myVar = setInterval(leerJuegos, 3000);
            }
        </script>

    <body onload='inicio()'>       
      <?php $page = "home"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->        

        <?php
            $correo = "";
            if(isset($_SESSION['user'])){
                $correo = readClienteId($_SESSION['user'])['CORREO'];
                $saldo = readClienteId($_SESSION['user'])['SALDO'];
                recalcularSuscripciones($correo);
                refreshDataAuto();
                promoFlotante();
            }
        ?>
        <div id="cuerpo" class="cuerpo">            
            <input type="hidden" id="actualsaldo" value="<?php echo $saldo;?>">
            <input type="hidden" id="correo" value="<?php echo $correo;?>" > 
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