<div class="layout">
    <div class="grid">
        <div class="grid__imagen">
        
        </div>
        
        <div class="grid__contenido">
        
            <div class="confirma">
                <div class="confirma__contenedor">
                    <div class="confirmaste">
                        <h1 class="confirmaste__heading">¡Confirmaste tu Cuenta!</h1>
                    </div>
        
                    <?php foreach ( $alertas as $key => $mensajes ):
                            foreach($mensajes as $mensaje):
                    ?>
                            <div class="alerta <?php echo $key; ?>">
                                <?php 
                                    echo $mensaje; 
                                    $page = $_SERVER['REQUEST_URI'];
                                    //debuguear($_SERVER);
                                    $sec = "15";
                                    header("Refresh: $sec; url=$page");
                                ?>
                            </div>
                    <?php
                            endforeach; 
                        endforeach;
                    ?>
        
                    <a href="/" class="formulario__boton">Ir a Inicio</a>
                </div>
            </div>
        
        </div>
    </div>
</div>
