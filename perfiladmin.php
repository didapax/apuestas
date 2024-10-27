<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
    $row= row_sqlconector("SELECT * FROM USUARIOS WHERE ID=".$_SESSION['user']);

    $binance = $bep20 = $nombreUsuario = "";

    $laborando = $binanceActivo = $bep20Activo = "";

    if(isset($row['NOMBRE_USUARIO'])){
        $nombreUsuario = $row['NOMBRE_USUARIO'];
    }
    
    if (isset($row['BINANCE'])){
        $binance = $row['BINANCE'];
    }

    if (isset($row['BEP20'])){
        $bep20 = $row['BEP20'];
    }

    if($row['LABORANDO'] == 1){
        $laborando = "checked";
    }

    if($row['ACTIVE_BINANCE'] == 1){
        $binanceActivo = "checked";
    }

    if($row['ACTIVE_BEP20'] == 1){
        $bep20Activo = "checked";
    }    

    if(isset($_POST['guardar'])){
        $nombreUsuario =  $_POST['nombreUsuario'];
        $binance = $_POST['binance'];
        $bep20 = $_POST['bep20'];
        $id = $_SESSION['user'];
        sqlconector("UPDATE USUARIOS SET NOMBRE_USUARIO='$nombreUsuario', BINANCE='$binance', BEP20='$bep20' WHERE ID=$id");
    }

    if(isset($_POST['setCampo'])){
        $campo = $_POST['campo'];
        $valor = $_POST['valor'];
        $id = $_SESSION['user'];
        sqlconector("UPDATE USUARIOS SET $campo = $valor WHERE ID=$id");
    }

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
         input[type="text"]{
            color:black;
         }
        </style>        
        <script>

           function save(){
            Swal.fire({
                                        title: 'Perfil',
                                        text: `Estas seguro de Guardar los cambios? se cambiaran las wallet de pagos y qre para depositos. `,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Guardar',
                                        showCancelButton: true,
                                        cancelButtonText: "No Estoy Seguro"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("perfiladmin",{
                                                    guardar: "",
                                                    nombreUsuario: document.getElementById("username").value,
                                                    binance: document.getElementById("binance").value,
                                                    bep20: document.getElementById("bep20").value
                                            },function(data){
                                                Swal.fire({
                                                title: 'Perfil',
                                                text: "Datos Guadados con Exito",
                                                icon: 'info',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Continuar'
                                                }); 
                                            });
                                            }
                                        });
            }

            function setLaborando(){
                let estatus = 0;

                if(document.getElementById('laborando').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "LABORANDO",
                    valor: estatus
                },function(data){});                 
            }

            function setBinanceActive(){
                let estatus = 0;

                if(document.getElementById('binanceactivo').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "ACTIVE_BINANCE",
                    valor: estatus
                },function(data){});                 
            }           
            
            function setBep20Active(){
                let estatus = 0;

                if(document.getElementById('bep20activo').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "ACTIVE_BEP20",
                    valor: estatus
                },function(data){});                 
            }            

        </script>
    <body id="top">

    <?php $page = "perfiladmin"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>  
        <section class="hero hero-inside" >
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo" > 
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div class="vista" id="vista">
        <form action="perfiladmin" method="POST">
        <table id='example' class="ui celled table" style='width:100%; '> 
                        <thead>
                            <tr>
                            <th>Datos</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabla-cuerpo">
                            <tr>
                                <td>Imagen de Perfil</td>
                                <td><iframe style='border:none; height: 250px;' src='subirperfil'><br></iframe></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Activo en el Trabajo</td>
                                <td><label class="switch"><input onchange="setLaborando()" type="checkbox" id="laborando" <?php echo $laborando ?> ><span class="slider"></span></label></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nombre de Usuario</td>
                                <td><input type="text" name="username" id="username" value="<?php echo $nombreUsuario; ?>"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Binance Pay</td>
                                <td><input type="text" name="binance" id="binance" value="<?php echo $binance; ?>"></td>
                                <td><iframe style="border:none;"  src='subirqrbinance'></iframe></td>
                                <td><label class="switch"><input onchange="setBinanceActive()" type="checkbox" id="binanceactivo" <?php echo $binanceActivo ?>><span class="slider"></span> Activar Wallet</label></td>
                            </tr>
                            <tr>
                                <td>Wallet Bep20</td><td><input type="text" name="bep20" id="bep20" value="<?php echo $bep20; ?>"></td>
                                <td><iframe style="border:none;"  src='subirqrbep20'></iframe></td>
                                <td><label class="switch"><input onchange="setBep20Active()" type="checkbox" id="bep20activo" <?php echo $bep20Activo ?>><span class="slider"></span> Activar Wallet</label></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>                    
        
            <br><br>
            <button id="guardar" onclick="save()" type="button" style="background:coral;border:solid 2px black; border-radius:5px;padding:5px;">Guardar Cambios</button>
        </form>

        </div>
        </div>
        </div>
        </section> 
              <!--Iniciar footer-->
      <?php include 'footer.php';?>
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
        <script>
        $(document).ready(function() {
            $('#example').DataTable({
                        responsive: true,
                        paging: false,
                        searching: false
                    });
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