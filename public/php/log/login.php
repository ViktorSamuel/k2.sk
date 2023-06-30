<?php 
    $ERRUsername=$ERRPassword="";
    
    if(isset($_POST["login"])){
        if(!$_POST["Username"]){
            $ERRUsername="Meno je potrebné vyplniť!";
        }
        
        if(!$_POST["Password"]){
            $ERRPassword="Zadajte heslo!";
        }
        
        if(!$ERRUsername&&!$ERRPassword){
            $Username=test_in($con,$_POST["Username"]);
            $Password=test_in($con,$_POST["Password"]);
            $query="SELECT * FROM registrovany WHERE Username='$Username'";
            $selected=mysqli_query($con,$query);
            $numOf=mysqli_num_rows($selected);
            
            if($numOf==0){
                $ERRUsername="Použivateľ neexistuje, zaregistrujte sa prosím";
            } elseif($numOf==1){
                $row=mysqli_fetch_array($selected);
                $pswd=sha1($Password);
                
                if($row['Username']===$_POST["Username"]&&$pswd===$row['Password']){
                    if($row["Role"]==='Editor'){
                        $_SESSION["Username"]=$_POST["Username"];
                        $_SESSION["Password"]=$Password;
                        $_SESSION["Role"]=$row["Role"];
                        header("location: index.php");
                    } else{
                        $ERRPassword="Ste úspešne zaregistrovaný, prosím počkajte kým vám aktuálny editory povolia prístup.";
                    }
                } else{
                    $ERRPassword="Nesprávne prihlasovacie údaje!";
                }
            }
        }
    } ?>
    
    <div>
        <p class="inline">Ak ešte niesi zaregistrovaný sprav tak:</p>
        <a class="cursor-pointer font-semibold hover:text-indigo-600 p-2 text-blue-900 underline"href="index.php?str=sign">Tu...</a>
    </div>
    
    <form action="index.php?str=login"method="post">
        <p>
            <input class="block border border-black m-8"name="Username"id="Username"placeholder="Zadaj meno"size="25"autofocus> 
            <span class="error"><?php echo $ERRUsername; ?></span>
        </p>
        <p>
            <input class="block border border-black m-8"name="Password"id="Password"placeholder="Zadaj heslo"size="25"type="Password"> 
            <span class="error"><?php echo $ERRPassword; ?></span>
        </p>
        <p>
            <input class="block border border-black m-8"name="login"type="submit"value="Prihlásiť">
        </p>
    </form>