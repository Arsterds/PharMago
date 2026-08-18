<<<<<<< HEAD
(() => {
    'use strict';

    const productos = [...document.querySelectorAll('.producto')];
    const buscador = document.getElementById('buscador-productos');
    const limpiarBusqueda = document.getElementById('limpiar-busqueda');
    const orden = document.getElementById('orden-productos');
    const filtros = [...document.querySelectorAll('.filtro-categoria')];
    const cantidadResultados = document.getElementById('cantidad-resultados');
    const textoFiltro = document.getElementById('texto-filtro');
    const sinResultados = document.getElementById('sin-resultados');
    const reiniciarFiltros = document.getElementById('reiniciar-filtros');

    const panelCarrito = document.getElementById('carrito-panel');
    const fondoCarrito = document.getElementById('carrito-fondo');
    const abrirCarrito = document.getElementById('abrir-carrito');
    const cerrarCarrito = document.getElementById('cerrar-carrito');
    const listaCarrito = document.getElementById('lista-carrito');
    const carritoVacio = document.getElementById('carrito-vacio');
    const contadorCarrito = document.getElementById('contador-carrito');
    const totalTexto = document.getElementById('total');
    const vaciarCarrito = document.getElementById('vaciar-carrito');
    const finalizarCompra = document.getElementById('finalizar-compra');

    const modalFondo = document.getElementById('modal-fondo');
    const cerrarModal = document.getElementById('cerrar-modal');
    const modalImagen = document.getElementById('modal-imagen');
    const modalCategoria = document.getElementById('modal-categoria');
    const modalNombre = document.getElementById('modal-nombre');
    const modalDescripcion = document.getElementById('modal-descripcion');
    const modalPresentacion = document.getElementById('modal-presentacion');
    const modalPrecio = document.getElementById('modal-precio');
    const modalAgregar = document.getElementById('modal-agregar');

    let categoriaActual = 'Todos';
    let carrito = JSON.parse(localStorage.getItem('pharmago_carrito') || '[]');
    let favoritos = JSON.parse(localStorage.getItem('pharmago_favoritos') || '[]');
    let productoModalActual = null;

    const dinero = valor => '$' + Number(valor).toLocaleString('es-CO');

    function guardarCarrito() {
        localStorage.setItem('pharmago_carrito', JSON.stringify(carrito));
    }

    function guardarFavoritos() {
        localStorage.setItem('pharmago_favoritos', JSON.stringify(favoritos));
    }

    function abrirPanel() {
        panelCarrito.classList.add('abierto');
        fondoCarrito.classList.add('abierto');
        panelCarrito.setAttribute('aria-hidden', 'false');
        document.body.classList.add('panel-abierto');
    }

    function cerrarPanel() {
        panelCarrito.classList.remove('abierto');
        fondoCarrito.classList.remove('abierto');
        panelCarrito.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('panel-abierto');
    }

    function actualizarContador() {
        const cantidad = carrito.reduce((suma, item) => suma + item.cantidad, 0);
        contadorCarrito.textContent = cantidad;
    }

    function renderizarCarrito() {
        listaCarrito.innerHTML = '';

        if (!carrito.length) {
            carritoVacio.hidden = false;
            actualizarContador();
            totalTexto.textContent = '$0';
            return;
        }

        carritoVacio.hidden = true;
        let total = 0;

        carrito.forEach(item => {
            total += item.precio * item.cantidad;

            const elemento = document.createElement('div');
            elemento.className = 'item-carrito';
            elemento.innerHTML = `
                <img src="${item.imagen}" alt="${item.nombre}">
                <div>
                    <strong>${item.nombre}</strong>
                    <div class="item-precio">${dinero(item.precio)}</div>
                    <div class="cantidad-carrito">
                        <button type="button" data-accion="restar" data-id="${item.id}" aria-label="Disminuir cantidad">−</button>
                        <span>${item.cantidad}</span>
                        <button type="button" data-accion="sumar" data-id="${item.id}" aria-label="Aumentar cantidad">+</button>
                    </div>
                </div>
                <button type="button" class="eliminar-item" data-accion="eliminar" data-id="${item.id}" aria-label="Eliminar ${item.nombre}">🗑</button>
            `;
            listaCarrito.appendChild(elemento);
        });

        totalTexto.textContent = dinero(total);
        actualizarContador();
    }

    function agregarAlCarrito(datos) {
        const existente = carrito.find(item => String(item.id) === String(datos.id));

        if (existente) {
            existente.cantidad += 1;
        } else {
            carrito.push({
                id: String(datos.id),
                nombre: datos.nombre,
                precio: Number(datos.precio),
                imagen: datos.imagen,
                cantidad: 1
            });
        }

        guardarCarrito();
        renderizarCarrito();
        abrirPanel();
    }

    function cambiarCantidad(id, cambio) {
        const item = carrito.find(producto => String(producto.id) === String(id));
        if (!item) return;

        item.cantidad += cambio;
        if (item.cantidad <= 0) {
            carrito = carrito.filter(producto => String(producto.id) !== String(id));
        }

        guardarCarrito();
        renderizarCarrito();
    }

    function eliminarDelCarrito(id) {
        carrito = carrito.filter(item => String(item.id) !== String(id));
        guardarCarrito();
        renderizarCarrito();
    }

    function ordenarProductos() {
        const tipo = orden.value;
        const contenedor = document.getElementById('catalogo-productos');

        const ordenados = [...productos].sort((a, b) => {
            if (tipo === 'nombre-asc') return a.dataset.nombre.localeCompare(b.dataset.nombre, 'es');
            if (tipo === 'nombre-desc') return b.dataset.nombre.localeCompare(a.dataset.nombre, 'es');
            if (tipo === 'precio-asc') return Number(a.dataset.precio) - Number(b.dataset.precio);
            if (tipo === 'precio-desc') return Number(b.dataset.precio) - Number(a.dataset.precio);
            return Number(a.dataset.id) - Number(b.dataset.id);
        });

        ordenados.forEach(producto => contenedor.appendChild(producto));
        aplicarFiltros();
    }

    function aplicarFiltros() {
        const texto = buscador.value.trim().toLowerCase();
        let visibles = 0;

        productos.forEach(producto => {
            const coincideCategoria = categoriaActual === 'Todos' || producto.dataset.categoria === categoriaActual;
            const contenido = `${producto.dataset.nombre} ${producto.dataset.categoria} ${producto.dataset.presentacion}`.toLowerCase();
            const coincideTexto = contenido.includes(texto);
            const visible = coincideCategoria && coincideTexto;

            producto.classList.toggle('oculto', !visible);
            if (visible) visibles++;
        });

        cantidadResultados.textContent = `${visibles} ${visibles === 1 ? 'producto' : 'productos'}`;
        textoFiltro.textContent = categoriaActual === 'Todos'
            ? (texto ? `Resultados para “${buscador.value.trim()}”` : 'Mostrando todo el catálogo')
            : `Categoría: ${categoriaActual}`;

        sinResultados.hidden = visibles !== 0;
    }

    function abrirDetalles(id) {
        const producto = productos.find(item => String(item.dataset.id) === String(id));
        if (!producto) return;

        productoModalActual = {
            id: producto.dataset.id,
            nombre: producto.dataset.nombre,
            precio: Number(producto.dataset.precio),
            imagen: producto.dataset.imagen,
            categoria: producto.dataset.categoria,
            presentacion: producto.dataset.presentacion,
            descripcion: producto.dataset.descripcion
        };

        modalImagen.src = productoModalActual.imagen;
        modalImagen.alt = productoModalActual.nombre;
        modalCategoria.textContent = productoModalActual.categoria;
        modalNombre.textContent = productoModalActual.nombre;
        modalDescripcion.textContent = productoModalActual.descripcion;
        modalPresentacion.textContent = productoModalActual.presentacion;
        modalPrecio.textContent = dinero(productoModalActual.precio);
        modalFondo.hidden = false;
        document.body.classList.add('panel-abierto');
    }

    function cerrarDetalles() {
        modalFondo.hidden = true;
        document.body.classList.remove('panel-abierto');
        productoModalActual = null;
    }

    function actualizarFavoritos() {
        document.querySelectorAll('.favorito').forEach(boton => {
            const activo = favoritos.includes(String(boton.dataset.id));
            boton.classList.toggle('activo', activo);
            boton.textContent = activo ? '♥' : '♡';
            boton.setAttribute('aria-label', activo ? 'Quitar de favoritos' : 'Agregar a favoritos');
        });
    }

    // Agregar al carrito.
    document.querySelectorAll('.boton-comprar').forEach(boton => {
        boton.addEventListener('click', () => agregarAlCarrito(boton.dataset));
    });

    // Favoritos.
    document.querySelectorAll('.favorito').forEach(boton => {
        boton.addEventListener('click', () => {
            const id = String(boton.dataset.id);
            if (favoritos.includes(id)) {
                favoritos = favoritos.filter(item => item !== id);
            } else {
                favoritos.push(id);
            }
            guardarFavoritos();
            actualizarFavoritos();
        });
    });

    // Abrir detalles desde imagen o botón.
    document.querySelectorAll('[data-detalle]').forEach(elemento => {
        elemento.addEventListener('click', () => abrirDetalles(elemento.dataset.detalle));
    });

    // Filtros.
    filtros.forEach(filtro => {
        filtro.addEventListener('click', () => {
            filtros.forEach(item => item.classList.remove('activo'));
            filtro.classList.add('activo');
            categoriaActual = filtro.dataset.categoria;
            aplicarFiltros();
        });
    });

    buscador.addEventListener('input', aplicarFiltros);
    limpiarBusqueda.addEventListener('click', () => {
        buscador.value = '';
        aplicarFiltros();
        buscador.focus();
    });

    orden.addEventListener('change', ordenarProductos);

    reiniciarFiltros.addEventListener('click', () => {
        buscador.value = '';
        categoriaActual = 'Todos';
        filtros.forEach(item => item.classList.toggle('activo', item.dataset.categoria === 'Todos'));
        orden.value = 'relevancia';
        ordenarProductos();
    });

    // Carrito.
    abrirCarrito.addEventListener('click', abrirPanel);
    cerrarCarrito.addEventListener('click', cerrarPanel);
    fondoCarrito.addEventListener('click', cerrarPanel);

    listaCarrito.addEventListener('click', evento => {
        const boton = evento.target.closest('[data-accion]');
        if (!boton) return;

        const id = boton.dataset.id;
        const accion = boton.dataset.accion;

        if (accion === 'sumar') cambiarCantidad(id, 1);
        if (accion === 'restar') cambiarCantidad(id, -1);
        if (accion === 'eliminar') eliminarDelCarrito(id);
    });

    vaciarCarrito.addEventListener('click', () => {
        if (!carrito.length) return;
        carrito = [];
        guardarCarrito();
        renderizarCarrito();
    });

    finalizarCompra.addEventListener('click', () => {
        if (!carrito.length) {
            alert('Tu carrito está vacío.');
            return;
        }

        alert('¡Tu pedido está listo! En una siguiente versión podemos conectar este botón con el proceso de compra de PharMago.');
    });

    // Modal.
    cerrarModal.addEventListener('click', cerrarDetalles);
    modalFondo.addEventListener('click', evento => {
        if (evento.target === modalFondo) cerrarDetalles();
    });

    modalAgregar.addEventListener('click', () => {
        if (!productoModalActual) return;
        agregarAlCarrito(productoModalActual);
        cerrarDetalles();
    });

    document.addEventListener('keydown', evento => {
        if (evento.key === 'Escape') {
            cerrarPanel();
            if (!modalFondo.hidden) cerrarDetalles();
        }
    });

    actualizarFavoritos();
    renderizarCarrito();
    aplicarFiltros();
})();
=======
// Carrito //
const botones = document.querySelectorAll(".boton-comprar");
const listaCarrito = document.getElementById("lista-carrito");
const totalTexto = document.getElementById("total");
const botonVaciar = document.getElementById("vaciar-carrito");
const botonFinalizar = document.getElementById("finalizar-compra")
let carrito = [];

//Actualizar carrito//
function actualizarCarrito() {
    listaCarrito.innerHTML = "";
    let total = 0;
    carrito.forEach((item, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
            <div class="item-carrito">
                <img
                    src="${item.imagen}"
                    alt="${item.nombre}"
                    width="60"
                    height="60">
                <div class="info-producto">
                    <strong>${item.nombre}</strong><br>
                    Precio: $${item.precio.toLocaleString()}<br><br>
                    Cantidad:
                    <input
                        type="number"
                        min="1"
                        value="${item.cantidad}"
                        data-index="${index}"
                        class="cantidad">
                    <button
                        class="eliminar"
                        data-index="${index}">
                        Eliminar
                    </button>
                </div>
            </div>
            <hr>
        `;
        listaCarrito.appendChild(li);
        total += item.precio * item.cantidad;
    });
    totalTexto.innerHTML = `<strong>Total:</strong> $${total.toLocaleString()}`;

    // Cambiar cantidades
    document.querySelectorAll(".cantidad").forEach(input => {
        input.addEventListener("change", function () {
            const indice = this.dataset.index;
            let cantidad = parseInt(this.value);
            if (cantidad < 1 || isNaN(cantidad)) {
                cantidad = 1;
            }
            carrito[indice].cantidad = cantidad;
            actualizarCarrito();
        });
    });

    // Eliminar productos
    document.querySelectorAll(".eliminar").forEach(btn => {
        btn.addEventListener("click", function () {
            const indice = this.dataset.index;
            carrito.splice(indice, 1);
            actualizarCarrito();
        });
    });
}

// Agregar productos //
botones.forEach(boton => {
    boton.addEventListener("click", () => {
        const nombre = boton.dataset.nombre;
        const precio = Number(boton.dataset.precio);
        const imagen = boton.dataset.imagen;
        const existente = carrito.find(producto => producto.nombre === nombre);
        if (existente) {
            existente.cantidad++;
        } else {
            carrito.push({

                nombre,
                precio,
                imagen,
                cantidad: 1

            });
        }
        actualizarCarrito();
    });
});

// Vaciar carrito //
botonVaciar.addEventListener("click", () => {
    carrito = [];
    actualizarCarrito();
});

//Finalizar compra //
botonFinalizar.addEventListener("click", () => {
    if (carrito.length === 0) {
        alert("El carrito está vacío.");
        return;
    }
    alert("¡Gracias por tu compra!");
    carrito = [];
    actualizarCarrito();
});
>>>>>>> 98c7256777a4f70eeec4b11cecf55b89ba80faf3
