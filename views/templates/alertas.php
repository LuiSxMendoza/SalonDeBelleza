<?php foreach ( $alertas as $key => $mensajes ):
        foreach($mensajes as $mensaje):
?>
        <div class="alerta <?php echo $key; ?>">
            <?php 
                echo $mensaje; 
                $page = $_SERVER['REQUEST_URI'];
                //debuguear($_SERVER);
                $sec = "4";
                header("Refresh: $sec; url=$page");
            ?>
        </div>
<?php
        endforeach; 
    endforeach;
?>