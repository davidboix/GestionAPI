<main>
    <?php if (isset($data)) {echo "esta inicialitzat";return;} ?>
    <!-- form_open el utilitzarem si hem de fer un formulari que utilitzi el metode POST. -->
    <div id="contenedorForm">
        <div>
            <?= form_open("users/login", array("id" => "formularioUsuario")) ?>
                <span>Usuario</span>
                <input class="inputLogin" type="text" name="user" placeholder="Introduce el nombre del usuario">
                <span>Contraseña</span>
                <input class="inputLogin" type="password" name="password" placeholder="Introduce la contraseña">
                <input type="submit" value="Login">
            <?= form_close(); ?>
        </div>
    </div>
    <p>No tienes usuario?</p><input type="button" onclick="registro()" value="Registrate"></input>
</main>