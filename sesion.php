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
        <link rel="shortcut icon" href="favicon.png">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

        <style>
            .conten{
                text-align:center;
                display: flex;
                justify-content: center;
            }   

            form{
                font-weight:bold;
                top: 15%;
                width: 350px;
                height: 350px;
                border: 1px solid black;
                border-radius: 13px;
                text-align: center;
                padding: 13px;
                /*background: #D4DEE2;*/
                background-image: url('balon2.png');
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
                        password: document.getElementById('password').value
                    },function(data){
                        var datos= JSON.parse(data);
                        if(datos.result == "true"){
                            if(datos.bloqueado == 0){
                                if(datos.correo == document.getElementById('correo').value && datos.password == document.getElementById('password').value){
                                    document.getElementById("btn_registro").disabled = true;
                                    $.post("block.php",
                                    {
                                        initSesion: "",
                                        correo: document.getElementById('correo').value
                                    },function(data){
                                        window.location.href="index";
                                    });
                                }
                                else{
                                    alert("Usuario o Password Incorrectos...!");
                                }
                            }
                            else{
                                alert("Usuario Bloqueado...!");
                            }
                        }
                        else{
                            document.getElementById("btn_registro").disabled = true;
                            $.post("block.php",{
                                regUsuario: "",
                                correo: document.getElementById('correo').value,
                                password: document.getElementById('password').value,
                                referente: document.getElementById('referente').value
                            },function(data){
                                window.location.href="index";
                            });
                        }
                    });
                    }
                    else{
                        alert("El Password debe contener al menos 8 caracteres");
                    }
                }
                else{
                    alert("No es un correo Valido...");
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
                <div style="width:85px;display:inline-block;">Correo:</div><input id="correo" required type="email" ><br>
                <div style="width:85px;display:inline-block;">Password:</div><input id="password" required type="password" ><br>
                <p class="condiciones" id="terminos" ><u>Terminos y Condiciones</u><br>
                    Al hacer Click Usted esta Aceptando estos Terminos y Condiciones, Nuestra Pagina
                    No se hace responsable por perdidas en las apuestas, usted debe proporcionar 
                    al Jugar la Nota ID o tixd de la Transferencia en USDT al Operador para ser verificada,
                    ya que no nos hacemos responsable por extravios de Dinero, usted certifica que es Mayor de 
                    Edad y Unico Responsable. Los pagos a ganadores se realizan en un plazo de 24 a 48 Horas.
                </p>
                <button type="button" onclick="registro()" id="btn_registro">Jugar / Registrarse</button> 
                <div style="margin-top:8px;"><a style="font-size:10px; cursor:pointer;" onclick="recuperar()">Olvide Mi Contraseña</a></div>
            </form>
        </div>
    </body>
</html>