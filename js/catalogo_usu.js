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

    const modalFondo = document.getElementById('modal-fondo');
    const cerrarModal = document.getElementById('cerrar-modal');
    const modalImagen = document.getElementById('modal-imagen');
    const modalCategoria = document.getElementById('modal-categoria');
    const modalNombre = document.getElementById('modal-nombre');
    const modalDescripcion = document.getElementById('modal-descripcion');
    const modalPresentacion = document.getElementById('modal-presentacion');
    const modalPrecio = document.getElementById('modal-precio');
    const modalAgregar = document.getElementById('modal-agregar');

    const panelCarrito = document.getElementById('carrito-panel');
const fondoCarrito = document.getElementById('carrito-fondo');
const abrirCarrito = document.getElementById('abrir-carrito');
const cerrarCarrito = document.getElementById('cerrar-carrito');

    let categoriaActual = 'Todos';
    
    let favoritos = JSON.parse(localStorage.getItem('pharmago_favoritos') || '[]');
    let productoModalActual = null;

    const dinero = valor => '$' + Number(valor).toLocaleString('es-CO');

   

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

  abrirCarrito.addEventListener('click', abrirPanel);
cerrarCarrito.addEventListener('click', cerrarPanel);
fondoCarrito.addEventListener('click', cerrarPanel);

   


    

    

    

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
    
    // Modal.
    cerrarModal.addEventListener('click', cerrarDetalles);
    modalFondo.addEventListener('click', evento => {
        if (evento.target === modalFondo) cerrarDetalles();
    });

    
    

    actualizarFavoritos();
    
    aplicarFiltros();
})();

