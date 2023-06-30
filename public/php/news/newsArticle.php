<?php 
    $selc="SELECT * FROM clanky WHERE ID=".test_in($con,$_GET['clan'])."";
    $res=mysqli_query($con,$selc);
    $dbData=mysqli_fetch_array($res); 
?>

<main class="py-6 bg-gray-200 pb-5 w-full">
    <article class="mx-auto w-11/12 bg-white lg:w-9/12 px-4">
        <h1 class="font-bold py-3 text-4xl text-blue-600"><?php echo($dbData['Title']); ?></h1>
        <h2 class="font-bold leading-6 py-6 text-lg"><?php echo($dbData['Main']); ?></h2>
        
        <img alt="Piešťanci na majstrovstvách Európy"class="mx-auto"src="<?php echo($dbData['Img']); ?>">
        
        <section class="mx-auto w-11/12 font-medium py-4">
            <?php echo($dbData['Articel']); ?>
        </section>
    </article>
</main>