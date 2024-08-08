<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>     
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />                 
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
         
         input[type="number"] { 
margin: 5px;
border-radius: 3px;
border: 0;
outline: 0;
padding: 2px;
width: 80px;
background: #CFCFD3;
text-align: right;
}

input[type="text"] {
margin: 5px;
border-radius: 3px;
border: 0;
outline: 0;
padding: 2px;
width: 80px;
text-transform: uppercase;
}

input[type="checkbox"] {
  margin: 5px;
  border-radius: 3px;
  border: 0;
  padding: 3px;
  text-transform: uppercase;
}

         .dialog_retiro{
            top: 150px;
            border: solid 1px black;
            box-shadow: 4px 3px 8px 1px #969696;
            background: #c1cae0;
            border-radius: 5px;
            z-index: 99;
        }   

        </style>        
        <script>

            function calcularInteresMensual(capital, tasaInteresAnual, meses) {
                // Convertir la tasa de interés anual a mensual
                let tasaInteresMensual = tasaInteresAnual / 12 / 100;

                let cuotaMensual, interesMensual;

                // Si la tasa de interés es cero, la cuota mensual es simplemente el capital dividido por el número de meses
                if (tasaInteresMensual === 0) {
                    cuotaMensual = capital / meses;
                    interesMensual = 0;
                } else {
                    // Calcular el interés mensual
                    interesMensual = capital * tasaInteresMensual;

                    // Calcular la cuota mensual
                    cuotaMensual = capital * tasaInteresMensual / (1 - Math.pow(1 + tasaInteresMensual, -meses));
                }

                return {
                    interesMensual: interesMensual,
                    cuotaMensual: cuotaMensual
                };
            }

            function calcular() {
                let capital = document.getElementById("monto").value;
                let interes = document.getElementById("porciento").value;
                let tipo = document.getElementById("tipoJuego").value;
                let numMes;

                switch (tipo) {
                    case 'MENSUAL':
                        numMes = 1;
                        break;
                    case 'TRIMESTRAL':
                        numMes = 3;
                        break;
                    case 'SEMESTRAL':
                        numMes = 6;
                        break;
                    case 'ANUAL':
                        numMes = 12;
                        break;
                    default:
                        numMes = 1;
                        break;
                }

                let resultados = calcularInteresMensual(capital, interes, numMes);

                $("#calculos").html(`Interes Mensuales: ${Math.round(resultados['interesMensual'] * 100) / 100}<br>
                Cuota Mensual de: ${Math.round(resultados['cuotaMensual'] * 100) / 100}`);
            }

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
                Swal.fire({
                                        title: 'Suscripciones',
                                        text: `Estas Seguro de Eliminar la Suscripcion del Sistema`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    borrar: id
                                                },function(data){
                                                    leerVista();
                                                });  
                                            }
                                        });  
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
        <dialog class="dialog_retiro" id="agregar" close>
            <form action="jugadas">
                <a title="Cerrar" style="font-weight:bold;float:right;cursor:pointer; color:yellow;" onclick="document.getElementById('agregar').close()">X</a><br>                
                Titulo: <input type="text" id="nombre"><br>
                Normal: <input title="Solo Insertar la Tarjeta" type="radio" id="ninguno" name="selectx">
                Favorito: <input title="Poner la tarjeta como Favorita" type="radio" value="1" id="favorito" name="selectx"><br>
                <input title="se paga por Adelantado" type="checkbox" value="1" id="adelantado" > Paga Por Adelantado: <br>
                Periodo:                
                <select id="tipoJuego" >
                    <option value="">selecciona Duracion..</option>
                    <option value="MENSUAL">Mensual</option>
                    <option value="TRIMESTRAL">Trimestral</option>
                    <option value="SEMESTRAL">Semestral</option>
                    <option value="ANUAL">ANUAL</option>
                </select>
                <br>                
                Costo de la Suscripción: <input required type="number" id="monto"  value="0" style="color:black;"  step="1"> Usdc<br>
                Interes Anual del: <input required type="number" id="porciento" onchange="calcular()" onkeyup="calcular()" value="0" style="color:black;"  step="1"> % <br>
                <div id="calculos" style="color:black; background:white;"></div>
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