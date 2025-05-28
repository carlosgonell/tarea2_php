<?php
$obras = json_decode(file_get_contents('datos/obras.json'), true);
$personajes = json_decode(file_get_contents('datos/personajes.json'), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Obras</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Listado de Obras</h2>
        <?php if (empty($obras)): ?>
            <p>No hay obras registradas aún.</p>
        <?php else: ?>
            <?php foreach ($obras as $obra):
                $cantidad = count(array_filter($personajes, fn($p) => $p['codigo_obra'] == $obra['codigo']));
            ?>
                <div style="margin-bottom:20px; padding:10px; border:1px solid #3a86ff; border-radius:8px;">
                <h3><?= $obra['nombre'] ?> (<?= $obra['tipo'] ?>)</h3>
                <?php if (!empty($obra['foto_url'])): ?>
                <img src="<?= $obra['foto_url'] ?>" alt="Foto de la obra" width="150" style="margin-bottom:10px;">
                <?php endif; ?>
                <p><strong>País:</strong> <?= $obra['pais'] ?></p>
                <p><strong>Personajes:</strong> <?= $cantidad ?></p>
                <a href="detalle.php?codigo=<?= $obra['codigo'] ?>" class="button">Detalle</a>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
        <a href="index.php">Volver al inicio</a>
    </div>
</body>
</html>
