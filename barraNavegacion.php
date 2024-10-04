<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="css/navBar.css">

      <title>Responsive dropdown menu </title>
   </head>
   <body>
      <!--=============== HEADER ===============-->
      <header class="header">
         <nav class="navbar navbar-container">
            <div class="nav__data">
               <a href="index" class="nav__logo">
                  <img class='logo' src='./Assets/logotype.png'> CryptoSignal
               </a>
               
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line nav__burger"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
      

            <!--=============== NAV MENU ===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <?php 
                   if(!isset($_SESSION['secured'])){
                     echo "<li><a href='sesion' class='nav__link'>Iniciar Sesión</a></li>";
                 }else{
                     $notificaciones = countNotif($_SESSION['user']);
                     $style = "";
                     if($notificaciones>0){
                       $style = "style='border-top: solid 1px red;'";
                     }
                  }

                  if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 && isset($_SESSION['secured'])){                                   
                   
                     if($page=="home"){
                       echo "<li><a href='index' class='nav__link active'>Tienda</a></li>";
                     }else{
                        echo "<li><a href='index' class='nav__link'>Tienda</a></li>";
                     }
                     if($page=="chat"){
                       echo "<li><a href='chat' class='nav__link active' $style>Soporte</a></li>";
                     }else{
                        echo "<li><a href='chat' class='nav__link' $style>Soporte</a></li>";
                     }
                     if($page=="wallet"){
                       echo "<li><a href='miwallet' class='nav__link active'>Cartera</a></li>";
                     }
                     else{
                        echo "<li><a href='miwallet' class='nav__link'>Cartera</a></li>";
                     }
                     if($page=="histcliente"){
                       echo "<li><a href='historialcliente' class='nav__link active'>Suscripciones</a></li>";
                     }
                     else{
                        echo "<li><a href='historialcliente' class='nav__link'>Suscripciones</a></li>";
                     }                    
                     
                     echo "
                     <li class='dropdown__item'>
                        <div class='nav__link'>
                           ".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i>
                        </div>
                     
                        <ul class='dropdown__menu'>
                       
                           <li>
                              <a href='miwallet' class='dropdown__link'>
                                 <i class='ri-pie-chart-line'></i> Saldo: <p id='saldo' style='color:green;margin:0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p> USDC
                              </a>                          
                           </li>

                           <li>
                              <a href='block?cerrarSesion' class='dropdown__link'>
                                 <i class='ri-arrow-up-down-line'></i> Cerrar Sesion
                              </a>
                           </li>
                     </ul>
                  </li>                 
                     "; 
                 }
///////////////////////////////////FIN NAV MENU///////////////////////////////////////////////



/////////////////////////////////////INICIO MENU ADMINISTRADOR//////////////////////////////////////////////////////
                 else if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1 && isset($_SESSION['secured'])){
                  if($page=="home"){
                     echo "<li><a href='index' class='nav__link active'>Tienda</a></li>";
                  }else{
                     echo "<li><a href='index' class='nav__link'>Tienda</a></li>";
                  }                  
                  if($page=="histadmin"){
                    echo "<a href='historialadmin' class='nav__link active' >Suscripciones</a>";
                  }
                  else{
                    echo "<a href='historialadmin' class='nav__link'>Suscripciones</a>";
                  }
                  if($page=="chat"){
                    echo "<li><a href='trabajos' class='nav__link active'>Trabajos</a></li>";
                  }                  
                  if($page=="trabajos"){
                     echo "<li><a href='trabajos' class='nav__link active' $style>Trabajos</a></li>";
                  }
                  else{                  
                     echo "<li><a href='trabajos' class='nav__link' $style>Trabajos</a></li>";
                  }
                  if($page=="jugadas"){
                    echo "<a href='jugadas' class='nav__link active'>Productos</a>";
                  }
                  else{                  
                    echo "<a href='jugadas' class='nav__link'>Productos</a>";
                  }
                  if($page=="promo"){
                    echo "<a href='promo' class='nav__link active'>Promos</a>";
                  }
                  else{                        
                    echo "<a href='promo' class='nav__link'>Promos</a>";
                  }
                  if($page=="criptos"){
                    echo "<a href='criptos' class='nav__link active'>Criptos</a>";
                  }
                  else{                        
                    echo "<a href='criptos' class='nav__link'>Criptos</a>";
                  }                  
                  if($page=="perfiladmin"){
                    echo "
                     <li class='dropdown__item'>
                        <div class='nav__link'>
                           ".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i>
                        </div>
                     
                        <ul class='dropdown__menu'>
                       
                          <li>
                              <a  href='perfiladmin' class='dropdown__link'>
                                 <i class='ri-pie-chart-line'></i> Perfil
                              </a>                          
                           </li>

                           <li>
                              <a href='miwallet' class='dropdown__link'>
                                 <i class='ri-pie-chart-line'></i> Saldo: <p id='saldo' style='color:green;margin:0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p> USDC
                              </a>                          
                           </li>

                           <li>
                              <a href='block?cerrarSesion' class='dropdown__link'>
                                 <i class='ri-arrow-up-down-line'></i> Cerrar Sesion
                              </a>
                           </li>
                      
                     </ul>
                  </li>                 
                    ";
                  }
                  else{                        
                    echo "
                       <li class='dropdown__item'>
                        <div class='nav__link'>
                           ".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i>
                        </div>
                     
                        <ul class='dropdown__menu'>
                       
                          <li>
                              <a  href='perfiladmin' class='dropdown__link'>
                                 <i class='ri-pie-chart-line'></i> Perfil
                              </a>                          
                           </li>

                           <li>
                              <a href='miwallet' class='dropdown__link'>
                                 <i class='ri-pie-chart-line'></i> Saldo: <p id='saldo' style='color:green;margin:0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p> USDC
                              </a>                          
                           </li>

                           <li>
                              <a href='block?cerrarSesion' class='dropdown__link'>
                                 <i class='ri-arrow-up-down-line'></i> Cerrar Sesion
                              </a>
                           </li>
                      
                     </ul>
                  </li>                 
                    ";
                  }                  
                }                            
                  ?>

                  <!--=============== DROPDOWN 2 ===============-->
               </ul>
               </div>
            </div>
         </nav>
         <!--<marquee><?php verPromo(); ?></marquee>-->

      </header>

      <!--=============== MAIN JS ===============-->
      <script src="Javascript/navBar.js"></script>
   </body>
</html>