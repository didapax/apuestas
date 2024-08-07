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
	
<body>
	<?php $page = "recuperar"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
        <div id="vista" class="grid-container app-grid">
		<?php
			if(isset($_GET['code'])) {
				if (ifCodeExist($_GET['code'])) {
			?>
			<form id="form" action="recuperar" method="POST" autocomplete="off">
				<input type="hidden" name="asociado" id="asociado" value="<?php echo $_GET['key']; ?>">
				<input type="hidden" name="code" id="code" value="<?php echo $_GET['code']; ?>">
				<h2>Recuperar Contraseña</h2>
				<input type="password" placeholder="Enter New Password" name="psw" id="psw" required >
				<br><br>
				<button type="submit" style="background:#BCE7BC;" name="guardar" class="btn btn-form">Cambiar Contraseña</button>
				<br>
			</form>

		<?php 
		}
			else {
				echo "<span style='color:black;'>El Link de Recuperacion ha Expirado....!</span>";
			}
		}  
		?>
		</div>
        </div>

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
