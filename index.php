<?php 
$namaToko = "Mbah Jamu";
include("backend/koneksi.php");

$listBahan = $bahan->fetchAllBahan();

?>

<!DOCTYPE html>
<html lang="en">
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
                <form action="/" method="post" class="search">
                    <input type="text" name="search" id="search" placeholder="Cari jamu...">
                    <button type="submit">Cari</button>
                </form>
            </div>
            
            <div class="cart">
                <a href=""><i class="bi bi-measuring-cup-fill"></i></a>
            </div>
        </nav>
    </header>

    <main>
<?php if (!empty($listBahan)): ?>
        <div class="sidebar">
            <h2>Kategori</h2>
            <?php foreach ($listBahan as $k): ?>
                <a href=""><?= $k['jenis'] ?></a>
            <?php endforeach; ?>
        </div>
        <div class="content">
        <div class="card-grid">
            <?php foreach ($listBahan as $b): ?>
            <div class="card">
                <img src="<?= $b['foto'] ?>" alt="Jamu <?= $b['nama'] ?>" class="card-img">
                <div class="card-body">
                <h3 class="card-title"><?= $b['nama'] ?></h3>
                <p class="card-category"><?= $b['jenis'] ?></p>
                <p class="card-description"><?= $b['deskripsi'] ?></p>
                <a href="?tKeranjang=<?= $b['id'] ?>" class="card-button">Tambah Keranjang</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="social">
            <p>Author : Adam Wahyu Hariyadi</p>
            <div class="social-links">
                <ul class="link">
                    <li><a target="_blank" href="mailto:adamdesign19@gmail.com"><i class="bi bi-google"></i></a></li>
                    <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#"><i class="bi bi-github"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="yapping">
            <div class="tentang">
                <h2>Tentang</h2>
                <p>Website ini dibuat untuk Ulangan Tengah Semester (MIDTEST) Pemrograman Web 1 - Dibuat Oleh Adam Wahyu Hariyadi menggunakan PHP dengan database Sqlite - 
                    <a style="color:purple; font-weight:900;" href="https://utpas.ac.id">UTPAS 23</a></p>
            </div>
            <div class="credit">
                <h2>Links</h2>
                <ul>
                    <li><a href="#">Credit</a></li>
                    <li><a href="#">Keranjang</a></li>
                    <li><a href="#">about</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>