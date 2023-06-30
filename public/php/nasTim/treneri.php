<?php 
    if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'add':include 'addMemb.php';break;
                case 'delete':include 'deleteMemb.php';break;
                case 'edit':include 'editMemb.php';break;
                default:include 'nasTim.php';
            }
        } ?>
        
        <a class="font-semibold py-1 rounded-lg bg-gray-200 block border border-black border-solid my-3 px-3 text-black text-center text-xl"href="index.php?str=nastim&clen=treneri&action=add">Pridať člena</a>
    <?php }
    
    $selc="SELECT * FROM treneri ORDER BY Priezvisko ASC";
    $quer=mysqli_query($con,$selc); ?>
    
    <a class="block font-bold lg:pt-0 pb-5 pt-10 text-4xl text-indigo-900"href="index.php?str=login">Tréneri</a>
    
    <ul class="leading-10 listOfSportsman">
        <li class="px-2 text-white bg-gradient-to-r from-indigo-900 to-red-900">
            <span class="inline-block w-4/5">Meno</span> 
            <span class="inline-block w-1/6">Disciplína</span>
        </li>
        
        <?php 
            $prevLabel=null;
            foreach($quer as $pre){
                $currLabel=mb_substr($pre['Priezvisko'],0,1,"UTF-8");
                
                if($currLabel!==$prevLabel){ ?>
                    <li class="font-bold bg-white p-2 text-red-700 text-xl uppercase"><?php echo($currLabel); ?></li>
                    
                    <?php $prevLabel=$currLabel;
                } ?>
                    
                <li class="px-2 even:bg-gray-200 relative">
                    <span class="inline-block w-4/5"><?php echo($pre['Meno'].' '.$pre['Priezvisko']); ?></span>
                    <span class="inline-block w-1/6"><?php echo($pre['Disciplina']); ?></span>
                    
                    <?php 
                        if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){ ?>
                            <span class="inline-block w-4/5">
                                <a class="px-2 text-white font-semibold py-1 rounded-lg bg-green-800"href="index.php?str=nastim&clen=treneri&action=edit&ID=<?php echo($pre['ID']) ?>">Upraviť</a>
                            </span> 
                            <span class="inline-block w-1/6">
                                <a class="px-2 text-white font-semibold py-1 rounded-lg bg-red-800"href="index.php?str=nastim&clen=treneri&action=delete&ID=<?php echo($pre['ID']) ?>">Odstrániť</a>
                            </span>
                        <?php } ?>
                </li>
            <?php } ?>
    </ul>