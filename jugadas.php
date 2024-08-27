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
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
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
       <link rel="stylesheet" type="text/css" href="css/newStyles.css">
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    

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

                if(capital *1 > 0 ){
                    let resultados = calcularInteresMensual(capital, interes, numMes);
                    $("#calculos").html(`Interes Mensuales: ${Math.round(resultados['interesMensual'] * 100) / 100}<br>
                    Cuota Mensual de: ${Math.round(resultados['cuotaMensual'] * 100) / 100}`);
                }
                else{
                    document.getElementById("monto").focus();                    
                }
            }

            function crear(){
                let orderFavorito = 0;
                let orderAdelantado = 0;
                let devuelveCapital = 0;

                if(document.getElementById('favorito').checked === true){
                    orderFavorito = 1;
                }                
                
                if(document.getElementById('adelantado').checked){
                    orderAdelantado = 1;
                }

                if(document.getElementById('devuelve_capital').checked){
                    devuelveCapital = 1;
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
                    poradelantado: orderAdelantado,
                    devuelveCapital: devuelveCapital,
                    imagen: document.getElementById("imagen").value,
                    foreground: document.getElementById("foreground").value
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('modalOverlay').style.display = "none";
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
                        document.getElementById('modalOverlay2').style.display = "none";
                        leerVista();
                    });
            }
            
            function leerVista(){
                $.get("block?readJuegos=", function(data){
                $("#tabla-cuerpo").html(data);
                new DataTable('#example');
                });
            }

            function inicio(){
                leerVista();
            }

            function showDialog(){
                document.getElementById('modalOverlay').style.display = "flex";
            }

            function analisis(id){    
                document.getElementById('idAnalisis').value = id;
                $.get("block?datosJuego=&idjuego="+id, function(data){
                    var datos= JSON.parse(data);                    
                    $("#nameAnalisis").html(datos.juego);
                    $("#analisisDescripcion").html(datos.descripcion);
                    $("#summerNoteAnalisis").html(datos.analisis);
                });
                document.getElementById('modalOverlay2').style.display = "flex";
            }

            function pagaIntereses(){                
                if(document.getElementById('paga_intereses').checked){
                    $("#zona_intereses").css("display","block");
                }
                else{
                    document.getElementById('porciento').value=0;
                    $("#zona_intereses").css("display","none");                    
                }                
            }

            function ifAdelantado(){
                if(document.getElementById('adelantado').checked){
                    document.getElementById('devuelve_capital').checked = true;
                }
                else{
                    document.getElementById('devuelve_capital').checked = false;
                }
            }

        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "jugadas"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->             

        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem; overflow-x: hidden; padding:5rem; min-height: calc(100vh - 24rem);'>
        <input type="hidden" value="<?php if(isset($_SESSION['user'])) echo readClienteId($_SESSION['user'])['CORREO']; ?>" id="correo">
        <input type="hidden"  id="idAnalisis">
        <div class="button-menu" id="menu">
            <button class='add-button' type="button" onclick="showDialog()">Agregar +</button>
        </div>


        <div id="modalOverlay" class="modal-overlay">
            <div class="modal">
                <span id="closeModalBtn" class="close-btn">X</span>
                <h2>Agregar Tarjeta</h2>
                    <div>
                        <h3>Titulo:</h3> 
                        <input type="text" id="nombre">
                    </div>
                                           
                    <div >
                        <h3>Tipo: </h3>
                        <div style='display: flex;gap: 1rem;justify-content: center;'>
                            <div style='display: flex;align-items: flex-start;gap: .2rem;'>
                            Normal: 
                                <input title="Solo Insertar la Tarjeta" type="radio" id="ninguno" name="selectx">
                            </div>
                            <div style='display: flex;align-items: flex-start;gap: .2rem;'>
                                Favorito: 
                                <input title="Poner la tarjeta como Favorita" type="radio" value="1" id="favorito" name="selectx"><br>                
                            </div>
                        </div>
                    </div>
                                       
                    <div >
                        <h3>Periodo:</h3> 

                        <select id="tipoJuego" >
                            <option value="MENSUAL">selecciona Duracion..</option>
                            <option value="MENSUAL">Mensual</option>
                            <option value="TRIMESTRAL">Trimestral</option>
                            <option value="SEMESTRAL">Semestral</option>
                            <option value="ANUAL">ANUAL</option>
                        </select>
                    </div>
                    
                    <div >
                        <h3>Color de Fondo:</h3> 
                        <select id="imagen" >
                            <option value="azul.png">background..</option>
                            <option value="amarillo.png">Dorado</option>
                            <option value="azul.png">Azul</option>
                            <option value="azul_oscuro.png">Azul Oscuro</option>
                            <option value="verde.png">Verde</option>                    
                            <option value="naranja.png">Naranja</option>                    
                            <option value="rojo.png">Rojo</option>
                            <option value="plateado.png">Plata</option>
                        </select>
                    </div>
                    
                    <div >
                        <h3>Color de Letra:</h3> 
                        <select id="foreground" >
                            <option value="white">foreground..</option>
                            <option value="yellow">Amarillo</option>
                            <option value="blue">Azul</option>
                            <option value="red">Rojo</option>
                            <option value="white">Blanco</option>
                            <option value="black">Negro</option>
                            <option value="green">Verde</option>
                        </select>   
                    </div>
    
                    <div >
                        <h3>Costo:</h3> 
                        <input required type="number" id="monto" value="0" style="color:black;" step="1"><span style='color:green;'>Usdc</span>
                    </div>

                    <div >
                            <h3>Paga Intereses: </h3>
                        <div style='display: flex;align-items: flex-start;justify-content: center;'>   
                            Si:   <input title="Paga Intereses.." type="checkbox" value="1" id="paga_intereses" onchange="pagaIntereses()">              
                        </div>

                        <div id="zona_intereses" style="display:none;">
                            <div style='display: flex;align-items: flex-start;'>   
                                Paga intereses Por Adelantado: <input title="se paga por Adelantado" type="checkbox" value="1" id="adelantado" onchange="ifAdelantado()"><br>
                            </div>
                            <div style='display: flex;align-items: flex-start;'>   
                                Devuelve Capital: <input title="Devuelve el capital.." type="checkbox" value="1" id="devuelve_capital" >  <br>                    
                            </div>
                        <div >
                            <h3>Interes Anual:</h3> 
                            <input required type="number" id="porciento" onchange="calcular()" onkeyup="calcular()" value="0" style="color:black;"  step="1"> % <br>                        </div>
                            <div id="calculos" style="color:black; background:white;"></div>
                        </div>
                    </div> 

                    <div >
                        <h3>Descripcion:</h3> 
                        <textarea  id="summernote"></textarea>
                    </div>

                    <div >
                        <h3>Cantidad de Tarjetas a la Venta:</h3> 
                        <input type="number" id="min" value="10">
                    </div>

                    <div >
                        <h3>Estrellas:</h3> 
                        <input type="number" id="rate" min="0" max="5" value="0">
                    </div>

                    <div style='display: flex;align-self: end;align-items: center;justify-content: center;'>
                        <button style='margin-bottom:2rem;' class='add-button' type="button" id="btncrear" onclick="crear()">Agregar</button>
                    </div>
            </div>
        </div>

        <div id="modalOverlay2" class="modal-overlay">
            <div class="modal">
                <span id="closeModalBtn2" class="close-btn">X</span>
                <h2>Analisis Tecnico</h2>
                <div id="nameAnalisis"></div>
                <div id="analisisDescripcion"></div>
                    <textarea   id="summerNoteAnalisis"></textarea>
                <button class='add-button' style="float:right;" type="button" id="btncrear" onclick="setAnalis()">Enviar Analisis</button>
            </div>
        </div>

        <div class="vista" id="vista"></div>
        <table id='example' class='ui celled table' style='width:100%; '> 
                        <thead>
                            <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Descripcion</th>
                            <th>Tipo</th>
                            <th>Usdc</th>
                            <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-cuerpo">
                        </tbody>
                    </table>        
        </div>
      <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     


    <script src='https://code.jquery.com/jquery-3.7.1.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.js'></script> 
    <script src='https://cdn.datatables.net/2.1.4/js/dataTables.semanticui.js'></script> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js'></script> 

<script>
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalOverlay2 = document.getElementById('modalOverlay2');
        const closeModalBtn2 = document.getElementById('closeModalBtn2');        

        // Función para cerrar el modal
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera de él
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }
        });

        // Función para cerrar el modal2
        closeModalBtn2.addEventListener('click', () => {
            modalOverlay2.style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera de él
        modalOverlay2.addEventListener('click', (e) => {
            if (e.target === modalOverlay2) {
                modalOverlay2.style.display = 'none';
            }
        });        

    </script>
        <script>
       /* $(document).ready(function() {
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

        });*/
    </script>   

    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>