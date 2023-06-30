<main class="bg-gray-100 overflow-hidden py-10">
    <section class="lg:flex md:w-9/12 mx-auto w-11/12">
        <nav class="cursor-pointer bg-gray-200 border-b border-gray-300 flex moblieAboutButton p-4 relative rounded-lg sm:border-none sm:hidden w-full">
            <p class="font-bold text-indigo-900 text-xl">Menu</p>
            <img alt="Ikona Menu"class="absolute mobileAboutIcon right-4"src="img/menuIcon.png">
        </nav>
        <nav class="bg-gray-200 rounded-lg h-auto hidden lg:h-44 lg:pr-10 moblieAboutOptions sm:block w-auto">
            <ul class="font-bold text-indigo-900 text-xl leading-10 px-7 py-3 sm:py-7">
                <li class="cursor-pointer hover:underline">
                    <a href="index.php?str=onas&sect=sucasnost">Súčasnosť</a>
                </li>
                <li class="cursor-pointer hover:underline">
                    <a href="index.php?str=onas&sect=uspechy">Úspechy</a>
                </li>
                <li class="cursor-pointer hover:underline">
                    <a href="index.php?str=onas&sect=historia">História</a>
                </li>
            </ul>
        </nav>
        
        <main class="px-12">
            <?php 
                if(isset($_GET['sect'])){
                    switch($_GET['sect']){
                        case 'historia':include 'historia.php';break;
                        case 'sucasnost':include 'sucasnost.php';break;
                        case 'uspechy':include 'uspechy.php';break;
                        default:include 'php/onas/onas.php';
                    }
                } else{
                    include('php/onas/onas.php');
                } 
            ?>
        </main>