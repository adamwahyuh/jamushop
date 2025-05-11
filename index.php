<?php 
$namaToko = "Jamu Mbah Jawa";
include("backend/koneksi.php");

$totalBahan = count($bahan->fetchAllBahan());
$totalDataKeranjang = count($keranjang->fetchAllData());
$search = $_GET['search'] ?? '';

$totalBahanUtama = $bahan->countEachDataCategory('bahan utama');
$totalRempahTambahan = $bahan->countEachDataCategory('rempah tambahan');
$totalPemanis = $bahan->countEachDataCategory('pemanis');
$totalBahanTambahan = $bahan->countEachDataCategory('bahan tambahan');

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
        <nav>
            <div class="logo">
                <img src="asset/img/ginger-tea.png" alt="Logo" height="50px">
                <h2><?= $namaToko ?></h2>
            </div>
            
            <div class="search-container">
                <form action="/" method="get" class="search">
                    <input type="text" name="search" id="search" placeholder="Cari bahan...">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            
            <div class="cart">
                <a href=""><i class="bi bi-measuring-cup-fill"></i></a>
                <?php if($totalDataKeranjang !== 0): ?>
                    <span class="cart-count"><?= $totalDataKeranjang ?></span>
                    <?php else:?>
                <?php endif; ?>
            </div>
        </nav>
    </header>

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
                                <input type="number" name="porsi" class="porsi-input" value="1" min="1">
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
        <div class="social">
            <p>Author : Adam Wahyu Hariyadi</p>
            <div class="social-links">
                <ul class="link">
                    <li><a target="_blank" href="mailto:adamdesign19@gmail.com"><i class="bi bi-google"></i></a></li>
                    <li><a target="_blank" href="https://instagram.com/adamwahyuh"><i class="bi bi-instagram"></i></a></li>
                    <li><a target="_blank" href="https://github.com/adamwahyuh"><i class="bi bi-github"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="yapping">
            <div class="tentang">
                <h2>Tentang</h2>
                <p>Website ini dibuat untuk Ujian Tengah Semester (MIDTEST) Pemrograman Web 1 - Dibuat Oleh Adam Wahyu Hariyadi menggunakan PHP dengan database Sqlite - 
                    <a style="color:purple; font-weight:900;" href="https://utpas.ac.id">UTPAS 23</a></p>
            </div>
            <div class="credit">
                <h2>Links</h2>
                <ul>
                    <li><a href="#">Credit</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="asset/js/index.js"></script>
</body>
</html>