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
                margin:0;
            }            

            .content{
                text-align: center;
                display: flex;
            }
            
            .outer-input-container{
                display: flex;
                flex-direction: column;
            align-items: center;
            }



            form {
                color: white;
                font-weight: bold;
                width: 60%;
                text-align: center;
                background: #181a20;
                background-repeat: no-repeat;
                background-size: cover;
                border: 1px solid #67676778;
                border-left: 2rem solid gainsboro;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
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
                text-align: center;
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



            .blue-div {
                width: 40%; /* Cambia de 40% a 100% */
                background: linear-gradient(45deg, #8996d3, transparent);
                min-height: 50vh; /* Cambia height a min-height */
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 1rem;
            }

            .termsR{
                display:none;
            }

            .go-back{
                font-weight: bold;float: right;cursor: pointer;position: absolute;top: 10%;right: 10%;font-size: 1rem;font-family: sans-serif;
            }

            .go-back:hover{
                color: #4a6ee9;
            }



/* Media query para pantallas pequeñas */
@media (max-width: 768px) {
    .blue-div {
        width: 100%;
        min-height: 30vh;
        display:none;
    }

    .content {
        display: flex;
        flex-direction: column-reverse
    }

    form {
        max-width: 100%;
        width: 100% !important;
        padding: 20px;
        border-left: 1rem solid gainsboro;
        border:none;

    }

    .input-container {
        padding: 0 20px;
    }

    .terms {
        font-size: 0.8rem; 
        top: 1rem;
        z-index: 1; /* Aseguramos que también funcione en pantallas pequeñas */
    }
    
    .termsR {
        display:block;
        }
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
                            title: 'Sign Up',
                            text: "We will proceed with the registration on Crytosignal. Remember, it must be a valid Binance user email. Do you accept our terms and conditions? Do you wish to join?",
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Yes',
                            confirmButtonColor: '#3085d6',
                            showCancelButton: true,
                            cancelButtonText: "Cancel"
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
                            title: 'Try Again',
                            text: `The Email: ${datos.correo} already has an account. Either that or the capcha is not valid. So Try Again`,
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
        </script> 
    </head>
    <body>
        <div class="content">
            <div class='blue-div'>
                <div style="
                display: flex;
                flex-direction: column;
                align-items: center;
                font-family: 'futurist';
                color: #263653;
                font-size: .6rem;">
                    <h1 style='margin:0;'>Sign Up to Join the Signal</h1>
                    <h2 style='margin:0;'>Get long-term safe profits</h2>
                    <img src="Assets/sign-image.svg" alt="" style='width: 100%;margin-top: 3rem;'>
                </div>
            <div class="terms" id="terms" style='align-self: flex-start;max-width: 90%;margin: 0 auto;'><u>Terms and Conditions for Registration</u><br>
                        <p>By clicking "Join", you agree to these Terms and Conditions. Our website is not responsible for the handling of the information provided. You must register with a valid Binance email. Your Binance email will be your identification. The website operator is not responsible for any loss of funds. For deposits and withdrawals, <u>Binance Pay</u> is used. You certify that you are of legal age and solely responsible for the lawful and unencumbered funds provided here. Deposits and withdrawals are processed within 24 to 48 hours.</p>
                </div>
        </div>

            <form>
                <?php 
			        if(isset($_GET['code'])){
				        echo "<input type='hidden' name='referente' id='referente' value='".$_GET['code']."'>";
			        }else{
                        echo "<input type='hidden' name='referente' id='referente' value='NULO'>";
                    }
		        ?>               
                <a title="Cerrar" class='go-back' onclick="window.location.href='index'">⇦ Go Back </a>
                
                <section>
                <div style='display: flex;flex-direction: column;align-items: center;'>
                <img style='width:3.5rem;' src='Assets/logotype.png'>
                <h2>Sign Up</h2>
                <br>
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
                <button type="button" onclick="registro()" id="btn_registro">Sign Up!</button> 
                <div class="termsR" id="termsR"><u>Terms and Conditions for Registration</u><br>
                        <p style='text-align: justify;'>By clicking "Join", you agree to these Terms and Conditions. Our website is not responsible for the handling of the information provided. You must register with a valid Binance email. Your Binance email will be your identification. The website operator is not responsible for any loss of funds. For deposits and withdrawals, <u>Binance Pay</u> is used. You certify that you are of legal age and solely responsible for the lawful and unencumbered funds provided here. Deposits and withdrawals are processed within 24 to 48 hours.</p>
                </div>
                </div>
                </section>
            </form>
        </div>

    </body>
</html>