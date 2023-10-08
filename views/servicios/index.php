<div class="layout">
    <div class="layout__contenido">
        
        <div class="servicioslyt">
            <div class="servicioslyt__contenedor">
                <div class="cita">
                    <div class="cita__texto">
                        <h1 class="cita__heading">¡Servicios!</h1>
                        <p class="cita__descripcion">
                            Administra tus Servicios:
                        </p>
                    </div>
                </div>

                <?php
                    include_once __DIR__ . '/../templates/barra.php';
                ?>
                
                <ul class="serviciosadm">
                    <?php foreach($servicios as $servicio) { ?>
                        <li>
                            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
                            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>
                
                            <div class="acciones">
                                <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" 
                                    class="boton-acciones">Actualizar</a>
                
                                <form action="/servicios/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                
                                    <input type="submit" value="Borrar" class="boton-accionesb">
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

                <?php
                    include_once __DIR__ . '/../templates/footer.php'
                ?>
            </div>
        </div>

    </div>
</div>
