/*
Javascript
*/

let retiros = [];
let depositos = [];
let historial = [];
let cajeros = [];
let person = [];
let dataSend = [];
let retiroTabla = null;
let sendTabla = null;
let cajeroTabla = null;
let depositosTabla = null;
let historialTabla = null;

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
    let binance = document.getElementById("payid").value;
    let userBinance = document.getElementById("userBinance").value;
    let bep20 = document.getElementById("bep20").value;

        Swal.fire({
            title: 'Cryptosignal',
            text: `Your wallet will be saved. Please note that once saved, it cannot be modified without contacting support.`,
            icon: 'warning',
            confirmButtonColor: '#EC7063',
            confirmButtonText: 'Yes, i\'m sure',
            showCancelButton: true,
            cancelButtonText: "No, go back"
            }).then((result) => {
                if (result.isConfirmed) {    
                    $.post("block",{
                        guardarWallet:"",
                        correo: document.getElementById("correo").value,                    
                        payid: binance,
                        userBinance: userBinance,
                        bep20: bep20
                    },function(data){
                        var datos= JSON.parse(data);
                        console.log("result:", data)
                        if(datos.result){
                            Swal.fire({
                                        title: 'Wallet',
                                        text: "Your PayId Wallet has been successfully filed!",
                                        icon: 'info',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                        });                                            
                            leerDatos();                        
                        }
                    });                
                }
            });
}

function savebep20(){
    let bep20 = document.getElementById("bep20").value;
    Swal.fire({
        title: 'Cryptosignal',
        text: `Your wallet will be saved to the BSC BEP20 network: ${bep20}. Please confirm!`,
        icon: 'warning',
        confirmButtonColor: '#EC7063',
        confirmButtonText: 'Yes, sure',
        showCancelButton: true,
        cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {    
                $.post("block",{
                    guardarWalletBep20:"",
                    correo: document.getElementById("correo").value,                    
                    bep20: bep20
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
                    }
                });                   
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
            document.getElementById("userBinance").value = datos.nombreUsuario;
            document.getElementById("payid").value = datos.binance;
            document.getElementById("bep20").value = datos.bep20;  
            $("#saldo").html(datos.saldo); 
            if(datos.binance != null && datos.binance.length > 0 && datos.nombreUsuario != null && datos.nombreUsuario.length > 0){
                document.getElementById("payid").readOnly = true;
                document.getElementById("userBinance").readOnly = true;
                oneMetodo = 1
            }

            if(datos.bep20 != null && datos.bep20.length > 0){
                document.getElementById("bep20").readOnly = true;
                oneMetodo = 2;
            }

            if(oneMetodo === 0){
                botonDeposito.disabled = true;
                botonRetiro.disabled = true;                
                botonDeposito.innerHTML = "You must have a payment method added";
                botonRetiro.innerHTML = "You must have a payment method added";
            }
            else{
                botonDeposito.disabled = false;
                botonRetiro.disabled = false;                
                botonDeposito.innerHTML = "Deposit";
                botonRetiro.innerHTML = "Withdraw";
            }

        });
    }
}

function initsession(){
    window.location.href="sesion";
}

function initDeposito(){
    Swal.fire({
        title: 'Deposit',
        text: "Deposit must originate from the same wallet you provided. Clicking 'Accept' confirms this and signs a smart contract. Please note that deposits can take up to 48 hours to complete.",
        icon: 'info',
        confirmButtonColor: '#EC7063',
        confirmButtonText: 'Yes, I accept',
        showCancelButton: true,
        cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {    
                document.getElementById('modalOverlay').style.display = 'flex';
                document.getElementById("overlay-common-dialog-2").style.display = 'flex';
            }
        });
}

function closeOverlayModal() {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById("overlay-common-dialog-2").style.display = 'none';
}

function closeOverlayModal2() {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById("overlay-common-dialog-3").style.display = 'none';
}


function selpago(){
    let userBinance = document.getElementById("userBinance").value;
    let walletBinance = document.getElementById("payid").value;
    let walletBep20 = document.getElementById("bep20").value;
    let valor = document.getElementById("comopago").value;
    let correo = document.getElementById("cajero").value;
    const usuarioEncontrado = cajeros.find(usuario => usuario.CORREO === correo);

    if (usuarioEncontrado) {
        var imagen = document.getElementById('QRdeposito');
        document.getElementById("cantidad").value = 0;
        if(valor === "BINANCE"){
            if(userBinance && walletBinance){
                $("#descripcionMetodo").html("<b>Please send the funds to this Binance Pay address prior to depositing</b>");
                document.getElementById("paycajero").value = usuarioEncontrado.BINANCE;
                imagen.src= "Assets/Perfiles/"+usuarioEncontrado.QR_BINANCE;
                $("#detalles").css("display","inline-block")
                document.getElementById('tipo').value = "Binance Pay Deposit";
            }
            else{
                Swal.fire({
                    title: 'Wallet',
                    text: "You don't have this payment method added. Choose another one",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }); 
                    $("#detalles").css("display","none")
                    document.getElementById('tipo').value = "";
            }
        }
        if(valor === "BEP20"){
            if(walletBep20){
                $("#descripcionMetodo").html("<b>To complete the deposit, please transfer the funds to the following BSC BEP-20 wallet beforehand.</b>");
                document.getElementById("paycajero").value = usuarioEncontrado.BEP20;
                imagen.src= "Assets/Perfiles/"+usuarioEncontrado.QR_BEP20;
                $("#detalles").css("display","inline-block")
                document.getElementById('tipo').value = "Deposito BSC BEP-20";            
            }
            else{
                Swal.fire({
                    title: 'Wallet',
                    text: "You don't have this payment method added. Choose another one",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    });
                    $("#detalles").css("display","none")
                    document.getElementById('tipo').value = "";                    
            }
        }     
    } else {
        console.log("User not found");
    }
}

function selretiro(){
    let userBinance = document.getElementById("userBinance").value;
    let walletBinance = document.getElementById("payid").value;
    let walletBep20 = document.getElementById("bep20").value;

    if($("#como_retiro").val() == "BINANCE"){     
        if(userBinance && walletBinance){
            $("#descripcionMetodoRetiro").html("My Binance Pay");            
            document.getElementById('tipo_retiro').value = "Withdrawal from Binance Pay";
            document.getElementById("paycliente").value = person.binance;
            $("#detalles_retiro").css("display","inline-block");
        }
        else{
            Swal.fire({
                title: 'Wallet',
                text: "You don't have this payment method added. Choose another one.",
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
                });
                $("#detalles_retiro").css("display","none");
        }
    }
    if($("#como_retiro").val() == "BEP20"){
        if(walletBep20){
            $("#descripcionMetodoRetiro").html("Mi Wallet BSC BEP-20");            
            document.getElementById('tipo_retiro').value = "Retiro BSC BEP-20";
            document.getElementById("paycliente").value = person.bep20;
            $("#detalles_retiro").css("display","inline-block");
        }
        else{
            $("#detalles_retiro").css("display","none");
        }
    }
}

function retirar_back(){

    Swal.fire({
                title: 'Withdrawal',
                text: "Are you sure you want to proceed with the withdrawal? Please note that withdrawals may take between 24 and 48 hours to process due to network congestion.",
                icon: 'info',
                confirmButtonColor: '#EC7063',
                confirmButtonText: 'Yes, withdraw',
                showCancelButton: true,
                cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(document.getElementById("cantidad_retiro").value*1 > 0){
                            if((document.getElementById("tsaldo").value*1) >= (document.getElementById("cantidad_retiro").value*1)){
                                retirar();
                            }
                            else{
                                Swal.fire({
                                            title: 'Withdrawal',
                                            text: "Insufficient USDC balance",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });
                            }
                        }
                        else{
                            Swal.fire({
                                            title: 'Retiros',
                                            text: "Withdrawals must be at least 1 USDC",
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
                title: 'Alert!',
                text: "Are you sure you've already transferred the funds to your Binance wallet from the ATM? Please note that deposits can take between 24 and 48 hours to process, depending on network congestion.",
                icon: 'info',
                confirmButtonColor: '#117A65',
                confirmButtonText: 'Deposit',
                cancelButtonColor: '#AEB6BF',
                showCancelButton: true,
                cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(document.getElementById("cantidad").value > 0){
                            lanzar();
                        }                
                        else{
                            Swal.fire({
                                            title: 'Deposits',
                                            text: "Deposits must be at least 1 USDC",
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
            comision: document.getElementById("comision_retiro").value,
            moneda: document.getElementById("establecoin_retiro").value
        },function(data){
            closeOverlayModal2();
            //document.getElementById("retirar_btn").disabled = false;
            window.location.href="miwallet";
        });  
    }else{
        Swal.fire({
                        title: 'Withdraw',
                        text: "Withdrawal cannot be processed or data is missing.",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
    }        
}

function showModalOverlay2() {
    document.getElementById('modalOverlay2').style.display = 'flex';
    document.getElementById("overlay-common-dialog-3").style.display = 'flex';
}

function closeModalOverlay2() {
    document.getElementById('modalOverlay2').style.display = 'none';
    document.getElementById("overlay-common-dialog-3").style.display = 'none';
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
            correo: document.getElementById("correo").value,
            moneda: document.getElementById("establecoin").value
        },function(data){
            closeOverlayModal();
            //document.getElementById("jugar").disabled = false;
            window.location.href="miwallet";
        });  
    }else{
        Swal.fire({ 
                        title: 'Deposit',
                        text: "Cannot complete the deposit. Missing Data",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });                    
    }         
}

function calculo_retiro(){
    let establecoin = document.getElementById("establecoin_retiro").value;
    let cantidad = document.getElementById("cantidad_retiro").value *1;
    let comision = 0;
    let porcentaje = 3; 
    let total = 0;

    comision = (cantidad * porcentaje) / 100;
    total = cantidad - comision;
    document.getElementById("recibe").value = Math.round(total * 100) / 100;
    document.getElementById("comision_retiro").value = Math.round(comision * 100) / 100;
    $("#calculo_retiro").html(`<li>Deposit =  ${cantidad} " ${establecoin}</li><li>Chain commission <b style='color:red;'> ${porcentaje}% =  ${Math.round(comision * 100) / 100}</b> ${establecoin}</li><li>You Get =  <b class='b-green;'>${Math.round(total * 100) / 100}</b> ${establecoin}</li>`);

}

function calculo(){
    let establecoin = document.getElementById("establecoin").value;
    let cantidad = document.getElementById("cantidad").value *1;
    let comision = 0;
    let porcentaje = 0; 
    let total = 0;

    comision = (cantidad * porcentaje) / 100;
    total = cantidad - comision;    
    $("#calculo").html(`<li>Deposit =  ${cantidad} " ${establecoin}</li><li>Chain commission <b style='color:red;'> ${porcentaje}% =  ${Math.round(comision * 100) / 100}</b> ${establecoin}</li><li>You Get =  <b class='b-green'>${Math.round(total * 100) / 100} ${establecoin}</b></li>`);
}
 
function calificacion(n,cal,id){
    if(cal == 0){
        let control=`<select style="width:100px;border:none;" id="cal${id}" onchange="setCal(${id})" >
        <option value="0">Rate...</option>
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
        title: 'Ratings',
        text: "Please verify that the transaction was successful before submitting your rating. Are you sure you want to send this rating?",
        icon: 'info',
        confirmButtonColor: '#117A65',
        confirmButtonText: 'Rate',
        cancelButtonColor: '#AEB6BF',
        showCancelButton: true,
        cancelButtonText: "Go Back"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("block",{
                    setCal:"",
                    id: id,
                    cajero: cajero,
                    rate: rate
                },function(data){
                    window.location.href="miwallet";        
                });            
            }    
        });
} 

function mostrarTablaRetiros() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo-retiro");
    tablaCuerpo.innerHTML = "";

    retiros.forEach((producto, index) => {
        let color_estatus="#ff7b7b";
        switch (producto.estatus) {
            case 'Under Review':
                color_estatus="#25d596";
                break;
                case 'In Process':
                    color_estatus="#478cf7";
                    break;        

                case 'Successful':
                    color_estatus="#f78c3d";
                    break;        
            default:
                color_estatus="#ff7b7b";
                break;
        }        
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${producto.fecha}</td>
            <td>${producto.ticket}</td>
            <td>${producto.descripcion}</td>
            <td>${Math.round(producto.recibe * 100) / 100} ${producto.moneda}</td>
            <td>${Math.round(producto.comision * 100) / 100}</td>
            <td>${Math.round(producto.monto * 100) / 100}</td>
            <td style='color: #fff;font-weight: 600;text-align: center;background:${color_estatus}'>${producto.estatus}</td>
            <td>${calificacion(producto.rate,producto.calificado,producto.id)}</td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}

function mostrarTablaSend() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo-send");
    tablaCuerpo.innerHTML = "";

    dataSend.forEach((producto, index) => {
        let color_estatus="#ff7b7b";
        switch (producto.estatus) {
            case 'Under Review':
                color_estatus="#25d596";
                break;
                case 'In Process':
                    color_estatus="#478cf7";
                    break;        

                case 'Successful':
                    color_estatus="#f78c3d";
                    break;        
            default:
                color_estatus="#ff7b7b";
                break;
        }        
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${producto.fecha}</td>
            <td>${producto.ticket}</td>
            <td>${producto.sendto}</td>
            <td style='color:${producto.color};'>${Math.round(producto.monto * 100) / 100} ${producto.moneda}</td>
            <td style='color: #fff;font-weight: 600;text-align: center;background:${color_estatus}'>${producto.estatus}</td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}

function mostrarTablaDepositos() {
    const tablaCuerpo = document.getElementById("tabla-cuerpo-depositos");
    tablaCuerpo.innerHTML = "";

    depositos.forEach((producto, index) => {
        let color_estatus="#ff7b7b";
        switch (producto.estatus) {
            case 'Under Review':
                color_estatus="#25d596";
                break;
                case 'In Process':
                    color_estatus="#478cf7";
                    break;        

                case 'Successful':
                    color_estatus="#f78c3d";
                    break;        
            default:
                color_estatus="#ff7b7b";
                break;
        }
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${producto.fecha}</td>
            <td>${producto.ticket}</td>
            <td>${producto.descripcion}</td>
            <td>${Math.round(producto.monto * 100) / 100} ${producto.moneda}</td>
            <td style='color: #fff;font-weight: 600;text-align: center;background:${color_estatus}'>${producto.estatus}</td>
            <td>${calificacion(producto.rate,producto.calificado,producto.id)}</td>
        `;
        tablaCuerpo.appendChild(fila);
    });
}  

function mostrarCajeros() {
    let fila = "<option value=''>Select.</option>";
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
    let fila = "<option value=''>Select...</option>";
    selPerson.innerHTML = fila; // Agrega la opción inicial directamente

    if (usuarioEncontrado) {
        document.getElementById('cajero').value = usuarioEncontrado.CORREO;

        if(person.binance != null && person.binance.length > 0){
            let option = document.createElement("option");
            option.value = 'BINANCE';
            option.textContent = 'Binance';
            selPerson.appendChild(option);
        }
        if(person.bep20 != null && person.bep20.length > 0){
            let option = document.createElement("option");
            option.value = 'BEP20';
            option.textContent = 'BSC BEP-20 Smart Chain';
            selPerson.appendChild(option);
        }     
    }else {
        console.log("User not found");
    } 
}

function selcajero(){
    let valor = document.getElementById("micajero").value;

    let fila = "<option value=''>Select...</option>";
    const selCajeros = document.getElementById("comopago");
    selCajeros.innerHTML = fila; // Agrega la opción inicial directamente

    const usuarioEncontrado = cajeros.find(usuario => usuario.ID === valor);

    if (usuarioEncontrado) {
        document.getElementById('cajero').value = usuarioEncontrado.CORREO;
        if(usuarioEncontrado.BINANCE != null && usuarioEncontrado.BINANCE.length > 0 && usuarioEncontrado.ACTIVE_BINANCE *1 === 1){
            let option = document.createElement("option");
            option.value = 'BINANCE';
            option.textContent = 'Binance';
            selCajeros.appendChild(option);
        }
        if(usuarioEncontrado.BEP20 != null && usuarioEncontrado.BEP20.length > 0 && usuarioEncontrado.ACTIVE_BEP20 *1 === 1){
            let option = document.createElement("option");
            option.value = 'BEP20';
            option.textContent = 'Red BSC BEP-20';
            selCajeros.appendChild(option);
        }     
    } else {
        console.log("User not Found");
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


    function recuperarSend() {
        fetch("block?readSend=1&correo="+document.getElementById('correo').value)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud: " + response.status);
                }
                return response.json(); // Parsear la respuesta como JSON
            })
            .then(data => {
                dataSend = data;  
                
                mostrarTablaSend();
                
                 sendTabla = $('#tableSend').DataTable({
                    responsive: true,
                    paging: true,
                    searching: true
                });
                
                //new DataTable('#example1');
                // Aquí puedes procesar los datos recibidos (data
                console.log("Datos retiros:", data);
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
            
             retiroTabla = $('#example1').DataTable({
                responsive: true,
                paging: true,
                searching: true
            });
            
            //new DataTable('#example1');
            // Aquí puedes procesar los datos recibidos (data
            console.log("Datos retiros:", data);
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
        });
    
    }
    
    function recalcRetiros() {
        function recalcResponsive() {
            return new Promise(resolve => {
                retiroTabla.responsive.recalc();
                setTimeout(resolve, 500); // Espera a que termine la recalculación
            });
        }
    
        recalcResponsive().then(recalcResponsive);
    }

    function recalcSend() {
        function recalcResponsive() {
            return new Promise(resolve => {
                sendTabla.responsive.recalc();
                setTimeout(resolve, 500); // Espera a que termine la recalculación
            });
        }
    
        recalcResponsive().then(recalcResponsive);
    }        

    function recalcCajeros() {
        function recalcResponsive() {
            return new Promise(resolve => {
                cajeroTabla.responsive.recalc();
                setTimeout(resolve, 500); // Espera a que termine la recalculación
            });
        }
    
        recalcResponsive().then(recalcResponsive);
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
                
                depositosTabla = $('#example').DataTable({                    
                    responsive: true,
                    paging: true,
                    searching: true
                });
                
                //new DataTable('#example');
                // Aquí puedes procesar los datos recibidos (data)
                console.log("Datos Depositos:", data);
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
            });
        
        }

        function recalcDepositos() {
            function recalcResponsive() {
                return new Promise(resolve => {
                    depositosTabla.responsive.recalc();
                    setTimeout(resolve, 500); // Espera a que termine la recalculación
                });
            }
        
            recalcResponsive().then(recalcResponsive);
        }  

        function mostrarTablaHistorial() {
            const tablaCuerpo = document.getElementById("tabla-cuerpo-historial");
            tablaCuerpo.innerHTML = "";
        
            historial.forEach((producto, index) => {
                let color_estatus="#ff7b7b";
                switch (producto.estatus) {
                    case 'COMPLETED':
                        color_estatus="#25d596";
                        break;
                        case 'EXPIRED':
                            color_estatus="#478cf7";
                            break;        
        
                        case 'ACTIVE':
                            color_estatus="#25d596";
                            break;        
                    default:
                        color_estatus="#ff7b7b";
                        break;
                }
                const fila = document.createElement("tr");
                fila.innerHTML = `
                    <td>${producto.fin}</td>
                    <td>${producto.faltan_dias}</td>
                    <td>${producto.juego}</td>
                    <td>${Math.round(producto.monto * 100) / 100} Usdc</td>
                    <td style='color: #fff;font-weight: 600;text-align: center;background:${color_estatus}'>${producto.estatus}</td>
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
                    
                    historialTabla = $('#example2').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true
                    });
                    
                    //new DataTable('#example2'); 
                    // Aquí puedes procesar los datos recibidos (data)
                    console.log("Datos Historial:", data);
                })
                .catch(error => {
                    console.error("Error en la solicitud:", error);
                });
            
        }   
        
        
        function recalcHistorial() {
            function recalcResponsive() {
                return new Promise(resolve => {
                    historialTabla.responsive.recalc();
                    setTimeout(resolve, 500); // Espera a que termine la recalculación
                });
            }
        
            recalcResponsive().then(recalcResponsive);
        }  
        
        function mostrarAyudaBinance() {
            const dialog = document.getElementById("info-dialog");
            dialog.showModal();
        }

        function mostrarTecnoDialog() {
            const tecnoDialog = document.getElementById("tecno-dialog");
            
            document.getElementById("overlay-common-dialog-1").style.display = 'flex';
            tecnoDialog.style.display = 'block';

        }

        function closeTecnoDialog() {
            document.getElementById('tecno-dialog').style.display = 'none';
            document.getElementById("overlay-common-dialog-1").style.display = 'none';
        }

        function enviarAsistencia(){
            const tecnoDialog = document.getElementById("tecno-dialog");
            const cliente = document.getElementById("correo").value;
            const asunto = document.getElementById("asuntoTecno").value;
            const mensaje = document.getElementById("mensajeTecno").value;
            if(asunto && mensaje){
                tecnoDialog.style.display ='none';
                document.getElementById('overlay-common-dialog-1').style.display ='none';

                Swal.fire({
                    title: 'Cryptosignal',
                    text: `We will proceed to open a support ticket with your case. ${asunto}`,
                    icon: 'warning',
                    confirmButtonColor: '#EC7063',
                    confirmButtonText: 'Yes, thanks',
                    showCancelButton: true,
                    cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {    
                            $.post("servermail",{
                                sendmailtecno: "",
                                cliente: cliente,
                                asunto: asunto,
                                mensaje: mensaje
                            },function(data){
                                    Swal.fire({
                                                title: 'Technical Assistance Support',
                                                text: "Your support ticket is being processed. You will be contacted at the email address registered on the platform within 24 to 48 hours. Please stay tuned. Thank you and we apologize for any inconvenience.",
                                                icon: 'info',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Ok'
                                                });
                            });     
                        }
                    });             
            }
            else{
                Swal.fire({
                    title: 'Cryptosignal',
                    text: "Lack of Data. You can't create an empty ticket!",
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                });
            }
        }

        function sendToEmail(){
            if(document.getElementById("amountTo").value*1 > 0){
                if((document.getElementById("tsaldo").value*1) >= (document.getElementById("amountTo").value*1)){
                    if(document.getElementById("sendTo").value.length>0){
                        Swal.fire({
                            title: 'Send',
                            text: "Confirms that you will ship at "+document.getElementById("sendTo").value+" "+document.getElementById("amountTo").value+" USDC",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Yes',
                            showCancelButton: true,
                            cancelButtonText: "No"                            
                            }).then((result) => {
                                if (result.isConfirmed) {          
                                    document.getElementById("buttonSend").disabled = true;
                                    $.post("block",{
                                        sendtoemail:"",                        
                                        tipo: "SEND",
                                        comopago: "TRANSFER",
                                        origen: "CRYPTOSIGNAL",
                                        destino: document.getElementById("sendTo").value,
                                        correo: document.getElementById("sendTo").value,
                                        cajero: document.getElementById("correo").value,
                                        monto: document.getElementById("amountTo").value,                        
                                        recibe: document.getElementById("amountTo").value,
                                        comision: document.getElementById("amountTo").value,
                                        moneda: "USDC"
                                    },function(data){
                                        datos = JSON.parse(data);
                                        Swal.fire({
                                            title: 'Send',
                                            text: datos.mensaje,
                                            icon: datos.icon,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            }).then((result) => {
                                                if (result.isConfirmed) {          
                                                    window.location.href="miwallet";
                                                }    
                                            });
                                    });                                
                                }    
                            }); 
                    }else{
                        Swal.fire({
                                        title: 'Send',
                                        text: "Send cannot be processed or data is missing.",
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                        });
                    }                    
                }
                else{
                    Swal.fire({
                                title: 'Send To',
                                text: "Insufficient USDC balance",
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                                });
                }
            }
            else{
                Swal.fire({
                                title: 'Send To',
                                text: "Send must be at least 1 USDC",
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                                });
            }
        }
    
        function inicio(){
            leerDatos();         
            recuperarRetiros();
            recuperarDepositos();
            recuperarHistorial();
            recuperarCajeros();
            recuperarSend();
            //myVar = setInterval(refrescar, 2000);
        }
        
        

