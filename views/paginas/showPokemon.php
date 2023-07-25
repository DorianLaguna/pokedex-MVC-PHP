<section class="contenedor no-Pokemon">
    <div class="parte-superior">

    <?php include_once __DIR__ . '/templates/alertas.php' ?>
        <!-- Botones de accion -->
        <div class="acciones contenedor-acciones boton-index">
            

            <div class="add">
                <form method="POST" class="form-acciones">
                    <div class="form-acciones">
                        <input type="hidden" value="favorite" name="boton">
                        <input type="hidden" name="id" class="boton-valor">
                        <button type="submit" class="boton-accion boton-favorito">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="add">
                    <button type="submit" class="boton-accion boton-añadir">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 12h6" />
                            <path d="M12 9v6" />
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        </svg>
                    </button>
            </div>

            <!-- Muesta los grupos que hay -->
            <div class="fondo oculta">
                <div class="contenedor-add">
                    <div class="deten contenedor-grupos-usuario">
                        <button class="boton-cerrar">X</button>
                        <form method="POST">
                            <input type="hidden" value="new" name="boton">
                            <input type="hidden" name="id" class="boton-valor" value="1">
                            <input type="submit" value="New Group" class="boton-accion boton-add">
                        </form>
                        
                    </div>
                </div>
            </div>
                
        </div>


        <!-- Pokemon info -->
        <div class="contenedor contenedor-pokemon_day">
            <div class="contenedor-info">
                <div class="info">
                    <h2 id="name"><?php echo $name ?? ''?></h2>
                    <p id="weight"></p>
                    <p id="height"></p>
                </div>
                <div class="imagen">
                    <img src="" alt="Unkown" id="image">
                </div>
            </div>

            <div class="contenedor-tipo">
                <h4>Type of Pokemon</h4>
                <p class="type-pokemon"></p>
            </div>
        </div>

        
    </div>

</section>