<div class="w-11/12 h-28">
    <h1 class="font-bold text-2xl">
        <?php
        if(isset($_GET["str"])){
            if($_GET["str"] == "login"){
                echo("Prihlasovanie");
            } else if($_GET["str"] == "sign"){
                echo("Registrácia");
            }
        }
        ?>
    </h1>
</div>