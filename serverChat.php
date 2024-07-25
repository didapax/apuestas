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
			'cajero' => readCliente($row['CAJERO'])['ID'],
			'cliente' => readCliente($row['CLIENTE'])['ID'],
			'medio_pago' => $row['MEDIO_PAGO'],
			'wallet' => $row['WALLET'],
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
		if($_SESSION['nivel']==1){
			$recibe=$_POST['recibe'];			
		}
		else{
			//La ID de un usuario administrador tiene que recibir
			$recibe= "3";
		}

		if (Strlen($_POST['mensaje'])>0){
			//($amo,$ticked,$envia,$recibe,$mensaje)
			insertChat($_SESSION['user'],$_POST['tickedchat'],$_POST['envia'],$recibe,$_POST['mensaje']); 

			$chat_path = "chat.php";
			if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
				$chat_path = "chat.php";
			}
			insertNotif($recibe,$_POST['pedido'],"Pedido #".$_POST['pedido']." Tiene un Nuevo Mensaje ",$chat_path."?chat=&idpedido=".$_POST['pedido']);
		}

		//if (($_SESSION['esAdmin']) > 0) updateColor($_POST['tickedchat'],readVendedor($_SESSION['user'])['CORREO'],"#BABAEE","#000000");

		//dibujaChatApp($_POST['tickedchat']);
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
	  //mysqli_close($conexion);
	  return $cadena;
  }

  function ifChatActivo($correo) {
    $consulta = "SELECT ACTIVO FROM CHAT WHERE AMO = '".$correo."'";
    $resultado = sqlconector($consulta);
    $row = mysqli_fetch_array($resultado);
    return isset($row['ACTIVO']) && $row['ACTIVO'] == 1;
}
 
 
  /*function ifChatActivo($correo){
	$p=0;
	$consulta = "select activo from chat where amo='".$correo."'";
	$resultado = mysqli_query( $GLOBALS['conexion'], $consulta ) or die("No se pudo Consultar el Chat");
	$row = mysqli_fetch_array($resultado);
	if(!empty($row['activo']))$p=$row['activo'];
	if($p==0) return FALSE;
	else return TRUE;
  }*/

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

 /* function latinFecha($fecha){
	$date=date_create($fecha);
	return date_format($date,"d/M/y h:ia");
}

function readCliente($id){
	return row_sqlconector("SELECT * FROM USUARIOS WHERE ID={$id}");
}*/

function dibujaChatApp($ticket) {
	  $consulta = "select * from CHAT where IDPEDIDO='".$ticket."' order by FECHA asc";
	  $resultado = sqlconector($consulta);
	  $activo="";
	  $recibe="";
	  $amo="";
	  while($row = mysqli_fetch_array($resultado)){
	  		$icono="";
			$recibe=$row['RECIBE'];
			$amo=$row['AMO'];
			if($row['ENVIA']==$row['AMO']){
				$activo=$row['ENVIA'];
			}
			else $activo=$row['RECIBE'];

			if(ifChatActivo($activo)){
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Conectado'>&#9742;</span>";
			}
			else{
				$icono= "<span style='font-weight: lighter; font-size:11px;' title='Desconectado'>&#9743;</span>";
			}

			echo "
			<div style='width: fit-content; padding:10px; border-radius:8px;margin:13px; background-color:".$row['BG']."; color=".$row['FG'].";'>
			<span style='margin-top:5px;font-size:12px;'><b>".latinFecha($row['FECHA'])."</b>  ".readClienteId($row['ENVIA'])['NOMBRE']." ".$icono."</span>
			<br><span style='font-weight: bolder;font-size:1em;'>".$row['MENSAJE']."</div>
			";
	  }

		if($activo==$amo){$activo=$recibe;}

      //mysqli_close($GLOBALS['conexion']);
  }

  if(isset($_POST['verChatApp'])) {
  	dibujaChatApp($_POST['verChatApp']);
	chatLeido($_POST['verChatApp'],$_POST['IDusuario']);
  }

?>