<?php 
include "modulo.php";
date_default_timezone_set('America/Caracas');    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['guardar'])){
        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nacionalidad = $_POST['nacionalidad'];
        $result = sqlconector("UPDATE USUARIOS SET NOMBRE='$nombre', TELEFONO='$telefono', NACIONALIDAD='$nacionalidad' WHERE CORREO='$correo'");
        
        if($result){
            $mensaje = "true";
        }
        else{
            $mensaje = "false";
        }
    }
}

$correo = $nombre = $telefono = $nacionalidad = $mensaje = "";
$saldo = "0.00";

if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 && isset($_SESSION['secured'])){


$row = readClienteId($_SESSION['user']);
$correo = $row['CORREO'];
$nombre = $row['NOMBRE'];
$telefono = $row['TELEFONO'];
$saldo = $row['SALDO'];
$nacionalidad = $row['NACIONALIDAD'];

$paises = [
    "CA" => "Canadá",
    "MX" => "México",
    "US" => "Estados Unidos",    
    "AR" => "Argentina",
    "BO" => "Bolivia",
    "BR" => "Brasil",
    "CL" => "Chile",
    "CO" => "Colombia",
    "CR" => "Costa Rica",
    "CU" => "Cuba",
    "DO" => "República Dominicana",
    "EC" => "Ecuador",
    "SV" => "El Salvador",
    "GT" => "Guatemala",
    "HN" => "Honduras",
    "MX" => "México",
    "NI" => "Nicaragua",
    "PA" => "Panamá",
    "PY" => "Paraguay",
    "PE" => "Perú",
    "PR" => "Puerto Rico",
    "UY" => "Uruguay",
    "VE" => "Venezuela",
    "BZ" => "Belice",
    "CR" => "Costa Rica",
    "SV" => "El Salvador",
    "GT" => "Guatemala",
    "HN" => "Honduras",
    "NI" => "Nicaragua",
    "PA" => "Panamá",
    "NO" => "Noruega",
    "SE" => "Suecia",
    "DK" => "Dinamarca",
    "FI" => "Finlandia",
    "IS" => "Islandia",
    "EE" => "Estonia",
    "LV" => "Letonia",
    "LT" => "Lituania",
    "GB" => "Reino Unido",
    "IE" => "Irlanda",
    "FR" => "Francia",
    "BE" => "Bélgica",
    "NL" => "Países Bajos",
    "LU" => "Luxemburgo",
    "MC" => "Mónaco",
    "DE" => "Alemania",
    "CH" => "Suiza",
    "AT" => "Austria",
    "PL" => "Polonia",
    "CZ" => "República Checa",
    "SK" => "Eslovaquia",
    "HU" => "Hungría",
    "LI" => "Liechtenstein",
    "RU" => "Rusia",
    "UA" => "Ucrania",
    "BY" => "Bielorrusia",
    "MD" => "Moldavia",
    "RO" => "Rumania",
    "BG" => "Bulgaria",
    "ES" => "España",
    "PT" => "Portugal",
    "IT" => "Italia",
    "GR" => "Grecia",
    "HR" => "Croacia",
    "SI" => "Eslovenia",
    "BA" => "Bosnia y Herzegovina",
    "RS" => "Serbia",
    "ME" => "Montenegro",
    "AL" => "Albania",
    "MK" => "Macedonia del Norte"                    
    // Agrega todos los países que necesites
];

?> 
<html lang="es"> 
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
        </style>        
        <script> 

        </script>
    <body onload="inicio()" id="top">
    <?php $page = "histcliente"; ?>
    <section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section> 
        <section class="hero hero-inside" >
        <input type="hidden" id="correo" value="<?php if(isset($_SESSION['user'])) echo readClienteId($_SESSION['user'])['CORREO']; ?>" >
        <div id="cuerpo" class="cuerpo" > 
        <h3 style="font-weight: bold;text-align: center;color:white;text-decoration:underline:">Profile</h3>
        <div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div id="vista" class='outerCard-container'>
        <form method="post" action="perfilcliente.php" style='display: flex;flex-direction: column;align-items: center;'>
        <div style="display:grid;">
        <div style="text-align: center;background: linear-gradient(45deg, #204916, #46514b8c);border-radius: 5px;padding: 1rem;">Balance: <span style="font-weight: 700;"><?php echo price($saldo); ?></span> USDC</div><br>
        Email: <input type="text" class='binance-input' readonly id="correo" name="correo" value="<?php echo $correo; ?>"><br>
        Full Name: <input type="text" class='binance-input' id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        Phone: <input type="text" class='binance-input' id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
        Nationality:
        <select name="nacionalidad" id="nacionalidad" class='binance-input' style='background: #2829298c;'>
            <option value="">Selecciona tu país</option>
            <?php
                foreach($paises as $codigo => $nombre) {
                    $selected = ($codigo == $nacionalidad) ? "selected" : "";
                    echo "<option $selected value=\"$codigo\">$nombre</option>";
                }
            ?>
        </select>
    </div>
    <br>
    <button class='deposit-button' type="submit" name="guardar" style='background: #58b5c3;display: flex;justify-content: center;'>Save</button>
</form>

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