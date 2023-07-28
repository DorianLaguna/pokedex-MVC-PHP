<section class="contenedor">
    <h2>Login</h2>
    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    
    <div class="contenedor-formulario">
        <form method="POST" class="formulario">

            <h3>Write your email</h3>
            
            <div class="entrada-formulario">
                <label for="email">Email: </label>
                <input type="email" placeholder="Your email" name="correo" value="<?php echo $usuario->correo ?>" require>
            </div>

            <input type="submit" value="Send" class="boton-send">
    
        </form>
    </div>


</section>