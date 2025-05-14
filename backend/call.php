<?php
// Counter 
$totalBahanUtama = $bahan->countEachDataCategory('bahan utama');
$totalRempahTambahan = $bahan->countEachDataCategory('rempah tambahan');
$totalPemanis = $bahan->countEachDataCategory('pemanis');
$totalBahanTambahan = $bahan->countEachDataCategory('bahan tambahan');
$totalBahan = count($bahan->fetchAllBahan());
$totalDataKeranjang = count($keranjang->fetchAllData());