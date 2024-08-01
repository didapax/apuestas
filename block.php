<?php
include "modulo.php";

if(isset($_POST['retirar'])){
  $wallet_comisiones = "alfonsi.acosta@gmail.com";
  $ticket = generaTicket();
  $monto = $_POST['monto'];
  $recibe = $_POST['recibe'];
  $comision = $_POST['comision'];
  $cajero = $_POST['cajero'];
  $cliente = $_POST['correo'];
  $wallet = $_POST['nota'];
  $descripcion= $_POST['tipo'];

  sqlconector("INSERT INTO TRANSACCIONES (TICKET,TIPO,DESCRIPCION,CAJERO,CLIENTE,WALLET,MONTO,RECIBE) VALUES(
      '$ticket',
      'RETIRO',
      '$descripcion',
      '$cajero',
      '$cliente',
      '$wallet',
      $monto,
      $recibe)");

    $saldo= readCliente($cliente)['SALDO'] - $monto;
    sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
    $saldo_comision = readCliente($wallet_comisiones)['SALDO'] + $comision;
    sqlconector("UPDATE USUARIOS SET SALDO = $saldo_comision WHERE CORREO='$wallet_comisiones'");
}


if(isset($_POST['depositar'])){ 
    $ticket = generaTicket();
    $monto = $_POST['cantidad'];
    $cajero = $_POST['cajero'];
    $cliente = $_POST['correo'];
    $wallet = $_POST['nota'];
    $descripcion= $_POST['tipo'];

    sqlconector("INSERT INTO TRANSACCIONES (TICKET,DESCRIPCION,CAJERO,CLIENTE,WALLET,MONTO,RECIBE) VALUES(
        '$ticket',
        '$descripcion',
        '$cajero',
        '$cliente',
        '$wallet',
        $monto,
        $monto)");
}

if(isset($_POST['jugar'])){
      $suscripcion = readJuegoId($_POST['idjuego']);  
      $ticket = generaTicket();      
      $monto = $suscripcion['MONTO'];
      $tipo = $suscripcion['TIPO'];
      $idJuego = $suscripcion['ID'];
      $juego = $suscripcion['JUEGO'];
      $cajero = $suscripcion['CAJERO'];
      $porciento = $suscripcion['PORCIENTO'];
      $porAdelantado = $suscripcion['PORADELANTADO'];
      $correo = $_POST['correo'];
      $numMes;
      $cuotaMensual;
      $interesMensual;
      $totalCuotas;
      $numeroPagos;

      switch ($tipo) {
        case 'MENSUAL':
          $numMes= 1;          
        break;
        case 'TRIMESTRAL':
          $numMes= 3;
        break;
        case 'SEMESTRAL':
          $numMes= 6;
        break;
        case 'ANUAL':
          $numMes= 12;
        break;                                  
        default:
          $numMes= 1;
        break;
      }

      $numeroPagos = $numMes;
      $resultado = calcularInteresMensual($monto, $porciento, $numMes);
      $cuotaMensual = $resultado['cuotaMensual'];
      $interesMensual =  $resultado['interesMensual'];
      $totalCuotas = $cuotaMensual * $numMes;

      $fechaInicial = date('Y-m-d'); // Tu fecha inicial
      $fechaFinal = calcularFechaDespuesDeUnMes($fechaInicial,$numMes);
      
      $consulta = "INSERT INTO APUESTAS (INICIO,FIN,TICKET,TIPO,IDJUEGO,JUEGO,CAJERO,CLIENTE,MONTO,PORCIENTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR,N_PAGOS) VALUES(
          '{$fechaInicial}',
          '{$fechaFinal}',
          '{$ticket}',
          '{$tipo}',
           {$idJuego},
          '{$juego}',
          '{$cajero}',
          '{$correo}',
           {$monto},
           {$porciento},
           {$interesMensual},
           {$cuotaMensual},
           {$totalCuotas},
           {$numeroPagos}
      )";
      
      sqlconector($consulta);

      $saldo= readCliente($correo)['SALDO'] - $monto;
      sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");

      if($porAdelantado == 1){
        $saldo= readCliente($correo)['SALDO'] + ($interesMensual * $numeroPagos);
        sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$correo'");
      }      

      $inversion = 0;
      $tipo = "DEBITO";
      if($porciento > 0){
        $inversion = 1;
        $tipo = "CREDITO";
      }

      $fechas = obtenerIntervalosMensuales($fechaInicial, $fechaFinal);
      foreach ($fechas as $fecha) {
        sqlconector("INSERT INTO LIBROCONTABLE(FECHA,TICKET,TIPO,IDJUEGO,INVERSION,JUEGO,CAJERO,CLIENTE,INTERES_ADELANTADO,MONTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR) VALUES(
        '$fecha',
        '$ticket',
        '$tipo',
         $idJuego,
         $inversion,
        '$juego',
        '$cajero',
        '$correo',
         $porAdelantado,
         $monto,
         $interesMensual,
         $cuotaMensual,
         $totalCuotas
        )");
      }

      sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE TICKET='$ticket' AND FECHA='$fechaInicial'");
}

if(isset($_POST['sendmail'])){
  $usuario = readCliente($_POST['correo']);

  $correo = $usuario['CORREO'];
  $vkey = $usuario['VKEY'];
  $para = $correo;
  $asunto = "Verificación de correo electrónico";
  $mensaje = "<a href='http://criptosignalgroup.online/verificarEmail?vkey=$vkey'>Registrar cuenta</a>";
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
          'binance' => $usuario['BINANCE'], 'bloqueado' => $usuario['BLOQUEADO'],
          'nivel' => $usuario['NIVEL'],'activo' => $usuario['ACTIVO'],'rate' => $usuario['RATE'],'result' => true, 'paso' => $paso,
          'saldo' => price($usuario['SALDO']), 'capcha' => $respuestaClave,'verificado' => $usuario['VERIFICADO']);          
        }
      }
    }
  }

  if(isset($_POST['sesion'])){
    $usuario = readCliente($correo);
    $obj = array('nombre' => $usuario['NOMBRE'],'correo' => $usuario['CORREO'], 
    'binance' => $usuario['BINANCE'], 'bloqueado' => $usuario['BLOQUEADO'],
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
  $row = readJuegoId($_GET['idjuego']);
  $obj = array(
    'id' => $row['ID'],
    'fecha' => $row['FECHA'],
    'juego' => $row['JUEGO'],
    'descripcion' => $row['DESCRIPCION'],
    'analisis' => $row['ANALISIS'],
    'cajero' => $row['CAJERO'],
    'tipo' => $row['TIPO'],
    'monto' => $row['MONTO'],
    'moneda' => $row['MONEDA']);

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

if(isset($_POST['deleteSuscripcion'])){
  $id= $_POST['deleteSuscripcion'];
  sqlconector("DELETE FROM APUESTAS WHERE ID=$id");
}

if(isset($_POST['refreshSuscripcion'])){
  $obj = array('result'=>true);
  $id= $_POST['refreshSuscripcion'];
  $suscripcion = readApuestaID($id);
  $cliente = $suscripcion['CLIENTE'];
  $saldo = readCliente($cliente)['SALDO'];
  $monto = $suscripcion['MONTO'];
  $ticket = $suscripcion['TICKET'];
  $n_pagos = $suscripcion['N_PAGOS'];
  $dia_actual = date("Y-m-d");

  if($saldo >= $monto){
    $idJuego = $suscripcion['IDJUEGO'];
    $juego = $suscripcion['JUEGO'];
    $cajero =$suscripcion['CAJERO'];
    $postSaldo = $saldo - $monto;
    sqlconector("UPDATE USUARIOS SET SALDO=$postSaldo WHERE CORREO='$cliente'");
    sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE TICKET='$ticket' AND CLIENTE='$cliente'");
    $fechaFinal = calcularFechaDespuesDeUnMes($dia_actual,$n_pagos);
    sqlconector("UPDATE APUESTAS SET FIN='$fechaFinal',ESTATUS='RENOVADO'  WHERE TICKET='$ticket' ");
    sqlconector("INSERT INTO LIBROCONTABLE(FECHA,TICKET,TIPO,IDJUEGO,INVERSION,JUEGO,CAJERO,CLIENTE,INTERES_ADELANTADO,MONTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR) VALUES(
      '$fechaFinal',
      '$ticket',
      'DEBITO',
       $idJuego,
       0,
      '$juego',
      '$cajero',
      '$cliente',
       0,
       $monto,
       0,
       $monto,
       $monto
      )");                
    sqlconector("UPDATE APUESTAS SET ACTIVO=1, ESTATUS='RENOVADO' WHERE TICKET='$ticket'");
  }
  else{
    $obj = array('result'=>false);
  }
  
  echo json_encode($obj);
}

if(isset($_GET['getSuscripciones'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $correo= $_GET['correo'];
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{    
    $consulta = "select * from APUESTAS WHERE ELIMINADO=0 AND CLIENTE='$correo' ORDER BY FECHA";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $fecha = latinFecha($row['FECHA']);
      $bloqueo = "detalle";
      $mensaje = "";
      $style = "";
      $colorTitle="";
      $favorito="";
      $analisis = "";
  
      if($row['ACTIVO']==0){     
        $analisis = "<button style='float: right;color:black;border:solid 1px black;border-radius:5px;' onclick=\"renovar('".$row['ID']."')\">Renovar</button>
                      <button style='background:coral;float: right;color:black;border:solid 1px black;border-radius:5px;' onclick=\"eliminar('".$row['ID']."')\">Eliminar</button>";
        $mensaje = "<span style='color:#FE6080;'>Suscripcion Suspendida</span>";
        $colorAlert = "#F96E1F";
        $style = "background: url(Assets/tarjetagris.png); border: 3px solid black; border-radius: 15px;";
        $colorTitle="darkgray";
      }
      else{
        if( isset(readJuegoId($row['IDJUEGO'])['ANALISIS']) ){
          $analisis = readJuegoId($row['IDJUEGO'])['ANALISIS'];
        }else{
          $analisis = readJuegoId($row['IDJUEGO'])['DESCRIPCION'];
        }        
        $bloqueo = "pagar";        
        $mensaje = "<span style='color:gray; font-size:13px;'>Suscripcion Activa</span>";
        $style = "background: url(Assets/tarjetadorada.png); border: 3px solid black; border-radius: 15px;";
        $colorTitle="black";
      }  
        echo "
        <div class=\"app\" style='{$style}' onclick=\"{$bloqueo}('".$row['ID']."')\">
          <div >
            <div class='app-title'><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:black;'>".$row['JUEGO']."</span></div>
              <div  style='font-size:14px; text-transform:capitalize;'>
                <div style='padding:5px;font-weight:bold; color:{$colorTitle};font-size:12px; whidth:100%; height: 160px;  overflow-y: auto; overflow-x: hidden;margin-left: 80px;'>".$analisis."</div>
                <div style='color:black;'> Interes Mensual de ".price($row['INTERES_MENSUAL'])."Usdc</div>
                <div style='color:gray;font-size:13px;font-weight:bold;'>Vence el : ".latinFecha($row['FIN'])."</div>
                <div id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'></div>
              </div>
            <div style='text-transform: uppercase;font-weight: bold; margin-top:2px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div><br>            
          </div>
        </div>";
      
    }
    mysqli_close($conexion);
  }
}

if(isset($_GET['getJugadas'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $correo = $_GET['correo'];
  $consulta = "select * from JUEGOS WHERE ELIMINADO=0 ORDER BY FECHA";

  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{    
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $fecha = latinFecha($row['FECHA']);
      $bloqueo = "trade";
      $mensaje = "";
      $style = "";
      $colorTitle="";
      $favorito="&#169;";

      if($row['BLOQUEADO']==1){
        $bloqueo = "bloque";
        $mensaje = "<span style='color:#FE6080;'>Suscripcion Bloqueda</span>";
        $colorAlert = "#F96E1F";
        $style = "background: url(Assets/tarjetagris.png); border: 3px solid black; border-radius: 15px;";
        $colorTitle="darkgray";
      }
      else{
        $mensaje = "<span style='color:#16A085; font-size:13px;'>Suscripcion Abierta</span>";
        $style = "background: url(Assets/tarjetanegra.png); border: 3px solid black; border-radius: 15px;";
        $colorTitle="white";
      }  

      if($row['FAVORITO']==1){
        $favorito = "&#169; Recomendado";
      }      
      
      if(!isset($_SESSION['user'])){
        echo "
        <div class=\"app\" style='{$style}' onclick=\"initsession()\">  
          <div >
            <div class='app-title'><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
            <div  style='font-size:14px; text-transform:capitalize;'>
                <div style='font-size:10px;font-weight:bold; color:{$colorTitle};'>{$favorito}</div>
                <div style='padding:5px;font-weight:bold; color:{$colorTitle};font-size:13px; whidth:100%; height: 110px;  overflow-y: auto; overflow-x: hidden;margin-left: 90px;'>".$row['DESCRIPCION']."</div>
                <div style='background: darkslategrey;text-align: right;color:white;font-size:12px;font-weight:bold;'>Costo: ".price($row['MONTO'])." Usdc</div>
                <div id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'></div>
            </div>
            <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div>
            <div class='app-rating app-rating--".$row['RATE']."'></div>
          </div>
        </div>";
      }
      else{
        if(strlen($correo) > 0 ){
          if(ifClienteJuegoExist($row['ID'],$correo)){
            if($row['PORCIENTO'] > 0){
              echo "
              <div class=\"app\" style='{$style}' onclick=\"{$bloqueo}('".$row['ID']."')\">
                <input type='hidden' id='M".$row['ID']."' value='".price($row['MONTO'])."'>
                <div >
                  <div class='app-title'><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
                    <div  style='font-size:14px; text-transform:capitalize;'>
                      <div style='font-size:10px;font-weight:bold; color:{$colorTitle};'>{$favorito}</div>
                      <div style='padding:5px;font-weight:bold; color:{$colorTitle};font-size:12px; whidth:100%; height: 110px;  overflow-y: auto; overflow-x: hidden;margin-left: 90px;'>".$row['DESCRIPCION']."</div>
                      <div style='background: darkslategrey;text-align: right;color:white;font-size:12px;font-weight:bold;'>Costo: ".price($row['MONTO'])." Usdc</div>
                      <div id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'></div>
                    </div>
                  <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div><br>
                  <div class='app-rating app-rating--".$row['RATE']."'></div>
                </div>
              </div>";
            }
          }
          else{
            echo "
              <div class=\"app\" style='{$style}' onclick=\"{$bloqueo}('".$row['ID']."')\">
                <input type='hidden' id='M".$row['ID']."' value='".price($row['MONTO'])."'>
                <div >
                  <div class='app-title'><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
                    <div  style='font-size:14px; text-transform:capitalize;'>
                      <div style='font-size:10px;font-weight:bold; color:{$colorTitle};'>{$favorito}</div>
                      <div style='padding:5px;font-weight:bold; color:{$colorTitle};font-size:12px; whidth:100%; height: 110px;  overflow-y: auto; overflow-x: hidden;margin-left: 90px;'>".$row['DESCRIPCION']."</div>
                      <div style='background: darkslategrey;text-align: right;color:white;font-size:12px;font-weight:bold;'>Costo: ".price($row['MONTO'])." Usdc</div>
                      <div id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'></div>
                    </div>
                  <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div><br>
                  <div class='app-rating app-rating--".$row['RATE']."'></div>
                </div>
              </div>";          
          }
        }
        else{
          echo "
              <div class=\"app\" style='{$style}' onclick=\"{$bloqueo}('".$row['ID']."')\">
                <input type='hidden' id='M".$row['ID']."' value='".price($row['MONTO'])."'>
                <div >
                  <div class='app-title'><span style='text-transform: uppercase;font-size:2.1vh;font-weight:bold;color:#FB8107;'>".$row['JUEGO']."</span></div>
                    <div  style='font-size:14px; text-transform:capitalize;'>
                      <div style='font-size:10px;font-weight:bold; color:{$colorTitle};'>{$favorito}</div>
                      <div style='padding:5px;font-weight:bold; color:{$colorTitle};font-size:12px; whidth:100%; height: 110px;  overflow-y: auto; overflow-x: hidden;margin-left: 90px;'>".$row['DESCRIPCION']."</div>
                      <div style='background: darkslategrey;text-align: right;color:white;font-size:12px;font-weight:bold;'>Costo: ".price($row['MONTO'])." Usdc</div>
                      <div id='V_{$row['ID']}' style='font-size:12px;font-weight:bold;'></div>
                    </div>
                  <div style='text-transform: uppercase;font-weight: bold; margin-top:5px;text-align:center; width:100%;font-size:12px;color:white;text-decoration:none;'>{$mensaje}</div><br>
                  <div class='app-rating app-rating--".$row['RATE']."'></div>
                </div>
              </div>";
        }
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
      $consulta = "select * from JUEGOS WHERE ELIMINADO=0 ORDER BY FECHA";
      echo "
      <table style='width:100%; '>
      <thead>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Descripcion</th>
        <th>Tipo</th>
        <th>Usdc</th>
        <th>Opciones</th>
        </thead><tbody>
      ";
      $resultado = mysqli_query( $conexion, $consulta );
      while($row = mysqli_fetch_array($resultado)){
        $bloqueo = "";
        if($row['BLOQUEADO']==1){
          $bloqueo = "checked";
        }
        $fecha = latinFecha($row['FECHA']); 
       echo "<tr>
        <td><span>{$fecha}</span></td>
        <td><span>".$row['JUEGO']."</span></td>
        <td title='".strip_tags($row['DESCRIPCION'])."'>".substr($row['DESCRIPCION'], 0, 100)."...</td>
        <td><span>".$row['TIPO']."</span></td>
        <td><span>".price($row['MONTO'])."</span></td>
        <td>";
          if($row['PORCIENTO'] == 0){
            echo "<button title='Analisis' type='button' onclick=\"analisis('".$row['ID']."')\">Analisis</button>";
          }
          
          echo "<button title='Eliminar' type='button' style='background:#F0917F;' onclick=\"borrar('".$row['ID']."')\">Delete</button>
          <label for='cerrar{$row['ID']}'><input id='cerrar{$row['ID']}' type='checkbox' {$bloqueo} onclick=\"cerrar(".$row['ID'].")\">Bloquear</label>          
        </td>
        </tr>";
      }
  
      echo "</tbody></table>";
      mysqli_close($conexion);
    }
}

if(isset($_GET['readTrabajos'])) {  
  function countNot($Idpedido){
    $total = 0;
    $resultado = sqlconector("SELECT COUNT(IDPEDIDO) AS TOTAL FROM NOTIFICACIONES WHERE IDPEDIDO='$Idpedido' AND VISTO = 0 AND IDUSUARIO = ".readCliente($_GET['correo'])['ID']);
    if($resultado){
      $row = mysqli_fetch_array($resultado);
      $total = $row['TOTAL'];
    }
    return $total;
  }

    $obj= array();
    $consulta = "select * from TRANSACCIONES WHERE ELIMINADO=0 AND PAGADO=0 ORDER BY FECHA"; 
    $resultado = sqlconector($consulta);
    if($resultado){
      while($row = mysqli_fetch_array($resultado)){
        $obj[]= array('id' => $row['ID'],
      'fecha' => latinFecha($row['FECHA']),
      'ticket' => $row['TICKET'],
      'descripcion' => $row['DESCRIPCION'],
      'cliente' => $row['CLIENTE'],
      'cajero' => $row['CAJERO'],
      'tipo' => $row['TIPO'],
      'medio_pago' => $row['MEDIO_PAGO'],
      'wallet' => $row['WALLET'],
      'monto' => $row['MONTO'],
      'recibe' => $row['RECIBE'],
      'moneda' => $row['MONEDA'],
      'notif' => countNot($row['TICKET']),
      'estatus' => $row['ESTATUS']);
      }
    }
    echo json_encode($obj);
}

if(isset($_GET['readHistorialAdmin'])) {
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $colorAlert = "#F96E1F";
    $consulta = "select * from APUESTAS ORDER BY FECHA";
    echo "
    <table style='width:100%; '>
      <thead>
      <th>Finaliza el</th>
      <th>Faltan Dias</th>
      <th>Suscripcion</th>
      <th>Tipo</th>
      <th>Monto Usdc</th>
      <th>Cliente</th>      
      <th>Estatus</th>
      </thead>
      <tbody>
    ";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){
      $color="transparent";
      if($row['ACTIVO']==0){
        $color="#AED6F1";
      }
      
     echo "<tr style='background:{$color};'>
      <td><span>".$row['FIN']."</span></td>
      <td><span>".calcularDiasEntreFechas(date("Y-m-d"), $row['FIN'])."</span></td>
      <td><span>".$row['JUEGO']."USDT</span></td>
      <td><span>".$row['TIPO']."</span></td>      
      <td><span>".price($row['MONTO'])."</span></td>      
      <td><span>".$row['CLIENTE']."</span></td>      
      <td><span>".$row['ESTATUS']."</span></td>      
      </tr>";
    }

    echo "</tbody></table>";
    mysqli_close($conexion);
  }
}

if(isset($_GET['readDepositos'])) {
  $obj = array();
  $correo = $_GET['correo'];
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $consulta = "select * from TRANSACCIONES WHERE TIPO='DEPOSITO' AND CLIENTE='$correo' ORDER BY FECHA DESC";
  $resultado = mysqli_query( $conexion, $consulta );
  while($row = mysqli_fetch_array($resultado)){
    $obj[] = array('fecha' => latinFecha($row['FECHA']),
    'id' => $row['ID'],
    'ticket' => $row['TICKET'],
    'descripcion' => $row['DESCRIPCION'],
    'monto' => price($row['MONTO']),
    'cliente' => $row['CLIENTE'],
    'cajero' => $row['CAJERO'],
    'pagado' => $row['PAGADO'],
    'estatus' => $row['ESTATUS']);
  }
  mysqli_close($conexion);
  echo json_encode($obj);
}

if(isset($_GET['readRetiros'])) {
  $obj = array();
  $correo = $_GET['correo'];
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  $consulta = "select * from TRANSACCIONES WHERE TIPO='RETIRO' AND CLIENTE='$correo' ORDER BY FECHA DESC";
  $resultado = mysqli_query( $conexion, $consulta );
  while($row = mysqli_fetch_array($resultado)){
    $obj[] = array('fecha' => latinFecha($row['FECHA']),
    'id' => $row['ID'],
    'ticket' => $row['TICKET'],
    'descripcion' => $row['DESCRIPCION'],
    'monto' => price($row['MONTO']),
    'cliente' => $row['CLIENTE'],
    'cajero' => $row['CAJERO'],
    'pagado' => $row['PAGADO'],
    'estatus' => $row['ESTATUS']);
  }
  mysqli_close($conexion);
  echo json_encode($obj);
}

if(isset($_GET['readHistorial'])) {
  $obj = array();
  $cliente = $_GET['cliente'];
  $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
    echo "Refresh page, Failed to connect to Data...";
    exit();
  }else{
    $consulta = "select * from APUESTAS WHERE CLIENTE='{$cliente}' ORDER BY FECHA DESC";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_array($resultado)){     
      $obj[] = array(
      'id' => $row['ID'],
      'fecha' => latinFecha($row['FECHA']),
      'inicio' => latinFecha($row['INICIO']),
      'fin' => latinFecha($row['FIN']), 
      'ticket' => $row['TICKET'],
      'tipo' => $row['TIPO'],
      'idjuego' => $row['IDJUEGO'],
      'juego' => $row['JUEGO'],
      'cajero' => $row['CAJERO'],
      'cliente' => $row['CLIENTE'],
      'porciento' => $row['PORCIENTO'],
      'monto' => price($row['MONTO']),
      'interes_mensual' => price($row['INTERES_MENSUAL']),
      'cuota_mensual' => price($row['CUOTA_MENSUAL']),
      'total_pagar' => price($row['TOTAL_PAGAR']),
      'n_pagos' => $row['N_PAGOS'],
      'pagados' => $row['PAGADOS'],
      'activo' => $row['ACTIVO'],
      'estatus' => $row['ESTATUS'],
      'faltan_dias' => calcularDiasEntreFechas( date("Y/m/d"), $row['FIN']));
    }
    mysqli_close($conexion);
    echo json_encode($obj);
  }
}

if(isset($_POST['borrar'])){
    //sqlconector("DELETE FROM JUEGOS WHERE ID={$_POST['borrar']}");
    sqlconector("UPDATE JUEGOS SET ELIMINADO=1 WHERE ID={$_POST['borrar']}");
}

if(isset($_POST['setAnalis'])){
  $consulta = "UPDATE JUEGOS SET ANALISIS='".$_POST['analisis']."' WHERE ID=".$_POST['setAnalis'];
  sqlconector($consulta);
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
 
  sqlconector("UPDATE TRANSACCIONES SET ESTATUS='{$_POST['setEstatus']}' WHERE TICKET='{$_POST['idapuesta']}'");
  
  if($_POST['setEstatus'] == "EXITOSO"){
    sqlconector("UPDATE TRANSACCIONES SET PAGADO=1 WHERE TICKET='{$_POST['idapuesta']}'");    
    $correo = readTransaccionTicket($_POST['idapuesta'])['CLIENTE'];
    
    if(readTransaccionTicket($_POST['idapuesta'])['TIPO'] == "DEPOSITO"){
      $monto = readTransaccionTicket($_POST['idapuesta'])['MONTO'];      
      $saldo= readCliente($correo)['SALDO'] + $monto;
      sqlconector("UPDATE USUARIOS SET SALDO={$saldo} WHERE CORREO='{$correo}'");    

      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "criptosignalgroup@criptosignalgroup.online";
      $to = $correo;
      $subject = "Transaccion de Deposito Cripto Signal Group";
      $message = "Tu transaccion de deposito ha sido marcada con el estatus Exitoso, puedes consultar tu saldo ";
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);           
    }
    elseif (readTransaccionTicket($_POST['idapuesta'])['TIPO'] == "RETIRO"){
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "criptosignalgroup@criptosignalgroup.online";
      $to = $correo;
      $subject = "Transaccion de Retiro Cripto Signal Group";
      $message = "Tu Retiro ha sido marcada con el estatus Exitoso, puedes consultar tu saldo en tu wallet de destino.! gracias por preferirnos ";
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);                 
    }
  }
}

if(isset($_POST['crear'])){
    sqlconector("INSERT INTO JUEGOS(JUEGO,CAJERO,MIN,DESCRIPCION,TIPO,FAVORITO,RATE,MONTO,PORCIENTO,PORADELANTADO) VALUES(
      '{$_POST['nombre']}',
      '{$_POST['cajero']}',
      {$_POST['min']},      
      '{$_POST['descripcion']}',
      '{$_POST['tipo']}',
      {$_POST['favorito']},
      {$_POST['rate']},
      {$_POST['monto']},
      {$_POST['porciento']},
      {$_POST['poradelantado']}
    )");
}

if(isset($_POST['crearPromo'])){
  sqlconector("INSERT INTO PROMO(NOMBRE,CODIGO,MENSAJE,DIFUSION,FLOTANTE) VALUES(
    '{$_POST['nombre']}',
    '".generaTicket()."',
    '{$_POST['mensaje']}',
    {$_POST['promoDifu']},
    {$_POST['promoFlotante']}
  )");
}

if(isset($_POST['guardarWallet'])){
  $result = false;
  if (sqlconector("UPDATE USUARIOS SET BINANCE='{$_POST['payid']}' WHERE CORREO='{$_POST['correo']}'")){
    $result = true; 
  }

  $obj = array('result' => $result);
  echo json_encode($obj);
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

?>