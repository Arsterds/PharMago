document.addEventListener("DOMContentLoaded", function () {

    const formulario = document.getElementById("formContacto");
    const mensaje = document.getElementById("mensajeExito");

    if (!formulario) return;

    formulario.addEventListener("submit", function (e) {

        e.preventDefault();

        // Validar el formulario
        if (!formulario.checkValidity()) {
            formulario.reportValidity();
            return;
        }

        // Mostrar mensaje de éxito
        mensaje.style.display = "block";

        // Limpiar formulario
        formulario.reset();

        // Ocultar mensaje después de 3 segundos
        setTimeout(function () {
            mensaje.style.display = "none";
        }, 3000);

    });

});