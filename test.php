<?php
require_once 'database.php';

$stmt = $pdo->prepare("
    SELECT p.*, k.navn AS kategori_navn 
    FROM gs_produkter p 
    JOIN gs_kategorier k ON p.kategori_id = k.kategori_id
");
$stmt->execute();
$produkter = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Database Test - GearShop</title>
    <style>
        body { font-family: Arial, sans-serif; background: #121212; color: #fff; padding: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .card { background: #1e1e1e; padding: 15px; border-radius: 8px; border: 1px solid #333; }
        img { max-width: 100%; height: 150px; object-fit: contain; background: #fff; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Test af databaseforbindelse (<?= count($produkter) ?> produkter hentet)</h1>
    <div class="grid">
        <?php foreach ($produkter as $p): ?>
            <div class="card">
                <img src="<?= htmlspecialchars($p['billede_sti']) ?>" alt="<?= htmlspecialchars($p['navn']) ?>">
                <h3><?= htmlspecialchars($p['navn']) ?></h3>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($p['kategori_navn']) ?> | <strong>Mærke:</strong> <?= htmlspecialchars($p['maerke']) ?></p>
                <p><strong>Pris:</strong> <?= htmlspecialchars($p['pris']) ?> kr. 
                    <?php if ($p['rabat_pris']): ?>
                        (Tilbud: <?= htmlspecialchars($p['rabat_pris']) ?> kr.)
                    <?php endif; ?>
                </p>
                <p><strong>Vægt:</strong> <?= htmlspecialchars($p['vaegt_gram']) ?> g | <strong>Lager:</strong> <?= htmlspecialchars($p['lagerantal']) ?> stk.</p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>