<?php 
include "servermail.php";
?>

<!doctype html>
<html  lang="en"> 
<head>
        <title>CriptoSignalGroup</title>
		<link rel="manifest" href="manifest.json">		
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <link rel="stylesheet" type="text/css" href="index-assets/css/datatables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="index-assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="index-assets/css/jquery.fancybox.css">
        <link rel="stylesheet" href="index-assets/css/flexslider.css">
        <link rel="stylesheet" href="index-assets/css/styles.css">
        <link rel="stylesheet" href="index-assets/css/queries.css">
        <link rel="stylesheet" href="index-assets/css/etline-font.css">
        <link rel="stylesheet" href="index-assets/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/sweetalert2.min.css" />
        <link rel="shortcut icon" href="Assets/favicon.png">
    </head> 
    <style>
            @font-face {
                font-family: impact;
                src: url(./css/impact.ttf);
            }

            @font-face {
                font-family: futurist;
                src: url(./css/fonts/futurist.otf);
            }

            body{
                background:black;
            }

            #image-dissapear{
                display:block;
            }

            @media screen and (max-width: 990px) {

                
            #image-dissapear{
                display:none;
            }

            }


            @media screen and (max-width: 1250px) {

                
            body{
                width: max-content;
            }

            }

            
            @media screen and (max-width: 1200px) {

                
            body{
                width: auto;
            }

            }


            @media screen and (max-width: 1050px) {

                
            body{
                width: max-content;
            }

            }


            
            @media screen and (max-width: 990px) {

                
            body{
                width: auto;
            }

            }



        </style> 
<body > 
   
            <?php $page = "index"; ?>
        <section class="navigation">
            <header style='padding:40px 0;'>
                <?php include 'barraNavegacion.php';?>
            </header>
        </section>
        <?php
                $correo = "";
                $saldo = "0.00";

                if(isset($_SESSION['user']) && isset($_SESSION['secured'])){
                    $correo = readClienteId($_SESSION['user'])['CORREO'];
                    $saldo = readClienteId($_SESSION['user'])['SALDO'];
                    recalcularSuscripciones($correo);
                    //refreshDataAuto();
                    //promoFlotante();
                } 
            ?> 
<section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="hero-content text-center">
                        <h1>Invest, empower, win!</h1>
                        <p class="intro">Introducing CryptoSignal. A Crypto-based safe investment fund</p>
                        <a href="tienda" class="btn btn-fill btn-large btn-margin-right">Go to Store</a> <a href="ayuda" class="btn btn-accent btn-large">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="down-arrow floating-arrow"><a href="#"><i class="fa fa-angle-down"></i></a></div>
    </section>

    <section class="features-extra section-padding" id="assets">
        <div class="container" style='display: flex;'>
            <div class="row">
                <div class="col-md-5" style='width: 100%;'>
                    <div class="feature-list">
                        <h3>Introducing CryptoSignal!</h3>
                        <p>At Cryptosignal, we specialize in providing innovative fixed-term investment solutions using cryptocurrencies. Our approach is designed to offer stability and substantial returns within a specified period, making it an attractive option for investors looking for reliable growth.</p>
                        <p>Our fixed-term investment fund leverages the power of blockchain technology to maximize security and efficiency. Join us and take advantage of the future of finance today.</p>
                        <a href="#" class="btn btn-ghost btn-accent btn-small">Learn More About Us</a>
                    </div>
                </div>
            </div>
            <div><img src="index-assets/img/macbook-pro.png" alt="responsive devices" style='width: 40rem;' id='image-dissapear'></div>
        </div>
        <div class="responsive-feature-img"><img src="index-assets/img/macbook-pro.png" alt="responsive devices"></div>
    </section>


    <section class="intro section-padding">
        <div class="container">
            <div class="row">
                <h3 style="padding: 0 7.5rem;">Our Benefits</h3>
                <div class="col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span data-icon="&#xe033;" class="icon"></span>
                    </div>
                    <div class="intro-content">
                        <h5>Security and Stability</h5>
                        <p>Unlike volatile short-term investments, our fixed-term cryptocurrency investments are designed to offer greater stability and security, protecting your capital against extreme market fluctuations.</p>
                    </div>
                </div>
                <div class="col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span data-icon="&#xe030;" class="icon"></span>
                    </div>
                    <div class="intro-content">
                        <h5>Accumulative Guaranteed Returns</h5>
                        <p>By opting for fixed-term cryptocurrency investments, you benefit from guaranteed returns over time. This approach allows you to plan your financial future with greater certainty.</p>
                    </div>
                </div>
                <div class="col-md-4 intro-feature">
                    <div class="intro-icon">
                        <span data-icon="&#xe046;" class="icon"></span>
                    </div>
                    <div class="intro-content last">
                        <h5>Strategic Diversification</h5>
                        <p>Diversification is key to a healthy portfolio. By including fixed-term cryptocurrency investments, you can balance the overall risk of your assets, combining the volatility of some investments with the stability of others.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features section-padding" id="features" >
        <div class="container">
            <div class="row" style="display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;">

                <iframe class='youtube-tutorial' src="https://www.youtube.com/embed/h3t7BDOySPE?si=vwwKs9qr7vJYPaxi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <div>
                    <div class="feature-list">
                        <h3>How to Start Investing</h3>
                        <p>Present your product, start up, or portfolio in a beautifully modern way. Turn your visitors in to clients.</p>
                        <ul class="features-stack">
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <span data-icon="&#xe03e;" class="icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h5>Top Up! Your Balance</h5>
                                    <p>Select your teller and deposit your stable coins to top your balance up.</p>
                                </div>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <span data-icon="&#xe040;" class="icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h5>Buy a Card</h5>
                                    <p>Go to subscriptions and select your card of preference, there are multiple options to choose that adjust to your level of comfort!</p>
                                </div>
                            </li>
                            <li class="feature-item">
                                <div class="feature-icon">
                                    <span data-icon="&#xe03c;" class="icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h5>Enjoy</h5>
                                    <p>You're now part of the investment fund. Sit and wait the given time to withdraw your money!</p>
                                </div>
                                <div style="display: flex;
                                align-items: center;
                                padding: 2rem 0rem;
                                justify-content: center;">
                                    <a href="#" class="btn btn-ghost btn-accent btn-small">Buy a Card</a>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class='faq-container'>

        <div class="faqWrapper">
            <h3 style="text-align: left;">How can we Help You</h3>

            <p style="text-align: left;">We hope you find a answer to your question. If you need any help, please search your query in our support center or contact us via Email.</p>
      
            <div class="faqB">
              <button class="accordion">
              Why has my deposit not been credited?        
                 <i class="ei--chevron-down"></i>
              </button>
              <div class="faqPannel">
                <p>
                The network confirmation for your deposit is still pending Your deposit will be credited correctly once the transaction meets the minimum number of network confirmations required by the system.                </p>
              </div>
            </div>
      
            <div class="faqB">
              <button class="accordion">
              What benefits does acquiring this product or service have?                
              <i class="ei--chevron-down"></i>
              </button>
              <div class="faqPannel">
                <p>
                By obtaining an investment fund plan you will be able to receive passive earnings monthly.                </p>
              </div>
            </div>
      
            <div class="faqB">
              <button class="accordion">
                Do I really need this product or service?
                <i class="ei--chevron-down"></i>
              </button>
              <div class="faqPannel">
                <p>
                An investment fund is an organized and useful way to save in the short and long term to meet financial goals.
                </p>
              </div>
            </div>
      
            <div class="faqB">
              <button class="accordion">
              How much money does it cost to acquire this product?
              <i class="ei--chevron-down"></i>
              </button>
              <div class="faqPannel">
                <p>
                Cryptosignal has different plans that range from a minimum amount of 10 dollars to the maximum amount of 2 thousand dollars.                </p>
              </div>
            </div>
      
            <div class="faqB">
              <button class="accordion">
                What payment methods do they accept?
              <i class="ei--chevron-down"></i>
              </button>
              <div class="faqPannel">
                <p>
                Currently the platform has binance pay and bep20 address (usdt, usdc) as payment methods.
                </p>
              </div>
            </div>
      
          </div>


    </section>
 

    



    <section id="testimonial" class="testimonial" style="background: #316077e3;padding: 8rem;">
        <div class="video_overlay">
            <div class="container">
                <div class="row">
                    <div class="main_testimonial sections text-center">
                        <div class="col-md-12" data-wow-delay="0.2s">
                            <div class="main_teastimonial_slider text-center">

                                <div class="single_testimonial">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <i class="fa fa-quote-left" style="font-size: 3rem;"></i>
                                            <p>The underlying principles of sound investment should not alter from decade to decade, but the application of these principles must be adapted to significant changes in the financial mechanisms and climate</p>
                                            <div class="single_test_author">
                                                <h4>Benjamin Graham<span> -- Economist</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Iniciar footer-->
    <?php include 'footer.php';?>
    <!--FIN footer--> 
    
    <script src="Javascript/index.js"></script>

            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        this.parentElement.classList.toggle("active");

                        var pannel = this.nextElementSibling;

                        if (pannel.style.display === "block") {
                            pannel.style.display = "none";
                        } else {
                            pannel.style.display = "block";
                        }
                    });
                }
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            
            
            <script src="bower_components/retina.js/dist/retina.js"></script>
            <script src="index-assets/js/jquery.fancybox.pack.js"></script>
            <script src="index-assets/js/vendor/bootstrap.min.js"></script>
            <script src="index-assets/js/scripts.js"></script>
            <script src="index-assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
            <script src="index-assets/js/jquery.flexslider-min.js"></script>
            <script src="index-assets/bower_components/classie/classie.js"></script>
            <script src="index-assets/bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>
			<script src="page_script.js" defer></script>
</body>
</html>
