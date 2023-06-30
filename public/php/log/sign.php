<?php
$ERRpassword = $ERRpassword1 = $ERRusername = "";

if(isset($_POST["sign"])){

    if(!name_validation($_POST["Username"])){
        $ERRusername = "Meno musi mat minimale 4 znaky!";
    }

    if(!pass_validation($_POST["Password"])){
        $ERRpassword = "Heslo musi mat minimale 4 znaky, obsahovať aspoň jedno číslo, malé a veľké písmeno";
    }
    
    if (!$_POST["Password1"]){
        $ERRpassword1 = "Zadajte overovacie heslo!";
    } elseif($_POST["Password"] != $_POST["Password1"]) {
        $ERRpassword1 = "Heslá sa nezhodujú!";
    }

    if(!$ERRusername && !$ERRpassword && !$ERRpassword1){
        $username = test_in($con, $_POST["Username"]);
        $password = test_in($con, $_POST["Password"]);

        $select = "select * from registrovany where Username='".$username."'";
        $result = mysqli_query($con, $select);
        $numOf = mysqli_num_rows($result);

        if($numOf == 0){
            $pswd = sha1($password);
            $addToDb = "INSERT INTO registrovany(Username,Password,Role) VALUES('$username','$pswd','None')";
            $res = mysqli_query($con, $addToDb);
                if($res){
                    echo "<p class='text-xl font-semibold'>Ďakujeme za vašu registráciu, prosím počkajte kým vám aktuálny editory povolia prístup</p>
                    <a class='text-blue-900 font-semibold underline cursor-pointer p-2 hover:text-indigo-600' href='index.php?str=login'>Klikni sem pre presmerovanie na prihlásenie</a>";
                    mysqli_close($con);  
                } else{
                    die("<p>Vaša registracia sa nepodarila");
                }
        } else{
            $ERRusername = "Toto meno sa už používa, vymysli iné";
        }
    }
}
?>


<section class="m-8">

    <form action="index.php?str=sign" method="post">
        <p class="py-3 text-lg">
            <label for="Username">Meno: </label>
            <input type="text" name="Username" id="Username" size="25" value="<?php if(isset($_POST["sign"])) echo $_POST["Username"]; ?>" placeholder="Zadaj meno">
            <span class="block p-3 text-red-700"> <?php echo $ERRusername;?> </span>
        </p>
            
        <p class="py-3 text-lg">
            <label for="Password">Heslo: </label>
            <input type="Password" name="Password" id="Password" size="25" placeholder="Zadaj heslo">
            <span class="block p-3 text-red-700"> <?php echo $ERRpassword;?> </span>
        </p>
        
        <p class="py-3 text-lg">
            <label for="Password1">Overiť Heslo: </label>
            <input type="Password" name="Password1" id="Password1" size="25" placeholder="Znova zadaj heslo">
            <span class="block p-3 text-red-700"> <?php echo $ERRpassword1;?> </span>
        </p>
        
        <p class="py-3 text-lg">
            <input class="px-2 py-1 border border-black rounded-lg bg-gray-50 cursor-pointer hover:bg-gray-500" type="submit" name="sign" value="Registrovať">
        </p>
    </form>
</section>