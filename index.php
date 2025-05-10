<?php 

include("backend/koneksi.php");

$listBahan = $bahan->fetchAllBahan();

?>

<?php if(!empty($listBahan)): ?>
    <h2>Daftar Bahan</h2>
    <ul>
        <?php foreach($listBahan as $v): ?>
            <li>
                <img src="<?= $v['foto'] ?>" alt="<?= $v['nama'] ?>">
                <div class="tugas">
                    <p>bahan : <u><?= htmlspecialchars($v['nama']) ?></u></p>
                </div>
                <div class="waktu">
                    <p>deskripsi : <?= $v['deskripsi'] ?></p>
                </div>
                <div class="waktu">
                    <p>Harga : Rp.<?= $v['harga'] ?></p>
                </div>
                <div class="act-button">
                    <a class="hapus" href="?d=<?= $v['id'] ?>"><i class="bi bi-trash3-fill"></i></a>
                    <a class="edit" href="u.php?u=<?= $v['id'] ?>"><i class="bi bi-pencil-fill"></i></a>
                    <a class="info" href="display.php?u=<?= $v['id'] ?>"><i class="bi bi-eye-fill"></i></a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Belum ada tugas</p>
<?php endif; ?>