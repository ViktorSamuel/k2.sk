<?php 
    if(isset($_POST['deleteArt'])){
        $table=test_in($con,$_GET['clen']);
        $del="DELETE FROM $table WHERE ID=".test_in($con,$_GET['ID'])."";$result=mysqli_query($con,$del);
        header('location:index.php?str=nastim&clen='.$table.'');
    } else{ 
        ?>
        <form action="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>&action=delete&ID=<?php echo($_GET['ID']); ?>"class="absolute -translate-x-1/2 -translate-y-1/2 bg-gray-100 border border-black h-40 left-1/2 p-6 rounded-xl top-1/2 transform w-96 z-10"method="post">
            <h3 class="font-semibold mb-4 text-2xl text-indigo-900">Chcete naozaj zmazať tohto člena?</h3>

            <a class="font-semibold p-1 rounded-lg bg-green-800 text-black"href="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>">Nie, nechcem</a> 
            <input class="absolute bg-red-700 font-semibold p-1 right-6 rounded-lg text-gray-50"id="deleteArt"name="deleteArt"type="submit"value="Áno, chcem"> 
            <a class="absolute h-8 right-2 top-2 w-8"href="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>">
                <img alt="Krížik"src="./img/crossIcon.png">
            </a>
        </form>
    <?php } ?>