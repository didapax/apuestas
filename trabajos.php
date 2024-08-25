<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html> 
    <head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">        
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />                       
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
    </head>
    <header>
        <style>

        </style>        
        <script>
            let trabajos = [];            

            function ver(id){
                
                const selectedId = id.toString();
                const datos = trabajos.find(p => p.id === selectedId);
                if (datos) {  
                    
                    let monto = datos.monto;
                    let destino = `Origen: ${datos.origen}<br>Wallet de Destino: ${datos.destino}`
                    if(datos.tipo == "RETIRO"){
                        monto = datos.recibe;
                        //destino = `Wallet de Destino: ${datos.origen}`
                    }
                    
                    $("#evento").html(datos.tipo);
                    $("#emailCliente").html(datos.cliente);
                    $("#mediopago").html(datos.medio_pago);
                    $("#wallet").html(destino);
                    $("#monto").html((monto *1).toFixed(2)+" "+datos.moneda);
                    $("#estatus").html(datos.estatus);
                    $("#idapuesta").val(datos.ticket);
                          
                    document.getElementById(datos.estatus).selected = true;
                    document.getElementById('modalOverlay').style.display = "flex";
                }

            }

            function borrar(id){
                var r = confirm("Estas Seguro de Cancelar la Apuesta.?");
                if (r == true) {
                    $.post("block",{
                        cancelar: id
                    },function(data){
                        leerTrabajos();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }

            function tomar(id){
                    $.post("block",{
                        tomar: id,
                        correo: document.getElementById("correo").value
                    },function(data){
                        leerTrabajos();
                    });
            }        
            

            function enviar(){ 
                Swal.fire({
                                        title: 'Promocion',
                                        text: `Estas seguro de cambiar es estatus de la orden?`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Cambiar Estatus',
                                        showCancelButton: true,
                                        cancelButtonText: "No Estoy Seguro"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                setEstatus: document.getElementById("selestatus").value,
                                                idapuesta: document.getElementById("idapuesta").value
                                            },function(data){
                                                leerTrabajos();
                                                document.getElementById('modalOverlay').style.display = "none";
                                            });
                                            }
                                            else{
                                                document.getElementById('modalOverlay').style.display = "none";
                                            }
                                        });
            }


            function leerTrabajos(){
                recuperarTrabajos();
            } 

            function recuperarTrabajos() {
                fetch("block?readTrabajos=1&correo="+document.getElementById('correo').value)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        trabajos = data;  
                        
                        mostrarTablaTrabajos();
                        new DataTable('#example');
                        // Aquí puedes procesar los datos recibidos (data)
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });
    
            }

            function mostrarTablaTrabajos() {
                const tablaCuerpo = document.getElementById("tabla-cuerpo-depositos");
                tablaCuerpo.innerHTML = "";

                trabajos.forEach((producto, index) => {
                    let monto = producto.monto;
                    let color_estatus="#FAD7A0";

                    if(producto.tipo == "RETIRO"){
                        monto= producto.recibe;
                    }

                    switch (producto.estatus) {
                        case 'REVISION':
                            color_estatus="#4caf50";
                            break;
                            case 'ESPERA':
                                color_estatus="#2196f3";
                                break;        

                            case 'EXITOSO':
                                color_estatus="#ff9800";
                                break;        
                        default:
                            color_estatus="#FAD7A0";
                            break;
                    }                 
                    const fila = document.createElement("tr");
                    fila.innerHTML = `
                        <td>${producto.fecha}</td>
                        <td>${producto.tipo}</td>
                        <td>${producto.ticket}</td>
                        <td>${producto.descripcion}</td>
                        <td>${Math.round(monto * 100) / 100} ${producto.moneda}</td>
                        <td style='background:${color_estatus}'>${producto.estatus}</td>
                        <td>
                            <!--<button type='button' onclick='borrar(${producto.id})' >Delete</button>-->                            
                            <button type='button' class='add-button' onclick='ver(${producto.id})' >Trabajar</button>
                            <a href='chatAdmin?ticket=${producto.ticket}'>&#128231;<sup style='color:red; font-weight: bold;'>${producto.notif}</sup></a>                            
                        </td>
                    `;
                    tablaCuerpo.appendChild(fila);
                });
            }              

            function inicio(){
                leerTrabajos();
                //myVar = setInterval(leerTrabajos, 3000);
            }
            
        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "trabajos"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->   

        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem; padding:5rem; min-height: calc(100vh - 24rem);'>
            <!--<div class="menu" id="menu">
                <label style="margin-left:1px; font-weight:bold;" id="estad"></label>
                <label style="margin-left:13px; font-weight:bold;" id="reg"></label>
            </div> -->
        <div id="modalOverlay" class="modal-overlay">
            <div class="modal" >
                <span id="closeModalBtn" class="close-btn">X</span>
                <h2><span id="evento"></span></h2>
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" id="idapuesta">
                Transaccion: <br>
                Cliente: <span id="emailCliente"></span><br>
                Medio de Pago: <span id="mediopago"></span><br>
                <span style='background:yellow;' id="wallet"></span>
                <br>
                Monto: <span id="monto"></span><br>
                Estatus:<span id="estatus"></span><br>
                Cambiar: <select id="selestatus" >
                    <option id="">selecciona estatus...</option>
                    <option id="REVISION" value="REVISION">En Revision</option>
                    <option id="ESPERA" value="ESPERA">En Espera</option>
                    <option id="EXITOSO" value="EXITOSO">Exitoso</option>
                    <option id="FALLIDO" value="FALLIDO">Fallido</option> 
                </select><br><br>
                <button class='add-button' style="float:right;" type="button" id="btnenviar" onclick="enviar()">Cambiar Estatus</button>
            </div>        
        </div>

            <div class="vista" id="vista">
                    <table id='example' class='ui celled table' style='width:100%; '> 
                        <thead>
                            <tr>
                                <th>Fecha.</th>
                                <th>Tipo.</th>
                                <th>Ticket N.</th>
                                <th>Descripcion</th>
                                <th>Monto</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-cuerpo-depositos">
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
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Función para cerrar el modal
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera de él
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }
        });   

</script>    

    </body>    
</html>

<?php
}
else{
    header("Location: index.php");
}
?>