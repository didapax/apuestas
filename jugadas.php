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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
       <!-- include summernote css/js -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>       
    </head>
    <header>
        <style>
         .textAreaContainer{
            background:white;
            color: black;
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
                let orderFavorito = 0;
                let orderAdelantado = 0;

                if(document.getElementById('favorito').checked === true){
                    orderFavorito = 1;
                }                
                
                if(document.getElementById('adelantado').checked){
                    orderAdelantado = 1;
                }

                document.getElementById("btncrear").disabled = true;
                $.post("block",{
                    crear: "",
                    cajero: document.getElementById("correo").value,
                    nombre: document.getElementById("nombre").value,
                    descripcion: document.getElementById("summernote").value,
                    min: document.getElementById("min").value,
                    rate: document.getElementById("rate").value,
                    favorito: orderFavorito,
                    tipo: document.getElementById("tipoJuego").value,
                    monto: document.getElementById("monto").value,
                    porciento: document.getElementById("porciento").value,
                    poradelantado: orderAdelantado
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('agregar').close();
                });
            }

            function borrar(id){
                var r = confirm("Estas Seguro de Eliminar el Juego.?");
                if (r == true) {
                    $.post("block",{
                        borrar: id
                    },function(data){
                        leerVista();
                        /*window.location.href="index";*/
                    });
                }
                else {
                   /*txt = "You pressed Cancel!";*/
                }
            }

            function cerrar(id){
                    $.post("block",{
                        cerrar: id
                    },function(data){
                        leerVista();
                    });
            }      
            
            function setAnalis(){
                $.post("block",{
                        setAnalis: document.getElementById('idAnalisis').value,
                        analisis: document.getElementById('summerNoteAnalisis').value
                    },function(data){
                        document.getElementById('analisis').close();
                        leerVista();
                    });
            }
            
            function leerVista(){
                $.get("block?readJuegos=", function(data){
                $("#vista").html(data);
                });
            }

            function inicio(){
                leerVista();
            }

            function showDialog(){
                document.getElementById('agregar').show();
            }    

            function analisis(id){    
                document.getElementById('idAnalisis').value = id;
                $.get("block?datosJuego=&idjuego="+id, function(data){
                    var datos= JSON.parse(data);                    
                    $("#nameAnalisis").html(datos.juego);
                    $("#analisisDescripcion").html(datos.descripcion);
                    $("#edit").html(datos.analisis);
                });
                document.getElementById('analisis').show();
            }

        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "jugadas"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->             

        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
        <input type="hidden" value="<?php if(isset($_SESSION['user'])) echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
        <input type="hidden"  id="idAnalisis">
        <div class="menu" id="menu">
            <button type="button" onclick="showDialog()">Agregar +</button>
        </div>
        <dialog class="dialog_agregar" id="agregar" close>
            <form action="jugadas">
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer; color:black;" onclick="document.getElementById('agregar').close()">X</a><br>                
                Titulo: <input type="text" id="nombre"><br>
                Detalles: <br>
                Normal: <input title="Solo Insertar la Tarjeta" type="radio" id="ninguno" name="selectx">
                Favorito: <input title="Poner la tarjeta como Favorita" type="radio" value="1" id="favorito" name="selectx">
                Paga Por Adelantado: <input title="se paga por Adelantado" type="checkbox" value="1" id="adelantado" ><br>
                Tipo: <select id="tipoJuego" >
                    <option value="">selecciona</option>
                    <option value="MENSUAL">Mensual</option>
                    <option value="TRIMESTRAL">Trimestral</option>
                    <option value="SEMESTRAL">Semestral</option>
                    <option value="ANUAL">ANUAL</option>
                </select>
                <br>                
                Costo de la Suscripción: <input required type="number" id="monto"  value="0" style="color:black;"  step="1"> Usdc<br>
                Interes Anual del: <input required type="number" id="porciento"  value="0" style="color:black;"  step="1"> % <br>
                <br>
                Descripcion: <br>
                <div class="textAreaContainer">                
                    <textarea row="10" id="summernote"> </textarea>
                </div>
                Limite de Usuarios: <input type="number" id="min" value="10"><br>
                Estrellas: <input type="number" id="rate" min="0" max="5" value="0"><br>
                <button class='appbtn' style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </form>
        </dialog>    
        
        
        <dialog style="color:black;" id="analisis" close>
            <form>
                <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;color:black;" onclick="document.getElementById('analisis').close()">X</a><br>
                Analisis Tecnico: <br>
                <div id="nameAnalisis"></div>
                <div id="analisisDescripcion"></div>
                <div class="textAreaContainer">                
                    <textarea row="10" id="summerNoteAnalisis"><p id="edit"></p></textarea>
                </div>
                <button class='appbtn' style="float:right;" type="button" id="btncrear" onclick="setAnalis()">Enviar Analisis</button>
            </form>
        </dialog> 

        <div class="vista" id="vista"></div>
        </div>
      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     

        <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Escribe aquí...',
                height: 150,
                toolbar: [
                    ['basic', ['fontname', 'fontsize']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height', 'codeview', 'undo', 'redo']]
                ]
            });

            $('#summerNoteAnalisis').summernote({
                placeholder: 'Escribe aquí...',
                height: 150,
                toolbar: [
                    ['basic', ['fontname', 'fontsize']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height', 'codeview', 'undo', 'redo']]
                ]
            });

        });
    </script>    
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>