<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">    
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">    
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>               
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    

    </head>
    <header>
        <style>
        
        </style>        
        <script>
            let tabla = [];

            function leerHistorial(){
                recuperarTabla();
            }

            function inicio(){
                leerHistorial();
                myVar = setInterval(leerHistorial, 3000);
            }


            function recuperarTabla() {
                fetch("block?readHistorialAdmin=&cliente="+document.getElementById('correo').value)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        tabla = data;  
                        
                        mostrarTabla();
                        // Aquí puedes procesar los datos recibidos (data)
                        console.log("Datos retiros:", data);
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });
                
            }            

            function mostrarTabla() {
                const tablaCuerpo = document.getElementById("tabla-cuerpo");
                tablaCuerpo.innerHTML = "";

                tabla.forEach((producto, index) => {
                    const fila = document.createElement("tr");
                    fila.innerHTML = `
                        <td>${producto.fin}</td>
                        <td>${producto.dias}</td>
                        <td>${producto.suscripcion}</td>
                        <td>${producto.tipo}</td>
                        <td>${Math.round(producto.monto * 100) / 100}</td>
                        <td>${producto.cliente}</td>
                        <td style='background:${producto.color}'>${producto.estatus}</td>                        
                    `;
                    tablaCuerpo.appendChild(fila);
                });
            }            

        </script>
    </header>
    <body onload="inicio()">

    <?php $page = "histadmin"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->   

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem; padding:5rem; min-height: calc(100vh - 24rem);'> 
            <div class="vista" id="vista">
                <table id='example' class='ui celled table' style='width:100%; '> 
                    <thead>
                        <tr>
                            <th>Finaliza</th>
                            <th>Dias Restantes</th>
                            <th>Suscripcion</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Cliente</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-cuerpo">
                    </tbody>
                </table>
            </div>        
        </div>
              <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->  
        

    <script src='https://code.jquery.com/jquery-3.7.1.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.semanticui.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 

    <script>
        new DataTable('#example');
    </script>

    </body>
</html>



<?php
}
else{
    header("Location: index.php");
}
?>