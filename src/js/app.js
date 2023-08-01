document.addEventListener('DOMContentLoaded', function(){
   
    iniciarApp();
});

let pokemonId;
let isRequestPending = false;
function iniciarApp(){
    
    const urlActual = window.location.pathname;
    
    ocultarAlertas();
    busqueda();
    menu();
    oculta();
    window.addEventListener('resize', busqueda);
    window.addEventListener('resize', oculta);
    
    //index
    if(urlActual === '/' || urlActual.includes('pokemon')){
        consultarAPI();
        botonesGrupos();
        ApiGrupos();
    }

    //pokedex personal
    if(urlActual  === '/myPokedex'){
        ApiGrupos();
        favorito();
        botonEditarNombre();
    }

    //Lista pokemones
    if(urlActual === '/list'){
        consultarLista()
        botonesGrupos()
        ApiGrupos();
    }
}

async function consultarAPI(){
    let id = document.querySelector('#name').textContent
    id = id.toLowerCase();
    if(!id){
        id = numRandom = generarNumeroAleatorio(1, 1010);
    }

    try {
        //Consulta el pokemon a mostrar por cada dia
        const link = 'https://pokeapi.co/api/v2/pokemon/' + id;
        resultado = await fetch(link);
        pokemon = await resultado.json();
        muestraPokemon(pokemon);
        muestraEstadisticas(pokemon);
        pokemonId = pokemon.id;
        //coloca el id a los botones de acciones
        botonId(pokemonId);
        
    } catch (error) {
        noPokemon();
        console.log(error);
    }
}

function generarNumeroAleatorio(min, max) {
    var fecha = new Date();
    var seed = fecha.getFullYear() * 10000 + (fecha.getMonth() + 1) * 100 + fecha.getDate(); // Obtener la fecha actual como semilla en formato 'yyyymmdd'
    
    // Generar un número pseudoaleatorio a partir de la semilla
    var numeroAleatorio = (seed * 9301 + 49297) % 233280;
    var resultado = numeroAleatorio / 233280; // Normalizar el resultado a un número entre 0 y 1
    
    // Ajustar el número al rango deseado
    numeroAleatorio = Math.floor(resultado * (max - min + 1)) + min;
    
    return numeroAleatorio;
}
  
function muestraPokemon(pokemon){

    const {name, height, types, weight, sprites} = pokemon;
    const imagen = sprites.front_default ?? sprites.front_shiny;
    
    //Concatenar el tipo/s de pokemon 
    typePokemon = ''
    types.forEach( function(tipo){
        typePokemon += tipo.type.name + ' ';
    });

    
    //seleccionar espacios
    const gapName = document.querySelector('#name');
    const gapHeight = document.querySelector('#height');
    const gapWeight = document.querySelector('#weight');
    const gapImage = document.querySelector('#image');
    const gapType = document.querySelector('.type-pokemon');
    //Colocarles su valor
    gapName.textContent = name;
    gapWeight.textContent = 'Weight: ' + weight/10 + ' Kg';
    gapHeight.textContent = 'Height: ' + height/10 + ' m';
    gapImage.src = imagen;
    gapType.textContent = typePokemon;
    
}

function muestraEstadisticas(pokemon){
    //Crear parrafos de cada stat
    const {stats} = pokemon;
    const divCant = document.querySelectorAll('#cantidad');
    const barra = document.querySelectorAll('#barra');

    i= 0;

    stats.forEach(function(estadistica){
        const cantidad = estadistica.base_stat;
        
        //Añade el valor de cada stat al span y width
        divCant[i].textContent = `${cantidad}`;
        barra[i].style.width = cantidad/2 + '%';
        i++;
    })
}

function menu(){
    //muestra el menu
    const boton = document.querySelector('.item-nav');
    const navLista = document.querySelector('.enlaces-nav');
    const contenedor = document.querySelector('.fondo-cierra');
    boton.addEventListener('click', function (){ 
        navLista.classList.toggle('oculta');
        contenedor.classList.remove('oculta');
    })

    //cierra el menu
    const botonCierra = document.querySelector('.cerrar');
    botonCierra.addEventListener('click', function(){
        navLista.classList.add('oculta');
        contenedor.classList.add('oculta')
    })
    contenedor.addEventListener('click', function(){
        contenedor.classList.add('oculta')
        navLista.classList.add('oculta');
    })
    navLista.addEventListener('click', (event) => {
        event.stopPropagation();
      });
}

function busqueda(){
    //muestra u oculta el overlay de busqueda. Solo funciona si es size < 1024
    const busca = document.querySelector('.busqueda-submit');
    const overlay = document. querySelector('.overlay');
    const campo = document.querySelector('.ventana-emergente');
    const botonCierra = document.querySelector('.boton-cierra')
    if(window.innerWidth < 1024){
        //añade la funcion para mostrar el overlay
        busca.addEventListener('click', eventosBoton);

        //cierra el overlay

        botonCierra.addEventListener('click', function(){
            overlay.classList.add('oculta');
        });

        overlay.addEventListener('click', function(){
        overlay.classList.add('oculta');
        });

    }else{
        //Resetea valor del boton del formulario
        busca.removeEventListener('click', eventosBoton);
    }

    //detiene la propagacion del click para que no se cierre el formulario cuando presiona el campo
    campo.addEventListener('click', (event) => {
        event.stopPropagation();
      });
}

function oculta(){
    //agrega o quita la barra de navegacion
    const navLista = document.querySelector('.enlaces-nav');
    const fondo = document.querySelector('.sel');

    if(window.innerWidth < 1024){
        navLista.classList.add('oculta');
        fondo.classList.add('fondo-cierra');
        fondo.classList.add('oculta')

    }else{
        navLista.classList.remove('oculta');
        fondo.classList.remove('fondo-cierra');
        fondo.classList.remove('oculta')
    }
}
function eventosBoton(event){
    //muestra el overlay  
    const overlay = document.querySelector('.overlay');
    event.preventDefault();
    overlay.classList.remove('oculta');
}

function noPokemon(){
    //elimina ventanas de informacion pokemon
    const parteSuperior = document.querySelector('.parte-superior');
    const statsPok = document.querySelector('.estadisticas');
    parteSuperior.classList.add('oculta');
    statsPok.classList.add('oculta');

    //Crea la ventana
    const div = document.createElement('DIV');
    const error = document.createElement('H2');
    const parrafo = document.createElement('P');

    div.classList.add('ventana-error');
    error.textContent = '¡Error!';
    parrafo.textContent = 'Pokemon not found';
    div.appendChild(error);
    div.appendChild(parrafo);

    //Agrega a la pagina
    const agrega = document.querySelector('.no-Pokemon');
    agrega.appendChild(div);

}

function botonId(id){
    //agrega valor del id a los botones de accion
    const boton = document.querySelectorAll('.boton-valor');
    
    boton.forEach(element => {
        element.value = id;
    });
    
}

function ocultarAlertas(){
    const alerta = document.querySelector('.alerta');
    if(alerta){
        setTimeout(() => {
            alerta.remove();
        }, 4000);

    }
}

async function ApiGrupos(){

    try {

        //conseguir id Usuario
        const urlSesion = `${location.origin}/api/sesion`;
        const resSesion = await fetch(urlSesion);

        const resultadoSesion = await resSesion.json();
        const idUsuario = resultadoSesion.id;
    

        //conseguir grupos de los usuarios
        const url = `${location.origin}/api/grupos?idUsuario=` + idUsuario;
        respuesta = await fetch(url,{
            method: 'GET'
        });
        const resultado = await respuesta.json();

        //si es index solo muestra el nombre de grupos
        const urlActual = window.location.pathname
        if( urlActual === '/' || urlActual.includes('pokemon') || urlActual.includes('/list')){
            gruposUsuario(resultado);
        }else{
            mostrarGrupos(resultado);
        }

    } catch (error) {
        console.log(error);
    }
}

async function mostrarGrupos(grupos) {

    try {
        gruponumero = 1;
        for (const grupo of grupos) {
            //crea un nuevo arreglo con los valores del id de cada pokemon de cada grupo
            const valores = Object.values(grupo);
            const idPokemon = [];

            
            for (let i = 2; i < 8; i++) {
                if (valores[i] != '0') {
                    idPokemon.push(valores[i]);
                }
            }
            //coloca el nombre del equipo
            const nombre = document.querySelectorAll('.nombre-equipo');
            if(grupo.nombre != 'Group'){
                nombre[gruponumero-1].textContent = `${grupo.nombre}`; 
            }
            
            //coloca id al equipo
            const idEquipo = document.querySelectorAll('.valor-tea');
            idEquipo[gruponumero-1].value = grupo.id;
            
            largo = idPokemon.length;

            if (largo > 0) {

                equipo = '.equipo' + `${1}`;
                
                for (j=0;j<largo;j++) {
                    //peticion a la API
                    const url = 'https://pokeapi.co/api/v2/pokemon/' + idPokemon[j];
                    const resultado = await fetch(url);
                    const pokemon = await resultado.json();
                    
                    const equipoNumero = document.querySelector(`.equipo${gruponumero}`)
                    const equipoPokemon = equipoNumero.querySelectorAll('.pokemon-equipo');

                    //coloca nombre
                    

                    //coloca id
                    const id = equipoPokemon[j].querySelector('.nombre-pokemon-equipo');
                    id.textContent = `#${pokemon.id}`;    

                    //quita el icono y botones de accion
                    const icon = equipoPokemon[j].querySelector('.without-pokemon');
                    const botonesAccion = equipoPokemon[j].querySelector('.contenedor-acciones-pokedex');
                    botonesAccion.classList.remove('oculta')
                    icon.classList.add('oculta')
                    
                    //crea la imagen
                    const imagen = document.createElement('IMG');
                    imagen.src = pokemon.sprites.front_default ?? pokemon.sprites.front_shiny;
                    //inserta antes de los botones de accion
                    equipoPokemon[j].insertBefore(imagen, equipoPokemon[j].children[2]);

                    //agrega valor a los botones de delete
                    const valorPokemon = equipoPokemon[j].querySelector('.valor-pokemon');
                    const valorEquipo = equipoPokemon[j].querySelector('.valor-equipo');
                    valorPokemon.value = pokemon.id;
                    valorEquipo.value = gruponumero;

                }
            }
            gruponumero++;
        }

    } catch (error) {
        console.error(error);
    }
}


async function favorito(){
    //obtener contenedor y valor
    const contenedor = document.querySelector('.contenedor-favorito');
    const valor = contenedor.querySelector('.pok-favorite');
    id = valor.value;

        const link = 'https://pokeapi.co/api/v2/pokemon/' + id;
        resultado = await fetch(link);
        pokemon = await resultado.json();

    //asignar valores
    const nombre = contenedor.querySelector('.nombre-fav');
    nombre.textContent = pokemon.name;
    
    //crear y colocar imagen
    const lugar = contenedor.querySelector('.my-favorite')
    const imagen = document.createElement('IMG');
    imagen.src = pokemon.sprites.front_default ?? pokemon.sprites.front_shiny;
    lugar.appendChild(imagen);

    const habilidades = contenedor.querySelector('.habilidades');
    numeroHabilidades = pokemon.abilities;

    numeroHabilidades.forEach(habilidad => {
        const nombreHabilidad = document.createElement('P');
        nombreHabilidad.textContent = "-" + habilidad.ability.name;
        habilidades.appendChild(nombreHabilidad);
    });

}

function gruposUsuario(grupos){
    const urlActual = window.location.pathname;
    if(urlActual.includes('list')){
        lugar = '.pokemons-busqueda-lista';
    }else{
        lugar = '.boton-index';
    }
    const espacio = document.querySelector(lugar)
    const contenedores = espacio.querySelectorAll('.contenedor-grupos-usuario');

    contenedores.forEach( contenedor => {
        grupoNumero = 1;
        //crea un div con un parrafo por cada grupo
        grupos.forEach(grupo => {
            //crea
            const form = document.createElement('FORM');
            const button = document.createElement('BUTTON');
    
            //añade clases
            form.classList.add('grupo-usuario');
    
            //añade valores al formulario
            form.method = 'POST';
                //id grupo
            const valorGrupo = document.createElement('INPUT');
            valorGrupo.type = 'hidden';
            valorGrupo.value = grupo.id;
            valorGrupo.name = 'grupo'
                //id pokemon
            const valorPok = document.createElement('INPUT');
            valorPok.classList.add('boton-valor');
            valorPok.value = pokemonId
            valorPok.type = 'hidden'
            valorPok.name = 'id'
    
            //tipo boton
            const valorBoton = document.createElement('INPUT');
            valorBoton.value = 'add'
            valorBoton.type = 'hidden'
            valorBoton.name = 'boton'
            //agrega a formulario
            form.appendChild(valorGrupo)
            form.appendChild(valorPok)
            form.appendChild(valorBoton)
    
            //coloca nombre de equipo
            if(grupo.nombre === 'Group'){    
                button.textContent = grupo.nombre + ` ${grupoNumero}`;
            }else{
                button.textContent = grupo.nombre;
            }
    
            //agrega
            form.appendChild(button);
            contenedor.appendChild(form);
    
            grupoNumero++;
        });

    })
}

function botonEditarNombre(){
    const contenedor = document.querySelectorAll('.titulo-equipo');

    contenedor.forEach( equipo =>{
        const boton = equipo.querySelector('.boton-editar-nombre');
        const overlay = equipo.querySelector('.overlay-nombre');
            
    
        boton.addEventListener('click', function(){
            //muestra la ventana
            overlay.classList.remove('oculta');
    
            const campo = overlay.querySelector('.ventana-emergente');
            const botonCierra = overlay.querySelector('.boton-cierra')
    
            //cierra el overlay
            botonCierra.addEventListener('click', function(){
                overlay.classList.add('oculta');
            });
            overlay.addEventListener('click', function(){
            overlay.classList.add('oculta');
            });
    
    
        //detiene la propagacion del click para que no se cierre el formulario cuando presiona el campo
        campo.addEventListener('click', (event) => {
            event.stopPropagation();
          });
        })

    })
    

}

async function consultarLista(){
    const botonBusqueda = document.querySelector('#botonLista');

        mainList('id');
    botonBusqueda.addEventListener('click', function(){
        consultarListaToApi();
    })
}

async function consultarListaToApi(){
    //conseguir valores del formulario
    const tipo = document.querySelector('#tipo-pokemon').value
    const generacion = document.querySelector('#generacion').value
    const orden = document.querySelector('#order').value

    if(tipo === '' && generacion === ''){
        mainList(orden);
    }else if(tipo === '' && generacion !== ''){
        lista(generacion,'generation',orden);

    }else if(tipo !== '' && generacion === ''){
        lista(tipo,'type', orden)

    }else if(tipo !== '' && generacion !== ''){
        listaVarios(tipo, generacion, orden);
    }
    
    
}

async function lista(extra, busca, orden,  id=0, valor=null ){
    
    try {
        if (isRequestPending) {
            return; // Si hay una solicitud pendiente, no hacer nada
        }
        isRequestPending = true;
        //pokemones de generacion
        url = 'https://pokeapi.co/api/v2/' + busca + '/' + extra 
        resultado = await fetch(url);
        generationPokemones = await resultado.json();
        if(url.includes('https://pokeapi.co/api/v2/generation/')){
            group = generationPokemones.pokemon_species
        }else{
            group = (generationPokemones.pokemon).map(objetoExterno => ( objetoExterno.pokemon));
        }

        if(valor === 'next'){
            const next = document.querySelectorAll('.boton-next');
            id = next[0].value;
        }else if(valor === 'preview'){
            const preview = document.querySelectorAll('.boton-preview');
            id = preview[0].value;
        }
        id2 = (parseInt(id) + 20)

        //ordena y obtiene los primeros 20;
        const grupoOrdenado = ordenarGrupo(group, orden)
        const grupo = grupoOrdenado.slice(id,id2);
       
        times = grupo.length;
        ajustarDivs(times);
        mostrarLista(grupo)


        //conseguir index del pokemon final e inicial
        let first = grupo[0] ? grupoOrdenado.findIndex(objeto => objeto.name === grupo[0].name) : null;
        const last = grupo[19] ? grupoOrdenado.findIndex(objeto => objeto.name === grupo[19].name) + 1 : first;
        if(id !== 0 && first !== 0){
            //no pasa el 0
            first -= 20;
        }
        
        //asigna valores al boton del pokemon siguiente o anterior
        botonesLista(last, first, orden, 'list', busca, extra);
        isRequestPending = false;

    } catch (error) {
        console.log(error)
    }
    
}

async function listaVarios(newTipo, newGeneracion, orden, id=0, valor=null ){
    try {
        if (isRequestPending) {
            return; // Si hay una solicitud pendiente, no hacer nada
        }
        isRequestPending = true;

        const tipo = newTipo;
        const generacion = newGeneracion;

        url = 'https://pokeapi.co/api/v2/type/' + tipo;
        resultado = await fetch(url)
        pokemonesTipo = await resultado.json();

        url = 'https://pokeapi.co/api/v2/generation/' + generacion;
        resultado = await fetch(url)
        pokemonesGeneracion = await resultado.json();

        const grupoTipo = (pokemonesTipo.pokemon).map(objetoExterno => ( objetoExterno.pokemon));
        const grupoGeneration = pokemonesGeneracion.pokemon_species;

        const ambosFiltros = obtenerNombresEnComun(grupoTipo, grupoGeneration);
        let ordenados = ordenarGrupo(ambosFiltros, orden);
        
        //obtener el valor si se quiere adelantar o ir atras una pagina
        if(valor === 'next'){
            const next = document.querySelectorAll('.boton-next');
            id = next[0].value;
        }else if(valor === 'preview'){
            const preview = document.querySelectorAll('.boton-preview');
            id = preview[0].value;
        }

        //asignar valor a id2 para que pueda traer solo los pokemones necesarios
        id2 = (parseInt(id) + 20)
        grupo = ordenados.slice( id , id2 );
        
        times = grupo.length;
        ajustarDivs(times);
        
        mostrarLista(grupo)
        
        //conseguir index del pokemon final e inicial
        let first = grupo[0] ? ordenados.findIndex(objeto => objeto.name === grupo[0].name) : null;
        const last = grupo[19] ? ordenados.findIndex(objeto => objeto.name === grupo[19].name) + 1 : first;
        if(id !== 0 && first !== 0){
            //no pasa el 0
            first -= 20;
        }
        
        //asigna valores al boton del pokemon siguiente o anterior
        botonesLista(last, first, orden, 'varios', tipo, generacion);
        isRequestPending = false;

    } catch (error) {
        console.log(error)
    }
}


async function mainList(orden, id = 0, valor = null){
    try {
        if (isRequestPending) {
            return; // Si hay una solicitud pendiente, no hacer nada
        }
        isRequestPending = true;
        //obtener el valor si se quiere adelantar o ir atras una pagina
        if(valor === 'next'){
            const next = document.querySelectorAll('.boton-next');
            id = next[0].value;
        }else if(valor === 'preview'){
            const preview = document.querySelectorAll('.boton-preview');
            id = preview[0].value
        }

        //asignar valor a id2 para que pueda traer solo los pokemones necesarios
        id2 = (parseInt(id) + 20)
        all = await consultaAllPokemones();
        ordenados = ordenarGrupo(all, orden)
        grupo = ordenados.slice( id , id2 )

        times = grupo.length;
        ajustarDivs(times);
        mostrarLista(grupo)
        
        //conseguir index del pokemon final e inicial
        let first = ordenados.findIndex(objeto => objeto.name === grupo[0].name);
        const last = grupo[19] ? ordenados.findIndex(objeto => objeto.name === grupo[19].name) + 1 : ordenados.findIndex(objeto => objeto.name === grupo[0].name);
        if(id !== 0 && first !== 0){
            //no pasa el 0
            first -= 20;
        }
        
        //asigna valores al boton del pokemon siguiente o anterior
        botonesLista(last, first, orden, 'main');
        isRequestPending = false;

    } catch (error) {
        console.log(error)
    }
    
}

function botonesLista(siguiente, anterior, order, list,tip = null, genera = null){
    const next = document.querySelectorAll('.boton-next');
    const preview = document.querySelectorAll('.boton-preview');
    nameLista = list;
    tipo = tip;
    generacion = genera;
    orden = order;

    next.forEach(buton => {
        buton.value = siguiente;
        buton.addEventListener('click', function(){
            if(!isRequestPending){
                if(nameLista === 'varios'){
                    listaVarios(tipo, generacion, orden, siguiente, 'next');
                }else if(nameLista === 'main'){
                    mainList(orden, siguiente, 'next');
                }else if(nameLista === 'list'){
                    lista(generacion, tipo, orden, siguiente, 'next');
                }
            }
        });
    });

    preview.forEach(buton => {
        buton.value = anterior;
        buton.addEventListener('click', function(){
            if(!isRequestPending){
                if(nameLista === 'main'){
                    mainList(orden, anterior, 'preview');
                }else if(nameLista === 'varios'){
                    listaVarios(tipo, generacion, orden, anterior, 'preview');
                }else if(nameLista === 'list'){
                    lista(generacion, tipo, orden, anterior, 'preview');
                }
            }
        });
        
    });
}

async function consultaAllPokemones(){
        url = 'https://pokeapi.co/api/v2/pokemon/?limit=1281';
        const resultado = await fetch(url)
        const pokemones = await resultado.json();
        grupo = pokemones.results
        return grupo
}


function mostrarLista(grupo){
    //setTime para que pueda
    setTimeout( async () => {
        
        //volver a obtener los espacios
        const espacio = document.querySelectorAll('.pokemon-lista');
    
        //consultar cada pokemon
        let num = 0
        for(const pokemon of grupo){
            const urlPoke = 'https://pokeapi.co/api/v2/pokemon/' + pokemon.name
            respuesta = await fetch(urlPoke)
            poke = await respuesta.json();
    
    
            const link = espacio[num].querySelector('.referencia-pokemon');
            const nombre = espacio[num].querySelector('.nombre-pokemon-lista');
            const id = espacio[num].querySelector('.id-pokemon-lista');
            const imagen = espacio[num].querySelector('.imagen-pokemon-lista');
            const Form = espacio[num].querySelectorAll('.boton-valor');
    
            Form.forEach(button => {
                button.value = poke.id
            });        
            link.href = '/pokemon?pokemon-name=' + poke.name
            nombre.textContent = poke.name;
            id.textContent = '#' + poke.id;
            imagen.src = poke.sprites.front_default ?? poke.sprites.front_shiny;
    
            num++;
        }
    }, 800);
}

function ordenarGrupo(grupo, orden){

    if(orden === 'id'){
        //la lista que regresa la API ya esta ordenada por ID 
        return grupo;
    }else if(orden === 'abeceInverso'){
        grupo.sort((a,b) => {
            if(a.name > b.name) return -1;
            if(a.name < b.name) return 1;
        })
        return grupo;

    }else{
        grupo.sort((a,b) => {
            if(a.name < b.name) return -1;
            if(a.name > b.name) return 1;
        })
        return grupo;
    }
}

function ajustarDivs(times){
    //eliminar o crear divs necesarios dependiendo del cuantos grupos haya
    const contenedor = document.querySelector('.pokemons-busqueda-lista')
    const espacio = contenedor.querySelectorAll('.pokemon-lista');
    const contenidoInfo = espacio[0].innerHTML;
    numDivs = espacio.length;

    if(times < numDivs){
        for(i=times;i<numDivs;i++){
            espacio[i].remove();
        }
    }else if (times > numDivs){
        for(i=numDivs;i<times;i++){
        const nuevoEspacio = document.createElement('DIV');
        nuevoEspacio.classList.add('pokemon-lista');
        nuevoEspacio.innerHTML = contenidoInfo;
        contenedor.appendChild(nuevoEspacio);
        }
    }
}

function obtenerNombresEnComun(grupo1, grupo2){
    const array = grupo1.filter(objeto => grupo2.map(item => item.name).includes(objeto.name)).map(objeto => ({ name: objeto.name}));

    return array
}

function botonesGrupos(){
    const urlActual = window.location.pathname;
    if(urlActual.includes('list')){
        lugar = '.pokemon-lista';
    }else{
        lugar = '.boton-index';
    }

    const contenedores = document.querySelectorAll(lugar);
    contenedores.forEach(contenedor => {
        
        const botonCierra = contenedor.querySelector('.boton-cerrar')
        const boton = contenedor.querySelector('.boton-añadir');
        const botonAdd = contenedor.querySelector('.boton-add');
        const overlay = contenedor.querySelector('.fondo');
        const deten = contenedor.querySelector('.deten');
    
        //muestra la ventana de los grupos
        boton.addEventListener('click', function(){
            botonAdd.classList.remove('oculta');
            overlay.classList.remove('oculta');
        });
        
        //cierra la ventana de los grupos
        overlay.addEventListener('click', function(){
            botonAdd.classList.add('oculta');
            overlay.classList.add('oculta');
        })
        botonCierra.addEventListener('click', function(){
            botonAdd.classList.add('oculta');
            overlay.classList.add('oculta');
        })
    
        //evita que se cierre cuando se presiona dentro de la ventana
        deten.addEventListener('click', (event) => {
            event.stopPropagation();
          });
    });
}