<div class="layout">
    <div class="layout__contenido">
        <div class="admin">
            <div class="admin__contenedor">
                <div class="cita">
                    <div class="cita__texto">
                        <h1 class="cita__heading">¡Panel de Administración!</h1>
                        <p class="cita__descripcion">
                            Bienvenido:
                        </p>
                    </div>
                </div>
                
                <?php include_once __DIR__ . '/../templates/barra.php';?>
                
                <div class="busqueda">
                    <h2 class="busqueda__heading">Buscar Citas:</h2>
                    <form class="formulario">
                        <div class="formulario__campo">
                            <label for="fecha">Fecha:</label>
                            <input 
                                type="date"
                                id="fechaB"
                                name="fecha"
                                value="<?php echo $fecha; ?>"
                            >
                        </div>
                    </form>
                </div>
                
                <div class="dialibre">
                    <?php
                        if(count($citas) === 0) {
                            echo "<h2>No tienes Citas Agendadas esta Fecha :(</h2>";
                        }
                    ?>
                </div>
                
                <div id="citas-admin">
                    <ul class="citas">
                    <?php
                        $idCita = 0;
                        foreach($citas as $key => $cita) {
                            if ($idCita !== $cita->id) {
                                $total = 0;
                    ?>
                        <li>
                            <p>Id: <span><?php echo $cita->id; ?></span></p>
                            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                            <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                            <p>Email: <span><?php echo $cita->email; ?></span></p>
                            <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
                
                            <h3>Servicios:</h3>
                    <?php
                        $idCita = $cita->id; 
                    } // FIN DE IF
                        $total += $cita->precio;
                    ?> 
                            <p>Servicio: <span><?php echo $cita->servicio . ' ' . 
                            '$' . $cita->precio; ?></span></p>
                
                        <?php
                            $actual = $cita->id;
                            $proximo = $citas[$key + 1]->id ?? 0;
                
                            if(esUltimo($actual, $proximo)) { ?>
                                <p>Total a pagar: <span>$<?php echo $total; ?></span></p>
                
                                <form action="/api/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                    <input type="submit" class="boton-delete" value="Eliminar">
                                </form>
                        <?php } ?>
                    <?php } // FIN DE FOREACH 
                        ?>
                    </ul>
                </div>

                <?php
                    include_once __DIR__ . '/../templates/footer.php'
                ?>
            </div>
        </div>
    </div>
</div>

