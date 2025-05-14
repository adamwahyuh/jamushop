<head>
    <link rel="stylesheet" href="../../asset/css/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<nav>
    <div class="logo">
        <img src="../../asset/img/ginger-tea.png" alt="Logo" height="50px">
        <h2><?= $namaToko ?></h2>
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
        <a href="pages/keranjang.php"><i class="bi bi-measuring-cup"></i></a>
        <?php if($totalDataKeranjang !== 0): ?>
            <span class="cart-count"><?= $totalDataKeranjang ?></span>
            <?php else:?>
        <?php endif; ?>
    </div>
</nav>