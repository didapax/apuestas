<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />        

        <style>
            .conten{
                text-align:center;
                display: flex;
                justify-content: center;
            }   

            form{
                color:white;
                font-weight:bold;
                top: 15%;
                width: 350px;
                height: 430px;
                border: 1px solid black;
                border-radius: 13px;
                text-align: center;
                padding: 13px;
                /*background: #D4DEE2;*/
                background-image: url('Assets/balon2.png');
                background-repeat: no-repeat;
                background-size: cover; 
                position: absolute;
                box-shadow: 4px 3px 8px 1px #969696;                
            }

            input[type="email"]{
                padding: 8px;
                font-size: 13px;
                width: 60%;
            }

            input[type="password"]{
                margin-top: 5px;
                padding: 8px;
                font-size: 13px;
                width: 60%;
            }

            button{
                padding: 8px;
                border: 0;
                border-radius: 3px;
            }

            button:hover{
                font-weight: bold;
                cursor: pointer;
            }

            .condiciones{
                font-size: 11px;
            }
            body{
                background:black;
            }
        </style>        
        <script>            
            function registro(){
                if(document.getElementById('correo').value.includes("@")){
                    if(document.getElementById('password').value.length > 7){                        
                        $.post("block.php",{
                        getUsuario: "",
                        correo: document.getElementById('correo').value,
                        password: document.getElementById('password').value,
                        grecaptcharesponse: document.getElementById('g-recaptcha-response').value
                    },function(data){
                        console.log("session data: ", data);
                        var datos= JSON.parse(data);
                        if(datos.result == true && datos.capcha.success){
                            if(datos.verificado == '0'){
                                Swal.fire({
                                title: 'Falta Verificacion',
                                text: "Correo no Verificado revisa tu bandeja de entrada...! o deseas reenviar el codigo de verificacion a tu correo..?",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Si Verificar',
                                confirmButtonColor: '#3085d6',
                                showCancelButton: true,
                                cancelButtonText: "No ya lo Tengo"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.post("block.php",{
                                        sendmail: "",
                                        correo: document.getElementById('correo').value
                                    },function(data){ });                                 
                                    }else{
                                        window.location.href="sesion";
                                    }
                                });
                            }
                            else{
                                if(datos.paso){
                                    document.getElementById("btn_registro").disabled = true;
                                    window.location.href="index";
                                }
                                else{
                                    Swal.fire({
                                    title: 'Iniciar Sesion',
                                    text: "Usuario o Password Incorrectos...! Intente de Nuevo",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href="sesion";
                                        }
                                    });

                                }
                            }
                        }
                        else if (datos.result == false && datos.capcha.success){
                            document.getElementById("btn_registro").disabled = true;
                            Swal.fire({
                            title: 'Registrarse',
                            text: "Email No Registrado.! Recuerda debe ser Un Email de Usuario en Binance Valido... estas seguro Deseas Unirte? ",
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Si Unirme',
                            confirmButtonColor: '#3085d6',
                            showCancelButton: true,
                            cancelButtonText: "Cancelar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.post("block.php",{
                                    regUsuario: "",
                                    correo: document.getElementById('correo').value,
                                    password: document.getElementById('password').value,
                                    referente: document.getElementById('referente').value
                                },function(data){
                                    var datos= JSON.parse(data);
                                    window.location.href="graciasRegistro?correo="+datos.correo+"&vkey="+datos.vkey;
                                    });                                    
                                }else{
                                    window.location.href="sesion";
                                }
                            });                        
                        }
                        else{
                            Swal.fire({
                            title: 'Capcha no Valida',
                            text: "Vuelva a intentar resolver la Capcha",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href="sesion";
                                }
                            });
                        }
                    });
                    }
                    else{
                        Swal.fire({
                        title: 'Error',
                        text: "El Pasword debe contener al menos 8 caracteres",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
                    }
                }
                else{
                    Swal.fire({
                        title: 'Error',
                        text: "Coloque un correo Valido",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
                }
            }

            function recuperar(){
                if(document.getElementById('correo').value.includes("@")){
                    $.post("recuperar",
                    {
                        recuperar: "",
                        correo: document.getElementById('correo').value
                    },
                    function(data){
                        alert("Revisa tu Correo y Ejecuta el Link que se te envio, Cambia tu clave Nuevamente..!");
                    });            
                }else alert("Coloca tu Correo de Usuario a Recuperar...");
	        }
        </script>
    </head>
    <body>
        <div class="conten">
            <h2>Fortuna Royal</h2>
        </div>
        <div class="conten">
            <form>
                <?php 
			        if(isset($_GET['code'])){
				        echo "<input type='hidden' name='referente' id='referente' value='".$_GET['code']."'>";
			        }else{
                        echo "<input type='hidden' name='referente' id='referente' value='NULO'>";
                    }
		        ?>               
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="window.location.href='index'">X</a>
                <h3>Cripto Signal Group</h>
                <br><br>
                <div style="width:85px;display:inline-block;">Correo:</div><input id="correo" required type="email" ><br>
                <div style="width:85px;display:inline-block;">Password:</div><input id="password" required type="password" >
                <br><br>
                <div name="g-recaptcha-response" id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Ld1nA0aAAAAAA7F7eJOY7CMwg7aaQAfg3WZy6P0"></div>
                <p class="condiciones" id="terminos" ><u>Terminos y Condiciones</u><br>
                    Al hacer Click Usted esta Aceptando estos Terminos y Condiciones, Nuestra Pagina
                    No se hace responsable por el manejo de la Informacion suministrada, usted debe  
                    Registrarse con un correo Valido para BINANCE, su correo de Binance sera su Identificacion   
                    el Operador de la Pagina, no se hace responsable por extravios de Dinero, 
                    para depositos y retiros se utiliza <u>Binance Pay</u>
                    usted certifica que es Mayor de Edad y Unico Responsable del uso de la informacion aqui suministgrada. 
                    Los Depositos y Retiros se realizan en un plazo de 24 a 48 Horas.
                </p>
                <button type="button" onclick="registro()" id="btn_registro">Inicio / Unirse</button> 
                <div style="margin-top:8px;"><a style="font-size:12px; cursor:pointer; color:blue;" onclick="recuperar()">Olvide Mi Contraseña</a></div>
            </form>
        </div>
    </body>
</html>