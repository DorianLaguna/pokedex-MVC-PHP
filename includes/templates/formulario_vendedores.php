<fieldset>
    <legend>Informacion General</legend>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
        
        <label for="apellido">Apeliido</label>
        <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
        
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
        
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="vendedor[imagen]" accept="image/jpeg image/png">

        <?php if($vendedor->imagen): ?>

            <img src="/imagenes/<?php echo $vendedor->imagen ?>" class="imagen-small">

        <?php endif; ?>