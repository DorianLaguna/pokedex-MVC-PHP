<h3>List Pokemons</h3>

<?php include_once __DIR__ . '/templates/alertas.php' ?>

<section class="contenedor">
    <div class="filtros-busqueda">
        <form method="POST">
            <div>
                <label for="tipo-pokemon">Type</label>
                <Select name="tipo-pokemon" id="tipo-pokemon">
                    <option value="">All</option>
                    <option value="1">Normal</option>
                    <option value="2">Fighting</option>
                    <option value="3">Flying</option>
                    <option value="4">Poison</option>
                    <option value="5">Ground</option>
                    <option value="6">Rock</option>
                    <option value="7">Bug</option>
                    <option value="8">Ghost</option>
                    <option value="9">Steel</option>
                    <option value="10">Fire</option>
                    <option value="11">Water</option>
                    <option value="12">Grass</option>
                    <option value="13">Electric</option>
                    <option value="14">Psychic</option>
                    <option value="15">Ice</option>
                    <option value="16">Dragon</option>
                    <option value="17">Dark</option>
                    <option value="18">Fairy</option>
                </Select>
            </div>

            <div>
                <label for="generacion">Generation</label>
                <select name="generacion" id="generacion">
                    <option value="">All</option>
                    <option value="1">Red/Blue</option>
                    <option value="2">Gold/Silver</option>
                    <option value="3">Ruby/Sapphire</option>
                    <option value="4">Diamon/pearl</option>
                    <option value="5">Black/White</option>
                    <option value="6">X/Y</option>
                    <option value="7">Sun/Moon</option>
                    <option value="8">Sword/Shield</option>
                    <option value="9">Scarlet/Violet</option>
                </select>

            </div>

            <div>
                <label for="order">Order</label>
                <select name="order" id="order">
                    <option value="id">Id</option>
                    <option value="abece">A-Z</option>
                    <option value="abeceInverso">Z-A</option>
                </select>

            </div>

        </form>
        
        <button id="botonLista">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
            </svg>
        </button>
        
    </div>
    
</section>

<section >
    <div class="contenedor contenedor-lista">
        <div class="botones-paginador">
            <button class="boton-preview">PREVIEW</button>
            <button class="boton-next">NEXT</button>
        </div>
        <div class="pokemons-busqueda-lista">
            <?php for($i = 0; $i<20; $i++): ?>
                <div class="pokemon-lista">
                    <div class="identificador">
                        <p class="nombre-pokemon-lista"></p>
                        <p class="id-pokemon-lista"></p>
                    </div>
                    <div class="">
                        <a href="" class="referencia-pokemon">
                            <img src="" alt="Uknown" class="imagen-pokemon-lista">
                        </a>
                    </div>
                    <div class="botones-pokemon-lista">
                        <!-- botones para agregar -->
                        <div class="favorite-button-list boton-lista">
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

                        <div class="add-button-lista boton-lista">
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

                    </div> <!-- Termina div de botones -->
                </div>
                <?php endfor; ?>
        </div>
        <div class="botones-paginador">
            <button class="boton-preview">PREVIEW</button>
            <button class="boton-next">NEXT</button>
        </div>
    </div>
</section>