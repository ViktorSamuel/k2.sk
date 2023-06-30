<div>
    <?php
        if(isset($_GET['clan']) == 'delete'){
            include 'deleteArticel.php';
        }
    ?>
</div>

<section class="w-full px-4 md:w-11/12 md:mx-auto md:px-0 py-6">
    <ul class="w-full grid grid-cols-12 gap-4 listOfNews">
        <?php

            $deleteBut = "";
            $editBut = "";

            if(isset($_SESSION['Username']) && isset($_SESSION['Password'])){
                echo('<li class="col-span-12 sm:col-span-6 lg:col-span-4 group cursor-pointer border border-black relative">
                <a href="index.php?str=news&clan=add" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full plus alt">Pridať nový článok</a>
                </li>');
            }

            $sel = "SELECT * FROM clanky";
            $query = mysqli_query($con, $sel);

            $select = "SELECT * FROM clanky ORDER BY Date DESC";
            $result = mysqli_query($con, $select);

            foreach($result as $q){ ?>
                <li class="col-span-12 sm:col-span-6 lg:col-span-4 group cursor-pointer">
                    <a href="index.php?str=news&clan=<?php echo($q['ID']); ?>">
                        <section class="h-48 w-full overflow-hidden bg-black">
                        <img class="min-h-full object-cover transform group-hover:scale-110 group-hover:opacity-90 transition duration-300 ease-in" src="<?php echo($q["Img"]); ?>" alt="">
                        </section>
                        <section class=" h-auto w-full p-3 bg-white group-hover:bg-black transition duration-300 ease-in">
                            <h2 class="text-2xl font-semibold text-gray-900 group-hover:text-yellow-500 transition duration-300 ease-in"><?php echo($q["Title"]); ?></h2>
                            <p class="text-black group-hover:text-green-50"><?php echo(words($q["Main"])); ?>...</p>
                            <span class="flex justify-end pt-2 text-gray-800 group-hover:text-green-50 transition duration-300 ease-in font-normal"><?php echo($q["Date"]); ?></span>
                            <?php
                                if(isset($_SESSION['Username']) && isset($_SESSION['Password'])){ ?>
                                <a class="w-8 h-4 mr-4 px-2 py-0.5 text-base text-black bg-gray-300 border border-black rounded-lg delBtn" href="index.php?str=news&clan=delete&ID=<?php echo($q['ID']); ?>">Zmaž článok</a>
                                <a class="w-8 h-4 mr-4 px-2 py-0.5 text-base text-black bg-gray-300 border border-black rounded-lg" href="index.php?str=news&clan=edit&ID=<?php echo($q['ID']); ?>">Edituj článok</a>
                            <?php } ?>
                        </section>
                    </a>
                </li>
        <?php } ?>
    </ul>
</section>