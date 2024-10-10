function registro() {
    window.location.replace("users/registro");
}

function comprova() {
    let boto = document.getElementById("consulta");
    //consultaAPI();
    crearImagen();
}

async function consultaAPI() {
    try {
        let nomPokemon = document.getElementById("nomPokemon").value.toLowerCase();
        //Pequeña validacion por si el usuario introduce un nombre en blanco
        if (nomPokemon.trim().length < 1) {
            console.log("es buit");
            return;
        }
        let rutaAPI = `https://pokeapi.co/api/v2/pokemon/${nomPokemon}`;
        //const res = await fetch("https://pokeapi.co/api/v2/pokemon/ditto");
        const res = await fetch(rutaAPI);

        if (!res.ok) {
            throw new Error("Hem entrat al error...");
        }
        const data = await res.json();
        console.log(data.id);
        let nombrePokemon = data.species.name;
        let ruta = data.sprites.front_default;
        let idPokemon = data.id;
        crearImagen(ruta, nombrePokemon, idPokemon);
    } catch (error) {
        console.error(`Entramos en el error ${error}`);
    }
}

/**
 * Funcion con nomenclatura arrow 
 * que utilizaremos para cargar TODOS los pokemons de primera generacion.
 * 
 * NOTA: Crearemos una vista para cada generacion de pokemons para asi tener mucha mas informacion de cada pokemon.
 *
 */
const data = async () => {
    try {
        const res = await fetch("https://pokeapi.co/api/v2/pokemon-species/384");
        if (!res.ok) {
            throw new Error("Hem entrat al error...");
        }
        const data = await res.json();
        // console.log(data);
        data.flavor_text_entries.forEach(element => {
            // console.log(element);
            if (element.language.name === "es") {
                console.log(element);
            }
        });
        //console.log(data.flavor_text_entries[44].flavor_text);
        //crearImagen(data);
    } catch (error) {
        console.error(`Entramos en el error ${error}`);
    }
}

function crearImagen(ruta, nombrePokemon, idPokemon) {
    let contenedor = document.getElementById("contenedorImagen");
    // let contenedor = document.getElementById("card");
    let crearImg = document.createElement("img");
    crearImg.setAttribute("id", "imatge");
    crearImg.setAttribute("src", ruta)
    contenedor.appendChild(crearImg);
    crearBodyCard(contenedor, nombrePokemon, idPokemon);
}
/**
 * Funcion que utilizamos para poder mostrar la informacion de los pokemons en cada uno de los cards.
 * 
 * NOTA: Queremos crear una pestaña que sea mas informacion para mostrar : 
 *  - Tipos del pokemon, EV's i IV's, y alguna informacion mas
 *  - Tenemos que anotar que numero de la pokedex es el pokemon al lado del nombre.
 *  
 * @param {*} contenedorGeneral 
 * @param {*} nombrePokemon 
 * @param {*} idPokemon 
 */
async function crearBodyCard(contenedorGeneral, nombrePokemon, idPokemon) {
    console.log(`Este es el nombre: ${nombrePokemon}`);
    let contenedor = document.createElement("div");
    contenedor.setAttribute("class", "card-body");
    let h5 = document.createElement("h5");
    h5.setAttribute("class", "card-title");
    h5.innerHTML = nombrePokemon;
    contenedor.appendChild(h5);
    let p = document.createElement("p");
    p.setAttribute("class", "card-text");
    let descripcionPokedex = await consultaDescripcionPokedex(idPokemon);
    p.innerText = descripcionPokedex;
    contenedor.appendChild(p);
    let a = document.createElement("a");
    a.setAttribute("href", "#");
    a.setAttribute("class", "btn btn-primary");
    a.innerText = "Mas informacion";
    contenedor.appendChild(a);
    contenedorGeneral.appendChild(contenedor);
}
/**
 * Funcion realizada para la consulta de descripcion de la pokedex de los pokemons.
 * 
 *  * NOTA: Hemos descubierto que hay ciertos pokemons que su descripcion en la pokedex NO siempre es la misma, por ejemplo
 *      - La descripcion de la pokedex de Ditto en español esta en la posicion numero 50
 *      - La descripcion de la pokedex de Rayquaza en español esta en la posicion numero 44.
 * Tenemos que revisar como queremos tratar estos datos
 *  
 * @param {*} id Identificador unico del pokemon.
 * @returns Devuelve la descripcion de la pokedex de un pokemon en concreto.
 */
async function consultaDescripcionPokedex(id) {
    try {
        let endpoint = `https://pokeapi.co/api/v2/pokemon-species/${id}`;
        const res = await fetch(endpoint);
        if (!res.ok) {
            throw new Error("Error en el endpoint.");
        }
        const data = await res.json();
        console.log(data);
        return data.flavor_text_entries[50].flavor_text;
    } catch (error) {
        console.error(`Hemos entrado al error de la consulta a la descripcion de la pokedex ${error}`);
    }
}

document.addEventListener("DOMContentLoaded", data(), false);