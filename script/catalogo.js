// Array donde guardaremos los productos agregados
    let carrito = [];

    // Seleccionamos todos los botones con la clase .boton-comprar
    const botones = document.querySelectorAll(".boton-comprar");

    // Recorremos los botones y añadimos un evento de clic
    botones.forEach((boton) => {
      boton.addEventListener("click", () => {
        const nombre = boton.getAttribute("data-nombre");
        const precio = parseFloat(boton.getAttribute("data-precio"));

        // Creamos un objeto producto
        const producto = { nombre, precio };

        // Lo agregamos al carrito
        carrito.push(producto);

        // Actualizamos la vista
        mostrarCarrito();
      });
    });

    // Función para mostrar el carrito
    function mostrarCarrito() {
      const contenedor = document.getElementById("carrito");
      contenedor.innerHTML = "<h3>Carrito:</h3>";

      if (carrito.length === 0) {
        contenedor.innerHTML += "<p>Tu carrito está vacío.</p>";
        return;
      }

      let total = 0;

      carrito.forEach((item, index) => {
        contenedor.innerHTML += `<p>${index + 1}. ${item.nombre} - $${item.precio.toFixed(2)}</p>`;
        total += item.precio;
      });

      contenedor.innerHTML += `<hr><p><strong>Total: $${total.toFixed(2)}</strong></p>`;
    }