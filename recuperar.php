<?php
	include "modulo.php";

	if(isset($_POST['guardar'])){
		$vkey = $_POST['asociado'];
		$contrasena = test_input($_POST['psw']);
		$hashContrasena = password_hash($contrasena, PASSWORD_BCRYPT);		
		sqlconector("update USUARIOS SET PASSWORD='$hashContrasena' WHERE VKEY='$vkey'");
		sqlconector("delete from LINKS where LINK='".$_POST['code']."'");
		header("Location:sesion");
	}

	if(isset($_POST['recuperar'])){ 
		$correo = $_POST['correo'];
		$obj = array('result' => false);

		if(ifUsuarioExist($correo)){
			echo json_encode($obj);
			$bytes = random_bytes(8);
			$codigo = bin2hex($bytes);			
			$idUsuario= readCliente($correo)['VKEY'];
			
			sqlconector("insert into LINKS (LINK,CORREO) values ('".$codigo."','".$_POST['correo']."')");
	
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "criptosignalgroup@criptosignalgroup.online";
			$to = $_POST['correo'];
			$subject = "Cambio de Contraseña criptosignalgroup online";
			$message = "No Conteste este Email solo Copie y Pegue el Link en su navegador para Cambiar su Contraseña: 
			http://www.criptosignalgroup.online/recuperar?code=$codigo&key=$idUsuario";
			$headers = "From:" . $from;
			mail($to,$subject,$message, $headers);

			$obj = array('result' => true);
		}

	}

	function ifCodeExist($link) {
		if(row_sqlconector("select COUNT(*) AS TOTAL from LINKS where LINK='".$link."'")['TOTAL']==1) return TRUE;
		return FALSE;
	}
?>

<html>
<head>
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
	
<body>
	<?php $page = "recuperar"; ?>
	<section class="navigation">
                <header style='padding:40px 0;'>
                    <?php include 'barraNavegacion.php'; ?>
                </header>
        </section>   
        <section class="hero hero-inside" >

        <div id="cuerpo" class="cuerpo" >
		<div class="common-background" style="background:black; padding:2rem;background: #00000078;padding: 2rem;border-radius: 17px;">
        <div id="vista" class="grid-container app-grid">
		<?php
			if(isset($_GET['code'])) {
				if (ifCodeExist($_GET['code'])) {
			?>
			<form id="form" action="recuperar" method="POST" autocomplete="off">
				<input type="hidden" name="asociado" id="asociado" value="<?php echo $_GET['key']; ?>">
				<input type="hidden" name="code" id="code" value="<?php echo $_GET['code']; ?>">
				<h2>Recuperar Contraseña</h2>
				<input style="color:black;padding:3px;" type="password" placeholder="Enter New Password" name="psw" id="psw" required >
				<br><br>
				<button type="submit" style="background:#BCE7BC;color:black" name="guardar" class="btn btn-form">Cambiar Contraseña</button>
				<br>
			</form>

		<?php 
		}
			else {
				echo "<span style='color:white;'>El Link de Recuperacion ha Expirado....!</span>";
			}
		}
        else{
            header("Location: index");
        }  
		?>
		</div>
        </div>
		</div>
		</section>
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
