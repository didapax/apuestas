<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');

    $correo = "";
    if(isset($_GET['correo'])){
        $correo = $_GET['correo'];
    }

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
                        if (datos.result == false && datos.capcha.success){
                            document.getElementById("btn_registro").disabled = true;
                            Swal.fire({
                            title: 'Registrarse',
                            text: "Se Procedera al Registro en Crytosignal, Recuerda debe ser Un Email de Usuario en Binance Valido. Aceptas Nuestros Terminos y Condiciones,  Deseas Unirte.? ",
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
                                }
                                else{
                                    window.location.href="sesion";
                                }
                            });                        
                        }
                        else{
                            Swal.fire({
                            title: 'Vuelva a Intentar',
                            text: `El Correo ${datos.correo} ya esta Registrado o la Capcha no es valida. Vuelva a intentalo`,
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href="registro";
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
                <h2>Registro CryptoSignal</h2>
                <br><br>
                <div class='outer-input-container'> 
                    <div class='input-container'>Email:<input id="correo" required type="email" value="<?php echo $correo; ?>" ></div><br>
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
                <div name="g-recaptcha-response" id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Ld1nA0aAAAAAA7F7eJOY7CMwg7aaQAfg3WZy6P0" style='display: flex;align-items: center;justify-content: center;'></div>
                <button type="button" onclick="registro()" id="btn_registro">Unirse</button> 

                <div class="terms" id="terminos" ><u>Terminos y Condiciones para Registrarse</u><br>
                    <p>Al hacer Click en Unirse Usted esta Aceptando estos Terminos y Condiciones, Nuestra Pagina
                    No se hace responsable por el manejo de la Informacion suministrada, usted debe  
                    Registrarse con un correo Valido para BINANCE, su correo de Binance sera su Identificacion   
                    el Operador de la Pagina, no se hace responsable por extravios de Dinero, 
                    para depositos y retiros se utiliza <u>Binance Pay</u>
                    usted certifica que es Mayor de Edad y Unico Responsable de los Fondos Licitos y Libres aqui suministrados. 
                    Los Depositos y Retiros se realizan en un plazo de 24 a 48 Horas.</p>
                </div>
            </form>
        </div>

    </body>
</html>