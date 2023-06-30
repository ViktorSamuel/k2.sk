<?php 
if(isset($_POST['addMeb'])){
    $firstName=test_in($con,$_POST['firstName']);
    $lastName=test_in($con,$_POST['lastName']);
    
    if($firstName&&$lastName){
        $discipline=$_POST['discipline'];
        if($discipline=='Tréner'){
            $table='treneri';
        }else{
            $table='sportovci';
        }
        
        $inser="INSERT INTO $table(Meno,Priezvisko,Disciplina) VALUES('$firstName','$lastName','$discipline')";
        $add=mysqli_query($con,$inser);
        
        if($add){
            echo('Nový člen bol uspesne pridaný');
            header('location:index.php?str=nastim&clen='.$table);
        } else{
            echo('Chyba');
        }
    } else{$err='Musíš vyplniť všetky polia';}
} ?>

<form action="index.php?str=nastim&clen=<?php echo($_GET['clen']); ?>&action=add"class="absolute -translate-x-1/2 -translate-y-1/2 bg-gray-100 border border-black h-auto left-1/2 p-6 rounded-xl top-1/2 transform w-96 z-10"method="post">
    <h3 class="font-semibold mb-4 text-2xl text-indigo-900">Pridanie nového člena</h3>
    
    <input class="block mb-2 px-1 py-0.5"name="firstName"id="firstName"placeholder="Meno"> 
    <input class="block mb-2 px-1 py-0.5"name="lastName"id="lastName"placeholder="Priezvisko"> 
    <select class="block mb-2 px-1 py-0.5"id="discipline"name="discipline">
        <option value="Kajak">Kajak</option>
        <option value="Canoe">Canoe</option>
        <option value="Tréner">Tréner</option>
    </select> 
    <input class="block mb-2 px-1 py-0.5 border border-black border-solid cursor-pointer rounded-lg"name="addMeb"type="submit"value="Pridaj"> 
    <a class="absolute h-8 right-2 top-2 w-8"href="index.php?str=nastim">
        <img alt="Krížik"src="./img/crossIcon.png">
    </a>
</form>