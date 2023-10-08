<div class="layout">
    <div class="layout__contenido">

        <div class="login">
            <div class="login__contenedor">
                <div class="login__texto">
                    <h2 class="login__heading">¡Salon de Belleza!</h2>
                    <p class="login__descripcion">
                        Inicia Sesión:
                    </p>
                </div>
                
                <?php include_once __DIR__ . '/../templates/alertas.php'?>
                
                <form action="/" class="formulario" method="POST">
                    <div class="formulario__campo">
                        <label for="email">Correo:</label>
                        <input 
                            type="email"
                            id="email"
                            placeholder="Tu Correo"
                            name="email"
                        >
                    </div>
                
                    <div class="formulario__campo">
                        <label for="password">Contraseña:</label>
                        <input 
                            type="password"
                            id="password"
                            placeholder="Tu Contraseña"
                            name="password"
                        >
                    </div>
                
                    <input type="submit" value="Iniciar Sesion" class="formulario__boton">
                
                </form>
                
                <div class="accionesauth">
                    <a href="/registrar" class="acciones__enlace"><span>¿Aún no tienes cuenta?</span> Crea Una</a>
                    <a href="/olvide" class="acciones__enlace"><span>¿Olvidaste tu Contraseña?</span> Resetear</a>
                </div>
            </div>
        </div>

    </div>
</div>