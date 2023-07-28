<div class="header">

    <!-- barra de busqueda -->
    <div class="busqueda-cont">

        <form method="GET" class="form-busqueda form-styles" action="/pokemon">
            
        <input type="text" placeholder="Search Pokemon" name="pokemon-name" class="busqueda">
            
            <button class="busqueda-submit boton-styles" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                </svg>
            </button>
        </form>

    </div>

    <!-- titulo -->
    <div class="pokedex centrado">
    <a href="/">Pokedex</a>    
    </div>

     <!-- icono de logout -->
    
     

    <!-- Navegacion -->
    <div class="navegador">
        <!-- icono para desplegar menu -->
        <div class="item-nav">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="36" height="36" viewBox="0 0 24 24" stroke-width="2.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 6l16 0" />
                <path d="M4 12l16 0" />
                <path d="M4 18l16 0" />
            </svg>
        </div>

        <!-- Menu -->
        <div class="fondo-cierra oculta sel">
            <div class="enlaces-nav">
                <button class="cerrar">X</button>
                <a href="/myPokedex">My Pokedex</a>
                <a href="/list">List</a>
                
                <!-- Login -->
                <?php if($auth): ?>
                    <a href="/logout" class="logout-contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                            </svg>
                    </a>
                <?php endif; ?>
    
                <!-- Logout -->
                <?php if(!$auth): ?>
                    <a href="/login" class="logout-contenedor">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>

        <!-- </div> -->

        
        
    </div>
</div>

<div class="overlay oculta">
  <div class="ventana-emergente">
        <button class="cerrar boton-cierra">X</button>

        <form method="GET" class="form-busqueda form-styles" action="/pokemon">
            
            <input type="text" placeholder="Search Pokemon" name="pokemon-name" class=" busqueda" id="campo-name">
                
                <button class="boton-styles busqueda-submi" type="submit">
                    Search
                </button>
        </form>
  </div>
</div>