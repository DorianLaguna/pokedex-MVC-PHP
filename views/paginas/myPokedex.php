<h2>My PoKedex</h2>

<?php include_once __DIR__ . '/templates/alertas.php' ?>

<section class="Mis favoritos contenedor">
    <h4>My favorite pokemon</h4>
    <div class="contenedor-favorito contenedor">
        <div class="my-favorite" >
            <button type="hidden" value="<?php echo $favorito ?>" class="oculta pok-favorite"></button>
            <p class="nombre-fav"></p>
        </div>
        <div class="habilidades">
            <p>Abilities</p>
        </div>
    </div>
    <?php
    ?>
<div class="contenedor-grupos-pokedex contenedor">

    <?php if($grupos){
    for($i = 0 ; $i<$grupos ; $i++){ ?>

    <div class="equipo<?php echo $i+1?>">
        <div class="titulo-equipo">
            <h3 class="nombre-equipo">Team <?php echo $i+1 ?></h3>
            <button class="boton-editar-nombre">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
            </button>
            
                
            <div class="overlay overlay-nombre oculta">
                <div class="ventana-emergente cambio-nombre">
                    <button class="cerrar boton-cierra">X</button>
                    <form method="POST" class="form-busqueda form-styles">
                        <input type="hidden" name="tipo" value="edit">
                        <input type="hidden" name="id" class="valor-equipo valor-tea">
                        <input type="text" placeholder="New Name" name="team-name" class=" busqueda" id="campo-name">
                            
                            <button class="boton-styles busqueda-submi" type="submit">
                                Change
                            </button>
                    </form>
                </div>
            </div>

            

        </div>
        <div class="only-pokemones">

        
        <?php for($j=0; $j<6 ; $j++){ ?>

            <div class="pokemon-equipo">
                <div class="without-pokemon">
                    <a href="/list">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#8ec9e6" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M20.985 12.528a9 9 0 1 0 -8.45 8.456" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                                <path d="M9 10h.01" />
                                <path d="M15 10h.01" />
                                <path d="M9.5 15c.658 .64 1.56 1 2.5 1s1.842 -.36 2.5 -1" />
                        </svg>
                    </a>
                </div>
                <p class="nombre-pokemon-equipo"></p>
                <div class="oculta contenedor-acciones-pokedex">
                    <div class="acciones-pokedex ">
                        <form method="POST">
                            <input type="hidden" name="tipo" value="delete">
                            <input type="hidden" class="valor-equipo" name="equipo">
                            <input type="hidden" class="valor-pokemon" name="pokemon">
                            <button type="input">Delete</button>
                        </form>
                    </div>

                </div>
            </div>


            <?php   } ?>
            </div>
    </div>

    <?php }
    //terminan 2 for
    }else { ?>

    <div class="no-pokemon">
        <p>There is no team yet</p>
    </div>

    <?php } ?>
        
</div>

    

</section>