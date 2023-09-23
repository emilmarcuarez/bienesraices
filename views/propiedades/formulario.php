<fieldset>
            <legend>
                Informacion general de la propiedad
            </legend>
            <!-- el name sera el que se manda a la base de datos, lee los datos, por medio de esa variable que es el nombre que le coloquemos es name -->
            <label for="titulo">Titulo: </label>
            <input type="text" name="propiedad[titulo]" id="titulo" placeholder="titulo propiedad" value="<?php echo s($propiedad->titulo); ?>">

            <label for="titulo">Precio: </label>
            <input type="number" name="propiedad[precio]" id="precio" placeholder="titulo propiedad" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen</label>
            <!-- con accept solo permite aceptar imagen jpeg y png-->
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
                <?php if($propiedad->imagen) {?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">          
                    <?php }?>
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion propiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños: </label>
            <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

            <label for="Estacionamiento">Estacionamiento: </label>
            <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="propiedad[vendedorId]" id="vendedor">
                <option selected value="">--Seleccione--</option>
                <?php foreach ($vendedores as $vendedor) : ?>
                    <option 
                    <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''
                    ?>
                    value="<?php echo s($vendedor->id); ?>"> <?php echo s($vendedor->nombre) . " ". s($vendedor->apellido); ?></option>
                    <?php endforeach?>
                </select>
        </fieldset>