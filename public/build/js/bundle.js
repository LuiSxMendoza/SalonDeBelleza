let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();

});

function iniciarApp() {
    mostrarSeccion(); //? Muestra y oculta secciones
    tabs(); //? Cambia seccion con tabs
    paginador(); //? Muestra y oculta botones
    pagSiguiente();
    pagAnterior();

    consultarApi(); //? Consulta Api en backend de php

    idCliente(); //? Añade id del cliente a la cita 
    nombreCliente(); //? Añade nombre de cliente al objeto de cita
    horaCita(); //? Añade hora seleccionada al objeto de cita
    fechaCita(); //? Añade fecha seleccionada al objeto de cita

    mostrarResumen(); //? Muestra el resumen de la cita
};

function mostrarSeccion() {

    //? Ocultar la seccion que tenga la clase mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    //? Añadir clase con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //? Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //? Resalta tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
};

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            paginador();

            if(paso === 3) {
                mostrarResumen();
            }
        });
    });
};

function paginador() {

    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1) {
        paginaAnterior.classList.add('ocultarb');
        paginaSiguiente.classList.remove('ocultarb');
    } if(paso === 3) {
        paginaAnterior.classList.remove('ocultarb');
        paginaSiguiente.classList.add('ocultarb');

        mostrarResumen();

    } if(paso === 2) {
        paginaAnterior.classList.remove('ocultarb');
        paginaSiguiente.classList.remove('ocultarb');
    }

    mostrarSeccion();

};

function pagAnterior() {
    const pagAnterior = document.querySelector('#anterior');
    pagAnterior.addEventListener('click', function() {

        if(paso <= pasoInicial) return;
        
        paso--;
        
        paginador();
    });
}

function pagSiguiente() {
    const pagSiguiente = document.querySelector('#siguiente');
    pagSiguiente.addEventListener('click', function() {

        if(paso >= pasoFinal) return;
        
        paso++;
        
        paginador();
    });
}

async function consultarApi() {

    try {
        const url = `${location.origin}/api/servicios`;
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
        
    } catch (error) {
        
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const { id, nombre, precio } = servicio;

        const servicioNombre = document.createElement('P');
        servicioNombre.classList.add('servicio__nombre');
        servicioNombre.textContent = nombre;

        const servicioPrecio = document.createElement('P');
        servicioPrecio.classList.add('servicio__precio');
        servicioPrecio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.servicioId = id;
        servicioDiv.onclick = function() {
            servicioSeleccionado(servicio);
        }

        servicioDiv.appendChild(servicioNombre);
        servicioDiv.appendChild(servicioPrecio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })
}

function servicioSeleccionado(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    //? Identificar a que elemento se le da click
    const divServicio = document.querySelector(`[data-servicio-id="${id}"]`);

    //? Comprobar si un servicio ya fue agregado 
    if( servicios.some( agregado => agregado.id === id ) ) {
        //? Eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id);
        divServicio.classList.remove('servicio__seleccionado');
    } else{
        //? Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('servicio__seleccionado');
    }
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}

function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function fechaCita() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {

        const dia = new Date(e.target.value).getUTCDay();

        if([0, 6].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no abrimos', 'error', '.formulario');
        } else{
            cita.fecha = e.target.value;
        }
    })
}

function horaCita() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {

        const citaHora = e.target.value;
        const hora = citaHora.split(":") [0];
        
        if(hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Negocio cerrado', 'error', '.formulario');
        } else{
            cita.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    //? Solo mostrar una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    //? Crear alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    //? Mostrar alerta
    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece) {
        //? Ocultar alerta automaticamente
        setTimeout(()=> {
            alerta.remove();
        }, 3000)
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.seccion__resumen');

    //? Limpiar contenido de resumen
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('') || (cita.servicios.length === 0)) {
        mostrarAlerta('Faltan datos de servicio, Fecha u Hora', 'error', '.seccion__resumen',
        false);

        return;
    }

    //? Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;

    //? Heading para servicios en resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios:';
    headingServicios.classList.add('seccion__heading');
    resumen.appendChild(headingServicios);

    //? Iterar en los sevicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;

        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('seccion__servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })

    //? Heading para cita en resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita:';
    headingCita.classList.add('seccion__heading');
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //? Formatear fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() +2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date( Date.UTC(year, mes, dia));

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones)

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    //? Boton para crear cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('seccion__boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservar);
}

async function reservarCita() {
    
    const { fecha, hora, servicios, id } = cita;

    const idservicios = servicios.map( servicio => servicio.id );

    const datos = new FormData();
    datos.append('usuarioId', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idservicios);
    
    try {
        //? Peticion a la api
        const url = `${location.origin}/api/citas`;

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        //console.log(respuesta);

        resultado.resultado;
        
    } catch (error) {
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: 'Cita Agendada Exitosamente'
        }).then( () => {
            setTimeout(() => {
                window.location.reload();
            }, 200);
        });
    }
    //console.log([...datos]);
}

function flashTitleNot() {
    var origTitle = document.title;
    var isFlash = false;
    function changeTitle() {
        document.title = isFlash ?
        "¡Bienvenido! - App Salon de Belleza" : origTitle;
        isFlash = !isFlash;
    }
    setInterval(changeTitle, 2500);
}
window.onload = flashTitleNot;
document.addEventListener('DOMContentLoaded', function() {
    iniciarBuscador();
});

function iniciarBuscador() {
    buscarPorFecha();
};

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fechaB');

    fechaInput.addEventListener('input', function(e) {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    })
}
(function (document) {
    var checkCount = 0,
      formatFound = false;
  
    function setHTMLClass(height, className) {
      checkCount++;
      if (height == 2) {
        formatFound = true;
        document.documentElement.className += " " + className;
      } else {
        document.documentElement.className += " not" + className;
        if (checkCount == 4 && !formatFound) {
          if (
            document.implementation.hasFeature(
              "http://www.w3.org/TR/SVG11/feature#Image",
              "1.1"
            )
          ) {
            document.documentElement.className += " svg";
          } else {
            document.documentElement.className += " notsvg png";
          }
        }
      }
    }
  
    var JXL = new Image();
    JXL.onload = JXL.onerror = function () {
      setHTMLClass(JXL.height, "jxl");
    };
    JXL.src =
      "data:image/jxl;base64,/woIELASCAgQAFwASxLFgkWAHL0xqnCBCV0qDp901Te/5QM=";
  
    var AVIF = new Image();
    AVIF.onload = AVIF.onerror = function () {
      setHTMLClass(AVIF.height, "avif");
    };
    AVIF.src =
      "data:image/avif;base64,AAAAIGZ0eXBhdmlmAAAAAGF2aWZtaWYxbWlhZk1BMUIAAADybWV0YQAAAAAAAAAoaGRscgAAAAAAAAAAcGljdAAAAAAAAAAAAAAAAGxpYmF2aWYAAAAADnBpdG0AAAAAAAEAAAAeaWxvYwAAAABEAAABAAEAAAABAAABGgAAAB0AAAAoaWluZgAAAAAAAQAAABppbmZlAgAAAAABAABhdjAxQ29sb3IAAAAAamlwcnAAAABLaXBjbwAAABRpc3BlAAAAAAAAAAIAAAACAAAAEHBpeGkAAAAAAwgICAAAAAxhdjFDgQ0MAAAAABNjb2xybmNseAACAAIAAYAAAAAXaXBtYQAAAAAAAAABAAEEAQKDBAAAACVtZGF0EgAKCBgANogQEAwgMg8f8D///8WfhwB8+ErK42A=";
  
    var WebP = new Image();
    WebP.onload = WebP.onerror = function () {
      setHTMLClass(WebP.height, "webp");
    };
    WebP.src =
      "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
  
    var JPX = new Image();
    JPX.onload = JPX.onerror = function () {
      setHTMLClass(JPX.height, "jpx");
    };
    JPX.src =
      "data:image/vnd.ms-photo;base64,SUm8AQgAAAAFAAG8AQAQAAAASgAAAIC8BAABAAAAAQAAAIG8BAABAAAAAgAAAMC8BAABAAAAWgAAAMG8BAABAAAARgAAAAAAAAAkw91vA07+S7GFPXd2jckQV01QSE9UTwAZAMFxAAAAATAAoAAKAACgAAAQgCAIAAAEb/8AAQAAAQDCPwCAAAAAAAAAAAAAAAAAjkI/AIAAAAAAAAABIAA=";
  
    var JP2 = new Image();
    JP2.onload = JP2.onerror = function () {
      setHTMLClass(JP2.height, "jp2");
    };
    JP2.src =
      "data:image/jp2;base64,/0//UQAyAAAAAAABAAAAAgAAAAAAAAAAAAAABAAAAAQAAAAAAAAAAAAEBwEBBwEBBwEBBwEB/1IADAAAAAEAAAQEAAH/XAAEQED/ZAAlAAFDcmVhdGVkIGJ5IE9wZW5KUEVHIHZlcnNpb24gMi4wLjD/kAAKAAAAAABYAAH/UwAJAQAABAQAAf9dAAUBQED/UwAJAgAABAQAAf9dAAUCQED/UwAJAwAABAQAAf9dAAUDQED/k8+kEAGvz6QQAa/PpBABr994EAk//9k=";
  })(
    (window.sandboxApi &&
      window.sandboxApi.parentWindow &&
      window.sandboxApi.parentWindow.document) ||
      document
  );