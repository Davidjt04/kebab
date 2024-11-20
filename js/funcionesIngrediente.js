/* <script src = "/2DAW/SERVIDOR/kebab/js/IngredientesJS.js"></script> */
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


function crearTarjeta($id){
    //Llamo al json que me devuelve la request get
    let datosjson = cogerIngrediente($id);
    //devuelve un array clave->valor
    let arrayDatos = JSON.parse(datosjson);
    console.log("aergweth");
    arrayDatos.forEach(dato => {
        console.log(dato.id);
    });




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


