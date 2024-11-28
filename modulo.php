<?php
require "init.php";
require "php-binance-api.php";
session_start();

// Variables clave para las estadisticas
$GLOBALS['__TOTALUSUARIOS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM USUARIOS")['TOTAL'];
$GLOBALS['__DEPOSITOS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM TRANSACCIONES WHERE TIPO='DEPOSITO'")['TOTAL'];
$GLOBALS['__DEPOSITOSUSDC__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(RECIBE), 0), 2) AS TOTAL FROM TRANSACCIONES WHERE TIPO='DEPOSITO'")['TOTAL'];
$GLOBALS['__RETIROS__'] = row_sqlconector("SELECT COUNT(*) AS TOTAL FROM TRANSACCIONES WHERE TIPO='RETIRO' AND YEAR(FECHA) = YEAR(NOW())")['TOTAL'];
$GLOBALS['__RETIROSUSDC__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(RECIBE), 0), 2) AS TOTAL FROM TRANSACCIONES WHERE TIPO='RETIRO' AND YEAR(FECHA) = YEAR(NOW())")['TOTAL'];
$GLOBALS['__OPERACIONESETF__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(MONTO), 0), 2) AS TOTAL FROM TRANSACCIONES WHERE (TIPO='BUY' OR TIPO='SELL') AND YEAR(FECHA) = YEAR(NOW())")['TOTAL'];
$GLOBALS['__TOTALSALDOS__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(SALDO), 0), 2) AS TOTAL FROM USUARIOS")['TOTAL'];
$GLOBALS['__PAGOSMESACTUAL__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(INTERES_MENSUAL), 0), 2) AS TOTAL FROM LIBROCONTABLE WHERE TIPO = 'CREDITO' AND PAGADO=0 AND MONTH(FECHA) = MONTH(CURDATE()) AND YEAR(FECHA) = YEAR(CURDATE())")['TOTAL'];
$GLOBALS['__CIERREANUAL__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(MONTO), 0), 2) AS SALDO FROM APUESTAS WHERE PAGADOS = 1 AND ACTIVO = 0 AND ELIMINADO = 1 AND PORCIENTO > 0 AND DEVUELVE_CAPITAL = 0 AND YEAR(FECHA) = YEAR(NOW())")['SALDO'];
$GLOBALS['__CIERREANUALSENALES__'] = row_sqlconector("SELECT FORMAT(COALESCE(SUM(MONTO), 0), 2) AS SALDO FROM `LIBROCONTABLE` WHERE JUEGO LIKE '%SEÑALES%' AND PAGADO = 1 AND ESTATUS = 'CERRADO' AND YEAR(FECHA) = YEAR(NOW())")['SALDO'];
$GLOBALS['__COMISIONRETIRO__'] = number_format(($GLOBALS['__RETIROSUSDC__'] * 3) /100, 2);

$GLOBALS['__COMISIONRETIROETF__'] = 3;
$GLOBALS['__COMISIONDEPOSITOETF__'] = 3;
$GLOBALS['__COMISIONPRIMAETF__'] = 2;

$GLOBALS['__BTCPOSEIDO__'] = row_sqlconector("SELECT BALANCE FROM DATOS WHERE MONEDA ='BTCUSDC'")['BALANCE'];
$GLOBALS['__ETHPOSEIDO__'] = row_sqlconector("SELECT BALANCE FROM DATOS WHERE MONEDA ='ETHUSDC'")['BALANCE'];
$GLOBALS['__PRECIOBTC__'] = row_sqlconector("SELECT PRECIO FROM DATOS WHERE MONEDA ='BTCUSDC'")['PRECIO'];
$GLOBALS['__PRECIOETH__'] = row_sqlconector("SELECT PRECIO FROM DATOS WHERE MONEDA ='ETHUSDC'")['PRECIO'];
$GLOBALS['__NUMACCIONESBTC__'] = row_sqlconector("SELECT ACCIONES FROM DATOS WHERE MONEDA ='BTCUSDC'")['ACCIONES'];
$GLOBALS['__NUMACCIONESETH__'] = row_sqlconector("SELECT ACCIONES FROM DATOS WHERE MONEDA ='ETHUSDC'")['ACCIONES'];

$GLOBALS['__FBTC__'] = number_format(calcularNAV($GLOBALS['__BTCPOSEIDO__'], $GLOBALS['__PRECIOBTC__'], $GLOBALS['__NUMACCIONESBTC__'], $GLOBALS['__COMISIONPRIMAETF__'])['navPorAccion'], 2);
$GLOBALS['__FETH__'] = number_format(calcularNAV($GLOBALS['__ETHPOSEIDO__'], $GLOBALS['__PRECIOETH__'], $GLOBALS['__NUMACCIONESETH__'], $GLOBALS['__COMISIONPRIMAETF__'])['navPorAccion'], 2);

function generaTicket(){
    $bytes = random_bytes(8);
	  $referencia = bin2hex($bytes);
    return $referencia;
}

function generaCode(){
  $bytes = random_bytes(4);
  $referencia = bin2hex($bytes);
  return $referencia;
}

function calcularNAV($btcPoseido, $precioBTC, $numAcciones, $primaPorcentaje) {
  // Calcular el valor total de los activos
  $valorTotalActivos = $btcPoseido * $precioBTC;

  // Calcular el NAV por acción
  $navPorAccion = $valorTotalActivos / $numAcciones;

  // Calcular la prima
  $prima = $navPorAccion * ($primaPorcentaje / 100);

  // Calcular el precio de la acción con prima
  $precioAccionConPrima = $navPorAccion + $prima;

  // Retornar los valores calculados
  return [
      'valorTotalActivos' => $valorTotalActivos,
      'navPorAccion' => $navPorAccion,
      'precioAccionConPrima' => $precioAccionConPrima
  ];
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

function detalleInversion($tipo='MENSUAL',$monto=1,$porciento=1){
  $obj = array();
  $numMes=1;
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

  $resultado = mysqli_query($conexion, "SELECT 1 FROM APUESTAS WHERE ELIMINADO=0 AND CLIENTE = '$correo' AND IDJUEGO=$idjuego");
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

function promoFlotante(){
  if(ifReadPromo()){
    $row = row_sqlconector("select * from PROMO where FLOTANTE=1 LIMIT 1");
    echo 	"
    <div class='overlay-dialog' id='promoFlotante'> 
      <dialog open id='promoFlotante' class='index-dialog'>      
        <div class='dialog-text'>
        
        <h2>".$row['NOMBRE']."</h2>
        
        ".$row['MENSAJE']." <button class=\"binance-button\" type='button' onclick=\"$('#promoFlotante').fadeOut()\">Go to Store!</button>
        </div>
        <div class='dialog-image-container'>
          <img src='Assets/dialog-image.png'>
          <a href='javascript:void(0);' class='close-icon' id='dialog-dissapear' onclick=\"$('#promoFlotante').fadeOut()\">X</a><br>
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
            $obj[] = array('ubicacion'=>$row['UBICACION'],'id'=>$row['ID'],'noticia'=>$row['NOTICIA']);
        }
    }
   return $obj;
 }

   /****FIN NOTIFICACIONES**************************************************************************
   */
