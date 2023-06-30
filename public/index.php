<?php

    ob_start();

    include('php/function.php');
    con();

    session_start();

    if(isset($_SESSION['Username']) && isset($_SESSION['Password'])){
        echo('<p>Ste prihlásený ako administrátor</p>');
        echo('<a class="absolute right-1 top-0 text-black" href="index.php?str=logout">Odhlásenie</a>');
    }

    $qu = "SELECT * FROM kontakt";
    $re = mysqli_query($con, $qu);
    $dbDataKo = mysqli_fetch_array($re);

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205614751-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-205614751-1');
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <title>Kajak - Kanoe Piešťany</title>
</head>
<body class="bg-gray-200 max-w-screen-2xl m-auto">
    <!-- fb plugin -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v13.0" nonce="rAoIbuhH"></script>

    <!-- Header  -->
    <header class="z-0">
        <nav class="relative">
            <!-- LG devices nav -->
            <ul class="hidden lg:flex items-center min-h-80px bg-white">
                <li class="flex-auto font-semibold tracking-tighter text-3xl text-indigo-900 font-sans">
                    <a href="index.php" class="p-8 outline-none">Kajak Kanoe Piešťany</a>
                </li>
                <li class="px-8 py-4 text-lg text-indigo-900 font-bold font-sans cursor-pointer"><a href="index.php?str=news">Aktuality</a></li> <!-- https://www.zpiestan.sk/tag/kajak-kanoe-piestany/ -->
                <li class="px-8 py-4 text-lg text-indigo-900 font-bold font-sans cursor-pointer"><a href="index.php?str=onas">O nás</a></li>
                <li class="px-8 py-4 text-lg text-indigo-900 font-bold font-sans cursor-pointer"><a href="index.php?str=nastim">Náš tím</a></li>
                <li class="px-8 py-4 text-lg text-indigo-900 font-bold font-sans cursor-pointer"><a href="index.php?str=kontakt" id="kontaktLink">Kontakt</a></li>
            </ul>
            
            <!-- SM devices nav -->
            <ul class="flex lg:hidden items-center min-h-80px p-2 bg-white">
                <li class="flex-auto font-semibold tracking-tighter text-3xl text-indigo-900 font-sans">
                    <a href="index.php" class="outline-none">Kajak Kanoe Piešťany</a>
                </li>
                <li class="">
                    <a href="#">
                        <img class="openMenu cursor-pointer" src="./img/menuIcon.png" alt="Open Menu button">
                    </a>
                </li>
            </ul>
                
            <!-- Sm devices nav - menu options -->
            <ul class="mobileNav invisible absolute top-0 w-full z-50 text-center bg-blue-700">
                <li class="absolute top-2 right-6">
                    <a href="index.php">
                        <img class="crossMenu" src="./img/crossMenu.png" alt="Tlačítko na zatvorenie menu">
                    </a>
                </li>
                <li class="px-8 py-4 text-lg text-blue-50 font-bold font-sans cursor-pointer"><a class="mobileMenuOptions" href="index.php">Kajak Kanoe Piešťany</a></li>
                <li class="px-8 py-4 text-lg text-blue-50 font-bold font-sans cursor-pointer"><a class="mobileMenuOptions" href="index.php?str=news">Aktuality</a></li>
                <li class="px-8 py-4 text-lg text-blue-50 font-bold font-sans cursor-pointer"><a class="mobileMenuOptions" href="index.php?str=onas">O nás</a></li>
                <li class="px-8 py-4 text-lg text-blue-50 font-bold font-sans cursor-pointer"><a class="mobileMenuOptions" href="index.php?str=nastim">Náš tím</a></li>
                <li class="px-8 py-4 text-lg text-blue-50 font-bold font-sans cursor-pointer"><a class="mobileMenuOptions" id="kontaktLinkS" href="index.php?str=kontakt">Kontakt</a></li>       
            </ul> 
        </nav>
        <?php

            if(isset($_GET["str"]) && !isset($_GET['clan'])){
                if($_GET["str"] == 'login' || $_GET["str"] == 'sign'){
                    include "php/header/loginHeader.php";
                } else{
                    include "php/header/sideHeader.php"; 
                }
            } elseif(!isset($_GET['clan'])){
                include "php/header/mainHeader.php";
            }

            // if(!isset($_GET["str"]) && !isset($_GET['clan'])){
            //     if(!isset($_GET['login']) && !isset($_GET['sign'])){
            //         include "php/header/mainHeader.php";
            //     }
            // } elseif(isset($_GET["str"]) && !isset($_GET['clan'])){
            //     if(!isset($_GET['login']) && !isset($_GET['sign'])){
            //         include "php/header/sideHeader.php";
            //     }
            // }

            // if(isset($_GET["str"]) && !isset($_GET['clan'])){
            //     if(!isset($_GET['login']) && !isset($_GET['sign'])){
            //         include "php/header/sideHeader.php";
            //     }
            // } elseif(!isset($_GET['clan'])){
            //     include "php/header/mainHeader.php";
            // }

        ?>
    </header>

    <main>
        <?php
            if(isset($_GET['str'])){
                if(isset($_SESSION['Username']) && isset($_SESSION['Password'])){
                    switch($_GET['str']){
                        case "news": include "php/news/news.php"; break;
                        case "onas": include "php/onas/onasIndx.php"; break;
                        case "nastim": include "php/nasTim/nasTimIndx.php"; break;
                        case "kontakt": include "php/kontakt/kontakt.php"; break;
                        case "logout": include "php/log/logout.php"; break;
                        default: include "php/uvod.php"; break;
                    }
                } else{
                    switch($_GET['str']){
                        case "news": include "php/news/news.php"; break;
                        case "onas": include "php/onas/onasIndx.php"; break;
                        case "nastim": include "php/nasTim/nasTimIndx.php"; break;
                        case "kontakt": include "php/kontakt/kontakt.php"; break;
                        case "login": include "php/log/login.php"; break;
                        case "sign": include "php/log/sign.php"; break;
                        default: include "php/uvod.php"; break;
                    }
                }
            } else{
                include "php/uvod.php";
            }  
        ?>
    </main>
    <!-- Footer -->
    <footer class="py-10 text-white bg-blue-900">
        <ul class="lg:flex sm:w-10/12 sm:mx-auto text-center lg:text-left">
            <li class="w-72 mx-auto py-10">
                <h3 class="text-2xl font-semibold">Kontaktné údaje</h3>
                <ul>
                <li class="font-semibold"><?php echo($dbDataKo['Nazov']); ?></li>
                <li><?php echo($dbDataKo['Adresa']); ?></li>
                    <li><?php echo($dbDataKo['PSC']); ?></li>
                    <li><br></li>
                    <li>Tel.č.: <a href="tel:<?php echo($dbDataKo['Tel']); ?>"><?php echo($dbDataKo['Tel']); ?></a></li>
                    <li>E-mail: <a href="mailto:<?php echo($dbDataKo['Email']); ?>"><?php echo($dbDataKo['Email']); ?></a></li>
                    <li><br></li>
                    <li>IČO: <?php echo($dbDataKo['ICO']); ?></li>
                    <li>DIČ: <?php echo($dbDataKo['DIC']); ?></li>
                    <li>IBAN: <?php echo($dbDataKo['IBAN']); ?></li>
                </ul>
            </li>
            <li class="w-72 mx-auto py-10">
                <h3 class="text-2xl font-semibold">Sleduj tiež náš</h3>
                <ul class="flex justify-center lg:justify-start">
                    <li class="w-10 h-10 mx-5 lg:mx-0 lg:mt-2 lg:mr-7 lg:ml-4 overflow-hidden">
                        <a href="https://www.facebook.com/K2.Piestany" target="_blank"><img src="./img/facebook.png" alt="Facebooková stránka"></a>
                    </li>
                    <li class="w-10 h-10 mx-5 lg:mx-0 lg:mt-2 lg:mr-7 lg:ml-4 overflow-hidden">
                        <a href="https://www.instagram.com/kajak_kanoe_piestany" target="_blank"><img src="./img/ig.png" alt="Instragramová stránka"></a>
                    </li>
                </ul>
            </li>
            <li><a href="index.php"><img class="w-72 mx-auto py-10" src="./img/kajakar.png" alt="Naše logo"></a></li>
        </ul>

    </footer>

    
    <!-- Swiper JS  -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

     <!-- Initialize Swiper  -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        centeredSlides: true,
        loop: true,
        autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
    });
    </script>

     <!-- My JS  -->
    <script src="script.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>