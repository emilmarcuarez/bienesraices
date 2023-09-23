
<main class="contenedor seccion">
    <h1>Crear propiedad</h1>
     <!-- FOREACH PARA IR MOSTRANDO LOS ERRORES ALMACENADOS EN EL ARREGLO DE ERRORES EN LA PAGINA -->
     <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

     <!-- boton de volver -->
     <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php';?>
 
        <input type="submit" id="btnEnviar" value="Crear propiedad" class="boton boton-verde">
    </form>
    
</main>