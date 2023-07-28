<section class="contenedor">

    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <h2>Sign-up</h2>
    
    <div class="contenedor-formulario">
            <form method="POST" class="formulario">
        
        
                <div class="entrada-formulario">
                    <label for="name">Name: </label>
                    <input type="text" placeholder="Your name" name="nombre" value="<?php  echo s($usuario->nombre) ?>" require>
                </div>
        
                <div class="entrada-formulario">
                    <label for="email">Email: </label>
                    <input type="email" placeholder="Your email" name="correo" value="<?php echo  s($usuario->correo) ?>" require>
                </div>
        
                <div class="entrada-formulario">
                    <label for="password">Password: </label>
                    <input type="password" placeholder="Your password" name="password">
                </div>
        
        
                <input type="submit" value="Create" class="boton-send">
            </form>
    </div>
</section>
<section class="contenedor">
            <div class="contenedor-log-in">
                <a href="./login">I have account</a>
                <a href="./password">I forgot my password</a>
            </div>
</section>