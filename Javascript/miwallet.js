/*
Javascript
*/

let retiros = [];
let depositos = [];
let historial = [];

function myFunction() {
    var copyText = document.getElementById("cajero");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    navigator.clipboard.writeText(copyText.value);
}

function showDialog(){
    document.getElementById('agregar').show();
    document.getElementById("myTopnav").className = "topnav";
}  

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
            document.getElementById('agregar').close();    
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
            document.getElementById("payid").value = datos.binance;
            //document.getElementById("wallet_binance").value = datos.binance;  
            $("#saldo").html("Saldo "+datos.saldo+" USDC"); 

            if(datos.binance != null && datos.binance.length > 0){
                document.getElementById("payid").readOnly = true;
            }
        });
    }
}

function initsession(){
    window.location.href="sesion";
}

function selpago(){
    if(document.getElementById("payid").value.length >0){
        if($("#comopago").val() == "BINANCE"){                    
        $.post("block",{
            getUsuario:"",
            sesion: true,
            correo: document.getElementById("cajero").value
        },function(data){
            var datos= JSON.parse(data);                        
            document.getElementById("cantidad").value = 0;
            document.getElementById("paycajero").value = datos.binance;
            //$("#info").html(" USDC + Comision por Uso de Red");
            $("#detalles").css("display","inline-block")
            document.getElementById('tipo').value = "Deposito Binance Pay";
        });
    }
    }   
    else{
        Swal.fire({
                        title: 'Depositos',
                        text: "Debe Tener un Binance Pay ID Valido Para los Depositar..!",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });                    
    }             

}

function selretiro(){
    if($("#como_retiro").val() == "BINANCE"){
        if(document.getElementById("payid").value.length >0){
            $.post("block",{
            getUsuario:"",
            sesion: true,
            correo: document.getElementById("correo").value
            },function(data){
                var datos= JSON.parse(data);                        
                //document.getElementById("cantidad_retiro").min = 10;
                //document.getElementById("cantidad_retiro").value = 0;
                //$("#info_retiro").html("USDC - Comision de Red");
                $("#detalles_retiro").css("display","inline-block");
                document.getElementById('tipo_retiro').value = "Retiro Binance Pay";
                document.getElementById("cajero_retiro").value = document.getElementById("wallet_binance").value;
            });
        }
        else{
            Swal.fire({
                        title: 'Retiros',
                        text: "Debe Tener un Binance Pay ID Valido Para los retiros..!",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
        }
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
                        if($("#como_retiro").val() == "BINANCE" && (document.getElementById("cantidad_retiro").value*1) > 0){
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
                        if($("#comopago").val() == "BINANCE" && document.getElementById("cantidad").value > 0){
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
    if(document.getElementById("cantidad_retiro").value.length>0 && document.getElementById("como_retiro").value.length>0){
        document.getElementById("retirar_btn").disabled = true;
    $.post("block",{
            retirar:"",                        
            tipo: document.getElementById("tipo_retiro").value,
            comopago: document.getElementById("como_retiro").value,
            nota: document.getElementById("wallet_binance").value,
            correo: document.getElementById("correo").value,
            cajero: document.getElementById("cajero").value,
            monto: document.getElementById("cantidad_retiro").value,                        
            recibe: document.getElementById("recibe").value,
            comision: document.getElementById("comision_retiro").value
        },function(data){
            document.getElementById('retirar').close();
            document.getElementById("retirar_btn").disabled = false;
            if(data.length>0){
                document.getElementById("retirar_btn").disabled = false;
            }
            window.location.href="historialcliente";
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
    if(document.getElementById("cantidad").value.length>0 && document.getElementById("comopago").value.length>0){
        document.getElementById("jugar").disabled = true;
    $.post("block",{
            depositar:"",
            nota: document.getElementById("wallet_binance").value,
            cantidad: document.getElementById("cantidad").value,
            tipo: document.getElementById("tipo").value,
            comopago: document.getElementById("comopago").value,
            cajero: document.getElementById("cajero").value,
            correo: document.getElementById("correo").value
        },function(data){
            document.getElementById('jugada').close();
            document.getElementById("jugar").disabled = false;
            if(data.length>0){
                document.getElementById("jugar").disabled = false;
            }
            window.location.href="historialcliente";
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
        `;
        tablaCuerpo.appendChild(fila);
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
    

