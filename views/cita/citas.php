<div class="layout">
    <div class="grid-auth">
        <div class="grid-auth__imagen">
               
        </div>
                   
        <div class="grid-auth__contenido">
            <div class="miscitas">
                <div class="miscitas__contenedor">
                    <div class="datosuser">
                        <h3 class="datosuser__nombre">¡Bienvenido -
                            <?php echo $usuario->nombre; ?>!
                        </h3>
                        
                        <a href="/cita" class="crud-volver">Volver</a>
        
                        <?php  
                            if(count($citas) != 0) { ?>
                                <p class="datosuser__descripcion">
                                    A continuación se muestran las citas que agendaste:
                                </p>
                            <?php }
                        ?>
                    </div>
        
                    <div class="dialibre">
                        <?php
                            if(count($citas) === 0) {
                                echo "<h2>Aún No tienes Citas Agendadas :(</h2>";
                            }
                        ?>
                    </div>
        
                    <div class="datoscita">
                        <ul class="citauser">
                            <?php foreach($citas as $cita) { ?>
                                <li>
                                    <p class="nota">Fecha y Hora de la Cita:</p>
                                    <p>Fecha: <span><?php echo $cita->fecha; ?></span></p>
                                    <p>Hora: <span>$<?php echo $cita->hora; ?></span></p>
                        
                                    <div class="acciones">
                                        <form action="/citas" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        
                                            <input type="submit" value="Cancelar Cita" class="boton-accionesb">
                                        </form>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php
                        include_once __DIR__ . '/../templates/footer.php'
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>