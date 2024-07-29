<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
    </head>
    <header>
        <style>
         .textAreaContainer{
            background:white;
            color: black;
         }
         textarea{
            color:black;
         }
         input[type=text]{
            color:black;
         }
         input[type=number]{
            color:black;
         }       
         
         select{
            color:black;
         }
         button{
            color:black;
         }          
        </style>        
        <script>
            function crear(){
                document.getElementById("btncrear").disabled = true;
                let difusion = 0;
                let flotante = 0;

                if(document.getElementById('difu').checked === true){
                    difusion = 1;
                }
                if(document.getElementById('difuFlotante').checked === true){
                    flotante = 1;
                }                                                

                $.post("block",{
                    crearPromo: "",
                    nombre: document.getElementById("nombre").value,
                    mensaje:document.getElementById("mensaje").value,
                    promoDifu: difusion,
                    promoFlotante: flotante
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('agregar').close();
                });
            }

            function borrar(codigo){
                var r = confirm("Estas Seguro de Eliminar la Promocion.?");
                if (r == true) {
                    $.post("block",{
                        borrarPromo: codigo
                    },function(data){
                        leerVista();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }      

            function leerVista(){
                
                $.get("block?readPromos=", function(data){
                $("#vista").html(data);
                });

                $.get("block?estatuslista=", function(data){
                    var datos= JSON.parse(data);
                    if(datos.reset == true){
                        $("#btn_reset").css("display","inline-block");
                        $("#btn_difundir").css("display","none");
                    }else{
                        document.getElementById("btn_difundir").disabled = datos.status;
                    }
                    
                });                
            }

            function reset(){
                $.post("block",{
                    resetlista: ""
                    },function(data){
                        /*leerVista();*/
                        window.location.href="promo";
                    });                               
            }   
            
            function difundir(){
                $.post("block",{
                    sendlista: ""
                    },function(data){
                        leerVista();
                        alert("Correos Enviados");
                        /*window.location.href="promo";*/
                    });                               
            }              

            function inicio(){                
                leerVista();
            }

            function showDialog(){
                document.getElementById('agregar').show();
            }            
        </script>
    </header> 
    <body onload="inicio()">
    <?php $page = "promo"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
        <div class="menu" id="menu">
            <button type="button" onclick="showDialog()">Crear Promocion</button>
            <button style="margin-left:21px;" id="btn_difundir" type="button" onclick="difundir()">Difundir Promocion</button>
            <button style="margin-left:21px; background:#E9B2B2; display:none;" id="btn_reset" type="button" onclick="reset()">Reset Promocion</button>
        </div>
        <dialog class="dialog_agregar" id="agregar" close>
            <form action="promo">
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
                Titulo: <input type="text" id="nombre"><br>
                Detalle:<br> <textarea style="width:100%; height:100px;"id="mensaje"></textarea><br>
                <label for="difuFlotante">Flotante </label><input type="radio" id="difuFlotante" name="idpromo"><br>
                <label for="difu"> Difusion </label><input type="radio" id="difu" name="idpromo">&#128266;<br>
                <button class='appbtn' style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </form>
        </dialog>        
        <div class="vista" id="vista"></div>
        </div>
      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->      
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>