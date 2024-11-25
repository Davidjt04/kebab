//Creamos los ingrdients
function rellenarCrear(){
//1. traigo el json de ingredientes
let datos = cogeringredientes();
//2. cojo los datos del json de ingredientes
let JSON = JSON.parse(datos);
    //recorro el Json hasta que encuentra el tipo obligatorio 
    //POSIBLE ERROR:que JSON no sea un array sino un array que tiene el array de objetos dentro
    let ingreObliga;
    let ingreComun;
    JSON.forEach((objeto) => {
        if(`${objeto.tipo}`=='obligatorio'){
            ingreObliga= objeto;
        }
        //meto los demas valores en otro array
        ingreComun.push(objeto);
    })
    
    //cojo el tipo obligatorio y lo meto en una variable
    //borro del Json el tipo obligatorio (para mostrarlo luego mas facil)

//3. cojo los campos 
    //imagen
    let imagen = document.querySelector("seccionImagen");
    //input texto 
    let nombreIngr = document.getElementById("nombre").value;
    //div alerContenidos  
    let divContenidos  = [];
    divContenidos = document.getElementById("alergenosContenidos");
    //div alerjenosTotales 
    
    let divTotales = document.getElementById("alerjenosTotales");

    //input number Precio Real
    let precioReal = document.querySelector("precioReal");
    //input number Precio Final
    let precioFinal = document.querySelector("precioFinal");

//4. rellenos los campos de los ingredientes
    for(let i = 0; i <ingreComun.length; i++) {
        //creo div
        let div = document.createElement("div");
        //paso el objeto a string y lo meto mediante el dataset
        div.dataset.objetoCompleto = JSON.stringify(ingreComun[i]);
        //como contaenido del div meto el nombre del objeto 
        div.textContent = ingreComun[i].nombre;
        div.appendChild(ingreComun[i]);

        //añado valor al div 
        divTotales.appendChild(div);
    }
    divContenidos.push(ingreObliga);


//5. hacer un bucle que recorra el JSON 
    //por objeto un div se crea dentro de alerjenos contenido
        //recorro el JSON por cada objeto creo un div 

}

