<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $obra = [
        "codigo" => $_POST['codigo'],
        "foto_url" => $_POST['foto_url'],
        "tipo" => $_POST['tipo'],
        "nombre" => $_POST['nombre'],
        "descripcion" => $_POST['descripcion'],
        "pais" => $_POST['pais'],
        "autor" => $_POST['autor']
    ];
    $datos = json_decode(file_get_contents('datos/obras.json'), true);
    $datos[] = $obra;
    file_put_contents('datos/obras.json', json_encode($datos, JSON_PRETTY_PRINT));
    echo "<script>alert('Obra registrada exitosamente'); window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Obra</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nueva Obra</h2>
        <form method="post">
            <label>Código</label><input type="text" name="codigo" required>
            <label>Foto URL</label><input type="text" name="foto_url" required>
            <label>Tipo</label>
            <select name="tipo">
                <option>Serie</option>
                <option>Película</option>
                <option>Otro</option>
            </select>
            <label>Nombre</label><input type="text" name="nombre" required>
            <label>Descripción</label><textarea name="descripcion"></textarea>
            <label>País</label><input type="text" name="pais">
            <label>Autor</label><input type="text" name="autor">
            <button class="button" type="submit">Registrar Obra</button>
        </form>
        <a href="index.php">Volver al inicio</a>
    </div>
</body>
</html>

