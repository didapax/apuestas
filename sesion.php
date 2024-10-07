<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />        

        <style>

            @font-face {
                font-family: futurist;
                src: url(./css/fonts/futurist.otf);
            }

            body{
                background: lightblue;
            }            

            .content{
                text-align: center;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }   

            form{
                color: white;
                font-weight: bold;
                width: 25rem;
                height: auto;
                border-radius: 13px;
                text-align: center;
                padding: 40px;
                background: #181a20;
                background-repeat: no-repeat;
                background-size: cover;
                border: 1px solid #67676778;
                margin-top: 5vh;
            }

            form h2{
               font-family: futurist;
               letter-spacing:1px; 
               margin-top:0.5rem;
            }

            .input-container{
                font-family: "Poppins", sans-serif;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.2rem;
                padding: 0 50px;
            }

            input[type="email"]{
                margin-top: 5px;
                padding: 8px;
                font-size: 14px;
                width: 270px;
                background: #212631;
                border: 1px solid #ffffff94;
                border-radius: 8px;
                padding: 14px;
                color: #ffffffe8;
                font-family: "Poppins", sans-serif;
                font-weight: 600;
            }

            input[type="password"]{
                margin-top: 5px;
                padding: 8px;
                font-size: 14px;
                width: 270px;
                background: #212631;
                border: 1px solid #ffffff94;
                border-radius: 8px;
                padding: 14px;
                color: #ffffffe8;
                font-family: "Poppins", sans-serif;
                font-weight: 600;
            }

            button{
                background: linear-gradient(45deg, #97dfef, #4a6ed9);
                border-radius: 7px;
                color: #fff;
                font-family: "Poppins", sans-serif;
                font-size: 16px;
                font-weight: 700;
                padding: 16px;
                width: 300px;
                border:none;
                margin-top:16px;
                margin-bottom:16px;

            }

            button:hover{
                font-weight: bold;
                cursor: pointer;
                transform: scale(1.1);
                transition: ease(0.5s);
            }

            .terms p{
                font-family: "Poppins", sans-serif;
                text-align: justify;
                font-weight: 200;
                font-size:10px;
                margin-top: 0px;
            }

            .terms u{
                text-align:center;
                font-weight: 200;
                font-size:10px;
                font-family: "Poppins", sans-serif;
            }

            .forgot-password-container{
                font-family: "Poppins", sans-serif;
                color: #4a6ed9;
                text-decoration:none;
                font-weight:600;
                cursor:pointer;
                padding:.5rem;
            }

            .forgot-password-container a:hover{
                color: #4a6ee9;
                text-decoration: underline;
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
                        if(datos.result == true ){
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
                                    window.location.href="secured";
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
                        else{
                            document.getElementById("btn_registro").disabled = true;
                            Swal.fire({
                            title: 'Registrarse',
                            text: `Email ${datos.correo} No Registrado.! Deseas Unirte a Cryptosignal?`,
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Si Unirme',
                            confirmButtonColor: '#3085d6',
                            showCancelButton: true,
                            cancelButtonText: "Cancelar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href="registro?correo="+datos.correo+"&vkey="+datos.vkey;
                                }else{
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
                        Swal.fire({
                        title: 'Recuperar o Cambiar',
                        text: "Revisa tu Correo y Ejecuta el Link que se te envio, Cambia tu clave Nuevamente..!",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        }); 
                    });         
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: "Coloque un correo Valido para Recuperar o cambiar tu Contraseña",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
                } 
	        }

            function unirse() {
                window.location.href="registro";
            }
        </script>
    </head>
    <body>

        <div class="content">
            <form>
                <?php 
			        if(isset($_GET['code'])){
				        echo "<input type='hidden' name='referente' id='referente' value='".$_GET['code']."'>";
			        }else{
                        echo "<input type='hidden' name='referente' id='referente' value='NULO'>";
                    }
		        ?>               
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="window.location.href='index'">X</a>
                <img style='width:3.5rem;' src='Assets/logotype.png'>
                <h2>CryptoSignal</h2>
                <br><br>
                <div class='outer-input-container'> 
                    <div class='input-container'>Email:<input id="correo" required type="email" ></div><br>
                    <div class='input-container'>Password:<input id="password" required type="password" ></div>
                </div>
                <br>
                <!-- Capcha del localhost
                <div name="g-recaptcha-response" id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Ld1nA0aAAAAAA7F7eJOY7CMwg7aaQAfg3WZy6P0" style='display: flex;align-items: center;justify-content: center;'></div>
                -->
                <!--
                capcha del server
                <div name="g-recaptcha-response" id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Lf1Ky8qAAAAAF7WqkzyLa6QnPQiuklj8tRr2og2" style='display: flex;align-items: center;justify-content: center;'></div>
                -->                  
                <div name="g-recaptcha-response" id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Ld1nA0aAAAAAA7F7eJOY7CMwg7aaQAfg3WZy6P0" style='display: none;align-items: center;justify-content: center;'></div>
                <button type="button" onclick="registro()" id="btn_registro"> Inicio </button>

                <div class="terms" id="terminos" ><u>Terminos y Condiciones</u><br>
                    <p>Al hacer Click en Inicio Usted esta Aceptando estos Terminos y Condiciones, <b>Derechos de los Inversores:</b>
Los inversores en Cryptosignal tienen sus participaciones expresadas en una tarjeta única, la cual indica el monto a ganar por su participación. Esta tarjeta es un reflejo directo de su inversión y los beneficios asociados.
<b>Propiedad Exclusiva:</b> Los inversores son poseedores única y exclusivamente de la tarjeta en la que participen. Esta tarjeta representa su participación en el fondo y los derechos a los beneficios generados por dicha participación.
<b>Intransferibilidad:</b> Las tarjetas son intransferibles y no se pueden vender o revender a otros usuarios. Esto asegura que la propiedad y los beneficios de la inversión permanezcan con el inversor original, manteniendo la integridad y la seguridad del fondo.</p>
                </div>
            </form>
            <div class='forgot-password-container'> <a onclick="recuperar()">Olvide Mi Contraseña</a> <a style="margin-left:34px;" onclick="unirse()">Unirse / Registrarse</a></div>
        </div>

    </body>
</html>