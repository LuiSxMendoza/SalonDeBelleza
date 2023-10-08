<div class="layout">
    <div class="layout__contenido">
        <div class="olvide">
            <div class="olvide__contenedor">
                <div class="olvide__texto">
                    <h1 class="olvide__heading">¡Salon de Belleza!</h1>
                    <p class="olvide__descripcion">
                        Restablece tu Contraseña:
                    </p>
                </div>
                
                <?php include_once __DIR__ . '/../templates/alertas.php'?>
                
                <form action="/olvide" class="formulario" method="POST">
                    <div class="formulario__campo">
                        <label for="email">Correo:</label>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Ingresa tu Correo"
                        >
                    </div>
                
                    <input type="submit" class="formulario__boton" value="Enviar Instrucciones">
                </form>
                
                <div class="accionesauth">
                    <a href="/" class="acciones__enlace"><span>¿Ya tienes una cuenta?</span> Inicia sesion</a>
                    <a href="/registrar" class="acciones__enlace"><span>¿Aún no tienes cuenta?</span> Crea Una</a>
                </div>
            </div>

        </div>
    </div>
</div>

