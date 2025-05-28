<?php
$obras = json_decode(file_get_contents('datos/obras.json'), true);

if (empty($obras)) {
    echo "<script>alert('No hay obras registradas. Registra una obra primero.'); window.location='registrar_obra.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $personaje = [
        "cedula" => $_POST['cedula'],
        "foto_url" => $_POST['foto_url'],
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "fecha_nacimiento" => $_POST['fecha_nacimiento'],
        "sexo" => $_POST['sexo'],
        "habilidades" => $_POST['habilidades'],
        "comida_favorita" => $_POST['comida_favorita'],
        "codigo_obra" => $_POST['codigo_obra'] // Relación con obra por código
    ];

    $datos = json_decode(file_get_contents('datos/personajes.json'), true);
    $datos[] = $personaje;
    file_put_contents('datos/personajes.json', json_encode($datos, JSON_PRETTY_PRINT));

    echo "<script>alert('Personaje registrado exitosamente.'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Personaje</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Personaje</h2>
        <form method="post">
            <label>Cédula:</label>
            <input type="text" name="cedula" required>

            <label>Foto URL:</label>
            <input type="text" name="foto_url" placeholder="http://... o ruta local">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Apellido:</label>
            <input type="text" name="apellido">

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento">

            <label>Sexo:</label>
            <select name="sexo">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>

            <label>Habilidades (separadas por comas):</label>
            <input type="text" name="habilidades" placeholder="Ej: Volar, Invisibilidad">

            <label>Comida Favorita:</label>
            <input type="text" name="comida_favorita">

            <label>Obra a la que pertenece:</label>
            <select name="codigo_obra" required>
                <option value="">Selecciona una obra</option>
                <?php foreach ($obras as $obra): ?>
                    <option value="<?= $obra['codigo'] ?>">
                        <?= $obra['nombre'] ?> (<?= $obra['codigo'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <button class="button" type="submit">Agregar Personaje</button>
        </form>
        <a href="index.php">Volver al inicio</a>
    </div>
</body>
</html>
