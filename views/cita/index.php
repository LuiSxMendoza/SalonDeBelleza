<div class="layout">
 <div class="grid-auth">
       <div class="grid-auth__imagen">
           
       </div>
           
       <div class="grid-auth__contenido">
           <div class="citaseccion">
               <div class="citaseccion__contenedor">
                   <div class="cita">
                       <div class="cita__texto">
                           <h1 class="cita__heading">¡Agenda tu Cita!</h1>
                           <p class="cita__descripcion">
                               Elige tus servicios y coloca tus datos:
                           </p>
                       </div>
                   </div>
                   
                   <?php
                       include_once __DIR__ . '/../templates/barra.php';
                   ?>
                   
                   <div id="app">
                   
                       <nav class="tabs">
                           <button class="actual" type="button" data-paso="1">Servicios</button>
                           <button type="button" data-paso="2">Información y Cita</button>
                           <button type="button" data-paso="3">Resumen</button>
                       </nav>
                   
                       <div id="paso-1" class="seccion">
                   
                           <h2 class="seccion__titulo">Servicios:</h2>
                           <p class="seccion__descripcion">
                               ¡Elige tus servicios a continuación!
                           </p>
                           <div id="servicios" class="servicios"></div>
                   
                       </div>
                   
                       <div id="paso-2" class="seccion">
                   
                           <h2 class="seccion__titulo">Tus Datos y Cita:</h2>
                           <p class="seccion__descripcion">
                               ¡Coloca tus datos y fecha de la cita!</p>
                   
                           <form class="formulario">
                               <div class="formulario__campo">
                                   <label for="nombre">Nombre:</label>
                                   <input 
                                       type="text"
                                       id="nombre"
                                       placeholder="Tu Nombre"
                                       value="<?php echo $nombre; ?>"
                                       disabled
                                   >
                               </div>
                   
                               <div class="formulario__campo">
                                   <label for="fecha">Fecha:</label>
                                   <input 
                                       type="date"
                                       id="fecha"
                                       min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                                   >
                               </div>
                   
                               <div class="formulario__campo">
                                   <label for="time">Hora:</label>
                                   <input 
                                       type="time"
                                       id="hora"
                                   >
                               </div>
                   
                               <input type="hidden" id="id" value="<?php echo $id; ?>">
                   
                           </form>
                   
                       </div>
                   
                       <div id="paso-3" class="seccion seccion__resumen">
                   
                           <h2 class="seccion__titulo">Resumen</h2>
                           <p class="seccion__descripcion">
                               Verifica que la información sea correcta</p>
                       </div>
                   
                       <div class="paginacion">
                           <button id="anterior" class="boton-volver">
                               &laquo;Anterior
                           </button>
                           <button id="siguiente" class="boton-volver">
                               Siguiente&raquo;
                           </button>
                       </div>
                       
                   </div>
    
                   <?php
                       include_once __DIR__ . '/../templates/footer.php'
                   ?>
               </div>
           </div>
    
       </div>
 </div>
</div>

