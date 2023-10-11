<div class="layout">
    <div class="layout__contenido">
        <div class="recupera">
            <div class="recupera__contenedor">
                <div class="recupera__texto">
                    <h1 class="recupera__heading">¡Recuperar Password!</h1>
                    <p class="recupera__descripcion">
                        Ingresa una nueva contraseña:
                    </p>
                </div>
                
                <?php
                    include_once __DIR__ . '/../templates/alertas.php'
                ?>
                
                <?php if($error) return ?>
                
                <form class="formulario" method="POST">
                
                    <div class="formulario__campo">
                        <label for="password">Password</label>
                        <input 
                            type="password"
                            id="password"
                            placeholder="Tu Password"
                            name="password"
                        >
                    </div>
                
                    <input type="submit" value="Cambiar Contraseña" class="formulario__boton">
                </form>
                
                <div class="acciones">
                    <a href="/" class="acciones__enlace">¿Ya tienes cuenta? Inicia sesion</a>
                    <a href="/registrar" class="acciones__enlace">¿Aún no tienes cuenta? Crea Una</a>
                </div>
            </div>
            
        </div>
    </div>
</div>

