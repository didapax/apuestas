<?php
require "init.php";
require "php-binance-api.php";
session_start();

// Variables clave para las estadisticas
$GLOBALS['__TOTALUSUARIOS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM USUARIOS")['TOTAL'];
$GLOBALS['__DEPOSITOS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM TRANSACCIONES WHERE TIPO='DEPOSITO'")['TOTAL'];
$GLOBALS['__RETIROS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM TRANSACCIONES WHERE TIPO='RETIRO'")['TOTAL'];

function generaTicket(){
    $bytes = random_bytes(8);
	  $referencia = bin2hex($bytes);
    return $referencia;
}

function obtenerCalificaciones($cajero) {
  $calificaciones = [];
  $consulta = "SELECT RATE FROM TRANSACCIONES WHERE CAJERO='$cajero'";   
  $resultado = sqlconector($consulta);

  if ($resultado) {
      while ($fila = mysqli_fetch_assoc($resultado)) {
          $calificaciones[] = (int)$fila['RATE'];
      }
  }

  return $calificaciones;
}

function calcularPromedio($calificaciones) {
  $totalCalificaciones = count($calificaciones);
  $sumaCalificaciones = array_sum($calificaciones);
  
  if ($totalCalificaciones > 0) {
      $promedio = $sumaCalificaciones / $totalCalificaciones;
  } else {
      $promedio = 0;
  }
  
  return round($promedio);
}

/* example 
$calificaciones = [5, 2, 4, 3, 5,5,5,5,5,3,4,5,5,4,5,5,5,5,5]; // Puedes agregar más calificaciones aquí
$promedio = calcularPromedio($calificaciones);
echo "El promedio de las calificaciones es: " . $promedio;
*/

function obtenerIntervalosMensuales($fechaInicio, $fechaFin) {
  $inicio = new DateTime($fechaInicio);
  $fin = new DateTime($fechaFin);
  $intervalo = new DateInterval('P1M');
  $periodo = new DatePeriod($inicio, $intervalo, $fin->add($intervalo));

  $fechas = [];
  foreach ($periodo as $fecha) {
      $fechas[] = $fecha->format('Y-m-d');
  }

  return $fechas;
}

function calcularFechaDespuesDeUnMes($fecha, $meses) {
  // Convierte la fecha a un objeto DateTime
  $fechaObjeto = new DateTime($fecha);

  // Agrega N meses al objeto DateTime (reemplaza N con el valor real)
  $fechaObjeto->modify("+$meses month");

  // Formatea la fecha resultante en el formato deseado (por ejemplo, 'Y-m-d')
  $fechaFinal = $fechaObjeto->format('Y-m-d');

  return $fechaFinal;
}

function calcularDiasEntreFechas($fechaInicial, $fechaFinal) {
  $fechaInicio = new DateTime($fechaInicial);
  $fechaFin = new DateTime($fechaFinal);

  $diferencia = $fechaInicio->diff($fechaFin);

  return $diferencia->format('%a');
}

function calcularInteresMensual($capital, $tasaInteresAnual, $meses) {
  // Convertir la tasa de interés anual a mensual
  $tasaInteresMensual = $tasaInteresAnual / 12 / 100;

  // Si la tasa de interés es cero, la cuota mensual es simplemente el capital dividido por el número de meses
  if ($tasaInteresMensual == 0) {
      $cuotaMensual = $capital / $meses;
      $interesMensual = 0;
  } else {
      // Calcular el interés mensual
      $interesMensual = $capital * $tasaInteresMensual;

      // Calcular la cuota mensual
      $cuotaMensual = $capital * $tasaInteresMensual / (1 - pow(1 + $tasaInteresMensual, -$meses));
  }

  return array(
      'interesMensual' => $interesMensual,
      'cuotaMensual' => $cuotaMensual
  );
}

function recalcularSuscripciones($correo){
  $resultado = sqlconector("SELECT * FROM LIBROCONTABLE WHERE CLIENTE='$correo' AND PAGADO=0 AND ACTIVO=1");
  if($resultado){
    while ($row = mysqli_fetch_assoc($resultado)) {
      $inversion = $row['INVERSION'];
      $devuelveCapital = $row['DEVUELVE_CAPITAL'];
      $interes_adelantado = $row['INTERES_ADELANTADO'];
      $capital = $row['MONTO'];
      $interes = $row['INTERES_MENSUAL'];
      $saldo = readCliente($row['CLIENTE'])['SALDO'];
      $dia_actual = date("Y-m-d");
      $vencimiento = $row['FECHA'];
      $ticket = $row['TICKET'];
      $cliente = $row['CLIENTE'];
      $suscripcion = readApuestaTicket($ticket);
      $n_pagos = $suscripcion['N_PAGOS'];
      $id_ticket = 0;

      if($inversion==1){
        if($interes_adelantado == 1){
          //la logica si tiene interes adelantado
          if($vencimiento <= $dia_actual){
            //calcula el id actual a menejar
            $id_ticket = $row["ID"];

            if($n_pagos > 1){
              $valor = $n_pagos - 1;
              sqlconector("UPDATE APUESTAS SET N_PAGOS=$valor WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
            else{
              $saldo = readCliente($cliente)['SALDO'] + $capital;
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
              sqlconector("UPDATE APUESTAS SET PAGADOS=1, ACTIVO=0, ELIMINADO=1,ESTATUS='CERRADO' WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
          }
        }
        else{
          //la logica si es solo una inversion
          if($vencimiento <= $dia_actual){
            //calcula el id actual a menejar
            $id_ticket = $row["ID"];
            if($n_pagos > 1){
              $saldo = readCliente($cliente)['SALDO'] + $interes;
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");              
              $valor = $n_pagos - 1;
              sqlconector("UPDATE APUESTAS SET N_PAGOS=$valor WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
            else{
              if($devuelveCapital == 0){
                $saldo = readCliente($cliente)['SALDO'] + $interes;
              }
              else{
                $saldo = readCliente($cliente)['SALDO'] + $capital + $interes;
              }              
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
              sqlconector("UPDATE APUESTAS SET PAGADOS=1, ACTIVO=0, ELIMINADO=1,ESTATUS='CERRADO' WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");              
            }
          }
        }
      }
      else{
        //La logica si es una suscripcion
        if($vencimiento <= $dia_actual){
          //calcula el id actual a menejar
          $id_ticket = $row["ID"];
          if(readCliente($cliente)['SALDO'] >= $capital){
            $idJuego = $row['IDJUEGO'];
            $juego = $row['JUEGO'];
            $cajero =$row['CAJERO'];
            $saldo = readCliente($cliente)['SALDO'] - $capital;
            sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
            sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
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
              '$correo',
               0,
               $capital,
               0,
               $capital,
               $capital
              )");            
          }else{
            sqlconector("UPDATE APUESTAS SET ACTIVO=0, ESTATUS='NO PAGO' WHERE TICKET='$ticket'");
          }     
        }
      }

    }
  }
}

function detalleInversion($tipo='MENSUAL',$monto=1,$porciento=1){
  $obj = array();
  $numMes;
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

  $obj = array('numeroPagos'=>$numeroPagos, 'cuotaMensual'=>$cuotaMensual,'interesMensual'=>$interesMensual,'totalCuotas'=>$totalCuotas);
  return $obj;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sqlApiKey(){
  return readParametros()['APIKEY'];
}

function sqlApiSecret(){
  return readParametros()['SECRET'];
}

function ifMonedaExist($moneda) {
  if(row_sqlconector("select COUNT(*) AS TOTAL from DATOS where MONEDA='{$moneda}'")['TOTAL']==1 )
  return TRUE;
  return FALSE;
}

function readDatos($mon){
  return row_sqlconector("select * from DATOS WHERE MONEDA='$mon'");
}

function readDatosMoneda($moneda){
  return row_sqlconector("select * from DATOS WHERE MONEDA='{$moneda}'");
}

function readParametros(){
  return row_sqlconector("select * from PARAMETROS");
}

function readPrices($moneda) {
  // Validar que la moneda no esté vacía
  if (strlen($moneda) > 0) {
      // Verificar si no existe un registro para el día actual
      if (ifNotDayExists("PRICES", $moneda)) {
          // Insertar un nuevo registro
          sqlconector("INSERT INTO PRICES (MONEDA) VALUES ('{$moneda}')");
      }
      
      // Obtener los precios del día actual
      $query = "SELECT * FROM PRICES WHERE MONEDA = '{$moneda}' AND DATE(FECHA) = CURDATE()";
      return row_sqlconector($query);
  }
  
  // Retornar null si la moneda está vacía
  return null;
}

function ifNotDayExists($tabla, $moneda) {
  $interval = row_sqlconector("SELECT CURDATE() AS HOY");
  $fecha = $interval['HOY'];
  
  $query = "SELECT COUNT(*) AS TOTAL FROM {$tabla} WHERE MONEDA = '{$moneda}' AND DATE(FECHA) = '{$fecha}'";
  $result = row_sqlconector($query);
  
  return $result['TOTAL'] == 0;
}

function formatPrice($valor,$moneda){
  switch ($moneda) {
    case "ADAUSDC":
    case "MATICUSDC":
        return number_format($valor,4,".","");
        break;    
    case "TRXUSDC":
    case "DOGEUSDC":        
        return number_format($valor,5,".","");
        break;      
    case "RUNEUSDC":
    case "RUNEUSDC":
    case "ATOMUSDC":
    case "NEARUSDC":
    case "INJUSDC":
          return number_format($valor,3,".","");
          break;          
    case "BTCUSDC":
    case "ETHUSDC":
    case "LTCUSDC":
          return number_format($valor,2,".","");
          break;
    case "BNBUSDC":
        return number_format($valor,1,".","");
        break;
    case "PAXGUSDC":
        return number_format($valor,0,".","");
        break;        
    default:
      return $valor;
  }
}

function porcenConjunto($min, $max, $variable) {
  $maxcien = $max - $min; 
  $conjunto = $variable - $min; 
  if($conjunto < 0) $conjunto = 0;
  if($maxcien == 0) $maxcien = 1;
  $resultado = ($conjunto * 100) / $maxcien;
  if($resultado > 100) $resultado = 100;
  if($min > $max) $resultado = 100;
  return number_format($resultado,0,"","");
}

function readMinAnterior($moneda){
  if(isset(row_sqlconector("select ABAJO from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()  - INTERVAL 1 DAY) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ABAJO'])){
    return row_sqlconector("select ABAJO from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()  - INTERVAL 1 DAY) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ABAJO'];
  }
  else{
    return row_sqlconector("select ABAJO from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ABAJO'];
  }  
}

function nivel($moneda){
  $nprice = readPrices($moneda);
  $asset = "SELL"; 
  $min= 0;
  $max= 0;
  $actual = $nprice['ACTUAL'];

  if($nprice['ARRIBA'] < readFlotadorAnterior($moneda)){
    $min = $nprice['ARRIBA'];
    $max = readFlotadorAnterior($moneda);
  }else{
    $min = readFlotadorAnterior($moneda);
    $max = $nprice['ARRIBA'];
  }

  $porcenmax = (porcenConjunto($min,$max,$actual)*3.6)."deg";  
  $nivel = "<div class=odometros style=--data:{$porcenmax};><div id=grad2>{$asset}</div></div>";

  return $nivel;
}

function nivelCompra($moneda){  
  $alerta = returnAlertas($moneda);
  $asset = "BUY";
  $nivel="<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>{$asset}</div></div>";
/*  if($alerta == "yellow"){
    $nivel="<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>{$asset}</div></div>";
  }*/
  if($alerta == "yellow"){
    $nivel="<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>{$asset}</div></div>";
  }
  if($alerta == "red"){
    $nivel="<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>{$asset}</div></div>";
  }

  return $nivel; 
}

function nivelAnterior($moneda){
  $nprice = readPrices($moneda);
  $asset = "BUY";
  $min= 0;
  $max= 0;

  if($nprice['ABAJO'] < readMinAnterior($moneda)){
    $min = $nprice['ABAJO'];
    $max = readMinAnterior($moneda);
  }else{
    $min = readMinAnterior($moneda);
    $max = $nprice['ABAJO'];
  }

  $porcenmax = (porcenConjunto(price($min), price($max), $nprice['ABAJO']) *3.6 )."deg";
  $nivel = "<div class=odometros style=--data:{$porcenmax};><div id=grad2>{$asset}</div></div>";

  return $nivel; 
}

function nivelBtc(){
  $nprice = readPrices("BTCUSDC");
  $min= 0;
  $max= 0;

  if($nprice['ARRIBA'] < readFlotadorAnterior("BTCUSDC")){
    $min = $nprice['ARRIBA'];
    $max = readFlotadorAnterior("BTCUSDC");
  }else{
    $min = readFlotadorAnterior("BTCUSDC");
    $max = $nprice['ARRIBA'];
  }

  $porcenmax = (porcenConjunto(price($min), price($max), $nprice['ACTUAL']) *3.6 )."deg";
  $nivel = "<div class=odometros style=--data:{$porcenmax};><div id=grad2>BTC</div></div>";

  return $nivel;
}

function updatePrices($moneda,$valores){
  sqlconector("UPDATE PRICES SET {$valores} WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())");
}

function updateTendenciaBajista($moneda){ 
  if(!ifNotDayExists("PRICES",$moneda)){
    updatePrices($moneda,"BAJISTA = 1, ALCISTA=0");
  }
}

function updateTendenciaAlcista($moneda){
  if(!ifNotDayExists("PRICES",$moneda)){
    updatePrices($moneda,"BAJISTA = 0, ALCISTA=1");
  }
}

function dayTendencia($moneda){
  $tendencia = "";
  $priceArriba = readPrices($moneda)['ARRIBA'];
  if($priceArriba > readFlotadorAnterior($moneda)){
    updateTendenciaAlcista($moneda);
    $tendencia = "<span style=color:#4DCB85;font-weight:bold;>&#9650;</span>";
  }else{
    updateTendenciaBajista($moneda);
    $tendencia = "<span style=color:#EA465C;font-weight:bold;>&#9660;</span>";
  }
  return $tendencia;
}

function readFlotadorAnterior($moneda){
  if(isset(row_sqlconector("select ARRIBA from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()  - INTERVAL 1 DAY) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ARRIBA'])){
    return row_sqlconector("select ARRIBA from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()  - INTERVAL 1 DAY) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ARRIBA'];
  }
  else{
    return row_sqlconector("select ARRIBA from PRICES WHERE MONEDA='{$moneda}' AND DAY(FECHA)= DAY(CURRENT_TIMESTAMP()) AND MONTH(FECHA)= MONTH(CURRENT_TIMESTAMP()) AND YEAR(FECHA)= YEAR(CURRENT_TIMESTAMP())")['ARRIBA'];
  }  
}

function totalTendencia($moneda){
  $bajista = row_sqlconector("select SUM(BAJISTA) AS ROJO from PRICES WHERE MONEDA='{$moneda}'")['ROJO'];
  $alcista = row_sqlconector("select SUM(ALCISTA) AS VERDE from PRICES WHERE MONEDA='{$moneda}'")['VERDE'];
  $tendencia = "";
  if($alcista > $bajista){
    $tendencia = "<span style=color:#4DCB85;font-weight:bold;>&#9650;</span>";
  }else{
    $tendencia = "<span style=color:#EA465C;font-weight:bold;>&#9660;</span>";
  }
  return $tendencia;
}

function returnAlertas($moneda){
  $readPrice = readPrices($moneda);
  $precio = $readPrice['ACTUAL'];
  $priceArriba= $readPrice['ARRIBA'];
  $priceAbajo= $readPrice['ABAJO']; 
  
  $variable = "black"; //sin alerta
  
  $porcenmax = porcenConjunto($priceAbajo, $priceArriba, $precio);
  $stop=0; 
  if($priceAbajo < readMinAnterior($moneda)){
    $stop=1; //stop de alerta de compra
    $variable = "red";
  }

  //logica de las alerta de venta y sus niveles de posible compras de acuerdo a su posicion. 
  if($porcenmax > 33 && $porcenmax < 89 && $stop==0){
    $variable = "green"; //alerta de venta
  }

  if( $porcenmax > 12 && $porcenmax < 34 && $stop==0 ){
    $variable = "orange"; //intension de subir
  }
  
  if($porcenmax > 1 && $porcenmax < 13 && $stop==0){
    $variable = "yellow"; //se puede comprar
  }

  return $variable;  
}

function listAsset(){
  $cadena="";

    $consulta = "select * from DATOS";
    $resultado = sqlconector($consulta);
    $cadena = "";
    while($row = mysqli_fetch_assoc($resultado)){
      $moneda = $row['MONEDA'];
      $promedioUndante = row_sqlconector("SELECT (SUM(ABAJO) / COUNT(*)) AS PROMEDIO FROM  PRICES WHERE MONEDA='{$moneda}'")['PROMEDIO'];
      $promedioFlotante = row_sqlconector("SELECT (SUM(ARRIBA) / COUNT(*)) AS PROMEDIO FROM  PRICES WHERE MONEDA='{$moneda}'")['PROMEDIO'];
      $totalPromedio = ($promedioFlotante + $promedioUndante) /2;      
      $color = "red";
      $colorAlerta = returnAlertas($moneda);
      $asset = $row['ASSET'];
      $elid = $row['ID'];
      $price = formatPrice(readPrices($moneda)['ACTUAL'],$moneda);
      if($price < $promedioFlotante){
        $color = "#F37A8B";
      }
      else{
          $color = "#4BC883";
      }
      $cadena = $cadena ." <span style=cursor:pointer;color:{$color};>{$asset}</span> <span style=color:{$color};font-weight:bold;>".formatPrice($price,$moneda)."</span> <span class=bolita style=color:{$colorAlerta};>&#9679;</span>";
    }
    return $cadena; 
}

function verPromo(){
  /*if(isset($_SESSION['user'])){
    $correo = readClienteId($_SESSION['user'])['CORREO'];
    if(recordCountApuestas($correo)>0){
      $json =  readPrices("BTCUSDC")['DATOS'];
      $data = json_decode($json, true);
      echo $data['listasset']. " Tendencia del Mercado" .$data['totalTendencia']." Animo".$data['tendencia']." Hora UTC ".$data['utc'];
    }
    else{
      echo "Suscribete con una minima compra de nuestros productos y disfruta de los mejores análisis y señales del mercado de criptomonedas...";
    }
  }*/

  echo "Suscríbete y disfruta de las ganancias como socio participativo sin riesgos. Ofrecemos una gran variedad de tarjetas de inversión con retornos mensuales de intereses y capital.";
}

function refreshDatos($mon){
  $row = readDatos($mon);
  $row2 = readParametros();
  $moneda=$row['MONEDA'];
  $auto = $row2['LOCAL'];  
  if(strlen($moneda) > 0){
    $readPrice = readPrices($moneda);
    $bitcoin = readPrices('BTCUSDC')['ACTUAL'];
    $priceMoneda = $readPrice['ACTUAL'];
    $priceArriba= $readPrice['ARRIBA'];
    $priceAbajo= $readPrice['ABAJO'];
    $labelPriceMoneda = formatPrice($priceMoneda,$moneda);
    $labelPriceBitcoin = formatPrice($bitcoin,"BTCUSDC");
    $color = "red";
    $colorbtc = "red";
    $colorDisp = "red";
    $symbol = "&#9660;";
    $promedioUndante = row_sqlconector("SELECT (SUM(ABAJO) / COUNT(*)) AS PROMEDIO FROM  PRICES WHERE MONEDA='{$moneda}'")['PROMEDIO'];
    $promedioFlotante = row_sqlconector("SELECT (SUM(ARRIBA) / COUNT(*)) AS PROMEDIO FROM  PRICES WHERE MONEDA='{$moneda}'")['PROMEDIO'];
    $promedioFlotanteBtc = row_sqlconector("SELECT (SUM(ARRIBA) / COUNT(*)) AS PROMEDIO FROM  PRICES WHERE MONEDA='BTCUSDC'")['PROMEDIO'];
    $totalPromedio = ($promedioFlotante + $promedioUndante) /2;  
    $porcenmax = porcenConjunto($priceAbajo, $priceArriba, $priceMoneda)."%";  
    $capital = $row2['CAPITAL'];
    $bina = $row2['BINANCE'];
    $symbol = nivelAnterior($moneda);
        
    if($priceMoneda < $promedioFlotante){
        $color = "#F37A8B";
    }
    else{
        $color = "#4BC883";
    }

    if($row2['DISPONIBLE'] < $row2['INVXCOMPRA']){
      $colorDisp = "#F37A8B";
    }
    else{
      $colorDisp = "#4BC883";
    }    
  
    if($bitcoin < $promedioFlotanteBtc){
      $colorbtc = "#F37A8B";
    }
    else{
      $colorbtc = "#4BC883";
    }  
    
    $obj = array('asset' => $row['ASSET'], 'ultimaventa' => $row['ULTIMAVENTA'], 'price' => $priceMoneda,'btc' => $bitcoin, 
    'colorbtc' => $colorbtc, 'symbol' => $symbol, 'moneda' => $moneda,'tendencia' => dayTendencia($moneda),'color' => $color,
    'maxdia' => $priceArriba,'mindia' => $priceAbajo, 'totalTendencia' => totalTendencia($moneda),
    'utc' => date('g:i A'),'techo' => $promedioFlotante,'piso' => $promedioUndante, 
    'ant' => readFlotadorAnterior($moneda),'nivel' => nivel($moneda),'nivelbtc' => nivelBtc(),
    'porcenmax' => $porcenmax,'ganancia' => $row2['GANANCIA'],'perdida' => $row2['PERDIDA'],'capital' => $row2['CAPITAL'],
    'disponible' => $row2['DISPONIBLE'], 'escalones' => $row2['ESCALONES'],'invxcompra' => $row2['INVXCOMPRA'],
    'totalpromedio' => $totalPromedio,'auto' => $auto,'bina' => $bina,'impuesto' => $row2['IMPUESTO'], 
    'colordisp' => $colorDisp,'labelpricebitcoin' => $labelPriceBitcoin,
    'labelpricemoneda' => $labelPriceMoneda,'precio_venta' => $row['PRECIO_VENTA'],'listasset' => listAsset(),
    'nivelcompra' => nivelCompra($moneda) ); 

    sqlconector("UPDATE PRICES SET DATOS='".json_encode($obj)."' WHERE MONEDA='$moneda'");
  }  
}

function refreshDataAuto() {
  try {
      // Conexión a MySQL
      $dsn = "mysql:host={$GLOBALS['servidor']};dbname={$GLOBALS['database']};charset=utf8";
      $conexion = new PDO($dsn, $GLOBALS['user'], $GLOBALS['password']);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Conexión a la API de Binance
      $api = new Binance\API(sqlApiKey(), sqlApiSecret());
      $api->useServerTime();
      $price = $api->prices();
      $balances = $api->balances();

      // Consulta a la base de datos
      $consulta = "SELECT * FROM DATOS";
      $stmt = $conexion->query($consulta);

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $asset = $row['ASSET'];
          $available_mon = $row['MONEDA'];
          $available = $price[$available_mon];
          $axie = readPrices($available_mon);
          $priceArriba = formatPrice($axie['ARRIBA'], $row['ASSET'], $row['PAR']);
          $priceAbajo = formatPrice($axie['ABAJO'], $row['ASSET'], $row['PAR']);
          updatePrices($available_mon, "ACTUAL={$available}");

          if ($priceArriba == 0) {
              updatePrices($available_mon, "ARRIBA={$available}");
          }

          if ($priceAbajo == 0) {
              updatePrices($available_mon, "ABAJO={$available}");
          }

          if ($priceArriba < $available) {
              updatePrices($available_mon, "ARRIBA={$available}");
          }

          if ($priceAbajo > $available) {
              updatePrices($available_mon, "ABAJO={$available}");
          }
          refreshDatos($available_mon);
      }      
  } catch (PDOException $e) {
      echo "Error en la conexión a la base de datos: " . $e->getMessage();
  } catch (Exception $e) {
      echo "Error en la conexión a la API de Binance: " . $e->getMessage();
  } finally {
      if (isset($conexion)) {
          $conexion = null;
      }
  }
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
    return date_format($date,"d/m/Y");
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

function insertLista($correo){
  sqlconector("INSERT INTO LISTA(CORREO) VALUES('{$correo}')");
}

function setEnviado($correo,$valor){
  sqlconector("UPDATE LISTA SET ENVIADO={$valor} WHERE CORREO='{$correo}'");
}

function recordList(){
  return row_sqlconector("SELECT Count(*) as SUMA FROM LISTA WHERE ENVIADO = 0")['SUMA'];
}

function returnListaCorreos() {
  $lista = [];
  $consulta = "SELECT * FROM LISTA WHERE ENVIADO=0";
  $resultado = sqlconector($consulta);
  
  while ($row = mysqli_fetch_assoc($resultado)) {
      $lista[] = $row['CORREO'];
  }
  
  return $lista;
}

function recordCount($table){
    return row_sqlconector("SELECT Count(*) as SUMA FROM ".$table)['SUMA'];
}

function recordCountApuestas($cliente){
  return row_sqlconector("SELECT Count(*) as SUMA FROM APUESTAS WHERE CLIENTE='$cliente'")['SUMA'];
}

function readCliente($correo){
  return row_sqlconector("SELECT * FROM USUARIOS WHERE CORREO='{$correo}'");
}

function readClienteId($id){
  return row_sqlconector("SELECT * FROM USUARIOS WHERE ID={$id}");
}

function ifClienteJuegoExist($idjuego,$correo) { 
  $conexion = @mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
  if (!$conexion) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      exit;
  }

  $resultado = mysqli_query($conexion, "SELECT 1 FROM APUESTAS WHERE CLIENTE = '$correo' AND IDJUEGO=$idjuego");
  $existe = mysqli_num_rows($resultado) > 0;
  mysqli_close($conexion);

  return $existe;
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
      while($row = mysqli_fetch_assoc($resultado)){
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
      while($row = mysqli_fetch_assoc($resultado)){        
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
      while($row = mysqli_fetch_assoc($resultado)){
        $max = "".readPromo($row['CODIGO'])['NUMPROMO']." Triunfos";
        echo "<tr><td>{$max}</td><td>".makeAnciEstrellas($row['RATE'])."</td></tr>";
      }    
      echo "</table>";
    }
  }   
}

function sendMail($correo,$asunto,$mensaje){
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );
  $from = "criptosignalgroup@criptosignalgroup.online";
  $to = $correo;
  $subject = $asunto;
  $message = $mensaje;
  $headers = "From:" . $from;
  mail($to,$subject,$message, $headers);       
}

function readMailPromo(){
  return row_sqlconector("SELECT * FROM PROMO WHERE DIFUSION=1 LIMIT 1");
}

function promoFlotante(){
  if(ifReadPromo()){
    $row = row_sqlconector("select * from PROMO where FLOTANTE=1 LIMIT 1");
    echo 	"
    <div class='overlay-dialog' id='promoFlotante'> 
      <dialog open id='promoFlotante' class='index-dialog'>      
        <div style='padding:21px;'>
        
        <h2>".$row['NOMBRE']."</h2>
        
        ".$row['MENSAJE']." <button class=\"binance-button\" type='button' onclick=\"$('#promoFlotante').fadeOut()\">Continuar</button>
        </div>

        <div class='dialog-image-container'>
          <img src='Assets/dialog-image.png'>
          <a href='javascript:void(0);' class='close-icon' onclick=\"$('#promoFlotante').fadeOut()\">X</a><br>
        </div>
        </dialog>
    </div> 
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
        while($row = mysqli_fetch_assoc($resultado)){
            $obj[] = array('ubicacion'=>$row['ubicacion'],'id'=>$row['ID'],'noticia'=>$row['noticia']);
        }
    }
   //return $obj;
 }
/*
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
 }*/

   /****FIN NOTIFICACIONES**************************************************************************
   */

?>