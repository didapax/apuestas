<?php 
    include "modulo.php";

    if(isset($_GET['vkey'])){
        // Procesar verificación
        $vkey = $_GET['vkey'];

        $sql = "SELECT VERIFICADO,VKEY FROM USUARIOS WHERE VERIFICADO = 0 AND VKEY = '$vkey' LIMIT 1";

        $result = sqlconector($sql);

        if(mysqli_num_rows($result) === 1){
            // Validar correo electrónico
            $actualizar = "UPDATE USUARIOS SET VERIFICADO = 1 WHERE VKEY = '$vkey'";
            sqlconector($actualizar);

            setcookie("verificado", "1");
            header("location:paginaCuentaVerificada");
            
         } else {

            setcookie("verificado", "0");
            header("location:paginaCuentaInvalida");
            
        }

    } else {
        die("¡Algo salió mal!");
    }
?>