<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');

    $correo="";

    if(isset($_SESSION['user'])){
        $correo = readClienteId($_SESSION['user'])['CORREO'];
    }
    else{
        header("Location: index.php");
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
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">

        <style>

            @font-face {
                font-family: futurist;
                src: url(./css/fonts/futurist.otf);
            }

            body{
                height: 100vh;
                background: linear-gradient(45deg, black, #101721d6);            
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
                border: 1px solid #00ffff40;
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
                background: linear-gradient(45deg, #609ed3, #1a9495);                
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
            
            .go-back{
                font-weight: bold;
                float: right;
                cursor: pointer;
                position: absolute;
                top: 2rem;
                right: 2rem;
                font-size: 1rem;
                font-family: sans-serif;
                border: 1px solid #50dfdf7a;
                padding: .5rem;
                color: #50dfdf7a;
            }

            .go-back:hover{
                color: #212631;
                background: #50dfdf7a;
                text-decoration:underline;
                transition: .2s ease;
            }



            
/* Media query para pantallas pequeñas */
@media (max-width: 768px) {
 
    body{
        margin:0;
        height: unset;
    }
    .content {
        display: flex;
        flex-direction: column-reverse
    }

    form {
    color: white;
    font-weight: bold;
    width: 100%;
    height: 100vh;
    border-radius: 13px;
    text-align: center;
    background: #181a20;
    background-repeat: no-repeat;
    background-size: cover;
    border: 1px solid #67676778;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin:0;
    padding:0;
    }

    .input-container {
        padding: 0 20px;
    }

    .terms {
        font-size: 0.8rem; 
        width: 90%;
        top: 1rem;
        z-index: 1; /* Aseguramos que también funcione en pantallas pequeñas */
    }
    
    .termsR {
        display:block;
        }

    .go-back{
        top: 1rem;
        right: 1rem;
     }

}


        </style>        
        <script>
            function enviarcode(){
                const mail = document.getElementById('correo').value;
                const code = document.getElementById('code').value;
                $.post("block",
                    {
                        recivecodemail: "",
                        email: mail,
                        code:code
                    },
                    function(data){
                        var datos= JSON.parse(data);

                        if(datos.good){
                            window.location.href="index";
                        }
                        else{
                            Swal.fire({
                            title: 'CryptoSinal',
                            text: "Wrong Code. Try Again",
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });                             
                        }
                    });
            }

            function getCodeClick(){
                const mail = document.getElementById('correo').value;
                const button = document.getElementById('buttonGetCode');
                let timeLeft = 55; // Tiempo en segundos

                button.disabled = true; // Deshabilitar el botón
                button.value = `Wait ${timeLeft} seconds`;

                // Iniciar el temporizador inmediatamente
                const timer = setInterval(() => {
                    timeLeft--;
                    button.value = `Wait ${timeLeft} seconds`;

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        button.disabled = false; // Habilitar el botón
                        button.value = 'Get Code';
                    }
                }, 1000); // Intervalo de 1 segundo

                $.post("servermail",
                    {
                        getcodemail: "",
                        email: mail
                    },
                    function(data){                        
                        Swal.fire({
                            title: 'CryptoSinal',
                            text: "Check your email and copy the code that was sent to you.",
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }); 
                    }
                );
            }

            function closesession() {                
                $.get("block?cerrarSesion=",function(data){
                    window.location.href="index";
                 });                
            }
        </script>
    </head>
    <body>
        <input type="hidden" id="correo" value="<?php echo $correo; ?>">
        <div class="content">
            <form>
                <?php 
			        if(isset($_GET['code'])){
				        echo "<input type='hidden' name='referente' id='referente' value='".$_GET['code']."'>";
			        }else{
                        echo "<input type='hidden' name='referente' id='referente' value='NULO'>";
                    }
		        ?>               
                <a title="Cerrar" class='go-back' onclick="closesession()">⇦ Go Back </a>
                <img style='width:3.5rem;' src='Assets/logotype.png'>
                <h2>CryptoSignal</h2>
                <br><br>

                <div id="getcode" style="display:inline-block;">
                    <input class='binance-input' style="background:white; color:black;" type="text" id="code" >
                    <input class='binance-button' type="button" id="buttonGetCode" value="Get Code" onclick="getCodeClick()">
                </div>
                <button type="button" onclick="enviarcode()" id="btn_envio">Send Code</button> 

                <div class="terms" id="terminos" ><u>Security Code</u><br>
                    <p>For your security, a code will be sent to your email. Please check your inbox for it and enter it. If you can't find it there, check your spam folder. Otherwise, request a new code. Please note that if the network is congested, it may take a while to arrive.</p>
                </div>
            </form>
        </div>

    </body>
</html>