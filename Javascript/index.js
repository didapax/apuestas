/*Javascript tarjetas*/

let tarjetas = [];

function dibujaTarjeta(id,acciones,imagen,titulo,texto,mensaje,costo,estrellas){
    let dibujo = `
        <div class="cover" onclick="rotateCard(this)">
            <div class="content">
                <div class="back-image-front" style="background: url('Assets/${imagen}') no-repeat center/cover;">
                    <div class="card-top" style="background: url('Assets/cardTop.png') no-repeat center/cover; border-radius:2rem; height: inherit;">
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
                            </section>
                            <section class='lower-side'>
                                <div class='cost-container'>
                                    <p>COSTO:</p>
                                    <div class='cost'>
                                        <p style='font-size: 2rem;'>${costo}<p>
                                        <p style='font-size:1.2rem;'>USDC<p>
                                    </div>
                                </div>
                                <div class='star-container'>
                                    <div class='stars' style="font-weight: 800;"> ${estrellas} </div>                                    
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="back-image-back" style="background: url('Assets/${imagen}') no-repeat center/cover; display:flex;flex-direction: column;align-items: center;justify-content: center;">
                    <input type="hidden" id="M${id}" value="${costo}">
                    <button class='yellow-button' ${acciones}>OBTENER AHORA!!</button>
					<div style="position: absolute; left: 30%; top: 85%;font-weight: 800;color:antiquewhite;">
						<div class='message'> ${mensaje} </div>
					</div>
                </div>
            </div>
        </div>`;
    return dibujo;
}

function rotateCard(element) {
	element.classList.toggle('rotated');
  }
  
  document.querySelectorAll('.cover').forEach(card => {
	card.addEventListener('click', function() {
	  rotateCard(this);
	});
  });
 
function mostrarTarjetas() {
    const caja = document.getElementById("vista");	
    caja.innerHTML = '';
    tarjetas.forEach((tarjeta) => {
        let acciones = `onclick="trade('${tarjeta.id}','${tarjeta.referencia}')"`;
        let texto = tarjeta.detalle;
        let mensaje = "Suscripcion Abierta";
        let costo = tarjeta.costo;
        let estrellas = dibujarEstrellas(tarjeta.estrellas);
        if (tarjeta.bloqueo === '1') {
            acciones = `onclick="bloque()"`;
            mensaje = "<span style='color:red;'>Suscripcion Pausada</span>";
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

function trade(id,referencia){
	let etiqueta =  "M"+id;
	let comision = (document.getElementById(etiqueta).value * 3) /100;
	let monto = (document.getElementById(etiqueta).value *1) + comision;
	if(referencia === 'ETF'){
		if(document.getElementById("actualsaldo").value *1 >= monto *1 ){
			$.get("block?datosJuego&idjuego="+id,
				function(data){
					var datos= JSON.parse(data);
					Swal.fire({
						title: 'Buy',
						text: `You are sure to make the Purchase of the Share ${datos.referencia} de ${datos.juego}, Shares have an additional 3% Network and Maintenance Fee Charge.`,
						icon: 'warning',
						confirmButtonColor: '#EC7063',
						confirmButtonText: 'Buy',
						showCancelButton: true,
						cancelButtonText: "Cancel"
						}).then((result) => {
							if (result.isConfirmed) {
								$.post("block",{
									jugar:"",
									idjuego: datos.id,
									correo: document.getElementById("correo").value
								},function(data){
									window.location.href="historialcliente";
								});  
							}
						});                                    
				});
		}
		else{
			Swal.fire({
				title: 'Buy',
				text: "Insufficient Balance to carry out this Operation..",
				icon: 'error',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Next'
				}); 
		}
	}else{
		if(document.getElementById("actualsaldo").value *1 >= document.getElementById(etiqueta).value *1 ){
			$.get("block?datosJuego&idjuego="+id,
				function(data){
					var datos= JSON.parse(data);
					Swal.fire({
						title: 'Buy',
						text: `You are sure to make the Subscription Purchase ${datos.tipo} de ${datos.juego}, Subscriptions are commission-free.`,
						icon: 'warning',
						confirmButtonColor: '#EC7063',
						confirmButtonText: 'Buy',
						showCancelButton: true,
						cancelButtonText: "Cancel"
						}).then((result) => {
							if (result.isConfirmed) {
								$.post("block",{
									jugar:"",
									idjuego: datos.id,
									correo: document.getElementById("correo").value
								},function(data){
									window.location.href="historialcliente";
								});  
							}
						});                                    
				});
		}
		else{
			Swal.fire({
				title: 'Buy',
				text: "Insufficient Balance to carry out this Operation..",
				icon: 'error',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Next'
				}); 
		}
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
		text: "Suscripcion Pausada, Vuelva a Intentarlo Mas tarde o Elija otra.",
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