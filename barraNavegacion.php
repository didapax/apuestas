<?php
$page = "home";
$style = "";
?>

      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="css/navBar.css">


   <div class="header-content" style='display: flex;align-items: center;'>
                     <div style='display: flex;align-items: center;'>
                     <img src="Assets/logotype.png" alt="" style='width:4rem;'> 
                    <div class="logo" onclick="window.location.href='index'">
                       CryptoSignal
                    </div>
                    </div>
                    <div class="header-nav">
                        <nav>
                            <ul class="primary-nav">
                               <?php
                                    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 && isset($_SESSION['secured'])){
                                    
                                       if($page=="home"){
                                       echo "<li><a href='tienda'>Store</a></li>";
                                       }else{
                                          echo "<li><a href='tienda'>Store</a></li>";
                                       }
                                       if($page=="chat"){
                                       echo "<li><a href='chat'  $style>Support</a></li>";
                                       }else{
                                          echo "<li><a href='chat' $style>Support</a></li>";
                                       }
                                       if($page=="wallet"){
                                       echo "<li><a href='miwallet'>Wallet</a></li>";
                                       }
                                       else{
                                          echo "<li><a href='miwallet'>Wallet</a></li>";
                                       }
                                       if($page=="histcliente"){
                                       echo "<li><a href='historialcliente'>Subscriptions</a></li>";
                                       }
                                       else{
                                          echo "<li><a href='historialcliente' >Subscriptions</a></li>";
                                       }        
                                    }

                                    else if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1 && isset($_SESSION['secured'])){
                                       if($page=="home"){
                                          echo "<li><a href='tienda' >Store</a></li>";
                                       }else{
                                          echo "<li><a href='tienda' >Store</a></li>";
                                       }                  
                                       if($page=="histadmin"){
                                         echo "<li><a href='historialadmin' >Subscriptions</a></li>";
                                       }
                                       else{
                                         echo "<li><a href='historialadmin'>Subscriptions</a></li>";
                                       }
                                       if($page=="chat"){
                                         echo "<li><a href='trabajos' >Tasks</a></li>";
                                       }                  
                                       if($page=="trabajos"){
                                          echo "<li><a href='trabajos'>Tasks</a></li>";
                                       }
                                       else{                  
                                          echo "<li><a href='trabajos'>Tasks</a></li>";
                                       }
                                       if($page=="jugadas"){
                                         echo "<li><a href='jugadas' >Products</a></li>";
                                       }
                                       else{                  
                                         echo "<li><a href='jugadas' >Products</a></li>";
                                       }
                                       if($page=="promo"){
                                         echo "<li><a href='promo' >Promotion</a></li>";
                                       }
                                       else{                        
                                         echo "<li><a href='promo' >Promotion</a></li>";
                                       }
                                       /*if($page=="criptos"){
                                         echo "<a href='criptos' class='nav__link active'>Criptos</a>";
                                       }
                                       else{                        
                                         echo "<a href='criptos' class='nav__link'>Criptos</a>";
                                       }    */   
                                    }
                                ?>
                            </ul>
                            <ul class="member-actions" >

                                                   <li id='show-on-small'>
                                                       <a  href='perfilcliente'>
                                                          <i class='ri-profile-line'></i> Profile
                                                       </a>                          
                                                    </li>
                                                      <li id='show-on-small'>
                                                       <a href='block?cerrarSesion'>
                                                          <i class='ri-expand-left-fill'></i> Log Out
                                                       </a>
                                                    </li> 
                                                    <li id='show-on-small'>
                                                       <a href='miwallet'>
                                                          <i></i><?php if(isset($_SESSION['user'])){echo "Balance <p id='saldo' style='color:green;margin:0;font-weight: 700;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p>";}?></a>
                                                    </li> 
                                                    

                                                    
                                                    
                                 <?php 
                                       if(!isset($_SESSION['secured'])){
                                          echo "    
                                             <li><a href='sesion' class='login'>Log in</a></li>
                                             <li><a href='registro' class='btn-white btn-small'>Sign up</a></li>
                                          ";
                                       }
                                       else{
                                          $notificaciones = countNotif($_SESSION['user']);
                                          $style = "";

                                          if($notificaciones>0){
                                             $style = "style='border-top: solid 1px red;'";
                                          }
                                       }

                                       if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 && isset($_SESSION['secured'])) {
                                          echo "
                                             <li class='dropdown' id='close-on-small'>
                                                <a>".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i> </a>
                                                <ul class='dropdown-content' style='width:14rem;'>
                                            
                                                   <li>
                                                      <a href='miwallet'>
                                                         <i class='ri-pie-chart-line'></i> Balance: <div> <span id='saldo' style='font-weight: 700;color:green;margin:0;padding-bottom: 0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</span> <span>USDC</span> <div>
                                                      </a>                          
                                                   </li>

                                                                                                      <li>
                                                      <a href='perfilcliente'>
                                                         <i class='ri-account-circle-line'></i> Profile
                                                      </a>
                                                   </li>
                     
                                                   <li>
                                                      <a href='block?cerrarSesion'>
                                                         <i class='ri-expand-left-fill'></i> Log Out
                                                      </a>
                                                   </li>
                                                </ul>
                                             </li>                 
                                          "; 
                                       }


                                       else if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1 && isset($_SESSION['secured'])) {
                                          if($page=="perfiladmin"){
                                             echo "
                                              <li class='dropdown' id='close-on-small'>
                                                 <a>".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i> </a>
                                                 <ul class='dropdown-content'>
                                                                                              
                                                   <li>
                                                       <a  href='perfiladmin'>
                                                          <i class='ri-profile-line'></i> Profile
                                                       </a>                          
                                                    </li>
                         
                                                    <li>
                                                       <a href='miwallet'>
                                                          <i class='ri-pie-chart-line'></i> Balance: <p id='saldo' style='font-weight: 700;color:green;margin:0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p> USDC
                                                       </a>                          
                                                    </li>
                         
                                                    <li>
                                                       <a href='block?cerrarSesion'>
                                                          <i class='ri-expand-left-fill'></i> Log Out
                                                       </a>
                                                    </li>                                               
                                              </ul>
                                           </li>                 
                                             ";
                                           }
                                           else{                        
                                             echo "
                                                <li class='dropdown' id='close-on-small'>
                                                   <a>".readClienteId($_SESSION['user'])['CORREO']." <i class='ri-arrow-down-s-line dropdown__arrow'></i> </a>
                                                   <ul class='dropdown-content'>
                                                                                              
                                                   <li>
                                                       <a  href='perfiladmin'>
                                                          <i class='ri-profile-line'></i> Profile
                                                       </a>                          
                                                    </li>
                         
                                                    <li>
                                                       <a href='miwallet'>
                                                          <i class='ri-pie-chart-line'></i> Balance: <p id='saldo' style='font-weight: 700;color:green;margin:0;'>".price(readClienteId($_SESSION['user'])['SALDO'])."</p> USDC
                                                       </a>                          
                                                    </li>
                         
                                                    <li>
                                                       <a href='block?cerrarSesion'>
                                                          <i class='ri-expand-left-fill'></i> Log Out
                                                       </a>
                                                    </li>                                               
                                              </ul>
                                           </li>                 
                                             ";
                                           }
                                       }                               
                                 ?> 

                            </ul>
                        </nav>
                    </div>

                    <div class="navicon">
                        <a class="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>

