<?php
include "modulo.php";

if(isset($_POST['retirar'])){
    $ticket = generaTicket();
    $recibe = $_POST['cantidad'];
    $lawallet="";

    if($_POST['comopago']=="USDT"){
        $lawallet= $_POST['wallet_usdt'];
    }else{
        $lawallet= $_POST['wallet_payeer'];
    }

    sqlconector("INSERT INTO APUESTAS (TICKET,MEDIO_PAGO,NOTAID,TIPO,APUESTA,JUEGO,CLIENTE,WALLET,REFERENCIA,MONTO,RECIBE,ESTATUS) VALUES(
        '{$ticket}',
        '{$_POST['comopago']}',
        '',
        '{$_POST['tipo']}',
        '',
        '',
        '{$_POST['correo']}',
        '{$lawallet}',
        '{$_POST['tipo']}',
        {$_POST['cantidad']},
        {$recibe},
        'EN REVISION'
    )");

    $correo = $_POST['correo'];
    $saldo= readCliente($correo)['SALDO'] - ($_POST['cantidad']+1);
    sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");    
    /*createPromo($_POST['correo']);*/
}


if(isset($_POST['depositar'])){
  if(!ifTxidExist($_POST['nota'])){
    $ticket = generaTicket();
    $recibe = $_POST['cantidad'];
    $lawallet = $_POST['cajero'];

    sqlconector("INSERT INTO APUESTAS (TICKET,MEDIO_PAGO,NOTAID,TIPO,APUESTA,JUEGO,CLIENTE,WALLET,REFERENCIA,MONTO,RECIBE,ESTATUS) VALUES(
        '{$ticket}',
        '{$_POST['comopago']}',
        '{$_POST['nota']}',
        '{$_POST['tipo']}',
        '',
        '',
        '{$_POST['correo']}',
        '{$lawallet}',
        '{$_POST['tipo']}',
        {$_POST['cantidad']},
        {$recibe},
        'EN REVISION'
    )");
    /*createPromo($_POST['correo']);*/
  }
  else{
    echo "Nota o TxId Repetido en el Sistema..!";
  }
}

if(isset($_POST['jugar'])){
  //if(!ifTxidExist($_POST['nota'])){
      $ticket = generaTicket();
      $recibe = $_POST['cantidad'] *2;

      if(str_contains($_POST['equipos'], 'desafiox4')){
        $recibe = $_POST['cantidad'] *4;
      }     

      if(str_contains($_POST['equipos'], 'desafiox3')){
        $recibe = $_POST['cantidad'] *3;
      }     

      if(str_contains($_POST['equipos'], 'desafiox1_5')){
        $recibe = $_POST['cantidad'] *1.5;
      }     

      $apuesta = $_POST['equipos'];
      $lawallet="";

      if($_POST['tipo']=="Empate"){
          $apuesta = $_POST['tipo'];
      }

      /*if($_POST['comopago']=="USDT"){
          $lawallet= $_POST['wallet_usdt'];
      }else{
          $lawallet= $_POST['wallet_payeer'];
      }*/

      sqlconector("INSERT INTO APUESTAS (TICKET,MEDIO_PAGO,NOTAID,TIPO,APUESTA,JUEGO,CLIENTE,WALLET,REFERENCIA,MONTO,RECIBE,ESTATUS) VALUES(
          '{$ticket}',
          'USDT',
          '',
          '{$_POST['tipo']}',
          '{$apuesta}',
          '{$_POST['eljuego']}',
          '{$_POST['correo']}',
          '{$lawallet}',
          '{$_POST['referencia']}',
          {$_POST['cantidad']},
          {$recibe},
          'EN REVISION'
      )");

      $correo = $_POST['correo'];
      $saldo= readCliente($correo)['SALDO'] - ($_POST['cantidad']);
      sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");        
      createPromo($_POST['correo']);
/*  }
  else{
    echo "Nota o TxId Repetido en el Sistema..!";
  }*/
}

if(isset($_POST['sendmail'])){
  $usuario = readCliente($_POST['correo']);
  $correo = $usuario['CORREO'];
  $vkey = $usuario['VKEY'];
  $para = $correo;
  $asunto = "Verificación de correo electrónico";
  $mensaje = "<a href='http://localhost/apuestas/verificarEmail?vkey=$vkey'>Registrar cuenta</a>";
  $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
  $cabeceras .= "MIME-Version: 1.0" . "\r\n";
  $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  mail($para, $asunto, $mensaje, $cabeceras);  

}

if(isset($_POST['getUsuario'])){
  $correo = $_POST['correo'];
  $respuestaClave = array('success' => false);
  $obj = array('result' => false, 'capcha' => $respuestaClave,'paso'=>false,'verificado' => 0);

  if(isset($_POST['grecaptcharesponse'])){
    $captcha = $_POST["grecaptcharesponse"];
    $claveSecreta = "6Ld1nA0aAAAAAJps4LCRTs7jfshN9GNjZAghnt0f";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($claveSecreta).'&response='.urldecode($captcha).'';
    $respuesta = file_get_contents($url);
    $respuestaClave = json_decode($respuesta, TRUE);
    $obj['capcha'] = $respuestaClave;

    if(ifUsuarioExist($correo)){
      $usuario = readCliente($correo);
      $obj['result'] = true;
      if($usuario['VERIFICADO'] != 0){          
        $obj['verificado'] = 1;
        $contrasena = test_input($_POST['password']);        
        if(password_verify($contrasena, $usuario['PASSWORD'])){
          $paso = true;

          $ipreal = getRealIpAddr();
          sqlconector("UPDATE USUARIOS SET IP='{$ipreal}' WHERE CORREO='$correo'");                
          $_SESSION['user'] =readCliente($correo)['ID'];
          $_SESSION['nivel'] =readCliente($correo)['NIVEL'];
          $tiempo_maximo = time() + (24 * 60 * 60);      
          setcookie("verificado", $usuario['VERIFICADO'],$tiempo_maximo); 
          $obj = array('nombre' => $usuario['NOMBRE'],'correo' => $usuario['CORREO'], 'password' => $usuario['PASSWORD'],
          'wallet' => $usuario['WALLET'],'payeer' => $usuario['PAYEER'], 'bloqueado' => $usuario['BLOQUEADO'],
          'nivel' => $usuario['NIVEL'],'activo' => $usuario['ACTIVO'],'rate' => $usuario['RATE'],'result' => true, 'paso' => $paso,
          'saldo' => price($usuario['SALDO']), 'capcha' => $respuestaClave,'verificado' => $usuario['VERIFICADO']);          
        }
      }
    }
  }

  if(isset($_POST['sesion'])){
    $usuario = readCliente($correo);
    $obj = array('nombre' => $usuario['NOMBRE'],'correo' => $usuario['CORREO'], 
    'wallet' => $usuario['WALLET'],'payeer' => $usuario['PAYEER'], 'bloqueado' => $usuario['BLOQUEADO'],
    'nivel' => $usuario['NIVEL'],'activo' => $usuario['ACTIVO'],'rate' => $usuario['RATE'],'saldo' => price($usuario['SALDO']),'verificado' => $usuario['VERIFICADO']);
  }

    echo json_encode($obj);
}

if(isset($_POST['regUsuario'])){
    $correo = $_POST['correo'];
    $respuestaClave = array('success' => false);
    $ipreal = getRealIpAddr();
    $codeRefer= generaTicket();    
    $vkey = generaTicket();
    $contrasena = test_input($_POST['password']);
    $hashContrasena = password_hash($contrasena, PASSWORD_BCRYPT);

    sqlconector("INSERT INTO USUARIOS(IP,NOMBRE,PASSWORD,CORREO,CODIGOREFERIDO,VKEY) VALUES('$ipreal','$correo','$hashContrasena','$correo','$codeRefer','$vkey')");
    if($_POST['referente'] != "NULO"){
      insertReferido($codeRefer,$_POST['referente']);
    }  

    $obj = array('result' => false,'correo' =>$correo, 'capcha' => $respuestaClave,'paso'=>false,'verificado' => 0,'vkey' => $vkey);
    echo json_encode($obj);         
}

if(isset($_POST['initSesion'])){
    $usuario = readCliente($_POST['correo']);
    $ipreal = getRealIpAddr();
    sqlconector("UPDATE USUARIOS SET IP='{$ipreal}' WHERE CORREO='{$_POST['correo']}'");
    $_SESSION['user'] =readCliente($_POST['correo'])['ID'];
    $_SESSION['nivel'] =readCliente($_POST['correo'])['NIVEL'];
    $tiempo_maximo = time() + (24 * 60 * 60);
    setcookie("verificado", $usuario['VERIFICADO'],$tiempo_maximo);          
}

if(isset($_GET['cerrarSesion'])) {
	session_unset();
	session_destroy();
  setcookie("verificado", "", time() - 3600);
	header("Location: index.php");
}

if(isset($_GET['datosJuego'])) {
  $juego = readJuegoId($_GET['idjuego']);
  $obj = array('juego' => $juego['JUEGO'],'equipo1' => $juego['EQUIPO1'], 'equipo2' => $juego['EQUIPO2'],
  'cajero' => $juego['CAJERO'], 'wallet' => $juego['WALLET'], 'referencia' => $juego['REFERENCIA'],
  'min' => $juego['MIN'],'max' => $juego['MAX'],'id' => $juego['ID'],'estatus' => $juego['ESTATUS'],
  'desafio' => $juego['DESAFIO'],'desafiox1_5' => $juego['DESAFIOX1_5'],'desafiox3' => $juego['DESAFIOX3'],
  'favorito' => $juego['FAVORITO']);

  echo json_encode($obj);  
}

if(isset($_GET['estadisticas'])) {
  
  $obj = array('totalReg' => recordCount("USUARIOS"),'totalRef' => recordCount("REFERIDOS") );

  echo json_encode($obj);  
}

if(isset($_GET['datosApuesta'])) {
  $juego = readApuestaId($_GET['idapuesta']);
  $line;
  if(strlen($juego['JUEGO'])>0){
    $line = readJuegoId($juego['JUEGO']);
  }

  $obj = array('tipo' => $juego['TIPO'],'apuesta' => $juego['APUESTA'], 'monto' => $juego['MONTO'],
  'recibe' => $juego['RECIBE'], 'wallet' => $juego['WALLET'], 'cliente' => $juego['CLIENTE'],
  'juego' => $juego['JUEGO'],'estatus' => $juego['ESTATUS'],'id' => $juego['ID'],'ticket' => $juego['TICKET'],
  'notaid' => $juego['NOTAID'],'nombre'=>$line['JUEGO'],'mediopago' => $juego['MEDIO_PAGO']);

  echo json_encode($obj);  
}

if(isset($_GET['getJugadas'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{    
    $consulta = "select * from JUEGOS WHERE ELIMINADO=0 ORDER BY INICIO";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $fecha = latinFecha($row['INICIO']);
      $bloqueo = "trade";
      $mensaje = "";
      $style = "";
      $colorTitle="";
      $desafio = "";
      $pagan ="x2";
      $favorito="";

      if($row['BLOQUEADO']==1){
        $bloqueo = "bloque";
        $mensaje = "<span style='color:#FE6080;'>El Juego ha Sido CERRADO</span>";
        $colorAlert = "#F96E1F";
        $style = "background:#D8E8F3; border: 21px solid black;border-image-source: url(marcohielo.png); border-image-slice: 23%;border-image-repeat: round;";
        $colorTitle="darkgray";
      }
      else{
        $mensaje = "<span style='color:#16A085; font-size:13px;'>El Juego esta ABIERTO</span>
        <br><span style='color:white; font-size:10px;'>LOS JUEGOS SE CIERRAN 10 HORAS ANTES DEL EVENTO</span>";
        $style = "background:black; border: 21px solid black;border-image-source: url(marcofuego.png); border-image-slice: 23%;border-image-repeat: round;";
        $colorTitle="white";
      }  

      if($row['DESAFIO']==1){
        $desafio = "(Super Desafio Fortuna) ".makeAnciTrebol(4);
        $pagan ="x4";
      }

      if($row['DESAFIOX1_5']==1){
        $desafio = "(Super Favorito) ".makeAnciTrebol(1);
        $pagan ="x1.5";
      }

      if($row['DESAFIOX3']==1){
        $desafio = "(Desafio Fortuna Royal) ".makeAnciTrebol(3);
        $pagan ="x3";
      }

      if($row['FAVORITO']==1){
        $favorito = "(FAVORITO)";
      }      
      
      if(!isset($_SESSION['user'])){
        echo "
        <div class=\"app\"  onclick=\"initsession()\">
                   
          <div class='app-content'>
            <div class='app-title'><br><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
              <div  style='font-size:14px; text-transform:capitalize;'>
                <span style='font-weight:bold; color:white;'>".$row['EQUIPO1']." {$favorito}{$desafio}</span><br>
                <span style='font-size:12px;'>Vs </span><br>
                <span style='font-weight:bold; color:white;'>".$row['EQUIPO2']."</span><br>
                <span style='font-size:12px;font-weight:bold;'>".$row['REFERENCIA']."</span><br>
                <span style='font-size:12px;'>Maximo a Jugar </span>
                <span id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'>{$row['MAX']} USDT</span><br>
                <span style='font-size:12px;'>Paga {$pagan} </span>                
              </div>
            <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div>
            <div class='app-rating app-rating--".$row['RATE']."'></div>
          </div>
        </div>";
      }
      else{
        echo "
        <div class=\"app\" style='{$style}' onclick=\"{$bloqueo}('".$row['ID']."')\">
          
          <div class='app-content'>
            <div class='app-title'><br><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
              <div  style='font-size:14px; text-transform:capitalize;'>
                <span style='font-weight:bold; color:{$colorTitle};'>".$row['EQUIPO1']." {$favorito}{$desafio}</span><br>
                <span style='font-size:12px;'>Vs </span><br>
                <span style='font-weight:bold; color:{$colorTitle};'>".$row['EQUIPO2']."</span><br>
                <span style='font-size:12px;font-weight:bold;'>".$row['REFERENCIA']."</span><br>
                <span style='font-size:12px;'>Maximo a Jugar </span>
                <span id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'>{$row['MAX']} USDT</span><br>
                <span style='font-size:12px;'>Paga {$pagan} </span>                
              </div>
            <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div>
            <div class='app-rating app-rating--".$row['RATE']."'></div>
          </div>
        </div>";
      }
    }
    mysqli_close($conexion);
  }
}

if( isset($_GET['bot']) ){
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $consulta = "select * from USUARIOS";
  $resultado = mysqli_query( $conexion, $consulta );
  while($row = mysqli_fetch_array($resultado)){
    if(!ifReferidoExist($row['CODIGOREFERIDO'])){
      insertReferido($row['CODIGOREFERIDO'],"a4050f5ac6267099");
    }
  }  
}

if(isset($_GET['readPromos'])) { 
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $colorAlert = "#F96E1F";
    $consulta = "select * from PROMO ORDER BY FECHA";
    echo "
    <table style='width:100%; text-align:center;'>
      <th>Fecha</th>
      <th>Nombre</th>
      <th>Mensaje</th>
      <th>Triunfos</th>
      <th>Opciones</th>
    ";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $difu = "";
      $flotante = "";
      $ganador = "";
      if($row['DIFUSION']==1){
        $difu = "Correo";
      } 
      if($row['GANADOR']==1){
        $ganador = "Ganador";
      }       
      if($row['FLOTANTE']==1){
        $flotante = "Flotante";
      }       

      $fecha = latinFecha($row['FECHA']);
     echo "<tr>
      <td><span>{$fecha}</span></td>
      <td><span>".$row['NOMBRE']."</span></td>
      <td><span>".$row['MENSAJE']."</span></td>
      <td><span>".$row['NUMPROMO']."</span></td>
      <td style='text-align: left;'>
        <button title='Eliminar Promocion' type='button' style='background:#F0917F;' onclick=\"borrar('".$row['CODIGO']."')\">&#9746;</button>
        <label>{$difu}{$flotante}{$ganador}</label>
      </td>
      </tr>";
    }

    echo "</table>";
    mysqli_close($conexion);
  }
}

if(isset($_GET['readJuegos'])) { 
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    if (!$conexion) {
      echo "Refresh page, Failed to connect to Data...";
      exit();
    }else{
      $colorAlert = "#F96E1F";
      $consulta = "select * from JUEGOS WHERE ELIMINADO=0 ORDER BY INICIO";
      echo "
      <table style='width:100%; text-align:center;'>
        <th>Inicio</th>
        <th>Juego</th>
        <th>Evento</th>
        <th>Jugadores</th>
        <th>Opciones</th>
      ";
      $resultado = mysqli_query( $conexion, $consulta );
      while($row = mysqli_fetch_array($resultado)){
        $bloqueo = "";
        if($row['BLOQUEADO']==1){
          $bloqueo = "checked";
        }
        $fecha = latinFecha($row['INICIO']); 
       echo "<tr>
        <td><span>{$fecha}</span></td>
        <td><span>".$row['JUEGO']."</span></td>
        <td><span>".$row['EQUIPO1']." Vs ".$row['EQUIPO2']."</span></td>
        <td><span>".$row['APUESTAS']."/".$row['MIN']."</span></td>
        <td>
          <button title='Eliminar Juego' type='button' style='background:#F0917F;' onclick=\"borrar(".$row['ID'].")\">&#9746;</button>
          <input id='cerrar{$row['ID']}' type='checkbox' {$bloqueo} onclick=\"cerrar(".$row['ID'].")\"><label for='cerrar{$row['ID']}'>Cerrar</label>
        </td>
        </tr>";
      }
  
      echo "</table>";
      mysqli_close($conexion);
    }
}

if(isset($_GET['readTrabajos'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $colorAlert = "#F96E1F";
    $consulta = "select * from APUESTAS WHERE ELIMINADO=0 AND PAGADO=0 ORDER BY FECHA"; 
    echo "
    <table style='width:100%; text-align:center;'>
      <th></th>
      <th>Evento</th>
      <th>Apuesta</th>
      <th>Monto</th>
      <th>Estatus</th>
      <th>Opciones</th>
    ";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){

      $color="transparent";
      if(str_contains($row['TIPO'], 'Deposito')){
        $color = "green";
      }      
      if(str_contains($row['TIPO'], 'Retiro')){
        $color = "red";
      }     

      $tomado = "";
      if($row['TOMADO']==1){
        $tomado = "checked";
      }      
      $fecha = latinFecha($row['FECHA']);
      $line= "";
      if(strlen($row['JUEGO'])>0){
        $juego = readJuegoId($row['JUEGO']);
        $line = $juego['JUEGO']." / ".$juego['EQUIPO1']." Vs ".$juego['EQUIPO2'];
      }
     echo "<tr style='background:{$color};'>
      <td><span>".$row['REFERENCIA']."</span></td>
      <td><span>{$line}</span></td>
      <td><span>".$row['APUESTA']."</span></td>
      <td><span>".$row['MONTO']."</span></td>
      <td><span>".$row['ESTATUS']."</span></td>
      <td>
        <button title='Cancelar' type='button' style='background:#F0917F;' onclick=\"borrar(".$row['ID'].")\">&#9932;</button>
        <button title='Ver Detalles' type='button' style='background:yellow;color:black;' onclick=\"ver(".$row['ID'].")\">&#9749;</button>
        <!--<input id='tomar{$row['ID']}' type='checkbox' {$tomado} onclick=\"tomar(".$row['ID'].")\"><label for='tomar{$row['ID']}'>Tomar</label>-->
      </td>
      </tr>";
    }

    echo "</table>";
    mysqli_close($conexion);
  }
}

if(isset($_GET['readHistorialAdmin'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $colorAlert = "#F96E1F";
    $consulta = "select * from APUESTAS ORDER BY FECHA DESC";
    echo "
    <table style='width:100%; text-align:center;'>
      <th></th>
      <th>Evento</th>
      <th>Apuesta</th>
      <th>Recibio</th>
      <th>Estatus</th>
      <th>Resultados</th>
    ";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $line= "";
      if(isset($row['JUEGO'])){
          if(strlen($row['JUEGO'])>0){
                      $juego = readJuegoId($row['JUEGO']);
        $line = $juego['JUEGO']." / ".$juego['EQUIPO1']." Vs ".$juego['EQUIPO2'];
          }
      }      
     echo "<tr>
      <td><span>".$row['REFERENCIA']."</span></td>
      <td><span>{$line}</span></td>
      <td><span>".$row['APUESTA']."</span></td>
      <td><span>".price($row['RECIBE'])."USDT</span></td>
      <td><span>".$row['ESTATUS']."</span></td>
      <td><span>".$row['RESULTADO']."</span></td>
      </tr>";
    }

    echo "</table>";
    mysqli_close($conexion);
  }
}

if(isset($_GET['readHistorial'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $colorAlert = "#F96E1F";
    $consulta = "select * from APUESTAS WHERE CLIENTE='{$_GET['cliente']}' AND FECHA BETWEEN (NOW() - INTERVAL 10 DAY) AND NOW() ORDER BY FECHA DESC";
    echo "
    <table style='width:100%; text-align:center;'>
      <th></th>
      <th>Evento</th>
      <th>Apuesta</th>
      <th>Recibes</th>
      <th>Estatus</th>
      <th>Resultados</th>
    ";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $color="transparent";
      if(str_contains($row['TIPO'], 'Deposito')){
        $color = "green";
      }      
      if(str_contains($row['TIPO'], 'Retiro')){
        $color = "red";
      }  

      $line= "";
      if(strlen($row['JUEGO'])>0){
        $juego = readJuegoId($row['JUEGO']);
        $line = $juego['JUEGO']." / ".$juego['EQUIPO1']." Vs ".$juego['EQUIPO2'];
      }
      
     echo "<tr style='background:{$color};'>
      <td><span>".$row['REFERENCIA']."</span></td>
      <td><span>{$line}</span></td>
      <td><span>".$row['APUESTA']."</span></td>
      <td><span>".price($row['RECIBE'])."USDT</span></td>
      <td><span>".$row['ESTATUS']."</span></td>
      <td><span>".$row['RESULTADO']."</span></td>
      </tr>";
    }

    echo "</table>";
    mysqli_close($conexion);
  }
}

if(isset($_POST['borrar'])){
    //sqlconector("DELETE FROM JUEGOS WHERE ID={$_POST['borrar']}");
    sqlconector("UPDATE JUEGOS SET ELIMINADO=1 WHERE ID={$_POST['borrar']}");
}

if(isset($_POST['borrarPromo'])){
  deletePromo($_POST['borrarPromo']);
}

if(isset($_POST['cancelar'])){
  sqlconector("UPDATE APUESTAS SET ELIMINADO=1, ESTATUS='CANCELADO' WHERE ID={$_POST['cancelar']}");
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );
  $from = "soporte@fortunaroyal.com";
  $to = readApuestaId($_POST['cancelar'])['CLIENTE'];
  $subject = "Su Apuesta ha Sido Cancelada";
  $message = "Fue Cancelada, no se consiguio el Id de la transaccion (".readApuestaId($_POST['cancelar'])['NOTAID']." ) le Recordamos que Fortuna Royal no se hace responsable por perdidas debe de revisar y colocar la Nota Id de su Transferencia al momento de Jugar.. ";
  $headers = "From:" . $from;
  mail($to,$subject,$message, $headers);   
}

if(isset($_POST['tomar'])){
  sqlconector("UPDATE APUESTAS SET TOMADO=1, CAJERO='{$_POST['correo']}' WHERE ID={$_POST['tomar']}");
}

if(isset($_POST['enviar'])){
  sqlconector("UPDATE APUESTAS SET RESULTADO='{$_POST['resultado']}' WHERE ID={$_POST['enviar']}");
}

//CAMBIA LOS ESTATUS DE LAS APUESTAS
if(isset($_POST['setEstatus'])){
 
  sqlconector("UPDATE APUESTAS SET ESTATUS='{$_POST['setEstatus']}' WHERE ID={$_POST['idapuesta']}");
  
  if($_POST['setEstatus'] == "PAGADO"){
    sqlconector("UPDATE APUESTAS SET PAGADO=1 WHERE ID={$_POST['idapuesta']}");
    
    if(str_contains(readApuestaId($_POST['idapuesta'])['TIPO'], 'Deposito')){
      $correo = readApuestaId($_POST['idapuesta'])['CLIENTE'];
      $saldo= readCliente($correo)['SALDO'] + readApuestaId($_POST['idapuesta'])['RECIBE'];
      sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");
    }
    else{
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "soporte@fortunaroyal.com";
      $to = readApuestaId($_POST['idapuesta'])['CLIENTE'];
      $subject = "Tu Apuesta ha sido Pagada";
      $message = "Fue hecho un pago de ".readApuestaId($_POST['idapuesta'])['RECIBE']."USDT En tu wallet Tron Trc20: ".readApuestaId($_POST['idapuesta'])['WALLET'].
      " Exitos.!";
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);     
    }
  }

  if($_POST['setEstatus'] == "PERDISTE"){
    sqlconector("UPDATE APUESTAS SET PAGADO=1 WHERE ID={$_POST['idapuesta']}");
    $cliente = readApuestaId($_POST['idapuesta'])['CLIENTE'];
    setPromo($cliente);
    error_reporting( E_ALL );
    $from = "soporte@fortunaroyal.com";
    $to = readApuestaId($_POST['idapuesta'])['CLIENTE'];
    $subject = "Sigue Intentandolo";
    $message = "Has perdido en el juego  ".readJuegoId(readApuestaId($_POST['idapuesta'])['JUEGO'])['JUEGO'].", Sigue Intentandolo Gracias por Preferirnos.!";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);       
  }  

  if($_POST['setEstatus'] == "GANADOR"){
    $cliente = readApuestaId($_POST['idapuesta'])['CLIENTE'];

    if(!str_contains(readApuestaId($_POST['idapuesta'])['TIPO'], 'PREMIO')){
      revisaGanadorPromo($cliente,$_POST['idapuesta']);
    }
    
    sqlconector("INSERT INTO LIBROCONTABLE (TIPO,MONTO) VALUES('GANADOR',5)");

    $correo = readApuestaId($_POST['idapuesta'])['CLIENTE'];
    $saldo= readCliente($correo)['SALDO'] + readApuestaId($_POST['idapuesta'])['RECIBE'];
    sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");    

    sqlconector("UPDATE APUESTAS SET PAGADO=1 WHERE ID={$_POST['idapuesta']}");

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "soporte@fortunaroyal.com";
    $to = readApuestaId($_POST['idapuesta'])['CLIENTE'];
    $subject = "Eres un Feliz Ganador";
    $message = "Has ganado con el juego ".readJuegoId(readApuestaId($_POST['idapuesta'])['JUEGO'])['JUEGO']. " Tu apuesta ".readApuestaId($_POST['idapuesta'])['APUESTA'].
    " Pronto recibiras tu Pago de ".readApuestaId($_POST['idapuesta'])['RECIBE']."USDT En tu wallet Tron Trc20: ".readApuestaId($_POST['idapuesta'])['WALLET'].
    " Gracias por Preferirnos.";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);    
  }

  if($_POST['setEstatus'] == "APOSTADO"){
    //cierra el juego si la cantidad de jugadores alcanza el limite.
    if( sumApostadores(readApuestaId($_POST['idapuesta'])['JUEGO']) ==1 ){
      sqlconector("UPDATE JUEGOS SET BLOQUEADO=1 WHERE ID='{$_POST['cerrar']}'");
    }

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "soporte@fortunaroyal.com";
    $to = readApuestaId($_POST['idapuesta'])['CLIENTE'];
    $subject = "Apuesta ".readApuestaId($_POST['idapuesta'])['APUESTA'];
    $message = "Cliente: ".readApuestaId($_POST['idapuesta'])['CLIENTE']." su apuesta esta ya en nuestra plataforma de forma segura, de resultar ganador espere con seguridad su premio en la Wallet que nos suministro, gracias por preferirnos.";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);     

    sqlconector("INSERT INTO LIBROCONTABLE (TIPO,MONTO) VALUES('APUESTA',0.5)");
  }
}

if(isset($_POST['crear'])){
    sqlconector("INSERT INTO JUEGOS(JUEGO,CAJERO,EQUIPO1,EQUIPO2,REFERENCIA,WALLET,MIN,MAX,DESAFIO,DESAFIOX1_5,DESAFIOX3,FAVORITO,RATE) VALUES(
      '{$_POST['nombre']}',
      '{$_POST['cajero']}',
      '{$_POST['equipo1']}',
      '{$_POST['equipo2']}',
      '{$_POST['descripcion']}',
      '{$_POST['wallet']}',
      {$_POST['min']},
      {$_POST['max']},
      {$_POST['desafio']},
      {$_POST['desafiox1_5']},
      {$_POST['desafiox3']},
      {$_POST['favorito']},
      {$_POST['rate']}
    )");
}

if(isset($_POST['crearPromo'])){
  sqlconector("INSERT INTO PROMO(NOMBRE,CODIGO,MENSAJE,NUMPROMO,PREMIO,GANADOR,DIFUSION,FLOTANTE) VALUES(
    '{$_POST['nombre']}',
    '".generaTicket()."',
    '{$_POST['mensaje']}',
    {$_POST['numpromo']},
    {$_POST['premio']},
    {$_POST['promoGanador']},
    {$_POST['promoDifu']},
    {$_POST['promoFlotante']}
  )");
}

if(isset($_POST['guardarWallet'])){
  sqlconector("UPDATE USUARIOS SET WALLET='{$_POST['wallet']}',PAYEER='{$_POST['payeer']}' WHERE CORREO='{$_POST['correo']}'");
}

if(isset($_POST['cerrar'])){
  $status= readJuegoId($_POST['cerrar']);
  if($status['BLOQUEADO']==0){
    sqlconector("UPDATE JUEGOS SET BLOQUEADO=1 WHERE ID='{$_POST['cerrar']}'");
  }else{
    sqlconector("UPDATE JUEGOS SET BLOQUEADO=0 WHERE ID='{$_POST['cerrar']}'");
  }
}

if(isset($_GET['estatuslista'])){
  $status= "";
  $reset = "";

  if(recordCount("LISTA") == recordList()){
    $reset = true;
  }else{
    $reset = false;
  }

  if(ifNotDayExists("ENVIOLISTA")){
    $status= false;
  }else{
    $status= true;
  }

  $obj = array('status' => $status,'reset' => $reset,'create' => $reset);
  echo json_encode($obj);      
}

if( isset($_POST['resetlista']) ){  
  sqlconector("DELETE FROM LISTA");  
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $consulta = "select * from USUARIOS";
  $resultado = mysqli_query( $conexion, $consulta );
  while($row = mysqli_fetch_array($resultado)){
    insertLista($row['CORREO']);
  }
}

if( isset($_POST['sendlista']) ){  
  if(ifNotDayExists("ENVIOLISTA")){
    sqlconector("INSERT INTO ENVIOLISTA(ENVIADO) VALUES(1)");
  }  
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $consulta = "select * from LISTA WHERE ENVIADO=0";
  $resultado = mysqli_query( $conexion, $consulta );
  $i=0;
  while($row = mysqli_fetch_array($resultado)){
    sendMail($row['CORREO'],readMailPromo()['NOMBRE'],readMailPromo()['MENSAJE']);
    setEnviado($row['CORREO'],1);
    if($i == 4) break;
    $i++;
  }
}

if (isset($_POST['cerrarchat'])){
  if (strlen($_POST['tickedchat'])>0){
    cerrarChat($_POST['tickedchat']);
  }
}

if (isset($_POST['insertmychat'])){
  
  $recibe="khorazi57@gmail.com";
  
  if (strlen($_POST['mensaje'])>0){
    insertChat($_POST['email'],$_POST['tickedchat'],$_POST['email'],$recibe,$_POST['mensaje']);
  }

  if (readClienteId($_SESSION['user'])['NIVEL'] > 0) updateColor($_POST['tickedchat'],$_POST['email'],"#BABAEE","#000000");

  dibujaChatApp($_POST['tickedchat']);
}

if(isset($_POST['verChatApp'])) {
  dibujaChatApp($_POST['verChatApp']);
}
?>