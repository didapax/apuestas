/*
Javascript
*/

let retiros = [];
let depositos = [];
let historial = [];
let cajeros = [];
let person = [];

function myFunction() {
    var copyText = document.getElementById("cajero");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    navigator.clipboard.writeText(copyText.value);
}

/*function showDialog(){
    document.getElementById('agregar').show();
    document.getElementById("myTopnav").className = "topnav";
}  */

function guardar(){
    $.post("block",{
        guardarWallet:"",
        correo: document.getElementById("correo").value,                    
        payid: document.getElementById("payid").value
    },function(data){
        var datos= JSON.parse(data);
        console.log("result:", data)
        if(datos.result){
            Swal.fire({
                        title: 'Wallet',
                        text: "Tu Wallet de PayId ha sigo Guardada con exito..!",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });                                            
            leerDatos();
            //document.getElementById('agregar').close();    
        }
    });
}

function savebep20(){
    $.post("block",{
        guardarWalletBep20:"",
        correo: document.getElementById("correo").value,                    
        bep20: document.getElementById("bep20").value
    },function(data){
        var datos= JSON.parse(data);
        console.log("result:", data)
        if(datos.result){
            Swal.fire({
                        title: 'Wallet',
                        text: "Tu Wallet de BSC BEP-20 ha sigo Guardada con exito..!",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });                                            
            leerDatos();
            //document.getElementById('agregar').close();    
        }
    });    
}

function leerDatos(){
    if(document.getElementById("correo").value.length > 0){
        $.post("block",{
            getUsuario:"", 
            sesion: true,
            correo: document.getElementById("correo").value
        },function(data){
            console.log("datos: ",data);
            var datos= JSON.parse(data);            
            var botonDeposito = document.getElementById('buttonDeposito');
            var botonRetiro = document.getElementById('buttonRetiro');
            var oneMetodo = 0;          
            person = datos;  
            document.getElementById("payid").value = datos.binance;
            document.getElementById("bep20").value = datos.bep20;  
            $("#saldo").html("Saldo "+datos.saldo+" USDC"); 
            if(datos.binance != null && datos.binance.length > 0){
                document.getElementById("payid").readOnly = true;
                oneMetodo = 1
            }

            if(datos.bep20 != null && datos.bep20.length > 0){
                document.getElementById("bep20").readOnly = true;
                oneMetodo = 2;
            }

            if(oneMetodo === 0){
                botonDeposito.disabled = true;
                botonRetiro.disabled = true;                
                botonDeposito.innerHTML = "Debes Tener un Metodo de Pago Agregado";
                botonRetiro.innerHTML = "Debes Tener un Metodo de Pago Agregado";
            }

        });
    }
}

function initsession(){
    window.location.href="sesion";
}

function initDeposito(){
    Swal.fire({
        title: 'Depositar',
        text: "Debes estar seguro de Depositar desde tu misma Wallet de origen que declaraste, al hacer click en Aceptar estas firmando un contrato inteligente que declaras estar depositando desde tu wallet configurada en nuestra plataforma, los depositos tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red. ",
        icon: 'info',
        confirmButtonColor: '#EC7063',
        confirmButtonText: 'Si Acepto',
        showCancelButton: true,
        cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {    
                document.getElementById('jugada').show();    
            }
        });
}

function selpago(){

    let valor = document.getElementById("comopago").value;
    let correo = document.getElementById("cajero").value;
    const usuarioEncontrado = cajeros.find(usuario => usuario.CORREO === correo);

    if (usuarioEncontrado) {
        var imagen = document.getElementById('QRdeposito');
        document.getElementById("cantidad").value = 0;
        if(valor === "BINANCE"){
            $("#descripcionMetodo").html("Binance Pay");
            document.getElementById("paycajero").value = usuarioEncontrado.BINANCE;
            imagen.src= "Assets/Perfiles/"+usuarioEncontrado.QR_BINANCE;
            $("#detalles").css("display","inline-block")
            document.getElementById('tipo').value = "Deposito Binance Pay";            
        }
        if(valor === "BEP20"){
            $("#descripcionMetodo").html("Wallet BSC BEP-20");
            document.getElementById("paycajero").value = usuarioEncontrado.BEP20;
            imagen.src= "Assets/Perfiles/"+usuarioEncontrado.QR_BEP20;
            $("#detalles").css("display","inline-block")
            document.getElementById('tipo').value = "Deposito BSC BEP-20";            
        }     
    } else {
        console.log("Usuario no encontrado");
    }
}

function selretiro(){    
    if($("#como_retiro").val() == "BINANCE"){     
            $("#descripcionMetodoRetiro").html("Mi Binance Pay");            
            document.getElementById('tipo_retiro').value = "Retiro Binance Pay";
            document.getElementById("paycliente").value = person.binance;
            $("#detalles_retiro").css("display","inline-block");
     
    }
    if($("#como_retiro").val() == "BEP20"){     
            $("#descripcionMetodoRetiro").html("Mi Wallet BSC BEP-20");            
            document.getElementById('tipo_retiro').value = "Retiro BSC BEP-20";
            document.getElementById("paycliente").value = person.bep20;
            $("#detalles_retiro").css("display","inline-block");
    }
}

function retirar_back(){

    Swal.fire({
                title: 'Retirar',
                text: "Estas Seguro de realizar el Retiro de tu cuenta, los retiros tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red. ",
                icon: 'info',
                confirmButtonColor: '#EC7063',
                confirmButtonText: 'Si Retirar',
                showCancelButton: true,
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(document.getElementById("cantidad_retiro").value*1 > 0){
                            if((document.getElementById("tsaldo").value*1) >= (document.getElementById("cantidad_retiro").value*1)){
                                retirar();
                            }
                            else{
                                Swal.fire({
                                            title: 'Retiros',
                                            text: "Saldo USDC Insuficiente",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });
                            }
                        }
                        else{
                            Swal.fire({
                                            title: 'Retiros',
                                            text: "Los retiros debe ser minimo 1 USDC",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });
                        }                                   
                    }
                    else{
                        window.location.href="miwallet";
                    }
                });    

}


function jugar_back(){
    Swal.fire({
                title: 'Depositos',
                text: "Bienvenido Deposito a tu cuenta CriptoSignalGroup, los depositos tardan entre 24 a 48 horas en realizarse dependiendo de la congestion de la red. ",
                icon: 'info',
                confirmButtonColor: '#117A65',
                confirmButtonText: 'Depositar',
                cancelButtonColor: '#AEB6BF',
                showCancelButton: true,
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(document.getElementById("cantidad").value > 0){
                            lanzar();
                        }                
                        else{
                            Swal.fire({
                                            title: 'Depositos',
                                            text: "Los depositos debe ser al menos 1 USDC, o otro monto",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });                    
                        }                                  
                    }else{
                        window.location.href="miwallet";
                    }
                });            
}

function retirar(){
    if(document.getElementById("cantidad_retiro").value.length*1 > 0 && document.getElementById("como_retiro").value.length>0){
        document.getElementById("retirar_btn").disabled = true;
        let origen;
        let valor = document.getElementById("micajero_retiro").value;
        const cajeroEncontrado = cajeros.find(usuario => usuario.ID === valor);
    
        if (cajeroEncontrado) {
            if(document.getElementById("como_retiro").value == "BINANCE"){
                origen = cajeroEncontrado.BINANCE;
            }
            if(document.getElementById("como_retiro").value == "BEP20"){
                origen = cajeroEncontrado.BEP20;
            }     
        }
        
    $.post("block",{
            retirar:"",                        
            tipo: document.getElementById("tipo_retiro").value,
            comopago: document.getElementById("como_retiro").value,
            origen: origen,
            destino: document.getElementById("paycliente").value,
            correo: document.getElementById("correo").value,
            cajero: document.getElementById("cajero").value,
            monto: document.getElementById("cantidad_retiro").value,                        
            recibe: document.getElementById("recibe").value,
            comision: document.getElementById("comision_retiro").value
        },function(data){
            document.getElementById('retirar').close();
            document.getElementById("retirar_btn").disabled = false;
            inicio();
        });  
    }else{
        Swal.fire({
                        title: 'Retirar',
                        text: "No se puede realizar el retiro o faltan datos",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
    }         
}

function lanzar(){
    if(document.getElementById("cantidad").value.length*1 > 0 && document.getElementById("comopago").value.length>0){
        document.getElementById("jugar").disabled = true;
        let origen;
        if(document.getElementById("comopago").value == "BINANCE"){
            origen = person.binance;
        }
        if(document.getElementById("comopago").value == "BEP20"){
            origen = person.bep20;
        }

    $.post("block",{
            depositar:"",
            origen: origen,
            destino: document.getElementById("paycajero").value,
            cantidad: document.getElementById("cantidad").value,
            tipo: document.getElementById("tipo").value,
            comopago: document.getElementById("comopago").value,
            cajero: document.getElementById("cajero").value,
            correo: document.getElementById("correo").value
        },function(data){
            document.getElementById('jugada').close();
            document.getElementById("jugar").disabled = false;
            inicio();
        });  
    }else{
        Swal.fire({ 
                        title: 'Depositos',
                        text: "No se puede realizar el deposito o faltan datos",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });                    
    }         
}

function calculo_retiro(){
    let cantidad = document.getElementById("cantidad_retiro").value *1;
    let comision = 0;
    let porcentaje = 3; 
    let total = 0;

    comision = (cantidad * porcentaje) / 100;
    total = cantidad - comision;
    document.getElementById("recibe").value = Math.round(total * 100) / 100;
    document.getElementById("comision_retiro").value = Math.round(comision * 100) / 100;
    $("#calculo_retiro").html("<li>Retiro por =  "+ cantidad + " USDC</li>"+"<li>Comision de Red "+porcentaje+"% =  "+ Math.round(comision * 100) / 100 + " USDC</li>"+"<li>Usted Recibe =  <b>"+ Math.round(total * 100) / 100 + "</b> USDC</li>");

}

function calculo(){
    let cantidad = document.getElementById("cantidad").value *1;
    let comision = 0;
    let porcentaje = 0; 
    let total = 0;

    comision = (cantidad * porcentaje) / 100;
    total = cantidad - comision;
    $("#calculo").html("<li>Deposito =  "+ cantidad + " USDC</li>"+"<li>Comision de Red "+porcentaje+"% =  "+ Math.round(comision * 100) / 100 + " USDC</li>"+"<li>Usted Recibe =  <b>"+ Math.round(total * 100) / 100 + "</b> USDC</li>");
}
 
function calificacion(n,cal,id){
    if(cal == 0){
        let control=`<select style="width:100px;border:none;" id="cal${id}" onchange="setCal(${id})" >
        <option value="0">califica...</option>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
        </select>`;  
        return control;      
    }else{
        return dibujarEstrellas(n)
    }
}

function setCal(id){
    const elemento = "cal"+id;
    const rate = document.getElementById(elemento).value;
    let t1 = retiros.find(usuario => usuario.id*1 === id*1);
    let cajero="pepe";
    if(t1){
        cajero = t1.cajero; 

    }else{
        let t2 = depositos.find(usuario => usuario.id*1 === id*1);
        if(t2){
            cajero = t2.cajero;
        }        
    }

    Swal.fire({
        title: 'Calificaciones',
        text: "Revise antes de Calificar que la transaccion sea exitosa. Esta seguro de enviar esta calificacion.?",
        icon: 'info',
        confirmButtonColor: '#117A65',
        confirmButtonText: 'Calificar',
        cancelButtonColor: '#AEB6BF',
        showCancelButton: true,
        cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("block",{
                    setCal:"",
                    id: id,
                    cajero: cajero,
                    rate: rate
                },function(data){
                        inicio();        
                });            
            }    
        });
}

function mostrarTablaRetiros() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo-retiro");
    tablaCuerpo.innerHTML = "";

    retiros.forEach((producto, index) => {
        let color_estatus="#FAD7A0";
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
            <td>${producto.ticket}</td>
            <td>${producto.descripcion}</td>
            <td>${Math.round(producto.monto * 100) / 100} Usdc</td>
            <td style='background:${color_estatus}'>${producto.estatus}</td>
            <td>${calificacion(producto.rate,producto.calificado,producto.id)}</td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}


function mostrarTablaDepositos() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo-depositos");
    tablaCuerpo.innerHTML = "";

    depositos.forEach((producto, index) => {
        let color_estatus="#FAD7A0";
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
            <td>${producto.ticket}</td>
            <td>${producto.descripcion}</td>
            <td>${Math.round(producto.monto * 100) / 100} Usdc</td>
            <td style='background:${color_estatus}'>${producto.estatus}</td>
            <td>${calificacion(producto.rate,producto.calificado,producto.id)}</td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}  

function mostrarCajeros() {
    let fila = "<option value=''>selecciona uno...</option>";
    const selCajeros = document.getElementById("micajero");
    const selCajeros_Retiro = document.getElementById("micajero_retiro");
    selCajeros.innerHTML = fila;
    selCajeros_Retiro.innerHTML = fila;

    cajeros.forEach((producto) => {
        let estrellas = dibujarEstrellas(producto.RATE);
        let option = document.createElement("option");
        let option2 = document.createElement("option");
        option.value = producto.ID;
        option2.value = producto.ID;
        option.textContent = producto.NOMBRE_USUARIO+" "+ estrellas;
        option2.textContent = producto.NOMBRE_USUARIO+" "+ estrellas;
        selCajeros.appendChild(option);
        selCajeros_Retiro.appendChild(option2);
    });
}

function selcajero_retiro(){
    let valor = document.getElementById("micajero_retiro").value;
    const usuarioEncontrado = cajeros.find(usuario => usuario.ID === valor);
    const selPerson = document.getElementById("como_retiro");
    let fila = "<option value=''>selecciona uno...</option>";
    selPerson.innerHTML = fila; // Agrega la opción inicial directamente

    if (usuarioEncontrado) {
        document.getElementById('cajero').value = usuarioEncontrado.CORREO;

        if(person.binance != null && person.binance.length > 0){
            let option = document.createElement("option");
            option.value = 'BINANCE';
            option.textContent = 'Binance Pay';
            selPerson.appendChild(option);
        }
        if(person.bep20 != null && person.bep20.length > 0){
            let option = document.createElement("option");
            option.value = 'BEP20';
            option.textContent = 'Red BSC BEP-20';
            selPerson.appendChild(option);
        }     
    }else {
        console.log("Usuario no encontrado");
    } 
}

function selcajero(){
    let valor = document.getElementById("micajero").value;

    let fila = "<option value=''>selecciona uno...</option>";
    const selCajeros = document.getElementById("comopago");
    selCajeros.innerHTML = fila; // Agrega la opción inicial directamente

    const usuarioEncontrado = cajeros.find(usuario => usuario.ID === valor);

    if (usuarioEncontrado) {
        document.getElementById('cajero').value = usuarioEncontrado.CORREO;
        if(usuarioEncontrado.BINANCE != null && usuarioEncontrado.BINANCE.length > 0 && usuarioEncontrado.ACTIVE_BINANCE *1 === 1){
            let option = document.createElement("option");
            option.value = 'BINANCE';
            option.textContent = 'Binance Pay';
            selCajeros.appendChild(option);
        }
        if(usuarioEncontrado.BEP20 != null && usuarioEncontrado.BEP20.length > 0 && usuarioEncontrado.ACTIVE_BEP20 *1 === 1){
            let option = document.createElement("option");
            option.value = 'BEP20';
            option.textContent = 'Red BSC BEP-20';
            selCajeros.appendChild(option);
        }     
    } else {
        console.log("Usuario no encontrado");
    }
}

function dibujarEstrellas(n) {
    var estrellas = '';
    for (var i = 0; i < n; i++) {
        estrellas += '⭐';
    }
    return estrellas;
}

function recuperarCajeros() {
    fetch("block?listCajeros=")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.status);
            }
            return response.json(); // Parsear la respuesta como JSON
        })
        .then(data => {
            cajeros = data;    
            mostrarCajeros();
            console.log("Cajeros:", data);
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
    
    }

function recuperarRetiros() {
    fetch("block?readRetiros=1&correo="+document.getElementById('correo').value)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.status);
            }
            return response.json(); // Parsear la respuesta como JSON
        })
        .then(data => {
            retiros = data;  
            
            mostrarTablaRetiros();
            // Aquí puedes procesar los datos recibidos (data)
            console.log("Datos retiros:", data);
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
    
    }
    

    function recuperarDepositos() {
        fetch("block?readDepositos=1&correo="+document.getElementById('correo').value)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud: " + response.status);
                }
                return response.json(); // Parsear la respuesta como JSON
            })
            .then(data => {
                depositos = data;  
                
                mostrarTablaDepositos();
                // Aquí puedes procesar los datos recibidos (data)
                console.log("Datos Depositos:", data);
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
            });
        
        }

        function mostrarTablaHistorial() {
            const tablaCuerpo = document.getElementById("tabla-cuerpo-historial");
            tablaCuerpo.innerHTML = "";
        
            historial.forEach((producto, index) => {
                let color_estatus="#FAD7A0";
                switch (producto.estatus) {
                    case 'PAGADO':
                        color_estatus="#4caf50";
                        break;
                        case 'VENCIDO':
                            color_estatus="#2196f3";
                            break;        
        
                        case 'ACTIVO':
                            color_estatus="#ff9800";
                            break;        
                    default:
                        color_estatus="#FAD7A0";
                        break;
                }
                const fila = document.createElement("tr");
                fila.innerHTML = `
                    <td>${producto.fin}</td>
                    <td>${producto.faltan_dias}</td>
                    <td>${producto.juego}</td>
                    <td>${Math.round(producto.total_pagar * 100) / 100} Usdc</td>
                    <td style='background:${color_estatus}'>${producto.estatus}</td>
                `;
                tablaCuerpo.appendChild(fila);
            });
        }          

        function recuperarHistorial() { 
            fetch("block?readHistorial=&cliente="+document.getElementById('correo').value)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error en la solicitud: " + response.status);
                    }
                    return response.json(); // Parsear la respuesta como JSON
                })
                .then(data => {
                    historial = data;                    
                    mostrarTablaHistorial();
                    // Aquí puedes procesar los datos recibidos (data)
                    console.log("Datos Historial:", data);
                })
                .catch(error => {
                    console.error("Error en la solicitud:", error);
                });
            
        }        
    
        function inicio(){
            leerDatos();                
            recuperarRetiros();  
            recuperarDepositos();  
            recuperarHistorial();  
            recuperarCajeros();
            //myVar = setInterval(refrescar, 2000);
        }           

