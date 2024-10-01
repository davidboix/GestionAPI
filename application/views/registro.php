<body>
    <?= form_open("users/setRegistro", array("id" => "formRegistro")); ?>
        <input type="text" name="user" id="" placeholder="Introduce el nombre de usuario">
        <input type="password" name="password" id="" placeholder="Introduce la contraseña">
        <input type="submit" value="Registrar">
    <?= form_close();?>
</body>