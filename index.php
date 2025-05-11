<?php 

include("backend/koneksi.php");

$listBahan = $bahan->fetchAllBahan();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamu Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="asset/css/navbar.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="asset/img/ginger-tea.png" alt="Logo" height="50px">
                <h2>Mbah Jamu</h2>
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

    </main>

    <footer>

    </footer>
</body>
</html>