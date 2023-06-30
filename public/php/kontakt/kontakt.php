<?php 
$err='';

if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
    if(isset($_POST['edit'])){

        if($_POST['Nazov']&&$_POST['Adresa']){
            $Nazov=test_in($con,$_POST['Nazov']);
            $Adresa=test_in($con,$_POST['Adresa']);
        } else{
            $err='Musíš vypnliť všetky polia';
        }
        
        if($_POST['PSC']&&$_POST['Tel']){
            $PSC=test_in($con,$_POST['PSC']);
            $Tel=test_in($con,$_POST['Tel']);
        } else{
            $err='Musíš vypnliť všetky polia';
        }
        
        if($_POST['Email']&&$_POST['ICO']){
            $Email=test_in($con,$_POST['Email']);
            $ICO=test_in($con,$_POST['ICO']);
        } else{
            $err='Musíš vypnliť všetky polia';
        }
        
        if($_POST['DIC']&&$_POST['IBAN']){
            $DIC=test_in($con,$_POST['DIC']);
            $IBAN=test_in($con,$_POST['IBAN']);
        } else{
            $err='Musíš vypnliť všetky polia';
        }
        
        if(!$err){
            $editDbKo="UPDATE kontakt SET Nazov='$Nazov', Adresa='$Adresa', PSC='$PSC', Tel='$Tel', Email='$Email', ICO='$ICO', DIC='$DIC', IBAN='$IBAN'";
            $resu=mysqli_query($con,$editDbKo);
            
            if(!$resu){
                echo('mame problema');
            }
        }
    } ?>
    
    <main class="w-full bg-gray-200 pb-5 py-6">
        <form action="index.php?str=kontakt"class="w-11/12 -translate-x-1/2 left-1/2 md:w-1/2 relative sm:8/12 transform"method="post">
            <label class="font-semibold text-lg"for="Nazov">Názov</label>
            <input class="w-full block my-4 p-2"name="Nazov"value="<?php if(isset($_POST['edit'])){echo($Nazov);}else{echo($dbDataKo['Nazov']);} ?>"id="Nazov"> 

            <label class="font-semibold text-lg"for="Adresa">Adresa</label> 
            <input class="w-full block my-4 p-2"name="Adresa"value="<?php if(isset($_POST['edit'])){echo($Adresa);}else{echo($dbDataKo['Adresa']);} ?>"id="Adresa"> 
            
            <label class="font-semibold text-lg"for="PSC">PSČ</label> 
            <input class="w-full block my-4 p-2"name="PSC"value="<?php if(isset($_POST['edit'])){echo($PSC);}else{echo($dbDataKo['PSC']);} ?>"id="PSC"> 
            
            <label class="font-semibold text-lg"for="Tel">Tel.č.</label> 
            <input class="w-full block my-4 p-2"name="Tel"value="<?php if(isset($_POST['edit'])){echo($Tel);}else{echo($dbDataKo['Tel']);} ?>"id="Tel"> 
            
            <label class="font-semibold text-lg"for="Email">E-mail</label> 
            <input class="w-full block my-4 p-2"name="Email"value="<?php if(isset($_POST['edit'])){echo($Email);}else{echo($dbDataKo['Email']);} ?>"id="Email"> 
            
            <label class="font-semibold text-lg"for="ICO">IČO</label> 
            <input class="w-full block my-4 p-2"name="ICO"value="<?php if(isset($_POST['edit'])){echo($ICO);}else{echo($dbDataKo['ICO']);} ?>"id="ICO"> 
            
            <label class="font-semibold text-lg"for="DIC">DIČ</label> 
            <input class="w-full block my-4 p-2"name="DIC"value="<?php if(isset($_POST['edit'])){echo($DIC);}else{echo($dbDataKo['DIC']);} ?>"id="DIC"> 
            
            <label class="font-semibold text-lg"for="IBAN">IBAN</label> 
            <input class="w-full block my-4 p-2"name="IBAN"value="<?php if(isset($_POST['edit'])){echo($IBAN);}else{echo($dbDataKo['IBAN']);} ?>"id="IBAN"> 
            
            <input class="w-full bg-gray-50 border border-black cursor-pointer p-3 rounded-lg text-lg"name="edit"value="Uprav"type="submit">
        </form>
    </main>
    
<?php } else{ ?>
        <section class="w-11/12 mx-auto py-12">
            <h2 class="sm:px-14 font-bold pb-10 text-4xl text-indigo-900">Kontaktné údaje</h2>
            <section class="sm:px-14 lg:gap-1 lg:grid lg:grid-cols-3">
                <section class="lg:col-span-1">
                    <ul>
                        <li class="font-semibold"><?php echo($dbDataKo['Nazov']); ?></li>
                        <li><?php echo($dbDataKo['Adresa']); ?></li>
                        <li><?php echo($dbDataKo['PSC']); ?></li>
                        <li><br></li>
                        <li>Tel.č.: 
                            <a href="tel:<?php echo($dbDataKo['Tel']); ?>"><?php echo($dbDataKo['Tel']); ?></a>
                        </li>
                        <li>E-mail: 
                            <a href="mailto:<?php echo($dbDataKo['Email']); ?>"><?php echo($dbDataKo['Email']); ?></a>
                        </li>
                        <li><br></li>
                        <li>IČO:<?php echo($dbDataKo['ICO']); ?></li>
                        <li>DIČ:<?php echo($dbDataKo['DIC']); ?></li>
                        <li>IBAN:<?php echo($dbDataKo['IBAN']); ?></li>
                    </ul>
                </section>

                <section class="h-96 lg:col-span-2 lg:p-0 py-10">
                    <iframe allowfullscreen height="100%"loading="lazy"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2639.9351797871723!2d17.822457015544263!3d48.5727902792605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476b54705b389803%3A0x79c4b8499417c08!2sK2!5e0!3m2!1ssk!2ssk!4v1630421537283!5m2!1ssk!2ssk"style="border:0"width="100%"></iframe>
                </section>
            </section>
        </section>
<?php } ?>