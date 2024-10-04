<?php



?>

<style>

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.footer {
  position: relative;
  width: 100%;
  min-height: 100px;
  padding: 20px 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background:black;
}

.social-icon,
.menu {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 10px 0;
  flex-wrap: wrap;
}

.social-icon__item,
.menu__item {
  list-style: none;
}

.social-icon__link {
  font-size: 2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
}
.social-icon__link:hover {
  transform: translateY(-10px);
}

.menu__link {
  font-size: 1.2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
  text-decoration: none;
  opacity: 0.75;
  font-weight: 300;
}

.menu__link:hover {
  opacity: 1;
}

.footer p {
  color: #fff;
  margin: 15px 0 10px 0;
  font-size: 1rem;
  font-weight: 300;
}




</style>

<footer class="footer">
    </div>
    <ul class="social-icon">

        <li class="social-icon__item">
            <a class="social-icon__link" href="#">
                <ion-icon name="send-outline"></ion-icon>
            </a>
        </li>

        <li class="social-icon__item">
            <a class="social-icon__link" href="mailto:crptsgnlgrpspprt@gmail.com">
                <ion-icon name="mail-open-outline"></ion-icon>
            </a>
        </li>
    </ul>
    <h1 style='font-family:futurist;color:#fff'>CryptoSignal</h1>
    <h5 style='font-family:futurist;color:#fff'>Fondo de Inversion</h5>
    <ul class="menu">
      <li class="menu__item"><a class="menu__link" href="index">Home</a></li>
      <li class="menu__item"><a class="menu__link" href="ayuda">Acerca De </a></li>
      <!--<li class="menu__item"><a class="menu__link" href="#">Servicios</a></li>-->
      <li class="menu__item"><a class="menu__link" href="terminos">Terminos de Uso</a></li>

    </ul>
    <p>&copy;2017 CryptoSignal | All Rights Reserved</p>
  </footer>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>