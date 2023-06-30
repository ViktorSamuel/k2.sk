<main class="bg-gray-100 overflow-hidden py-10">
    <section class="lg:flex md:w-9/12 mx-auto w-11/12">
        <nav class="bg-gray-200 cursor-pointer flex moblieAboutButton p-4 relative rounded-lg sm:hidden w-full">
            <p class="font-bold text-indigo-900 text-xl">Menu</p>
            <img alt="Ikona Menu"class="absolute mobileAboutIcon right-4"src="img/menuIcon.png">
        </nav>
        
        <?php 
            if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
                echo('
                    <nav class="moblieAboutOptions hidden sm:block w-auto lg:pr-10 lg:h-40 h-auto bg-gray-200 rounded-lg">
                        <ul class="px-7 py-4 leading-10 text-xl font-bold text-indigo-900">
                            <li class="hover:underline cursor-pointer"><a href="index.php?str=nastim&clen=sportovci">Športovci</a></li>
                            <li class="hover:underline cursor-pointer"><a href="index.php?str=nastim&clen=treneri">Tréneri</a></li>
                            <li class="hover:underline cursor-pointer"><a href="index.php?str=nastim&clen=registrovany">Registrovaný</a>
                            </li>  
                        </ul>
                    </nav>');
            }else{
                echo('
                    <nav class="moblieAboutOptions hidden sm:block w-auto lg:pr-10 lg:h-28 h-auto bg-gray-200 rounded-lg">
                        <ul class="px-7 py-4 leading-10 text-xl font-bold text-indigo-900">
                            <li class="hover:underline cursor-pointer"><a href="index.php?str=nastim&clen=sportovci">Športovci</a></li>
                            <li class="hover:underline cursor-pointer"><a href="index.php?str=nastim&clen=treneri">Tréneri</a></li>
                        </ul>
                    </nav>');
            } ?>
            
            <main class="lg:pl-12 lg:w-8/12">
                <?php 
                    if(isset($_GET['clen'])){
                        if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
                            switch($_GET['clen']){
                                case 'sportovci':include 'sportovci.php';break;
                                case 'treneri':include 'treneri.php';break;
                                case 'registrovany':include 'registrovany.php';break;
                                default:include 'php/nasTim/nasTim.php';
                            }
                        } else{
                            switch($_GET['clen']){
                                case 'sportovci':include 'sportovci.php';break;
                                case 'treneri':include 'treneri.php';break;
                                default:include 'php/nasTim/nasTim.php';
                            }
                        }
                    } else{
                        include('php/nasTim/nasTim.php');
                    } ?>
            </main>
    </section>
</main>