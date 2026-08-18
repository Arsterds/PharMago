console.log("✅ Script de registro cargado correctamente");

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#formContacto");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // evita recargar el formulario

    const nombre = document.getElementById("nombre").value.trim();
    const nombre_de_usuario = document.getElementById("nombre_de_usuario").value.trim();
    const tipoDocumento = document.getElementById("tipoDocumento").value.trim();
    const identificacion = document.getElementById("identificacion").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const contrasena = document.getElementById("contrasena").value.trim();
    const confirmar_contrasena = document.getElementById("confirmar_contrasena").value.trim();





    // Validar solo números en identificacion 
    if (identificacion && !/^\d+$/.test(identificacion)) {
      alert("❌ El numero de identificacion debe contener solo números.");
      return;
    }

    // Validar solo números en teléfono (si se escribe)
    if (telefono && !/^\d+$/.test(telefono)) {
      alert("❌ El teléfono debe contener solo números.");
      return;
    }

    // Validar correo electrónico
    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(correo)) {
      alert("❌ Ingresa un correo válido.");
      return;
    }


    // Validar contraseña
    if (contrasena.length < 8) {
      alert("❌ La contraseña debe tener al menos 8 caracteres.");
      return;
    }

    // Validar coincidencia de contraseñas
    if (contrasena !== confirmar_contrasena) {
      alert("❌ Las contraseñas no coinciden.");
      return;
    }





    // Guardar usuario en localStorage
    const usuario = { nombre, nombre_de_usuario, tipoDocumento, identificacion, telefono, correo, contrasena, confirmar_contrasena };
    localStorage.setItem("usuarioRegistrado", JSON.stringify(usuario));

    // Limpiar formulario
    form.reset();
  });
  function noReincioForm() {
    event.preventDefault();
  }

});
