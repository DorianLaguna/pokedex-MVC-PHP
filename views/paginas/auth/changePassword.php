<section class="contenedor">
    <h2>New password</h2>
    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($allow) : ?>
    
    <div class="contenedor-formulario">
        <form method="POST" class="formulario">

            <p class="description-form">Write your new password</p>
            
            <div class="entrada-formulario">
                <label for="email">New password: </label>
                <input id="email" type="password" placeholder="Your new password" name="password" value="<?php $correo ?>" required>
            </div>

            <input type="submit" value="Send" class="boton-send">
    
        </form>
    </div>

    <?php endif; ?>
</section>
<section class="contenedor">
    <?php if(!$allow) : ?>
            <div class="contenedor-log-in">
                <a href="./create">Create account</a>
                <a href="./login">Login</a>
            </div>
    <?php endif; ?>
</section>