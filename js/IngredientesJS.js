window.addEventListener('load', async function () { // Cambiamos a una función asíncrona
    function crearEleccionIngredientes(){
        // 
    }








    // Hacer la request para mandar los ingredientes a la API
    const url = 'http://localhost/2DAW/SERVIDOR/kebab/api/ApiIngredientes.php';

    async function cogerIngrediente(id) {
        try {
            // Hacer la solicitud HTTP y esperar la respuesta
            const response = await fetch(`${url}?id=${id}`, { 
                headers: {
                    'Content-Type': 'application/json'
                },
                method: 'GET'
            });

            console.log("Solicitud enviada"); // Mensaje de depuración

            // Verificar si la respuesta es exitosa
            if (!response.ok) { // Usamos .ok para verificar el estado
                // console.log("asdasg");
                throw new Error(`Error en la respuesta del servidor: ${response.status} ${response.statusText}`);
            }
            // console.log("bbbbb");

            // Convertir la respuesta a JSON y esperar a que se complete
            const data = await response.json();
            // console.log(data);
            console.log("Datos del ingrediente recibidos:", data); // Imprimimos los datos obtenidos
            return data;
        } catch (e) {
            console.error('Error GET:', e);
        }
    }
    // Llamar a la función y esperar su resultado
    cogerIngrediente(1);


    async function llevarIngredientePost(){
        //primero creo los lugares donde voy a meater los datos del ingrediente
        
    }

});
