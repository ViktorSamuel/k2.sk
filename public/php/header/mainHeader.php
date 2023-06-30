<!-- Swiper / Slide show --> 
<section class="h-screen overflow-hidden">
    <gallery class="swiper-container mySwiper block h-5/6 lg:h-4/5">
        <ul class="swiper-wrapper w-full">
        <?php 

            $sele = "SELECT * FROM clanky";
            $quer = mysqli_query($con, $sele);

            $numberOfItems = 3;

            $selec = "SELECT * FROM clanky ORDER BY Date DESC LIMIT $numberOfItems";
            $resul = mysqli_query($con, $selec);

            foreach($resul as $re){ ?>
                <li class="swiper-slide group flex justify-center items-start w-full bg-black overflow-hidden">
                    <a href="index.php?str=news&clan=<?php echo($re["ID"]);?> " class="h-full w-full group-hover:opacity-95 transform group-hover:scale-105 transition duration-300">
                        <img class="h-full w-full opacity-80 object-cover" src="<?php echo($re["Img"]); ?>" alt="Obrázok kajakára">
                        <a href="index.php?str=news&clan=<?php echo($re["ID"]) ?>" class="-translate-x-1/2 -translate-y-1/2 absolute left-1/2 top-1/2 transform text-center font-sans text-3xl lg:text-4xl xl:text-5xl font-bold text-gray-50 uppercase"><?php echo($re["Title"]); ?></a>
                    </a>
                </li>

        <?php } ?>
        </ul>
        <a class="swiper-button-next invisible sm:visible"></a>
        <a class="swiper-button-prev invisible sm:visible"></a>
    </gallery>
</section> 

