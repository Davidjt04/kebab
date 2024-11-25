<!--Página de mantenimiento-->
<body>
    <!--Sección ingredientes -->

    <div class="ingredientes">
        <div class="seccionImagen ">Imagen del ingrediente
           <input type="text" placeholder = "nombre Ingrediente" id= "nombre">
           <div id = "alergenosContenidos"></div>
           <div id = "alerjenosTotales">
                <button id="crearAlerjeno">Crear Alerjeno</button>
           </div>
           <input type="text" placeholder = "Precio Real"class = "precioReal">
           <input type="text" placeholder = "Precio Final"class = "precioFinal">
        </div>
    </div>

    <!--Sección Alergenos-->
    <!-- se habilitará cuando poulsemos el boton de crear alergenos -->
    
    <!--ESTE CODIGO DEBERÍA DE SER UN MODAL QUE APAREZCA CUANDO LE DOY AL BOTON "CREAR ALERJENOS" -->
    <div class="alergenos" disabled>
        <div class="seccionImagen ">Imagen del ingrediente
            <div class="seccionAlerjeno ">alergenos del ingrediente
            <input type="text" placeholder = "nombre alergenos">
            <button id="crear">Crear</button>
            </div>
        </div>
    </div>

    <!-- Botones -->
    <div class="buttons-row">
        <button>Crear</button>
        <button>Cancelar</button>
    </div>
    <script src = ../../js/crearIngredieentes.js></script>
</body>
 </html>