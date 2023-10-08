<div class="layoutb">
        <div class="barra">
            <p>Hola: <?php echo $nombre ?? ''; ?></p>

            <?php if (!isset($_SESSION['admin'])) { ?>
                <a href="/citas" class="mis-citas">Mis Citas</a>
            <?php } ?>

            <a href="/logout" class="barra__logout">Cerrar Sesión</a>
        </div>

        <?php if(isset($_SESSION['admin'])) { ?> 
            <div class="barra__secciones">
                <a href="/admin" class="barra__botones">Ver Citas</a>
                <a href="/servicios" class="barra__botones">Ver Servicios</a>
                <a href="/servicios/crear" class="barra__botones">Nuevo Servicio</a>
            </div>
        <?php } ?>
</div>

