<?php
$obras = json_decode(file_get_contents('datos/obras.json'), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Proyecto PHP</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Proyecto PHP - Gestión de Obras y Personajes</h1>
        <p>En esta plataforma podrás registrar y gestionar obras (series, películas, libros) y sus personajes asociados.</p>
        <ul>
            <li><a href="registrar_obra.php">Registrar Obra</a></li>
            <li><a href="agregar_personaje.php">Agregar Personaje</a></li>
            <li><a href="ver_obras.php">Ver Obras</a></li>
        </ul>

        <h2>Obras Registradas</h2>
        <?php if (!empty($obras)): ?>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <?php foreach ($obras as $obra): ?>
                    <div style="background-color: #2b2d42; padding:10px; border-radius:8px; width:180px; text-align:center;">
                        <?php if (!empty($obra['foto_url'])): ?>
                            <img src="<?= $obra['foto_url'] ?>" alt="Foto de la obra" width="150" style="border-radius:5px;"><br>
                        <?php endif; ?>
                        <strong><?= $obra['nombre'] ?></strong><br>
                        <span><?= $obra['tipo'] ?></span><br>
                        <span><?= $obra['pais'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay obras registradas aún.</p>
        <?php endif; ?>
    </div>
</body>
</html>
