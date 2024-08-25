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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
       <!-- include summernote css/js -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>           
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.4/css/dataTables.semanticui.css">    
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
    </head>
    <header>
        <style>      

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
                    mensaje:document.getElementById("summernote").value,
                    promoDifu: difusion,
                    promoFlotante: flotante
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('modalOverlay').style.display = "none";
                });
            }

            function borrar(codigo){
                Swal.fire({
                                        title: 'Promocion',
                                        text: `Estas Seguro de Eliminar la Promocion del Sistema`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "Cancelar"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    borrarPromo: codigo
                                                },function(data){
                                                    leerVista();
                                                });  
                                            }
                                        });  
            }      

            function leerVista(){
                
                $.get("block?readPromos=", function(data){
                $("#tabla-cuerpo").html(data);
                new DataTable('#example');
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
                        Swal.fire({
                                    title: 'Difucion',
                                    text: "Los Correos con la promocion han sido Enviados..",
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Continuar'
                                    }); 
                    });                               
            }              

            function inicio(){                
                leerVista();
            }

            function showDialog(){
                document.getElementById('modalOverlay').style.display = "flex";
            }            
        </script>
    </header> 
    <body onload="inicio()">
    <?php $page = "promo"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <div id="cuerpo" class="cuerpo" style='margin-top: 8rem; padding:5rem; min-height: calc(100vh - 24rem);'>
        <div class="menu" id="menu">
            <button class='add-button' type="button" onclick="showDialog()">Crear Promocion +</button>
            <button style="margin-left:21px;" id="btn_difundir" type="button" onclick="difundir()">Difundir Promocion</button>
            <button style="margin-left:21px; background:#E9B2B2; display:none;" id="btn_reset" type="button" onclick="reset()">Reset Promocion</button>
        </div>
        <div id="modalOverlay" class="modal-overlay">
            <div class="modal">
                <span id="closeModalBtn" class="close-btn">X</span>
                <h2>Agregar una Promocion</h2>
                Titulo: <input type="text" id="nombre"><br>
                Detalle:<br>
                <textarea id="summernote"></textarea>
                <label for="difuFlotante">Flotante </label><input type="radio" id="difuFlotante" name="idpromo">
                <label for="difu"> Difusion </label><input type="radio" id="difu" name="idpromo"><br>
                <button style='margin-bottom:2rem;' class='add-button'  style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </div>
        </div>
        <div class="vista" id="vista"></div>
                    <table id='example' class='ui celled table' style='width:100%; '> 
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Mensaje</th>
                                <th>Tipo</th>
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
    </script>          
        <script>
      /*  $(document).ready(function() {
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