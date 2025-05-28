<?php
include("../backend/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    $keranjangData = $keranjang->getDataById($id);
    $porsi = $keranjangData['porsi'];

    if ($action === 'plus') {
        $porsi++;
    } elseif ($action === 'min') {
        if($porsi <= 1){
            $keranjang->destroy($id);
            header('Location: keranjang.php');
            exit;
        }
        $porsi--;
    }
    $keranjang->updatePorsi($id, $porsi);
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['d'] ?? false;
    $nuke = $_GET['nuke'] ?? false;

    if ($id != false) {
        $keranjang->destroy( $id );
        header('Location : keranjang.php');
    }
    
    if($nuke != false) {
        $keranjang->nuke();
        header('Location : ../index.php');
    }
}
$totalHarga= 0;
$listKeranjang = $keranjang->fetchAllData();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $namaToko; ?> | Cangkir</title>

    <link rel="stylesheet" href="../asset/css/navbar.css">
    <link rel="stylesheet" href="../asset/css/global.css">
    <link rel="stylesheet" href="../asset/css/keranjang.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../asset/img/ginger-tea.png" alt="Logo" height="50px">
                <h2><a href="../index.php"><?= $namaToko ?></a></h2>
            </div>
            <!-- // Search -->
            <div class="search-container">
                <form action="/" method="get" class="search">
                    <input type="text" name="search" id="search" placeholder="Cari bahan...">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <!-- Keranjang -->
            <div class="cart">
                <a href="keranjang.php"><i class="bi bi-measuring-cup"></i></a>
                <?php if($totalDataKeranjang !== 0): ?>
                    <span class="cart-count"><?= $totalDataKeranjang ?></span>
                    <?php else:?>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="cart-main">
    <h2 class="cart-title">Cangkir kamu</h2>
        <div class="cart-layout">
            <?php if(!empty($listKeranjang)): ?>
            <div class="cart-items">
                <?php foreach ($listKeranjang as $k): 
                    $subtotal = $k['total_harga'];
                    $totalHarga += $subtotal;
                    ?>
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="../<?= htmlspecialchars($k['foto']) ?>" alt="<?= htmlspecialchars($k['nama']) ?>">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-header">
                            <h3><?= htmlspecialchars($k['nama']) ?></h3>
                        </div>
                        <div class="cart-item-category">
                            <span class="delivery-method"><?= htmlspecialchars($k['jenis']) ?></span>
                        </div>
                        <div class="cart-item-actions">
                            <form method="POST" class="qty-form">
                                <input type="hidden" name="id" value="<?= $k['keranjang_id'] ?>">
                                <button type="submit" name="action" value="min" class="qty-btn">-</button>
                                <span class="qty-count"><?= $k['porsi'] ?></span>
                                <button type="submit" name="action" value="plus" class="qty-btn">+</button>
                            </form>
                            <div class="cart-item-price">
                                Rp<?= number_format($k['total_harga']) ?>
                            </div>
                        </div>
                    </div>
                    <a href="?d=<?= $k['keranjang_id'] ?>" class="cart-item-delete"><i class="bi bi-trash3-fill"></i></a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <div class="cart-items"></div>
                    <div class="cart-item">
                        <h2 class="empty-cart">Cangkir mu kosong.. Total Harga : <?= $totalHarga ?></h2>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($listKeranjang)): ?>
            <div class="cart-summary">
                <div class="details-options">
                    <h2>Details</h2>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>Rp<?= number_format($totalHarga) ?></span>
                </div>
                <a href="?nuke=doit" class="checkout-btn"  onclick="confirmAlert('Pay?')">Checkout</a>
            </div>
            <?php else: ?>
                <?php endif; ?>
        </div>
    </main>

    <footer>
    </footer>
    <script src="../asset/ts/index.js"></script>
</body>
</html>