<?php
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://apis.google.com");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");

include "modulo.php";

if(isset($_SESSION['user'])){

  if(isset($_POST['verifiUser'])){
    $correo = $_POST['correo'];
    $obj = array('exist' => false, 'saldo' => 0.00);
    if(ifUsuarioExist($correo)){
      $cliente = readCliente($correo);
      $obj = array('exist' => true, 'saldo' => $cliente['SALDO']);
    }
    echo json_encode($obj);
  }
  
  if(isset($_POST['retirar'])){
    $wallet_comisiones = $_POST['cajero'];
    $ticket = generaTicket();
    $monto = $_POST['monto'];
    $recibe = $_POST['recibe'];
    $comision = $_POST['comision'];
    $cajero = $_POST['cajero'];
    $cliente = $_POST['correo'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $descripcion= $_POST['tipo'];
    $comopago = $_POST['comopago'];
    $moneda = $_POST['moneda'];
  
    sqlconector("INSERT INTO TRANSACCIONES (TICKET,TIPO,DESCRIPCION,CAJERO,CLIENTE,ORIGEN,DESTINO,MEDIO_PAGO,MONTO,RECIBE,MONEDA) VALUES(
        '$ticket',
        'RETIRO',
        '$descripcion',
        '$cajero',
        '$cliente',
        '$origen',
        '$destino',      
        '$comopago',      
        $monto,
        $recibe,
        '$moneda')");
  
      $saldo= readCliente($cliente)['SALDO'] - $monto;
      sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
      $saldo_comision = readCliente($wallet_comisiones)['SALDO'] + $comision;
      sqlconector("UPDATE USUARIOS SET SALDO = $saldo_comision WHERE CORREO='$wallet_comisiones'");
  
      $para = $cajero;
      $asunto = "Tienes un Retiro Pendiente por ejecutar";
      $mensaje = "Retiro Pendiente por ejecutar de $cliente por un monto de: $recibe por la plataforma $comopago";
      $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
      $cabeceras .= "MIME-Version: 1.0" . "\r\n";
      $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  
      if(mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "Correo enviado exitosamente.";
      } else {
          echo "Error al enviar el correo.";
      }   
  }
    
  if(isset($_POST['depositar'])){ 
    $ticket = generaTicket();
    $monto = $_POST['cantidad'];
    $cajero = $_POST['cajero'];
    $cliente = $_POST['correo'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $descripcion= $_POST['tipo'];
    $comopago = $_POST['comopago'];
    $moneda = $_POST['moneda'];
  
    sqlconector("INSERT INTO TRANSACCIONES (TICKET,DESCRIPCION,CAJERO,CLIENTE,ORIGEN,DESTINO,MEDIO_PAGO,MONTO,RECIBE,MONEDA) VALUES(
        '$ticket',
        '$descripcion',
        '$cajero',
        '$cliente',
        '$origen',
        '$destino',
        '$comopago',        
        $monto,
        $monto,
        '$moneda')");
  
    $para = $cajero;
    $asunto = "Tienes un deposito Pendiente";
    $mensaje = "Deposito Pendiente por revisar de $cliente por un monto de: $monto por la plataforma $comopago";
    $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
    $cabeceras .= "MIME-Version: 1.0" . "\r\n";
    $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  
    if(mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "Correo enviado exitosamente.";
    } else {
        echo "Error al enviar el correo.";
    }
  }
  
  if(isset($_POST['addpar'])){
    if(!ifMonedaExist($_POST['moneda'])){
      sqlconector("UPDATE DATOS SET ACTIVO=0");
      sqlconector("INSERT INTO DATOS(MONEDA,ASSET,ACTIVO) VALUES('{$_POST['moneda']}','{$_POST['asset']}',0)");
    }
    refreshDatos($_POST['moneda']);
  }
  
  if(isset($_POST['deletepar'])){  
    sqlconector("DELETE FROM DATOS WHERE MONEDA='{$_POST['deletepar']}'");
    sqlconector("DELETE FROM PRICES WHERE MONEDA='{$_POST['deletepar']}'");
    sqlconector("UPDATE DATOS SET ACTIVO=0");
  }
  
  if(isset($_GET{'listMonedas'})){
    echo json_encode (array_sqlconector("SELECT * FROM DATOS"));
  }
  
  if(isset($_GET['getPriceBinance'])){
        refreshDataAuto();
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
        $devuelveCapital = $suscripcion['DEVUELVE_CAPITAL'];
        $imagen = $suscripcion['IMAGEN'];
        $foreground = $suscripcion['FOREGROUND'];
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
        
        $consulta = "INSERT INTO APUESTAS (INICIO,FIN,TICKET,TIPO,IDJUEGO,JUEGO,CAJERO,CLIENTE,IMAGEN,FOREGROUND,MONTO,PORCIENTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR,N_PAGOS,DEVUELVE_CAPITAL) VALUES(
            '$fechaInicial',
            '$fechaFinal',
            '$ticket',
            '$tipo',
             $idJuego,
            '$juego',
            '$cajero',
            '$correo',
            '$imagen',
            '$foreground',
             $monto,
             $porciento,
             $interesMensual,
             $cuotaMensual,
             $totalCuotas,
             $numeroPagos,
             $devuelveCapital)";
        
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

        if($inversion == 1){
          //LA LOGICA SI ES UNA INVERSION QUE PAGA INTERESES MENSUALES
          $fechas = obtenerIntervalosMensuales($fechaInicial, $fechaFinal);
          foreach ($fechas as $fecha) {
            sqlconector("INSERT INTO LIBROCONTABLE(FECHA,TICKET,TIPO,IDJUEGO,INVERSION,JUEGO,CAJERO,CLIENTE,INTERES_ADELANTADO,MONTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR,DEVUELVE_CAPITAL) VALUES(
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
             $totalCuotas,
             $devuelveCapital
            )");
          }
        }
        else{
          //LA LOGICA SI ES UNA SUSCRIPCION QUE COBRA INTERESES DE ACUERDO A LA FECHA
          $fechas = array($fechaInicial, $fechaFinal);
          foreach ($fechas as $fecha) {
              sqlconector("INSERT INTO LIBROCONTABLE(FECHA,TICKET,TIPO,IDJUEGO,INVERSION,JUEGO,CAJERO,CLIENTE,INTERES_ADELANTADO,MONTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR,DEVUELVE_CAPITAL) VALUES(
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
                  $totalCuotas,
                  $devuelveCapital
              )");
          }
        }
  
        sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE TICKET='$ticket' AND FECHA='$fechaInicial'");
  }
    
  if(isset($_GET{'listCajeros'})){
    echo json_encode (array_sqlconector("SELECT * FROM USUARIOS WHERE NIVEL=1"));
  }
  
  if(isset($_POST['getUsuario'])){ 
    $correo = $_POST['correo'];
    $respuestaClave = array('success' => false);
    $obj = array('result' => false, 'capcha' => $respuestaClave,'paso'=>false,'verificado' => 0);
  
    if(isset($_POST['sesion'])){
      $usuario = readCliente($correo);
      $obj = array('nombre' => $usuario['NOMBRE'],'correo' => $usuario['CORREO'], 
      'binance' => $usuario['BINANCE'], 'bep20' => $usuario['BEP20'],'bloqueado' => $usuario['BLOQUEADO'],
      'nivel' => $usuario['NIVEL'],'activo' => $usuario['ACTIVO'],'rate' => $usuario['RATE'],
      'saldo' => price($usuario['SALDO']),'verificado' => $usuario['VERIFICADO']);
    }
  
      echo json_encode($obj);
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
    $correo = $_GET['correo'];
    $analisis = "";
    $activo = true;
    $interes = 0;
    $pagaIntereses = false;
    
    $obj = array();
    $consulta = "select * from APUESTAS WHERE ELIMINADO=0 AND CLIENTE='$correo' ORDER BY FECHA";
    $resultado = sqlconector($consulta);
    
    if($resultado){
      while($row = mysqli_fetch_assoc($resultado)){
        $fecha = latinFecha($row['FECHA']);
        $bloqueo = readJuegoId($row['IDJUEGO'])['BLOQUEADO'];
        $imagen= $row['IMAGEN'];
        $foreground = $row['FOREGROUND'];
        $titulo = strip_tags($row['JUEGO']);
        $estrellas = readJuegoId($row['IDJUEGO'])['RATE'];
        $costo = price($row['MONTO']);
        $interes = price($row['INTERES_MENSUAL']);
        $pagaIntereses = false;
  
        if(readJuegoId($row['IDJUEGO'])['PORCIENTO'] > 0){
        $pagaIntereses = true;
        }		  
       if($row['ACTIVO']==0){     
        $activo = false;
       }
       else{
          if( isset(readJuegoId($row['IDJUEGO'])['ANALISIS']) ){
            $analisis = readJuegoId($row['IDJUEGO'])['ANALISIS'];
          }
          else{
            $analisis = readJuegoId($row['IDJUEGO'])['DESCRIPCION'];
          }
          foreach ($GLOBALS as $clave => $valor) {
            if (strpos($analisis, $clave) !== false) {
                $analisis = str_replace($clave, $valor, $analisis);
            }
          }          
        }
        
        $obj[]= array(
        'id' => $row['ID'],
        'idJuego' => $row['IDJUEGO'],
        'correo'=>$correo, 
        'fecha'=>$fecha,
        'bloqueo'=>$bloqueo,
        'imagen'=>$imagen,
        'foreground'=>$foreground,
        'pagaIntereses'=>$pagaIntereses,
        'titulo'=>$titulo,
        'analisis'=>$analisis,
        'estrellas'=>$estrellas,
        'interes'=>$interes,
        'pagaIntereses'=>$pagaIntereses,
        'activo'=>$activo,
        'costo'=>$costo);
      }	
    }
    echo json_encode($obj);
  }
  
  if(isset($_GET['getJugadas'])) {
    $correo = $_GET['correo'];
    $sesion = false;
    $suscripcionExiste = false;
    $pagaIntereses = false;
    
    if(isset($_SESSION['user'])){
      $sesion = true;
    }
  
    $obj = array();
    $consulta = "select * from JUEGOS WHERE ELIMINADO=0 AND FAVORITO=0 ORDER BY FECHA";
     
    $resultado = sqlconector($consulta );
    
    if($resultado){
      while($row = mysqli_fetch_assoc($resultado)){
        $fecha = latinFecha($row['FECHA']);
        $bloqueo = $row['BLOQUEADO'];
        $imagen= $row['IMAGEN'];
        $foreground = $row['FOREGROUND'];
        $favorito = $row['FAVORITO'];
        $suscripcionExiste = false;
        $pagaIntereses = false;
        $titulo = strip_tags($row['JUEGO']);
        $detalle = strip_tags($row['DESCRIPCION']);
        $estrellas = $row['RATE'];
        $costo = price($row['MONTO']);
        
        if(strlen($correo) > 0 ){ 
          if(ifClienteJuegoExist($row['ID'],$correo)){				  
            $suscripcionExiste = true;
          if($row['PORCIENTO'] > 0){
            $pagaIntereses = true;
          }
          }
        }        			  
  
        $obj[]= array(
        'id' => $row['ID'],
        'correo'=>$correo, 
        'fecha'=>$fecha,
        'bloqueo'=>$bloqueo,
        'imagen'=>$imagen,
        'foreground'=>$foreground,
        'favorito'=>$favorito,
        'sesion'=>$sesion,
        'suscripcionExiste'=>$suscripcionExiste,
        'pagaIntereses'=>$pagaIntereses,
        'titulo'=>$titulo,
        'detalle'=>$detalle,
        'estrellas'=>$estrellas,
        'costo'=>$costo);
      }
    }
    echo json_encode($obj);
  }
  
  if( isset($_GET['bot']) ){
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    $consulta = "select * from USUARIOS";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_assoc($resultado)){
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
      $resultado = mysqli_query( $conexion, $consulta );
      while($row = mysqli_fetch_assoc($resultado)){
        $difu = "";
        $flotante = "";
        if($row['DIFUSION']==1){
          $difu = "Correo";
        }
        if($row['FLOTANTE']==1){
          $flotante = "Flotante";
        }       
  
        $fecha = latinFecha($row['FECHA']);
       echo "<tr>
        <td>".$fecha."</td>
        <td>".$row['NOMBRE']."</td>
        <td>".$row['MENSAJE']."</td>
        <td>{$difu}{$flotante}</td>
        <td style='text-align: left;'>
          <button title='Eliminar Promocion' type='button' class='retire-button' onclick=\"borrar('".$row['CODIGO']."')\">Borrar</button>        
        </td>
        </tr>";
      }
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
  
        $resultado = mysqli_query( $conexion, $consulta );
        while($row = mysqli_fetch_assoc($resultado)){
          $bloqueo = "";
          if($row['BLOQUEADO']==1){
            $bloqueo = "checked";
          }
          $fecha = latinFecha($row['FECHA']); 
         echo "<tr>
          <td>{$fecha}</td>
          <td>".$row['JUEGO']."</td>
          <td title='".strip_tags($row['DESCRIPCION'])."'>".$row['DESCRIPCION']."</td>
          <td>".$row['TIPO']."</td>
          <td>".price($row['MONTO'])."</td>
          <td>";
            if($row['PORCIENTO'] == 0){
              echo "<button title='Analisis' type='button' class='add-button' onclick=\"analisis('".$row['ID']."')\">Analisis</button>";
            }

            if($row['FAVORITO']==1){
              echo "<button title='Tarjeta de Regalo' type='button' class='binance-button' onclick=\"enviar_regalo('".$row['ID']."')\">Enviar Regalo</button>";
            }
            
            echo "<button title='Borrar' type='button' class='retire-button' onclick=\"borrar('".$row['ID']."')\">Borrar</button>
            <label for='cerrar{$row['ID']}'><input id='cerrar{$row['ID']}' type='checkbox' {$bloqueo} onclick=\"cerrar(".$row['ID'].")\">Bloquear</label>          
          </td>
          </tr>";
        }
        mysqli_close($conexion);
      }
  }
  
  if(isset($_GET['readTrabajos'])) {  
    function countNot($Idpedido){
      $total = 0;
      $resultado = sqlconector("SELECT COUNT(IDPEDIDO) AS TOTAL FROM NOTIFICACIONES WHERE IDPEDIDO='$Idpedido' AND VISTO = 0 AND IDUSUARIO = ".readCliente($_GET['correo'])['ID']);
      if($resultado){
        $row = mysqli_fetch_assoc($resultado);
        $total = $row['TOTAL'];
      }
      return $total;
    }
  
      $obj= array();
      $consulta = "select * from TRANSACCIONES WHERE ELIMINADO=0 AND PAGADO=0 ORDER BY FECHA"; 
      $resultado = sqlconector($consulta);
      if($resultado){
        while($row = mysqli_fetch_assoc($resultado)){
          $obj[]= array('id' => $row['ID'],
        'fecha' => latinFecha($row['FECHA']),
        'ticket' => $row['TICKET'],
        'descripcion' => $row['DESCRIPCION'],
        'cliente' => $row['CLIENTE'],
        'cajero' => $row['CAJERO'],
        'tipo' => $row['TIPO'],
        'medio_pago' => $row['MEDIO_PAGO'],      
        'wallet' => $row['WALLET'],
        'origen' => $row['ORIGEN'],      
        'destino' => $row['DESTINO'],      
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
    $obj = array();
    $consulta = "select * from APUESTAS ORDER BY FECHA";
    $resultado = sqlconector( $consulta );
  
      if($resultado){
        while($row = mysqli_fetch_assoc($resultado)){
          $color="transparent";
          $binance = readCliente($row['CLIENTE'])['BINANCE'];
          $bep20 = readCliente($row['CLIENTE'])['BEP20'];
          if($row['ACTIVO']==0){
            $color="#AED6F1";
          }
  
          $obj[] = array('color'=>$color,
          'fin' =>$row['FIN'],
          'dias'=>calcularDiasEntreFechas(date("Y-m-d"), $row['FIN']),
          'suscripcion' =>$row['JUEGO'],
          'tipo' =>$row['TIPO'],
          'monto' => price($row['MONTO']),
          'cliente' => $row['CLIENTE'],
          'estatus'=>$row['ESTATUS'],
          'binance'=>$binance,
          'bep20'=>$bep20);
        }
      }
      
      echo json_encode($obj);
  }
  
  if(isset($_POST['setCal'])){
    $id = $_POST['id'];
    $rate = $_POST['rate'];
    $cajero = $_POST['cajero'];
  
    sqlconector("UPDATE TRANSACCIONES SET RATE=$rate, CALIFICADO=1 WHERE ID=$id");
    $calificacion = obtenerCalificaciones($cajero);
    $promedio = calcularPromedio($calificacion);
    sqlconector("UPDATE USUARIOS SET RATE=$promedio WHERE CORREO='$cajero'");
  }
  
  if(isset($_GET['readDepositos'])) {
    $obj = array();
    $correo = $_GET['correo'];
    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
    $consulta = "select * from TRANSACCIONES WHERE TIPO='DEPOSITO' AND CLIENTE='$correo' ORDER BY FECHA DESC";
    $resultado = mysqli_query( $conexion, $consulta );
    while($row = mysqli_fetch_assoc($resultado)){
      $obj[] = array('fecha' => latinFecha($row['FECHA']),
      'id' => $row['ID'],
      'ticket' => $row['TICKET'],
      'descripcion' => $row['DESCRIPCION'],
      'monto' => price($row['MONTO']),
      'cliente' => $row['CLIENTE'],
      'cajero' => $row['CAJERO'],
      'pagado' => $row['PAGADO'],
      'rate' => $row['RATE'],
      'calificado' => $row['CALIFICADO'],    
      'moneda' => $row['MONEDA'],
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
    while($row = mysqli_fetch_assoc($resultado)){
      $obj[] = array('fecha' => latinFecha($row['FECHA']),
      'id' => $row['ID'],
      'ticket' => $row['TICKET'],
      'descripcion' => $row['DESCRIPCION'],
      'monto' => price($row['MONTO']),
      'cliente' => $row['CLIENTE'],
      'cajero' => $row['CAJERO'],
      'pagado' => $row['PAGADO'],
      'rate' => $row['RATE'],
      'moneda' => $row['MONEDA'],
      'calificado' => $row['CALIFICADO'],
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
      while($row = mysqli_fetch_assoc($resultado)){     
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
  
        $para = $correo;
        $asunto = "Transaccion de Deposito CryptoSignal";
        $mensaje = "Tu transaccion de deposito ha sido marcada con el estatus Exitoso, puedes consultar tu saldo ";
        $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
        $cabeceras .= "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        if(mail($para, $asunto, $mensaje, $cabeceras)) {
            echo "Correo enviado exitosamente.";
        } else {
            echo "Error al enviar el correo.";
        }
      }
      elseif (readTransaccionTicket($_POST['idapuesta'])['TIPO'] == "RETIRO"){
        $para = $correo;
        $asunto = "Transaccion de Retiro CryptoSignal";
        $mensaje = "Tu Retiro ha sido marcada con el estatus Exitoso, puedes consultar tu saldo en tu wallet de destino.! gracias por preferirnos ";
        $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
        $cabeceras .= "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        if(mail($para, $asunto, $mensaje, $cabeceras)) {
          echo "Correo enviado exitosamente.";
        } else {
            echo "Error al enviar el correo.";
        }
  
      }
    }
  }
  
  if(isset($_POST['crear'])){
      sqlconector("INSERT INTO JUEGOS(JUEGO,CAJERO,MIN,DESCRIPCION,TIPO,IMAGEN,FOREGROUND,FAVORITO,RATE,MONTO,PORCIENTO,PORADELANTADO,DEVUELVE_CAPITAL) VALUES(
        '{$_POST['nombre']}',
        '{$_POST['cajero']}',
        {$_POST['min']},      
        '{$_POST['descripcion']}',
        '{$_POST['tipo']}',
        '{$_POST['imagen']}',
        '{$_POST['foreground']}',
        {$_POST['favorito']},
        {$_POST['rate']},
        {$_POST['monto']},
        {$_POST['porciento']},
        {$_POST['poradelantado']},
        {$_POST['devuelveCapital']})");
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
  
  if(isset($_POST['guardarWalletBep20'])){
    $result = false;
    if (sqlconector("UPDATE USUARIOS SET BEP20='{$_POST['bep20']}' WHERE CORREO='{$_POST['correo']}'")){
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
    while($row = mysqli_fetch_assoc($resultado)){
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
    while($row = mysqli_fetch_assoc($resultado)){
      sendMail($row['CORREO'],readMailPromo()['NOMBRE'],readMailPromo()['MENSAJE']);
      setEnviado($row['CORREO'],1);
      if($i == 4) break;
      $i++;
    }
  }
}
else{
  if(isset($_POST['getUsuario'])){ 
    $correo = $_POST['correo'];
    $respuestaClave = array('success' => false);
    $obj = array('result' => false, 'capcha' => $respuestaClave,'paso'=>false,'verificado' => 0);
  
    if(isset($_POST['grecaptcharesponse'])){
      $captcha = $_POST["grecaptcharesponse"];
      /* Clave secreta del server
      $claveSecreta = "6Lf1Ky8qAAAAAAdntOC-lxAPuEniXRNqQd0h2urG";
      */
      /* Clave secreta del localhost
      $claveSecreta = "6Ld1nA0aAAAAAJps4LCRTs7jfshN9GNjZAghnt0f";
      */
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

  if(isset($_GET['getJugadas'])) {
    $correo = $_GET['correo'];
    $sesion = false;
    $suscripcionExiste = false;
    $pagaIntereses = false;
    
    if(isset($_SESSION['user'])){
      $sesion = true;
    }
  
    $obj = array();
    $consulta = "select * from JUEGOS WHERE ELIMINADO=0 AND FAVORITO=0 ORDER BY FECHA";
     
    $resultado = sqlconector($consulta );
    
    if($resultado){
      while($row = mysqli_fetch_assoc($resultado)){
        $fecha = latinFecha($row['FECHA']);
        $bloqueo = $row['BLOQUEADO'];
        $imagen= $row['IMAGEN'];
        $foreground = $row['FOREGROUND'];
        $favorito = $row['FAVORITO'];
        $suscripcionExiste = false;
        $pagaIntereses = false;
        $titulo = strip_tags($row['JUEGO']);
        $detalle = strip_tags($row['DESCRIPCION']);
        $estrellas = $row['RATE'];
        $costo = price($row['MONTO']);
        
        if(strlen($correo) > 0 ){ 
          if(ifClienteJuegoExist($row['ID'],$correo)){				  
            $suscripcionExiste = true;
          if($row['PORCIENTO'] > 0){
            $pagaIntereses = true;
          }
          }
        }        			  
  
        $obj[]= array(
        'id' => $row['ID'],
        'correo'=>$correo, 
        'fecha'=>$fecha,
        'bloqueo'=>$bloqueo,
        'imagen'=>$imagen,
        'foreground'=>$foreground,
        'favorito'=>$favorito,
        'sesion'=>$sesion,
        'suscripcionExiste'=>$suscripcionExiste,
        'pagaIntereses'=>$pagaIntereses,
        'titulo'=>$titulo,
        'detalle'=>$detalle,
        'estrellas'=>$estrellas,
        'costo'=>$costo);
      }
    }
    echo json_encode($obj);
  }

  if(isset($_POST['sendmail'])){
    $usuario = readCliente($_POST['correo']);
  
    $correo = $usuario['CORREO'];
    $vkey = $usuario['VKEY'];
    $para = $correo;
    $asunto = "Verificación de correo electrónico";
    $mensaje = "<a href='http://criptosignalgroup.online/verificarEmail?vkey=$vkey'>Verificar Cuenta</a>";
    $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
    $cabeceras .= "MIME-Version: 1.0" . "\r\n";
    $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  
    mail($para, $asunto, $mensaje, $cabeceras);  
  }  

}

?>