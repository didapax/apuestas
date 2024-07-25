<?php
require "init.php";
session_start();

function generaTicket(){
    $bytes = random_bytes(8);
	  $referencia = bin2hex($bytes);
    return $referencia;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function ifReferidoExist($referido){
	if(row_sqlconector("select * from REFERIDOS where REFERIDO='".$referido."'")['REFERIDO']==$referido) return TRUE;
	return FALSE;  
}

function insertReferido($referido,$referente){
  if(!ifReferidoExist($referido))
	  sqlconector("insert into REFERIDOS (REFERIDO,REFERENTE) values ('".$referido."','".$referente."')");
}

function readReferido($referido){
	return row_sqlconector("select * from USUARIOS where CODIGOREFERIDO='".$referido."'");
}

function returnReferente($referido){
  return row_sqlconector("select REFERENTE from REFERIDOS where REFERIDO='".$referido."'")['REFERENTE'];
}

function latinFecha($fecha){
    $date=date_create($fecha);
    return date_format($date,"d/M/y h:ia");
}

function makeAnciEstrellas($rate){
    $cadena="";
    for ($i=1; $i<=$rate; $i++){
        $cadena= $cadena. "<span style='background:transparent;color:#F9F11D;vertical-align:middle;font-size:18px;'>★</span>";
    }
    return $cadena;
}

function makeAnciTrebol($rate){
  $cadena="";
  for ($i=1; $i<=$rate; $i++){
      $cadena= $cadena. "<span style='background:transparent;color:red;vertical-align:middle;font-size:20px;'>&#9829;</span>";
  }
  return $cadena;
}

function redo($number){
    return number_format($number,0,",",".");
}

function price($price){
  if($price >= 1)
    return number_format($price,2,".","");
  return number_format($price,4,".","");
}

function getRealIpAddr(){
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function recordCount($table){
    return row_sqlconector("SELECT Count(*) as SUMA FROM ".$table)['SUMA'];
}

function recordList(){
  return row_sqlconector("SELECT Count(*) as SUMA FROM LISTA WHERE ENVIADO = 1")['SUMA'];
}

function readCliente($correo){
  return row_sqlconector("SELECT * FROM USUARIOS WHERE CORREO='{$correo}'");
}

function readClienteId($id){
  return row_sqlconector("SELECT * FROM USUARIOS WHERE ID={$id}");
}

function ifUsuarioExist($correo) {
  $conexion = @mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      exit;
  }

  $resultado = mysqli_query($conexion, "SELECT 1 FROM USUARIOS WHERE CORREO = '$correo'");
  $existe = mysqli_num_rows($resultado) > 0;
  mysqli_close($conexion);

  return $existe;
}

function ifTxidExist($txid){
	if(row_sqlconector("select * from APUESTAS where NOTAID='".$txid."'")['NOTAID']==$txid) return TRUE;
	return FALSE;  
}

function readJuegoId($id){
  if(isset(row_sqlconector("SELECT * FROM JUEGOS WHERE ID={$id}")['ID'])){
    return row_sqlconector("SELECT * FROM JUEGOS WHERE ID={$id}");
  }  
}

function readApuestaId($id){
  return row_sqlconector("SELECT * FROM APUESTAS WHERE ID={$id}");
}

function readApuestaTicket($id){
  return row_sqlconector("SELECT * FROM APUESTAS WHERE TICKET='{$id}'");
}

function readTransaccionTicket($id){
  return row_sqlconector("SELECT * FROM TRANSACCIONES WHERE TICKET='{$id}'");
}

function ifPromoExist($correo,$codigo){
	if(row_sqlconector("select * from USERPROMO where CORREO='{$correo}' AND CODIGO='{$codigo}'")['CORREO']==$correo) return TRUE;
	return FALSE;   
}

function readUserPromo($correo,$codigo){
  return row_sqlconector("SELECT * FROM USERPROMO WHERE CORREO='{$correo}' AND CODIGO='{$codigo}'");
}

function readPromo($codigo){
  return row_sqlconector("SELECT * FROM PROMO WHERE CODIGO='{$codigo}'");
}

function createPromo($correo){
  if(recordCount("PROMO")>0){
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    $consulta = "select * from PROMO WHERE GANADOR=1";
    if (!$conexion) {
      echo "Refresh page, Failed to connect to Data...";
      exit();
    }else{
      $resultado = mysqli_query( $conexion, $consulta );
      while($row = mysqli_fetch_array($resultado)){
        if(!ifPromoExist($correo,$row['CODIGO'])){
          sqlconector("INSERT INTO USERPROMO (CORREO,CODIGO,NUMPROMO) VALUES('{$correo}','{$row['CODIGO']}',{$row['NUMPROMO']})");
        }
      }    
    }
  }
}

function sumPromo($correo,$codigo){
 $rate = readUserPromo($correo,$codigo)['RATE'] +1;
 sqlconector("UPDATE USERPROMO SET RATE={$rate} WHERE CORREO='{$correo}' AND CODIGO='{$codigo}'");
}

function sumLogros($referido){
  $rate = row_sqlConector("SELECT * FROM REFERIDOS WHERE REFERIDO='{$referido}'")['LOGROS'] +1;
  sqlconector("UPDATE REFERIDOS SET LOGROS={$rate} WHERE REFERIDO='{$referido}'");
 }

function sumApostadores($id){
  $juego = readJuegoId($id);
  $rate = $juego['APUESTAS'] +1;
  sqlconector("UPDATE JUEGOS SET APUESTAS={$rate} WHERE ID={$id}");
  $n_apuestas = readJuegoId($id)['MIN'];
  if($n_apuestas == $rate){
    return 1;
  }
  else {
    return 0;
  }
 }

function setPromo($correo){
  if(recordCount("PROMO")>0){
    sqlconector("UPDATE USERPROMO SET RATE=0 WHERE CORREO='{$correo}'");
  }
}

function deletePromo($codigo){
  sqlconector("DELETE FROM PROMO WHERE CODIGO='{$codigo}'");
  sqlconector("DELETE FROM USERPROMO WHERE CODIGO='{$codigo}'");
}

function revisaGanadorPromo($correo,$idApuesta){
  //Asigna premios de promos
  //Revisa si es referido y paga comisiones
  $referido = readCliente($correo)['CODIGOREFERIDO'];
  $referente = returnReferente($referido);

  if( isset($referente) ) {
    $promo = "Ganador Por Referido";
    $wallet = readReferido($referente)['PAYEER'];
    $cliente = readReferido($referente)['CORREO'];
    $ticket = generaTicket();
    $recibe = "0.5";
    $apuesta = "Ganador Por Referido"; 
    $t_juego = readApuestaId($_POST['idapuesta'])['JUEGO'];

    sqlconector("INSERT INTO APUESTAS (TICKET,NOTAID,TIPO,APUESTA,JUEGO,CLIENTE,WALLET,REFERENCIA,MONTO,RECIBE,ESTATUS) VALUES(
        '{$ticket}',
        '',
        'PREMIO',
        '{$apuesta}',
        '{$t_juego}',
        '{$cliente}',
        '{$wallet}',
        '',
        {$recibe},
        {$recibe},
        'EN PROCESO'
    )");
    sqlconector("INSERT INTO LIBROCONTABLE (OPERACION,TIPO,MONTO) VALUES('PAGO','PREMIO',10)"); 
    sumLogros($referido);
  }
  
  //suma o paga juegos ganados segun la promocion
  if(recordCount("PROMO")>0){
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    if (!$conexion) {
      echo "Refresh page, Failed to connect to Data...";
      exit();
    }else{      
      $consulta = "select * from USERPROMO WHERE CORREO='{$correo}'";
      $resultado = mysqli_query( $conexion, $consulta );
      while($row = mysqli_fetch_array($resultado)){        
        if($row['RATE'] < $row['NUMPROMO']-1 && readApuestaId($_POST['idapuesta'])['MONTO'] >9){
          sumPromo($correo,$row['CODIGO']);
        }else{
          $promo = readPromo($row['CODIGO']);
          $wallet = readCliente($correo)['WALLET'];
          $cliente = readCliente($correo)['CORREO'];
          $ticket = generaTicket();
          $recibe = $promo['PREMIO'];
          $apuesta = $promo['NOMBRE']; 
          $t_juego = readApuestaId($_POST['idapuesta'])['JUEGO'];
          
          sqlconector("INSERT INTO APUESTAS (TICKET,NOTAID,TIPO,APUESTA,JUEGO,CLIENTE,WALLET,REFERENCIA,MONTO,RECIBE,ESTATUS) VALUES(
              '{$ticket}',
              '',
              'PREMIO',
              '{$apuesta}',
              '{$t_juego}',
              '{$cliente}',
              '{$wallet}',
              '',
              {$recibe},
              {$recibe},
              'EN PROCESO'
          )");      
          setPromo($correo,$row['CODIGO']);
          sqlconector("INSERT INTO LIBROCONTABLE (OPERACION,TIPO,MONTO) VALUES('PAGO','PREMIO',10)");          
        }
      }
    }
  } 
}

function statusPromocion($correo){
  if(recordCount("PROMO")>0){
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    $consulta = "select * from USERPROMO WHERE CORREO='{$correo}'";
    if (!$conexion) {
      echo "Refresh page, Failed to connect to Data...";
      exit();
    }else{
      $resultado = mysqli_query( $conexion, $consulta );
      echo "
      <span>Promociones:</span>
      <table>        
      ";
      while($row = mysqli_fetch_array($resultado)){
        $max = "".readPromo($row['CODIGO'])['NUMPROMO']." Triunfos";
        echo "<tr><td>{$max}</td><td>".makeAnciEstrellas($row['RATE'])."</td></tr>";
      }    
      echo "</table>";
    }
  }   
}

function verPromo(){
  if(recordCount("PROMO")>0){
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    $consulta = "select * from PROMO WHERE GANADOR=1";
    if (!$conexion) {
      echo "Refresh page, Failed to connect to Data...";
      exit();
    }else{
      $resultado = mysqli_query( $conexion, $consulta );
      $cadena = "- JUEGA Y GANA EL DOBLE -";
      while($row = mysqli_fetch_array($resultado)){
        $cadena = $cadena . " - {$row['MENSAJE']} -";
      }
    }
  }else{
    $cadena =  " - JUEGA Y GANA EL DOBLE -";
  }
  echo $cadena;
}

function ifNotDayExists($tabla){
  $interval = row_sqlconector("SELECT DAY(NOW()) AS DIA, MONTH(NOW()) AS MES, YEAR(NOW()) AS ANO");
  $fecha1 = "{$interval['ANO']}-{$interval['MES']}-{$interval['DIA']} 00:00";
  $fecha2 = "{$interval['ANO']}-{$interval['MES']}-{$interval['DIA']} 23:59";
  if (row_sqlconector("select COUNT(*) AS TOTAL from {$tabla} WHERE FECHA BETWEEN '{$fecha1}' AND '{$fecha2}'")['TOTAL'] == 0)
  return TRUE;
  return FALSE;
}

function insertLista($correo){
  sqlconector("INSERT INTO LISTA(CORREO) VALUES('{$correo}')");
}

function sendMail($correo,$asunto,$mensaje){
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );
  $from = "soporte@fortunaroyal.com";
  $to = $correo;
  $subject = $asunto;
  $message = $mensaje;
  $headers = "From:" . $from;
  mail($to,$subject,$message, $headers);       
}

function setEnviado($correo,$valor){
  sqlconector("UPDATE LISTA SET ENVIADO={$valor} WHERE CORREO='{$correo}'");
}

function readMailPromo(){
  return row_sqlconector("SELECT * FROM PROMO WHERE DIFUSION=1 LIMIT 1");
}

function promoFlotante(){
  if(ifReadPromo()){
    $row = row_sqlconector("select * from PROMO where FLOTANTE=1 LIMIT 1");
    echo 	"<dialog open id='promoFlotante' class='dialog_mss'>      
      <a href='javascript:void(0);' class='icon-close' style='float:right;' onclick=\"$('#promoFlotante').fadeOut()\">✖️</a><br>
      <div style='padding:21px;'>".$row['MENSAJE']."</div>      
      </dialog>
      ";
  }
}

function ifReadPromo(){
	if($row = row_sqlconector("select * from PROMO where FLOTANTE=1 LIMIT 1")){
		if(strlen($row['MENSAJE'])>0) return TRUE;
		return FALSE;
	}
}

	/*****************************************************************************************************************
	NOTIFICACIONES*/
  function countNotif($IDusuario){
    return row_sqlconector("select COUNT(*) AS TOTAL from NOTIFICACIONES WHERE IDUSUARIO=".$IDusuario." AND VISTO=0")['TOTAL'];
}

function notif($IDusuario){
    $cadena="";   
    sqlconector("DELETE FROM NOTIFICACIONES WHERE IDUSUARIO=".$IDusuario." AND VISTO=1");
    $resultado = sqlconector("SELECT * FROM NOTIFICACIONES WHERE IDUSUARIO=".$IDusuario." AND VISTO=0");
    if($resultado){
        $obj=array();
        while($row = mysqli_fetch_array($resultado)){
            $obj[] = "<a href='{$row['ubicacion']}&notif={$row['ID']}'>".$row['noticia']."</a>";
        }
       }
   return $obj;
 }

 if(isset($_POST['insertNotif'])){
    $Q_consulta = "INSERT INTO NOTIFICACIONES(IDUSUARIO,NOTICIA,UBICACION) VALUES(".$_POST['IDusuario'].",'".$_POST['noticia']."','{$_POST['ubicacion']}')";
    sqlconector($Q_consulta);
 }     

 if(isset($_GET['marcarNotif'])){
    $Q_consulta = "UPDATE NOTIFICACIONES SET VISTO=1 WHERE IDPEDIDO='".$_GET['idpedido']."' AND IDUSUARIO='".$_GET['user']."'";
    sqlconector($Q_consulta);
 }

 if(isset($_GET['vernotif'])){
    $obj = array('noticias' => notif($_GET['IDusuario']),'totalNotif' => countNotif($_GET['IDusuario']));
    $json = json_encode($obj);
    echo $json;
 }

   /****FIN NOTIFICACIONES**************************************************************************
   */

?>