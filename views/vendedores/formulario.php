<fieldset>
            <legend>
                Informacion general
            </legend>
            <!-- el name sera el que se manda a la base de datos, lee los datos, por medio de esa variable que es el nombre que le coloquemos es name -->
            <label for="nombre">Nombre: </label>
            <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

            <label for="nombre">Apellido: </label>
            <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
          
            <label for="imagen">Foto de perfil: </label>
            <input type="file" name="vendedor[imagen]" id="imagen" accept="image/jpeg, image/png, image/jpg" value="<?php echo s($vendedor->imagen); ?>">
            <?php if($vendedor->imagen){?>
                <img src="/imagenes_vendedor/<?php echo $vendedor->imagen ?>" class="imagen-small">          
            <?php }?>
</fieldset>

<fieldset>
    <legend>Informacion extra</legend>
    <label for="telefono">Telefono: </label>
            <input type="text" name="vendedor[telefono]" id="telefono" placeholder="Telefono vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
    <label for="email">Email: </label>
            <input type="email" name="vendedor[email]" id="email" placeholder="E-mail vendedor(a)" value="<?php echo s($vendedor->email); ?>">
 
</fieldset>