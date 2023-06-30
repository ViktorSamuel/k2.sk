<?php

$err = '';

$selc = "SELECT * FROM clanky WHERE ID=".test_in($con, $_GET['ID'])."";
$res = mysqli_query($con, $selc);
$dbData = mysqli_fetch_array($res);

if(isset($_POST['edit'])){
    if($_POST['Title'] && $_POST['Main']){
        $ID = test_in($con, $_GET['ID']);
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
        unlink($dbData['Img']);
    }else{
        $Foldar = $dbData['Img'];
    }

    if($_POST['Articel']){
        $Articel = $_POST['Articel'];
    }else{
        $Articel ='';
    }

    if($_FILES['Field']['name']){
        $doc_name = $_FILES['Field']['name'];
        $tmp_name = $_FILES['Field']['tmp_name'];
        $Document = './fields/'.$doc_name;
        move_uploaded_file($tmp_name, $Document);
        unlink($dbData['Document']);
    }else{
        $Document = $dbData['Document'];
    }
    
    $Date = date("Y/m/d");
    
    if(!$err){
        $editDb = "UPDATE clanky SET Title='$Title', Main='$Main', Articel='$Articel', Img='$Foldar', Document='$Document' WHERE ID = '$ID'";
        $res = mysqli_query($con, $editDb);
        if($res){
            header('location:index.php?str=news');
            mysqli_close($con);  
        } else{
            echo('mame problema');
        }
    }
}

?>

<main class="w-full bg-gray-200 pb-5 py-6">
    <form class="w-11/12 sm:8/12 md:w-1/2 relative left-1/2 transform -translate-x-1/2" action="index.php?str=news&clan=edit&ID=<?php echo($_GET['ID']); ?>" method="post" enctype="multipart/form-data">
        <label class="text-lg font-semibold" for="Title">Nadpis</label>
        <textarea class="w-full my-4 p-2 block" name="Title" id="Title" cols="75" rows="2"><?php echo($dbData['Title']); ?></textarea>
        <span><?php echo($err); ?></span>
        <div class="w-full my-4 p-2 block">
            <h3 class="text-lg font-semibold">Starý obrázok:</h3>
            <p class="py-1">Ak nevyberieš nový obrázok / súbor tak sa ponechá starý.</p>
            <img src="<?php echo($dbData['Img']) ?>">
        </div>
        <div class="w-full my-4 p-2 block">
            <label for="Image">Vyber nový obrázok</label>
            <input type="file" name='Image' id="Image">
        </div>
        <div class="w-full my-4 p-2 block">
            <label for="Field">Vyber súbor</label>
            <input type="file" name='Field' id="Field">
        </div>
        <label class="text-lg font-semibold" for="Main">Hlavná časť</label>
        <textarea class="w-full my-4 p-2 block" name="Main" id="Main" cols="75" rows="4"><?php echo($dbData['Main']); ?></textarea>
        <span><?php echo($err); ?></span>
        <label class="text-lg font-semibold" for="Articel">Text článku</label>
        <textarea class="w-full my-4 p-2 block" name="Articel" id="Articel" cols="75" rows="10"><?php echo($dbData['Articel']); ?></textarea>
        <input class="cursor-pointer w-full bg-gray-50 border border-black rounded-lg p-3 text-lg" name="edit" type="submit" value="Uprav">
    </form>
</main>
