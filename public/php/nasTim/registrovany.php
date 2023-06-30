<?php 
    if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'delete':include 'deleteMemb.php';break;
                case 'edit':include 'editMemb.php';break;
                default:include 'nasTim.php';
            }
        } 
    }
    
    $selc="SELECT * FROM registrovany ORDER BY Username ASC";
    $quer=mysqli_query($con,$selc); ?>
    
    <h2 class="font-bold lg:pt-0 pb-5 pt-10 text-4xl text-indigo-900">Registrovaný</h2>
    
    <ul class="leading-10 listOfSportsman">
        <li class="px-2 text-white bg-gradient-to-r from-indigo-900 to-red-900">
            <span class="inline-block w-4/5">Uživateľské meno</span> 
            <span class="inline-block w-1/6">Oprávnenie</span>
        </li>
        
        <?php 
            $prevLabel=null;
            foreach($quer as $pre){
                $currLabel=mb_substr($pre['Username'],0,1,"UTF-8");
                
                if($currLabel!==$prevLabel){ ?>
                    <li class="font-bold bg-white p-2 text-red-700 text-xl uppercase"><?php echo($currLabel); ?></li>

                    <?php $prevLabel=$currLabel;
                } ?>
                    
                <li class="px-2 even:bg-gray-200 relative">
                    <span class="inline-block w-4/5"><?php echo($pre['Username']); ?></span>
                    <span class="inline-block w-1/6"><?php echo($pre['Role']); ?></span>
                    
                    <?php if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){ ?>
                        <span class="inline-block w-4/5">
                            <a class="px-2 text-white font-semibold py-1 rounded-lg bg-red-800 deleteSport"href="index.php?str=nastim&clen=registrovany&action=delete&ID=<?php echo($pre['ID']) ?>">Odstrániť</a>
                        </span> 
                        <span class="inline-block w-1/6">
                            <a class="px-2 text-white font-semibold py-1 rounded-lg bg-green-800 editSport"href="index.php?str=nastim&clen=registrovany&action=edit&ID=<?php echo($pre['ID']) ?>">Upraviť</a>
                        </span>
                    <? } ?>
                </li>
            <?php } ?>
    </ul>