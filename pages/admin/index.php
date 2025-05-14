<?php
    include ("../../backend/koneksi.php");
    include ("../../backend/call.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard | Toko Jamu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../asset/css/dashboard-admin.css">
</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar d-flex flex-column">
        <h4><?= $namaToko ?></h4>
        <a href="#">Dashboard</a>
        <a href="#">Product</a>
        <a href="#">Create</a>
      </div>
        <!-- Sidebar -->
      <div class="col-md-10 content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm">
          <div class="container-fluid">
            <span class="navbar-brand">Dashboard Admin</span>
            <div class="d-flex">
              <span class="me-3">Halo, Admin</span>
              <a href="#" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
          </div>
        </nav>

        <div class="row g-3">
          <div class="col-md-4">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <p class="card-text fs-3"><?= $totalBahan  ?></p>
              </div>
            </div>
          </div>
        </div>

    </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
