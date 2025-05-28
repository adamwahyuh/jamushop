<?php
include('../../backend/koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaRacikan = $_POST['nama_racikan'] ?? false;
    if ($namaRacikan != false) {
        $racikan->create($namaRacikan);
        $lastId = $kon->lastInsertId();
        header("Location: racikan/create-detail.php?id=" . $lastId);
        exit();
    }
}

$listRacikan = $racikan->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/racikan.css">
    <!-- <link rel="stylesheet" href="../../asset/css/global.css"> -->

    <title>Pilihan mu</title>
</head>
<body>
    <?php include('../components/navbar.php'); ?>

   <main class="container">
    <h1 class="heading">Racikanmu</h1>

    <!-- Form Buat Racikan -->
    <form class="form" method="POST">
        <div class="form-group input-group">
            <input type="text" name="nama_racikan" class="input-text" placeholder="Nama racikanmu" required>
            <button type="submit" class="btn-secondary">Make</button>
        </div>
    </form>

    <!-- Daftar Racikan -->
    <?php if (empty($listRacikan)): ?>
        <div class="alert-info">
            Belum ada racikan. Yuk buat racikan pertamamu!
        </div>
    <?php else: ?>
        <div class="racikan-list">
            <?php foreach ($listRacikan as $racikan): ?>
                <div class="racikan-item">
                    <div class="racikan-info">
                        <h5 class="racikan-title"><?= htmlspecialchars($racikan['nama']) ?></h5>
                        <div class="bahan-list">
                            <?php foreach ($racikan['bahan'] as $bahan): ?>
                                <img src="../../<?= htmlspecialchars($bahan['foto']) ?>" alt="bahan" class="bahan-img">
                            <?php endforeach; ?>
                            <a href="detail_racikan.php?id=<?= $racikan['id'] ?>" class="btn-icon">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="racikan-actions">
                        <a href="edit_racikan.php?id=<?= $racikan['id'] ?>" class="btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="delete_racikan.php?id=<?= $racikan['id'] ?>" class="btn-danger" onclick="return confirm('Yakin hapus?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>


</body>
</html>