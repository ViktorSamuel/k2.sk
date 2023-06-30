<?php

    $err = '';

    if(isset($_POST['submit'])){

        if($_POST['Title'] && $_POST['Main']){
            $Title = test_in($con, $_POST['Title']);
            $Main = $_POST['Main'];
        } else{
            $err= '<p class="text-red-900">Musíš vyplniť všetký polia</p>';
        }

        if($_FILES['Image']['name']){
            $img_name = $_FILES['Image']['name'];
            $tmp_name = $_FILES['Image']['tmp_name'];
            $Foldar = './img/'.$img_name;
            move_uploaded_file($tmp_name, $Foldar);
        }else{
            $err = '<p class="text-red-900">Musíš vyplniť všetký polia</p>';
        }

        if($_POST['Articel']){
            $Articel = $_POST['Articel'];
        }

        if($_FILES['Field']['name']){
            $doc_name = $_FILES['Field']['name'];
            $tmp_name = $_FILES['Field']['tmp_name'];
            $Document = './fields/'.$doc_name;
            move_uploaded_file($tmp_name, $Document);
        }
        
        
        $Date = date("Y/m/d");
        
        if(!$err){
            $addToDb = "INSERT INTO clanky(Title,Main,Articel,Img,Date,Document) VALUES('$Title','$Main','$Articel','$Foldar','$Date','$Document')";
            $res = mysqli_query($con, $addToDb);
            if($res){
                echo "<p class='text-2xl'>Príspevok bol pridaný</p>";
                mysqli_close($con);  
            } else{
                echo('mame problema');
            }
        }
    }

?>

<main class="w-full bg-gray-200 pb-5 py-6">
    <form class="w-11/12 sm:8/12 md:w-1/2 relative left-1/2 transform -translate-x-1/2" action="index.php?str=news&clan=add" method="post" enctype="multipart/form-data">
        <h3 class="font-semibold text-2xl">Pri každom článku je potrebné vyplniť: Nadpis, hlavnú časť a obrázok. Ak sa nič nepíše do políčka "text článku", tak toto políčko je potrebné vyprázdniť.</h3>
        <textarea class="w-full my-4 p-2 block" name="Title" id="Tile" cols="75" rows="2" placeholder="Nadpis"></textarea>
        <span><?php echo($err); ?></span>
        <div class="w-full my-4 p-2 block">
            <label for="Image">Vyber obrázok</label>
            <input type="file" name='Image' id="Image">
            <span><?php echo($err); ?></span>
        </div>
        <div class="w-full my-4 p-2 block">
            <label for="Field">Vyber súbor</label>
            <input type="file" name='Field' id="Field">
            <span><?php echo($err); ?></span>
        </div>
        <textarea class="w-full my-4 p-2 block" name="Main" id="Main" cols="75" rows="4" placeholder="Hlavná časť"></textarea>
        <span><?php echo($err); ?></span>
        <label class="mt-4 mb-0" for="Articel">Text článku: (značky v poli použi pre každý nový odstavec)</label>
        <textarea class="w-full mb-4 mt-0 p-2 block" name="Articel" id="Articel" cols="75" rows="10" ><?php echo ' <p class="my-4"> Sem prvý odstavec </p>'.PHP_EOL.' <p class="my-4"> Sem druhý odstavec </p>'; ?> </textarea>
        <span><?php echo($err); ?></span>
        <input class="w-full bg-gray-50 border border-black rounded-lg p-3 text-lg" name="submit" type="submit" value="Pridať">
    </form>
</main>