<fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">
            
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">
           
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg image/png">

                <?php if($propiedad->imagen): ?>

                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">

                <?php endif; ?>
            
                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="propiedad[descripcion]" cols="10" rows="5"><?php echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacionde la propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" name="propiedad[habitaciones]" id="habitaciones" value="<?php echo s($propiedad->habitaciones); ?>" placeholder="Numero de habitaciones" min="1" max="9">

                <label for="wc ">Baños</label>
                <input type="number" name="propiedad[wc]" id="wc" placeholder="Numero de baños" value="<?php echo s($propiedad->wc); ?>" min="1" max="9">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" value="<?php echo s($propiedad->estacionamiento); ?>" placeholder="Numero de estacionamientos" min="1" max="9">

            </fieldset>

            <fieldset>
                <legend>Vendedores</legend>
                
                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedores_id]" id="Vendedor">
                    <option selected value="">-- Seleccione --</option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option 
                            <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
                            value="<?php echo s($vendedor->id) ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> 
                        </option>
                    <?php endforeach; ?>    
                </select>

            </fieldset>