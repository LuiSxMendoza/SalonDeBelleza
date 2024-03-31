<div class="layout">
    <div class="grid">
        <div class="grid__imagen">
        
        </div>
        
        <div class="grid__contenido">
            <div class="recupera">
                <div class="recupera__contenedor">
                    <div class="recupera__texto">
                        <h1 class="recupera__heading">¡Recuperar Password!</h1>
                        <p class="recupera__descripcion">
                            Ingresa una nueva contraseña:
                        </p>
                    </div>
                    
                    <?php foreach ( $alertas as $key => $mensajes ):
                            foreach($mensajes as $mensaje):
                    ?>
                            <div class="alerta <?php echo $key; ?>">
                                <?php 
                                    echo $mensaje; 
                                    $page = $_SERVER['APP_URL'];
                                    //debuguear($_SERVER);
                                    $sec = "5";
                                    header("Refresh: $sec; url=$page");
                                ?>
                            </div>
                    <?php
                            endforeach; 
                        endforeach;
                    ?>
                    
                    <?php if($error) return ?>
                    
                    <form class="formulario" method="POST">
                    
                        <div class="formulario__campo">
                            <label for="password">Contraseña:</label>
                            <input 
                                type="password"
                                id="password"
                                placeholder="Tu Password"
                                name="password"
                            >
                        </div>
                    
                        <input type="submit" value="Cambiar Contraseña" class="formulario__boton">
                    </form>
                    
                    <div class="accionesauth">
                        <a href="/" class="acciones__enlace"><span>¿Ya tienes una cuenta?</span> Inicia sesion</a>
                        <a href="/registrar" class="acciones__enlace"><span>¿Aún no tienes cuenta?</span> Crea Una</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

