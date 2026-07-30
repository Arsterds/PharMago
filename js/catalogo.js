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