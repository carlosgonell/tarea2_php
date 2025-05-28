<?php
$codigo = $_GET['codigo'] ?? '';
$obras = json_decode(file_get_contents('datos/obras.json'), true);
$personajes = json_decode(file_get_contents('datos/personajes.json'), true);
$obra = array_filter($obras, fn($o) => $o['codigo'] == $codigo);
$obra = reset($obra);
$personajes_obra = array_filter($personajes, fn($p) => $p['codigo_obra'] == $codigo);

function calcularEdad($fecha) {
    if (!$fecha) return '-';
    $nacimiento = new DateTime($fecha);
    $hoy = new DateTime();
    return $hoy->diff($nacimiento)->y;
}

function signoZodiacal($fecha) {
    if (!$fecha) return '-';
    $mesdia = date('m-d', strtotime($fecha));
    if (($mesdia >= '03-21') && ($mesdia <= '04-19')) return 'Aries';
    if (($mesdia >= '04-20') && ($mesdia <= '05-20')) return 'Tauro';
    if (($mesdia >= '05-21') && ($mesdia <= '06-20')) return 'Géminis';
    if (($mesdia >= '06-21') && ($mesdia <= '07-22')) return 'Cáncer';
    if (($mesdia >= '07-23') && ($mesdia <= '08-22')) return 'Leo';
    if (($mesdia >= '08-23') && ($mesdia <= '09-22')) return 'Virgo';
    if (($mesdia >= '09-23') && ($mesdia <= '10-22')) return 'Libra';
    if (($mesdia >= '10-23') && ($mesdia <= '11-21')) return 'Escorpio';
    if (($mesdia >= '11-22') && ($mesdia <= '12-21')) return 'Sagitario';
    if (($mesdia >= '12-22') || ($mesdia <= '01-19')) return 'Capricornio';
    if (($mesdia >= '01-20') && ($mesdia <= '02-18')) return 'Acuario';
    if (($mesdia >= '02-19') && ($mesdia <= '03-20')) return 'Piscis';
    return 'Desconocido';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Obra</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="container">
        <?php if ($obra): ?>
            <h2>Detalle de la Obra</h2>
            <p><strong>Código:</strong> <?= $obra['codigo'] ?></p>
            <?php if (!empty($obra['foto_url'])): ?>
                <img src="<?= $obra['foto_url'] ?>" alt="Foto de la obra" width="200"><br>
            <?php endif; ?>
            <p><strong>Tipo:</strong> <?= $obra['tipo'] ?></p>
            <p><strong>Nombre:</strong> <?= $obra['nombre'] ?></p>
            <p><strong>Descripción:</strong> <?= $obra['descripcion'] ?></p>
            <p><strong>País:</strong> <?= $obra['pais'] ?></p>
            <p><strong>Autor:</strong> <?= $obra['autor'] ?></p>

            <h3>Personajes</h3>
            <?php if (empty($personajes_obra)): ?>
                <p>No hay personajes registrados para esta obra.</p>
            <?php else: ?>
                <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <?php foreach ($personajes_obra as $p): ?>
                    <div style="background-color: #2b2d42; padding:10px; border-radius:8px; width:180px; text-align:center;">
                        <?php if (!empty($p['foto_url'])): ?>
                            <img src="<?= $p['foto_url'] ?>" alt="Foto del personaje" width="150" style="border-radius:5px;"><br>
                        <?php endif; ?>
                        <strong><?= $p['nombre'] ?> <?= $p['apellido'] ?></strong><br>
                        Edad: <?= calcularEdad($p['fecha_nacimiento']) ?><br>
                        Signo: <?= signoZodiacal($p['fecha_nacimiento']) ?>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <button class="button" onclick="window.print()">Imprimir</button>
            <a href="ver_obras.php">Volver</a>
        <?php else: ?>
            <p>Obra no encontrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
