<div class="layout">
<div class="grid-auth">
        <div class="grid-auth__imagen">
            
        </div>
            
        <div class="grid-auth__contenido">
            <div class="actualizarservicio">
                <div class="actualizarservicio__contenedor">
                    <div class="cita">
                        <div class="cita__texto">
                            <h1 class="cita__heading">¡Actualizar Servicio!</h1>
                            <p class="cita__descripcion">
                                Completa los datos para modificar el servicio:
                            </p>
                        </div>
                    </div>
                    
                    <div class="barra">
                        <p>Hola: <?php echo $nombre ?? ''; ?></p>
                    
                        <a href="/logout" class="barra__logout">Cerrar Sesión</a>
                    </div>
    
                    <a href="/servicios" class="crud-volver">Volver</a>
    
                    <?php
                        include_once __DIR__ . '/../templates/alertas.php'
                    ?>
                    
                    <form method="POST" class="formulario">
                        <?php include_once __DIR__ . '/formulario.php'; ?>
                    
                        <input type="submit" class="boton-crud" value="Actualizar Sevicio">
                    </form>
    
                    <?php
                        include_once __DIR__ . '/../templates/footer.php'
                    ?>
                </div>
            </div>
        </div>
</div>
</div>

