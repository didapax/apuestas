/*Javascript tarjetas*/

let tarjetas = [];

function dibujaTarjeta(id,acciones,imagen,titulo,texto,mensaje,costo,estrellas){	
	let dibujo = `
    <div class="cover" >
        <div class="content">
			<div class="back-image-front" style="background: url('Assets/${imagen}') no-repeat center/cover;">
				<div class="card-top" style="background: url('Assets/cardTop.png') no-repeat center/cover;border-radius:2rem;height: inherit;">	
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
								<button class='yellow-button' ${acciones}>OBTENER</button>
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
								<div class='stars'> ${estrellas} </div><div class='message'> ${mensaje} </div>
							</div>
						</section>
					</div>	
				</div>						             
			</div>
			<div class="back-image-back" style="background: url('Assets/${imagen}') no-repeat center/cover; display:flex;align-items: center;justify-content: center;">
				<input type="hidden" id="M${id}" value="${costo}">
				<button class='yellow-button' ${acciones}>OBTENER AHORA!!</button>             
			</div>
		</div>
	</div>`;
    return dibujo;
}

function mostrarTarjetas() {
    const caja = document.getElementById("vista");	
    caja.innerHTML = '';
    tarjetas.forEach((tarjeta) => {
        let acciones = `onclick="trade('${tarjeta.id}')"`;
        let texto = tarjeta.detalle;
        let mensaje = "Suscripcion Abierta";
        let costo = tarjeta.costo;
        let estrellas = dibujarEstrellas(tarjeta.estrellas);
        let favorito = "&#169;";
        if (tarjeta.bloqueo === '1') {
            acciones = `onclick="bloque()"`;
            mensaje = "<span style='color:red;'>Suscripcion Bloqueda</span>";
        }
        if (tarjeta.favorito === '1') {
            favorito = "&#169; Recomendado";
        }        
        if (tarjeta.sesion === false) {
            acciones = `onclick="initsession()"`;
            caja.innerHTML += dibujaTarjeta(tarjeta.id,acciones,tarjeta.imagen,tarjeta.titulo,texto,mensaje,costo,estrellas);
        } else {
            if (tarjeta.suscripcionExiste) {
                if (tarjeta.pagaIntereses) {
                    caja.innerHTML += dibujaTarjeta(tarjeta.id,acciones,tarjeta.imagen,tarjeta.titulo,texto,mensaje,costo,estrellas);
                }
            }
			else{
				caja.innerHTML += dibujaTarjeta(tarjeta.id,acciones,tarjeta.imagen,tarjeta.titulo,texto,mensaje,costo,estrellas);
			}
        }			
    });    
}

function recuperarTarjetas(){ 
	fetch("block?getJugadas=&correo="+document.getElementById('correo').value)
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

function trade(id){
	let etiqueta =  "M"+id;
	if(document.getElementById("actualsaldo").value *1 >= document.getElementById(etiqueta).value *1 ){
		$.get("block?datosJuego&idjuego="+id,
			function(data){
				var datos= JSON.parse(data);
				Swal.fire({
					title: 'Suscripciones',
					text: `Estas Seguro de realizar la Compra de la Suscripcion ${datos.tipo} de ${datos.juego}, las Suscripciones tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red.`,
					icon: 'info',
					confirmButtonColor: '#EC7063',
					confirmButtonText: 'Si Unirme',
					showCancelButton: true,
					cancelButtonText: "Cancelar"
					}).then((result) => {
						if (result.isConfirmed) {
							$.post("block",{
								jugar:"",
								idjuego: datos.id,
								correo: document.getElementById("correo").value
							},function(data){
								window.location.href="index";
							});  
						}
					});                                    
			});
	}else{
		Swal.fire({
			title: 'Suscripciones',
			text: "Saldo Insuficiente para realizar esta Operacion..",
			icon: 'info',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Continuar'
			}); 
	}
}

function leerDatos(){
	if(document.getElementById("correo").value.length > 0){
		$.post("block",{
			getUsuario: "", 
			sesion: true,
			correo: document.getElementById("correo").value
		},function(data){
			var datos= JSON.parse(data);
			document.getElementById("actualsaldo").value = datos.saldo; 
			$("#saldo").html(datos.saldo); 
		});
	}
}

function leerJuegos(){
	recuperarTarjetas();
	leerDatos();                
}

function initsession(){
	window.location.href="sesion";
}

function bloque(){
	Swal.fire({
		title: 'Bloqueo',
		text: "Suscripcion Bloqueda, Vuelva a Intentarlo Mas tarde o Elija otra.",
		icon: 'error',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Continuar'
		});  
}            

function inicio(){ 
	leerJuegos();
	leerDatos();
	//myVar = setInterval(leerJuegos, 3000);
}