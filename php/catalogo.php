<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PharMago</title>
    <link rel="icon" href="../imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/catalogo.css">
</head>

<body>
  <!-- ENCABEZADO -->
    <header>
        <div class="contenedor">
            <img src="../imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="./php/soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="../index.php">INICIO</a>
            <a href="./catalogo.php">CATÁLOGO</a>
            <a href="../registro.php">REGISTRO</a>
            <a href="../iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>

      <!-- CONTENIDO -->
  <main>
    <section class="catalogo-grid">
      <div class="producto">
        <img src="../imagenes/warfarina-5mg.png" alt="Warfarina 5mg">
        <h3>Warfarina 5mg</h3>
        <p>
          Previene coágulos sanguíneos y ayuda a reducir el riesgo de eventos trombóticos graves. Puede aumentar el riesgo de sangrado abundante.
        </p>
        <ul>
          <li><strong>Precio:</strong> $62.500</li>
          <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
          class="boton-comprar"
          data-imagen="../imagenes/warfarina-5mg.png"
          data-nombre="Warfarina 5mg"
          data-precio="62500">
          🛒 Comprar
        </button>
      </div>
        
      <div class="producto">
          <img src="../imagenes/vitaminac-500mg.png" alt="Vitamina C 500mg">
          <h3>Vitamina C 500mg</h3>
          <p>
              Esencial para el crecimiento y reparación de tejidos. Necesaria para producir colágeno, un componente clave de la piel, ligamentos y vasos sanguíneos.
          </p>
          <ul>
              <li><strong>Precio:</strong> $4.400</li>
              <li><strong>Presentación:</strong> Tabletas</li>
          </ul>
          <button
              class="boton-comprar"
              data-imagen="../imagenes/vitaminac-500mg.png"
              data-nombre="Vitamina C 500mg"
              data-precio="4400">
              🛒 Comprar
          </button>
      </div>

      <div class="producto">
          <img src="../imagenes/vaporub.png" alt="Vaporub 50g">
          <h3>Vaporub 50g</h3>
          <p>
              Alivia los síntomas del resfriado común y la gripe, como congestión nasal, tos y dolores musculares leves.
          </p>
          <ul>
              <li><strong>Precio:</strong> $19.000</li>
              <li><strong>Presentación:</strong> Ungüento</li>
          </ul>
          <button
              class="boton-comprar"
              data-imagen="../imagenes/vaporub.png"
              data-nombre="Vaporub 50g"
              data-precio="19000">
              🛒 Comprar
          </button>
      </div>

      <div class="producto">
          <img src="../imagenes/pediasure-400g.png" alt="Pediasure 400g">
          <h3>Pediasure 400g</h3>
          <p>
              Se utiliza para apoyar el crecimiento y desarrollo de los niños, ayudando a mejorar su estado nutricional y fortalecer el sistema inmunológico.
          </p>
          <ul>
              <li><strong>Precio:</strong> $56.000</li>
              <li><strong>Presentación:</strong> Polvo</li>
          </ul>
          <button
              class="boton-comprar"
              data-imagen="../imagenes/pediasure-400g.png"
              data-nombre="Pediasure 400g"
              data-precio="56000">
              🛒 Comprar
          </button>
      </div>

      <div class="producto">
          <img src="../imagenes/PARACETAMOL.avif" alt="Paracetamol 500mg">
          <h3>Paracetamol 500mg</h3>
          <p>
              Alivia el dolor y reduce la fiebre. El uso de dosis elevadas puede ocasionar daño hepático.
          </p>
          <ul>
              <li><strong>Precio:</strong> $7.500</li>
              <li><strong>Presentación:</strong> Tabletas</li>
          </ul>
          <button
              class="boton-comprar"
              data-imagen="../imagenes/PARACETAMOL.avif"
              data-nombre="Paracetamol 500mg"
              data-precio="7500">
              🛒 Comprar
          </button>
      </div>

      <div class="producto">
          <img src="../imagenes/NaproxenoSodico-275mg.png" alt="Naproxeno Sódico 275mg">
          <h3>Naproxeno Sódico 275mg</h3>
          <p>
              Ayuda a reducir la fiebre y aliviar dolores leves causados por cefaleas, dolores musculares, artritis y cólicos menstruales.
          </p>
          <ul>
              <li><strong>Precio:</strong> $9.500</li>
              <li><strong>Presentación:</strong> Tabletas</li>
          </ul>
          <button
              class="boton-comprar"
              data-imagen="../imagenes/NaproxenoSodico-275mg.png"
              data-nombre="Naproxeno Sódico 275mg"
              data-precio="9500">
              🛒 Comprar
          </button>
          </div>

      <div class="producto">
        <img src="../imagenes/ibu.png" alt="Ibuprofeno 800mg">
        <h3>Ibuprofeno 800mg</h3>
        <p>
            Alivia el dolor y reduce la fiebre. En algunos pacientes suele ser más efectivo para aliviar el dolor de corta duración.
        </p>
        <ul>
            <li><strong>Precio:</strong> $4.500</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/ibu.png"
            data-nombre="Ibuprofeno 800mg"
            data-precio="4500">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/Ensure-400g.png" alt="Ensure 400g">
        <h3>Ensure 400g</h3>
        <p>
            Suplemento nutricional que ayuda a mantener y recuperar la masa muscular en adultos, complementando una alimentación equilibrada.
        </p>
        <ul>
            <li><strong>Precio:</strong> $79.000</li>
            <li><strong>Presentación:</strong> Polvo</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/Ensure-400g.png"
            data-nombre="Ensure 400g"
            data-precio="79000">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/benzerinverde-120mL.png" alt="Benzerin Verde 120 mL">
        <h3>Benzerin Verde 120 mL</h3>
        <p>
            Spray bucal con propiedades antiinflamatorias, analgésicas, anestésicas y antisépticas, indicado para aliviar el dolor e irritación de la garganta, boca y encías.
        </p>
        <ul>
            <li><strong>Precio:</strong> $64.500</li>
            <li><strong>Presentación:</strong> Líquido</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/benzerinverde-120mL.png"
            data-nombre="Benzerin Verde 120 mL"
            data-precio="64500">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/ATORVASTATINA.png" alt="Atorvastatina 20mg">
        <h3>Atorvastatina 20mg</h3>
        <p>
            Se utiliza para reducir los niveles de colesterol y triglicéridos en la sangre, ayudando a disminuir el riesgo de enfermedades cardiovasculares.
        </p>
        <ul>
            <li><strong>Precio:</strong> $8.500</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/ATORVASTATINA.png"
            data-nombre="Atorvastatina 20mg"
            data-precio="8500">
            🛒 Comprar
      </button>
      </div>

      <div class="producto">
        <img src="../imagenes/AMOXICILINA.png" alt="Amoxicilina 500mg">
        <h3>Amoxicilina 500mg</h3>
        <p>
            Antibiótico utilizado para tratar diversas infecciones bacterianas, como neumonía, bronquitis, infecciones de oído, garganta y vías urinarias.
        </p>
        <ul>
            <li><strong>Precio:</strong> $7.000</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/AMOXICILINA.png"
            data-nombre="Amoxicilina 500mg"
            data-precio="7000">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/acetaminofen-500mg.png" alt="Acetaminofén 500mg">
        <h3>Acetaminofén 500mg</h3>
        <p>
            Indicado para aliviar el dolor leve o moderado y reducir la fiebre. También puede utilizarse para tratar cefaleas, dolores musculares, resfriados y dolor de garganta.
        </p>
        <ul>
            <li><strong>Precio:</strong> $8.500</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/acetaminofen-500mg.png"
            data-nombre="Acetaminofén 500mg"
            data-precio="8500">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/acetaminofenniños-160mg.png" alt="Acetaminofén 160mg (Niños)">
        <h3>Acetaminofén 160mg (Niños)</h3>
        <p>
            Indicado para aliviar el dolor y reducir la fiebre en niños. Puede utilizarse en casos de resfriado común, dolor de garganta, cefalea y otros dolores leves, siempre bajo la dosis recomendada.
        </p>
        <ul>
            <li><strong>Precio:</strong> $14.000</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/acetaminofenniños-160mg.png"
            data-nombre="Acetaminofén 160mg (Niños)"
            data-precio="14000">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
      <img src="../imagenes/omeprazol.png" alt="Omeprazol 20mg">
      <h3>Omeprazol 20mg</h3>
      <p>
          Reduce la producción de ácido en el estómago, ayudando a tratar la acidez, el reflujo gastroesofágico y otras afecciones relacionadas con el exceso de ácido.
      </p>
      <ul>
          <li><strong>Precio:</strong> $10.000</li>
          <li><strong>Presentación:</strong> Tabletas</li>
      </ul>
      <button
          class="boton-comprar"
          data-imagen="../imagenes/omeprazol.png"
          data-nombre="Omeprazol 20mg"
          data-precio="10000">
          🛒 Comprar
      </button>
      </div>

      <div class="producto">
        <img src="../imagenes/levotiroxina.png" alt="Levotiroxina Sódica 100mcg">
        <h3>Levotiroxina Sódica 100mcg</h3>
        <p>
            Medicamento utilizado para tratar el hipotiroidismo y otras alteraciones de la glándula tiroides. También puede emplearse como parte del tratamiento del cáncer de tiroides.
        </p>
        <ul>
            <li><strong>Precio:</strong> $19.000</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/levotiroxina.png"
            data-nombre="Levotiroxina Sódica 100mcg"
            data-precio="19000">
            🛒 Comprar
        </button>
      </div>

      <div class="producto">
        <img src="../imagenes/AMLODIPINA-10MG.png" alt="Amlodipina 10mg">
        <h3>Amlodipina 10mg</h3>
        <p>
            Ayuda a controlar la presión arterial alta al relajar los vasos
            sanguíneos, facilitando el flujo de sangre y reduciendo el
            esfuerzo que realiza el corazón.
        </p>
        <ul>
            <li><strong>Precio:</strong> $15.000</li>
            <li><strong>Presentación:</strong> Tabletas</li>
        </ul>
        <button
            class="boton-comprar"
            data-imagen="../imagenes/AMLODIPINA-10MG.png"
            data-nombre="Amlodipina 10mg"
            data-precio="15000">
            🛒 Comprar
        </button>
      </div>
    </section>

    <!---Carrito --->
    <aside class="carrito" id="carrito">
      <h2>🛒 Carrito de Compras</h2>
      <ul id="lista-carrito">
        <!-- Los productos se agregarán aquí automáticamente -->
      </ul>
      <hr>
        <div class="carrito-total">
            <p id="total">
              <strong>Total:</strong> $0
            </p>
        </div>
        <div class="acciones-carrito">
          <button
            id="vaciar-carrito"
            class="boton-vaciar">
            🗑️ Vaciar carrito
          </button>
          <button
            id="finalizar-compra"
            class="boton-finalizar">
            ✅ Finalizar compra
          </button>
        </div>
    </aside>
  </main>

  <!---SCRIPT--->
  <script src="../js/catalogo.js"></script>

  <!--- PIE --->
  <footer>
  Contáctanos al: +57 xxxxxxxxx o: PharMago_official en las redes
  <br>
  <div class="ejemplo">
      <div class="derechos">
        <p>&copy; 2025 <span class="titulo-animado">PharMago</span> | Desarrollado en el programa Técnico en Programación de Software.</p>
        <p>
          Este sitio web utiliza imágenes y recursos con propósitos de aprendizaje.  
          Créditos a <a href="https://pixabay.com" target="_blank">Pixabay</a>, 
          <a href="https://www.google.com/" target="_blank">Google</a>, 
          <a href="https://youtube.com" target="_blank">YouTube</a>, 
          y fuentes de libre uso en la web.
        </p>
      </div>
    </div>
  </footer>

</body>
</html>