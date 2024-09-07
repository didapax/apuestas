/*Suscripciones del cliente*/

let tarjetas = [];


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
    const caja = document.getElementById("vista");	
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

function leerHistorial(){
    recuperarTarjetas();
} 

function inicio(){
    leerHistorial();
    /*myVar = setInterval(leerHistorial, 3000);*/
}

function renovar(id){
    Swal.fire({
    title: 'Suscripciones',
    text: "Bienvenido a Renovar tu Suscripcion, la Renovacion es Automatica y estaras disfrutando del servicio rapidamente.",
    icon: 'info',
    confirmButtonColor: '#117A65',
    confirmButtonText: 'Renovar',
    cancelButtonColor: '#AEB6BF',
    showCancelButton: true,
    cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
                //aqui va la logiba de comunicacion con el backed
                $.post("block",{
                refreshSuscripcion: id
                }, 
                function(data){
                    var datos= JSON.parse(data);
                    if(datos.result == false){
                        Swal.fire({
                                title: 'Suscripciones',
                                text: "Saldo Insuficiente para Realizar esta Operacion.",
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                                }); 
                    }else{
                        window.location.href="historialcliente"; 
                    }
                }
            );                            

        }
    }); 
}

function eliminar(id){
    Swal.fire({
    title: 'Suscripciones',
    text: "Estas Seguro de Eliminar tu Suscripcion.? puedes comprarla nuevamente cuando quieras en la Tienda.",
    icon: 'warning',
    confirmButtonColor: 'coral',
    confirmButtonText: 'Eliminar',
    cancelButtonColor: '#AEB6BF',
    showCancelButton: true,
    cancelButtonText: "Seguir Suscrito"
    }).then((result) => {
        if (result.isConfirmed) {
            //aqui va la logica de eliminar
            $.post("block",{
                deleteSuscripcion: id
            }, 
            function(data){
                window.location.href="historialcliente"; 
            }); 
        }
    });                 
}            
