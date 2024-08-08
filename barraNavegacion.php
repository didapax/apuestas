<?php 
 //hola
    ?>
<link rel="stylesheet" href="css/style.css">
<header > 

    <nav class="nav-media1200 main-nav-media1200" style='position:relative;z-index:5; background:white;height:6rem'>
        <div id="cabeza" class="cabeza">
            <marquee><?php verPromo(); ?></marquee>
            <div class="topnav" id="myTopnav">
            <?php             
            if(!isset($_SESSION['user'])){
                echo "<a style=\"color:yellow;\" href='sesion'>Iniciar Sesion / Unirse</a>";
            }else{
                $notificaciones = countNotif($_SESSION['user']);
                $style = "";
                if($notificaciones>0){
                  $style = "style='border-top: solid 1px red;'";
                }
                if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){                                   
                   
                    if($page=="home"){
                      echo "<a href='index' class='active'>Tienda</a>";
                    }else{
                      echo "<a href='index' >Tienda</a>";
                    }
                    if($page=="chat"){
                      echo "<a href='chat' class='active'>Soporte</a>";
                    }else{
                      echo "<a href='chat' >Soporte</a>";
                    }
                    if($page=="wallet"){
                      echo "<a href='miwallet' class='active'>Mi Wallet</a>";
                    }
                    else{
                      echo "<a href='miwallet'>Mi Wallet</a>";
                    }
                    if($page=="histcliente"){
                      echo "<a href='historialcliente' class='active'>Suscripciones</a>";
                    }
                    else{
                      echo "<a href='historialcliente'>Suscripciones</a>";
                    }                    
                    
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
                    echo "<a style='cursor:pointer;' href='miwallet' class='saldo' id='saldo'> Saldo ".price(readClienteId($_SESSION['user'])['SALDO'])." USDC</a>";
                    echo "<a class='perfil'>".readClienteId($_SESSION['user'])['CORREO']."</a>";
                    echo "<a href=\"javascript:void(0);\" class='icon' onclick=\" myFunctionMenu();\"><i class='fa fa-bars'></i></a></div>";
                }
                else if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
                  if($page=="home"){
                    echo "<a href='index' class='active'>Tienda</a>";
                  }else{
                    echo "<a href='index' >Tienda</a>";
                  }                  
                  if($page=="histadmin"){
                    echo "<a href='historialadmin' class='active'>Suscripciones</a>";
                  }
                  else{
                    echo "<a href='historialadmin'>Suscripciones</a>";
                  }
                  if($page=="chat"){
                    echo "<a href='trabajos' class='active'>Chat</a>";
                  }                  
                  if($page=="trabajos"){
                    echo "<a href='trabajos' class='active'>Depositos/Retiros</a>";
                  }
                  else{                  
                    echo "<a href='trabajos' $style>Depositos/Retiros</a>";
                  }
                  if($page=="jugadas"){
                    echo "<a href='jugadas' class='active'>Productos</a>";
                  }
                  else{                  
                    echo "<a href='jugadas'>Productos</a>";
                  }
                  if($page=="promo"){
                    echo "<a href='promo' class='active'>Promos</a>";
                  }
                  else{                        
                    echo "<a href='promo'>Promos</a>";
                  }
                  if($page=="criptos"){
                    echo "<a href='criptos' class='active'>Criptos</a>";
                  }
                  else{                        
                    echo "<a href='criptos'>Criptos</a>";
                  }                  
                  if($page=="perfiladmin"){
                    echo "<a href='perfiladmin' class='active'>Mi Perfil</a>";
                  }
                  else{                        
                    echo "<a href='perfiladmin'>Mi Perfil</a>";
                  }                  
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
                    echo "<a style='cursor:pointer;' href='miwallet' class='saldo' id='saldo'> Saldo ".price(readClienteId($_SESSION['user'])['SALDO'])." USDC</a>";
                    echo "<a class='perfil'><span style='color:white;'>Admin: </span>".readClienteId($_SESSION['user'])['CORREO']."</a>";
                    echo "<a href=\"javascript:void(0);\" class='icon' onclick=\" myFunctionMenu();\"><i class='fa fa-bars'></i></a></div>";
                }                    
            }            
            ?>            
        </div>

    </nav>    
</header>