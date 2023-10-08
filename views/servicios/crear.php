<div class="layout">
    <div class="layout__contenido">
        <div class="crearservicio">
            <div class="crearservicio__contenedor">
                <div class="cita">
                    <div class="cita__texto">
                        <h1 class="cita__heading">¡Nuevo Servicio!</h1>
                        <p class="cita__descripcion">
                            Completa los datos para añadir un nuevo servicio:
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
                
                <form action="/servicios/crear" method="POST" class="formulario">
                    <?php include_once __DIR__ . '/formulario.php'; ?>
                
                    <input type="submit" class="boton-crud" value="Crear Sevicio">
                </form>

                <?php
                    include_once __DIR__ . '/../templates/footer.php'
                ?>
            </div>
        </div>
    </div>
</div>