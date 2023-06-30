<?php

$err = '';

$table = $_GET['clen'];

$sel = "SELECT * FROM $table WHERE ID=".test_in($con, $_GET['ID'])."";
$quer = mysqli_query($con, $sel);
$dbData = mysqli_fetch_array($quer);
$id = $_GET['ID'];

if($table != 'registrovany'){

    if(isset($_POST['editArt'])){
        
        $newFirstName = test_in($con, $_POST['newFirstName']);
        $newLastName = $_POST['newLastName'];

        if($newFirstName && $newLastName){
            if($_POST['newDiscipline'] != '0'){
                $newDiscipline = test_in($con, $_POST['newDiscipline']);
            } else{
                $newDiscipline = $dbData['Disciplina'];
            }
            

            if($newDiscipline == 'Tréner'){
                $tableNew = 'treneri';

                if($newDiscipline == $dbData['Disciplina']){
                    $editDb = "UPDATE $tableNew SET Meno='$newFirstName', Priezvisko='$newLastName', Disciplina='$newDiscipline' WHERE ID = '$id'";
                    $res = mysqli_query($con, $editDb);
                        if($res){
                            header('location:index.php?str=nastim&clen=treneri');
                            mysqli_close($con);  
                        } else{
                            echo('mame problema');
                        }
                }
                if($newDiscipline != $dbData['Disciplina']){
                    $del = "DELETE FROM sportovci WHERE ID=".test_in($con, $_GET['ID'])."";
                    $result = mysqli_query($con, $del);

                    $inser = "INSERT INTO $tableNew(Meno,Priezvisko,Disciplina) VALUES('$newFirstName','$newLastName','$newDiscipline')";
                    $add = mysqli_query($con, $inser);
                        if($add){
                            header('location:index.php?str=nastim&clen=treneri');
                            mysqli_close($con);  
                        } else{
                            echo('mame problema');
                        }
                }
            } else{
                $tableNew = 'sportovci';

                if($dbData['Disciplina'] == 'Kajak' || $dbData['Disciplina'] == 'Canoe'){
                    $editDb = "UPDATE $tableNew SET Meno='$newFirstName', Priezvisko='$newLastName', Disciplina='$newDiscipline' WHERE ID = '$id'";
                    $res = mysqli_query($con, $editDb);
                        if($res){
                            header('location:index.php?str=nastim&clen=sportovci');
                            mysqli_close($con);  
                        } else{
                            echo('mame problema');
                        }
                }

                if($dbData['Disciplina'] == 'Tréner'){
                    $del = "DELETE FROM treneri WHERE ID=".test_in($con, $_GET['ID'])."";
                    $result = mysqli_query($con, $del);

                    $inser = "INSERT INTO $tableNew(Meno,Priezvisko,Disciplina) VALUES('$newFirstName','$newLastName','$newDiscipline')";
                    $add = mysqli_query($con, $inser);
                        if($add){
                            header('location:index.php?str=nastim&clen=sportovci');
                            mysqli_close($con);  
                        } else{
                            echo('mame problema');
                        }
                }
            }
        } else{
            $err ='Musíš vyplnit všetky polia';
        }
    }

    ?>

    <form action="index.php?str=nastim&clen=<?php echo($_GET['clen']); ?>&action=edit&ID=<?php echo($_GET['ID']); ?>" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-auto border border-black rounded-xl bg-gray-100 z-10 p-6">
        <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Editácia členov</h3>  
        <h4 class='text-2xl font-semibold text-red-900 mb-4'><?php echo($err); ?></h4>

        <label class="block font-semibold" for="newFirstName">Pôvodné meno:</label>
        <input class="block mb-4" type="text" name="newFirstName" id="newFirstName" value="<?php echo($dbData['Meno']); ?>">  

        <label class="block font-semibold" for="newLastName">Pôvodné priezvisko:</label>
        <input class="block mb-4" type="text" name="newLastName" id="newLastName" value="<?php echo($dbData['Priezvisko']); ?>">  

        <p class="block font-semibold mb-4" for="newDiscipline">Pôvodná disciplína: <?php echo($dbData['Disciplina']); ?></p>

        <label class="font-semibold" for="newDiscipline">Nová disciplína:</label>
        <select id="newDiscipline" name="newDiscipline">
            <option value="0">-Vyber disciplínu-</option>
            <option value="Kajak">Kajak</option>
            <option value="Canoe">Canoe</option>
            <option value="Tréner">Tréner</option>
        </select>

        <input type="submit" name="editArt" id="editArt" value="Upraviť" class="block mx-auto my-6 p-1 w-11/12 rounded-lg bg-red-700 text-gray-50 font-semibold">
        
        <a class="absolute top-2 right-2 w-8 h-8" href="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>"><img src="./img/crossIcon.png" alt="Krížik"></a>
    </form>

<?php 

}

if($table == 'registrovany'){

    $ERRusername = $ERRpassword = '';
    
    if($dbData['Password'] === sha1($_SESSION['Password']) && $dbData['Username'] === $_SESSION['Username']){
        if(isset($_POST['editArt'])){
            if($_POST["newUsername"]){
                if(name_validation($_POST["newUsername"])){
                    $newUsername = test_in($con, $_POST["newUsername"]);
                } else{
                    $ERRusername = "Meno musi mat minimale 4 znaky!";
                }
            } else{
                $ERRusername = "Meno musi mat minimale 4 znaky!";
            }
            if($_POST["newPassword"]){
                if(pass_validation($_POST["newPassword"])){
                    $newPassword = sha1($_POST["newPassword"]);
                } else{
                    $ERRpassword = "Heslo musi mat minimale 4 znaky, obsahovať aspoň jedno číslo, malé a veľké písmeno";
                }
            } else{
                $newPassword = $_SESSION['Password'];
            }
            if($_POST['newRole'] == '0'){
                $newRole = $dbData['Role']; 
            } else{
                $newRole = $_POST['newRole'];
            }
    
            if(!$ERRusername && !$ERRpassword){
                $editDb = "UPDATE $table SET Username='$newUsername', Password='$newPassword', Role='$newRole' WHERE ID = '$id'";
                $res = mysqli_query($con, $editDb);
                if($res){
                    header('location:index.php?str=nastim&clen=registrovany');
                    mysqli_close($con);  
                } else{
                    echo('mame problema');
                }
            }
        }
        ?>
        <form action="index.php?str=nastim&clen=<?php echo($_GET['clen']); ?>&action=edit&ID=<?php echo($_GET['ID']); ?>" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-auto border border-black rounded-xl bg-gray-100 z-10 p-6">
            <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Editácia použivateľov</h3>  
            <h4 class='text-2xl font-semibold text-red-900 mb-4'><?php echo($err); ?></h4>

            <label class="block font-semibold" for="newUsername">Použivateľské meno:</label>
            <input class="block mb-4 w-52" type="text" name="newUsername" id="newUsername" value="<?php echo($dbData['Username']); ?>">  
            <span class="block p-3 text-red-700"> <?php echo $ERRusername;?> </span>

            <p class="block font-semibold mb-4" for="newRole">Pôvodné oprávnenie: <?php echo($dbData['Role']); ?></p>

            <label class="font-semibold" for="newRole">Nové oprávnenie:</label>
            <select class="mb-4" id="newRole" name="newRole">
                <option value="0">-Vyber oprávnenie-</option>
                <option value="None">None</option>
                <option value="Editor">Editor</option>
            </select>

            <label class="block font-semibold" for="newPassword">Ak si chceš upraviť svoje heslo, tak sem zadaj nové:</label> 
            <input class="block mb-4" type="Password" name="newPassword" id="newPassword" placeholder="Tvoje nové heslo">  
            <span class="block p-3 text-red-700"> <?php echo $ERRpassword;?> </span>

            <input type="submit" name="editArt" id="editArt" value="Upraviť" class="block mx-auto my-6 p-1 w-11/12 rounded-lg bg-red-700 text-gray-50 font-semibold">
            
            <a class="absolute top-2 right-2 w-8 h-8" href="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>"><img src="./img/crossIcon.png" alt="Krížik"></a>
        </form>
        <?php
    } else{
        if(isset($_POST['editArt'])){
            if($_POST['newRole'] == '0'){
                $newRole = $dbData['Role']; 
            } else{
                $newRole = $_POST['newRole'];
            }
        
            if($newRole){
                $editDb = "UPDATE $table SET Role='$newRole' WHERE ID = '$id'";
                $res = mysqli_query($con, $editDb);
                if($res){
                    header('location:index.php?str=nastim&clen=registrovany');
                    mysqli_close($con);  
                } else{
                    echo('mame problema');
                }
            }
        }
        ?>
        <form action="index.php?str=nastim&clen=<?php echo($_GET['clen']); ?>&action=edit&ID=<?php echo($_GET['ID']); ?>" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-auto border border-black rounded-xl bg-gray-100 z-10 p-6">
            <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Editácia použivateľov</h3>  
            <h5 class="block mb-4 font-semibold"><?php echo($dbData['Username']); ?></h5>

            <p class="block font-semibold mb-4" for="newRole">Pôvodné oprávnenie: <?php echo($dbData['Role']); ?></p>

            <label class="font-semibold" for="newRole">Nové oprávnenie:</label>
            <select id="newRole" name="newRole">
                <option value="0">-Vyber oprávnenie-</option>
                <option value="None">None</option>
                <option value="Editor">Editor</option>
            </select>

            <input type="submit" name="editArt" id="editArt" value="Upraviť" class="block mx-auto my-6 p-1 w-11/12 rounded-lg bg-red-700 text-gray-50 font-semibold">
            
            <a class="absolute top-2 right-2 w-8 h-8" href="index.php?str=nastim&clen=<?php echo($_GET['clen']) ?>"><img src="./img/crossIcon.png" alt="Krížik"></a>
        </form>
        <?php
    }
}