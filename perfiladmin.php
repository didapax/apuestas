<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
    $row= row_sqlconector("SELECT * FROM USUARIOS WHERE ID=".$_SESSION['user']);

    $binance = $bep20 = $nombreUsuario = "";

    $laborando = $binanceActivo = $bep20Activo = "";

    if(isset($row['NOMBRE_USUARIO'])){
        $nombreUsuario = $row['NOMBRE_USUARIO'];
    }
    
    if (isset($row['BINANCE'])){
        $binance = $row['BINANCE'];
    }

    if (isset($row['BEP20'])){
        $bep20 = $row['BEP20'];
    }

    if($row['LABORANDO'] == 1){
        $laborando = "checked";
    }

    if($row['ACTIVE_BINANCE'] == 1){
        $binanceActivo = "checked";
    }

    if($row['ACTIVE_BEP20'] == 1){
        $bep20Activo = "checked";
    }    

    if(isset($_POST['guardar'])){
        $nombreUsuario =  $_POST['nombreUsuario'];
        $binance = $_POST['binance'];
        $bep20 = $_POST['bep20'];
        $id = $_SESSION['user'];
        sqlconector("UPDATE USUARIOS SET NOMBRE_USUARIO='$nombreUsuario', BINANCE='$binance', BEP20='$bep20' WHERE ID=$id");
    }

    if(isset($_POST['setCampo'])){
        $campo = $_POST['campo'];
        $valor = $_POST['valor'];
        $id = $_SESSION['user'];
        sqlconector("UPDATE USUARIOS SET $campo = $valor WHERE ID=$id");
    }

?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">    
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />           
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>               
    </head>
    <header>
        <style>
        
        </style>        
        <script>

           function save(){
            Swal.fire({
                                        title: 'Perfil',
                                        text: `Estas seguro de Guardar los cambios? se cambiaran las wallet de pagos y qre para depositos. `,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Guardar',
                                        showCancelButton: true,
                                        cancelButtonText: "No Estoy Seguro"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("perfiladmin",{
                                                    guardar: "",
                                                    nombreUsuario: document.getElementById("username").value,
                                                    binance: document.getElementById("binance").value,
                                                    bep20: document.getElementById("bep20").value
                                            },function(data){
                                                Swal.fire({
                                                title: 'Perfil',
                                                text: "Datos Guadados con Exito",
                                                icon: 'info',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Continuar'
                                                }); 
                                            });
                                            }
                                        });
            }

            function setLaborando(){
                let estatus = 0;

                if(document.getElementById('laborando').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "LABORANDO",
                    valor: estatus
                },function(data){});                 
            }

            function setBinanceActive(){
                let estatus = 0;

                if(document.getElementById('binanceactivo').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "ACTIVE_BINANCE",
                    valor: estatus
                },function(data){});                 
            }           
            
            function setBep20Active(){
                let estatus = 0;

                if(document.getElementById('bep20activo').checked === true){
                    estatus = 1;
                } 

                $.post("perfiladmin",{
                    setCampo: "",
                    campo: "ACTIVE_BEP20",
                    valor: estatus
                },function(data){});                 
            }            

        </script>
    </header>
    <body>

    <?php $page = "perfiladmin"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->   

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem;padding:1rem;'> 
        <div class="vista" id="vista">
        <form action="perfiladmin" method="POST">
            <table>
                <tr><td>Imagen de Perfil</td><td><iframe style='border:none; height: 250px;' src='subirperfil'><br></iframe></td></tr>
                <tr><td>Activo en el Trabajo</td><td><label class="switch"><input onchange="setLaborando()" type="checkbox" id="laborando" <?php echo $laborando ?> ><span class="slider"></span></label></td></tr>
                <tr><td>Nombre de Usuario</td><td><input type="text" name="username" id="username" value="<?php echo $nombreUsuario; ?>"></td><td>Imagen QR</td><td>Activar</td></tr>
                <tr><td>Binance Pay</td><td><input type="text" name="binance" id="binance" value="<?php echo $binance; ?>"></td><td><iframe style="border:none;"  src='subirqrbinance'></iframe></td><td><label class="switch"><input onchange="setBinanceActive()" type="checkbox" id="binanceactivo" <?php echo $binanceActivo ?>><span class="slider"></span></label></td></tr>
                <tr><td>Wallet Bep20</td><td><input type="text" name="bep20" id="bep20" value="<?php echo $bep20; ?>"></td><td><iframe style="border:none;"  src='subirqrbep20'></iframe></td><td><label class="switch"><input onchange="setBep20Active()" type="checkbox" id="bep20activo" <?php echo $bep20Activo ?>><span class="slider"></span></label></td></tr>

            </table>
            <br><br>
            <button id="guardar" onclick="save()" type="button" style="border:solid 2px black; border-radius:5px;padding:5px;">Guardar Cambios</button>
        </form>

        </div>
        </div>
              <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>