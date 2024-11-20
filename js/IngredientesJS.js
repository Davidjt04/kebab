window.addEventListener('load',  function () { // Cambiamos a una función asíncrona
    //----------------------------------------------------------------
    //REQUESTS DE LOS INGREDIENTES
    //----------------------------------------------------------------
    // Hacer la request para mandar los ingredientes a la API
    const url = 'http://localhost/2DAW/SERVIDOR/kebab/api/ApiIngredientes.php';

    // async function cogerIngrediente(id) {
    //     try {
    //         // Hacer la solicitud HTTP y esperar la respuesta
    //         const response = await fetch(`${url}?id=${id}`, { 
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             method: 'GET'
    //         });

    //         // console.log("Solicitud enviada"); // Mensaje de depuración

    //         // Verificar si la respuesta es exitosa
    //         if (!response.ok) { // Usamos .ok para verificar el estado
    //             // console.log("asdasg");
    //             throw new Error(`Error en la respuesta del servidor: ${response.status} ${response.statusText}`);
    //         }
    //         // console.log("bbbbb");

    //         // Convertir la respuesta a JSON y esperar a que se complete
    //         const data = await response.json();
    //         // console.log("Datos del ingrediente recibidos:", data); // Imprimimos los datos obtenidos
    //         return data;
    //     } catch (e) {
    //         console.error('Error GET:', e);
    //     }
    // }
// function hola(){
//     console.log("hola");
// }

function cogerIngrediente(id) {
    // Hacer la solicitud HTTP
    return fetch(`${url}?id=${id}`, {
        headers: {
            'Content-Type': 'application/json'
        },
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
        return data;  // Devuelves los datos obtenidos
    })
    .catch(e => {
        console.error('Error GET:', e);
    });
}
    // cogerIngrediente(1);

    // async function llevarIngredientePost(){
    //     //primero creo los lugares donde voy a meater los datos del ingrediente
        


    // }
    //----------------------------------------------------------------
    //METODOS DE LOS INGREDIENTES
    //----------------------------------------------------------------
    //cuando se pulse la targeta me lleva a la pagina de mantenimiento de ingrediente



/*Aqui tendre los addlistener de las tarjetas*/

function primeratarjeta(){
    // document.addEventListener('click', cogerIngrediente($id));
    //creo el div donde se va a alojar
    const divTargeta = document.createElement('div');
    //le añado la clase que va a tener
    divTargeta.classList.add('tarjeta');

    //le añado un texto 
    const texto = document.createElement('h3');
    texto.textContent = 'title';
    //añado el titulo al cuerpo de la tarjeta
    divTargeta.appendChild(texto);

}


function crearTarjeta(id){
    //Llamo al json que me devuelve la request get
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


    //     // console.log(valores);
    //     // for(valores in objeto){
    // //         console.log(objeto[clave]);
    // //     };
    // }
    /*SI ARRAY DATOS ES UN NUMERO SE HACE DE ESTA FORMA SI ARRAY DATOS ES UN ARRAY
    DE OBJETOS SE TIENE QUE HACER DE OTRA*/
    if(!Array.isArray(arrayDatos)){
   //voy metiendo los valores en un innerhtml que será el de la tarjeta
   let tarjeta = `<div class="tarjeta">
   <img src="${arrayDatos.foto}" alt="${arrayDatos.nombre}">
   <div class="cuerpoTarjeta">
       <h3>${arrayDatos.nombre}</h3>
       <p>Precio:${arrayDatos.precio}</p>

       <button>Modificar</button>
   </div>`;


   // arrayDatos.forEach(dato => {
   //     console.log(dato.id);
   // });
   let div = document.getElementById('contenedorTarjetasDinamicas');
   console.log(div);
   div.innerHTML = tarjeta;
   }else{
    //METER EL CODIGO PARA TRATAR CON UN ARRAY DE OBJETOS 

   }
    })
    // .catch(err => {
    //     console.error("La tarjeta no se ha introducido correctamente");
    // });
    



    // // document.addEventListener('click', cogerIngrediente($id));
    // //creo el div donde se va a alojar
    // const divTargeta = document.createElement('div');
    // //le añado la clase que va a tener
    // divTargeta.classList.add('tarjeta');

    // //creo la imagen de la tarjeta
    // const img = document.createElement('img');
    // //creamos el src para dar la ubicacion de la imagen 
    // img.src = ''; //ruta de la targeta 
    // //texto alternativo para la imagen 
    // img.alt = title + "Imagen";
    // //añado la imagen a la targeta
    // divTargeta.appendChild(img);


    // //creo el div del cuerpo de la tarjeta
    // const cuerpo = document.createElement('div');
    // //le añado la clase que va a tener
    // divTargeta.classList.add('cuerpoTarjeta');
    // //añado el cuerpo a la targeta
    // divTargeta.appendChild(cuerpo);

    // //le añado un texto 
    // const texto = document.createElement('h3');
    // texto.textContent = 'title';
    // //añado el titulo al cuerpo de la tarjeta
    // cuerpo.appendChild(texto);

    // //le añado la descripcion 
    // const descripcion = document.createElement('p');
    // descripcion.textContent = 'texto de la carta'
    // //añado el titulo al cuerpo de la tarjeta
    // cuerpo.appendChild(descripcion);

    // //le añado un boton
    // const boton = document.createElement('button');
    // boton.textContent = 'Modificar';
    // //añado el boton al cuerpo de la tarjeta
    // cuerpo.appendChild(boton);

    // //creo el div donde metere toda la tarjeta siendo este el div que se devolverá
    // const contenedor = document.createElement('div');

    // return contenedor;
}
crearTarjeta(1);
// let json = cogerIngrediente(1);
// console.log(JSON.parse(json));













});
