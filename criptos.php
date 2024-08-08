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

button{
  margin: 5px;
padding: 5px;
width: 100px;
border: 0;
border-radius: 3px;
}

button:hover{
font-weight: bold;
cursor: pointer;
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
            let monedas = [];

            function recuperarMonedas() {
                fetch("block?listMonedas=")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la solicitud: " + response.status);
                        }
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(data => {
                        monedas = data;    
                        mostrarTablaMonedas();
                        console.log("Monedas:", data);
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                    });
                
                }

                function mostrarTablaMonedas() {
                    const tablaCuerpo = document.getElementById("tabla-cuerpo-monedas");
                    tablaCuerpo.innerHTML = "";

                    monedas.forEach((producto, index) => {
                        const fila = document.createElement("tr");
                        fila.innerHTML = `
                            <td>${producto.MONEDA}</td>
                            <td>${producto.ASSET}</td>
                            <td>${producto.PAR}</td>
                            <td><button type="button" onclick="borrar('${producto.MONEDA}')">Eliminar</button></td>
                        `;
                        tablaCuerpo.appendChild(fila);
                    });
                }

            function crear(){
                document.getElementById("btncrear").disabled = true;
                moneda = document.getElementById("moneda");
                asset = document.getElementById("asset");

                if (moneda.value.length > 0 && asset.value.length > 0) {
                $.post("block",{
                    addpar:"",
                    moneda: moneda.value.toUpperCase(),
                    asset: asset.value.toUpperCase()
                },function(data){
                    leerVista();
                    document.getElementById("btncrear").disabled = false;
                    document.getElementById('agregar').close();
                });
                }
                else{
                    Swal.fire({
                                            title: 'Criptomonedas',
                                            text: "Dede colocar una Moneda Par valida",
                                            icon: 'warning',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                            });  
                }
            }

            function borrar(codigo){
                Swal.fire({
                                        title: 'Criptomonedas',
                                        text: `Estas Seguro de Eliminar la Criptomoneda ${codigo}, se borrarn los registros de precios y calculostambien..?`,
                                        icon: 'warning',
                                        confirmButtonColor: '#EC7063',
                                        confirmButtonText: 'Si Eliminar',
                                        showCancelButton: true,
                                        cancelButtonText: "No Todavia No"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.post("block",{
                                                    deletepar: codigo
                                                },function(data){
                                                    leerVista();
                                                });  
                                            }
                                        });  
            }      

            function leerVista(){
                recuperarMonedas();         
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
    <?php $page = "criptos"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;">
        <div class="menu" id="menu">
            <button type="button" onclick="showDialog()">Incluir Cripto</button>
        </div>
        <dialog class="dialog_retiro" id="agregar" close>
            <form action="cripto">
                <a title="Cerrar" style="color:black;font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>
                Moneda Par <br><input style="width:300px;" title="Par Existente en Binance: BTCUSDT, HNTBUSD" type="text" maxlength="10" id="moneda" value=""><br>
                Asset <br><input style="width:120px;" title="Abreviacion de la Moneda: HNT, BNB, BTC" type="text" maxlength="10" id="asset" value=""><br>
                <button class='appbtn' style="float:right;" type="button" id="btncrear" onclick="crear()">Agregar</button>
            </form>
        </dialog>        
        <div class="vista" id="vista">
        <table style='width: 100%;'> 
                                    <thead>
                                        <tr>
                                            <th>Moneda</th>
                                            <th>Asset</th>
                                            <th>Par</th>
                                            <th>Opciones</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-cuerpo-monedas">
                                    </tbody>
                                </table>
        </div>
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