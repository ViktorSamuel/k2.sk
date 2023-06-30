<?php

if(isset($_POST['deleteArt'])){
    $sel = "SELECT Img FROM clanky WHERE ID=".test_in($con, $_GET['ID'])."";
    $qur = mysqli_query($con, $sel);
    $db = mysqli_fetch_array($qur);

    unlink($db['Img']);
    unlink($db['Document']);

    $del = "DELETE FROM clanky WHERE ID=".test_in($con, $_GET['ID'])."";
    $result = mysqli_query($con, $del);

    header('location:index.php?str=news');
}

?>
    
<form action="index.php?str=news&clan=delete&ID=<?php echo($_GET['ID']); ?>" method="post" class="delAlr absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-56 border border-black rounded-xl bg-gray-100 z-10 p-6">
    <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Chcete naozaj zmazať tento článok?</h3>
    <h4 class="mb-3">Zmazaním tohto článku sa odstráni zároveň aj jeho obrázok, prípadne aj dokumet, ak nejaký obsahuje.</h4>    
    <a class="p-1 rounded-lg bg-green-800 text-black font-semibold" href="index.php?str=news">Nie, nechcem</a>
    <input type="submit" name="deleteArt" id="deleteArt" value="Áno, chcem" class="absolute p-1 rounded-lg bg-red-700 text-gray-50 font-semibold right-6">
    <a class="absolute top-2 right-2 w-8 h-8" href="index.php?str=news"><img src="./img/crossIcon.png" alt="Krížik"></a>
</form>
