    <?php
    //asigna que tipo de alerta sera
    $key = key($alertas);
    //itera sobre cada alerta
    if($key){
    if($alertas[$key]){
    foreach($alertas[$key] as $alerta){?>

    <!-- Crea un div para mostrar la alerta -->
    <div class="<?php echo $key ?> alerta">
        <p><?php echo $alerta ?></p>
    </div>
        
   <?php }}} ?>