<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
        <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>               
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">    
    </head>
    <header>
        <style>
            dialog {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border: none;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                background-color: white;
            }

            .dialog-content {
                text-align: center;
            }        
        </style>        
        <script>
            let tabla = [];
            let tarjetas = [];

            function leerHistorial(){
                recuperarTabla();
                recuperarTarjetas();
            }

            function inicio(){
                leerHistorial();                
               //myVar = setInterval(leerHistorial, 3000);
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
                        new DataTable('#example');
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
                        <td>${producto.suscripcion}</td>
                        <td>${Math.round(producto.monto * 100) / 100} USDC</td>
                        <td>${Math.round(producto.intereses * 100) / 100} USDC</td>
                        <td>${producto.cliente} <button onclick="mostrarInfo(${index})">Info</button></td>
                        <td style='background:${producto.color};'>${producto.estatus}</td>                        
                    `;
                    tablaCuerpo.appendChild(fila);
                });
            }
            
            function mostrarInfo(index) {
                const producto = tabla[index];
                const dialog = document.getElementById("info-dialog");
                dialog.querySelector(".dialog-content").innerHTML = `
                <p>Tarjeta <b>${producto.tipo}</b></p>
                <p>Finaliza el <b>${producto.fin}</b> le quedan ${producto.dias} días</p>
                <p>Usuario Binance: <b>${producto.usuariobinance}</b></p>
                <p>Wallet Binance: <b>${producto.binance}</b></p>
                <p>Wallet Bep20: <b>${producto.bep20}</b></p>
                `;
                dialog.showModal();
            }

    function dibujaTarjeta(acciones,imagen,titulo,texto,mensaje,costo,estrellas){	
	let dibujo = `
    <div class="cover" >
        <div class="content">
			<div class="back-image-front" style="background: url('Assets/${imagen}') no-repeat center/cover;">
				<div class='glow'>
					<section class='upper-side'> 
						<section class='left-side'>
							<div class='header-container'>
								<div class='chip-container'>
									<img class='chip' style='width:4.5rem;' src='Assets/vainitas.png'>
								</div>
								<div class='title-container'>
									<h2>${titulo}</h2>
								</div>
							</div>
							<div class='text-container'>
								<p>${texto.slice(0, 130)}</p>
							</div>
						</section>
						<section class='right-side'>
                        ${acciones}
						</section>
					</section>   
					<section class='lower-side'>
						<div class='cost-container'>
							<p>COSTO:</p> 
							<div class='cost'>
								<p style='font-size: 2rem;'>${costo}<p> <p style='font-size:1.2rem;'>USDC<p>
							</div>
						</div>
						
						<div class='star-container'> 
							<div class='stars'> ${estrellas} </div> 	<div class='message'> ${mensaje} </div>
						</div>
					</section>
				</div>							             
			</div>
			<div class="back-image-back" style="overflow-y: auto;overflow-x: hidden;background: url('Assets/${imagen}') no-repeat center/cover; display:flex;align-items: center;justify-content: center;">
            ${acciones}
				<div class='text-container' style="overflow-y: auto;overflow-x: hidden; height: 200px;">
					<p>${texto}</p>
				</div>
			</div>
		</div>
	</div>`;
    return dibujo;
}

function mostrarTarjetas() {
    const caja = document.getElementById("outerCard");	
    caja.innerHTML = '';
    tarjetas.forEach((tarjeta) => {
        let acciones;
        let texto = tarjeta.analisis;
        let mensaje = "Suscripcion Abierta";
        let costo = tarjeta.costo;
        let estrellas = dibujarEstrellas(tarjeta.estrellas);
        if (tarjeta.activo) {
            acciones = "";
            mensaje = "Suscripcion Activa";
        }
        else{
            acciones = `<button style='float: right;color:black;border:solid 1px black;border-radius:5px;' onclick="renovar('${tarjeta.id}')">Renovar</button>
                      <button style='background:coral;float: right;color:black;border:solid 1px black;border-radius:5px;' onclick="eliminar('${tarjeta.id}')">Eliminar</button>`;
            mensaje = "Suscripcion Suspendida";
        }
        caja.innerHTML += dibujaTarjeta(acciones,tarjeta.imagen,tarjeta.titulo,texto,mensaje,costo,estrellas);
    });    
}


function recuperarTarjetas(){
	fetch("block?getSuscripciones=&correo="+document.getElementById('correo').value)
		.then(response => {
			if (!response.ok) {
				throw new Error("Error en la solicitud: " + response.status);
			}
			return response.json(); // Parsear la respuesta como JSON
		})
		.then(data => {
			tarjetas = data;                    
			mostrarTarjetas();
			// Aquí puedes procesar los datos recibidos (data)
			console.log("Datos Historial:", data);
		})
		.catch(error => {
			console.error("Error en la solicitud:", error);
		});
	
}

function dibujarEstrellas(n) {
    var estrellas = '';
    for (var i = 0; i < n; i++) {
        estrellas += '★';
    }
    return estrellas;
}

        </script>
    </header>
    <body onload="inicio()">

    <?php $page = "histadmin"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->   

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo" style='margin-top: 7rem;'> 
            <dialog id="info-dialog">
                <div class="dialog-content"></div><br>
                <button class="add-button" onclick="document.getElementById('info-dialog').close()">Cerrar</button>
            </dialog>    
            <div id="outerCard" class='outerCard-container' style="background:none;"></div>
            <div class="vista" id="vista">             
            Suscripciones de Clientes en el Sistema:
                <table id='example' class='ui celled table' style='width:100%; '> 
                    <thead>
                        <tr>
                            <th>Suscripcion</th>
                            <th>Monto</th>
                            <th>Paga Mensual</th>
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

    </body>
</html>



<?php
}
else{
    header("Location: index.php");
}
?>