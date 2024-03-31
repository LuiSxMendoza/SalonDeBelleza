<div class="layout">
    <div class="grid">
        <div class="grid__imagen">
        
        </div>
        <div class="grid__contenido">
            <div class="registrar">
                <div class="registrar__contenedor">
                    <div class="registrar__texto">
                        <h1 class="registrar__heading">¡Mendoza'S Beauty Salón!</h1>
                        <p class="registrar__descripcion">
                            Crea tu Cuenta:
                        </p>
                    </div>
                    
                    <?php
                        include_once __DIR__ . '/../templates/alertas.php'
                    ?>
                    
                    <form action="/registrar" class="formulario" method="POST">
                        <div class="formulario__campo">
                            <label for="nombre">Nombre:</label>
                            <input 
                                type="text"
                                id="nombre"
                                name="nombre"
                                placeholder="Ingresa tu Nombre"
                                value="<?php echo s($usuario->nombre) ?>"
                            >
                        </div>
                    
                        <div class="formulario__campo">
                            <label for="apellidos">Apellidos:</label>
                            <input 
                                type="text"
                                id="apellidos"
                                name="apellidos"
                                placeholder="Ingresa tus Apellidos"
                                value="<?php echo s($usuario->apellidos) ?>"
                            >
                        </div>
                    
                        <div class="formulario__campo">
                            <label for="telefono">Teléfono:</label>
                            <input 
                                type="tel"
                                id="telefono"
                                name="telefono"
                                placeholder="Ingresa tu Teléfono"
                                value="<?php echo s($usuario->telefono) ?>"
                            >
                        </div>
                    
                        <div class="formulario__campo">
                            <label for="email">Correo:</label>
                            <input 
                                type="email"
                                id="email"
                                placeholder="Ingresa tu Correo"
                                name="email"
                                value="<?php echo s($usuario->email) ?>"
                            >
                        </div>
                        
                        <div class="formulario__campo">
                            <label for="password">Contraseña:</label>
                            <input 
                                type="password"
                                id="password"
                                placeholder="Crea tu Contraseña"
                                name="password"
                            >
                        </div>
                    
                        <input type="submit" class="formulario__boton" value="Crear Cuenta">
                    </form>
                    
                    <div class="accionesauth">
                        <a href="/" class="acciones__enlace"><span>¿Ya tienes una cuenta?</span> Inicia sesion</a>
                        <a href="/olvide" class="acciones__enlace"><span>¿Olvidaste tu Contraseña?</span> Resetear</a>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
</div>