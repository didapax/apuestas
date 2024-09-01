<?php 
    include "modulo.php"; 
?>

<?php
  //*******************************************************************************************************************
  //CHAT

	function insertNotif($IDusuario,$Idpedido,$noticia,$ubicacion){
		$Q_consulta = "INSERT INTO NOTIFICACIONES (IDUSUARIO,IDPEDIDO,NOTICIA,UBICACION) VALUES(".$IDusuario.",'$Idpedido','".$noticia."','$ubicacion')";
		sqlconector($Q_consulta);
	}

	if(isset($_GET['tiketPedido'])){
		$obj = array();
		$ticket = $_GET['idpedido'];
		if($ticket != "0"){
			$row =  row_sqlconector("SELECT * FROM TRANSACCIONES WHERE TICKET = '$ticket'"); 
			$obj = array('id' => $row['ID'],
			'fecha' => latinFecha($row['FECHA']),
			'tipo' => $row['TIPO'],
			'ticket' => $row['TICKET'],
			'descripcion' => $row['DESCRIPCION'],
			'cajero' => readCliente($row['CAJERO'])['NOMBRE_USUARIO'],
			'idCajero' => readCliente($row['CAJERO'])['ID'],
			'estrellas' => readCliente($row['CAJERO'])['RATE'],
			'cliente' => readCliente($row['CLIENTE'])['CORREO'],
			'idCliente' => readCliente($row['CLIENTE'])['ID'],
			'saldo' => readCliente($row['CLIENTE'])['SALDO'],
			'medio_pago' => $row['MEDIO_PAGO'],
			'wallet' => $row['WALLET'],
			'origen' => $row['ORIGEN'],
			'destino' => $row['DESTINO'],
			'monto' => price($row['MONTO']),
			'recibe' => price($row['RECIBE']),
			'estatus' => $row['ESTATUS'],
			'moneda' => $row['MONEDA']);
		}
		echo json_encode($obj);
	}

	if (isset($_POST['cerrarchat'])){
		if (strlen($_POST['tickedchat'])>0){
			cerrarChat($_POST['tickedchat']);
		}
	}

	if(isset($_POST['cambiarEstado'])){
		if(strlen($_POST['estado']) !="null"){
			$consulta = "UPDATE transaccion SET estado='{$_POST['estado']}' WHERE idpedido=".$_POST['tickedchat']."";
			$consulta2 = "UPDATE pedido_usuario SET estado='{$_POST['estado']}' WHERE idpedido=".$_POST['tickedchat']."";
			$row = mysqli_query( $GLOBALS['conexion'], $consulta );
			$row2 = mysqli_query( $GLOBALS['conexion'], $consulta2 );
			echo $_POST['estado'];
		}		
	}

	if (isset($_POST['insertchat'])){
		$recibe=$_POST['recibe'];

		if (Strlen($_POST['mensaje'])>0){
			insertChat($_SESSION['user'],$_POST['tickedchat'],$_POST['envia'],$recibe,$_POST['mensaje']); 

			$chat_path = "chat.php";
			if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
				$chat_path = "chat.php";
			}
			insertNotif($recibe,$_POST['pedido'],"Pedido #".$_POST['pedido']." Tiene un Nuevo Mensaje ",$chat_path."?chat=&idpedido=".$_POST['pedido']);
		}

	}

  function makeChat($ticked){
	  $consulta = "select * from CHAT where IDPEDIDO='".$ticked."' order by fecha asc";
	  $resultado = sqlconector($consulta);
	  $cadena="<table style='width: 100%; padding: 13px 0;'>";
	  while($row = mysqli_fetch_array($resultado)){
			$cadena=$cadena . "<tr><td style='font-size:11px;'>".$row['fecha']." - ".$row['envia']."</td></tr>
				<tr><td style='background-color:".$row['bg']."; color=".$row['fg'].";'>".$row['mensaje']."</td></tr>";
	  }
	  $cadena = $cadena."</table>";
	  return $cadena;
  }

  function ifChatActivo($correo) {
    $consulta = "SELECT ACTIVO FROM CHAT WHERE AMO = '".$correo."' LIMIT 1";
    $resultado = sqlconector($consulta);
    $row = mysqli_fetch_array($resultado);
    return isset($row['ACTIVO']) && $row['ACTIVO'] == 1;
  }

  function ifAmoExist($correo){
	$consulta = "select * from CHAT where AMO='".$correo."'";
	$resultado = sqlconector($consulta);
	$row = mysqli_fetch_array($resultado);
	if($row['AMO']=="$correo") return TRUE;
	return FALSE;
  }

  function ifChatCerrado($ticked){ 
	$consulta = "select * from CHAT where IDPEDIDO='".$ticked."'";
    $resultado = sqlconector($consulta);
    $row = mysqli_fetch_array($resultado);
    return isset($row['CERRADO']) && $row['CERRADO'] == 1;
  }

  function chatSinLeer($ticked,$recibe){
	$consulta = "select LEIDO, COUNT(*) AS TOTAL from CHAT where IDPEDIDO='".$ticked."' AND LEIDO=0 AND RECIBE='".$recibe."'";
	$resultado = sqlconector($consulta);
	$row = mysqli_fetch_array($resultado);
	if($row['TOTAL']>0) return $row['TOTAL'];
	else return 0;
  }

  function bgChatColor(){
	$bgAdmin =  "#ff7380";
	$bgUser = "#DADFE8";

	 if($_SESSION['nivel']==1) return $bgAdmin;
	 else return $bgUser;
  }

  function cerrarChat($ticked){
	$consulta = "UPDATE CHAT SET CERRADO=1 WHERE IDPEDIDO='".$ticked."'";
	sqlconector($consulta);
  }

  function activarChat($correo,$estatus){
	$consulta = "UPDATE CHAT SET ACTIVO=".$estatus." WHERE AMO='".$correo."'";
	sqlconector($consulta);
  }


  function chatLeido($ticked,$IDusuario){
	$consulta = "UPDATE CHAT SET LEIDO=1 WHERE IDPEDIDO='".$ticked."' AND RECIBE=".$IDusuario;
	sqlconector($consulta);
  }

  function ifChatLeido($ticked,$IDusuario) {
    $consulta = "SELECT FECHA,LEIDO FROM CHAT WHERE IDPEDIDO='$ticked' AND RECIBE='$IDusuario' ORDER BY FECHA DESC LIMIT 1 ";
    $resultado = sqlconector($consulta);
    $row = mysqli_fetch_array($resultado);
    return isset($row['LEIDO']) && $row['LEIDO'] == 1;
}

  function insertChat($amo,$ticked,$envia,$recibe,$mensaje){
	$consulta = "INSERT INTO CHAT(AMO,IDPEDIDO,ENVIA,RECIBE,MENSAJE,BG) VALUES('".$amo."','".$ticked."','".$envia."','".$recibe."','".$mensaje."','".bgChatColor()."')";
	sqlconector($consulta);
  }

  function createAmo($correo,$tk){
	  if(ifAmoExist($correo)==FALSE){
		$consulta = "INSERT INTO CHAT(AMO,IDPEDIDO) VALUES('".$correo."','".$tk."')";
		sqlconector($consulta);
			return 1;
	  }
	  else{
		  return 0;
	  }
  }

 function updateColor($ticked,$envia,$bg,$fg){
	$consulta = "UPDATE CHAT SET BG='".$bg."',FG='".$fg."' WHERE IDPEDIDO='".$ticked."' AND ENVIA='".$envia."'";
	sqlconector($consulta);
  }

function dibujaChatApp($ticket) {
	  $consulta = "select * from CHAT where IDPEDIDO='".$ticket."' order by FECHA asc";
	  $resultado = sqlconector($consulta);
	  $activo="";
	  $recibe="";
	  $amo= $_SESSION['user'];	  
	  while($row = mysqli_fetch_array($resultado)){
	  		$icono="";
			$recibe=$row['RECIBE'];
			$usuario="";
			$fecha = latinFecha($row['FECHA']);
			if($row['ENVIA']==$row['AMO']){
				$activo=$row['RECIBE'];
			}
			else{
				$activo=$row['ENVIA'];				
			} 

			if(ifChatLeido($ticket,$activo)){
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Conectado'>✓✓</span>";
			}
			else{
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Desconectado'>✓</span>";
			}

			echo "
			<div style='width: fit-content; padding:10px; border-radius:8px;margin:13px; background-color:".$row['BG']."; color=".$row['FG'].";'>
			<span style='margin-top:3px;font-size:12px;'>".$usuario."</span>
			<br><span style='font-weight: bolder;font-size:1em;'>".$row['MENSAJE']."
			<br><div style='font-size:9px; float:right;'>$fecha <span style='margin-left:3px;color:blue;font-weight:bold;'>$icono</span></div>			
			</div>
			<br>
			";
	  }

		if($activo==$amo){$activo=$recibe;}

      //mysqli_close($GLOBALS['conexion']);
  }

  if(isset($_POST['verChatApp'])) {
  	dibujaChatApp($_POST['verChatApp']);
	//Marca el chat como leido
	chatLeido($_POST['verChatApp'],$_POST['IDusuario']);
	//Marca como vista las notificaciones relacionadas a este chat
    $Q_consulta = "UPDATE NOTIFICACIONES SET VISTO=1 WHERE IDPEDIDO='".$_POST['verChatApp']."' AND IDUSUARIO='".$_POST['IDusuario']."'";
    sqlconector($Q_consulta);	
  }

?>