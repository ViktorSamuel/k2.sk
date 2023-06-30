<section class="w-full bg-black overflow-hidden h-96 relative">
  <gallery class="w-full h-full block mySwiper opacity-40 swiper-container">
    <ul class="w-full swiper-wrapper">
      <?php
      $selec = "SELECT * FROM clanky ORDER BY Date DESC LIMIT 3";
      $result = mysqli_query($con, $selec);
      foreach ($result as $re) {
      ?>
        <li class="w-full bg-black overflow-hidden flex group items-start justify-center swiper-slide">
          <img alt="Obrázok kajakára" class="w-full h-full object-cover opacity-80" src="<?php echo ($re["Img"]); ?>">
        </li>
      <?php } ?>
    </ul>
    <a class="invisible sm:visible swiper-button-next"></a>
    <a class="invisible sm:visible swiper-button-prev"></a>
  </gallery>
  <h1 class="-translate-x-1/2 -translate-y-1/2 absolute font-semibold left-1/2 text-5xl text-white top-1/2 transform">
    <?php
    switch ($_GET['str']) {
      case "news":
        echo ('Aktuality');
        break;
      case "onas":
        echo ('O nás');
        break;
      case "nastim":
        echo ('Náš tím');
        break;
      case "kontakt":
        echo ('Kontakt');
        break;
    }
    ?>
  </h1>
</section>
