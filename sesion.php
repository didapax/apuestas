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
                height: 100vh;
                background: linear-gradient(45deg, black, #3575d691);
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
                                title: 'Verification pending:',
                                text: "Your email address is not verified yet. Please check your inbox for the verification code or request a new one to be sent.",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, verify',
                                confirmButtonColor: '#3085d6',
                                showCancelButton: true,
                                cancelButtonText: "No, I already have it"
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
                                    title: 'Log In',
                                    text: "Either the username or the password don't match. Please try again",
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
                            title: 'Sign in',
                            text: `Email ${datos.correo} is not signed.! Would you like to join the signal!?`,
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
                        text: "Password must have at least 8 characters",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        });
                    }
                }
                else{
                    Swal.fire({
                        title: 'Error',
                        text: "Choose a valid Email",
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
                        title: 'Recover or change',
                        text: "Check your email and follow the link that was sent to you. Change your password again.",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        }); 
                    });         
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: "Enter a valid email address to recover or change your password.",
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

                <div class="terms" id="terminos" ><u>Terms of use</u><br>
                <p>By clicking "Start", you are accepting these Terms and Conditions, <b>Investors' Rights:</b>
Investors in Cryptosignal have their holdings represented by a unique card, which indicates the amount to be earned for their participation. This card is a direct reflection of their investment and the associated benefits.
<b>Exclusive Ownership:</b> Investors are the sole and exclusive owners of the card in which they participate. This card represents their participation in the fund and the rights to the benefits generated by such participation.
<b>Non-Transferability:</b> Cards are non-transferable and cannot be sold or resold to other users. This ensures that ownership and benefits of the investment remain with the original investor, maintaining the integrity and security of the fund.</p>
                </div>
            </form>
            <div class='forgot-password-container'> <a onclick="recuperar()">Forgot my password?</a> <a style="margin-left:34px;" onclick="unirse()">Sign In</a></div>
        </div>

    </body>
</html>