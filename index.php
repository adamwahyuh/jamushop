<?php 
session_start();
include("backend/koneksi.php");

$search = $_GET['search'] ?? '';
if ($search !== ''){
    $listBahan = $bahan->search($search);
}else{
    $listBahan = $bahan->fetchAllBahan();
}

//handler untuk postnya -> masukin data ke keranjang 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bahan_id = $_POST['bahan_id'] ?? false;
    $porsi = $_POST['porsi'] ?? false;
    if (!empty($bahan_id) && !empty($porsi)) {
        $cekData = $keranjang->findDataByFId($bahan_id);
        if ($cekData) {
            $newPorsi = $cekData['porsi'] + $porsi;
            $keranjang->updatePorsi($cekData['id'],  $newPorsi);
        } else {
            $keranjang->create($bahan_id, $porsi);
        }
        $_SESSION['success'] = "Bahan berhasil Dituangkan!";
        header('Location: /');
        exit();
    }

}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $namaToko ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="asset/css/navbar.css">
    <link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="asset/css/footer.css">
    <link rel="stylesheet" href="asset/css/global.css">
    <link rel="stylesheet" href="asset/css/card.css">
</head>
<body>
    
    <header>
        <?php include("pages/components/navbar.php"); ?>
    </header>

    <!-- pesan berhasil tambah -->
    <?php 
        if (isset($_SESSION['success'])) {
            echo '<div class="alert success" id ="succes-msg">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
    ?>

    <main>
        <div class="sidebar">
            <div class="side-content">
                <div class="category">
                    <h2>Kategori</h2>
                    <a href="?search=bahan+utama">Bahan Utama <span class="highlight-indicator">(<?= $totalBahanUtama; ?>)</span></a>
                    <a href="?search=rempah+tambahan">Rempah Tambahan <span class="highlight-indicator">(<?= $totalRempahTambahan; ?>)</span></a>
                    <a href="?search=pemanis">Pemanis <span class="highlight-indicator">(<?= $totalPemanis; ?>)</span></a>
                    <a href="?search=bahan+tambahan">Bahan Tambahan <span class="highlight-indicator">(<?= $totalBahanTambahan; ?>)</span></a>
                    <a href="?search=">Semua <span class="highlight-indicator">(<?= $totalBahan ?>)</span></a>
                    <hr>
                </div>
                <div class="admin">
                    <h2>Administrator</h2>
                    <a href="pages/admin/">Admin panel</a>
                    <hr>
                </div>
            </div>
            
        </div>

    <?php if (!empty($listBahan)): ?>
        <div class="content">
            <div class="card-grid">
                <?php foreach ($listBahan as $b): ?>
                <div class="card">
                    <img src="<?= $b['foto'] ?>" alt="<?= $b['nama'] ?>" class="card-img">
                    <div class="card-body">
                        <h3 class="card-title"><?= $b['nama'] ?></h3>
                        <h3 class="card-price">Rp.<?= $b['harga'] ?></h3>
                        <p class="card-category"><?= $b['jenis'] ?></p>
                        <p class="card-description"><?= $b['deskripsi'] ?></p>
                        <form action="" method="post" class="keranjang-form">
                            <input type="hidden" name="bahan_id" value="<?= $b['id'] ?>">
                            <div class="porsi-control">
                                <button type="button" class="kurang">−</button>
                                <input type="number" name="porsi" class="porsi-input" value="1" min="1" readonly>
                                <button type="button" class="tambah">+</button>
                            </div>
                            <button type="submit" class="card-button">Tambah Keranjang</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <p class="not-found">Tidak ada bahan... :( </p>
        </div>  
            <?php endif; ?>
    </main>

    <footer>
        <?php include("pages/components/footer.php"); ?>
    </footer>

    <script src="asset/js/index.js"></script>
</body>
</html>