<section class="contenedor">
    <h2>Login</h2>
    
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    
    <div class="contenedor-formulario">
        <form method="POST" class="formulario">
            
            <div class="entrada-formulario">
                <label for="email">Email: </label>
                <input type="email" placeholder="Your email" name="correo" value="<?php echo $usuario->correo ?>" require>
            </div>

            <div class="entrada-formulario">
                <label for="password">Password: </label>
                <input type="password" placeholder="Your password" name="password" require>
            </div>

            <input type="submit" value="Login" class="boton-send">
    
        </form>
    </div>

    
</section>
<section class="contenedor">
            <div class="contenedor-log-in">
                <a href="./create">I need an account</a>
                <a href="./password">I forgot my password</a>
            </div>
</section>