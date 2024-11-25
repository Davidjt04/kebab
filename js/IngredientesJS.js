window.addEventListener('load',  function () { // Cambiamos a una función asíncrona
    //----------------------------------------------------------------
    //REQUESTS DE LOS INGREDIENTES
    //----------------------------------------------------------------
    // Hacer la request para mandar los ingredientes a la API
    const url = 'http://localhost/2DAW/SERVIDOR/kebab/api/ApiIngredientes.php';

    function cogerIngrediente(id) {
        // Hacer la solicitud HTTP
        // console.log(id);
        return fetch(`${url}?id=${id}`, {
            method: 'GET'
        })
        .then(response => {
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error(`Error en la respuesta del servidor: ${response.status} ${response.statusText}`);
            }
            // Convertir la respuesta a JSON y devolverla
            return response.json();
        })
        .then(data => {
            // Aquí puedes hacer lo que necesites con los datos
            // console.log("Datos del ingrediente recibidos:", data);
            // console.log(JSON.stringify(data));
            return JSON.stringify(data);  // Devuelves los datos obtenidos
        })
        .catch(e => {
            console.error('Error GET:', e);
        });
    }

    async function cogeringredientes(){
        //recojo los datos del get 
        $ingedientes = await cogerIngrediente();
        return $ingredientes;
        
    }
    // cogerIngrediente(1);

    // async function llevarIngredientePost(){
    //     //primero creo los lugares donde voy a meater los datos del ingrediente
        


    // }
    //----------------------------------------------------------------
    //METODOS DE LOS INGREDIENTES
    //----------------------------------------------------------------
    //cuando se pulse la targeta me lleva a la pagina de mantenimiento de ingrediente

    function crearTarjeta(id){
        //Llamo al json que me devuelve la request get
        // console.log(id);
        cogerIngrediente(id).then(datosjson => {
        // let datosjson = cogerIngrediente($id);
        // console.log(datosjson);
        //devuelve un array clave->valor
        let arrayDatos = JSON.parse(JSON.stringify(datosjson));
        // console.log(arrayDatos);
        // let valores;
        // for(objeto in arrayDatos){
        //     // console.log(`${objeto}:${arrayDatos[objeto]}`);
        //     valores = `${objeto}:${arrayDatos[objeto]}`;
        let tarjeta;
        /*SI ARRAY DATOS ES UN NUMERO SE HACE DE ESTA FORMA SI ARRAY DATOS ES UN ARRAY
        DE OBJETOS SE TIENE QUE HACER DE OTRA*/
        if(!Array.isArray(arrayDatos)){
    //voy metiendo los valores en un innerhtml que será el de la tarjeta
    tarjeta = `<div class="tarjeta">
    <img src="${arrayDatos.foto}" alt="${arrayDatos.nombre}">
    <div class="cuerpoTarjeta">
        <h3>${arrayDatos.nombre}</h3>
        <p>Precio:${arrayDatos.precio}</p>

        <button>Modificar</button>
    </div>`;

    let div = document.getElementById('contenedorTarjetasDinamicas');
    div.innerHTML = tarjeta;

    }else{
        let subarray = arrayDatos[0];
        //METER EL CODIGO PARA TRATAR CON UN ARRAY DE OBJETOS 
        //recorro el array de datos 
        subarray.forEach((objeto) =>{
            // console.log(objeto.foto);
            // console.log(`Elemento en índice ${index}:`, objeto);
            // console.log(objeto);
            // console.log(objeto[1].nombre);
            // let routeImg = "http://localhost/2DAW/SERVIDOR/kebab/recursos/img/";
            // ${routeImg}
            tarjeta = `<div class="tarjeta">
                <img src="${objeto.foto}" alt="${objeto.nombre}">
                <div class="cuerpoTarjeta">
                    <h3>${objeto.nombre}</h3>
                    <p>Precio:${objeto.precio}</p>
            
                    <button>Modificar</button>
                </div>`;
        div = document.getElementById('contenedorTarjetasDinamicas');
        let newDiv = document.createElement('div');
        newDiv.classList.add('newDiv');
        div.appendChild(newDiv);
        newDiv.innerHTML = tarjeta;

        })


    }
        })
}
crearTarjeta("todos");
// let json = cogerIngrediente(1);
// console.log(JSON.parse(json));













});
