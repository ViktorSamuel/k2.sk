
<!-- News -->
<section class="relative -top-20vh lg:-top-24vh left-1/2 transform -translate-x-1/2 z-10 w-full md:w-11/12 overflow-hidden bg-gray-50 shadow-lg">
    <!-- LG Destcopes -->
    <ul class="hidden lg:flex flex-wrap">
        <?php

        $select = "SELECT * FROM clanky ORDER BY Date DESC LIMIT 3, 3";
        $result = mysqli_query($con, $select);

        if(!$result){
            die('problem');
        }

        foreach($result as $q){ ?>
            <li class="flex-1 relative h-64 mx-2 my-4 bg-black overflow-hidden group">
                <a href="index.php?str=news&clan=<?php echo($q['ID']); ?>">
                    <img class="min-h-full min-w-full opacity-75 transform group-hover:scale-105 transition duration-300" src="<?php echo($q["Img"]); ?>" alt="Obrzok k článku">
                    <a href="index.php?str=news&clan=<?php echo($q['ID']); ?>" class="absolute left-2 bottom-3 text-2xl sm:text-3xl text-white font-bold"><?php echo($q["Title"]); ?></a>
                </a>
            </li>
        <?php } ?>
    </ul>

        <!-- MD Destcopes -->
        <ul class="hidden sm:flex lg:hidden flex-wrap">
            <?php
            $selectMd = "SELECT * FROM clanky ORDER BY Date DESC LIMIT 3, 2";
            $resultMd = mysqli_query($con, $selectMd);

            if(!$resultMd){
                die('problem');
            }

            foreach($resultMd as $qMd){ ?>
                <li class="flex-1 relative h-64 mx-2 my-4 bg-black overflow-hidden group">
                    <a href="index.php?str=news&clan=<?php echo($qMd['ID']); ?>">
                        <img class="min-h-full min-w-full opacity-75 transform group-hover:scale-105 transition duration-300" src="<?php echo($qMd["Img"]); ?>" alt="Obrzok k článku">
                        <a href="index.php?str=news&clan=<?php echo($qMd['ID']); ?>" class="absolute left-2 bottom-3 text-2xl sm:text-3xl text-white font-bold"><?php echo($qMd["Title"]); ?></a>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <!-- SM Devices -->
        <ul class="block sm:hidden w-11/12 mx-auto">
        <?php
            $selectSm = "SELECT * FROM clanky ORDER BY Date DESC LIMIT 3, 2";
            $resultSm = mysqli_query($con, $selectSm);

            if(!$resultSm){
                die('problem');
            }

            foreach($resultSm as $qSm){ ?>
                <li class="flex-1 relative h-64 mx-2 my-4 bg-black overflow-hidden group">
                    <a href="index.php?str=news&clan=<?php echo($qSm['ID']); ?>">
                        <img class="min-h-full min-w-full opacity-75 transform group-hover:scale-105 transition duration-300" src="<?php echo($qSm["Img"]); ?>" alt="Obrzok k článku">
                        <a href="index.php?str=news&clan=<?php echo($qSm['ID']); ?>" class="absolute left-2 bottom-3 text-2xl sm:text-3xl text-white font-bold"><?php echo($qSm["Title"]); ?></a>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <a href="index.php?str=news" class="flex relative mx-auto mb-4 w-11/12 sm:w-5/12 h-12 justify-center items-center border-2 border-blue-500 rounded-md hover:border-transparent hover:bg-blue-700 text-xl text-blue-800 hover:text-gray-50 font-semibold cursor-pointer transition duration-300 ease-in">Všetky články</a> 
</section>

<!-- Calendar, competition html -->
<section class="relative w-11/12 -top-24 mx-auto overflow-hidden">
    <!-- Calendar, competition php -->
    <?php
        $selectCal = "SELECT * FROM preteky ORDER BY do"; //ORDER BY od
        $resultCal = mysqli_query($con, $selectCal);

        if(!$resultCal){
                die("error");
        }

        // novy pretek 
        $err = '';
        if(isset($_POST['submit'])){

            $name = test_in($con, $_POST['nazov']);
            if(!$name){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť všetky polia</p>';
            }

            $place = test_in($con, $_POST['miesto']);
            if(!$place){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť všetky polia</p>';
            }
            
            $link = test_in($con, $_POST['link']);
            if(!$link){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť všetky polia</p>';
            }
            
            $od = test_in($con, $_POST['od']);
            if(!$od){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť všetky polia</p>';
            }
            
            $do = test_in($con, $_POST['do']);
            if(!$do){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť všetky polia</p>';
            }
            
            foreach($resultCal as $res){
                for($y = strtotime($res['od']); $y <=strtotime($res['do']); $y = $y + (60*60*24)){
                    for($x = strtotime($od); $x <= strtotime($do); $x = $x + (60*60*24)){
                        if($x == $y){
                            $err = '<p class="text-red-700 font-semibold text-xl">V tomto datume už preteky sú</p>';
                        }
                    }
                }
            }

            if(!$err){
                $addToDb = "INSERT INTO preteky(nazov,link,miesto,od,do) VALUES('$name','$link','$place','$od','$do')";
                $res = mysqli_query($con, $addToDb);
                if($res){
                    header('location:index.php');
                    mysqli_close($con);  
                } else{
                    echo('Vyskitol sa problém.');
                }
            }
        }    

        // odstranenie preteku
        $num = 0;
        $any = 0;
        if(isset($_POST['delete'])){
            $name = test_in($con, $_POST['nazov']);
            if(!$name){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť potrebne polia</p>';
            }
            $od = test_in($con, $_POST['od']);
            if(!$od){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť potrebne polia</p>';
            }
            $do = test_in($con, $_POST['do']);
            if(!$do){
                $err = '<p class="text-red-700 font-semibold text-xl">Musíš vyplniť potrebne polia</p>';
            }

            foreach($resultCal as $res){
                $num++;
                if($od == $res['od'] && $do == $res['do']){
                    if($name == $res['nazov']){
                        $del = "DELETE FROM preteky WHERE nazov='$name' AND od='$od' AND do='$do'";
                        $resultCal = mysqli_query($con, $del);
                        
                        if(!$resultCal){
                            echo('Vyskitol sa problém.');
                        } else{
                            header('location:index.php');
                            mysqli_close($con);  
                        }
                    } else{
                        $any++;
                    }
                } else{
                    $any++;
                    if($num == $any){
                        $err = '<p class="text-red-700 font-semibold text-xl">Pretek s daným názvom sa v danom termíne nenachádza</p>';
                    }
                }
            }
        

        }
    ?>
    <?php if(isset($_SESSION['Username']) && isset($_SESSION['Password'])){ ?>
        <form class="grid grid-cols-2 gap-10 m-2 mb-10 sm:m-5 p-5 border border-black rounded-md" action="index.php" method="post">
            <h4 class="text-3xl font-semibold text-blue-800 sm:col-span-1 col-span-2">Pridávanie / odstraňovanie preteku</h4>
            <?php echo($err); ?>
            <p class="sm:col-span-1 col-span-2">Pri pridávaní preteku vypíš všetky polia. Pri odstraňovaní je potrebné vyplniť: Názov, dátum začiatku a konca</p>
            <div class="sm:col-span-1 col-span-2">
                <label for="nazov">Názov preteku</label><br>
                <input class="w-56 md:w-80" type="text" name="nazov" id="nazov" placeholder="MSR kratke ...">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <label for="miesto">Miesto konania</label><br>
                <input class="w-56 md:w-80" type="text" name="miesto" id="miesto" placeholder="Zemník, Bratislava">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <label for="link">Link na pretek na Slovenskú kanoistiku</label><br>
                <input class="w-56 md:w-80" type="text" name="link" id="link" placeholder="Adresa linku">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <label for="od">Začiatok konania</label><br>
                <input type="date" name="od" id="od">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <label for="do">Koniec konania</label><br>
                <input type="date" name="do" id="do">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <input class="px-5 py-3 text-xl font-semibold border border-black rounded-md hover:bg-gray-500" type="submit" name="submit" value="Pridať">
            </div>

            <div class="sm:col-span-1 col-span-2">
                <input class="px-5 py-3 text-xl font-semibold border border-black rounded-md hover:bg-gray-500" type="submit" name="delete" value="Odstrániť">
            </div>

        </form>
    <?php } ?>
    <ul class="lg:grid grid-cols-8 gap-3">
        <!-- Calendar -->
        <li class="relative lg:col-span-4 xl:col-span-3 max-w-md mx-auto sm:mx-0 cursor-pointer calendar">
            <h2 class="text-indigo-900 text-5xl font-semibold pb-10">Kalendár</h2>
            <!-- w-11/12 sm:w-9/12 md:w-6/12 lg:w-4/12 2xl:w-3/12 -->
            <section class="calendar p-2.5 pb-8 bg-blue-900 text-white shadow-md rounded-2xl cursor-pointer">
                <div class="flex justify-between items-center w-full h-12 text-3xl font-bold">
                    <i class="bg-transparent prev cursor-pointer px-3 font-normal outline-none">&lt;</i>
                    <div class="date">
                    <h3 class="tracking-wide text-2xl sm:text-3xl"></h3>
                    </div>
                    <i class="bg-transparent next cursor-pointer px-3 font-normal outline-none">&gt;</i>
                </div>
                <ul class="flex items-center w-full text-base sm:text-lg font-semibold py-2.5">
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">Po</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">Ut</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">St</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">Št</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">Pi</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">So</li>
                    <li class="flex justify-center items-center tracking-wider w-1/6 h-9">Ne</li>
                </ul>
                <div class="days grid grid-cols-7 gap-2 text-white"></div>
            </section>
        </li>       

        <!-- Competition -->              
        <li class="relative lg:col-span-4 xl:col-span-5 blizkePreteky">                  
            <h2 class="text-indigo-900 text-5xl font-semibold pb-10 pt-10 lg:pt-0">Najbližšie preteky</h2>                   
            <ul class="nextCompetiton">                       
            </ul>
        </li>
    </ul>

    <!-- Calendar, competition js -->
    <script>
        // do konstanty date sa vytvori objekt podla konstruktora Date() tzn. objek obahujuci aktualy datum
        const date = new Date();

        let numOf = 0,
            numOfWill = 0,
            numOfWere = 0,
            competitionPrev = [],
            competitionNext = [],
            nextCompetiton = document.querySelector(".nextCompetiton");

        <?php foreach($resultCal as $res){

            $odDay = date('d', strtotime($res['od']));
            $doDay = date('d', strtotime($res['do']));

            $odMonth = date('m', strtotime($res['od']));
            $doMonth = date('m', strtotime($res['do']));

            $odYear = date('Y', strtotime($res['od']));
            $doYear = date('Y', strtotime($res['do'])); ?>
            
            numOf++;

            if(<?php echo($odDay); ?> == <?php echo($doDay); ?> && <?php echo($odMonth); ?> == <?php echo($doMonth); ?>){
                if(<?php echo($doYear); ?> == date.getFullYear()){
                    if(<?php echo($doMonth); ?> == date.getMonth() + 1){
                        if(<?php echo($doDay); ?> >= date.getDate()){
                            competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                    '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+'.'+'<?php echo($odYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                                '</li>');
                        } else{
                            competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                    '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+'.'+'<?php echo($odYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                                '</li>');
                        }   
                    } else if(<?php echo($doMonth); ?> > date.getMonth() + 1){
                        competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                    '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+'.'+'<?php echo($odYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                            '</li>');
                    } else{
                        competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                            '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+'.'+'<?php echo($odYear); ?>' +'</span>'+
                                '<span class="block sm:pl-8">'+
                                    '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                    '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                '</span>'+
                            '</a>'+
                            '</li>'); 
                    }
                } else if(<?php echo($doYear); ?> > date.getFullYear()){
                    competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + '.'+ '<?php echo($odYear); ?>'+'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                            '</li>'); 
                } else{
                    competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                            '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + '.'+ '<?php echo($odYear); ?>'+'</span>'+
                                '<span class="block sm:pl-8">'+
                                    '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                    '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                '</span>'+
                            '</a>'+
                        '</li>'); 
                }
            } else{
                if(<?php echo($doYear); ?> == date.getFullYear()){
                    if(<?php echo($doMonth); ?> == date.getMonth() + 1){
                        if(<?php echo($doDay); ?> >= date.getDate()){
                            if(<?php echo($doYear); ?> == <?php echo($odYear); ?> ){
                                competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            } else{
                                competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+ '.' + '<?php echo($odYear); ?>'+ ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            }
                        } else{
                            if(<?php echo($doYear); ?> == <?php echo($odYear); ?> ){
                                competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            } else{
                                competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+ '.' + '<?php echo($odYear); ?>'+ ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            }
                        }   
                    } else if(<?php echo($doMonth); ?> > date.getMonth() + 1){
                        competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                    '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                            '</li>');
                    } else{
                        if(<?php echo($doYear); ?> == <?php echo($odYear); ?>){
                            competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                    '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                            '</li>'); 
                        } else{
                            competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + '.'+ '<?php echo($odYear); ?>' +' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($doYear); ?>' +'</span>'+
                                    '<span class="block sm:pl-8">'+
                                        '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                        '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                    '</span>'+
                                '</a>'+
                            '</li>'); 
                        }
                    }
                } else if(<?php echo($doYear); ?> > date.getFullYear()){
                    if(<?php echo($doYear); ?> == <?php echo($odYear); ?> ){
                                competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            } else{
                                competitionNext.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+ '.' + '<?php echo($odYear); ?>'+ ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            }
                } else{
                    if(<?php echo($doYear); ?> == <?php echo($odYear); ?> ){
                                competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>' + ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            } else{
                                competitionPrev.push('<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">'+                        
                                        '<a href="'+ '<?php echo($res['link']); ?>' +'" target="_blank" class="sm:flex">'+
                                            '<span class="event-date w-48 self-center text-lg text-gray-800 font-light">' + '<?php echo($odDay); ?>' + "."+ '<?php echo($odMonth); ?>'+ '.' + '<?php echo($odYear); ?>'+ ' - ' + '<?php echo($doDay); ?>' + "."+ '<?php echo($doMonth); ?>'+ '.' + '<?php echo($odYear); ?>' +'</span>'+
                                            '<span class="block sm:pl-8">'+
                                                '<span class="event text-lg text-blue-900 font-semibold">' + '<?php echo($res['nazov']); ?>' + '</span><br>'+
                                                '<span class="event-place text-base text-gray-800 font-light">' +'<?php echo($res['miesto']); ?>' + '</span>'+
                                            '</span>'+
                                        '</a>'+
                                    '</li>');
                            }
                }
            }
            
        <?php } ?>
        if(competitionNext == 0){
            nextCompetiton.innerHTML = '<li class="mb-3 px-6 py-1 bg-gray-50 hover:bg-gray-200 shadow-md">Všetky preteky už boli. Tu je výpis štyroch posledných</li>';
            if(competitionPrev.length > 4){ numOf = 4; } else{ numOf = competitionPrev.length}
            for(let f = competitionPrev.length - 1; f >= competitionPrev.length - numOf; f--){
                nextCompetiton.innerHTML +=  competitionPrev[f];
            }
        } else{
            if(competitionNext.length > 5){ numOf = 5; } else{ numOf = competitionNext.length}
            for(let f = 0; f < numOf; f++){
                nextCompetiton.innerHTML +=  competitionNext[f];
            }
        }

        // funkcia renderCalendar
        const renderCalendar = () => {

            // nadstavim datum na prvy den v urcenom mesiaci
            date.setDate(1);
            
            let monthDays = document.querySelector(".days");

            // do konstanty lastDate sa nadstavy posledny den aktualneho mesiaca (nulty den buduceho)
            let lastDay = new Date(
                date.getFullYear(),
                date.getMonth() + 1,
                0
            ).getDate();

            // do konstanty prevLastDay sa nacita posledny den minuleho mesiaca (nulty den aktualneho)
            let prevLastDay = new Date(
                date.getFullYear(),
                date.getMonth(),
                0
            ).getDate();

            // do firstDayIndex sa vlozi poradove cislo aktualneho dna v aktualnom tyzdni 0Ne - 6So
            let firstDayIndex = date.getDay();

            // ak sa firstdayindex = 0 tak sa nadstavý na 6 pretoze defautne je 0 nedela ako prvý den ale ja mam pondelok ako prvý deň
            if(firstDayIndex == 0){
                firstDayIndex = 7;
            }

            // do lastDayIndex sa vlozi poradove cislo posledneho dna aktualneho mesiaca v tyzdni 0Ne - 6So (nulty den buduceho)
            let lastDayIndex = new Date(
                date.getFullYear(),
                date.getMonth() + 1,
                0
            ).getDay();
            
            // zostavajuci pocet dni do dokoncenia tydna po skonceni urceneho mesiaca
            let nextDays = 7 - lastDayIndex;

            // do pola nacitam nazvy mesiacov
            let months = [
                "Január",
                "Február",
                "Marec",
                "Apríl",
                "Máj",
                "Jún",
                "Júl",
                "August",
                "September",
                "Október",
                "November",
                "December",
            ];

            // do h3 zapisem nazov mesiaca a rok
            document.querySelector(".date h3").innerHTML = months[date.getMonth()] + " " + date.getFullYear();

            // pole pre uskladnenie datumov
            let days = [];

            // pole na vypisanie datumov
            let finalDays = '';

            // pomocne premenne pre rozlisenie preteku od nepreteku
            let d, n, remain = 0;
        
            // minuly meisac
            for(let j = firstDayIndex - 1; j > 0; j--){
                <?php foreach($resultCal as $res){
                    $odDay = date('d', strtotime($res['od']));
                    $doDay = date('d', strtotime($res['do']));
                    $odMonth = date('m', strtotime($res['od']));
                    $doMonth = date('m', strtotime($res['do']));
                    $odYear = date('Y', strtotime($res['od']));
                    $doYear = date('Y', strtotime($res['do']));
                    
                    if($odMonth == $doMonth){ ?>
                        if(date.getFullYear() == <?php echo($odYear); ?> &&  date.getMonth() == <?php echo($odMonth); ?>){
                            <?php for($d = $odDay; $d <= $doDay; $d++){ ?>
                                if(prevLastDay - j + 1 == <?php echo($d); ?>){
                                    days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${prevLastDay - j + 1}</a></div>`);
                                    n = prevLastDay - j + 1;
                                }
                            <?php } ?>
                        }
                    <?php } else if($odMonth != $doMonth && $odYear == $doYear){ ?>
                            if(date.getFullYear() == <?php echo($odYear); ?> &&  date.getMonth() == <?php echo($odMonth); ?>){
                                if(date.getMonth() + 1 == <?php echo($doMonth); ?>){
                                    for(d = <?php echo($odDay); ?>; d <= prevLastDay; d++){
                                        if(prevLastDay - j + 1 == d){
                                            days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${prevLastDay - j + 1}</a></div>`);
                                            n = prevLastDay - j + 1;
                                        }
                                    }
                                }
                            }
                    <?php } else if($odYear != $doYear && $odMonth - $doMonth == 11){ ?>
                            if(date.getFullYear() == <?php echo($odYear); ?> + 1 && date.getMonth() == 0){
                                for(d = <?php echo($odDay); ?>; d <= prevLastDay; d++){
                                    if(prevLastDay - j + 1 == d){
                                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${prevLastDay - j + 1}</a></div>`);
                                        n = prevLastDay - j + 1;  
                                    }
                                }
                            }
                    <?php } 
                }?>
                if(n != prevLastDay - j + 1){
                    days.push(`<div class="next-date col-span-1 flex justify-center items-center h-9 opacity-50 rounded-lg hover:bg-blue-800">${prevLastDay - j + 1}</div>`);
                }
            }

            // aktualny mesiac
            for(let j = 1; j <= lastDay; j++){
                <?php foreach($resultCal as $res){
                $odDay = date('d', strtotime($res['od']));
                $doDay = date('d', strtotime($res['do']));
                $odMonth = date('m', strtotime($res['od']));
                $doMonth = date('m', strtotime($res['do']));
                $odYear = date('Y', strtotime($res['od']));
                $doYear = date('Y', strtotime($res['do']));

                    if($odMonth == $doMonth){ ?>
                        if(date.getFullYear() == <?php echo($odYear); ?> &&  date.getMonth() + 1 == <?php echo($odMonth); ?>){
                            <?php for($d = $odDay; $d <= $doDay; $d++){ ?>
                                if(j == <?php echo($d); ?>){
                                    if(j == new Date().getDate()){
                                        days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j;
                                    } else{
                                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j;
                                    }
                                }
                            <? } ?> 
                        }
                    <?php }

                    if($odMonth + 1 == $doMonth){ ?>
                        if(date.getFullYear() == <?php echo($odYear); ?>){
                            if(date.getMonth() + 1 == <?php echo($odMonth); ?>){
                                for(let d = <?php echo($odDay); ?>; d <= lastDay; d++){
                                    if(j == d){
                                        if(j == new Date().getDate()){
                                            days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;
                                        } else{
                                            
                                            days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;
                                        }
                                    }
                                }
                            }
                            if(date.getMonth() == <?php echo($odMonth); ?>){
                                for(let d = 1; d <= <?php echo($doDay); ?>; d++){
                                    if(j == d){
                                        if(j == new Date().getDate()){
                                            days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;
                                        } else{                                     
                                            days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;
                                        }
                                    }
                                }
                            }
                        }
                    <?php }
                    if($odYear != $doYear){?>
                        if(date.getMonth() + 1 == <?php echo($odMonth); ?>){
                                for(let d = <?php echo($odDay); ?>; d <= lastDay; d++){
                                    if(j == d){
                                        if(j == new Date().getDate()){                                           
                                            days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;  
                                        } else{
                                            days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                            n = j;
                                        }
                                    }
                                }
                            }
                        if(date.getFullYear() == <?php echo($odYear); ?> + 1 && date.getMonth() == 0){
                            for(d = 1; d <= <?php echo($doDay); ?>; d++){
                                if(j == d){
                                    if(j == new Date().getDate()){                                
                                        days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j;
                                    } else{                                     
                                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j; 
                                    }
                                }
                            }
                        }
                    <?php }
                } ?>
                if(j != n){   
                    if(j == new Date().getDate() && date.getMonth() == new Date().getMonth()){
                        if(new Date().getFullYear() == date.getFullYear()){                    
                            days.push(`<div class="col-span-1 flex justify-center items-center h-9 rounded-lg border-2 border-white hover:bg-blue-800">${j}</div>`); 
                        }
                    } else{
                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg border-2 hover:bg-blue-800">${j}</div>`);
                    }
                }
            }

            // buduci mesiac
            for(let j = 1; j <= nextDays; j++){
                <?php foreach($resultCal as $res){
                    $odDay = date('d', strtotime($res['od']));
                    $doDay = date('d', strtotime($res['do']));
                    $odMonth = date('m', strtotime($res['od']));
                    $doMonth = date('m', strtotime($res['do']));
                    $odYear = date('Y', strtotime($res['od']));
                    $doYear = date('Y', strtotime($res['do']));
                    
                    if($odMonth == $doMonth){ ?>
                        if(date.getFullYear() == <?php echo($odYear); ?> &&  date.getMonth() + 2 == <?php echo($odMonth); ?>){
                            <?php for($d = $odDay; $d <= $doDay; $d++){ ?>
                                if(j == <?php echo($d); ?>){
                                    days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                    n = j;
                                }
                            <? } ?> 
                        }
                    <?php } else if($odMonth != $doMonth && $odYear == $doYear){ ?>
                        if(date.getFullYear() == <?php echo($odYear); ?> && date.getMonth() + 1 == <?php echo($odMonth); ?>){ 
                            if(date.getMonth() + 2 == <?php echo($doMonth); ?>){
                                if(<?php echo($doDay); ?> > nextDays){ remain = nextDays; } 
                                else{ remain = <?php echo($doDay); ?>}
                                for(d = 1; d <= remain; d++){
                                    if(j == d){
                                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j;
                                    }
                                }
                            }
                        }
                    <?php } else if($odYear != $doYear){?>
                        if(<?php echo($odYear); ?> == date.getFullYear() && <?php echo($doYear); ?> == date.getFullYear() + 1){
                            if(date.getMonth() + 1 == <?php echo($odMonth); ?> && 1 == <?php echo($doMonth); ?>){
                                if(<?php echo($doDay); ?> > nextDays){ remain = nextDays; } 
                                else{ remain = <?php echo($doDay); ?>}
                                for(d = 1; d <= remain; d++){
                                    if(j == d){
                                        days.push(`<div class="border-none col-span-1 flex justify-center items-center h-9 rounded-lg bg-red-800 hover:bg-red-600 opacity-50"><a target="_blank" class="w-full h-full flex justify-center items-center" href="<?php echo($res['link']); ?>">${j}</a></div>`);
                                        n = j;
                                    }
                                }
                            }
                        }
                    <?php }
                }?>
                if(j != n){
                    days.push(`<div class="next-date col-span-1 flex justify-center items-center h-9 opacity-50 rounded-lg hover:bg-blue-800">${j}</div>`);
                }
            }

            for(let j = 0; j < days.length; j++){
                    finalDays += days[j];
            }

            monthDays.innerHTML = finalDays;
            console.log(' ');
        };
        
        // ak kliknem na prev tak sa posuniem o jeden mesiac dozadu 
        document.querySelector(".prev").addEventListener("click", () => {
            date.setMonth(date.getMonth() - 1);
            renderCalendar();
        });

        // ak kliknem na prev tak sa posuniem o jeden mesiac dopredu 
        document.querySelector(".next").addEventListener("click", () => {
            date.setMonth(date.getMonth() + 1);
            renderCalendar();
        });
        
        renderCalendar();
    </script>
</section>
    
<!-- social media -->
<section class="relative w-11/12 mx-auto overflow-hidden mb-11">
    <h2 class="text-indigo-900 text-5xl font-semibold pb-10">Sociálne siete</h2>
    <ul class="md:grid grid-cols-8 gap-20 lg:gap-1">
        <li class="relative col-span-8 md:col-span-4 xl:col-span-3 mx-auto sm:mx-0 cursor-pointer mb-10 md:mb-0">
            <div class="fb-page" data-href="https://www.facebook.com/K2.Piestany/" data-tabs="timeline" data-width="380" data-height="485" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/K2.Piestany/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/K2.Piestany/">Kajak-Kanoe Piešťany</a></blockquote></div>
        </li>
        <li class="relative col-span-8 md:col-span-4 xl:col-span-5">
            <!-- instagram -->
            <!-- LightWidget WIDGET -->
            <div class="max-h-108 overflow-y-scroll">
                <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
                <iframe src="https://cdn.lightwidget.com/widgets/b07f80bfb7e05282ac39d77764c1f49d.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
            </div>
        </li>
    </ul>   
</section>
