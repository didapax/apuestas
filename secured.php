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
                            text: "Codigo Errado, Vuelva a Intentarlo",
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });                             
                        }
                    });
            }

            function getCodeClick(){
                const mail = document.getElementById('correo').value;
                $.post("servermail",
                    {
                        getcodemail: "",
                        email: mail
                    },
                    function(data){
                        Swal.fire({
                        title: 'CryptoSinal',
                        text: "Revisa tu Correo y Copia el Codigo que se te envio, Luego dale Enviar Codigo para acceder",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                        }); 
                    });
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
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="closesession()">X</a>
                <img style='width:3.5rem;' src='Assets/logotype.png'>
                <h2>CryptoSignal</h2>
                <br><br>

                <div id="getcode" style="display:inline-block;">
                    <input class='binance-input' style="background:white; color:black;" type="text" id="code" >
                    <input class='binance-button' type="button" id="buttonGetCode" value="Solicitar Codigo" onclick="getCodeClick()">
                </div>
                <button type="button" onclick="enviarcode()" id="btn_envio">Eviar Codigo</button> 

                <div class="terms" id="terminos" ><u>Codigo de Seguridad</u><br>
                    <p>Por su seguridad al solicitar un codigo se enviará  a tu correo, busquelo y ingreselo
                    sino lo consigue en la bandeja de entraja intente buscar en labandeja de no deseados, de lo contrario solicite uno nuevo,
                    tenga en cuenta que si la red esta congestionada puede tardar un poco.
                    .</p>
                </div>
            </form>
        </div>

    </body>
</html>