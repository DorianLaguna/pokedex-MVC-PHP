<section class="contenedor">
    <h2>Change password</h2>
    
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    
    <div class="contenedor-formulario">
        <form method="POST" class="formulario">

            <p class="description-form">Write your email to send you instructions to change your password</p>
            
            <div class="entrada-formulario">
                <label for="email">Email: </label>
                <input id="email" type="email" placeholder="Your email" name="correo" value="<?php $correo ?>" required>
            </div>

            <input type="submit" value="Send" class="boton-send">
    
        </form>
    </div>


</section>
<section class="contenedor">
            <div class="contenedor-log-in">
                <a href="./create">I need an account</a>
            </div>
</section>