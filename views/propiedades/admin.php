
<main class="contenedor seccion">
    <h1>Administrador de bienes y raices</h1>
    <!-- estos numeros de resultado se mandan por el header que redirecciona a la pagina principal-->
    <?php 
    if($resultado){
         $mensaje=mostrarNotificacion(intval($resultado));
        if($mensaje){?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        
        
        <?php } ?>
    <?php } ?>
    
<a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
<a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
<h2>Propiedades</h2>
<table class="propiedades contenedor">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        </theader>

    <tbody>
        <!-- MOSTRAR RESULTADOS DE LA BD EN LA TABLA -->
        <?php foreach ($propiedades as $propiedad) : ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                <td><?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <!-- ESTOS INPUT HIDDEN SIRVEN PARA MANDAR INFORMACION, QUE EN ESTE CASO ES EL ID -->
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">

                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2>Vendedores</h2>

<table class="propiedades contenedor">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Foto</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </theader>

    <tbody>
        <!-- MOSTRAR RESULTADOS DE LA BD EN LA TABLA -->
        <?php foreach ($vendedores as $vendedor) : ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><img src="../imagenes_vendedor/<?php echo $vendedor->imagen; ?>" class="imagen-tabla" alt=""></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td><?php echo $vendedor->email; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <!-- ESTOS INPUT HIDDEN SIRVEN PARA MANDAR INFORMACION, QUE EN ESTE CASO ES EL ID -->
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</main>